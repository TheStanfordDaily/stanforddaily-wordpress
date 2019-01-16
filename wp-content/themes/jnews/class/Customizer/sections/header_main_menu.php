<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_header_main_menu',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Main Menu Style','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_menu_style',
    'transport'     => 'postMessage',
    'default'       => 'jeg_menu_style_1',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Menu Style','jnews'),
    'description'   => esc_html__('Choose your navbar menu style.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'jeg_menu_style_1' => esc_attr__( 'Style 1', 'jnews' ),
        'jeg_menu_style_2' => esc_attr__( 'Style 2', 'jnews' ),
        'jeg_menu_style_3' => esc_attr__( 'Style 3', 'jnews' ),
        'jeg_menu_style_4' => esc_attr__( 'Style 4', 'jnews' ),
        'jeg_menu_style_5' => esc_attr__( 'Style 5', 'jnews' ),
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.jeg_menu.jeg_main_menu',
            'property'      => array(
                'jeg_menu_style_1'          => 'jeg_menu_style_1',
                'jeg_menu_style_2'          => 'jeg_menu_style_2',
                'jeg_menu_style_3'          => 'jeg_menu_style_3',
                'jeg_menu_style_4'          => 'jeg_menu_style_4',
                'jeg_menu_style_5'          => 'jeg_menu_style_5',
            ),
        ),
    )
);

// text color
$options[] = array(
    'id'            => 'jnews_header_menu_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Menu Text Color','jnews'),
    'description'   => esc_html__('Menu text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_menu.jeg_main_menu > li > a",
            'property'      => 'color',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_menu_hover_line_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Menu Hover Line Color','jnews'),
    'description'   => esc_html__('Menu hover Line color for menu style 1, 2 and 3.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_menu_style_1 > li > a:before,
                                        .jeg_menu_style_2 > li > a:before,
                                        .jeg_menu_style_3 > li > a:before",
            'property'      => 'background',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_menu_hover_background_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Menu Hover Background Color 4','jnews'),
    'description'   => esc_html__('Menu hover background color for menu style 4.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_menu_style_4 > li > a:hover,
                                        .jeg_header .jeg_menu_style_4 > li.sfHover > a,
                                        .jeg_header .jeg_menu_style_4 > li.current-menu-item > a,
                                        .jeg_header .jeg_menu_style_4 > li.current-menu-ancestor > a,
                                        .jeg_navbar_dark .jeg_menu_style_4 > li > a:hover,
                                        .jeg_navbar_dark .jeg_menu_style_4 > li.sfHover > a,
                                        .jeg_navbar_dark .jeg_menu_style_4 > li.current-menu-item > a,
                                        .jeg_navbar_dark .jeg_menu_style_4 > li.current-menu-ancestor > a",
            'property'      => 'background',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_header_menu_style',
            'operator' => '==',
            'value'    => 'jeg_menu_style_4',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_header_menu_hover_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Menu Hover Text Color','jnews'),
    'description'   => esc_html__('Set text color on menu hover.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_menu.jeg_main_menu > li > a:hover,
                                        .jeg_header .jeg_menu.jeg_main_menu > li.sfHover > a,
                                        .jeg_header .jeg_menu.jeg_main_menu > li > .sf-with-ul:hover:after,
                                        .jeg_header .jeg_menu.jeg_main_menu > li.sfHover > .sf-with-ul:after,
                                        .jeg_header .jeg_menu_style_4 > li.current-menu-item > a,
                                        .jeg_header .jeg_menu_style_4 > li.current-menu-ancestor > a,
                                        .jeg_header .jeg_menu_style_5 > li.current-menu-item > a,
                                        .jeg_header .jeg_menu_style_5 > li.current-menu-ancestor > a",
            'property'      => 'color',
        )
    ),
);

// Submenu
$options[] = array(
    'id'            => 'jnews_header_main_submenu',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Main Submenu Style','jnews' ),
);

// icon drop color
$options[] = array(
    'id'            => 'jnews_header_submenu_icon_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Submenu Arrow Icon Color','jnews'),
    'description'   => esc_html__('Menu arrow drop icon color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_navbar_wrapper .sf-arrows .sf-with-ul:after",
            'property'      => 'color',
        )
    ),
);

// drop background
$options[] = array(
    'id'            => 'jnews_header_submenu_background',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Submenu Background Color','jnews'),
    'description'   => esc_html__('Submenu background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_navbar_wrapper .jeg_menu li > ul",
            'property'      => 'background',
        )
    ),
);

// drop text color
$options[] = array(
    'id'            => 'jnews_header_submenu_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Submenu Text Color','jnews'),
    'description'   => esc_html__('Submenu text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_navbar_wrapper .jeg_menu li > ul li > a",
            'property'      => 'color',
        )
    ),
);

