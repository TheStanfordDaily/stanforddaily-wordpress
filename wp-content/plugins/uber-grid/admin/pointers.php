<?php
	
class UberGrid_Pointers{
	function __construct(){
		add_action('admin_enqueue_scripts', array($this, '_admin_init'));
		add_action('wp_ajax_uber_grid_dismiss_pointer', array($this, '_dismiss_pointer'));
	}
	
	function _dismiss_pointer(){
		$disabled = get_user_meta(get_current_user_id(), 'uber_grid_disabled_pointers', true);
		if (!$disabled)
			$disabled = array();
		$disabled []= $_REQUEST['pointer'];
		update_user_meta(get_current_user_id(), 'uber_grid_disabled_pointers', $disabled);
		exit;
	}
	function _admin_init(){
		global $post;
		$screen =  get_current_screen();
		$pointers = array();
		if ($screen->base == 'post' && $screen->post_type == UBERGRID_POST_TYPE){
			$pointers = array(
				'#add-new-cell' => array(
					'title' => __('Add a cell', 'uber-grid'),
					'content' => __('<p>Click here to add a first cell to your grid.</p>', 'uber-grid'),
					'position' => array('edge' => 'right', 'align' => 'center')
				),
				'#shortcode' => array(
					'title' => __('Save your grid', 'uber-grid'),
					'content' => sprintf(__('<p>After saving your grid, insert this code <strong>[ubergrid id=%s]</strong> into your site pages to use the grid.</p>','uber-grid'), $post->ID),
					'position' => array('edge' => 'top')
				)
			);
		}
		if ($screen->base == 'edit' && $screen->post_type == UBERGRID_POST_TYPE){
			$pointers = array(
				'.add-new-h2' => array(
					'title' => __('Create a grid', 'uber-grid'),
					'content' => __('<p>Please click here to create your first grid.</p>', 'uber-grid')
				)
			);
		}
		
		$disabled = get_user_meta(get_current_user_id(), 'uber_grid_disabled_pointers', true);

		if ($disabled){
			foreach($disabled as $item){
				if (isset($pointers[$item]))
					unset($pointers[$item]);
			}
		}

		if ($pointers){
			wp_enqueue_script("wp-pointer");
			wp_enqueue_style("wp-pointer");
			wp_enqueue_script('uber-grid-pointers', UBERGRID_URL . 'assets/js/admin-pointers.js');
			wp_localize_script('uber-grid-pointers', 'uber_grid_pointers', array($pointers));
			
		}
	}
}

new UberGrid_Pointers;
?>