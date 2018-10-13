<?php
class YOP_Poll_Admin {
	private $templates;
	private static $date_format, $time_format, $old_version = null;
	public function __construct() {
		self::$date_format = get_option( 'date_format' );
		self::$time_format = get_option( 'time_format' );
		self::$old_version = get_option( 'yop_poll_old_version' );
		if ( true === is_admin() ) {
			add_filter( 'admin_title', array( &$this, 'change_page_title' ) );
			add_action( 'admin_menu', array( &$this, 'build_admin_menu' ) );
			add_action( 'plugins_loaded', array( &$this, 'verify_update' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'load_dependencies' ) );
			add_action( 'upgrader_process_complete', array( &$this, 'upgrade_complete' ) );
			add_action( 'wp_ajax_create_yop_poll', array( &$this, 'create_poll' ) );
			add_action( 'wp_ajax_update_yop_poll', array( &$this, 'update_poll' ) );
			add_action( 'wp_ajax_delete_single_yop_poll', array( &$this, 'delete_single_poll' ) );
			add_action( 'wp_ajax_delete_bulk_yop_poll', array( &$this, 'delete_bulk_poll' ) );
			add_action( 'wp_ajax_clone_single_yop_poll', array( &$this, 'clone_single_poll' ) );
			add_action( 'wp_ajax_clone_bulk_yop_poll', array( &$this, 'clone_bulk_poll' ) );
			add_action( 'wp_ajax_reset_bulk_yop_poll', array( &$this, 'reset_bulk_poll' ) );
			add_action( 'wp_ajax_create_yop_poll_ban', array( &$this, 'create_ban' ) );
			add_action( 'wp_ajax_delete_yop_poll_ban', array( &$this, 'delete_single_ban' ) );
			add_action( 'wp_ajax_update_yop_poll_ban', array( &$this, 'update_ban' ) );
			add_action( 'wp_ajax_delete_bulk_yop_poll_ban', array( &$this, 'delete_bulk_ban' ) );
            add_action( 'wp_ajax_delete_yop_poll_log', array( &$this, 'delete_single_log' ) );
            add_action( 'wp_ajax_get_yop_poll_log_details', array( &$this, 'get_log_details' ) );
            add_action( 'wp_ajax_delete_bulk_yop_poll_log', array( &$this, 'delete_bulk_log' ) );
			add_action( 'wp_ajax_yop_poll_is_user_logged_in', array( &$this, 'is_user_logged_in' ) );
			add_action( 'wp_ajax_nopriv_yop_poll_is_user_logged_in', array( &$this, 'is_user_logged_in' ) );
			add_action( 'wp_ajax_yop_poll_record_vote', array( &$this, 'record_vote' ) );
			add_action( 'wp_ajax_nopriv_yop_poll_record_vote', array( &$this, 'record_vote' ) );
			add_action( 'wp_ajax_yop_poll_record_wordpress_vote', array( &$this, 'record_wordpress_vote' ) );
            add_action( 'wp_ajax_get_yop_poll_votes_customs', array( &$this, 'get_yop_poll_votes_customs' ) );
            add_action( 'wp_ajax_yop-poll-get-vote-details', array( &$this, 'get_vote_details' ) );
			add_action( 'wp_ajax_nopriv_yop_poll_record_wordpress_vote', array( &$this, 'record_wordpress_vote' ) );
            add_action( 'wp_ajax_yop_poll_save_settings', array( &$this, 'save_settings' ) );
			if ( self::$old_version ) {
				if ( false !== strpos( self::$old_version, '4.' ) ) {
					add_action( 'wp_ajax_yop_ajax_migrate', array( 'ClassYopPollImporter4x', 'yop_ajax_import' ) );
				} elseif ( false !== strpos( self::$old_version, '5.' ) ) {
					add_action( 'wp_ajax_yop_ajax_migrate', array( 'ClassYopPollImporter5x', 'yop_ajax_import' ) );
				}
			}
		}
		Yop_Poll_DbSchema::initialize_tables_names();
	}
	public function verify_update() {
		$installed_version = get_option( 'yop_poll_version' );
		if ( $installed_version ) {
			if ( true === version_compare( $installed_version, '6.0.0', '<' ) ) {
				$maintenance = new YOP_POLL_Maintenance();
				$maintenance->activate();
			}
			if ( true === version_compare( $installed_version, '6.0.0', '==' ) ) {
				update_option( 'yop_poll_version', '6.0.1' );
			}
		}
	}
	public function upgrade_complete() {
	}
	public function is_user_logged_in() {
		if ( true === is_user_logged_in() ) {
			wp_send_json_success();
		} else {
			wp_send_json_error();
		}
		die();
	}
	public function build_admin_menu() {
		if( function_exists( 'add_menu_page' ) ) {
			$page = add_menu_page(
				__( 'Yop Poll', 'yop-poll' ),
				__( 'Yop Poll', 'yop-poll' ),
				'yop_poll_results_own',
				'yop-polls',
				array(
					$this,
					'manage_polls'
				),
				YOP_POLL_URL . "admin/assets/images/yop-poll-admin-menu-icon16.png",
				'26.6'
			);
			if ( function_exists( 'add_submenu_page' ) ) {
				$subpage = add_submenu_page(
					'yop-polls',
					__( 'All Polls', 'yop-poll' ),
					__( 'All Polls', 'yop-poll' ),
					'yop_poll_results_own',
					'yop-polls',
					array(
						$this,
						'manage_polls'
					)
				);
                if ( $subpage ) {
                    $votesObj = YOP_Poll_Votes::get_instance();
                    add_action( 'load-' . $subpage, array( $votesObj, 'send_votes_to_download' ) );
                }
				$subpage = add_submenu_page(
					'yop-polls',
					__( 'Add New', 'yop-poll' ),
					__( 'Add New', 'yop-poll' ),
					'yop_poll_add',
					'yop-poll-add-poll',
					array(
						$this,
						'add_new_poll'
					)
				);
				$subpage = add_submenu_page(
					'yop-polls',
					__( 'Bans', 'yop-poll' ),
					__( 'Bans', 'yop-poll' ),
					'yop_poll_results_own',
					'yop-poll-bans',
					array(
						$this,
						'manage_bans'
					)
				);
				$subpage_logs = add_submenu_page(
					'yop-polls',
					__( 'Logs', 'yop-poll' ),
					__( 'Logs', 'yop-poll' ),
					'yop_poll_results_own',
					'yop-poll-logs',
					array(
						$this,
						'manage_logs'
					)
				);
                if ( $subpage_logs ) {
                    $logsObj = YOP_Poll_Logs::get_instance();
                    add_action( 'load-' . $subpage_logs, array( $logsObj, 'send_logs_to_download' ) );
                }
                $subpage = add_submenu_page(
                    'yop-polls',
                    __( 'Settings', 'yop-poll' ),
                    __( 'Settings', 'yop-poll' ),
                    'yop_poll_results_own',
                    'yop-poll-settings',
                    array(
                        $this,
                        'manage_settings'
                    )
                );
				if ( self::$old_version ) {
					$subpage = add_submenu_page(
						'yop-polls',
						__( 'Migrate old records', 'yop-poll' ),
						__( 'Migrate old records', 'yop-poll' ),
						'yop_poll_results_own',
						'yop-poll-migrate',
						array(
							$this,
							'migrate_old_tables'
						)
					);
				}
                $proObj  = YopPollUpgrade::get_instance();
                $subpage_upgrade = add_submenu_page(
                    'yop-polls',
                    __( "Upgrade to Pro", 'yop-poll' ),
                    __( "Upgrade to Pro", 'yop-poll' ),
                    'yop_poll_results_own',
                    'yop-poll-upgrade-pro', array(
                    &$proObj,
                    "manage_upgrade_pages"
                ) );
			}
		}
	}
	public function load_dependencies() {
		$this->load_styles();
		$this->load_scripts();
	}
	public function load_scripts() {
		//include jquery by default
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'tiny_mce' );
		wp_enqueue_script( 'jquery-ui-core', array( 'jquery' ) );
		wp_enqueue_script( 'jquery-ui-datepicker', array( 'jquery' ) );
		wp_enqueue_script( 'jquery-ui-sortable', array( 'jquery-ui-core' ) );
		wp_enqueue_script( 'jquery-ui-draggable', array( 'jquery-ui-core' ) );
		wp_enqueue_script( 'jquery-ui-droppable', array( 'jquery-ui-core' ) );
		wp_enqueue_script( 'yop', YOP_POLL_URL . 'admin/assets/js/admin.min.js', array( 'jquery',
			'jquery-ui-sortable',
			'jquery-ui-dialog',
			'jquery-ui-datepicker' )
		);
		wp_localize_script( 'yop', 'objectL10n', array(
			'yopPollParams' => array(
				'appUrl' => YOP_POLL_URL,
				'dateFormat' => self::$date_format,
				'timeFormat' => self::$time_format,
				'timeNow' => time(),
				'votingEnded' => esc_html__( 'This poll is no longer accepting votes', 'yop-poll' ),
				'votingNotStarted' => esc_html__( 'This poll is not accepting votes yet', 'yop-poll' ),
				'newCustomFieldText' => esc_html__( 'New Custom Field', 'yop-poll' ),
				'deleteTitle'  => esc_html__( 'Warning', 'yop-poll' ),
				'deletePollMessage' => esc_html__( 'Are you sure you want to delete this poll?', 'yop-poll' ),
				'deleteBulkPollsSingleMessage' => esc_html__( 'Are you sure you want to delete this poll?', 'yop-poll' ),
				'deleteBulkPollsMultiMessage' => esc_html__( 'Are you sure you want to delete these polls?', 'yop-poll' ),
				'clonePollMessage' => esc_html__( 'Are you sure you want to clone this poll?', 'yop-poll' ),
				'cloneBulkPollsSingleMessage' => esc_html__( 'Are you sure you want to clone this poll?', 'yop-poll' ),
				'cloneBulkPollsMultiMessage' => esc_html__( 'Are you sure you want to clone these polls?', 'yop-poll' ),
				'resetPollMessage' => esc_html__( 'Are you sure you want to reset votes for this poll?', 'yop-poll' ),
				'resetBulkPollsSingleMessage' => esc_html__( 'Are you sure you want to reset votes for this poll?', 'yop-poll' ),
				'resetBulkPollsMultiMessage' => esc_html__( 'Are you sure you want to reset votes for these polls?', 'yop-poll' ),
				'noBulkActionSelected' => esc_html__( 'No bulk action selected', 'yop-poll' ),
				'noPollsSelectedForBulk' => esc_html__( 'No polls selected', 'yop-poll' ),
				'noBansSelectedForBulk' => esc_html__( 'No bans selected', 'yop-poll' ),
                'noLogsSelectedForBulk' => esc_html__( 'No logs selected', 'yop-poll' ),
				'deleteBulkBansSingleMessage' => esc_html__( 'Are you sure you want to delete this ban?', 'yop-poll' ),
				'deleteBulkBansMultiMessage' => esc_html__( 'Are you sure you want to delete these bans?', 'yop-poll' ),
                'deleteBulkLogsSingleMessage' => esc_html__( 'Are you sure you want to delete this log?', 'yop-poll' ),
                'deleteBulkLogsMultiMessage' => esc_html__( 'Are you sure you want to delete these logs?', 'yop-poll' ),
				/* PRO */
				'deleteCustomFieldMessage' => esc_html__( 'Are you sure you want to delete this field?', 'yop-poll' ),
				'deleteQuestionMessage' => esc_html__( 'Are you sure you want to delete this question?', 'yop-poll' ),
				'deleteSpaceSeparatorMessage' => esc_html__( 'Are you sure you want to delete this space separator?', 'yop-poll' ),
				'deleteTextBlockMessage' => esc_html__( 'Are you sure you want to delete this text block?', 'yop-poll' ),
				/* END PRO */
				'deleteAnswerMessage' => esc_html__( 'Are you sure you want to delete this answer?', 'yop-poll' ),
				'deleteAnswerNotAllowedMessage' => esc_html__( 'Answer can\'t be deleted. At least one answer is required!', 'yop-poll' ),
				'deleteCustomFieldMessage' => esc_html__( 'Are you sure you want to delete this custom field?', 'yop-poll' ),
				'deleteCancelLabel' => esc_html__( 'Cancel', 'yop-poll' ),
				'deleteOkLabel' => esc_html__( 'Ok', 'yop-poll' ),
				'noTemplateSelectedLabel' => esc_html__( 'Before generating the preview a template is required', 'yop-poll' ),
				'noNumberOfColumnsDefined' => esc_html__( 'Number of columns is missing', 'yop-poll' ),
				'numberOfColumnsTooBig' => esc_html__( 'Too many columns. Max 12 allowed', 'yop-poll' ),
				'selectHelperText' => esc_html__( 'Click to select', 'yop-poll' ),
				'publishDateImmediately' => esc_html__( 'Publish immediately', 'yop-poll' ),
				'publishDateSchedule' => esc_html__( 'Schedule for', 'yop-poll' ),
				'copyToClipboardSuccess' => esc_html__( 'Code Copied To Clipboard', 'yop-poll' ),
				'copyToClipboardError' => array(
					'press' => esc_html__( 'Press', 'yop-poll' ),
					'copy' => esc_html__( ' to copy', 'yop-poll' ),
					'noSupport' => esc_html__( 'No Support', 'yop-poll' )
				),
				'captchaParams' => array(
					'imgPath' => YOP_POLL_URL . 'public/assets/img/',
					'url' => YOP_POLL_URL . 'app.php',
					'accessibilityAlt' => esc_html__( 'Sound icon', 'yop-poll' ),
					'accessibilityTitle' => esc_html__( 'Accessibility option: listen to a question and answer it!', 'yop-poll' ),
					'accessibilityDescription' => __( 'Type below the <strong>answer</strong> to what you hear. Numbers or words:', 'yop-poll' ),
					'explanation' => __( "Click or touch the <strong>ANSWER</strong>", 'yop-poll' ),
					'refreshAlt' => esc_html__( 'Refresh/reload icon', 'yop-poll' ),
					'refreshTitle' => esc_html__( 'Refresh/reload: get new images and accessibility option!', 'yop-poll' )
				),
				'previewParams' => array(
					'pollPreviewTitle' => esc_html__( 'Poll Preview', 'yop-poll' ),
					'choosePreviewText' => esc_html__( 'Show preview for', 'yop-poll' ),
					'votingText' => esc_html__( 'Voting', 'yop-poll' ),
					'resultsText' => esc_html__( 'Results', 'yop-poll' ),
					'numberOfVotesSingular' => esc_html__( 'vote', 'yop-poll' ),
					'numberOfVotesPlural' => esc_html__( 'votes', 'yop-poll' ),
					'numberOfAnswerSingular' => esc_html__( 'answer', 'yop-poll' ),
					'numberOfAnswersPlural' => esc_html__( 'answers', 'yop-poll' ),
					'annonymousVoteText' => esc_html__( 'Anonymous Vote', 'yop-poll' ),
					'wordpressVoteText' => esc_html__( 'Sign in with Wordpress', 'yop-poll' ),
					'facebookVoteText' => esc_html__( 'Sign in with Facebook', 'yop-poll' ),
					'googleVoteText' => esc_html__( 'Sign in with Google', 'yop-poll' )
				),
				'saveParams' => array(
					'noTemplateSelected' => esc_html__( 'Template is missing', 'yop-poll' ),
					'generalErrorMessage' => esc_html__( ' is missing', 'yop-poll' ),
					'noPollName' => esc_html__( 'Poll name is missing', 'yop-poll' ),
					'noQuestion' => esc_html__( 'Question Text is missing', 'yop-poll' ),
					'noAnswerText' => esc_html__( 'Answer Text is missing', 'yop-poll' ),
					'noAnswerLink' => esc_html__( 'Answer Link is missing', 'yop-poll' ),
					'noAnswerEmbed' => esc_html__( 'Answer Embed is missing', 'yop-poll' ),
					'noOtherLabel' => esc_html__( 'Label for Other is missing', 'yop-poll' ),
					'noMinAnswers' => esc_html__( 'Minimum answers is missing', 'yop-poll' ),
					'noMaxAnswers' => esc_html__( 'Maximum answers is missing', 'yop-poll' ),
					'noCustomFieldName' => esc_html__( 'Custom Field Name is missing', 'yop-poll' ),
					'noStartDate' => esc_html__( 'Poll Start Date is missing', 'yop-poll' ),
					'noEndDate' => esc_html__( 'Poll End Date is missing', 'yop-poll' ),
					'noCustomDate' => esc_html__( 'Custom Date for displaying results is missing', 'yop-poll' ),
					'noShowResultsMoment' => esc_html__( 'Show Results Time is missing', 'yop-poll' ),
					'noShowResultsTo' => esc_html__( 'Show Results To is missing', 'yop-poll' ),
					'noVoteAsWordpress' => esc_html__( 'Vote As Wordpress User is missing', 'yop-poll' )
				),
				'saveBanParams' => array(
					'noBanFor' => esc_html__( 'Ban For is missing', 'yop-poll' ),
					'noBanValue' => esc_html__( 'Ban Value is missing', 'yop-poll' )
				),
				'deleteBanMessage' => esc_html__( 'Are you sure you want to delete this ban?', 'yop-poll' ),
                'deleteLogMessage' => esc_html__( 'Are you sure you want to delete this log?', 'yop-poll' ),
                'viewLogDetailsQuestionText' => esc_html__( 'Question', 'yop-poll' ),
                'viewLogDetailsAnswerText' => esc_html__( 'Answer', 'yop-poll' ),
                'showLogDetailsLinkText' => esc_html__( 'Answer', 'yop-poll' ),
                'showLogDetailsLinkText' => esc_html__( 'View Details', 'yop-poll' ),
                'hideLogDetailsLinkText' => esc_html__( 'Hide Details', 'yop-poll' ),
				'numberOfVotesText'      => esc_html__( 'Number of Votes', 'yop-poll' ),
				'resultsParams'=> array(
					'singleVote' => esc_html__( 'vote', 'yop-poll' ),
					'multipleVotes' => esc_html__( 'votes', 'yop-poll' )
				),
				'importOld' => array(
					'gdprEnabledContinue' => esc_html__( 'Got It. Continue with the migration', 'yop-poll' ),
					'gdprEnabledStop' => esc_html__( 'Hold On. I want to change settings', 'yop-poll' ),
					'gdprEnabledGeneral' => esc_html__( 'Please review your settings before continue', 'yop-poll' ),
					'gdprEnabledChoice' => esc_html__( 'Your selection', 'yop-poll' ),
					'gdprEnabledMigrateAsIs' => esc_html__( 'This setting will migrate all data from previous version without any anonymization', 'yop-poll' ),
					'gdprEnabledAnonymizeIp' => esc_html__( 'This setting will migrate all data from previous version but ips will be anonymized', 'yop-poll' ),
					'gdprEnabledNoStore' => esc_html__( 'This setting will migrate everything except ip addresses. ', 'yop-poll' ),
					'response' => esc_html__( 'Response:', 'yop-poll' ),
					'allDone' => esc_html__( 'All done.', 'yop-poll' ),
					'importStarted' => esc_html__( 'Migration started', 'yop-poll' ),
				)
			)
		) );
	}
	public function load_styles() {
		wp_enqueue_style( 'yop-admin', YOP_POLL_URL . 'admin/assets/css/admin.css' );
		wp_enqueue_style( 'yop-public', YOP_POLL_URL . 'public/assets/css/yop-poll-public.css' );
	}
	public function change_page_title( $title ) {
		$_page = isset( $_GET['page'] ) ? $_GET['page'] : '';
		$_action = isset( $_GET['action'] ) ? $_GET['action'] : '';
		switch ( $_page ) {
			case 'yop-polls':{
				switch ( $_action ) {
					case 'edit': {
						$title = __( 'Edit Poll', 'yop-poll' );
						break;
					}
					case 'view-results': {
						$title = __( 'View Poll Results', 'yop-poll' );
						break;
					}
					default: {
						$title = __( 'All Polls', 'yop-poll' );
						break;
					}
				}
				break;
			}
			case 'yop-poll-logs': {
				switch ( $_action ) {
					default: {
						$title = __( 'View Logs', 'yop-poll' );
						break;
					}
				}
				break;
			}
			case 'yop-poll-bans': {
				switch ( $_action ) {
					case 'add': {
						$title = __( 'Add Ban', 'yop-poll' );
						break;
					}
					case 'edit': {
						$title = __( 'Edit Ban', 'yop-poll' );
						break;
					}
					default: {
						$title = __( 'All Bans', 'yop-poll' );
						break;
					}
				}
				break;
			}
		}
		return $title;
	}
	public function manage_polls() {
		$_action = isset( $_GET['action'] ) ? $_GET['action'] : '';
		switch ( $_action) {
			case 'edit': {
				$this->show_edit_poll( $_GET['poll_id'] );
				break;
			}
			case 'delete': {
				$this->delete_poll( $_GET['poll_id'] );
				break;
			}
			case 'view-results': {
				$this->display_results( $_GET['poll_id'] );
				break;
			}
            case 'results': {
                $this->build_results( $_GET['poll_id'] );
                break;
            }
            case 'view-votes': {
                $this->display_votes( $_GET['poll_id'] );
                break;
            }
			default: {
				$this->show_polls();
				break;
			}
		}
	}
	public function show_polls() {
		if ( current_user_can( 'yop_poll_results_own' ) ) {
			$params['q'] = isset( $_GET['q']) ? $_GET['q'] : '';
			$params['order_by'] = isset( $_GET['order_by'] ) ? $_GET['order_by'] : '';
			$params['sort_order'] = isset( $_GET['sort_order'] ) ? $_GET['sort_order'] : 'desc';
			$params['page_no'] = isset( $_GET['page_no'] ) ? $_GET['page_no'] : '1';
			$polls = YOP_Poll_Polls::get_polls( $params );
			$template = YOP_POLL_PATH . 'admin/views/viewpolls.php';
			echo YOP_Poll_View::render(
				$template,
				array(
					'polls' => $polls['polls'],
					'statistics' => $polls['statistics'],
					'params' => $params,
					'total_polls' => $polls['total_polls'],
					'total_pages' => $polls['total_pages'],
					'pagination' => $polls['pagination'],
					'date_format' => self::$date_format,
					'time_format' => self::$time_format
				)
			);
		}
		return true;
	}
	public function add_new_poll() {
		if ( current_user_can( 'yop_poll_add' ) ) {
			$template = YOP_POLL_PATH . 'admin/views/addnewpoll.php';
			$templates = YOP_Poll_Templates::get_templates();
			$email_settings = YOP_Poll_Settings::get_email_settings();
			echo YOP_Poll_View::render( $template, array(
				'templates' => $templates,
				'email_settings' => $email_settings,
				'date_format' => self::$date_format
			) );
		}
	}
	public function show_edit_poll( $poll_id ) {
		if ( 0 < intval( $poll_id ) ) {
			$current_user = wp_get_current_user();
			$poll_owner = YOP_Poll_Polls::get_owner( $poll_id );
			if (
				( ( $poll_owner === $current_user->ID ) && ( current_user_can( 'yop_poll_edit_own' ) ) ) ||
				( ( $poll_owner !== $current_user->ID ) && ( current_user_can( 'yop_poll_edit_others' ) ) )
			) {
				$poll = YOP_Poll_Polls::get_poll( $poll_id );
				if ( false !== $poll ) {
					$template = YOP_POLL_PATH . 'admin/views/editpoll.php';
					$templates = YOP_Poll_Templates::get_templates();
					echo YOP_Poll_View::render( $template, array(
						'poll' => $poll,
						'templates' => $templates,
						'date_format' => self::$date_format ) );
				} else {
					echo __( 'You don\'t have sufficient permissions to access this page', 'yop-poll');
				}
			}
		}
	}
	public function create_poll() {
		if ( current_user_can( 'yop_poll_add' ) && check_ajax_referer( 'yop-poll-add-poll', '_token', false ) ) {
			$result = YOP_Poll_Polls::add( json_decode( wp_unslash( $_POST['poll'] ) ) );
			if ( true === $result['success'] ) {
				wp_send_json_success( __( 'Poll successfully added', 'yop-poll' ) );
			} else {
				wp_send_json_error( $result['error'] );
			}
		} else {
			wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
		}
	}
	public function update_poll() {
		$current_user = wp_get_current_user();
		$poll = json_decode( wp_unslash( $_POST['poll'] ) );
		$poll_owner = YOP_Poll_Polls::get_owner( $poll->id );
		if ( check_ajax_referer( 'yop-poll-edit-poll', '_token', false ) ) {
			if (
				( ( $poll_owner === $current_user->ID ) && ( current_user_can( 'yop_poll_edit_own' ) ) ) ||
				( ( $poll_owner !== $current_user->ID ) && ( current_user_can( 'yop_poll_edit_others' ) ) )
			) {
				$result = YOP_Poll_Polls::update( $poll );
				if ( true === $result['success'] ) {
					wp_send_json_success( __( 'Poll successfully updated', 'yop-poll' ) );
				} else {
					wp_send_json_error( $result['error'] );
				}
			} else {
				wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
			}
		} else {
			wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
		}
	}
	public function delete_single_poll() {
		if ( check_ajax_referer( 'yop-poll-view-polls', '_token', false ) || check_ajax_referer( 'yop-poll-edit-poll', '_token', false ) ) {
			if ( isset( $_POST['poll_id'] ) && ( 0 < intval( $_POST['poll_id'] ) ) ) {
				$current_user = wp_get_current_user();
				$poll_owner = YOP_Poll_Polls::get_owner( $_POST['poll_id'] );
				if (
					( ( $poll_owner === $current_user->ID ) && ( current_user_can( 'yop_poll_delete_own' ) ) ) ||
					( ( $poll_owner !== $current_user->ID ) && ( current_user_can( 'yop_poll_delete_others' ) ) )
				) {
					$result = YOP_Poll_Polls::delete( $_POST['poll_id'] );
					if ( true === $result['success'] ) {
						YOP_Poll_Bans::delete_all_for_poll( $_POST['poll_id'] );
						wp_send_json_success( __( 'Poll successfully deleted', 'yop-poll' ) );
					} else {
						wp_send_json_error( $result['error'] );
					}
				} else {
					wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
				}
			} else {
				wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
			}
		} else {
			wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
		}
	}
	public function delete_bulk_poll() {
		if ( check_ajax_referer( 'yop-poll-bulk-polls', '_token', false ) ) {
			$current_user = wp_get_current_user();
			$polls = json_decode( wp_unslash( $_POST['polls'] ) );
			$success = 0;
			foreach ( $polls as $poll ) {
				$poll_owner = YOP_Poll_Polls::get_owner( $poll );
				if (
					( ( $poll_owner === $current_user->ID ) && ( current_user_can( 'yop_poll_delete_own' ) ) ) ||
					( ( $poll_owner !== $current_user->ID ) && ( current_user_can( 'yop_poll_delete_others' ) ) )
				) {
					$result = YOP_Poll_Polls::delete( $poll );
					if ( true === $result['success'] ) {
						$success++;
					} else {
						$success--;
					}
				} else {
					$success--;
				}
			}
			if ( $success === intval( count( $polls ) ) ) {
				wp_send_json_success( _n(
					'Poll successfully deleted',
					'Polls successfully deleted',
					count( $polls ),
					'yop-poll' )
				);
			} else {
				wp_send_json_error( _(
					'Error deleting poll',
					'Error deleting polls',
					count( $polls ),
					'yop-poll' )
				);
			}
		} else {
			wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
		}
	}
	public function clone_single_poll() {
		if ( check_ajax_referer( 'yop-poll-view-polls', '_token', false ) ) {
			if ( isset( $_POST['poll_id'] ) && ( 0 < intval( $_POST['poll_id'] ) ) ) {
				if ( current_user_can( 'yop_poll_add' ) ) {
					$result = YOP_Poll_Polls::clone_poll( $_POST['poll_id'] );
					if ( true === $result['success'] ) {
						wp_send_json_success( __( 'Poll successfully cloned', 'yop-poll' ) );
					} else {
						wp_send_json_error( $result['error'] );
					}
				} else {
					wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
				}
			} else {
				wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
			}
		} else {
			wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
		}
	}
	public function clone_bulk_poll() {
		if ( check_ajax_referer( 'yop-poll-bulk-polls', '_token', false ) ) {
			$polls = json_decode( wp_unslash( $_POST['polls'] ) );
			$success = 0;
			foreach ( $polls as $poll ) {
				if ( current_user_can( 'yop_poll_add' ) ) {
					$result = YOP_Poll_Polls::clone_poll( $poll );
					if ( true === $result['success'] ) {
						$success++;
					} else {
						$success--;
					}
				} else {
					$success--;
				}
			}
			if ( $success === intval( count( $polls ) ) ) {
				wp_send_json_success( _n(
					'Poll successfully cloned',
					'Polls successfully cloned',
					count( $polls ),
					'yop-poll' )
				);
			} else {
				wp_send_json_error( _(
					'Error cloning poll',
					'Error cloning polls',
					count( $polls ),
					'yop-poll' )
				);
			}
		} else {
			wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
		}
	}
	public function reset_bulk_poll() {
		if ( check_ajax_referer( 'yop-poll-bulk-polls', '_token', false ) ) {
			$polls = json_decode( wp_unslash( $_POST['polls'] ) );
			$success = 0;
			foreach ( $polls as $poll ) {
				if ( current_user_can( 'yop_poll_add' ) ) {
					$result = YOP_Poll_Polls::reset_poll( $poll );
					if ( true === $result['success'] ) {
						$success++;
					} else {
						$success--;
					}
				} else {
					$success--;
				}
			}
			if ( $success === intval( count( $polls ) ) ) {
				wp_send_json_success( __( 'Votes successfully reset', 'yop-poll' ) );
			} else {
				wp_send_json_error( __( 'Error resetting votes', 'yop-poll' ) );
			}
		} else {
			wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
		}
	}
	public function display_results( $poll_id ) {
		if ( current_user_can( 'yop_poll_results_own' ) ) {
			$template = YOP_POLL_PATH . 'admin/views/viewresults.php';
			$poll = YOP_Poll_Polls::get_poll( $poll_id );
			echo YOP_Poll_View::render(
				$template,
				array(
					'poll' => $poll
				)
			);
		}
	}
	public function build_results( $poll_id ) {
        if ( current_user_can( 'yop_poll_results_own' ) ) {
            $params['q'] = isset( $_GET['q']) ? $_GET['q'] : '';
            $params['order_by'] = isset( $_GET['order_by'] ) ? $_GET['order_by'] : '';
            $params['sort_order'] = isset( $_GET['sort_order'] ) ? $_GET['sort_order'] : 'asc';
            $params['page_no'] = isset( $_GET['page_no'] ) ? $_GET['page_no'] : '1';
            $template = YOP_POLL_PATH . 'admin/views/results.php';
            $poll = YOP_Poll_Polls::get_poll( $poll_id );
            if ( $poll ) {
                $voters = YOP_Poll_Votes::get_poll_voters_sorted( $poll_id );
                $limit = 10;
                $page = 1;
                $offset = 0;
                $cf_string = '';
                $cf_hidden = '';
                $cf_total_pages = 0;
                $customs_count = 0;
                $total_votes_per_question = [];
                $total_voters_per_question = [];
                $votes_count = $GLOBALS['wpdb']->get_var( $GLOBALS['wpdb']->prepare( "SELECT COUNT(*) FROM `{$GLOBALS['wpdb']->yop_poll_votes}` WHERE `poll_id` = %d AND `status` = 'active'", array( $poll_id ) ) );
                $total_pages = ceil( $votes_count/$limit );
                $query  = "SELECT * FROM `{$GLOBALS['wpdb']->yop_poll_votes}` WHERE `poll_id` = %d AND `status` = 'active' limit $offset, $limit";
                $votes = $GLOBALS['wpdb']->get_results( $GLOBALS['wpdb']->prepare( $query, array( $poll_id ) ) );

                $all_votes_query = "SELECT * FROM `{$GLOBALS['wpdb']->yop_poll_votes}` WHERE `poll_id` = %d AND `status` = 'active'";
                $all_votes = $GLOBALS['wpdb']->get_results( $GLOBALS['wpdb']->prepare( $all_votes_query, array( $poll_id ) ) );

                $other_answers = [];
                foreach ( $all_votes as $av ) {
                    $vote_data = unserialize( $av->vote_data );
					$user_type = $av->user_type;
                    foreach ( $vote_data['elements'] as $ave ) {
                        $question_aswers = [];
                        if ( 'question' === $ave['type'] ) {
                            foreach ( $ave['data'] as $answers ) {
                                if ( 0 == $answers['id'] ) {
                                    $question_aswers[] = $answers['data'];
                                }
                            }
                            if( isset( $total_votes_per_question[$ave['id']] ) ) {
                                $total_votes_per_question[$ave['id']]++;
                            } else {
                                $total_votes_per_question[$ave['id']] = 1;
                            }
                            if( isset( $total_voters_per_question[$ave['id']][$user_type] ) ) {
                                $total_voters_per_question[$ave['id']][$user_type]++;
                            } else {
                                $total_voters_per_question[$ave['id']][$user_type] = 1;
                            }
                            $other_answers[] = [ 'question_id' => $ave['id'], 'other_answers' => $question_aswers ];
                        }
                    }
                }
                $other_answers = Helper::group_other_answers( $other_answers );
                if( count( $votes ) > 0 ) {
                    $cf_hidden .= '<input type="hidden" name="cf_total_pages" id="cf-total-pages" value="' . $total_pages . '">';
                    $cf_hidden .= '<input type="hidden" name="cf_page" id="cf-page" value="' . $page . '">';
                    foreach ( $votes as $vote ) {
                        $vote_data = unserialize( $vote->vote_data );
                        $custom_fields = [];
                        foreach ( $vote_data['elements'] as $vde ) {
                            if ( 'custom-field' === $vde['type'] ) {
                                $custom_fields[] = [ 'id' => $vde['id'], 'data' => isset( $vde['data'][0] ) ? $vde['data'][0] : '' ];
                                $customs_count++;
                            }
                        }
                        if ( count( $custom_fields ) > 0 ) {
                            $cf_total_pages = ceil( count( $custom_fields )/$limit );
                            $cf_string .= '<tr>';
                            foreach ( $custom_fields as $cf ) {
                                $cf_string .= '<td>' . $cf['data'] . '</td>';
                            }
                            $cf_string .= '</tr>';
                        } else {
                            $cf_total_pages = 0;
                        }
                    }
                }
                echo YOP_Poll_View::render(
                    $template,
                    array(
                        'params' => $params,
                        'poll' => $poll,
                        'total_votes' => $votes_count,
                        'total_pages' => $total_pages,
                        'voters' => $voters,
                        'cf_string' => $cf_string,
                        'cf_hidden' => $cf_hidden,
                        'cf_total_pages' => $cf_total_pages,
                        'other_answers' => $other_answers,
                        'total_votes_per_question' => $total_votes_per_question,
                        'total_voters_per_question' => $total_voters_per_question
                    )
                );
            } else {
                $error = __( 'Invalid poll', 'yop-poll' );
                $template = YOP_POLL_PATH . 'admin/views/error.php';
                echo YOP_Poll_View::render(
                    $template,
                    array(
                        'error' => $error
                    )
                );
            }
        }
    }
    public function display_votes( $poll_id ) {
        if ( current_user_can( 'yop_poll_results_own' ) ) {
            $params['order_by'] = isset( $_GET['order_by'] ) ? $_GET['order_by'] : '';
            $params['sort_order'] = isset( $_GET['sort_order'] ) ? $_GET['sort_order'] : 'asc';
            $params['page_no'] = isset( $_GET['page_no'] ) ? $_GET['page_no'] : '1';
            $params['page'] = isset( $_GET['page'] ) ? $_GET['page'] : 'yop-poll';
            $params['poll_id'] = isset( $_GET['poll_id'] ) ? $_GET['poll_id'] : '';
            $params['action'] = isset( $_GET['action'] ) ? $_GET['action'] : '';
            $template = YOP_POLL_PATH . 'admin/views/viewpollvotes.php';
            $poll = YOP_Poll_Polls::get_poll( $poll_id );
            if ($poll) {
                $votes = YOP_Poll_Votes::get_votes_to_display( $params );
                echo YOP_Poll_View::render(
                    $template,
                    array(
                        'params' => $params,
                        'poll' => $poll,
                        'total_votes' => $votes['total_votes'],
                        'votes_pages' => $votes['total_pages'],
                        'total_pages' => $votes['total_pages'],
                        'votes' => $votes['votes'],
                        'pagination' => $votes['pagination']
                    )
                );
            } else {
                $error = __( 'Invalid poll', 'yop-poll' );
                $template = YOP_POLL_PATH . 'admin/views/error.php';
                echo YOP_Poll_View::render(
                    $template,
                    array(
                        'error' => $error
                    )
                );
            }
        }
    }
    public function get_yop_poll_votes_customs() {
        if ( check_ajax_referer( 'yop-poll-get-vote-customs', '_token', false ) ) {
            $limit = 10;
            if(isset($_POST['page']) && $_POST['page'] != "") {
                $page = $_POST['page'];
                $offset = $limit * ($page-1);
            } else {
                $page = 1;
                $offset = 0;
            }
            $votes = YOP_Poll_Votes::get_vote_by_poll( $_POST['poll_id'], $limit, $offset );
            $cf_string = '';
            if( count( $votes ) > 0 ) {
                foreach ( $votes as $vote ) {
                    $vote_data = unserialize( $vote->vote_data );
                    $custom_fields = [];
                    foreach ( $vote_data['elements'] as $vde ) {
                        if ( 'custom-field' === $vde['type'] ) {
                            $custom_fields[] = [ 'id' => $vde['id'], 'data' => isset( $vde['data'][0] ) ? $vde['data'][0] : '' ];
                        }
                    }
                    if ( count( $custom_fields ) > 0 ) {
                        $cf_string .= '<tr>';
                        foreach ($custom_fields as $cf ) {
                            $cf_string .= '<td>' . $cf['data'] . '</td>';
                        }
                        $cf_string .= '</tr>';
                    }
                }
                wp_send_json_success( $cf_string );
            } else {
                wp_send_json_success( $cf_string );
            }
        } else {
            wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
        }
    }
	public function manage_support() {
		$template = YOP_POLL_PATH . 'admin/views/support.php';
		echo YOP_Poll_View::render( $template );
	}
	public function migrate_old_tables() {
		$template = YOP_POLL_PATH . 'admin/views/migrate-old-tables.php';
		echo YOP_Poll_View::render( $template );
	}
	public function manage_logs () {
		if ( current_user_can( 'yop_poll_add' ) ) {
			$params['q'] = isset( $_GET['q']) ? $_GET['q'] : '';
			$params['order_by'] = isset( $_GET['order_by'] ) ? $_GET['order_by'] : '';
			$params['sort_order'] = isset( $_GET['sort_order'] ) ? $_GET['sort_order'] : 'asc';
			$params['page_no'] = isset( $_GET['page_no'] ) ? $_GET['page_no'] : '1';
            $logs = YOP_Poll_Logs::get_logs( $params );
            $template = YOP_POLL_PATH . 'admin/views/viewlogs.php';
            echo YOP_Poll_View::render( $template, array(
                'logs' => $logs['logs'],
                'params' => $params,
                'total_logs' => $logs['total_logs'],
                'total_pages' => $logs['total_pages'],
                'pagination' => $logs['pagination'],
                'date_format' => self::$date_format,
                'time_format' => self::$time_format
            ) );
		}
	}
	public function get_log_details() {
        if ( check_ajax_referer( 'yop-poll-view-logs', '_token', false ) ) {
            if ( isset( $_POST['log_id'] ) && ( 0 < intval( $_POST['log_id'] ) ) ) {
                $log_owner = YOP_Poll_Logs::get_owner( $_POST['log_id'] );
				$current_user = wp_get_current_user();
                if ( $log_owner == $current_user->ID ) {
                    $results = YOP_Poll_Logs::get_log_details( $_POST['log_id'] );
                    $details_string = '';
                    foreach ( $results as $res ) {
                        if ( 'custom-field' === $res['question']) {
                            $details_string .= "<div>" . __( 'Custom Field', 'yop-poll' ) . ': ' . $res['caption'];
                            $details_string .= '<div style="padding-left: 10px;">' . __( 'Answer', 'yop-poll' ) . ': ' .
                                $res['answers'][0]['answer_value'] . '</div>';
                        } else {
                            $details_string .= "<div>" . __('Question', 'yop-poll' ). ': ' . $res['question'];
                            foreach ( $res['answers'] as $ra ) {
                                $details_string .= '<div style="padding-left: 10px;">' . __( 'Answer', 'yop-poll' ) . ': ' . $ra['answer_value'] . '</div>';
                            }
                        }
                        $details_string .= '</div>';
                    }
                    wp_send_json_success( [ 'details' => $details_string ] );
                } else {
                    wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
                }
            } else {
                wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
            }
        } else {
            wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
        }
    }
	public function manage_bans() {
		$_action = isset( $_GET['action'] ) ? $_GET['action'] : '';
		switch ( $_action) {
			case 'add': {
				$this->show_add_ban();
				break;
			}
			case 'edit': {
				$this->show_edit_ban( $_GET['ban_id'] );
				break;
			}
			default: {
				$this->show_bans();
				break;
			}
		}
	}
	public function show_bans() {
		if ( current_user_can( 'yop_poll_add' ) ) {
			$params['q'] = isset( $_GET['q']) ? $_GET['q'] : '';
			$params['order_by'] = isset( $_GET['order_by'] ) ? $_GET['order_by'] : '';
			$params['sort_order'] = isset( $_GET['sort_order'] ) ? $_GET['sort_order'] : 'asc';
			$params['page_no'] = isset( $_GET['page_no'] ) ? $_GET['page_no'] : '1';
			$template = YOP_POLL_PATH . 'admin/views/viewbanns.php';
			$bans = YOP_Poll_Bans::get_bans( $params );
			echo YOP_Poll_View::render( $template, array(
				'bans' => $bans['bans'],
				'params' => $params,
				'total_bans' => $bans['total_bans'],
				'total_pages' => $bans['total_pages'],
				'pagination' => $bans['pagination'],
				'date_format' => self::$date_format,
				'time_format' => self::$time_format
			) );
		}
	}
	public function show_add_ban() {
		if ( current_user_can( 'yop_poll_add' ) ) {
			$polls = YOP_Poll_Polls::get_names();
			$template = YOP_POLL_PATH . 'admin/views/addban.php';
			echo YOP_Poll_View::render( $template, array(
				'polls' => $polls
			) );
		}
	}
	public function create_ban() {
		if ( current_user_can( 'yop_poll_add' ) && check_ajax_referer( 'yop-poll-add-ban', '_token', false ) ) {
			$result = YOP_Poll_Bans::add( json_decode( wp_unslash( $_POST['ban'] ) ) );
			if ( true === $result['success'] ) {
				wp_send_json_success( __( 'Ban successfully added', 'yop-poll' ) );
			} else {
				wp_send_json_error( $result['error'] );
			}
		} else {
			wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
		}
	}
	public function show_edit_ban( $ban_id ) {
		if ( 0 < intval( $ban_id ) ) {
			$current_user = wp_get_current_user();
			$ban_owner = YOP_Poll_Bans::get_owner( $ban_id );
			if (
				( ( $ban_owner === $current_user->ID ) && ( current_user_can( 'yop_poll_edit_own' ) ) ) ||
				( ( $ban_owner !== $current_user->ID ) && ( current_user_can( 'yop_poll_edit_others' ) ) )
			) {
				$ban = YOP_Poll_Bans::get_ban( $ban_id );
				if ( false !== $ban ) {
					$polls = YOP_Poll_Polls::get_names();
					$template = YOP_POLL_PATH . 'admin/views/editban.php';
					echo YOP_Poll_View::render( $template, array(
						'ban' => $ban['ban'],
						'polls' => $polls
					));
				} else {
					echo __( 'You don\'t have sufficient permissions to access this page', 'yop-poll' );
				}
			}
		}
	}
	public function delete_single_ban() {
		if ( check_ajax_referer( 'yop-poll-view-bans', '_token', false ) ) {
			if ( isset( $_POST['ban_id'] ) && ( 0 < intval( $_POST['ban_id'] ) ) ) {
				$current_user = wp_get_current_user();
				$ban_owner = YOP_Poll_Bans::get_owner( $_POST['ban_id'] );
				if (
					( ( $ban_owner === $current_user->ID ) && ( current_user_can( 'yop_poll_delete_own' ) ) ) ||
					( ( $ban_owner !== $current_user->ID ) && ( current_user_can( 'yop_poll_delete_others' ) ) )
				) {
					$result = YOP_Poll_Bans::delete( $_POST['ban_id'] );
					if ( true === $result['success'] ) {
						wp_send_json_success( __( 'Ban successfully deleted', 'yop-poll' ) );
					} else {
						wp_send_json_error( $result['error'] );
					}
				} else {
					wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
				}
			} else {
				wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
			}
		} else {
			wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
		}
	}
	public function update_ban() {
		$ban = json_decode( wp_unslash( $_POST['ban'] ) );
		$ban_owner = YOP_Poll_Bans::get_owner( $ban->ban->id );
		$current_user = wp_get_current_user();
		if ( check_ajax_referer( 'yop-poll-edit-ban', '_token', false ) ) {
			if (
				( ( $ban_owner === $current_user->ID ) && ( current_user_can( 'yop_poll_edit_own' ) ) ) ||
				( ( $ban_owner !== $current_user->ID ) && ( current_user_can( 'yop_poll_edit_others' ) ) )
			) {
				$result = YOP_Poll_Bans::update( $ban );
				if ( true === $result['success'] ) {
					wp_send_json_success( __( 'Ban successfully updated', 'yop-poll' ) );
				} else {
					wp_send_json_error( $result['error'] );
				}
			} else {
				wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
			}
		} else {
			wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
		}
	}
	public function delete_bulk_ban() {
		if ( check_ajax_referer( 'yop-poll-bulk-bans', '_token', false ) ) {
			$bans = json_decode( wp_unslash( $_POST['bans'] ) );
			$success = 0;
			$current_user = wp_get_current_user();
			foreach ( $bans as $ban ) {
				$ban_owner = YOP_Poll_Bans::get_owner( $ban );
				if (
					( ( $ban_owner === $current_user->ID ) && ( current_user_can( 'yop_poll_delete_own' ) ) ) ||
					( ( $ban_owner !== $current_user->ID ) && ( current_user_can( 'yop_poll_delete_others' ) ) )
				) {
					$result = YOP_Poll_Bans::delete( $ban );
					if ( true === $result['success'] ) {
						$success++;
					} else {
						$success--;
					}
				} else {
					$success--;
				}
			}
			if ( $success === intval( count( $bans ) ) ) {
				wp_send_json_success( _n(
					'Ban successfully deleted',
					'Bans successfully deleted',
					count( $bans ),
					'yop-poll' )
				);
			} else {
				wp_send_json_error( _(
					'Error deleting ban',
					'Error deleting bans',
					count( $bans ),
					'yop-poll' )
				);
			}
		} else {
			wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
		}
	}
	public function record_vote() {
		$vote_data = json_decode( wp_unslash( $_POST['data'] ) );
		if ( isset( $vote_data->pollId ) && ( 0 < intval( $vote_data->pollId ) ) ) {
			if ( check_ajax_referer( 'yop-poll-vote-' . $vote_data->pollId, '_token', false ) ) {
				$result = YOP_Poll_Votes::add( $vote_data );
				if ( true === $result['success'] ) {
					wp_send_json_success( __( 'Vote Recorded', 'yop-poll' ) );
				} else {
					wp_send_json_error( $result['error'] );
				}
			} else {
				wp_send_json_error( __( 'Invalid data 1', 'yop-poll' ) );
			}
		} else {
			wp_send_json_error( __( 'Invalid data 2', 'yop-poll' ) );
		}
	}
	public function record_wordpress_vote() {
		if ( isset( $_GET['poll_id'] ) && ( 0 < intval( $_GET['poll_id'] ) ) ) {
			$template = YOP_POLL_PATH . 'admin/views/addnewwordpressvote.php';
			echo YOP_Poll_View::render( $template, array(
				'poll_id' => $_GET['poll_id']
			) );
		} else {
			echo 'no go';
		}
		wp_die();
	}
	public function get_vote_details () {
        if ( check_ajax_referer( 'yop-poll-get-vote-details', '_token', false ) ) {
            if ( isset( $_POST['voteid'] ) && ( intval( $_POST['voteid'] ) > 0 ) ) {
                $results = YOP_Poll_Votes::get_vote_details( $_POST['voteid'] );
                $details_string = '';
                foreach ( $results as $res ) {
                    if ( 'custom-field' === $res['question']) {
                        $details_string .= "<div>" . __('Custom Field', 'yop-poll' ) . ': ' . $res['caption'];
                        $details_string .= '<div style="padding-left: 10px;">' . __( 'Answer', 'yop-poll' ) . ': ' .
                            $res['answers'][0]['answer_value'] . '</div>';
                    } else {
                        $details_string .= "<div>" . __('Question', 'yop-poll' ). ': ' . $res['question'];
                        foreach ( $res['answers'] as $ra ) {
                            $details_string .= '<div style="padding-left: 10px;">' . __( 'Answer', 'yop-poll' ) . ': ' . $ra['answer_value'] . '</div>';
                        }
                    }
                    $details_string .= '</div>';
                    }
                    wp_send_json_success( [ 'details' => $details_string ] );
            } else {
                wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
            }
        } else {
            wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
        }
    }
    public function delete_single_log() {
        if ( check_ajax_referer( 'yop-poll-view-logs', '_token', false ) ) {
            if ( isset( $_POST['log_id'] ) && ( 0 < intval( $_POST['log_id'] ) ) ) {
                $log_owner = YOP_Poll_Logs::get_owner( $_POST['log_id'] );
				$current_user = wp_get_current_user();
                if (
                    ( ( $log_owner === $current_user->ID ) && ( current_user_can( 'yop_poll_delete_own' ) ) ) ||
                    ( ( $log_owner !== $current_user->ID ) && ( current_user_can( 'yop_poll_delete_others' ) ) )
                ) {
                    $result = YOP_Poll_Logs::delete( $_POST['log_id'] );
                    if ( true === $result['success'] ) {
                        wp_send_json_success( __( 'Log successfully deleted', 'yop-poll' ) );
                    } else {
                        wp_send_json_error( $result['error'] );
                    }
                } else {
                    wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
                }
            } else {
                wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
            }
        } else {
            wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
        }
    }
    public function delete_bulk_log() {
        if ( check_ajax_referer( 'yop-poll-bulk-logs', '_token', false ) ) {
            $logs = json_decode( wp_unslash( $_POST['logs'] ) );
            $success = 0;
			$current_user = wp_get_current_user();
            foreach ( $logs as $log ) {
                $log_owner = YOP_Poll_Logs::get_owner( $log );
                if (
                    ( ( $log_owner === $current_user->ID ) && ( current_user_can( 'yop_poll_delete_own' ) ) ) ||
                    ( ( $log_owner !== $current_user->ID ) && ( current_user_can( 'yop_poll_delete_others' ) ) )
                ) {
                    $result = YOP_Poll_Logs::delete( $log );
                    if ( true === $result['success'] ) {
                        $success++;
                    } else {
                        $success--;
                    }
                } else {
                    $success--;
                }
            }
            if ( $success === intval( count( $logs ) ) ) {
                wp_send_json_success( _n(
                        'Log successfully deleted',
                        'Logs successfully deleted',
                        count( $logs ),
                        'yop-poll' )
                );
            } else {
                wp_send_json_error( _(
                        'Error deleting log',
                        'Error deleting logs',
                        count( $logs ),
                        'yop-poll' )
                );
            }
        } else {
            wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
        }
    }
    public function manage_settings() {
        if ( current_user_can( 'yop_poll_add' ) ) {
            $template = YOP_POLL_PATH . 'admin/views/viewsettings.php';
            $yop_poll_notification_from_name                = '';
            $yop_poll_notification_from_email               = '';
            $yop_poll_notification_recipients               = '';
            $yop_poll_notification_subject                  = '';
            $yop_poll_notification_body                     = '';
            $yop_poll_media_facebook_integration            = '';
            $yop_poll_media_facebook_integration_app_id     = '';
            $yop_poll_media_google_integration              = '';
            $yop_poll_media_google_integration_app_id       = '';
            $yop_poll_media_google_integration_app_secret   = '';
            $yop_poll_settings = get_option( 'yop_poll_settings' );
            if ( $yop_poll_settings ) {
                $unserialized = unserialize( $yop_poll_settings );
                $yop_poll_notification_from_name = ( isset( $unserialized['email'] ) && isset( $unserialized['email']['from_name'] ) ) ? $unserialized['email']['from_name'] : '';
                $yop_poll_notification_from_email = ( isset( $unserialized['email'] ) && isset( $unserialized['email']['from_email'] ) ) ? $unserialized['email']['from_email'] : '';
                $yop_poll_notification_recipients = ( isset( $unserialized['email'] ) && isset( $unserialized['email']['recipients'] ) ) ? $unserialized['email']['recipients'] : '';
                $yop_poll_notification_subject = ( isset( $unserialized['email'] ) && isset( $unserialized['email']['subject'] ) ) ? $unserialized['email']['subject'] : '';
                $yop_poll_notification_body = ( isset( $unserialized['email'] ) && isset( $unserialized['email']['message'] ) ) ? $unserialized['email']['message'] : '';

                $yop_poll_media_facebook_integration            = ( isset( $unserialized['integrations'] ) && isset( $unserialized['integrations']['facebook'] ) && isset( $unserialized['integrations']['facebook']['integration'] ) ) ? $unserialized['integrations']['facebook']['integration'] : '';
                $yop_poll_media_facebook_integration_app_id     = ( isset( $unserialized['integrations'] ) && isset( $unserialized['integrations']['facebook'] ) && isset( $unserialized['integrations']['facebook']['app_id'] ) ) ? $unserialized['integrations']['facebook']['app_id'] : '';
                $yop_poll_media_google_integration              = ( isset( $unserialized['integrations'] ) && isset( $unserialized['integrations']['google'] ) && isset( $unserialized['integrations']['google']['integration'] ) ) ? $unserialized['integrations']['google']['integration'] : '';
                $yop_poll_media_google_integration_app_id       = ( isset( $unserialized['integrations'] ) && isset( $unserialized['integrations']['google'] ) && isset( $unserialized['integrations']['google']['app_id'] ) ) ? $unserialized['integrations']['google']['app_id'] : '';
                $yop_poll_media_google_integration_app_secret   = ( isset( $unserialized['integrations'] ) && isset( $unserialized['integrations']['google'] ) && isset( $unserialized['integrations']['google']['app_secret'] ) ) ? $unserialized['integrations']['google']['app_secret'] : '';
            }
            $render_array = array(
                'yop_poll_notification_from_name' => $yop_poll_notification_from_name,
                'yop_poll_notification_from_email' => $yop_poll_notification_from_email,
                'yop_poll_notification_recipients' => $yop_poll_notification_recipients,
                'yop_poll_notification_subject' => $yop_poll_notification_subject,
                'yop_poll_notification_body' => $yop_poll_notification_body,
                'yop_poll_media_facebook_integration' => $yop_poll_media_facebook_integration,
                'yop_poll_media_facebook_integration_app_id' => $yop_poll_media_facebook_integration_app_id,
                'yop_poll_media_google_integration' => $yop_poll_media_google_integration,
                'yop_poll_media_google_integration_app_id' => $yop_poll_media_google_integration_app_id,
                'yop_poll_media_google_integration_app_secret' => $yop_poll_media_google_integration_app_secret
            );
            echo YOP_Poll_View::render( $template, $render_array );
        }
    }
    public function save_settings () {
        if ( current_user_can( 'yop_poll_add' ) ) {
            if ( check_ajax_referer( 'yop-poll-update-settings', '_token', false ) ) {
                $from_name = sanitize_text_field( wp_unslash( $_POST['from_name'] ) );
                $from_email = sanitize_text_field( wp_unslash( $_POST['from_email'] ) );
                $recipients = sanitize_text_field( wp_unslash( $_POST['recipients'] ) );
                $subject = sanitize_text_field( wp_unslash( $_POST['subject'] ) );
                $body = sanitize_text_field( wp_unslash( $_POST['body'] ) );
                $facebook_integration = sanitize_text_field( wp_unslash( $_POST['facebook_integration'] ) );
                $facebook_integration_app_id = sanitize_text_field( wp_unslash( $_POST['facebook_integration_app_id'] ) );
                $google_integration = sanitize_text_field( wp_unslash( $_POST['google_integration'] ) );
                $google_integration_app_id = sanitize_text_field( wp_unslash( $_POST['google_integration_app_id'] ) );
                $google_integration_app_secret = sanitize_text_field( wp_unslash( $_POST['google_integration_app_secret'] ) );
                if( !$from_name || !$from_email || !$recipients || !$subject || !$body || !$facebook_integration  || !$google_integration  ) {
                    wp_send_json_error( __( 'All fields are required', 'yop-poll' ) );
                } else {
                    $yop_poll_settings = array(
                        'email'        => array(
                            'from_name'  => $from_name,
                            'from_email' => $from_email,
                            'subject'    => $subject,
                            'recipients' => $recipients,
                            'message'    => $body
                        ),
                        'integrations' => array(
                            'facebook' => array(
                                'integration' => $facebook_integration,
                                'app_id'      => $facebook_integration_app_id,
                            ),
                            'google'   => array(
                                'integration' => $google_integration,
                                'app_id'      => $google_integration_app_id,
                                'app_secret'  => $google_integration_app_secret
                            )
                        )
                    );
                    if( get_option( 'yop_poll_settings' ) ){
                        update_option('yop_poll_settings', serialize( $yop_poll_settings ) );
                    } else {
                        add_option( 'yop_poll_settings', serialize( $yop_poll_settings ) );
                    }
                    wp_send_json_success( [ 'message' => __( 'Settings updated' ) ] );
                }
            } else {
                wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
            }
        } else {
            wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
        }
    }
}
