<?php

$single_post_redirect = array(
    array(
        'redirect'  => 'single_post_tag',
        'refresh'   => false
    )
);

$article_top = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'article_top',
    'title' => esc_html__('Above Article', 'jnews'),
    'default_size' => '970x90',
    'visibility' => array(
        'desktop' => true,
        'tab' => true,
        'phone' => true
    ),
    'postvar' => $single_post_redirect
));

$content_top = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'content_top',
    'title' => esc_html__('Top Content', 'jnews'),
    'default_size' => '970x90',
    'visibility' => array(
        'desktop' => true,
        'tab' => true,
        'phone' => true
    ),
    'postvar' => $single_post_redirect
));

$content_inline = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'content_inline',
    'title' => esc_html__('Inline Content 1', 'jnews'),
    'default_size' => '728x90',
    'visibility' => array(
        'desktop' => true,
        'tab' => true,
        'phone' => true
    ),
    'postvar' => $single_post_redirect
));

$content_inline_2 = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'content_inline_2',
    'title' => esc_html__('Inline Content 2', 'jnews'),
    'default_size' => '728x90',
    'visibility' => array(
        'desktop' => true,
        'tab' => true,
        'phone' => true
    ),
    'postvar' => $single_post_redirect
));

$content_inline_3 = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'content_inline_3',
    'title' => esc_html__('Inline Content 3', 'jnews'),
    'default_size' => '728x90',
    'visibility' => array(
        'desktop' => true,
        'tab' => true,
        'phone' => true
    ),
    'postvar' => $single_post_redirect
));

$content_bottom = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'content_bottom',
    'title' => esc_html__('Bottom Content', 'jnews'),
    'default_size' => '728x90',
    'visibility' => array(
        'desktop' => true,
        'tab' => true,
        'phone' => true
    ),
    'postvar' => $single_post_redirect
));

$article_bottom = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'article_bottom',
    'title' => esc_html__('Below Article', 'jnews'),
    'default_size' => '970x90',
    'visibility' => array(
        'desktop' => true,
        'tab' => true,
        'phone' => true
    ),
    'postvar' => $single_post_redirect
));

return array_merge(
    $article_top->ads_option_generator(),
    $content_top->ads_option_generator(),
    $content_inline->ads_option_generator(),
    $content_inline_2->ads_option_generator(),
    $content_inline_3->ads_option_generator(),
    $content_bottom->ads_option_generator(),
    $article_bottom->ads_option_generator()
);