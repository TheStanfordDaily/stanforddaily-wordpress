<?php

$options = array();

$all_sidebar = apply_filters('jnews_get_sidebar_widget', null);

$options[] = array(
    'id'            => 'jnews_woocommerce_archive_section',
    'type'          => 'jnews-header',
    'label'         => esc_html__('WooCommerce Archive','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_woocommerce_archive_page_layout',
    'transport'     => 'postMessage',
    'default'       => 'right-sidebar',
    'type'          => 'jnews-radio-image',
    'label'         => esc_html__('Page Layout','jnews' ),
    'description'   => esc_html__('Choose page layout on WooCommerce shop page, or category.','jnews'),
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
            'redirect'  => 'woo_archive_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_woocommerce_archive_sidebar',
    'transport'     => 'postMessage',
    'default'       => 'default-sidebar',
    'type'          => 'jnews-select',
    'label'         => esc_html__('WooCommerce Archive Sidebar','jnews'),
    'description'   => wp_kses(__("Choose your WooCommerce Archive sidebar. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'       => $all_sidebar,
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_woocommerce_archive_page_layout',
            'operator' => '!=',
            'value'    => 'no-sidebar',
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'woo_archive_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_woocommerce_archive_second_sidebar',
    'transport'     => 'postMessage',
    'default'       => 'default-sidebar',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Second WooCommerce Archive Sidebar','jnews'),
    'description'   => wp_kses(__("Choose your second sidebar for WooCommerce Archive page. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'       => $all_sidebar,
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_woocommerce_archive_page_layout',
            'operator' => 'in',
            'value'    => array('double-sidebar', 'double-right-sidebar'),
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'woo_archive_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_woocommerce_sticky_sidebar',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('WooCommerce Archive Sticky Sidebar','jnews'),
    'description'   => esc_html__('Enable sticky sidebar on woocommerce archive page.','jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_woocommerce_archive_page_layout',
            'operator' => '!=',
            'value'    => 'no-sidebar',
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'woo_archive_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_woocommerce_single_section',
    'type'          => 'jnews-header',
    'label'         => esc_html__('WooCommerce Single','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_woocommerce_single_page_layout',
    'transport'     => 'postMessage',
    'default'       => 'right-sidebar',
    'type'          => 'jnews-radio-image',
    'label'         => esc_html__('Page Layout','jnews' ),
    'description'   => esc_html__('Choose page layout on WooCommerce single page.','jnews'),
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
            'redirect'  => 'woo_single_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_woocommerce_single_sidebar',
    'transport'     => 'postMessage',
    'default'       => 'default-sidebar',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Woocommerce Single Sidebar','jnews'),
    'description'   => wp_kses(__("Choose your WooCommerce single sidebar. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'       => $all_sidebar,
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_woocommerce_single_page_layout',
            'operator' => '!=',
            'value'    => 'no-sidebar',
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'woo_single_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_woocommerce_single_second_sidebar',
    'transport'     => 'postMessage',
    'default'       => 'default-sidebar',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Second Woocommerce Single Sidebar','jnews'),
    'description'   => wp_kses(__("Choose your second sidebar for WooCommerce single page. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'       => $all_sidebar,
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_woocommerce_single_page_layout',
            'operator' => 'in',
            'value'    => array('double-sidebar', 'double-right-sidebar'),
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'woo_single_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_woocommerce_single_sticky_sidebar',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Woocommerce Single Sticky Sidebar','jnews'),
    'description'   => esc_html__('Enable sticky sidebar on woocommerce single page.','jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_woocommerce_single_page_layout',
            'operator' => '!=',
            'value'    => 'no-sidebar',
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'woo_single_tag',
            'refresh'   => true
        )
    )
);

return $options;