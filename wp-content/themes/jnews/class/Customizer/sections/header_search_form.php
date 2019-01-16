<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_header_menu_search_form_style',
    'transport'     => 'postMessage',
    'default'       => 'square',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Search Form Style','jnews'),
    'description'   => esc_html__('Select search form input style.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'square'          => esc_attr__( 'Square', 'jnews' ),
        'rounded'       => esc_attr__( 'Rounded', 'jnews' ),
        'round'       => esc_attr__( 'Round', 'jnews' ),
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.jeg_search_no_expand',
            'property'      => array(
                'square' => 'square',
                'rounded' => 'rounded',
                'round' => 'round',
            ),
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_menu_search_form_width',
    'transport'     => 'postMessage',
    'default'       => 60,
    'type'          => 'jnews-slider',
    'label'         => esc_html__('Form Width', 'jnews'),
    'description'   => esc_html__('Set search input width in percentage.','jnews'),
    'choices'     => array(
        'min'  => '20',
        'max'  => '100',
        'step' => '1',
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_nav_search',
            'property'      => 'width',
            'units'         => '%',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_no_expand_header',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Search Form Color Options','jnews' ),
);

// search - no expand
$options[] = array(
    'id'            => 'jnews_header_menu_search_noexpand_input_background_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Input Background Color','jnews'),
    'description'   => esc_html__('Search input background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_no_expand .jeg_search_form .jeg_search_input',
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_menu_search_noexpand_input_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Input Border Color','jnews'),
    'description'   => esc_html__('Search input border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_no_expand .jeg_search_form .jeg_search_input',
            'property'      => 'border-color',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_menu_search_noexpand_icon_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Icon Color','jnews'),
    'description'   => esc_html__('Search icon color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_no_expand .jeg_search_form button.jeg_search_button',
            'property'      => 'color',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_menu_search_noexpand_input_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Input Text Color','jnews'),
    'description'   => esc_html__('Search input text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_search_wrapper.jeg_search_no_expand .jeg_search_form .jeg_search_input",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_menu_search_noexpand_input_placeholder_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Input Placeholder Color','jnews'),
    'description'   => esc_html__('Search input placeholder color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_no_expand .jeg_search_form .jeg_search_input::-webkit-input-placeholder',
            'property'      => 'color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_no_expand .jeg_search_form .jeg_search_input:-moz-placeholder',
            'property'      => 'color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_no_expand .jeg_search_form .jeg_search_input::-moz-placeholder',
            'property'      => 'color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_no_expand .jeg_search_form .jeg_search_input:-ms-input-placeholder',
            'property'      => 'color',
        ),
    ),
);

/* live search result */
$options[] = array(
    'id'            => 'jnews_header_search_no_expand_result_header',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Live Results Color Options','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_menu_search_noexpand_input_result_background_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Background Color','jnews'),
    'description'   => esc_html__('Live search results background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_no_expand .jeg_search_result',
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_menu_search_noexpand_input_result_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Border Color','jnews'),
    'description'   => esc_html__('Live search results border color','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_no_expand .jeg_search_result,
                                        .jeg_header .jeg_search_no_expand .jeg_search_result .search-link',
            'property'      => 'border-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_menu_search_noexpand_result_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Text Color','jnews'),
    'description'   => esc_html__('Live search results text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_search_no_expand .jeg_search_result a,
                                        .jeg_header .jeg_search_no_expand .jeg_search_result .search-link",
            'property'      => 'color',
        )
    ),
);

return $options;