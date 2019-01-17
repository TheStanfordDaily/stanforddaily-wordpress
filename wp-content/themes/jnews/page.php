<?php

if(function_exists('is_woocommerce') && ( is_account_page() || is_shop()
        || is_product_taxonomy() || is_product()  || is_cart()
        || is_checkout() || is_checkout_pay_page() || is_order_received_page()
        || is_wc_endpoint_url('order-pay') || is_wc_endpoint_url('order-received')
        || is_wc_endpoint_url('view-order') || is_wc_endpoint_url('edit-account')
        || is_wc_endpoint_url('edit-address') || is_wc_endpoint_url('lost-password')
        || is_wc_endpoint_url('customer-logout') || is_wc_endpoint_url('add-payment-method')
    )) {
    get_template_part('page', 'shop');
} else if(is_page()) {
    get_template_part('page', 'default');
} else if(function_exists('is_bbpress') && is_bbpress()) {
    get_template_part('page', 'forum');
} else {
    get_template_part('page', 'global');
}