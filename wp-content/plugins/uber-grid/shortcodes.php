<?php
class UberGrid_Shortcodes{
	function __construct(){
		add_shortcode('uber_grid', array($this, 'uber_grid'));
		add_shortcode('ubergrid', array($this, 'uber_grid'));
		add_action('wp_enqueue_scripts', array($this, '_wp_enqueue_scripts'), 0);
		if (get_option('uber_grid_shortcode_hack')){
			add_filter('the_content', array($this, '_shortcode_hack'), 1000);
		}
		add_action('init', array($this, '_register_visual_composer'));
		add_action('wp_footer', array($this, '_wp_footer'));
	}

	function _register_visual_composer(){
		if (!function_exists('vc_map'))
			return;
		$galleries = get_posts(array('post_type' => UBERGRID_POST_TYPE, 'posts_per_page' => -1));
		$params = array();
		foreach($galleries as $gallery){
			$params[$gallery->post_title] = $gallery->ID;
		}
		vc_map( array(
				"name" => __("UberGrid", 'uber-grid'),
				"base" => "ubergrid",
				"class" => "",
				"category" => __('Content', 'uber-grid'),
			//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
			//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
				"params" => array(
						array(
								"type" => "dropdown",
								"holder" => "div",
								"class" => "",
								"heading" => __("UberGrid"),
								"param_name" => "id",
								"value" => $params,
								"description" => __("Please enter grid ID here.", 'uber-grid')
						)
				)
		) );
	}

	function _wp_footer(){}

	function uber_grid($attributes = array(), $content = array()){
		if (!$id = intval($attributes['id']))
			return;
		if (get_option('uber_grid_shortcode_hack')){
			return "<!--ubergrid-$id-->";
		}
		return ubergrid($attributes['id'], $attributes);
	}

	function _shortcode_hack($content){
		return preg_replace_callback('/<\!\-\-ubergrid-(\d+)\-\->/',
			array($this, '_replace_callback'), $content);
	}
	function _replace_callback($matches){
		return ubergrid($matches[1]);
	}

	function _wp_enqueue_scripts(){
		if (is_admin())
			return;
		wp_enqueue_style('uber-grid', UBERGRID_URL . "assets/css/uber-grid.css",
			array(), UBERGRID_VERSION);
		wp_enqueue_style('uber-grid2', UBERGRID_URL . "assets/js/uber-grid.css",
				array(), UBERGRID_VERSION);
	}

}

$ubergrid_shortcodes = new UberGrid_Shortcodes;

function ubergrid($id, $options = array()){
	$options = wp_parse_args($options, array('echo' => false,
		'lightbox' => true, 'buttons' => true));
	$grid = new UberGrid_Grid($id, $options);
	ob_start();
	$grid->render($options);
	$text = ob_get_clean();
	if ($options['echo']){
		echo $text;
		return;
	}
	return $text;
}

function uber_grid($id, $options = array()){return ubergrid($id, $options);}
