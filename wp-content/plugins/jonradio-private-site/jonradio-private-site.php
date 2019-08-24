<?php
/*
Plugin Name: My Private Site
Plugin URI: http://zatzlabs.com/plugins/
Description: Creates a Private Site by allowing only those logged on to view the WordPress web site.  Settings select the initial destination after login.
Version: 2.14.2
Author: David Gewirtz
Author URI: http://zatzlabs.com/plugins/
License: GPLv2
*/

/*  Copyright 2014  jonradio  (email : info@zatz.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*	Exit if .php file accessed directly
*/
if ( !defined( 'ABSPATH' ) ) exit;

global $jr_ps_path;
$jr_ps_path = plugin_dir_path( __FILE__ );
/**
 * Return Plugin's full directory path with trailing slash
 * 
 * Local XAMPP install might return:
 *	C:\xampp\htdocs\wpbeta\wp-content\plugins\jonradio-private-site/
 *
 */
function jr_ps_path() {
	global $jr_ps_path;
	return $jr_ps_path;
}

global $jr_ps_plugin_basename;
$jr_ps_plugin_basename = plugin_basename( __FILE__ );
/**
 * Return Plugin's Basename
 * 
 * For this plugin, it would be:
 *	jonradio-multiple-themes/jonradio-multiple-themes.php
 *
 */
function jr_ps_plugin_basename() {
	global $jr_ps_plugin_basename;
	return $jr_ps_plugin_basename;
}

