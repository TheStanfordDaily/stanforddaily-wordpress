<?php

$options = array();

$all_sidebar = apply_filters('jnews_get_sidebar_widget', null);

$options[] = array(
    'id'            => 'jnews_bbpress_archive_section',
    'type'          => 'jnews-header',
    'label'         => esc_html__('BBPress Page Layout','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_bbpress_page_layout',
    'transport'     => 'postMessage',
    'default'       => 'right-sidebar',
    'type'          => 'jnews-radio-image',
    'label'         => esc_html__('Page Layout','jnews' ),
    'description'   => esc_html__('Choose page layout on BBPress page.','jnews'),
    'choices'       => array(
        'right-sidebar'         => '',
        'left-sidebar'          => '',
        'right-sidebar-narrow'  => '',
        'left-sidebar-narrow'   => '',
        'double-sidebar'        => '',
        'double-right-sidebar'  => '',
        'no-sidebar'            => ''
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'bbpress_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_bbpress_sidebar',
    'transport'     => 'postMessage',
    'default'       => 'default-sidebar',
    'type'          => 'jnews-select',
    'label'         => esc_html__('BBPress Sidebar','jnews'),
    'description'   => wp_kses(__("Choose your BBPress archive sidebar. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'       => $all_sidebar,
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_bbpress_page_layout',
            'operator' => '!=',
            'value'    => 'no-sidebar',
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'bbpress_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_bbpress_second_sidebar',
    'transport'     => 'postMessage',
    'default'       => 'default-sidebar',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Second BBPress Sidebar','jnews'),
    'description'   => wp_kses(__("Choose your second sidebar for BBPress archive page. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'       => $all_sidebar,
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_bbpress_page_layout',
            'operator' => 'in',
            'value'    => array('double-sidebar', 'double-right-sidebar'),
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'bbpress_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_bbpress_sticky_sidebar',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('BBPress Sidebar','jnews'),
    'description'   => esc_html__('Enable sticky sidebar on bbpress page.','jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_bbpress_page_layout',
            'operator' => '!=',
            'value'    => 'no-sidebar',
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'bbpress_tag',
            'refresh'   => true
        )
    )
);

return $options;