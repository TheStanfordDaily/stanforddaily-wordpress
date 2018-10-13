<?php
/*
	Plugin Name: JNews - Essential
	Plugin URI: http://jegtheme.com/
	Description: Advertisement, Shortcode & Widget for JNews
	Version: 2.0.0
	Author: Jegtheme
	Author URI: http://jegtheme.com
	License: GPL2
*/


defined( 'JNEWS_ESSENTIAL' )               or define( 'JNEWS_ESSENTIAL', 'jnews-essential');
defined( 'JNEWS_ESSENTIAL_URL' )           or define( 'JNEWS_ESSENTIAL_URL', plugins_url(JNEWS_ESSENTIAL));
defined( 'JNEWS_ESSENTIAL_FILE' )          or define( 'JNEWS_ESSENTIAL_FILE',  __FILE__ );
defined( 'JNEWS_ESSENTIAL_DIR' )           or define( 'JNEWS_ESSENTIAL_DIR', plugin_dir_path( __FILE__ ) );


add_filter('jnews_load_advertisement_option', 'jnews_load_advertisement_option');

if(!function_exists('jnews_load_advertisement_option'))
{
    function jnews_load_advertisement_option()
    {
        return true;
    }
}

add_filter('jnews_load_shortcode_detail', 'jnews_load_shortcode_detail');

if(!function_exists('jnews_load_shortcode_detail'))
{
    function jnews_load_shortcode_detail()
    {
        return true;
    }
}

add_filter('jnews_load_all_widget', 'jnews_load_all_widget');

if(!function_exists('jnews_load_all_widget'))
{
    function jnews_load_all_widget()
    {
        return true;
    }
}

add_filter('jnews_load_default_metabox', 'jnews_load_default_metabox');

if(!function_exists('jnews_load_default_metabox'))
{
    function jnews_load_default_metabox()
    {
        return true;
    }
}

add_filter('jnews_load_post_subtitle', 'jnews_load_post_subtitle');

if(!function_exists('jnews_load_post_subtitle'))
{
    function jnews_load_post_subtitle()
    {
        return true;
    }
}

add_filter('jnews_load_mega_menu_option', 'jnews_load_mega_menu_option');

if(!function_exists('jnews_load_mega_menu_option'))
{
    function jnews_load_mega_menu_option()
    {
        return true;
    }
}

add_filter('jnews_send_message', 'jnews_send_message', null, 4);

if(!function_exists('jnews_send_message'))
{
    function jnews_send_message($result, $email, $title, $message)
    {
        return wp_mail($email, $title, $message);
    }
}

add_action('jnews_render_element', 'jnews_render_shortcode', null, 2);

if(!function_exists('jnews_render_shortcode'))
{
    function jnews_render_shortcode($tag, $func)
    {
        add_shortcode($tag, $func);
    }
}


add_action('jnews_admin_dashboard_parent', 'jnews_add_dashboard_menu');

if(!function_exists('jnews_add_dashboard_menu'))
{
    function jnews_add_dashboard_menu($parameter)
    {
        call_user_func_array('add_menu_page', $parameter);
    }
}

add_action('jnews_admin_dashboard_child', 'jnews_add_dashboard_submenu');

if(!function_exists('jnews_add_dashboard_submenu'))
{
    function jnews_add_dashboard_submenu($parameter)
    {
        call_user_func_array('add_submenu_page', $parameter);
    }
}

add_action('jnews_vc_element_parame', 'jnews_vc_element_parame');

if(!function_exists('jnews_vc_element_parame'))
{
    function jnews_vc_element_parame($parameter)
    {
        call_user_func_array('vc_add_shortcode_param', $parameter);
    }
}


add_filter('jnews_translate_polylang', 'jnews_translate_polylang', null, 2);

if(!function_exists('jnews_translate_polylang'))
{
    function jnews_translate_polylang($text)
    {
        if ( defined('POLYLANG_VERSION') )
        {
            return pll__($text);
        }

        return $text;
    }
}

add_filter('jnews_force_disable_related_post', 'jnews_force_disable_related_post');

if(!function_exists('jnews_force_disable_related_post'))
{
    function jnews_force_disable_related_post()
    {
        return false;
    }
}


/** Additional social account */
add_filter('user_contactmethods', 'jnews_account_social_contact', null);

function jnews_account_social_contact($socials)
{
    $additional = array(
        "facebook"      => "Facebook",
        "twitter"       => "Twitter",
        "googleplus"    => "Google Plus",
        "linkedin"      => "Linkedin",
        "pinterest"     => "Pinterest",
        "behance"       => "Behance",
        "github"        => "Github",
        "flickr"        => "Flickr",
        "tumblr"        => "Tumblr",
        "dribbble"      => "Dribbble",
        "soundcloud"    => "Soundcloud",
        "instagram"     => "Instagram",
        "vimeo"         => "Vimeo",
        "youtube"       => "Youtube",
        "reddit"        => "Reddit",
        "vk"            => "Vk",
        "weibo"         => "Weibo",
        "rss"           => "Rss",
    );
    return array_merge($socials, $additional);
}

// Need to remove admin dashboard
add_action('admin_menu', function()
{
    remove_action('jnews_admin_dashboard_child', 'jnews_theme_admin_dashboard_child');
});