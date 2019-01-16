<?php
/**
 * Sanitize Customizer Input
 *
 * @author      Jegtheme
 * @license     https://opensource.org/licenses/MIT
 */
namespace Jeg\Util;

Class Sanitize
{
    /**
     * @var Sanitize
     */
    private static $instance;

    /**
     * @return Sanitize
     */
    public static function getInstance()
    {
        if ( null === static::$instance )
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * @param $value
     * @return string
     */
    public function sanitize_input( $value )
    {
        if(is_array($value)) {
            return $this->sanitize_array($value);
        } else {
            return sanitize_text_field( $value ) ;
        }
    }

    /**
     * @param $value
     * @return string
     */
    public function sanitize_url($value)
    {
        return esc_url_raw($value);
    }

    /**
     * Filters numeric values.
     *
     * @static
     * @access public
     * @param string $value The value to be sanitized.
     * @return int|float
     */
    public static function sanitize_number( $value ) {
        return filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
    }

    /**
     * Sanitize colors.
     *
     * @static
     * @since 0.8.5
     * @param string $value The value to be sanitized.
     * @return string
     */
    public function sanitize_color( $value ) {
        // If the value is empty, then return empty.
        if ( '' === $value ) {
            return '';
        }
        // If transparent, then return 'transparent'.
        if ( is_string( $value ) && 'transparent' === trim( $value ) ) {
            return 'transparent';
        }
        // Instantiate the object.
        $color = AriColor::newColor( $value );
        // Return a CSS value, using the auto-detected mode.
        return $color->toCSS( $color->mode );
    }

    /**
     * @param $value
     * @return array
     */
    public function sanitize_array($value)
    {
        $value = ( ! is_array( $value ) ) ? explode( ',', $value ) : $value;
        return ( ! empty( $value ) ) ? array_map( 'sanitize_text_field', $value ) : array();
    }
    /**
     * @param $value
     * @return bool
     */
    public function sanitize_checkbox($value)
    {
        if ( is_null( $value ) ) {
            return false;
        }

        if ( 1 === $value || '1' === $value || true === $value || 'true' === $value || 'on' === $value ||
            0 === $value || '0' === $value || false === $value || 'false' === $value || 'off' === $value ) {
            return $value;
        }

        return false;
    }

    /**
     * @param $value
     * @param $hash
     * @return null|string|void
     */
    public function sanitize_solid_color($value, $hash = true)
    {
        if($hash) {
            return sanitize_hex_color($value);
        } else {
            return sanitize_hex_color_no_hash($value);
        }
    }

    /**
     * Sanitizes typography controls
     *
     * @since 2.2.0
     * @param array $value The value.
     * @return array
     */
    public static function sanitize_typography( $value ) {


        if ( ! is_array( $value ) ) {
            return array();
        }

        // Escape the font-family.
        if ( isset( $value['font-family'] ) ) {
            $value['font-family'] = esc_attr( $value['font-family'] );
        }

        // Make sure we're using a valid variant.
        // We're adding checks for font-weight as well for backwards-compatibility
        // Versions 2.0 - 2.2 were using an integer font-weight.
        if ( isset( $value['variant'] ) ) {
            $valid_variants = Font::get_all_variants();
            $variants_ok = array();

            $value['variant'] = is_array($value['variant']) ? $value['variant'] : array($value['variant']);

            foreach($value['variant'] as $variant) {
                if ( array_key_exists( $variant, $valid_variants ) ) {
                    $variants_ok[] = $variant;
                }
            }

            $value['variant'] = $variants_ok;
        }

        // Make sure the saved value is "subsets" (plural) and not "subset".
        // This is for compatibility with older versions.
        if ( isset( $value['subset'] ) ) {
            if ( ! empty( $value['subset'] ) ) {
                if ( ! isset( $value['subsets'] ) || empty( $value['subset'] ) ) {
                    $value['subsets'] = $value['subset'];
                }
            }
            unset( $value['subset'] );
        }

        // Make sure we're using a valid subset.
        if ( isset( $value['subsets'] ) ) {
            $valid_subsets = Font::get_google_font_subsets();
            $subsets_ok = array();
            if ( is_array( $value['subsets'] ) ) {
                foreach ( $value['subsets'] as $subset ) {
                    if ( array_key_exists( $subset, $valid_subsets ) ) {
                        $subsets_ok[] = $subset;
                    }
                }
                $value['subsets'] = $subsets_ok;
            }
        }


        // Sanitize the font-size.
        if ( isset( $value['font-size'] ) && ! empty( $value['font-size'] ) ) {
            $value['font-size'] = self::css_dimension( $value['font-size'] );
            if ( is_numeric( $value['font-size'] ) ) {
                $value['font-size'] .= 'px';
            }
        }

        // Sanitize the line-height.
        if ( isset( $value['line-height'] ) && ! empty( $value['line-height'] ) ) {
            $value['line-height'] = self::css_dimension( $value['line-height'] );
        }

        // Sanitize the letter-spacing.
        if ( isset( $value['letter-spacing'] ) && ! empty( $value['letter-spacing'] ) ) {
            $value['letter-spacing'] = self::css_dimension( $value['letter-spacing'] );
            if ( is_numeric( $value['letter-spacing'] ) ) {
                $value['letter-spacing'] .= 'px';
            }
        }

        // Sanitize the text-align.
        if ( isset( $value['text-align'] ) && ! empty( $value['text-align'] ) ) {
            if ( ! in_array( $value['text-align'], array( 'inherit', 'left', 'center', 'right', 'justify' ) ) ) {
                $value['text-align'] = 'inherit';
            }
        }

        // Sanitize the text-transform.
        if ( isset( $value['text-transform'] ) && ! empty( $value['text-transform'] ) ) {
            if ( ! in_array( $value['text-transform'], array( 'none', 'capitalize', 'uppercase', 'lowercase', 'initial', 'inherit' ) ) ) {
                $value['text-transform'] = 'none';
            }
        }

        // Sanitize the color.
        if ( isset( $value['color'] ) && ! empty( $value['color'] ) ) {
            $color = AriColor::newColor( $value['color'] );
            $value['color'] = $color->toCSS( 'hex' );
        }

        return $value;
    }

    /**
     * Sanitizes css dimensions.
     *
     * @static
     * @access public
     * @since 2.2.0
     * @param string $value The value to be sanitized.
     * @return string
     */
    public static function css_dimension( $value ) {

        // Trim it.
        $value = trim( $value );

        // If the value is round, then return 50%.
        if ( 'round' === $value ) {
            $value = '50%';
        }

        // If the value is empty, return empty.
        if ( '' === $value ) {
            return '';
        }

        // If auto, return auto.
        if ( 'auto' === $value ) {
            return 'auto';
        }

        // Return empty if there are no numbers in the value.
        if ( ! preg_match( '#[0-9]#' , $value ) ) {
            return '';
        }

        // If we're using calc() then return the value.
        if ( false !== strpos( $value, 'calc(' ) ) {
            return $value;
        }

        // The raw value without the units.
        $raw_value = self::sanitize_number( $value );
        $unit_used = '';

        // An array of all valid CSS units. Their order was carefully chosen for this evaluation, don't mix it up!!!
        $units = array( 'rem', 'em', 'ex', '%', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ch', 'vh', 'vw', 'vmin', 'vmax' );
        foreach ( $units as $unit ) {
            if ( false !== strpos( $value, $unit ) ) {
                $unit_used = $unit;
            }
        }

        // Hack for rem values.
        if ( 'em' === $unit_used && false !== strpos( $value, 'rem' ) ) {
            $unit_used = 'rem';
        }

        return $raw_value . $unit_used;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function by_pass($value)
    {
        return $value;
    }

}