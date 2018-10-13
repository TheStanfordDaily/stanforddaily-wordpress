<?php
class YOP_POLL_Elements {
	private static $errors_present = false,
		$error_text,
		$order_by_allowed = array( 'etext', 'sorder' ),
		$sort_rule_allowed = array( 'ASC', 'DESC' );
	public static function add( $poll_id, $elements, $is_imported = false ) {
		$display_order = 1;
		$element_id = 0;
		$current_user = wp_get_current_user();
		foreach( $elements as $element ) {
			if ( false === self::$errors_present ) {
				$data = array(
					'poll_id' => $poll_id,
					'etext' => ( isset( $element->text ) && ( '' !== $element->text ) ) ? $element->text : '',
					'author' => $current_user->ID,
					'etype' => $element->type,
					'status' => 'active',
					'sorder' => $display_order,
					'meta_data' => serialize( self::create_meta_data( $element ) ),
					'added_date' => current_time( 'mysql' ),
					'modified_date' => current_time( 'mysql' )
				);
				if ( $is_imported ) {
					$data['id'] = $element->ID;
					$data['sorder'] = $element->poll_order;
				}
				if ( false !== $GLOBALS['wpdb']->insert( $GLOBALS['wpdb']->yop_poll_elements, $data ) ) {
					$element_id = $GLOBALS['wpdb']->insert_id;
					if (  ( 'text-question' == $element->type ) || ( 'media-question' === $element->type ) ) {
						if( $is_imported )
							$sub_elements_result = YOP_Poll_SubElements::add( $poll_id, $element_id, $element->answers, true );
						else
							$sub_elements_result = YOP_Poll_SubElements::add( $poll_id, $element_id, $element->answers );
						self::$errors_present = $sub_elements_result['errors_present'];
						self::$error_text = $sub_elements_result['error_text'];
					}
				} else {
					self::$errors_present = true;
					self::$error_text = __( 'Error adding element', 'yop-poll' );
				}
				$display_order++;
			}
		}
		return array(
			'errors_present' => self::$errors_present,
			'error_text' => self::$error_text
		);
	}

	public static function update( $poll_id, $elements ) {
		$display_order = 1;
		$element_id = 0;
		$query_result_error = false;
		$current_user = wp_get_current_user();
		foreach( $elements as $element ) {
			if ( false === self::$errors_present ) {
				$data = array(
					'poll_id' => $poll_id,
					'etext' => ( isset( $element->text ) && ( '' !== $element->text ) ) ? $element->text : '',
					'author' => $current_user->ID,
					'etype' => $element->type,
					'status' => 'active',
					'sorder' => $display_order,
					'meta_data' => serialize( self::create_meta_data( $element ) ),
					'modified_date' => current_time( 'mysql' )
				);
				if ( isset( $element->id ) && ( '' !== $element->id ) ) {
					//existing element. doing an update
					$query_result_error = $GLOBALS['wpdb']->update(
						$GLOBALS['wpdb']->yop_poll_elements,
						$data, array( 'id' => $element->id
						)
					);
					$element_id = $element->id;
				} else {
					//new element. doing an insert
					$data['added_date'] = current_time( 'mysql' );
					$query_result_error = $GLOBALS['wpdb']->insert( $GLOBALS['wpdb']->yop_poll_elements, $data );
					$element_id = $GLOBALS['wpdb']->insert_id;
				}
				if ( false !== $query_result_error ) {
					if ( true === in_array( $element->type, array( 'text-question', 'media-question' ) ) ) {
						$sub_elements_result = YOP_Poll_SubElements::update( $poll_id, $element_id, $element->answers );
						self::$errors_present = $sub_elements_result['errors_present'];
						self::$error_text = $sub_elements_result['error_text'];
					}
				} else {
					self::$errors_present = true;
					self::$error_text = __( 'Error updating element', 'yop-poll' );
				}
				if ( isset( $element->answersRemoved ) && ( '' !== $element->answersRemoved ) ) {
					$sub_elements_removed = explode( ',', $element->answersRemoved );
					foreach ( $sub_elements_removed as $sub_element_removed ) {
						YOP_Poll_SubElements::delete( $poll_id, $element_id, $sub_element_removed );
					}
				}
				$display_order++;
			}
		}
		return array(
			'errors_present' => self::$errors_present,
			'error_text' => self::$error_text
		);
	}

	public static function delete( $poll_id, $element_id ) {
		if ( 0 < intval( $element_id) ) {
			$data = array(
				'status' => 'deleted',
				'sorder' => '0'
			);
			$delete_result = $GLOBALS['wpdb']->update(
				$GLOBALS['wpdb']->yop_poll_elements,
				$data,
				array(
					'id' => $element_id,
					'poll_id' => $poll_id
				)
			);
			if ( false === $delete_result ) {
				self::$errors_present = true;
				self::$error_text = __( 'Error deleting element', 'yop-poll' );
			}
		} else {
			self::$errors_present = true;
			self::$error_text = __( 'Invalid element id', 'yop-poll' );
		}
		return array(
			'errors_present' => self::$errors_present,
			'error_text' => self::$error_text
		);
	}

