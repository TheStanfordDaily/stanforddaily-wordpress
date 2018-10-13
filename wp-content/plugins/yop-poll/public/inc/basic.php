<?php
class YOP_Poll_Basic {
	public static function search_array($value, $key, $array) {
		foreach ( $array as $k => $val ) {
			if ( $val[$key] == $value ) {
				return $val;
			}
		}
		return null;
	}
	public static function generate_uid() {
		return md5( uniqid( rand(), true ) );
	}
	public static function is_allow_multiple_answers( $setting ) {
		$answers_type = '';
		if ( 'yes' === $setting ) {
			$answers_type = 'checkbox';
		} else {
			$answers_type = 'radio';
		}
		return $answers_type;
	}
	public static function is_answer_default( $setting) {
		$answer_selected = '';
		if ( 'yes' === $setting ) {
			$answer_selected = 'checked';
		} else {
			$answer_selected = '';
		}
		return $answer_selected;
	}
	public static function is_answer_link( $answer ) {
		$answer_text = '';
		$answer_url = '';
		if ( 'yes' === $answer->meta_data['makeLink'] ) {
			$answer_url = filter_var( $answer->meta_data['link'], FILTER_SANITIZE_URL );
			if ( ( '' !== $answer->meta_data['link'] ) && ( false === !filter_var( $answer_url, FILTER_VALIDATE_URL) ) ) {
				$answer_text = "<a href='{$answer_url}' target='_blank'>" . esc_html( $answer->stext ) . "</a>";
			} else {
				$answer_text = esc_html( $answer->stext );
			}
		} else {
			$answer_text = esc_html( $answer->stext );
		}
		return $answer_text;
	}
	public static function get_answers_count( $question ) {
		$answers_count = count( $question->answers );
		if ( 'yes' === $question->meta_data['allowOtherAnswers'] ) {
			$answers_count++;
		}
		return $answers_count;
	}
	public static function get_gdpr_html( $poll ) {
		$gdpr_html = '';
		if ( 'yes' === $poll->meta_data['options']['poll']['enableGdpr'] ) {
			if ( 'consent' === $poll->meta_data['options']['poll']['gdprSolution'] ) {
				$gdpr_html = '<div class="basic-gdpr-consent">'
					. '<input type="checkbox" name="gdpr-consent" class="gdpr-consent" value="agree">'
					. '<span class="basic-gdpr-consent-text">' . $poll->meta_data['options']['poll']['gdprConsentText'] . '</span>'
					. '</div>';
			}
		}
		return $gdpr_html;
	}
	public static function has_captcha( $poll, $params ) {
		$use_captcha = array();
		$uid = self::generate_uid();
		if ( ( true === isset( $params['show_results'] ) ) && ( '1' === $params['show_results'] ) ) {
			$use_captcha[0] = '0';
			$use_captcha[1] = '';
			$use_captcha[2] = $uid;
		} else {
			if ( 'yes' === $poll->meta_data['options']['poll']['useCaptcha'] ) {
				$use_captcha[0] = '1';
				$use_captcha[1] = '<div id="yop-poll-captcha-' . $uid . '"></div>';
				$use_captcha[2] = $uid;
			} else {
				$use_captcha[0] = '0';
				$use_captcha[1] = '';
				$use_captcha[2] = $uid;
			}
		}
		return $use_captcha;
	}
	public static function do_vertical_text( $element, $poll_meta_data, $params ) {
		$answers_type = '';
		$answer_text = '';
		$answer_selected = '';
		/*
		if ( ( true === isset( $params['show_results']) ) && ( '1' === $params['show_results'] ) ) {
			$element_answers = '<ul class="basic-answers hide">';
		} else {
			$element_answers = '<ul class="basic-answers">';
		}
		*/
		$element_answers = '<ul class="basic-answers">';
		$answers_type = self::is_allow_multiple_answers( $element->meta_data['allowMultipleAnswers'] );
		foreach ( $element->answers as $answer ) {
			$answer_selected = self::is_answer_default( $answer->meta_data['makeDefault'] );
			$answer_text = self::is_answer_link( $answer );
			$element_answers .= '<li class="basic-answer" style="'
								. 'background-color:' . esc_attr( $poll_meta_data['style']['answers']['backgroundColor'] ) . ';'
								. 'border:' . esc_attr( $poll_meta_data['style']['answers']['borderSize'] ) . 'px;'
								. 'border-style: solid;'
								. 'border-color:' . esc_attr( $poll_meta_data['style']['answers']['borderColor'] ) . ';'
								. 'border-radius:' . esc_attr( $poll_meta_data['style']['answers']['borderRadius'] ) . 'px;'
								. 'padding:' . esc_attr( $poll_meta_data['style']['answers']['padding'] ) . 'px;'
								. 'color:' . esc_attr( $poll_meta_data['style']['answers']['textColor'] ) . ';'
								. 'font-size:' . esc_attr( $poll_meta_data['style']['answers']['textSize'] ) . ';"'
								. ' data-id="' . esc_attr( $answer->id ) . '"'
								. ' data-type="' . $answer->stype . '"'
								. ' data-vn="' . $answer->total_submits . '"'
								. ' data-color="' . $answer->meta_data['resultsColor'] . '"'
								. '>'
								. '<div class="basic-canvas">'
									. '<span class="basic-howmuch"></span>'
								. '</div>'
								. '<div class="basic-inner">'
									. '<label class="basic-label">'
										. '<input type="' . $answers_type . '" name="answer[' . $element->id . ']" value="' . esc_attr( $answer->id ) . '"' . $answer_selected . '>'
										. '<span class="basic-answer-content">'
											. '<span class="basic-text">'
											. $answer_text
											. '</span>'
										. '</span>'
									. '</label>'
								. '</div>'
							. '</li>';
		}
		if ( 'yes' === $element->meta_data['allowOtherAnswers'] ) {
			$element_answers .= '<li class="basic-answer basic-other-answer" style="'
								. 'background-color:' . esc_attr( $poll_meta_data['style']['answers']['backgroundColor'] ) . ';'
								. 'border:' . esc_attr( $poll_meta_data['style']['answers']['borderSize'] ) . 'px;'
								. 'border-style: solid;'
								. 'border-color:' . esc_attr( $poll_meta_data['style']['answers']['borderColor'] ) . ';'
								. 'border-radius:' . esc_attr( $poll_meta_data['style']['answers']['borderRadius'] ) . 'px;'
								. 'padding:' . esc_attr( $poll_meta_data['style']['answers']['padding'] ) . 'px;'
								. 'color:' . esc_attr( $poll_meta_data['style']['answers']['textColor'] ) . ';'
								. 'font-size:' . esc_attr( $poll_meta_data['style']['answers']['textSize'] ) . ';'
								. '">'
								. '<div class="basic-canvas">'
									. '<span class="basic-howmuch"></span>'
								. '</div>'
								. '<div class="basic-inner">'
									. '<label class="basic-label">'
										. '<input type="' . $answers_type . '" name="answer[' . $element->id . ']" value="0">'
										. '<span class="basic-answer-content">'
											. '<span class="basic-text">'
											. esc_html( $element->meta_data['otherAnswersLabel'] )
											. '<br/>'
											. '<input class="basic-input-text form-control" type="text" name="other[' . $element->id . ']" data-type="other-answer">'
											. '</span>'
										. '</span>'
									. '</label>'
								. '</div>'
							. '</li>';
		}
		$element_answers .= '</ul>';
		return $element_answers;
	}
	public static function do_horizontal_text( $element, $poll_meta_data, $params ) {
		$answers_type = '';
		$answer_text = '';
		$answer_selected = '';
		$answers_count = self::get_answers_count( $element );
		$answers_type = self::is_allow_multiple_answers( $element->meta_data['allowMultipleAnswers'] );
		/*
		if ( '1' === $params['show_results'] ) {
			$element_answers = '<div class="basic-answers hide">';
		} else {
			$element_answers = '<div class="basic-answers">';
		}
		*/
		$element_answers = '<div class="basic-answers">';
		$element_answers .= '<div class="row" data-columns="' . $answers_count . '">';
		foreach ( $element->answers as $answer ) {
			$answer_selected = self::is_answer_default( $answer->meta_data['makeDefault'] );
			$answer_text = self::is_answer_link( $answer );
			$element_answers .= '<div class="col-md-1 basic-answer" style="'
							. 'background-color:' . esc_attr( $poll_meta_data['style']['answers']['backgroundColor'] ) . ';'
							. 'border:' . esc_attr( $poll_meta_data['style']['answers']['borderSize'] ) . 'px;'
							. 'border-style: solid;'
							. 'border-color:' . esc_attr( $poll_meta_data['style']['answers']['borderColor'] ) . ';'
							. 'border-radius:' . esc_attr( $poll_meta_data['style']['answers']['borderRadius'] ) . 'px;'
							. 'padding:' . esc_attr( $poll_meta_data['style']['answers']['padding'] ) . 'px;'
							. 'color:' . esc_attr( $poll_meta_data['style']['answers']['textColor'] ) . ';'
							. 'font-size:' . esc_attr( $poll_meta_data['style']['answers']['textSize'] ) . ';"'
							. ' data-id="' . esc_attr( $answer->id ) . '"'
							. ' data-type="' . $answer->stype . '"'
							. ' data-vn="' . $answer->total_submits . '"'
							. ' data-color="' . $answer->meta_data['resultsColor'] . '"'
							. '">'
							. '<div class="basic-canvas">'
								. '<span class="basic-howmuch"></span>'
							. '</div>'
							. '<div class="basic-inner">'
								. '<label class="basic-label">'
									. '<input type="' . $answers_type . '" name="answer[' . $element->id . ']" value="' . esc_attr( $answer->id ) . '"' . $answer_selected . '>'
									. '<span class="basic-answer-content">'
										. '<span class="basic-text">'
										. $answer_text
										. '</span>'
									. '</span>'
								. '</label>'
							. '</div>'
						. '</div>';
		}
		if ( 'yes' === $element->meta_data['allowOtherAnswers'] ) {
			$element_answers .= '<div class="col-md-1 basic-answer basic-other-answer" style="'
								. 'background-color:' . esc_attr( $poll_meta_data['style']['answers']['backgroundColor'] ) . ';'
								. 'border:' . esc_attr( $poll_meta_data['style']['answers']['borderSize'] ) . 'px;'
								. 'border-style: solid;'
								. 'border-color:' . esc_attr( $poll_meta_data['style']['answers']['borderColor'] ) . ';'
								. 'border-radius:' . esc_attr( $poll_meta_data['style']['answers']['borderRadius'] ) . 'px;'
								. 'padding:' . esc_attr( $poll_meta_data['style']['answers']['padding'] ) . 'px;'
								. 'color:' . esc_attr( $poll_meta_data['style']['answers']['textColor'] ) . ';'
								. 'font-size:' . esc_attr( $poll_meta_data['style']['answers']['textSize'] ) . ';'
								. '">'
								. '<div class="basic-canvas">'
									. '<span class="basic-howmuch"></span>'
								. '</div>'
								. '<div class="basic-inner">'
									. '<label class="basic-label">'
										. '<input type="' . $answers_type . '" name="answer[' . $element->id . ']" value="0">'
										. '<span class="basic-answer-content">'
											. '<span class="basic-text">'
											. esc_html( $element->meta_data['otherAnswersLabel'] )
											. '<br/>'
											. '<input class="basic-input-text form-control" type="text" name="other[' . $element->id . ']" data-type="other-answer">'
											. '</span>'
										. '</span>'
									. '</label>'
								. '</div>'
							. '</div>';
		}
		$element_answers .= '</div>';
		$element_answers .= '</div>';
		return $element_answers;
	}
	public static function do_columns_text( $element, $poll_meta_data, $params ) {
		$answers_type = '';
		$answer_text = '';
		$answer_selected = '';
		$answers_count = self::get_answers_count( $element );
		if ( 'yes' === $element->meta_data['allowOtherAnswers'] ) {
			$defined_answers_count = $answers_count - 1;
		} else {
			$defined_answers_count = $answers_count;
		}
		$answers_type = self::is_allow_multiple_answers( $element->meta_data['allowMultipleAnswers'] );
		$answers_per_row = $element->meta_data['answersColumns'];
		$i = 1;
		if ( '1' === $params['show_results'] ) {
			$element_answers = '<div class="basic-answers">';
		} else {
			$element_answers = '<div class="basic-answers">';
		}
		$element_answers .= '<div class="row" data-columns="' . $answers_per_row . '">';
		foreach ( $element->answers as $answer ) {
			$answer_selected = self::is_answer_default( $answer->meta_data['makeDefault'] );
			$answer_text = self::is_answer_link( $answer );
			$element_answers .= '<div class="col-md-1 basic-answer" style="'
							. 'background-color:' . esc_attr( $poll_meta_data['style']['answers']['backgroundColor'] ) . ';'
							. 'border:' . esc_attr( $poll_meta_data['style']['answers']['borderSize'] ) . 'px;'
							. 'border-style: solid;'
							. 'border-color:' . esc_attr( $poll_meta_data['style']['answers']['borderColor'] ) . ';'
							. 'border-radius:' . esc_attr( $poll_meta_data['style']['answers']['borderRadius'] ) . 'px;'
							. 'padding:' . esc_attr( $poll_meta_data['style']['answers']['padding'] ) . 'px;'
							. 'color:' . esc_attr( $poll_meta_data['style']['answers']['textColor'] ) . ';'
							. 'font-size:' . esc_attr( $poll_meta_data['style']['answers']['textSize'] ) . ';"'
							. ' data-id="' . esc_attr( $answer->id ) . '"'
							. ' data-type="' . $answer->stype . '"'
							. ' data-vn="' . $answer->total_submits . '"'
							. ' data-color="' . $answer->meta_data['resultsColor'] . '"'
							. '">'
							. '<div class="basic-canvas">'
								. '<span class="basic-howmuch"></span>'
							. '</div>'
							. '<div class="basic-inner">'
								. '<label class="basic-label">'
									. '<input type="' . $answers_type . '" name="answer[' . $element->id . ']" value="' . esc_attr( $answer->id ) . '"' . $answer_selected . '>'
									. '<span class="basic-answer-content">'
										. '<span class="basic-text">'
										. $answer_text
										. '</span>'
									. '</span>'
								. '</label>'
							. '</div>'
						. '</div>';
			if ( 0 === ( $i % $answers_per_row ) ) {
				$element_answers .= '</div>';
				if ( $i < $defined_answers_count ) {
					$element_answers .= '<div class="row" data-columns="' . $answers_per_row . '">';
				}
			}
			$i++;
		}
		if ( 'yes' === $element->meta_data['allowOtherAnswers'] ) {
			if ( 0 === ( $defined_answers_count % $answers_per_row ) )  {
				$element_answers .= '<div class="row" data-columns="' . esc_attr( $answers_per_row ) . '">';
			}
			$element_answers .= '<div class="col-md-1 basic-answer basic-other-answer" style="'
								. 'background-color:' . esc_attr( $poll_meta_data['style']['answers']['backgroundColor'] ) . ';'
								. 'border:' . esc_attr( $poll_meta_data['style']['answers']['borderSize'] ) . 'px;'
								. 'border-style: solid;'
								. 'border-color:' . esc_attr( $poll_meta_data['style']['answers']['borderColor'] ) . ';'
								. 'border-radius:' . esc_attr( $poll_meta_data['style']['answers']['borderRadius'] ) . 'px;'
								. 'padding:' . esc_attr( $poll_meta_data['style']['answers']['padding'] ) . 'px;'
								. 'color:' . esc_attr( $poll_meta_data['style']['answers']['textColor'] ) . ';'
								. 'font-size:' . esc_attr( $poll_meta_data['style']['answers']['textSize'] ) . ';'
								. '">'
								. '<div class="basic-canvas">'
									. '<span class="basic-howmuch"></span>'
								. '</div>'
								. '<div class="basic-inner">'
									. '<label class="basic-label">'
										. '<input type="' . $answers_type . '" name="answer[' . $element->id . ']" value="0">'
										. '<span class="basic-answer-content">'
											. '<span class="basic-text">'
											. esc_html( $element->meta_data['otherAnswersLabel'] )
											. '<br/>'
											. '<input class="basic-input-text form-control" type="text" name="other[' . $element->id . ']" data-type="other-answer">'
											. '</span>'
										. '</span>'
									. '</label>'
								. '</div>'
							. '</div>';
			$element_answers .= '</div>';
		} else {
			if ( 0 !== $defined_answers_count % $answers_per_row ) {
				$element_answers .= '</div>';
			}
		}
		$element_answers .= '</div>';
		return $element_answers;
	}
	public static function do_show_results_link( $poll ) {
		$poll_show_results_link = '';
		if ( 'yes' === $poll->meta_data['options']['poll']['showResultsLink'] ) {
			$poll_show_results_link = '<button class="basic-results-button">'
										. $poll->meta_data['options']['poll']['resultsLabelText']
									. '</button>';
		}
		return $poll_show_results_link;
	}
	public static function do_show_back_to_vote_link( $poll ) {
		$poll_show_back_to_vote_link = '';
		if ( 'yes' === $poll->meta_data['options']['results']['backToVoteOption'] ) {
			$poll_show_back_to_vote_link = '<button class="basic-back-to-vote-button" style="display:none;">'
										. $poll->meta_data['options']['results']['backToVoteCaption']
									. '</button>';
		}
		return $poll_show_back_to_vote_link;
	}
	public static function do_show_total_votes_and_answers( $poll, $params ) {
		$total_votes_and_answers = '';
		if ( ( true === isset( $params['show_results'] ) ) && ( '1' !== $params['show_results'] ) ) {
			if (
				( 'yes' === $poll->meta_data['options']['poll']['showTotalVotes'] ) &&
				( 'yes' === $poll->meta_data['options']['poll']['showTotalAnswers'] )
				) {
					$total_votes_and_answers = '<div class="basic-stats">'
													. '<span class="basic-stats-votes">'
														. '<span class="basic-stats-votes-number">'
															. $poll->total_submits
														. '</span>'
														. '<span>'
															 . '&nbsp;' . sprintf( _n( 'vote', 'votes', $poll->total_submits, 'yop-poll' ), $poll->total_submits )
														. '</span>'
													. '</span>'
													. '&nbsp;&middot;&nbsp;'
													. '<span class="basic-stats-answers">'
														. '<span class="basic-stats-answers-number">'
															. $poll->total_submited_answers
														. '</span>'
														. '<span>'
															 . '&nbsp;' . sprintf( _n( 'answer', 'answers', $poll->total_submited_answers, 'yop-poll' ), $poll->total_submited_answers )
														. '</span>'
													. '</span>'
			        							. '</div>';
				} else if ( 'yes' === $poll->meta_data['options']['poll']['showTotalVotes'] ) {
					$total_votes_and_answers = '<div class="basic-stats">'
													. '<span class="basic-stats-votes">'
														. '<span class="basic-stats-votes-number">'
															. $poll->total_submits . '&nbsp;'
														. '</span>'
														. '<span>'
															. sprintf( _n( 'vote', 'votes', $poll->total_submits, 'yop-poll' ), $poll->total_submits )
														. '</span>'
													. '</span>'
			        							. '</div>';
				} else if ( 'yes' === $poll->meta_data['options']['poll']['showTotalAnswers'] ) {
					$total_votes_and_answers = '<div class="basic-stats">'
													. '<span class="basic-stats-answers">'
														. '<span class="basic-stats-answers-number">'
															. $poll->total_submited_answers . '&nbsp;'
														. '</span>'
														. '<span>'
															. sprintf( _n( 'answer', 'answers', $poll->total_submited_answers, 'yop-poll' ), $poll->total_submited_answers )
														. '</span>'
													. '</span>'
			        							. '</div>';
				}
			}
			return $total_votes_and_answers;
	}
	public static function do_anonymous_vote( $poll ) {
		$anonymous_vote_code = '';
		if ( 1 < count( $poll->meta_data['options']['access']['votePermissions'] ) ) {
			if (true === in_array( 'guest', $poll->meta_data['options']['access']['votePermissions'] ) ) {
				$anonymous_vote_code .= '<div class="basic-anonymous">'
									. '<button type="button" class="btn btn-default">'
										. '<i class="fa fa-user-secret" aria-hidden="true"></i>'
										. __( 'Anonymous Vote', 'yop-poll' )
									. '</button>'
								. '</div>';
			}
		}
		return $anonymous_vote_code;
	}
	public static function do_wordpress_vote( $poll ) {
		$wordpress_vote_code = '';
		if ( 1 < count( $poll->meta_data['options']['access']['votePermissions'] ) ) {
			if (true === in_array( 'wordpress', $poll->meta_data['options']['access']['votePermissions'] ) ) {
				$wordpress_vote_code .= '<div class="basic-wordpress">'
										. '<button type="button" class="btn btn-default">'
											. '<i class="fa fa-wordpress" aria-hidden="true"></i>'
											. __( 'Sign in with Wordpress', 'yop-poll' )
										. '</button>'
									. '</div>';
			}
		}
		return $wordpress_vote_code;
	}
	public static function do_facebook_vote( $poll ) {
		$facebook_vote_code = '';
		if ( 1 < count( $poll->meta_data['options']['access']['votePermissions'] ) ) {
			if (true === in_array( 'facebook', $poll->meta_data['options']['access']['votePermissions'] ) ) {
				$facebook_vote_code .= '<div class="basic-facebook">'
										. '<button type="button" class="btn btn-default">'
											. '<i class="fa fa-wordpress" aria-hidden="true"></i>'
											. __( 'Sign in with Facebook', 'yop-poll' )
										. '</button>'
									. '</div>';
			}
		}
		return $facebook_vote_code;
	}
	public static function do_google_vote( $poll ) {
		$google_vote_code = '';
		if ( 1 < count( $poll->meta_data['options']['access']['votePermissions'] ) ) {
			if (true === in_array( 'google', $poll->meta_data['options']['access']['votePermissions'] ) ) {
				$google_vote_code .= '<div class="basic-google">'
										. '<button type="button" class="btn btn-default">'
											. '<i class="fa fa-wordpress" aria-hidden="true"></i>'
											. __( 'Sign in with Google', 'yop-poll' )
										. '</button>'
									. '</div>';
			}
		}
		return $google_vote_code;
	}
	public static function do_text_question( $element, $poll_meta_data, $params ) {
		$element_answers = '';
		switch ( $element->meta_data['answersDisplay'] ) {
			case 'vertical': {
				$element_answers = self::do_vertical_text( $element, $poll_meta_data, $params );
				break;
			}
			case 'horizontal': {
				$element_answers = self::do_horizontal_text( $element, $poll_meta_data, $params );
				break;
			}
			case 'columns': {
				$element_answers = self::do_columns_text( $element, $poll_meta_data, $params );
				break;
			}
			default: {
				$element_answers = self::do_vertical_text( $element, $poll_meta_data, $params );
				break;
			}
		}
		$element_code = '<div class="basic-element basic-question" style="'
							. 'background-color:' . esc_attr( $poll_meta_data['style']['questions']['backgroundColor'] ) . ';'
							. 'border:' . esc_attr( $poll_meta_data['style']['questions']['borderSize'] ) . 'px;'
							. 'border-style: solid;'
							. 'border-color:' . esc_attr( $poll_meta_data['style']['questions']['borderColor'] ) . ';'
							. 'border-radius:' . esc_attr( $poll_meta_data['style']['questions']['borderRadius'] ) . 'px;'
							. 'padding:' . esc_attr( $poll_meta_data['style']['questions']['padding'] ) . 'px;'
							. 'color:' . esc_attr( $poll_meta_data['style']['questions']['textColor'] ) . ';'
							. 'font-size:' . esc_attr( $poll_meta_data['style']['questions']['textSize'] ) . ';"'
							. 'data-id="' . esc_attr( $element->id ) . '"'
							. 'data-uid="' . esc_attr( self::generate_uid() ) . '"'
		                    . 'data-type="question"'
							. 'data-question-type="text"'
							. 'data-min="' . esc_attr( $element->meta_data['multipleAnswersMinim'] ) . '"'
							. 'data-max="' . esc_attr( $element->meta_data['multipleAnswersMaxim'] ) . '"'
		                    . 'data-display="' .esc_attr( $element->meta_data['answersDisplay'] ) . '"'
		                    . 'data-colnum="' . esc_attr( $element->meta_data['answersColumns']) . '"'
						. '>'
						. '<div class="basic-question-title">'
							. esc_html( $element->etext )
						. '</div>'
						. $element_answers
					. '</div>';
		return $element_code;
	}
	public static function do_custom_field( $element, $poll_meta_data, $params ) {
		if ( ( true === isset( $params['show_results'] ) ) && ( '1' !== $params['show_results'] ) ) {
			$poll_elements = '<div class="basic-element basic-custom-field"'
								. ' data-id="' .$element->id . '"'
								. ' data-type="custom-field"'
								. ' data-required="' .$element->meta_data['makeRequired'] . '"'
								. '>'
								. '<label>' . esc_html( $element->etext ) . '</label>'
								. '<input type="text" name="cfield[' . $element->id . ']" class="form-control" data-type="cfield">'
								. '<br>'
							. '</div>';
		} else {
			$poll_elements = '';
		}
		return $poll_elements;
	}
	public static function do_media_question( $element, $poll_meta_data, $params ) {
		$element_answers = '';
		switch ( $element->meta_data['answersDisplay'] ) {
			case 'vertical': {
				$element_answers = self::do_vertical_media( $element, $poll_meta_data, $params );
				break;
			}
			case 'horizontal': {
				$element_answers = self::do_horizontal_media( $element, $poll_meta_data, $params );
				break;
			}
			case 'columns': {
				$element_answers = self::do_columns_media( $element, $poll_meta_data, $params );
				break;
			}
			default: {
				$element_answers = self::do_vertical_media( $element, $poll_meta_data, $params );
				break;
			}
		}
		$element_code = '<div class="basic-element basic-question" style="'
							. 'background-color:' . esc_attr( $poll_meta_data['style']['questions']['backgroundColor'] ) .';'
							. 'border:' . esc_attr( $poll_meta_data['style']['questions']['borderSize'] ) . 'px;'
							. 'border-style: solid;'
							. 'border-color:' . esc_attr( $poll_meta_data['style']['questions']['borderColor'] ) . ';'
							. 'border-radius:' . esc_attr( $poll_meta_data['style']['questions']['borderRadius'] ) . 'px;'
							. 'padding:' . esc_attr( $poll_meta_data['style']['questions']['padding'] ) . 'px;'
							. 'color:' . esc_attr( $poll_meta_data['style']['questions']['textColor'] ) . ';'
							. 'font-size:' . esc_attr( $poll_meta_data['style']['questions']['textSize'] ) . ';"'
							. 'data-id="' . esc_attr( $element->id ) . '"'
							. 'data-uid="' . esc_attr( self::generate_uid() ) . '"'
		                    . 'data-type="question"'
							. 'data-question-type="media"'
							. 'data-min="' . esc_attr( $element->meta_data['multipleAnswersMinim'] ) . '"'
							. 'data-max="' . esc_attr( $element->meta_data['multipleAnswersMaxim'] ) . '"'
		                    . 'data-display="' .esc_attr( $element->meta_data['answersDisplay'] ) . '"'
		                    . 'data-colnum="' . esc_attr( $element->meta_data['answersColumns']) . '"'
						. '>'
						. '<div class="basic-question-title">'
							. esc_html( $element->etext )
						. '</div>'
						. $element_answers
					. '</div>';
		return $element_code;
	}
	public static function create_media_answer( $answer ) {
		switch ( $answer->stype ) {
			case 'image': {
				$answer_code = '<img src="' . $answer->stext . '">';
				break;
			}
			case 'video': {
				$answer_code = $answer->stext;
				break;
			}
		}
		return $answer_code;
	}
	public static function do_vertical_media( $element, $poll_meta_data, $params ) {
		$answers_type = '';
		$answer_text = '';
		$answer_selected = '';
		/*
		if ( '1' === $params['show_results'] ) {
			$element_answers = '<ul class="basic-answers hide">';
		} else {
			$element_answers = '<ul class="basic-answers">';
		}
		*/
		$element_answers = '<ul class="basic-answers">';
		$answers_type = self::is_allow_multiple_answers( $element->meta_data['allowMultipleAnswers'] );
		foreach ( $element->answers as $answer ) {
			$answer_selected = self::is_answer_default( $answer->meta_data['makeDefault'] );
			$answer_text = self::create_media_answer( $answer );
			$element_answers .= '<li class="basic-answer" style="'
								. 'background-color:' . esc_attr( $poll_meta_data['style']['answers']['backgroundColor'] ) . ';'
								. 'border:' . esc_attr( $poll_meta_data['style']['answers']['borderSize'] ) . 'px;'
								. 'border-style: solid;'
								. 'border-color:' . esc_attr( $poll_meta_data['style']['answers']['borderColor'] ) . ';'
								. 'border-radius:' . esc_attr( $poll_meta_data['style']['answers']['borderRadius'] ) . 'px;'
								. 'padding:' . esc_attr( $poll_meta_data['style']['answers']['padding'] ) . 'px;'
								. 'color:' . esc_attr( $poll_meta_data['style']['answers']['textColor'] ) . ';'
								. 'font-size:' . esc_attr( $poll_meta_data['style']['answers']['textSize'] ) . ';"'
								. ' data-id="' . esc_attr( $answer->id ) . '"'
								. ' data-type="' . $answer->stype . '"'
								. ' data-vn="' . $answer->total_submits . '"'
								. ' data-color="' . $answer->meta_data['resultsColor'] . '"'
								. '>'
								. '<div class="basic-canvas">'
									. '<span class="basic-howmuch"></span>'
								. '</div>'
								. '<div class="basic-inner">'
									. '<label class="basic-label basic-label-media basic-label-media-vertical">'
										. '<input type="' . $answers_type . '" name="answer[' . $element->id . ']" value="' . esc_attr( $answer->id ) . '"' . $answer_selected . '>'
										. '<span class="basic-answer-content">'
											. '<span class="basic-media">'
											. $answer_text
											. '<span class="basic-media-text hide">'
												. $answer->meta_data['text']
											. '</span>'
											. '</span>'
										. '</span>'
									. '</label>'
								. '</div>'
							. '</li>';
		}
		if ( 'yes' === $element->meta_data['allowOtherAnswers'] ) {
			$element_answers .= '<li class="basic-answer basic-other-answer" style="'
								. 'background-color:' . esc_attr( $poll_meta_data['style']['answers']['backgroundColor'] ) . ';'
								. 'border:' . esc_attr( $poll_meta_data['style']['answers']['borderSize'] ) . 'px;'
								. 'border-style: solid;'
								. 'border-color:' . esc_attr( $poll_meta_data['style']['answers']['borderColor'] ) . ';'
								. 'border-radius:' . esc_attr( $poll_meta_data['style']['answers']['borderRadius'] ) . 'px;'
								. 'padding:' . esc_attr( $poll_meta_data['style']['answers']['padding'] ) . 'px;'
								. 'color:' . esc_attr( $poll_meta_data['style']['answers']['textColor'] ) . ';'
								. 'font-size:' . esc_attr( $poll_meta_data['style']['answers']['textSize'] ) . ';'
								. '">'
								. '<div class="basic-canvas">'
									. '<span class="basic-howmuch"></span>'
								. '</div>'
								. '<div class="basic-inner">'
									. '<label class="basic-label">'
										. '<input type="' . $answers_type . '" name="answer[' . $element->id . ']" value="0">'
										. '<span class="basic-answer-content">'
											. '<span class="basic-text">'
											. esc_html( $element->meta_data['otherAnswersLabel'] )
											. '<br/>'
											. '<input class="basic-input-text form-control" type="text" name="other[' . $element->id . ']">'
											. '</span>'
										. '</span>'
									. '</label>'
								. '</div>'
							. '</li>';
		}
		$element_answers .= '</ul>';
		return $element_answers;
	}
	public static function do_horizontal_media( $element, $poll_meta_data, $params ) {
		$answers_type = '';
		$answer_text = '';
		$answer_selected = '';
		$answers_count = self::get_answers_count( $element );
		$answers_type = self::is_allow_multiple_answers( $element->meta_data['allowMultipleAnswers'] );
		/*
		if ( '1' === $params['show_results'] ) {
			$element_answers = '<div class="basic-answers hide">';
		} else {
			$element_answers = '<div class="basic-answers">';
		}
		*/
		$element_answers = '<div class="basic-answers">';
		$element_answers .= '<div class="row" data-columns="' . $answers_count . '">';
		foreach ( $element->answers as $answer ) {
			$answer_selected = self::is_answer_default( $answer->meta_data['makeDefault'] );
			$answer_text = self::create_media_answer( $answer );
			$element_answers .= '<div class="col-md-1 basic-answer" style="'
							. 'background-color:' . esc_attr( $poll_meta_data['style']['answers']['backgroundColor'] ) . ';'
							. 'border:' . esc_attr( $poll_meta_data['style']['answers']['borderSize'] ) . 'px;'
							. 'border-style: solid;'
							. 'border-color:' . esc_attr( $poll_meta_data['style']['answers']['borderColor'] ) . ';'
							. 'border-radius:' . esc_attr( $poll_meta_data['style']['answers']['borderRadius'] ) . 'px;'
							. 'padding:' . esc_attr( $poll_meta_data['style']['answers']['padding'] ) . 'px;'
							. 'color:' . esc_attr( $poll_meta_data['style']['answers']['textColor'] ) . ';'
							. 'font-size:' . esc_attr( $poll_meta_data['style']['answers']['textSize'] ) . ';"'
							. ' data-id="' . esc_attr( $answer->id ) . '"'
							. ' data-type="' . $answer->stype . '"'
							. ' data-vn="' . $answer->total_submits . '"'
							. ' data-color="' . $answer->meta_data['resultsColor'] . '"'
							. '">'
							. '<div class="basic-canvas">'
								. '<span class="basic-howmuch"></span>'
							. '</div>'
							. '<div class="basic-inner">'
								. '<label class="basic-label basic-label-media basic-label-media-horizontal">'
									. '<input type="' . $answers_type . '" name="answer[' . $element->id . ']" value="' . esc_attr( $answer->id ) . '"' . $answer_selected . '>'
									. '<span class="basic-answer-content">'
										. '<span class="basic-media">'
											. $answer_text
											. '<span class="basic-media-text hide">'
												. $answer->meta_data['text']
											. '</span>'
										. '</span>'
									. '</span>'
								. '</label>'
							. '</div>'
						. '</div>';
		}
		if ( 'yes' === $element->meta_data['allowOtherAnswers'] ) {
			$element_answers .= '<div class="col-md-1 basic-answer basic-other-answer" style="'
								. 'background-color:' . esc_attr( $poll_meta_data['style']['answers']['backgroundColor'] ) . ';'
								. 'border:' . esc_attr( $poll_meta_data['style']['answers']['borderSize'] ) . 'px;'
								. 'border-style: solid;'
								. 'border-color:' . esc_attr( $poll_meta_data['style']['answers']['borderColor'] ) . ';'
								. 'border-radius:' . esc_attr( $poll_meta_data['style']['answers']['borderRadius'] ) . 'px;'
								. 'padding:' . esc_attr( $poll_meta_data['style']['answers']['padding'] ) . 'px;'
								. 'color:' . esc_attr( $poll_meta_data['style']['answers']['textColor'] ) . ';'
								. 'font-size:' . esc_attr( $poll_meta_data['style']['answers']['textSize'] ) . ';'
								. '">'
								. '<div class="basic-canvas">'
									. '<span class="basic-howmuch"></span>'
								. '</div>'
								. '<div class="basic-inner">'
									. '<label class="basic-label">'
										. '<input type="' . $answers_type . '" name="answer[' . $element->id . ']" value="0">'
										. '<span class="basic-answer-content">'
											. '<span class="basic-text">'
											. esc_html( $elements->meta_data['otherAnswersLabel'] )
											. '<br/>'
											. '<input class="basic-input-text form-control" type="text" name="other[' . $element->id . ']" data-type="other-answer">'
											. '</span>'
										. '</span>'
									. '</label>'
								. '</div>'
							. '</div>';
		}
		$element_answers .= '</div>';
		$element_answers .= '</div>';
		return $element_answers;
	}
	public static function do_columns_media( $element, $poll_meta_data, $params ) {
		$answers_type = '';
		$answer_text = '';
		$answer_selected = '';
		$answers_count = self::get_answers_count( $element );
		if ( 'yes' === $element->meta_data['allowOtherAnswers'] ) {
			$defined_answers_count = $answers_count - 1;
		} else {
			$defined_answers_count = $answers_count;
		}
		$answers_type = self::is_allow_multiple_answers( $element->meta_data['allowMultipleAnswers'] );
		$answers_per_row = $element->meta_data['answersColumns'];
		$i = 1;
		/*
		if ( '1' === $params['show_results'] ) {
			$element_answers = '<div class="basic-answers hide">';
		} else {
			$element_answers = '<div class="basic-answers">';
		}
		*/
		$element_answers = '<div class="basic-answers">';
		$element_answers .= '<div class="row" data-columns="' . $answers_per_row . '">';
		foreach ( $element->answers as $answer ) {
			$answer_selected = self::is_answer_default( $answer->meta_data['makeDefault'] );
			$answer_text = self::create_media_answer( $answer );
			$element_answers .= '<div class="col-md-1 basic-answer" style="'
							. 'background-color:' . esc_attr( $poll_meta_data['style']['answers']['backgroundColor'] ) . ';'
							. 'border:' . esc_attr( $poll_meta_data['style']['answers']['borderSize'] ) . 'px;'
							. 'border-style: solid;'
							. 'border-color:' . esc_attr( $poll_meta_data['style']['answers']['borderColor'] ) . ';'
							. 'border-radius:' . esc_attr( $poll_meta_data['style']['answers']['borderRadius'] ) . 'px;'
							. 'padding:' . esc_attr( $poll_meta_data['style']['answers']['padding'] ) . 'px;'
							. 'color:' . esc_attr( $poll_meta_data['style']['answers']['textColor'] ) . ';'
							. 'font-size:' . esc_attr( $poll_meta_data['style']['answers']['textSize'] ) . ';"'
							. ' data-id="' . esc_attr( $answer->id ) . '"'
							. ' data-type="' . $answer->stype . '"'
							. ' data-vn="' . $answer->total_submits . '"'
							. ' data-color="' . $answer->meta_data['resultsColor'] . '"'
							. '">'
							. '<div class="basic-canvas">'
								. '<span class="basic-howmuch"></span>'
							. '</div>'
							. '<div class="basic-inner">'
								. '<label class="basic-label basic-label-media basic-label-media-horizontal">'
									. '<input type="' . $answers_type . '" name="answer[' . $element->id . ']" value="' . esc_attr( $answer->id ) . '"' . $answer_selected . '>'
									. '<span class="basic-answer-content">'
										. '<span class="basic-text">'
											. $answer_text
											. '<span class="basic-media-text hide">'
												. $answer->meta_data['text']
											. '</span>'
										. '</span>'
									. '</span>'
								. '</label>'
							. '</div>'
						. '</div>';
			if ( 0 === ( $i % $answers_per_row ) ) {
				$element_answers .= '</div>';
				if ( $i < $defined_answers_count ) {
					$element_answers .= '<div class="row" data-columns="' . $answers_per_row . '">';
				}
			}
			$i++;
		}
		if ( 'yes' === $element->meta_data['allowOtherAnswers'] ) {
			if ( 0 === ( $defined_answers_count % $answers_per_row ) )  {
				$element_answers .= '<div class="row" data-columns="' . esc_attr( $answers_per_row ) . '">';
			}
			$element_answers .= '<div class="col-md-1 basic-answer basic-other-answer" style="'
								. 'background-color:' . esc_attr( $poll_meta_data['style']['answers']['backgroundColor'] ) . ';'
								. 'border:' . esc_attr( $poll_meta_data['style']['answers']['borderSize'] ) . 'px;'
								. 'border-style: solid;'
								. 'border-color:' . esc_attr( $poll_meta_data['style']['answers']['borderColor'] ) . ';'
								. 'border-radius:' . esc_attr( $poll_meta_data['style']['answers']['borderRadius'] ) . 'px;'
								. 'padding:' . esc_attr( $poll_meta_data['style']['answers']['padding'] ) . 'px;'
								. 'color:' . esc_attr( $poll_meta_data['style']['answers']['textColor'] ) . ';'
								. 'font-size:' . esc_attr( $poll_meta_data['style']['answers']['textSize'] ) . ';'
								. '">'
								. '<div class="basic-canvas">'
									. '<span class="basic-howmuch"></span>'
								. '</div>'
								. '<div class="basic-inner">'
									. '<label class="basic-label">'
										. '<input type="' . $answers_type . '" name="answer[' . $element->id . ']" value="0">'
										. '<span class="basic-answer-content">'
											. '<span class="basic-text">'
											. esc_html( $element->meta_data['otherAnswersLabel'] )
											. '<br/>'
											. '<input class="basic-input-text form-control" type="text" name="other[' . $element->id . ']" data-type="other-answer">'
											. '</span>'
										. '</span>'
									. '</label>'
								. '</div>'
							. '</div>';
			if ( 0 === ( $defined_answers_count % $answers_per_row ) )  {
				$element_answers .= '</div>';
			}
		}
		$element_answers .= '</div>';
		return $element_answers;
	}
	public static function do_text_block( $element, $poll_meta_data, $params ) {
		if ( '1' !== $params['show_results'] ) {
			$poll_element = '<div class="basic-element basic-text-block" data-type="text-block">' .  $element->etext . '</div>';
		} else {
			$poll_element = '';
		}
		return $poll_element;
	}
	public static function do_space_separator( $element, $poll_meta_data, $params ) {
		if ( '1' !== $params['show_results'] ) {
			$poll_element = '<div class="basic-element basic-separator basic-space" data-type="space-separator"></div>';
		} else {
			$poll_element = '';
		}
		return $poll_element;
	}
	public static function has_results_before_vote( $poll_meta_data ) {
		$show_results = false;
		if ( true === in_array( 'before-vote', $poll_meta_data['options']['results']['showResultsMoment'] ) ) {
			if ( true === in_array( 'custom-date', $poll_meta_data['options']['results']['showResultsMoment'] ) ) {
				$custom_date = new DateTime( $poll_meta_data['options']['results']['customDateResults'] );
				$today_date = new DateTime( 'now' );
				if ( $today_date >= $custom_date ) {
					$show_results = true;
				} else {
					$show_results = false;
				}
			} else {
				$show_results = true;
			}
		} else {
			$show_results = false;
		}
		if ( true === $show_results ) {
			if ( 1 === count( $poll_meta_data['options']['results']['showResultsTo'] ) ) {
				if ( 'registered' === $poll_meta_data['options']['results']['showResultsTo'][0] ) {
					if ( true === is_user_logged_in() ) {
						$show_results = true;
					} else {
						$show_results = false;
					}
				} else {
					$show_results = true;
				}
			} else {
				$show_results = true;
			}
		}
		return $show_results;
	}
	public static function should_display_results( $poll ) {
		$should_continue = true;
		$should_display_results = false;
		$current_user = wp_get_current_user();
		if ( ( 1 === count( $poll->meta_data['options']['results']['showResultsTo'] ) ) && ( true === in_array( 'registered', $poll->meta_data['options']['results']['showResultsTo'] ) ) ) {
			if ( 0 !== $current_user->ID ) {
				$should_continue = true;
			} else {
				$should_display_results = false;
				$should_continue = false;
			}
		}
		if ( ( true === $should_continue ) && ( true === in_array( 'never', $poll->meta_data['options']['results']['showResultsMoment'] ) ) ) {
			$should_display_results = false;
			$should_continue = false;
		}
		if ( ( true === $should_continue ) && ( true === in_array( 'before-vote', $poll->meta_data['options']['results']['showResultsMoment'] ) ) ) {
			$should_display_results = true;
			$should_continue = false;
		}
		if ( ( true === $should_continue ) && ( true === in_array( 'after-vote', $poll->meta_data['options']['results']['showResultsMoment'] ) ) ) {
			$should_display_results = true;
			$should_continue = false;
		}
		if ( ( true === $should_continue ) && ( true === in_array( 'after-end-date', $poll->meta_data['options']['results']['showResultsMoment'] ) ) ) {
			if ( true === YOP_Poll_Polls::is_ended( $poll, true ) ) {
				$should_display_results = true;
				$should_continue = false;
			} else {
				$should_display_results = false;;
				$should_continue = true;
			}
		}
		if ( ( true === $should_continue ) && ( true === in_array( 'custom-date', $poll->meta_data['options']['results']['showResultsMoment'] ) ) ) {
			$today = new DateTime( current_time( 'mysql' ) );
			$custom_date = new DateTime( $poll->meta_data['options']['results']['customDateResults'] );
			if ( $today >= $custom_date ) {
				$should_display_results = true;
				$should_continue = false;
			} else {
				$should_display_results = false;;
				$should_continue = true;
			}
		}
		return $should_display_results;
	}
	public static function prepare_ended_poll_for_display( $poll, $params ) {
		$poll_ready_for_output = '<div class="basic-yop-poll-container" style="'
									. 'background-color:' . esc_attr( $poll->meta_data['style']['poll']['backgroundColor'] ) . ';'
									. 'border:' . esc_attr( $poll->meta_data['style']['poll']['borderSize'] ) . 'px;'
									. 'border-style:solid;'
									. 'border-color:' . esc_attr( $poll->meta_data['style']['poll']['borderColor'] ) . ';'
									. 'border-radius:' . esc_attr( $poll->meta_data['style']['poll']['borderRadius'] ) . 'px;'
									. 'padding:' . esc_attr( $poll->meta_data['style']['poll']['padding'] ) . 'px;'
									. '">'
									. '<div class="basic-canvas"></div>'
									. '<div class="basic-inner">'
										. '<div class="basic-message" style="'
										. 'background-color:' . esc_attr( $poll->meta_data['style']['errors']['backgroundColor'] ) . ';'
										. 'border:' . esc_attr( $poll->meta_data['style']['errors']['borderSize'] ) . 'px;'
										. 'border-style:solid;'
										. 'border-color:' . esc_attr( $poll->meta_data['style']['errors']['borderColor'] ) . ';'
										. 'border-radius:' . esc_attr( $poll->meta_data['style']['errors']['borderRadius'] ) . 'px;'
										. 'padding:' . esc_attr( $poll->meta_data['style']['errors']['padding'] ) . 'px;'
										. 'color:' . esc_attr( $poll->meta_data['style']['errors']['textColor'] ) . ';'
										. 'font-size:' . esc_attr( $poll->meta_data['style']['errors']['textSize'] ) . ';"'
										. '">'
											. '<p>' . __( 'This poll is no longer accepting votes', 'yop-poll' ) . '</p>'
										. '</div>'
									. '</div>';
		return $poll_ready_for_output;
	}
	public static function prepare_not_started_poll_for_display( $poll, $params ) {
		$poll_ready_for_output = '<div class="basic-yop-poll-container" style="'
									. 'background-color:' . esc_attr( $poll->meta_data['style']['poll']['backgroundColor'] ) . ';'
									. 'border:' . esc_attr( $poll->meta_data['style']['poll']['borderSize'] ) .'px;'
									. 'border-style:solid;'
									. 'border-color:' . esc_attr( $poll->meta_data['style']['poll']['borderColor'] ) .';'
									. 'border-radius:' . esc_attr( $poll->meta_data['style']['poll']['borderRadius'] ) .'px;'
									. 'padding:' . esc_html( $poll->meta_data['style']['poll']['padding'] ) .'px;'
									. '">'
									. '<div class="basic-canvas"></div>'
									. '<div class="basic-inner">'
										. '<div class="basic-message" style="'
										. 'background-color:' . esc_html( $poll->meta_data['style']['errors']['backgroundColor'] ) . ';'
										. 'border:' . esc_html( $poll->meta_data['style']['errors']['borderSize'] ) . 'px;'
										. 'border-style:solid;'
										. 'border-color:' . esc_html( $poll->meta_data['style']['errors']['borderColor'] ) . ';'
										. 'border-radius:' . esc_html( $poll->meta_data['style']['errors']['borderRadius'] ) . 'px;'
										. 'padding:' . esc_html( $poll->meta_data['style']['errors']['padding'] ) . 'px;'
										. 'color:' . esc_attr( $poll->meta_data['style']['errors']['textColor'] ) . ';'
										. 'font-size:' . esc_attr( $poll->meta_data['style']['errors']['textSize'] ) . ';"'
										. '">'
											. '<p>' . __( 'This poll is not accepting votes yet', 'yop-poll' ) . '</p>'
										. '</div>'
									. '</div>';
		return $poll_ready_for_output;
	}
	public static function prepare_regular_view_for_display( $poll, $params ) {
		$poll_elements = '';
		foreach ( $poll->elements as $element ) {
			switch ( $element->etype ) {
				case 'text-question': {
					$poll_elements .= self::do_text_question( $element, $poll->meta_data, $params );
					break;
				}
				case 'custom-field': {
					$poll_elements .= self::do_custom_field( $element, $poll->meta_data, $params );
					break;
				}
				case 'media-question': {
					$poll_elements .= self::do_media_question( $element, $poll->meta_data, $params );
					break;
				}
				case 'space-separator': {
					$poll_elements .= self::do_space_separator( $element, $poll->meta_data, $params );
					break;
				}
				case 'text-block': {
					$poll_elements .= self::do_text_block( $element, $poll->meta_data, $params );
					break;
				}
			}
		}
		if ( false === isset( $params['tid'] )  ) {
			$params['tid'] = '';
		}
		if ( false === isset( $poll->meta_data['style']['answers']['skin'] ) ) {
			$poll->meta_data['style']['answers']['skin'] = '';
		}
		if ( false === isset( $poll->meta_data['style']['answers']['colorScheme'] ) ) {
			$poll->meta_data['style']['answers']['colorScheme'] = '';
		}
		if ( true === isset( $params['show_results'] ) && ( '1' === $params['show_results'] ) ) {
			$show_results_only = 'true';
			$show_results_only_class = 'hide';
		} else {
			$show_results_only = 'false';
			$show_results_only_class = '';
		}
		$results_before_vote_data = 'data-show-results-to="' . implode( ',', $poll->meta_data['options']['results']['showResultsTo'] ) . '"'
			. 'data-show-results-moment="' . implode( ',', $poll->meta_data['options']['results']['showResultsMoment'] ) . '"'
			. 'data-show-results-only="' . $show_results_only . '"'
			. 'data-show-results-as="' . $poll->meta_data['options']['results']['displayResultsAs'] . '"'
			. 'data-sort-results-by="' . $poll->meta_data['options']['results']['sortResults'] . '"'
			. 'data-sort-results-rule="' . $poll->meta_data['options']['results']['sortResultsRule'] . '"';
		$poll_show_results_link = self::do_show_results_link( $poll );
		$poll_show_back_to_vote_link = self::do_show_back_to_vote_link( $poll );
		$total_votes_and_answers = self::do_show_total_votes_and_answers( $poll, $params );
		$use_captcha = self::has_captcha( $poll, $params );
		$poll_ready_for_output = '<div class="basic-yop-poll-container" style="'
									. 'background-color:' . esc_attr( $poll->meta_data['style']['poll']['backgroundColor'] ) . ';'
									. 'border:' . esc_attr( $poll->meta_data['style']['poll']['borderSize'] ) .'px;'
									. 'border-style:solid;'
									. 'border-color:' . esc_attr( $poll->meta_data['style']['poll']['borderColor'] ) .';'
									. 'border-radius:' . esc_attr( $poll->meta_data['style']['poll']['borderRadius'] ) .'px;'
									. 'padding:' . esc_attr( $poll->meta_data['style']['poll']['padding'] ) .'px;"'
									. 'data-id="' . esc_attr( $poll->id ) . '"'
									. 'data-temp="' . esc_html( $poll->template_base ) .'"'
									. 'data-skin="' . esc_html( $poll->meta_data['style']['answers']['skin'] ) . '"'
									. 'data-cscheme="' . esc_html( $poll->meta_data['style']['answers']['colorScheme'] ) . '"'
									. 'data-cap="' . esc_attr( $use_captcha[0] ) . '"'
									. 'data-access="' . esc_attr( implode( ',', $poll->meta_data['options']['access']['votePermissions'] ) ) . '"'
									. 'data-tid="' . esc_attr( $params['tid'] ) . '"'
									. 'data-uid="' . esc_attr( $use_captcha[2] ) . '"'
									. 'data-resdet="' . esc_attr( implode( ',', $poll->meta_data['options']['results']['resultsDetails'] ) ) . '"'
									. $results_before_vote_data
									. 'data-gdpr="' . $poll->meta_data['options']['poll']['enableGdpr'] . '"'
									. 'data-gdpr-sol="' . $poll->meta_data['options']['poll']['gdprSolution'] . '"'
									. '>'
									. '<div class="basic-canvas"></div>'
									. '<div class="basic-inner">'
										. '<div class="basic-message hide" style="'
										. 'background-color:' . esc_attr( $poll->meta_data['style']['errors']['backgroundColor'] ) . ';'
										. 'border:' . esc_attr( $poll->meta_data['style']['errors']['borderSize'] ) . 'px;'
										. 'border-style:solid;'
										. 'border-color:' . esc_attr( $poll->meta_data['style']['errors']['borderColor'] ) . ';'
										. 'border-radius:' . esc_attr( $poll->meta_data['style']['errors']['borderRadius'] ) . 'px;'
										. 'padding:' . esc_attr( $poll->meta_data['style']['errors']['padding'] ) . 'px;'
										. 'color:' . esc_attr( $poll->meta_data['style']['errors']['textColor'] ) . ';'
										. 'font-size:' . esc_attr( $poll->meta_data['style']['errors']['textSize'] ) . ';"'
										. '">'
											. '<p></p>'
										. '</div>'
										. '<div class="basic-overlay hide">'
											. '<div class="basic-vote-options">'
												. self::do_anonymous_vote( $poll )
												. self::do_wordpress_vote( $poll )
												. self::do_facebook_vote( $poll )
												. self::do_google_vote( $poll )
											. '</div>'
											. '<div class="basic-preloader hide">'
												. '<div class="basic-windows8">'
													. '<div class="basic-wBall basic-wBall_1">'
														. '<div class="basic-wInnerBall"></div>'
													. '</div>'
													. '<div class="basic-wBall basic-Ball_2">'
														. '<div class="basic-wInnerBall"></div>'
													. '</div>'
													. '<div class="basic-wBall basic-wBall_3">'
														. '<div class="basic-wInnerBall"></div>'
													. '</div>'
													. '<div class="basic-wBall basic-wBall_4">'
														. '<div class="basic-wInnerBall"></div>'
													. '</div>'
													. '<div class="basic-wBall basic-wBall_5">'
														. '<div class="basic-wInnerBall"></div>'
													. '</div>'
												. '</div>'
											. '</div>'
										. '</div>'
										. '<form class="basic-form">'
											. '<input type="hidden" name="_token" value="' . wp_create_nonce( 'yop-poll-vote-' . $poll->id ) . '">'
											. '<div class="basic-elements">'
												. $poll_elements
											. '</div>'
											. self::get_gdpr_html( $poll )
											. $use_captcha[1]
											. $total_votes_and_answers
											. '<div class="basic-vote ' . $show_results_only_class . '">'
												. '<a href="#" class="button basic-vote-button" style="'
												. 'background:' . esc_attr( $poll->meta_data['style']['buttons']['backgroundColor'] ) . ';'
												. 'border:' . esc_attr( $poll->meta_data['style']['buttons']['borderSize'] ) . 'px;'
												. 'border-style: solid;'
												. 'border-color:' . esc_attr( $poll->meta_data['style']['buttons']['borderColor'] ) . ';'
												. 'border-radius:' . esc_attr( $poll->meta_data['style']['buttons']['borderRadius'] ) . 'px;'
												. 'padding:' . esc_attr( $poll->meta_data['style']['buttons']['padding'] ) . 'px;'
												. 'color:' . esc_attr( $poll->meta_data['style']['buttons']['textColor'] ) . ';'
												. 'font-size:' . esc_attr( $poll->meta_data['style']['answers']['textSize'] ) . ';'
												. '">' . esc_html( $poll->meta_data['options']['poll']['voteButtonLabel'] ) . '</a>'
												. $poll_show_results_link
												. $poll_show_back_to_vote_link
											. '</div>'
										. '</form>'
									. '</div>'
								. '</div>';
		return $poll_ready_for_output;
	}
	public static function prepare_thankyou_view_for_display( $poll, $params ) {
		$poll_ready_for_output = '<div class="basic-yop-poll-container" style="'
									. 'background-color:' . esc_attr( $poll->meta_data['style']['poll']['backgroundColor'] ) . ';'
									. 'border:' . esc_attr( $poll->meta_data['style']['poll']['borderSize'] ) .'px;'
									. 'border-style:solid;'
									. 'border-color:' . esc_attr( $poll->meta_data['style']['poll']['borderColor'] ) .';'
									. 'border-radius:' . esc_attr( $poll->meta_data['style']['poll']['borderRadius'] ) .'px;'
									. 'padding:' . esc_html( $poll->meta_data['style']['poll']['padding'] ) .'px;'
									. '">'
									. '<div class="basic-canvas"></div>'
									. '<div class="basic-inner">'
										. '<div class="basic-message" style="'
										. 'background-color:' . esc_html( $poll->meta_data['style']['errors']['backgroundColor'] ) . ';'
										. 'border:' . esc_html( $poll->meta_data['style']['errors']['borderSize'] ) . 'px;'
										. 'border-style:solid;'
										. 'border-color:' . esc_html( $poll->meta_data['style']['errors']['borderColor'] ) . ';'
										. 'border-radius:' . esc_html( $poll->meta_data['style']['errors']['borderRadius'] ) . 'px;'
										. 'padding:' . esc_html( $poll->meta_data['style']['errors']['padding'] ) . 'px;'
										. 'color:' . esc_attr( $poll->meta_data['style']['errors']['textColor'] ) . ';'
										. 'font-size:' . esc_attr( $poll->meta_data['style']['errors']['textSize'] ) . ';"'
										. '">'
											. '<p>' . __( 'Thank you for your vote(s)', 'yop-poll' ) . '</p>'
										. '</div>'
									. '</div>';
		return $poll_ready_for_output;
	}
	public static function create_poll_view( $poll, $params ) {
		$poll_ready_for_output = '';
		$should_continue = true;
		$current_user = wp_get_current_user();
		if ( ( true === $should_continue ) && ( true === YOP_Poll_Polls::is_ended_frontend( $poll ) ) ) {
			//poll has ended
			if ( true === self::should_display_results( $poll ) ) {
				$params['show_results'] = '1';
				$poll_ready_for_output = self::prepare_regular_view_for_display( $poll, $params );
			} else {
				$poll_ready_for_output = self::prepare_ended_poll_for_display( $poll, $params );
			}
			$should_continue = false;
		}
		if ( ( true === $should_continue ) && ( false === YOP_Poll_Polls::has_started_frontend( $poll ) ) ) {
			//not started yet
			$poll_ready_for_output = self::prepare_not_started_poll_for_display( $poll, $params );
			$should_continue = false;
		}
		if ( true === $should_continue ) {
			if ( ( 'yes' === $poll->meta_data['options']['access']['limitVotesPerUser'] ) && ( $poll->meta_data['options']['access']['votesPerUserAllowed'] > 0 ) ) {
				if ( 0 !== $current_user->ID ) {
					$accept_votes_from_user = YOP_Poll_Polls::accept_votes_from_user( $poll, $current_user->ID, 'wordpress' );
					if ( true === $accept_votes_from_user ) {
						//accepting votes from this user. showing regular poll
						$poll_ready_for_output = self::prepare_regular_view_for_display( $poll, $params );
					} else {
						//no longer accepting votes from this user. need to decide what to do
						if ( true === self::should_display_results( $poll ) ) {
							$params['show_results'] = '1';
							$poll_ready_for_output = self::prepare_regular_view_for_display( $poll, $params );
						} else {
							$poll_ready_for_output = self::prepare_thankyou_view_for_display( $poll, $params );
						}
					}
				} else {
					$poll_ready_for_output = self::prepare_regular_view_for_display( $poll, $params );
				}
			} elseif ( ( true === in_array( 'by-cookie',  $poll->meta_data['options']['access']['blockVoters'] ) ) ||
						( true === in_array( 'by-ip',  $poll->meta_data['options']['access']['blockVoters'] ) ) ||
						( true === in_array( 'by-user-id',  $poll->meta_data['options']['access']['blockVoters'] ) )
		 	) {
				$current_user = wp_get_current_user();
				$vote = new \stdClass();
				$vote->pollId = $poll->id;
				$vote->user = new \stdClass();
				$vote->user->id = ( $current_user->ID != 0 ) ? $current_user->ID : '';
				$vote->user->c_data = YOP_Poll_Votes::get_voter_cookie( $poll->id );
				$vote->user->ipaddress = YOP_Poll_Votes::get_voter_ip( $poll );
				if ( true === YOP_Poll_Votes::validate_voter_against_blocks( $vote, $poll ) ) {
					if ( true === self::should_display_results( $poll ) ) {
						$params['show_results'] = '1';
						$poll_ready_for_output = self::prepare_regular_view_for_display( $poll, $params );
					} else {
						$poll_ready_for_output = self::prepare_thankyou_view_for_display( $poll, $params );
					}
				} else {
					$poll_ready_for_output = self::prepare_regular_view_for_display( $poll, $params );
				}
			} else {
				$poll_ready_for_output = self::prepare_regular_view_for_display( $poll, $params );
			}
		}
		return $poll_ready_for_output;
	}
}
