<?php

$category_post_redirect = array(
    array(
        'redirect'  => 'category_tag',
        'refresh'   => false
    )
);

$archive_above_hero = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'archive_above_hero',
    'title' => esc_html__('Above Hero', 'jnews'),
    'default_size' => '728x90',
    'visibility' => array(
        'desktop' => true,
        'tab' => true,
        'phone' => true
    ),
    'postvar' => $category_post_redirect
));

$archive_below_hero = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'archive_below_hero',
    'title' => esc_html__('Below Hero', 'jnews'),
    'default_size' => '728x90',
    'visibility' => array(
        'desktop' => true,
        'tab' => true,
        'phone' => true
    ),
    'postvar' => $category_post_redirect
));

$inline_module = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'inline_module',
    'title' => esc_html__('Inline Module', 'jnews'),
    'default_size' => '728x90',
    'visibility' => array(
        'desktop' => true,
        'tab' => true,
        'phone' => true
    ),
    'postvar' => $category_post_redirect
));

return array_merge(
    $archive_above_hero->ads_option_generator(),
    $archive_below_hero->ads_option_generator(),
    $inline_module->ads_option_generator()
);