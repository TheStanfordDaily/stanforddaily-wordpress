<?php
// https://wordpress.stackexchange.com/a/88335/75147
function tsd_pn_post_transition_post_status( $new_status, $old_status, $post ) {
	if ( get_post_type( $post ) != 'post' ) {
		return;
	}

	if ( $new_status == 'publish' && $old_status != 'publish' ) {
		// The post is published
		// See note below (for `save_post` action) as for why we need to do this.
		update_post_meta( $post->ID, '_tsd_pn_sent', 'ready' );
	}
}
add_action( 'transition_post_status', 'tsd_pn_post_transition_post_status', 10, 3 );

function tsd_pn_post_save_post( $post_id, $post ) {
	$tsd_pn_sent_post_meta = get_post_meta( $post_id, '_tsd_pn_sent', 'sent' );
	if ( $tsd_pn_sent_post_meta && $tsd_pn_sent_post_meta == "ready" ) {
		// See note below (for `save_post` action) as for why we need to do this.
		update_post_meta( $post_id, '_tsd_pn_sent', 'sent' );

		$post_authors = [ (int) $post->post_author ];
		if ( function_exists( "get_coauthors" ) ) {
			$post_authors = [];
			foreach ( get_coauthors( $post_id ) as $each_author ) {
				$post_authors[] = (int) $each_author->ID;
			}
		}

		$notification_body = trim( strip_tags( get_extended( $post->post_content )[ "main" ] ) );

		set_transient( "tsd_pn_debug_info", [ date('m/d/Y h:i:s a', time()), get_coauthors( $post_id ) ] );

		$notification_data = [
			"post_id" => $post_id,
		];

		$send_results = tsd_send_expo_push_notification(
			[1144875, 1144876],	// TODO: actually get receivers
			$post->post_title,
			$notification_body,
			$notification_data
		);
	}
}
/**
 * We use `20` for priority because Co-Authors Plus add authors data at priority `10`.
 * We also cannot just use `publish_post` because Co-Authors Plus add authors data in `save_post` which is called after `publish_post`.
 * Ref: https://github.com/Automattic/Co-Authors-Plus/search?q=save_post
 *
 * Also, `save_post` cannot distingish between save and publish, so we have to add a post_meta to store if the notification is sent.
 * When the author click "Publish", `_tsd_pn_sent` first becomes "ready" (by `tsd_pn_post_transition_post_status`), then becomes "sent" (by `tsd_pn_post_save_post`).
 */
add_action( 'save_post', 'tsd_pn_post_save_post', 20, 2 );
