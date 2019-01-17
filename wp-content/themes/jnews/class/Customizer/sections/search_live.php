<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_live_search_show',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Enable Live Search Block','jnews'),
    'description'   => esc_html__('Turn this option on to enable live search.','jnews'),
);

$options[] = array(
    'id'            => 'jnews_live_search_number_post',
    'transport'     => 'postMessage',
    'default'       => 4,
    'type'          => 'jnews-slider',
    'label'         => esc_html__('Live Search Number of Post', 'jnews'),
    'description'   => esc_html__('Set the number of post on live search result.', 'jnews'),
    'choices'     => array(
        'min'  => '1',
        'max'  => '10',
        'step' => '1',
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_live_search_show',
            'operator' => '==',
            'value'    => true,
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_live_search_date',
    'transport'     => 'postMessage',
    'default'       => 'default',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Live Search Date Format','jnews'),
    'description'   => esc_html__('Choose which date format you want to use for live search.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'ago' => esc_attr__( 'Relative Date/Time Format (ago)', 'jnews' ),
        'default' => esc_attr__( 'WordPress Default Format', 'jnews' ),
        'custom' => esc_attr__( 'Custom Format', 'jnews' ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_live_search_show',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_live_search_date_custom',
    'transport'     => 'postMessage',
    'default'       => 'Y/m/d',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Custom Live Search Date Format','jnews'),
    'description'   => wp_kses(sprintf(__("Please set custom date format for live search. For more detail about this format, please refer to
                                <a href='%s' target='_blank'>Developer Codex</a>.", "jnews"), "https://developer.wordpress.org/reference/functions/current_time/"),
        wp_kses_allowed_html()),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_live_search_date',
            'operator' => '==',
            'value'    => 'custom',
        ),
        array(
            'setting'  => 'jnews_live_search_show',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

return $options;