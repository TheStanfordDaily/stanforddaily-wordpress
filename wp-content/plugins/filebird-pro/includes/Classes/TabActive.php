<?php
namespace FileBird\Classes;

use FileBird\Classes\Helpers;

defined('ABSPATH') || exit;

class TabActive {

  private static $_instance = null;

    private $envato_login_url = 'https://active.ninjateam.org/envato-login/';
    private $check_purchase_url = 'https://active.ninjateam.org/wp-admin/admin-ajax.php?action=njt_validate_code';

    private $update_checker = null;
    private $slug = 'filebird/filebird.php';

    public function __construct() {
        add_filter('fbv_data', array($this, 'localize_fbv_data'));
        add_action('wp_ajax_fb_login_envato_success', array($this, 'ajax_login_envato_success'));

        if ( ! function_exists( 'is_plugin_active' ) )
          require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
        if(!is_plugin_active('envato-market/envato-market.php') || (get_site_transient('envato_market_plugins') === false)) {
          if(!class_exists('\Puc_v4_Factory'))
          require_once NJFB_PLUGIN_PATH .  '/includes/Lib/plugin-update-checker/plugin-update-checker.php';

          $this->update_checker = \Puc_v4_Factory::buildUpdateChecker(
            'https://active.ninjateam.org/json/filebird.json',
            NJFB_PLUGIN_FILE, //Full path to the main plugin file or functions.php.
            $this->slug
          );
  
          add_filter('puc_pre_inject_update-' . $this->slug, array($this, 'injectUpdate'));
          add_action( 'in_plugin_update_message-' . plugin_basename( NJFB_PLUGIN_FILE ), array($this, 'in_plugin_update_message'), 10, 2 );
        }
    }
    public function in_plugin_update_message($plugin_data, $version_info) {
      if(!Helpers::isActivated()) {
        echo '&nbsp;<strong><a href="'.esc_url(add_query_arg(array('page' => 'filebird-settings', 'tab' => 'activation'), admin_url('options-general.php'))).'">'.__('Activate your license for automatic updates', 'filebird').'</a></strong>.';
      }
    }
    public function ajax_login_envato_success() {
        $purchase_code = isset($_GET['code']) ? $_GET['code'] : '';
        $email = isset($_GET['email']) ? $_GET['email'] : '';
        $success = isset($_GET['success']) ? $_GET['success'] : '';
        $error = isset($_GET['error']) ? $_GET['error'] : '';
        if($success == true) {
          $final_check = $this->remote_check_purchase_code($purchase_code, $email);
          if($final_check['success']) {
            foreach($final_check['data'] as $k => $v) {
              update_option('filebird_' . $k, $v);
            }
          }
        } else {
          update_option('filebird_activation_error', $error);
        }
        exit('<script>window.close()</script>');
    }
    public function injectUpdate($update) {
      if(Helpers::isActivated()) {
        $update->download_url = add_query_arg(array(
          'code' => get_option('filebird_code', ''),
          'email' => get_option('filebird_email', ''),
          'domain' => $this->get_domain(),
        ), $update->download_url);
      } else {
        $update->download_url = null;
      }
      return $update;
    }
    private function remote_check_purchase_code($code, $email, $plugin = 'filebird') {
      $domain = $this->get_domain();
      $response = wp_remote_post(
        add_query_arg(array(), $this->check_purchase_url),
        array(
          'method' => 'POST',
          'timeout' => 45,
          'redirection' => 5,
          'httpversion' => '1.0',
          'blocking' => true,
          'headers' => array(),
          'body' => array(
            'code' => $code,
            'email' => $email,
            'domain' => $domain,
            'plugin' => $plugin
          )
        )
      );
      if (!is_wp_error($response)) {
        $json = json_decode($response["body"]);
        if ($json->success) {
            return array(
              'success' => true,
              'data' => array(
                'code' => $json->data->code,
                'email' => $json->data->email,
                'supported_until' => $json->data->supported_until
              )
            );
        }
        return array(
          'success' => false
        );
      }
      return array(
        'success' => false
      );
    }

    public function ajax_filebird_active_license() {
        // $purchase_code = isset($_POST['purchase_code']) ? $_POST['purchase_code'] : '';
        $envato_token = isset($_POST['envato_token']) ? sanitize_text_field($_POST['envato_token']) : '';

        $domain = $this->get_domain();
        $current_user = wp_get_current_user();

        $response = wp_remote_post(
            add_query_arg(array('action' => 'fb_action', 'act' => 'check_domain'), $this->envato_login_url),
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

    public function localize_fbv_data($data) {
        $return_url = add_query_arg(array('action' => 'fb_login_envato_success'), admin_url('admin-ajax.php'));
        $domain = $this->get_domain();
        $data['login_envato_url'] = esc_url(add_query_arg(array(
            'domain' => $domain,
            'plugin' => 'filebird',
            'return_url' => $return_url
        ), $this->envato_login_url));
        $data['i18n']['active_to_update'] = __('Please active license to update.', 'filebird');
        return $data;
    }
    public static function renderHtml($echo = true) {
      $str = '';

      $filebird_activation_error = get_option('filebird_activation_error', '');
      if($filebird_activation_error != '') update_option('filebird_activation_error', '');
      $str .= Helpers::view('particle/activation_fail', array('filebird_activation_error' => $filebird_activation_error));
      if( ! Helpers::isActivated() ) {
        $str .= Helpers::view('pages/settings/tab-active');
      } else {
        $str .= Helpers::view('pages/settings/tab-activated');
      }
      if($echo === true) {
        echo $str;
      } else {
        return $str;
      }
    }
    private function cURL($url, $post = null, $token = null) {
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
    private function get_domain() {
      $url = get_bloginfo('url');
      if($url == '' || $url == null) {
        $url = home_url();
      }
      return preg_replace('#https?:\/\/#', '', $url);
    }
    
    public static function getInstance() {
      if(self::$_instance == null) self::$_instance = new self;
      return self::$_instance;
    }
}
