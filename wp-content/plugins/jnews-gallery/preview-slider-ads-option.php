<?php

$options = array();

$ad_size = array(
    'auto'                  =>  'Auto',
    'hide'                  =>  'Hide',
    '120x90'                =>  '120 x 90',
    '120x240'               =>  '120 x 240',
    '120x600'               =>  '120 x 600',
    '125x125'               =>  '125 x 125',
    '160x90'                =>  '160 x 90',
    '160x600'               =>  '160 x 600',
    '180x90'                =>  '180 x 90',
    '180x150'               =>  '180 x 150',
    '200x90'                =>  '200 x 90',
    '200x200'               =>  '200 x 200',
    '234x60'                =>  '234 x 60',
    '250x250'               =>  '250 x 250',
    '320x100'               =>  '320 x 100',
    '300x250'               =>  '300 x 250',
    '300x600'               =>  '300 x 600',
    '320x50'                =>  '320 x 50',
    '336x280'               =>  '336 x 280',
    '468x15'                =>  '468 x 15',
    '468x60'                =>  '468 x 60',
    '728x15'                =>  '728 x 15',
    '728x90'                =>  '728 x 90',
    '970x90'                =>  '970 x 90',
    '240x400'               =>  '240 x 400',
    '250x360'               =>  '250 x 360',
    '580x400'               =>  '580 x 400',
    '750x100'               =>  '750 x 100',
    '750x200'               =>  '750 x 200',
    '750x300'               =>  '750 x 300',
    '980x120'               =>  '980 x 120',
    '930x180'               =>  '930 x 180',
);

$options[] = array(
    'id'            => 'jnews_preview_slider_ads_header',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Preview Slider Ads','jnews-gallery' ),
);

$options[] = array(
    'id'            => 'jnews_option[ads_preview_slider_type]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 'googleads',
    'type'          => 'jnews-radio',
    'label'         => esc_html__('Advertisement type','jnews-gallery'),
    'description'   => esc_html__('Choose which type of advertisement you want to use.','jnews-gallery'),
    'multiple'      => 1,
    'choices'       => array(
        'image'         => esc_attr__( 'Image Ads', 'jnews-gallery' ),
        'googleads'     => esc_attr__( 'Google Ads', 'jnews-gallery' ),
        'code'          => esc_attr__( 'Script Code', 'jnews-gallery' ),
        'shortcode'     => esc_attr__( 'Shortcode', 'jnews-gallery' ),
    ),
);


// IMAGE

$options[] = array(
    'id'            => 'jnews_option[ads_preview_slider_image]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-image',
    'label'         => esc_html__('Advertisement Image','jnews-gallery'),
    'description'   => esc_html__('Upload 300x250 Image size.','jnews-gallery' ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[ads_preview_slider_type]',
            'operator' => '==',
            'value'    => 'image',
        ),
    )
);

$options[] = array(
    'id'            => 'jnews_option[ads_preview_slider_link]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Advertisement Link','jnews-gallery'),
    'description'   => esc_html__('Please put where this advertisement image will be heading.','jnews-gallery' ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[ads_preview_slider_type]',
            'operator' => '==',
            'value'    => 'image',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_option[ads_preview_slider_text]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Alternate Text','jnews-gallery' ),
    'description'   => esc_html__('Insert alternate text for advertisement image.','jnews-gallery' ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[ads_preview_slider_type]',
            'operator' => '==',
            'value'    => 'image',
        ),
    ),
);

// GOOGLE ADS

$options[] = array(
    'id'            => 'jnews_option[ads_preview_slider_google_publisher]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Publisher ID','jnews-gallery'),
    'description'   => esc_html__('Insert data-ad-client / google_ad_client content.','jnews-gallery' ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[ads_preview_slider_type]',
            'operator' => '==',
            'value'    => 'googleads',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_option[ads_preview_slider_google_id]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Ads Slot ID','jnews-gallery'),
    'description'   => esc_html__('Insert data-ad-slot / google_ad_slot content.','jnews-gallery' ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[ads_preview_slider_type]',
            'operator' => '==',
            'value'    => 'googleads',
        ),
    ),
);


$options[] = array(
    'id'            => 'jnews_option[ads_preview_slider_google_desktop]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 'auto',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Desktop Ads Size','jnews-gallery'),
    'description'   => esc_html__('Choose ad size to be shown on desktop, recommended to use auto.','jnews-gallery' ),
    'choices'       => $ad_size,
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[ads_preview_slider_type]',
            'operator' => '==',
            'value'    => 'googleads',
        ),
    ),
);


// CODE

$options[] = array(
    'id'            => 'jnews_option[ads_preview_slider_code]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-textarea',
    'label'         => esc_html__('Ads code', 'jnews-gallery'),
    'description'   => esc_html__('Put your ad\'s script code right here.', 'jnews-gallery'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[ads_preview_slider_type]',
            'operator' => '==',
            'value'    => 'code',
        ),
    ),
);

// SHORTCODE

$options[] = array(
    'id'            => 'jnews_option[ads_preview_slider_shortcode]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-textarea',
    'label'         => esc_html__('Advertisement code', 'jnews-gallery'),
    'description'   => esc_html__('Put your shortcode ads right here.', 'jnews-gallery'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_option[ads_preview_slider_type]',
            'operator' => '==',
            'value'    => 'shortcode',
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_option[ads_preview_slider_ads_text]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Advertisement Text','jnews'),
);

return $options;