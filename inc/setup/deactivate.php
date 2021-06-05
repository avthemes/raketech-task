<?php
/**
* Plugin de-activation functions
*/

// Security check if plugin is being loaded via WP or not
// Exit if accessed directly.

defined( 'ABSPATH' ) || exit( RT_GO_AWAY_MSG );

/**
 * De-activate plugin
 * @return void
 */

function rt_deactivate_plugin() {

	// Nothing to do here, so we probably don't need it

}