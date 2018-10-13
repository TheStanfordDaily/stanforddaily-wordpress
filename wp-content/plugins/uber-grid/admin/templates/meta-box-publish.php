<div class="submitbox" id="submitpost">
	<div id="minor-publishing">
		<div id="misc-publishing-actions">
			<div class="misc-pub-section">
				<a href="#" class="button-primary" id="preview"><?php _e('Preview', 'ubergrid')?></a>
				<a href="<?php echo wp_nonce_url(admin_url('admin-ajax.php?action=uber_grid_clone&id=' . $post->ID), 'ubergrid-clone-' . $post->ID) ?>" id="clone"><?php _e('Create a copy', 'uber-grid')?></a>
			</div>
		</div>
		<div class="clear"></div>
	</div>

	<div id="major-publishing-actions">
		<div id="delete-action">
		<?php
		if ( current_user_can( "delete_post", $post->ID ) ) {
			if ( !EMPTY_TRASH_DAYS )
				$delete_text = __('Delete Permanently');
			else
				$delete_text = __('Move to Trash');
			?>
		<a class="submitdelete deletion" href="<?php echo get_delete_post_link($post->ID); ?>"><?php echo $delete_text; ?></a><?php
		} ?>
		</div>
		<div id="publishing-action">
			<span class="spinner"></span>
			<?php if ($post->post_status == 'auto-draft'): ?>
				<input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e('Publish') ?>" />
				<?php submit_button( __( 'Create', 'uber-grid' ), 'primary', 'publish', false, array( 'tabindex' => '5', 'accesskey' => 'p' ) ); ?>
			<?php else: ?>
				<input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e('Update') ?>" />
				<input name="save" type="submit" class="button-primary" id="publish" tabindex="5" accesskey="p" disabled="disabled" value="<?php esc_attr_e('Save', 'uber-grid') ?>" />
			<?php endif ?>

		</div>
		<input name="un_redirect_back" value="<?php echo esc_attr(isset($_REQUEST['un_redirect_back']) ? $_REQUEST['un_redirect_back'] : $_SERVER['HTTP_REFERER']) ?>" type="hidden">
		<div class="clear"></div>
	</div>
</div>
