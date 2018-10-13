<?php
if( isset( $params['order_by'] ) && $params['order_by'] === 'added_date' ) {
    if( isset( $params['sort_order'] ) && ( 'asc' === $params['sort_order'] ) ) {
        $sort_order = 'desc';
    } else {
        $sort_order = 'asc';
    }
} else {
    $sort_order = 'desc';
}
?>
<input type="hidden" name="_token" value="<?php echo wp_create_nonce( 'yop-poll-get-vote-details' ); ?>">
<input type="hidden" name="poll_id" id="poll_id" value="<?php echo $poll->id; ?>">
<div id="yop-main-area" class="bootstrap-yop wrap">
    <div id="icon-options-general" class="icon32"></div>
    <h1>
        <i class="fa fa-bar-chart" aria-hidden="true"></i><?php _e( 'Poll results for', 'yop-poll' ); ?> <?php echo $poll->name; ?>
        <a href="<?php echo esc_url( add_query_arg(
            array(
                'page' => 'yop-polls',
                'action' => false,
                'poll_id' => false,
                '_token' => false,
                'order_by' => false,
                'sort_order' => false,
                'q' => false,
                'exportCustoms' => false,
            ) ) );?>" class="page-title-action">
            <?php _e( 'All Polls', 'yop-poll' );?>
        </a>
    </h1>
    <div class="tablenav top">
        <form method="get">
            <div class="alignleft actions">
                <input type="hidden" name="_votes_token" value="<?php echo wp_create_nonce( 'yop-poll-votes' ); ?>">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>">
                <input type="hidden" name="action" value="<?php echo $_REQUEST['action']; ?>">
                <input type="hidden" name="poll_id" value="<?php echo $_REQUEST['poll_id']; ?>">
                <select name="order_by" class="order_by">
                    <option value=""><?php _e( 'Order by', 'yop-poll' ); ?></option>
                    <option value="date" <?php if ( isset( $_REQUEST['order_by'] ) && 'date' === $_REQUEST['order_by'] )  echo 'selected'; ?> class="hide-if-no-js">
                        <?php _e( 'Date', 'yop-poll' );?>
                    </option>
                </select>
                <select name="order_direction" class="order_direction">
                    <option value="ascending" <?php if ( isset( $_REQUEST['order_direction'] ) && 'ascending' === $_REQUEST['order_direction'] )  echo 'selected'; ?>><?php _e( 'Ascending', 'yop-poll' ); ?></option>
                    <option value="descending" <?php if ( isset( $_REQUEST['order_direction'] ) && 'descending' === $_REQUEST['order_direction'] )  echo 'selected'; ?>><?php _e( 'Descending', 'yop-poll' ); ?></option>
                </select>
                <input class="button sorting-action" data-position="top" value="<?php _e( 'Filter', 'yop-poll' ); ?>" type="submit">
            </div>
        </form>
        <div class="alignleft">
            <form method="get" action="" id="searchForm">
                <input type="hidden" name="page" value="yop-polls">
                <input type="hidden" name="poll_id" value="<?php echo $_REQUEST['poll_id']; ?>">
                <button class="export-logs-button button" id="doaction" type="button" name="export"><?php _e( 'Export', 'yop-poll' ); ?></button>
                <input type="hidden" name="doExport" id="doExport" value="true">
            </form>
        </div>
        <h2 class="screen-reader-text">
            <?php _e( 'Pages list navigation', 'yop-poll' );?>
        </h2>
        <div class="tablenav-pages">
			<span class="displaying-num">
				<?php echo sprintf( _n( '%s item', '%s items', $total_votes, 'yop-poll' ), $total_votes );?>
			</span>
            <?php
            if ( $votes_pages > 1 ) {
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
    <br>
    <div>
        <div class="tabs-container" style="padding-top: 0px!important;">
            <div class="tab-content">
                <div class="tab-pane active" id="poll-design">
                    <br><br>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <a href="<?php echo esc_url( add_query_arg(
                                array(
                                    'page' => 'yop-polls',
                                    'action' => 'results',
                                    'poll_id' => $poll->id,
                                    '_token' => false,
                                    'order_by' => false,
                                    'sort_order' => false,
                                    'q' => false,
                                    'exportCustoms' => false
                                ) ) ); ?>" class="btn btn-link btn-block">
                                <?php _e( 'Stats', 'yop-poll' ); ?>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

                            <a class="btn btn-link btn-block btn-underline">
                                <?php _e( 'View votes', 'yop-poll' );?>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table class="wp-list-table yop-table widefat striped">
                                <thead>
                                    <tr>
                                        <td width="70%">
                                            <label>
                                                <a href="
                                                <?php echo esc_url(
                                                    add_query_arg(
                                                        array(
                                                            'action' => $params['action'],
                                                            'poll_id' => $params['poll_id'],
                                                            '_token' => false,
                                                            'order_by' => 'added_date',
                                                            'sort_order' => $sort_order,
                                                            'page_no' => $params['page_no']
                                                        )
                                                    )
                                                );
                                                ?>
                                ">
                                                <?php _e( 'Date', 'yop-poll' ); ?>
                                                </a>
                                            </label>
                                        </td>
                                        <td width="10%"><label><?php _e( 'IP Address', 'yop-poll' ); ?></label></td>
                                        <td width="10%"><label><?php _e( 'Authentified', 'yop-poll' ); ?></label></td>
                                        <td width="10%"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $x = 1;
                                foreach ( $votes as $vote ) {
                                    ?>
                                    <tr>
                                        <td><?php echo date_i18n( get_option( 'date_format' ) . ' @ ' .get_option( 'time_format' ), strtotime( $vote->added_date ) ) ?>
                                            <div id="detailsdiv<?php echo $vote->id; ?>" style="display: none; padding-top: 10px;">

                                            </div>
                                    </td>
                                        <td><?php echo $vote->ipaddress; ?></td>
                                        <td><?php $vote->user_type === 'wordpress' ? _e( 'Yes', 'yop-poll' )  : _e( 'No', 'yop-poll' ); ?></td>
                                        <td>
                                            <a href="#" class="details-operation" data-voteid="<?php echo $vote->id; ?>" data-ajaxsent="no">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </td>

                                    </tr>

                                    <?php
                                    $x++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tablenav top">
        <h2 class="screen-reader-text">
            <?php _e( 'Pages list navigation', 'yop-poll' );?>
        </h2>
        <div class="tablenav-pages">
            <?php
            if ( $votes_pages > 1 ) {
                ?>
                <span class="pagination-links">
                                            <?php echo $pagination['first_page']; ?>
                    <?php echo $pagination['previous_page']; ?>
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