// drop background hover
$options[] = array(
    'id'            => 'jnews_header_submenu_hover_background_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Submenu Hover Background Color','jnews'),
    'description'   => esc_html__('Submenu hover background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_navbar_wrapper .jeg_menu li > ul li:hover > a,
                                        .jeg_navbar_wrapper .jeg_menu li > ul li.sfHover > a,
                                        .jeg_navbar_wrapper .jeg_menu li > ul li.current-menu-item > a,
                                        .jeg_navbar_wrapper .jeg_menu li > ul li.current-menu-ancestor > a",
            'property'      => 'background',
        )
    ),
);
$options[] = array(
    'id'            => 'jnews_header_submenu_hover_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Submenu Hover Text Color','jnews'),
    'description'   => esc_html__('Submenu Hover text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_navbar_wrapper .jeg_menu li > ul li:hover > a,
                                        .jeg_navbar_wrapper .jeg_menu li > ul li.sfHover > a,
                                        .jeg_navbar_wrapper .jeg_menu li > ul li.current-menu-item > a,
                                        .jeg_navbar_wrapper .jeg_menu li > ul li.current-menu-ancestor > a,
                                        .jeg_navbar_wrapper .jeg_menu li > ul li:hover > .sf-with-ul:after,
                                        .jeg_navbar_wrapper .jeg_menu li > ul li.sfHover > .sf-with-ul:after,
                                        .jeg_navbar_wrapper .jeg_menu li > ul li.current-menu-item > .sf-with-ul:after,
                                        .jeg_navbar_wrapper .jeg_menu li > ul li.current-menu-ancestor > .sf-with-ul:after",
            'property'      => 'color',
        )
    ),
);

// drop border color
$options[] = array(
    'id'            => 'jnews_header_submenu_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Submenu Border Color','jnews'),
    'description'   => esc_html__('Submenu border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_navbar_wrapper .jeg_menu li > ul li a",
            'property'      => 'border-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_header',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Mega Menu','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_subcat_newsfeed_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Subcategory News Feed Background Color','jnews'),
    'description'   => esc_html__('Subcategory news feed background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_subcat",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_subcat_newsfeed_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Subcategory News Feed Border Color','jnews'),
    'description'   => esc_html__('Subcategory news feed border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_subcat",
            'property'      => 'border-right-color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_subcat li.active",
            'property'      => 'border-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_subcat_newsfeed_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Subcategory News Feed Text Color','jnews'),
    'description'   => esc_html__('Subcategory news feed text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_navbar_wrapper .jeg_megamenu .sub-menu .jeg_newsfeed_subcat li a",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_subcat_newsfeed_hover_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Subcategory News Feed Hover Text Color','jnews'),
    'description'   => esc_html__('Subcategory news feed hover text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_subcat li.active a",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_subcat_newsfeed_hover_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Subcategory News Feed Hover Background Color','jnews'),
    'description'   => esc_html__('Subcategory news feed hover background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_subcat li.active",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('News Feed Background Color','jnews'),
    'description'   => esc_html__('News feed background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_overlay_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('News Feed Overlay Background Color','jnews'),
    'description'   => esc_html__('News feed overlay background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .newsfeed_overlay",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_preloader_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('News Feed Preloader Color','jnews'),
    'description'   => esc_html__('News feed preloader color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .newsfeed_overlay .jeg_preloader span",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('News Feed Text Color','jnews'),
    'description'   => esc_html__('News feed text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_list .jeg_newsfeed_item .jeg_post_title a",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_tags_heading_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Tags Heading Color','jnews'),
    'description'   => esc_html__('Trending tags heading text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_newsfeed_tags h3",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_tags_list_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Tags List Color','jnews'),
    'description'   => esc_html__('Trending tags list text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_navbar_wrapper .jeg_newsfeed_tags li a",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_tags_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Separator Border Color','jnews'),
    'description'   => esc_html__('Trending tags separator border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_newsfeed_tags",
            'property'      => 'border-left-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_arrow_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Nav Arrow Color','jnews'),
    'description'   => esc_html__('News feed nav arrow color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_list .newsfeed_carousel.owl-carousel .owl-nav div",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_arrow_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Nav Arrow Background Color','jnews'),
    'description'   => esc_html__('News feed nav arrow Background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_list .newsfeed_carousel.owl-carousel .owl-nav div",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_arrow_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Nav Arrow Border Color','jnews'),
    'description'   => esc_html__('News feed nav arrow border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_list .newsfeed_carousel.owl-carousel .owl-nav div",
            'property'      => 'border-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_arrow_hover_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Nav Arrow Hover Color','jnews'),
    'description'   => esc_html__('News feed nav arrow hover color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_list .newsfeed_carousel.owl-carousel .owl-nav div:hover",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_arrow_hover_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Nav Arrow Hover Background Color','jnews'),
    'description'   => esc_html__('News feed nav arrow hover Background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_list .newsfeed_carousel.owl-carousel .owl-nav div:hover",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_arrow_hover_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Nav Arrow Hover Border Color','jnews'),
    'description'   => esc_html__('News feed nav arrow hover border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_list .newsfeed_carousel.owl-carousel .owl-nav div:hover",
            'property'      => 'border-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_arrow_disabled_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Nav Arrow Disabled Color','jnews'),
    'description'   => esc_html__('News feed nav arrow disabled color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_list .newsfeed_carousel.owl-carousel .owl-nav div.disabled",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_arrow_disabled_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Nav Arrow Disabled Background Color','jnews'),
    'description'   => esc_html__('News feed nav arrow disabled Background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_list .newsfeed_carousel.owl-carousel .owl-nav div.disabled",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mega_menu_newsfeed_arrow_disabled_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Nav Arrow Disabled Border Color','jnews'),
    'description'   => esc_html__('News feed nav arrow disabled border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_megamenu .sub-menu .jeg_newsfeed_list .newsfeed_carousel.owl-carousel .owl-nav div.disabled",
            'property'      => 'border-color',
        )
    ),
);

return $options;