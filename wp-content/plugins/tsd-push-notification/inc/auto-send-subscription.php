<?php
// https://wordpress.stackexchange.com/a/88335/75147
function tsd_pn_post_transition_post_status( $new_status, $old_status, $post ) {
	if ( get_post_type( $post ) != 'post' ) {
		return;
	}

	if ( $new_status == 'publish' && $old_status == 'new' ) {
		// the post is inserted
	} else if ( $new_status == 'publish' && $old_status != 'publish' ) {
		// the post is published
		tsd_pn_post_send_new_notification( $post );
	} else {
		// the post is updated
	}
}
add_action( 'transition_post_status', 'tsd_pn_post_transition_post_status', 10, 3 );

function tsd_pn_post_send_new_notification( $post ) {
	$notification_body = trim( strip_tags( get_extended( $post->post_content )[ "main" ] ) );

	$notification_data = [
		"post_id" => $post->ID,
	];

	$send_results = tsd_send_expo_push_notification(
		[1144875, 1144876],	// TODO: actually get receivers
		$post->post_title,
		$notification_body,
		$notification_data
	);
}
