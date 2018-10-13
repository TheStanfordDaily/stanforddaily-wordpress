<ul class="ubergrid-tabs">
	<li class="ubergrid-current"><a href="#ubergrid-layout-default"><?php _e('Default', 'uber-grid') ?></a></li>
	<li><a href="#ubergrid-layout-768"><?php _e('< 768px', 'uber-grid') ?></a></li>
	<li><a href="#ubergrid-layout-440"><?php _e('< 440px', 'uber-grid') ?></a></li>
</ul>
<ul class="ubergrid-panels">
	<li id="ubergrid-layout-default" class="ubergrid-current"><?php require(dirname(__FILE__) . "/meta-box-layout-default.php") ?></li>
	<li id="ubergrid-layout-768"><?php require(dirname(__FILE__) . "/meta-box-layout-440.php") ?></li>
	<li id="ubergrid-layout-440"><?php require(dirname(__FILE__) . "/meta-box-layout-440.php") ?></li>
</ul>
<br class="clear">
