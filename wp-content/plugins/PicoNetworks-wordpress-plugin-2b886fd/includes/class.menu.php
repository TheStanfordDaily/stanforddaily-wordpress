<?php

class Pico_Menu {
    private static $initiated = false;

    public static function init() {
		if (!self::$initiated) {
            add_action( 'admin_print_scripts', array( 'Pico_Menu', 'load_custom_wp_admin_style' ) );
            add_action( 'admin_enqueue_scripts', array( 'Pico_Menu', 'load_custom_wp_admin_scripts' ) );
        	add_action('admin_menu', array( 'Pico_Menu', 'load_menu' ));
			// leaky_paywall_percentage is set in the view connected.php
			// leaky_paywall_percentage refers to the percentage of time leaky paywall is not active and Pico is active
			// if (isset($_POST['leaky_paywall_percentage'])) {
			// 	update_option('leaky_paywall_percentage', intval($_POST['leaky_paywall_percentage']));
			// }
			if (isset($_POST['action']) && $_POST['action'] === 'enter-key') {
				self::enter_api_key();
			}
			if (isset($_POST['action']) && $_POST['action'] === 'disconnect-pp') {
				Pico_Setup::deactivate_key();
			}
		}
	}

    public static function load_custom_wp_admin_style() {
    	wp_register_style( 'pico_style', plugin_dir_url( __FILE__ ) . 'css/pico.css', array(), PICO_VERSION );
    	wp_enqueue_style( 'pico_style');
    	wp_register_style( 'pico_font', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600', array(), PICO_VERSION );
    	wp_enqueue_style( 'pico_font');
    }

    public static function load_custom_wp_admin_scripts() {
    	wp_enqueue_script('jquery');
    	wp_register_script( 'pico_js', plugin_dir_url( __FILE__ ) . 'js/pico.js', array(), PICO_VERSION );
    	wp_enqueue_script( 'pico_js' );
    }

    /**
     * This function stores the publisher ID and API key in the database
     * @return [bool] Returns true if added to database
     */
    public static function enter_api_key() {

        $publisher_id = $_POST['publisher_id'];
        $api_key = $_POST['api_key'];

        $array = array(
            "publisher_id" => $publisher_id,
            "key" => $api_key
        );

        $request = json_encode($array);

        $response = self::http_post($request, 'auth/check', true);
        if ($response === 200) {
            return Pico_Setup::add_publisher_info($publisher_id, $api_key);
		}
		return false;
	}

	/**
	 * Checks whether the token is valid ?
	 * Used in connected page
	 * @param  [string] $token [description]
	 * @return [bool]        [description]
	 */
	public static function health_check() {
		$http_args = array(
			'headers' => array(
				'Content-Type' => 'application/json; charset=' . get_option('blog_charset'),
				'Accept' => 'application/json'
			),
			'httpversion' => '1.0',
			'timeout' => 15
		);
		$request_url = Pico_Setup::get_api_endpoint() . '/status';
		$response = wp_remote_get($request_url, $http_args);
		$status_code = wp_remote_retrieve_response_code($response);
		if ($status_code !== 200) {
			return '<div class="error-message">' .
			       '<div class="error-icon">' .
			       '<img src="' . plugin_dir_url( __DIR__ ) . 'includes/img/ic_error.svg" alt="Something is wrong.">' .
			       '</div>' .
			       '<div class="error-text">' . $status_code . '</div>' .
			       '</div>';
		}
	}

    /**
    * POST request to the API
    * @param  [type] $request [description]
    * @param  [type] $path    [current path?]
    * @param  [bool] $return_code    [return status code instead of body?]
    * @return [type] [response body or status code]
    */
    public static function http_post($request, $path, $return_code) {
        $http_args = array(
            'body' => $request,
            'headers' => array(
                'Content-Type' => 'application/json; charset=' . get_option('blog_charset'),
                'Accept' => 'application/json'
            )
        );
        $request_url = Pico_Setup::get_api_endpoint() . "/" . $path;
        $response = wp_remote_post($request_url, $http_args);
        $body = wp_remote_retrieve_body($response);
        if ($return_code) {
            return wp_remote_retrieve_response_code($response);
        } else {
            return $body;
        }
    }

		/**
		* GET request to the API
		* @param  [string] $token [description]
		* @param  [string] $path  [current path?]
		* @return [array]        [body of the response]
		*/
		public static function http_get($token, $path) {
			$http_args = array(
				'headers' => array(
					'Content-Type' => 'application/json; charset=' . get_option('blog_charset'),
					'Accept' => 'application/json',
					'Authorization' => 'Pico ' . $token
				),
				'httpversion' => '1.0',
				'timeout' => 15
			);
			$request_url = Pico_Setup::get_api_endpoint() . "/" . $path;
			$response = wp_remote_get($request_url, $http_args);
			return array($response['body']);
		}

		/**
		 * Pico plugin views
		 * @param  [string] $name [description]
		 * @param  array  $args [description]
		 * @return [type]       [description] ?
		 */
		public static function view($name, array $args = array()) {
			$args = apply_filters('pico_view_arguments', $args, $name);

			foreach ($args as $key => $val) {
				$$key = $val;
			}

			$file = PICO__PLUGIN_DIR . 'includes/views/'. $name . '.php';
			include($file);
		}

		/**
		 * ?
		 * @return [type] [description]
		 */
		public static function display_page() {
			global $wpdb;
			$result = $wpdb->get_results("SELECT * FROM " .($wpdb->prefix). "pico WHERE status = 1");
			$count = count($result);

			$view = $count === 0 ? 'auth' : 'connected';

			self::view($view);
		}


	/**
	* Loads the menu page
	*/
	public static function load_menu() {
		add_menu_page('Pico',
			'Pico',
			'manage_options',
			'pico-plugin',
			array( 'Pico_Menu', 'display_page' ),
			'dashicons-pico'
		);
		self::$initiated = true;
	}
}
