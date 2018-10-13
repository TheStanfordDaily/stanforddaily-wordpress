<?php
/*
	Plugin Name: JNews - Social Login
	Plugin URI: http://jegtheme.com/
	Description: Social Login & Registration Plugin for JNews Themes
	Version: 2.0.0
	Author: Jegtheme
	Author URI: http://jegtheme.com
	License: GPL2
*/

defined( 'JNEWS_SOCIAL_LOGIN' )          or define( 'JNEWS_SOCIAL_LOGIN', 'jnews-social-login');
defined( 'JNEWS_SOCIAL_LOGIN_VERSION' )  or define( 'JNEWS_SOCIAL_LOGIN_VERSION', '2.0.0' );
defined( 'JNEWS_SOCIAL_LOGIN_URL' )      or define( 'JNEWS_SOCIAL_LOGIN_URL', plugins_url('jnews-social-login') );
defined( 'JNEWS_SOCIAL_LOGIN_FILE' )     or define( 'JNEWS_SOCIAL_LOGIN_FILE',  __FILE__ );
defined( 'JNEWS_SOCIAL_LOGIN_DIR' )      or define( 'JNEWS_SOCIAL_LOGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once 'class.jnews-social-login.php';

/**
 * Get JNews option
 *
 * @param array $setting
 * @param mixed $default
 * 
 * @return mixed
 * 
 */
if ( !function_exists('jnews_get_option') )
{
    function jnews_get_option( $setting, $default = null )
    {
        $options = get_option( 'jnews_option', array() );
        $value = $default;

        if ( isset( $options[ $setting ] ) ) 
        {
            $value = $options[ $setting ];
        }
        return $value;
    }
}

/**
 * Load Plugin Option
 */
add_action( 'jnews_register_customizer_option', 'jnews_social_login_customizer_option' );

if ( !function_exists('jnews_social_login_customizer_option') )
{
    function jnews_social_login_customizer_option()
    {
        require_once 'include/class.jnews-social-login-option.php';
        JNews_Social_Login_Option::getInstance();
    }
}


add_filter('jeg_register_lazy_section', 'jnews_social_login_lazy_section');

if(!function_exists('jnews_social_login_lazy_section'))
{
    function jnews_social_login_lazy_section($result)
    {
        $result['jnews_social_login_section'][] = JNEWS_SOCIAL_LOGIN_DIR . "social-login-option.php";
        return $result;
    }
}

/**
 * Check bbpress plugin
 *
 * @return boolean
 */
function jeg_social_login_bbpress_plugin_check()
{
    if ( !function_exists( 'get_plugins' ) )
    {
        require_once ABSPATH . '/wp-admin/includes/plugin.php';
    }

    if ( get_plugins('/bbpress') )
    {
        if ( is_plugin_active('bbpress/bbpress.php') )
        {
            return true;
        }
    }

    return false;
}


/**
 * Social login info
 *
 * @return string
 *
 */
function jeg_show_social_login_info()
{
    $facebook_url = apply_filters( 'jeg_social_url_filter', '', 'facebook' );
    $google_url   = apply_filters( 'jeg_social_url_filter', '', 'google' );
    $linkedin_url = apply_filters( 'jeg_social_url_filter', '', 'linkedin' );

    if ( get_option( 'permalink_structure' ) )
    {
        return wp_kses(
            sprintf(
                __("You will be asked to enter callback url when you configure apps. Please use below url :
                                <ol>
                                    <li><strong>Facebook</strong> : %s</li>
                                    <li><strong>Google</strong> : %s</li>
                                    <li><strong>Linked In</strong> : %s</li>
                                 </ol>", "jnews-weather"),
                $facebook_url, $google_url, $linkedin_url ), wp_kses_allowed_html()
        );
    } else {
        return wp_kses(__("Please <strong>Do not use Plain Permalink setting</strong>. To change this setting, please go to Settings > Permalinks.", 'jnews-social-login' ), wp_kses_allowed_html());
    }
}

/**
 * Activation hook
 */
register_activation_hook( __FILE__, array( JNews_Social_Login::getInstance(), 'flush_rewrite_rules' ) );

/**
 * Load Social Login Class
 */
add_action( 'plugins_loaded', 'jnews_social_login' );

if ( !function_exists('jnews_social_login') )
{
    function jnews_social_login()
    {
        JNews_Social_Login::getInstance();
    }
}

/**
 * Print Translation
 */
if ( !function_exists('jnews_print_translation') )
{
    function jnews_print_translation( $string, $domain, $name )
    {
        do_action( 'jnews_print_translation', $string, $domain, $name );
    }
}

if ( !function_exists('jnews_print_main_translation') )
{
    add_action( 'jnews_print_translation', 'jnews_print_main_translation', 10, 2 );

    function jnews_print_main_translation( $string, $domain )
    {
        call_user_func_array( 'esc_html_e', array( $string, $domain ) );
    }
}

/**
 * Return Translation
 */
if ( !function_exists('jnews_return_translation') )
{
    function jnews_return_translation( $string, $domain, $name, $escape = true )
    {
        return apply_filters( 'jnews_return_translation', $string, $domain, $name, $escape );
    }
}

if ( !function_exists('jnews_return_main_translation') )
{
    add_filter( 'jnews_return_translation', 'jnews_return_main_translation', 10, 4 );

    function jnews_return_main_translation( $string, $domain, $name, $escape = true )
    {
        if ( $escape )
        {
            return call_user_func_array( 'esc_html__', array( $string, $domain ) );
        } else {
            return call_user_func_array( '__', array( $string, $domain ) );
        }

    }
}

/**
 * Load Text Domain
 */
function jnews_social_login_load_textdomain()
{
    load_plugin_textdomain( JNEWS_SOCIAL_LOGIN, false, basename(__DIR__) . '/languages/' );
}

jnews_social_login_load_textdomain();