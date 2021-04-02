<?php
namespace Flytead;

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.flytedesk.com
 * @since      20181101
 *
 * @package    Flytedesk_Digital
 * @subpackage Flytedesk_Digital/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Flytedesk_Digital
 * @subpackage Flytedesk_Digital/public
 * @author     Flytedesk <help@flytedesk.com>
 */
class Flytedesk_Digital_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    20181101
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    20181101
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $uuid;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    20181101
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version     The version of this plugin.
	 * @param string      $uuid
	 */
	public function __construct( $plugin_name, $version, $uuid = '') {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->uuid = $uuid;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    20181101
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Flytedesk_Digital_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Flytedesk_Digital_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/flytedesk-digital-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    20181101
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Flytedesk_Digital_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Flytedesk_Digital_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/flytedesk-digital-public.js', array(), $this->version, false );
		$script_data = array(
				'uuid' => $this->uuid
		);
		wp_localize_script($this->plugin_name, 'flytedesk_digital_publisher', $script_data);
	}

}
