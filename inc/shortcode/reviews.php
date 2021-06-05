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

	extract(
		shortcode_atts(
			array(
				'toplists_key' 	=> 575,
				'cache' 		=> RT_ENABLE_CACHE,
				'tpl'			=> 'default',
			), 
			$attr
		)
	);

	$output = '';

	$template =  'inc/front/tpl/default.php';
	$template_css = 'inc/front/tpl/default.css';
	
	if( $tpl != "default" && file_exists( RT_PLUGIN_PATH . 'inc/front/tpl/' . $tpl . '.php' ) ) {

		$template = 'inc/front/tpl/' . $tpl . '.php';
	}

	if( $tpl != "default" && file_exists( RT_PLUGIN_PATH . 'inc/front/tpl/' . $tpl . '.css' ) ) {

		$template_css = 'inc/front/tpl/' . $tpl . '.css';
	}

	$data_id = md5( RT_DATA_API_ENDPOINT . $toplists_key );

	$ver = filemtime( RT_PLUGIN_PATH . $template_css );
    wp_register_style( 'rt_review_' . $tpl ,  plugins_url( $template_css, RT_PLUGIN_URL ), array(), $ver, 'all' );
	wp_enqueue_style( 'rt_review_' . $tpl );

	// check if caching is enabled and retrieve file from cache
	if( RT_ENABLE_CACHE === TRUE && $tpl != "admin" ) {

		if( $cached_html = rt_cache_get_review( $data_id ) ) {

			return $cached_html;
		}
	}

	// fetching source data
	if( $source_data = rt_fetch_source_data( RT_DATA_API_ENDPOINT ) ) {

		$json_data = @json_decode( $source_data, true );

		if( ! empty( $json_data['toplists'][$toplists_key] ) ) {

			$sorted_list = rt_custom_sort_list( $json_data['toplists'][$toplists_key], $data_id );

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

			foreach( $sorted_list as $review_data ) {
			
				ob_start();
				
				include( RT_PLUGIN_PATH . $template );

				$output .= ob_get_contents();
				
				ob_end_clean();
			}

			$output .= '</tbody></table>';

			if( RT_ENABLE_CACHE === TRUE && $tpl != "admin" ) {

				$cached_output = $output . '<!-- RT cached @' . date( 'Y-m-d H:i:s' ) . ' -->';

				rt_cache_save_review( $cached_output, $data_id );
			}

			return $output;
		}
	}

	// fail silently
	return $output;
}

function rt_custom_sort_list( $list_array, $id ) {

	$user_sorting = get_option( 'raketech_' . $id );

	if( $user_sorting ) {

		foreach( $list_array as $index => $list_item ) {

			$new_position = array_search( (int)$list_item['brand_id'], $user_sorting );

			if( $new_position !== false ) {

				$list_array[ $index ]['position'] = $new_position;
			}
		}
	}

	usort( $list_array, 'sortByPosition' );

	return $list_array;
}

/**
 * Sort reviews by position key
 * @return Array
 */
function sortByPosition( $a, $b ) {
    
	return $a['position'] - $b['position'];
}