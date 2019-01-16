<?php

$options = array();


$options[] = array(
    'id'            => 'jnews_block_notice',
    'type'          => 'jnews-alert',
    'default'       => 'info',
    'label'         => esc_html__('Notice','jnews' ),
    'description'   => wp_kses(__(
        '<ul>
                    <li>This option will affect Module Block, Widget, Live Search, and Side Feed</li>
                    <li>Every element will behave differently when option changed depend on default meta on each element</li>
                </ul>',
        'jnews'), wp_kses_allowed_html()),
);

$options[] = array(
    'id'            => 'jnews_show_block_meta',
    'transport'     => 'refresh',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Block Meta','jnews'),
    'description'   => esc_html__('Show meta for block','jnews'),
);

$options[] = array(
    'id'            => 'jnews_show_block_meta_author',
    'transport'     => 'refresh',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Block Meta - Author','jnews'),
    'description'   => esc_html__('Show author on meta block','jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_show_block_meta',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_show_block_meta_date',
    'transport'     => 'refresh',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Block Meta - Date','jnews'),
    'description'   => esc_html__('Show date on meta block','jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_show_block_meta',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_show_block_meta_comment',
    'transport'     => 'refresh',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Block Meta - Comment','jnews'),
    'description'   => esc_html__('Show comment icon on meta block','jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_show_block_meta',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_show_block_meta_rating',
    'transport'     => 'refresh',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Block Meta - Rating','jnews'),
    'description'   => esc_html__('Show rating on meta block','jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_show_block_meta',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

return $options;