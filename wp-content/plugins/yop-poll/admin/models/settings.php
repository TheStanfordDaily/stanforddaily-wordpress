<?php
class YOP_Poll_Settings {
	public static function get_all_settings() {
		$settings = get_option( 'yop_poll_settings' );
		return $settings;
	}
	public static function get_email_settings() {
		$email_settings = array();
		$settings = self::get_all_settings();
		if ( '' !== $settings ) {
			$unserialized_settings = unserialize( $settings );
			$email_settings = array(
				'from_name' => $unserialized_settings['email']['from_name'],
				'from_email' => $unserialized_settings['email']['from_email'],
				'recipients' => $unserialized_settings['email']['recipients'],
				'subject' => $unserialized_settings['email']['subject'],
				'message' => $unserialized_settings['email']['message']
			);
		}
		return $email_settings;
	}
}