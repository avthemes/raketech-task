<?php
/**
* Consuming API functions
*/

// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.

defined( 'ABSPATH' ) || exit( RT_GO_AWAY_MSG );

/**
 * Fetches data from API endpoint
 * @param String $api_url - API endpoint for data source
 * @param Boolean $ids_only - Set to true to return only toplist IDs
 * @return Mixed
 */
function rt_fetch_source_data( $api_url, $ids_only = false ) {

	// set headers for API
	$args = array(
		'headers' => array(
			'Content-Type' => 'application/json',
		)
	);

	// fetch data from API endpoint
	$response = wp_remote_get( $api_url, $args );

	// check for errors
	if ( is_array( $response ) && ! is_wp_error( $response ) ) {
		
		// if $ids_only is true, loop through response and return only toplists IDs
		if( $ids_only ) {

			// json decode the response body
			$json_data = @json_decode( $response['body'], true );

			// if toplists array not empty
			if( ! empty( $json_data['toplists'] ) ) {
			
				// loop through toplists
				foreach( $json_data['toplists'] as $list_id => $list_item ) {

					// if list item is not empty
					if( ! empty( $list_item ) ) {
					
						// add list id to output array
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