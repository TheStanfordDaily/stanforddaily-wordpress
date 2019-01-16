<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_mobile_truncate',
    'transport'     => 'refresh',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Enable mobile truncate', 'jnews'),
    'description'   => esc_html__('turn this option on to enable mobile truncate', 'jnews'),
    'postvar'       => array( array(
        'redirect'  => 'single_post_tag',
        'refresh'   => false
    ))
);

$options[] = array(
    'id'            => 'jnews_mobile_truncate_btn_bg',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'disable_color' => true,
    'label'         => esc_html__('Mobile button background','jnews'),
    'description'   => esc_html__('Mobile button background colors','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_mobile_truncate',
            'operator' => '==',
            'value'    => true,
        ),
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.mobile-truncate .truncate-read-more span',
            'property'      => 'background',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_mobile_truncate_btn_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'disable_color' => true,
    'label'         => esc_html__('Mobile button color','jnews'),
    'description'   => esc_html__('Mobile button text color','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_mobile_truncate',
            'operator' => '==',
            'value'    => true,
        ),
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.mobile-truncate .truncate-read-more span',
            'property'      => 'color',
        )
    ),
);

return $options;