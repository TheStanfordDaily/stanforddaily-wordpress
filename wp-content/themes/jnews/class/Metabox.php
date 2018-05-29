<?php
/**
 * @author : Jegtheme
 */
namespace JNews;

/**
 * Class Plugin Metabox
 */
Class Metabox
{
    public function __construct()
    {
        if (apply_filters('jnews_load_default_metabox', false))
        {
            add_action('after_setup_theme', array($this, 'blog_metabox'));
            add_action('after_setup_theme', array($this, 'page_metabox'));
        }
    }

    public function blog_metabox()
    {
        new \VP_Metabox(JNEWS_THEME_DIR . '/class/metabox/post-single.php');
        new \VP_Metabox(JNEWS_THEME_DIR . '/class/metabox/post-primary-category.php');
    }

    public function page_metabox()
    {
        new \VP_Metabox(JNEWS_THEME_DIR . '/class/metabox/page-loop.php');
        new \VP_Metabox(JNEWS_THEME_DIR . '/class/metabox/page-default.php');
    }
}
