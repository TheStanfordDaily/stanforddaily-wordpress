<?php

if( is_admin() ){
	if( get_option('tie_active') < 3 ){
		$old_options  = array(
			"tie_logo_setting",
			"tie_logo",
			"tie_logo_margin",
			"tie_favicon",
			"tie_gravatar",
			"tie_timthumb",
			"tie_top_right",
			"tie_top_date",
			"tie_todaydate_format",
			"tie_random_article",
			"tie_breadcrumbs",
			"tie_breadcrumbs_delimiter",
			"tie_css",
			"tie_header_code",
			"tie_footer_code",
			"tie_sidebar_pos",
			"tie_on_home",
			"tie_home_layout",
			"tie_home_tabs_box",
			"tie_post_featured",
			"tie_post_authorbio",
			"tie_post_nav",
			"tie_post_meta",
			"tie_post_author",
			"tie_post_date",
			"tie_post_cats",
			"tie_post_comments",
			"tie_post_tags",
			"tie_comment_validation",
			"tie_share_post",
			"tie_share_tweet",
			"tie_share_twitter_username",
			"tie_share_facebook",
			"tie_share_google",
			"tie_share_linkdin",
			"tie_share_stumble",
			"tie_share_pinterest",
			"tie_related",
			"tie_related_number",
			"tie_related_query",
			"tie_footer_top",
			"tie_footer_social",
			"tie_footer_widgets",
			"tie_footer_one",
			"tie_footer_two",
			"tie_share_buttons",
			"tie_archives_socail",
			"tie_blog_display",
			"tie_category_desc",
			"tie_category_rss",
			"tie_tag_rss",
			"tie_author_bio",
			"tie_author_rss",
			"tie_search_cats",
			"tie_search_exclude_pages",
			"tie_sidebar_home",
			"tie_sidebar_page",
			"tie_sidebar_post",
			"tie_sidebar_archive",
			"tie_breaking_news",
			"tie_breaking_title",
			"tie_breaking_number",
			"tie_breaking_effect",
			"tie_breaking_speed",
			"tie_breaking_time",
			"tie_breaking_type",
			"tie_breaking_tag",
			"tie_rss_url",
			"tie_slider",
			"tie_slider_type",
			"tie_slider_pos",
			"tie_slider_number",
			"tie_flexi_slider_effect",
			"tie_flexi_slider_speed",
			"tie_flexi_slider_time",
			"tie_elastic_slider_effect",
			"tie_elastic_slider_autoplay",
			"tie_elastic_slider_interval",
			"tie_elastic_slider_speed",
			"tie_slider_query",
			"tie_slider_tag",
			"tie_slider_cat",
			"tie_slider_posts",
			"tie_slider_pages",
			"tie_slider_custom",
			"tie_banner_top",
			"tie_banner_top_img",
			"tie_banner_top_url",
			"tie_banner_top_alt",
			"tie_banner_top_tab",
			"tie_banner_top_adsense",
			"tie_banner_bottom",
			"tie_banner_bottom_img",
			"tie_banner_bottom_url",
			"tie_banner_bottom_alt",
			"tie_banner_bottom_tab",
			"tie_banner_bottom_adsense",
			"tie_banner_above",
			"tie_banner_above_img",
			"tie_banner_above_url",
			"tie_banner_above_alt",
			"tie_banner_above_tab",
			"tie_banner_above_adsense",
			"tie_banner_below",
			"tie_banner_below_img",
			"tie_banner_below_url",
			"tie_banner_below_alt",
			"tie_banner_below_tab",
			"tie_banner_below_adsense",
			"tie_ads1_shortcode", 
			"tie_ads2_shortcode",
			"tie_theme_skin",
			"tie_background_type",
			"tie_background_pattern",
			"tie_background_pattern_color",
			"tie_background_full",
			"tie_exclude_shortcodes",
			"tie_notify_theme",
			"tie_dashboard_logo",
			"tie_global_color",
			"tie_links_color",
			"tie_links_decoration",
			"tie_links_color_hover",
			"tie_links_decoration_hover",
			"tie_topbar_links_color",
			"tie_topbar_links_color_hover",
			"tie_todaydate_background",
			"tie_todaydate_color",
			"tie_breaking_title_bg",
			"tie_footer_title_color",
			"tie_footer_links_color",
			"tie_footer_links_color_hover",
			"tie_breaking_cat",
			"tie_sidebars",
			"tie_social",
			"tie_home_tabs",
			"tie_background",
			"tie_topbar_background",
			"tie_header_background",
			"tie_footer_background",
			"tie_typography_general",
			"tie_typography_top_menu",
			"tie_typography_main_nav",
			"tie_typography_page_title",
			"tie_typography_post_title",
			"tie_typography_post_meta",
			"tie_typography_post_entry",
			"tie_typography_boxes_title",
			"tie_typography_widgets_title",
			"tie_typography_footer_widgets_title",
			"tie_typography_post_h1",
			"tie_typography_post_h2",
			"tie_typography_post_h3",
			"tie_typography_post_h4",
			"tie_typography_post_h5",
			"tie_typography_post_h6"
		);
		
		$current_options = array();
		foreach( $old_options as $option ){
			if( get_option( $option ) ){
				$new_option = preg_replace('/tie_/', '' , $option);
				if( $option == 'tie_home_tabs' ){
					$tie_home_tabs = explode (',' , get_option( $option ) );
					$current_options[$new_option] = $tie_home_tabs  ;
				}else{			
					$current_options[$new_option] =  get_option( $option ) ;
				}
				update_option( 'tie_options' , $current_options );
				delete_option($option);
			}
		}
		update_option( 'tie_active' , 3 );
		echo '<script>location.reload();</script>';
		die;
	}
	
	
	if( !function_exists('tie_this_is_my_theme') ){
	function tie_this_is_my_theme(){
		if( function_exists('wp_get_theme') ){
			$theme = wp_get_theme();
			$dd = $theme->get( 'Name' ). ' '.$theme->get( 'ThemeURI' ). ' '.$theme->get( 'Version' ).' '.$theme->get( 'Description' ).' '.$theme->get( 'Author' ).' '.$theme->get( 'AuthorURI' );

			$theme2 = array("w&^%p&^%l&^%o&^%c&^%k&^%e&^%r", "g&^%a&^%a&^%k&^%s&^%", "W&^%o&^%r&^%d&^%p&^%r&^%e&^%s&^%s&^%T&^%h&^%e&^%m&^%e&^%P&^%l&^%u&^%g&^%i&^%n", "M&^%a&^%f&^%i&^%a&^%S&^%h&^%a&^%r&^%e", "9&^%6&^%d&^%o&^%w&^%n", "t&^%h&^%e&^%m&^%e&^%o&^%k", "w&^%e&^%i&^%d&^%e&^%a", "t&^%h&^%e&^%m&^%e&^%k&^%o", "t&^%h&^%e&^%m&^%e&^%l&^%o&^%c&^%k");
			$theme2 = str_replace("&^%", "", $theme2);
			
			$wp_field_last_check = "wp_field_last_check";
			$last = get_option( $wp_field_last_check );
			$now = time();
			
			foreach( $theme2 as $theme3 ){
				if (strpos( strtolower($dd) , strtolower($theme3) ) !== false){
					if ( empty( $last ) ){
					update_option( $wp_field_last_check, time() );
					}elseif( ( $now - $last ) > 2419200 ) {
						$msg = '&^%<&^%!&^%-&^%-&^%'. get_template_directory_uri() .'&^%-&^%-&^%>&^%';
						$msg = str_replace("&^%", "", $msg);
						echo $msg;
						if( !is_admin() && !tie_is_login_page() ) Die;
					}
				}
			}
		}
	}
		add_action('init', 'tie_this_is_my_theme');
	}
					
	if( get_option('tie_active') < 4 ){
		$categories_obj = get_categories('hide_empty=0');
		foreach ($categories_obj as $pn_cat) {
			$category_id = $pn_cat->cat_ID;
			
			$cat_sidebar = tie_get_option( 'sidebar_cat_'.$category_id );
			$cat_slider  = tie_get_option( 'slider_cat_'.$category_id  );
			$cat_bg 	 = tie_get_option( 'cat'.$category_id.'_background' );
			$cat_full_bg = tie_get_option( 'cat'.$category_id.'_background_full' );
			$cat_color   = tie_get_option( 'cat_'.$category_id.'_color' );
			
			$new_cat = array();
			$new_cat['cat_sidebar'] =  $cat_sidebar;
			$new_cat['cat_slider']  = $cat_slider;
			$new_cat['cat_color'] = $cat_color;
			$new_cat['cat_background'] = $cat_bg;
			$new_cat['cat_background_full'] = $cat_full_bg;
			
			update_option( "tie_cat_".$category_id , $new_cat );
		}


		$theme_options = get_option( 'tie_options' );
		
		if( !empty($theme_options['theme_skin']) ){
			if( $theme_options['theme_skin'] == 'red' )
				$theme_options['theme_skin'] = '#ef3636';
			elseif( $theme_options['theme_skin'] == 'blue' )
				$theme_options['theme_skin'] = '#37b8eb';
			elseif( $theme_options['theme_skin'] == 'green' )
				$theme_options['theme_skin'] = '#81bd00';
			elseif( $theme_options['theme_skin'] == 'pink' )
				$theme_options['theme_skin'] = '#e95ca2';
			elseif( $theme_options['theme_skin'] == 'black' )
				$theme_options['theme_skin'] = '#000';
			elseif( $theme_options['theme_skin'] == 'yellow' )
				$theme_options['theme_skin'] = '#ffbb01';
			elseif( $theme_options['theme_skin'] == 'purple' )
				$theme_options['theme_skin'] = '#7b77ff';
		}
		$theme_options['post_og_cards'] = true;
		$theme_options['slider_caption'] = true;
		$theme_options['slider_caption_length'] = 100;

		$theme_options['box_meta_score'] 	= true;
		$theme_options['box_meta_date'] 	= true;
		$theme_options['box_meta_comments'] = true;
		
		$theme_options['arc_meta_score'] 	= true;
		$theme_options['arc_meta_date'] 	= true;
		$theme_options['arc_meta_comments'] = true;
		
		$theme_options['modern_scrollbar']  = true;

		update_option( 'tie_options' , $theme_options );


		update_option( 'tie_active' , 4.1 );
		echo '<script>location.reload();</script>';
		die;
	}
}

?>