<?php
class YOP_POLL_SubElements {
	private static $errors_present = false,
		$error_text,
		$order_by_allowed = array( 'stext', 'sorder', 'total_submits' ),
		$sort_rule_allowed = array( 'ASC', 'DESC' );
	public static function add_single( $sub_element ) {
		if ( '' !== $sub_element->poll_id ) {
			if ( '0' === $sub_element->sorder ) {
				$display_order = self::get_max_display( $sub_element->poll_id, $sub_element->element_id ) + 1;
			} else {
				$display_order = $sub_element->sorder;
			}
			$data = array(
				'poll_id' => $sub_element->poll_id,
				'element_id' => $sub_element->element_id,
				'stext' => $sub_element->stext,
				'author' => $sub_element->author,
				'stype' => $sub_element->type,
				'status' => $sub_element->status,
				'sorder' => $display_order,
				'meta_data' => serialize( self::create_meta_data( $sub_element ) ),
				'total_submits' => $sub_element->total_submits,
				'added_date' => current_time( 'mysql' ),
				'modified_date' => current_time( 'mysql' )
			);
			$GLOBALS['wpdb']->insert( $GLOBALS['wpdb']->yop_poll_subelements, $data );
		}
	}
	public static function add( $poll_id, $element_id, $sub_elements, $is_imported = false ) {
		$display_order = 1;
		$current_user = wp_get_current_user();
		foreach( $sub_elements as $sub_element ) {
			if ( false === self::$errors_present ) {
				$data = array(
					'poll_id' => $poll_id,
					'element_id' => $element_id,
					'stext' => $sub_element->text,
					'author' => $current_user->ID,
					'stype' => $sub_element->type,
					'status' => 'active',
					'sorder' => $display_order,
					'meta_data' => serialize( self::create_meta_data( $sub_element ) ),
					'total_submits' => '0',
					'added_date' => current_time( 'mysql' ),
					'modified_date' => current_time( 'mysql' )
				);
				if ( $is_imported) {
					$data['id'] = $sub_element->ID;
					if ( isset( $sub_element->is_other ) && true == $sub_element->is_other ) {
						$data['author'] = 0;
					}
				}
				if ( false === $GLOBALS['wpdb']->insert( $GLOBALS['wpdb']->yop_poll_subelements, $data ) ) {
					self::$errors_present = true;
					self::$error_text = __( 'Error adding answers', 'yop-poll' );
				}
				$display_order++;
			}
		}
		return array(
			'errors_present' => self::$errors_present,
			'error_text' => self::$error_text
		);
	}
	public static function update( $poll_id, $element_id, $sub_elements ) {
		$display_order = 1;
		$query_result_error = false;
		$current_user = wp_get_current_user();
		foreach( $sub_elements as $sub_element ) {
			if ( false === self::$errors_present ) {
				$data = array(
					'poll_id' => $poll_id,
					'element_id' => $element_id,
					'stext' => $sub_element->text,
					'author' => $current_user->ID,
					'stype' => $sub_element->type,
					'status' => 'active',
					'sorder' => $display_order,
					'meta_data' => serialize( self::create_meta_data( $sub_element ) ),
					'modified_date' => current_time( 'mysql' )
				);
				if ( isset( $sub_element->id ) && ( '' !== $sub_element->id ) ) {
					$query_result_error = $GLOBALS['wpdb']->update(
						$GLOBALS['wpdb']->yop_poll_subelements, $data,
						array( 'id' => $sub_element->id )
					);
				} else {
					$data['added_date'] = current_time( 'mysql' );
					$query_result_error = $GLOBALS['wpdb']->insert( $GLOBALS['wpdb']->yop_poll_subelements, $data );
				}
				if ( false === $query_result_error ) {
					self::$errors_present = true;
					self::$error_text = __( 'Error adding answers', 'yop-poll' );
				}
				$display_order++;
			}
		}
		return array(
			'errors_present' => self::$errors_present,
			'error_text' => self::$error_text
		);
	}
	public static function delete( $poll_id, $element_id, $sub_element_id ) {
		if ( 0 < intval( $sub_element_id) ) {
			$data = array(
				'status' => 'deleted',
				'sorder' => '0'
			);
			$delete_result = $GLOBALS['wpdb']->update(
				$GLOBALS['wpdb']->yop_poll_subelements,
				$data,
				array(
					'id' => $sub_element_id,
					'poll_id' => $poll_id,
					'element_id' => $element_id
				)
			);
			if ( false === $delete_result ) {
				self::$errors_present = true;
				self::$error_text = __( 'Error deleting answer', 'yop-poll' );
			}
		} else {
			self::$errors_present = true;
			self::$error_text = __( 'Invalid answer id', 'yop-poll' );
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
			$GLOBALS['wpdb']->yop_poll_subelements,
			$data,
			array(
				'poll_id' => $poll_id
			)
		);
		if ( false !== $delete_result ) {
			self::$errors_present = false;
		} else {
			self::$errors_present = true;
			self::$error_text = __( 'Error deleting answer', 'yop-poll' );
		}
		return array(
			'errors_present' => self::$errors_present,
			'error_text' => self::$error_text
		);
	}
	public static function delete_all_for_element( $poll_id, $element_id ) {
		$data = array(
			'status' => 'deleted',
			'sorder' => '0'
		);
		$delete_result = $GLOBALS['wpdb']->update(
			$GLOBALS['wpdb']->yop_poll_subelements,
			$data,
			array(
				'poll_id' => $poll_id,
				'element_id' => $element_id
			)
		);
		if ( false !== $delete_result ) {
			self::$errors_present = false;
		} else {
			self::$errors_present = true;
			self::$error_text = __( 'Error deleting answer', 'yop-poll' );
		}
		return array(
			'errors_present' => self::$errors_present,
			'error_text' => self::$error_text
		);
	}
	public static function create_meta_data( $sub_element ) {
		$return_data = array();
		switch ( $sub_element->type ) {
			case 'text': {
				$meta_data = array(
					'makeDefault' => $sub_element->options->makeDefault,
					'makeLink' => $sub_element->options->makeLink,
					'link' => $sub_element->options->link,
					'resultsColor' => $sub_element->options->resultsColor
				);
				break;
			}
			case 'image': {
				$meta_data = array(
					'makeDefault' => $sub_element->options->makeDefault,
					'makeLink' => $sub_element->options->makeLink,
					'addText' => $sub_element->options->addText,
					'text' => $sub_element->options->text,
					'resultsColor' => $sub_element->options->resultsColor
				);
				break;
			}
			case 'video': {
				$meta_data = array(
					'makeDefault' => $sub_element->options->makeDefault,
					'makeLink' => $sub_element->options->makeLink,
					'addText' => $sub_element->options->addText,
					'text' => $sub_element->options->text,
					'resultsColor' => $sub_element->options->resultsColor
				);
				break;
			}
		}
		return $meta_data;
	}
	public static function get( $poll_id, $order_by, $sort_rule ) {
		if ( false === in_array( $order_by, self::$order_by_allowed ) ) {
			$order_by = 'sorder';
		}
		if ( false === in_array( $order_by, self::$sort_rule_allowed ) ) {
			$sort_rule = 'ASC';
		}
		$query = $GLOBALS['wpdb']->prepare(
			"SELECT * FROM {$GLOBALS['wpdb']->yop_poll_subelements} WHERE `poll_id` = %s
			AND `status` = 'active' ORDER BY {$order_by} {$sort_rule}",
			$poll_id
		);
		$sub_elements = $GLOBALS['wpdb']->get_results( $query, OBJECT );
		if ( null !== $sub_elements ) {
			foreach ( $sub_elements as $sub_element ) {
				$sub_element->meta_data = unserialize( $sub_element->meta_data );
			}
			return $sub_elements;
		} else {
			return false;
		}
	}
	public static function clone_all( $old_poll_id, $new_poll_id, $old_element_id, $new_element_id ) {
		$current_user = wp_get_current_user();
		$query = $GLOBALS['wpdb']->prepare(
			"SELECT * FROM {$GLOBALS['wpdb']->yop_poll_subelements} WHERE `poll_id` = %s and `element_id`=%s", $old_poll_id, $old_element_id
		);
		$sub_elements = $GLOBALS['wpdb']->get_results( $query, OBJECT );
		if ( null !== $sub_elements ) {
			foreach ( $sub_elements as $sub_element ) {
				$data = array(
					'poll_id' => $new_poll_id,
					'element_id' => $new_element_id,
					'stext' => $sub_element->stext,
					'author' => $current_user->ID,
					'stype' => 'answer',
					'status' => $sub_element->status,
					'sorder' => $sub_element->sorder,
					'meta_data' => $sub_element->meta_data,
					'total_submits' => '0',
					'added_date' => current_time( 'mysql' ),
					'modified_date' => current_time( 'mysql' )
				);
				if ( false === $GLOBALS['wpdb']->insert( $GLOBALS['wpdb']->yop_poll_subelements, $data ) ) {
					self::$errors_present = true;
					self::$error_text = __( 'Error adding answers', 'yop-poll' );
				}
			}
		}
		return array(
			'errors_present' => self::$errors_present,
			'error_text' => self::$error_text
		);
	}
	public static function validate_order_by( $order_by ) {
		$valid_order_by = '';
		switch ( $order_by ) {
			case 'as-defined': {
				$valid_order_by = 'sorder';
				break;
			}
			case 'alphabetical': {
				$valid_order_by = 'stext';
				break;
			}
			case 'number-of-votes': {
				$valid_order_by = 'total_submits';
				break;
			}
			default: {
				$valid_order_by = 'sorder';
				break;
			}
		}
		return $valid_order_by;
	}
	public static function validate_order_rule( $order_rule ) {
		$valid_order_rule = '';
		switch ( $order_rule ) {
			case 'asc': {
				$valid_order_rule = 'ASC';
				break;
			}
			case 'desc': {
				$valid_order_rule = 'DESC';
				break;
			}
			default: {
				$valid_order_rule = 'ASC';
				break;
			}
		}
		return $valid_order_rule;
	}
	public static function get_max_display( $poll_id, $element_id ) {
		$query = $GLOBALS['wpdb']->prepare(
			"SELECT MAX(`sorder`) FROM {$GLOBALS['wpdb']->yop_poll_subelements} "
			. " WHERE `poll_id` = %s AND `element_id` = %s", $poll_id, $element_id
		);
		$max_display = $GLOBALS['wpdb']->get_var( $query );
		return ( null === $max_display ) ? 0 : intval( $max_display );
	}
	public static function exists( $poll_id, $element_id, $stext ) {
		$sub_element_exists = array();
		$query = $GLOBALS['wpdb']->prepare(
			"SELECT * from {$GLOBALS['wpdb']->yop_poll_subelements} "
			. "WHERE `poll_id` = %s AND `element_id` = %s "
			. "AND LOWER( `stext` ) = %s", $poll_id, $element_id, strtolower( $stext )
		);
		$sub_element = $GLOBALS['wpdb']->get_row( $query );
		if ( null === $sub_element ) {
			$sub_element_exists['status'] = false;
		} else {
			$sub_element_exists['status'] = true;
			$sub_element_exists['id'] = $sub_element->id;
		}
		return $sub_element_exists;
	}
	public static function add_vote( $sub_element_id ) {
		$query = $GLOBALS['wpdb']->prepare(
			"UPDATE {$GLOBALS['wpdb']->yop_poll_subelements} SET `total_submits` = `total_submits` + 1 "
			. "WHERE `id` = %s", $sub_element_id
		);
		$GLOBALS['wpdb']->query( $query );
	}
	public static function get_statistics( $poll_id, $order_by, $order_rule ) {
		$results = array();
		$total_poll_submits = 0;
		$elements = self::get( $poll_id, $order_by, $order_rule );
		foreach ( $elements as $element ) {
			$total_poll_submits += intval( $element->total_submits );
		}
		$i = 0;
		foreach ( $elements as $element ) {
			$results[$i]['id'] = $element->id;
			$results[$i]['votes'] = $element->total_submits;
			if ( 0 < intval( $total_poll_submits ) ) {
				if ( 0 ===  ( 100 * $element->total_submits % $total_poll_submits ) ) {
					$results[$i]['percentage'] = number_format( $element->total_submits / $total_poll_submits * 100, 0 );
				} else {
					$results[$i]['percentage'] = number_format( $element->total_submits / $total_poll_submits * 100, 2 );
				}
			} else {
				$results[$i]['percentage'] = 0;
			}
			$i++;
		}
		return $results;
	}
	public static function reset_submits_for_poll( $poll_id ) {
		$query = $GLOBALS['wpdb']->prepare(
			"UPDATE {$GLOBALS['wpdb']->yop_poll_subelements} SET `total_submits` = '0' WHERE `poll_id` = %s", $poll_id
		);
		$GLOBALS['wpdb']->query( $query );
	}
}
