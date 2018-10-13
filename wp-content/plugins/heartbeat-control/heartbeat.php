<?php
/**
 * Contains the Heartbeat_Control\Heartbeat class.
 *
 * @package Heartbeat_Control
 */

namespace Heartbeat_Control;

/**
 * Primary Hearbeat class.
 */
class Heartbeat {

	/**
	 * The current screen being accessed.
	 *
	 * @var string
	 */
	public $current_screen;

	/**
	 * The current query string being accessed.
	 *
	 * @var string
	 */
	public $current_query_string;

	/**
	 * Stores heartbeat settings across class methods.
	 *
	 * @var array
	 */
	public $settings = array();

	/**
	 * Just a regular ole constructor.
	 */
	public function __construct() {

		if ( ! empty( $_SERVER['QUERY_STRING'] ) ) {
			$current_url = $_SERVER['REQUEST_URI'] . '?' . $_SERVER['QUERY_STRING'];
		} else {
			$current_url = $_SERVER['REQUEST_URI'];
		}

		$this->current_screen = wp_parse_url( $current_url );

		if ( $this->current_screen === '/wp-admin/admin-ajax.php' ) {
			return;
		}

		$settings = get_option( 'heartbeat_control_settings' );

		if ( ( ! is_array( $settings['rules'] ) ) || ( empty( $settings['rules'] ) ) ) {
			return;
		}

		array_reverse( $settings['rules'] );
		$this->settings = $settings['rules'];

		add_action( 'admin_enqueue_scripts', array( $this, 'maybe_disable' ), 99 );
		add_action( 'wp_enqueue_scripts', array( $this, 'maybe_disable' ), 99 );
		add_filter( 'heartbeat_settings', array( $this, 'maybe_modify' ), 99, 1 );
	}

	/**
	 * Checks if the current location has a rule.
	 *
	 * @param array $locations Locations that have rules.
	 *
	 * @return bool
	 */
	public function check_location( $locations ) {
		if ( ! isset( $locations ) || ! is_array( $locations ) ) {
			return false;
		}

		if ( in_array( $this->current_screen['path'], $locations ) ) {
			return true;
		} elseif ( ( ! is_admin() ) && ( in_array( 'frontend', $locations ) ) ) {
			return true;
		} elseif ( ( is_admin() ) && ( in_array( 'admin', $locations ) ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Disable the heartbeat, if needed.
	 *
	 * @return void
	 */
	public function maybe_disable() {
		foreach ( $this->settings as $rule ) {
			if ( array_key_exists( 'heartbeat_control_behavior', $rule ) && $rule['heartbeat_control_behavior'] === 'disable' ) {

				if ( ! array_key_exists( 'heartbeat_control_location', $rule ) ) {
					return;
				}

				if ( $this->check_location( $rule['heartbeat_control_location'] ) ) {
					wp_deregister_script( 'heartbeat' );
					return;
				}
			}
		}

	}

	/**
	 * Modify the heartbeat, if needed.
	 *
	 * @param array $settings The settings.
	 *
	 * @return array
	 */
	public function maybe_modify( $settings ) {

		foreach ( $this->settings as $rule ) {
			if ( array_key_exists( 'heartbeat_control_behavior', $rule ) && $rule['heartbeat_control_behavior'] === 'modify' ) {

				if ( ! array_key_exists( 'heartbeat_control_location', $rule ) ) {
					return;
				}

				if ( $this->check_location( $rule['heartbeat_control_location'] ) ) {
					$settings['interval'] = intval( $rule['heartbeat_control_frequency'] );
					return $settings;
				}
			}
		}

		return $settings;
	}

}
