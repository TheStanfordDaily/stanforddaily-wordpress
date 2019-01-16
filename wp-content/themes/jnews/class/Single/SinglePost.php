<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Single;

use JNews\Module\Block\BlockViewAbstract;

/**
 * Class Theme SinglePost
 */
Class SinglePost
{
    /**
     * @var SinglePost
     */
    private static $instance;

    /**
     * @var \WP_Post
     */
    private $post_id;

    /**
     * @return SinglePost
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        $this->post_id = get_the_ID();
        $this->hook();
    }

    public function hook()
    {
        add_filter('body_class',  array($this, 'add_body_class'));
        add_filter('the_content', array($this, 'render_inline_related_post'), 10);

        add_action('jnews_single_post_after_content', array($this, 'next_prev_content_hook'), 20);
        add_action('jnews_single_post_after_content', array($this, 'author_box_hook'), 30);
        add_action('jnews_single_post_after_content', array($this, 'related_post_hook'), 40);
        add_action('jnews_single_post_after_content', array($this, 'popup_post_hook'), 50);
        add_action('jnews_single_post_after_content', array($this, 'comment_post_hook'), 60);
    }

    public function set_post_id($post_id)
    {
        $this->post_id = $post_id;
        return $this;
    }

    public function next_prev_content_hook()
    {
        echo "<div class=\"jnews_prev_next_container\">" ;
        $this->prev_next_post();
        echo "</div>";
    }

    public function author_box_hook()
    {
        echo "<div class=\"jnews_author_box_container\">";
        $this->author_box();
        echo "</div>";
    }

    public function related_post_hook()
    {
        echo "<div class=\"jnews_related_post_container\">";
        echo jnews_sanitize_output($this->related_post(false));
        echo "</div>";
    }

    public function popup_post_hook()
    {
        echo "<div class=\"jnews_popup_post_container\">";
        $this->popup_post();
        echo "</div>";
    }

    public function comment_post_hook()
    {
        echo "<div class=\"jnews_comment_container\">";
        $this->post_comment();
        echo "</div>";
    }

    public function post_comment()
    {
        $show_comment = apply_filters('jnews_single_show_comment', true, $this->post_id);

        if($show_comment)
        {
            if ( comments_open() || '0' != jnews_get_comments_number() ) {
                comments_template();
            }
        }
    }

    /**
     * @return string
     */
    public function additional_fs_class()
    {
        $class = array();
        $template = $this->get_template();

        if($template === '4' || $template === '5')
        {
            if($this->get_fullscreen_mode()) {
                $class[] = 'jeg_fs_container';
            }

            if($this->get_parallax_mode()) {
                $class[] = 'jeg_parallax';
            }
        }

        echo implode(' ', $class);
    }

    public function add_body_class($classes)
    {
        $template = $this->get_template();

        switch($template) {
            case '1' :
                $classes[] = 'jeg_single_tpl_1';
                break;
            case '2' :
                $classes[] = 'jeg_single_tpl_2';
                break;
            case '3' :
                $classes[] = 'jeg_single_tpl_3';
                break;
            case '4' :
                $classes[] = 'jeg_single_tpl_4';
                if($this->get_fullscreen_mode()) {
                    $classes[] = 'jeg_force_fs';
                }
                break;
            case '5' :
                $classes[] = 'jeg_single_tpl_5';
                if($this->get_fullscreen_mode()) {
                    $classes[] = 'jeg_force_fs';
                }
                break;
            case '6' :
                $classes[] = 'jeg_single_tpl_6';
                break;
            case '7' :
                $classes[] = 'jeg_single_tpl_7';
                break;
            case '8' :
                $classes[] = 'jeg_single_tpl_8';
                break;
            case '9' :
                $classes[] = 'jeg_single_tpl_9';
                break;
            case '10' :
                $classes[] = 'jeg_single_tpl_10';
                break;
            default :
                break;
        }


        $layout = $this->get_layout();

        if($layout === 'no-sidebar-narrow')
        {
            $classes[] = 'jeg_single_fullwidth';
        }

        return $classes;
    }

    public function main_class()
    {
        $layout = $this->get_layout();

        switch ($layout)
        {
	        case 'no-sidebar-narrow' :
		        echo "jeg_sidebar_none";
		        break;

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

	        default :
	        	break;
        }
    }

	public function post_date_format($post)
	{
		$date_format = $this->get_date_format();

		if ( $date_format === 'ago' )
		{
			return jnews_ago_time ( human_time_diff( get_the_time('U', $post), current_time('timestamp') ) );
		}
		else if ( $date_format === 'default' )
		{
			return get_the_modified_date(null, $post);
		}
		else if ( $date_format )
		{
			return get_the_modified_date($date_format, $post);
		}

		return get_the_modified_date(null, $post);
	}

    public function get_template()
    {
        if(vp_metabox('jnews_single_post.override_template', null, $this->post_id))
        {
            $template = vp_metabox('jnews_single_post.override.0.template', '1', $this->post_id);
        } else {
            $template = get_theme_mod('jnews_single_blog_template', '1');
        }

        return apply_filters('jnews_single_post_template', $template, $this->post_id);
    }

    public function get_fullscreen_mode()
    {
        if(vp_metabox('jnews_single_post.override_template', null, $this->post_id))
        {
            $enable = vp_metabox('jnews_single_post.override.0.fullscreen', true, $this->post_id);
        } else {
            $enable = get_theme_mod('jnews_single_blog_enable_fullscreen', true);
        }

        return apply_filters('jnews_single_post_fullscreen', $enable, $this->post_id);
    }

    public function get_parallax_mode()
    {
        if(vp_metabox('jnews_single_post.override_template', null, $this->post_id))
        {
            $enable = vp_metabox('jnews_single_post.override.0.parallax', true, $this->post_id);
        } else {
            $enable = get_theme_mod('jnews_single_blog_enable_parallax', true);
        }

        return apply_filters('jnews_single_post_parallax', $enable, $this->post_id);
    }

    public function get_layout()
    {
        if(vp_metabox('jnews_single_post.override_template', null, $this->post_id))
        {
            $layout = vp_metabox('jnews_single_post.override.0.layout', 'right-sidebar', $this->post_id);
        } else {
            $layout = get_theme_mod('jnews_single_blog_layout', 'right-sidebar');
        }

        return apply_filters('jnews_single_post_layout', $layout, $this->post_id);
    }

    public function has_sidebar()
    {
        $layout = $this->get_layout();

        $sidebar = array('left-sidebar', 'right-sidebar', 'left-sidebar-narrow', 'right-sidebar-narrow', 'double-sidebar', 'double-right-sidebar');

        if ( in_array($layout, $sidebar) )
        {
            return true;
        }
        return false;
    }

    public function get_sidebar()
    {
        $sidebar = get_theme_mod('jnews_single_sidebar', 'default-sidebar');

        if(vp_metabox('jnews_single_post.override_template', null, $this->post_id))
        {
            $sidebar = vp_metabox('jnews_single_post.override.0.sidebar', 'default-sidebar', $this->post_id);
        }

        return apply_filters('jnews_single_post_sidebar', $sidebar, $this->post_id);
    }

	public function get_second_sidebar()
	{
		$sidebar = get_theme_mod('jnews_single_second_sidebar', 'default-sidebar');

		if(vp_metabox('jnews_single_post.override_template', null, $this->post_id))
		{
			$sidebar = vp_metabox('jnews_single_post.override.0.second_sidebar', 'default-sidebar', $this->post_id);
		}

		return apply_filters('jnews_single_post_second_sidebar', $sidebar, $this->post_id);
	}

    public function get_sticky_sidebar()
    {
        if ( $this->sticky_sidebar() )
        {
            return 'jeg_sticky_sidebar';
        }
        
        return false;
    }

    public function sticky_sidebar()
    {
        $sticky_sidebar = get_theme_mod('jnews_single_sticky_sidebar', true);

        if(vp_metabox('jnews_single_post.override_template', null, $this->post_id))
        {
            $sticky_sidebar = vp_metabox('jnews_single_post.override.0.sticky_sidebar', true, $this->post_id);
        }

        return apply_filters('jnews_single_post_sticky_sidebar', $sticky_sidebar, $this->post_id);
    }

    public function render_sidebar()
    {
        if($this->has_sidebar())
        {
        	$layout = $this->get_layout();

            get_template_part('fragment/post/single-sidebar');

            if ( $layout === 'double-right-sidebar' || $layout === 'double-sidebar' )
            {
	            set_query_var( 'double_sidebar', true );
	            get_template_part('fragment/post/single-sidebar');
            }
        }
    }

	public function get_sidebar_width()
	{
		$layout = $this->get_layout();

		if($layout === 'left-sidebar' || $layout === 'right-sidebar')
		{
			return 4;
		}

		return 3;
	}

    public function main_content_width()
    {
	    $layout = $this->get_layout();

	    switch ($layout)
	    {
		    case 'left-sidebar':
		    case 'right-sidebar':
		    	return 8;
		    	break;

		    case 'left-sidebar-narrow':
		    case 'right-sidebar-narrow':
			    return 9;
			    break;

		    case 'double-sidebar':
		    case 'double-right-sidebar':
			    return 6;
			    break;

		    case 'no-sidebar-narrow':
			    return $layout;
			    break;

		    default:
			    return 12;
			    break;
	    }
    }

    /**
     * breadcrumb
     */
    public function render_breadcrumb()
    {
        echo jnews_render_breadcrumb();
    }

    /**
     * Post Share
     */

    public function share_float_additional_class()
    {
        if ( vp_metabox('jnews_single_post.override_template') && vp_metabox('jnews_single_post.override.0.share_position') )
        {
            if ( vp_metabox('jnews_single_post.override.0.share_position') === 'float' || vp_metabox('jnews_single_post.override.0.share_position') === 'floatbottom' )
            {
                return "with-share";
            }

            return "no-share";
        }

        if ( get_theme_mod('jnews_single_share_position', 'top') === 'float' || get_theme_mod('jnews_single_share_position', 'top') === 'floatbottom' )
        {
            return "with-share";
        }

        return "no-share";
    }

    /**
     * Post Share - Float Style
     */

    public function share_float_style_class()
    {
        if ( vp_metabox('jnews_single_post.override_template') && vp_metabox('jnews_single_post.override.0.share_float_style') )
        {
            echo vp_metabox('jnews_single_post.override.0.share_float_style');
        } else {
            echo get_theme_mod('jnews_single_share_float_style', 'share-monocrhome');
        }
    }

    /**
     * Post Meta
     */
    public function render_post_meta()
    {
        if($this->show_post_meta())
        {
            $template = $this->get_template();

            switch($template) {
                case '1' :
                case '3' :
                case '4' :
                case '6' :
                case '7' :
                case '8' :
                case '9' :
                    get_template_part('fragment/post/meta-post-1');
                    break;
                case '2' :
                case '5' :
                case '10' :
                default :
                    get_template_part('fragment/post/meta-post-2');
                    break;
            }
        }
    }

    public function is_subtitle_empty()
    {
        $subtitle = $this->render_subtitle();
        return empty($subtitle);
    }

    public function render_subtitle()
    {
        $subtitle = wp_kses( get_post_meta( $this->post_id, 'post_subtitle', true ), wp_kses_allowed_html() );
        return apply_filters('jnews_single_subtitle', $subtitle, $this->post_id);
    }

    public function show_post_meta()
    {
        if ( vp_metabox('jnews_single_post.override_template') )
        {
            $flag = vp_metabox('jnews_single_post.override.0.show_post_meta');
        } else {
            $flag = get_theme_mod('jnews_single_show_post_meta', true);
        }

        return apply_filters('jnews_single_show_post_meta', $flag, $this->post_id);
    }

    public function show_author_meta_image()
    {
        if ( vp_metabox('jnews_single_post.override_template') )
        {
            $flag = vp_metabox('jnews_single_post.override.0.show_post_author_image');
        } else {
            $flag = get_theme_mod('jnews_single_show_post_author_image', true);
        }
        
        return apply_filters('jnews_single_show_post_author_image', $flag, $this->post_id);
    }

    public function show_author_meta()
    {
        if ( vp_metabox('jnews_single_post.override_template') )
        {
            $flag = vp_metabox('jnews_single_post.override.0.show_post_author');
        } else {
            $flag = get_theme_mod('jnews_single_show_post_author', true);
        }

        return apply_filters('jnews_single_show_post_author', $flag, $this->post_id);
    }

    public function show_date_meta()
    {
        if ( vp_metabox('jnews_single_post.override_template') )
        {
            $flag = vp_metabox('jnews_single_post.override.0.show_post_date');
        } else {
            $flag = get_theme_mod('jnews_single_show_post_date', true);
        }
        
        return apply_filters('jnews_single_show_post_date', $flag, $this->post_id);
    }

	public function get_date_format()
	{
		if ( vp_metabox('jnews_single_post.override_template') )
		{
			$format = vp_metabox('jnews_single_post.override.0.post_date_format', 'default');

			if ( $format === 'custom' )
			{
				$format = vp_metabox('jnews_single_post.override.0.post_date_format_custom', 'Y/m/d');
			}
		} else {
			$format = get_theme_mod('jnews_single_post_date_format', 'default');

			if ( $format === 'custom' )
			{
				$format = get_theme_mod('jnews_single_post_date_format_custom', 'Y/m/d');
			}
		}

		return apply_filters('jnews_single_show_post_date', $format, $this->post_id);
	}

    public function show_category_meta()
    {
        if ( vp_metabox('jnews_single_post.override_template') )
        {
            $flag = vp_metabox('jnews_single_post.override.0.show_post_category');
        } else {
            $flag = get_theme_mod('jnews_single_show_category', true);
        }
        
        return apply_filters('jnews_single_show_category', $flag, $this->post_id);
    }

    public function show_comment_meta()
    {
        $flag = get_theme_mod('jnews_single_comment', true);
        return apply_filters('jnews_single_comment', $flag, $this->post_id);
    }

    public function post_tag_render()
    {
        if ( vp_metabox('jnews_single_post.override_template') )
        {
            $flag = vp_metabox('jnews_single_post.override.0.show_post_tag');
        } else {
            $flag = get_theme_mod('jnews_single_show_tag', true);
        }

        if($flag)
        {
            $this->render_post_tag();
        }
    }

    public function render_post_tag()
    {
        echo "<span>" . jnews_return_translation('Tags:', 'jnews', 'tags') . "</span> " . get_the_tag_list('', '', '');
    }

    /**
     * Featured Post
     */
    public function render_featured_post_alternate()
    {
        $format = get_post_format();

        if($format === 'video' || $format === 'gallery') {
            $this->render_featured_post();
        }
    }

    public function render_featured_post()
    {
        if ( vp_metabox('jnews_single_post.override_template') )
        {
            $flag = vp_metabox('jnews_single_post.override.0.show_featured');
        } else {
            $flag = get_theme_mod('jnews_single_show_featured', true);
        }

        $current_page   = jnews_get_post_current_page();
        if( $flag && $current_page === 1) $this->feature_post_1();
    }

    public function get_featured_post_image_size($size)
    {
        $template = $this->get_template();

        if( $template === '1' || $template === '2' || $template === '3' || $template === '4' || $template === '5' ||
            $template === '6' || $template === '7' || $template === '8' || $template === '9' || $template === '10' )
        {
            if($this->has_sidebar())
            {
                $width_image = false;
            } else {
                $width_image = true;
            }
        } else {
            $width_image = true;
        }

        if($width_image === 'normal')
        {
            switch ($size) {
                case 'no-crop' :
                    $image_size = 'jnews-featured-750';
                    break;
                case 'crop-500';
                    $image_size = 'jnews-750x375';
                    break;
                case 'crop-715':
                    $image_size = 'jnews-750x536';
                    break;
                default :
                    $image_size = 'jnews-750x375';
            }
        } else {
            switch ($size) {
                case 'no-crop' :
                    $image_size = 'jnews-featured-1140';
                    break;
                case 'crop-500';
                    $image_size = 'jnews-1140x570';
                    break;
                case 'crop-715':
                    $image_size = 'jnews-1140x815';
                    break;
                default :
                    $image_size = 'jnews-1140x570';
            }
        }

        return $image_size;
    }

    public function get_single_thumbnail_size()
    {
        if(vp_metabox('jnews_single_post.override_image_size', null, $this->post_id))
        {
            $image_size = vp_metabox('jnews_single_post.image_override.0.single_post_thumbnail_size', 'crop-500', $this->post_id);
        } else {
            $image_size = get_theme_mod('jnews_single_post_thumbnail_size', 'crop-500');
        }

        return $this->get_featured_post_image_size($image_size);
    }

    public function get_gallery_thumbnail_size()
    {
        if(vp_metabox('jnews_single_post.override_image_size', null, $this->post_id))
        {
            $image_size = vp_metabox('jnews_single_post.image_override.0.single_post_gallery_size', 'crop-500', $this->post_id);
        } else {
            $image_size = get_theme_mod('jnews_single_post_gallery_size', 'crop-500');
        }

        return $this->get_featured_post_image_size($image_size);
    }

    public function feature_post_1()
    {
        $format = get_post_format();

        switch($format) {
            case 'gallery' :
                $gallery_size = $this->get_gallery_thumbnail_size();
                $output = $this->featured_gallery($gallery_size);
                break;
            case 'video' :
                $output = $this->featured_video();
                break;
            default :
                $image_size = $this->get_single_thumbnail_size();
                $output = $this->featured_image($image_size);
                break;
        }

        echo jnews_sanitize_output($output);
    }

    public function featured_gallery($size)
    {
        $size = apply_filters('jnews_featured_gallery_image_size', $size);
        $dimension = jnews_get_image_dimension_by_name($size);
        $output = '';
        $images = get_post_meta($this->post_id, '_format_gallery_images', true);

        if($images)
        {
            $output = "<div class=\"jeg_featured thumbnail-container size-{$dimension}\">";
            $output .= "<div class=\"featured_gallery jeg_owlslider owl-carousel\">";

            $popup = get_theme_mod('jnews_single_popup_script', 'magnific');

            foreach ( $images as $image_id )
            {
                $image = wp_get_attachment_image_src($image_id, 'full');

                $output .= ( $popup !== 'disable' ) ? "<a href=\"{$image[0]}\">" : "";
                $output .= apply_filters('jnews_single_image_lazy_owl', $image_id, $size);
                $output .= ( $popup !== 'disable' ) ? "</a>" : "";
            }

            $output .= "</div>";
            $output .= "</div>";

        }

        return apply_filters('jnews_featured_gallery', $output, $this->post_id);
    }


    public function featured_image($size)
    {
        $output = "<div class=\"jeg_featured featured_image\">";

        $popup              = get_theme_mod('jnews_single_popup_script', 'magnific');
        $image_src          = $this->get_featured_image_src('full');

        if(has_post_thumbnail())
        {
            $output .= ( $popup !== 'disable' ) ? "<a href=\"{$image_src}\">" : "";
            $output .= apply_filters('jnews_image_thumbnail_unwrap', $this->post_id, $size);
            $output .= ( $popup !== 'disable' ) ? "</a>" : "";
        }

        $output .= "</div>";
        return apply_filters('jnews_featured_image', $output, $this->post_id);
    }

    public function get_featured_image_src($size)
    {
        $post_thumbnail_id  = get_post_thumbnail_id( $this->post_id );
        $image              = wp_get_attachment_image_src($post_thumbnail_id, $size);

        return $image[0];
    }

    public function featured_video()
    {
        $output = "<div class=\"jeg_featured featured_video\">";

        $video_url      = get_post_meta( $this->post_id, '_format_video_embed', true );
        $video_format   = strtolower( pathinfo( $video_url, PATHINFO_EXTENSION ) );
        $featured_img   = jnews_get_image_src( get_post_thumbnail_id( $this->post_id ), 'jnews-featured-750' );

        if( jnews_check_video_type($video_url) === 'youtube' )
        {
            $output .=
                "<div data-src=\"". esc_url( $video_url ) . "\" data-type=\"youtube\" data-repeat=\"false\" data-autoplay=\"false\" class=\"youtube-class clearfix\">
                    <div class=\"jeg_video_container\"></div>
                </div>";
        } else if( jnews_check_video_type($video_url) === 'vimeo' )
        {
            $output .=
                "<div data-src=\"" . esc_url( $video_url ) . "\" data-repeat=\"false\" data-autoplay=\"false\" data-type=\"vimeo\" class=\"vimeo-class clearfix\">
                    <div class=\"jeg_video_container\"></div>
                </div>";
        } else if( $video_format == 'mp4' )
        {
            $output .=
                "<video width=\"640\" height=\"360\" style=\"width: 100%; height: 100%;\" poster=\"" . esc_attr( $featured_img ) . "\" preload=\"none\">
                    <source type=\"video/mp4\" src=\"" . esc_url( $video_url ) . "\">
                </video>";
        } else if ( wp_oembed_get( $video_url ) )
        {
            $output .= "<div class=\"jeg_video_container\">" . wp_oembed_get( $video_url ) . "</div>";
        }

        $output .= "</div>";

        return apply_filters('jnews_featured_video', $output, $this->post_id);
    }

    /**
     * Next Prev Post
     */
    public function prev_next_post()
    {
        if ( vp_metabox('jnews_single_post.override_template') )
        {
            $flag = vp_metabox('jnews_single_post.override.0.show_prev_next_post');
        } else {
            $flag = get_theme_mod('jnews_single_show_prev_next_post', true);
        }

        $show_prev_next = apply_filters('jnews_single_show_prev_next_post', $flag, $this->post_id);
        
        if($show_prev_next) {
            get_template_part('fragment/post/prev-next-post');
        }
    }

    /**
     * Popup Post
     */
    public function popup_post()
    {
        if ( vp_metabox('jnews_single_post.override_template') )
        {
            $flag   = vp_metabox('jnews_single_post.override.0.show_popup_post');
            $number = vp_metabox('jnews_single_post.override.0.number_popup_post');
        } else {
            $flag   = get_theme_mod('jnews_single_show_popup_post', true);
            $number = get_theme_mod('jnews_single_number_popup_post', 1);
        }

        $show_popup_post = apply_filters('jnews_single_show_popup_post', $flag, $this->post_id);

        if ( $show_popup_post ) 
        {
            set_query_var( 'number_popup_post', $number );
            get_template_part('fragment/post/popup-post');
        }
    }

    /**
     * Author Box
     */
    public function author_box()
    {
        if ( vp_metabox('jnews_single_post.override_template') )
        {
            $flag = vp_metabox('jnews_single_post.override.0.show_author_box');
        } else {
            $flag = get_theme_mod('jnews_single_show_author_box', false);
        }


        $show_author_box = apply_filters('jnews_single_show_author_box', $flag, $this->post_id);

        if($show_author_box) {
            get_template_part('fragment/post/author-box');
        }
    }

    public function recursive_category($categories, &$result)
    {
        foreach($categories as $category)
        {
            $result[] = $category;
            $children = get_categories ( array( 'parent' => $category->term_id ) );

            if( ! empty( $children ) ) {
                $this->recursive_category($children, $result);
            }
        }
    }

    /**
     * Check if we can render related post
     *
     * @return boolean
     */
    public function can_render_related_post()
    {
        if(apply_filters('jnews_force_disable_related_post', true)) return false;

        if ( vp_metabox('jnews_single_post.override_template') )
        {
            $flag = vp_metabox('jnews_single_post.override.0.show_post_related');
        } else {
            $flag = get_theme_mod('jnews_single_show_post_related', false);
        }

        return $flag;
    }

    /**
     * Check if we can render inline related post
     *
     * @return boolean
     */
    public function can_render_inline_related_post()
    {
        if ( apply_filters('jnews_force_disable_inline_related_post', false) ) return false;

        if ( vp_metabox('jnews_single_post.override_template') )
        {
            $flag = vp_metabox('jnews_single_post.override.0.show_inline_post_related');
        } else {
            $flag = get_theme_mod('jnews_single_post_show_inline_related', false);
        }

        return $flag;
    }

    /**
     * @param bool|true $echo
     * @return array|string
     */
    public function related_post($echo = true)
    {
        if($this->can_render_related_post())
        {
            $content_width = is_numeric($this->main_content_width()) ? $this->main_content_width() : 8;

            do_action('jnews_module_set_width', $content_width);
            $post_per_page = get_theme_mod('jnews_single_number_post_related', 6);

            $match = get_theme_mod('jnews_single_post_related_match', 'category');
            $category = $tag = $result = array();
            if($match === 'category')
            {
                $this->recursive_category(get_the_category(), $result);

                if($result) {
                    foreach($result as $cat) {
                        $category[] = $cat->term_id;
                    }
                }
            } else if($match === 'tag')
            {
                $tags = get_the_tags();
                if($tags) {
                    foreach($tags as $cat) {
                        $tag[] = $cat->term_id;
                    }
                }
            }

            $attr = array(
                'first_title' => jnews_return_translation('Related', 'jnews', 'related'),
                'second_title' => jnews_return_translation(' Posts', 'jnews', 'posts'),
                'header_type' => get_theme_mod('jnews_single_post_related_header', 'heading_6'),
                'date_format' => get_theme_mod('jnews_single_post_related_date', 'default'),
                'date_format_custom' => get_theme_mod('jnews_single_post_related_date_custom', 'Y/m/d'),
                'excerpt_length' => get_theme_mod('jnews_single_post_related_excerpt', 20),
                'pagination_number_post' => $post_per_page,
                'number_post' => $post_per_page,
                'include_category' => implode(',', $category),
                'include_tag' => implode(',', $tag),
                'exclude_post' => $this->post_id,
                'sort_by' => 'latest',
                'pagination_mode' => get_theme_mod('jnews_single_post_pagination_related', 'disable'),
                'pagination_scroll_limit' => get_theme_mod('jnews_single_post_auto_load_related', 3),
                'paged' => 1,
            );

            $name = 'JNews_Block_' . get_theme_mod('jnews_single_post_related_template', '22');
            $name = jnews_get_view_class_from_shortcode( $name );

            /** @var $content_instance BlockViewAbstract */
            $content_instance = jnews_get_module_instance($name);
            $result = $content_instance->build_module($attr);

            if($echo) {
                echo jnews_sanitize_output($result);
            } else {
                return $result;
            }
        }
    }

    public function render_inline_related_post( $content )
    {
        if ( get_post_type() === 'post' && is_single() && ! is_admin() )
        {
            if ( $this->can_render_inline_related_post() ) 
            {
                $pnumber    = explode( '<p>', $content );
                $paragraph  = get_theme_mod('jnews_single_post_inline_related_paragraph', 2);
                $random     = get_theme_mod('jnews_single_post_inline_related_random', false);
                $class      = get_theme_mod('jnews_single_post_inline_related_float', 'left');
                $fullwidth  = get_theme_mod('jnews_single_post_inline_related_fullwidth', false);

                if ( $random )
                {
                    $maxparagraph = count($pnumber) - 2;
                    $paragraph    = rand( $paragraph, $maxparagraph );
                }

                if ( ! $fullwidth ) 
                {
                    $class .= ' half'; 
                }

                $related_content = 
                    "<div class='jnews_inline_related_post_wrapper {$class}'>
                        " . $this->build_inline_related_post() . "
                    </div>";

                $content = $this->prefix_insert_after_paragraph($related_content, $paragraph, $content);
            }
        }

        return $content;
    }

    public function build_inline_related_post()
    {
        $match          = get_theme_mod('jnews_single_post_inline_related_match', 'category');
        $related_width  = get_theme_mod('jnews_single_post_inline_related_fullwidth', false) ? 8 : 4;
        $post_per_page  = get_theme_mod('jnews_single_post_inline_related_number', 3);
        $tag = $category = $result = array();

        do_action('jnews_module_set_width', $related_width);

        if ( $match === 'category' )
        {
            $this->recursive_category( get_the_category(), $result );

            if ( $result ) 
            {
                foreach($result as $cat) 
                {
                    $category[] = $cat->term_id;
                }
            }
        } 
        else if ( $match === 'tag' ) 
        {
            $tags = get_the_tags();
            if ( $tags ) 
            {
                foreach ( $tags as $cat ) 
                {
                    $tag[] = $cat->term_id;
                }
            }
        }

        $attr = array(
            'first_title'               => get_theme_mod('jnews_single_post_inline_related_ftitle', 'Related'),
            'second_title'              => get_theme_mod('jnews_single_post_inline_related_stitle', 'Posts'),
            'header_type'               => get_theme_mod('jnews_single_post_inline_related_header', 'heading_6'),
            'date_format'               => get_theme_mod('jnews_single_post_inline_related_date', 'default'),
            'date_format_custom'        => get_theme_mod('jnews_single_post_inline_related_date_custom', 'Y/m/d'),
            'pagination_number_post'    => $post_per_page,
            'number_post'               => $post_per_page,
            'include_category'          => implode(',', $category),
            'include_tag'               => implode(',', $tag),
            'exclude_post'              => $this->post_id,
            'sort_by'                   => 'latest',
            'pagination_mode'           => get_theme_mod('jnews_single_post_inline_related_pagination', 'nextprev'),
            'paged' => 1,
        );

        $name = 'JNews_Block_' . get_theme_mod('jnews_single_post_inline_related_template', '29') ;
        $name = jnews_get_view_class_from_shortcode( $name );

        /** @var $content_instance BlockViewAbstract */
        $content_instance = jnews_get_module_instance($name);
        $result = $content_instance->build_module($attr);

        $output = 
            "<div class='jnews_inline_related_post'>
                {$result}
            </div>";

        return $output;
    }

    protected function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content )
    {
        $begin_p = '</p>';
        $paragraphs = explode( $begin_p, $content );

        if ($paragraph_id == 0 ) {
            return $insertion . $content;
        }

        foreach ($paragraphs as $index => $paragraph) {
            if ( ($paragraph_id - 1 ) == $index ) {
                $paragraphs[$index] .= $insertion;
            }
            if ( trim( $paragraph ) ) {
                $paragraphs[$index] .= $begin_p;
            }
        }
        return implode( '', $paragraphs );
    }
}