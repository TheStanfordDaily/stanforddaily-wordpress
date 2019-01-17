<?php

$options = array();

$footer_refresh = array (
    'selector'        => '.footer-holder',
    'render_callback' => function() {
        get_template_part( 'fragment/footer/footer-' . get_theme_mod('jnews_footer_style', '1') );
    },
);

$show_secondary_footer_active_callback = array(
    'setting'  => 'jnews_footer_show_secondary',
    'operator' => '==',
    'value'    => true,
);

$options[] = array(
    'id'            => 'jnews_footer_option_section',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Footer Options','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_footer_copyright',
    'transport'     => 'postMessage',
    'default'       => jnews_get_footer_copyright_text(),
    'type'          => 'jnews-textarea',
    'label'         => esc_html__('Footer Copyright', 'jnews'),
    'description'   => esc_html__('Allowed tag : a, b, strong, em.', 'jnews'),
    'sanitize'      => 'jnews_sanitize_allowed_tag',
    'partial_refresh' => array (
        'jnews_footer_copyright' => array (
            'selector'              => '.copyright',
            'render_callback'       => function() {
                return get_theme_mod('jnews_footer_copyright', jnews_get_footer_copyright_text() );
            },
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_footer_logo',
    'transport'     => 'postMessage',
    'default'       => get_parent_theme_file_uri('assets/img/logo.png'),
    'type'          => 'jnews-image',
    'label'         => esc_html__('Footer Logo','jnews' ),
    'description'   => esc_html__('Upload your footer\'s logo.','jnews' ),
    'partial_refresh' => array (
        'jnews_footer_logo' => array (
            'selector'        => '.jeg_footer_sidecontent .footer_logo',
            'render_callback' => function() {
                return jnews_generate_footer_7_logo( false );
            },
        ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => '7',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_logo_retina',
    'transport'     => 'postMessage',
    'default'       => get_parent_theme_file_uri('assets/img/logo@2x.png'),
    'type'          => 'jnews-image',
    'label'         => esc_html__('Footer Logo Retina','jnews' ),
    'description'   => esc_html__('Upload your retina logo for footer.','jnews' ),
    'partial_refresh' => array (
        'jnews_footer_logo_retina' => array (
            'selector'        => '.jeg_footer_sidecontent .footer_logo',
            'render_callback' => function() {
                return jnews_generate_footer_7_logo( false );
            },
        ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => '7'
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_logo_alt',
    'transport'     => 'postMessage',
    'default'       => get_bloginfo('name'),
    'type'          => 'jnews-text',
    'label'         => esc_html__('Footer Logo Alt','jnews' ),
    'description'   => esc_html__('Your logo\'s alternate text.','jnews' ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => '7'
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_menu_title',
    'transport'     => 'postMessage',
    'default'       => 'Navigate Site',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Navigation Footer Text', 'jnews'),
    'description'   => esc_html__('Text that appear above navigation.', 'jnews'),
    'partial_refresh' => array (
        'jnews_footer_menu_title' => array (
            'selector'              => '.jeg_footer_title.menu-title span',
            'render_callback'       => function() {
                return get_theme_mod('jnews_footer_menu_title', 'Navigate Site');
            },
        ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => '7'
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_social_title',
    'transport'     => 'postMessage',
    'default'       => 'Follow Us',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Social Footer Text', 'jnews'),
    'description'   => esc_html__('Text that appear above social text.', 'jnews'),
    'partial_refresh' => array (
        'jnews_footer_social_title' => array (
            'selector'              => '.jeg_footer_title.social-title span',
            'render_callback'       => function() {
                return get_theme_mod('jnews_footer_social_title', 'Follow Us');
            },
        ),
    ),

    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => '7'
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_force_fullwidth',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Force Footer into Full Width','jnews'),
    'description'   => esc_html__('If layout is on boxed mode, enable this option to force footer into full width.','jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_boxed_layout',
            'operator' => '==',
            'value'    => true
        )
    ),
    'output'        => array(
        array(
            'method'        => 'switch-class',
            'element'       => '.jeg_footer_container',
            'property'      => array('jeg_container', 'jeg_container_full'),
        ),
    )
);

$options[] = array(
    'id'            => 'jnews_footer_show_social',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Social Icon','jnews'),
    'description'   => esc_html__('Enable this option to show social icon on top of the footer.','jnews'),
    'partial_refresh' => array (
        'jnews_footer_show_social' => $footer_refresh
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => '5'
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_text',
    'transport'     => 'postMessage',
    'default'       => jnews_footer_text(),
    'type'          => 'jnews-textarea',
    'label'         => esc_html__('Footer Additional Text', 'jnews'),
    'description'   => esc_html__('Allowed tag : a, b, strong, em.', 'jnews'),
    'sanitize'      => 'jnews_sanitize_allowed_tag',
    'partial_refresh' => array (
        'jnews_footer_text' => array (
            'selector'              => '.footer-text',
            'render_callback'       => function() {
                return get_theme_mod('jnews_footer_text', jnews_footer_text() );
            },
        ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => '4'
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_show_secondary',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Secondary Footer','jnews'),
    'description'   => esc_html__('Disable this option to hide secondary footer menu.','jnews'),
    'partial_refresh' => array (
        'jnews_footer_show_secondary' => $footer_refresh
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '4', '5', '6' ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_menu_position',
    'transport'     => 'postMessage',
    'default'       => 'right',
    'type'          => 'jnews-radio-buttonset',
    'label'         => esc_html__('Menu Position on Secondary Footer','jnews'),
    'description'   => esc_html__('Adjust menu position on secondary footer.','jnews'),
    'choices'       => array(
        'left' => esc_attr__( 'Left', 'jnews' ),
        'right' => esc_attr__( 'Right', 'jnews' ),
        'hide' => esc_attr__( 'Hide', 'jnews' ),
    ),
    'partial_refresh' => array (
        'jnews_footer_menu_position' => $footer_refresh
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '6' ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_copyright_position',
    'transport'     => 'postMessage',
    'default'       => 'left',
    'type'          => 'jnews-radio-buttonset',
    'label'         => esc_html__('Copyright Position on Secondary Footer','jnews'),
    'description'   => esc_html__('Adjust copyright position on secondary footer.','jnews'),
    'choices'       => array(
        'left' => esc_attr__( 'Left', 'jnews' ),
        'right' => esc_attr__( 'Right', 'jnews' ),
        'hide' => esc_attr__( 'Hide', 'jnews' ),
    ),
    'partial_refresh' => array (
        'jnews_footer_copyright_position' => $footer_refresh
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '6' ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_social_position',
    'transport'     => 'postMessage',
    'default'       => 'hide',
    'type'          => 'jnews-radio-buttonset',
    'label'         => esc_html__('Social Position on Secondary Footer','jnews'),
    'description'   => esc_html__('Adjust social position on secondary footer.','jnews'),
    'choices'       => array(
        'left' => esc_attr__( 'Left', 'jnews' ),
        'right' => esc_attr__( 'Right', 'jnews' ),
        'hide' => esc_attr__( 'Hide', 'jnews' ),
    ),
    'partial_refresh' => array (
        'jnews_footer_social_position' => $footer_refresh
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '6' ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_style_section',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Footer Style','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_footer_scheme',
    'transport'     => 'postMessage',
    'default'       => 'dark',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Footer Scheme','jnews'),
    'description'   => esc_html__('Choose your footer scheme.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'normal'        => esc_attr__( 'Normal Style (Light)', 'jnews' ),
        'dark'          => esc_attr__( 'Dark Style', 'jnews' ),
    ),
    'output'        => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.jeg_footer',
            'property'      => array(
                'normal'            => 'normal',
                'dark'              => 'dark',
            ),
        ),
    )
);

$options[] = array(
    'id'            => 'jnews_footer_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Background Color','jnews'),
    'description'   => esc_html__('Footer background color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_content,.jeg_footer.dark .jeg_footer_content',
            'property'      => 'background-color',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Text Color','jnews'),
    'description'   => esc_html__('Footer text color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_content,.jeg_footer.dark .jeg_footer_content',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '4', '5', '6' ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_widget_title_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Widget Title Color','jnews'),
    'description'   => esc_html__('Footer widget title text color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer .jeg_footer_heading h3,.jeg_footer.dark .jeg_footer_heading h3,.jeg_footer .widget h2,.jeg_footer .footer_dark .widget h2',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '5', '6' ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_link_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Link Color','jnews'),
    'description'   => esc_html__('Footer link text color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer .jeg_footer_content a, .jeg_footer.dark .jeg_footer_content a',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '5', '6' ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_linkhover_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Link Hover Color','jnews'),
    'description'   => esc_html__('Footer link hover text color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer .jeg_footer_content a:hover,.jeg_footer.dark .jeg_footer_content a:hover',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '5', '6' ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_button_bg',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Button Background Color','jnews'),
    'description'   => esc_html__('Footer button background color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer input[type="submit"],.jeg_footer .btn,.jeg_footer .button',
            'property'      => 'background-color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '5', '6' ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_button_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Button Text Color','jnews'),
    'description'   => esc_html__('Footer button text color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer input[type="submit"],.jeg_footer .btn,.jeg_footer .button',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '5', '6' ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_form_bg',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Input Form Background','jnews'),
    'description'   => esc_html__('Footer input form background color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer input:not([type="submit"]),.jeg_footer textarea,.jeg_footer select,.jeg_footer.dark input:not([type="submit"]),.jeg_footer.dark textarea,.jeg_footer.dark select',
            'property'      => 'background-color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '5', '6' ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_form_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Input Text Color','jnews'),
    'description'   => esc_html__('Footer input form text color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer input:not([type="submit"]),.jeg_footer textarea,.jeg_footer select,.jeg_footer.dark input:not([type="submit"]),.jeg_footer.dark textarea,.jeg_footer.dark select',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '5', '6' ),
        )
    )
);

// Widget: Tag Cloud
$options[] = array(
    'id'            => 'jnews_footer_tags_bg',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Widget: Tag Cloud Background','jnews'),
    'description'   => esc_html__('Widget Tag Cloud on footer background color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.footer_widget.widget_tag_cloud a,.jeg_footer.dark .footer_widget.widget_tag_cloud a',
            'property'      => 'background-color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '5', '6' ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_tags_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Widget: Tag Cloud Text Color','jnews'),
    'description'   => esc_html__('Widget Tag Cloud on footer text color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.footer_widget.widget_tag_cloud a,.jeg_footer.dark .footer_widget.widget_tag_cloud a',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '5', '6' ),
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_line_separator_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Line Separator Color','jnews'),
    'description'   => esc_html__('Footer line separator color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_secondary,.jeg_footer.dark .jeg_footer_secondary',
            'property'      => 'border-top-color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_2 .footer_column,.jeg_footer_2.dark .footer_column',
            'property'      => 'border-right-color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_5 .jeg_footer_social, .jeg_footer_5 .footer_column, .jeg_footer_5 .jeg_footer_secondary,.jeg_footer_5.dark .jeg_footer_social,.jeg_footer_5.dark .footer_column,.jeg_footer_5.dark .jeg_footer_secondary',
            'property'      => 'border-color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '4', '5' ),
        ),
        $show_secondary_footer_active_callback,
        array(
            'setting'  => 'jnews_footer_show_social',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_footer_secondary_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Secondary Footer Background Color','jnews'),
    'description'   => esc_html__('Set background color for secondary footer.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_bottom,.jeg_footer.dark .jeg_footer_bottom,.jeg_footer_secondary,.jeg_footer.dark .jeg_footer_secondary',
            'property'      => 'background-color',
        )
    ),
    'active_callback'  => array(
        $show_secondary_footer_active_callback,
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '1', '2', '3', '4', '5', '6' ),
        ),
    )
);

$options[] = array(
    'id'            => 'jnews_footer_copyright_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Copyright Color','jnews'),
    'description'   => esc_html__('Footer Copyright color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_secondary,.jeg_footer.dark .jeg_footer_secondary,.jeg_footer_bottom,.jeg_footer.dark .jeg_footer_bottom,.jeg_footer_sidecontent .jeg_footer_primary',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        $show_secondary_footer_active_callback,
        array(
            'setting'  => 'jnews_footer_copyright_position',
            'operator' => '!=',
            'value'    => 'hide',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_secondary_link_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Copyright Link Color','jnews'),
    'description'   => esc_html__('Footer copyright link color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_bottom a,.jeg_footer.dark .jeg_footer_bottom a,.jeg_footer_secondary a,.jeg_footer.dark .jeg_footer_secondary a,.jeg_footer_sidecontent .jeg_footer_primary a,.jeg_footer_sidecontent.dark .jeg_footer_primary a',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        $show_secondary_footer_active_callback
    )
);

$options[] = array(
    'id'            => 'jnews_footer_nav_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Navigation Text Color','jnews'),
    'description'   => esc_html__('Footer navigation title text color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_sidecontent .jeg_footer_primary .col-md-7 .jeg_footer_title, .jeg_footer_sidecontent .jeg_footer_primary .col-md-7 .jeg_footer_title',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => '7',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_nav_line_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Navigation Line Color','jnews'),
    'description'   => esc_html__('Footer navigation title line color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_sidecontent .jeg_footer_primary .col-md-7 .jeg_footer_title,.jeg_footer.dark .jeg_footer_sidecontent .jeg_footer_primary .col-md-7 .jeg_footer_title',
            'property'      => 'border-bottom-color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => '7',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_menu_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Menu Text Color','jnews'),
    'description'   => esc_html__('Footer menu text color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_menu_footer a,.jeg_footer.dark .jeg_menu_footer a,.jeg_footer_sidecontent .jeg_footer_primary .col-md-7 .jeg_menu_footer a',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        $show_secondary_footer_active_callback,
        array(
            'setting'  => 'jnews_footer_menu_position',
            'operator' => '!=',
            'value'    => 'hide',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_menu_hover_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Menu Hover Text Color','jnews'),
    'description'   => esc_html__('Footer menu hover text color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_menu_footer a:hover,.jeg_footer.dark .jeg_menu_footer a:hover,.jeg_footer_sidecontent .jeg_footer_primary .col-md-7 .jeg_menu_footer a:hover',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        $show_secondary_footer_active_callback,
        array(
            'setting'  => 'jnews_footer_menu_position',
            'operator' => '!=',
            'value'    => 'hide',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_menu_separator_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Menu Separator Color','jnews'),
    'description'   => esc_html__('Footer menu separator color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_menu_footer li:not(:last-child):after,.jeg_footer.dark .jeg_menu_footer li:not(:last-child):after',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        $show_secondary_footer_active_callback,
        array(
            'setting'  => 'jnews_footer_menu_position',
            'operator' => '!=',
            'value'    => 'hide',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_social_icon_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Social Icon Color','jnews'),
    'description'   => esc_html__('Footer social icon color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.socials_widget a .fa,.jeg_footer.dark .socials_widget a .fa,.jeg_footer .socials_widget.nobg .fa,.jeg_footer.dark .socials_widget.nobg .fa,.jeg_footer .socials_widget:not(.nobg) a .fa,.jeg_footer.dark .socials_widget:not(.nobg) a .fa',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        $show_secondary_footer_active_callback,
        array(
            'setting'  => 'jnews_footer_social_position',
            'operator' => '!=',
            'value'    => 'hide',
        )
    )
);



$options[] = array(
    'id'            => 'jnews_footer_social_icon_hover_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Social Icon Hover Color','jnews'),
    'description'   => esc_html__('Footer social icon hover color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.socials_widget a:hover .fa,.jeg_footer.dark .socials_widget a:hover .fa,.socials_widget a:hover .fa,.jeg_footer.dark .socials_widget a:hover .fa,.jeg_footer .socials_widget.nobg a:hover .fa,.jeg_footer.dark .socials_widget.nobg a:hover .fa,.jeg_footer .socials_widget:not(.nobg) a:hover .fa,.jeg_footer.dark .socials_widget:not(.nobg) a:hover .fa',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        $show_secondary_footer_active_callback,
        array(
            'setting'  => 'jnews_footer_social_position',
            'operator' => '!=',
            'value'    => 'hide',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_social_icon_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Social Icon Background Color','jnews'),
    'description'   => esc_html__('Footer social icon background color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_5 .jeg_footer_content .jeg_footer_social .socials_widget .fa,.jeg_footer_5.dark .jeg_footer_content .jeg_footer_social .socials_widget .fa',
            'property'      => 'background-color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => '5',
        ),
        array(
            'setting'  => 'jnews_footer_show_social',
            'operator' => '==',
            'value'    => true,
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer5_social_icon_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Social Icon Color','jnews'),
    'description'   => esc_html__('Footer social icon color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_5 .jeg_footer_content .jeg_footer_social .socials_widget .fa,.jeg_footer_5.dark .jeg_footer_content .jeg_footer_social .socials_widget .fa',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => '5',
        ),
        array(
            'setting'  => 'jnews_footer_show_social',
            'operator' => '==',
            'value'    => true,
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_social_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Social Text Color','jnews'),
    'description'   => esc_html__('Footer social text color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_5 .jeg_footer_content .jeg_footer_social .socials_widget a,.jeg_footer_5.dark .jeg_footer_content .jeg_footer_social .socials_widget a,.jeg_footer_sidecontent .jeg_footer_primary .col-md-3 .jeg_footer_title',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => 'in',
            'value'    => array( '5', '7' ),
        ),
        array(
            'setting'  => 'jnews_footer_show_social',
            'operator' => '==',
            'value'    => true,
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_social_line_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Social Line Color','jnews'),
    'description'   => esc_html__('Footer social title line color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_sidecontent .jeg_footer_primary .col-md-3 .jeg_footer_title,.jeg_footer.dark .jeg_footer_sidecontent .jeg_footer_primary .col-md-3 .jeg_footer_title',
            'property'      => 'border-bottom-color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => '7',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_social_icon_hover_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Social Icon Hover Background Color','jnews'),
    'description'   => esc_html__('Footer social icon hover background color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_5 .jeg_footer_content .jeg_footer_social .socials_widget a:hover .fa,.jeg_footer_5.dark .jeg_footer_content .jeg_footer_social .socials_widget a:hover .fa',
            'property'      => 'background-color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => '5',
        ),
        array(
            'setting'  => 'jnews_footer_show_social',
            'operator' => '==',
            'value'    => true,
        )
    )
);

$options[] = array(
    'id'            => 'jnews_footer_social_hover_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Social Hover Text Color','jnews'),
    'description'   => esc_html__('Footer social hover text color.','jnews'),
    'choices'       => array(
        'alpha'     => true,
    ),
    'output'        => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_footer_5 .jeg_footer_content .jeg_footer_social .socials_widget a:hover,.jeg_footer_5.dark .jeg_footer_content .jeg_footer_social .socials_widget a:hover',
            'property'      => 'color',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => '5',
        ),
        array(
            'setting'  => 'jnews_footer_show_social',
            'operator' => '==',
            'value'    => true,
        )
    )
);

return $options;