<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_option[article_schema_type]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 'article',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Blog Page Schema Type','jnews-jsonld'),
    'description'   => esc_html__('Choose which schema you want to use for your blog post.','jnews-jsonld'),
    'choices'       => array(
        'Article'           => esc_attr__( 'Article', 'jnews-jsonld' ),
        'BlogPosting'       => esc_attr__( 'Blog Posting', 'jnews-jsonld' ),
        'NewsArticle'       => esc_attr__( 'News Article', 'jnews-jsonld' ),
        'TechArticle'       => esc_attr__( 'Tech Article ', 'jnews-jsonld' ),
    ),
);

return $options;