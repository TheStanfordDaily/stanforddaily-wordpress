<script type="text/template" id="ug-manual-editor-template">
	<h2 class="cells-header">
		<?php _e('Cells', 'uber-grid') ?>
		<button class="button" data-action="add-new-before"><?php _e('Add new at the top', 'uber-grid')?></button>
	</h2>
	<ul class="ug-cells"></ul>
	<h2 class="cells-header"><button class="button" data-action="add-new-after"><?php _e('Add new at the bottom', 'uber-grid')?></button></h2>
</script>

<script type="text/template" id="ug-manual-editor-no-cells-template">
	<?php _e('No cells yet', 'uber-grid') ?>
</script>

<script type="text/template" id="ug-cell-manual-template">
	<h3>
		<span class="handle"></span>
		<a href="#" data-action="clone" class="ug-action-link"><?php _e('clone', 'uber-crid')?></a>
		<a href="#" data-action="remove" class="ug-action-link"><?php _e('remove', 'uber-crid')?></a>
		<span class="heading"></span>
	</h3>
	<div class="ug-cell-content">
		<div class="ug-cell-main-wrapper ug-section-wrapper"></div>
		<div class="ug-cell-filtering-wrapper ug-section-wrapper"></div>
		<div class="ug-cell-layout-wrapper ug-section-wrapper"></div>
		<div class="ug-cell-linking-wrapper ug-section-wrapper"></div>
		<div class="ug-cell-hover-wrapper ug-section-wrapper"></div>
		<div class="ug-cell-label-wrapper ug-section-wrapper"></div>
	</div>
</script>

