<?php

$options = array();

$mobile_sticky = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'mobile_sticky',
    'title' => esc_html__('Sticky Mobile', 'jnews'),
    'default_size' => '320x50',
    'visibility' => array(
        'desktop' => false,
        'tab' => false,
        'phone' => true
    ),
));

$options[] = array(
    'id'            => 'jnews_page_level_ads_header',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Adsense - Page Level Ads','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_page_level_ads_enable',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Enable Page Level Ads','jnews'),
    'description'   => esc_html__('Enable this option to enable page level ads for mobile site.','jnews'),
);

$options[] = array(
    'id'            => 'jnews_ads_page_level_google_publisher',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Ad Client ID','jnews'),
    'description'   => esc_html__('Insert data-ad-client / google_ad_client content.','jnews' ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_page_level_ads_enable',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_page_level_anchor_enable',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Enable Page Level Anchor Ads','jnews'),
    'description'   => esc_html__('Enable this option to enable page level anchor ads for mobile site.','jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_page_level_ads_enable',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_ads_page_level_anchor_google_channel',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Page Level Anchor Ads Google Channel','jnews'),
    'description'   => esc_html__('Insert google_ad_channel content.','jnews' ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_page_level_ads_enable',
            'operator' => '==',
            'value'    => true,
        ),
        array(
            'setting'  => 'jnews_page_level_anchor_enable',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_page_level_vignette_enable',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Enable Page Level Vignette Ads','jnews'),
    'description'   => esc_html__('Enable this option to enable page level vignette ads for mobile site.','jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_page_level_ads_enable',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_ads_page_level_vignette_google_channel',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Page Level Vignette Ads Google Channel','jnews'),
    'description'   => esc_html__('Insert google_ad_channel content.','jnews' ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_page_level_ads_enable',
            'operator' => '==',
            'value'    => true,
        ),
        array(
            'setting'  => 'jnews_page_level_vignette_enable',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

return array_merge(
    $mobile_sticky->ads_option_generator(),
    $options
);