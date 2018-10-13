<ul class="ubergrid-tabs">
	<li class="ubergrid-current">
    <a href="#ubergrid-extras-filters"><?php _e('Filters', 'uber-grid') ?></a>
  </li>
	<li><a href="#ubergrid-extras-pagination">
    <?php _e('Pagination', 'uber-grid') ?></a></li>
	<li><a href="#ubergrid-extras-effects">
    <?php _e('Effects', 'uber-grid') ?></a></li>
  <li><a href="#ubergrid-extras-lightbox">
    <?php _e('Lightbox', 'uber-grid') ?></a></li>
</ul>
<ul class="ubergrid-panels">
	<?php foreach(array('filters', 'pagination', 'effects', 'lightbox')
    as $panel): ?>
		<li id="ubergrid-layout-<?php echo $panel ?>"
      class="<?php echo $panel == 'default' ? 'ubergrid-current' : '' ?>">
        <?php require("meta-box-extras-$panel.php") ?></li>
	<?php endforeach ?>
</ul>
<br class="clear">
