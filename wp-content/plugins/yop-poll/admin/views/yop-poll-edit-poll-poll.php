<div class="row">
	<div class="col-md-12">
		&nbsp;
	</div>
</div>
<div class="row vote-options">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<h4>
					<?php _e( 'Vote Button', 'yop-poll' );?>
				</h4>
			</div>
		</div>
		<div class="form-horizontal">
			<div class="form-group">
				<div class="col-md-3 field-caption">
					<?php _e( 'Vote Button Label', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control vote-button-label" value="<?php echo esc_html( $poll->meta_data['options']['poll']['voteButtonLabel'] );?>"/>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Show [Results] Link', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        if ( 'yes' === $poll->meta_data['options']['poll']['showResultsLink'] ) {
			            $show_results_link_yes = 'selected';
			            $show_results_link_no = '';
						$show_results_link_class = '';
			        } else {
			            $show_results_link_yes = '';
			            $show_results_link_no = 'selected';
						$show_results_link_class = 'hide';
			        }
			        ?>
			        <select class="show-results-link" style="width:100%">
			            <option value="yes" <?php echo $show_results_link_yes;?>><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" <?php echo $show_results_link_no;?>><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group results-link-option <?php echo $show_results_link_class?>">
				<div class="col-md-3 field-caption">
					<?php _e( '[Results] Link Label', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control results-label-text" value="<?php echo esc_html( $poll->meta_data['options']['poll']['resultsLabelText'] );?>"/>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Show Total Votes', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        if ( 'yes' === $poll->meta_data['options']['poll']['showTotalVotes'] ) {
			            $show_total_votes_yes = 'selected';
			            $show_total_votes_no = '';
			        } else {
			            $show_total_votes_yes = '';
			            $show_total_votes_no = 'selected';
			        }
			        ?>
			        <select class="show-total-votes" style="width:100%">
			            <option value="yes" <?php echo $show_total_votes_yes;?>><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" <?php echo $show_total_votes_no;?>><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Show Total Answers', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        if ( 'yes' === $poll->meta_data['options']['poll']['showTotalAnswers'] ) {
			            $show_total_answers_yes = 'selected';
			            $show_total_answers_no = '';
			        } else {
			            $show_total_answers_yes = '';
			            $show_total_answers_no = 'selected';
			        }
			        ?>
			        <select class="show-total-answers" style="width:100%">
			            <option value="yes" <?php echo $show_total_votes_yes;?>><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" <?php echo $show_total_votes_no;?>><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4>
					<?php _e( 'Preferences', 'yop-poll' );?>
				</h4>
			</div>
		</div>
		<div class="form-horizontal poll-preferences">
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Start Date', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        if ( 'now' === $poll->meta_data['options']['poll']['startDateOption'] ) {
			            $start_date_now = 'selected';
			            $start_date_custom = '';
			            $start_date_custom_class = 'hide';
			        } else {
			            $start_date_now = '';
			            $start_date_custom = 'selected';
			            $start_date_custom_class = '';
			        }
			        ?>
					<select class="start-date-option" style="width:100%">
			            <option value="now" <?php echo $start_date_now;?>><?php _e( 'Now', 'yop-poll' );?></option>
			            <option value="custom" <?php echo $start_date_custom;?>><?php _e( 'Custom Date', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group start-date-section <?php echo $start_date_custom_class;?>">
				<div class="col-md-3">
				</div>
				<div class="col-md-9">
					<div class="input-group">
						<input type="text" class="form-control start-date-custom" value="<?php echo $poll->meta_data['options']['poll']['startDateCustom'];?>" readonly />
						<input type="hidden" class="form-control start-date-custom-hidden" value="<?php echo $poll->meta_data['options']['poll']['startDateCustom'];?>" />
		                <div class="input-group-addon">
							<i class="fa fa-calendar show-start-date" aria-hidden="true"></i>
		                </div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'End Date', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        if ( 'never' === $poll->meta_data['options']['poll']['endDateOption'] ) {
			            $end_date_never = 'selected';
			            $end_date_custom = '';
			            $end_date_custom_class = 'hide';
			        } else {
			            $end_date_never = '';
			            $end_date_custom = 'selected';
			            $end_date_custom_class = '';
			        }
			        ?>
			        <select class="end-date-option" style="width:100%">
			            <option value="never" <?php echo $end_date_never;?>><?php _e( 'Never', 'yop-poll' );?></option>
			            <option value="custom" <?php echo $end_date_custom;?>><?php _e( 'Custom Date', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group end-date-section <?php echo $end_date_custom_class;?>">
				<div class="col-md-3">
				</div>
				<div class="col-md-9">
					<div class="input-group">
						<input type="text" class="form-control end-date-custom" value="<?php echo $poll->meta_data['options']['poll']['endDateCustom']?>" readonly />
						<input type="hidden" class="form-control end-date-custom-hidden" value="<?php echo $poll->meta_data['options']['poll']['endDateCustom']?>" />
		                <div class="input-group-addon">
							<i class="fa fa-calendar show-end-date" aria-hidden="true"></i>
		                </div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Redirect after vote', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        if ( 'yes' === $poll->meta_data['options']['poll']['redirectAfterVote'] ) {
			            $redirect_after_vote_yes = 'selected';
			            $redirect_after_vote_no = '';
						$redirect_after_vote_class = '';
						$redirect_url = $poll->meta_data['options']['poll']['redirectUrl'];
			        } else {
			            $redirect_after_vote_yes = '';
			            $redirect_after_vote_no = 'selected';
						$redirect_after_vote_class = 'hide';
						$redirect_url = '';
			        }
			        ?>
			        <select class="redirect-after-vote" style="width:100%">
			            <option value="yes" <?php echo $redirect_after_vote_yes;?>><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" <?php echo $redirect_after_vote_no;?>><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group redirect-url-section <?php echo $redirect_after_vote_class?>">
				<div class="col-md-3 field-caption">
					<?php _e( 'Redirect Url', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control redirect-url" value="<?php echo $redirect_url;?>"/>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Reset Poll Stats automatically', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        if ( 'yes' === $poll->meta_data['options']['poll']['resetPollStatsAutomatically'] ) {
			            $reset_poll_stats_automatically_yes = 'selected';
			            $reset_poll_stats_automatically_no = '';
						$reset_poll_stats_automatically_class = '';
			        } else {
			            $reset_poll_stats_automatically_yes = '';
			            $reset_poll_stats_automatically_no = 'selected';
						$reset_poll_stats_automatically_class = 'hide';
			        }
			        ?>
			        <select class="reset-poll-stats-automatically" style="width:100%">
			            <option value="yes" <?php echo $reset_poll_stats_automatically_yes;?>><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" <?php echo $reset_poll_stats_automatically_no;?>><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group reset-poll-stats-section <?php echo $reset_poll_stats_automatically_class;?>">
				<div class="col-md-3">
					<?php _e( 'Reset on', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<div class="input-group">
						<input type="text" class="form-control reset-poll-stats-on" value="<?php echo $poll->meta_data['options']['poll']['resetPollStatsOn'];?>" readonly />
						<input type="hidden" class="form-control reset-poll-stats-on-hidden" value="<?php echo $poll->meta_data['options']['poll']['resetPollStatsOn'];?>" />
		                <div class="input-group-addon">
							<i class="fa fa-calendar show-reset-poll-stats-on" aria-hidden="true"></i>
		                </div>
					</div>
				</div>
			</div>
			<div class="form-group reset-poll-stats-section <?php echo $reset_poll_stats_automatically_class;?>">
				<div class="col-md-3">
					<?php _e( 'Reset every', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control reset-poll-stats-every" value="<?php echo $poll->meta_data['options']['poll']['resetPollStatsEvery'];?>"/>
					<?php
                    if ( 'yes' === $poll->meta_data['options']['poll']['resetPollStatsEveryPeriod'] ) {
                        $reset_poll_stats_every_period_hours = 'selected';
                        $reset_poll_stats_every_period_days = '';
                    } else {
                        $reset_poll_stats_every_period_hours = '';
                        $reset_poll_stats_every_period_days = 'selected';
                    }
                    ?>
                    <select class="reset-poll-stats-every-period" style="width:100%">
                        <option value="hours" <?php echo $reset_poll_stats_every_period_hours;?>><?php _e( 'Hours', 'yop-poll' );?></option>
                        <option value="days" <?php echo $reset_poll_stats_every_period_days;?>><?php _e( 'Days', 'yop-poll' );?></option>
                    </select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Auto Generate Poll Page', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        if ( 'yes' === $poll->meta_data['options']['poll']['autoGeneratePollPage'] ) {
			            $auto_generate_poll_page_yes = 'selected';
			            $auto_generate_poll_page_no = '';
			        } else {
			            $auto_generate_poll_page_yes = '';
			            $auto_generate_poll_page_no = 'selected';
			        }
			        ?>
			        <select class="auto-generate-poll-page" style="width:100%">
			            <option value="yes" <?php echo $auto_generate_poll_page_yes;?>><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" <?php echo $auto_generate_poll_page_no;?>><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Use Captcha', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        if ( 'yes' === $poll->meta_data['options']['poll']['useCaptcha'] ) {
			            $use_captcha_yes = 'selected';
			            $use_captcha_no = '';
			        } else {
			            $use_captcha_yes = '';
			            $use_captcha_no = 'selected';
			        }
			        ?>
			        <select class="use-captcha" style="width:100%">
			            <option value="yes" <?php echo $use_captcha_yes;?>><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" <?php echo $use_captcha_no;?>><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4>
					<?php _e( 'Notifications', 'yop-poll' );?>
				</h4>
			</div>
		</div>
		<div class="form-horizontal poll-notifications">
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Send Email notifications', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        if ( 'yes' === $poll->meta_data['options']['poll']['sendEmailNotifications'] ) {
			            $send_email_notifications_yes = 'selected';
			            $send_email_notifications_no = '';
			            $send_email_notifications_class = '';
			        } else {
			            $send_email_notifications_yes = '';
			            $send_email_notifications_no = 'selected';
			            $send_email_notifications_class = 'hide';
			        }
			        ?>
			        <select class="send-email-notifications" style="width:100%">
			            <option value="yes" <?php echo $send_email_notifications_yes;?>><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" <?php echo $send_email_notifications_no;?>><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group send-email-notifications-section <?php echo $send_email_notifications_class;?>">
				<div class="col-md-3 field-caption">
					<?php _e( 'From Name', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control email-notifications-from-name" value="<?php echo esc_html( $poll->meta_data['options']['poll']['emailNotificationsFromName'] );?>"/>
				</div>
			</div>
			<div class="form-group send-email-notifications-section <?php echo $send_email_notifications_class;?>">
				<div class="col-md-3 field-caption">
					<?php _e( 'From Email', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control email-notifications-from-email" value="<?php echo esc_html( $poll->meta_data['options']['poll']['emailNotificationsFromEmail'] );?>"/>
				</div>
			</div>
			<div class="form-group send-email-notifications-section <?php echo $send_email_notifications_class;?>">
				<div class="col-md-3 field-caption">
					<?php _e( 'Subject', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control email-notifications-subject" value="<?php echo esc_html( $poll->meta_data['options']['poll']['emailNotificationsSubject'] );?>"/>
				</div>
			</div>
			<div class="form-group send-email-notifications-section <?php echo $send_email_notifications_class;?>">
				<div class="col-md-3 field-caption">
					<?php _e( 'Message', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<textarea class="form-control email-notifications-message"><?php echo esc_textarea( $poll->meta_data['options']['poll']['emailNotificationsMessage'] );?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4>
					<?php _e( 'Compliance', 'yop-poll' );?>
				</h4>
			</div>
		</div>
		<div class="form-horizontal poll-compliance">
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Enable GDPR', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
			        if ( 'yes' === $poll->meta_data['options']['poll']['enableGdpr'] ) {
			            $enable_gdpr_yes = 'selected';
			            $enable_gdpr_no = '';
						$enable_gdpr_class = '';
						if ( 'consent' === $poll->meta_data['options']['poll']['gdprSolution'] ) {
							$enable_gdpr_consent_class = '';
						} else {
							$enable_gdpr_consent_class = 'hide';
						}
			        } else {
						$enable_gdpr_yes = '';
						$enable_gdpr_no = 'selected';
			            $enable_gdpr_class = 'hide';
						$enable_gdpr_consent_class = 'hide';
			        }
			        ?>
					<select class="enable-gdpr" style="width:100%">
			            <option value="yes" <?php echo $enable_gdpr_yes?>><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no"  <?php echo $enable_gdpr_no?>><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group gdpr-solution-section <?php echo $enable_gdpr_class;?>">
				<div class="col-md-3 field-caption">
					<?php _e( 'Solution', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<?php
					$gdpr_solution_consent = '';
					$gdpr_solution_anonymize = '';
					$gdpr_solution_nostore = '';
					switch ( $poll->meta_data['options']['poll']['gdprSolution'] ) {
						case 'consent': {
							$gdpr_solution_consent = 'selected';
							break;
						}
						case 'anonymize': {
							$gdpr_solution_anonymize = 'selected';
							break;
						}
						case 'nostore': {
							$gdpr_solution_nostore = 'selected';
							break;
						}
						default: {
							$gdpr_solution_consent = 'selected';
							break;
						}
					}
					?>
					<select class="gdpr-solution" style="width:100%">
			            <option value="consent" <?php echo $gdpr_solution_consent;?>><?php _e( 'Ask for consent ( Ip Addresses will be stored and cookies will be enabled )', 'yop-poll' );?></option>
			            <option value="anonymize" <?php echo $gdpr_solution_anonymize;?>><?php _e( 'Anonymize Ip Addresses ( Cookies will be disabled ) ', 'yop-poll' );?></option>
						<option value="nostore" <?php echo $gdpr_solution_nostore;?>><?php _e( 'Do not store Ip Addresses ( Cookies will be disabled ) ', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group gdpr-consent-section <?php echo $enable_gdpr_consent_class;?>">
				<div class="col-md-3 field-caption">
					<?php _e( 'Text for consent checkbox', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<textarea class="form-control gdpr-consent-text"><?php echo esc_textarea( $poll->meta_data['options']['poll']['gdprConsentText'] );?></textarea>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		&nbsp;
	</div>
</div>
