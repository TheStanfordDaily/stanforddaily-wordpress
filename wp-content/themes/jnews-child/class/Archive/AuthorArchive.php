<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Archive;

use JNews\Module\ModuleManager;

/**
 * Class AuthorArchive
 * @package JNews\Archive
 */
Class AuthorArchive extends ArchiveAbstract
{
    /**
     * @var \WP_Term
     */
    protected $author;

    /**
     * @var String
     */
    protected $section;

    public function __construct()
    {
        $this->author = get_the_author_meta( 'ID' );
        $this->section = isset($_REQUEST['section']) ? $_REQUEST['section'] : '';
    }

    public function render_content()
    {
        $content_width = array($this->get_content_width());
        ModuleManager::getInstance()->set_width($content_width);

        $post_per_page = get_option( 'posts_per_page' );

        $attr = array(
            'content_type' => $this->section,
            'date_format' => $this->get_content_date(),
            'date_format_custom' => $this->get_content_date_custom(),
            'excerpt_length' => $this->get_content_excerpt(),
            'pagination_number_post' => $post_per_page,
            'number_post' => $post_per_page,
            'post_offset' => $this->offset,
            'include_author' => $this->author,
            'sort_by' => 'latest',
            'pagination_mode' => $this->get_content_pagination(),
            'pagination_scroll_limit' => $this->get_content_pagination_limit(),
            'paged' => jnews_get_post_current_page(),
            'pagination_align' => $this->get_content_pagination_align(),
            'pagination_navtext' => $this->get_content_pagination_navtext(),
            'pagination_pageinfo' => $this->get_content_pagination_pageinfo(),
            'push_archive' => true
        );

        $name = jnews_get_view_class_from_shortcode ( 'JNews_Block_' . $this->get_content_type() );
        $this->content_instance = jnews_get_module_instance($name);
        return $this->content_instance->build_module($attr);
    }

    // content
    public function get_content_type()
    {
        return apply_filters('jnews_author_content', get_theme_mod('jnews_author_content', '3'), $this->author);
    }

    public function get_content_excerpt()
    {
        return apply_filters('jnews_author_content_excerpt', get_theme_mod('jnews_author_content_excerpt', 20), $this->author);
    }

    public function get_content_date()
    {
        return apply_filters('jnews_author_content_date', get_theme_mod('jnews_author_content_date', 'default'), $this->author);
    }

    public function get_content_date_custom()
    {
        return apply_filters('jnews_author_content_date_custom', get_theme_mod('jnews_author_content_date_custom', 'Y/m/d'), $this->author);
    }

    public function get_content_pagination()
    {
        return apply_filters('jnews_author_content_pagination', get_theme_mod('jnews_author_content_pagination', 'nav_1'), $this->author);
    }

    public function get_content_pagination_limit()
    {
        return apply_filters('jnews_author_content_pagination_limit', get_theme_mod('jnews_author_content_pagination_limit'), $this->author);
    }

    public function get_content_pagination_align()
    {
        return apply_filters('jnews_author_content_pagination_align', get_theme_mod('jnews_author_content_pagination_align', 'center'), $this->author);
    }

    public function get_content_pagination_navtext()
    {
        return apply_filters('jnews_author_content_pagination_show_navtext', get_theme_mod('jnews_author_content_pagination_show_navtext', false), $this->author);
    }

    public function get_content_pagination_pageinfo()
    {
        return apply_filters('jnews_author_content_pagination_show_pageinfo', get_theme_mod('jnews_author_content_pagination_show_pageinfo', false), $this->author);
    }

	public function get_page_layout()
	{
		return apply_filters('jnews_author_page_layout', get_theme_mod('jnews_author_page_layout', 'right-sidebar'), $this->author);
	}

	public function get_content_sidebar()
	{
		return apply_filters('jnews_author_sidebar', get_theme_mod('jnews_author_sidebar', 'default-sidebar'), $this->author);
	}

	public function get_second_sidebar()
	{
		return apply_filters('jnews_author_second_sidebar', get_theme_mod('jnews_author_second_sidebar', 'default-sidebar'), $this->author);
	}

	public function sticky_sidebar()
	{
		return apply_filters('jnews_author_sticky_sidebar', get_theme_mod('jnews_author_sticky_sidebar', true), $this->author);
	}

    public function get_header_title(){}
    public function get_header_description(){}
}
