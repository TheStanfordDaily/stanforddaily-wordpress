<?php
/**
 * @author      Jegtheme
 * @license     https://opensource.org/licenses/MIT
 */
namespace Jeg\Customizer\Setting;

/**
 * Default Settings
 */
class DefaultSetting extends \WP_Customize_Setting {
    /**
     * setting(section)(id)
     * @var string pattern
     */
    public static $lazy_pattern =  '/^setting\((?P<section>[^\)]+)\)\((?P<id>[^\)]+)\)$/';

    /**
     * Pattern for javascript
     * @var string
     */
    public static $lazy_js_pattern = 'setting\(([^)]+)\)\(([^)]+)\)';

    /**
     * Create setting base on setting pattern
     *
     * @param $section
     * @param $id
     * @return string
     */
    public static function create_lazy_setting($section, $id)
    {
        return "setting({$section})({$id})";
    }

    /**
     * Constructor.
     *
     * Any supplied $args override class property defaults.
     *
     * @since 3.4.0
     *
     * @param \WP_Customize_Manager $manager
     * @param string               $id      An specific ID of the setting. Can be a
     *                                      theme mod or option name.
     * @param array                $args    Setting arguments.
     */
    public function __construct( $manager, $id, $args = array() ) {
        $keys = array_keys( get_object_vars( $this ) );
        foreach ( $keys as $key ) {
            if ( isset( $args[ $key ] ) ) {
                $this->$key = $args[ $key ];
            }
        }

        $this->manager = $manager;
        $this->id = $id;

        // Parse the ID for array keys.
        if(preg_match( self::$lazy_pattern, $this->id, $matches )) {
            $id = $matches['id'];
        }

        $this->id_data['keys'] = preg_split( '/\[/', str_replace( ']', '', $id ) );
        $this->id_data['base'] = array_shift( $this->id_data['keys'] );

        if ( $this->validate_callback ) {
            add_filter( "customize_validate_{$this->id}", $this->validate_callback, 10, 3 );
        }
        if ( $this->sanitize_callback ) {
            add_filter( "customize_sanitize_{$this->id}", $this->sanitize_callback, 10, 2 );
        }
        if ( $this->sanitize_js_callback ) {
            add_filter( "customize_sanitize_js_{$this->id}", $this->sanitize_js_callback, 10, 2 );
        }

        if ( 'option' === $this->type || 'theme_mod' === $this->type ) {
            // Other setting types can opt-in to aggregate multidimensional explicitly.
            $this->aggregate_multidimensional();

            // Allow option settings to indicate whether they should be autoloaded.
            if ( 'option' === $this->type && isset( $args['autoload'] ) ) {
                self::$aggregated_multidimensionals[ $this->type ][ $this->id_data['base'] ]['autoload'] = $args['autoload'];
            }
        }
    }
}
