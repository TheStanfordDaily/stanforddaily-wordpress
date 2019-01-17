<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Single;

/**
 * Class Theme SinglePage
 */
Class SinglePage
{
    /**
     * @var \WP_Post
     */
    private $post_id;

    public function __construct($post_id = null)
    {
        $this->post_id = ($post_id === null ) ? get_the_ID() : $post_id;
    }

    public function render_breadcrumb()
    {
        echo jnews_render_breadcrumb();
    }

    public function can_render_post_meta()
    {
        return vp_metabox('jnews_single_page.show_post_meta');
    }

    public function get_featured_image_src($size)
    {
        $post_thumbnail_id  = get_post_thumbnail_id( $this->post_id );
        $image              = wp_get_attachment_image_src($post_thumbnail_id, $size);

        return $image[0];
    }

    public function render_featured_post()
    {
        if($this->get_page_layout() !== 'no-sidebar')
        {
            $image_size = 'jnews-featured-750';
        } else {
            $image_size = 'jnews-featured-1140';
        }

        $output = "<div class=\"jeg_featured featured_image\">";

        $popup              = get_theme_mod('jnews_single_popup_script', 'magnific');
        $image_src          = $this->get_featured_image_src('full');

        if(has_post_thumbnail())
        {
            $output .= ( $popup !== 'disable' ) ? "<a href=\"{$image_src}\">" : "";
            $output .= apply_filters('jnews_image_thumbnail_unwrap', $this->post_id, $image_size);
            $output .= ( $popup !== 'disable' ) ? "</a>" : "";
        }

        $output .= "</div>";
        return apply_filters('jnews_featured_image', $output, $this->post_id);
    }

    public function share_float_additional_class()
    {
        $share_position = vp_metabox('jnews_single_page.share_position', 'top');

        if($share_position === 'float' || $share_position === 'floatbottom')
        {
            echo "with-share";
        }
    }

    public function is_share_float()
    {
        $share_position = vp_metabox('jnews_single_page.share_position', 'top');

        if($share_position === 'float' || $share_position === 'floatbottom')
        {
            return true;
        }
        return false;
    }

    public function get_sidebar()
    {
        return vp_metabox('jnews_single_page.sidebar');
    }

	public function get_second_sidebar()
	{
		return vp_metabox('jnews_single_page.second_sidebar');
	}

    public function get_sticky_sidebar()
    {
        if ( vp_metabox('jnews_single_page.sticky_sidebar') )
        {
            return 'jeg_sticky_sidebar';
        }
        
        return false;
    }

	public function get_page_layout()
	{
		return vp_metabox('jnews_single_page.layout', 'no-sidebar');
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

    public function main_class()
    {
        $layout = vp_metabox('jnews_single_page.layout', 'no-sidebar');

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

}