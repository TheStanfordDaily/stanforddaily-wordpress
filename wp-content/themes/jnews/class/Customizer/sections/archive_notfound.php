<?php

$options = array();

$all_sidebar = apply_filters('jnews_get_sidebar_widget', null);

// sidebar section
$options[] = array(
    'id'            => 'jnews_404_sidebar_section',
    'type'          => 'jnews-header',
    'label'         => esc_html__('404 Page Layout','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_404_page_layout',
    'transport'     => 'postMessage',
    'default'       => 'right-sidebar',
    'type'          => 'jnews-radio-image',
    'label'         => esc_html__('Page Layout','jnews' ),
    'description'   => esc_html__('Choose your page layout.','jnews' ),
    'choices'       => array(
        'right-sidebar'         => '',
        'left-sidebar'          => '',
        'right-sidebar-narrow'  => '',
        'left-sidebar-narrow'   => '',
        'double-sidebar'        => '',
        'double-right-sidebar'  => '',
        'no-sidebar'            => ''
    ),
    'postvar'       => array(
        array(
            'redirect'  => '404_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_404_sidebar',
    'transport'     => 'postMessage',
    'default'       => 'default-sidebar',
    'type'          => 'jnews-select',
    'label'         => esc_html__('404 Page Sidebar','jnews'),
    'description'   => wp_kses(__("Choose your 404 page sidebar. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'       => $all_sidebar,
    'postvar'       => array(
        array(
            'redirect'  => '404_tag',
            'refresh'   => true
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_404_page_layout',
            'operator' => '!=',
            'value'    => 'no-sidebar',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_404_second_sidebar',
    'transport'     => 'postMessage',
    'default'       => 'default-sidebar',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Second 404 Page Sidebar','jnews'),
    'description'   => wp_kses(__("Choose your second sidebar for 404 page. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'       => $all_sidebar,
    'postvar'       => array(
        array(
            'redirect'  => '404_tag',
            'refresh'   => true
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_404_page_layout',
            'operator' => 'in',
            'value'    => array('double-sidebar', 'double-right-sidebar'),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_404_sticky_sidebar',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('404 Page Sticky Sidebar','jnews'),
    'description'   => esc_html__('Enable sticky sidebar.','jnews'),
    'postvar'       => array(
        array(
            'redirect'  => '404_tag',
            'refresh'   => true
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_404_page_layout',
            'operator' => '!=',
            'value'    => 'no-sidebar',
        )
    ),
);

// content type
$options[] = array(
    'id'            => 'jnews_404_content_section',
    'type'          => 'jnews-header',
    'label'         => esc_html__('404 Page Content','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_404_content',
    'transport'     => 'postMessage',
    'default'       => '3',
    'type'          => 'jnews-radio-image',
    'label'         => esc_html__('Not found Content Layout','jnews'),
    'description'   => esc_html__('Choose your Not found content layout.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        '3'  => '',
        '4'  => '',
        '5'  => '',
        '6'  => '',
        '7'  => '',
        '9'  => '',
        '10' => '',
        '11' => '',
        '12' => '',
        '14' => '',
        '15' => '',
        '18' => '',
        '22' => '',
        '23' => '',
        '25' => '',
        '26' => '',
        '27' => '',
    ),
    'partial_refresh' => array (
        'jnews_404_content' => array (
            'selector'        => '.jnews_404_content_wrapper',
            'render_callback' => function() {
                $single = new \JNews\Archive\NotFoundArchive();
                echo jnews_sanitize_output($single->render_content());
            },
        )
    ),
    'postvar'       => array( array(
        'redirect'  => '404_tag',
        'refresh'   => false
    ) )
);

$options[] = array(
    'id'            => 'jnews_404_content_excerpt',
    'transport'     => 'postMessage',
    'default'       => 20,
    'type'          => 'jnews-number',
    'label'         => esc_html__('Excerpt Length', 'jnews'),
    'description'   => esc_html__('Set the word length of excerpt on post.', 'jnews'),
    'choices'     => array(
        'min'  => '0',
        'max'  => '200',
        'step' => '1',
    ),
    'partial_refresh' => array (
        'jnews_404_content_excerpt' => array (
            'selector'        => '.jnews_404_content_wrapper',
            'render_callback' => function() {
                $single = new \JNews\Archive\NotFoundArchive();
                echo jnews_sanitize_output($single->render_content());
            },
        )
    ),
    'postvar'       => array( array(
        'redirect'  => '404_tag',
        'refresh'   => false
    ) )
);

$options[] = array(
    'id'            => 'jnews_404_content_date',
    'transport'     => 'postMessage',
    'default'       => 'default',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Content Date Format','jnews'),
    'description'   => esc_html__('Choose which date format you want to use for author for content.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'ago' => esc_attr__( 'Relative Date/Time Format (ago)', 'jnews' ),
        'default' => esc_attr__( 'WordPress Default Format', 'jnews' ),
        'custom' => esc_attr__( 'Custom Format', 'jnews' ),
    ),
    'partial_refresh' => array (
        'jnews_404_content_date' => array (
            'selector'        => '.jnews_404_content_wrapper',
            'render_callback' => function() {
                $single = new \JNews\Archive\NotFoundArchive();
                echo jnews_sanitize_output($single->render_content());
            },
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => '404_tag',
            'refresh'   => false
        )
    )
);

$options[] = array(
    'id'            => 'jnews_404_content_date_custom',
    'transport'     => 'postMessage',
    'default'       => 'Y/m/d',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Custom Date Format for Content','jnews'),
    'description'   => wp_kses(sprintf(__("Please set custom date format for post content. For more detail about this format, please refer to
                                <a href='%s' target='_blank'>Developer Codex</a>.", "jnews"), "https://developer.wordpress.org/reference/functions/current_time/"),
        wp_kses_allowed_html()),
    'postvar'       => array(
        array(
            'redirect'  => '404_tag',
            'refresh'   => false
        )
    ),
    'partial_refresh' => array (
        'jnews_404_content_date_custom' => array (
            'selector'        => '.jnews_404_content_wrapper',
            'render_callback' => function() {
                $single = new \JNews\Archive\NotFoundArchive();
                echo jnews_sanitize_output($single->render_content());
            },
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_404_content_date',
            'operator' => '==',
            'value'    => 'custom',
        )
    ),
);

return $options;