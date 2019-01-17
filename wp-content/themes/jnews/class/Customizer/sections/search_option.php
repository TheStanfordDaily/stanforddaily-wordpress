<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_search_only_post',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Only Search Post','jnews'),
    'description'   => esc_html__('WordPress default search will also look for your single page, enable this feature to only search post type.','jnews'),
    'partial_refresh' => array (
        'jnews_search_only_post' => array (
            'selector'        => '.jnews_search_content_wrapper',
            'render_callback' => function() {
                $single = new \JNews\Archive\SearchArchive();
                echo jnews_sanitize_output($single->render_content());
            },
        )
    ),
    'postvar'       => array( array(
        'redirect'  => 'search_tag',
        'refresh'   => false
    ) )
);

return $options;