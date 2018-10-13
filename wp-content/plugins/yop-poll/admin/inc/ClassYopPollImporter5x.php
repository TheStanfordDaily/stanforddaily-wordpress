<?php
class ClassYopPollImporter5x {
	private static $initial_limit           = 500;
	private static $ajax_limit              = 100;
	private static $unprocessed_polls       = 0;
	private static $processed_polls         = 0;
	private static $unprocessed_bans        = 0;
	private static $processed_bans          = 0;
	private static $unprocessed_votes       = 0;
	private static $processed_votes         = 0;
	private static $unprocessed_logs        = 0;
	private static $processed_logs          = 0;
	private static $checked_existence_polls = false;
	private static $checked_existence_bans  = false;
	private static $checked_existence_votes = false;
	private static $checked_existence_logs  = false;
	private static $polls_table_exists      = false;
	private static $bans_table_exists       = false;
	private static $votes_table_exists      = false;
	private static $logs_table_exists       = false;
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
	private static function import_polls( $query_limit, $skip_table_check = false ) {
		global $wpdb;
		$polls_table_name                = $GLOBALS['wpdb']->prefix . 'yop2_polls';
		$polls_meta_table_name           = $GLOBALS['wpdb']->prefix . 'yop2_pollmeta';
		$polls_questions_table_name      = $GLOBALS['wpdb']->prefix . 'yop2_poll_questions';
		$polls_questions_meta_table_name = $GLOBALS['wpdb']->prefix . 'yop2_poll_questionmeta';
		$polls_answers_table_name        = $GLOBALS['wpdb']->prefix . 'yop2_poll_answers';
		$polls_answers_meta_table_name   = $GLOBALS['wpdb']->prefix . 'yop2_poll_answermeta';
		$polls_questions_customs_table   = $GLOBALS['wpdb']->prefix . 'yop2_poll_custom_fields';
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
			self::$unprocessed_polls = $wpdb->get_var("select count(ID) from `{$polls_table_name}` where processed = false");
			$polls                   = $wpdb->get_results( "select `ID`, `poll_title`, `poll_name`, `poll_author`, `poll_date`, `poll_status`, `poll_modified`, `poll_type`, `poll_start_date`, `poll_end_date`, `poll_total_votes`, `meta_key`, `meta_value` from `{$polls_table_name}` inner join
`{$polls_meta_table_name}` on `{$polls_table_name}`.`ID` = `{$polls_meta_table_name}`.`yop_poll_id` where `processed` = false limit {$query_limit}" );
			if ( count( $polls ) > 0 ) {
				if ( self::check_if_table_exists( $polls_questions_table_name ) &&
				     self::check_if_table_exists( $polls_questions_meta_table_name ) ) {
					$maxID              = $wpdb->get_var( "select max(`ID`) from `{$polls_questions_table_name}`" );
					self::$maxElementID = $maxID + 1;
				}
				foreach ( $polls as $poll ) {
					$unserialized_meta = unserialize( $poll->meta_value );
					$poll_style        = self::create_css_from_template( '' !== $unserialized_meta['template'] ? $unserialized_meta['template'] : 1 );
					$vote_perms        = [];
					if ( isset( $unserialized_meta['vote_permisions'] ) ) {
						foreach ( $unserialized_meta['vote_permisions'] as $vp ) {
							if ( 'registered' === $vp ) {
								$vote_perms[] = 'wordpress';
							} else {
								$vote_perms[] = $vp;
							}
						}
					}
					if ( 0 == count( $vote_perms ) ) {
						$vote_perms[] = 'wordpress';
					}
					$results_moment = [];
					if ( isset( $unserialized_meta['view_results'] ) ) {
						foreach ( $unserialized_meta['view_results'] as $vr ) {
							if ( 'after' === $vr ) {
								$results_moment[] = 'after-vote';
							} elseif ( 'before' === $vr ) {
								$results_moment[] = 'before-vote';
							} else {
								$results_moment[] = $vr;
							}
						}
					}
					if ( 0 == count( $results_moment ) ) {
						$results_moment[] = 'after-vote';
					}
					$show_results_to = [];
					if ( isset( $unserialized_meta['view_results_permissions'] ) ) {
						foreach ( $unserialized_meta['view_results_permissions'] as $vrp ) {
							if ( 'registered' === $vrp ) {
								$show_results_to[] = 'registered';
							} else {
								$show_results_to[] = $vrp;
							}
						}
					}
					if ( 0 == count( $show_results_to ) ) {
						$show_results_to[] = 'guest';
						$show_results_to[] = 'registered';
					}
					$sorting_results = 'as-defined';
					if ( isset( $unserialized_meta['sorting_results'] ) ) {
						if ( 'votes' === $unserialized_meta['sorting_results'] ) {
							$sorting_results = 'number-of-votes';
						} elseif ( 'as_defined' === $unserialized_meta['sorting_results'] ) {
							$sorting_results = 'as-defined';
						} else {
							$sorting_results = $unserialized_meta['sorting_results'];
						}
					}
					$newBlVoters = [];
					if ( isset( $unserialized_meta['blocking_voters'] ) ) {
						foreach ( $unserialized_meta['blocking_voters'] as $bv ) {
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
								case 'user_id':
									$blocking_voters = 'by-user-id';
									break;
								default:
									break;
							}
							$newBlVoters[] = $blocking_voters;
						}
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
                    $pro_templates_ids = [16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28];
                    if( isset( $unserialized_meta['template'] ) ) {
						if( in_array( $unserialized_meta['template'], $pro_templates_ids ) ) {
							$template_base = 'basic-pretty';
						} else {
							$template_base = 'basic';
						}
                    } else {
                    	$template_base = 'basic';
                    }
					if ( isset( $unserialized_meta['show_results_in'] ) ) {
                    	if ( 'bar' === $unserialized_meta['show_results_in'] ) {
                    		$displayResultsAs = 'bar';
	                    } else {
                    		$displayResultsAs = 'pie';
	                    }
					} else {
						$displayResultsAs = 'bar';
					}
					if ( '' !== $poll->poll_end_date ) {
                        if ( '2038-01-01 23:59:59' === $poll->poll_end_date ) {
							$poll_end_date_option = 'never';
                            $poll_end_date = '';
                        } else {
							$poll_end_date_option = 'custom';
                            $poll_end_date = $poll->poll_end_date;
                        }
                    } else {
						$poll_end_date_option = 'never';
						$poll_end_date = '';
                    }
					$pollArray         = [
						'ID'                     => $poll->ID,
						'name'                   => $poll->poll_title,
						'poll_author'            => $poll->poll_author,
						'status'                 => 'published',
						'stype'                  => 'poll',
						'total_submits'          => $poll->poll_total_votes,
						'total_submited_answers' => $poll->poll_total_votes,
						'added_date'             => $poll->poll_date,
						'modified_date'          => $poll->poll_modified,
						'design'                 => [
							'template'     => 1,
							'templateBase' => $template_base,
							'style'        => $poll_style
						],
						'options'                => [
							'poll'    => [
								'voteButtonLabel'             => $unserialized_meta['vote_button_label'],
								'showResultsLink'             => 'no',
								'resultsLabelText'            => 'Results',
								'showTotalVotes'              => $unserialized_meta['view_total_votes'],
								'showTotalAnswers'            => $unserialized_meta['view_total_answers'],
								'startDateOption'             => 'custom',
								'startDateCustom'             => $poll->poll_start_date,
								'endDateOption'               => $poll_end_date_option,
								'endDateCustom'               => $poll_end_date,
								'redirectAfterVote'           => $unserialized_meta['redirect_after_vote'],
								'redirectUrl'                 => $unserialized_meta['redirect_after_vote_url'],
								'resetPollStatsAutomatically' => isset( $unserialized_meta['schedule_reset_poll_stats'] ) ? $unserialized_meta['schedule_reset_poll_stats'] : 'no',
								'resetPollStatsOn'            => $unserialized_meta['schedule_reset_poll_date'],
								'resetPollStatsEvery'         => $unserialized_meta['schedule_reset_poll_recurring_value'],
								'resetPollStatsEveryPeriod'   => $unserialized_meta['schedule_reset_poll_recurring_unit'] . 's',
								'autoGeneratePollPage'        => $unserialized_meta['auto_generate_poll_page'],
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
								'blockForValue'       => isset( $unserialized_meta['blocking_voters_interval_value'] ) ? $unserialized_meta['blocking_voters_interval_value'] : '',
								'blockForPeriod'      => isset( $unserialized_meta['blocking_voters_interval_unit'] ) ? $unserialized_meta['blocking_voters_interval_unit'] : 'minutes',
								'limitVotesPerUser'   =>
									isset( $unserialized_meta['limit_number_of_votes_per_user'] ) ? $unserialized_meta['limit_number_of_votes_per_user'] : 'no',
								'votesPerUserAllowed' => isset( $unserialized_meta['number_of_votes_per_user'] ) ? $unserialized_meta['number_of_votes_per_user'] : 3
							],
							'results' => [
								'showResultsMoment' => $results_moment,
								'customDateResults' => isset( $unserialized_meta['view_results_start_date'] ) ? $unserialized_meta['view_results_start_date'] : '',
								'showResultsTo'     => $show_results_to,
								'backToVoteOption'  => isset( $unserialized_meta['view_back_to_vote_link'] ) ? $unserialized_meta['view_back_to_vote_link'] : 'no',
								'backToVoteCaption' => 'Back to vote',
								'sortResults'       => $sorting_results,
								'sortResultsRule'   => isset( $unserialized_meta['sorting_results_direction'] ) ? $unserialized_meta['sorting_results_direction'] : 'asc',
								'displayResultsAs'  => $displayResultsAs,
                                'resultsDetails'    => $resultsDetails
							]
						]
					];
					$pollElementsArray = [];
					if ( self::check_if_table_exists( $polls_questions_table_name ) && self::check_if_table_exists( $polls_questions_meta_table_name ) ) {
						$pollQuestions = $wpdb->get_results( "select * from `{$polls_questions_table_name}` inner join `{$polls_questions_meta_table_name}` on
					`{$polls_questions_table_name}`.`ID` = `$polls_questions_meta_table_name`.`yop_poll_question_id` where `poll_id` = {$poll->ID}" );
						foreach ( $pollQuestions as $pQ ) {
							$qArr                     = [];
							$unserialized_q_meta      = unserialize( $pQ->meta_value );
							$pollQuestionAnswers      = $wpdb->get_results( "select * from `{$polls_answers_table_name}` inner join `{$polls_answers_meta_table_name}` on
					`{$polls_answers_table_name}`.`ID` = `{$polls_answers_meta_table_name}`.`yop_poll_answer_id` where `poll_id` = {$poll->ID} and `question_id` = {$pQ->ID}" );
							$pollQuestionCustoms      = $wpdb->get_results( "select `custom_field`, `required` from `{$polls_questions_table_name}` inner join `{$polls_questions_customs_table}` on
					`{$polls_questions_table_name}`.`ID` = `{$polls_questions_customs_table}`.`question_id` where `{$polls_questions_table_name}`.`poll_id` = {$poll->ID} and `question_id` = {$pQ->ID}" );
							$x                        = 0;
							$pollQuestionAnswersArray = [];
							switch ( $pQ->type ) {
								case 'text': {
									foreach ( $pollQuestionAnswers as $pQA ) {
										$unserialized_a_meta = unserialize( $pQA->meta_value );
										switch ( $pQA->type ) {
											case 'text': {
												$pQAA = [
													'ID'             => $pQA->ID,
													'question_order' => $pQA->question_order,
													'type'           => 'text',
													'text'           => stripslashes( $pQA->answer ),
													'options'        => [
														'makeDefault'  => isset( $unserialized_a_meta['is_default_answer'] ) ? $unserialized_a_meta['is_default_answer'] : 'no',
														'makeLink'     => 'no',
														'link'         => '',
														'resultsColor' => isset ( $unserialized_a_meta['bar_background'] ) ? $unserialized_a_meta['bar_background'] : ''
													]
												];
												break;
											}
											case 'other': {
												$pQAA = [
													'ID'             => $pQA->ID,
													'question_order' => $pQA->question_order,
													'type'           => 'text',
													'text'           => stripslashes( $pQA->answer ),
													'is_other'       => true,
													'options'        => [
														'makeDefault'  => isset( $unserialized_a_meta['is_default_answer'] ) ? $unserialized_a_meta['is_default_answer'] : 'no',
														'makeLink'     => 'no',
														'link'         => '',
														'resultsColor' => isset ( $unserialized_a_meta['bar_background'] ) ? $unserialized_a_meta['bar_background'] : ''
													]
												];
												break;
											}
											case 'image': {
												$pQAA = [
													'ID'             => $pQA->ID,
													'question_order' => $pQA->question_order,
													'type'           => 'image',
													'text'           => stripslashes( $pQA->answer ),
													'options'        => [
														'makeDefault'  => isset( $unserialized_a_meta['is_default_answer'] ) ? $unserialized_a_meta['is_default_answer'] : 'no',
														'makeLink'     => 'no',
														'addText'      => 'no',
														'text'         => '',
														'resultsColor' => isset ( $unserialized_a_meta['bar_background'] ) ? $unserialized_a_meta['bar_background'] : '#000'
													]
												];
												break;
											}
										}
										$pollQuestionAnswersArray[$x] = $pQAA;
										$x ++;
									}
									if ( isset( $unserialized_q_meta['display_answers'] ) ) {
										if( 'orizontal' === $unserialized_q_meta['display_answers'] ) {
											$answersDisplay = 'horizontal';
										} elseif ( 'tabulated' === $unserialized_q_meta['display_answers'] ) {
											$answersDisplay = 'columns';
										} else {
											$answersDisplay = $unserialized_q_meta['display_answers'];
										}
									} else {
										$answersDisplay = 'vertical';
									}
									$pollElementsArray[] = [
										'ID'         => $pQ->ID,
										'type'       => 'text-question',
										'text'       => stripslashes( $pQ->question ),
										'poll_order' => $pQ->poll_order,
										'answers'    => $pollQuestionAnswersArray,
										'options'    => [
											'allowOtherAnswers'            => isset( $unserialized_q_meta['allow_other_answers'] ) ? $unserialized_q_meta['allow_other_answers'] : 'no',
											'otherAnswersLabel'            => isset( $unserialized_q_meta['other_answers_label'] ) ? $unserialized_q_meta['other_answers_label'] : 'Other',
											'addOtherAnswers'              =>
												isset( $unserialized_q_meta['add_other_answers_to_default_answers'] ) ? $unserialized_q_meta['add_other_answers_to_default_answers'] : 'no',
											'displayOtherAnswersInResults' =>
												isset( $unserialized_q_meta['display_other_answers_values'] ) ? $unserialized_q_meta['display_other_answers_values'] : 'no',
											'allowMultipleAnswers'         =>
												isset( $unserialized_q_meta['allow_multiple_answers'] ) ? $unserialized_q_meta['allow_multiple_answers'] : 'no',
											'multipleAnswersMinim'         =>
												isset( $unserialized_q_meta['allow_multiple_answers_min_number'] ) ? $unserialized_q_meta['allow_multiple_answers_min_number'] : 1,
											'multipleAnswersMaxim'         => isset( $unserialized_q_meta['allow_multiple_answers_number'] ) ? $unserialized_q_meta['allow_multiple_answers_number'] : 3,
											'answersDisplay'               => $answersDisplay,
											'answersColumns'               =>
												isset( $unserialized_q_meta['display_answers_tabulated_cols'] ) ? $unserialized_q_meta['display_answers_tabulated_cols'] : 2
										]
									];
									break;
								}
								case 'media': {
									foreach ( $pollQuestionAnswers as $pQA ) {
										$unserialized_a_meta = unserialize( $pQA->meta_value );
										switch ( $pQA->type ) {
											case 'text': {
												$pQAA = [
													'ID'             => $pQA->ID,
													'question_order' => $pQA->question_order,
													'type'           => 'text',
													'text'           => stripslashes( $pQA->answer ),
													'options'        => [
														'makeDefault'  => isset( $unserialized_a_meta['is_default_answer'] ) ? $unserialized_a_meta['is_default_answer'] : 'no',
														'makeLink'     => 'no',
														'link'         => '',
														'resultsColor' => isset ( $unserialized_a_meta['bar_background'] ) ? $unserialized_a_meta['bar_background'] : ''
													]
												];
												break;
											}
											case 'image': {
												$pQAA = [
													'ID'             => $pQA->ID,
													'question_order' => $pQA->question_order,
													'type'           => 'image',
													'text'           => stripslashes( $pQA->answer ),
													'options'        => [
														'makeDefault'  => isset( $unserialized_a_meta['is_default_answer'] ) ? $unserialized_a_meta['is_default_answer'] : 'no',
														'makeLink'     => 'no',
														'addText'      => 'no',
														'text'         => '',
														'resultsColor' => isset ( $unserialized_a_meta['bar_background'] ) ? $unserialized_a_meta['bar_background'] : '#000'
													]
												];
												break;
											}
										}
										$pollQuestionAnswersArray[$x] = $pQAA;
										$x ++;
									}
									if ( isset( $unserialized_q_meta['display_answers'] ) ) {
										if( 'orizontal' === $unserialized_q_meta['display_answers'] ) {
											$answersDisplay = 'horizontal';
										} elseif ( 'tabulated' === $unserialized_q_meta['display_answers'] ) {
											$answersDisplay = 'columns';
										} else {
											$answersDisplay = $unserialized_q_meta['display_answers'];
										}
									} else {
										$answersDisplay = 'vertical';
									}
									$pollElementsArray[] = [
										'ID'         => $pQ->ID,
										'type'       => 'media-question',
										'text'       => stripslashes( $pQ->question ),
										'poll_order' => $pQ->poll_order,
										'answers'    => $pollQuestionAnswersArray,
										'options'    => [
											'allowOtherAnswers'            => isset( $unserialized_q_meta['allow_other_answers'] ) ? $unserialized_q_meta['allow_other_answers'] : 'no',
											'otherAnswersLabel'            => isset( $unserialized_q_meta['other_answers_label'] ) ? $unserialized_q_meta['other_answers_label'] : 'Other',
											'addOtherAnswers'              =>
												isset( $unserialized_q_meta['add_other_answers_to_default_answers'] ) ? $unserialized_q_meta['add_other_answers_to_default_answers'] : 'no',
											'displayOtherAnswersInResults' =>
												isset( $unserialized_q_meta['display_other_answers_values'] ) ? $unserialized_q_meta['display_other_answers_values'] : 'no',
											'allowMultipleAnswers'         =>
												isset( $unserialized_q_meta['allow_multiple_answers'] ) ? $unserialized_q_meta['allow_multiple_answers'] : 'no',
											'multipleAnswersMinim'         =>
												isset( $unserialized_q_meta['allow_multiple_answers_min_number'] ) ? $unserialized_q_meta['allow_multiple_answers_min_number'] : 1,
											'multipleAnswersMaxim'         => isset( $unserialized_q_meta['allow_multiple_answers_number'] ) ? $unserialized_q_meta['allow_multiple_answers_number'] : 3,
											'answersDisplay'               => $answersDisplay,
											'answersColumns'               =>
												isset( $unserialized_q_meta['display_answers_tabulated_cols'] ) ? $unserialized_q_meta['display_answers_tabulated_cols'] : 2
										]
									];
									break;
								}
							}
							foreach ( $pollQuestionCustoms as $pQC ) {
								$pollElementsArray[] = [
									'ID'             => self::$maxElementID,
									'poll_order' => 1,
									'type'    => 'custom-field',
									'text'    => stripslashes( $pQC->custom_field ),
									'options' => [
										'makeRequired' => 'yes' === $pQC->required ? 'yes' : 'no'
									]
								];
								self::$maxElementID++;
							}
						}
					}
					$pollArray['elements'] = $pollElementsArray;
					$responseArray         = YOP_Poll_Polls::add( json_decode( json_encode( $pollArray ) ) );
					if ( '' !== $responseArray['poll_id'] ) {
						$result = $wpdb->update( $polls_table_name, array( 'processed' => true ), array( 'ID' => $poll->ID ) );
						self::$processed_polls += $result;
					}
				}
			}
		}
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

	private static function import_bans( $skip_table_check = false ) {
		global $wpdb;
		$polls_bans_table = $GLOBALS['wpdb']->prefix . 'yop2_poll_bans';
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
			self::$unprocessed_bans = $wpdb->get_var("select count(ID) from `{$polls_bans_table}` where `processed` = false");
			$bans                   = $wpdb->get_results( "select * from `{$polls_bans_table}` LIMIT " .self::$ajax_limit );
			$bansIds = [];
			if ( count( $bans ) > 0 ) {
				foreach ( $bans as $ban ) {
					$values[] = $wpdb->prepare( "(%d, %d, %s, %s, %s)", $current_user->ID, $ban->poll_id, $ban->type, $ban->value, current_time( 'mysql' ) );
					$bansIds[] = $ban->id;
				}
				$query = "INSERT INTO `{$GLOBALS['wpdb']->yop_poll_bans}` (`author`, `poll_id`, `b_by`, `b_value`, `added_date`) VALUES ";
				if ( count( $values ) > 0 ) {
					$query  .= implode( ",\n", $values );
					$result = $wpdb->query( $query );
					if ( ! $result ) {
						$last_error = $wpdb->last_error;
						return [ 'response_code' => 1, 'message' => __( $last_error, 'yop-poll' ) ];
					} else {
						$res = $wpdb->query("update {$polls_bans_table} set `processed` = true where `ID` in (".implode(',', $bansIds).")");
						self::$processed_bans += $res;
						if ( self::$processed_bans == self::$unprocessed_bans ) {
							return [ 'response_code' => - 1, 'message' => __( 'Processed ' . self::$processed_bans . ' out of ' . self::$unprocessed_bans . ' records on table bans.', 'yop-poll' ) ];
						} else {
							return [ 'response_code' => 1, 'message' => __( 'Processed ' . self::$processed_bans . ' out of ' . self::$unprocessed_bans . ' remaining records on table bans.', 'yop-poll' ) ];
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
		$polls_results_table_name         = $GLOBALS['wpdb']->prefix . 'yop2_poll_results';
		$polls_results_customs_table_name = $GLOBALS['wpdb']->prefix . 'yop2_poll_votes_custom_fields';
		$current_user                     = wp_get_current_user();
		if( $skip_table_check ) {
			self::$checked_existence_votes = true;
			self::$votes_table_exists      = true;
		}
		if ( !self::$checked_existence_votes ) {
			if ( self::check_if_table_exists( $polls_results_table_name ) ) {
				if ( ! self::check_if_column_exists( $polls_results_table_name, 'processed' ) ) {
					$wpdb->query( "ALTER TABLE `{$polls_results_table_name}` ADD processed BOOLEAN DEFAULT FALSE " );
				}
				self::$checked_existence_votes = true;
				self::$votes_table_exists      = true;
			}
		}

		if ( self::$checked_existence_votes && self::$votes_table_exists ) {
			self::$unprocessed_votes = $wpdb->get_var("select count(ID) from `{$polls_results_table_name}` where processed = false");
			$results                 = $wpdb->get_results( "select `{$polls_results_table_name}`.* from  `{$polls_results_table_name}` where `processed` = false limit " . self::$ajax_limit );
			if ( 0 == count( $results ) ) {
				return [ 'response_code' => - 1, 'message' => __( 'No votes to process.', 'yop-poll' ) ];
			} else {
				$voteData   = ['elements' => [], 'user' => [] ];
				$votesArray = [];
				$resultsIds = [];
				foreach ( $results as $result ) {
                    $voteData   = ['elements' => [], 'user' => [] ];
					$resultsIds[]   = $result->ID;
					$result_details = get_object_vars( json_decode( $result->result_details ) );
					foreach ( $result_details as $rd ) {
						$a_data = [];
						foreach ( $rd->a as $answer_id ) {
							$a_data[] = [
								'id'   => $answer_id,
								'data' => true
							];
                            $wpdb->query( $wpdb->prepare("UPDATE `{$GLOBALS['wpdb']->yop_poll_subelements}` SET `total_submits` = ( `total_submits` + 1 ) WHERE `id` = %d", array( $answer_id ) ) );

						}
                        $voteData['elements'][] = [
							'id'   => $rd->id,
							'type' => 'question',
							'data' => $a_data
						];
						if ( property_exists( $rd, 'cf' ) && count( $rd->cf ) > 0 ) {
							$customs = $wpdb->get_results( "select `id`, `user_id`,`custom_field_value` from `{$polls_results_customs_table_name}` where ID in (" . implode( ',', $rd->cf ) . ")" );
							if ( $customs ) {
								foreach ( $customs as $cust ) {
								    $custom_text = $wpdb->get_var( "select `custom_field` from {$GLOBALS['wpdb']->prefix}yop2_poll_custom_fields where ID = '{$cust->id}'" );
								    $added_custom = $wpdb->get_var( $wpdb->prepare("select `id` from `{$GLOBALS['wpdb']->yop_poll_elements}` where `poll_id` = %d and `etext` = %s limit 1", array( $result->poll_id, $custom_text ) ) );
								    if ( '' != $added_custom && $added_custom > 0 ) {
								        $custom_id = $added_custom;
                                    } else {
                                        $wpdb->insert( $GLOBALS['wpdb']->yop_poll_elements,
                                            ['poll_id'=> $result->poll_id,
                                                'author' => $current_user->ID,
                                                'etext' => 'Custom field',
                                                'etype' => 'custom_field',
                                                'status' => 'active',
                                                'meta_data' => serialize( ['makeRequired' => 'no'] ),
                                                'added_date' => date( 'Y-m-d H:i:s' ),
                                                'modified_date' => date( 'Y-m-d H:i:s' )
                                            ],
                                            ['%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s'] );
                                        $custom_id = $wpdb->insert_id;
                                    }
                                    $voteData['elements'][] = [
										'id'   => $custom_id,
										'type' => 'custom-field',
										'data' => [$cust->custom_field_value]
									];
								}
							}
						}
					}
					$voteData['user'] = [
						'first_name' => '',
						'last_name'  => ''
					];
					$data             = array(
						'poll_id'           => $result->poll_id,
						'user_id'           => $result->user_id,
						'user_email'        => '',
						'user_type'         => $result->user_type,
						'ipaddress'         => self::make_ip_gdpr_compliant( $result->ip ),
						'tracking_id'       => $result->tr_id,
						'voter_id'          => self::make_cookie_gdpr_compliant( $result->vote_id ),
						'voter_fingerprint' => '',
						'vote_data'         => serialize( $voteData ),
						'status'            => 'active',
						'added_date'        => $result->vote_date
					);
					$votesArray[]       = $wpdb->prepare( "(%d, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $data['poll_id'], $data['user_id'], $data['user_email'], $data['user_type'], $data['ipaddress'],
						$data['tracking_id'], $data['voter_id'], $data['voter_fingerprint'], $data['vote_data'], $data['status'], $data['added_date'] );
				}
				$query = "INSERT INTO `{$GLOBALS['wpdb']->yop_poll_votes}` (`poll_id`, `user_id`, `user_email`, `user_type`, `ipaddress`, `tracking_id`, `voter_id`, `voter_fingerprint`, `vote_data`,
					`status`, `added_date`) VALUES ";
				if ( count( $votesArray ) > 0 ) {
					$query    .= implode( ",\n", $votesArray );
					$response = $wpdb->query( $query );
					if ( $response ) {
						$result = $wpdb->query( "update `{$polls_results_table_name}` set `processed` = true where ID in (" . implode( ',', $resultsIds ) . ")" );
						self::$processed_votes += $result;
						if ( self::$processed_votes == self::$unprocessed_votes ) {
							return [ 'response_code' => -1, 'message' => __( 'Processed ' . self::$processed_votes . ' out of ' . self::$unprocessed_votes . ' records on table votes.', 'yop-poll' ) ];
						} else {
							return [ 'response_code' => 1, 'message' => __( 'Processed ' . self::$processed_votes . ' out of '. self::$unprocessed_votes . ' remaining records on table votes.', 'yop-poll' ) ];
						}
					} else {
						return [ 'response_code' => 1, 'message' => __( $wpdb->last_error, 'yop-poll' ) ];
					}
				} else {
					return [ 'response_code' => - 1, 'message' => __( 'No votes to process.', 'yop-poll' ) ];
				}
			}
		} else {
			return [ 'response_code' => - 1, 'message' => __( 'No votes table, skipping.', 'yop-poll' ) ];
		}

	}

	private static function import_logs( $skip_table_check = false ) {
		global $wpdb;
		$polls_logs_table_name            = $GLOBALS['wpdb']->prefix . 'yop2_poll_logs';
		$polls_results_customs_table_name = $GLOBALS['wpdb']->prefix . 'yop2_poll_votes_custom_fields';
		$current_user                     = wp_get_current_user();
		if ( $skip_table_check ) {
			self::$checked_existence_logs = true;
			self::$logs_table_exists      = true;
		}
		if ( ! self::$checked_existence_bans ) {
			if ( self::check_if_table_exists( $polls_logs_table_name ) ) {
				if ( ! self::check_if_column_exists( $polls_logs_table_name, 'processed' ) ) {
					$wpdb->query( "ALTER TABLE `{$polls_logs_table_name}` ADD processed BOOLEAN DEFAULT FALSE " );
				}
				self::$checked_existence_logs = true;
				self::$logs_table_exists      = true;
			}
		}
		if ( self::$checked_existence_logs && self::$logs_table_exists ) {
			self::$unprocessed_logs = $wpdb->get_var("select count(ID) from `{$polls_logs_table_name}` where processed = false");
			$log_results            = $wpdb->get_results( "select `{$polls_logs_table_name}`.* from  `{$polls_logs_table_name}` where `processed` = false limit " . self::$ajax_limit );
			if ( 0 == count( $log_results ) ) {
				return [ 'response_code' => - 1, 'message' => __( 'No logs to process.', 'yop-poll' ) ];
			} else {
				$logData   = [ 'elements' => [], 'user' => [] ];
				$logsArray = [];
				$logsIds   = [];
				foreach ( $log_results as $lresult ) {
                    $logData   = [ 'elements' => [], 'user' => [] ];
					$logsIds[] = $lresult->ID;
					if ( 'Success' === $lresult->message ) {
						$lresult_details = get_object_vars( json_decode( $lresult->vote_details ) );
						$q_data          = [];
						foreach ( $lresult_details as $rd ) {
							$a_data = [];
							foreach ( $rd->a as $answer_id ) {
								$a_data[] = [
									'id'   => $answer_id,
									'data' => true
								];
							}
                            $logData['elements'][] = [
								'id'   => $rd->id,
								'type' => 'question',
								'data' => $a_data
							];
							if ( count( $rd->cf ) > 0 ) {
								$customs = $wpdb->get_results( "select `id`, `custom_field_value` from `{$polls_results_customs_table_name}` where ID in (" . implode( ',', $rd->cf ) . ")" );
								if ( $customs ) {
									foreach ( $customs as $cust ) {
                                        $custom_text = $wpdb->get_var("select `custom_field` from {$GLOBALS['wpdb']->prefix}yop2_poll_custom_fields where ID = '{$cust->id}'");
                                        $added_custom = $wpdb->get_var( $wpdb->prepare("select `id` from `{$GLOBALS['wpdb']->yop_poll_elements}` where `poll_id` = %d and `etext` = %s limit 1", array( $lresult->poll_id, $custom_text ) ) );
                                        if ( '' != $added_custom && $added_custom > 0 ) {
                                            $custom_id = $added_custom;
                                        } else {
                                            $wpdb->insert( $GLOBALS['wpdb']->yop_poll_elements,
                                                ['poll_id'=> $lresult->poll_id,
                                                    'author' => $current_user->ID,
                                                    'etext' => 'Custom field',
                                                    'etype' => 'custom_field',
                                                    'status' => 'active',
                                                    'meta_data' => serialize( ['makeRequired' => 'no'] ),
                                                    'added_date' => date( 'Y-m-d H:i:s' ),
                                                    'modified_date' => date( 'Y-m-d H:i:s' )
                                                ],
                                                ['%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s']);
                                            $custom_id = $wpdb->insert_id;
                                        }
                                        $logData['elements'][] = [
											'id'   => $custom_id,
											'type' => 'custom-field',
											'data' => [$cust->custom_field_value]
										];
									}
								}
							}
						}
					}

					$logData['user'] = [
						'first_name' => '',
						'last_name'  => ''
					];
					$vote_message    = [ $lresult->message ];
					$data            = array(
						'poll_id'           => $lresult->poll_id,
                        'poll_author'       => $current_user->ID,
						'user_id'           => $lresult->user_id,
						'user_email'        => '',
						'user_type'         => $lresult->user_type,
						'ipaddress'         => self::make_ip_gdpr_compliant( $lresult->ip ),
						'tracking_id'       => $lresult->tr_id,
						'voter_id'          => self::make_cookie_gdpr_compliant( $lresult->vote_id ),
						'voter_fingerprint' => '',
						'vote_data'         => serialize( $logData ),
						'vote_message'      => serialize( $vote_message ),
						'added_date'        => $lresult->vote_date
					);
					$logsArray[]     = $wpdb->prepare( "(%d, %d, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $data['poll_id'], $data['poll_author'], $data['user_id'], $data['user_email'], $data['user_type'], $data['ipaddress'],
						$data['tracking_id'], $data['voter_id'], $data['voter_fingerprint'], $data['vote_data'], $data['vote_message'], $data['added_date'] );
				}
				$query     = "INSERT INTO `{$GLOBALS['wpdb']->yop_poll_logs}` (`poll_id`, `poll_author`, `user_id`, `user_email`, `user_type`, `ipaddress`, `tracking_id`, `voter_id`, `voter_fingerprint`, `vote_data`,
				`vote_message`, `added_date`) VALUES ";
				$query    .= implode( ",\n", $logsArray );
				$response = $wpdb->query( $query );
				if ( $response ) {
					$result = $wpdb->query( "update `{$polls_logs_table_name}` set `processed` = true where `ID` in (" . implode( ',', $logsIds ) . ")" );
					self::$processed_logs += $result;
					if ( self::$processed_logs == self::$unprocessed_logs ) {
						return [ 'response_code' => -1, 'message' => __( 'Processed ' . self::$processed_logs . ' out of ' . self::$unprocessed_logs . ' records on table logs.', 'yop-poll' ) ];
					} else {
						return [ 'response_code' => 1, 'message' => __( 'Processed ' . self::$processed_logs . ' out of remaining ' . self::$unprocessed_logs . ' records on table logs.', 'yop-poll' ) ];
					}
				} else {
					return [ 'response_code' => 1, 'message' => __( $wpdb->last_error, 'yop-poll' ) ];
				}
			}
		} else {
			return [ 'response_code' => - 1, 'message' => __( 'No logs table, skipping.', 'yop-poll' ) ];
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
		$css_array = [];
		switch ( $template_id ) {
			case 1: {
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
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333333',
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
				break;
			}
			case 2: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#eee',
						'borderSize'               => 0,
						'borderColor'              => '#eee',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#fff',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#eee',
						'borderSize'      => 0,
						'borderColor'     => '#eee',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#fff',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#eee',
						'borderSize'      => 0,
						'borderColor'     => '#eee',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#000',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333333',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#eee',
						'borderSize'      => 0,
						'borderColor'     => '#eee',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 3: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#555',
						'borderSize'               => 0,
						'borderColor'              => '#555',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#fff',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#555',
						'borderSize'      => 0,
						'borderColor'     => '#555',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#fff',
						'textSize'        => 'small',
					],
					'answers'   => [
						'backgroundColor' => '#555',
						'borderSize'      => 0,
						'borderColor'     => '#555',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#333',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333333',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#555',
						'borderSize'      => 0,
						'borderColor'     => '#555',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 4: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#327BD6',
						'borderSize'               => 0,
						'borderColor'              => '#327BD6',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#fff',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#327BD6',
						'borderSize'      => 0,
						'borderColor'     => '#327BD6',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#fff',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#327BD6',
						'borderSize'      => 0,
						'borderColor'     => '#327BD6',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#000',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333333',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#327BD6',
						'borderSize'      => 0,
						'borderColor'     => '#327BD6',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 5: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#fff',
						'borderSize'               => 0,
						'borderColor'              => '#fff',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#fff',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#327BD6',
						'borderSize'      => 0,
						'borderColor'     => '#327BD6',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#fff',
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
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333333',
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
				break;
			}
			case 6: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#fff',
						'borderSize'               => 2,
						'borderColor'              => '#327BD6',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#000',
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
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333333',
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
				break;
			}
			case 7: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#B70004',
						'borderSize'               => 0,
						'borderColor'              => '#B70004',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#000',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#B70004',
						'borderSize'      => 0,
						'borderColor'     => '#B70004',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#fff',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#B70004',
						'borderSize'      => 0,
						'borderColor'     => '#B70004',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#000',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333333',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#B70004',
						'borderSize'      => 0,
						'borderColor'     => '#B70004',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 8: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#fff',
						'borderSize'               => 0,
						'borderColor'              => '#fff',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#000',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#B70004',
						'borderSize'      => 0,
						'borderColor'     => '#B70004',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#fff',
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
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333333',
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
				break;
			}
			case 9: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#fff',
						'borderSize'               => 2,
						'borderColor'              => '#B70004',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#000',
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
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333333',
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
				break;
			}
			case 10: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#3F8B43',
						'borderSize'               => 0,
						'borderColor'              => '#3F8B43',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#000',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#3F8B43',
						'borderSize'      => 0,
						'borderColor'     => '#3F8B43',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#fff',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#3F8B43',
						'borderSize'      => 0,
						'borderColor'     => '#3F8B43',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#000',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333333',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#3F8B43',
						'borderSize'      => 0,
						'borderColor'     => '#3F8B43',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 11: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#fff',
						'borderSize'               => 0,
						'borderColor'              => '#fff',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#000',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#3F8B43',
						'borderSize'      => 0,
						'borderColor'     => '#3F8B43',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#fff',
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
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333333',
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
				break;
			}
			case 12: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#fff',
						'borderSize'               => 2,
						'borderColor'              => '#3F8B43',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#000',
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
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333333',
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
				break;
			}
			case 13: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#FB6911',
						'borderSize'               => 0,
						'borderColor'              => '#FB6911',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#000',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#FB6911',
						'borderSize'      => 0,
						'borderColor'     => '#FB6911',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#fff',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#FB6911',
						'borderSize'      => 0,
						'borderColor'     => '#FB6911',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#000',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#FB6911',
						'borderSize'      => 0,
						'borderColor'     => '#FB6911',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 14: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#fff',
						'borderSize'               => 0,
						'borderColor'              => '#fff',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#000',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#FB6911',
						'borderSize'      => 0,
						'borderColor'     => '#FB6911',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#fff',
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
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333333',
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
				break;
			}
			case 15: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#fff',
						'borderSize'               => 2,
						'borderColor'              => '#FB6911',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#000',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#fff',
						'borderSize'      => 0,
						'borderColor'     => '#fff',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#fff',
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
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#000',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333333',
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
				break;
			}
			case 16: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#FFF',
						'borderSize'               => 1,
						'borderColor'              => '#000',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#333',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 0,
						'borderColor'     => '#FFF',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#858585',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#fff',
						'borderSize'      => 0,
						'borderColor'     => '#fff',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#858585',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#333',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333',
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
				break;
			}
			case 17: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#bfe5f8',
						'borderSize'               => 0,
						'borderColor'              => '#bfe5f8',
						'borderRadius'             => 20,
						'padding'                  => 10,
						'textColor'                => '#90c1cf',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#bfe5f8',
						'borderSize'      => 0,
						'borderColor'     => '#bfe5f8',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#90c1cf',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#bfe5f8',
						'borderSize'      => 0,
						'borderColor'     => '#bfe5f8',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#90c1cf',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 1,
						'borderColor'     => '#333',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#333',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#bfe5f8',
						'borderSize'      => 0,
						'borderColor'     => 'bfe5f8',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 18: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#bfe5f8',
						'borderSize'               => 0,
						'borderColor'              => '#bfe5f8',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#90c1cf',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#bfe5f8',
						'borderSize'      => 0,
						'borderColor'     => '#bfe5f8',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#90c1cf',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#bfe5f8',
						'borderSize'      => 0,
						'borderColor'     => '#bfe5f8',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#90c1cf',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 2,
						'borderColor'     => '#333',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#bfe5f8',
						'borderSize'      => 0,
						'borderColor'     => '#bfe5f8',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 19: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#f1f0ff',
						'borderSize'               => 2,
						'borderColor'              => '#ACCBE0',
						'borderRadius'             => 20,
						'padding'                  => 10,
						'textColor'                => '#38595E',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#f1f0ff',
						'borderSize'      => 0,
						'borderColor'     => '#f1f0ff',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#666666',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#f1f0ff',
						'borderSize'      => 0,
						'borderColor'     => '#f1f0ff',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#666666',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#fff',
						'borderSize'      => 2,
						'borderColor'     => '#333',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#333',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#f1f0ff',
						'borderSize'      => 0,
						'borderColor'     => '#f1f0ff',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 20: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#333333',
						'borderSize'               => 1,
						'borderColor'              => '#FFF',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#fff',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#333333',
						'borderSize'      => 0,
						'borderColor'     => '#333333',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#fff',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#333333',
						'borderSize'      => 0,
						'borderColor'     => '#333333',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#fff',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 0,
						'borderColor'     => '#FFF',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FFF',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#333333',
						'borderSize'      => 0,
						'borderColor'     => '#333333',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 21: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#333333',
						'borderSize'               => 0,
						'borderColor'              => '#333333',
						'borderRadius'             => 20,
						'padding'                  => 10,
						'textColor'                => '#FFF',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#333333',
						'borderSize'      => 0,
						'borderColor'     => '#333333',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#FFF',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#333333',
						'borderSize'      => 0,
						'borderColor'     => '#333333',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#fff',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#fff',
						'borderSize'      => 0,
						'borderColor'     => '#fff',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#000',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#333',
						'borderSize'      => 0,
						'borderColor'     => '#333',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 22: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#333333',
						'borderSize'               => 0,
						'borderColor'              => '#333333',
						'borderRadius'             => 20,
						'padding'                  => 10,
						'textColor'                => '#FFF',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#333333',
						'borderSize'      => 0,
						'borderColor'     => '#333333',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#FFF',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#333333',
						'borderSize'      => 0,
						'borderColor'     => '#333333',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#fff',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#fff',
						'borderSize'      => 0,
						'borderColor'     => '#fff',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#000',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#333',
						'borderSize'      => 0,
						'borderColor'     => '#333',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 23: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#333333',
						'borderSize'               => 0,
						'borderColor'              => '#333333',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#FFF',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#333333',
						'borderSize'      => 0,
						'borderColor'     => '#333333',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#FFF',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#333333',
						'borderSize'      => 0,
						'borderColor'     => '#333333',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#fff',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#fff',
						'borderSize'      => 0,
						'borderColor'     => '#fff',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#000',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#333',
						'borderSize'      => 0,
						'borderColor'     => '#333',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 24: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#1D2328',
						'borderSize'               => 1,
						'borderColor'              => '#FFF',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#E9E9E9',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#1D2328',
						'borderSize'      => 0,
						'borderColor'     => '#1D2328',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#E9E9E9',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#1D2328',
						'borderSize'      => 0,
						'borderColor'     => '#1D2328',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#E9E9E9',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#69C9D4',
						'borderSize'      => 0,
						'borderColor'     => '#FFF',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FFF',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#1D2328',
						'borderSize'      => 0,
						'borderColor'     => '#1D2328',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 25: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#FFF',
						'borderSize'               => 2,
						'borderColor'              => '#FB6911',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#333',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#FB6911',
						'borderSize'      => 0,
						'borderColor'     => '#FB6911',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#fff',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 0,
						'borderColor'     => '#FFF',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#333',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#fff',
						'borderSize'      => 1,
						'borderColor'     => '#333',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#000',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 0,
						'borderColor'     => '#FFF',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 26: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#FFF',
						'borderSize'               => 2,
						'borderColor'              => '#6b7552',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#333333',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#009a31',
						'borderSize'      => 0,
						'borderColor'     => '#c3e9f9',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#333333',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 0,
						'borderColor'     => '#FFF',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#333333',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 1,
						'borderColor'     => '#38595E',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#000',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 0,
						'borderColor'     => '#FFF',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 27: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#333333',
						'borderSize'               => 2,
						'borderColor'              => '#d23c3d',
						'borderRadius'             => 20,
						'padding'                  => 10,
						'textColor'                => '#FFF',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#333333',
						'borderSize'      => 0,
						'borderColor'     => '#333333',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#FFF',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#333333',
						'borderSize'      => 0,
						'borderColor'     => '#333333',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FFF',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#595959',
						'borderSize'      => 0,
						'borderColor'     => '#FFF',
						'borderRadius'    => 2,
						'padding'         => 0,
						'textColor'       => '#FFF',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#333333',
						'borderSize'      => 0,
						'borderColor'     => '#333333',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			case 28: {
				$css_array = [
					'poll'      => [
						'backgroundColor'          => '#FFF',
						'borderSize'               => 2,
						'borderColor'              => '#6b7552',
						'borderRadius'             => 0,
						'padding'                  => 10,
						'textColor'                => '#333333',
						'inputElementsBorderColor' => '#000',
					],
					'questions' => [
						'backgroundColor' => '#009a31',
						'borderSize'      => 0,
						'borderColor'     => '#c3e9f9',
						'borderRadius'    => 0,
						'padding'         => 4,
						'textColor'       => '#333333',
						'textSize'        => 'small'
					],
					'answers'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 0,
						'borderColor'     => '#FFF',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#333333',
						'textSize'        => 'small',
						'skin'            => 'minimal',
						'colorScheme'     => 'black'
					],
					'buttons'   => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 1,
						'borderColor'     => '#38595E',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#000',
						'textSize'        => 'small'
					],
					'captcha'   => [],
					'errors'    => [
						'backgroundColor' => '#FFF',
						'borderSize'      => 0,
						'borderColor'     => '#FFF',
						'borderRadius'    => 0,
						'padding'         => 0,
						'textColor'       => '#FF0000',
						'textSize'        => 'small'
					]
				];
				break;
			}
			default: {
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
				break;
			}
		}

		return $css_array;
	}

	public static function yop_ajax_import() {
		if ( false === is_user_logged_in() ) {
            wp_send_json_error( __( 'You are not allowed to perform this action', 'yop-poll' ) );
			wp_die();
		}
		if ( check_ajax_referer( 'yop-poll-ajax-importer', '_csrf_token', false ) ){
            $skip_table_check = false;
			if ( isset( $_REQUEST['enableGdpr'] ) && isset( $_REQUEST['gdprSolution'] ) ) {
				self::set_gdpr( $_REQUEST['enableGdpr'], $_REQUEST['gdprSolution'] );
			}
            switch ( $_REQUEST['table'] ) {
                case 'polls': {
                    $response = self::import_polls( self::$ajax_limit, $skip_table_check );
                    if ( -1 == $response['response_code'] )
                    {
                        $table = 'bans';
                        $response_code = 1;
                        wp_send_json_success( array( 'table' => $table, 'response_code' => $response_code, 'message' =>  $response['message'], 'skip_table_check' => false ) );
                    } else {
                        $table = 'polls';
                        $response_code = $response['response_code'];
                        wp_send_json_success( array( 'table' => $table, 'response_code' => $response_code, 'message' =>  $response['message'], 'skip_table_check' => true ) );
                    }
                    break;
                }
                case 'bans': {
                    $response = self::import_bans( $skip_table_check );
                    if ( -1 == $response['response_code'] ) {
                        $table = 'votes';
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
                        $table = 'logs';
                        $response_code = 1;
                        wp_send_json_success( array( 'table' => $table, 'response_code' => $response_code, 'message' => $response['message'], 'skip_table_check' => false ) );
                    } else {
                        $table = 'votes';
                        $response_code = $response['response_code'];
                        wp_send_json_success( array( 'table' => $table, 'response_code' => $response_code, 'message' => $response['message'], 'skip_table_check' => true ) );
                    }
                    break;
                }
                case 'logs': {
                    $response = self::import_logs( $skip_table_check );
                    if ( -1 == $response['response_code'] ) {
                        $response_code = 'done';
						delete_option( 'yop_poll_old_version' );
                        wp_send_json_success( array( 'table' => 'logs', 'response_code' => $response_code, 'message' => $response['message'] ) );
                    } else {
                        $response_code = $response['response_code'];
                        wp_send_json_success( array( 'table' => 'logs', 'response_code' => $response_code, 'message' => $response['message'], 'skip_table_check' => $skip_table_check ) );
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