	public static function delete_all_for_poll( $poll_id ) {
		$data = array(
			'status' => 'deleted',
			'sorder' => '0'
		);
		$delete_result = $GLOBALS['wpdb']->update(
			$GLOBALS['wpdb']->yop_poll_elements,
			$data,
			array(
				'poll_id' => $poll_id
			)
		);
		if ( false !== $delete_result ) {
			self::$errors_present = false;
		} else {
			self::$errors_present = true;
			self::$error_text = __( 'Error deleting element', 'yop-poll' );
		}
		return array(
			'errors_present' => self::$errors_present,
			'error_text' => self::$error_text
		);
	}

	public static function create_meta_data( $element ) {
		$return_data = '';
		switch ( $element->type ) {
			case 'text-question': {
				$return_data = array(
					'allowOtherAnswers' => $element->options->allowOtherAnswers,
					'otherAnswersLabel' => $element->options->otherAnswersLabel,
					'addOtherAnswers' => $element->options->addOtherAnswers,
					'displayOtherAnswersInResults' => $element->options->displayOtherAnswersInResults,
					'allowMultipleAnswers' => $element->options->allowMultipleAnswers,
					'multipleAnswersMinim' => $element->options->multipleAnswersMinim,
					'multipleAnswersMaxim' => $element->options->multipleAnswersMaxim,
					'answersDisplay' => $element->options->answersDisplay,
					'answersColumns' => $element->options->answersColumns
				);
				break;
			}
			case 'custom-field': {
			    if( property_exists( $element->options, 'old_id' ) ) {
                    $return_data = array(
                        'makeRequired' => $element->options->makeRequired,
                        'old_id'       => $element->options->old_id
                    );
                } else {
                    $return_data = array(
                        'makeRequired' => $element->options->makeRequired
                    );
                }
				break;
			}
			case 'media-question': {
				$return_data = array(
					'allowOtherAnswers' => $element->options->allowOtherAnswers,
					'otherAnswersLabel' => $element->options->otherAnswersLabel,
					'addOtherAnswers' => $element->options->addOtherAnswers,
					'displayOtherAnswersInResults' => $element->options->displayOtherAnswersInResults,
					'allowMultipleAnswers' => $element->options->allowMultipleAnswers,
					'multipleAnswersMinim' => $element->options->multipleAnswersMinim,
					'multipleAnswersMaxim' => $element->options->multipleAnswersMaxim,
					'answersDisplay' => $element->options->answersDisplay,
					'answersColumns' => $element->options->answersColumns
				);
				break;
			}
			case 'space-separator': {
				break;
			}
			case 'text-block': {
				break;
			}
		}
		return $return_data;
	}

	public static function get( $poll_id, $order_by, $sort_rule ) {
		if ( false === in_array( $order_by, self::$order_by_allowed ) ) {
			$order_by = 'sorder';
		}
		if ( false === in_array( $sort_rule, self::$sort_rule_allowed ) ) {
			$sort_rule = 'ASC';
		}
		$query = $GLOBALS['wpdb']->prepare(
			"SELECT * FROM {$GLOBALS['wpdb']->yop_poll_elements} WHERE `poll_id` = %s
			AND `status` = 'active' ORDER BY {$order_by} {$sort_rule} ",
			$poll_id
		);
		$elements = $GLOBALS['wpdb']->get_results( $query, OBJECT );
		if ( null !== $elements ) {
			foreach ( $elements as $element ) {
				$element->meta_data = unserialize( $element->meta_data );
			}
			return $elements;
		} else {
			return false;
		}
	}

	public static function clone_all( $old_poll_id, $new_poll_id ) {
		$current_user = wp_get_current_user();
		$query = $GLOBALS['wpdb']->prepare(
			"SELECT * from {$GLOBALS['wpdb']->yop_poll_elements} WHERE `poll_id`=%s", $old_poll_id
		);
		$elements = $GLOBALS['wpdb']->get_results( $query, OBJECT );
		if ( null !== $elements ) {
			foreach ( $elements as $element ) {
				$data = array(
					'poll_id' => $new_poll_id,
					'etext' => $element->etext,
					'author' => $current_user->ID,
					'etype' => $element->etype,
					'status' => $element->status,
					'sorder' => $element->sorder,
					'meta_data' => $element->meta_data,
					'added_date' => current_time( 'mysql' ),
					'modified_date' => current_time( 'mysql' )
				);
				if ( false !== $GLOBALS['wpdb']->insert( $GLOBALS['wpdb']->yop_poll_elements, $data ) ) {
					$new_element_id = $GLOBALS['wpdb']->insert_id;
					if ( true === in_array( $element->etype, array( 'text-question', 'media-question' ) ) ) {
						$sub_elements_result = YOP_Poll_SubElements::clone_all( $old_poll_id, $new_poll_id, $element->id, $new_element_id );
						self::$errors_present = $sub_elements_result['errors_present'];
						self::$error_text = $sub_elements_result['error_text'];
					}
				} else {
					self::$errors_present = true;
					self::$error_text = __( 'Error adding element', 'yop-poll' );
				}
			}
		}
	}

}
