<?php

/**
* Plugin Name: Raketech Task
* Plugin URI: http://wprecipe.com
* Description: Consume a review API and display formatted HTML to users.
* Version: 1.0
* Author: Ravi Ramroop
* License: GPLv2
* License URI: http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain: raketech
* Domain Path: /languages
*/

// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.

defined( 'ABSPATH' ) || exit( "Going fishing are we? Sorry no fishes here!" );


// Plugin setup and options
// Constant values can also come from options table if settings administered in wp-admin.
define( 'RT_DEV_MODE', TRUE ); // change 'FALSE' on PRODUCTION site
define( 'RT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) ); // absolute path to plugin
define( 'RT_PLUGIN_URL', __FILE__ ); // plugin URI
define( 'RT_ENABLE_CACHE', FALSE ); // enable caching, generally reading filesystem is faster than fetching a remote API endpoint.
define( 'RT_CACHE_EXPIRE', 'hourly' ); // cache expire, possible values: https://developer.wordpress.org/reference/functions/wp_get_schedules/
define( 'RT_GO_AWAY_MSG', 'Fishing are we? Sorry no fishes here!' );

define( 'RT_DATA_API_ENDPOINT', 'http://213.136.72.173/data.json' ); // URL to data source


// Includes
include( RT_PLUGIN_PATH . 'inc/setup/activate.php' ); // plugin activation functions
include( RT_PLUGIN_PATH . 'inc/setup/deactivate.php' ); // plugin de-activation functions
include( RT_PLUGIN_PATH . 'inc/setup/init.php' ); // initialization functions
include( RT_PLUGIN_PATH . 'inc/process/api.php' ); // initialization functions
include( RT_PLUGIN_PATH . 'inc/process/cache.php' ); // initialization functions
include( RT_PLUGIN_PATH . 'inc/shortcode/reviews.php' ); // enqueue assets in front-end
include( RT_PLUGIN_PATH . 'inc/front/enqueue.php' ); // enqueue assets in front-end


// Actions & Hooks
register_activation_hook( __FILE__, 'rt_activate_plugin' ); // inc/setup/activate.php
register_deactivation_hook( __FILE__, 'rt_deactivate_plugin' ); // inc/setup/deactivate.php
add_action('admin_menu', 'rt_create_admin_menu'); // inc/setup/init.php
//add_action( 'wp_enqueue_scripts', 'rt_enqueue_scripts', 100 ); // inc/front/enqueue.php


// Shortcodes
add_shortcode( 'rt_reviews', 'rt_frontend_reviews_shortcode' ); // inc/shortcode/reviews.php