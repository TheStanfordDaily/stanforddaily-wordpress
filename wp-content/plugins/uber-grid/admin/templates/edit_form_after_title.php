<?php $grid = new UberGrid_Grid($post->ID) ?>

<input type="hidden" name="uber-grid-data" id="ug-data" value="<?php echo esc_attr($grid->get_json_data()) ?>">
<?php if ($post->post_status == 'publish'): ?>
	<div id="shortcode">
		<label><?php _e('Shortcode', 'uber-grid') ?>:</label> [ubergrid id=<?php echo $post->ID?>]
	</div>
<?php endif ?>


<h2 class="nav-tab-wrapper">
	<a href="<?php echo admin_url('edit.php?post_type=uber-grid&page=support&url=http://' . urlencode($_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'])) ?>"
	   class="button-primary" style="float: right"><?php _e('Ask for support', 'uber-grid') ?></a>
	<a href="options-general.php?page=uber-grid-options" target="_blank" class="button" id="settings" style="float: right; margin-right: 1em"><?php _e('Global settings', 'uber-grid') ?></a>
	<a href="#manual" id="ug-manual-mode-link" class="nav-tab"><?php _e('Manual', 'uber-grid')?></a>
	<a href="#auto" id="ug-auto-mode-link" class="nav-tab"><?php _e('Automatic', 'uber-grid')?></a>
</h2>
<div id="ug-editor-wrapper"></div>
<?php require(dirname(__FILE__) . "/backbone/manual-editor.php") ?>
<?php require(dirname(__FILE__) . "/backbone/cell-sections.php") ?>
<?php require(dirname(__FILE__) . "/backbone/auto-editor.php") ?>








