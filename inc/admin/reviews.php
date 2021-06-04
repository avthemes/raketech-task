<?php
/**
* Plugin admin functions
*/

// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.

defined( 'ABSPATH' ) || exit( RT_GO_AWAY_MSG );

function rt_admin_review_sorting() {

	echo '<div class="wrap"><div id="poststuff"><div id="post-body" class="metabox-holder"><div id="post-body-content"><div class="postbox">';

	echo '<h1>' . esc_attr( 'Reviews Sorting', 'raketech' ) . '</h1>';

	echo '<p class="instructions">Click and drag the arrows to sort the reviews</p>';

	echo '<div class="btns" style="padding-bottom: 0;"><input class="button-primary btn-save" type="button" name="Example" value="' . esc_attr( 'Save new positions' ) . '" /> ';

	echo '<span class="save-status"></span></div>';

	echo '<div id="review-container">';

	echo do_shortcode( '[rt_reviews cache="false" tpl="admin"]' );

	echo '</div>';

	echo '<div class="btns"><input class="button-primary btn-save" type="button" name="Example" value="' . esc_attr( 'Save new positions' ) . '" /> ';

	echo '<span class="save-status"></span></div>';

	echo '</div></div></div></div></div>';
}


function rt_admin_save_review_positions() {

    $reponse = array();

    if( ! empty( $_POST['positions'] ) && ! empty( $_POST['id'] ) ){

		$response['response'] = '<span class="rt-success">' . esc_html( 'Positions saved', 'raketech' ) . ' @' . date( 'H:i:s' ) . '</span>';

		update_option( 'raketech_' . $_POST['id'], $_POST['positions'], 'no' );
    } 
	else {
         
		$response['response'] = '<span class="rt-fail">' . esc_html( 'Error saving positions', 'raketech' ) . ' @' . date( 'H:i:s' ) . '</span>';
    }

    header( "Content-Type: application/json" );
    echo json_encode( $response );

    // Never forget to always exit in the ajax function.
    exit;
}