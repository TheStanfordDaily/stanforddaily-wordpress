<?php
/*
	Plugin Name: JNews - Breadcrumb
	Plugin URI: http://jegtheme.com/
	Description: Breadcrumb Plugin for JNews Themes
	Version: 2.0.0
	Author: Jegtheme
	Author URI: http://jegtheme.com
	License: GPL2
*/

defined( 'JNEWS_BREADCRUMB' ) 		        or define( 'JNEWS_BREADCRUMB', 'jnews-breadcrumb');
defined( 'JNEWS_BREADCRUMB_URL' ) 		    or define( 'JNEWS_BREADCRUMB_URL', plugins_url(JNEWS_BREADCRUMB));
defined( 'JNEWS_BREADCRUMB_FILE' ) 		    or define( 'JNEWS_BREADCRUMB_FILE',  __FILE__ );
defined( 'JNEWS_BREADCRUMB_DIR' ) 		    or define( 'JNEWS_BREADCRUMB_DIR', plugin_dir_path( __FILE__ ) );

require 'class.jnews-breadcrumb.php';

/**
 * Get jnews option
 *
 * @param $setting
 * @param $default
 * @return mixed
 */
if(!function_exists('jnews_get_option'))
{
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

/**
 * Render Breadcurmb
 */
add_filter('jnews_breadcrumb', 'jnews_breadcrumb_call');

if(!function_exists('jnews_breadcrumb_call'))
{
    function jnews_breadcrumb_call()
    {
        $instance = JNews_Breadcrumb::getInstance();
        return $instance->call_breadcrumb();
    }
}

/**
 * Breadcrumb Schema
 */

add_filter('jnews_breadcrumb_schema', 'jnews_breadcrumb_schema');

if(!function_exists('jnews_breadcrumb_schema'))
{
    function jnews_breadcrumb_schema()
    {
        $instance = JNews_Breadcrumb::getInstance();
        return $instance->breadcrumb_schema();
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

function jnews_breadcrumb_load_textdomain()
{
    load_plugin_textdomain( JNEWS_BREADCRUMB, false, basename(__DIR__) . '/languages/' );
}

jnews_breadcrumb_load_textdomain();