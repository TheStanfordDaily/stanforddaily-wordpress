<?php

function uber_grid_array_insert(&$input, $offset, $element, $key = null){
	if ($key == null)
		$key = $offset;
	if ($offset > count($input))
		$offset = count($input);
	else if ($offset < 0)
		$offset = 0;
	$input = array_merge(array_slice($input, 0, $offset), array($key => $element), array_slice($input, $offset));
}


function uber_grid_hex2rgba($hex, $opacity = 1){
	if (empty($hex))
		return 'transparent';
	$hex = preg_replace("/^#/", "", trim($hex));
	$color = array();
	if(strlen($hex) == 3) {
		$color['r'] = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
		$color['g'] = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
		$color['b'] = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
	}
	else if(strlen($hex) == 6) {
		$color['r'] = hexdec(substr($hex, 0, 2));
		$color['g'] = hexdec(substr($hex, 2, 2));
		$color['b'] = hexdec(substr($hex, 4, 2));
	}
	return "rgba(" . implode(', ', $color) . ", " . $opacity . ")";
}


function uber_grid_color($hex, $opacity = 1.0){
	$hex = strtolower($hex);
	if (preg_match("/^#?(\d|[abcdef]){3,6}$/i", $hex)){
		if ((float)$opacity < 1.0)
			return uber_grid_hex2rgba($hex, $opacity);
		if (preg_match("/^#(\d|[abcdef]){3,6}$/i", $hex))
			return $hex;
		if (preg_match("/^(\d|[abcdef]){3,6}$/i", $hex))
			return "#" . $hex;
	}
	return $hex;
}

function uber_grid_ajax_url(){
	return admin_url('admin-ajax.php', 'relative');
}

function uber_grid_get_builtin_image($file, $option_name){
	if (false === ($image = get_option($option_name))){
		$id = uber_grid_add_image($file);
		if (is_wp_error($id))
			return null;
		update_option($option_name, $id);
		return $id;
	}
	if (false !== wp_get_attachment_image_src($image))
		return $image;
	$id = uber_grid_add_image($file);
	if (is_wp_error($id))
		return null;
	update_option($option_name, $id);
	return $id;
}

function uber_grid_add_image($path){
	$upload_dir = wp_upload_dir();
	$file = wp_unique_filename($upload_dir['path'], basename($path));
	$file_path = $upload_dir['path'] . "/" . $file;
	$plus_contents = file_get_contents($path);
	file_put_contents($file_path, $plus_contents);
	$attachment = array(
			'post_mime_type' => 'image/png',
			'guid' => $upload_dir['url'] . "/" . $file,
			'post_title' => __('Plus', 'uber-grid'),
			'post_content' => '',
	);
	$id = wp_insert_attachment($attachment, $file_path);

	if ( !is_wp_error($id) ) {
		wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $file_path ) );
	}
	return $id;
}

function uber_grid_get_test_image(){
	return uber_grid_get_builtin_image(UBERGRID_PATH .
		"assets/admin/images/image-troubleshooting/demo.jpg", 'uber_grid_demo_image'
	);
}

function uber_grid_lightbox_theme_option_get() {
	return get_option('uber_grid_lightbox_theme', 'black');
}
