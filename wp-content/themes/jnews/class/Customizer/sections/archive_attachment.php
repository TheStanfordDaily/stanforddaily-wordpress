<?php

$options = array();

$all_sidebar = apply_filters('jnews_get_sidebar_widget', null);

// sidebar section
$options[] = array(
    'id'            => 'jnews_attachment_sidebar_section',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Attachment Page Layout','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_attachment_page_layout',
    'transport'     => 'postMessage',
    'default'       => 'right-sidebar',
    'type'          => 'jnews-radio-image',
    'label'         => esc_html__('Page Layout','jnews'),
    'description'   => esc_html__('Choose your page layout.','jnews'),
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
            'redirect'  => 'attachment_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_attachment_sidebar',
    'transport'     => 'postMessage',
    'default'       => 'default-sidebar',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Attachment Sidebar','jnews'),
    'description'   => wp_kses(__("Choose your attachment sidebar. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'       => $all_sidebar,
    'postvar'       => array(
        array(
            'redirect'  => 'attachment_tag',
            'refresh'   => true
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_attachment_page_layout',
            'operator' => '!=',
            'value'    => 'no-sidebar',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_attachment_second_sidebar',
    'transport'     => 'postMessage',
    'default'       => 'default-sidebar',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Second Attachment Sidebar','jnews'),
    'description'   => wp_kses(__("Choose your second sidebar for attachment page. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'       => $all_sidebar,
    'postvar'       => array(
        array(
            'redirect'  => 'attachment_tag',
            'refresh'   => true
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_attachment_page_layout',
            'operator' => 'in',
            'value'    => array('double-sidebar', 'double-right-sidebar'),
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_attachment_sticky_sidebar',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Attachment Sticky Sidebar','jnews'),
    'description'   => esc_html__('Enable sticky sidebar on attachment page.','jnews'),
    'postvar'       => array(
        array(
            'redirect'  => 'attachment_tag',
            'refresh'   => true
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_attachment_page_layout',
            'operator' => '!=',
            'value'    => 'no-sidebar',
        )
    ),
);

return $options;