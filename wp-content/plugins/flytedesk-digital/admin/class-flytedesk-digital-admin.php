<?php

namespace Flytead;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.flytedesk.com
 * @since      20181101
 *
 * @package    Flytedesk_Digital
 * @subpackage Flytedesk_Digital/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Flytedesk_Digital
 * @subpackage Flytedesk_Digital/admin
 * @author     Flytedesk <help@flytedesk.com>
 */
class Flytedesk_Digital_Admin {

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

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    20181101
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/flytedesk-digital-admin.css', [], $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/flytedesk-digital-admin.js', [ 'jquery' ], $this->version, FALSE );

	}

	public function create_settings_page() {
		// Add the menu item and page
		$page_title = 'Flytedesk Digital Ads Settings';
		$menu_title = 'Flytedesk';
		$capability = 'manage_options';
		$slug       = 'flytedesk-digital-options';
		$callback   = [$this, 'settings_page_content'];

		add_options_page($page_title, $menu_title, $capability, $slug, $callback);
	}

	public function settings_page_content() {
		$display_form = TRUE;
		if (!current_user_can('manage_options')) {
			wp_die('Unauthorized user');
		}
		if (isset($_POST['flytedesk-digital-option_publisher_uuid'])) {
			update_option('flytedesk-digital-option_publisher_uuid', $_POST['flytedesk-digital-option_publisher_uuid']);
			$display_form = FALSE;
		}
		$value = get_option('flytedesk-digital-option_publisher_uuid', 'xxxxxxxx-xxxx-4xxx-xxxx-xxxxxxxxxxxx');
		?>
		<div class="flytedesk-wrap">
			<img src="<?php echo plugin_dir_url( __DIR__ )  . 'images/logo.png'?>" class= "flytedesk-logo">
			<h1>Flytedesk Digital Ads Settings</h1>
			<?php if ($display_form) { ?>
			<p>Please enter the publisher or property uuid for your website.  This is a 36 character string that will be provided to you by your Flytedesk contact and is available in your digital mediakit on the Flytedesk platform. </p>
			<form method="POST">
				<div class="flytedesk-settings">
          <input type="text" class="flytedesk-uuid-input" maxlength="36" minlength="36" name="flytedesk-digital-option_publisher_uuid" id="flytedesk-digital-option_publisher_uuid" value="<?php echo $value; ?>">
          <?php wp_nonce_field( 'flytedesk_option_page_action' ); ?>
          <input type="submit" value="Save" class="button button-primary button-large flytedesk-save">
				</div>
			</form>
			<?php } else {  ?>
			<p>Your uuid has been saved successfully.  Ads will automatically begin to appear wherever you have added Flytedesk Ad Unit widgets. </p>
			<?php } ?>
		</div> <?php
	}

}

