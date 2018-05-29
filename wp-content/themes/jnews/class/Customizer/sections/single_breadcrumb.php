<?php

$show_breadcrumb = array(
    'setting'  => 'jnews_breadcrumb',
    'operator' => '!=',
    'value'    => 'hide',
);


$options = array();

$options[] = array(
    'id'            => 'jnews_breadcrumb',
    'transport'     => 'postMessage',
    'default'       => 'native',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Website Breadcrumb','jnews'),
    'description'   => wp_kses(__('Choose which breadcrumb script you want to use, or you want to hide completely. <br/> Each breadcrumb script will need you to install its respective plugin.','jnews'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'partial_refresh' => array (
        'jnews_breadcrumb_single' => array (
            'selector'        => '.jeg_breadcrumb_container',
            'render_callback' => function() {
                echo jnews_render_breadcrumb();
            },
        ),
    ),
    'choices'       => array(
        'hide'          => esc_attr__( 'Hide Breadcrumb', 'jnews' ),
        'native'        => esc_attr__( 'JNews Native Breadcrumb', 'jnews' ),
        'navxt'         => esc_attr__( 'Navxt Breadcrumb', 'jnews' ),
        'yoast'         => esc_attr__( 'Yoast Breadcrumb', 'jnews' ),
    ),
    'postvar'       => array( array(
        'redirect'  => 'breadcrumb_tag',
        'refresh'   => false
    ) )
);

$options[] = array(
    'id'            => 'jnews_breadcrumb_show_post',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Breadcrumb on Single Post', 'jnews'),
    'description'   => esc_html__('Turn this option off to hide breadcrumb on single post.', 'jnews'),
    'partial_refresh' => array (
        'jnews_breadcrumb_show_post' => array (
            'selector'        => '.jeg_breadcrumb_container',
            'render_callback' => function() {
                echo jnews_render_breadcrumb();
            },
        ),
    ),
    'active_callback'  => array(
        $show_breadcrumb
    ),
    'postvar'       => array( array(
        'redirect'  => 'single_post_tag',
        'refresh'   => false
    ) )
);

$options[] = array(
    'id'            => 'jnews_breadcrumb_show_category',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Breadcrumb on Category Page', 'jnews'),
    'description'   => esc_html__('Turn this option off to hide breadcrumb on category page.', 'jnews'),
    'partial_refresh' => array (
        'jnews_breadcrumb_show_category' => array (
            'selector'        => '.jeg_breadcrumb_container',
            'render_callback' => function() {
                echo jnews_render_breadcrumb();
            },
        ),
    ),
    'active_callback'  => array(
        $show_breadcrumb
    ),
    'postvar'       => array( array(
        'redirect'  => 'category_tag',
        'refresh'   => false
    ) )
);

$options[] = array(
    'id'            => 'jnews_breadcrumb_show_search',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Breadcrumb on Search Result Page', 'jnews'),
    'description'   => esc_html__('Turn this option off to hide breadcrumb on search result page.', 'jnews'),
    'partial_refresh' => array (
        'jnews_breadcrumb_show_search' => array (
            'selector'        => '.jeg_breadcrumb_container',
            'render_callback' => function() {
                echo jnews_render_breadcrumb();
            },
        ),
    ),
    'active_callback'  => array(
        $show_breadcrumb
    ),
    'postvar'       => array( array(
        'redirect'  => 'search_tag',
        'refresh'   => false
    ) )
);

$options[] = array(
    'id'            => 'jnews_breadcrumb_show_author',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Breadcrumb on Author Page', 'jnews'),
    'description'   => esc_html__('Turn this option off to hide breadcrumb on author page.', 'jnews'),
    'partial_refresh' => array (
        'jnews_breadcrumb_show_author' => array (
            'selector'        => '.jeg_breadcrumb_container',
            'render_callback' => function() {
                echo jnews_render_breadcrumb();
            },
        ),
    ),
    'active_callback'  => array(
        $show_breadcrumb
    ),
    'postvar'       => array( array(
        'redirect'  => 'author_tag',
        'refresh'   => false
    ) )
);

$options[] = array(
    'id'            => 'jnews_breadcrumb_show_archive',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Breadcrumb on Archive Page', 'jnews'),
    'description'   => esc_html__('Turn this option off to hide breadcrumb on archive page.', 'jnews'),
    'partial_refresh' => array (
        'jnews_breadcrumb_show_archive' => array (
            'selector'        => '.jeg_breadcrumb_container',
            'render_callback' => function() {
                echo jnews_render_breadcrumb();
            },
        ),
    ),
    'active_callback'  => array(
        $show_breadcrumb
    ),
    'postvar'       => array( array(
        'redirect'  => 'archive_tag',
        'refresh'   => false
    ) )
);

return $options;