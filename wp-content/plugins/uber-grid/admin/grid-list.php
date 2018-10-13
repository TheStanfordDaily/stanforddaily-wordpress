<?php
class UberGrid_GridList{
	function __construct(){
		add_filter("manage_" . UBERGRID_POST_TYPE . "_posts_columns", array($this, '_manage_ubergrid_custom_column'));
		add_filter("manage_" . UBERGRID_POST_TYPE . "_posts_custom_column", array($this, "_manage_ubergrid_posts_custom_column"), 10, 2);
		add_filter('init', array($this, '_init'));
	}

	function _init(){
		if (is_admin()){
			wp_enqueue_style('ubergrid-admin', UBERGRID_URL . "assets/css/admin.css");
		}

	}
	
	function _manage_ubergrid_custom_column($columns){
		uber_grid_array_insert($columns, 2, __('Shortcode', 'uber-grid'), 'ubergrid_shortcode');
		return $columns;
	}
	
	function _manage_ubergrid_posts_custom_column($column, $id){
		echo "[ubergrid id={$id}]";
	}
}

new UberGrid_GridList;