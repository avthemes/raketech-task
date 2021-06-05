<?php
/**
* Plugin admin enqueue functions
*/

// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.

defined( 'ABSPATH' ) || exit( RT_GO_AWAY_MSG );

function rt_admin_enqueue() {

	if( isset( $_GET['page'] ) && $_GET['page'] == "rt_reviews" ) {

		wp_register_style( 'rt_jquery_ui', plugins_url( '/inc/assets/css/jquery-ui.min.css', RT_PLUGIN_URL ) );

		$css_ver = filemtime( RT_PLUGIN_PATH . 'inc/assets/css/admin.css' );
		wp_register_style( 'rt_admin', plugins_url( '/inc/assets/css/admin.css', RT_PLUGIN_URL, array(), $css_ver ) );
		wp_enqueue_style( 'rt_jquery_ui' );
		wp_enqueue_style( 'rt_admin' );

		wp_register_script( 'rt_jquery_ui', plugins_url( 'inc/assets/js/jquery-ui.min.js', RT_PLUGIN_URL ), array( 'jquery' ), NULL, TRUE );

		$js_ver = filemtime( RT_PLUGIN_PATH . 'inc/assets/js/admin.js' );
		wp_register_script( 'rt_admin', plugins_url( 'inc/assets/js/admin.js', RT_PLUGIN_URL ), array( 'jquery' ), $js_ver, TRUE );
		wp_enqueue_script( 'rt_jquery_ui' );
		wp_enqueue_script( 'rt_admin' );

		$params = array(
			'rt_security' => wp_create_nonce( 'rt_reviews' ),
		);

		wp_localize_script( 'rt_admin', 'rt_ajax_object', $params );
	}
}