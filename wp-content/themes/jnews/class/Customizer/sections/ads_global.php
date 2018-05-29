<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_background_ads_header',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Background Advertisement','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_background_ads_header_alert',
    'type'          => 'jnews-alert',
    'default'       => 'info',
    'label'         => esc_html__('Background Ad\'s Image','jnews' ),
    'description'   => wp_kses(__("You can set your image background from <strong>JNews : Layout, Color & Scheme</strong> &raquo; <strong>Layout & Background</strong>.", 'jnews'), wp_kses_allowed_html()),
);

$options[] = array(
    'id'            => 'jnews_background_ads_url',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Background Ad\'s URL','jnews'),
    'description'   => esc_html__('Put your Background Ad\'s URL.','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_background_ads_open_tab',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Open URL on New Tab', 'jnews'),
    'description'   => esc_html__('Open advertisement\'s URL in new tab.', 'jnews'),
);

$above_footer = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'above_footer',
    'title' => esc_html__('Above Footer', 'jnews'),
    'default_size' => '970x90',
    'visibility' => array(
        'desktop' => true,
        'tab' => true,
        'phone' => true
    ),
));

$archive_above_content = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'archive_above_content',
    'title' => esc_html__('Above Archive', 'jnews'),
    'default_size' => '728x90',
    'visibility' => array(
        'desktop' => true,
        'tab' => true,
        'phone' => true
    ),
    'postvar' => array(
        array(
            'redirect'  => 'archive_tag',
            'refresh'   => false
        )
    )
));

return array_merge(
    $options,
    $above_footer->ads_option_generator(),
    $archive_above_content->ads_option_generator()
);