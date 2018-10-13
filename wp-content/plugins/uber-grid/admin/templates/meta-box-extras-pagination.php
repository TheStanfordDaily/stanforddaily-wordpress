<p><label><input type="checkbox" value="1" rv-checked="model:pagination:enable"> <?php _e('Enable pagination')?></label></p>
<p>
	<label><?php _e('Style', 'uber-grid')?></label>
	<select rv-value="model:pagination:style">
		<option value="pagination"><?php _e('Pages', 'uber-grid')?></option>
		<option value="load-more"><?php _e('Load more', 'uber-grid')?></option>
	</select>
</p>
<p>
	<label><?php _e('Items per page')?></label>
	<input type="number" rv-value="model:pagination:per_page">
</p>
<p><label><?php _e('Color: ', 'uber-grid')?></label><input type="text" rv-value="model:pagination:color"></p>
<p><label><?php _e('Background color: ', 'uber-grid')?></label><input type="text" rv-value="model:pagination:background_color"></p>
<p><label><?php _e('Border color:', 'uber-grid')?></label><input type="text" rv-value="model:pagination:border_color"></p>
<p rv-show="model:pagination.isPagination < :style">
	<label><?php _e('Current page color: ', 'uber-grid')?></label>
	<input type="text" rv-value="model:pagination:current_page_color">
</p>
<p rv-show="model:pagination.isPagination < :style">
	<label><?php _e('Current page bg color: ', 'uber-grid')?></label>
	<input type="text" rv-value="model:pagination:current_page_background_color">
</p>
<p rv-show="model:pagination.isPagination < :style">
	<label><?php _e('Current page border color:', 'uber-grid')?></label>
	<input type="text" rv-value="model:pagination:current_page_border_color">
</p>
<p><label><?php _e('Align:', 'uber-grid')?></label>
	<select rv-value="model:pagination:align">
	<option value="center"><?php _e('Center', 'uber-grid')?></option>
	<option value="left"><?php _e('Left', 'uber-grid')?></option>
	<option value="right"><?php _e('Right', 'uber-grid')?></option>
</select>
</p>
<p><label><?php _e('"Load more" wording', 'uber-grid')?></label><input type="text" rv-value="model:pagination:load_more"></p>
