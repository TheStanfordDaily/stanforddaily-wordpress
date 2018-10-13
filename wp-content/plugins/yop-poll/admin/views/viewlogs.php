<?php
$poll_name_sort_order         = 'asc';
$poll_name_sort_order_display = 'desc';
$poll_name_column_class       = 'sortable';

$user_id_sort_order = 'asc';
$user_id_sort_order_display = 'desc';
$user_id_column_class = 'sortable';

$email_sort_order = 'asc';
$email_sort_order_display = 'desc';
$email_column_class = 'sortable';

$user_type_sort_order = 'asc';
$user_type_sort_order_display = 'desc';
$user_type_column_class = 'sortable';

$ipaddress_sort_order = 'asc';
$ipaddress_sort_order_display = 'desc';
$ipaddress_column_class = 'sortable';

$added_date_sort_order = 'asc';
$added_date_sort_order_display = 'desc';
$added_date_column_class = 'sortable';

$vote_message_sort_order = 'asc';
$vote_message_sort_order_display = 'desc';
$vote_message_column_class = 'sortable';
switch( $params['order_by'] ) {
	case 'name':{
		$poll_name_sort_order = ( isset( $params['sort_order'] ) && ( 'asc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
		$poll_name_sort_order_display = ( isset( $params['sort_order'] ) && ( 'desc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
		$poll_name_column_class = 'sorted';
		break;
	}
	case 'user_id':{
		$user_id_sort_order = ( isset( $params['sort_order'] ) && ( 'asc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
		$user_id_sort_order_display = ( isset( $params['sort_order'] ) && ( 'desc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
		$user_id_column_class = 'sorted';
		break;
	}
	case 'email':{
		$email_sort_order = ( isset( $params['sort_order'] ) && ( 'asc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
		$email_sort_order_display = ( isset( $params['sort_order'] ) && ( 'desc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
		$email_column_class = 'sorted';
		break;
	}
    case 'user_type': {
	    $user_type_sort_order =  ( isset( $params['sort_order'] ) && ( 'asc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
	    $user_type_sort_order_display = ( isset( $params['sort_order'] ) && ( 'desc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
	    $user_type_column_class = 'sorted';
        break;
    }
    case 'ipaddress': {
	    $ipaddress_sort_order =  ( isset( $params['sort_order'] ) && ( 'asc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
	    $ipaddress_sort_order_display = ( isset( $params['sort_order'] ) && ( 'desc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
	    $ipaddress_column_class = 'sorted';
        break;
    }
    case 'added_date': {
	    $added_date_sort_order = ( isset( $params['sort_order'] ) && ( 'asc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
	    $added_date_sort_order_display = ( isset( $params['sort_order'] ) && ( 'desc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
	    $added_date_column_class = 'sorted';
	    break;
    }
    case 'vote_message': {
	    $vote_message_sort_order = ( isset( $params['sort_order'] ) && ( 'asc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
	    $vote_message_sort_order_display = ( isset( $params['sort_order'] ) && ( 'desc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
	    $vote_message_column_class = 'sorted';
	    break;
    }
	default: {
		$poll_name_sort_order         = 'asc';
		$poll_name_sort_order_display = 'desc';
		$poll_name_column_class       = 'sorted';

		$user_id_sort_order = 'asc';
		$user_id_sort_order_display = 'desc';
		$user_id_column_class = 'sortable';

		$email_sort_order = 'asc';
		$email_sort_order_display = 'desc';
		$email_column_class = 'sortable';

		$user_type_sort_order = 'asc';
		$user_type_sort_order_display = 'desc';
		$user_type_column_class = 'sortable';

		$ipaddress_sort_order = 'asc';
		$ipaddress_sort_order_display = 'desc';
		$ipaddress_column_class = 'sortable';

		$added_date_sort_order = 'asc';
		$added_date_sort_order_display = 'desc';
		$added_date_column_class = 'sortable';

		$vote_message_sort_order = 'asc';
		$vote_message_sort_order_display = 'desc';
		$vote_message_column_class = 'sortable';

        break;
	}
}
$search_value = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
?>
<div id="yop-main-area" class="bootstrap-yop wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h1>
		<i class="fa fa-bar-chart" aria-hidden="true"></i>Logs
	</h1>
	<form method="get" action="" id="searchForm">
		<input type="hidden" name="_token" value="<?php echo wp_create_nonce( 'yop-poll-view-logs' ); ?>">
		<p class="search-box">
			<label class="screen-reader-text" for="post-search-input">
				<?php _e( 'Search Logs', 'yop-poll' ); ?>:
			</label>
			<input type="hidden" name="page" value="yop-poll-logs">
			<input id="logs-search-input" name="q" value="<?php echo $search_value; ?>" type="search">
			<input id="search-submit" class="button" value="<?php _e( 'Search Logs', 'yop-poll' );?>" type="submit">
		</p>
        <button class="export-logs-button button" id="doaction" type="button" name="export"><?php echo __( 'Export', 'yop-poll' ); ?></button>
        <input type="hidden" name="doExport" id="doExport" value="">
	</form>
	<div class="tablenav top">
		<div class="alignleft actions bulkactions">
			<input type="hidden" name="_bulk_token" value="<?php echo wp_create_nonce( 'yop-poll-bulk-logs' ); ?>">
			<label for="bulk-action-selector-top" class="screen-reader-text">
				<?php _e( 'Select bulk action', 'yop-poll' );?>
			</label>
			<select name="action" class="logs-bulk-action-top">
				<option value="-1" class="hide-if-no-js">
					<?php _e( 'Bulk Actions', 'yop-poll' );?>
				</option>
				<option value="trash" class="hide-if-no-js">
					<?php _e( 'Move to Trash', 'yop-poll' );?>
				</option>
			</select>
			<input class="button logs-bulk-action" data-position="top" value="<?php _e( 'Apply', 'yop-poll' );?>" type="submit">
		</div>
		<h2 class="screen-reader-text">
			<?php _e( 'Logs list navigation', 'yop-poll' );?>
		</h2>
		<div class="tablenav-pages">
			<span class="displaying-num">
				<?php echo sprintf( _n( '%s item', '%s items', count( $logs ), 'yop-poll' ), count( $logs ) );?>
			</span>
			<?php
			if ( 1 < $total_pages ) {
				?>
				<span class="pagination-links">
                <?php echo $pagination['first_page'];?>
					<?php echo $pagination['previous_page'];?>
					<span class="paging-input">
                    <label for="current-page-selector" class="screen-reader-text">
                        <? _e( 'Current Page', 'yop-poll' );?>
                    </label>
                    <input class="current-page"
                           id="current-poll-page-selector"
                           type="text"
                           name="page_no"
                           value="<?php echo sanitize_text_field( $params['page_no'] );?>"
                           size="1"
                           aria-describedby="table-paging">
                    <span class="tablenav-paging-text"> of
                        <span class="total-pages">
                            <?php echo $total_pages;?>
                        </span>
                    </span>
                </span>
					<?php echo $pagination['next_page'];?>
					<?php echo $pagination['last_page'];?>
            </span>
				<?php
			}
			?>
		</div>
		<br class="clear">
	</div>
	<table class="wp-list-table yop-table widefat striped pages ">
		<thead>
		<tr>
			<td id="cb" class="manage-column column-cb check-column">
				<label class="screen-reader-text" for="cb-select-all-1">
					<?php _e( 'Select All', 'yop-poll' );?>
				</label>
				<input id="cb-select-all-1" type="checkbox">
			</td>
			<th scope="col" class="manage-column column-title column-primary <?php echo $poll_name_column_class . ' ' . $poll_name_sort_order_display;?>">
				<a href="
                        <?php echo esc_url(
					add_query_arg(
						array(
							'action' => false,
							'poll_id' => false,
							'_token' => false,
							'order_by' => 'name',
							'sort_order' => $poll_name_sort_order,
							'q' => htmlentities( $params['q'] ),
							'page_no' => $params['page_no']
						)
					)
				);
				?>
                        ">
						<span>
							<?php _e( 'Poll', 'yop-poll' );?>
						</span>
					<span class="sorting-indicator"></span>
				</a>
			</th>
			<th scope="col" class="manage-column column-title column-primary <?php echo $user_id_column_class . ' ' . $user_id_sort_order_display;?>">
				<a href="
                        <?php echo esc_url(
					add_query_arg(
						array(
							'action' => false,
							'poll_id' => false,
							'_token' => false,
							'order_by' => 'user_id',
							'sort_order' => $user_id_sort_order,
							'q' => htmlentities( $params['q'] ),
							'page_no' => $params['page_no']
						)
					)
				);
				?>
                        ">
						<span>
							<?php _e( 'Username', 'yop-poll' );?>
						</span>
					<span class="sorting-indicator"></span>
				</a>
			</th>
			<th scope="col" class="manage-column column-title column-primary <?php echo $email_column_class . ' ' . $email_sort_order_display;?>">
				<a href="
                    <?php echo esc_url(
					add_query_arg(
						array(
							'action' => false,
							'poll_id' => false,
							'_token' => false,
							'order_by' => 'email',
							'sort_order' => $email_sort_order,
							'q' => htmlentities( $params['q'] ),
							'page_no' => $params['page_no']
						)
					)
				);
				?>
                    ">
						<span>
							<?php _e( 'Email', 'yop-poll' );?>
						</span>
					<span class="sorting-indicator"></span>
				</a>
			</th>
			<th scope="col" class="manage-column column-title column-primary <?php echo $user_type_column_class . ' ' . $user_type_sort_order_display;?>">
				<a href="
                    <?php echo esc_url(
					add_query_arg(
						array(
							'action' => false,
							'poll_id' => false,
							'_token' => false,
							'order_by' => 'user_type',
							'sort_order' => $user_type_sort_order,
							'q' => htmlentities( $params['q'] ),
							'page_no' => $params['page_no']
						)
					)
				);
				?>
                    ">
						<span>
							<?php _e( 'User Type', 'yop-poll' );?>
						</span>
					<span class="sorting-indicator"></span>
				</a>
			</th>
			<th scope="col" class="manage-column column-title column-primary <?php echo $ipaddress_column_class . ' ' . $ipaddress_sort_order_display;?>">
				<a href="
                    <?php echo esc_url(
					add_query_arg(
						array(
							'action' => false,
							'poll_id' => false,
							'_token' => false,
							'order_by' => 'ipaddress',
							'sort_order' => $ipaddress_sort_order,
							'q' => htmlentities( $params['q'] ),
							'page_no' => $params['page_no']
						)
					)
				);
				?>
                    ">
						<span>
							<?php _e( 'Ipaddress', 'yop-poll' );?>
						</span>
					<span class="sorting-indicator"></span>
				</a>
			</th>
			<th scope="col" class="manage-column column-title column-primary <?php echo $added_date_column_class . ' ' . $added_date_sort_order_display;?>">
				<a href="
                    <?php echo esc_url(
					add_query_arg(
						array(
							'action' => false,
							'poll_id' => false,
							'_token' => false,
							'order_by' => 'added_date',
							'sort_order' => $added_date_sort_order,
							'q' => htmlentities( $params['q'] ),
							'page_no' => $params['page_no']
						)
					)
				);
				?>
                    ">
						<span>
							<?php _e( 'Date', 'yop-poll' );?>
						</span>
					<span class="sorting-indicator"></span>
				</a>
			</th>
			<th scope="col" class="manage-column column-title column-primary <?php echo $vote_message_column_class . ' ' . $vote_message_sort_order_display;?>">
				<a href="
                    <?php echo esc_url(
					add_query_arg(
						array(
							'action' => false,
							'poll_id' => false,
							'_token' => false,
							'order_by' => 'vote_message',
							'sort_order' => $vote_message_sort_order,
							'q' => htmlentities( $params['q'] ),
							'page_no' => $params['page_no']
						)
					)
				);
				?>
                    ">
						<span>
							<?php _e( 'Message', 'yop-poll' );?>
						</span>
					<span class="sorting-indicator"></span>
				</a>
			</th>
		</tr>
		</thead>
		<?php
		foreach ( $logs as $log ) {
			?>
			<tr class="iedit author-self level-0 post-17 type-post status-publish format-standard hentry category-uncategorized">
				<th scope="row" class="check-column">
					<label class="screen-reader-text" for="cb-select-17">
						<?php _e( 'Select', 'yop-poll' );?>
					</label>
					<input name="logs[]" value="<?php echo esc_html( $log['id'] );?>" type="checkbox">
					<div class="locked-indicator"></div>
				</th>
				<td class="title column-title has-row-actions column-primary page-title" data-colname="Poll Name">
					<strong>
                        <?php echo esc_html( $log['name'] );?>
					</strong>
					<div class="row-actions">
                        <span class="view">
						    <a class="view-log-details" title="<?php _e( 'View details for this record', 'yop-poll' );?>"
                               href="#" data-id="<?php echo esc_html( $log['id'] );?>"><?php _e( 'View Details', 'yop-poll' );?></a> |
					    </span>
						<span class="trash">
						    <a class="delete-log" title="<?php _e( 'Move this log record to the Trash', 'yop-poll' );?>"
						    href="#" data-id="<?php echo esc_html( $log['id'] );?>"><?php _e( 'Trash', 'yop-poll' );?></a>
					    </span>
					</div>
                    <div class="log-details-div" style="display: none; color: #000!important;"></div>
				</td>
				<td class="title column-title has-row-actions column-primary page-title" data-colname="Username">
					<?php
					    echo esc_html( $log['user_id'] );
					?>
				</td>
				<td class="title column-title has-row-actions column-primary page-title" data-colname="Email">
					<?php echo esc_html( $log['user_email'] );?>
				</td>
				<td class="title column-title has-row-actions column-primary page-title" data-colname="User Type">
					<?php echo esc_html( $log['user_type'] );?>
				</td>
				<td class="title column-title has-row-actions column-primary page-title" data-colname="Ipaddress">
					<?php echo esc_html( $log['ipaddress'] );?>
				</td>
				<td class="title column-title has-row-actions column-primary page-title" data-colname="Added Date">
					<?php echo esc_html( date( $date_format . ' @ ' . $time_format, strtotime( $log['added_date'] ) ) );?>
				</td>
				<td class="title column-title has-row-actions column-primary page-title" data-colname="Message">
					<?php
						echo esc_html( $log['vote_message'] );
					?>
				</td>
			</tr>
            <?php
		}
		?>
        <thead>
        <tr>
            <td id="cb" class="manage-column column-cb check-column">
                <label class="screen-reader-text" for="cb-select-all-1">
					<?php _e( 'Select All', 'yop-poll' );?>
                </label>
                <input id="cb-select-all-1" type="checkbox">
            </td>
            <th scope="col" class="manage-column column-title column-primary <?php echo $poll_name_column_class . ' ' . $poll_name_sort_order_display;?>">
                <a href="
                        <?php echo esc_url(
					add_query_arg(
						array(
							'action' => false,
							'poll_id' => false,
							'_token' => false,
							'order_by' => 'name',
							'sort_order' => $poll_name_sort_order,
							'q' => htmlentities( $params['q'] ),
							'page_no' => $params['page_no']
						)
					)
				);
				?>
                        ">
						<span>
							<?php _e( 'Poll', 'yop-poll' );?>
						</span>
                    <span class="sorting-indicator"></span>
                </a>
            </th>
            <th scope="col" class="manage-column column-title column-primary <?php echo $user_id_column_class . ' ' . $user_id_sort_order_display;?>">
                <a href="
                        <?php echo esc_url(
					add_query_arg(
						array(
							'action' => false,
							'poll_id' => false,
							'_token' => false,
							'order_by' => 'user_id',
							'sort_order' => $user_id_sort_order,
							'q' => htmlentities( $params['q'] ),
							'page_no' => $params['page_no']
						)
					)
				);
				?>
                        ">
						<span>
							<?php _e( 'Username', 'yop-poll' );?>
						</span>
                    <span class="sorting-indicator"></span>
                </a>
            </th>
            <th scope="col" class="manage-column column-title column-primary <?php echo $email_column_class . ' ' . $email_sort_order_display;?>">
                <a href="
                    <?php echo esc_url(
					add_query_arg(
						array(
							'action' => false,
							'poll_id' => false,
							'_token' => false,
							'order_by' => 'email',
							'sort_order' => $email_sort_order,
							'q' => htmlentities( $params['q'] ),
							'page_no' => $params['page_no']
						)
					)
				);
				?>
                    ">
						<span>
							<?php _e( 'Email', 'yop-poll' );?>
						</span>
                    <span class="sorting-indicator"></span>
                </a>
            </th>
            <th scope="col" class="manage-column column-title column-primary <?php echo $user_type_column_class . ' ' . $user_type_sort_order_display;?>">
                <a href="
                    <?php echo esc_url(
					add_query_arg(
						array(
							'action' => false,
							'poll_id' => false,
							'_token' => false,
							'order_by' => 'user_type',
							'sort_order' => $user_type_sort_order,
							'q' => htmlentities( $params['q'] ),
							'page_no' => $params['page_no']
						)
					)
				);
				?>
                    ">
						<span>
							<?php _e( 'User Type', 'yop-poll' );?>
						</span>
                    <span class="sorting-indicator"></span>
                </a>
            </th>
            <th scope="col" class="manage-column column-title column-primary <?php echo $ipaddress_column_class . ' ' . $ipaddress_sort_order_display;?>">
                <a href="
                    <?php echo esc_url(
					add_query_arg(
						array(
							'action' => false,
							'poll_id' => false,
							'_token' => false,
							'order_by' => 'ipaddress',
							'sort_order' => $ipaddress_sort_order,
							'q' => htmlentities( $params['q'] ),
							'page_no' => $params['page_no']
						)
					)
				);
				?>
                    ">
						<span>
							<?php _e( 'Ipaddress', 'yop-poll' );?>
						</span>
                    <span class="sorting-indicator"></span>
                </a>
            </th>
            <th scope="col" class="manage-column column-title column-primary <?php echo $added_date_column_class . ' ' . $added_date_sort_order_display;?>">
                <a href="
                    <?php echo esc_url(
					add_query_arg(
						array(
							'action' => false,
							'poll_id' => false,
							'_token' => false,
							'order_by' => 'added_date',
							'sort_order' => $added_date_sort_order,
							'q' => htmlentities( $params['q'] ),
							'page_no' => $params['page_no']
						)
					)
				);
				?>
                    ">
						<span>
							<?php _e( 'Date', 'yop-poll' );?>
						</span>
                    <span class="sorting-indicator"></span>
                </a>
            </th>
            <th scope="col" class="manage-column column-title column-primary <?php echo $vote_message_column_class . ' ' . $vote_message_sort_order_display;?>">
                <a href="
                    <?php echo esc_url(
					add_query_arg(
						array(
							'action' => false,
							'poll_id' => false,
							'_token' => false,
							'order_by' => 'vote_message',
							'sort_order' => $vote_message_sort_order,
							'q' => htmlentities( $params['q'] ),
							'page_no' => $params['page_no']
						)
					)
				);
				?>
                    ">
						<span>
							<?php _e( 'Message', 'yop-poll' );?>
						</span>
                    <span class="sorting-indicator"></span>
                </a>
            </th>
        </tr>
        </thead>
	</table>
	<div class="tablenav top">
		<div class="alignleft actions bulkactions">
			<label for="bulk-action-selector-bottom" class="screen-reader-text">
				<?php _e( 'Select bulk action', 'yop-poll' );?>
			</label>
			<select name="action" class="logs-bulk-action-bottom">
				<option value="-1" class="hide-if-no-js">
					<?php _e( 'Bulk Actions', 'yop-poll' );?>
				</option>
				<option value="trash" class="hide-if-no-js">
					<?php _e( 'Move to Trash', 'yop-poll' );?>
				</option>
			</select>
			<input class="button logs-bulk-action" data-position="bottom" value="<?php _e( 'Apply', 'yop-poll' );?>" type="submit">
		</div>
		<h2 class="screen-reader-text">
			<?php _e( 'Pages list navigation', 'yop-poll' );?>
		</h2>
		<div class="tablenav-pages">
			<span class="displaying-num">
				<?php echo sprintf( _n( '%s item', '%s items', $total_logs, 'yop-poll' ), $total_logs );?>
			</span>
			<?php
			if ( 1 < $total_pages ) {
				?>
				<span class="pagination-links">
                <?php echo $pagination['first_page'];?>
					<?php echo $pagination['previous_page'];?>
					<span class="paging-input">
                    <label for="current-page-selector" class="screen-reader-text">
                        <? _e( 'Current Page', 'yop-poll' );?>
                    </label>
                    <span class="tablenav-paging-text">
                        <?php echo sanitize_text_field( $params['page_no'] );?> of
                        <span class="total-pages">
                            <?php echo $total_pages;?>
                        </span>
                    </span>
                </span>
					<?php echo $pagination['next_page'];?>
					<?php echo $pagination['last_page'];?>
            </span>
				<?php
			}
			?>
		</div>
		<br class="clear">
	</div>
</div>