if ( !function_exists( 'get_plugin_data' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

global $jr_ps_plugin_data;
$jr_ps_plugin_data = get_plugin_data( __FILE__ );
$jr_ps_plugin_data['slug'] = basename( dirname( __FILE__ ) );

/*	Detect initial activation or a change in plugin's Version number

	Sometimes special processing is required when the plugin is updated to a new version of the plugin.
	Also used in place of standard activation and new site creation exits provided by WordPress.
	Once that is complete, update the Version number in the plugin's Network-wide settings.
*/

if ( ( FALSE === ( $internal_settings = get_option( 'jr_ps_internal_settings' ) ) ) 
	|| empty( $internal_settings['version'] ) )
	{
	/*	Plugin is either:
		- updated from a version so old that Version was not yet stored in the plugin's settings, or
		- first use after install:
			- first time ever installed, or
			- installed previously and properly uninstalled (data deleted)
	*/

	$old_version = '0.1';
} else {
	$old_version = $internal_settings['version'];
}

if ( version_compare( $old_version, $jr_ps_plugin_data['Version'], '!=' ) ) {
	/*	Create, if internal settings do not exist; update if they do exist
	*/
	$internal_settings['version'] = $jr_ps_plugin_data['Version'];
	if ( version_compare( $old_version, '2', '<' ) ) {
		/*	Previous versions turned Privacy on at Activation;
			Now it is a Setting on the Settings page,
			so warn Admin.
		*/
		$internal_settings['warning_privacy'] = TRUE;
	}
	update_option( 'jr_ps_internal_settings', $internal_settings );
}

require_once( jr_ps_path() . 'includes/common-functions.php' );
jr_ps_init_settings( 'jr_ps_settings',
	array(
		'private_site'        => FALSE,
		'reveal_registration' => TRUE,
		'landing'             => 'return',
		'specific_url'        => '',
		'wplogin_php'         => FALSE,
		'custom_login'        => FALSE,
		'login_url'           => '',
		'custom_login_onsite' => TRUE,
		'excl_url'            => array(),
		'excl_url_prefix'     => array(),
		'excl_home'           => FALSE,
		'check_role'          => TRUE,
		'override_omit'       => FALSE
	),
	array( 'user_submenu' )
);
$settings = get_option( 'jr_ps_settings' );
if ( is_admin() ) {
	require_once( jr_ps_path() . 'includes/all-admin.php' );
	/* 	Support WordPress Version 3.0.x before is_network_admin() existed
	*/
	if ( function_exists( 'is_network_admin' ) && is_network_admin() ) {
		//	Network Admin pages in Network/Multisite install
		if ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( jr_ps_plugin_basename() ) ) {
			//	Network Admin Settings page for Plugin
			require_once( jr_ps_path() . 'includes/net-settings.php' );
		}
	} else {
		//	Regular (non-Network) Admin pages
		//	Settings page for Plugin
		require_once( jr_ps_path() . 'includes/admin-settings.php' );
	}
	//	All changes to all Admin-Installed Plugins pages
	require_once( jr_ps_path() . 'includes/installed-plugins.php' );
} else {
	/*	Public WordPress content, i.e. - not Admin pages
		Do nothing if Private Site setting not set by Administrator
	*/
	if ( $settings['private_site'] ) {
		//	Private Site code
		require_once( jr_ps_path() . 'includes/public.php' );
	}
}

/**
 * Check for missing Settings and set them to defaults
 * 
 * Ensures that the Named Setting exists, and populates it with defaults for any missing values.
 * Safe to use on every execution of a plugin because it only does an expensive Database Write
 * when it finds missing Settings.
 *
 * @param	string	$name		Name of Settings as looked up with get_option()
 * @param	array	$defaults	Each default Settings value in [key] => value format
 * @param	array	$deletes	Each old Settings value to delete as [0] => key format
 * @return  bool/Null			Return value from update_option(), or NULL if update_option() not called
 */
function jr_ps_init_settings( $name, $defaults, $deletes = array() ) {
	$updated = FALSE;
	if ( FALSE === ( $settings = get_option( $name ) ) ) {
		$settings = $defaults;
		$updated = TRUE;
	} else {
		foreach ( $defaults as $key => $value ) {
			if ( !isset( $settings[$key] ) ) {
				$settings[$key] = $value;
				$updated = TRUE;
			}
		}
		foreach ( $deletes as $key ) {
			if ( isset( $settings[$key] ) ) {
				/*	Don't need to check to UNSET,
					but do need to know to set $updated
				*/
				unset( $settings[$key] );
				$updated = TRUE;
			}
		}
	}
	if ( $updated ) {
		$return = update_option( $name, $settings );
	} else {
		$return = NULL;
	}
	return $return;
}

/*	Documentation of Research Done for this Plugin:
	Registration URL (based on a root install in http://localhost):
	WordPress 3.6.1 without jonradio Private Site installed
	Single Site - not a network
		http://localhost/wp-login.php?action=register
	Primary Site of a Network
		http://localhost/wp-signup.php
	Secondary Site of a Network
		http://localhost/wp-signup.php
	This last URL needs a lot of thought because it means that what begins on one site ends up on another.

	WordPress 3.7-beta without jonradio Private Site installed
	Single Site - not a network
		http://localhost/wp-login.php?action=register
	Primary Site of a Network
		http://localhost/wp-signup.php
	Secondary Site of a Network
		http://localhost/wp-signup.php
	
	WordPress 3.0.0 without jonradio Private Site installed
	Single Site - not a network
		http://localhost/wp-login.php?action=register
	Primary Site of a Network
		http://localhost/wp-signup.php
	Secondary Site of a Network
		http://localhost/wp-signup.php
	
	wp_registration_url() was not available prior to WordPress Version 3.6.0
	
	Self-Registration allows potential Users to Register their own ID and Password without Administrator intervention or knowledge.
	It is controlled by:
		get_option( 'users_can_register' ) - non-Network
			'1' - allows Self-Registration
			'0' - no Self-Registration
		get_site_option( 'registration' ) - Network (Multisite)
			'user' - allows Self-Registration
			'none' - no Self-Registration
			'blog' - Users can create new Sites in a Network
			'all' - allows Self-Registration and the creation of new Sites in a Network
*/

?>