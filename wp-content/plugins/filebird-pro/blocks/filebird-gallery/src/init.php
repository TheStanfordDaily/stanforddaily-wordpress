<?php
use FileBird\Model\Folder as FolderModel;

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
		'filebird/block-filebird-gallery', array(
			'editor_script' => 'filebird_gallery-fb-block-js',
			'render_callback' => 'filebird_gallery_render',	
			'attributes' => array(
				'selectedFolder' => array(
					'type' => 'array',
					'default' => array()
				),
				'hasCaption' => array(
					'type' => 'boolean',
					'default' => false,
				),
				'captions' => array(
					'type' => 'object',
					'default' => array()
				),
				'imagesRemoved' => array(
					'type' => 'array',
					'default' => array()
				),
                'images' => array(
					'type' => 'array',
					'default' => array()
				),
				'columns' => array(
					'type' => 'integer',
					'default' => 3
				),
				'isCropped' => array(
					'type' => 'boolean',
					'default' => true
				),
				'linkTo' => array(
					'type' => 'string',
					'default' => 'none'
				),
				'sortBy' => array(
					'type' => 'string',
					'default' => 'date'
				),
				'sortType' => array(
					'type' => 'string',
					'default' => 'DESC'
				)
            )
		)
	);
}

function filebird_gallery_render( $attributes ){
	global $wpdb;

	if (empty($attributes['selectedFolder'])) return '';
	
    $where_arr = array('1 = 1');
	$where_arr[] = "`folder_id` IN (".implode(',', $attributes['selectedFolder']).")";
	$in_not_in = $wpdb->get_col("SELECT `attachment_id` FROM {$wpdb->prefix}fbv_attachment_folder". " WHERE " . implode(' AND ', apply_filters('fbv_in_not_in_where_query', $where_arr, $attributes['selectedFolder'])));

	if (empty($in_not_in)) return '';

	$query = new \WP_Query(array(
        'post_type' => 'attachment',
		'posts_per_page' => -1,
		'post__in' => $in_not_in,
		'orderby' => $attributes['sortBy'],
		'order' => $attributes['sortType'],
		'post_status' => 'inherit'
	));
	$posts = $query->get_posts();
	$ulClass = 'wp-block-filebird-block-filebird-gallery wp-block-gallery blocks-gallery-grid';
	$ulClass .= ' columns-' . $attributes['columns'];
	$ulClass .= $attributes['isCropped'] ? ' is-cropped' : '';

	if (count($posts) < 1) return '';

	$html = '';
	$html .= '<ul class="' . $ulClass . '">';

	foreach ($posts as $post) {
		if (!wp_attachment_is_image($post)) {
			continue;
		}
		$href = '';
		$imageSrc = wp_get_attachment_image_src($post->ID, 'full');
		$imageSrc = $imageSrc[0];
		switch ($attributes['linkTo']) {
			case 'media':
				$href = $imageSrc;
				break;
			case 'attachment':
				$href = get_attachment_link($post->ID);;
				break;
			default:
				break;
		}

		$img = '<img src="' . $imageSrc . '"' . ' alt="' . 'img' . '"';   
		$img .= 'class="' . "wp-image-{$post->ID}" . '"/>';

		$li = '<li class="blocks-gallery-item">';
		$li .= '<figure>';
		
		$li .= empty($href) ? $img : '<a href="' . $href . '">' . $img . '</a>';

		if ($attributes['hasCaption']) {
			$li .= empty($post->post_excerpt) ? '' : '<figcaption class="blocks-gallery-item__caption">' . $post->post_excerpt . '</figcaption>';
		}

		$li .= '</figure>';
		$li .= '</li>';

		$html .= $li;
	}

	$html .= '</ul>';

	return $html;
}

function filebird_gutenberg_get_images (){
	register_rest_route(NJFB_REST_URL,
		'gutenberg-get-images',
		array(
			'methods' => 'POST',
			'callback' => 'filebird_gutenberg_render_callback',
			'permission_callback' => '__return_true'
		)
	);
}

function filebird_gutenberg_render_callback($request){
	$attributes = $request->get_params();

	$html = filebird_gallery_render($attributes);
	wp_send_json(array(
		'html' => $html
	));
}

add_action( 'init', 'filebird_gallery_fb_block_assets' );
add_action( 'rest_api_init', 'filebird_gutenberg_get_images' );
