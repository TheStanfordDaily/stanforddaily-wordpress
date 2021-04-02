<?php

namespace Flytead;

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.flytedesk.com
 * @since      20181101
 *
 * @package    Flytedesk_Digital
 * @subpackage Flytedesk_Digital/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      20181101
 * @package    Flytedesk_Digital
 * @subpackage Flytedesk_Digital/includes
 * @author     Flytedesk <help@flytedesk.com>
 */
class Flytedesk_Digital {

	CONST VERSION = '20181101';
	CONST PLUGIN_NAME = 'flytedesk-digital';
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    20181101
	 * @access   protected
	 * @var      Flytedesk_Digital_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;


	protected $options = [
			'flytedesk-digital-option_publisher_uuid' => 'xxxxxxxx-xxxx-4xxx-xxxx-xxxxxxxxxxxx'
	];

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    20181101
	 */
	public function __construct() {
		$this->load_dependencies();
		$this->set_locale();
		$this->get_options();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_widget_hooks();
	}

	private function get_options() {
		foreach ($this->options as $option_name => $default_value) {
			$this->options[$option_name] = get_option($option_name, $default_value);
		}
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Flytedesk_Digital_Loader. Orchestrates the hooks of the plugin.
	 * - Flytedesk_Digital_i18n. Defines internationalization functionality.
	 * - Flytedesk_Digital_Admin. Defines all hooks for the admin area.
	 * - Flytedesk_Digital_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    20181101
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(__DIR__) . 'includes/class-flytedesk-digital-widget.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(__DIR__) . 'includes/class-flytedesk-digital-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(__DIR__) . 'includes/class-flytedesk-digital-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(__DIR__) . 'admin/class-flytedesk-digital-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(__DIR__) . 'public/class-flytedesk-digital-public.php';

		$this->loader = new Flytedesk_Digital_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Flytedesk_Digital_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    20181101
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Flytedesk_Digital_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    20181101
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Flytedesk_Digital_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action('admin_menu', $plugin_admin, 'create_settings_page');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    20181101
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Flytedesk_Digital_Public( $this->get_plugin_name(), $this->get_version(),  $this->options['flytedesk-digital-option_publisher_uuid']);

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the widgets
	 *
	 * @since    20181101
	 * @access   private
	 */
	private function define_widget_hooks() {
		$this->loader->register_widget('Flytead\Flytedesk_Digital_Widget');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    20181101
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     20181101
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return self::PLUGIN_NAME;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     20181101
	 * @return    Flytedesk_Digital_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     20181101
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return self::VERSION;
	}

	/**
	 * Uninstalls any options
	 *
	 * @since     20181101
	 * @return    string    The version number of the plugin.
	 */
	public function uninstall() {
		$option_names = array_keys($this->options);
		$option_count = count($option_names);
		for ($i=0; $i<$option_count; $i++) {
			delete_option($option_names[$i]);
		}
	}
}
