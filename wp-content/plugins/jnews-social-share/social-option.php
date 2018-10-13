<?php

$options = array();


$options[] = array(
    'id'            => 'jnews_option[single_view_option]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 'jnews',
    'type'          => 'jnews-select',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('View Counter Script','jnews-social-share'),
    'description'   => wp_kses(__(
        "<ul>
                        <li>Please choose view counter script on single page.</li>                        
                        <li>Please be aware value of each counter script may be different.</li>
                        <li>You will need to install one plugin of <strong>JNews - View Counter</strong> or <strong>Jetpack</strong> that based on option that you chosen below.</li>
                        <li>We recommend you only to stick to one view counter script for more consistent result.</li>
                    </ul>",
        'jnews-social-share'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'     => array(
        'jnews'     => esc_attr__( 'JNews View Counter', 'jnews-social-share' ),
        'jetpack'   => esc_attr__( 'Jetpack View Counter', 'jnews-social-share' ),
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    )
);

$single_post_tag = array(
    'redirect'  => 'single_post_tag',
    'refresh'   => false
);

$top_share = array (
    'selector'        => '.jeg_share_top_container',
    'render_callback' => function() {
        do_action('jnews_share_top_bar', get_the_ID());
    },
);

$float_share = array (
    'selector'        => '.jeg_share_float_container',
    'render_callback' => function() {
        do_action('jnews_share_float_bar', get_the_ID());
    },
);

$bottom_share = array(
    'selector'        => '.jeg_share_bottom_container',
    'render_callback' => function() {
        do_action('jnews_share_bottom_bar', get_the_ID());
    },
);

$options[] = array(
    'id'            => 'jnews_single_view_header',
    'type'          => 'jnews-header',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('View Option','jnews-social-share' ),
);

$options[] = array(
    'id'            => 'jnews_option[single_view_option]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 'jnews',
    'type'          => 'jnews-select',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('View Counter Script','jnews-social-share'),
    'description'   => wp_kses(__(
        "<ul>
                        <li>Please choose view counter script on single page.</li>                        
                        <li>Please be aware value of each counter script may be different.</li>
                        <li>You will need to install one plugin of <strong>JNews - View Counter</strong> or <strong>Jetpack</strong> that based on option that you chosen below.</li>
                        <li>We recommend you only to stick to one view counter script for more consistent result.</li>
                    </ul>",
        'jnews-social-share'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'     => array(
        'jnews'     => esc_attr__( 'JNews View Counter', 'jnews-social-share' ),
        'jetpack'   => esc_attr__( 'Jetpack View Counter', 'jnews-social-share' ),
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_single_social_share_main_header',
    'type'          => 'jnews-header',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('Share Bar Social Icon','jnews-social-share' ),
);

$share_network = array(
    ''              => esc_attr__( 'Choose Share Network', 'jnews-social-share' ),
    'facebook'      => esc_attr__( 'Facebook', 'jnews-social-share' ),
    'twitter'       => esc_attr__( 'Twitter', 'jnews-social-share' ),
    'linkedin'      => esc_attr__( 'Linkedin', 'jnews-social-share' ),
    'googleplus'    => esc_attr__( 'Google+', 'jnews-social-share' ),
    'pinterest'     => esc_attr__( 'Pinterest', 'jnews-social-share' ),
    'stumbleupon'   => esc_attr__( 'Stumbleupon', 'jnews-social-share' ),
    'reddit'        => esc_attr__( 'Reddit', 'jnews-social-share' ),
    'tumblr'        => esc_attr__( 'Tumblr', 'jnews-social-share' ),
    'whatsapp'      => esc_attr__( 'Whatsapp', 'jnews-social-share' ),
    'vk'            => esc_attr__( 'Vk', 'jnews-social-share' ),
    'qrcode'        => esc_attr__( 'QR Code', 'jnews-social-share' ),
    'wechat'        => esc_attr__( 'Wechat', 'jnews-social-share' ),
    'line'          => esc_attr__( 'Line', 'jnews-social-share' ),
    'hatena'        => esc_attr__( 'Hatena', 'jnews-social-share' ),
    'email'         => esc_attr__( 'Email', 'jnews-social-share' ),
);

$options[] = array(
    'id'            => 'jnews_option[single_social_share_main]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'type'          => 'jnews-repeater',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('Main Share Network', 'jnews-social-share'),
    'description'   => wp_kses(__('Main share network will always show on your share post container. <br/>Fill share text if you need your share button to have share text on it, but leave it empty to make it look like default button.', 'jnews-social-share'), wp_kses_allowed_html()),
    'default'       => array(
        array(
            'social_share'  => 'facebook',
            'social_text'   => 'Share on Facebook'
        ),
        array(
            'social_share'   => 'twitter',
            'social_text'    => 'Share on Twitter'
        ),
        array(
            'social_share'   => 'googleplus',
            'social_text'    => ''
        ),
    ),
    'row_label'     => array(
        'type' => 'text',
        'value' => esc_attr__( 'Main Share Button', 'jnews-social-share' ),
        'field' => false,
    ),
    'fields' => array(
        'social_share' => array(
            'type'        => 'select',
            'label'       => esc_attr__( 'Share Network', 'jnews-social-share' ),
            'default'     => '',
            'choices'     => $share_network
        ),
        'social_text' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Share Text', 'jnews-social-share' ),
            'default'     => '',
        ),
    ),
    'partial_refresh' => array (
        'jnews_single_social_share_main_top'    => $top_share,
        'jnews_single_social_share_main_float'  => $float_share,
        'jnews_single_social_share_main_bottom' => $bottom_share,
    ),
    'postvar'       => array( $single_post_tag )
);

$options[] = array(
    'id'            => 'jnews_option[single_social_share_secondary]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'type'          => 'jnews-repeater',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('Secondary Share Network', 'jnews-social-share'),
    'description'   => wp_kses(__('Secondary share network will not shown until user click plus (+) button on your share container.', 'jnews-social-share'), wp_kses_allowed_html()),
    'default'       => array(
        array(
            'social_share'  => 'linkedin',
        ),
        array(
            'social_share'   => 'pinterest',
        ),
    ),
    'row_label'     => array(
        'type' => 'text',
        'value' => esc_attr__( 'Secondary Share', 'jnews-social-share' ),
        'field' => false,
    ),
    'fields' => array(
        'social_share' => array(
            'type'        => 'select',
            'label'       => esc_attr__( 'Share Network', 'jnews-social-share' ),
            'default'     => '',
            'choices'     => $share_network
        ),
    ),
    'partial_refresh' => array (
        'jnews_single_social_share_secondary_top'    => $top_share,
        'jnews_single_social_share_secondary_float'  => $float_share,
        'jnews_single_social_share_secondary_bottom' => $bottom_share,
    ),
    'postvar'       => array( $single_post_tag )
);

$options[] = array(
    'id'            => 'jnews_single_social_share_detail',
    'type'          => 'jnews-header',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('Share Bar Setting Detail','jnews-social-share' ),
);

$options[] = array(
    'id'            => 'jnews_option[single_social_share_threshold]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 0,
    'type'          => 'jnews-number',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('Social Share Threshold', 'jnews-social-share'),
    'description'   => esc_html__('Only show social share total number if its more than this threshold.', 'jnews-social-share'),
    'choices'     => array(
        'min'  => '0',
        'max'  => '99999',
        'step' => '5',
    ),
    'partial_refresh' => array (
        'jnews_single_social_share_threshold' => $top_share
    ),
    'postvar'       => array( $single_post_tag )
);

$options[] = array(
    'id'            => 'jnews_option[single_social_share_via_twitter]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('Twitter Account','jnews-social-share'),
    'description'   => esc_html__('Default Twitter account (username) as share reference.','jnews-social-share'),
    'partial_refresh' => array (
        'jnews_single_social_share_via_twitter' => $top_share
    ),
);

$options[] = array(
    'id'            => 'jnews_option[single_social_share_fb_id]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('Facebook App ID','jnews-social-share'),
    'description'   => sprintf(__('You can create an application and get Facebook App ID <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://developers.facebook.com/docs/apps/register'),
);

$options[] = array(
    'id'            => 'jnews_option[single_social_share_fb_secret]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('Facebook App Secret','jnews-social-share'),
    'description'   => sprintf(__('You can create an application and get Facebook App Secret <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://developers.facebook.com/docs/apps/register'),
);

$options[] = array(
    'id'            => 'jnews_option[single_social_share_fb_token]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('Facebook Access Token','jnews-social-share'),
    'description'   => sprintf(__('Get your Facebook Access Token by clicking this <a class="%s" href="%s" target="_blank">link</a>.<span class="jnews-spinner spinner"></span>', 'jnews'), 'jnews_token_access facebook', '#'),
);

$options[] = array(
    'id'            => 'jnews_single_fake_counter_header',
    'type'          => 'jnews-header',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('Initial Counter','jnews-social-share' ),
);


$options[] = array(
    'id'            => 'jnews_option[single_view_initial_value]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 0,
    'type'          => 'jnews-number',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('Initial View Count', 'jnews-social-share'),
    'description'   => esc_html__('This value will increase your initial view counter. This value will also affect social share value (if you choose to use social share option above).', 'jnews-social-share'),
    'choices'     => array(
        'min'  => 0,
        'max'  => 999999,
        'step' => 1,
    ),
    'partial_refresh' => array (
        'jnews_single_view_initial_value_top'       => $top_share,
        'jnews_single_view_initial_value_bottom'    => $bottom_share
    ),
    'postvar'       => array( $single_post_tag )
);

$options[] = array(
    'id'            => 'jnews_option[single_social_share_view_percentage]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 0,
    'type'          => 'jnews-slider',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('Social Share Value base on View', 'jnews-social-share'),
    'description'   => esc_html__('We increase your social share value base on percentage of your view. You can change value of percentage using this input.', 'jnews-social-share'),
    'choices'     => array(
        'min'  => '0',
        'max'  => '100',
        'step' => '1',
    ),
    'partial_refresh' => array (
        'jnews_single_social_share_view_percentage_top'     => $top_share,
        'jnews_single_social_share_view_percentage_bottom'  => $bottom_share
    ),
    'postvar'       => array( $single_post_tag )
);

$options[] = array(
    'id'            => 'jnews_option[single_like_view_percentage]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 0,
    'type'          => 'jnews-slider',
    'section'       => 'jnews_social_like_section',
    'label'         => esc_html__('Like Percentage base on View', 'jnews-social-share'),
    'description'   => esc_html__('We increase your like value base on percentage of your view. Dislike will also calculated by using your title length.', 'jnews-social-share'),
    'choices'     => array(
        'min'  => '0',
        'max'  => '100',
        'step' => '1',
    ),
    'partial_refresh' => array (
        'jnews_option[single_like_view_percentage]' => array (
            'selector'        => '.jeg_meta_container',
            'render_callback' => function() {
                $single = JNews\Single\SinglePost::getInstance();
                $single->render_post_meta();
            },
        ),
    ),
    'postvar'       => array( $single_post_tag )
);

return $options;