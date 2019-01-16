<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_header_width',
    'transport'     => 'postMessage',
    'default'       => 'normal',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Desktop Header Width','jnews'),
    'description'   => esc_html__('Choose header container width.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'normal'        => esc_attr__( 'Normal', 'jnews' ),
        'full'          => esc_attr__( 'Fullwidth', 'jnews' )
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.jeg_header_wrapper .jeg_header',
            'property'      => array(
                'normal'            => 'normal',
                'full'              => 'full',
            )
        ),
    )
);

// Setting
$options[] = array(
    'id'            => 'jnews_header_topbar_setting',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Desktop Header - Topbar ','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_height',
    'transport'     => 'postMessage',
    'default'       => 36,
    'type'          => 'jnews-slider',
    'label'         => esc_html__('Top Bar Height', 'jnews'),
    'choices'     => array(
        'min'  => '20',
        'max'  => '150',
        'step' => '1',
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_topbar .jeg_nav_row, .jeg_topbar .jeg_search_no_expand .jeg_search_input',
            'property'      => 'line-height',
            'units'         => 'px',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_topbar .jeg_nav_row, .jeg_topbar .jeg_nav_icon',
            'property'      => 'height',
            'units'         => 'px',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_scheme',
    'transport'     => 'postMessage',
    'default'       => 'dark',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Top Bar Scheme','jnews'),
    'description'   => esc_html__('Choose your top bar menu scheme.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'normal'        => esc_attr__( 'Normal Style (Light)', 'jnews' ),
        'dark'          => esc_attr__( 'Dark Style', 'jnews' ),
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.jeg_topbar',
            'property'      => array(
                'normal'            => 'normal',
                'dark'              => 'dark',
            )
        ),
    )
);

$options[] = array(
    'id'            => 'jnews_header_topbar_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Background Color','jnews'),
    'description'   => esc_html__('Top bar background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_topbar, .jeg_topbar.dark, .jeg_topbar.custom',
            'property'      => 'background',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_enable_gradient',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Enable Gradient','jnews'),
    'description'   => esc_html__('Enable top bar gradient','jnews'),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_gradient',
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
    'description'   => esc_html__('Top bar gradient color.','jnews'),
    'output'     => array(
        array(
            'method'        => 'gradient',
            'element'       => '.jeg_topbar, .jeg_topbar.dark, .jeg_topbar.custom',
        )
    ),
    'active_callback'   => array(
        array(
            'setting'  => 'jnews_header_topbar_enable_gradient',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_border_bottom',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Border Bottom','jnews'),
    'description'   => esc_html__('Top bar border bottom color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_topbar, .jeg_topbar.dark',
            'property'      => 'border-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_side_border',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Side Border','jnews'),
    'description'   => esc_html__('Top bar side border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_topbar .jeg_nav_item, .jeg_topbar.dark .jeg_nav_item",
            'property'      => 'border-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Default Text Color','jnews'),
    'description'   => esc_html__('Top bar default text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_topbar, .jeg_topbar.dark",
            'property'      => 'color',
        )
    ),
);


$options[] = array(
    'id'            => 'jnews_header_topbar_link_color_hover',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Default Link Color','jnews'),
    'description'   => esc_html__('Top bar default link color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_topbar a, .jeg_topbar.dark a',
            'property'      => 'color',
        )
    ),
);


$options[] = array(
    'id'            => 'jnews_header_topbar_border_top_height',
    'transport'     => 'postMessage',
    'default'       => 0,
    'type'          => 'jnews-slider',
    'label'         => esc_html__('Top Bar Border - Top Height', 'jnews'),
    'description'   => esc_html__('Border height in px.','jnews'),
    'choices'     => array(
        'min'           => '0',
        'max'           => '20',
        'step'          => '1',
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_topbar, .jeg_topbar.dark',
            'property'      => 'border-top-width',
            'units'         => 'px',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_topbar_border_top_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Top Bar Border - Top Color','jnews'),
    'description'   => esc_html__('Top bar border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_topbar, .jeg_topbar.dark',
            'property'      => 'border-top-color',
        )
    ),
);


