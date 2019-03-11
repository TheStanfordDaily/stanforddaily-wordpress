<?php
function tsd_pn_get_subscription_types() {
	return [ "list", "category_ids", "author_ids", "location_ids" ];
}

function tsd_pn_get_sub_list_id_from_name( $name ) {
	$term_id = get_term_by( 'slug', $name, 'tsd_push_msg_receiver_group' )->term_id;
	return (int) $term_id;	// See "Warning: string vs integer confusion!" on https://codex.wordpress.org/Function_Reference/get_term_by
}


function tsd_pn_set_admin_notice( $status, $content ) {
	set_transient( get_current_user_id() . 'tsd_send_pn_' . $status, $content );
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
