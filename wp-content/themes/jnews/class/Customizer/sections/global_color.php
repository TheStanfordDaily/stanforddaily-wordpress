<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_scheme_header',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Website Scheme','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_scheme_color',
    'transport'     => 'refresh',
    'default'       => 'normal',
    'type'          => 'jnews-preset',
    'label'         => esc_html__('Choose your scheme color', 'jnews'),
    'description'   => esc_html__('This option will switch color option of your website. Header & footer option won\'t be affected by this option.','jnews' ),
    'choices'       => array(
        'normal' => array(
            'label'     => esc_html__('Normal', 'jnews'),
            'settings'  => array(
                'jnews_body_color' => '#53585c',
                'jnews_heading_color' => '#212121',
                'jnews_container_background' => '#ffffff',
            )
        ),
        'dark' => array(
            'label'     => esc_html__('Dark', 'jnews'),
            'settings'  => array(
                'jnews_body_color' => '#ffffff',
                'jnews_heading_color' => '#ffffff',
                'jnews_container_background' => '#111111',
            )
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_webstite_color_header',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Website Color','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_body_color',
    'transport'     => 'postMessage',
    'type'          => 'jnews-color',
    'default'       => '#53585c',
    'label'         => esc_html__('Base Text Color (Body)', 'jnews'),
    'description'   => esc_html__('Set body text color.', 'jnews'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => 'body,.newsfeed_carousel.owl-carousel .owl-nav div,.jeg_filter_button,.owl-carousel .owl-nav div,.jeg_readmore,.jeg_hero_style_7 .jeg_post_meta a,.widget_calendar thead th,.widget_calendar tfoot a,.jeg_socialcounter a,.entry-header .jeg_meta_like a,.entry-header .jeg_meta_comment a,.entry-content tbody tr:hover,.entry-content th,.jeg_splitpost_nav li:hover a,#breadcrumbs a,.jeg_author_socials a:hover,.jeg_footer_content a,.jeg_footer_bottom a,.jeg_cartcontent,.woocommerce .woocommerce-breadcrumb a',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_accent_color',
    'transport'     => 'postMessage',
    'type'          => 'jnews-color',
    'default'       => '#f70d28',
    'label'         => esc_html__('Accent Color', 'jnews'),
    'description'   => esc_html__('Set general accent color.', 'jnews'),
    'output'     => array(
        array(
            /* Accent Color */
            'method'        => 'inject-style',
            'element'       => 'a,.jeg_menu_style_5 > li > a:hover,.jeg_menu_style_5 > li.sfHover > a,.jeg_navbar .jeg_menu:not(.jeg_main_menu) > li > a:hover,.jeg_midbar .jeg_menu:not(.jeg_main_menu) > li > a:hover,.jeg_side_tabs li.active,.jeg_block_heading_5 strong,.jeg_block_heading_6 strong,.jeg_block_heading_7 strong,.jeg_block_heading_8 strong,.jeg_subcat_list li a:hover,.jeg_subcat_list li button:hover,.jeg_pl_lg_7 .jeg_thumb .jeg_post_category a,.jeg_pl_xs_2:before,.jeg_pl_xs_4 .jeg_postblock_content:before,.jeg_postblock .jeg_post_title a:hover,.jeg_hero_style_6 .jeg_post_title a:hover,.jeg_sidefeed .jeg_pl_xs_3 .jeg_post_title a:hover,.widget_jnews_popular .jeg_post_title a:hover,.jeg_meta_author a,.widget_archive li a:hover,.widget_pages li a:hover,.widget_meta li a:hover,.widget_recent_entries li a:hover,.widget_rss li a:hover,.widget_rss cite,.widget_categories li a:hover,.widget_categories li.current-cat > a,#breadcrumbs a:hover,.jeg_share_count .counts,.commentlist .bypostauthor > .comment-body > .comment-author > .fn,span.required,.jeg_review_title,.bestprice .price,.authorlink a:hover,.jeg_vertical_playlist .jeg_video_playlist_play_icon,.jeg_vertical_playlist .jeg_video_playlist_item.active .jeg_video_playlist_thumbnail:before,.jeg_horizontal_playlist .jeg_video_playlist_play,.woocommerce li.product .pricegroup .button,.widget_display_forums li a:hover,.widget_display_topics li:before,.widget_display_replies li:before,.widget_display_views li:before,.bbp-breadcrumb a:hover,.jeg_mobile_menu li.sfHover > a,.jeg_mobile_menu li a:hover',
            'property'      => 'color',
        ),
        array(
            /* Accent Background */
            'method'        => 'inject-style',
            'element'       => '.jeg_menu_style_1 > li > a:before,.jeg_menu_style_2 > li > a:before,.jeg_menu_style_3 > li > a:before,.jeg_side_toggle,.jeg_slide_caption .jeg_post_category a,.jeg_slider_type_1 .owl-nav .owl-next,.jeg_block_heading_1 .jeg_block_title span,.jeg_block_heading_2 .jeg_block_title span,.jeg_block_heading_3,.jeg_block_heading_4 .jeg_block_title span,.jeg_block_heading_6:after,.jeg_pl_lg_box .jeg_post_category a,.jeg_pl_md_box .jeg_post_category a,.jeg_readmore:hover,.jeg_thumb .jeg_post_category a,.jeg_block_loadmore a:hover, .jeg_postblock.alt .jeg_block_loadmore a:hover,.jeg_block_loadmore a.active,.jeg_postblock_carousel_2 .jeg_post_category a,.jeg_heroblock .jeg_post_category a,.jeg_pagenav_1 .page_number.active,.jeg_pagenav_1 .page_number.active:hover,input[type="submit"],.btn,.button,.widget_tag_cloud a:hover,.popularpost_item:hover .jeg_post_title a:before,.jeg_splitpost_4 .page_nav,.jeg_splitpost_5 .page_nav,.jeg_post_tags a:hover,.comment-reply-title small a:before,.comment-reply-title small a:after,.jeg_storelist .productlink,.authorlink li.active a:before,.jeg_footer.dark .socials_widget:not(.nobg) a:hover .fa,.jeg_breakingnews_title,.jeg_overlay_slider_bottom.owl-carousel .owl-nav div,.jeg_overlay_slider_bottom.owl-carousel .owl-nav div:hover,.jeg_vertical_playlist .jeg_video_playlist_current,.woocommerce span.onsale,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.jeg_popup_post .caption,.jeg_footer.dark input[type="submit"],.jeg_footer.dark .btn,.jeg_footer.dark .button,.footer_widget.widget_tag_cloud a:hover',
            'property'      => 'background-color',
        ),
        array(
            /* Accent Border Color */
            'method'        => 'inject-style',
            'element'       => '.jeg_block_heading_7 .jeg_block_title span, .jeg_readmore:hover, .jeg_block_loadmore a:hover, .jeg_block_loadmore a.active, .jeg_pagenav_1 .page_number.active, .jeg_pagenav_1 .page_number.active:hover, .jeg_pagenav_3 .page_number:hover, .jeg_prevnext_post a:hover h3, .jeg_overlay_slider .jeg_post_category, .jeg_sidefeed .jeg_post.active, .jeg_vertical_playlist.jeg_vertical_playlist .jeg_video_playlist_item.active .jeg_video_playlist_thumbnail img, .jeg_horizontal_playlist .jeg_video_playlist_item.active',
            'property'      => 'border-color',
        ),
        array(
            /* Accent Border Color */
            'method'        => 'inject-style',
            'element'       => '.jeg_tabpost_nav li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active',
            'property'      => 'border-bottom-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_alt_color',
    'transport'     => 'postMessage',
    'type'          => 'jnews-color',
    'default'       => '#2e9fff',
    'label'         => esc_html__('Alternate Color', 'jnews'),
    'description'   => esc_html__('Alternate color including post meta icon & floated social share.', 'jnews'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_post_meta .fa, .entry-header .jeg_post_meta .fa, .jeg_review_stars, .jeg_price_review_list',
            'property'      => 'color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_share_button.share-float.share-monocrhome a',
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_heading_color',
    'transport'     => 'postMessage',
    'type'          => 'jnews-color',
    'default'       => '#212121',
    'label'         => esc_html__('Heading Color', 'jnews'),
    'description'   => esc_html__('Post title and other heading elements: H1, H2, H3, H4, H5 and H6.', 'jnews'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => 'h1,h2,h3,h4,h5,h6,.jeg_post_title a,.entry-header .jeg_post_title,.jeg_hero_style_7 .jeg_post_title a,.jeg_block_title,.jeg_splitpost_bar .current_title,.jeg_video_playlist_title,.gallery-caption',
            'property'      => 'color',
        )
    ),
);

return $options;