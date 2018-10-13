<?php
/**
 * @author Jegtheme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'JNews_Social_Login' ) )
{
    class JNews_Social_Login
    {   
        /**
         * @var JNews_Social_Login
         */
        private static $instance;

        /**
         * @var Facebook integration
         */
        private $fb_enable = false;
        private $fb_app_id;
        private $fb_app_secret;
        private $fb_graph_version;

        /**
         * @var Google integration
         */
        private $google_enable = false;
        private $google_client_id;
        private $google_client_secret;
        private $google_app_name;

        /**
         * @var Linked In integration
         */
        private $linkedin_enable = false;
        private $linkedin_client_id;
        private $linkedin_client_secret;

        /**
         * @var string
         */
        private $default_user_role;
        private $show_social_form;
        private $button_style;

        /**
         * @var string
         */
        private $cache_key = 'jnews_social_login_url';

        /**
         * @return JNews_Social_Login
         */
        public static function getInstance()
        {
            if (null === static::$instance)
            {
                static::$instance = new static();
            }
            return static::$instance;
        }

        /**
         * JNews_Social_Login constructor
         */
        private function __construct()
        {
            $this->setup_init();
            $this->setup_hook();
            $this->setup_source();
        }

        /**
         * Init setup
         */
        public function setup_init()
        {
            if ( !session_id() )
            {
                session_start();
            }

            if ( jnews_get_option( 'social_login_enable_facebook', '' ) ) 
            {
                $this->fb_enable        = true;
                $this->fb_app_id        = jnews_get_option( 'social_login_facebook_id', '' );
                $this->fb_app_secret    = jnews_get_option( 'social_login_facebook_secret', '' );
	            $this->fb_graph_version = 'v2.10';
            }

            if ( jnews_get_option( 'social_login_enable_google', '' ) ) 
            {
                $this->google_enable        = true;
                $this->google_client_id     = jnews_get_option( 'social_login_google_id', '' );
                $this->google_client_secret = jnews_get_option( 'social_login_google_secret', '' );
                $this->google_app_name      = jnews_get_option( 'social_login_google_app_name', '' );
            }

            if ( jnews_get_option( 'social_login_enable_linkedin', '' ) ) 
            {
                $this->linkedin_enable        = true;
                $this->linkedin_client_id     = jnews_get_option( 'social_login_linkedin_id', '' );
                $this->linkedin_client_secret = jnews_get_option( 'social_login_linkedin_secret', '' );
            }

            $this->default_user_role = jnews_get_option( 'social_login_user_role', 'subscriber' );
            $this->show_social_form  = jnews_get_option( 'social_login_show', 'hide' );
            $this->button_style      = jnews_get_option( 'social_login_style', 'normal' );

            $this->update_url_cache();
        }

        /**
         * Hook setup
         */
        public function setup_hook()
        {
            add_action( 'init',                     array( $this, 'add_social_endpoint' ) );
            add_action( 'parse_request',            array( $this, 'social_parse_request' ) );
            add_action( 'wp_print_styles',          array( $this, 'load_assets' ) );

            add_filter( 'query_vars',               array( $this, 'social_query_vars' ) );
            add_filter( 'jeg_social_url_filter',    array( $this, 'social_url_filter' ), 10, 2 );
            add_filter( 'jnews_social_login',       array( $this, 'social_login_form' ), 10, 2 );
        }

        /**
         * Source setup
         */
        public function setup_source()
        {
            include_once( JNEWS_SOCIAL_LOGIN_DIR . 'include/source/facebook-sdk-v5/autoload.php' );
            include_once( JNEWS_SOCIAL_LOGIN_DIR . 'include/source/google-api-php-client/src/Google/autoload.php' );
            include_once( JNEWS_SOCIAL_LOGIN_DIR . 'include/source/LinkedIn/LinkedIn.php' );
        }

        /**
         * Remove url cache
         */
        private function update_url_cache()
        {
            update_option( $this->cache_key, array() );
        }



        /**
         * Add social login callback endpoint
         */
        public function add_social_endpoint()
        {
            add_rewrite_rule( '^social-callback/([^/]*)/?', 'index.php?social-callback=$matches[1]', 'top' );
        }

        /**
         * Refresh permalink
         */
        public function flush_rewrite_rules()
        {
            $this->add_social_endpoint();

            global $wp_rewrite;
            $wp_rewrite->flush_rules();
        }

        /**
         * Parse request for social login callback
         * 
         * @param  object $wp
         * 
         */
        public function social_parse_request( $wp )
        {
            if ( array_key_exists( 'social-callback', $wp->query_vars ) )
            {
                switch( $wp->query_vars['social-callback'] )
                {
                    case "facebook" :
                        $this->facebook_login();
                        break;
                    case "google" :
                        $this->google_login();
                        break;
                    case "linkedin" :
                        $this->linkedin_login();
                        break;
                }
            }
        }

        /**
         * Add query vars filter of social login callback
         * 
         * @param  array $vars
         * 
         * @return array
         *       
         */
        public function social_query_vars( $vars )
        {
            $vars[] = 'social-callback';
            return $vars;
        }

        /**
         * Add social login url filter
         * 
         * @param  string $value 
         * @param  string $social
         *
         * @return string        
         * 
         */
        public function social_url_filter( $value, $social )
        {
            return $this->social_callback_url( $social );
        }

        /**
         * Social login callback url
         * 
         * @param  string $social
         * 
         * @return string
         *         
         */
        public function social_callback_url( $social )
        {
            if ( get_option( 'permalink_structure' ) ) 
            {
                $url = home_url() . '/social-callback/' . $social;
            } else {
                $url = add_query_arg( array( 'social-callback' => $social ), home_url() );
            }

            return $url;
        }

        /**
         * Facebook login and register url
         * 
         * @return string
         * 
         */
        public function facebook_oauth_url()
        {
            if ( empty( $this->fb_app_id ) || empty( $this->fb_app_secret ) ) 
            {
                return false;
            }

            $fb = new Facebook\Facebook(
                array(
                    'app_id'                => $this->fb_app_id,
                    'app_secret'            => $this->fb_app_secret,
                    'default_graph_version' => $this->fb_graph_version,
                )
            );

            $helper   = $fb->getRedirectLoginHelper();
            $loginUrl = $helper->getLoginUrl( $this->social_callback_url('facebook'), array('email') );

            return $loginUrl;
        }

        /**
         * Google login and register url
         * 
         * @return string
         * 
         */
        public function google_oauth_url()
        {
            if ( empty( $this->google_client_id ) || empty( $this->google_client_secret ) ) 
            {
                return false;
            }

            $client = new Google_Client();
            $client->setApplicationName( $this->google_app_name );
            $client->setClientId( $this->google_client_id );
            $client->setClientSecret( $this->google_client_secret );
            $client->addScope( 'https://www.googleapis.com/auth/userinfo.profile' );
            $client->addScope( 'https://www.googleapis.com/auth/userinfo.email' );

            $client->setRedirectUri( $this->social_callback_url('google') );
            return $client->createAuthUrl();
        }

        /**
         * Linked In login and register url
         * 
         * @return string
         * 
         */
        public function linkedin_oauth_url()
        {
            if ( empty( $this->linkedin_client_id ) || empty( $this->linkedin_client_secret ) ) 
            {
                return false;
            }

            $linkedin = new LinkedIn\LinkedIn(
                array(
                    'api_key'      => $this->linkedin_client_id,
                    'api_secret'   => $this->linkedin_client_secret,
                    'callback_url' => $this->social_callback_url( 'linkedin' ),
                )
            );

            $authUrl = $linkedin->getLoginUrl(
                array(
                    LinkedIn\LinkedIn::SCOPE_BASIC_PROFILE,
                    LinkedIn\LinkedIn::SCOPE_EMAIL_ADDRESS
                )
            );

            return $authUrl;
        }

        /**
         * Facebook login and register handler
         * 
         * @return string
         * 
         */
        public function facebook_login()
        {
            if ( empty( $this->fb_app_id ) || empty( $this->fb_app_secret ) ) 
            {
                return false;
            }

            $fb = new Facebook\Facebook(
                array(
                    'app_id'                => $this->fb_app_id,
                    'app_secret'            => $this->fb_app_secret,
                    'default_graph_version' => $this->fb_graph_version,
                )
            );

            $helper = $fb->getRedirectLoginHelper();

            try {

                $accessToken = $helper->getAccessToken();

                if ( !isset( $accessToken ) )
                {
                    if ( $helper->getError() )
                    {
                        header('HTTP/1.0 401 Unauthorized');
                        echo "Error: " . $helper->getError() . "\n";
                        echo "Error Code: " . $helper->getErrorCode() . "\n";
                        echo "Error Reason: " . $helper->getErrorReason() . "\n";
                        echo "Error Description: " . $helper->getErrorDescription() . "\n";
                    } else {
                        header('HTTP/1.0 400 Bad Request');
                        echo 'Bad request';
                    }
                    exit;
                }

                $response   = $fb->get( '/me?fields=id,name,email,first_name,last_name', $accessToken->getValue() );
                $user       = $response->getGraphUser();

                $user_email = $user['email'];

                if ( email_exists( $user_email ) )
                { 
                    // user exist
                    $this->log_user_in_social( $user_email );
                } else { 
                    // user not exist
                    $this->register_user_social(
                        array(
                            'email'      => $user_email,
                            'first_name' => $user["first_name"],
                            'last_name'  => $user["last_name"]
                        )
                    );
                }
            } catch (Exception $e ) {
                if ( $e instanceof Facebook\Exceptions\FacebookResponseException )
                {
                    echo '<strong>' . esc_html__('Graph returned an error: ','jnews-social-login') . ':</strong> ' . $e->getMessage();
                } else if ( $e instanceof Facebook\Exceptions\FacebookSDKException ) {
                    echo '<strong>' . esc_html__('Facebook SDK returned an error: ','jnews-social-login') . ':</strong> ' . $e->getMessage();
                } else {
                    echo '<strong>' . esc_html__('Error: ','jnews-social-login') . ':</strong> ' . $e->getMessage();
                }
            }

            if ( apply_filters( 'jnews_social_login_force_disable', false ) )
            {
                wp_redirect( home_url( '/#jnews_social_login' ) );
            } else {
                wp_redirect( home_url( '/' ) );
            }
            exit;
        }

        /**
         * Google login and register handler
         * 
         * @return string
         * 
         */
        public function google_login()
        {   
            if ( empty( $this->google_client_id ) || empty( $this->google_client_secret ) ) 
            {
                return false;
            }

            $client = new Google_Client();
            $client->setApplicationName( $this->google_app_name );
            $client->setClientId( $this->google_client_id );
            $client->setClientSecret( $this->google_client_secret );
            $client->setRedirectUri( $this->social_callback_url( 'google' ) );

            try {

                if ( !isset( $_GET['code'] ) )
                {
                    throw new Exception( '<strong>' . esc_html__('Error','jnews-social-login') . ':</strong> ' . esc_html__( 'Failed to get Google Code', 'jnews-social-login' ) );
                } else {
                    if ( !isset( $_GET['code'] ) )
                    {
                        header('HTTP/1.0 400 Bad Request');
                        echo 'Bad request';
                        exit;
                    }

                    // get access token
                    $client->authenticate( $_GET['code'] );
                    $access_token = $client->getAccessToken();
                    $client->setAccessToken( $access_token );

                    // use access token to get detail user
                    $plus = new Google_Service_Plus( $client );
                    $user = $plus->people->get( 'me' );

                    $user_email = $user['emails'][0]['value'];

                    if ( email_exists( $user_email ) )
                    { 
                        // user exist
                        $this->log_user_in_social( $user_email );
                    } else { 
                        // user not exist
                        $this->register_user_social(
                            array(
                                'email'      => $user_email,
                                'first_name' => $user['name']['givenName'],
                                'last_name'  => $user['name']['familyName']
                            )
                        );
                    }
                }
            } catch (Exception $e ) {
                echo '<strong>' . esc_html__('Error','jnews-social-login') . ':</strong> ' . $e->getMessage();
            }

            if ( apply_filters( 'jnews_social_login_force_disable', false ) )
            {
                wp_redirect( home_url( '/#jnews_social_login' ) );
            } else {
                wp_redirect( home_url( '/' ) );
            }

            exit;
        }

        /**
         * Linked In login and register handler
         * 
         * @return string
         * 
         */
        public function linkedin_login()
        {
            if ( empty( $this->linkedin_client_id ) || empty( $this->linkedin_client_secret ) ) 
            {
                return false;
            }

            $linkedin = new LinkedIn\LinkedIn(
                array(
                    'api_key'      => $this->linkedin_client_id,
                    'api_secret'   => $this->linkedin_client_secret,
                    'callback_url' => $this->social_callback_url( 'linkedin' ),
                )
            );

            try {
                
                $token = $linkedin->getAccessToken($_REQUEST['code']);

                if ( !isset( $token ) )
                {
                    throw new Exception( '<strong>' . esc_html__( 'Error', 'jnews-social-login' ) . ':</strong> ' . esc_html__( 'Failed to get Linked in access token', 'jnews-social-login' ) );
                }

                $info = $linkedin->get( '/people/~:(email-address,first-name,last-name)' );
                $user_email = $info['emailAddress'];

                if ( email_exists( $user_email ) )
                {
                    // user exist
                    $this->log_user_in_social( $user_email );
                } else {
                    // user not exist
                    $this->register_user_social(
                        array(
                            'email'      => $user_email,
                            'first_name' => $info["firstName"],
                            'last_name'  => $info["lastName"]
                        )
                    );
                }
            } catch (Exception $e ) {
                echo '<strong>' . esc_html__('Error','jnews-social-login') . ':</strong> ' . $e->getMessage();
            }

            if ( apply_filters( 'jnews_social_login_force_disable', false ) )
            {
                wp_redirect( home_url( '/#jnews_social_login' ) );
            } else {
                wp_redirect( home_url( '/' ) );
            }

            exit;
        }

        /**
         * Login user handler
         * 
         * @return string
         * 
         */
        public function log_user_in_social( $user_email )
        {
            if ( ! apply_filters( 'jnews_social_login_force_disable', false ) ) 
            {
                // get user detail
                $userdetail = get_user_by( 'email', $user_email );

                // log the new user in
                wp_set_auth_cookie( $userdetail->ID, true, is_ssl() );
                wp_set_current_user( $userdetail->ID );
            }
        }

        /**
         * Register new user handler
         * 
         * @return string
         * 
         */
        public function register_user_social( $user )
        {
            if ( ! apply_filters( 'jnews_social_login_force_disable', false ) ) 
            {
                $generated_password  = wp_generate_password();
                $default_member_role = $this->default_user_role;
                $new_customer        = wp_insert_user(
                    array(
                        'user_login'        => $user['email'],
                        'user_pass'         => $generated_password,
                        'user_email'        => $user['email'],
                        'first_name'        => $user["first_name"],
                        'last_name'         => $user["last_name"],
                        'user_registered'   => date('Y-m-d H:i:s'),
                        'role'              => $default_member_role
                    )
                );

                if ( is_wp_error( $new_customer ) )
                {
                    throw new Exception( $new_customer->get_error_message() );
                } else {
                    // send an email to the admin and user
                    wp_new_user_notification( $new_customer, null, 'both' );

                    // log the new user in
                    wp_set_auth_cookie( $new_customer, true, is_ssl() );
                    wp_set_current_user( $new_customer, $user['email'] );
                }
            }
        }

        /**
         * Load plugin assest
         */
        public function load_assets()
        {
            wp_enqueue_style( 'jnews-social-login-style',    JNEWS_SOCIAL_LOGIN_URL . '/assets/css/plugin.css', null, JNEWS_SOCIAL_LOGIN_VERSION );
        }

        /**
         * Get social oauth url
         * 
         * @param  string $social
         * 
         * @return string        
         * 
         */
        public function get_social_oauth_url( $social )
        {
            $url_cache = get_option( $this->cache_key, array() );

            switch ( $social ) 
            {
                case 'facebook':
                    if ( empty( $url_cache['facebook'] ) ) 
                    {
                        $url_cache['facebook'] = $this->facebook_oauth_url();

                        update_option( $this->cache_key, $url_cache );
                    }
                    return $url_cache['facebook'];
                    break;

                case 'google':
                    if ( empty( $url_cache['google'] ) ) 
                    {
                        $url_cache['google'] = $this->google_oauth_url();

                        update_option( $this->cache_key, $url_cache );
                    }
                    return $url_cache['google'];
                    break;

                case 'linkedin':
                    if ( empty( $url_cache['linkedin'] ) ) 
                    {
                        $url_cache['linkedin'] = $this->linkedin_oauth_url();

                        update_option( $this->cache_key, $url_cache );
                    }
                    return $url_cache['linkedin'];
                    break;
            }
        }

        /**
         * Social login form
         */
        public function social_login_form( $output, $type )
        {
            if ( $this->show_social_form === 'both' || $this->show_social_form === $type ) 
            {
                $form = $this->social_build_button( $type );

                $output = "<div class=\"social-login-wrapper {$type} {$this->button_style}\">
                            {$form}
                            <div class=\"social-login-line\">
                                <span>" . jnews_return_translation( 'OR', 'jnews-social-login', 'or' ) . "</span>
                            </div>
                        </div>";

                return $output;
            }

            return false;
        }

        /**
         * Build form content
         * 
         * @param  string $action
         * 
         * @return string
         *         
         */
        public function social_build_button( $action )
        {
            if ( $action === 'login' ) 
            {
                $text = array(
                    'facebook' => jnews_return_translation( 'Sign In with Facebook',  'jnews-social-login', 'login_facebook' ),
                    'google'   => jnews_return_translation( 'Sign In with Google+',   'jnews-social-login', 'login_google' ),
                    'linkedin' => jnews_return_translation( 'Sign In with Linked In', 'jnews-social-login', 'login_linkedin' ),
                );
            } else {
                $text = array(
                    'facebook' => jnews_return_translation( 'Sign Up with Facebook',  'jnews-social-login', 'register_facebook' ),
                    'google'   => jnews_return_translation( 'Sign Up with Google+',   'jnews-social-login', 'register_google' ),
                    'linkedin' => jnews_return_translation( 'Sign Up with Linked In', 'jnews-social-login', 'register_linkedin' ),
                );
            }

            $output = '';

            if ( $this->fb_enable ) 
            {
                $output .= "<div class=\"social-login-item\">
                                <a href=\"" . esc_url( $this->get_social_oauth_url('facebook') ) . "\" class=\"btn btn-facebook\">
                                    <i class=\"fa fa-facebook\"></i> 
                                    <span>{$text['facebook']}</span>
                                </a>
                            </div>";
            }

            if ( $this->google_enable ) 
            {
                $output .= "<div class=\"social-login-item\">
                                <a href=\"" . esc_url( $this->get_social_oauth_url('google') ) . "\" class=\"btn btn-google-plus\">
                                    <i class=\"fa fa-google-plus\"></i> 
                                    <span>{$text['google']}</span>
                                </a>
                            </div>";
            }

            if ( $this->linkedin_enable ) 
            {
                $output .= "<div class=\"social-login-item\">
                                <a href=\"" . esc_url( $this->get_social_oauth_url('linkedin') ) . "\" class=\"btn btn-linkedin\">
                                    <i class=\"fa fa-linkedin\"></i> 
                                    <span>{$text['linkedin']}</span>
                                </a>
                            </div>";
            }

            return $output;
        }

    }
}