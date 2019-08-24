<?php
/*
	Initiated when in the Network Admin panels.
	Used to create the Settings page for the plugin.
*/

add_action( 'network_admin_menu', 'jr_ps_network_admin_hook' );
//	Runs just after admin_init

/**
 * Add Network Admin Menu item for plugin
 * 
 * Plugin needs its own Page in the Settings section of the Network Admin menu.
 *
 */
function jr_ps_network_admin_hook() {
	//  Add Network Settings Page for this Plugin
	global $jr_ps_plugin_data;
	add_submenu_page( 'settings.php', $jr_ps_plugin_data['Name'], 'Private Sites', 'manage_network_options', 'jr_ps_network_settings', 'jr_ps_network_settings_page' );
}

/**
 * Network Settings page for plugin
 * 
 * Display and Process Settings page for this plugin.
 *
 */
function jr_ps_network_settings_page() {
	global $jr_ps_plugin_data;
	add_thickbox();
	echo '<div class="wrap">';
	screen_icon( 'plugins' );
	echo '<h2>' . $jr_ps_plugin_data['Name'] . '</h2>';
	?>
	<p>
	This Plugin has been <b>Network Activated</b> in a WordPress Multisite ("Network") installation.
	Since all of this plugin's Settings can be specified separately for each individual WordPress site,
	you will need to go to the Admin pages for each Site,
	and review the plugin's Settings page,
	making changes appropriate for that Site.
	The plugin's Settings page can be found by opening the <b>Settings</b> submenu on the left sidebar of each Admin page for the Site
	and selecting <b>Private Site</b>.
	Or from the <b>Settings</b> link in the plugin's entry on the <b>Installed Plugins</b> page for the Site
	<i>(WordPress does not list Network Activated plugins on each Site's Installed Plugins page,
	but this plugin has added its own entry for your convenience)</i>.
	</p>
	<p>
	Alternatively, you can <b>Network Deactivate</b> this plugin
	and <b>Activate</b> it individually on each Site where you wish to use it.
	</p>
	<p>
	If you would prefer, when this plugin is Network Activated,
	to have a single set of Settings that would apply to all Sites in a WordPress network,
	and/or be able to view and change all of the Settings for all Sites from this one Network Settings page that you are now viewing,
	<a href="http://zatzlabs.com/contact-us/">please contact the Plugin author</a>
	and this will be added to a future version of this plugin if there is enough interest expressed by webmasters such as you.
	</p>
	<?php
}

?>