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

	// fetching source data
	if( $source_data = rt_fetch_source_data() ) {

		$json_data = @json_decode( $source_data, true );

		if( isset( $json_data['toplists'][$toplists_key] ) && count( $json_data['toplists'][$toplists_key] ) > 0 ) {
		
			usort( $json_data['toplists'][$toplists_key], 'sortByPosition' );

			$ver = filemtime( RT_PLUGIN_PATH . $template_css );
        	wp_register_style( 'rt_review_' . $tpl ,  plugins_url( $template_css, RT_PLUGIN_URL ), array(), $ver, 'all' );
			wp_enqueue_style( 'rt_review_' . $tpl );

			foreach( $json_data['toplists'][$toplists_key] as $review_data ) {
			
				ob_start();
				
				include( RT_PLUGIN_PATH . $template );

				$output .= ob_get_contents();
				
				ob_end_clean();
			}

		}
	}

	// fail silently
	return $output;
}

/**
 * Sort reviews by position key
 * @return Array
 */
function sortByPosition( $a, $b ) {
    
	return $a['position'] - $b['position'];
}