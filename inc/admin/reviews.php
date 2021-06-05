<?php
/**
* Plugin admin functions
*/

// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.

defined( 'ABSPATH' ) || exit( RT_GO_AWAY_MSG );

/**
 * Sorting of reviews in the admin page
 * @return String
 */
function rt_admin_review_sorting() {

	// Get a list of review IDs for user to choose which list to use
	$list_ids = rt_fetch_source_data( RT_DATA_API_ENDPOINT, true );

	echo '<div class="wrap"><div id="poststuff"><div id="post-body" class="metabox-holder"><div id="post-body-content"><div class="postbox">';

	echo '<h1>' . esc_attr( 'Reviews Sorting', 'raketech' ) . '</h1>';

	echo '<p class="instructions">' . __( 'Click and drag the arrows to sort the reviews', 'raketech' ) . '</p>';

	echo '<div class="btns" style="padding-bottom: 0;"><input class="button-primary btn-save" type="button" value="' . esc_attr( 'Save new positions' ) . '" /> ';

	echo '<span class="save-status"></span>';
	
	// if list_ids is not empty load the select input options
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

	// load reviews table with the admin template and the selected toplists key
	$shortcode = '[rt_reviews cache="false" tpl="admin"' . ( ! empty( $_GET['id'] ) ? ' toplists_key="' . (int)$_GET['id'] . '"' : '' ) . ']';

	echo do_shortcode( $shortcode );

	echo '</div>';

	echo '<div class="btns"><input class="button-primary btn-save" type="button" value="' . esc_attr( 'Save new positions' ) . '" /> ';

	echo '<span class="save-status"></span><div class="select-list"><a href="javascript:void(0);" style="color:#cc0000;" id="flush-cache">&orarr; Flush cache</a></div></div>';

	echo '</div></div></div></div></div>';
}

/**
 * Save user defined positions for the review items in a particular review list
 * @return String
 */
function rt_admin_save_review_positions() {

	// validate wp_nonce for security
	check_ajax_referer( 'rt_reviews', 'security' );

	// define response array
    $reponse = array();

	// if required $_POST data is not empty save new positions in wp_options table
    if( ! empty( $_POST['positions'] ) && ! empty( $_POST['id'] ) ){

		// response success message
		$response['response'] = '<span class="rt-success">' . esc_html( 'Positions saved', 'raketech' ) . ' @' . date( 'H:i:s' ) . '</span>';

		// update new position options in DB
		update_option( 'raketech_' . $_POST['id'], $_POST['positions'], 'no' );

		// delete cached file if it exists, so new cached file will be created with new positions
		if( RT_ENABLE_CACHE === TRUE ) {
			
			rt_cache_delete( $_POST['id'] );
		}
    } 
	else {
         
		// response error message
		$response['response'] = '<span class="rt-fail">' . esc_html( 'Error saving positions', 'raketech' ) . ' @' . date( 'H:i:s' ) . '</span>';
    }

	// set response header to application/json and echo json encoded response
    header( "Content-Type: application/json" );
    echo json_encode( $response );

    // Never forget to always exit in the ajax function.
    exit;
}


function rt_admin_clear_cache() {

	// validate wp_nonce for security
	check_ajax_referer( 'rt_reviews', 'security' );
 
	// get all the file names from the cache directory
	$files = glob( RT_PLUGIN_PATH . 'cache/*' );

	 // iterate files
	foreach( $files as $file ) {
		
		// if is file
		if( is_file( $file ) ) {
		  
			// delete file
			@unlink( $file );
		}
	}

	// response success message
	$response['response'] = '<span class="rt-success">' . esc_html( 'Cached files successfully deleted', 'raketech' ) . ' @' . date( 'H:i:s' ) . '</span>';

	// set response header to application/json and echo json encoded response
    header( "Content-Type: application/json" );
    echo json_encode( $response );

    // Never forget to always exit in the ajax function.
    exit;
}