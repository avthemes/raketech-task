<?php
/**
* Plugin admin functions
*/

// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.

defined( 'ABSPATH' ) || exit( RT_GO_AWAY_MSG );

function rt_admin_review_sorting() {

	$list_ids = rt_fetch_source_data( RT_DATA_API_ENDPOINT, true );

	echo '<div class="wrap"><div id="poststuff"><div id="post-body" class="metabox-holder"><div id="post-body-content"><div class="postbox">';

	echo '<h1>' . esc_attr( 'Reviews Sorting', 'raketech' ) . '</h1>';

	echo '<p class="instructions">Click and drag the arrows to sort the reviews</p>';

	echo '<div class="btns" style="padding-bottom: 0;"><input class="button-primary btn-save" type="button" value="' . esc_attr( 'Save new positions' ) . '" /> ';

	echo '<span class="save-status"></span>';
	
	if( $list_ids ) {
		
		echo '<div class="select-list">Review List ID: <select id="select-list">';
		
		echo '<option value=""> - select - </option>';

		foreach( $list_ids as $list_id ) { 
			
			$selected_id = RT_DEFAULT_LIST_ID;
			
			if( ! empty( $_GET['id'] ) ) {

				$selected_id = (int)$_GET['id'];
			}
			
			echo '<option value="' . admin_url( 'admin.php?page=rt_reviews&id=' . $list_id ) . '"' . ( $selected_id == $list_id ? ' selected' : '') . '>' . $list_id . '</option>';
		}

		echo '</select></div>';
	}

	echo '</div><div id="review-container">';

	$shortcode = '[rt_reviews cache="false" tpl="admin"' . ( ! empty( $_GET['id'] ) ? ' toplists_key="' . (int)$_GET['id'] . '"' : '' ) . ']';

	echo do_shortcode( $shortcode );

	echo '</div>';

	echo '<div class="btns"><input class="button-primary btn-save" type="button" value="' . esc_attr( 'Save new positions' ) . '" /> ';

	echo '<span class="save-status"></span></div>';

	echo '</div></div></div></div></div>';
}


function rt_admin_save_review_positions() {

	check_ajax_referer( 'rt_reviews', 'security' );

    $reponse = array();

    if( ! empty( $_POST['positions'] ) && ! empty( $_POST['id'] ) ){

		$response['response'] = '<span class="rt-success">' . esc_html( 'Positions saved', 'raketech' ) . ' @' . date( 'H:i:s' ) . '</span>';

		update_option( 'raketech_' . $_POST['id'], $_POST['positions'], 'no' );

		// delete cached file if it exists
		if( RT_ENABLE_CACHE === TRUE ) {
			
			rt_cache_delete( $_POST['id'] );
		}
    } 
	else {
         
		$response['response'] = '<span class="rt-fail">' . esc_html( 'Error saving positions', 'raketech' ) . ' @' . date( 'H:i:s' ) . '</span>';
    }

    header( "Content-Type: application/json" );
    echo json_encode( $response );

    // Never forget to always exit in the ajax function.
    exit;
}