<?php
// https://codex.wordpress.org/Taxonomies#Registering_a_taxonomy
// https://codex.wordpress.org/Function_Reference/register_taxonomy
function tsd_push_notification_receiver_group_init() {
	register_taxonomy(
		'tsd_push_msg_receiver_group',
		[ 'tsd_push_msg' ],
		[
			'labels' => [
				'name' => 'Receiver Groups',
				'singular_name' => 'Receiver Group',
				'search_items' => 'Search Receiver Groups',
				'all_items' => 'All Receiver Groups',
				'parent_item' => 'Parent Receiver Group',
				'parent_item_colon' => 'Parent Receiver Group:',
				'edit_item' => 'Edit Receiver Group',
				'update_item' => 'Update Receiver Group',
				'add_new_item' => 'Add New Receiver Group',
				'new_item_name' => 'New Receiver Group Name',
				'menu_name' => 'Receiver Group',
			],
			'public' => false,
			'show_ui' => true,
			'show_admin_column' => true,
			'hierarchical' => true,
			'query_var' => false,
			'rewrite' => false,
			'capabilities' => [
				'manage_terms' => 'update_core',
				'edit_terms' => 'update_core',
				'delete_terms' => 'update_core',
				'assign_terms' => 'update_core',
			]
		]
	);
}
add_action( 'init', 'tsd_push_notification_receiver_group_init' );
