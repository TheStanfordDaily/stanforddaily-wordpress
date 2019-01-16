<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_header_topbar_menu_desktop',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Desktop - Top Bar Menu','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_menu_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Text Color','jnews'),
    'description'   => esc_html__('Top Bar menu text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jnews .jeg_header .jeg_menu.jeg_top_menu > li > a',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_menu_text_color_hover',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Menu Hover Color','jnews'),
    'description'   => esc_html__('Top bar menu text hover color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jnews .jeg_header .jeg_menu.jeg_top_menu > li a:hover',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_menu_drop_arrow_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Drop Arrow Color','jnews'),
    'description'   => esc_html__('Top bar arrow color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jnews .jeg_top_menu.sf-arrows .sf-with-ul:after',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_menu_background',
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
            'element'       => ".jnews .jeg_menu.jeg_top_menu li > ul",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_submenu_text_color',
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
            'element'       => ".jnews .jeg_menu.jeg_top_menu li > ul,
                                        .jnews .jeg_menu.jeg_top_menu li > ul li > a,
	                                    .jnews .jeg_menu.jeg_top_menu li > ul li:hover > a,
	                                    .jnews .jeg_menu.jeg_top_menu li > ul li.sfHover > a",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_submenu_background_hover_color',
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
            'element'       => ".jnews .jeg_menu.jeg_top_menu li > ul li:hover > a, .jnews .jeg_menu.jeg_top_menu li > ul li.sfHover > a",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_submenu_border_color',
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
            'element'       => ".jnews .jeg_menu.jeg_top_menu li > ul, .jnews .jeg_menu.jeg_top_menu li > ul li a",
            'property'      => 'border-color',
        )
    ),
);

return $options;