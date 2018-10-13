<div class="uber-grid-edit-wrapper">
	<a href="<?php echo admin_url(
		'edit.php?post_type=uber-grid&page=support&url=http://' .
		$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']) ?>">
		<?php _e('Ask for support','uber-grid') ?>
	</a>
	&nbsp;
	<a href="<?php echo admin_url("post.php?post={$this->id}&action=edit") ?>"
		class="edit-grid">
		<?php _e('Edit grid', 'uber-grid')?>
	</a>
</div>
