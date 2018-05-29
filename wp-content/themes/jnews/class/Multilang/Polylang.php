<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Multilang;

/**
 * Integration with polylang
 */
Class Polylang
{
    /**
     * @var Polylang
     */
    private static $instance;

    /**
     * @return Polylang
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        if(class_exists('Polylang'))
        {
            add_action( 'admin_init', array($this, 'widget_string_translation'));
            add_action( 'admin_init', array($this, 'option_string_translation'));
            add_action( 'admin_init', array($this, 'mod_string_translation'));

            add_filter('vp_option_key', array($this, 'option_key'));
            add_filter('vp_get_option_key', array($this, 'get_option_key'));
        }
    }

    /**
     * Option Key
     */
    function option_key($key)
    {
        if(function_exists('pll_current_language'))
        {
            $current_language = pll_current_language();

            if(empty($current_language))
            {
                $current_language = pll_default_language();
            }

            return $key . '_' . $current_language;
        }

        return $key;
    }
    
    function get_option_key($keys)
    {
        if(function_exists('pll_current_language'))
        {
            $keys[0] = $this->option_key($keys[0]);
        }

        return $keys;
    }

    public function option_string_translation()
    {
        if(function_exists('pll_register_string'))
        {
            $buttons = jnews_get_option('single_social_share_main', array(
                array(
                    'social_share'  => 'facebook',
                    'social_text'   => esc_html__('Share on Facebook', 'jnews')
                ),
                array(
                    'social_share'   => 'twitter',
                    'social_text'    => esc_html__('Share on Twitter', 'jnews')
                ),
                array(
                    'social_share'   => 'googleplus',
                    'social_text'    => ''
                ),
            ));

            foreach($buttons as $button)
            {
                if(!empty($button['social_text']))
                {
                    pll_register_string( 'Social Text', $button['social_text'], 'Customizer');
                }
            }
        }
    }

    public function mod_string_translation()
    {
        if(function_exists('pll_register_string'))
        {
            $strings = array(
                'footer_copyright' => array(
                    'label' => 'Copyright',
                    'value' => wp_kses( get_theme_mod( 'jnews_footer_copyright', jnews_get_footer_copyright_text() ), wp_kses_allowed_html() ),
                    'group' => 'Customizer',
                ),
                'footer_menu_title' => array(
                    'label' => 'Footer Menu Title',
                    'value' => wp_kses( get_theme_mod( 'jnews_footer_menu_title', 'Navigate Site' ), wp_kses_allowed_html() ),
                    'group' => 'Customizer',
                ),
                'footer_social_title' => array(
                    'label' => 'Footer Social Title',
                    'value' => wp_kses( get_theme_mod( 'jnews_footer_social_title', 'Follow Us' ), wp_kses_allowed_html() ),
                    'group' => 'Customizer',
                )
            );

            foreach ($strings as $string) 
            {
                pll_register_string( $string['label'], $string['value'], $string['group'], false);
            }
        }
    }

    public function widget_string_translation()
    {
        if(function_exists('pll_register_string'))
        {
            global $wp_registered_widgets;
            $sidebars = wp_get_sidebars_widgets();
            foreach ( $sidebars as $sidebar => $widgets ) {
                if ( 'wp_inactive_widgets' == $sidebar || empty( $widgets ) ) {
                    continue;
                }

                foreach ( $widgets as $widget ) {
                    // nothing can be done if the widget is created using pre WP2.8 API :(
                    // there is no object, so we can't access it to get the widget options
                    if ( ! isset( $wp_registered_widgets[ $widget ]['callback'][0] ) || ! is_object( $wp_registered_widgets[ $widget ]['callback'][0] ) || ! method_exists( $wp_registered_widgets[ $widget ]['callback'][0], 'get_settings' ) ) {
                        continue;
                    }

                    $widget_settings = $wp_registered_widgets[ $widget ]['callback'][0]->get_settings();
                    $number = $wp_registered_widgets[ $widget ]['params'][0]['number'];

                    // don't enable widget translation if the widget is visible in only one language or if there is no title
                    if ( empty( $widget_settings[ $number ]['pll_lang'] ) ) {
                        if ( isset( $widget_settings[ $number ]['first_title'] ) && $first_title = $widget_settings[ $number ]['first_title'] ) {
                            pll_register_string( 'Widget First title', $first_title, 'Widget' );
                        }

                        if ( isset( $widget_settings[ $number ]['second_title'] ) && $second_title = $widget_settings[ $number ]['second_title'] ) {
                            pll_register_string( 'Widget Second title', $second_title, 'Widget' );
                        }

                        if ( isset( $widget_settings[ $number ]['header_filter_text'] ) && $header_filter_text = $widget_settings[ $number ]['header_filter_text'] ) {
                            pll_register_string( 'Widget Filter Text', $header_filter_text, 'Widget' );
                        }
                    }
                }
            }
        }
    }
}
