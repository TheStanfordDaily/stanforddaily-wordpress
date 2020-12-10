<?php
namespace FileBird\Classes;

defined('ABSPATH') || exit;

class TabActive {

    private static $server_url = 'http://fb-server/wp-admin/admin-ajax.php';

    public static function hooks() {
        add_filter('fbv_data', array(__CLASS__, 'localize_fbv_data'));
        add_action('wp_ajax_fb_login_envato_success', array(__CLASS__, 'ajax_login_envato_success'));
        add_action('wp_ajax_fb_get_saved_envato_token', array(__CLASS__, 'ajax_fb_get_saved_envato_token'));
        add_action('wp_ajax_filebird_active_license', array(__CLASS__, 'ajax_filebird_active_license'));
    }

    public function ajax_login_envato_success() {
        $token = isset($_GET['token']) ? $_GET['token'] : '';
        if($token !== '') {
            update_option('fb_envato_token', $token);
        }
        exit('<script>window.close()</script>');
    }

    public function ajax_fb_get_saved_envato_token() {
        wp_send_json_success(array(
            'token' => get_option('fb_envato_token')
        ));
    }

    public static function ajax_filebird_active_license() {
        // $purchase_code = isset($_POST['purchase_code']) ? $_POST['purchase_code'] : '';
        $envato_token = isset($_POST['envato_token']) ? sanitize_text_field($_POST['envato_token']) : '';

        $domain = preg_replace('#https?:\/\/#', '', get_bloginfo('url'));
        $current_user = wp_get_current_user();

        $response = wp_remote_post(
            add_query_arg(array('action' => 'fb_action', 'act' => 'check_domain'), self::$server_url),
            array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(),
                'body' => array(
                    'data' => array(
                        // 'code' => $purchase_code,
                        'token' => $envato_token,
                        'domain' => $domain,
                        'email' => $current_user->user_email,
                        'firstname' => isset($current_user->user_firstname) ? $current_user->user_firstname : '',
                        'lastname' => isset($current_user->user_lastname) ? $current_user->user_lastname : '',
                    )
                )
            )
        );

        if (!is_wp_error($response)) {
            $json = json_decode($response["body"]);

            if ($json->success) {
                update_option('fb_envato_token', $envato_token);
                update_option('fb_purchase_code', $purchase_code);
                update_option('fb_activated', $json->data->success);
                update_option('supported_until', $json->data->supported_until);
                update_option('fb_license', $json->data->license);
                wp_send_json_success();
            } else {
                wp_send_json_error(array('html' => $response, 'mess' => __('Could not use this purchase code for your domain.', 'filebird')));
            }
        } else {
            wp_send_json_error(array('html' => $response, 'mess' => __('Could not verify your domain.', 'filebird')));
        }
    }

    public static function localize_fbv_data($data) {
        $return_url = add_query_arg(array('action' => 'fb_login_envato_success'), admin_url('admin-ajax.php'));
        $data['login_envato_url'] = esc_url(add_query_arg(array(
            'action' => 'fb_action',
            'act' => 'login',
            'return_url' => $return_url
        ), self::$server_url));
        return $data;
    }
    public static function renderHtml($echo = true) {
      $str = __('Activated', 'filebird');
      if( ! get_option('fb_activated')) {
        ob_start();
        include_once NJFB_PLUGIN_PATH . 'views/pages/settings/tab-active.php';
        $str = \ob_get_clean();
      }
      if($echo === true) {
        echo $str;
      } else {
        return $str;
      }
    }
    private static function cURL($url, $post = null, $token) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//must be true on prod enviroment
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $header = array();
        if($post != null) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
            $header[] = 'Content-Type: application/json';
            $header[] = 'Content-Length: ' . strlen(json_encode($post));
        }
    
        if($token != null) {
            $header[] = 'Authorization: Bearer '. $token;
        }
    
        if(count($header) > 0) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        $res = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        curl_close($ch);
        if($res === false && isset($error_msg)) {
            throw new \Exception($error_msg);
        }
        return json_decode($res);
        
    }
}
