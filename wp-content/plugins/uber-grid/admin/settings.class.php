<?php
class UberGrid_Settings{
	function __construct(){
		add_action('admin_menu', array($this, '_admin_menu'));
		add_action('admin_init', array($this, '_admin_init'));
		add_action('admin_enqueue_scripts', array($this, '_enqueue_scripts'));
	}

	function _admin_menu(){
		add_options_page(
			__('UberGrid', 'uber-grid'),
			__('UberGrid', 'uber-grid'),
			'manage_options',
			'uber-grid-options',
			array($this, 'build_option_pages'));
	}

	function _admin_init(){
		$settings = array(
			'uber_grid_force_new_jquery' => 'intval',
			'uber_grid_shortcode_hack' => 'intval',
			'uber_grid_prettyphoto_theme' => 'stripslashes',
			'uber_grid_processing_engine' => 'stripslashes',
			'uber_grid_hide_buttons' => 'intval',
			'uber_grid_lightbox_theme' => 'stripslashes');
		foreach($settings as $option => $function){
			register_setting('uber-grid-options', $option, $function);
		}
	}

	function _enqueue_scripts(){
		global $hook_suffix;
		if ($hook_suffix != 'settings_page_uber-grid-options')
			return;
		wp_enqueue_style('uber-grid-settings', UBERGRID_URL . "assets/css/ubergrid-settings.css");
	}

	function build_option_pages(){
		$upload_permissions_ok = $this->upload_permissions_ok();
		$gd_ok =  $this->gd_ok();
		$stylesheet_accessible = $this->stylesheet_accessible();
		require(dirname(__FILE__) . '/templates/settings.php');
	}

	function upload_permissions_ok(){
		$dir = wp_upload_dir();
		return is_writable($dir['basedir']);
	}

	function gd_ok(){
		return extension_loaded('gd') && function_exists('gd_info');
	}

	function stylesheet_accessible(){
		$response = wp_remote_get(UBERGRID_URL . "frontend-style.css.php", array('timeout' => 3));
		if (is_wp_error($response))
			return false;
		return $response['response']['code'] == 200;
	}
}
new UberGrid_Settings;
