<?php

class UberGrid_GridEditor{
	var $grid;

	function __construct(){
		add_action('admin_action_ubergrid_reload', array($this, '_ubergrid_reload'));
		add_action('admin_enqueue_scripts', array($this, '_admin_enqueue_scripts'));
		add_filter('post_updated_messages', array($this, '_post_updated_messages'));
		add_action('add_meta_boxes_' . UBERGRID_POST_TYPE, array($this, '_add_meta_boxes'));

		add_action('edit_form_after_editor', array($this, '_edit_form_after_title'));
		// Remove Quick Edit action
		add_filter('post_row_actions', array($this, '_post_row_actions'), 10, 2);

		add_action('wp_ajax_uber_grid_reload_images', array($this, '_admin_ajax_uber_grid_reload_images'));
		add_action('wp_ajax_uber_grid_preview', array($this, '_wp_ajax_preview'));
		add_action('wp_ajax_uber_grid_get_fonts', array($this, '_wp_ajax_load_fonts'));
		add_action('wp_ajax_uber_grid_clone', array($this, '_wp_ajax_clone'));

		add_action('save_post', array($this, '_save_post'), 10, 2);
		add_action('admin_footer', array($this, '_admin_footer'));

	}

	function _ubergrid_reload(){
		$id = (int)$_REQUEST['id'];
		delete_post_meta($id, '_uber_grid_data');
		wp_redirect("post.php?post=$id&action=edit");
		exit;
	}


	function _admin_enqueue_scripts($hook_suffix){
		global $post_type, $doaction;
		if ($post_type != UBERGRID_POST_TYPE || !in_array($hook_suffix,  array('post.php', 'post-new.php')))
			return;

		wp_enqueue_style('wp-color-picker');
		wp_enqueue_style('ubergrid-editor', UBERGRID_URL . "assets/css/grid-editor.css", UBERGRID_VERSION);
		wp_enqueue_media();
		wp_enqueue_script('jquery.scrollto', UBERGRID_URL . "assets/js/jquery.scrollto.js", array('jquery'), UBERGRID_VERSION);
		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('ubergrid', UBERGRID_URL . "assets/js/uber-grid.js", array('jquery'), UBERGRID_VERSION);
		wp_enqueue_script('backbone.marionette', UBERGRID_URL . "vendor/backbone.marionette.js", array('jquery', 'backbone'));
		wp_enqueue_script('sightglass', UBERGRID_URL . "vendor/sightglass.js", array('jquery'));
		wp_enqueue_script('rivets', UBERGRID_URL . "vendor/rivets.js", array('jquery', 'sightglass'));
		wp_enqueue_script('rivets-backbone-adapter', UBERGRID_URL . "vendor/rivets-backbone-adapter.js", array('rivets'));
		wp_enqueue_script('ubergrid-editor', UBERGRID_URL . "assets/js/grid-editor.js",
			array('jquery', 'backbone.marionette', 'rivets-backbone-adapter',
				'media-editor', 'media-views', 'wp-color-picker'), UBERGRID_VERSION);
	}

	function _admin_footer(){
		global $hook_suffix, $post, $post_type;
		if (($hook_suffix == 'post.php' || $hook_suffix == 'post-new.php') && $post_type == UBERGRID_POST_TYPE){

			require("templates/preview-template.php");
		}
	}

	function _post_updated_messages($messages){
		$messages[UBERGRID_POST_TYPE][1] = __('Grid updated.', 'uber-grid');
		$messages[UBERGRID_POST_TYPE][6] = __('Grid created.', 'uber-grid');
		return $messages;
	}

	function _add_meta_boxes($post){
		global $wp_meta_boxes;
		// Remove all the third party meta boxes - we don't need them
		foreach(array('advanced', 'normal', 'side') as $priority)
			$wp_meta_boxes['uber-grid'][$priority] = array();
		// Add customized Publish block.
		add_meta_box('submitdiv', __('Publish'), array($this, '_submitdiv_meta_box'), UBERGRID_POST_TYPE, 'side', 'default');

		add_meta_box('grid_layout', __('Grid Layout', 'uber-grid'), array($this, "_layout_meta_box"), UBERGRID_POST_TYPE, 'normal', 'default');
		add_meta_box('grid_extras', __('Extras', 'uber-grid'), array($this, '_extras_meta_box'), UBERGRID_POST_TYPE, 'normal', 'default');

		add_meta_box('grid_fonts', __('Fonts', 'uber-grid'), array($this, "_fonts_meta_box"), UBERGRID_POST_TYPE, 'side', 'default');
		add_meta_box('grid_revert', __('Reload 1.8 data', 'uber-grid'), array($this, "_reload_meta_box"), UBERGRID_POST_TYPE, 'side', 'default');

	}


	function _reload_meta_box($post){
		?>
		<a href="admin.php?action=ubergrid_reload&amp;id=<?php echo $post->ID ?>">Load 1.8 version data</a>
	<?php
	}

