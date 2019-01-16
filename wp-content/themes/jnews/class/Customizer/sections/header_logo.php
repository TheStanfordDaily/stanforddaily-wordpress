<?php

$options = array();


$options[] = array(
    'id'            => 'jnews_header_section_logo',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Normal Header Logo','jnews' ),
);


$options[] = array(
    'id'            => 'jnews_header_logo_type',
    'transport'     => 'postMessage',
    'default'       => 'image',
    'type'          => 'jnews-radio-buttonset',
    'label'         => esc_html__('Choose your header logo type','jnews'),
    'description'   => esc_html__('choose between image logo or text logo', 'jnews'),
    'choices'       => array(
        'image'         => esc_attr__( 'Image Logo', 'jnews' ),
        'text'          => esc_attr__( 'Text Logo', 'jnews' )
    ),
    'partial_refresh' => array (
        'jnews_header_logo_type' => array (
            'selector'        => '.jeg_desktop_logo.jeg_logo > a',
            'render_callback' => function() {
                return jnews_generate_header_logo( false );
            },
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_header_logo_text',
    'transport'     => 'postMessage',
    'default'       => 'Logo',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Header Logo Text','jnews' ),
    'description'   => esc_html__('Type your logo text.','jnews' ),
    'partial_refresh' => array (
        'jnews_header_logo_text' => array (
            'selector'        => '.jeg_desktop_logo.jeg_logo > a',
            'render_callback' => function() {
                return jnews_generate_header_logo( false );
            },
        ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_header_logo_type',
            'operator' => '==',
            'value'    => 'text',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_logo_text_font',
    'transport'     => 'postMessage',
    'type'          => 'jnews-typography',
    'label'         => esc_html__('Header Logo Text Font', 'jnews' ),
    'description'   => esc_html__('Set font for your header logo text', 'jnews' ),
    'default'     => array (
        'font-family'    => '',
        'variant'        => '',
        'font-size'      => '',
        'line-height'    => '',
        'subsets'        => array( ),
        'color'          => ''
    ),
    'output'     => array(
        array(
            'method'        => 'typography',
            'element'       => '.jeg_nav_item.jeg_logo .site-title a'
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_header_logo_type',
            'operator' => '==',
            'value'    => 'text',
        )
    ),
);


$options[] = array(
    'id'            => 'jnews_header_logo',
    'transport'     => 'postMessage',
    'default'       => get_parent_theme_file_uri('assets/img/logo.png'),
    'type'          => 'jnews-image',
    'label'         => esc_html__('Header Logo','jnews' ),
    'description'   => esc_html__('Upload your header logo.','jnews' ),
    'partial_refresh' => array (
        'jnews_header_logo' => array (
            'selector'        => '.jeg_desktop_logo.jeg_logo > a',
            'render_callback' => function() {
                return jnews_generate_header_logo( false );
            },
        ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_header_logo_type',
            'operator' => '==',
            'value'    => 'image',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_logo_retina',
    'transport'     => 'postMessage',
    'default'       => get_parent_theme_file_uri('assets/img/logo@2x.png'),
    'type'          => 'jnews-image',
    'label'         => esc_html__('Header Logo Retina','jnews' ),
    'description'   => esc_html__('Upload your header logo retina.','jnews' ),
    'partial_refresh' => array (
        'jnews_header_logo_retina' => array (
            'selector'        => '.jeg_desktop_logo.jeg_logo > a',
            'render_callback' => function() {
                return jnews_generate_header_logo( false );
            },
        ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_header_logo_type',
            'operator' => '==',
            'value'    => 'image',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_logo_alt',
    'transport'     => 'postMessage',
    'default'       => get_bloginfo('name'),
    'type'          => 'jnews-text',
    'label'         => esc_html__('Header Logo Alt','jnews' ),
    'description'   => esc_html__('Your logo alternate text','jnews' ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_header_logo_type',
            'operator' => '==',
            'value'    => 'image',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_logo_spacing',
    'transport'     => 'postMessage',
    'default'     => array(
        'top'    => '0px',
        'bottom' => '0px',
        'left'   => '0px',
        'right'  => '0px',
    ),
    'type'          => 'jnews-spacing',
    'label'         => esc_html__('Logo Spacing','jnews'),
    'description'   => esc_html__('You can use px, em for your logo spacing.','jnews'),
    'output'     => array(
        array(
            'method'        => 'inline-spacing',
            'element'       => '.jeg_header .jeg_logo > a',
            'property'      => 'padding',
        )
    )
);


/**
 * Sticky Header Logo
 */

$options[] = array(
    'id'            => 'jnews_sticky_section_logo',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Sticky Header Logo','jnews' ),
);


$options[] = array(
    'id'            => 'jnews_sticky_logo_type',
    'transport'     => 'postMessage',
    'default'       => 'image',
    'type'          => 'jnews-radio-buttonset',
    'label'         => esc_html__('Choose your sticky header logo type','jnews'),
    'description'   => esc_html__('choose between image logo or text logo', 'jnews'),
    'choices'       => array(
        'image'         => esc_attr__( 'Image Logo', 'jnews' ),
        'text'          => esc_attr__( 'Text Logo', 'jnews' )
    ),
    'partial_refresh' => array (
        'jnews_sticky_logo_type' => array (
            'selector'        => '.jeg_stickybar .jeg_logo > a',
            'render_callback' => function() {
                return jnews_generate_sticky_logo( false );
            },
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_sticky_logo_text',
    'transport'     => 'postMessage',
    'default'       => 'Logo',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Header Logo Text','jnews' ),
    'description'   => esc_html__('Your logo alternate text.','jnews' ),
    'partial_refresh' => array (
        'jnews_sticky_logo_text' => array (
            'selector'        => '.jeg_stickybar .jeg_logo > a',
            'render_callback' => function() {
                return jnews_generate_sticky_logo( false );
            },
        ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sticky_logo_type',
            'operator' => '==',
            'value'    => 'text',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_sticky_logo_text_font',
    'transport'     => 'postMessage',
    'type'          => 'jnews-typography',
    'label'         => esc_html__('Sticky Logo Text Font', 'jnews' ),
    'description'   => esc_html__('Set font for your sticky logo text', 'jnews' ),
    'default'     => array (
        'font-family'    => '',
        'variant'        => '',
        'font-size'      => '',
        'line-height'    => '',
        'subsets'        => array( ),
        'color'          => ''
    ),
    'output'     => array(
        array(
            'method'        => 'typography',
            'element'       => '.jeg_stickybar .jeg_nav_item.jeg_logo .site-title a'
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sticky_logo_type',
            'operator' => '==',
            'value'    => 'text',
        )
    ),
);



$options[] = array(
    'id'            => 'jnews_sticky_menu_logo',
    'transport'     => 'postMessage',
    'default'       => get_parent_theme_file_uri('assets/img/sticky_logo.png'),
    'type'          => 'jnews-image',
    'label'         => esc_html__('Sticky Menu Logo','jnews' ),
    'description'   => esc_html__('Upload your sticky menu logo.','jnews' ),
    'partial_refresh' => array (
        'jnews_sticky_menu_logo' => array (
            'selector'        => '.jeg_stickybar .jeg_logo > a',
            'render_callback' => function() {
                return jnews_generate_sticky_logo( false );
            },
        ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sticky_logo_type',
            'operator' => '==',
            'value'    => 'image',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_sticky_menu_logo_retina',
    'transport'     => 'postMessage',
    'default'       => get_parent_theme_file_uri('assets/img/sticky_logo@2x.png'),
    'type'          => 'jnews-image',
    'label'         => esc_html__('Sticky Menu Logo Retina','jnews' ),
    'description'   => esc_html__('Upload your sticky menu logo retina.','jnews' ),
    'partial_refresh' => array (
        'jnews_sticky_menu_logo_retina' => array (
            'selector'        => '.jeg_stickybar .jeg_logo > a',
            'render_callback' => function() {
                return jnews_generate_sticky_logo( false );
            },
        ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sticky_logo_type',
            'operator' => '==',
            'value'    => 'image',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_sticky_menu_alt',
    'transport'     => 'postMessage',
    'default'       => get_bloginfo('name'),
    'type'          => 'jnews-text',
    'label'         => esc_html__('Sticky Menu Alt','jnews' ),
    'description'   => esc_html__('Your logo alternate text.','jnews' ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sticky_logo_type',
            'operator' => '==',
            'value'    => 'image',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_mobile_section_logo',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Mobile Header Logo','jnews' ),
);



$options[] = array(
    'id'            => 'jnews_mobile_logo_type',
    'transport'     => 'postMessage',
    'default'       => 'image',
    'type'          => 'jnews-radio-buttonset',
    'label'         => esc_html__('Choose your mobile header logo type','jnews'),
    'description'   => esc_html__('choose between image logo or text logo', 'jnews'),
    'choices'       => array(
        'image'         => esc_attr__( 'Image Logo', 'jnews' ),
        'text'          => esc_attr__( 'Text Logo', 'jnews' )
    ),
    'partial_refresh' => array (
        'jnews_mobile_logo_type' => array (
            'selector'        => '.jeg_mobile_logo > a',
            'render_callback' => function() {
                return jnews_generate_mobile_logo( false );
            },
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_mobile_logo_text',
    'transport'     => 'postMessage',
    'default'       => 'Logo',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Mobile Logo Text','jnews' ),
    'description'   => esc_html__('Your logo alternate text.','jnews' ),
    'partial_refresh' => array (
        'jnews_mobile_logo_text' => array (
            'selector'        => '.jeg_mobile_logo > a',
            'render_callback' => function() {
                return jnews_generate_mobile_logo( false );
            },
        ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_mobile_logo_type',
            'operator' => '==',
            'value'    => 'text',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_mobile_logo_text_font',
    'transport'     => 'postMessage',
    'type'          => 'jnews-typography',
    'label'         => esc_html__('Mobile Logo Text Font', 'jnews' ),
    'description'   => esc_html__('Set font for your sticky logo text', 'jnews' ),
    'default'     => array (
        'font-family'    => '',
        'variant'        => '',
        'font-size'      => '',
        'line-height'    => '',
        'subsets'        => array( ),
        'color'          => ''
    ),
    'output'     => array(
        array(
            'method'        => 'typography',
            'element'       => '.jeg_nav_item.jeg_mobile_logo .site-title a'
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_mobile_logo_type',
            'operator' => '==',
            'value'    => 'text',
        )
    ),
);



$options[] = array(
    'id'            => 'jnews_mobile_logo',
    'transport'     => 'postMessage',
    'default'       => get_parent_theme_file_uri('assets/img/logo_mobile.png'),
    'type'          => 'jnews-image',
    'label'         => esc_html__('Mobile Device Logo','jnews' ),
    'description'   => esc_html__('Upload your mobile device logo.','jnews' ),
    'partial_refresh' => array (
        'jnews_mobile_logo' => array (
            'selector'        => '.jeg_mobile_logo > a',
            'render_callback' => function() {
                return jnews_generate_mobile_logo( false );
            },
        ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_mobile_logo_type',
            'operator' => '==',
            'value'    => 'image',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_mobile_logo_retina',
    'transport'     => 'postMessage',
    'default'       => get_parent_theme_file_uri('assets/img/logo_mobile@2x.png'),
    'type'          => 'jnews-image',
    'label'         => esc_html__('Mobile Device Logo Retina','jnews' ),
    'description'   => esc_html__('Upload your mobile device logo retina.','jnews' ),
    'partial_refresh' => array (
        'jnews_mobile_logo_retina' => array (
            'selector'        => '.jeg_mobile_logo > a',
            'render_callback' => function() {
                return jnews_generate_mobile_logo( false );
            },
        ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_mobile_logo_type',
            'operator' => '==',
            'value'    => 'image',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_mobile_logo_alt',
    'transport'     => 'postMessage',
    'default'       => get_bloginfo('name'),
    'type'          => 'jnews-text',
    'label'         => esc_html__('Mobile Logo Alt','jnews' ),
    'description'   => esc_html__('Your logo alternate text.','jnews' ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_mobile_logo_type',
            'operator' => '==',
            'value'    => 'image',
        )
    ),
);

return $options;