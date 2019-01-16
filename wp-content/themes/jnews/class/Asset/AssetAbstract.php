<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Asset;

abstract class AssetAbstract
{
    public function get_asset_uri()
    {
        return apply_filters('jnews_get_asset_uri', get_parent_theme_file_uri('assets/'));
    }

    public function get_theme_version()
    {
        $theme = wp_get_theme();
        return $theme->get('Version');
    }

    public function is_login_page()
    {
        return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
    }
}