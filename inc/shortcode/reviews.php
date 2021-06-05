<?php
/**
* Plugin shortcode functions
*/

// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.

defined( 'ABSPATH' ) || exit( RT_GO_AWAY_MSG );


/**
 * Renders the reviews in the front-end
 * @param Array $attr
 * @param String $content
 * @return String
 */
function rt_frontend_reviews_shortcode( $attr, $content = null ) {

	// extract shortcode attributes
	extract(
		shortcode_atts(
			array(
				'toplists_key' 	=> RT_DEFAULT_LIST_ID,
				'cache' 		=> RT_ENABLE_CACHE,
				'tpl'			=> 'default',
			), 
			$attr
		)
	);

	// declare output variable
	$output = '';

	// default html template and css paths
	$template =  'inc/front/tpl/default.php';
	$template_css = 'inc/front/tpl/default.css';
	
	// if the tpl shortcode attribute is not default, check the path and if exists update the $template variable
	if( $tpl != "default" && file_exists( RT_PLUGIN_PATH . 'inc/front/tpl/' . $tpl . '.php' ) ) {

		$template = 'inc/front/tpl/' . $tpl . '.php';
	}

	// if the tpl shortcode attribute is not default, check the css path and if exists update the $template_css variable
	if( $tpl != "default" && file_exists( RT_PLUGIN_PATH . 'inc/front/tpl/' . $tpl . '.css' ) ) {

		$template_css = 'inc/front/tpl/' . $tpl . '.css';
	}

	// create a unique ID for the review list
	$data_id = md5( RT_DATA_API_ENDPOINT . $toplists_key );

	// add template css file loaded in footer since this is non critical frontend rendering
	$ver = filemtime( RT_PLUGIN_PATH . $template_css );
    wp_register_style( 'rt_review_' . $tpl ,  plugins_url( $template_css, RT_PLUGIN_URL ), array(), $ver, 'all' );
	wp_enqueue_style( 'rt_review_' . $tpl );

	// check if caching is enabled and template is not admin
	if( (bool)$cache === TRUE && $tpl != "admin" ) {

		// retrieve file from cache and on success return the cached version
		if( $cached_html = rt_cache_get_review( $data_id ) ) {

			return $cached_html;
		}
	}

	// Caching not enable then fetching source data from API
	if( $source_data = rt_fetch_source_data( RT_DATA_API_ENDPOINT ) ) {

		// convert JSON data to Array
		$json_data = @json_decode( $source_data, true );

		// if toplist key exists
		if( ! empty( $json_data['toplists'][$toplists_key] ) ) {

			// sort the list based on the "position" key
			$sorted_list = rt_custom_sort_list( $json_data['toplists'][$toplists_key], $data_id );

			// HTML table headers
			$output .= '<div id="rt-review-' . ( $tpl == "admin" ? 'default' : $tpl ) . '">';
			$output .= '<table class="rt-reviews"' . ( $tpl == "admin" ? 'data-id="' . $data_id . '"' : '' ) . '>
							<thead>
								<tr>
									' . ( $tpl == "admin" ? '<th></th>' : '' ) . '
									<th>' . __( 'Casino', 'raketech' ) . '</th>
									<th>'. __( 'Bonus', 'raketech' ) . '</th>
									<th class="text-left">' . __( 'Features', 'raketech' ) . '</th>
									<th>' . __( 'Play', 'raketech' ) . '</th>
								</tr>
							</thead>
							<tbody>';

			// loop through the list and render HTML
			foreach( $sorted_list as $review_data ) {
			
				ob_start();
				
				include( RT_PLUGIN_PATH . $template );

				$output .= ob_get_contents();
				
				ob_end_clean();
			}

			// close table body
			$output .= '</tbody></table></div>';

			// if caching is enabled and template is not admin
			if( (bool)$cache === TRUE && $tpl != "admin" ) {

				// add cache timestamp at the end of rendered HTML
				$cached_output = $output . '<!-- RT cached @' . date( 'Y-m-d H:i:s' ) . ' -->';

				// save cached data to filesystem
				rt_cache_save_review( $cached_output, $data_id );
			}

			return $output;
		}
	}

	// fail silently
	return $output;
}

/**
 * Sort reviews list based on user defined positions
 * @param Array $list_array
 * @param Int $id
 * @return Array
 */
function rt_custom_sort_list( $list_array, $id ) {

	// fetch user defined sorting position for list key from options table
	$user_sorting = get_option( 'raketech_' . $id );

	// if user defined sorting is not empty
	if( $user_sorting ) {

		// loop through the reviews list
		foreach( $list_array as $index => $list_item ) {

			// match brand_id from list array item with user defined positions array
			$new_position = array_search( (int)$list_item['brand_id'], $user_sorting );

			// if a nwe position is found
			if( $new_position !== false ) {

				// update the list array item with the new position
				$list_array[ $index ]['position'] = $new_position;
			}
		}
	}

	// sort the list array by the newly updated positions
	usort( $list_array, 'sortByPosition' );

	// return updated list array
	return $list_array;
}

/**
 * Sort reviews by position key
 * @return Array
 */
function sortByPosition( $a, $b ) {
    
	return $a['position'] - $b['position'];
}