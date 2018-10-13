<div id="filters-options">
	<p><label><?php _e('Style:', 'uber-grid')?></label>
		<select rv-value="model:filters:style">
			<option value="tabs"><?php _e('Tabs', 'uber-grid')?></option>
			<option value="dropdown"><?php _e('Dropdown', 'uber-grid')?></option>
		</select>
	</p>
	<p><label><?php _e('Color: ', 'uber-grid')?></label><input type="text" rv-value="model:filters:color"></p>
	<p><label><?php _e('Border color: ', 'uber-grid')?></label><input type="text" rv-value="model:filters:border_color"></p>
	<p><label><?php _e('Background color: ', 'uber-grid')?></label><input type="text" rv-value="model:filters:background_color"></p>
	<p><label><?php _e('Accent color: ', 'uber-grid')?></label><input type="text" rv-value="model:filters:accent_color"></p>
	<p><label><?php _e('Accent border color: ', 'uber-grid')?></label><input type="text" rv-value="model:filters:accent_border_color"></p>
	<p><label><?php _e('Accent background color: ', 'uber-grid')?></label><input type="text" rv-value="model:filters:accent_background_color"></p>
	<p>
		<label><?php _e('Sort filters', 'uber-grid')?></label>
		<select rv-value="model:filters:sort">
			<option value="0"><?php _e('Off', 'uber-grid')?></option>
			<option value="1"><?php _e('On', 'uber-grid')?></option>
		</select>
	</p>
	<p><label><?php _e('Align:', 'uber-grid')?></label>
		<select rv-value="model:filters:align">
		<option value="center"><?php _e('Center', 'uber-grid')?></option>
		<option value="left"><?php _e('Left', 'uber-grid')?></option>
		<option value="right"><?php _e('Right', 'uber-grid')?></option>
	</select></p>
	<p>
		<label><?php _e('Exclude "All" from filters', 'uber-grid')?></label>
		<select rv-value="model:filters:exclude_all">
			<option value="0"><?php _e('Off - "All" will be visible', 'uber-grid') ?></option>
			<option value="1"><?php _e('On - "All" will be hidden')?></option>
		</select>
	<p rv-hide="model:filters:exclude_all"><label><?php _e('"All" wording', 'uber-grid')?></label>
		<input type="text" rv-value="model:filters:all">
	</p>
	<p>
		<label><?php _e('Default filtering category:', 'uber-grid') ?></label>
		<select rv-value="model:filters:default">
			<option value=""><?php _e('None', 'uber-grid')?></option>
			<?php foreach($grid->get_tags_from_cells($grid->get_cells()) as $tag): ?>
				<option value="<?php echo esc_attr($tag) ?>"><?php echo esc_html($tag)?></option>
			<?php endforeach ?>
		</select>
	</p>
	<p>
		<label><?php _e('Filtering categories <small>(comma-separated)</small>', 'uber-grid')?></label>
		<textarea rv-value="model:filters:tags" rows="7"></textarea>

	</p>
</div>
