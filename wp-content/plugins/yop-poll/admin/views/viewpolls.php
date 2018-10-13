<?php
switch( $params['order_by'] ) {
    case 'name':{
        $name_sort_order = ( isset( $params['sort_order'] ) && ( 'asc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
        $name_sort_order_display = ( isset( $params['sort_order'] ) && ( 'desc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
        $name_column_class = 'sorted';
        $status_sort_order = 'asc';
        $status_sort_order_display = 'desc';
        $status_column_class = 'sortable';
        $total_submits_sort_order = 'asc';
        $total_submits_sort_order_display = 'desc';
        $total_submits_column_class = 'sortable';
        $author_sort_order = 'asc';
        $author_sort_order_display = 'desc';
        $author_column_class = 'sortable';
        $start_date_sort_order = 'asc';
        $start_date_sort_order_display = 'desc';
        $start_date_column_class = 'sortable';
        $end_date_sort_order = 'asc';
        $end_date_sort_order_display = 'desc';
        $end_date_column_class = 'sortable';
        break;
    }
    case 'status':{
        $name_sort_order = 'asc';
        $name_sort_order_display = 'desc';
        $name_column_class = 'sortable';
        $status_sort_order = ( isset( $params['sort_order'] ) && ( 'asc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
        $status_sort_order_display = ( isset( $params['sort_order'] ) && ( 'desc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
        $status_column_class = 'sorted';
        $total_submits_sort_order = 'asc';
        $total_submits_sort_order_display = 'desc';
        $total_submits_column_class = 'sortable';
        $author_sort_order = 'asc';
        $author_sort_order_display = 'desc';
        $author_column_class = 'sortable';
        $start_date_sort_order = 'asc';
        $start_date_sort_order_display = 'desc';
        $start_date_column_class = 'sortable';
        $end_date_sort_order = 'asc';
        $end_date_sort_order_display = 'desc';
        $end_date_column_class = 'sortable';
        break;
    }
    case 'votes':{
        $name_sort_order = 'asc';
        $name_sort_order_display = 'desc';
        $name_column_class = 'sortable';
        $status_sort_order = 'asc';
        $status_sort_order_display = 'desc';
        $status_column_class = 'sortable';
        $total_submits_sort_order = ( isset( $params['sort_order'] ) && ( 'asc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
        $total_submits_sort_order_display = ( isset( $params['sort_order'] ) && ( 'desc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
        $total_submits_column_class = 'sorted';
        $author_sort_order = 'asc';
        $author_sort_order_display = 'desc';
        $author_column_class = 'sortable';
        $start_date_sort_order = 'asc';
        $start_date_sort_order_display = 'desc';
        $start_date_column_class = 'sortable';
        $end_date_sort_order = 'asc';
        $end_date_sort_order_display = 'desc';
        $end_date_column_class = 'sortable';
        break;
    }
    case 'author':{
        $name_sort_order = 'asc';
        $name_sort_order_display = 'desc';
        $name_column_class = 'sortable';
        $status_sort_order = 'asc';
        $status_sort_order_display = 'desc';
        $status_column_class = 'sortable';
        $total_submits_sort_order = 'asc';
        $total_submits_sort_order_display = 'desc';
        $total_submits_column_class = 'sortable';
        $author_sort_order = ( isset( $params['sort_order'] ) && ( 'asc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
        $author_sort_order_display = ( isset( $params['sort_order'] ) && ( 'desc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
        $author_column_class = 'sorted';
        $start_date_sort_order = 'asc';
        $start_date_sort_order_dislay = 'desc';
        $start_date_column_class = 'sortable';
        $end_date_sort_order = 'asc';
        $end_date_sort_order_display = 'desc';
        $end_date_column_class = 'sortable';
        break;
    }
    case 'sdate':{
        $name_sort_order = 'asc';
        $name_sort_order_display = 'desc';
        $name_column_class = 'sortable';
        $status_sort_order = 'asc';
        $status_sort_order_display = 'desc';
        $status_column_class = 'sortable';
        $total_submits_sort_order = 'asc';
        $total_submits_sort_order_display = 'desc';
        $total_submits_column_class = 'sortable';
        $author_sort_order = 'asc';
        $author_sort_order_display = 'desc';
        $author_column_class = 'sortable';
        $start_date_sort_order = ( isset( $params['sort_order'] ) && ( 'asc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
        $start_date_sort_order_display = ( isset( $params['sort_order'] ) && ( 'desc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
        $start_date_column_class = 'sorted';
        $end_date_sort_order = 'asc';
        $end_date_sort_order_display = 'desc';
        $end_date_column_class = 'sortable';
        break;
    }
    case 'edate':{
        $name_sort_order = 'asc';
        $name_sort_order_display = 'desc';
        $name_column_class = 'sortable';
        $status_sort_order = 'asc';
        $status_sort_order_display = 'desc';
        $status_column_class = 'sortable';
        $total_submits_sort_order = 'asc';
        $total_submits_sort_order_display = 'desc';
        $total_submits_column_class = 'sortable';
        $author_sort_order = 'asc';
        $author_sort_order_display = 'desc';
        $author_column_class = 'sortable';
        $start_date_sort_order = 'asc';
        $start_date_sort_order_display = 'desc';
        $start_date_column_class = 'sortable';
        $end_date_sort_order = ( isset( $params['sort_order'] ) && ( 'asc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
        $end_date_sort_order_display = ( isset( $params['sort_order'] ) && ( 'desc' === $params['sort_order'] ) ) ? 'desc' : 'asc';
        $end_date_column_class = 'sorted';
        break;
    }
    default: {
        $name_sort_order = 'asc';
        $name_sort_order_display = 'desc';
        $name_column_class = 'sortable';
        $status_sort_order = 'asc';
        $status_sort_order_display = 'desc';
        $status_column_class = 'sortable';
        $total_submits_sort_order = 'asc';
        $total_submits_sort_order_display = 'desc';
        $total_submits_column_class = 'sortable';
        $author_sort_order = 'asc';
        $author_sort_order_display = 'desc';
        $author_column_class = 'sortable';
        $start_date_sort_order = 'asc';
        $start_date_sort_order_display = 'desc';
        $start_date_column_class = 'sortable';
        $end_date_sort_order = 'asc';
        $end_date_sort_order_display = 'desc';
        $end_date_column_class = 'sortable';
        break;
    }
}
?>
<div id="yop-main-area" class="bootstrap-yop wrap">
    <div id="icon-options-general" class="icon32"></div>
    <h1>
		<i class="fa fa-bar-chart" aria-hidden="true"></i>YOP Poll
		<a href="<?php echo esc_url( add_query_arg(
            array(
                'page' => 'yop-poll-add-poll',
                'action' => false,
                'poll_id' => false,
                '_token' => false,
                'order_by' => false,
                'sort_order' => false,
                'q' => false
             ) ) );?>" class="page-title-action">
			<?php _e( 'Add New', 'yop-poll' );?>
		</a>
	</h1>
    <ul class="subsubsub">
		<li class="all">
			<a href="#" class="current">
				<?php _e( 'All', 'yop-poll' );?>
				<span class="count">
					(<?php echo count( $polls); ?>)
				</span>
			</a> |
		</li>
		<li class="publish">
			<a href="#">
				<?php _e( 'Published', 'yop-poll' );?>
				<span class="count">
					(<?php echo $statistics['published']; ?>)
				</span>
			</a> |
		</li>
		<li class="draft">
			<a href="#">
				<?php _e( 'Draft', 'yop-poll' );?>
				<span class="count">
					(<?php echo $statistics['draft']; ?>)
				</span>
			</a> |
		</li>
		<li class="draft">
			<a href="#">
				<?php _e( 'Ending Soon', 'yop-poll' );?>
				<span class="count">
					(<?php echo $statistics['ending-soon']; ?>)
				</span>
			</a> |
		</li>
		<li class="draft">
			<a href="#">
				<?php _e( 'Ended', 'yop-poll' );?>
				<span class="count">
					(<?php echo $statistics['ended']; ?>)
				</span>
			</a>
		</li>
	</ul>
	<form method="get">
		<input type="hidden" name="_token" value="<?php echo wp_create_nonce( 'yop-poll-view-polls' ); ?>">
	    <p class="search-box">
			<label class="screen-reader-text" for="post-search-input">
				<?php _e( 'Search Polls', 'yop-poll' );?>:
			</label>
            <input type="hidden" name="page" value="yop-polls">
			<input id="poll-search-input" name="q" value="" type="search">
			<input id="search-submit" class="button" value="<?php _e( 'Search Polls', 'yop-poll' );?>" type="submit">
	    </p>
	</form>
    <div class="tablenav top">
		<div class="alignleft actions bulkactions">
            <input type="hidden" name="_bulk_token" value="<?php echo wp_create_nonce( 'yop-poll-bulk-polls' ); ?>">
			<label for="bulk-action-selector-top" class="screen-reader-text">
				<?php _e( 'Select bulk action', 'yop-poll' );?>
			</label>
			<select name="action" class="bulk-action-top">
				<option value="-1" class="hide-if-no-js">
					<?php _e( 'Bulk Actions', 'yop-poll' );?>
				</option>
				<option value="trash" class="hide-if-no-js">
					<?php _e( 'Move to Trash', 'yop-poll' );?>
				</option>
                <option value="clone" class="hide-if-no-js">
					<?php _e( 'Clone', 'yop-poll' );?>
				</option>
                <option value="reset-votes" class="hide-if-no-js">
					<?php _e( 'Reset Votes', 'yop-poll' );?>
				</option>
			</select>
			<input class="button bulk-action" data-position="top" value="<?php _e( 'Apply', 'yop-poll' );?>" type="submit">
		</div>
        <!-- TO BE IMPLEMENTED DOWN THE ROAD
		<div class="alignleft actions">
			<label for="filter-by-date" class="screen-reader-text">
				<?php _e( 'Filter by date', 'yop-poll' );?>
			</label>
			<select name="m" id="filter-by-date">
				<option selected="selected" value="0">
					<?php _e( 'View All Polls', 'yop-poll' );?>
				</option>
                <option value="published">
					<?php _e( 'Published', 'yop-poll' );?>
				</option>
                <option value="draft">
					<?php _e( 'Draft', 'yop-poll' );?>
				</option>
                <option value="ending-soon">
					<?php _e( 'Ending Soon', 'yop-poll' );?>
				</option>
			</select>
			<input name="filter_action" class="button filter-polls" value="<?php _e( 'Filter', 'yop-poll' );?>" type="submit">
		</div>
        END -->
        <h2 class="screen-reader-text">
            <?php _e( 'Pages list navigation', 'yop-poll' );?>
        </h2>
		<div class="tablenav-pages">
			<span class="displaying-num">
				<?php echo sprintf( _n( '%s item', '%s items', $total_polls, 'yop-poll' ), $total_polls );?>
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
				<th scope="col" class="manage-column column-title column-primary <?php echo $name_column_class . ' ' . $name_sort_order_display;?>">
					<a href="
                        <?php echo esc_url(
                                add_query_arg(
                                    array(
                                        'action' => false,
                                        'poll_id' => false,
                                        '_token' => false,
                                        'order_by' => 'name',
                                        'sort_order' => $name_sort_order,
                                        'q' => htmlentities( $params['q'] ),
                                        'page_no' => $params['page_no']
                                    )
                                )
                            );
                            ?>
                        ">
						<span>
							<?php _e( 'Title', 'yop-poll' );?>
						</span>
						<span class="sorting-indicator"></span>
					</a>
				</th>
				<th scope="col" class="manage-column column-title column-primary sorted">
					<span>
						<?php _e( 'Results', 'yop-poll' );?>
					</span>
				</th>
				<th scope="col" class="manage-column column-title column-primary <?php echo $status_column_class . ' ' . $status_sort_order_display;?>">
					<a href="
                    <?php echo esc_url(
                            add_query_arg(
                                array(
                                    'action' => false,
                                    'poll_id' => false,
                                    '_token' => false,
                                    'order_by' => 'status',
                                    'sort_order' => $status_sort_order
                                )
                            )
                        );
                        ?>
                    ">
						<span>
							<?php _e( 'Status', 'yop-poll' );?>
						</span>
						<span class="sorting-indicator"></span>
					</a>
				</th>
				<th scope="col" class="manage-column column-title column-primary sortable">
					<span>
						<?php _e( 'Code', 'yop-poll' );?>
					</span>
				</th>
				<th scope="col" class="manage-column column-title column-primary <?php echo $total_submits_column_class . ' ' . $total_submits_sort_order_display;?>">
					<a href="
                    <?php echo esc_url(
                            add_query_arg(
                                array(
                                    'action' => false,
                                    'poll_id' => false,
                                    '_token' => false,
                                    'order_by' => 'votes',
                                    'sort_order' => $total_submits_sort_order
                                )
                            )
                        );
                        ?>
                    ">
						<span>
							<?php _e( 'Votes', 'yop-poll' );?>
						</span>
						<span class="sorting-indicator"></span>
					</a>
				</th>
				<th scope="col" class="manage-column column-title column-primary <?php echo $author_column_class . ' ' . $author_sort_order_display;?>">
                    <a href="
                    <?php echo esc_url(
                            add_query_arg(
                                array(
                                    'action' => false,
                                    'poll_id' => false,
                                    '_token' => false,
                                    'order_by' => 'votes',
                                    'sort_order' => $author_sort_order
                                )
                            )
                        );
                    ?>
                    ">
						<span>
							<?php _e( 'Author', 'yop-poll' );?>
						</span>
						<span class="sorting-indicator"></span>
					</a>
				</th>
				<th scope="col" class="manage-column column-title column-primary <?php echo $start_date_column_class . ' ' . $start_date_sort_order_display;?>">
					<a href="
                    <?php echo esc_url(
                            add_query_arg(
                                array(
                                    'action' => false,
                                    'poll_id' => false,
                                    '_token' => false,
                                    'order_by' => 'sdate',
                                    'sort_order' => $start_date_sort_order
                                )
                            )
                        );
                        ?>
                    ">
						<span>
							<?php _e( 'Start Date', 'yop-poll' );?>
						</span>
						<span class="sorting-indicator"></span>
					</a>
				</th>
				<th scope="col" class="manage-column column-title column-primary <?php echo $end_date_column_class . ' ' . $end_date_sort_order_display;?>">
					<a href="
                    <?php echo esc_url(
                            add_query_arg(
                                array(
                                    'action' => false,
                                    'poll_id' => false,
                                    '_token' => false,
                                    'order_by' => 'edate',
                                    'sort_order' => $end_date_sort_order
                                )
                            )
                        );
                        ?>
                    ">
						<span>
							<?php _e( 'End Date', 'yop-poll' );?>
						</span>
						<span class="sorting-indicator"></span>
					</a>
				</th>
			</tr>
		</thead>
		<?php
		foreach ( $polls as $poll ) {
			$poll_meta_data = unserialize( $poll['meta_data'] );
            switch ( $poll['status'] ) {
                case 'published': {
                    $status_class = 'published';
                    break;
                }
                case 'draft': {
                    $status_class = 'draft';
                    break;
                }
                case 'archived': {
                    $status_class = 'archived';
                    break;
                }
                case 'ended': {
                    $status_class = 'ended';
                    break;
                }
                case 'ending soon': {
                    $status_class = 'endsoon';
                    break;
                }
            }
		?>
        <tr  class="iedit author-self level-0 post-17 type-post status-publish format-standard hentry category-uncategorized">
			<th scope="row" class="check-column">
				<label class="screen-reader-text" for="cb-select-17">
					<?php _e( 'Select', 'yop-poll' );?>
				</label>
				<input name="polls[]" value="<?php echo esc_html( $poll['id'] );?>" type="checkbox">
				<div class="locked-indicator"></div>
			</th>
			<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
				<strong>
					<a class="row-title" href="<?php echo esc_url( add_query_arg(
                        array(
                            'page' => 'yop-polls',
                            'action' => 'edit',
                            'poll_id' => $poll['id'],
                            '_token' => false,
                            'order_by' => false,
                            'sort_order' => false,
                            'q' => false
                         )
                        ))?>"
                        title="<?php _e( 'Poll name', 'yop-poll' );?>">
						<?php echo esc_html( $poll['name'] );?>
					</a>
				</strong>
				<div class="row-actions">
					<span class="edit">
						<a href="<?php echo esc_url( add_query_arg(
                            array(
                                'page' => 'yop-polls',
                                'action' => 'edit',
                                'poll_id' => $poll['id'],
                                '_token' => false,
                                'order_by' => false,
                                'sort_order' => false,
                                'q' => false
                             ) ) );?>" title="<?php _e( 'Edit this poll', 'yop-poll' );?>">
							<?php _e( 'Edit', 'yop-poll' );?>
						</a> |
					</span>
					<span class="trash">
						<a class="delete-poll" title="<?php _e( 'Move this poll to the Trash', 'yop-poll' );?>"
                            href="#"
                            data-id="<?php echo esc_html( $poll['id'] );?>">
							<?php _e( 'Trash', 'yop-poll' );?>
						</a> |
					</span>
					<span class="view">
						<a href="#" class="clone-poll" title="<?php _e( 'Clone', 'yop-poll' );?>"
                            data-id="<?php echo esc_html( $poll['id'] );?>"
                            rel="permalink">
							<?php _e( 'Clone', 'yop-poll' );?>
						</a>
					</span>
				</div>
			</td>
			<td class="author">
                <a href="<?php echo esc_url( add_query_arg(
                    array(
                        'page' => 'yop-polls',
                        'action' => 'results',
                        'poll_id' => $poll['id'],
                        '_token' => false,
                        'order_by' => false,
                        'sort_order' => false,
                        'q' => false
                    ) ) );?>" title="<?php _e( 'View Results', 'yop-poll' );?>">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                </a>
			</td>
			<td class="author">
				<label class="status-<?php echo $status_class;?>">
					<?php echo ucwords( esc_html( $poll['status'] ) );?>
				</label>
			</td>
			<td class="author">
                <a href="#" class="get-poll-code" data-id="<?php echo $poll['id'];?>">
                    <i class="fa fa-code" aria-hidden="true"></i>
                </a>
			</td>
			<td class="author">
				<?php echo esc_html( $poll['total_submits'] );?>
			</td>
			<td class="author">
				<?php echo esc_html( $poll['author'] );?>
			</td>
			<td class="author">
				<?php
				if ( 'now' === $poll_meta_data['options']['poll']['startDateOption'] ) {
					echo date( $date_format . ' ' . $time_format, strtotime( $poll['added_date'] ) );
				} else {
					echo date( $date_format . ' ' . $time_format, strtotime( $poll_meta_data['options']['poll']['startDateCustom'] ) );
				}
				?>
			</td>
			<td class="author">
				<?php
				if ( 'never' === $poll_meta_data['options']['poll']['endDateOption'] ) {
					_e( 'Never', 'yop-poll' );
				} else {
					echo date( $date_format . ' ' . $time_format, strtotime( $poll_meta_data['options']['poll']['endDateCustom'] ) );
				}
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
				<th scope="col" class="manage-column column-title column-primary <?php echo $name_column_class . ' ' . $name_sort_order_display;?>">
					<a href="
                        <?php echo esc_url(
                                add_query_arg(
                                    array(
                                        'action' => false,
                                        'poll_id' => false,
                                        '_token' => false,
                                        'order_by' => 'name',
                                        'sort_order' => $name_sort_order
                                    )
                                )
                            );
                            ?>
                        ">
						<span>
							<?php _e( 'Title', 'yop-poll' );?>
						</span>
						<span class="sorting-indicator"></span>
					</a>
				</th>
				<th scope="col" class="manage-column column-title column-primary sorted">
					<span>
						<?php _e( 'Results', 'yop-poll' );?>
					</span>
				</th>
				<th scope="col" class="manage-column column-title column-primary <?php echo $status_column_class . ' ' . $status_sort_order_display;?>">
					<a href="
                    <?php echo esc_url(
                            add_query_arg(
                                array(
                                    'action' => false,
                                    'poll_id' => false,
                                    '_token' => false,
                                    'order_by' => 'status',
                                    'sort_order' => $status_sort_order
                                )
                            )
                        );
                        ?>
                    ">
						<span>
							<?php _e( 'Status', 'yop-poll' );?>
						</span>
						<span class="sorting-indicator"></span>
					</a>
				</th>
				<th scope="col" class="manage-column column-title column-primary sortable">
					<span>
						<?php _e( 'Code', 'yop-poll' );?>
					</span>
				</th>
				<th scope="col" class="manage-column column-title column-primary <?php echo $total_submits_column_class . ' ' . $total_submits_sort_order_display;?>">
					<a href="
                    <?php echo esc_url(
                            add_query_arg(
                                array(
                                    'action' => false,
                                    'poll_id' => false,
                                    '_token' => false,
                                    'order_by' => 'votes',
                                    'sort_order' => $total_submits_sort_order
                                )
                            )
                        );
                        ?>
                    ">
						<span>
							<?php _e( 'Votes', 'yop-poll' );?>
						</span>
						<span class="sorting-indicator"></span>
					</a>
				</th>
				<th scope="col" class="manage-column column-title column-primary <?php echo $author_column_class . ' ' . $author_sort_order_display;?>">
                    <a href="
                    <?php echo esc_url(
                            add_query_arg(
                                array(
                                    'action' => false,
                                    'poll_id' => false,
                                    '_token' => false,
                                    'order_by' => 'votes',
                                    'sort_order' => $author_sort_order
                                )
                            )
                        );
                    ?>
                    ">
						<span>
							<?php _e( 'Author', 'yop-poll' );?>
						</span>
						<span class="sorting-indicator"></span>
					</a>
				</th>
				<th scope="col" class="manage-column column-title column-primary <?php echo $start_date_column_class . ' ' . $start_date_sort_order_display;?>">
					<a href="
                    <?php echo esc_url(
                            add_query_arg(
                                array(
                                    'action' => false,
                                    'poll_id' => false,
                                    '_token' => false,
                                    'order_by' => 'sdate',
                                    'sort_order' => $start_date_sort_order
                                )
                            )
                        );
                        ?>
                    ">
						<span>
							<?php _e( 'Start Date', 'yop-poll' );?>
						</span>
						<span class="sorting-indicator"></span>
					</a>
				</th>
				<th scope="col" class="manage-column column-title column-primary <?php echo $end_date_column_class . ' ' . $end_date_sort_order_display;?>">
					<a href="
                    <?php echo esc_url(
                            add_query_arg(
                                array(
                                    'action' => false,
                                    'poll_id' => false,
                                    '_token' => false,
                                    'order_by' => 'edate',
                                    'sort_order' => $end_date_sort_order
                                )
                            )
                        );
                        ?>
                    ">
						<span>
							<?php _e( 'End Date', 'yop-poll' );?>
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
			<select name="action" class="bulk-action-bottom">
                <option value="-1" class="hide-if-no-js">
					<?php _e( 'Bulk Actions', 'yop-poll' );?>
				</option>
				<option value="trash" class="hide-if-no-js">
					<?php _e( 'Move to Trash', 'yop-poll' );?>
				</option>
                <option value="clone" class="hide-if-no-js">
					<?php _e( 'Clone', 'yop-poll' );?>
				</option>
                <option value="reset-votes" class="hide-if-no-js">
					<?php _e( 'Reset Votes', 'yop-poll' );?>
				</option>
			</select>
			<input class="button bulk-action" data-position="bottom" value="<?php _e( 'Apply', 'yop-poll' );?>" type="submit">
		</div>
        <h2 class="screen-reader-text">
            <?php _e( 'Pages list navigation', 'yop-poll' );?>
        </h2>
		<div class="tablenav-pages">
			<span class="displaying-num">
				<?php echo sprintf( _n( '%s item', '%s items', $total_polls, 'yop-poll' ), $total_polls );?>
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
<div class="bootstrap-yop">
    <div id="shortcode-popup" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <?php _e( 'Generate Poll Shortcode', 'yop-poll' );?>
                    </h4>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">
                        <?php _e( 'Place the shortcode on your pages or posts to display the poll:', 'yop-poll' );?>
                    </h4>
                    <br/>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <input type="text" class="form-control poll-code" id="yop-poll-shortcode" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" type="button" id="copy-yop-poll-code" data-clipboard-target="#yop-poll-shortcode"><?php _e( 'Copy to Clipboard', 'yop-poll' );?></button>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="form-horizontal">
                        <h4 class="text-center">
                            <?php _e( 'To customize it, you can use the options below', 'yop-poll' );?>
                        </h4>
                        <br/>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">
                                <?php _e( 'Tracking Id', 'yop-poll' );?>
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control shortcode-tracking-id" placeholder="<?php _e( 'Leave empty if none', 'yop-poll' );?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">
                                <?php _e( 'Display Results Only', 'yop-poll' );?>
                            </label>
                            <div class="col-md-8">
                                <select class="form-control shortcode-show-results" style="width:100%">
                                    <option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
                                    <option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary generate-yop-poll-code" type="button" data-id="">
                                    <?php _e( 'Generate Code', 'yop-poll' );?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
