<?php

class ClassYopPollImporter4x {

	private static $initial_limit           = 500;
	private static $ajax_limit              = 100;
	private static $unprocessed_polls       = 0;
	private static $processed_polls         = 0;
	private static $unprocessed_bans        = 0;
	private static $processed_bans          = 0;
	private static $processed_votes         = 0;
	private static $unprocessed_logs        = 0;
	private static $checked_existence_polls = false;
	private static $checked_existence_bans  = false;
	private static $checked_existence_logs  = false;
	private static $polls_table_exists      = false;
	private static $bans_table_exists       = false;
	private static $logs_table_exists       = false;
	private static $polls_questions         = []; // array of arrays => [$poll_id => $question_id]
	private static $maxElementID            = 0;
	private static $enableGdpr              = 'no';
	private static $gdprSolution            = 'consent';

	public function __construct( $initial_limit, $ajax_limit ) {
		if ( $initial_limit ) {
			self::$initial_limit = $initial_limit;
		}
		if ( $ajax_limit ) {
			self::$ajax_limit    = $ajax_limit;
		}
		add_action( 'wp_ajax_yop_ajax_import', array( &$this, 'yop_ajax_import' ) );
	}

	public function initialise() {
		self::import_polls( self::$initial_limit );
	}

	private static function set_gdpr( $enableGdpr, $gdprSolution ) {
		self::$enableGdpr = $enableGdpr;
		self::$gdprSolution = $gdprSolution;
	}

	private static function make_ip_gdpr_compliant( $ipaddress ) {
		$compliant_ipaddress = '';
		if ( 'yes' === self::$enableGdpr ) {
			switch( self::$gdprSolution ) {
				case 'consent': {
					$compliant_ipaddress = $ipaddress;
					break;
				}
				case 'anonymize': {
					$compliant_ipaddress = Helper::anonymize_ip( $ipaddress );
					break;
				}
				case 'nostore': {
					$compliant_ipaddress = '';
					break;
				}
				default: {
					$compliant_ipaddress = $ipaddress;
					break;
				}
			}
		} else {
			$compliant_ipaddress = $ipaddress;
		}
		return $compliant_ipaddress;
	}

	private static function make_cookie_gdpr_compliant( $cookie ) {
		$compliant_cookie = '';
		if ( 'yes' === self::$enableGdpr ) {
			switch( self::$gdprSolution ) {
				case 'consent': {
					$compliant_cookie = $cookie;
					break;
				}
				case 'anonymize': {
					$compliant_cookie = '';
					break;
				}
				case 'nostore': {
					$compliant_cookie = '';
					break;
				}
				default: {
					$compliant_cookie = $cookie;
					break;
				}
			}
		} else {
			$compliant_cookie = $cookie;
		}
		return $compliant_cookie;
	}

