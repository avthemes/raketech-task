<?php
/**
* Plugin caching functions
*/

// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.

defined( 'ABSPATH' ) || exit( RT_GO_AWAY_MSG );

/**
 * Refreshes the cache and do some tidying up
 * @param Int $file_id
 * @return Mixed
 */
function rt_cache_get_review( $file_id ) {

	// path to fetch the cached file
	$file_path = RT_PLUGIN_PATH . 'cache/' . $file_id;

	// check if cached file exists
	if( file_exists( $file_path ) ) {

		// and check if it has not expired
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

/**
 * Save cached data to filesystem
 * @param String $html - the html data to cache
 * @param Int $file_id
 * @return Boolean
 */
function rt_cache_save_review( $html, $file_id ) {

	// path to save the cached file
	$file_path = RT_PLUGIN_PATH . 'cache/' . $file_id;

	// save file to filesystem and return true on success
	if( file_put_contents( $file_path, $html ) !== false ) {

		return true;
	}

	return false;
}

/**
 * Deletes cached file from filesystem
 * @param Int $file_id
 * @return Boolean
 */
function rt_cache_delete( $file_id ) {

	// path to cached file
	$file_path = RT_PLUGIN_PATH . 'cache/' . $file_id;

	// file the file exists on filesystem
	if( file_exists( $file_path ) ) {
	
		// delete it and return status
		return @unlink( $file_path );
	}

	return false;
}