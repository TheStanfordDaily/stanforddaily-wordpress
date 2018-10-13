<div id="yop-main-area" class="bootstrap-yop wrap add-edit-poll">
    <h1>
        <?php _e( 'Create Poll', 'yop-poll' );?>
    </h1>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<div id="post-body-content" style="position:relative">
				<form id="yop-poll-form" action="#">
	                <input type="hidden" id="_token" value="<?php echo wp_create_nonce( 'yop-poll-add-poll' );?>" />
	                <div class="meta-box-sortables ui-sortable">
	                    <div id="titlediv">
	                        <div id="titlewrap">
	                            <input name="poll[name]" size="30" value="" id="title"
	                                spellcheck="true" autocomplete="off" type="text"
	                                class="form-control"
	                                placeholder="<?php _e( 'Name goes here', 'yop-poll' );?>" />
	                        </div>
	                        <div class="inside"></div>
	                    </div>
                        <div class="container-fluid yop-poll-hook">
						<div class="tabs-container">
							<!-- Nav tabs -->
							<ul class="main nav nav-tabs poll-steps" role="tablist">
								<li role="presentation" class="active">
									<a href="#poll-design" aria-controls="design" role="tab" data-toggle="tab">
										<?php _e( 'Design', 'yop-poll' );?>
									</a>
								</li>
								<li role="presentation">
									<a href="#poll-questions" aria-controls="questions" role="tab" data-toggle="tab">
										<?php _e( 'Question & Answers', 'yop-poll' );?>
									</a>
								</li>
								<li role="presentation">
									<a href="#poll-options" aria-controls="options" role="tab" data-toggle="tab">
										<?php _e( 'Options', 'yop-poll' );?>
									</a>
								</li>
							</ul>
							<div class="tab-content poll-steps-content">
								<div role="tabpanel" class="tab-pane active" id="poll-design">
									<br><br>
							    	<div class="row submenu">
										<div class="col-md-4">
											<a class="btn btn-link btn-block btn-underline submenu-item" data-content="content-design-templates">
												<?php _e( 'Choose a template', 'yop-poll' );?>
											</a>
										</div>
										<div class="col-md-4">
											<a class="btn btn-link btn-block submenu-item" data-content="content-design-style">
												<?php _e( 'Style', 'yop-poll' );?>
											</a>
										</div>
										<div class="col-md-4"></div>
									</div>
									<div class="row submenu-content content-design-templates">
										<div class="col-md-12">
                                            <div>&nbsp;</div>
											<?php include( YOP_POLL_PATH . 'admin/views/yop-poll-new-template.php' );?>
										</div>
									</div>
                                    <div class="row submenu-content content-design-style hide">
										<div class="col-md-12">
											<?php include( YOP_POLL_PATH . 'admin/views/yop-poll-new-style.php' );?>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="poll-questions">
                                    <br><br>
                                    <div class="row submenu">
                                        <div class="col-md-4">
                                            <a class="btn btn-link btn-block btn-underline submenu-item" data-content="content-qa-elements">
												<?php _e( 'Poll Elements', 'yop-poll' );?>
											</a>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                    </div>
									<div class="row submenu-content content-qa-elements">
                                        <div class="col-md-12">
                                            <?php include( YOP_POLL_PATH . 'admin/views/yop-poll-new-poll-elements.php' );?>
                                        </div>
                                    </div>
								</div>
								<div role="tabpanel" class="tab-pane" id="poll-options">
                                    <br><br>
                                    <div class="row submenu">
                                        <div class="col-md-4">
                                            <a class="btn btn-link btn-block btn-underline submenu-item" data-content="content-options-poll">
												<?php _e( 'Poll', 'yop-poll' );?>
											</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a class="btn btn-link btn-block submenu-item" data-content="content-options-access">
												<?php _e( 'Access', 'yop-poll' );?>
											</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a class="btn btn-link btn-block submenu-item" data-content="content-options-results">
												<?php _e( 'Results', 'yop-poll' );?>
											</a>
                                        </div>
                                    </div>
                                    <div class="row submenu-content content-options-poll">
                                        <div class="col-md-12">
                                            <?php include( YOP_POLL_PATH . 'admin/views/yop-poll-new-poll-poll.php' );?>
                                        </div>
                                    </div>
                                    <div class="row submenu-content content-options-access hide">
                                        <div class="col-md-12">
                                            <?php include( YOP_POLL_PATH . 'admin/views/yop-poll-new-poll-access.php' );?>
                                        </div>
                                    </div>
                                    <div class="row submenu-content content-options-results hide">
                                        <div class="col-md-12">
                                            <?php include( YOP_POLL_PATH . 'admin/views/yop-poll-new-poll-results.php' );?>
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
                                <?php _e( 'Publish', 'yop-poll' );?>
                            </span>
                        </h2>
                        <div class="inside">
                            <div id="submitpoll" class="submitbox">
                                <div id="minor-publishing">
                                    <div id="minor-publishing-actions">
                                        <div id="peview-action">
                                            <a class="button preview-poll" id="poll-preview">
                                                <?php _e( 'Preview', 'yop-poll' );?>
                                            </a>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div id="misc-publishing-actions">
                                        <div class="misc-pub-section misc-pub-post-status">
                                            <label for="post_status">
                                                <?php _e( 'Status:', 'yop-poll' );?>
                                            </label>
                                            <span id="post-status-display" class="poll-status">
                                                Published
                                            </span>
                                            <a href="#" class="edit-poll-status hide-if-no-js">
                                                <span aria-hidden="true">
                                                    <?php _e( 'Edit', 'yop-poll' );?>
                                                </span>
                                                <span class="screen-reader-text">
                                                    <?php _e( 'Edit status', 'yop-poll' );?>
                                                </span>
                                            </a>
                                            <div id="poll-status-select" class="hide-if-js">
                                                <select name="poll_status" id="poll_status">
                                                    <option value="published">
                                                        <?php _e( 'Published', 'yop-poll' );?>
                                                    </option>
                                                    <option value="draft">
                                                        <?php _e( 'Draft', 'yop-poll' );?>
                                                    </option>
                                                </select>
                                                <a href="#" class="save-poll-status hide-if-no-js button">
                                                    <?php _e( 'OK', 'yop-poll' );?>
                                                </a>
                                                <a href="#" class="cancel-poll-status hide-if-no-js button-cancel">
                                                    <?php _e( 'Cancel', 'yop-poll' );?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="misc-pub-section curtime misc-pub-curtime">
                                            <span id="timestamp">
                                                <?php _e( 'Publish immediately', 'yop-poll' );?>
                                            </span>
                                            <a href="#" class="edit-timestamp hide-if-no-js">
                                                <span aria-hidden="true">
                                                    <?php _e( 'Edit', 'yop-poll' );?>
                                                </span>
                                                <span class="screen-reader-text">
                                                    <?php _e( 'Edit status', 'yop-poll' );?>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div id="major-publishing-actions">
                                        <div id="publishing-action">
                                            <span class="spinner publish"></span>
                                        	<input name="original_publish" id="original_publish" value="Publish" type="hidden">
                                        	<input name="publish"
                                                id="publish-poll"
                                                class="button button-primary button-large"
                                                value="<?php _e( 'Publish', 'yop-poll' );?>"
                                                type="submit">
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                    <div id="submitdiv" class="postbox stuffbox">
                        <button type="button" class="handlediv button-link" aria-expanded="true">
                            <span class="screen-reader-text">
                                <?php _e( 'Toggle panel: Format', 'yop-poll' );?>
                            </span>
                            <span class="toggle-indicator" aria-hidden="true"></span>
                        </button>
                        <h3 class="hndle ui-sortable-handle">
                            <span>
                                <?php _e( 'Preview', 'yop-poll' );?>
                            </span>
                        </h3>
                        <div class="inside">
                            <div id="submitpost" class="submitbox preview-box">
                                preview goes here
                            </div>
                        </div>
                        <button class="button button-primary right preview-poll">
							<?php _e( 'Live Preview', 'yop-poll' );?>
						</button>
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
<!-- begin templates -->
<div class='yop-templates'>
<?php
foreach( $templates as $template ) {
    ?>
    <div class='template' data-base='<?php echo $template->base?>' style='display:none'>
        <div class='preview'>
            <?php echo $template->html_preview;?>
        </div>
        <div class='vertical'>
            <?php echo $template->html_vertical;?>
        </div>
        <div class='horizontal'>
            <?php echo $template->html_horizontal;?>
        </div>
        <div class='columns'>
            <?php echo $template->html_columns;?>
        </div>
    </div>
    <?php
}
?>
</div>
<!-- end templates -->
<!-- begin live preview -->
<div class="bootstrap-yop">
    <div id="yop-poll-preview" class="hide">
    </div>
</div>
<!-- end live preview -->
