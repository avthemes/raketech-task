<?php
/**
* Plugin activation functions
*/

// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.

defined( 'ABSPATH' ) || exit( RT_GO_AWAY_MSG );

/**
 * Activate plugin
 * @return void
 */
function rt_activate_plugin() {

    // check if plugin is compatible with current WordPress version
    if( version_compare( get_bloginfo( 'version' ), '5.0', '<' ) ) {

        wp_die( __( 'You must update WordPress to a version greater than 5.0 to use this plugin.', 'raketech' ) );
    }

	// if caching config is true, add a schedule event to refresh the data at a specified interval (RT_CACHE_EXPIRE)
	if( RT_ENABLE_CACHE ) {
	
		wp_schedule_event( time(), RT_CACHE_EXPIRE, 'rt_refresh_cache' );
	}
}