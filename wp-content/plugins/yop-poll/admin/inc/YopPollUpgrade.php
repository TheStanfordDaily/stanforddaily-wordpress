<?php
class YopPollUpgrade {
    private static $_instance = null;
    public static function get_instance() {
        if( self::$_instance === null ) {
            $class           = __CLASS__;
            self::$_instance = new $class;
        }
        return self::$_instance;
    }
    public function manage_upgrade_pages() {
        $action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '';
        switch( $action ) {
            case 'after-buy':
                $this->after_buy();
                break;
            case 'do-buy':
                    $this->do_buy();
                    break;
            case 'validate_licence';
                $this->check_licence();
                break;
            default:
                $this->before_buy();
                break;
        }
    }
    private function before_buy() {
        $data['title'] = __( 'Before You Buy', 'yop-poll' );
        $data['poll_url'] = YOP_POLL_URL;
        $template = YOP_POLL_PATH . 'admin/views/before-upgrade.php';
        echo YOP_Poll_View::render(
            $template,
            array(
                'data' => $data
            )
        );
    }
    public function check_licence(){
        if( isset( $_POST['licence'] ) && $_POST['licence'] !== '' ) {
            if( check_admin_referer( 'yop-poll-before-buy' ) ) {
                $fields        = array(
                    'action'     => 'check_licence',
                    'pro_key'    => $_POST['licence'],
                    'user-agent' => 'WordPress/;' . get_bloginfo( 'url' )
                );
                $url = 'https://admin.yoppoll.com/';
                $fields_string = '';
                foreach( $fields as $key => $value ) {
                    $fields_string .= $key . '=' . $value . '&';
                }
                $request_string = array(
                    'body'       => array(
                        'action'  => 'check_licence',
                        'pro_key' =>  $_POST['licence'],
                    ),
                    'user-agent' => 'WordPress/' . YOP_POLL_VERSION . '; ' . get_bloginfo( 'url' )
                );
                $result = wp_remote_post( $url, $request_string );
                if( ! is_wp_error( $result ) && ( $result['response']['code'] === 200 ) ) {
                    $response = unserialize( $result['body'] );
                } else {
                    $response = null;
                }
                if( is_object( $response ) ) {
                    if( isset( $response->status ) && $response->status === '200' ) {
                        if( isset( $response->error ) && '' !== $response->error ) {
                            wp_die( $response->error );
                        } else {
                            $pro_options            = get_option( 'yop_poll_pro' );
                            $pro_options['pro_key'] = $response->license;
                            $rand = $response->rand;
                            $huid = $response->huid;
                            update_option( 'yop_poll_pro', $pro_options );
                            $download_link = 'https://admin.yoppoll.com/upgrade?action=downloadPackage&huid=' .$huid . '&rand=' .$rand;
                            require_once YOP_POLL_PATH . '/upgrade.php';
                        }
                    } else {
                        wp_die( 'Pro License Key is not Valid' );
                    }
                } else {
                    wp_die( 'Pro License Key is not Valid' );
                }
            }
        }
    }
    public static function do_buy() {
        if( isset( $_POST['upgrade'] ) && ( $_POST['upgrade'] === 'yes' ) ) {
            if( check_admin_referer( 'yop-poll-before-buy' ) ) {
                $huid =  hash('sha256', mt_rand() . microtime());
                $rand_number                = rand( 1000000, 9999999 );
                $pro_options                = get_option( 'yop_poll_pro' );
                $pro_options['huid']        = $huid;
                $pro_options['rand_number'] = $rand_number;
                update_option( 'yop_poll_pro', $pro_options );
                $optin_box_modal_options = get_option( 'yop_poll_optin_box_modal_options_yop' );
                $email = isset( $optin_box_modal_options['modal_email'] ) ? $optin_box_modal_options['modal_email'] : 'johndoe@email.com';
                $redirect_url = urlencode( add_query_arg( array(
                    'page'   => 'yop-poll-upgrade-pro',
                    'action' => 'after-buy'
                ), admin_url( 'admin.php' ) ) );
                $custom = urlencode( $huid . ';' . $rand_number. ';1;' .$email );
                $paypalUrl = 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=Z6EYUMUYXG9QW&lc=GB&item_name=YOP%20Poll%20Pro&amount=17%2e00&currency_code=USD&button_subtype=services&no_note=0&cn=VAT%20ID%20%28if%20any%29&no_shipping=2&bn=PP%2dBuyNowBF%3abtn_buynowCC_LG%2egif%3aNonHosted&notify_url=https%3A%2F%2Fadmin.yoppoll.com%2Fipn&return=' .
                    "$redirect_url&rm=2&custom=" . $custom;
                echo '<p>' . __( '
                    Please wait while you are being redirected to PayPal<br>If you are not redirected within 10 seconds, please click ', 'yop-poll' ) .
                    "<a href='{$paypalUrl}'>" . __( 'here', 'yop-poll' ) . '</a></p>';
                echo "<script> window.location = '$paypalUrl'; </script>";
            }
        }
    }
    public function after_buy() {
        sleep(8);
        $data['title'] = __( 'Finish Upgrade', 'yop-poll' );
        $pro_options   = get_option( 'yop_poll_pro' );
        $huid          = $pro_options['huid'];
        $rand          = $pro_options['rand_number'];
        $url = 'https://admin.yoppoll.com/upgrade/?action=getPackageLink&huid=' .
            urlencode( $huid ) . '&rand=' .
            urlencode( $rand );
        $ch            = curl_init( $url );
        curl_setopt( $ch, CURLOPT_HEADER, 0 );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $result = curl_exec( $ch );
        curl_close( $ch );
        $result = json_decode( $result, true );
        if( isset( $result['error'] ) && 'Error' === $result['error'] ) {
            $data['error'] = $result['message'];
            $template = YOP_POLL_PATH . 'admin/views/after-upgrade.php';
            echo YOP_Poll_View::render(
                $template,
                array(
                    'data' => $data
                )
            );
        }
        else {
            $pro_options            = get_option( 'yop_poll_pro' );
            $pro_options['pro_key'] = $result['licence'];
            $data['success']        = $result['message'];
            $download_link          = $result['download_link'] . "&huid={$huid}&rand={$rand}";
            update_option( 'yop_poll_pro', $pro_options );
            require_once YOP_POLL_PATH . '/upgrade.php';
            $template = YOP_POLL_PATH . 'admin/views/after-upgrade.php';
            echo YOP_Poll_View::render(
                $template,
                array(
                    'data' => $data
                )
            );
        }
    }
    public function curl_post( $url, array $post = null, array $options = array() ) {
        $defaults = array(
            CURLOPT_POST           => 1,
            CURLOPT_HEADER         => 0,
            CURLOPT_URL            => $url,
            CURLOPT_FRESH_CONNECT  => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE   => 1,
            CURLOPT_TIMEOUT        => 4,
            CURLOPT_POSTFIELDS     => http_build_query( $post )
        );
        $ch = curl_init();
        curl_setopt_array( $ch, ( $options + $defaults ) );
        if( ! $result = curl_exec( $ch ) ) {
            $this->error = curl_error( $ch );

            return false;
        }
        curl_close( $ch );
        return $result;
    }
    public function curl_get( $url, array $get = null, array $options = array() ) {
        $defaults = array(
            CURLOPT_URL            => $url . ( strpos( $url, '?' ) === false ? '?' : '' ) . http_build_query( $get ),
            CURLOPT_HEADER         => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 4
        );
        $ch = curl_init();
        curl_setopt_array( $ch, ( $options + $defaults ) );
        if( ! $result = curl_exec( $ch ) ) {
            $this->error = curl_error( $ch );
            return false;
        }
        curl_close( $ch );
        return $result;
    }
}