	private static function import_polls( $query_limit, $skip_table_check = false ) {
		global $wpdb;
		$polls_table_name                = $GLOBALS['wpdb']->prefix . 'yop_polls';
		$polls_meta_table_name           = $GLOBALS['wpdb']->prefix . 'yop_pollmeta';
		$polls_answers_table_name        = $GLOBALS['wpdb']->prefix . 'yop_poll_answers';
		$polls_answers_meta_table_name   = $GLOBALS['wpdb']->prefix . 'yop_poll_answermeta';
		$polls_customs_table   = $GLOBALS['wpdb']->prefix . 'yop_poll_custom_fields';
		if ( $skip_table_check ) {
			self::$checked_existence_polls = true;
			self::$polls_table_exists      = true;
		}
		if ( !self::$checked_existence_polls ) {
			if ( self::check_if_table_exists( $polls_table_name ) && self::check_if_table_exists( $polls_meta_table_name ) ) {
				if ( ! self::check_if_column_exists( $polls_table_name, 'processed' ) ) {
					$wpdb->query( "ALTER TABLE `{$polls_table_name}` ADD processed BOOLEAN DEFAULT FALSE " );
				}
				self::$checked_existence_polls = true;
				self::$polls_table_exists      = true;
			}
		}
		if ( self::$checked_existence_polls && self::$polls_table_exists ) {
			self::$unprocessed_polls = $wpdb->get_var("select count(id) from `{$polls_table_name}` where processed = false");
			$polls                   = $wpdb->get_results( "select `id`, `name`, `question`, `poll_author`, `start_date`, `end_date`, `status`, `last_modified`,
  `total_votes`, `total_answers`, `date_added`,  `meta_key`, `meta_value` from `{$polls_table_name}` left join
`{$polls_meta_table_name}` on `{$polls_table_name}`.`id` = `{$polls_meta_table_name}`.`yop_poll_id` where `processed` = false limit {$query_limit}" );

			if ( count( $polls ) > 0 ) {
				$questionId = 1;
				$maxID              = $wpdb->get_var( "select max(`id`) from `{$polls_table_name}`" );
				self::$maxElementID = $maxID + 1;
				foreach ( $polls as $poll ) {
					if ( '' !== $poll->meta_value && null !== $poll->meta_value ) {
						$unserialized_meta = unserialize( $poll->meta_value );
					} else {
						$unserialized_meta = [];
					}

					$poll_style        = self::create_css_from_template( (isset ($unserialized_meta['template']) && '' !== $unserialized_meta['template']) ? $unserialized_meta['template'] : 1 );
					$vote_perms        = [];
					if ( isset( $unserialized_meta['vote_permisions_wordpress'] ) ) {
						$vote_perms[] = 'wordpress';
					}
					if ( isset( $unserialized_meta['vote_permisions_anonymous'] ) ) {
						$vote_perms[] = 'guest';
					}
					if ( 0 == count( $vote_perms ) ) {
						$vote_perms[] = 'wordpress';
					}
					$results_moment = [];
					if ( isset( $unserialized_meta['view_results'] ) ) {
						if ( 'after' === $unserialized_meta['view_results'] ) {
							$results_moment[] = 'after-vote';
						} elseif ( 'before' === $unserialized_meta['view_results'] ) {
							$results_moment[] = 'before-vote';
						} elseif ( 'after-poll-end-date' == $unserialized_meta['view_results'] ) {
							$results_moment[] = 'after-end-date';
						} elseif ( 'custom-date' == $unserialized_meta['view_results'] ) {
							$results_moment[] = 'custom-date';
						} else {
							$results_moment[] = $unserialized_meta['view_results'];
						}
					}
					if ( 0 == count( $results_moment ) ) {
						$results_moment[] = 'after-vote';
					}
					$show_results_to = [];
					if ( isset( $unserialized_meta['view_results_permissions'] ) ) {
						if ( 'registered-only' === $unserialized_meta['view_results_permissions'] ) {
							$show_results_to[] = 'registered';
						} elseif ( 'guest-only' === $unserialized_meta['view_results_permissions'] ) {
							$show_results_to[] = 'guest';
						} elseif ( 'guest-only' === $unserialized_meta['view_results_permissions'] ) {
							$show_results_to[] = 'guest';
							$show_results_to[] = 'registered';
						}
					}
					if ( 0 == count( $show_results_to ) ) {
						$show_results_to[] = 'guest';
						$show_results_to[] = 'registered';
					}
					$sorting_results = 'as-defined';
					if ( isset( $unserialized_meta['sorting_results'] ) ) {
						switch ( $unserialized_meta['sorting_results'] ) {
							case 'exact':
								break;
							case 'alphabetical':
								$sorting_results = 'alphabetical';
								break;
							case 'random':
								break;
							case 'votes':
								$sorting_results = 'number-of-votes';
								break;
						}
					}

					$newBlVoters = [];
					if ( isset( $unserialized_meta['blocking_voters'] ) ) {
						$blocking_voters = 'no-block';
						switch ( $unserialized_meta['blocking_voters'] ) {
							case 'dont-block':
								break;
							case 'cookie':
								$blocking_voters = 'by-cookie';
								break;
							case 'ip':
								$blocking_voters = 'by-ip';
								break;
							case 'username':
								$blocking_voters = 'by-user-id';
								break;
							case 'cookie-ip':
								$blocking_voters = 'ip';
							default:
								break;
						}
						$newBlVoters[] = $blocking_voters;
					}
					$blockForPeriod  = 'hours';
					if ( isset( $unserialized_meta['blocking_voters_interval_unit'] ) ) {
						$blockForPeriod = $unserialized_meta['blocking_voters_interval_unit'];
					}
					$blockForValue = 1;
					if ( isset( $unserialized_meta['blocking_voters_interval_value'] ) ) {
						$blockForValue = $unserialized_meta['blocking_voters_interval_value'];
					}

                    if( isset( $unserialized_meta['view_results_type'] ) ) {
                        switch( $unserialized_meta['view_results_type'] ) {
                            case 'votes-number': {
                                $resultsDetails = ['votes-number'];
                                break;
                            }
                            case 'percentages': {
                                $resultsDetails = ['percentages'];
                                break;
                            }
                            case 'votes-number-and-percentages' : {
                                $resultsDetails = ['votes-number', 'percentages'];
                                break;
                            }
                            default: {
                                $resultsDetails = ['votes-number'];
                                break;
                            }
                        }
                    } else {
                        $resultsDetails = ['percentages'];
                    }
					if ( isset( $unserialized_meta['poll_start_date'] ) && ( '' !== $unserialized_meta['poll_start_date'] ) ) {
							$poll_start_date_option = 'custom';
                            $poll_start_date = $unserialized_meta['poll_start_date'];
                    } else {
						$poll_start_date_option = 'never';
						$poll_start_date = '';
                    }
					if ( isset( $unserialized_meta['poll_end_date'] ) && ( '' !== $unserialized_meta['poll_end_date'] ) ) {
							$poll_end_date_option = 'custom';
                            $poll_end_date = $unserialized_meta['poll_end_date'];
                    } else {
						$poll_end_date_option = 'never';
						$poll_end_date = '';
                    }
					$pollArray         = [
						'ID'                     => $poll->id,
						'name'                   => $poll->name,
						'poll_author'            => $poll->poll_author,
						'status'                 => 'published',
						'stype'                  => 'poll',
						'total_submits'          => $poll->total_votes,
						'total_submited_answers' => $poll->total_votes,
						'design'                 => [
							'template'     => 1,
							'templateBase' => 'basic',
							'style'        => $poll_style
						],
						'options'                => [
							'poll'    => [
								'voteButtonLabel'             => isset( $unserialized_meta['vote_button_label'] ) ? $unserialized_meta['vote_button_label'] : 'Vote',
								'showResultsLink'             => 'no',
								'resultsLabelText'            => 'Results',
								'showTotalVotes'              => isset( $unserialized_meta['view_total_votes'] ) ? $unserialized_meta['view_total_votes'] : 'yes',
								'showTotalAnswers'            => isset( $unserialized_meta['view_total_answers'] ) ? $unserialized_meta['view_total_answers'] : 'yes',
								'startDateOption'             => $poll_start_date_option,
								'startDateCustom'             => $poll_start_date,
								'endDateOption'               => $poll_end_date_option,
								'endDateCustom'               => $poll_end_date,
								'redirectAfterVote'           => isset( $unserialized_meta['redirect_after_vote'] ) ? $unserialized_meta['redirect_after_vote'] : 'no',
								'redirectUrl'                 => isset( $unserialized_meta['redirect_after_vote_url'] ) ? $unserialized_meta['redirect_after_vote_url'] : '',
								'resetPollStatsAutomatically' => isset( $unserialized_meta['schedule_reset_poll_stats'] )? $unserialized_meta['schedule_reset_poll_stats'] : 'no',
								'resetPollStatsOn'            => isset( $unserialized_meta['schedule_reset_poll_date'] ) ? date( 'Y-m-d H:i:s', $unserialized_meta['schedule_reset_poll_date'] ) : '9999-12-31 23:59:59',
								'resetPollStatsEvery'         => isset( $unserialized_meta['schedule_reset_poll_recurring_value'] ) ? $unserialized_meta['schedule_reset_poll_recurring_value'] : 9999,
								'resetPollStatsEveryPeriod'   => isset( $unserialized_meta['schedule_reset_poll_recurring_unit'] ) ? $unserialized_meta['schedule_reset_poll_recurring_unit']. 's' : 'days',
								'autoGeneratePollPage'        => isset ( $unserialized_meta['auto_generate_poll_page'] ) ? $unserialized_meta['auto_generate_poll_page'] : 'no',
								'pageId'                      => '',
								'pageLink'                    => '',
								'useCaptcha'                  => isset( $unserialized_meta['use_captcha'] ) ? $unserialized_meta['use_captcha'] : 'no',
								'sendEmailNotifications'      => isset( $unserialized_meta['send_email_notifications'] ) ? $unserialized_meta['send_email_notifications'] : 'no',
								'emailNotificationsFromName'  =>
									isset( $unserialized_meta['email_notifications_from_name'] ) ? $unserialized_meta['email_notifications_from_name'] : 'Voting Alerts',
								'emailNotificationsFromEmail' =>
									isset( $unserialized_meta['email_notifications_from_email'] ) ? $unserialized_meta['email_notifications_from_email'] : 'noreply@???',
								'emailNotificationsSubject'   =>
									isset( $unserialized_meta['email_notifications_subject'] ) ? $unserialized_meta['email_notifications_subject'] : 'New Vote',
								'emailNotificationsMessage'   =>
									isset( $unserialized_meta['email_notifications_body'] ) ? $unserialized_meta['email_notifications_body'] : 'New Vote',
								'enableGdpr' => 'no',
								'gdprSolution' => 'consent',
								'gdprConsentText' => ''
							],
							'access'  => [
								'votePermissions'     => $vote_perms,
								'blockVoters'         => $newBlVoters,
								'blockForValue'       => $blockForValue,
								'blockForPeriod'      => $blockForPeriod,
								'limitVotesPerUser'   =>
									isset( $unserialized_meta['limit_number_of_votes_per_user'] ) ? $unserialized_meta['limit_number_of_votes_per_user'] : 'no',
								'votesPerUserAllowed' => isset( $unserialized_meta['number_of_votes_per_user'] ) ? $unserialized_meta['number_of_votes_per_user'] : 3
							],
							'results' => [
								'showResultsMoment' => $results_moment,
								'customDateResults' => isset( $unserialized_meta['view_results_start_date'] ) ? $unserialized_meta['view_results_start_date'] : '',
								'showResultsTo'     => $show_results_to,
								'backToVoteOption'  => isset( $unserialized_meta['view_back_to_vote_link'] ) ? $unserialized_meta['view_back_to_vote_link'] : 'no',
								'backToVoteCaption' => isset( $unserialized_meta['view_back_to_vote_link_label'] ) ? $unserialized_meta['view_back_to_vote_link_label'] : 'Back to vote',
								'sortResults'       => $sorting_results,
								'sortResultsRule'   => isset( $unserialized_meta['sorting_results_direction'] ) ? $unserialized_meta['sorting_results_direction'] : 'asc',
								'displayResultsAs'  => isset( $unserialized_meta['show_results_in'] ) ? $unserialized_meta['show_results_in'] : 'bar',
                                'resultsDetails'    => $resultsDetails
							]
						]
					];
					$pollElementsArray = [];
					$pollAnswers       = $wpdb->get_results( "select * from `{$polls_answers_table_name}` left join `{$polls_answers_meta_table_name}` on
			`{$polls_answers_table_name}`.`id` = `{$polls_answers_meta_table_name}`.`yop_poll_answer_id` where `poll_id` = {$poll->id}" );
					$pollCustoms       = $wpdb->get_results( "select * from `{$polls_customs_table}` where `{$polls_customs_table}`.`poll_id` = {$poll->id}" );
					$x                 = 1;
					$pollAnswersArray  = [];
					foreach ( $pollAnswers as $pA ) {
						if ( '' !== $pA->meta_value && !is_null( $pA->meta_value ) ) {
							$unserialized_a_meta = unserialize( $pA->meta_value );
						} else {
							$unserialized_a_meta = [];
						}
						if ( 'other' !== $pA->type ) {
							$pQAA = [
								'ID'             => $pA->id,
								'question_order' => $x,
								'type'           => 'text',
								'is_other'       => 'other' === $pA->type ? true : false,
								'text'           => stripslashes( $pA->answer ),
								'options'        => [
									'makeDefault'  => isset( $unserialized_a_meta['is_default_answer'] ) ? $unserialized_a_meta['is_default_answer'] : 'no',
									'makeLink'     => 'no',
									'link'         => '',
									'resultsColor' => isset ( $unserialized_a_meta['bar_background'] ) ? $unserialized_a_meta['bar_background'] : '#000'
								]
							];
							$pollAnswersArray[] = $pQAA;
							$x ++;
						}
					}
					$answers_display = 'vertical';
					if ( isset( $unserialized_meta['display_answers'] ) ) {
						if ( 'tabulated' === $unserialized_meta['display_answers'] ) {
							$answers_display = 'columns';
						} elseif( 'orizontal' === $unserialized_meta['display_answers'] ) {
							$answers_display = 'horizontal';
						}
						else {
							$answers_display = $unserialized_meta['display_answers'];
						}
					}
					$pollElementsArray[] = [
						'ID'         => $questionId,
						'type'       => 'text-question',
						'text'       => stripslashes( $poll->question ),
						'poll_order' => 1,
						'answers'    => $pollAnswersArray,
						'options'    => [
							'allowOtherAnswers'            => isset( $unserialized_meta['allow_other_answers'] ) ? $unserialized_meta['allow_other_answers'] : 'yes',
							'otherAnswersLabel'            => isset( $unserialized_meta['other_answers_label'] ) ? $unserialized_meta['other_answers_label'] : 'Other',
							'addOtherAnswers'              =>
								isset( $unserialized_meta['add_other_answers_to_default_answers'] ) ? $unserialized_meta['add_other_answers_to_default_answers'] : 'no',
							'displayOtherAnswersInResults' =>
								isset( $unserialized_meta['display_other_answers_values'] ) ? $unserialized_meta['display_other_answers_values'] : 'no',
							'allowMultipleAnswers'         =>
								isset( $unserialized_meta['allow_multiple_answers'] ) ? $unserialized_meta['allow_multiple_answers'] : 'no',
							'multipleAnswersMinim'         =>
								isset( $unserialized_meta['allow_multiple_answers_min_number'] ) ? $unserialized_meta['allow_multiple_answers_min_number'] : 1,
							'multipleAnswersMaxim'         => isset( $unserialized_meta['allow_multiple_answers_number'] ) ? $unserialized_meta['allow_multiple_answers_number'] : 3,
							'answersDisplay'               => $answers_display,
							'answersColumns'               =>
								isset( $unserialized_meta['display_answers_tabulated_cols'] ) ? $unserialized_meta['display_answers_tabulated_cols'] : 2
						]
					];
					foreach ( $pollCustoms as $pC ) {
						$pollElementsArray[] = [
							'ID'             => self::$maxElementID,
							'poll_order' => 1,
							'type'    => 'custom-field',
							'text'    => stripslashes( $pC->custom_field ),
							'options' => [
								'makeRequired' => 'yes' === $pC->required ? 'yes' : 'no',
                                'old_id'       => $pC->id
							]
						];
						self::$maxElementID++;
					}

					$pollArray['elements'] = $pollElementsArray;
					$responseArray         = YOP_Poll_Polls::add( json_decode( json_encode( $pollArray ) ) );
					if ( '' !== $responseArray['poll_id'] ) {
						$result = $wpdb->update( $polls_table_name, array( 'processed' => true ), array( 'id' => $poll->id ) );
						self::$processed_polls += $result;
					}
					$questionId++;
				}
			}
		}
	}

	private static function import_bans( $skip_table_check = false ) {
		global $wpdb;
		$polls_bans_table = $GLOBALS['wpdb']->prefix . 'yop_poll_bans';
		$values           = [];
		$current_user = wp_get_current_user();
		if ( $skip_table_check ) {
			self::$checked_existence_bans = true;
			self::$bans_table_exists      = true;
		}
		if ( !self::$checked_existence_bans ) {
			if ( self::check_if_table_exists( $polls_bans_table ) ) {
				if ( ! self::check_if_column_exists( $polls_bans_table, 'processed' ) ) {
					$wpdb->query( "ALTER TABLE `{$polls_bans_table}` ADD processed BOOLEAN DEFAULT FALSE " );
				}
				self::$checked_existence_bans = true;
				self::$bans_table_exists      = true;
			}
		}

		if ( self::$checked_existence_bans && self::$bans_table_exists ) {
			self::$unprocessed_bans = $wpdb->get_var( "select count(ID) from `{$polls_bans_table}` where `processed` = false" );
			$bans                   = $wpdb->get_results( "select * from `{$polls_bans_table}` LIMIT ". self::$ajax_limit );
			$bansIds                = [];
			if ( count( $bans ) > 0 ) {
				foreach ( $bans as $ban ) {
					$values[]  = $wpdb->prepare( "(%d, %d, %s, %s, %s)", $current_user->ID, $ban->poll_id, $ban->type, $ban->value, current_time( 'mysql' ) );
					$bansIds[] = $ban->id;
				}
				$query = "INSERT INTO `{$GLOBALS['wpdb']->yop_poll_bans}` (`author`, `poll_id`, `b_by`, `b_value`, `added_date`) VALUES ";
				if ( count( $values ) > 0 ) {
					$query  .= implode( ",\n", $values );
					$result  = $wpdb->query( $query );
					if ( ! $result ) {
						$last_error = $wpdb->last_error;
						return [ 'response_code' => 1, 'message' => __( $last_error, 'yop-poll' ) ];
					} else {
						$res = $wpdb->query("update {$polls_bans_table} set `processed` = true where `ID` in (".implode(',', $bansIds).")");
						self::$processed_bans += $res;
						if ( self::$processed_bans == self::$unprocessed_bans ) {
							return [ 'response_code' => - 1, 'message' => __( 'Processed ' . self::$processed_bans . ' out of '. self::$unprocessed_bans. ' records on table bans.', 'yop-poll' ) ];
						} else {
							return [ 'response_code' => 1, 'message' => __( 'Processed '. self::$processed_bans . ' out of '. self::$unprocessed_bans .' remaining records on table bans.', 'yop-poll' ) ];
						}
					}
				}
			} else {
				return [ 'response_code' => - 1, 'message' => __( 'No bans to process.', 'yop-poll' ) ];
			}
		} else {
			return [ 'response_code' => - 1, 'message' => __( 'No bans table, skipping.', 'yop-poll' ) ];
		}
	}

	private static function import_votes( $skip_table_check = false ) {
		global $wpdb;
		$polls_logs_table_name            = $GLOBALS['wpdb']->prefix . 'yop_poll_logs';
		$polls_results_customs_table_name = $GLOBALS['wpdb']->prefix . 'yop_poll_votes_custom_fields';
		$polls_answers_table_name         = $GLOBALS['wpdb']->prefix . 'yop_poll_answers';
		$current_user                     = wp_get_current_user();
		if( $skip_table_check ) {
			self::$checked_existence_logs = true;
			self::$logs_table_exists      = true;
		}
		if ( !self::$checked_existence_logs ) {
			if ( self::check_if_table_exists( $polls_logs_table_name ) ) {
				if ( ! self::check_if_column_exists( $polls_logs_table_name, 'processed' ) ) {
					$wpdb->query( "ALTER TABLE `{$polls_logs_table_name}` ADD processed BOOLEAN DEFAULT FALSE " );
				}
				self::$checked_existence_logs = true;
				self::$logs_table_exists      = true;
			}
		}

		if ( self::$checked_existence_logs && self::$logs_table_exists ) {
			self::$unprocessed_logs = $wpdb->get_var("select count(distinct `vote_id`) from `{$polls_logs_table_name}` where `processed` = false");
			$logs                   = $wpdb->get_results("select distinct `vote_id` from `{$polls_logs_table_name}` where `processed` = false limit " .self::$ajax_limit );
			if ( count($logs) > 0 ) {
				$votesArray = [];
				$logsArray = [];
				$resultsIds = [];
				foreach ( $logs as $log ) {
				    $rquery = "SELECT `{$polls_logs_table_name}`.`id`, `{$polls_logs_table_name}`.`poll_id`, `{$polls_logs_table_name}`.`vote_id`,  `{$polls_logs_table_name}`.`answer_id`, `{$polls_logs_table_name}`.`ip`, `{$polls_logs_table_name}`.`user_id`, `{$polls_logs_table_name}`.`user_type`,`other_answer_value`, `{$polls_logs_table_name}`.`vote_date` FROM  `{$polls_logs_table_name}`  WHERE `{$polls_logs_table_name}`.`vote_id` = %s ";
					$results = $wpdb->get_results( $wpdb->prepare( $rquery, $log->vote_id ) );
					foreach ( $results as $result ) {
                        $customs_query = "select * from `{$polls_results_customs_table_name}` where `vote_id` = %s";
                        $customs = $wpdb->get_results( $wpdb->prepare( $customs_query, array( $result->vote_id ) ) );
                        $countC = count( $customs );
                        $voteData   = ['elements' => [], 'user' => [] ];
                        $logData    = ['elements' => [], 'user' => [] ];
						$resultsIds[]   = $result->id;
						$answerType = $wpdb->get_var( "SELECT `type` FROM `{$polls_answers_table_name}` where `id` = '$result->answer_id'" );
						$a_data         = [];
						if ( 'other' === $answerType ) {
							$a_data[]       = [
								'id'   => 0,
								'data' => $result->other_answer_value
							];
						} else {
							$a_data[]       = [
								'id'   => $result->answer_id,
								'data' => true
							];
						}

                        $wpdb->query( $wpdb->prepare("update `{$GLOBALS['wpdb']->yop_poll_subelements}` set `total_submits` = `total_submits` + 1 where `id` = %d", array( $result->answer_id ) ) );
						#get the question
						$question_id    = $wpdb->get_var( "select `id` from `{$GLOBALS['wpdb']->yop_poll_elements}` where `poll_id` = '{$result->poll_id}' and `etype` = 'text-question' limit 1" );
						$new_customs = $wpdb->get_results( "SELECT * FROM `{$GLOBALS['wpdb']->yop_poll_elements}` WHERE `meta_data` LIKE '%old_id%'" );
                        $voteData['elements'][] = [
							'id'   => $question_id,
							'type' => 'question',
							'data' => $a_data
						];
                        $logData['elements'][] = [
                            'id'   => $question_id,
                            'type' => 'question',
                            'data' => $a_data
                        ];
						if ( $countC > 0 ) {
						    foreach( $customs as $cust ) {
						        $cID = null;
                                foreach( $new_customs as $nc ) {
                                    $udata = unserialize( $nc->meta_data );
                                    if( ( int )$udata['old_id'] == ( int )$cust->custom_field_id ) {
                                        $cID = $nc->id;
                                    }
                                }
                                $voteData['elements'][] = [
                                    'id'   => $cID,
                                    'type' => 'custom-field',
                                    'data' => stripslashes( [$cust->custom_field_value] )
                                ];
                                $logData['elements'][] = [
                                    'id'   => $cID,
                                    'type' => 'custom-field',
                                    'data' => stripslashes( [$cust->custom_field_value] )
                                ];
                            }

						}
						//array_push( $voteData['elements'], $q_data );
						//array_push( $logData['elements'], $q_data );

						$voteData['user'] = [
							'first_name' => '',
							'last_name'  => ''
						];
						$data             = array(
							'poll_id'           => $result->poll_id,
                            'poll_author'       => $current_user->ID,
							'user_id'           => $result->user_id,
							'user_email'        => '',
							'user_type'         => 'default' === $result->user_type ? 'anonymous' : $result->user_type,
							'ipaddress'         => self::make_ip_gdpr_compliant( $result->ip ),
							'tracking_id'       => '',
							'voter_id'          => self::make_cookie_gdpr_compliant( $result->vote_id ),
							'voter_fingerprint' => '',
							'vote_data'         => serialize( $voteData ),
							'status'            => 'active',
							'added_date'        => $result->vote_date
						);
						$votesArray[]       = $wpdb->prepare( "(%d, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                            $data['poll_id'],
                            $data['user_id'],
                            $data['user_email'],
                            $data['user_type'],
                            $data['ipaddress'],
                            $data['tracking_id'],
                            $data['voter_id'],
                            $data['voter_fingerprint'],
							$data['vote_data'],
                            $data['status'],
                            $data['added_date']
                        );

						$logData['user'] = [
							'first_name' => '',
							'last_name'  => ''
						];
						$vote_message    = ['Success'];
						$ldata            = array(
							'poll_id'           => $result->poll_id,
							'poll_author'       => $current_user->ID,
							'user_id'           => $result->user_id,
							'user_email'        => '',
							'user_type'         => 'default' === $result->user_type ? 'anonymous' : $result->user_type,
							'ipaddress'         => self::make_ip_gdpr_compliant( $result->ip ),
							'tracking_id'       => '',
							'voter_id'          => self::make_cookie_gdpr_compliant( $result->vote_id ),
							'voter_fingerprint' => '',
							'vote_data'         => serialize( $logData ),
							'vote_message'      => serialize( $vote_message ),
							'added_date'        => $result->vote_date
						);
						$logsArray[]       = $wpdb->prepare( "(%d, %d, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                            $ldata['poll_id'],
                            $ldata['poll_author'],
                            $ldata['user_id'],
                            $ldata['user_email'],
							$ldata['user_type'],
                            $ldata['ipaddress'],
                            $ldata['tracking_id'],
                            $ldata['voter_id'],
                            $ldata['voter_fingerprint'],
                            $ldata['vote_data'],
                            $ldata['vote_message'],
                            $ldata['added_date']
                        );
					}
				}
				$query         = "INSERT INTO `{$GLOBALS['wpdb']->yop_poll_votes}` (`poll_id`, `user_id`, `user_email`, `user_type`, `ipaddress`, `tracking_id`, `voter_id`, `voter_fingerprint`, `vote_data`, `status`, `added_date`) VALUES ";

				$logs_query    = "INSERT INTO `{$GLOBALS['wpdb']->yop_poll_logs}` (`poll_id`, `poll_author`, `user_id`, `user_email`, `user_type`, `ipaddress`, `tracking_id`, `voter_id`, `voter_fingerprint`, `vote_data`, `vote_message`, `added_date`) VALUES ";
				if ( count( $votesArray ) > 0 ) {
					$query      .= implode( ",\n", $votesArray );
					$logs_query .= implode( ",\n", $logsArray );
					$response    = $wpdb->query( $query );
					$responseLog = $wpdb->query( $logs_query );
					if ( $response && $responseLog ) {
						$result = $wpdb->query( "update `{$polls_logs_table_name}` set `processed` = true where id in (" . implode( ',', $resultsIds ) . ")" );
						self::$processed_votes += $result;
						if ( self::$processed_votes == self::$unprocessed_logs ) {
							return [ 'response_code' => -1, 'message' => __( 'Processed ' . self::$processed_votes . ' out of ' . self::$unprocessed_logs . ' records on table votes.', 'yop-poll' ) ];
						} elseif ( self::$processed_votes > self::$unprocessed_logs ) {
							return [ 'response_code' => -1, 'message' => __( 'Processed ' . self::$unprocessed_logs . ' out of ' . self::$unprocessed_logs . ' records on table votes.', 'yop-poll' ) ];
						} else {
							return [ 'response_code' => 1, 'message' => __( 'Processed ' . self::$processed_votes . ' out of ' . self::$unprocessed_logs . ' remaining records on table votes.', 'yop-poll' ) ];
						}
					} else {
						return [ 'response_code' => 1, 'message' => __( $wpdb->last_error, 'yop-poll' ) ];
					}
				} else {
					return [ 'response_code' => - 1, 'message' => __( 'No votes to process.', 'yop-poll' ) ];
				}

			} else {
				return [ 'response_code' => - 1, 'message' => __( 'No votes to process.', 'yop-poll' ) ];
			}

		} else {
			return [ 'response_code' => - 1, 'message' => __( 'No votes table, skipping.', 'yop-poll' ) ];
		}

	}

	private static function check_if_table_exists( $table_name ) {
		global $wpdb;
		if ( 0 == $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(1) FROM `information_schema`.`tables` WHERE `table_schema` = %s AND `table_name` = %s",
				DB_NAME, $table_name ) ) ) {
			return false;
		}
		return true;
	}

