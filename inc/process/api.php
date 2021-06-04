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
function rt_fetch_source_data() {

	// fetch data from API endpoint
	$args = array(
		'headers' => array(
			'Content-Type' => 'application/json',
		)
	);

	$response = wp_remote_get( RT_DATA_API_ENDPOINT, $args );

	// check for errors
	if ( is_array( $response ) && ! is_wp_error( $response ) ) {
		
		return $response['body']; // use the content
	}

	return false;
}