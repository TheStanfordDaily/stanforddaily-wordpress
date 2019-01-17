<?php
/**
 * Customizer Setting: Spacing Setting
 *
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license     https://opensource.org/licenses/MIT
 * @author      Aristath
 * @author      Jegtheme
 */
namespace Jeg\Customizer\Setting;

/**
 * Repeater Settings.
 */
class SpacingSetting extends DefaultSetting {

    /**
     * Constructor.
     *
     * Any supplied $args override class property defaults.
     *
     * @access public
     * @param \WP_Customize_Manager $manager The WordPress WP_Customize_Manager object.
     * @param string               $id       A specific ID of the setting. Can be a theme mod or option name.
     * @param array                $args     Setting arguments.
     */
    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );

        // Will onvert the setting from JSON to array. Must be triggered very soon.
        add_filter( "customize_sanitize_{$this->id}", array( $this, 'sanitize_spacing_setting' ), 10, 1 );
    }

    /**
     * Fetch the value of the setting.
     *
     * @access public
     * @return mixed The value.
     */
    public function value() {
        $value = parent::value();
        $value = $this->sanitize_spacing_setting($value);

        if ( ! is_array( $value ) ) {
            $value = array();
        }

        return $value;
    }

    /**
     * Convert the JSON encoded setting coming from Customizer to an Array.
     *
     * @access public
     * @param string $value URL Encoded JSON Value.
     * @return array
     */
    public function sanitize_spacing_setting( $value )
    {
        if ( ! is_array( $value ) ) {
            $value = json_decode( $value, true );
        }

        return $value;
    }
}
