<p>
	<label><?php _e('Cell width', 'uber-grid')?></label>
	<input type="number" rv-value=":cell_width" placeholder="160">px
</p>
<p>
	<label><?php _e('Cell height', 'uber-grid')?></label>
	<input type="number" rv-value=":cell_height" placeholder="0">px
</p>
<p>
	<label><?php _e('Gap between cells', 'uber-grid')?></label>
	<input type="number" rv-value=":cell_gap" placeholder="0">px
</p>
<p>
	<label><?php _e('Max grid width', 'uber-grid')?></label>
	<input type="number" rv-value=":max_width" placeholder="" step="1">px
</p>
<p>
	<label><?php _e('Responsive cell size', 'uber-grid') ?></label>
	<select rv-value=":cell_autosize">
		<option value="0"><?php _e('Disabled', 'uber-grid') ?></option>
		<option value="1"><?php _e('Enabled', 'uber-grid') ?></option>
	</select>
</p>
<p>
	<label><?php _e('Columns', 'uber-grid') ?></label>
	<select rv-value=":columns">
		<option value=""><?php _e('Auto', 'uber-grid') ?></option>
		<?php for ($col = 2; $col < 15; $col++) { ?>
		<option value="<?php echo $col ?>"><?php echo $col ?></option>
		<?php } ?>
	</select>
</p>

<p>
	<label><?php _e('Cell border width', 'uber-grid')?></label>
	<input type="number" rv-value=":cell_border_width" placeholder="0">px
</p>
<p>
	<label><?php _e('Border color', 'uber-grid')?></label>
	<input type="text" rv-value=":cell_border_color" placeholder="FFFFFF">
</p>
<p>
	<label><?php _e('Border radius', 'uber-grid')?></label>
	<input type="number" rv-value=":cell_border_radius" placeholder="0">px
</p>
<p>
	<label><?php _e('Border opacity', 'uber-grid')?></label>
	<input type="number" rv-value=":cell_border_opacity" placeholder="1.0" step="any">
</p>
<p>
	<label><?php _e('Shadow radius', 'uber-grid')?></label>
	<input type="number" rv-value=":cell_shadow_radius" placeholder="0">px
</p>
<p>
	<label><?php _e('Max label height', 'uber-grid') ?></label>
	<input type="number" rv-value=":label_max_height" step="1">px
</p>
