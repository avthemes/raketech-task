<?php
/**
* Consuming API functions
*/

// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.

defined( 'ABSPATH' ) || exit( RT_GO_AWAY_MSG );

/**
 * Fetches data from API endpoint
 */
function rt_fetch_source_data( $api_url, $ids_only = false ) {

	// fetch data from API endpoint
	$args = array(
		'headers' => array(
			'Content-Type' => 'application/json',
		)
	);

	$response = wp_remote_get( $api_url, $args );

	// check for errors
	if ( is_array( $response ) && ! is_wp_error( $response ) ) {
		
		if( $ids_only ) {

			$json_data = @json_decode( $response['body'], true );

			if( ! empty( $json_data['toplists'] ) ) {
			
				foreach( $json_data['toplists'] as $list_id => $list_item ) {

					if( ! empty( $list_item ) ) {
					
						$output[] = $list_id;
					}
				}

				return $output;
			}

			return false;
		}

		return $response['body']; // use the content
	}

	return false;
}