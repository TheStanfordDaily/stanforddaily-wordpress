<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_header_html_mobile',
    'transport'     => 'postMessage',
    'sanitize'      => 'jnews_sanitize_by_pass',
    'default'       => '',
    'type'          => 'jnews-textarea',
    'label'         => esc_html__('Mobile HTML','jnews'),
    'description'   => esc_html__('HTML / Shortcode element.','jnews'),
    'partial_refresh' => array (
        'jnews_header_html_mobile' => array (
            'selector'        => '.jeg_navbar_mobile_wrapper',
            'render_callback' => function() {
                get_template_part('fragment/header/mobile-builder');
            },
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_html_1',
    'transport'     => 'postMessage',
    'sanitize'      => 'jnews_sanitize_by_pass',
    'default'       => '',
    'type'          => 'jnews-textarea',
    'label'         => esc_html__('HTML Element 1','jnews'),
    'description'   => esc_html__('HTML / Shortcode element.','jnews'),
    'partial_refresh' => array (
        'jnews_header_html_1' => array (
            'selector'        => '.jeg_header_wrapper',
            'render_callback' => function() {
                get_template_part('fragment/header/desktop-builder');
            },
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_html_2',
    'transport'     => 'postMessage',
    'sanitize'      => 'jnews_sanitize_by_pass',
    'default'       => '',
    'type'          => 'jnews-textarea',
    'label'         => esc_html__('HTML Element 2','jnews'),
    'description'   => esc_html__('HTML / Shortcode element.','jnews'),
    'partial_refresh' => array (
        'jnews_header_html_2' => array (
            'selector'        => '.jeg_header_wrapper',
            'render_callback' => function() {
                get_template_part('fragment/header/desktop-builder');
            },
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_html_3',
    'transport'     => 'postMessage',
    'sanitize'      => 'jnews_sanitize_by_pass',
    'default'       => '',
    'type'          => 'jnews-textarea',
    'label'         => esc_html__('HTML Element 3','jnews'),
    'description'   => esc_html__('HTML / Shortcode element.','jnews'),
    'partial_refresh' => array (
        'jnews_header_html_3' => array (
            'selector'        => '.jeg_header_wrapper',
            'render_callback' => function() {
                get_template_part('fragment/header/desktop-builder');
            },
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_html_4',
    'transport'     => 'postMessage',
    'sanitize'      => 'jnews_sanitize_by_pass',
    'default'       => '',
    'type'          => 'jnews-textarea',
    'label'         => esc_html__('HTML Element 4','jnews'),
    'description'   => esc_html__('HTML / Shortcode element.','jnews'),
    'partial_refresh' => array (
        'jnews_header_html_4' => array (
            'selector'        => '.jeg_header_wrapper',
            'render_callback' => function() {
                get_template_part('fragment/header/desktop-builder');
            },
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_html_5',
    'transport'     => 'postMessage',
    'sanitize'      => 'jnews_sanitize_by_pass',
    'default'       => '',
    'type'          => 'jnews-textarea',
    'label'         => esc_html__('HTML Element 5','jnews'),
    'description'   => esc_html__('HTML / Shortcode element.','jnews'),
    'partial_refresh' => array (
        'jnews_header_html_5' => array (
            'selector'        => '.jeg_header_wrapper',
            'render_callback' => function() {
                get_template_part('fragment/header/desktop-builder');
            },
        )
    ),
);

return $options;