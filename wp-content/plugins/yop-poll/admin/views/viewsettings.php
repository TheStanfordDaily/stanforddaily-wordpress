<div id="yop-main-area" class="bootstrap-yop wrap add-edit-poll">
    <h1>
        <?php _e( 'Poll Settings', 'yop-poll' );?>
    </h1>
    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content" style="position:relative">
                <form id="yop-poll-settings-form" action="">
                    <input type="hidden" id="_token" value="<?php echo wp_create_nonce( 'yop-poll-update-settings' ); ?>" name="_token">
                    <div class="meta-box-sortables ui-sortable">
                        <div id="titlediv">
                            <div class="inside"></div>
                        </div>
                        <div class="container-fluid yop-poll-hook">
                            <div class="tabs-container">
                                <!-- Nav tabs -->
                                <ul class="main nav nav-tabs settings-steps" role="tablist">
                                    <li role="presentation" id="notifications-tab"  class="active">
                                        <a href="#settings-notifications" aria-controls="notifications" role="tab" data-toggle="tab">
                                            <?php _e( 'Notifications', 'yop-poll' );?>
                                        </a>
                                    </li>
                                    <li role="presentation" id="media-tab">
                                        <a href="#settings-media" aria-controls="media" role="tab" data-toggle="tab">
                                            <?php _e( 'Media', 'yop-poll' );?>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content settings-steps-content">
                                    <div role="tabpanel" class="tab-pane active" id="settings-notifications">
                                        <div class="row submenu" style="padding-top: 20px;">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="from_name">
                                                        <?php _e( 'From Name', 'yop-poll' ); ?>
                                                    </label>
                                                    <input class="form-control" name="from_name" id="from_name" value="<?php echo esc_html ( $yop_poll_notification_from_name ); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="from_email">
                                                        <?php _e( 'From Email', 'yop-poll' ); ?>
                                                    </label>
                                                    <input class="form-control" name="from_email" id="from_email" value="<?php echo esc_html ( $yop_poll_notification_from_email ); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="recipients">
                                                        <?php _e( 'Recipients', 'yop-poll' ); ?>
                                                    </label>
                                                    <div><?php _e( 'Use comma separated email addresses: email@xmail.com,email2@ymail.com', 'yop_poll' ) ?></div>
                                                    <input class="form-control" name="recipients" id="recipients" value="<?php echo esc_html( $yop_poll_notification_recipients ); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="subject">
                                                        <?php _e( 'Subject', 'yop-poll' ); ?>
                                                    </label>
                                                    <input class="form-control" name="subject" id="subject" value="<?php echo esc_html ( $yop_poll_notification_subject ); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="body">
                                                        <?php _e( 'Body', 'yop-poll' ); ?>
                                                    </label>
                                                    <textarea class="form-control" name="body" id="body" rows="15"><?php echo esc_html( $yop_poll_notification_body );?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="settings-media">
                                        <br><br>
                                        <div class="row submenu">
                                            <div class="row submenu" style="padding-top: 20px;">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <a href="#" class="upgrade-to-pro" data-screen="media-integration">
													    <img src="<?php echo YOP_POLL_URL;?>admin/assets/images/pro-horizontal.svg" class="responsive" />
                                                    </a>
                                                    <?php _e( 'Use Facebook integration:', 'yop-poll' ); ?>

                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
													<?php
													$facebook_integration_yes = '';
													$facebook_integration_no = '';
													if ( 'yes' === $yop_poll_media_facebook_integration ) {
														$facebook_integration_yes = 'selected';
													}
													if ( 'no' === $yop_poll_media_facebook_integration ) {
														$facebook_integration_no = 'selected';
													}
													?>
													<select name="facebook_integration" class="facebook-integration-settings" style="width:100%">
											            <option value="yes" <?php echo $facebook_integration_yes;?>><?php _e( 'Yes', 'yop-poll' );?></option>
											            <option value="no" <?php echo $facebook_integration_no;?>><?php _e( 'No', 'yop-poll' );?></option>
											        </select>
                                                </div>
                                            </div>
                                            <?php
                                            if ( 'yes' === $yop_poll_media_facebook_integration ) {
                                                echo '<div class="row submenu hidden-facebook-input" style="padding-top: 20px; margin-left: 20px;">';
                                            } else {
                                                echo '<div class="row submenu hidden-facebook-input" style="padding-top: 20px; margin-left: 20px; display: none">';
                                            }
                                            ?>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <?php _e( '- App ID:', 'yop-poll' ); ?>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <input name="facebook_integration_app_id" id ="facebook_integration_app_id" class="form-control" value="<?php echo esc_html( $yop_poll_media_facebook_integration_app_id ); ?>">
                                                </div>
                                            </div>
                                            <div class="row submenu" style="padding-top: 20px;">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <a href="#" class="upgrade-to-pro" data-screen="media-integration">
													    <img src="<?php echo YOP_POLL_URL;?>admin/assets/images/pro-horizontal.svg" class="responsive" />
                                                    </a>
                                                        <?php _e( 'Use Google integration:', 'yop-poll' ); ?>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
													<?php
													$google_integration_yes = '';
													$google_integration_no = '';
													if ( 'yes' === $yop_poll_media_google_integration ) {
														$google_integration_yes = 'selected';
													}
													if ( 'no' === $yop_poll_media_google_integration ) {
														$google_integration_no = 'selected';
													}
													?>
													<select name="google_integration" class="google-integration-settings" style="width:100%">
											            <option value="yes" <?php echo $google_integration_yes;?>><?php _e( 'Yes', 'yop-poll' );?></option>
											            <option value="no" <?php echo $google_integration_no;?>><?php _e( 'No', 'yop-poll' );?></option>
											        </select>
                                                </div>
                                            </div>
                                            <?php
                                                if ( 'yes' === $yop_poll_media_google_integration ) {
                                                    echo '<div class="row submenu hidden-google-input" style="padding-top: 20px; margin-left: 20px;">';
                                                } else {
                                                    echo '<div class="row submenu hidden-google-input" style="padding-top: 20px; margin-left: 20px; display: none;">';
                                                }
                                            ?>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                        <?php _e( '- App ID:', 'yop-poll' ); ?>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <input name="google_integration_app_id" id ="google_integration_app_id" class="form-control" value="<?php echo esc_html( $yop_poll_media_google_integration_app_id ); ?>">
                                                    </div>
                                                </div>
                                                <div class="row" style="padding-top: 10px;">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                        <?php _e( '- App Secret:', 'yop-poll' ); ?>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <input name="google_integration_app_secret" id ="google_integration_app_secret" class="form-control" value="<?php echo esc_html ($yop_poll_media_google_integration_app_secret ); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.container -->
                    </div>
                </form>
            </div>
            <div id="postbox-container-1" class="postbox-container">
                <div id="side-sortables" class="meta-box-sortables ui-sortable">
                    <div class="postbox" id="submitdiv">
                        <button type="button" class="handlediv button-link" aria-expanded="true">
                            <span class="screen-reader-text">
                                <?php _e( 'Toggle panel: Publish', 'yop-poll' );?>
                            </span>
                            <span class="toggle-indicator" aria-hidden="true"></span>
                        </button>
                        <h2 class="hndle ui-sortable-handle">
                            <span>
                                <?php _e( 'Action', 'yop-poll' );?>
                            </span>
                        </h2>
                        <div class="inside">
                            <div id="submitpoll" class="submitbox">
                                <div id="minor-publishing">
                                    <div class="clear"></div>
                                    <div id="major-publishing-actions">
                                        <div id="publishing-action">
                                            <span class="spinner publish"></span>
                                            <button name="save_settings" class="button button-primary button-large save-settings-button" type="button">
                                                <?php _e( 'Save settings', 'yop-poll' );?>
                                            </button>

                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div id="yopPollUpgradeModal" class="modal fade" role="dialog" style="margin-top: 10px;">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header" style="border-bottom: 0px!important;">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<div class="flexslider" style="margin-bottom:30px; border: 0px;">
								<ul class="slides">
									<li><img src="<?php echo YOP_POLL_URL . "admin/assets/images/slider/image1.jpg"; ?>" alt="Image 1"></li>
									<li><img src="<?php echo YOP_POLL_URL . "admin/assets/images/slider/image2.jpg"; ?>" alt="Image 2"></li>
									<li><img src="<?php echo YOP_POLL_URL . "admin/assets/images/slider/image3.jpg"; ?>" alt="Image 3"></li>
									<li><img src="<?php echo YOP_POLL_URL . "admin/assets/images/slider/image4.jpg"; ?>" alt="Image 4"></li>
									<li><img src="<?php echo YOP_POLL_URL . "admin/assets/images/slider/image6.jpg"; ?>" alt="Image 5"></li>
									<li><img src="<?php echo YOP_POLL_URL . "admin/assets/images/slider/image7.jpg"; ?>" alt="Image 6"></li>
								</ul>
							</div>
							<form style="text-align: center" action="<?php echo admin_url('admin.php?page=yop-poll-upgrade-pro'); ?>" method="post">
								<p style="text-align:center; font-weight: bold; font-size: 16px">
									<?php wp_nonce_field('yop-poll-before-buy' ); ?>
									<input type="hidden" name="action" value="do-buy">
									<input type="hidden" name="upgrade" value="yes">
									<button class="btn btn-primary btn-lg" type="submit">
										Upgrade to Pro for <u>Only</u> $17
									</button>
									<br>
									60 days money back guarantee
								</p>
							</form>
							<div class="yop_testimonials" style="border: 2px solid; border-radius: 15px; padding: 10px;">
								<p class="yop_testimonials_header">
									Top class software and support
								</p>
								<p class="yop_testimonials_content">
									I love this software and the support service.
									<br>
									This is definitely the #1 poll plugin for WP. I give this software and its support service a A++++.
									<br><br>
									I'm so glad to be a Pro version user. The US$17 upgrade worth every cent...
									<br><br>
									I originally had some difficulties with the tool, and I reported them. (This is normal for all software.)
									After I reported my issues, the support got in touch with me very quickly and have the problem resolved.
									Also, they listened to my suggestions and worked with me to have things implemented and resolved.
									This is definitely a TOP CLASS service.
								</p>
								<p class="yop_testimonials_client">
									edwintam, wordpress user
								</p>
								<p></p>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
<!-- begin live preview -->
<div class="bootstrap-yop">
    <div id="yop-poll-preview" class="hide">
    </div>
</div>
<!-- end live preview -->
