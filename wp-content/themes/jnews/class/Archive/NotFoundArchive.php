<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Archive;

use JNews\Module\ModuleManager;

/**
 * Class NotFoundArchive
 * @package JNews\Archive
 */
Class NotFoundArchive extends ArchiveAbstract
{
    public function render_content()
    {
        $content_width = array($this->get_content_width());
        ModuleManager::getInstance()->set_width($content_width);

        $post_per_page = get_option( 'posts_per_page' );

        $attr = array(
            'first_title' => jnews_return_translation('Latest Articles', 'jnews', 'latest_articles'),
            'date_format' => $this->get_content_date(),
            'date_format_custom' => $this->get_content_date_custom(),
            'excerpt_length' => $this->get_content_excerpt(),
            'pagination_number_post' => $post_per_page,
            'number_post' => $post_per_page,
            'post_offset' => 0,
            'sort_by' => 'latest',
            'pagination_mode' => 'disable'
        );

        $name = jnews_get_view_class_from_shortcode ( 'JNews_Block_' . $this->get_content_type() );
        $this->content_instance = jnews_get_module_instance($name);
        return $this->content_instance->build_module($attr);
    }

    // content
    public function get_content_type()
    {
        return apply_filters('jnews_404_content', get_theme_mod('jnews_404_content', '3'));
    }

    public function get_content_excerpt()
    {
        return apply_filters('jnews_404_content_excerpt', get_theme_mod('jnews_404_content_excerpt', 20));
    }

    public function get_content_date()
    {
        return apply_filters('jnews_404_content_date', get_theme_mod('jnews_404_content_date', 'default'));
    }

    public function get_content_date_custom()
    {
        return apply_filters('jnews_404_content_date_custom', get_theme_mod('jnews_404_content_date_custom', 'Y/m/d'));
    }

	public function get_page_layout()
	{
		return apply_filters('jnews_404_page_layout', get_theme_mod('jnews_404_page_layout', 'right-sidebar'));
	}

    public function get_content_sidebar()
    {
        return apply_filters('jnews_404_sidebar', get_theme_mod('jnews_404_sidebar', 'default-sidebar'));
    }

	public function get_second_sidebar()
	{
		return apply_filters('jnews_404_second_sidebar', get_theme_mod('jnews_404_second_sidebar', 'default-sidebar'));
	}

    public function sticky_sidebar()
    {
        return apply_filters('jnews_404_sticky_sidebar', get_theme_mod('jnews_404_sticky_sidebar', true));
    }

    public function get_header_title()
    {
        $content = get_search_query();
        return $content;
    }

    public function get_header_description(){}
    public function get_content_pagination(){}
    public function get_content_pagination_limit(){}
    public function get_content_pagination_align(){}
    public function get_content_pagination_navtext(){}
    public function get_content_pagination_pageinfo(){}
}
