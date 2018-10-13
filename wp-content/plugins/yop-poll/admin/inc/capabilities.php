<?php
class YOP_POLL_Capabilities {
	private $capabilities = array(
		'administrator' => array(
			'yop_poll_add' => true,
			'yop_poll_edit_own' => true,
			'yop_poll_edit_others' => true,
			'yop_poll_delete_own' => true,
			'yop_poll_delete_others' => true,
			'yop_poll_results_own' => true,
			'yop_poll_results_others' => true
		),
		'editor' => array(
			'yop_poll_add' => true,
			'yop_poll_edit_own' => true,
			'yop_poll_edit_others' => true,
			'yop_poll_delete_own' => true,
			'yop_poll_delete_others' => true,
			'yop_poll_results_own' => true,
			'yop_poll_results_others' => true
		),
		'author' => array(
			'yop_poll_add' => true,
			'yop_poll_edit_own' => true,
			'yop_poll_edit_others' => true,
			'yop_poll_delete_own' => true,
			'yop_poll_delete_others' => true,
			'yop_poll_results_own' => true,
			'yop_poll_results_others' => true
		),
		'contributor' => array(
			'yop_poll_add' => false,
			'yop_poll_edit_own' => false,
			'yop_poll_edit_others' => false,
			'yop_poll_delete_own' => false,
			'yop_poll_delete_others' => false,
			'yop_poll_results_own' => false,
			'yop_poll_results_others' => false
		),
		'subscriber' => array(
			'yop_poll_add' => false,
			'yop_poll_edit_own' => false,
			'yop_poll_edit_others' => false,
			'yop_poll_delete_own' => false,
			'yop_poll_delete_others' => false,
			'yop_poll_results_own' => false,
			'yop_poll_results_others' => false
		),
		'guest' => array(
			'yop_poll_add' => false,
			'yop_poll_edit_own' => false,
			'yop_poll_edit_others' => false,
			'yop_poll_delete_own' => false,
			'yop_poll_delete_others' => false,
			'yop_poll_results_own' => false,
			'yop_poll_results_others' => false
		)
    );
	public function role_exists( $role ) {
		if ( ! empty( $role ) ) {
			return wp_roles()->is_role( $role );
		}
		return false;
	}
	public function install() {
		foreach ( $this->capabilities as $role => $capabilities ) {
			if ( $this->role_exists( $role ) ) {
				$role_obj = get_role( $role );
				foreach ( $capabilities as $capability => $value ) {
					if ( $value ) {
						$role_obj->add_cap( $capability );
					}
				}
			}
		}
	}
	public function uninstall() {
		foreach ( $this->capabilities as $role => $capabilities ) {
			if ( $this->role_exists( $role ) ) {
				$role_obj = get_role( $role );
				foreach ( $capabilities as $capability => $value ) {
					if ( $value ) {
						$role_obj->remove_cap( $capability );
					}
				}
			}
		}
	}
}
