<?php
/*
Plugin Name: Pico
Plugin URI: https://github.com/PicoNetworks/wordpress-plugin
Description: The publisher toolkit for direct reader revenue
Version: 0.3.9
Author: Pico
Author URI: https://www.pico.tools
Network: false
*/

define( 'PICO_VERSION', '0.3.9' );
define( 'PICO__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PICO__MINIMUM_WP_VERSION', '3.7' );

register_activation_hook( __FILE__, array( 'Pico_Setup', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Pico_Setup', 'plugin_deactivation' ) );
register_uninstall_hook( __FILE__, array( 'Pico_Setup', 'plugin_uninstall' ) );

require_once( PICO__PLUGIN_DIR . 'includes/class.pico.php' );
require_once( PICO__PLUGIN_DIR . 'includes/class.setup.php' );
require_once( PICO__PLUGIN_DIR . 'includes/class.widget.php' );
require_once( PICO__PLUGIN_DIR . 'includes/class.api.php' );
require_once( PICO__PLUGIN_DIR . 'includes/utils.php' );
require_once( PICO__PLUGIN_DIR . 'includes/htmlawed.php' );
require_once( PICO__PLUGIN_DIR . 'includes/vendor/plugin-update-checker-4.4/plugin-update-checker.php');


$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/PicoNetworks/wordpress-plugin',
    __FILE__
);

if ($branchName = defined('PP_BRANCH_NAME')) {
    # Used for Local and Staging testing. By default the plugin will pull data from the latest GitHub release
    $updateChecker->setBranch(PP_BRANCH_NAME);
}

add_action( 'init', array( 'Pico_Widget', 'init' ) );

if ( is_admin() ) {
    require_once( PICO__PLUGIN_DIR . 'includes/class.menu.php' );
	add_action( 'init', array( 'Pico_Menu', 'init' ) );
}
