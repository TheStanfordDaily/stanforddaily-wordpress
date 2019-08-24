<?php
/*
	Loaded for all Admin panels.
*/

//	Exit if .php file accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

$internal_settings = get_option( 'jr_ps_internal_settings' );
if ( isset( $internal_settings['warning_privacy'] ) ) {
	add_action( 'all_admin_notices', 'jr_ps_warning_privacy' );
	/**
	* Warn that Private Site is turned OFF by default
	* 
	* Put Warning on top of every Admin page (visible to Admins only)
	* until Admin visits plugin's Settings page.
	*
	*/
	function jr_ps_warning_privacy() {
		global $jr_ps_plugin_data;
		if ( current_user_can( 'manage_options' ) ) {
			echo '<div class="updated"><p><b>Private Site is currently turned off on ' . $jr_ps_plugin_data['Name'] . ' plugin <a href="'
				. admin_url( 'options-general.php?page=jr_ps_settings' )
				. '">Settings page</a>.</b></p></div>';
		}
	}
}

?>