	private static function check_if_column_exists( $table_name, $column_name ) {
		global $wpdb;
		if ( 0 == $wpdb->get_var( $wpdb->prepare(
				"SELECT count(1) FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA` = %s AND `TABLE_NAME` = %s AND `COLUMN_NAME` = %s ",
				DB_NAME, $table_name, $column_name
			) ) ) {
			return false;
		}
		return true;
	}

	private static function create_css_from_template( $template_id ) {
		$css_array = [
			'poll'      => [
				'backgroundColor'          => '#fff',
				'borderSize'               => 0,
				'borderColor'              => '#fff',
				'borderRadius'             => 0,
				'padding'                  => 10,
				'textColor'                => '#555',
				'inputElementsBorderColor' => '#000',
			],
			'questions' => [
				'backgroundColor' => '#fff',
				'borderSize'      => 0,
				'borderColor'     => '#fff',
				'borderRadius'    => 0,
				'padding'         => 4,
				'textColor'       => '#000',
				'textSize'        => 'small'
			],
			'answers'   => [
				'backgroundColor' => '#fff',
				'borderSize'      => 0,
				'borderColor'     => '#fff',
				'borderRadius'    => 0,
				'padding'         => 0,
				'textColor'       => '#000',
				'textSize'        => 'small',
				'skin'            => 'minimal',
				'colorScheme'     => 'black'
			],
			'buttons'   => [
				'backgroundColor' => '#222',
				'borderSize'      => 0,
				'borderColor'     => '#222',
				'borderRadius'    => 2,
				'padding'         => 0,
				'textColor'       => '#fff',
				'textSize'        => 'small'
			],
			'captcha'   => [],
			'errors'    => [
				'backgroundColor' => '#fff',
				'borderSize'      => 0,
				'borderColor'     => '#fff',
				'borderRadius'    => 0,
				'padding'         => 0,
				'textColor'       => '#FF0000',
				'textSize'        => 'small'
			]
		];
		return $css_array;
	}