	function _submitdiv_meta_box($post){
		global $action;
		$post_type = $post->post_type;
		$post_type_object = get_post_type_object($post_type);
		$can_publish = current_user_can($post_type_object->cap->publish_posts);
		require('templates/meta-box-publish.php');
	}

	function get_grid($post){
		if (!$this->grid)
			$this->grid = new UberGrid_Grid($post->ID);
		return $this->grid;
	}
	function _extras_meta_box($post){
		$grid = $this->get_grid($post);
		require('templates/meta-box-extras.php');
	}

	function _layout_meta_box($post){
		require('templates/meta-box-layout.php');
	}

	function _fonts_meta_box($post){
		require('templates/meta-box-fonts.php');
	}

	function _edit_form_after_title(){
		global $post;
		if ($post->post_type != UBERGRID_POST_TYPE)
			return;
		$grid = $this->get_grid($post);
		require('templates/edit_form_after_title.php');
	}


	function _post_row_actions($actions, $post){
		if ($post->post_type != UBERGRID_POST_TYPE)
			return $actions;
		// Remove Quick Edit action
		unset($actions['inline hide-if-no-js']);
		return $actions;
	}

	function recode_fonts($fonts){
		$fonts = json_decode($fonts);
		$recoded = array();
		foreach($fonts->items as $item){
			$recoded []= array(
				'family' => $item->family,
				'variants' => $item->variants
			);
		}
		return json_encode(array('items' => $recoded));
	}

	function _wp_ajax_clone(){
		$id = $_REQUEST['id'];
		check_admin_referer('ubergrid-clone-' . $id);
		$post = get_post($id);
		$post->ID = null;
		$post->post_title = $post->post_title . " " . __('(copy)', 'uber-grid');
		$newid = wp_insert_post($post);
		foreach(get_post_custom($id) as $key => $value){
			if (!in_array($key, array('_edit_lock'))){
				foreach($value as $k => $value_item)
					add_post_meta($newid, $key, maybe_unserialize($value_item), true);
			}
		}
		update_post_meta($newid, '_ubergrid', addslashes(get_post_meta($id, '_ubergrid', true)));
		update_post_meta($newid, '_uber_grid_data', addslashes(get_post_meta($id, '_uber_grid_data', true)));
		wp_redirect(admin_url('post.php?action=edit&post=' . $newid));
		exit;
	}

	function _wp_ajax_load_fonts(){
		if (false === ($fonts = get_transient('uber_grid_fonts'))){
			$fonts = wp_remote_get('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyDSpTwW0s_wuysfud2LSssvVOEvHD0ltOs');
			if (!is_wp_error($fonts)){
				$fonts = $this->recode_fonts($fonts['body']);
				set_transient('uber_grid_fonts', $fonts, 3600 * 24);
			}
		}
		if (is_wp_error($fonts) || strlen($fonts) < 512){
			$fonts = fread($file = fopen(UBERGRID_PATH . "assets/fonts.json", 'r'), filesize(UBERGRID_PATH . "assets/fonts.json"));
			fclose($file);
		}
		header('Content-type: text/json');
		echo $fonts;
		exit;
	}


	function _admin_ajax_uber_grid_reload_images(){
		require_once(ABSPATH . "wp-admin/includes/image.php");
		header('Content-type: text/json');
		$srcs = array();
		foreach(explode(',', $_REQUEST['ids']) as $id){
			wp_generate_attachment_metadata($id, get_attached_file($id));
			$src = wp_get_attachment_image_src($id, 'uber-grid-' . $_REQUEST['layout']);
			$srcs []= $src[0];
		}
		echo json_encode(array('srcs' => $srcs));
		exit;
	}


	function _save_post($id, $post){
		if ($post->post_type != UBERGRID_POST_TYPE)
			return;

		if (isset($_REQUEST['uber-grid-data'])){
			update_post_meta($id, '_uber_grid_data', ($_REQUEST['uber-grid-data']));
		}

		//Hack to prevent draft posts
		remove_action('save_post', array($this, '_save_post'));
		$post_data = array('ID' => $id, 'post_name' => isset($_POST['post_title']) ? sanitize_title(stripslashes($_POST['post_title'])) : '');
		if ($post->post_status == 'draft'){
			$post_data['post_status'] = 'publish';
		}
		wp_update_post($post_data);
		add_action('save_post', array($this, '_save_post'));

	}

	function _wp_ajax_preview(){
		$data = stripslashes_deep($_POST['data']);

		$id = $_REQUEST['id'];


		$grid = new UberGrid_Grid($id, array(), json_decode($data));
		echo "<link rel='stylesheet' id='preview-css'  href='" . UBERGRID_URL . "assets/css/uber-grid.css' type='text/css' media='all' />";
		$grid->render(array('buttons' => false, 'lightbox' => true));
		exit;
	}

}

new UberGrid_GridEditor;
