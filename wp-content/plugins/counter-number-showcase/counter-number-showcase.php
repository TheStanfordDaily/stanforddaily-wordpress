<?php
/*
 * Plugin Name: Counter Number Showcase
 * Version: 1.0.9
 * Description: counter number showcase plugin is used to display counter number on blog and post page. 
 * Author: wpshopmart
 * Author URI: https://www.wpshopmart.com
 * Plugin URI: https://www.wpshopmart.com/plugins
 *
 */
 if ( ! defined( 'ABSPATH' ) ) exit;
define("wpshopmart_cns_directory_url", plugin_dir_url(__FILE__));
define("wpshopmart_cns_text_domain", "wpsm_cns");

 if(!function_exists('wpsm_hex2rgb_counter')) {
    function wpsm_hex2rgb_counter($hex) {
       $hex = str_replace("#", "", $hex);

       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       $rgb = array($r, $g, $b);
       return $rgb; // returns an array with the rgb values
    }
}
//default settings added
function wpsm_cns_default_data() {
	
			$Settings_CN_Array = serialize( array(
			// BOX COLOR SETTINGS
				"icon_clr" 		       => "#000000",
				"count_num_clr" 	   => "#000000",
				"count_title_clr" 	   => "#000000",
				"icon_size" 		   => "20",
				"count_num_size" 	   => "18",
				"title_size" 		   => "18",
				"cn_weight" 		   => "400",
				"font_family" 		   => "Open Sans",
				"display_icon" 		   => "yes",
				"cn_layout" 		   => "4",
				"custom_css" 		   => "",
			));
			update_option('wpsm_cns_default_settings', $Settings_CN_Array);
}
register_activation_hook( __FILE__, 'wpsm_cns_default_data' );

/**
 * PLUGIN Install
 */
require_once("inc/install/installation.php");

/**
 * counter number showcase  cpt + admin 
 */
require_once("inc/admin/menu.php");

/**
 * SHORTCODE
 */
 
require_once("templates/shortcode.php");

?>