<?php
/**
 * Plugin Name:       Flytedesk Digital
 * Plugin URI:        https://www.flytedesk.com
 * Description:       This plugin allows Flytedesk publishers to easily insert digital ad units to be filled via the Flytedesk platform.  https://flytedesk.com
 * Version:           20181101
 * Author:            Flytedesk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       flytedesk-digital
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-flytedesk-digital.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-flytedesk-digital-activator.php
 */
function FLYTEAD_activate_flytedesk_digital() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-flytedesk-digital-activator.php';
	Flytead\Flytedesk_Digital_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-flytedesk-digital-deactivator.php
 */
function FLYTEAD_deactivate_flytedesk_digital() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-flytedesk-digital-deactivator.php';
	Flytead\Flytedesk_Digital_Deactivator::deactivate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-flytedesk-digital-deactivator.php
 */
function FLYTEAD_uninstall_flytedesk_digital() {
	$plugin = new Flytead\Flytedesk_Digital();
	$plugin->uninstall();
}


register_activation_hook(__FILE__, 'FLYTEAD_activate_flytedesk_digital');
register_deactivation_hook(__FILE__, 'FLYTEAD_deactivate_flytedesk_digital');
register_uninstall_hook(__FILE__, 'FLYTEAD_uninstall_flytedesk_digital');
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    20181101
 */
function FLYTEAD_run_flytedesk_digital() {

	$plugin = new Flytead\Flytedesk_Digital();
	$plugin->run();

}

FLYTEAD_run_flytedesk_digital();
