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


		$notification_receiver_ids = [];

		// Authors
		$post_authors = [ (int) $post->post_author ];
		if ( function_exists( "get_coauthors" ) ) {
			$post_authors = [];
			foreach ( get_coauthors( $post_id ) as $each_author ) {
				$post_authors[] = (int) $each_author->ID;
			}
		}
		foreach ( $post_authors as $each_author ) {
			$notification_receiver_ids = array_merge( $notification_receiver_ids, tsd_pn_sub_get_receivers_for_item( 'author_ids', $each_author ) );
		}

		// Categories
		$post_categories = get_the_category( $post_id );
		foreach ( $post_categories as $each_category ) {
			$each_category_id = $each_category->term_id;
			$notification_receiver_ids = array_merge( $notification_receiver_ids, tsd_pn_sub_get_receivers_for_item( 'category_ids', $each_category_id ) );
		}


		$notification_receiver_ids = array_unique( $notification_receiver_ids );
		$notification_title = $post->post_title;
		$notification_body = trim( strip_tags( get_extended( $post->post_content )[ "main" ] ) );
		$notification_data = [
			"post_id" => $post_id,
		];

		$send_results = tsd_send_expo_push_notification(
			$notification_receiver_ids,
			$notification_title,
			$notification_body,
			$notification_data
		);

		// DEBUG
		set_transient( "tsd_pn_debug_info", [ date('m/d/Y h:i:s a', time()), $post_authors, $post_categories, $notification_receiver_ids ] );
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
