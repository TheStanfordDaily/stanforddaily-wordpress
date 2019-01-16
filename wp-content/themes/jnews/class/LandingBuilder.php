<?php
/**
 * @author : Jegtheme
 */
namespace JNews;

use JNews\Module\Block\BlockViewAbstract;
use JNews\Module\ModuleManager;

/**
 * Class Theme Landing Builder
 */
Class LandingBuilder
{
    /**
     * @var int
     */
    private $post_id;

    /**
     * @var BlockViewAbstract
     */
    private $content_instance;


    public function __construct($post_id = null)
    {
        $this->post_id = ($post_id === null ) ? get_the_ID() : $post_id;
    }

    public function render_loop()
    {
        $content_width = array($this->column_width());
        ModuleManager::getInstance()->set_width($content_width);

        $attr = array(
            'first_title' => $this->get_first_title_header(),
            'second_title' => $this->get_second_title_header(),
            'header_type' => $this->get_header_type(),
            'header_background' => $this->get_header_background(),
            'header_text_color' => $this->get_header_text_color(),

            'date_format' => $this->get_content_date(),
            'date_format_custom' => $this->get_content_date_custom(),
            'excerpt_length' => $this->get_content_excerpt(),
            'pagination_number_post' => $this->get_posts_per_page(),
            'number_post' => $this->get_posts_per_page(),
            'pagination_mode' => $this->get_content_pagination(),
            'paged' => jnews_get_post_current_page(),
            'pagination_align' => $this->get_content_pagination_align(),
            'pagination_navtext' => $this->get_content_pagination_navtext(),
            'pagination_pageinfo' => $this->get_content_pagination_pageinfo(),

            'post_offset' => $this->get_post_offset(),
            'include_post' => $this->get_include_post(),
            'exclude_post' => $this->get_exclude_post(),
            'include_category' => $this->get_include_category(),
            'exclude_category' => $this->get_exclude_category(),
            'include_author' => $this->get_include_author(),
            'include_tag' => $this->get_include_tag(),
            'exclude_tag' => $this->get_exclude_tag(),
            'sort_by' => $this->get_sort_by()
        );

        $name = jnews_get_view_class_from_shortcode ( 'JNews_Block_' . $this->get_content_type() );
        $this->content_instance = jnews_get_module_instance($name);
        return $this->content_instance->build_module($attr);
    }

    public function can_render_builder()
    {
        return ( jnews_get_post_current_page() == 1 );
    }

    public function can_render_loop()
    {
        return vp_metabox('jnews_page_loop.enable_page_loop', null, $this->post_id);
    }

    public function main_class()
    {
        $layout = vp_metabox('jnews_page_loop.layout', 'right-sidebar', $this->post_id);

	    switch ($layout)
	    {
		    case 'left-sidebar' :
		    case 'left-sidebar-narrow' :
			    echo "jeg_sidebar_left";
			    break;

		    case 'double-sidebar' :
			    echo "jeg_double_sidebar";
			    break;

		    case 'double-right-sidebar' :
			    echo "jeg_double_right_sidebar";
			    break;

		    case 'no-sidebar' :
			    echo "jeg_sidebar_none";
			    break;

		    default :
			    break;
	    }
    }


    // header

    public function get_first_title_header()
    {
        return vp_metabox('jnews_page_loop.first_title', null, $this->post_id);
    }

    public function get_second_title_header()
    {
        return vp_metabox('jnews_page_loop.second_title', null, $this->post_id);
    }

    public function get_header_type()
    {
        return vp_metabox('jnews_page_loop.header_type', null, $this->post_id);
    }

    public function get_header_background()
    {
        return vp_metabox('jnews_page_loop.header_background', null, $this->post_id);
    }

    public function get_header_text_color()
    {
        return vp_metabox('jnews_page_loop.header_text_color', null, $this->post_id);
    }

    // content

    public function get_post_offset()
    {
        return vp_metabox('jnews_page_loop.post_offset', null, $this->post_id);
    }

	public function get_posts_per_page()
	{
		$posts_per_page = vp_metabox('jnews_page_loop.posts_per_page', 5, $this->post_id);

		return $posts_per_page ? $posts_per_page : get_option( 'posts_per_page' );
	}

    public function get_include_post()
    {
        return vp_metabox('jnews_page_loop.include_post', null, $this->post_id);
    }

    public function get_exclude_post()
    {
        return vp_metabox('jnews_page_loop.exclude_post', null, $this->post_id);
    }

    public function get_include_category()
    {
        return vp_metabox('jnews_page_loop.include_category', null, $this->post_id);
    }

    public function get_exclude_category()
    {
        return vp_metabox('jnews_page_loop.exclude_category', null, $this->post_id);
    }

    public function get_include_author()
    {
        return vp_metabox('jnews_page_loop.include_author', null, $this->post_id);
    }

    public function get_include_tag()
    {
        return vp_metabox('jnews_page_loop.include_tag', null, $this->post_id);
    }

    public function get_exclude_tag()
    {
        return vp_metabox('jnews_page_loop.exclude_tag', null, $this->post_id);
    }

    public function get_sort_by()
    {
        return vp_metabox('jnews_page_loop.sort_by', 'latest', $this->post_id);
    }


    // layout

    public function get_sidebar()
    {
        return vp_metabox('jnews_page_loop.sidebar', null, $this->post_id);
    }

	public function get_second_sidebar()
	{
		return vp_metabox('jnews_page_loop.second_sidebar', null, $this->post_id);
	}

    public function get_sticky_sidebar()
    {
        if ( vp_metabox('jnews_page_loop.sticky_sidebar', true, $this->post_id) ) 
        {
            return 'jeg_sticky_sidebar';
        }
        
        return false;
    }

	public function get_page_layout()
	{
		return vp_metabox('jnews_page_loop.layout', 'right-sidebar');
	}

	public function column_width()
	{
		$layout = $this->get_page_layout();

		switch ($layout)
		{
			case 'right-sidebar':
			case 'left-sidebar':
				return 8;
				break;

			case 'right-sidebar-narrow':
			case 'left-sidebar-narrow':
				return 9;
				break;

			case 'double-sidebar':
			case 'double-right-sidebar':
				return 6;
				break;
		}

		return 12;
	}

	public function render_sidebar()
	{
		$layout = $this->get_page_layout();

		if ( $layout !== 'no-sidebar' )
		{
			$sidebar = array(
				'content-sidebar'   => $this->get_sidebar(),
				'sticky-sidebar'    => $this->get_sticky_sidebar(),
				'width-sidebar'     => $this->get_sidebar_width(),
				'position-sidebar'  => 'left'
			);

			set_query_var( 'sidebar', $sidebar );
			get_template_part('fragment/archive-sidebar');

			if($layout === 'double-right-sidebar' || $layout === 'double-sidebar')
			{
				$sidebar['content-sidebar']  = $this->get_second_sidebar();
				$sidebar['position-sidebar'] = 'right';
				set_query_var( 'sidebar', $sidebar );
				get_template_part('fragment/archive-sidebar');
			}
		}
	}

	public function get_sidebar_width()
	{
		$layout = $this->get_page_layout();

		if($layout === 'left-sidebar' || $layout === 'right-sidebar')
		{
			return 4;
		}

		return 3;
	}

	public function render_second_sidebar()
	{
		if($this->get_page_layout() === 'double-sidebar')
		{
			$sidebar = array(
				'content-sidebar'   => $this->get_sidebar(),
				'sticky-sidebar'    => $this->get_sticky_sidebar(),
				'width-sidebar'     => $this->get_sidebar_width()
			);

			set_query_var( 'sidebar', $sidebar );
			get_template_part('fragment/archive-sidebar');
		}
	}

    public function get_content_type()
    {
        return vp_metabox('jnews_page_loop.module', '3', $this->post_id);
    }

    public function get_content_date()
    {
        return vp_metabox('jnews_page_loop.content_date', 'default', $this->post_id);
    }

    public function get_content_date_custom()
    {
        return vp_metabox('jnews_page_loop.date_custom', 'Y/m/d', $this->post_id);
    }

    public function get_content_excerpt()
    {
        return vp_metabox('jnews_page_loop.excerpt_length', '20', $this->post_id);
    }

    public function get_content_pagination()
    {
        return vp_metabox('jnews_page_loop.content_pagination', 'nav_1', $this->post_id);
    }

    public function get_content_pagination_align()
    {
        return vp_metabox('jnews_page_loop.pagination_align', 'center', $this->post_id);
    }

    public function get_content_pagination_navtext()
    {
        return vp_metabox('jnews_page_loop.show_navtext', null, $this->post_id);
    }

    public function get_content_pagination_pageinfo()
    {
        return vp_metabox('jnews_page_loop.show_pageinfo', null, $this->post_id);
    }
}