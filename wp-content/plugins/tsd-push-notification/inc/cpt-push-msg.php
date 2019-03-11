<?php
function tsd_add_push_notification_post_type() {
	// Ref: https://developer.wordpress.org/reference/functions/register_post_type/#comment-351
	$labels = [
		'name'                  => 'Push Notifications', // Post type general name
		'singular_name'         => 'Push Notification', // Post type singular name
		'menu_name'             => 'Push Notifications', // Admin Menu text
		'name_admin_bar'        => 'Push Notification', // Add New on Toolbar
		'add_new'               => 'Send New',
		'add_new_item'          => 'Send New Push Notification',
		'new_item'              => 'New Push Notification',
		'edit_item'             => 'Edit Push Notification',
		'view_item'             => 'View Push Notification',
		'all_items'             => 'Past Push Notifications',
		'search_items'          => 'Search Push Notifications',
		'parent_item_colon'     => 'Parent Push Notifications:',
		'not_found'             => 'No Push Notifications found.',
		'not_found_in_trash'    => 'No Push Notifications found in Trash.',
		'featured_image'        => 'Push Notification Feature Image', // Overrides the “Featured Image” phrase for this post type. Added in 4.3
		'set_featured_image'    => 'Set feature image', // Overrides the “Set featured image” phrase for this post type. Added in 4.3
		'remove_featured_image' => 'Remove feature image', // Overrides the “Remove featured image” phrase for this post type. Added in 4.3
		'use_featured_image'    => 'Use as feature image', // Overrides the “Use as featured image” phrase for this post type. Added in 4.3
		'archives'              => 'Push Notification archives', // The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4
		'insert_into_item'      => 'Insert into Push Notification', // Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4
		'uploaded_to_this_item' => 'Uploaded to this Push Notification', // Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4
		'filter_items_list'     => 'Filter Push Notifications list', // Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4
		'items_list_navigation' => 'Push Notifications list navigation', // Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4
		'items_list'            => 'Push Notifications list', // Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4
	];
	$args = [
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_rest'       => false,
		'menu_icon'          => "dashicons-cloud",
		'query_var'          => false,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'capabilities' => [
			'edit_published_posts' => false,
			'delete_published_posts' => false,
			// https://wordpress.stackexchange.com/a/54962/75147
			'edit_post'          => 'update_core',
			'read_post'          => 'update_core',
			'delete_post'        => 'update_core',
			'edit_posts'         => 'update_core',
			'edit_others_posts'  => 'update_core',
			'delete_posts'       => 'update_core',
			'publish_posts'      => 'update_core',
			'read_private_posts' => 'update_core',
		],
		'map_meta_cap'       => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => [ 'title', 'excerpt', 'custom-fields', 'thumbnail' ],
	];
	register_post_type( 'tsd_push_msg', $args );
}
add_action( 'init', 'tsd_add_push_notification_post_type' );

// https://wordpress.stackexchange.com/a/137257/75147
function tsd_push_notification_post_type_on_publish( $post_id, $post ) {
	// https://stackoverflow.com/a/139553/2603230
	//$log_content = "<pre>".var_export( $post, true )."</pre>";
	//var_dump($log_content);

	$receiver_groups = get_the_terms( $post->ID, 'tsd_push_msg_receiver_group' );
	$receiver_cpt_ids = [];
	if ( $receiver_groups ) {
		foreach ( $receiver_groups as $each_receiver_group ) {
			$each_receiver_group_id = tsd_pn_get_sub_list_id_from_name( $each_receiver_group->slug );
			$receiver_cpt_ids = array_merge( $receiver_cpt_ids, tsd_pn_sub_get_receivers_for_item( "list", $each_receiver_group_id ) );
		}
	}
	$receiver_cpt_ids = array_unique( $receiver_cpt_ids );

	$custom_fields = get_post_custom( $post_id );
	// https://stackoverflow.com/a/4979308/2603230
	$tsd_pn_custom_fields = [];
	foreach ( $custom_fields as $key => $value ) {
		if ( strpos( $key, 'tsd_pn_' ) === 0 ) {
			// Remove `tsd_pn_` from key.
			$tsd_pn_custom_fields[ substr( $key, 7 ) ] = $value[ 0 ];
		}
	}

	$send_results = tsd_send_expo_push_notification(
		$receiver_cpt_ids,
		$post->post_title,
		$post->post_excerpt,
		$tsd_pn_custom_fields,
		true
	);

	// If failed.
	if ( !$send_results ) {
		wp_update_post( [
			'ID' => $post_id,
			'post_status' => 'draft',
		] );
	}
}
add_action( 'publish_tsd_push_msg', 'tsd_push_notification_post_type_on_publish', 10, 2 );
