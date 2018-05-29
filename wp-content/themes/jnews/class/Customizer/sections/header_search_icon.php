<?php

$options = array();


$options[] = array(
    'id'            => 'jnews_header_search_icon',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Desktop - Search Icon','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_search_style',
    'transport'     => 'postMessage',
    'default'       => 'jeg_search_popup_expand',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Search Style','jnews'),
    'description'   => esc_html__('Choose your navbar search style.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'jeg_search_modal_expand'       => esc_attr__( 'Modal Expand', 'jnews' ),
        'jeg_search_popup_expand'       => esc_attr__( 'Popup Expand', 'jnews' ),
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.jeg_header .jeg_search_wrapper.search_icon',
            'property'      => array(
                'jeg_search_modal_expand'               => 'jeg_search_modal_expand',
                'jeg_search_popup_expand'               => 'jeg_search_popup_expand',
            ),
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_icon_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Icon Color','jnews'),
    'description'   => esc_html__('Set color of search icon.','jnews'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_wrapper.search_icon .jeg_search_toggle',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_popup_style',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Desktop - Popup Drop Style','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_search_popup_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Background Color','jnews'),
    'description'   => esc_html__('Set search header background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_wrapper.jeg_search_popup_expand .jeg_search_form,
                                        .jeg_header .jeg_search_popup_expand .jeg_search_result',
            'property'      => 'background',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_expanded .jeg_search_popup_expand .jeg_search_form:before',
            'property'      => 'border-bottom-color',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_popup_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Border Color','jnews'),
    'description'   => esc_html__('Set search outer border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_wrapper.jeg_search_popup_expand .jeg_search_form,
                                        .jeg_header .jeg_search_popup_expand .jeg_search_result,
                                        .jeg_header .jeg_search_popup_expand .jeg_search_result .search-noresult,
                                        .jeg_header .jeg_search_popup_expand .jeg_search_result .search-all-button',
            'property'      => 'border-color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_expanded .jeg_search_popup_expand .jeg_search_form:after',
            'property'      => 'border-bottom-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_popup_input_background_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Input Background Color','jnews'),
    'description'   => esc_html__('Set search input background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_wrapper.jeg_search_popup_expand .jeg_search_form .jeg_search_input',
            'property'      => 'background',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_popup_input_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Input Border Color','jnews'),
    'description'   => esc_html__('Set search input border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_wrapper.jeg_search_popup_expand .jeg_search_form .jeg_search_input',
            'property'      => 'border-color',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_popup_icon_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Icon Color','jnews'),
    'description'   => esc_html__('Set search icon color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_search_popup_expand .jeg_search_form .jeg_search_button",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_popup_input_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Input Text Color','jnews'),
    'description'   => esc_html__('Set search input text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_search_wrapper.jeg_search_popup_expand .jeg_search_form .jeg_search_input,
                                        .jeg_header .jeg_search_popup_expand .jeg_search_result a,
                                        .jeg_header .jeg_search_popup_expand .jeg_search_result .search-link",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_popup_placeholder_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Placeholder Color','jnews'),
    'description'   => esc_html__('Set search placeholder color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_search_popup_expand .jeg_search_form .jeg_search_input::-webkit-input-placeholder",
            'property'      => 'color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_search_popup_expand .jeg_search_form .jeg_search_input:-moz-placeholder",
            'property'      => 'color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_search_popup_expand .jeg_search_form .jeg_search_input::-moz-placeholder",
            'property'      => 'color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_search_popup_expand .jeg_search_form .jeg_search_input:-ms-input-placeholder",
            'property'      => 'color',
        )
    ),
);

/* live search result */
$options[] = array(
    'id'            => 'jnews_header_search_popup_result_header',
    'type'          => 'jnews-header',
    'label'        => esc_html__('Desktop - Live Results','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_search_popup_result_input_bg_color',
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
            'element'       => '.jeg_header .jeg_search_popup_expand .jeg_search_result',
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_popup_result_input_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Border Color','jnews'),
    'description'   => esc_html__('Live search results border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_popup_expand .jeg_search_result,
                                        .jeg_header .jeg_search_popup_expand .jeg_search_result .search-link',
            'property'      => 'border-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_popup_result_text_color',
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
            'element'       => ".jeg_header .jeg_search_popup_expand .jeg_search_result a,
                                        .jeg_header .jeg_search_popup_expand .jeg_search_result .search-link",
            'property'      => 'color',
        )
    ),
);


$options[] = array(
    'id'            => 'jnews_header_search_modal_style',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Desktop - Modal Style','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_search_modal_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Modal Color','jnews'),
    'description'   => esc_html__('Search modal color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_search_expanded .jeg_search_modal_expand .jeg_search_toggle i,
                                        .jeg_header .jeg_search_expanded .jeg_search_modal_expand .jeg_search_button,
                                        .jeg_header .jeg_search_expanded .jeg_search_modal_expand .jeg_search_input",
            'property'      => 'color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_search_expanded .jeg_search_modal_expand .jeg_search_input",
            'property'      => 'border-bottom-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_modal_input_placeholder_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Modal Input Placeholder Color','jnews'),
    'description'   => esc_html__('Search modal input placeholder color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_expanded .jeg_search_modal_expand .jeg_search_input::-webkit-input-placeholder',
            'property'      => 'color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_expanded .jeg_search_modal_expand .jeg_search_input:-moz-placeholder',
            'property'      => 'color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_expanded .jeg_search_modal_expand .jeg_search_input::-moz-placeholder',
            'property'      => 'color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_search_expanded .jeg_search_modal_expand .jeg_search_input:-ms-input-placeholder',
            'property'      => 'color',
        ),
    )
);

$options[] = array(
    'id'            => 'jnews_header_search_modal_background',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Modal Background Color','jnews'),
    'description'   => esc_html__('Search modal background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_search_expanded .jeg_search_modal_expand",
            'property'      => 'background',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_icon_mobile',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Mobile - Search Icon','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_search_mobile_icon_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search icon color','jnews'),
    'description'   => esc_html__('Color of search icon.','jnews'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_navbar_mobile .jeg_search_wrapper .jeg_search_toggle,
                                        .jeg_navbar_mobile .dark .jeg_search_wrapper .jeg_search_toggle',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_icon_mobile_popup',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Mobile - Popup Drop Style','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_search_mobile_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Background Color','jnews'),
    'description'   => esc_html__('Search header background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_navbar_mobile .jeg_search_popup_expand .jeg_search_form,
                                        .jeg_navbar_mobile .jeg_search_popup_expand .jeg_search_result',
            'property'      => 'background',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_navbar_mobile .jeg_search_expanded .jeg_search_popup_expand .jeg_search_toggle:before',
            'property'      => 'border-bottom-color',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_mobile_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Border Color','jnews'),
    'description'   => esc_html__('Search outer border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_navbar_mobile .jeg_search_wrapper.jeg_search_popup_expand .jeg_search_form,
                                        .jeg_navbar_mobile .jeg_search_popup_expand .jeg_search_result,
                                        .jeg_navbar_mobile .jeg_search_popup_expand .jeg_search_result .search-noresult,
                                        .jeg_navbar_mobile .jeg_search_popup_expand .jeg_search_result .search-all-button',
            'property'      => 'border-color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_navbar_mobile .jeg_search_expanded .jeg_search_popup_expand .jeg_search_toggle:after',
            'property'      => 'border-bottom-color',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_mobile_input_background_color',
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
            'element'       => '.jeg_navbar_mobile .jeg_search_popup_expand .jeg_search_form .jeg_search_input',
            'property'      => 'background',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_mobile_input_border_color',
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
            'element'       => '.jeg_navbar_mobile .jeg_search_popup_expand .jeg_search_form .jeg_search_input',
            'property'      => 'border-color',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_mobile_popup_icon_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Icon Color','jnews'),
    'description'   => esc_html__('Popup search icon color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_navbar_mobile .jeg_search_popup_expand .jeg_search_form .jeg_search_button',
            'property'      => 'color',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_mobile_input_color',
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
            'element'       => ".jeg_navbar_mobile .jeg_search_wrapper.jeg_search_popup_expand .jeg_search_form .jeg_search_input,
                                        .jeg_navbar_mobile .jeg_search_popup_expand .jeg_search_result a,
                                        .jeg_navbar_mobile .jeg_search_popup_expand .jeg_search_result .search-link",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_search_mobile_placeholder_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Search Placeholder Color','jnews'),
    'description'   => esc_html__('Set search placeholder text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_navbar_mobile .jeg_search_popup_expand .jeg_search_input::-webkit-input-placeholder",
            'property'      => 'color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_navbar_mobile .jeg_search_popup_expand .jeg_search_input:-moz-placeholder",
            'property'      => 'color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_navbar_mobile .jeg_search_popup_expand .jeg_search_input::-moz-placeholder",
            'property'      => 'color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_navbar_mobile .jeg_search_popup_expand .jeg_search_input:-ms-input-placeholder",
            'property'      => 'color',
        )
    ),
);

return $options;