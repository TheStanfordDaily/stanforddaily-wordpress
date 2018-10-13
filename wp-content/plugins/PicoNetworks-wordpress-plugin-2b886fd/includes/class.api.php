<?php

	class Pico_API_Controller {

		// Here initialize our namespace and resource name.
		public function __construct() {
			$this->namespace     = '/pico/v1';
			$this->verify_resource_name = 'verify';
			$this->health_resource_name = 'check';
		}

		/**
		 * Register routes with callbacks and schema
		 */
		public function register_routes() {
			register_rest_route( $this->namespace, '/' . $this->verify_resource_name, array(
                'methods'   => 'GET',
                'callback'  => array( $this, 'verify_callback' ),
                'args' => self::validate_verify_arguments()
			));
			register_rest_route( $this->namespace, '/' . $this->health_resource_name, array(
                'methods'   => 'POST',
                'callback'  => array( $this, 'health_callback' ),
                'args' => self::validate_health_arguments()
			));
		}

		/**
		 * Passes the params to make the request
		 * @param WP_REST_Request $request Current request.
		 */
		public function health_callback( $request ) {
			$publisher_id = sanitize_key($request->get_param( 'publisher_id' ));
			$publisher_key = sanitize_key($request->get_param( 'key' ));

			$stored_data = Pico_Setup::get_publisher_id(true);

			if (
				$publisher_id === $stored_data['publisher_id'] &&
				$publisher_key === $stored_data['api_key']
			) {
				return rest_ensure_response(array(
				    "connected" => true,
                    "pico_version" => PICO_VERSION
                ));
			} else {
				return rest_ensure_response(array(
				    "connected" => false,
                ));
			}
		}

		/**
		 * Passes the params to make the request
		 * If user_article_id isn't a param received, submit health check
		 * @param WP_REST_Request $request Current request.
		 */
		public function verify_callback( $request ) {
			$params = $request->get_query_params();
			// Sanitizes each of the keys
			$params = array_map('sanitize_key', $params);
			$data = self::make_request($params);
			return rest_ensure_response($data);
		}

		/**
		 * Arguments for verify endpoint
		 * Registers the schema for arguments
		 */
		public function validate_health_arguments() {
			$args = array();

			// registering the schema for the post_id argument.
			$args['publisher_id'] = array(
				'description' => esc_html__( 'The post ID being requested.', 'pico' ),
				'type'        => 'string',
				'required'    => true
			);

			// registering the schema for the user_article_id argument.
			$args['key'] = array(
				'description' => esc_html__( 'The user_article_id that needs to be verified.', 'pico' ),
				'type'        => 'string',
				'required'    => true
			);

			return $args;
		}

		/**
		 * Arguments for verify endpoint
		 * Registers the schema for arguments
		 */
		public function validate_verify_arguments() {
			$args = array();
			// registering the schema for the post_id argument.
			$args['post_id'] = array(
				'description' => esc_html__( 'The post ID being requested.', 'pico' ),
				'type'        => 'string',
				'required'    => false,
				'validate_callback' => array( $this, 'post_id_validate_callback' ),
			);
			// registering the schema for the user_article_id argument.
			$args['user_article_id'] = array(
				'description' => esc_html__( 'The user_article_id that needs to be verified.', 'pico' ),
				'type'        => 'string',
				'required'    => false
			);

			$args['audience_id'] = array(
				'description' => esc_html__( 'The audience_id of the user.', 'pico' ),
				'type'        => 'string',
				'required'    => false
			);
			return $args;
		}

		/**
		 * Verify that the post id is valid and published
		 */
		public function post_id_validate_callback( $value, $request, $param ) {
			// If the 'post_id' argument is not a string return an error.
			if ( !is_string( $value ) ) {
				return new WP_Error( 'rest_invalid_param', esc_html__( 'The post_id argument must be a string.', 'pico' ), array( 'status' => 400 ) );
			}
		}

		public function post_url_validate_callback( $value, $request, $param ) {
			// If the 'post_url' argument is not a string return an error.
			if ( !is_string( $value ) ) {
				return new WP_Error( 'rest_invalid_param', esc_html__( 'The post_url argument must be a string.', 'pico' ), array( 'status' => 400 ) );
			}
		}

		/**
		 * Posts user_article_id to Pico API to verify it is valid
		 */
		public function make_request( $params ) {

            $post_info = self::get_item($params);
            return $post_info;

			if (!array_key_exists('audience_id', $params)) {
				return array(
					'snippet' => $post_info['snippet'],
					'remainder' => $post_info['remainder']
				);
			}

			$args = array(
				'method'	=> 'POST',
				'blocking'  => true,
				'headers'   => array(
					'Content-Type' => 'application/json',
					'Accept' => 'application/json',
				),
				'body' => json_encode($params)
			);

			$api_url = Pico_Setup::get_api_endpoint();

			$pico_response = wp_remote_request(
					$api_url . '/user_articles/verify',
					$args
			);

			$response_code =  wp_remote_retrieve_response_code( $pico_response );
			$response_message = wp_remote_retrieve_response_message( $pico_response );
			$response_body = json_decode( wp_remote_retrieve_body( $pico_response ) );

			if ( !is_wp_error($pico_response) && $response_code == 200) {
				return array(
					'user_article' => $response_body,
					'snippet' => $post_info['snippet'],
					'remainder' => $post_info['remainder'],
					'content' => $post_info['content']
				);
			} elseif ( in_array($response_code, [400, 401, 403, 404]) ) {
				// If the API says the request is unauthorized or the userArticle isn't found, meaning they don't own it
				return new WP_Error($response_message, $response_body, array('status' => $response_code));
			} else {
				// if API is not reachable by Wordpress, send back the article contents
				return array(
					'snippet' => $post_info['snippet'],
					'remainder' => $post_info['remainder'],
					'content' => $post_info['content']
				);
			}
		}

		/**
		 * Posts user_article_id to Pico API to verify it is valid
		 */
		public function check_api_health( $params ) {
			$args = array(
				'method'	=> 'GET',
				'blocking'  => true,
				'headers'   => array(
					'Content-Type' => 'application/json',
					'Accept' => 'application/json',
				)
			);

			$api_url = Pico_Setup::get_api_endpoint();

			$pico_response = wp_remote_request(
					$api_url . '/status',
					$args
			);

			$response_code =  wp_remote_retrieve_response_code( $pico_response );
			$response_message = wp_remote_retrieve_response_message( $pico_response );
			$response_body = json_decode( wp_remote_retrieve_body( $pico_response ) );

			if ( $response_code == 200 ) {
				return new WP_Error($response_message, $response_body, array('status' => $response_code));
			} else {
				return new WP_Error($response_message, array('content' => self::get_item($params) ), array('status' => $response_code) );
			}
		}

		/**
		* Grabs the post and applies content filter
		*
		* @param array $params array of params
		*/
		public function get_item( $params ) {
			$post_id = (int) $params['post_id'];
			$post = get_post( $post_id );

			$chunks = split_post($post);

			$snippet = apply_filters('the_content', $chunks['snippet']);
			$snippet = clean_snippet($snippet);
            $remainder = apply_filters('the_content', $chunks['remainder']);
            $remainder = clean_snippet($remainder);
            $content = apply_filters('the_content', $chunks['content']);
            $content = clean_snippet($content);


			return ['snippet' => $snippet, 'remainder' => $remainder, 'content' => $content];
		}

	}

	// Function to register route from the controller.
	function pico_register_routes() {
		$controller = new Pico_API_Controller();
		$controller->register_routes();
	}

	add_action( 'rest_api_init', 'pico_register_routes' );
