<div class="bootstrap-yop wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h1>
		<i class="fa fa-bar-chart" aria-hidden="true"></i>
	 	Edit Ban
	</h1>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder addban">
			<!-- main content -->
			<div id="post-body-content ">
				<form>
					<input type="hidden" name="_token" id="_token" value="<?php echo wp_create_nonce( 'yop-poll-edit-ban' );?>">
					<div class="yop-container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="yop-text">
                                        <label>
                                        <?php _e( 'Poll', 'yop-poll' );?>
                                        <!--<i class="fa fa-info-circle yop-info"></i>-->
                                        </label>
                                    </div>
                                    <select class="ban-poll" style="width:50%">
                                        <?php if ( 0 === intval( $ban->poll_id ) ) {
                                            ?>
                                            <option value="0" selected>
                                                All Polls
                                            </option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="0">
                                                All Polls
                                            </option>
                                            <?php
                                        }
                                        foreach ( $polls as $poll ) {
                                            if ( $ban->poll_id === $poll->id ) {
                                                ?>
                                                <option value="<?php echo esc_attr( $poll->id )?>" selected>
                                                    <?php echo esc_html( $poll->name )?>
                                                </option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo esc_attr( $poll->id )?>"><?php echo esc_html( $poll->name )?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="yop-container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="yop-text">
                                        <label>
                                            <?php _e( 'Ban By', 'yop-poll' );?>
                                        <!--<i class="fa fa-info-circle yop-info"></i>-->
                                        </label>
                                    </div>
                                    <?php
                                    switch ( $ban->b_by ) {
                                        case 'ip': {
                                            $ban_by_ip = 'selected';
                                            $ban_by_email = '';
                                            $ban_by_username = '';
                                            break;
                                        }
                                        case 'email': {
                                            $ban_by_ip = '';
                                            $ban_by_email = 'selected';
                                            $ban_by_username = '';
                                            break;
                                        }
                                        case 'username': {
                                            $ban_by_ip = '';
                                            $ban_by_email = '';
                                            $ban_by_username = 'selected';
                                            break;
                                        }
                                        default: {
                                            $ban_by_ip = 'selected';
                                            $ban_by_email = '';
                                            $ban_by_username = '';
                                            break;
                                        }
                                    }
                                    ?>
                                    <select class="ban-by" style="width:50%">
                                        <option value="ip" <?php echo $ban_by_ip;?>>
                                            <?php _e( 'IP', 'yop-poll' );?>
                                        </option>
                                        <option value="email" <?php echo $ban_by_email;?>>
                                            <?php _e( 'Email', 'yop-poll' );?>
                                        </option>
                                        <option value="username" <?php echo $ban_by_username;?>>
                                            <?php _e( 'Username', 'yop-poll' );?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="yop-container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="yop-text">
                                        <label>
                                            <?php _e( 'Value' , 'yop-poll' );?>
                                        </label>
                                    </div>
                                    <input type="text" class="form-control ban-value"
                                        style="width:50%"
                                        value="<?php echo esc_html( $ban->b_value );?>"
                                    >
                                </div>
                            </div>
                        </div>
					</div>
					<div class="yop-container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input
                                        name="updateban"
                                        class="button button-primary button-large center update-ban"
                                        value="<?php _e( 'Update', 'yop-poll' );?>"
                                        data-id="<?php echo $ban->id;?>"
                                        type="submit">
                                </div>
                            </div>
                        </div>
					</div>
				</form>
			</div> <!-- #post-body  -->
			<br class="clear">
		</div> <!-- #poststuff -->
	</div> <!-- .wrap -->
</div>
