<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_header_nav_icon_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Desktop Navigation Icon Color','jnews'),
    'description'   => esc_html__('Desktop nav icon color.','jnews'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_nav_icon .jeg_mobile_toggle.toggle_btn',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_nav_icon_mobilcolor',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Mobile Navigation Icon Color','jnews'),
    'description'   => esc_html__('Mobile nav icon color.','jnews'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_navbar_mobile_wrapper .jeg_nav_item a.jeg_mobile_toggle,
                                        .jeg_navbar_mobile_wrapper .dark .jeg_nav_item a.jeg_mobile_toggle',
            'property'      => 'color',
        )
    ),
);

return $options;