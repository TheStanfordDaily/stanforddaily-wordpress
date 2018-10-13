<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_preview_slider_alert',
    'type'          => 'jnews-alert',
    'default'       => 'info',
    'section'       => 'jnews_preview_slider_section',
    'label'         => esc_html__('Gallery Info','jnews-gallery' ),
    'description'   => esc_html__('This gallery option setting is a global setting. Its mean, when you change this setting, all of your gallery setting will follow this setting. But you can override each of this setting on your single gallery.','jnews-gallery' )
);

$options[] = array(
    'id'            => 'jnews_preview_slider_header',
    'type'          => 'jnews-header',
    'section'       => 'jnews_preview_slider_section',
    'label'         => esc_html__('JNews Gallery Default Option','jnews-gallery' ),
);

$options[] = array(
    'id'            => 'jnews_option[preview_slider_toggle]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'section'       => 'jnews_preview_slider_section',
    'label'         => esc_html__('Turn All Gallery to JNews Gallery', 'jnews-gallery'),
    'description'   => wp_kses(__("Enabling this option will turn all default slider into <strong>JNews Gallery</strong>.", 'jnews-gallery'), wp_kses_allowed_html()),
);

$options[] = array(
    'id'            => 'jnews_option[preview_slider_desc]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'section'       => 'jnews_preview_slider_section',
    'label'         => esc_html__('Use Slider Zoom with Description', 'jnews-gallery'),
    'description'   => wp_kses(__("Enabling this option will turn your <strong>JNews Gallery</strong> to have description when zoomed.", 'jnews-gallery'), wp_kses_allowed_html()),
    'active_callback' => array(
        array(
            'setting' => 'jnews_option[preview_slider_toggle]',
            'operator' => '==',
            'value'    => true
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_option[preview_slider_ads]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'section'       => 'jnews_preview_slider_section',
    'label'         => esc_html__('Show Ads Wrapper', 'jnews-gallery'),
    'description'   => wp_kses(__("Enabling this option will turn your <strong>JNews Gallery</strong> to have ads section when zoomed.", 'jnews-gallery'), wp_kses_allowed_html()),

    'active_callback' => array(
        array(
            'setting' => 'jnews_option[preview_slider_toggle]',
            'operator' => '==',
            'value'    => true
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_option[preview_slider_loader]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 'dot',
    'type'          => 'jnews-select',
    'section'       => 'jnews_preview_slider_section',
    'label'         => esc_html__('Preview Slider Loader Style', 'jnews-gallery'),
    'description'   => esc_html__('Choose loader style that you want to use for gallery.', 'jnews-gallery'),
    'choices'       => array(
        'dot'		    => esc_html__('Dot', 'jnews-gallery'),
        'circle'		=> esc_html__('Circle', 'jnews-gallery'),
        'square'		=> esc_html__('Square', 'jnews-gallery'),
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.preview-slider-overlay .preloader_type',
            'property'      => array(
                'dot'           => 'preloader_dot',
                'circle'        => 'preloader_circle',
                'square'        => 'preloader_square',
            ),
        ),
    )
);

return $options;