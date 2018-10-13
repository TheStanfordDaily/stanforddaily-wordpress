<?php
class YOP_Poll_Bans {
	private static $errors_present = false,
			$error_text,
			$by_allowed = array( 'ip', 'email', 'username' ),
			$for_allowed = array( 'hours', 'days', 'weeks', 'months' ),
			$sort_order_allowed = array( 'asc', 'desc' ),
			$order_by_allowed = array( 'id', 'name', 'author', 'ban_by', 'ban_value', 'ban_date' ),
			$bans_per_page = 10;
	public static function get_owner( $ban_id ) {
		$query = $GLOBALS['wpdb']->prepare(
			"SELECT * FROM {$GLOBALS['wpdb']->yop_poll_bans} WHERE `id` = %s", $ban_id
		);
		$ban = $GLOBALS['wpdb']->get_row( $query, OBJECT );
		if( null !== $ban ){
			return $ban->author;
		} else {
			return false;
		}
	}
	public static function paginate( $params ) {
		$return_data = array();
		$total_pages = 0;
		$total_polls = 0;
		$current_user = wp_get_current_user();
		if ( current_user_can( 'yop_poll_results_others' ) ) {
			$query = "SELECT COUNT(*) FROM {$GLOBALS['wpdb']->yop_poll_bans}";
			if ( isset( $params['q'] ) && ( '' !== $params['q'] ) ) {
				$params['q'] = "'" . '%' . esc_sql( $GLOBALS['wpdb']->esc_like( $params['q'] ) ) . '%' . "'";
				$query .= " WHERE `b_value` LIKE {$params['q']}";
			}
		} else if ( current_user_can( 'yop_poll_results_own' ) ) {
			$query = "SELECT COUNT(*) FROM {$GLOBALS['wpdb']->yop_poll_bans} WHERE `author` = '" . $current_user->ID . "'";
			if ( isset( $params['q'] ) && ( '' !== $params['q'] ) ) {
				$params['q'] = "'" . '%' . esc_sql( $GLOBALS['wpdb']->esc_like( $params['q'] ) ) . '%' . "'";
				$query .= " AND `b_value` LIKE {$params['q']}";
			}
		}
		if ( '' !== $query ) {
			$total_bans = $GLOBALS['wpdb']->get_var( $query );
		}
		if ( 0 < $total_bans ) {
			if ( $total_bans <= self::$bans_per_page ) {
				$data['pagination'] = '';
				$page = 1;
				$total_pages = 1;
			} else {
				$total_pages = intval( ceil( $total_bans / self::$bans_per_page ) );
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
								'action' => false,
								'ban_id' => false,
								'_token' => false,
								'order_by' => $params['order_by'],
								'sort_order' => $params['sort_order'],
								'q' => htmlentities( $params['q'] ),
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
									'action' => false,
									'ban_id' => false,
									'_token' => false,
									'order_by' => $params['order_by'],
									'sort_order' => $params['sort_order'],
									'q' => htmlentities( $params['q'] ),
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
								'action' => false,
								'ban_id' => false,
								'_token' => false,
								'order_by' => $params['order_by'],
								'sort_order' => $params['sort_order'],
								'q' => htmlentities( $params['q'] ),
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
									'action' => false,
									'ban_id' => false,
									'_token' => false,
									'order_by' => $params['order_by'],
									'sort_order' => $params['sort_order'],
									'q' => htmlentities( $params['q'] ),
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
								'action' => false,
								'ban_id' => false,
								'_token' => false,
								'order_by' => $params['order_by'],
								'sort_order' => $params['sort_order'],
								'q' => htmlentities( $params['q'] ),
								'page_no' => $params['page_no']-1
							)
						)
					);
				$links['next_page'] = esc_url(
						add_query_arg(
							array(
								'action' => false,
								'ban_id' => false,
								'_token' => false,
								'order_by' => $params['order_by'],
								'sort_order' => $params['sort_order'],
								'q' => htmlentities( $params['q'] ),
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
									'action' => false,
									'ban_id' => false,
									'_token' => false,
									'order_by' => $params['order_by'],
									'sort_order' => $params['sort_order'],
									'q' => htmlentities( $params['q'] ),
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
									'action' => false,
									'ban_id' => false,
									'_token' => false,
									'order_by' => $params['order_by'],
									'sort_order' => $params['sort_order'],
									'q' => htmlentities( $params['q'] ),
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
			'total_bans' => $total_bans,
			'total_pages' => $total_pages,
			'pagination' => $pagination
		);
	}
	public static function get_bans( $params ) {
		$query = '';
		$bans = '';
		$current_user = wp_get_current_user();
		if ( 0 >= intval( $params['page_no'] ) ) {
			$params['page_no'] = 1;
		}
		$pagination = self::paginate( $params );
		if ( !in_array( $params['sort_order'], self::$sort_order_allowed ) ) {
			$params['sort_order'] = SORT_ASC;
		} elseif ( 'desc' === $params['sort_order'] ) {
			$params['sort_order'] = SORT_DESC;
		} else{
			$params['sort_order'] = SORT_ASC;
		}
		if ( !in_array( $params['order_by'], self::$order_by_allowed ) ) {
			$params['order_by'] = 'id';
		}
		if ( $params['page_no'] > $pagination['total_pages']) {
			$params['page_no'] = 1;
		}
		$limit = self::$bans_per_page * ( $params['page_no'] - 1 );
		$limit_query = " LIMIT {$limit}, ". self::$bans_per_page;
		if ( current_user_can( 'yop_poll_results_others' ) ) {
			$query = "SELECT bans.id, bans.poll_id, bans.author, bans.b_by, bans.b_value, bans.added_date,"
						. " polls.name"
			 			. " FROM {$GLOBALS['wpdb']->yop_poll_bans} as bans LEFT JOIN {$GLOBALS['wpdb']->yop_poll_polls} as polls"
						. " ON bans.`poll_id` = polls.`id`";
			if ( isset( $params['q'] ) && ( '' !== $params['q'] ) ) {
				$params['q'] = "'" . '%' . esc_sql( $GLOBALS['wpdb']->esc_like( $params['q'] ) ) . '%' . "'";
				$query .= " WHERE `b_value` LIKE {$params['q']}";
			}
		} else if ( current_user_can( 'yop_poll_results_own' ) ) {
			$query = "SELECT * FROM {$GLOBALS['wpdb']->yop_poll_bans} LEFT JOIN {$GLOBALS['wpdb']->yop_poll_polls}"
						. " ON {$GLOBALS['wpdb']->yop_poll_bans}.`poll_id` = {$GLOBALS['wpdb']->yop_poll_polls}.`id`"
						. " WHERE {$GLOBALS['wpdb']->yop_poll_bans}.`author`=" . $current_user->ID;
			if ( isset( $params['q'] ) && ( '' !== $params['q'] ) ) {
				$params['q'] = "'" . '%' . esc_sql( $GLOBALS['wpdb']->esc_like( $params['q'] ) ) . '%' . "'";
				$query .= " AND `b_value` LIKE {$params['q']}";
			}
		}
		if ( '' !== $query ) {
			$query .= $limit_query;
			$bans = $GLOBALS['wpdb']->get_results( $query, ARRAY_A );
		}
		foreach ( $bans as &$ban ) {
			$ban_author = get_user_by( 'id', $ban['author'] );
			$ban['author'] = $ban_author->display_name;
		}
		foreach ( $bans as $key => $row ) {
			$order_by['id'][$key] = $row['id'];
			$order_by['name'][$key] = $row['name'];
			$order_by['author'][$key] = $row['author'];
			$order_by['ban_by'][$key] = $row['b_by'];
			$order_by['ban_value'][$key] = $row['b_value'];
			$order_by['ban_date'][$key] = $row['added_date'];
		}
		if ( 0 < count( $bans ) ) {
			array_multisort( $order_by[$params['order_by']], $params['sort_order'], $bans );
		}
		return array(
			'bans' => $bans,
			'total_bans' => $pagination['total_bans'],
			'total_pages' => $pagination['total_pages'],
			'pagination' => $pagination['pagination']
		);
	}
	public static function add( $ban ) {
		self::validate_data( $ban->ban );
		$current_user = wp_get_current_user();
		if ( false === self::$errors_present ) {
			$data = array(
				'author' => $current_user->ID,
				'poll_id' => $ban->ban->poll_id,
				'b_by' => $ban->ban->b_by,
				'b_value' => $ban->ban->b_value,
				'added_date' => current_time( 'mysql' ),
				'modified_date' => current_time( 'mysql' )
			);
			if ( false !== $GLOBALS['wpdb']->insert( $GLOBALS['wpdb']->yop_poll_bans, $data ) ) {
				self::$errors_present = false;
			} else {
				self::$errors_present = true;
				self::$error_text = __( 'Error adding ban', 'yop-poll' );
			}
		}
		return array(
			'success' => !self::$errors_present,
			'error' => self::$error_text
		);
	}
	public static function update( stdClass $ban ) {
		$ban_id = $ban->ban->id;
		$current_user = wp_get_current_user();
		if ( intval( $ban_id ) > 0 ) {
			$elements_result = array();
			self::validate_data( $ban->ban );
			if ( false === self::$errors_present ) {
				$data = array(
					'author' => $current_user->ID,
					'poll_id' => $ban->ban->poll_id,
					'b_by' => $ban->ban->b_by,
					'b_value' => $ban->ban->b_value,
					'modified_date' => current_time( 'mysql' )
				);
				if ( false !== $GLOBALS['wpdb']->update( $GLOBALS['wpdb']->yop_poll_bans, $data, array( 'id' => $ban_id ) ) ) {
					self::$errors_present = false;
				} else {
					self::$errors_present = true;
					self::$error_text = __( 'Error updating ban', 'yop-poll' );
				}
			}
		} else {
			self::$errors_present = true;
			self::$error_text = __( 'Error updating poll', 'yop-poll' );
		}
		return array(
			'success' => !self::$errors_present,
			'error' => self::$error_text
		);
	}
	public static function delete( $ban_id ) {
		$delete_ban_result = $GLOBALS['wpdb']->delete(
			$GLOBALS['wpdb']->yop_poll_bans,
			array(
				'id' => $ban_id
			)
		);
		if ( false !== $delete_ban_result ) {
			self::$errors_present = false;
		} else {
			self::$errors_present = true;
			self::$error_text = __( 'Error deleting ban', 'yop-poll' );
		}
		return array(
			'success' => !self::$errors_present,
			'error' => self::$error_text
		);
	}
	public static function delete_all_for_poll( $poll_id ) {
		if ( isset( $poll_id ) && ( 0 < intval( $poll_id ) ) ) {
			$delete_bans_result = $GLOBALS['wpdb']->delete(
				$GLOBALS['wpdb']->yop_poll_bans,
				array(
					'poll_id' => $poll_id
				)
			);
			if ( false !== $delete_bans_result ) {
				self::$errors_present = false;
			} else {
				self::$errors_present = true;
				self::$error_text = __( 'Error deleting bans', 'yop-poll' );
			}
		} else {
			self::$errors_present = true;
			self::$error_text = __( 'Invalid poll', 'yop-poll' );
		}
		return array(
			'success' => !self::$errors_present,
			'error' => self::$error_text
		);
	}
	public static function get_ban( $ban_id ) {
		$query = $GLOBALS['wpdb']->prepare(
			"SELECT * FROM {$GLOBALS['wpdb']->yop_poll_bans} WHERE `id` = %s", $ban_id
		);
		$ban = $GLOBALS['wpdb']->get_row( $query, OBJECT );
		if( null !== $ban ){
			return array(
				'ban' => $ban
			);
		} else {
			return false;
		}
	}
	public static function validate_data( $ban ) {
		if ( false === is_object( $ban ) ) {
			self::$errors_present = true;
			self::$error_text = __( 'Invalid data', 'yop-poll' );
		} else {
			if (
				( false === self::$errors_present ) &&
				( !isset( $ban->poll_id ) ||
				( '' === trim( $ban->poll_id ) ) )
			) {
				self::$errors_present = true;
				self::$error_text = __( 'Data for "Poll" is invalid', 'yop-poll' );
			}
			if (
				( false === self::$errors_present ) &&
				( !isset( $ban->b_by ) ||
				( '' === trim( $ban->b_by ) ) ||
				( false === in_array( $ban->b_by, self::$by_allowed ) )
				)
			) {
				self::$errors_present = true;
				self::$error_text = __( 'Data for "Ban by" is invalid', 'yop-poll' );
			}
			if (
				( false === self::$errors_present ) &&
				( !isset( $ban->b_value ) ||
				( '' === trim( $ban->b_value ) ) )
			) {
				self::$errors_present = true;
				self::$error_text = __( 'Data for "Ban Value" is invalid', 'yop-poll' );
			}
		}
	}
}
