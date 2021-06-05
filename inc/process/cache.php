<?php
/**
* Plugin caching functions
*/

// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.

defined( 'ABSPATH' ) || exit( RT_GO_AWAY_MSG );

/**
 * Refreshes the cache and do some tidying up
 */
function rt_cache_get_review( $file_id ) {

	$file_path = RT_PLUGIN_PATH . 'cache/' . $file_id;

	// check if cached file exists
	// and check if it has not expired
	if( file_exists( $file_path ) ) {

		if( filemtime( $file_path ) > strtotime( '-' . RT_CACHE_EXPIRE . ' hours' ) ) {
			
			// all looks good, we service the file
			return file_get_contents( $file_path );
		}
		else {

			// the cached file is stale, let's delete it.
			@unlink( $file_path );
		}
	}

	return false;
}


function rt_cache_save_review( $html, $file_id ) {

	$file_path = RT_PLUGIN_PATH . 'cache/' . $file_id;

	if( file_put_contents( $file_path, $html ) !== false ) {

		return true;
	}

	return false;
}


function rt_cache_delete( $file_id ) {

	$file_path = RT_PLUGIN_PATH . 'cache/' . $file_id;

	if( file_exists( $file_path ) ) {
	
		return @unlink( $file_path );
	}

	return false;
}