<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
function filebird_gallery_fb_block_assets() {
	wp_register_script(
		'filebird_gallery-fb-block-js',
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
		null,
		true
	);

	wp_localize_script(
		'filebird_gallery-fb-block-js',
		'fbGlobal',
		[
			'pluginDirPath' => plugin_dir_path( __DIR__ ),
			'pluginDirUrl'  => plugin_dir_url( __DIR__ ),
		]
	);

	register_block_type(
		'fb/block-filebird-gallery', array(
			'editor_script' => 'filebird_gallery-fb-block-js',
		)
	);
}

add_action( 'init', 'filebird_gallery_fb_block_assets' );
