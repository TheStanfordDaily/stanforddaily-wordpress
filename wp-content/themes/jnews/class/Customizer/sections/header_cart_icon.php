<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_header_cart_icon_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Cart Icon Color','jnews'),
    'description'   => esc_html__('Cart icon color.','jnews'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_cart_icon.woocommerce .jeg_carticon',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_cart_icon_drop_style',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Cart Drop Style','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_header_cart_icon_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Cart Background Color','jnews'),
    'description'   => esc_html__('Cart drop content background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_cart_icon .jeg_cartcontent",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_cart_icon_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Cart Text Color','jnews'),
    'description'   => esc_html__('Cart drop text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_cart_icon.woocommerce ul.cart_list li a,
                                        .jeg_cart_icon.woocommerce ul.product_list_widget li a,
                                        .jeg_cart_icon.woocommerce .widget_shopping_cart_content .total",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_cart_icon_product_quantity_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Product Quantity Color','jnews'),
    'description'   => esc_html__('Product quantity text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_cart_icon.woocommerce .cart_list .quantity,
                                        .jeg_cart_icon.woocommerce .product_list_widget .quantity",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_cart_icon_border_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Cart Border Color','jnews'),
    'description'   => esc_html__('Cart drop border color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_cart_icon.woocommerce .widget_shopping_cart_content .total",
            'property'      => 'border-top-color',
        ),
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_cart_icon.woocommerce .widget_shopping_cart_content .total",
            'property'      => 'border-bottom-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_cart_icon_button_bg_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Cart Button Background Color','jnews'),
    'description'   => esc_html__('Cart drop button background color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_cart_icon.woocommerce .widget_shopping_cart_content .button",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_cart_icon_button_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Cart Button Color','jnews'),
    'description'   => esc_html__('Cart drop button text color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_cart_icon.woocommerce a.button",
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_cart_icon_button_bg_hover_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Cart Button Background Hover Color','jnews'),
    'description'   => esc_html__('Cart drop button background hover color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_cart_icon.woocommerce a.button:hover",
            'property'      => 'background-color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_cart_icon_button_text_hover_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Cart Button Hover Color','jnews'),
    'description'   => esc_html__('Cart drop button text hover color.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => ".jeg_cart_icon.woocommerce a.button:hover",
            'property'      => 'color',
        )
    ),
);

return $options;