<div class="row">
	<div class="col-md-12">
		&nbsp;
	</div>
</div>
<div class="row">
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
					<input type="text" class="form-control vote-button-label" value="<?php _e( 'Vote', 'yop-poll' );?>"/>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Show [Results] Link', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<select class="show-results-link" style="width:100%">
			            <option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group results-link-option hide">
				<div class="col-md-3 field-caption">
					<?php _e( '[Results] Link Label', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control results-label-text" value="<?php _e( 'Results', 'yop-poll' );?>"/>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Show Total Votes', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<select class="show-total-votes" style="width:100%">
			            <option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Show Total Answers', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<select class="show-total-answers" style="width:100%">
			            <option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
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
					<select class="start-date-option" style="width:100%">
			            <option value="now" selected><?php _e( 'Now', 'yop-poll' );?></option>
			            <option value="custom"><?php _e( 'Custom Date', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group start-date-section hide">
				<div class="col-md-3">
				</div>
				<div class="col-md-9">
					<div class="input-group">
						<input type="text" class="form-control start-date-custom" readonly />
						<input type="hidden" class="form-control start-date-custom-hidden" />
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
					<select class="end-date-option" style="width:100%">
			            <option value="never" selected><?php _e( 'Never', 'yop-poll' );?></option>
			            <option value="custom"><?php _e( 'Custom Date', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group end-date-section hide">
				<div class="col-md-3">
				</div>
				<div class="col-md-9">
					<div class="input-group">
						<input type="text" class="form-control end-date-custom" readonly />
						<input type="hidden" class="form-control end-date-custom-hidden" />
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
					<select class="redirect-after-vote" style="width:100%">
			            <option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group redirect-url-section hide">
				<div class="col-md-3 field-caption">
					<?php _e( 'Redirect Url', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control redirect-url"/>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Reset Poll Stats automatically', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<select class="reset-poll-stats-automatically" style="width:100%">
			            <option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group reset-poll-stats-section hide">
				<div class="col-md-3">
					<?php _e( 'Reset on', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<div class="input-group">
						<input type="text" class="form-control reset-poll-stats-on" readonly />
						<input type="hidden" class="form-control reset-poll-stats-on-hidden" />
		                <div class="input-group-addon">
							<i class="fa fa-calendar show-reset-poll-stats-on" aria-hidden="true"></i>
		                </div>
					</div>
				</div>
			</div>
			<div class="form-group reset-poll-stats-section hide">
				<div class="col-md-3">
					<?php _e( 'Reset every', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control reset-poll-stats-every" value="24"/>
					<select class="reset-poll-stats-every-period" style="width:100%">
                        <option value="hours" selected><?php _e( 'Hours', 'yop-poll' );?></option>
                        <option value="days"><?php _e( 'Days', 'yop-poll' );?></option>
                    </select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Auto Generate Poll Page', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<select class="auto-generate-poll-page" style="width:100%">
			            <option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
					<?php _e( 'Use Captcha', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<select class="use-captcha" style="width:100%">
			            <option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
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
					<select class="send-email-notifications" style="width:100%">
			            <option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group send-email-notifications-section hide">
				<div class="col-md-3 field-caption">
					<?php _e( 'From Name', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control email-notifications-from-name" value="<?php echo $email_settings['from_name'];?>"/>
				</div>
			</div>
			<div class="form-group send-email-notifications-section hide">
				<div class="col-md-3 field-caption">
					<?php _e( 'From Email', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control email-notifications-from-email" value="<?php echo $email_settings['from_email'];?>"/>
				</div>
			</div>
			<div class="form-group send-email-notifications-section hide">
				<div class="col-md-3 field-caption">
					<?php _e( 'Subject', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<input type="text" class="form-control email-notifications-subject" value="<?php echo $email_settings['subject'];?>"/>
				</div>
			</div>
			<div class="form-group send-email-notifications-section hide">
				<div class="col-md-3 field-caption">
					<?php _e( 'Message', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<textarea class="form-control email-notifications-message"><?php echo $email_settings['message'];?></textarea>
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
					<select class="enable-gdpr" style="width:100%">
			            <option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
			            <option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group gdpr-solution-section hide">
				<div class="col-md-3 field-caption">
					<?php _e( 'Solution', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<select class="gdpr-solution" style="width:100%">
			            <option value="consent"><?php _e( 'Ask for consent ( Ip Addresses will be stored and cookies will be enabled )', 'yop-poll' );?></option>
			            <option value="anonymize"><?php _e( 'Anonymize Ip Addresses ( Cookies will be disabled ) ', 'yop-poll' );?></option>
						<option value="nostore"><?php _e( 'Do not store Ip Addresses ( Cookies will be disabled ) ', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="form-group gdpr-consent-section hide">
				<div class="col-md-3 field-caption">
					<?php _e( 'Text for consent checkbox', 'yop-poll' );?>
				</div>
				<div class="col-md-9">
					<textarea class="form-control gdpr-consent-text"></textarea>
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
