<?php
/**
 * Contains the Heartbeat_Control\Settings class.
 *
 * @package Heartbeat_Control
 */

namespace Heartbeat_Control;

/**
 * Primary settings page class.
 */
class Settings {

	/**
	 * Renders the slider field.
	 *
	 * @param [type] $field
	 * @param [type] $field_escaped_value
	 * @param [type] $field_object_id
	 * @param [type] $field_object_type
	 * @param [type] $field_type_object
	 *
	 * @return void
	 */
	public function render_slider_field( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
		echo '<div class="slider-field"></div>';
		// phpcs:ignore
		echo $field_type_object->input( array(
			'type'       => 'hidden',
			'class'      => 'slider-field-value',
			'readonly'   => 'readonly',
			'data-start' => absint( $field_escaped_value ),
			'data-min'   => intval( $field->min() ),
			'data-max'   => intval( $field->max() ),
			'data-step'  => intval( $field->step() ),
			'desc'       => '',
		) );
		echo '<span class="slider-field-value-display">' . esc_html( $field->value_label() ) . ' <span class="slider-field-value-text"></span></span>';
		$field_type_object->_desc( true, true );
	}

	/**
	 * Enqueue scripts on settings pages.
	 *
	 * @param string $hook The settings page slug.
	 *
	 * @return void
	 */
	public function enqueue_scripts( $hook ) {
		if ( $hook !== 'settings_page_heartbeat_control_settings' ) {
			return;
		}

		wp_enqueue_script( 'heartbeat-control-settings', plugins_url( '/assets/js/bundle.js', __FILE__ ), array( 'jquery', 'jquery-ui-slider' ), '1.0.0', true );
		wp_localize_script( 'heartbeat-control-settings', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		wp_register_style( 'slider_ui', '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css', array(), '1.0' );
		wp_enqueue_style( 'slider_ui' );
	}

	/**
	 * Initialize the meta boxes in CMB2.
	 *
	 * @return void
	 */
	public function init_metaboxes() {
		add_action( 'cmb2_render_slider', array( $this, 'render_slider_field' ), 10, 5 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		$prefix = 'heartbeat_control_';

		$cmb = new_cmb2_box( array(
			'id'           => 'heartbeat_control_settings',
			'title'        => __( 'Heartbeat Control Settings', 'heartbeat-control' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => 'heartbeat_control_settings',
			'capability'   => 'manage_options',
			'parent_slug'  => 'options-general.php',
		) );

		$rule_group = $cmb->add_field( array(
			'id'          => 'rules',
			'type'        => 'group',
			'description' => __( 'Set WordPress heartbeat rules. Duplicate locations are ordered based on priority (higher list position wins).', 'heartbeat-control' ),
			'options'     => array(
				'group_title'   => __( 'Rule {#}', 'heartbeat-control' ),
				'add_button'    => __( 'Add Another Rule', 'heartbeat-control' ),
				'remove_button' => __( 'Remove Rule', 'heartbeat-control' ),
				'sortable'      => true,
			),
		) );

		$cmb->add_group_field( $rule_group, array(
			'name'    => __( 'Heartbeat Behavior', 'heartbeat-control' ),
			'id'      => $prefix . 'behavior',
			'type'    => 'select',
			'default' => 'allow',
			'classes' => 'heartbeat_behavior',
			'options' => array(
				'allow'   => __( 'Allow Heartbeat', 'heartbeat-control' ),
				'disable' => __( 'Disable Heartbeat', 'heartbeat-control' ),
				'modify'  => __( 'Modify Heartbeat', 'heartbeat-control' ),
			),
		) );

		$cmb->add_group_field( $rule_group, array(
			'name'    => __( 'Locations', 'heartbeat-control' ),
			'id'      => $prefix . 'location',
			'type'    => 'multicheck',
			'options' => array(
				'admin'              => __( 'WordPress Dashboard', 'heartbeat-control' ),
				'frontend'           => __( 'Frontend', 'heartbeat-control' ),
				'/wp-admin/post.php' => __( 'Post Editor', 'heartbeat-control' ),
			),
		) );

		$cmb->add_group_field( $rule_group, array(
			'name'    => __( 'Frequency', 'heartbeat-control' ),
			'id'      => $prefix . 'frequency',
			'type'    => 'slider',
			'min'     => '15',
			'step'    => '1',
			'max'     => '300',
			'default' => '15',
			'classes' => 'heartbeat_frequency',
		) );
	}

}
