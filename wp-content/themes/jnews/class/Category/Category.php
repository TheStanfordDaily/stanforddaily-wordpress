<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Category;

/**
 * Class Theme Category
 */
Class Category extends CategoryAbstract
{
    public function is_overwritten()
    {
        if(get_theme_mod('jnews_category_override_' . $this->term->term_id, false)) {
            return true;
        }
        return false;
    }

    // Header Breadcrumb Type
    public function get_header_type()
    {
        $option = get_theme_mod('jnews_category_header', '1');

        if ( $this->is_overwritten() ) 
        {
            $option = get_theme_mod('jnews_category_header_' . $this->term->term_id, '1');
        }

        return apply_filters( 'jnews_category_header', $option, $this->term->term_id );
    }

    public function get_header_background()
    {
        $option = get_theme_mod('jnews_category_header_bg_color', '#f5f5f5');

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_header_bg_color_' . $this->term->term_id, '#f5f5f5');
        }

        return apply_filters( 'jnews_category_header_bg_color', $option, $this->term->term_id );
    }

    public function get_header_style()
    {
        $option =get_theme_mod('jnews_category_header_style', 'dark');

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_header_style_' . $this->term->term_id, 'dark');
        }

        return apply_filters( 'jnews_category_header_style', $option, $this->term->term_id );
    }

    public function get_header_image()
    {
        $option = get_theme_mod('jnews_category_header_bg_image', '');

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_header_bg_image_' . $this->term->term_id, '');
        }

        return apply_filters( 'jnews_category_header_bg_image', $option, $this->term->term_id );
    }

    // Hero Header
    public function show_hero()
    {
        $option = get_theme_mod('jnews_category_hero_show', true);

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_hero_show_' . $this->term->term_id, true);
        }

        return apply_filters( 'jnews_category_hero_show', $option, $this->term->term_id );
    }

    public function get_hero_type()
    {
        $option = get_theme_mod('jnews_category_hero', '1');

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_hero_' . $this->term->term_id, '1');
        }

        return apply_filters( 'jnews_category_hero', $option, $this->term->term_id );
    }

    public function get_hero_style()
    {
        $option = get_theme_mod('jnews_category_hero_style', 'jeg_hero_style_1');

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_hero_style_' . $this->term->term_id, 'jeg_hero_style_1');
        }

        return apply_filters( 'jnews_category_hero_style', $option, $this->term->term_id );
    }

    public function get_hero_margin()
    {
        $option = get_theme_mod('jnews_category_hero_margin', 10);

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_hero_margin_' . $this->term->term_id, 10);
        }

        return apply_filters( 'jnews_category_hero_margin', $option, $this->term->term_id );
    }

    public function get_hero_date()
    {
        $option = get_theme_mod('jnews_category_hero_date', 'default');

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_hero_date_' . $this->term->term_id, 'default');
        }

        return apply_filters( 'jnews_category_hero_date', $option, $this->term->term_id );
    }

    public function get_hero_date_custom()
    {
        $option = get_theme_mod('jnews_category_hero_date_custom', 'Y/m/d');

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_hero_date_custom_' . $this->term->term_id, 'Y/m/d');
        }

        return apply_filters( 'jnews_category_hero_date_custom', $option, $this->term->term_id );
    }

    // content
    public function get_content_type()
    {
        $option = get_theme_mod('jnews_category_content', '5');

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_content_' . $this->term->term_id, '5');
        }

        return apply_filters( 'jnews_category_content', $option, $this->term->term_id );
    }

    public function get_content_excerpt()
    {
        $option = get_theme_mod('jnews_category_content_excerpt', 20);

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_content_excerpt_' . $this->term->term_id, 20);
        }

        return apply_filters( 'jnews_category_content_excerpt', $option, $this->term->term_id );
    }

    public function get_content_date()
    {
        $option = get_theme_mod('jnews_category_content_date', 'default');

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_content_date_' . $this->term->term_id, 'default');
        }

        return apply_filters( 'jnews_category_content_date', $option, $this->term->term_id );
    }

    public function get_content_date_custom()
    {
        $option = get_theme_mod('jnews_category_content_date_custom', 'Y/m/d');

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_content_date_custom_' . $this->term->term_id, 'Y/m/d');
        }

        return apply_filters( 'jnews_category_content_date_custom', $option, $this->term->term_id );
    }

    public function get_content_pagination()
    {
        $option = get_theme_mod('jnews_category_content_pagination', 'nav_1');

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_content_pagination_' . $this->term->term_id, 'nav_1');
        }

        return apply_filters( 'jnews_category_content_pagination', $option, $this->term->term_id );
    }

    public function get_content_pagination_limit()
    {
        $option = get_theme_mod('jnews_category_content_pagination_limit', 0);

        if ( $this->is_overwritten() ) 
        {
            $option = get_theme_mod('jnews_category_content_pagination_limit_' . $this->term->term_id, 0);
        }

        return apply_filters( 'jnews_category_content_pagination_limit', $option, $this->term->term_id );
    }

    public function get_content_pagination_align()
    {
        $option = get_theme_mod('jnews_category_content_pagination_align', 'center');

        if ( $this->is_overwritten() ) 
        {
            $option = get_theme_mod('jnews_category_content_pagination_align_' . $this->term->term_id, 'center');
        }

        return apply_filters( 'jnews_category_content_pagination_align', $option, $this->term->term_id );
    }

    public function get_content_pagination_navtext()
    {
        $option = get_theme_mod('jnews_category_content_pagination_show_navtext', false);

        if ( $this->is_overwritten() ) 
        {
            $option = get_theme_mod('jnews_category_content_pagination_show_navtext_' . $this->term->term_id, false);
        }

        return apply_filters( 'jnews_category_content_pagination_show_navtext', $option, $this->term->term_id );
    }

    public function get_content_pagination_pageinfo()
    {
        $option = get_theme_mod('jnews_category_content_pagination_show_pageinfo', false);

        if ( $this->is_overwritten() ) 
        {
            $option = get_theme_mod('jnews_category_content_pagination_show_pageinfo_' . $this->term->term_id, false);
        }

        return apply_filters( 'jnews_category_content_pagination_show_pageinfo', $option, $this->term->term_id );
    }

	public function get_page_layout()
	{
		$option = get_theme_mod('jnews_category_page_layout', 'right-sidebar');

		if ( $this->is_overwritten() )
		{
			$option = get_theme_mod('jnews_category_page_layout_' . $this->term->term_id, true);
		}

		return apply_filters( 'jnews_category_page_layout', $option, $this->term->term_id );
	}

    public function get_content_sidebar()
    {
        $option = get_theme_mod('jnews_category_sidebar', 'default-sidebar');

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_sidebar_' . $this->term->term_id, 'default-sidebar');
        }

        return apply_filters( 'jnews_category_sidebar', $option, $this->term->term_id );
    }

	public function get_second_sidebar()
	{
		$option = get_theme_mod('jnews_category_second_sidebar', 'default-sidebar');

		if ( $this->is_overwritten() )
		{
			$option = get_theme_mod('jnews_category_second_sidebar_' . $this->term->term_id, 'default-sidebar');
		}

		return apply_filters( 'jnews_category_second_sidebar', $option, $this->term->term_id );
	}

    public function sticky_sidebar()
    {
        $option = get_theme_mod('jnews_category_sticky_sidebar', true);

        if ( $this->is_overwritten() )
        {
            $option = get_theme_mod('jnews_category_sticky_sidebar_' . $this->term->term_id, true);
        }

        return apply_filters( 'jnews_category_sticky_sidebar', $option, $this->term->term_id );
    }
}