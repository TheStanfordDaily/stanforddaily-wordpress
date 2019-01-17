<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_header_account_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Text Color','jnews'),
    'description'   => esc_html__('Account text color.','jnews'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_nav_account,
                                        .jeg_navbar .jeg_nav_account .jeg_menu > li > a,
                                        .jeg_midbar .jeg_nav_account .jeg_menu > li > a',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_account_submenu_background',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Submenu Background','jnews'),
    'description'   => esc_html__('Top bar submenu background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_menu.jeg_accountlink li > ul",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_account_submenu_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Submenu Text Color','jnews'),
    'description'   => esc_html__('Top bar submenu text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_menu.jeg_accountlink li > ul,
                                        .jeg_menu.jeg_accountlink li > ul li > a,
	                                    .jeg_menu.jeg_accountlink li > ul li:hover > a,
	                                    .jeg_menu.jeg_accountlink li > ul li.sfHover > a",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_account_submenu_background_hover_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Submenu Background Hover Color','jnews'),
    'description'   => esc_html__('Top bar menu background hover color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_menu.jeg_accountlink li > ul li:hover > a,
                                        .jeg_menu.jeg_accountlink li > ul li.sfHover > a",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_account_submenu_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Submenu Border Color','jnews'),
    'description'   => esc_html__('Top bar submenu border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_menu.jeg_accountlink li > ul,
                                        .jeg_menu.jeg_accountlink li > ul li a",
            'property'      => 'border-color',
        )
    ),
);

return $options;