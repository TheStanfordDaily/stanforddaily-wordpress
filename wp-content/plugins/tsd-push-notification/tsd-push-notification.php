<?php
/**
* Plugin Name: The Stanford Daily - Push Notification
* Description: Add push notification supports.
* Author: The Stanford Daily Tech Team
* Version: 1.0
* History:
* 1.0 (2019-02-18) - Created. (Yifei He)
*/

// https://codex.wordpress.org/Creating_Tables_with_Plugins
global $wpdb, $tsd_pn_db_version, $tsd_pn_db_table_name;
$tsd_pn_db_version = '1.0';
$tsd_pn_db_table_name = $wpdb->prefix . 'tsd_pn';

function tsd_pn_install() {
    global $wpdb;
    global $tsd_pn_db_version;
    global $tsd_pn_db_table_name;

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $tsd_pn_db_table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        receiver_id bigint(20) unsigned NOT NULL,
        item_type varchar(20) NOT NULL,
        item_id bigint(20) unsigned NOT NULL,
        PRIMARY KEY (id),
        UNIQUE (receiver_id, item_type, item_id),
        INDEX (receiver_id, item_type),
        INDEX (item_type, item_id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option( 'tsd_pn_db_version', $tsd_pn_db_version );
}

function tsd_pn_install_data() {
    global $wpdb;
    global $tsd_pn_db_table_name;

    // Do nothing
}

register_activation_hook( __FILE__, 'tsd_pn_install' );
register_activation_hook( __FILE__, 'tsd_pn_install_data' );


function tsd_pn_get_subscription_types() {
    return [ "list", "category_ids", "author_ids", "location_ids" ];
}

function tsd_pn_get_sub_list_id_from_name( $name ) {
    switch ( $name ) {
        case "breaking":
            return 1;
        case "daily":
            return 2;
        case "weekly":
            return 3;
        default:
            return -1;
    }
}


function tsd_pn_sub_add( $receiver_id, $item_type, $item_id ) {
    global $wpdb, $tsd_pn_db_table_name;

    $wpdb->insert(
        $tsd_pn_db_table_name,
        [
            'receiver_id' => $receiver_id,
            'item_type' => $item_type,
            'item_id' => $item_id,
        ]
    );
}

function tsd_pn_sub_delete( $receiver_id, $item_type, $item_id ) {
    global $wpdb, $tsd_pn_db_table_name;

    $wpdb->delete(
        $tsd_pn_db_table_name,
        [
            'receiver_id' => $receiver_id,
            'item_type' => $item_type,
            'item_id' => $item_id,
        ]
    );
}

function tsd_pn_sub_clear_receiver( $receiver_id ) {
    global $wpdb, $tsd_pn_db_table_name;

    $wpdb->delete(
        $tsd_pn_db_table_name,
        [
            'receiver_id' => $receiver_id,
        ]
    );
}

function tsd_pn_sub_get_receivers_for_item( $item_type, $item_id ) {
    global $wpdb, $tsd_pn_db_table_name;

    return $wpdb->get_col( $wpdb->prepare( "
        SELECT receiver_id
        FROM $tsd_pn_db_table_name
        WHERE item_type = %s
            AND item_id = %d
    " , $item_type, $item_id ) );
}

function tsd_pn_sub_get_items_for_receiver( $receiver_id, $item_type ) {
    global $wpdb, $tsd_pn_db_table_name;

    return $wpdb->get_col( $wpdb->prepare( "
        SELECT item_id
        FROM $tsd_pn_db_table_name
        WHERE receiver_id = %d
            AND item_type = %s
    " , $receiver_id, $item_type ) );
}

function tsd_pn_sub_update_subscription( $receiver_id, $item_type, $new_sub ) {
    $original_sub = tsd_pn_sub_get_items_for_receiver( $receiver_id, $item_type );

    $removed_items = array_values( array_diff( $original_sub, $new_sub ) );
    $added_items = array_values( array_diff( $new_sub, $original_sub ) );

    foreach ( $removed_items as $removed_item ) {
        tsd_pn_sub_delete( $receiver_id, $item_type, $removed_item );
    }

    foreach ( $added_items as $added_item ) {
        tsd_pn_sub_add( $receiver_id, $item_type, $added_item );
    }
}

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
function tsd_push_notification_post_type_on_publish( $post_id, $post ) {
    // https://stackoverflow.com/a/139553/2603230
    //$log_content = "<pre>".var_export( $post, true )."</pre>";
    //var_dump($log_content);

    $receiver_groups = get_the_terms( $post->ID, 'tsd_push_msg_receiver_group' );
    $receiver_cpt_ids = [];
    foreach ( $receiver_groups as $each_receiver_group ) {
        $each_receiver_group_id = tsd_pn_get_sub_list_id_from_name( $each_receiver_group->slug );
        $receiver_cpt_ids = array_merge( $receiver_cpt_ids, tsd_pn_sub_get_receivers_for_item( "list", $each_receiver_group_id ) );
    }
    $receiver_cpt_ids = array_unique( $receiver_cpt_ids );

    // TODO: only send notification to certain groups
    $user_lists = get_posts( [
        'post_type' => 'tsd_pn_receiver',
        'include' => $receiver_cpt_ids,
    ] );

    $custom_fields = get_post_custom( $post_id );
    // https://stackoverflow.com/a/4979308/2603230
    $tsd_pn_custom_fields = [];
    foreach ( $custom_fields as $key => $value ) {
        if ( strpos( $key, 'tsd_pn_' ) === 0 ) {
            // Remove `tsd_pn_` from key.
            $tsd_pn_custom_fields[ substr( $key, 7 ) ] = $value[ 0 ];
        }
    }
    $message_body = [
        "title" => $post->post_title,
        "body" => $post->post_excerpt,
    ];
    if ( ! empty( $tsd_pn_custom_fields ) ) {
        $message_body[ "data" ] = $tsd_pn_custom_fields;
    }

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
        tsd_send_pn_failed( $post_id, $error_message, $message_body );
        return;
    }

    $decoded_body = json_decode( $response[ "body" ], true );
    if ( $response[ "response" ][ "code" ] != 200 ) {
        tsd_send_pn_failed( $post_id, $decoded_body, $message_body );
        return;
    }

    set_transient( get_current_user_id().'tsd_send_pn_success', "Response: \n" . json_encode( $decoded_body ) . "\nYour message: \n" . json_encode( $message_body ) );

    //wp_die( "Notification sent!<br />".$log_content, "Notification sent!", [ "response" => 200, "back_link" => true ] );
}
add_action( 'publish_tsd_push_msg', 'tsd_push_notification_post_type_on_publish', 10, 2 );

function tsd_send_pn_failed( $post_id, $response_message, $sent_message ) {
    set_transient( get_current_user_id().'tsd_send_pn_fail', "Response: \n" . json_encode( $response_message ) . "\nYour message: \n" . json_encode( $sent_message ) );
    wp_update_post( [
        'ID' => $post_id,
        'post_status' => 'draft',
    ] );
}

// https://stackoverflow.com/a/19822056/2603230
function tsd_push_notification_add_admin_notice() {
    if ( $out = get_transient( get_current_user_id() . 'tsd_send_pn_success' ) ) {
        delete_transient( get_current_user_id() . 'tsd_send_pn_success' );
        ?>
        <div class="notice notice-success is-dismissible">
            <pre style="white-space: pre-wrap;">Notification sent!<?php echo "\n".$out; ?></pre>
        </div>
        <?php
    }

    if ( $out = get_transient( get_current_user_id() . 'tsd_send_pn_fail' ) ) {
        delete_transient( get_current_user_id() . 'tsd_send_pn_fail' );
        ?>
        <style>#message { display: none; }</style><!-- Hide the "Post published." message -->
        <div class="notice notice-error is-dismissible">
            <pre style="white-space: pre-wrap;">Error! Message:<?php echo "\n".$out; ?></pre>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'tsd_push_notification_add_admin_notice' );

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

// https://wordpress.stackexchange.com/a/91052/75147
function tsd_push_notification_receiver_post_type_trash_post( $post_id ) {
    $post_type = get_post_type( $post_id );
    $post_status = get_post_status( $post_id );

    if ( $post_type == 'tsd_pn_receiver' && in_array( $post_status, [ 'publish', 'draft', 'future' ] ) ) {
        tsd_pn_sub_clear_receiver( $post_id );
    }
}
add_action( 'wp_trash_post', 'tsd_push_notification_receiver_post_type_trash_post' );
