<?php

namespace Flytead;

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.flytedesk.com
 * @since      20181101
 *
 * @package    Flytedesk_Digital
 * @subpackage Flytedesk_Digital/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      20181101
 * @package    Flytedesk_Digital
 * @subpackage Flytedesk_Digital/includes
 * @author     Flytedesk <help@flytedesk.com>
 */
class Flytedesk_Digital_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    20181101
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'flytedesk-digital',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
