<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Multilang;

/**
 * Integration with WPML
 */
Class WPML
{
    /**
     * @var WPML
     */
    private static $instance;

    /**
     * @return WPML
     */
    public static function getInstance()
    {
        if ( null === static::$instance ) 
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        if ( defined('ICL_SITEPRESS_VERSION') )
        {
            add_action( 'admin_init',           array( $this, 'option_string_translation' ) );
            add_action( 'admin_init',           array( $this, 'mod_string_translation' ) );

            add_filter( 'vp_option_key',        array( $this, 'option_key' ) );
            add_filter( 'vp_get_option_key',    array( $this, 'get_option_key' ) );
        }
    }

    public function option_key( $key )
    {
        if ( defined('ICL_LANGUAGE_CODE') )
        {
            $current_language = ICL_LANGUAGE_CODE;

            if ( empty( $current_language ) )
            {
                global $sitepress;
                $current_language = $sitepress->get_default_language();
            }

            return $key . '_' . $current_language;
        }

        return $key;
    }
    
    public function get_option_key( $keys )
    {
        if ( defined('ICL_LANGUAGE_CODE') )
        {
            $keys[0] = $this->option_key($keys[0]);
        }

        return $keys;
    }

    public function option_string_translation()
    {
        if ( function_exists('icl_register_string') )
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

            foreach( $buttons as $button )
            {
                if ( !empty( $button['social_text'] ) )
                {
                    icl_register_string( 'jnews', $button['social_text'], $button['social_text']);
                }
            }
        }
    }

    public function mod_string_translation()
    {
        if ( function_exists('icl_register_string') )
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
                icl_register_string( 'jnews', $string['value'], $string['value'] );
            }
        }
    }
}