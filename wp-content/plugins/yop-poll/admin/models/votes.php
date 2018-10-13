<?php
class YOP_Poll_Votes {
	private static $errors_present = false,
			$error_text = array(),
            $votes_per_page = 10;
    private static $_instance = NULL;
    public static function get_instance() {
        if ( self::$_instance == NULL ){
            $class           = __CLASS__;
            self::$_instance = new $class;
        }
        return self::$_instance;
    }
	public static function add( $vote ) {
		$poll = YOP_Poll_Polls::get_poll( $vote->pollId );
		$vote->user->ipaddress = YOP_Poll_Votes::get_voter_ip( $poll );
		$vote->added_date = current_time( 'mysql' );
		if ( 'wordpress' == $vote->user->type ) {
			$current_user = wp_get_current_user();
			$vote->user->id = $current_user->ID;
			$vote->user->first_name = $current_user->user_firstname;
			$vote->user->last_name = $current_user->user_lastname;
			$vote->user->email = $current_user->user_email;
		}
		$vote->pollAuthor = $poll->author;
		if ( false === self::$errors_present ) {
			self::validate_data( $vote, $poll );
		}
		if ( ( false === self::$errors_present ) && ( 'yes' === $poll->meta_data['options']['poll']['enableGdpr'] ) ) {
			self::validate_gdpr( $vote, $poll );
		}
		if ( ( false === self::$errors_present ) && ( 'yes' === $poll->meta_data['options']['poll']['useCaptcha'] ) ) {
			self::validate_captcha( $vote, $poll );
		}
		if ( false === self::$errors_present ) {
			if ( 'yes' === $poll->meta_data['options']['poll']['enableGdpr']  ) {
				switch ( $poll->meta_data['options']['poll']['gdprSolution'] ) {
					case 'consent': {
						$vote->user->c_data = self::get_voter_cookie( $vote->pollId );
						if ( '' === $vote->user->c_data ) {
							$vote->user->c_data = self::generate_voter_cookie();
						}
						break;
					}
					case 'anonymize': {
						$vote->user->c_data = '';
						break;
					}
					case 'nostore': {
						$vote->user->c_data = '';
						break;
					}
				}

			} else {
				$vote->user->c_data = self::get_voter_cookie( $vote->pollId );
				if ( '' === $vote->user->c_data ) {
					$vote->user->c_data = self::generate_voter_cookie();
				}
			}
		} else {
			$vote->user->c_data = '';
		}
		if ( false === self::$errors_present ) {
			self::validate_voter_against_bans( $vote, $poll );
		}
		if ( false === self::$errors_present ) {
			self::validate_voter_against_blocks( $vote, $poll );
		}
		if ( false === self::$errors_present ) {
			self::validate_voter_against_limits( $vote, $poll );
		}
		self::create_meta_data( $vote );
		if ( false === self::$errors_present ) {
			self::record( $vote, $poll );
			if ( 'yes' === $poll->meta_data['options']['poll']['sendEmailNotifications'] ) {
				self::send_email_notification( $vote, $poll );
			}
		}
		YOP_Poll_Logs::add( $vote, self::$errors_present, self::$error_text );
		if ( false === self::$errors_present ) {
			if (
				( 'no' === $poll->meta_data['options']['poll']['enableGdpr'] ) ||
				( ( 'yes' === $poll->meta_data['options']['poll']['enableGdpr'] ) && ( 'consent' === $poll->meta_data['options']['poll']['gdprSolution'] ) )
			) {
				self::set_voter_cookie( $vote );
			}
			$response = self::generate_response( $vote );
			wp_send_json_success( $response );
		} else {
			wp_send_json_error( self::$error_text );
		}
	}
	public static function validate_data( $vote, $poll ) {
		foreach ( $poll->elements as $element ) {
			switch ( $element->etype ) {
				case 'text-question': {
					foreach ( $vote->data as $question ) {
						if ( intval( $element->id ) === intval( $question->id ) ) {
							if ( count( $question->data ) < $element->meta_data['multipleAnswersMinim'] ) {
								self::$errors_present = true;
								array_push(
									self::$error_text,
									sprintf( _n(
											'At least %s answer required',
											'At least %s answers required',
											intval( $element->meta_data['multipleAnswersMinim'] ),
											'yop-poll' ),
										$element->meta_data['multipleAnswersMinim'] )
								);
							}
							if ( count( $question->data ) > $element->meta_data['multipleAnswersMaxim'] ) {
								self::$errors_present = true;
								array_push(
									self::$error_text,
									sprintf( _n(
											'A max of %s answer accepted',
											'A max of %s answers accepted',
											intval( $element->meta_data['multipleAnswersMaxim'] ),
											'yop-poll' ),
										$element->meta_data['multipleAnswersMaxim']
									)
								);
							}
							foreach ( $question->data as $answer ) {
								if ( '' === trim( $answer->data ) ) {
									self::$errors_present = true;
									array_push(
										self::$error_text,
										__( 'Answer data is missing', 'yop-poll' )
									);
								}
							}
						}
					}
					break;
				}
				case 'media-question': {
					foreach ( $vote->data as $question ) {
						if ( intval( $element->id ) === intval( $question->id ) ) {
							if ( count( $question->data ) < $element->meta_data['multipleAnswersMinim'] ) {
								self::$errors_present = true;
								array_push(
									self::$error_text,
									sprintf( _n(
											'At least %s answer required',
											'At least %s answers required',
											$element->meta_data['multipleAnswersMinim'],
											'yop-poll' ),
										$element->meta_data['multipleAnswersMinim']
									)
								);
							}
							if ( count( $question->data ) > $element->meta_data['multipleAnswersMaxim'] ) {
								self::$errors_present = true;
								array_push(
									self::$error_text,
									sprintf( _n(
											'A max of %s answer accepted',
											'A max of %s answers accepted',
											$element->meta_data['multipleAnswersMaxim'],
											'yop-poll' ),
										$element->meta_data['multipleAnswersMaxim']
									)
								);
							}
							foreach ( $question->data as $answer ) {
								if ( '' === trim( $answer->data ) ) {
									self::$errors_present = true;
									array_push(
										self::$error_text,
										__( 'Answer data is missing', 'yop-poll' )
									);
								}
							}
						}
					}
					break;
				}
				case 'custom-field': {
					foreach ( $vote->data as $vote_element ) {
						if ( intval( $element->id ) === intval( $vote_element->id ) ) {
							if ( 'yes' === $element->meta_data['makeRequired'] ) {
								if ( '' === trim( $vote_element->data ) ) {
									self::$errors_present = true;
									array_push(
										self::$error_text,
										sprintf( __( '%s is required', 'yop-poll' ), $element->etext )
									);
								}
							}
						}
					}
					break;
				}
				default: {
					break;
				}
			}
		}
	}
	public static function validate_gdpr( $vote, $poll ) {
		if ( 'consent' === $poll->meta_data['options']['poll']['gdprSolution']) {
			if ( 'agree' !== $vote->gdprConsent ) {
				self::$errors_present = true;
				array_push(
					self::$error_text,
					__( 'You must agree to our terms and conditions', 'yop-poll' )
				);
			}
		}
	}
	public static function validate_captcha( $vote, $poll ) {
		$captcha_result = false;
		if ( 'yes' === $poll->meta_data['options']['poll']['useCaptcha'] ) {
			session_cache_limiter( false );
			if ( '' === session_id() ) {
				session_start();
			}
			$session = new \visualCaptcha\Session('visualcaptcha_' . 'yop-poll-captcha-' . $vote->pollUid );
			$captcha = new \visualCaptcha\Captcha( $session );
			if (  isset( $vote->imageCaptcha ) && ( '' !== $vote->imageCaptcha ) ) {
				$captcha_result = $captcha->validateImage( $vote->imageCaptcha );
			} elseif ( isset( $vote->audioCaptcha ) && ( '' !== $vote->audioCaptcha ) ) {
				$captcha_result = $captcha->validateAudio( $vote->audioCaptcha );
			}
			if ( false === $captcha_result ) {
				self::$errors_present = true;
				array_push(
					self::$error_text,
					__( 'Invalid security code', 'yop-poll' )
				);
			}
		}
	}
	public static function validate_voter_against_bans( $vote, $poll ) {
		$query = "SELECT * from {$GLOBALS['wpdb']->yop_poll_bans} WHERE `poll_id` IN ('0', %s) AND "
				. "(`b_by` = 'ip' AND `b_value` = %s) OR "
				. "(`b_by` = 'email' AND `b_value` = %s) OR "
				. "(`b_by` = 'username' AND `b_value` = %s)";
		$bans = $GLOBALS['wpdb']->get_var( $GLOBALS['wpdb']->prepare( $query, $vote->pollId, $vote->user->ipaddress, $vote->user->email, $vote->user->id ) );
		if ( null !== $bans ) {
			self::$errors_present = true;
			array_push(
				self::$error_text,
				__( 'Vote not allowed by ban', 'yop-poll' )
			);
		}
	}
	public static function validate_voter_against_blocks( $vote, $poll ) {
		$previous_vote = null;
		if ( true === in_array( 'by-cookie', $poll->meta_data['options']['access']['blockVoters'] ) ) {
			if ( '' !== $vote->user->c_data ) {
				$previous_vote = self::get_vote( $vote->pollId, 'voter_id', $vote->user->c_data );
			}
		}
		if ( null !== $previous_vote ) {
			switch ( $poll->meta_data['options']['access']['blockForPeriod'] ) {
				case 'minutes': {
					$block_for_period = 'PT' . $poll->meta_data['options']['access']['blockForValue'] . 'M';
					break;
				}
				case 'hours': {
					$block_for_period = 'PT' . $poll->meta_data['options']['access']['blockForValue'] . 'H';
					break;
				}
				case 'days': {
					$block_for_period = 'P' . $poll->meta_data['options']['access']['blockForValue'] . 'D';
					break;
				}
			}
			$current_vote_date = new DateTime();
			$previous_vote_date = new DateTime( $previous_vote->added_date );
			$previous_vote_date->add( new DateInterval( $block_for_period ) );
			if ( $current_vote_date < $previous_vote_date ) {
				self::$errors_present = true;
				array_push(
					self::$error_text,
					__( 'Vote not allowed by cookie value', 'yop-poll' )
				);
			}
		}
		if ( false === self::$errors_present ) {
			$previous_vote = null;
			if ( true === in_array( 'by-ip', $poll->meta_data['options']['access']['blockVoters'] ) ) {
				if ( '' !== $vote->user->ipaddress ) {
					$previous_vote = self::get_vote( $vote->pollId, 'ipaddress', $vote->user->ipaddress );
				}
			}
			if ( null !== $previous_vote ) {
				switch ( $poll->meta_data['options']['access']['blockForPeriod'] ) {
					case 'minutes': {
						$block_for_period = 'PT' . $poll->meta_data['options']['access']['blockForValue'] . 'M';
						break;
					}
					case 'hours': {
						$block_for_period = 'PT' . $poll->meta_data['options']['access']['blockForValue'] . 'H';
						break;
					}
					case 'days': {
						$block_for_period = 'P' . $poll->meta_data['options']['access']['blockForValue'] . 'D';
						break;
					}
				}
				$current_vote_date = new DateTime();
				$previous_vote_date = new DateTime( $previous_vote->added_date );
				$previous_vote_date->add( new DateInterval( $block_for_period ) );
				if ( $current_vote_date < $previous_vote_date ) {
					self::$errors_present = true;
					array_push(
						self::$error_text,
						__( 'Vote not allowed by ipaddress', 'yop-poll' )
					);
				}
			}
		}
		if ( false === self::$errors_present ) {
			$previous_vote = null;
			if ( true === in_array( 'by-user-id', $poll->meta_data['options']['access']['blockVoters'] ) ) {
				if ( '' !== $vote->user->id ) {
					$previous_vote = self::get_vote( $vote->pollId, 'user_id', $vote->user->id );
				}
			}
			if ( null !== $previous_vote ) {
				switch ( $poll->meta_data['options']['access']['blockForPeriod'] ) {
					case 'minutes': {
						$block_for_period = 'PT' . $poll->meta_data['options']['access']['blockForValue'] . 'M';
						break;
					}
					case 'hours': {
						$block_for_period = 'PT' . $poll->meta_data['options']['access']['blockForValue'] . 'H';
						break;
					}
					case 'days': {
						$block_for_period = 'P' . $poll->meta_data['options']['access']['blockForValue'] . 'D';
						break;
					}
				}
				$current_vote_date = new DateTime();
				$previous_vote_date = new DateTime( $previous_vote->added_date );
				$previous_vote_date->add( new DateInterval( $block_for_period ) );
				if ( $current_vote_date < $previous_vote_date ) {
					self::$errors_present = true;
					array_push(
						self::$error_text,
						__( 'Vote not allowed by user id', 'yop-poll' )
					);
				}
			}
		}
		return self::$errors_present;
	}
	public static function validate_voter_against_limits( $vote, $poll ) {
		$search_by = '';
		$search_value = '';
		$votes = 0;
		if ( 'yes' === $poll->meta_data['options']['access']['limitVotesPerUser'] ) {
			switch ( $vote->user->type ) {
				case 'wordpress': {
					$search_by = 'user_id';
					$search_value = $vote->user->id;
					break;
				}
				case 'facebook': {
					$search_by = 'user_email';
					$search_value = $vote->user->email;
					break;
				}
				case 'google': {
					$search_by = 'user_email';
					$search_value = $vote->user->email;
				}
			}
			if ( '' !== $search_by ) {
				$votes = self::get_votes_for_user( $vote->pollId, $search_by, $search_value );
				if ( intval( $votes) >= intval( $poll->meta_data['options']['access']['votesPerUserAllowed'] ) ) {
					self::$errors_present = true;
					array_push(
						self::$error_text,
						__( 'Limit for allowed votes reached', 'yop-poll' )
					);
				}
			}
		}
	}
	public static function get_vote( $pollId, $field, $data ) {
		$vote = null;
		$query = '';
		switch ( $field ) {
			case 'voter_id': {
				$query = "SELECT * FROM {$GLOBALS['wpdb']->yop_poll_votes} WHERE `poll_id` = %d AND `voter_id` = %s ORDER BY `added_date` DESC LIMIT 1";
				break;
			}
			case 'ipaddress': {
				$query = "SELECT * FROM {$GLOBALS['wpdb']->yop_poll_votes} WHERE `poll_id` = %d AND  `ipaddress` = %s ORDER BY `added_date` DESC LIMIT 1";
				break;
			}
		}
		if ( '' !== $query ) {
			$vote = $GLOBALS['wpdb']->get_row( $GLOBALS['wpdb']->prepare( $query, $pollId, $data ) );
		}
		return $vote;
	}
	public static function get_votes_for_user( $poll, $field, $data ) {
		$votes = 0;
		$query = '';
		switch ( $field ) {
			case 'user_id': {
				$query = "SELECT COUNT(*) FROM {$GLOBALS['wpdb']->yop_poll_votes} WHERE `poll_id` = %s AND `user_id` = %s";
				break;
			}
			case 'user_email': {
				$query = "SELECT COUNT(*) FROM {$GLOBALS['wpdb']->yop_poll_votes} WHERE `poll_id` = %s AND `user_email` = %s";
				break;
			}
			default: {
				break;
			}
		}
		if ( '' !== $query ) {
			$votes = $GLOBALS['wpdb']->get_var( $GLOBALS['wpdb']->prepare( $query, $poll, $data ) );
		}
		return $votes;
	}
	public static function create_meta_data( $vote ) {
		$vote_elements = array();
		foreach ( $vote->data as $element ) {
			$element_data = array();
			switch ( $element->type ) {
				case 'question': {
					foreach ( $element->data as $data ) {
						array_push(
							$element_data,
							array(
								'id' => $data->id,
								'data' => $data->data
							)
						);
					}
					break;
				}
				case 'custom-field': {
					array_push(
						$element_data,
						$element->data
					);
					break;
				}
				default: {
					break;
				}
			}
			array_push(
				$vote_elements,
				array(
					'id' => $element->id,
					'type' => $element->type,
					'data' => $element_data
				)
			);
		}
		return array(
			'elements' => $vote_elements,
			'user' => array(
				'first_name' => $vote->user->first_name,
				'last_name' => $vote->user->last_name
			)
		);
	}
	public static function get_voter_ip( $poll ) {
		$voter_ip = '';
		$should_continue = false;
		if ( 'yes' === $poll->meta_data['options']['poll']['enableGdpr'] ) {
			switch ( $poll->meta_data['options']['poll']['gdprSolution'] ) {
				case 'consent': {
					$should_continue = true;
					break;
				}
				case 'anonymize': {
					$should_continue = true;
					break;
				}
				case 'nostore': {
					$should_continue = false;
					break;
				}
			}
		} else {
			$should_continue = true;
		}
		if ( true === $should_continue ) {
			if ( true === function_exists( 'apache_request_headers' ) ) {
				$headers = apache_request_headers();
			} else {
				$headers = $_SERVER;
			}
			if (
				 ( true === array_key_exists( 'X-Forwarded-For', $headers ) ) &&
				 filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP )
			) {
				$voter_ip = $headers['X-Forwarded-For'];
			} elseif (
				( true === array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) ) &&
				filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP )
			) {
				$voter_ip = $headers['HTTP_X_FORWARDED_FOR'];
			} else {
				$voter_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP );
			}
			if ( 'anonymize' == $poll->meta_data['options']['poll']['gdprSolution'] ) {
				$voter_ip = Helper::anonymize_ip( $voter_ip );
			}
		}
		return $voter_ip;
	}
	public static function get_voter_cookie( $poll_id ) {
		$voter_cookie = '';
		if ( isset( $_COOKIE['ypdt'] ) && ( '' !== $_COOKIE['ypdt'] ) ) {
			$voter_cookie = $_COOKIE['ypdt'];
		}
		return $voter_cookie;
	}
	public static function generate_voter_cookie() {
		return md5( time() . mt_rand( 1, 1000000 ) );
	}
	public static function set_voter_cookie( $vote ) {
		setcookie( 'ypdt', $vote->user->c_data, time() + 60 * 60 * 24 * 365, COOKIEPATH, COOKIE_DOMAIN );
	}
	public static function record( $vote, $poll ) {
		$vote_total_answers = 0;
		$data = array(
			'poll_id' => $vote->pollId,
			'user_id' => $vote->user->id,
			'user_email' => $vote->user->email,
			'user_type' => $vote->user->type,
			'ipaddress' => $vote->user->ipaddress,
			'tracking_id' => $vote->trackingId,
			'voter_id' => $vote->user->c_data,
			'voter_fingerprint' => $vote->user->f_data,
			'vote_data' => serialize( self::create_meta_data( $vote ) ),
			'status' => 'active',
			'added_date' => $vote->added_date
		);
		$GLOBALS['wpdb']->insert( $GLOBALS['wpdb']->yop_poll_votes, $data );
		foreach ( $vote->data as $vote_element ) {
			if ( 'question' === $vote_element->type ) {
				foreach ( $vote_element->data as $vote_subelement ) {
					if ( '0' !== strval( $vote_subelement->id ) ) {
						YOP_Poll_SubElements::add_vote( $vote_subelement->id );
					} else {
						foreach ( $poll->elements as $poll_element ) {
							if ( $vote_element->id === $poll_element->id) {
								if ( 'yes' === $poll_element->meta_data['addOtherAnswers'] ) {
									$sub_element_exists = YOP_Poll_SubElements::exists(
										$vote->pollId,
										$poll_element->id,
										$vote_subelement->data
									);
									if ( true === $sub_element_exists['status'] ) {
										YOP_Poll_SubElements::add_vote( $sub_element_exists['id'] );
									} else {
										$meta_data = new StdClass();
										$meta_data->options = new StdClass();
										$meta_data->options->type = 'text';
										$meta_data->options->makeDefault = 'no';
										$meta_data->options->makeLink = 'no';
										$meta_data->options->link = '';

										$sub_element_data = new StdClass();
										$sub_element_data->poll_id = $vote->pollId;
										$sub_element_data->element_id = $poll_element->id;
										$sub_element_data->stext = $vote_subelement->data;
										$sub_element_data->author = '0';
										$sub_element_data->type = 'text';
										$sub_element_data->status = 'active';
										$sub_element_data->sorder = '0';
										$sub_element_data->total_submits = 1;
										$sub_element_data->options = new StdClass();
										$sub_element_data->options->type = 'text';
										$sub_element_data->options->makeDefault = 'no';
										$sub_element_data->options->makeLink = 'no';
										$sub_element_data->options->link = '';
										$sub_element_data->options->resultsColor = '#000000';
										YOP_Poll_SubElements::add_single( $sub_element_data );
									}
								}
							}
						}
					}
					$vote_total_answers += count( $vote_element->data );
				}
			}
		}
		YOP_Poll_Polls::add_vote( $vote->pollId, $vote_total_answers );
	}
	public static function generate_response( $vote ) {
		$response = array();
		$poll_results = '';
		$poll = YOP_Poll_Polls::get_poll( $vote->pollId );
		if ( true === YOP_Poll_Polls::is_show_results_after_vote( $poll ) ) {
			$show_results = true;
			$poll_results = YOP_Poll_Polls::generate_results_after_vote( $poll );
		} else {
			$show_results = false;
		}
		if ( 'yes' === $poll->meta_data['options']['poll']['redirectAfterVote'] ) {
			$redirect_to = $poll->meta_data['options']['poll']['redirectUrl'];
			$redirect_after = '2';
		} else {
			$redirect_to = '';
			$redirect_after = '';
		}
		if ( 'yes' === $poll->meta_data['options']['results']['backToVoteOption'] ) {
			$show_back_text = $poll->meta_data['options']['results']['backToVoteCaption'];
		} else {
			$show_back_text = '';
		}
		if ( 'yes' === $poll->meta_data['options']['poll']['showTotalVotes'] ) {
			$total_votes = $poll->total_submits;
		} else {
			$total_votes = '';
		}
		if ( 'yes' === $poll->meta_data['options']['poll']['showTotalAnswers'] ) {
			$total_answers = $poll->total_submited_answers;
		} else {
			$total_answers = '';
		}
		$rebuild_elements = false;
		$elements_code = array();
		foreach ( $poll->elements as $element ) {
			if ( true === in_array( $element->etype, array( 'text-question', 'media-question' ) ) ) {
				if ( ( 'yes' === $element->meta_data['allowOtherAnswers'] ) && ( 'yes' === $element->meta_data['addOtherAnswers'] ) ) {
					$rebuild_elements = true;
					switch ( $element->etype ) {
						case 'text-question': {
							$element_html = YOP_Poll_Basic::do_text_question( $element, $poll->meta_data, array() );
							break;
						}
						case 'media-question': {
							$element_html = YOP_Poll_Basic::do_media_question( $element, $poll->meta_data, array() );
							break;
						}
					}
					$elements_code[] = array(
						'id' => $element->id,
						'code' => $element_html
					);
				}
			}
		}
		$response = array(
			'poll_id' => $vote->pollId,
			'show_results' => $show_results,
			'redirect' => $poll->meta_data['options']['poll']['redirectAfterVote'],
			'redirect_to' => $redirect_to,
			'redirect_after' => $redirect_after,
			'total_votes' => $total_votes,
			'total_answers' => $total_answers,
			'rebuild' => $rebuild_elements,
			'elements' => json_encode( $elements_code ),
			'results' => json_encode( $poll_results )
		);
		return $response;
	}
	public static function get_content_between_tags( $content, $start, $end ) {
	    $r = explode( $start, $content );
	    if ( isset( $r[1] ) ) {
	        $r = explode( $end, $r[1] );
	        return $r[0];
	    }
	    return '';
	}
	public static function prepare_for_mail( $vote, $poll ) {
		$result_data = array();
		foreach( $vote->data as $vote_element ) {
			foreach( $poll->elements as $poll_element ) {
				if ( $vote_element->id === $poll_element->id ) {
					switch( $vote_element->type ) {
						case 'custom-field': {
							$result_data['custom-fields'][] = array(
																'text' => $poll_element->etext,
																'answer' => $vote_element->data
															);
							break;
						}
						case 'question': {
							$answers = array();
							foreach( $vote_element->data as $vote_answer ) {
								if ( 0 === $vote_answer->id ) {
									$answers[] = 'Other: ' . $vote_answer->data;
								} else {
									foreach( $poll_element->answers as $poll_answer ) {
										if ( $vote_answer->id === $poll_answer->id ) {
											$answers[] = $poll_answer->stext;
										}
									}
								}
							}
							$result_data['questions'][] = array(
															'text' => $poll_element->etext,
															'answers' => $answers
							);
							break;
						}
					}
				}
			}
		}
		return $result_data;
	}
	public static function send_email_notification( $vote, $poll ) {
		$email_to = $poll->meta_data['options']['poll']['emailNotificationsTo'];
		$email_subject = $poll->meta_data['options']['poll']['emailNotificationsSubject'];
		$email_body = $poll->meta_data['options']['poll']['emailNotificationsMessage'];
		$email_headers = array (
			'From: ' . $poll->meta_data['options']['poll']['emailNotificationsFromName'] . '<' . $poll->meta_data['options']['poll']['emailNotificationsFromEmail'] . '>'
		);
		$email_body = str_replace( '%VOTE_DATE%', date_i18n( get_option( 'date_format' ), strtotime( $vote->added_date ) ), $email_body);
		$email_body = str_replace( '%POLL_NAME%', $poll->name, $email_body );
		$questions_tag = self::get_content_between_tags( $email_body, '[QUESTION]', '[/QUESTION]' );
		$custom_fields_tag = self::get_content_between_tags( $email_body, '[CUSTOM_FIELDS]', '[/CUSTOM_FIELDS]' );
		$questions_block = '';
		$custom_fields_block = '';
		$vote_results = self::prepare_for_mail( $vote, $poll );
		foreach( $vote_results['questions'] as $question_result ) {
			$question_block = str_replace( '%QUESTION_TEXT%', $question_result['text'], $questions_tag );
			$question_block = str_replace( '%ANSWER_VALUE%', implode( '\n', $question_result['answers'] ), $question_block );
			$questions_block .= $question_block;
		}
		foreach( $vote_results['custom-fields'] as $custom_field_result ) {
			$custom_field_block = str_replace( '%CUSTOM_FIELD_NAME%', $custom_field_result['text'], $custom_fields_tag );
			$custom_field_block = str_replace( '%CUSTOM_FIELD_VALUE%', $custom_field_result['answer'], $custom_field_block );
			$custom_fields_block .= $custom_field_block;
		}
		$questions_block = str_replace(
			array(
				'[QUESTION]',
				'[/QUESTION]',
				'[ANSWERS]',
				'[/ANSWERS]'
			),
			array(
				'',
				'',
				'',
				'',
			),
			$questions_block
		);
		$email_body = str_replace( $questions_tag, $questions_block, $email_body );
		$email_body = str_replace( $custom_fields_tag, $custom_fields_block, $email_body );
		$email_body = str_replace(
			array(
				'[QUESTION]',
				'[/QUESTION]',
				'[ANSWERS]',
				'[/ANSWERS]',
				'[CUSTOM_FIELDS]',
				'[/CUSTOM_FIELDS]'
			),
			array(
				'',
				'',
				'',
				'',
			),
			$email_body
		);
		//$email_body = str_replace( $custom_fields_tag, $custom_fields_block, $email_body );
		//wp_mail( $email_to, $email_subject, $email_body, $email_headers );
	}
	public static function get_vote_by_poll ( $poll_id, $limit, $offset ) {
        $query = "SELECT * FROM {$GLOBALS['wpdb']->yop_poll_votes} WHERE `poll_id` = %d AND `status` = 'active' ORDER BY `added_date` ASC LIMIT %d OFFSET %d";
        $votes = $GLOBALS['wpdb']->get_results( $GLOBALS['wpdb']->prepare( $query, $poll_id, $limit, $offset ) );
        return $votes;
    }
    public static function get_total_votes_by_poll ( $poll_id ) {
	    $query = $query = "SELECT COUNT(*) FROM {$GLOBALS['wpdb']->yop_poll_votes} WHERE `poll_id` = %d AND `status` = 'active'";
        $votes_no = $GLOBALS['wpdb']->get_var( $GLOBALS['wpdb']->prepare( $query, $poll_id ) );
        return $votes_no;
    }
    public static function get_poll_voters_sorted( $poll_id ) {
        $query = "SELECT `user_type`, count(`user_type`) AS cnt FROM {$GLOBALS['wpdb']->yop_poll_votes} WHERE `poll_id` = %d AND `status` = 'active' GROUP BY `user_type` ORDER BY cnt DESC";
        $voters = $GLOBALS['wpdb']->get_results( $GLOBALS['wpdb']->prepare( $query, $poll_id ) );
        return $voters;
    }
    public static function get_votes_to_display ( $params ) {
        if ( 0 >= intval( $params['page_no'] ) ) {
            $params['page_no'] = 1;
        }
        $pagination = self::paginate( $params );
        if ( $params['page_no'] > $pagination['total_pages']) {
            $params['page_no'] = 1;
        }
        if ( isset( $params['sort_order'] ) && '' !== $params['sort_order'] ) {
            $sort_order = $params['sort_order'];
        } else{
            $sort_order = 'ASC';
        }
        if ( isset( $params['order_by'] ) && '' !== $params['order_by'] ) {
            $order_by = $params['order_by'];
        } else {
            $order_by = 'added_date';
        }
        $order_query = " ORDER BY `{$order_by}` {$sort_order}";
        $limit = self::$votes_per_page * ( $params['page_no'] - 1 );
        $limit_query = " LIMIT {$limit}, ". self::$votes_per_page;
        $query = '';
        $votes = [];
        if ( current_user_can( 'yop_poll_results_others' ) ) {
            $query = "SELECT * FROM {$GLOBALS['wpdb']->yop_poll_votes} WHERE `poll_id` = %d AND `status` = 'active'";
        } else if ( current_user_can( 'yop_poll_results_own' ) ) {
			$current_user = wp_get_current_user();
            $query = "SELECT * FROM {$GLOBALS['wpdb']->yop_poll_votes} WHERE `user_id` = '" . $current_user->ID . "' AND `poll_id` = %d AND `status` = 'active'";
        }
        if ( '' !== $query ) {
            $query .= $order_query;
            $query .= $limit_query;
            $votes = $GLOBALS['wpdb']->get_results( $GLOBALS['wpdb']->prepare( $query, array( $params['poll_id'] ) ) );
        }
        return array(
            'votes' => $votes,
            'total_votes' => $pagination['total_votes'],
            'total_pages' => $pagination['total_pages'],
            'pagination' => $pagination['pagination']
        );
    }
    public static function paginate( $params ) {
        $return_data = array();
        $total_pages = 0;
        $total_votes = 0;
        $query = '';
        if ( current_user_can( 'yop_poll_results_others' ) ) {
            $query = "SELECT COUNT(*) FROM {$GLOBALS['wpdb']->yop_poll_votes} WHERE `poll_id` = %d AND `status` = 'active'";
        } else if ( current_user_can( 'yop_poll_results_own' ) ) {
			$current_user = wp_get_current_user();
            $query = "SELECT COUNT(*) FROM {$GLOBALS['wpdb']->yop_poll_votes} WHERE `user_id` = '" . $current_user->ID . "' and `poll_id` = %d AND `status` = 'active'";
        }
        if ( '' !== $query ) {
            $total_votes = $GLOBALS['wpdb']->get_var( $GLOBALS['wpdb']->prepare( $query, array( $params['poll_id'] ) ) );
        }
        if ( $total_votes > 0 ) {
            if ( self::$votes_per_page >= $total_votes ) {
                $data['pagination'] = '';
                $page = 1;
                $total_pages = 1;
            } else {
                $total_pages = intval( ceil( $total_votes / self::$votes_per_page ) );
            }
        } else {
            $data['pagination'] = '';
        }
        if ( 1 < $total_pages ){
            $pagination['first_page'] = '<span class="tablenav-pages-navspan" aria-hidden="true">
							«
						  </span>';
            $pagination['previous_page'] = '<span class="screen-reader-text">
								' . __( 'Previous page', 'yop-poll' ) . '
							</span>
							<span class="tablenav-pages-navspan" aria-hidden="true">
								‹
							</span>';
            $pagination['next_page'] = '<span class="screen-reader-text">' . __( 'Next page', 'yop-poll' ) . '
							</span>
							<span aria-hidden="true">›</span>';
            $pagination['last_page'] = '<span class="tablenav-pages-navspan" aria-hidden="true">
							»
							</span>';
            if ( 1 === intval( $params['page_no'] ) ) {
                //we're on the first page.
                $links['next_page'] = esc_url(
                    add_query_arg(
                        array(
                            'action' => $params['action'],
                            'poll_id' => $params['poll_id'],
                            '_token' => false,
                            'order_by' => $params['order_by'],
                            'sort_order' => $params['sort_order'],
                            'q' => false,
                            'page_no' => $params['page_no']+1
                        )
                    )
                );
                $pagination['next_page'] = "<a
										class=\"next-page\"
										href=\"{$links['next_page']}\">{$pagination['next_page']}</a>";
                if ( 2 < intval( $total_pages ) ) {
                    $links['last_page'] = esc_url(
                        add_query_arg(
                            array(
                                'action' => $params['action'],
                                'poll_id' => $params['poll_id'],
                                '_token' => false,
                                'order_by' => $params['order_by'],
                                'sort_order' => $params['sort_order'],
                                'q' => false,
                                'page_no' => intval( $total_pages )
                            )
                        )
                    );
                    $pagination['last_page'] = "<a
												class=\"last-page\"
												href=\"{$links['last_page']}\">{$pagination['last_page']}</a>";
                }
            } else if ( intval( $params['page_no'] ) === intval( $total_pages ) ) {
                //we're on the last page
                $links['previous_page'] = esc_url(
                    add_query_arg(
                        array(
                            'action' => $params['action'],
                            'poll_id' => $params['poll_id'],
                            '_token' => false,
                            'order_by' => $params['order_by'],
                            'sort_order' => $params['sort_order'],
                            'q' => false,
                            'page_no' => $params['page_no']-1
                        )
                    )
                );
                $pagination['previous_page'] = "<a
											class=\"prev-page\"
											href=\"{$links['previous_page']}\">{$pagination['previous_page']}</a>";
                if ( 2 < intval( $total_pages ) ) {
                    $links['first_page'] = esc_url(
                        add_query_arg(
                            array(
                                'action' => $params['action'],
                                'poll_id' => $params['poll_id'],
                                '_token' => false,
                                'order_by' => $params['order_by'],
                                'sort_order' => $params['sort_order'],
                                'q' => false,
                                'page_no' => 1
                            )
                        )
                    );
                    $pagination['first_page'] = "<a
												class=\"first-page\"
												href=\"{$links['first_page']}\">{$pagination['first_page']}</a>";
                }
            } else {
                //we're on an intermediary page
                $links['previous_page'] = esc_url(
                    add_query_arg(
                        array(
                            'action' => $params['action'],
                            'poll_id' => $params['poll_id'],
                            '_token' => false,
                            'order_by' => $params['order_by'],
                            'sort_order' => $params['sort_order'],
                            'q' => false,
                            'page_no' => $params['page_no']-1
                        )
                    )
                );
                $links['next_page'] = esc_url(
                    add_query_arg(
                        array(
                            'action' => $params['action'],
                            'poll_id' => $params['poll_id'],
                            '_token' => false,
                            'order_by' => $params['order_by'],
                            'sort_order' => $params['sort_order'],
                            'q' => false,
                            'page_no' => $params['page_no']+1
                        )
                    )
                );
                $pagination['previous_page'] = "<a
											class=\"prev-page\"
											href=\"{$links['previous_page']}\">{$pagination['previous_page']}</a>";
                $pagination['next_page'] = "<a
											class=\"prev-page\"
											href=\"{$links['next_page']}\">{$pagination['next_page']}</a>";
                if ( 2 < intval( $params['page_no'] ) ) {
                    $links['first_page'] = esc_url(
                        add_query_arg(
                            array(
                                'action' => $params['action'],
                                'poll_id' => $params['poll_id'],
                                '_token' => false,
                                'order_by' => false,
                                'sort_order' => false,
                                'q' => false,
                                'page_no' => 1
                            )
                        )
                    );
                    $pagination['first_page'] = "<a
												class=\"first-page\"
												href=\"{$links['first_page']}\">{$pagination['first_page']}</a>";
                }
                if ( ( intval( $params['page_no'] + 2 ) ) <= $total_pages ) {
                    $links['last_page'] = esc_url(
                        add_query_arg(
                            array(
                                'action' => $params['action'],
                                'poll_id' => $params['poll_id'],
                                '_token' => false,
                                'order_by' => false,
                                'sort_order' => false,
                                'q' => false,
                                'page_no' => intval( $total_pages )
                            )
                        )
                    );
                    $pagination['last_page'] = "<a
												class=\"last-page\"
												href=\"{$links['last_page']}\">{$pagination['last_page']}</a>";
                }
            }
        } else {
            $pagination['first_page'] = '';
            $pagination['previous_page'] = '';
            $pagination['next_page'] = '';
            $pagination['last_page'] = '';
        }
        return array(
            'total_votes' => $total_votes,
            'total_pages' => $total_pages,
            'pagination' => $pagination
        );
    }
    public static function get_vote_details ( $vote_id ) {
        $query = $GLOBALS['wpdb']->prepare(
            "SELECT * FROM {$GLOBALS['wpdb']->yop_poll_votes} WHERE `id` = %d", $vote_id
        );
        $vote= $GLOBALS['wpdb']->get_row( $query, OBJECT );
        if( null !== $vote ){
            $vote_data = unserialize($vote->vote_data);
            if ( count($vote_data) > 0 ) {
                if ( isset( $vote_data['elements'] ) ) {
                    $vote_elements = $vote_data['elements'];
                    $questions          = [];
                    $questions_ids      = [];
                    $answers_ids        = [];
                    $questions_results  = [];
                    $answers_results    = [];
                    if ( count( $vote_elements ) > 0 ) {
                        foreach ( $vote_elements as $ve ) {
                            $qanswers = [];
                            if ( isset ( $ve['id'] ) ) {
                                $questions_ids[] = $ve['id'];
                            }
                            if ( isset( $ve['data'] ) ) {
                                foreach ( $ve['data'] as $vdata ) {
                                    if ( isset( $vdata['id'] ) ) {
                                        if( 0 !== $vdata['id'] ) {
                                            $answers_ids[] = $vdata['id'];
                                        }
                                    }
                                }
                            }
                        }
                        if ( count( $questions_ids ) > 0 ) {
                            $questions_ids_string = '('. implode( ',', $questions_ids ) .')';
                            $questions_query = "SELECT * from {$GLOBALS['wpdb']->yop_poll_elements} where `id` in $questions_ids_string";
                            $questions_results = $GLOBALS['wpdb']->get_results( $questions_query, OBJECT );
                        }
                        if ( count( $answers_ids ) > 0 ) {
                            $answers_ids_string = '('. implode( ',', $answers_ids ) .')';
                            $answers_query = "SELECT * from {$GLOBALS['wpdb']->yop_poll_subelements} where `id` in $answers_ids_string";
                            $answers_results = $GLOBALS['wpdb']->get_results( $answers_query, OBJECT );
                        }
                        foreach ( $vote_elements as $ve ) {
                            $pqa = [ 'question' => '', 'answers' => [] ];
                            switch ( $ve['type'] ) {
                                case 'question': {
                                    if ( isset ( $ve['id'] ) )  {
                                        foreach ( $questions_results as $qres ) {
                                            if ( $ve['id'] == $qres->id ) {
                                                $pqa['question'] = $qres->etext;
                                            }
                                        }
                                    }
                                    if ( isset( $ve['data'] ) ) {
                                        foreach ( $ve['data'] as $vdata ) {
                                            if ( 0 === $vdata['id'] ) {
                                                $pqa['answers'][] = [ 'answer_text' => 'other', 'answer_value' => $vdata['data'] ];
                                            } else {
                                                foreach ( $answers_results as $ares ) {
                                                    if ( $vdata['id'] == $ares->id ) {
                                                        $pqa['answers'][] = [ 'answer_text' => '', 'answer_value' => $ares->stext ];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    $questions[] = $pqa;
                                    break;
                                }
                                case 'custom-field': {
                                    if ( isset ( $ve['id'] ) ) {
                                        foreach ( $questions_results as $qres ) {
                                            if ( $ve['id'] == $qres->id ) {
                                                $pqa['question'] = 'custom-field';
                                                $pqa['caption'] = $qres->etext;
                                            }
                                        }
                                    }
                                    if ( isset($ve['data'] ) ) {
                                        $pqa['answers'][] = [ 'answer_text' => 'custom-field', 'answer_value' => $ve['data'][0] ];
                                    }
                                    $questions[] = $pqa;
                                    break;
                                }
                            }
                        }
                        return $questions;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
    public static function send_votes_to_download (  ) {
        $date_format = get_option( 'date_format' );
        $time_format = get_option( 'time_format' );
        if ( isset( $_REQUEST['poll_id'] ) && ( isset( $_REQUEST['doExport'] ) || isset( $_REQUEST['exportCustoms'] ) ) ) {
            $votes = self::get_export_votes( $_REQUEST['poll_id'] );
            $votes_for_csv  = [];
            $customs_data   = [];
            if ( count( $votes ) > 0 ){
                $x = 0;
                foreach ( $votes as $vote ) {
                    $vote_details = self::get_vote_details( $vote['id'] );
                    $details_string = '';
                    foreach ( $vote_details as $res ) {
                        if ( 'custom-field' === $res['question']) {
                            $details_string .= __( 'Custom Field', 'yop-poll' ) . ': ' . addslashes( $res['caption'] ) . ';';
                            $details_string .= __( 'Answer', 'yop-poll' ) . ': '. addslashes( $res['answers'][0]['answer_value'] ) . ';';
                            $customs_data[$x]['headers'][] = $res['caption'];
                            $customs_data[$x]['data'][] = addslashes( $res['answers'][0]['answer_value'] ) ;
                        } else {
                            $details_string .= __( 'Question', 'yop-poll' ). ': ' . addslashes( $res['question'] ) .';';
                            foreach ( $res['answers'] as $ra ) {
                                $details_string .= __( 'Answer', 'yop-poll' ) . ': ' . addslashes( $ra['answer_value'] ) . ';';
                            }
                        }
                    }
                    $vote_data = [
                        stripslashes( $vote ['name'] ),
                        esc_html( stripslashes( $vote['user_id'] ) ),
                        stripslashes( $vote ['user_email'] ),
                        stripslashes( $vote ['user_type'] ),
                        stripslashes( $vote ['ipaddress'] ),
                        esc_html( date( $date_format . ' @ ' . $time_format, strtotime( $vote['added_date'] ) ) ),
                        stripslashes( $details_string )
                    ];
                    $votes_for_csv[] = $vote_data;
                    $x++;
                }
            }
            if ( isset ( $_REQUEST ['doExport'] ) && 'true' === $_REQUEST['doExport'] ) {
                header( "Content-Type: text/csv" );
                header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
                header( "Content-Transfer-Encoding: binary\n" );
                header( 'Content-Transfer-Encoding: binary' );
                header( 'Connection: Keep-Alive' );
                header( 'Expires: 0' );
                ob_start();
                $f = fopen( 'php://output', 'w' ) or show_error( __( "Can't open php://output!", 'yop_poll' ) );
                $csv_file_name    = 'votes_export.' . date( 'YmdHis' ) . '.csv';
                header( 'Content-Disposition: attachment; filename="' . $csv_file_name . '"' );
                $csv_header_array = [
                    __( 'Poll Name', 'yop_poll' ),
                    __( 'Username', 'yop_poll' ),
                    __( 'Email', 'yop_poll' ),
                    __( 'User Type', 'yop_poll' ),
                    __( 'IP', 'yop_poll' ),
                    __( 'Date', 'yop_poll' ),
                    __( 'Vote data', 'yop-poll' )
                ];
                if ( !Helper::yop_fputcsv( $f, $csv_header_array ) ) _e( "Can't write header!", 'yop_poll' );
                if ( count( $votes_for_csv ) > 0 ) {
                    foreach ( $votes_for_csv as $vote_data ) {
                        if ( !Helper::yop_fputcsv( $f, $vote_data, ',', '"' ) ) _e( "Can't write votes!", 'yop_poll' );
                    }
                }
                fclose( $f ) or show_error( __( "Can't close php://output!", 'yop_poll' ) );
                $csvStr = ob_get_contents();
                ob_end_clean();
                echo $csvStr;
                exit ();
            }
            if ( isset ( $_REQUEST ['exportCustoms'] ) && 'true' === $_REQUEST['exportCustoms'] ) {
                header( "Content-Type: text/csv" );
                header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
                header( "Content-Transfer-Encoding: binary\n" );
                header( 'Content-Transfer-Encoding: binary' );
                header( 'Connection: Keep-Alive' );
                header( 'Expires: 0' );
                ob_start();
                $customs_sorted_array = [];
                foreach ($customs_data as $cd) {
                    foreach ( $cd as $key => $value ) {
                        $customs_sorted_array[$key][] = $value;
                    }
                }
                $f = fopen( 'php://output', 'w' ) or show_error( __( "Can't open php://output!", 'yop_poll' ) );
                $count_customs = count( $customs_data );
                if ( $count_customs > 0 ) {
                    $csv_file_name    = 'customs_export.' . date( 'YmdHis' ) . '.csv';
                    header( 'Content-Disposition: attachment; filename="' . $csv_file_name . '"' );
                    $customs_data_keys = array_keys( $customs_data );
                    if ( !Helper::yop_fputcsv( $f, $customs_data[$customs_data_keys[0]]['headers'] ) ) _e( "Can't write header!", 'yop_poll' );
                    foreach ( $customs_data as $ch ) {
                        if ( !Helper::yop_fputcsv( $f, $ch['data'], ',', '"' ) ) _e( "Can't write votes!", 'yop_poll' );
                    }
                    fclose( $f ) or show_error( __( "Can't close php://output!", 'yop_poll' ) );
                }
                $csvStr = ob_get_contents();
                ob_end_clean();
                echo $csvStr;
                exit ();
            }
        }
    }
    public static function get_export_votes( $poll_id ) {
        $query = '';
        $votes = '';
        if ( current_user_can( 'yop_poll_results_own' ) ) {
            $query = "SELECT votes.*, polls.`name` FROM {$GLOBALS['wpdb']->yop_poll_votes}"
                . " as votes LEFT JOIN {$GLOBALS['wpdb']->yop_poll_polls} as polls"
                . " ON votes.`poll_id` = polls.`id` where votes.`poll_id`= %d and votes.`status` = 'active'";
        }
        if ( '' !== $query ) {
            $votes = $GLOBALS['wpdb']->get_results( $GLOBALS['wpdb']->prepare( $query, array( $poll_id ) ), ARRAY_A );
            foreach ( $votes as $key => $row ) {
                if( 'wordpress' === $row['user_type'] ) {
                    $vote_user_obj = get_user_by('id', $row['user_id'] );
                    if( $vote_user_obj ) {
                        $votes[$key]['user_id'] = $vote_user_obj->user_login;
                    } else{
                        $votes[$key]['user_id'] = '';
                    }
                } else {
                    $votes[$key]['user_id'] = '';
                }
                $votes[$key]['vote_data'] = $row['vote_data'];
            }
        }
        return  $votes;
    }
	public static function delete_votes_for_poll( $poll_id ) {
		$query = $GLOBALS['wpdb']->prepare(
			"UPDATE {$GLOBALS['wpdb']->yop_poll_votes} SET `status` = 'deleted' WHERE `poll_id` = %s", $poll_id
		);
		$GLOBALS['wpdb']->query( $query );
	}
}
