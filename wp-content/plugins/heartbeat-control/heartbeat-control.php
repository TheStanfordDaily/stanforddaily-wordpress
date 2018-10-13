<?php
/**
 * Plugin Name: Heartbeat Control
 * Plugin URI: https://jeffmatson.net/heartbeat-control
 * Description: Completely controls the WordPress heartbeat.
 * Version: 1.2.5
 * Author: Jeff Matson
 * Author URI: http://jeffmatson.net
 * License: GPL2
 * Text Domain: heartbeat-control
 * Domain Path: /languages
 *
 * @package Heartbeat_Control
 */

namespace Heartbeat_Control;

/**
 * The primary Heartbeat Control class.
 */
class Heartbeat_Control {

	/**
	 * The current version.
	 *
	 * @var string
	 */
	public $version = '1.2.5';

	/**
	 * Heartbeat_Control Constructor.
	 */
	public function __construct() {
		$this->maybe_upgrade();
		$this->register_dependencies();
		add_action( 'wp_ajax_dismiss_heartbeat_control_update_notice', array( $this, 'dismiss_update_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'maybe_enqueue_scripts' ) );

		new Heartbeat();
	}

	/**
	 * Enqueue additional scrips if needed.
	 *
	 * @return void
	 */
	public function maybe_enqueue_scripts() {
		if ( get_option( 'heartbeat_control_update_notice' ) ) {
			wp_enqueue_script( 'heartbeat-control-notices', plugins_url( '/assets/js/bundle.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_localize_script( 'heartbeat-control-notices', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		}
	}

	/**
	 * Register additional plugin dependencies.
	 *
	 * @return void
	 */
	public function register_dependencies() {
		// Main plugin autoloader.
		require_once dirname( __FILE__ ) . '/autoloader.php';

		// Initialize CMB2 for settings pages.
		require_once dirname( __FILE__ ) . '/vendor/webdevstudios/cmb2/init.php';
		add_action( 'cmb2_admin_init', array( new Settings(), 'init_metaboxes' ) );
	}

	/**
	 * Check the version and update as needed.
	 *
	 * @return void
	 */
	public function maybe_upgrade() {
		if ( ! apply_filters( 'hbc_disable_notice', false ) ) {
			add_action( 'admin_notices', array( $this, 'heartbeat_control_updated' ) );
		}

		$db_version = get_option( 'heartbeat_control_version', '1.0' );
		if ( version_compare( $db_version, $this->version, '<' ) ) {
			$this->upgrade_db( $db_version );
		}
	}

	/**
	 * Upgrades the database from older versions.
	 *
	 * @param string $version The current DB version.
	 * @return void
	 */
	public function upgrade_db( $version ) {
		if ( version_compare( $version, '1.1', '<' ) ) {

			$updated_options = array();

			if ( $old_location === get_option( 'heartbeat_location' ) ) {
				if ( $old_location === 'disable-heartbeat-everywhere' ) {
					$updated_options['heartbeat_control_behavior'] = 'disable';
					$updated_options['heartbeat_control_location'] = array( 'frontend', 'admin', '/wp-admin/post.php' );
				} elseif ( $old_location === 'disable-heartbeat-dashboard' ) {
					$updated_options['heartbeat_control_behavior'] = 'disable';
					$updated_options['heartbeat_control_location'] = array( 'admin' );
				} elseif ( $old_location === 'allow-heartbeat-post-edit' ) {
					$updated_options['heartbeat_control_behavior'] = 'allow';
					$updated_options['heartbeat_control_location'] = array( '/wp-admin/post.php' );
				} else {
					if ( $old_frequency === get_option( 'heartbeat_frequency' ) ) {
						$updated_options['heartbeat_control_behavior']  = 'modify';
						$updated_options['heartbeat_control_location']  = array( 'frontend', 'admin', '/wp-admin/post.php' );
						$updated_options['heartbeat_control_frequency'] = $old_frequency;
					}
				}
			}

			update_option( 'heartbeat_control_settings', $updated_options );
		}

		if ( version_compare( $version, '1.2', '<' ) && ! array_key_exists( 'rules', get_option( 'heartbeat_control_settings' ) ) ) {
			$original_settings = get_option( 'heartbeat_control_settings' );
			update_option( 'heartbeat_control_settings', array( 'rules' => array( $original_settings ) ) );
		}

		update_option( 'heartbeat_control_version', $this->version );
		update_option( 'heartbeat_control_update_notice', true );
	}

	/**
	 * Displays the update notice.
	 *
	 * @return void
	 */
	public function heartbeat_control_updated() {
		if ( get_option( 'heartbeat_control_update_notice' ) ) {
			?>
			<div id="heartbeat_control_update_notice" class="notice notice-success is-dismissible">
				<p><?php esc_html_e( 'Heartbeat Control has updated to a new version!', 'heartbeat-control' ); ?></p>
				<p><?php esc_html_e( 'Love it? Does it save you money and valuable server resources? Consider <a href="https://paypal.me/JeffMatson">sending me a donation</a>. The plugin is entirely developed in my spare time and every little bit helps to motivate me to add more features and bug fixes.', 'heartbeat-control' ); ?></p>
			</div>
			<?php
		}
	}

	/**
	 * Dismisses the update notice.
	 *
	 * @return void
	 */
	public function dismiss_update_notice() {
		delete_option( 'heartbeat_control_update_notice' );
	}

}

new Heartbeat_Control();
