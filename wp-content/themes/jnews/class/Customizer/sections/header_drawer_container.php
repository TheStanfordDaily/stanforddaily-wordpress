<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_header_mobile_drawer_scheme',
    'transport'     => 'postMessage',
    'default'       => 'normal',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Drawer Scheme','jnews'),
    'description'   => esc_html__('Choose your drawer color scheme.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'normal'        => esc_attr__( 'Normal Style (Light)', 'jnews' ),
        'dark'          => esc_attr__( 'Dark Style', 'jnews' ),
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => '#jeg_off_canvas',
            'property'      => array(
                'normal'            => 'normal',
                'dark'              => 'dark',
            ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_header_mobile_drawer_background_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Background Color','jnews'),
    'description'   => esc_html__('Background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => "#jeg_off_canvas.dark .jeg_mobile_wrapper, #jeg_off_canvas .jeg_mobile_wrapper",
            'property'      => 'background',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mobile_drawer_enable_gradient',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Enable Gradient','jnews'),
    'description'   => esc_html__('Enable mobile drawer gradient','jnews'),
);

$options[] = array(
    'id'            => 'jnews_header_mobile_drawer_gradient',
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
    'description'   => esc_html__('Mobile Drawer gradient color.','jnews'),
    'output'     => array(
        array(
            'method'        => 'gradient',
            'element'       => "#jeg_off_canvas.dark .jeg_mobile_wrapper, #jeg_off_canvas .jeg_mobile_wrapper",
        )
    ),
    'active_callback'   => array(
        array(
            'setting'  => 'jnews_header_mobile_drawer_enable_gradient',
            'operator' => '==',
            'value'    => true,
        )
    ),
);


$options[] = array(
    'id'            => 'jnews_header_mobile_drawer_overlay_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Overlay Color','jnews'),
    'description'   => esc_html__('Background image overlay color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_mobile_wrapper .nav_wrap:before",
            'property'      => 'background',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mobile_drawer_background_image',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-image',
    'label'         => esc_html__('Mobile Drawer Background Image','jnews' ),
    'description'   => esc_html__('Upload your background image.','jnews' ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_mobile_wrapper',
            'property'      => 'background-image',
            'prefix'        => 'url("',
            'suffix'        => '")'
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_mobile_drawer_background_repeat',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Background Repeat', 'jnews'),
    'choices'       => array(
        ''              => '',
        'repeat-x'      => esc_attr__('Repeat Horizontal', 'jnews'),
        'repeat-y'      => esc_attr__('Repeat Vertical', 'jnews'),
        'repeat'        => esc_attr__('Repeat Image', 'jnews'),
        'no-repeat'     => esc_attr__('No Repeat', 'jnews')
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_mobile_wrapper',
            'property'      => 'background-repeat',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_header_mobile_drawer_background_image',
            'operator' => '!=',
            'value'    => '',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_header_mobile_drawer_background_position',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Background Position', 'jnews'),
    'choices'       => array(
        ''              => '',
        'left top'      => esc_attr__('Left Top', 'jnews'),
        'left center'   => esc_attr__('Left Center', 'jnews'),
        'left bottom'   => esc_attr__('Left Bottom', 'jnews'),
        'center top'    => esc_attr__('Center Top', 'jnews'),
        'center center' => esc_attr__('Center Center', 'jnews'),
        'center bottom' => esc_attr__('Center Bottom', 'jnews'),
        'right top'     => esc_attr__('Right Top', 'jnews'),
        'right center'  => esc_attr__('Right Center', 'jnews'),
        'right bottom'  => esc_attr__('Right Bottom', 'jnews'),
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_mobile_wrapper',
            'property'      => 'background-position',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_header_mobile_drawer_background_image',
            'operator' => '!=',
            'value'    => '',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_header_mobile_drawer_background_fixed',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Attachment Background', 'jnews'),
    'choices'       => array(
        ''              => '',
        'fixed'         => esc_attr__('Fixed', 'jnews'),
        'scroll'        => esc_attr__('Scroll', 'jnews')
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_mobile_wrapper',
            'property'      => 'background-attachment',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_header_mobile_drawer_background_image',
            'operator' => '!=',
            'value'    => '',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_header_mobile_drawer_background_size',
    'transport'     => 'postMessage',
    'default'       => 'inherit',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Background Size', 'jnews'),
    'choices'       => array(
        ''              => '',
        'cover'         => esc_attr__('Cover', 'jnews'),
        'contain'       => esc_attr__('Contain', 'jnews'),
        'initial'       => esc_attr__('Initial', 'jnews'),
        'inherit'       => esc_attr__('Inherit', 'jnews')
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_mobile_wrapper',
            'property'      => 'background-size',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_header_mobile_drawer_background_image',
            'operator' => '!=',
            'value'    => '',
        )
    )
);

return $options;