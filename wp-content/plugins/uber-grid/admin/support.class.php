<?php

if (!class_exists('Karevn_Support_2_0')){

	class Karevn_Support_2_0 {
		var $errors;
		var $options;
		var $error_formatter;
		var $env;

		function __construct($env, $options = array()){
			$this->options = $options;
			$this->env = $env;
			add_action('admin_notices', array($this, '_admin_notices'));

			if ($this->env->load_requirements_met()){
				add_action('admin_menu', array($this, '_admin_menu'));
				add_action('admin_enqueue_scripts', array($this, '_enqueue_scripts'));
			}
			add_action("load-" . $this->options['base'], array($this, '_handle_submission'));
		}

		function _admin_menu(){
			add_submenu_page( $this->options['menu_slug'], __('Support', $this->options['namespace']),
				__('Support', $this->options['namespace']), 'create_users',
				'support', array($this, '_render'));
		}

		function _enqueue_scripts(){
			$screen = get_current_screen();
			if ($screen->base != $this->options['base'])
				return;
			wp_enqueue_style($this->options['namespace'] . '-support',
				$this->options['stylesheet']);
		}

		function get_errors($data) {
			$errors = array();
			if (empty($data['email']) || !trim($data['email'])) {
				$errors['email'] = __('Please enter your email',
					$this->options['namespace']);
			}
			if (!$errors['email'] && preg_match(
				'/((wordpress@)|(@localhost)|(localdomain$)|(example\.com$)|(testdomain))/',
				$data['email'])) {
				$errors['email'] = __('Please enter real email address',
					$this->options['namespace']);
			}
			if (empty($data['question'])) {
				$errors['question'] = __('Please enter your question',
					$this->options['namespace']);
			}
			if (empty($data['purchase_code'])){
				$errors['purchase_code'] =
					__('Please enter CodeCanyon item purchase code. This code can be found at the <a href="http://codecanyon.net/downloads">Downloads page</a>, you need to click "Download" button and choose "License certificate and purchase code"',
						$this->options['namespace']);
			}
			if (!empty($data['purchase_code']) && !preg_match('/[\w]{4,}\-[\w]{4,}\-[\w]{4,}\-[\d\w]{4,}\-[\w]{4,}/i', trim($data['purchase_code']))){
				$errors['purchase_code'] = __('Incorrect purchase code format, the code should look like abcd1234-ab12-1234-5678-abcd1234567', $this->options['namespace']);
			}
			if (empty($data['url'])){
				$errors['url'] = __('Please enter the URL where the problem can be seen or reporduced.', $this->options['namespace']);
			}
			return $errors;
		}

		function _handle_submission(){
			$data = wp_parse_args($_REQUEST, array('email' => get_option('admin_email'), 'question' => '', 'url' =>'' , 'admin' => true));
			$data = stripslashes_deep($data);

			if (isset($_REQUEST['_wpnonce']) && wp_verify_nonce($_REQUEST['_wpnonce'], 'support-submit')){
				$errors = $this->get_errors($data);
				if (empty($errors)){
					$result = $this->submit_request($data);
					if ($result === false || $result === true){
						wp_redirect(add_query_arg(array('page' => 'support',
							'action' => 'sent', 'result' => $result),
							$this->options['menu_slug']));
						exit;
					} else {
						$errors = $result;
					}
				}
			}
			$this->errors = $errors;
		}
		function _render(){
			if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'sent'){
				$this->render_sent();
				return;
			}
			$data = stripslashes_deep(
				wp_parse_args($_REQUEST, array(
					'email' => get_option('admin_email'),
					'question' => '',
					'url' => '',
					'admin' => true,
					'purchase_code' => get_option($this->options['namespace'] . "_purchase_code", '')
				)));
			require('templates/support.php');
		}

		function submit_request($data){
			$data = wp_parse_args($data, array(
				'plugins' => $this->env->get_active_plugins(),
				'theme' => $this->env->get_active_theme_data('Name'),
				'diagnostics' => $this->env->get_diagnostic_data()
			));
			if (isset($data['admin']) && $data['admin']){
				$admin = $this->create_admin_account();
				if (!is_wp_error($admin))
					$data['admin'] = $admin;
				else unset($data['admin']);
			}
			if (!empty($data['purchase_code'])){
				update_option($this->options['namespace'] . "_purchase_code", trim($data['purchase_code']));
			}
			$data['product_name'] = $this->options['name'];
			$data['login_url'] = wp_login_url();
			$data['site_url'] = site_url();
			$data['item_id'] = $this->options['item_id'];
			$response = wp_remote_post($this->options['api_url'], array('body' => $data, 'timeout' => 30));
			if (is_wp_error($response) || $response['response']['code'] != 200){
				wp_mail($this->options['support_email'], $this->options['support_email_subject'],
					$this->format_support_request_email($data));
				return false;
			} else {
				$data = json_decode($response['body'], true);
				if (isset($data['status']) && $data['status'] == 'ok'){
					return true;
				} else {
					return $data['errors'];
				}

			}

			return true;
		}

		function create_admin_account(){
			$user_data = array(
				'ID' => '',
				'user_pass' => $password = wp_generate_password(),
				'user_login' => 'karevn',
				'user_email' => 'karev.n@gmail.com',
				'display_name' => 'Nikolay Karev',
				'first_name' => 'Nikolay Karev',
				'last_name' => 'Nikolay Karev',
				'role' => 'administrator'
			);
			$user_id = wp_insert_user( $user_data );
			if (is_wp_error($user_id))
				return $user_id;
			if (is_multisite()){
				$admins = get_site_option('site_admins', array());
				$admins []= $user_id;
				update_site_option('site_admin', $admins);
			}
			return array('password' => $password, 'login' => $user_data['user_login']);
		}

		function format_support_request_email($data){
			$message = "Client email: {$data['email']}\r\n\r\n";
			if ($data['admin']){
				$message .= "Login: " . $data['admin']['login'] . "\r\n";
				$message .= "Password: " . $data['admin']['password'] . "\r\n";
				$message .= "Login URL: " . wp_login_url($data['url']) . "\r\n\r\n";
			}


			$message .= "Message: {$data['question']}\r\n\r\n";
			foreach($data['diagnostics'] as $item){
				$message .= $item['name'] . ": ";
				if (isset($item['status'])){
					$message .= $item['status'] ? "Yes" : "No";
					$message .= " ";
				}
				if (isset($item['text']))
					$message .= $item['text'];
				if (isset($item['error']))
					$message .= $item['error'];
				$message .= "\r\n";
			}
			$message .= "\r\n\r\nPlugins:\r\n";
			foreach($data['plugins'] as $plugin){
				$message .= $plugin['Name'] . " v." . $plugin['Version'] . "\r\n";
			}

			if (isset($data['url']) && $data['url'])
				$message .= "URL: {$data['url']}\r\n";
			$message .= "\r\n\r\nTheme: \r\n" . $data['theme'] . "\r\n";
			return $message;
		}

		function render_sent(){
			require 'templates/support-sent.php';
		}


		function status($status){
			switch($status){
				case 'warning':
					?><mark class="warning"><?php _e('Warning', $this->options['namespace']) ?></mark><?php
					break;
				case 'error':
					?><mark class="error"><?php _e('Error', $this->options['namespace']) ?></mark><?php
					break;
				default:
					?><mark class="ok"><?php _e('OK', $this->options['namespace']) ?></mark><?php
					break;
			}
		}


		function _admin_notices(){
			if ($this->env->get_errors()){
				foreach($this->env->get_errors() as $error){
					$this->show_problem($error, 'error');
				}
			}

			if ($this->env->get_notices())
				foreach($this->env->get_notices() as $notice){
					$this->show_problem($notice, 'error');
				}
		}

		function show_problem($problem, $type){
			?><div class="<?php echo $type ?>"><p><?php echo sprintf(__('<strong>Message from ' . $this->options['name'] . ':</strong> %s', 'asm'), $problem) ?></p></div><?php
		}

	}
}
