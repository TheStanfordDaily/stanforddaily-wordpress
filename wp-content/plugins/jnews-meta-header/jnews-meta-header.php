<?php
/*
	Plugin Name: JNews - Meta Header
	Plugin URI: http://jegtheme.com/
	Description: Plugin to customize Meta Header (Facebook share / Twitter Card)
	Version: 2.0.0
	Author: Jegtheme
	Author URI: http://jegtheme.com
	License: GPL2
*/

defined( 'JNEWS_META_HEADER' ) 		            or define( 'JNEWS_META_HEADER', 'jnews-meta-header');
defined( 'JNEWS_META_HEADER_VERSION' )          or define( 'JNEWS_META_HEADER_VERSION', '2.0.0' );
defined( 'JNEWS_META_HEADER_URL' ) 		        or define( 'JNEWS_META_HEADER_URL', plugins_url(JNEWS_META_HEADER));
defined( 'JNEWS_META_HEADER_FILE' ) 		    or define( 'JNEWS_META_HEADER_FILE',  __FILE__ );
defined( 'JNEWS_META_HEADER_DIR' ) 		        or define( 'JNEWS_META_HEADER_DIR', plugin_dir_path( __FILE__ ) );


add_action( 'init', function() { require 'fallback-function.php'; } );

/**
 * Social Meta Option
 */
add_action( 'jnews_register_customizer_option', 'jnews_social_meta_customizer_option');

if(!function_exists('jnews_social_meta_customizer_option'))
{
    function jnews_social_meta_customizer_option()
    {
        require_once 'class.jnews-meta-option.php';
        JNews_Social_Meta_Option::getInstance();
    }
}


add_filter('jeg_register_lazy_section', 'jnews_meta_header_lazy_section');

if(!function_exists('jnews_meta_header_lazy_section'))
{
    function jnews_meta_header_lazy_section($result)
    {
        $result['jnews_social_meta_section'][] = JNEWS_META_HEADER_DIR . "meta-header-option.php";
        return $result;
    }
}

/**
 * Initialize meta header instance
 */
if(!function_exists('jnews_meta_header_init'))
{
    function jnews_meta_header_init()
    {
        require_once 'class.jnews-meta-header.php';
        JNews_Meta_Header::getInstance();
    }
}

jnews_meta_header_init();

if(!function_exists('jnews_get_option'))
{
    /**
     * Get jnews option
     *
     * @param $setting
     * @param $default
     * @return mixed
     */
    function jnews_get_option($setting, $default = null)
    {
        $options = get_option( 'jnews_option', array() );
        $value = $default;
        if ( isset( $options[ $setting ] ) ) {
            $value = $options[ $setting ];
        }
        return $value;
    }
}

/** Print Translation */

if(!function_exists('jnews_print_translation'))
{
    function jnews_print_translation($string, $domain, $name)
    {
        do_action('jnews_print_translation', $string, $domain, $name);
    }
}


if(!function_exists('jnews_print_main_translation'))
{
    add_action('jnews_print_translation', 'jnews_print_main_translation', 10, 2);

    function jnews_print_main_translation($string, $domain)
    {
        call_user_func_array('esc_html_e', array($string, $domain));
    }
}

/** Return Translation */

if(!function_exists('jnews_return_translation'))
{
    function jnews_return_translation($string, $domain, $name, $escape = true)
    {
        return apply_filters('jnews_return_translation', $string, $domain, $name, $escape);
    }
}

if(!function_exists('jnews_return_main_translation'))
{
    add_filter('jnews_return_translation', 'jnews_return_main_translation', 10, 4);

    function jnews_return_main_translation($string, $domain, $name, $escape = true)
    {
        if($escape)
        {
            return call_user_func_array('esc_html__', array($string, $domain));
        } else {
            return call_user_func_array('__', array($string, $domain));
        }
    }
}

/**
 * Load Text Domain
 */

function jnews_meta_header_load_textdomain()
{
    load_plugin_textdomain( JNEWS_META_HEADER, false, basename(__DIR__) . '/languages/' );
}

jnews_meta_header_load_textdomain();