	public static function yop_ajax_import()
	{
		if ( false === is_user_logged_in() ) {
            wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
			wp_die();
		}
		if( check_ajax_referer( 'yop-poll-ajax-importer', '_csrf_token' ) ) {
            $skip_table_check = false;
			if ( isset( $_REQUEST['enableGdpr'] ) && isset( $_REQUEST['gdprSolution'] ) ) {
				self::set_gdpr( $_REQUEST['enableGdpr'], $_REQUEST['gdprSolution'] );
			}
            switch ($_REQUEST['table']) {
                case 'polls': {
                    $response = self::import_polls( self::$ajax_limit, $skip_table_check );
                    if ( -1 == $response['response_code'] ) {
                        $table         = 'bans';
                        $response_code = 1;
                        wp_send_json_success( array( 'table' => $table, 'response_code' => $response_code, 'message' => $response['message'], 'skip_table_check' => false ) );
                    } else {
                        $table         = 'polls';
                        $response_code = $response['response_code'];
                        wp_send_json_success( array( 'table' => $table, 'response_code' => $response_code, 'message' => $response['message'], 'skip_table_check' => true ) );
                    }
                    break;
                }
                case 'bans': {
                    $response = self::import_bans( $skip_table_check );
                    if ( -1 == $response['response_code'] ) {
                        $table         = 'votes';
                        $response_code = 1;
                        wp_send_json_success( array( 'table' => $table, 'response_code' => $response_code, 'message' => $response['message'], 'skip_table_check' => false ) );
                    } else {
                        $table = 'bans';
                        $response_code = $response['response_code'];
                        wp_send_json_success( array( 'table' => $table, 'response_code' => $response_code, 'message' => $response['message'], 'skip_table_check' => true ) );
                    }
                    break;
                }
                case 'votes': {
                    $response = self::import_votes( $skip_table_check );
                    if ( -1 == $response['response_code'] ) {
                        $table = 'votes';
                        $response_code = 'done';
						delete_option( 'yop_poll_old_version' );
                        wp_send_json_success( array( 'table' => $table, 'response_code' => $response_code, 'message' => $response['message'], 'skip_table_check' => false ) );
                    } else {
                        $table = 'votes';
                        $response_code = $response['response_code'];
                        wp_send_json_success( array( 'table' => $table, 'response_code' => $response_code, 'message' => $response['message'], 'skip_table_check' => true ) );
                    }
                    break;
                }
            }
            wp_die();
        } else {
            wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
            wp_die();
        }
	}
}
