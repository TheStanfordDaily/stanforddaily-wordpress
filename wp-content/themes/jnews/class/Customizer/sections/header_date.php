<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_header_date_format',
    'transport'     => 'postMessage',
    'default'       => 'l, F j, Y',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Date format for Header','jnews'),
    'description'   => wp_kses(sprintf(__("Please set your date format for header, for more detail about this format, please refer to
                                <a href='%s' target='_blank'>Developer Codec</a>.", "jnews"), "https://developer.wordpress.org/reference/functions/current_time/"),
        wp_kses_allowed_html()),
    'partial_refresh' => array (
        'jnews_header_date_format' => array (
            'selector'        => '.jeg_top_date',
            'render_callback' => function() {
                return date_i18n( get_theme_mod('jnews_header_date_format', 'l, F j, Y') );
            },
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_date_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Text Color','jnews'),
    'description'   => esc_html__('Date text color.','jnews'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_top_date',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_date_background_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Background Color','jnews'),
    'description'   => esc_html__('Date background color.','jnews'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_top_date',
            'property'      => 'background',
        )
    ),
);

return $options;