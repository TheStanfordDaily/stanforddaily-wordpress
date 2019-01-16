<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Ajax;

/**
 * Class JNews Website Fragment
 */
Class FirstLoadAction
{
    public function build_response($action)
    {
        $response = array();

        if(in_array('desktop_login', $action)) {
            $response['desktop_login'] = $this->top_bar_account();
        }

        if(in_array('mobile_login', $action)) {
            $response['mobile_login'] = $this->mobile_account();
        }

        if(in_array('login_form', $action)) {
            $response['social_login_form'] = $this->social_login();
            $response['social_register_form'] = $this->social_register();
            $response['account_nonce'] = $this->account_nonce();
        }

        $response = apply_filters('jnews_do_first_load_action', $response, $action);

        wp_send_json($response);
    }

    public function account_nonce()
    {
        return wp_create_nonce('jnews_nonce');
    }

    public function top_bar_account()
    {
        if(!is_user_logged_in()) {

            $output = "<li><a href=\"#jeg_loginform\" class=\"jeg_popuplink\"><i class=\"fa fa-lock\"></i> " .  jnews_return_translation('Login', 'jnews', 'login') . "</a></li>";

            if(get_option( 'users_can_register' )) {
                $output .= "<li><a href=\"#jeg_registerform\" class=\"jeg_popuplink\"><i class=\"fa fa-user\"></i> " . jnews_return_translation('Register', 'jnews', 'register') . "</a></li>";
            }

        } else {
            $current_user = wp_get_current_user();
	        $endpoint = \JNews\AccountPage::getInstance()->get_endpoint();
	        $account_url = apply_filters('jnews_top_bar_account_url', home_url('/' . $endpoint['account']['slug']));

            $output =
                "<li>
                    <a href=\"" . $account_url . "\" class=\"logged\">" . get_avatar( $current_user->user_email, 22 ) . esc_html($current_user->display_name) . "</a>                    
                    " . $this->dropdown() . "
                </li>";
        }

        return $output;
    }

    public function mobile_account()
    {
        $cartoutput = "";

        if(function_exists('is_woocommerce')) {
            $cartoutput = "<li class=\"cart\"><a href=\"" . wc_get_cart_url() . "\"><i class=\"fa fa-shopping-cart\"></i> " . jnews_return_translation('Cart', 'jnews', 'cart') . "</a></li>";
        }

        if(!is_user_logged_in()) {

            $registeroutput = "";

            if(get_option( 'users_can_register' )) {
                $registeroutput = "<li><a href=\"#jeg_registerform\" class=\"jeg_popuplink\"><i class=\"fa fa-user\"></i> " . jnews_return_translation('Sign Up', 'jnews', 'sign_up') . "</a></li>";
            }

            $output =
                "<ul class=\"jeg_accountlink\">
                    <li><a href=\"#jeg_loginform\" class=\"jeg_popuplink\"><i class=\"fa fa-lock\"></i> " .  jnews_return_translation('Login', 'jnews', 'login') . "</a></li>
                    {$registeroutput}
                    {$cartoutput}
                </ul>";

        } else {

            $current_user = wp_get_current_user();
	        $endpoint = \JNews\AccountPage::getInstance()->get_endpoint();
            $account_url = apply_filters('jnews_mobile_account_url', home_url('/' . $endpoint['account']['slug']));

            $output =
                "<div class=\"profile_box\">
                    <a href=\"{$account_url}\" class=\"profile_img\">" . get_avatar( $current_user->user_email, 55 ) . "</a>
                    <h3><a href=\"{$account_url}\" class=\"profile_name\">" . esc_html(get_the_author_meta('display_name', get_current_user_id())) . "</a></h3>
                    <ul class=\"profile_links\">
                        <li><a href=\"{$account_url}\"><i class=\"fa fa-user\"></i> " . jnews_return_translation('Account', 'jnews', 'account') . "</a></li>
                        {$cartoutput}
                        <li><a href=\"" . esc_url(wp_logout_url()) . "\" class=\"logout\"><i class=\"fa fa-sign-out\"></i> " . jnews_return_translation('Logout', 'jnews', 'logout') . "</a></li>
                    </ul>
                </div>";

        }

        return $output;
    }

    public function dropdown()
    {
        $dropdown_html = '';
        $dropdown = array();

        if(function_exists('is_woocommerce'))
        {
            $dropdown['order'] = array(
                'text' => jnews_return_translation('Order List', 'jnews', 'order_list'),
                'url' => wc_get_account_endpoint_url('orders')
            );

            $dropdown['edit-account'] = array(
                'text' => jnews_return_translation('Edit Account', 'jnews', 'edit_profile'),
                'url' => wc_get_account_endpoint_url('edit-account')
            );
        }

        $dropdown['logout'] = array(
            'text' => jnews_return_translation('Logout', 'jnews', 'logout'),
            'url' => wp_logout_url()
        );

        $dropdown = apply_filters('jnews_dropdown_link', $dropdown);

        foreach($dropdown as $key => $value)
        {
            $dropdown_html .= "<li><a href=\"{$value['url']}\" class=\"{$key}\">{$value['text']}</a></li>";
        }

        return "<ul>" . $dropdown_html . "</ul>";
    }

    public function social_login()
    {
        $output = "<h3>" . jnews_return_translation('Welcome Back!', 'jnews', 'welcome_back') . "</h3>";

        if ( defined('JNEWS_SOCIAL_LOGIN') ) 
        {
            $output .= apply_filters( 'jnews_social_login', '', 'login' );
        }

        return $output;
    }

    public function social_register()
    {
        $output = "<h3>" . jnews_return_translation('Create New Account!', 'jnews', 'create_new_account') . "</h3>";

        if ( defined('JNEWS_SOCIAL_LOGIN') ) 
        {
            $output .= apply_filters( 'jnews_social_login', '', 'register' );
        }

        return $output;
    }
}