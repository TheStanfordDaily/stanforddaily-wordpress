<?php
if (!class_exists('Karevn_Environment_1_0')){


	abstract class Karevn_Environment_1_0{
		var $memory_limit = 40;
		var $required_wp_version = '3.7';
		var $namespace;
		var $name;

		function __construct($namespace, $name){
			$this->namespace = $namespace;
			$this->name = $name;
			add_action('wp_ajax_nopriv_' . $this->namespace . '_ping', array($this, '_admin_ajax_available'));
		}



		public function check_memory_limit(){
			if ($this->get_memory_limit() > $this->memory_limit)
				return true;
			return __('Please increase your memory limit.', $this->namespace);
		}

		function check_wp_version(){
			global $wp_version;
			if (version_compare($wp_version, $this->required_wp_version , '>='))
				return true;
			return __('Please upgrade your WordPress installation', $this->namespace);
		}



		function get_active_theme_data($name){
			$active_theme = wp_get_theme();
			return $active_theme->$name;
		}

		function get_gd_supported(){
			return (extension_loaded('gd') && function_exists('gd_info'));
		}

		function get_admin_ajax_available(){
			if (is_wp_error($response = wp_remote_get(add_query_arg(
					'action', $this->namespace . "_ping", admin_url('admin-ajax.php')))))
				return $response->get_error_message();
			if ($response['body'] == 'working')
				return true;
			return false;
		}


		function _admin_ajax_available(){
			echo 'working';
			exit;
		}

		function get_http_status(){
			if (($response = get_transient($this->namespace . "_http_test")) === false){
				$response = wp_remote_get(site_url());
				set_transient($this->namespace . "_http_test", $response, 600);
			}
			return $response;
		}

		function get_memory_limit(){
			return (int)ini_get('memory_limit');
		}


		function get_active_plugins(){
			$active_plugins = (array) get_option( 'active_plugins', array() );
			if ( is_multisite() )
				$active_plugins = array_merge( $active_plugins,
						array_keys(get_site_option( 'active_sitewide_plugins', array()) ) );
			$plugins = array();
			foreach($active_plugins as $plugin){
				$plugins []= get_plugin_data(WP_PLUGIN_DIR . "/" . $plugin);
			}
			return $plugins;
		}

		function get_errors(){
			$errors = array();
			if ($this->check_wp_version() !== true)
				$errors []= sprintf($this->name . " " .  __('plugin requires at least WordPress %s.
					Please <a href="%s">update your installation</a> to enable UberGrid.', $this->namespace),
						$this->required_wp_version, admin_url('update-core.php'));
			return $errors;
		}

		function get_notices(){return array();}

		function get_diagnostic_data(){
			return array(
					array(  'name' => 'Home URL', 'text' => home_url()),
					array(  'name' => 'Site URL', 'text' => site_url()),
					array(  'name' => 'WP Version',
							'status' => $this->check_wp_version() === true,
							'text' => (is_multisite() ? 'WPMU' : 'WP') . get_bloginfo('version')),
					array(  'name' => 'Server Software', 'text' => $_SERVER['SERVER_SOFTWARE']),
					array(  'name' => 'PHP Version',
							'text' => function_exists('phpversion') ? phpversion() : __("Can't detect", $this->namespace)),
					array('name' => 'WP Debug Mode',
							'status' => !defined('WP_DEBUG') || !WP_DEBUG,
							'warning' => true,
							'error' => __('Not a big deal,
									but it is recommended to disable debug mode on production sites', $this->namespace)
					)

			);
		}
		function load_requirements_met(){
			return $this->check_wp_version() === true;
		}
	}
}


class UberGrid_Environment extends Karevn_Environment_1_0{
	function __construct(){
		parent::__construct('ubergrid', __('UberGrid', 'ubergrid'));
		$this->required_wp_version = UBERGRID_REQUIRED_WP;
		if ($this->load_requirements_met()){
			add_action('wp_ajax_nopriv_ubergrid_ping', array($this, '_ping'));

		}
		add_action('init', array($this, '_init'), 11);
	}

	function _init(){
		new Karevn_Support_2_0($this, array(
						'namespace' => $this->namespace,
						'name' => $this->name,
						'menu_slug' => "edit.php?post_type=" . UBERGRID_POST_TYPE,
						'base' => 'uber-grid_page_support',
						'item_id' => 4851992,
						'stylesheet' => UBERGRID_URL . "assets/admin/css/support.css",
						'api_url' => apply_filters('ubergrid_api_url', 'http://api.karevn.com/v2/tickets/'),
						'support_email' => apply_filters('ubergrid_support_email', 'karev.n@gmail.com'),
						'support_email_subject' => __('UberGrid Support Request', 'uber-grid')
				)
		);
	}

	function _ping(){
		echo 'working';
		exit;
	}

	function get_diagnostic_data(){
		$data = parent::get_diagnostic_data();
		$http_status = $this->get_http_status();
		$data []= array(
				'name' => 'GD library support',
				'status' => $this->get_gd_supported(),
				'error' => __('GD library is required to resize images before displaying. Please contact
					your hosting provider in order to install it.', 'uber-grid'));
		$ajax_status = $this->get_admin_ajax_available();
		$data []= array(
				'name' => 'wp-admin/admin-ajax.php file available',
				'status' => $ajax_status && !is_wp_error($ajax_status),
				'warning' => true,
				'error' => __('This may break "Load more" or endless scrolling. To fix this issue,
					please disable security hardening plugins and make sure your .htaccess file does not restrict an
					access to this file.', 'uber-grid'));
		return $data;
	}

	function try_to_create($dir){
		$parent = dirname($dir);
		$perms = fileperms($parent);
		@chmod(0x777, $parent);
		@mkdir($dir);
		@chmod($perms, $parent);
	}


	function get_errors(){
		$errors = parent::get_errors();
		return $errors;
	}

	function get_notices(){
		$notices = parent::get_notices();

		if (is_wp_error($this->get_http_status())){
			$errors []= __('External HTTP requests are not supported. This will break most of image sources. Please install Curl or other PHP HTTP extension.', $this->namespace);
		}
		return $notices;
	}



}
