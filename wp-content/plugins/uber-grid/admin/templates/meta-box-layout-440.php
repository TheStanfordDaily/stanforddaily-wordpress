<p>
	<label><?php _e('Cell width', 'uber-grid')?></label>
	<input type="number" rv-value=":cell_width" placeholder="160">px
</p>
<p>
	<label><?php _e('Cell height', 'uber-grid')?></label>
	<input type="number" rv-value=":cell_height" placeholder="0">px
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
	<label><?php _e('Gap between cells', 'uber-grid')?></label>
	<input type="number" rv-value=":cell_gap" placeholder="0">
</p>
<p>
	<label><?php _e('Cell border width', 'uber-grid')?></label>
	<input type="number" rv-value=":cell_border_width" placeholder="0">
</p>
<p>
	<label><?php _e('Cell border radius', 'uber-grid')?></label>
	<input type="number" rv-value=":cell_border_radius" placeholder="0">
</p>
<p>
	<label><?php _e('Title font size', 'uber-grid')?></label>
	<input type="number" rv-value=":title_font_size">
</p>
<p>
	<label><?php _e('Tagline font size', 'uber-grid')?></label>
	<input type="number" rv-value=":tagline_font_size">
</p>
<p>
	<label><?php _e('Hover title font size', 'uber-grid')?></label>
	<input type="number" rv-value=":hover_title_font_size">
</p>
<p>
	<label><?php _e('Hover text font size', 'uber-grid')?></label>
	<input type="number" rv-value=":hover_text_font_size">
</p>
<p>
	<label><?php _e('Label title font size', 'uber-grid')?></label>
	<input type="number" rv-value=":label_title_font_size">
</p>
<p>
	<label><?php _e('Label tagline font size', 'uber-grid')?></label>
	<input type="number" rv-value=":label_tagline_font_size">
</p>
<p>
	<label><?php _e('Label price tag font size', 'uber-grid')?></label>
	<input type="number" rv-value=":label_price_font_size">
</p>
<p>
	<label><?php _e('Max label height', 'uber-grid') ?></label>
	<input type="number" rv-value=":label_max_height" step="1">px
</p>
