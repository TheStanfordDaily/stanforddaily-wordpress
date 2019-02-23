<?php
/**
* Plugin Name: The Stanford Daily - Push Notification
* Description: Add push notification supports.
* Author: The Stanford Daily Tech Team
* Version: 1.0
* History:
* 1.0 (2019-02-18) - Created. (Yifei He)
*/

include_once "rest-api-endpoints.php";

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
function tsd_push_notification_post_type_on_save( $post_id, $post, $update ) {
    if ( $update && $post->post_status == "publish" ) {
        // https://stackoverflow.com/a/139553/2603230
        $log_content = "<pre>".var_export( $post, true )."</pre>";
        var_dump($log_content);

        // TODO: only send notification to certain groups
        $user_lists = get_posts( [
            'post_type'  => 'tsd_pn_receiver',
        ] );

        $message_body = [
            "title" => $post->post_title,
            "body" => $post->post_excerpt,
        ];

        $all_messages = [];
        foreach ( $user_lists as $each_user ) {
            $each_message = $message_body;
            $each_message[ "to" ] = $each_user->post_title;
            $all_messages[] = $each_message;
        }

        // Ref: https://docs.expo.io/versions/latest/guides/push-notifications/#http2-api
        // TODO: "an array of up to 100 messages" - need divide 100
        $response = wp_remote_post( "https://exp.host/--/api/v2/push/send", [
            'method' => 'POST',
            'timeout' => 15,
            'httpversion' => '2.0',
            'headers' => [ "content-type" => "application/json" ],
            'body' => json_encode( $all_messages ),
        ] );

        if ( is_wp_error( $response ) ) {
            $error_message = $response->get_error_message();
            echo "Something went wrong: $error_message";
        } else {
            echo 'Response:<pre>';
            print_r( $response );
            echo '</pre>';
        }

        // TODO: Use admin_notices
        // Ref:
        // https://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices
        // https://digwp.com/2016/05/wordpress-admin-notices/

        //wp_die( "Notification sent!<br />".$log_content, "Notification sent!", [ "response" => 200, "back_link" => true ] );
    }
}
add_action( 'save_post_tsd_push_msg', 'tsd_push_notification_post_type_on_save', 10, 3 );

// https://codex.wordpress.org/Taxonomies#Registering_a_taxonomy
// https://codex.wordpress.org/Function_Reference/register_taxonomy
function tsd_push_notification_receiver_group_init() {
	register_taxonomy(
		'tsd_push_msg_receiver_group',
		[ 'tsd_push_msg', 'tsd_pn_receiver' ],
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


function tsd_add_push_notification_receiver_post_type() {
    $args = [
        'label'              => "PN Users",
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_rest'       => false,
        'menu_icon'          => "dashicons-networking",
        'query_var'          => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'capabilities' => [
            'edit_post'          => 'update_core',
            'read_post'          => 'update_core',
            'delete_post'        => 'update_core',
            'edit_posts'         => 'update_core',
            'edit_others_posts'  => 'update_core',
            'publish_posts'      => 'update_core',
            'read_private_posts' => 'update_core',
            'create_posts'       => 'update_core',
        ],
        'map_meta_cap'       => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => [ 'title', 'custom-fields' ],
    ];
    register_post_type( 'tsd_pn_receiver', $args );
}
add_action( 'init', 'tsd_add_push_notification_receiver_post_type' );
