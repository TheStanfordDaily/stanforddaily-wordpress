<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_single_popup_script',
    'transport'     => 'postMessage',
    'default'       => 'magnific',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Image Popup Script','jnews'),
    'description'   => wp_kses(__("This option will enable your image popup on Gallery Thumbnail, Single image, and WordPress default gallery.
            <ol>
                <li><strong>Photoswipe :</strong> Zoomable, ability to go fullscreen, button for share on social network.</li>
                <li><strong>Magnific :</strong> Simple Option, option to turn all single image into one gallery.</li>
            </ol>",'jnews'), wp_kses_allowed_html()),
    'choices'       => array(
        'disable'       => esc_attr__( 'Disabled', 'jnews' ),
        'photoswipe'    => esc_attr__( 'Photoswipe', 'jnews' ),
        'magnific'      => esc_attr__( 'Magnific Popup', 'jnews' ),
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_single_as_gallery',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Set Images as Gallery','jnews'),
    'description'   => esc_html__('Set images on a single post as one instance of gallery.','jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_single_popup_script',
            'operator' => '==',
            'value'    => 'magnific',
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    )
);

return $options;