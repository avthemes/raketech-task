<?php
/**
* Plugin admin enqueue functions
*/

// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.

defined( 'ABSPATH' ) || exit( RT_GO_AWAY_MSG );

/**
 * Scripts to enqueue on plugin admin page
 * @return Void
 */
function rt_admin_enqueue() {

	// If admin page is rt_reviews load css and other scripts
	if( isset( $_GET['page'] ) && $_GET['page'] == "rt_reviews" ) {

		// load query-ui css
		wp_register_style( 'rt_jquery_ui', plugins_url( '/inc/assets/css/jquery-ui.min.css?23434', RT_PLUGIN_URL ) );
		wp_enqueue_style( 'rt_jquery_ui' );

		// load plugin admin css with version control
		$css_ver = filemtime( RT_PLUGIN_PATH . 'inc/assets/css/admin.css' );
		wp_register_style( 'rt_admin', plugins_url( '/inc/assets/css/admin.css', RT_PLUGIN_URL, array(), $css_ver ) );
		wp_enqueue_style( 'rt_admin' );

		// load query-ui js
		wp_register_script( 'rt_jquery_ui', plugins_url( 'inc/assets/js/jquery-ui.min.js?344', RT_PLUGIN_URL ), array( 'jquery' ), NULL, TRUE );
		wp_enqueue_script( 'rt_jquery_ui' );

		// load plugin admin js
		$js_ver = filemtime( RT_PLUGIN_PATH . 'inc/assets/js/admin.js' );
		wp_register_script( 'rt_admin', plugins_url( 'inc/assets/js/admin.js', RT_PLUGIN_URL ), array( 'jquery' ), $js_ver, TRUE );
		wp_enqueue_script( 'rt_admin' );

		// create wp_nonce to secure ajax requests
		$params = array(
			'rt_security' => wp_create_nonce( 'rt_reviews' ),
		);

		wp_localize_script( 'rt_admin', 'rt_ajax_object', $params );
	}
}