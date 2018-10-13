<?php
/*
	Plugin Name: JNews - JSON-LD
	Plugin URI: http://jegtheme.com/
	Description: JNews JSON-LD Schema
	Version: 2.0.0
	Author: Jegtheme
	Author URI: http://jegtheme.com
	License: GPL2
*/

defined( 'JNEWS_JSONLD' ) 		        or define( 'JNEWS_JSONLD', 'jnews-jsonld');
defined( 'JNEWS_JSONLD_URL' ) 		    or define( 'JNEWS_JSONLD_URL', plugins_url(JNEWS_JSONLD));
defined( 'JNEWS_JSONLD_FILE' ) 		    or define( 'JNEWS_JSONLD_FILE',  __FILE__ );
defined( 'JNEWS_JSONLD_DIR' ) 		    or define( 'JNEWS_JSONLD_DIR', plugin_dir_path( __FILE__ ) );


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

/**
 * JSONLD Option
 */
add_action( 'jnews_register_customizer_option', 'jnews_jsonld_option');

if(!function_exists('jnews_jsonld_option'))
{
    function jnews_jsonld_option()
    {
        require_once 'class.jnews-option-jsonld.php';
        JNews_JSONLD_Option::getInstance();
    }
}


add_filter('jeg_register_lazy_section', 'jnews_jsonld_lazy_section');

if(!function_exists('jnews_jsonld_lazy_section'))
{
    function jnews_jsonld_lazy_section($result)
    {
        $result['jnews_schema_setting'][] = JNEWS_JSONLD_DIR . "schema-option.php";
        $result['jnews_main_schema'][] = JNEWS_JSONLD_DIR . "main-option.php";
        $result['jnews_article_schema'][] = JNEWS_JSONLD_DIR . "article-option.php";
        return $result;
    }
}


/**
 * JSON LD Class
 */
add_action('plugins_loaded', 'jnews_json_ld');

if(!function_exists('jnews_json_ld'))
{
    function jnews_json_ld()
    {
        require_once "class.jnews-jsonld.php";
        JNews_JSONLD::getInstance();
    }
}

/**
 * Load Text Domain
 */

function jnews_jsonld_load_textdomain()
{
    load_plugin_textdomain( JNEWS_JSONLD, false, basename(__DIR__) . '/languages/' );
}

jnews_jsonld_load_textdomain();