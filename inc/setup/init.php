<?php
/**
* Plugin init functions
*/

// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.

defined( 'ABSPATH' ) || exit( RT_GO_AWAY_MSG );

/**
 * Add menu link and page in admin sidebar
 * @return void
 */
function rt_create_admin_menu() {

	// add ad admin menu page for the plugin
	add_menu_page(
		__( 'Raketech Reviews', 'raketech' ), // page title
		__( 'Raketech', 'raketech' ), // Menu title
		'edit_theme_options', // capability
		'rt_reviews', // menu slug
		'rt_admin_review_sorting', // page content function
		'dashicons-list-view', // menu icon
		2 // lower values highest position in menu order
	);
}