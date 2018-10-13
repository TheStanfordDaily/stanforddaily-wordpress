<?php

class UberGrid_WPData{
	function __construct(){
		add_action('init', array($this, '_register_post_types'));
	}

	function _register_post_types(){
		register_post_type(UBERGRID_POST_TYPE, array(
			'label' => __('UberGrid', 'uber-grid'),
			'public' => false,
			'show_ui' => true,
			'labels' => array(
				'add_new' => __('Add new Grid', 'uber-grid'),
				'add_new_item' => __('Add new Grid', 'uber-grid'),
				'edit_item' => __('Edit Grid', 'uber-grid'),
				'search_items' => __('Search grids', 'uber-grid'),
				'not_found' => __('No grids yet', 'uber-grid')
			),
			'supports' => array('title')
		));
	}
}

new UberGrid_WPData;