$options[] = array(
    'id'            => 'jnews_header_midbar_setting',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Desktop Header - Middle Bar','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_midbar_height',
    'transport'     => 'postMessage',
    'default'       => 130,
    'type'          => 'jnews-slider',
    'label'         => esc_html__('Middle Bar Height', 'jnews'),
    'choices'     => array(
        'min'  => '50',
        'max'  => '350',
        'step' => '1',
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_midbar',
            'property'      => 'height',
            'units'         => 'px',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_midbar_scheme',
    'transport'     => 'postMessage',
    'default'       => 'normal',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Middle Bar Scheme','jnews'),
    'description'   => esc_html__('Choose your middle bar scheme.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'normal'        => esc_attr__( 'Normal Style (Light)', 'jnews' ),
        'dark'          => esc_attr__( 'Dark Style', 'jnews' )
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.jeg_midbar',
            'property'      => array(
                'normal'            => 'normal',
                'dark'              => 'dark',
            )
        ),
    )
);

$options[] = array(
    'id'            => 'jnews_header_midbar_background',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Middle Bar Background Color','jnews'),
    'description'   => esc_html__('Change color of middle bar, you can also use another transparent color for this background.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_midbar, .jeg_midbar.dark',
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_midbar_enable_gradient',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Enable Gradient','jnews'),
    'description'   => esc_html__('Enable top bar gradient','jnews'),
);

$options[] = array(
    'id'            => 'jnews_header_midbar_gradient',
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
    'description'   => esc_html__('Middle Bar gradient color.','jnews'),
    'output'     => array(
        array(
            'method'        => 'gradient',
            'element'       => '.jeg_midbar, .jeg_midbar.dark',
        )
    ),
    'active_callback'   => array(
        array(
            'setting'  => 'jnews_header_midbar_enable_gradient',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_midbar_background_image',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-image',
    'label'         => esc_html__('Middle Bar Background Image','jnews' ),
    'description'   => esc_html__('Upload your background image.','jnews' ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_midbar',
            'property'      => 'background-image',
            'prefix'        => 'url("',
            'suffix'        => '")'
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_midbar_background_repeat',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Background Repeat', 'jnews'),
    'choices'       => array(
        ''              => '',
        'repeat-x'      => 'Repeat Horizontal',
        'repeat-y'      => 'Repeat Vertical',
        'repeat'        => 'Repeat Image',
        'no-repeat'     => 'No Repeat'
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_midbar',
            'property'      => 'background-repeat',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_header_midbar_background_image',
            'operator' => '!=',
            'value'    => '',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_header_midbar_background_position',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Background Position', 'jnews'),
    'choices'       => array(
        ''                  => '',
        'left top'         => 'Left Top',
        'left center'       => 'Left Center',
        'left bottom'        => 'Left Bottom',
        'center top'       => 'Center Top',
        'center center'     => 'Center Center',
        'center bottom'      => 'Center Bottom',
        'right top'        => 'Right Top',
        'right center'      => 'Right Center',
        'right bottom'       => 'Right Bottom',
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_midbar',
            'property'      => 'background-position',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_header_midbar_background_image',
            'operator' => '!=',
            'value'    => '',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_header_midbar_background_fixed',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Attachment Background', 'jnews'),
    'choices'       => array(
        ''              => '',
        'fixed'         => 'Fixed',
        'scroll'        => 'Scroll'
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_midbar',
            'property'      => 'background-attachment',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_header_midbar_background_image',
            'operator' => '!=',
            'value'    => '',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_header_midbar_background_size',
    'transport'     => 'postMessage',
    'default'       => 'inherit',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Background Size', 'jnews'),
    'choices'       => array(
        ''              => '',
        'cover'         => 'Cover',
        'contain'       => 'Contain',
        'initial'       => 'Initial',
        'inherit'       => 'Inherit'
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_midbar',
            'property'      => 'background-size',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_header_midbar_background_image',
            'operator' => '!=',
            'value'    => '',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_header_midbar_border_bottom_height',
    'transport'     => 'postMessage',
    'default'       => 0,
    'type'          => 'jnews-slider',
    'label'         => esc_html__('Middle Bar Border - Bottom Height', 'jnews'),
    'description'   => esc_html__('Border height in px.','jnews'),
    'choices'     => array(
        'min'           => '0',
        'max'           => '20',
        'step'          => '1',
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_midbar, .jeg_midbar.dark',
            'property'      => 'border-bottom-width',
            'units'         => 'px',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_midbar_border_bottom_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Middle Bar Border - Bottom Color','jnews'),
    'description'   => esc_html__('Midbar bar border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_midbar, .jeg_midbar.dark',
            'property'      => 'border-bottom-color',
        )
    ),
);



$options[] = array(
    'id'            => 'jnews_header_mid_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Default Text Color','jnews'),
    'description'   => esc_html__('Middle bar text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_midbar, .jeg_midbar.dark",
            'property'      => 'color',
        )
    ),
);


$options[] = array(
    'id'            => 'jnews_header_mid_link_color_hover',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Default Link Color','jnews'),
    'description'   => esc_html__('Middle bar link color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_midbar a, .jeg_midbar.dark a',
            'property'      => 'color',
        )
    ),
);


// Field
$options[] = array(
    'id'            => 'jnews_header_bottombar_setting',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Desktop Header - Bottom Bar','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_height',
    'transport'     => 'postMessage',
    'default'       => 50,
    'type'          => 'jnews-slider',
    'label'         => esc_html__('Bottom Bar Height', 'jnews'),
    'choices'     => array(
        'min'  => '30',
        'max'  => '150',
        'step' => '1',
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_bottombar.jeg_navbar,.jeg_bottombar .jeg_nav_icon',
            'property'      => 'height',
            'units'         => 'px',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_bottombar.jeg_navbar,
                                        .jeg_header .jeg_bottombar .jeg_main_menu:not(.jeg_menu_style_1) > li > a,
                                        .jeg_header .jeg_bottombar .jeg_menu_style_1 > li,
                                        .jeg_header .jeg_bottombar .jeg_menu:not(.jeg_main_menu) > li > a',
            'property'      => 'line-height',
            'units'         => 'px',
        )
    ),
);


