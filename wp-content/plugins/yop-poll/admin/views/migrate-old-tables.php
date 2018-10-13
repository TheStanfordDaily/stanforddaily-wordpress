<?php
$ajax_nonce = wp_create_nonce( "yop-poll-ajax-importer" );
?>
<div id="yop-main-area" class="bootstrap-yop wrap migrate-section">
	<div class="row" style="margin-top: 10px;">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<h3 class="text-center">
				<?php _e( 'Here you can migrate data( votes, bans, logs ) from previous version', 'yop-poll' );?>
			</h3>
			<p>&nbsp;</p>
			<div class="row">
				<div class="col-md-2">
					<?php _e( 'Enable GDPR', 'yop-poll' );?>
				</div>
				<div class="col-md-10">
					<select class="migrate-enable-gdpr" style="width:100%">
						<option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
						<option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
					</select>
				</div>
			</div>
			<div class="row migrate-gdpr-solution-section hide" style="margin-top: 10px;">
				<div class="col-md-2">
					<?php _e( 'Solution', 'yop-poll' );?>
				</div>
				<div class="col-md-10">
					<select class="migrate-gdpr-solution" style="width:100%">
			            <option value="consent"><?php _e( 'Migrate as is', 'yop-poll' );?></option>
			            <option value="anonymize"><?php _e( 'Anonymize Ip Addresses', 'yop-poll' );?></option>
						<option value="nostore"><?php _e( 'Do not migrate Ip Addresses', 'yop-poll' );?></option>
			        </select>
				</div>
			</div>
			<div class="row" style="margin-top: 10px;">
				<div class="col-md-12 text-center">
					<input type="hidden" id="_csrf_token" value="<?php echo $ajax_nonce; ?>" name="_csrf_token">
					<button class="button send-request">
							<?php _e( 'Start Migrating', 'yop-poll' );?>
					</button>
				</div>
			</div>
			<div class="row" style="margin-top: 10px;">
				<div class="col-md-12 text-center migrate-output">
				</div>
			</div>
		</div>
		<div class="col-md-2">
		</div>
	</div>
</div>
