<?php

$header_top = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'header_top',
    'title' => esc_html__('Above Header', 'jnews'),
    'default_size' => '970x90',
    'visibility' => array(
        'desktop' => true,
        'tab' => true,
        'phone' => true
    )
));

$header = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'header',
    'title' => esc_html__('Header', 'jnews'),
    'default_size' => '728x90',
    'visibility' => array(
        'desktop' => true,
        'tab' => false,
        'phone' => false
    ),
    'default' => array(
        'jnews_ads_header_enable' => 1,
        'jnews_ads_header_type' => 'image',
        'jnews_ads_header_image' => get_parent_theme_file_uri('assets/img/ad_728x90.png'),
        'jnews_ads_header_link' => '#',
        'jnews_ads_header_text' => esc_html__('Advertisement', 'jnews')
    )
));

return array_merge(
    $header_top->ads_option_generator(),
    $header->ads_option_generator()
);