$options[] = array(
    'id'            => 'jnews_header_bottombar_boxed',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Boxed Navbar','jnews'),
    'description'   => esc_html__('Enable this option and convert nav bar into boxed.','jnews'),
    'output'     => array(
        array(
            'method'        => 'add-class',
            'element'       => '.jeg_header .jeg_navbar_wrapper',
            'property'      => 'jeg_navbar_boxed',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_fitwidth',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Fit Width Navbar','jnews'),
    'description'   => esc_html__('Enable this option and nav bar will have fit width effect.','jnews'),
    'output'     => array(
        array(
            'method'        => 'add-class',
            'element'       => '.jeg_header .jeg_navbar_wrapper',
            'property'      => 'jeg_navbar_fitwidth',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_border',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Navbar Border','jnews'),
    'description'   => esc_html__('Enable this option and nav bar will have border around it.','jnews'),
    'output'     => array(
        array(
            'method'        => 'add-class',
            'element'       => '.jeg_header .jeg_navbar_wrapper',
            'property'      => 'jeg_navbar_menuborder',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_shadow',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Navbar Shadow','jnews'),
    'description'   => esc_html__('Enable this option and nav bar will have shadow around it.','jnews'),
    'output'     => array(
        array(
            'method'        => 'add-class',
            'element'       => '.jeg_header .jeg_navbar_wrapper',
            'property'      => 'jeg_navbar_shadow',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_scheme',
    'transport'     => 'postMessage',
    'default'       => 'jeg_navbar_normal',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Menu Scheme','jnews'),
    'description'   => esc_html__('Choose your menu scheme.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'jeg_navbar_normal'        => esc_attr__( 'Normal Style (Light)', 'jnews' ),
        'jeg_navbar_dark'          => esc_attr__( 'Dark Style', 'jnews' ),
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.jeg_header .jeg_navbar_wrapper',
            'property'      => array(
                'jeg_navbar_normal'            => 'jeg_navbar_normal',
                'jeg_navbar_dark'              => 'jeg_navbar_dark',
            ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_background_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Bottom Bar Background Color','jnews'),
    'description'   => esc_html__('Bottom bar background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_navbar_wrapper:not(.jeg_navbar_boxed), .jeg_header .jeg_navbar_boxed .jeg_nav_row",
            'property'      => 'background',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_enable_gradient',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Enable Gradient','jnews'),
    'description'   => esc_html__('Enable Bottom bar gradient','jnews'),
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_gradient',
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
    'description'   => esc_html__('Bottom bar gradient color.','jnews'),
    'output'     => array(
        array(
            'method'        => 'gradient',
            'element'       => ".jeg_header .jeg_navbar_wrapper:not(.jeg_navbar_boxed), .jeg_header .jeg_navbar_boxed .jeg_nav_row",
        )
    ),
    'active_callback'   => array(
        array(
            'setting'  => 'jnews_header_bottombar_enable_gradient',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Border Color','jnews'),
    'description'   => esc_html__('Bottom bar bottom color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_navbar_menuborder .jeg_main_menu > li:not(:last-child),
                                        .jeg_header .jeg_navbar_menuborder .jeg_nav_item, .jeg_navbar_boxed .jeg_nav_row,
                                        .jeg_header .jeg_navbar_menuborder:not(.jeg_navbar_boxed) .jeg_nav_left .jeg_nav_item:first-child",
            'property'      => 'border-color',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Default Text color','jnews'),
    'description'   => esc_html__('Bottom bar text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_bottombar,
                                        .jeg_header .jeg_bottombar.jeg_navbar_dark",
            'property'      => 'color',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_link_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Default Link color','jnews'),
    'description'   => esc_html__('Bottom bar link color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_bottombar a,
                                        .jeg_header .jeg_bottombar.jeg_navbar_dark a",
            'property'      => 'color',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_link_hover_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Default Link Hover color','jnews'),
    'description'   => esc_html__('Bottom bar link hover color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_header .jeg_bottombar a:hover,
                                        .jeg_header .jeg_bottombar.jeg_navbar_dark a:hover,
                                        .jeg_header .jeg_bottombar .jeg_menu:not(.jeg_main_menu) > li > a:hover",
            'property'      => 'color',
        ),
    ),
);



$options[] = array(
    'id'            => 'jnews_header_bottombar_border_top_height',
    'transport'     => 'postMessage',
    'default'       => 0,
    'type'          => 'jnews-slider',
    'label'         => esc_html__('Border Top Height', 'jnews'),
    'choices'     => array(
        'min'           => '0',
        'max'           => '20',
        'step'          => '1',
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_bottombar,
                                        .jeg_header .jeg_bottombar.jeg_navbar_dark,
                                        .jeg_navbar_boxed .jeg_nav_row,.jeg_navbar_dark.jeg_navbar_boxed .jeg_nav_row',
            'property'      => 'border-top-width',
            'units'         => 'px',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_border_top_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Border Top Color','jnews'),
    'description'   => esc_html__('Bottom Bar border top color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header_wrapper .jeg_bottombar,
                                        .jeg_header_wrapper .jeg_bottombar.jeg_navbar_dark,
                                        .jeg_navbar_boxed .jeg_nav_row,.jeg_navbar_dark.jeg_navbar_boxed .jeg_nav_row',
            'property'      => 'border-top-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_border_bottom_height',
    'transport'     => 'postMessage',
    'default'       => 1,
    'type'          => 'jnews-slider',
    'label'         => esc_html__('Border Bottom Height', 'jnews'),
    'choices'     => array(
        'min'           => '0',
        'max'           => '20',
        'step'          => '1',
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header .jeg_bottombar,
                                        .jeg_header .jeg_bottombar.jeg_navbar_dark,
                                        .jeg_navbar_boxed .jeg_nav_row,.jeg_navbar_dark.jeg_navbar_boxed .jeg_nav_row',
            'property'      => 'border-bottom-width',
            'units'         => 'px',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_bottombar_border_bottom_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Border Bottom Color','jnews'),
    'description'   => esc_html__('Bottom bar border bottom color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_header_wrapper .jeg_bottombar,
                                        .jeg_header_wrapper .jeg_bottombar.jeg_navbar_dark,
                                        .jeg_navbar_boxed .jeg_nav_row,.jeg_navbar_dark.jeg_navbar_boxed .jeg_nav_row',
            'property'      => 'border-bottom-color',
        )
    ),
);

return $options;