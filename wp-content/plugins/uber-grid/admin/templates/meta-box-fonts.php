<input name="fonts-loaded" value="" type="hidden" id="fonts-loaded">
<div class="spin-wrapper"><span class="spinner"></span><br class="clear"></div>
<div id="fonts">
	<p>You can preview fonts at <a href="http://www.google.com/fonts">Google Fonts directory</a></p>
	<p>
		<label><?php _e('Title font', 'uber-grid')?></label>
		<select role="font" rv-font-family=":title:family"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<select role="style" rv-value=":title:style"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<input type="number" rv-value=":title:size">px
		<label><?php _e('Tagline font', 'uber-grid')?></label>
		<select role="font" rv-font-family=":tagline:family"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<select role="style" rv-value=":tagline:style"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<input type="number" rv-value=":tagline:size">px
	</p>
	<p>
		<label><?php _e('Hover title font', 'uber-grid')?></label>
		<select role="font" rv-font-family=":hover_title:family"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<select role="style" rv-value=":hover_title:style"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<input type="number" rv-value=":hover_title:size">px

		<label><?php _e('Hover text font', 'uber-grid')?></label>
		<select role="font" rv-font-family=":hover_text:family"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<select role="style" rv-value=":hover_text:style"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<input type="number" rv-value=":hover_text:size">px
	</p>
	<p>
		<label><?php _e('Label title font', 'uber-grid')?></label>
		<select role="font" rv-font-family=":label_title:family"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<select role="style" rv-value=":label_title:style"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<input  type="number" rv-value=":label_title:size">px
		<label><?php _e('Label tagline font', 'uber-grid')?></label>
		<select role="font" rv-font-family=":label_tagline:family"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<select role="style" rv-value=":label_tagline:style"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<input type="number" rv-value=":label_tagline:size">px

		<label><?php _e('Label price font', 'uber-grid')?></label>
		<select role="font" rv-font-family=":label_price:family"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<select role="style" rv-value=":label_price:style"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<input type="number" rv-value=":label_price:size">px
	</p>
	<div class="section">
		<label><?php _e('Filters font', 'uber-grid')?></label>
		<select role="font" rv-font-family=":filters:family"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<select role="style" rv-value=":filters:style"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<input type="number" rv-value=":filters:size">px
	</div>
	<div class="section">
		<label><?php _e('Pagination font', 'uber-grid')?></label>
		<select role="font" rv-font-family=":pagination:family"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<select role="style" rv-value=":pagination:style"><option value=""><?php _e('Default', 'uber-grid')?></option></select>
		<input type="number" rv-value=":pagination:size">px
	</div>
</div>
