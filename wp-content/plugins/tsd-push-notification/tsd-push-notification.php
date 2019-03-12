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

include_once "inc/helper.php";

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

include_once "inc/send-notification.php";

include_once "inc/rest-api-endpoints.php";
include_once "inc/cpt-push-msg.php";
include_once "inc/cpt-pn-receiver.php";
include_once "inc/ct-receiver-group.php";

include_once "inc/auto-send-subscription.php";

include_once "inc/admin-menu.php";
