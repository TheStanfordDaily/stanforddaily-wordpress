<?php if ( isset( $_POST['success-message'] ) ) : ?>
	<div class="alert-success alert alert-dismissible fade in" role="alert"><?php echo $_POST['success-message'] ?></div>
<?php endif ?>

<?php if ( isset( $_POST['error-message'] ) ) : ?>
	<div class="alert-error alert alert-dismissible fade in" role="alert"><?php echo $_POST['error-message'] ?></div>
<?php endif ?>

<form method="post" action="">
	<div class="row clearfix">
		<!-- old password -->
		<div class="col-md-6 old_password-field">
			<div class="form-group">
                <label for="old_password"><?php jnews_print_translation('Old Password', 'jnews', 'old_password'); ?> <span class="required">*</span></label>
		        <input id="old_password" name="old_password" type="password" class="form-control" value="">
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<!-- new password -->
		<div class="col-md-6 new_password-field">
			<div class="form-group">
                <label for="new_password"><?php jnews_print_translation('New Password', 'jnews', 'new_password'); ?></label> <span class="required">*</span></label>
		        <input id="new_password" name="new_password" type="password" class="form-control" value="">
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<!-- confirm password -->
		<div class="col-md-6 confirm_password-field">
			<div class="form-group">
                <label for="confirm_password"><?php jnews_print_translation('Confirm Password', 'jnews', 'confirm_password'); ?></label> <span class="required">*</span></label>
		        <input id="confirm_password" name="confirm_password" type="password" class="form-control" value="">
			</div>
		</div>
	</div>
	<div class="row clearfix">
        <!-- submit -->
        <div class="col-md-12">
            <div class="form-group">
				<input type="hidden" name="jnews-action" value="change-password" />
                <input type="hidden" name="user_id" value="<?php echo esc_attr( get_current_user_id() ); ?>" />
                <input type="hidden" name="jnews-account-nonce" value="<?php echo esc_attr( wp_create_nonce('jnews-account-nonce') ); ?>"/>
                <input type="submit" value="<?php jnews_print_translation('Change Password', 'jnews', 'change_password_button'); ?>"/>
            </div>
        </div>
	</div>
</form>