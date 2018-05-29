<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Helper;

/**
 * Class JNews Helper Style
 */
Class StyleHelper
{
    /**
     * @var StyleHelper
     */
    private static $instance;

    /**
     * @return StyleHelper
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        add_filter( 'body_class', array($this, 'body_class'));
    }

    public function body_class($classes)
    {
        $classes[] = 'jnews';

        if(get_theme_mod('jnews_boxed_layout', false)) {
            $classes[] = 'jeg_boxed';
        }

        if(get_theme_mod('jnews_sidefeed_enable', false)) {
            $classes[] = 'jeg_sidecontent';
        }

        if(get_theme_mod('jnews_sidefeed_enable', false)) {
            $classes[] = 'jeg_sidecontent_' . get_theme_mod('jnews_sidefeed_main_position', 'center');
        }

        $classes[] = "jsc_" . get_theme_mod('jnews_scheme_color', 'normal');

        return $classes;
    }


    /** menu class */

    public static function header_bottombar_class()
    {
        $classes = array();
        $classes[] = 'jeg_navbar_wrapper';

        $classes[] = get_theme_mod('jnews_header_bottombar_boxed', 'jeg_navbar_normal');


        if(get_theme_mod('jnews_header_bottombar_boxed', false)){
            $classes[] = 'jeg_navbar_boxed';
        }

        if(get_theme_mod('jnews_header_bottombar_shadow', false)) {
            $classes[] = 'jeg_navbar_shadow';
        }

        if(get_theme_mod('jnews_header_bottombar_fitwidth', false)) {
            $classes[] = 'jeg_navbar_fitwidth';
        }

        if(get_theme_mod('jnews_header_bottombar_border', false)) {
            $classes[] = 'jeg_navbar_menuborder';
        }

        $classes[] = get_theme_mod('jnews_header_bottombar_scheme', 'jeg_navbar_normal');

        echo esc_attr(implode(' ', $classes));
    }


    public static function header_stickybar_class()
    {
        $classes = array();
        $classes[] = 'jeg_navbar_wrapper';

        $classes[] = get_theme_mod('jnews_header_stickybar_boxed', 'jeg_navbar_normal');


        if(get_theme_mod('jnews_header_stickybar_boxed', false)){
            $classes[] = 'jeg_navbar_boxed';
        }

        if(get_theme_mod('jnews_header_stickybar_shadow', false)) {
            $classes[] = 'jeg_navbar_shadow';
        }

        if(get_theme_mod('jnews_header_stickybar_fitwidth', false)) {
            $classes[] = 'jeg_navbar_fitwidth';
        }

        if(get_theme_mod('jnews_header_stickybar_border', false)) {
            $classes[] = 'jeg_navbar_menuborder';
        }

        $classes[] = get_theme_mod('jnews_header_stickybar_scheme', 'jeg_navbar_normal');

        echo esc_attr(implode(' ', $classes));
    }
}