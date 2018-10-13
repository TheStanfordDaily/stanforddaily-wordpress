<?php
class YOP_POLL_Maintenance {
	private $dbschema, $capabilities, $import_errors, $importer = null;
	public function __construct() {
		$this->dbschema     = new Yop_Poll_DbSchema;
		$this->capabilities = new YOP_POLL_Capabilities;
		$this->import_errors = false;
	}
	public function activate() {
		#TODO - multisite install
		$installed_version = get_option( 'yop_poll_version' );
		if ( false !== $installed_version ) {
			if ( true === version_compare( $installed_version, '6.0.0', '<' ) ) {
				update_option( 'yop_poll_old_version', $installed_version );
				if ( false !== strpos( $installed_version, '4.' ) ) {
					$this->importer = new ClassYopPollImporter4x( 1000, 100 );
				} elseif ( false !== strpos( $installed_version, '5.' ) ) {
					$this->importer = new ClassYopPollImporter5x( 1000, 100 );
				}
			} else {
				if ( true === version_compare( $installed_version, '6.0.0', '==' ) ) {
					update_option( 'yop_poll_version', YOP_POLL_VERSION );
				}
			}
		}
		$this->dbschema->create_tables();
		$this->capabilities->install();
		//$this->create_archive_page();
		if ( $this->importer ) {
			$this->importer->initialise();
		}
		$this->create_options();
		if ( ! wp_next_scheduled ( 'yop_poll_hourly_event', array() ) ) {
			wp_schedule_event( time(), 'hourly', 'yop_poll_hourly_event', array() );
		}
	}
	public function create_archive_page() {
		$poll_archive_page = get_page_by_path( 'yop-poll-archive', ARRAY_A );
		if ( ! $poll_archive_page ) {
			$_p                   = array();
			$_p['post_title']     = 'Yop Poll Archive';
			$_p['post_content']   = "[yop_poll_archive]";
			$_p['post_status']    = 'publish';
			$_p['post_type']      = 'page';
			$_p['comment_status'] = 'open';
			$_p['ping_status']    = 'open';
			$_p['post_category']  = array( 1 );
			$poll_archive_page_id = wp_insert_post( $_p );
		} else {
			$poll_archive_page_id = $poll_archive_page['ID'];
		}
	}
	public function create_options() {
		update_option( 'yop_poll_version', YOP_POLL_VERSION );
		$old_poll_settings = get_option( 'yop_poll_options' );
		if( $old_poll_settings ) {
            update_option( 'yop_poll_settings', $this->import_yop_poll_settings( $old_poll_settings ) );
        } else {
            update_option( 'yop_poll_settings', $this->create_yop_poll_settings() );
        }
	}
	public function delete_options() {
		delete_option( 'yop_poll_version' );
		delete_option( 'yop_poll_old_version' );
		delete_option( 'yop_poll_settings' );
		delete_option( 'external_updates-yop-poll' );
	}
	public function deactivate() {
		wp_clear_scheduled_hook( 'yop_poll_hourly_event' );
	}
	public function uninstall() {
		$this->dbschema->delete_tables();
		$this->capabilities->uninstall();
		$this->delete_options();
	}
	public function create_yop_poll_settings() {
		$yop_poll_settings = array(
			'general' => array(
				'idate' => current_time( 'mysql' )
			),
			'email'        => array(
				'from_name'  => 'Your Name Here',
				'from_email' => 'Your Email Address Here',
				'subject'    => 'Your Subject Here',
                'recipients' => '',
				'message'    => 'Your Message Here'
			),
			'integrations' => array(
				'facebook' => array(
				    'integration' => 'no',
					'app_id'      => '',
				),
				'google'   => array(
				    'integration' => 'no',
					'app_id'      => '',
					'app_secret'  => ''
				)
			)
		);
		return serialize( $yop_poll_settings );
	}
    public function import_yop_poll_settings( $old_settings ) {
        $yop_poll_settings = array(
			'general' => array(
				'idate' => current_time( 'mysql' )
			),
            'email'        => array(
                'from_name'  => isset( $old_settings['email_notifications_from_name'] ) ? $old_settings['email_notifications_from_name']: 'Your Name Here',
                'from_email' => isset( $old_settings['email_notifications_from_email'] ) ? $old_settings['email_notifications_from_email']: 'Your Email Address Here',
                'recipients' => isset( $old_settings['email_notifications_recipients'] ) ? $old_settings['email_notifications_recipients']: '',
                'subject'    => isset( $old_settings['email_notifications_subject'] ) ? $old_settings['email_notifications_subject']: 'Your Subject Here',
                'message'    => isset( $old_settings['email_notifications_body'] ) ? $old_settings['email_notifications_body'] : 'Your Message Here'
            ),
            'integrations' => array(
                'facebook' => array(
                    'integration'  => isset( $old_settings['facebook_integration'] ) ? $old_settings['facebook_integration'] : 'no',
                    'app_id'     => isset( $old_settings['facebook_appID'] ) ? $old_settings['facebook_appID'] : '',
                ),
                'google'   => array(
                    'integration' => isset( $old_settings['google_integration'] ) ? $old_settings['google_integration'] : 'no',
                    'app_id'      => isset( $old_settings['google_appID'] ) ? $old_settings['google_appID']: '',
                    'app_secret'  => isset( $old_settings['google_appSecret'] ) ? $old_settings['google_appSecret']: ''
                )
            )
        );
        return serialize( $yop_poll_settings );
    }
	public function add_activation_message() {
		add_option( 'yop_poll_ajax_importer', 'yop_poll_ajax_importer' );
		$url = admin_url( 'admin.php?page=yop-poll-import' );
		$html = '<div class="updated">';
		$html .= '<p>';
		$html .= __( 'Click <a href="' . $url . '" target="_blank">here</a> to start the import.', 'yop-poll' );
		$html .= '</p>';
		$html .= '</div><!-- /.updated -->';
		echo $html;
	}
}
