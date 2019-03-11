<?php
// Returns whether the push notification process is successfully completed.
// $manual parameter changes the behavior of no receiver;
// I.e. If it's not manual, no error will be produced when there's no receiver.
function tsd_send_expo_push_notification( $receiver_pn_users_ids, $title, $body, $data, $manual = false ) {
	// We have to check this first because `'include' => []` below will return all tsd_pn_receiver.
	if ( empty( $receiver_pn_users_ids ) ) {
		if ( $manual ) {
			tsd_pn_set_admin_notice( 'fail', "No receiver!" );
			return false;
		} else {
			// Do nothing
			return true;
		}
	}
	$receiver_pn_users = get_posts( [
		'post_type' => 'tsd_pn_receiver',
		'include' => $receiver_pn_users_ids,
	] );
	if ( empty( $receiver_pn_users ) ) {
		if ( $manual ) {
			tsd_pn_set_admin_notice( 'fail', "No receiver!\nThis might be a bug. Please note down what you are doing and contact the Tech Team!" );
			return false;
		} else {
			// Do nothing
			return true;
		}
	}

	if ( empty( $title ) ) {
		tsd_pn_set_admin_notice( 'fail', "Missing title!" );
		return false;
	}
	// TODO: Check char. limit for title and body

	$message_body = [
		"title" => $title,
		"body" => $body,
	];
	if ( ! empty( $data ) ) {
		$message_body[ "data" ] = $data;
	}

	$all_messages = [];
	foreach ( $receiver_pn_users as $each_user ) {
		$each_message = $message_body;
		$each_message[ "to" ] = $each_user->post_title;	// post_title is the user token
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
		tsd_pn_set_admin_notice( 'fail', "Response: \n" . json_encode( $error_message ) . "\nYour message: \n" . json_encode( $message_body ) );
		return false;
	}

	$decoded_body = json_decode( $response[ "body" ], true );
	if ( $response[ "response" ][ "code" ] != 200 ) {
		tsd_pn_set_admin_notice( 'fail', "Response: \n" . json_encode( $decoded_body ) . "\nYour message: \n" . json_encode( $message_body ) );
		return false;
	}

	tsd_pn_set_admin_notice( 'success', "Response: \n" . json_encode( $decoded_body ) . "\nYour message: \n" . json_encode( $message_body ) );
	//wp_die( "Notification sent!<br />".$log_content, "Notification sent!", [ "response" => 200, "back_link" => true ] );

	return true;
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
