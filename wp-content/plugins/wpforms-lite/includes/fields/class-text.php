<?php

/**
 * Single line text field.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Field_Text extends WPForms_Field {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// Define field type information.
		$this->name  = esc_html__( 'Single Line Text', 'wpforms-lite' );
		$this->type  = 'text';
		$this->icon  = 'fa-text-width';
		$this->order = 30;

		// Define additional field properties.
		add_filter( 'wpforms_field_properties_text', array( $this, 'field_properties' ), 5, 3 );
	}

	/**
	 * Convert mask formatted for jquery.inputmask into  the format used by amp-inputmask.
	 *
	 * Note that amp-inputmask does not yet support all of the options that jquery.inputmask provides.
	 * In particular, amp-inputmask doesn't provides:
	 *  - Upper-alphabetical mask.
	 *  - Upper-alphanumeric mask.
	 *  - Advanced Input Masks with arbitrary repeating groups.
	 *
	 * @link https://amp.dev/documentation/components/amp-inputmask
	 * @link https://wpforms.com/docs/how-to-use-custom-input-masks/
	 *
	 * @param string $mask Mask formatted for jquery.inputmask.
	 * @return array {
	 *     Mask and placeholder.
	 *
	 *     @type string $mask        Mask for amp-inputmask.
	 *     @type string $placeholder Placeholder derived from mask if one is not supplied.
	 * }
	 */
	protected function convert_mask_to_amp_inputmask( $mask ) {
		$placeholder = '';

		// Convert jquery.inputmask format into amp-inputmask format.
		$amp_mask            = '';
		$req_mask_mapping    = array(
			'9' => '0', // Numeric.
			'a' => 'L', // Alphabetical (a-z or A-Z).
			'A' => 'L', // Upper-alphabetical (A-Z). Note: AMP does not have an uppercase-alphabetical mask type, so same as previous.
			'*' => 'A', // Alphanumeric (0-9, a-z, A-Z).
			'&' => 'A', // Upper-alphanumeric (A-Z, 0-9). Note: AMP does not have an uppercase-alphanumeric mask type, so same as previous.
			' ' => '_', // Automatically insert spaces.
		);
		$opt_mask_mapping    = array(
			'9' => '9', // The user may optionally add a numeric character.
			'a' => 'l', // The user may optionally add an alphabetical character.
			'A' => 'l', // The user may optionally add an alphabetical character.
			'*' => 'a', // The user may optionally add an alphanumeric character.
			'&' => 'a', // The user may optionally add an alphanumeric character.
		);
		$placeholder_mapping = array(
			'9' => '0',
			'a' => 'a',
			'A' => 'a',
			'*' => '_',
			'&' => '_',
		);
		$is_inside_optional  = false;
		$last_mask_token     = null;
		for ( $i = 0, $len = strlen( $mask ); $i < $len; $i++ ) {
			if ( '[' === $mask[ $i ] ) {
				$is_inside_optional = true;
				$placeholder       .= $mask[ $i ];
				continue;
			} elseif ( ']' === $mask[ $i ] ) {
				$is_inside_optional = false;
				$placeholder       .= $mask[ $i ];
				continue;
			} elseif ( isset( $last_mask_token ) && preg_match( '/^\{(?P<n>\d+)(?:,(?P<m>\d+))?\}/', substr( $mask, $i ), $matches ) ) {
				$amp_mask    .= str_repeat( $req_mask_mapping[ $last_mask_token ], $matches['n'] );
				$placeholder .= str_repeat( $placeholder_mapping[ $last_mask_token ], $matches['n'] );
				if ( isset( $matches['m'] ) ) {
					$amp_mask    .= str_repeat( $opt_mask_mapping[ $last_mask_token ], $matches['m'] );
					$placeholder .= str_repeat( $placeholder_mapping[ $last_mask_token ], $matches['m'] );
				}
				$i += strlen( $matches[0] ) - 1;

				$last_mask_token = null; // Reset.
				continue;
			}

			if ( '\\' === $mask[ $i ] ) {
				$amp_mask .= '\\';
				$i++;
				if ( ! isset( $mask[ $i ] ) ) {
					continue;
				}
				$amp_mask .= $mask[ $i ];
			} else {
				// Remember this token in case it is a mask.
				if ( isset( $opt_mask_mapping[ $mask[ $i ] ] ) ) {
					$last_mask_token = $mask[ $i ];
				}

				if ( $is_inside_optional && isset( $opt_mask_mapping[ $mask[ $i ] ] ) ) {
					$amp_mask .= $opt_mask_mapping[ $mask[ $i ] ];
				} elseif ( isset( $req_mask_mapping[ $mask[ $i ] ] ) ) {
					$amp_mask .= $req_mask_mapping[ $mask[ $i ] ];
				} else {
					$amp_mask .= '\\' . $mask[ $i ];
				}
			}

			if ( isset( $placeholder_mapping[ $mask[ $i ] ] ) ) {
				$placeholder .= $placeholder_mapping[ $mask[ $i ] ];
			} else {
				$placeholder .= $mask[ $i ];
			}
		}
		return array( $amp_mask, $placeholder );
	}

	/**
	 * Define additional field properties.
	 *
	 * @since 1.4.5
	 *
	 * @param array $properties Field properties.
	 * @param array $field      Field settings.
	 * @param array $form_data  Form data and settings.
	 *
	 * @return array
	 */
	public function field_properties( $properties, $field, $form_data ) {

		// Input primary: Detect custom input mask.
		if ( ! empty( $field['input_mask'] ) ) {

			// Add class that will trigger custom mask.
			$properties['inputs']['primary']['class'][] = 'wpforms-masked-input';

			if ( wpforms_is_amp() ) {
				list( $amp_mask, $placeholder ) = $this->convert_mask_to_amp_inputmask( $field['input_mask'] );

				$properties['inputs']['primary']['attr']['mask'] = $amp_mask;
				if ( empty( $properties['inputs']['primary']['attr']['placeholder'] ) ) {
					$properties['inputs']['primary']['attr']['placeholder'] = $placeholder;
				}
			} elseif ( false !== strpos( $field['input_mask'], 'alias:' ) ) {
				$mask = str_replace( 'alias:', '', $field['input_mask'] );
				$properties['inputs']['primary']['data']['inputmask-alias'] = $mask;
			} elseif ( false !== strpos( $field['input_mask'], 'regex:' ) ) {
				$mask = str_replace( 'regex:', '', $field['input_mask'] );
				$properties['inputs']['primary']['data']['inputmask-regex'] = $mask;
			} elseif ( false !== strpos( $field['input_mask'], 'date:' ) ) {
				$mask = str_replace( 'date:', '', $field['input_mask'] );
				$properties['inputs']['primary']['data']['inputmask-alias']       = 'datetime';
				$properties['inputs']['primary']['data']['inputmask-inputformat'] = $mask;

			} else {
				$properties['inputs']['primary']['data']['inputmask-mask'] = $field['input_mask'];
			}
		}

		return $properties;
	}

	/**
	 * Field options panel inside the builder.
	 *
	 * @since 1.0.0
	 *
	 * @param array $field Field settings.
	 */
	public function field_options( $field ) {
		/*
		 * Basic field options.
		 */

		// Options open markup.
		$this->field_option(
			'basic-options',
			$field,
			array(
				'markup' => 'open',
			)
		);

		// Label.
		$this->field_option( 'label', $field );

		// Description.
		$this->field_option( 'description', $field );

		// Required toggle.
		$this->field_option( 'required', $field );

		// Options close markup.
		$this->field_option(
			'basic-options',
			$field,
			array(
				'markup' => 'close',
			)
		);

		/*
		 * Advanced field options.
		 */

		// Options open markup.
		$this->field_option(
			'advanced-options',
			$field,
			array(
				'markup' => 'open',
			)
		);

		// Size.
		$this->field_option( 'size', $field );

		// Placeholder.
		$this->field_option( 'placeholder', $field );

		// Hide label.
		$this->field_option( 'label_hide', $field );

		// Default value.
		$this->field_option( 'default_value', $field );

		// Custom CSS classes.
		$this->field_option( 'css', $field );

		// Input Mask.
		$lbl = $this->field_element(
			'label',
			$field,
			array(
				'slug'          => 'input_mask',
				'value'         => esc_html__( 'Input Mask', 'wpforms-lite' ),
				'tooltip'       => esc_html__( 'Enter your custom input mask.', 'wpforms-lite' ),
				'after_tooltip' => '<a href="https://wpforms.com/how-to-use-custom-input-masks/" class="after-label-description" target="_blank" rel="noopener noreferrer">' . esc_html__( 'See Examples & Docs', 'wpforms-lite' ) . '</a>',
			),
			false
		);
		$fld = $this->field_element(
			'text',
			$field,
			array(
				'slug'  => 'input_mask',
				'value' => ! empty( $field['input_mask'] ) ? esc_attr( $field['input_mask'] ) : '',
			),
			false
		);
		$this->field_element(
			'row',
			$field,
			array(
				'slug'    => 'input_mask',
				'content' => $lbl . $fld,
			)
		);

		// Options close markup.
		$this->field_option(
			'advanced-options',
			$field,
			array(
				'markup' => 'close',
			)
		);
	}

	/**
	 * Field preview inside the builder.
	 *
	 * @since 1.0.0
	 *
	 * @param array $field Field settings.
	 */
	public function field_preview( $field ) {

		// Define data.
		$placeholder = ! empty( $field['placeholder'] ) ? esc_attr( $field['placeholder'] ) : '';

		// Label.
		$this->field_preview_option( 'label', $field );

		// Primary input.
		echo '<input type="text" placeholder="' . esc_attr( $placeholder ) . '" class="primary-input" disabled>';

		// Description.
		$this->field_preview_option( 'description', $field );
	}

	/**
	 * Field display on the form front-end.
	 *
	 * @since 1.0.0
	 *
	 * @param array $field      Field settings.
	 * @param array $deprecated Deprecated.
	 * @param array $form_data  Form data and settings.
	 */
	public function field_display( $field, $deprecated, $form_data ) {

		// Define data.
		$primary = $field['properties']['inputs']['primary'];

		// Primary field.
		printf(
			'<input type="text" %s %s>',
			wpforms_html_attributes( $primary['id'], $primary['class'], $primary['data'], $primary['attr'] ),
			$primary['required']
		); // WPCS: XSS ok.
	}
}

new WPForms_Field_Text();
