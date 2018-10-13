<?php
/*
	Plugin Name: JNews - Split
	Plugin URI: http://jegtheme.com/
	Description: Split post into several page
	Version: 2.0.0
	Author: Jegtheme
	Author URI: http://jegtheme.com
	License: GPL2
*/

defined( 'JNEWS_SPLIT' ) 		        or define( 'JNEWS_SPLIT', 'jnews-split');
defined( 'JNEWS_SPLIT_URL' ) 		    or define( 'JNEWS_SPLIT_URL', plugins_url(JNEWS_SPLIT));
defined( 'JNEWS_SPLIT_FILE' ) 		    or define( 'JNEWS_SPLIT_FILE',  __FILE__ );
defined( 'JNEWS_SPLIT_DIR' ) 		    or define( 'JNEWS_SPLIT_DIR', plugin_dir_path( __FILE__ ) );


add_action( 'init', function() { require 'fallback-function.php'; } );

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

/** Load Split Post Metabox */
add_action('after_setup_theme', 'jnews_split_metabox_load');

if(!function_exists('jnews_split_metabox_load'))
{
    function jnews_split_metabox_load()
    {
        if(class_exists('VP_Metabox'))
        {
            new VP_Metabox( JNEWS_SPLIT_DIR . 'metabox/post-split.php');
        }
    }
}

/**
 * Split Option
 */
add_filter('jeg_register_lazy_section', 'jnews_split_lazy_section');

if(!function_exists('jnews_split_lazy_section'))
{
    function jnews_split_lazy_section($result)
    {
        $result['jnews_global_loader_section'][] = JNEWS_SPLIT_DIR . "split-option.php";
        return $result;
    }
}

/** Load Split Class */
add_action('plugins_loaded', 'jnews_split_content');

if(!function_exists('jnews_split_content'))
{
    function jnews_split_content()
    {
        require_once "class.jnews-split-post.php";
        JNews_Split_Post::getInstance();
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

function jnews_split_load_textdomain()
{
    load_plugin_textdomain( JNEWS_SPLIT, false, basename(__DIR__) . '/languages/' );
}

jnews_split_load_textdomain();