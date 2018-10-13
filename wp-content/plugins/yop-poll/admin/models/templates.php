<?php
class YOP_Poll_Templates {
	public static function get_templates() {
		$templates = $GLOBALS['wpdb']->get_results( "SELECT * FROM {$GLOBALS['wpdb']->yop_poll_templates}", OBJECT );
		return $templates;
	}
	public static function get_template( $template_id ) {
		$sql_query = $GLOBALS['wpdb']->prepare( "SELECT * FROM {$GLOBALS['wpdb']->yop_poll_templates} WHERE `id`=%s", $template_id );
		return $GLOBALS['wpdb']->get_row( $sql_query, OBJECT );
	}
	public static function template_already_exists( $base, $available_templates ) {
		$template_exists = false;
		foreach ( $available_templates as $available_template ) {
			if ( $available_template->base === $base  ) {
				$template_exists = true;
			}
		}
		return $template_exists;
	}
}
