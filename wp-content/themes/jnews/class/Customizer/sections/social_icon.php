<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_social_icon_notice',
    'type'          => 'jnews-alert',
    'default'       => 'info',
    'label'         => esc_html__('Info','jnews' ),
    'description'   => wp_kses(__(
        '<ul>
                    <li>This social icon will show on header & footer of your website. </li>
                    <li>Also will be used if you install JNews - Meta Header & JNews - JSON LD plugin</li>
                </ul>',
        'jnews'), wp_kses_allowed_html()),
);

$options[] = array(
    'id'            => 'jnews_social_icon',
    'transport'     => 'postMessage',
    'type'          => 'jnews-repeater',
    'label'         => esc_html__('Add Social Icon', 'jnews'),
    'description'   => esc_html__('Add icon for each of your social account.', 'jnews'),
    'default'       => array(
        array(
            'social_icon' => 'facebook',
            'social_url'  => 'https://www.facebook.com/jegtheme/'
        ),
        array(
            'social_icon' => 'twitter',
            'social_url'  => 'https://twitter.com/jegtheme'
        ),
    ),
    'row_label'     => array(
        'type' => 'text',
        'value' => esc_attr__( 'Social Icon', 'jnews' ),
        'field' => false,
    ),
    'fields' => array(
        'social_icon' => array(
            'type'        => 'select',
            'label'       => esc_attr__( 'Social Icon', 'jnews' ),
            'default'     => '',
            'choices'     => array(
                ''              => esc_attr__( 'Choose Icon', 'jnews' ),
                'facebook'      => esc_attr__( 'Facebook', 'jnews' ),
                'twitter'       => esc_attr__( 'Twitter', 'jnews' ),
                'linkedin'      => esc_attr__( 'Linkedin', 'jnews' ),
                'googleplus'    => esc_attr__( 'Google+', 'jnews' ),
                'pinterest'     => esc_attr__( 'Pinterest', 'jnews' ),
                'behance'       => esc_attr__( 'Behance', 'jnews' ),
                'github'        => esc_attr__( 'Github', 'jnews' ),
                'flickr'        => esc_attr__( 'Flickr', 'jnews' ),
                'tumblr'        => esc_attr__( 'Tumblr', 'jnews' ),
                'telegram'      => esc_attr__( 'Telegram', 'jnews' ),
                'dribbble'      => esc_attr__( 'Dribbble', 'jnews' ),
                'soundcloud'    => esc_attr__( 'Soundcloud', 'jnews' ),
                'stumbleupon'   => esc_attr__( 'StumbleUpon', 'jnews' ),
                'instagram'     => esc_attr__( 'Instagram', 'jnews' ),
                'vimeo'         => esc_attr__( 'Vimeo', 'jnews' ),
                'youtube'       => esc_attr__( 'Youtube', 'jnews' ),
                'twitch'        => esc_attr__( 'Twitch', 'jnews' ),
                'vk'            => esc_attr__( 'Vk', 'jnews' ),
                'reddit'        => esc_attr__( 'Reddit', 'jnews' ),
                'weibo'         => esc_attr__( 'Weibo', 'jnews' ),
                'rss'           => esc_attr__( 'RSS', 'jnews' ),
            ),
        ),
        'social_url' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Social URL', 'jnews' ),
            'default'     => '',
        ),
    ),
    'partial_refresh' => array (
        'social_icon' => array (
            'selector'              => '.jeg_top_socials',
            'render_callback'       => function() {
                return jnews_generate_social_icon(false);
            },
        ),
        'social_icon2' => array (
            'selector'              => '.jeg_social_icon_block',
            'render_callback'       => function() {
                return jnews_generate_social_icon_block(false);
            },
        ),
        'social_icon3' => array (
            'selector'              => '.jeg_new_social_icon_block',
            'render_callback'       => function() {
                return jnews_generate_social_icon_block(false, true);
            },
        ),
        'social_icon_mobile_menu' => array (
            'selector'              => '.jeg_mobile_socials',
            'render_callback'       => function() {
                return jnews_generate_social_icon(false);
            },
        ),
    ),
);

return $options;