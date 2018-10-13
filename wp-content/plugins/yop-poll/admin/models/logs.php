<?php
class YOP_Poll_Logs {
	private static $errors_present = false,
		$error_text,
		$sort_order_allowed = array( 'asc', 'desc' ),
		$order_by_allowed = array( 'name', 'user_id', 'email', 'user_type', 'ipaddress', 'added_date', 'vote_message' ),
		$logs_per_page = 10;
    private static $_instance = NULL;
    public static function get_instance() {
        if ( self::$_instance == NULL ){
            $class           = __CLASS__;
            self::$_instance = new $class;
        }
        return self::$_instance;
    }
	public static function add( $vote, $has_errors, $message ) {
		if ( false === $has_errors ) {
			array_push( $message, 'success' );
		}
		$data = array(
			'poll_id' => $vote->pollId,
			'poll_author' => $vote->pollAuthor,
			'user_id' => $vote->user->id,
			'user_email' => $vote->user->email,
			'user_type' => $vote->user->type,
			'ipaddress' => $vote->user->ipaddress,
			'tracking_id' => $vote->trackingId,
			'voter_id' => $vote->user->c_data,
			'voter_fingerprint' => $vote->user->f_data,
			'vote_data' => serialize( YOP_Poll_Votes::create_meta_data( $vote ) ),
			'vote_message' => serialize( $message ),
			'added_date' => $vote->added_date
		);
		$GLOBALS['wpdb']->insert( $GLOBALS['wpdb']->yop_poll_logs, $data );
	}
	public static function paginate( $params ) {
		$return_data = array();
		$total_pages = 0;
		$total_polls = 0;
		$query = '';
		$total_logs = 0;
		$current_user = wp_get_current_user();
		if ( current_user_can( 'yop_poll_results_others' ) ) {
			$query = "SELECT COUNT(*) FROM `{$GLOBALS['wpdb']->yop_poll_logs}` INNER JOIN `{$GLOBALS['wpdb']->yop_poll_polls}` ON ";
			$query .= "`{$GLOBALS['wpdb']->yop_poll_logs}`.`poll_id` = `{$GLOBALS['wpdb']->yop_poll_polls}`.`id`";
			if ( isset( $params['q'] ) && ( '' !== $params['q'] ) ) {
				$params['q'] = "'" . '%' . esc_sql( $GLOBALS['wpdb']->esc_like( $params['q'] ) ) . '%' . "'";
				$query .= " WHERE `user_email` LIKE {$params['q']}";
				$query .= " or `ipaddress` LIKE {$params['q']}";
                $query .= " or `name` LIKE {$params['q']}";
			}
		} else if ( current_user_can( 'yop_poll_results_own' ) ) {
			$query = "SELECT COUNT(*) FROM `{$GLOBALS['wpdb']->yop_poll_logs}` INNER JOIN `{$GLOBALS['wpdb']->yop_poll_polls}` ON ";
			$query .= "`{$GLOBALS['wpdb']->yop_poll_logs}`.`poll_id` = `{$GLOBALS['wpdb']->yop_poll_polls}`.`id`";
            $query .= "WHERE `author` = '" . $current_user->ID . "'";
			if ( isset( $params['q'] ) && ( '' !== $params['q'] ) ) {
				$params['q'] = "'" . '%' . esc_sql( $GLOBALS['wpdb']->esc_like( $params['q'] ) ) . '%' . "'";
                $query .= " AND (`user_email` LIKE {$params['q']}";
                $query .= " or `ipaddress` LIKE {$params['q']}";
                $query .= " or `name` LIKE {$params['q']})";
			}
		}
		if ( '' !== $query ) {
			$total_logs = $GLOBALS['wpdb']->get_var( $query );
		}
		if ( $total_logs > 0 ) {
			if ( $total_logs <= self::$logs_per_page ) {
				$data['pagination'] = '';
				$page = 1;
				$total_pages = 1;
			} else {
				$total_pages = intval( ceil( $total_logs / self::$logs_per_page ) );
			}
		} else {
			$data['pagination'] = '';
		}
		if ( $total_pages > 1 ){
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
			'total_logs' => $total_logs,
			'total_pages' => $total_pages,
			'pagination' => $pagination
		);
	}
	public static function get_logs( $params ) {
		$query = '';
		$logs = '';
		$order_by = [];
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
		$limit = self::$logs_per_page * ( $params['page_no'] - 1 );
		$limit_query = " LIMIT {$limit}, ". self::$logs_per_page;
		if ( current_user_can( 'yop_poll_results_others' ) ) {
			$query = "SELECT logs.*, polls.name FROM {$GLOBALS['wpdb']->yop_poll_logs}"
			         . " as logs LEFT JOIN {$GLOBALS['wpdb']->yop_poll_polls} as polls"
			         . " ON logs.`poll_id` = polls.`id`";
			if ( isset( $params['q'] ) && ( '' !== $params['q'] ) ) {
				$params['q'] = "'" . '%' . esc_sql( $GLOBALS['wpdb']->esc_like( $params['q'] ) ) . '%' . "'";
				$query .= " WHERE `ipaddress` LIKE {$params['q']}";
                $query .= " OR `user_email` LIKE {$params['q']}";
                $query .= " OR `name` LIKE {$params['q']}";
			}
		} else if ( current_user_can( 'yop_poll_results_own' ) ) {
			$query = "SELECT logs.*, polls.name FROM {$GLOBALS['wpdb']->yop_poll_logs} as logs LEFT JOIN {$GLOBALS['wpdb']->yop_poll_polls} as polls"
			         . " ON {$GLOBALS['wpdb']->yop_poll_logs}.`poll_id` = {$GLOBALS['wpdb']->yop_poll_polls}.`id`"
			         . " WHERE {$GLOBALS['wpdb']->yop_poll_logs}.`poll_author`=" . $current_user->ID;
			if ( isset( $params['q'] ) && ( '' !== $params['q'] ) ) {
				$params['q'] = "'" . '%' . esc_sql( $GLOBALS['wpdb']->esc_like( $params['q'] ) ) . '%' . "'";
                $query .= " AND (`ipaddress` LIKE {$params['q']}";
                $query .= " OR `user_email` LIKE {$params['q']}";
                $query .= " OR `name` LIKE {$params['q']})";
			}
		}
		if ( '' !== $query ) {
			$query .= $limit_query;
			$logs = $GLOBALS['wpdb']->get_results( $query, ARRAY_A );
            foreach ( $logs as $key => $row ) {
                $log_message = unserialize( $row['vote_message'] );
                $order_by['id'][$key] = $row['id'];
                $order_by['name'][$key] = $row['name'];
                if( 'wordpress' === $row['user_type'] ) {
                    $log_user_obj = get_user_by('id', $row['user_id'] );
                    $order_by['user_id'][$key] = $log_user_obj->user_login;
                    $logs[$key]['user_id'] = $log_user_obj->user_login;
                } else {
                    $order_by['user_id'][$key] = '';
                    $logs[$key]['user_id'] = '';
                }
                $order_by['email'][$key] = $row['user_email'];
                $order_by['user_type'][$key] = $row['user_type'];
                $order_by['ipaddress'][$key] = $row['ipaddress'];
                $order_by['added_date'][$key] = $row['added_date'];
                $order_by['vote_message'][$key] = $log_message[0];
                $logs[$key]['vote_message'] = $log_message[0];
            }
		}
		if ( count( $logs ) > 0 ) {
			array_multisort( $order_by[$params['order_by']], $params['sort_order'], $logs );
		}
		return array(
			'logs' => $logs,
			'total_logs' => $pagination['total_logs'],
			'total_pages' => $pagination['total_pages'],
			'pagination' => $pagination['pagination']
		);
	}
	public static function get_export_logs( $params ) {
        $query = '';
        $logs = '';
		$current_user = wp_get_current_user();
        if ( current_user_can( 'yop_poll_results_others' ) ) {
            $query = "SELECT logs.*, polls.name FROM {$GLOBALS['wpdb']->yop_poll_logs}"
                . " as logs LEFT JOIN {$GLOBALS['wpdb']->yop_poll_polls} as polls"
                . " ON logs.`poll_id` = polls.`id`";
            if ( isset( $params['q'] ) && ( '' !== $params['q'] ) ) {
                $params['q'] = "'" . '%' . esc_sql( $GLOBALS['wpdb']->esc_like( $params['q'] ) ) . '%' . "'";
                $query .= " WHERE `ipaddress` LIKE {$params['q']}";
                $query .= " OR `user_email` LIKE {$params['q']}";
                $query .= " OR `name` LIKE {$params['q']}";
            }
        } else if ( current_user_can( 'yop_poll_results_own' ) ) {
            $query = "SELECT logs.*, polls.name FROM {$GLOBALS['wpdb']->yop_poll_logs} as logs LEFT JOIN {$GLOBALS['wpdb']->yop_poll_polls} as polls"
                . " ON {$GLOBALS['wpdb']->yop_poll_logs}.`poll_id` = {$GLOBALS['wpdb']->yop_poll_polls}.`id`"
                . " WHERE {$GLOBALS['wpdb']->yop_poll_logs}.`poll_author`=" . $current_user->ID;
            if ( isset( $params['q'] ) && ( '' !== $params['q'] ) ) {
                $params['q'] = "'" . '%' . esc_sql( $GLOBALS['wpdb']->esc_like( $params['q'] ) ) . '%' . "'";
                $query .= " AND (`ipaddress` LIKE {$params['q']}";
                $query .= " OR `user_email` LIKE {$params['q']}";
                $query .= " OR `name` LIKE {$params['q']})";
            }
        }
        if ( '' !== $query ) {
            $logs = $GLOBALS['wpdb']->get_results( $query, ARRAY_A );
        }
        foreach ( $logs as $key => $row ) {
            $log_message = unserialize( $row['vote_message'] );
            $order_by['id'][$key] = $row['id'];
            $order_by['name'][$key] = $row['name'];
            if( 'wordpress' === $row['user_type'] ) {
                $log_user_obj = get_user_by('id', $row['user_id'] );
                $order_by['user_id'][$key] = $log_user_obj->user_login;
                $logs[$key]['user_id'] = $log_user_obj->user_login;
            } else {
                $order_by['user_id'][$key] = '';
                $logs[$key]['user_id'] = '';
            }
            $order_by['email'][$key] = $row['user_email'];
            $order_by['user_type'][$key] = $row['user_type'];
            $order_by['ipaddress'][$key] = $row['ipaddress'];
            $order_by['added_date'][$key] = $row['added_date'];
            $order_by['vote_message'][$key] = $log_message[0];
            $logs[$key]['vote_message'] = $log_message[0];
        }
        return  $logs;
    }
    public static function send_logs_to_download () {
        $date_format = get_option( 'date_format' );
        $time_format = get_option( 'time_format' );
        if ( isset ( $_REQUEST ['doExport'] ) && 'true' === $_REQUEST['doExport'] ) {
            $params['q'] = $_REQUEST['q'];
            $logs = self::get_export_logs( $params );
            $csv_file_name    = 'logs_export.' . date( 'YmdHis' ) . '.csv';
            $csv_header_array = [
                __( 'POLL Name', 'yop_poll' ),
                __( 'Username', 'yop_poll' ),
                __( 'Email', 'yop_poll' ),
                __( 'User Type', 'yop_poll' ),
                __( 'IP', 'yop_poll' ),
                __( 'Date', 'yop_poll' ),
                __( 'Message', 'yop_poll' ),
                __( 'Vote data', 'yop-poll' )
            ];
            header( "Content-Type: text/csv" );
            header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
            header( "Content-Transfer-Encoding: binary\n" );
            header( 'Content-Disposition: attachment; filename="' . $csv_file_name . '"' );
            header( 'Content-Transfer-Encoding: binary' );
            header( 'Connection: Keep-Alive' );
            header( 'Expires: 0' );
            ob_start();
            $f = fopen( 'php://output', 'w' ) or show_error( __( "Can't open php://output!", 'yop_poll' ) );
            if ( !Helper::yop_fputcsv( $f, $csv_header_array ) ) _e( "Can't write header!", 'yop_poll' );
            $logs_for_csv = [];
            if ( count( $logs ) > 0 ){
                 foreach ( $logs as $log ) {
                     $log_details = self::get_log_details($log['id']);
                     $details_string = '';
                     foreach ( $log_details as $res ) {
                         if ( 'custom-field' === $res['question']) {
                             $details_string .= __( 'Custom Field', 'yop-poll' ) . ': ' . addslashes( $res['caption'] ) . ';';
                             $details_string .= __( 'Answer', 'yop-poll' ) . ': '. addslashes( $res['answers'][0]['answer_value'] ) . ';';
                         } else {
                             $details_string .= __( 'Question', 'yop-poll' ). ': ' . addslashes( $res['question'] ) .';';
                             foreach ( $res['answers'] as $ra ) {
                                 $details_string .= __( 'Answer', 'yop-poll' ) . ': ' . addslashes( $ra['answer_value'] ) . ';';
                             }
                         }
                     }
                     $logs_data = [
                         stripslashes( $log ['name'] ),
                         esc_html( stripslashes( $log['user_id'] ) ),
                         stripslashes( $log ['user_email'] ),
                         stripslashes( $log ['user_type'] ),
                         stripslashes( $log ['ipaddress'] ),
                         esc_html( date( $date_format . ' @ ' . $time_format, strtotime( $log['added_date'] ) ) ),
                         esc_html( $log['vote_message'] ),
                         stripslashes( $details_string )
                     ];
                     $logs_for_csv[] = $logs_data;
                     if ( !Helper::yop_fputcsv( $f, $logs_data, ',', '"' ) ) _e( "Can't write logs!", 'yop_poll' );
                 }
             }
            fclose( $f ) or show_error( __( "Can't close php://output!", 'yop_poll' ) );
            $csvStr = ob_get_contents();
            ob_end_clean();
            echo $csvStr;
            exit ();
        }
    }
    public static function get_owner( $log_id ) {
        $query = $GLOBALS['wpdb']->prepare(
            "SELECT * FROM {$GLOBALS['wpdb']->yop_poll_logs} WHERE `id` = %s", $log_id
        );
        $log= $GLOBALS['wpdb']->get_row( $query, OBJECT );
        if( null !== $log ){
            return $log->poll_author;
        } else {
            return false;
        }
    }
    public static function delete( $log_id ) {
        $delete_log_result = $GLOBALS['wpdb']->delete(
            $GLOBALS['wpdb']->yop_poll_logs,
            array(
                'id' => $log_id
            )
        );
        if ( false !== $delete_log_result ) {
            self::$errors_present = false;
        } else {
            self::$errors_present = true;
            self::$error_text = __( 'Error deleting log', 'yop-poll' );
        }
        return array(
            'success' => !self::$errors_present,
            'error' => self::$error_text
        );
    }
    public static function get_log_details ( $log_id ) {
        $query = $GLOBALS['wpdb']->prepare(
            "SELECT * FROM {$GLOBALS['wpdb']->yop_poll_logs} WHERE `id` = %d", $log_id
        );
        $log= $GLOBALS['wpdb']->get_row( $query, OBJECT );
        if( null !== $log ){
            $vote_data = unserialize( $log->vote_data );
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
                            if ( isset ( $ve['id'] ) )  {
                                $questions_ids[] = $ve['id'];
                            }
                            if (  isset( $ve['data'] ) ) {
                                foreach ( $ve['data'] as $vdata ) {
                                    if ( isset( $vdata['id'] ) ) {
                                        if( 0 != $vdata['id'] ) {
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
                                        if ( isset($ve['data'] ) ) {
                                            foreach ( $ve['data'] as $vdata ) {
                                                if ( 0 == $vdata['id']) {
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
                                        if ( isset ( $ve['id'] ) )  {
                                            foreach ( $questions_results as $qres ) {
                                                if ( $ve['id'] == $qres->id ) {
                                                    $pqa['question'] = 'custom-field';
                                                    $pqa['caption'] = $qres->etext;
                                                }
                                            }
                                        }
                                        if ( isset( $ve['data'] ) ) {
                                            $pqa['answers'][] = [ 'answer_text' => 'custom-field', 'answer_value' => $ve['data'][0] ];
                                        }
                                        $questions[] = $pqa;
                                        break;
                                    }
                                }
                        }
                        return $questions;
                    } else {
                        return [];
                    }
                } else {
                    return [];
                }
            }

        } else {
            return [];
        }
    }
}
