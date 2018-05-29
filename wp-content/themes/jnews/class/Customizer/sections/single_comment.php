<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_comment_type',
    'transport'     => 'postMessage',
    'default'       => 'wordpress',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Comment Type', 'jnews'),
    'description'   => esc_html__('Choose which comment platform to use.', 'jnews'),
    'choices'       => array(
        'wordpress'     => esc_html__('WordPress Comment', 'jnews'),
        'facebook'      => esc_html__('Facebook Comment', 'jnews'),
        'disqus'        => esc_html__('Disqus Comment', 'jnews'),
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => false
        )
    ),
    'partial_refresh' => array (
        'jnews_comment_type' => array (
            'selector'        => '.jnews_comment_container',
            'render_callback' => function() {
                $single = \JNews\Single\SinglePost::getInstance();
                $single->post_comment();
            },
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_comment_login',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Enable JNews Login Form', 'jnews'),
    'description'   => esc_html__('Use JNews login form on comment login.', 'jnews'),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_comment_type',
            'operator' => '==',
            'value'    => 'wordpress',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_comment_load',
    'transport'     => 'postMessage',
    'default'       => 'normal',
    'type'          => 'jnews-select',
    'label'         => esc_html__('How comment loaded', 'jnews'),
    'description'   => esc_html__('Choose how the comment loaded', 'jnews'),
    'choices'       => array(
        'normal'          => esc_attr__( 'Normal Load', 'jnews' ),
        'click'           => esc_attr__( 'Load when Click', 'jnews' ),
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_comment_type',
            'operator' => 'in',
            'value'    => array('facebook', 'disqus'),
        )
    ),
    'partial_refresh' => array (
        'jnews_comment_load' => array (
            'selector'        => '.jnews_comment_container',
            'render_callback' => function() {
                $single = \JNews\Single\SinglePost::getInstance();
                $single->post_comment();
            },
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_comment_disqus_shortname',
    'transport'     => 'refresh',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Disqus Shortname', 'jnews'),
    'description'   => wp_kses(sprintf(__("Please register your website first and get shortname for your website <a href='%s' target='_blank'>here</a>.", "jnews"), "https://disqus.com/admin/create/"), wp_kses_allowed_html()),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_comment_type',
            'operator' => '==',
            'value'    => 'disqus',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_comment_disqus_api_key',
    'transport'     => 'refresh',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Disqus API Key', 'jnews'),
    'description'   => wp_kses(sprintf(__("Insert your Disqus API Key. You can create an application and get Disqus API Key <a href='%s' target='_blank'>here</a>.", "jnews"), "http://disqus.com/api/applications/register/"), wp_kses_allowed_html()),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_comment_type',
            'operator' => '==',
            'value'    => 'disqus',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_comment_facebook_appid',
    'transport'     => 'refresh',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Facebook App ID', 'jnews'),
    'description'   => wp_kses(sprintf(__("The unique ID that lets Facebook know the identity of your site. You can create your Facebook App ID <a href='%s' target='_blank'>here</a>.", "jnews"), "https://developers.facebook.com/docs/apps/register"), wp_kses_allowed_html()),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_comment_type',
            'operator' => '==',
            'value'    => 'facebook',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_comment_cache_expired',
    'transport'     => 'postMessage',
    'default'       => '1',
    'type'          => 'jnews-slider',
    'label'         => esc_html__('Comment Cache Lifetime', 'jnews'),
    'description'   => esc_html__('Set the lifetime of comment cache in hours.', 'jnews'),
    'choices'       => array(
        'min'  => '1',
        'max'  => '24',
        'step' => '1',
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_comment_type',
            'operator' => '!=',
            'value'    => 'wordpress',
        )
    ),
);

return $options;