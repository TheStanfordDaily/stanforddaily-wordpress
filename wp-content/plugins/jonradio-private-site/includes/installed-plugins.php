<?php
/*
	Initiated when in the Admin panels.
	Used to handle the plugin's entry on the Install Plugins page.
*/

/* 	Support WordPress Version 3.0.x before is_network_admin() existed
*/
if ( function_exists( 'is_network_admin' ) && is_network_admin() ) {
	// Add Link to the plugin's entry on the Network Admin "Plugins" Page, for easy access
	add_filter( 'network_admin_plugin_action_links_' . jr_ps_plugin_basename(), 'jr_ps_plugin_network_action_links', 10, 1 );
	
	/**
	* Creates Settings link right on the Network Plugins Page entry.
	*
	* Helps the user understand where to go immediately upon Activation of the Plugin
	* by creating entries on the Plugins page, right beside Deactivate and Edit.
	*
	* @param	array	$links	Existing links for our Plugin, supplied by WordPress
	* @param	string	$file	Name of Plugin currently being processed
	* @return	string	$links	Updated set of links for our Plugin
	*/
	function jr_ps_plugin_network_action_links( $links ) {
		// The "page=" query string value must be equal to the slug
		// of the Settings admin page.
		array_push( $links, '<a href="' . get_bloginfo('wpurl') . '/wp-admin/network/settings.php?page=jr_ps_network_settings' . '">Settings</a>' );
		return $links;
	}
} else {
	// Add Link to the plugin's entry on the Admin "Plugins" Page, for easy access
	add_filter( 'plugin_action_links_' . jr_ps_plugin_basename(), 'jr_ps_plugin_action_links', 10, 1 );

	if ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( jr_ps_plugin_basename() ) ) {
		// Add entry for the plugin on the each site's Admin "Plugins" Page, when Network Activated and not normally shown
		add_action( 'pre_current_active_plugins', 'jr_ps_show_plugin' );
		
		function jr_ps_show_plugin() {
			global $wp_list_table;	
			global $jr_ps_path;
			$wp_list_table->items[jr_ps_plugin_basename()] = get_plugin_data( $jr_ps_path . basename( jr_ps_plugin_basename() ) );
			uasort( $wp_list_table->items, 'jr_ps_sort_plugins' );
			return;
		}
		
		function jr_ps_sort_plugins( $a, $b ) {
			return strcasecmp( $a['Name'], $b['Name'] );
		}
		
		/**
		* Creates Settings entry right on the Plugins Page entry.
		*
		* Helps the user understand where to go immediately upon Activation of the Plugin
		* by creating entries on the Plugins page, right beside Deactivate and Edit.
		*
		* @param	array	$links	Existing links for our Plugin, supplied by WordPress
		* @param	string	$file	Name of Plugin currently being processed
		* @return	string	$links	Updated set of links for our Plugin
		*/
		function jr_ps_plugin_action_links( $links ) {
			/*	Delete existing Links and replace with "Network Activated" (not a link)
				and "Settings" as a link to Plugin Settings page.
				The "page=" query string value must be equal to the slug
				of the Settings admin page.
			*/
			return array( 'Network Activated',
				'<a href="' . get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=jr_ps_settings' . '">Settings</a>'
				);
		}
	} else {
		/**
		* Creates Settings entry right on the Plugins Page entry.
		*
		* Helps the user understand where to go immediately upon Activation of the Plugin
		* by creating entries on the Plugins page, right beside Deactivate and Edit.
		*
		* @param	array	$links	Existing links for our Plugin, supplied by WordPress
		* @param	string	$file	Name of Plugin currently being processed
		* @return	string	$links	Updated set of links for our Plugin
		*/
		function jr_ps_plugin_action_links( $links ) {
			/*	Add "Settings" to the end of existing Links
				The "page=" query string value must be equal to the slug
				of the Settings admin page.
			*/
			array_push( $links, '<a href="' . get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=jr_ps_settings' . '">Settings</a>' );
			return $links;
		}
	}
}

?>