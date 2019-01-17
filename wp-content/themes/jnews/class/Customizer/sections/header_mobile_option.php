<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_mobile_menu_follow',
    'transport'     => 'refresh',
    'default'       => 'scroll',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Menu Following Mode','jnews'),
    'description'   => esc_html__('Choose your navbar menu style.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'fixed'         => esc_attr__( 'Always Follow', 'jnews' ),
        'scroll'        => esc_attr__( 'Follow when Scroll Up', 'jnews' ),
        'pinned'        => esc_attr__( 'Show when Scroll', 'jnews' ),
        'normal'        => esc_attr__( 'No follow', 'jnews' ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mobile_midbar_setting',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Mobile Header - Middle Bar','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_mobile_midbar_scheme',
    'transport'     => 'postMessage',
    'default'       => 'dark',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Middle Bar Scheme','jnews'),
    'description'   => esc_html__('Choose your menu scheme.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'normal'        => esc_attr__( 'Normal Style (Light)', 'jnews' ),
        'dark'          => esc_attr__( 'Dark Style', 'jnews' ),
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.jeg_mobile_bottombar',
            'property'      => array(
                'normal'            => 'normal',
                'dark'              => 'dark',
            ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_header_mobile_midbar_height',
    'transport'     => 'postMessage',
    'default'       => 60,
    'type'          => 'jnews-slider',
    'label'         => esc_html__('Middle Bar Height', 'jnews'),
    'choices'     => array(
        'min'  => '30',
        'max'  => '150',
        'step' => '1',
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_mobile_bottombar',
            'property'      => 'height',
            'units'         => 'px',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_mobile_bottombar',
            'property'      => 'line-height',
            'units'         => 'px',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mobile_midbar_background_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Background Color','jnews'),
    'description'   => esc_html__('Set background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_mobile_midbar, .jeg_mobile_midbar.dark",
            'property'      => 'background',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mobile_midbar_enable_gradient',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Enable Gradient','jnews'),
    'description'   => esc_html__('Enable mobile bar gradient','jnews'),
);

$options[] = array(
    'id'            => 'jnews_header_mobile_midbar_gradient_color',
    'transport'     => 'postMessage',
    'default'       => array(
        'degree'    	    => 90,
        'beginlocation'     => 0,
        'endlocation'    	=> 100,
        'begincolor'      	=> "#dd3333",
        'endcolor'    	    => "#8224e3",
    ),
    'type'          => 'jnews-gradient',
    'label'         => esc_html__('Gradient Color','jnews'),
    'description'   => esc_html__('Mobile middle bar gradient color.','jnews'),
    'output'     => array(
        array(
            'method'        => 'gradient',
            'element'       => ".jeg_mobile_midbar, .jeg_mobile_midbar.dark",
        )
    ),
    'active_callback'   => array(
        array(
            'setting'  => 'jnews_header_mobile_midbar_enable_gradient',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mobile_midbar_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Default Text color','jnews'),
    'description'   => esc_html__('Top bar text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_mobile_midbar, .jeg_mobile_midbar.dark",
            'property'      => 'color',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mobile_midbar_link_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Default Link color','jnews'),
    'description'   => esc_html__('Middle bar link color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_mobile_midbar a, .jeg_mobile_midbar.dark a",
            'property'      => 'color',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mobile_midbar_border_top_height',
    'transport'     => 'postMessage',
    'default'       => 0,
    'type'          => 'jnews-slider',
    'label'         => esc_html__('Bottom Bar Border Height', 'jnews'),
    'choices'     => array(
        'min'           => '0',
        'max'           => '20',
        'step'          => '1',
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_mobile_midbar, .jeg_mobile_midbar.dark',
            'property'      => 'border-top-width',
            'units'         => 'px',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mobile_midbar_border_top_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Mobile Top Bar Border - Top Color','jnews'),
    'description'   => esc_html__('Mobile top border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_mobile_midbar, .jeg_mobile_midbar.dark',
            'property'      => 'border-top-color',
        )
    ),
);

return $options;