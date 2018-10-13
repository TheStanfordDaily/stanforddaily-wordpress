<script type="text/template" id="ug-cell-custom-cell">
	<label><?php _e('Tags', 'uber-grid')?></label>
	<input type="text" rv-value="model:tags" placeholder="<?php _e('comma-separated tags')?>">
	<small><?php _e('Enter tags if you want to enable filtering', 'uber-grid') ?></small>
</script>


<script type="text/template" id="ug-cell-filtering-section-template">
	<label class="huge"><?php _e('Categories', 'uber-grid') ?></label>
	<div class="ug-column-1">
		<div class="ug-field">
			<label><?php _e('Categories for this cell', 'uber-grid') ?></label>
			<input type="text" rv-value="model:filtering_tags">
			<small><?php _e('Categories will be enabled automatically when you\'ll enter some', 'uber-grid') ?></small>
		</div>
	</div>
	<br class="clear">
</script>


<script type="text/template" id="ug-cell-main-section-template">
<?php
function render_select_options($options){
	foreach($options as $value => $text){
		echo "<option ";
		echo  "value=\"" . esc_attr($value) . "\" ";
		echo ">" . $text . "</option>";
	}
}
$position_options = array("center" =>__('Center', 'uber-grid'),
				"top-center" =>   __('Top center', 'uber-grid'),
				"top-left" =>  __('Top left', 'uber-grid'),
				"top-right" =>  __('Top right', 'uber-grid'),
				"bottom-center" =>  __('Bottom center', 'uber-grid'),
				"bottom-left" => __('Bottom left', 'uber-grid'),
				"bottom-right" => __('Bottom right', 'uber-grid'),
				"top-left-bottom-left" => __('Top left - bottom left', 'uber-grid'),
				"top-left-bottom-right" =>  __('Top left - bottom right', 'uber-grid'),
				"top-right-bottom-right" => __('Top right - bottom right', 'uber-grid'),
				"top-left-bottom-left" => __('Top left - bottom left', 'uber-grid')) ?>

		<label class="huge"><?php _e('Title & image', 'uber-grid')?></label>
		<div class="ug-columns-2">
			<div class="ug-column">
				<div class="ug-field">
					<label><?php _e('Title', 'uber-grid')?></label>
					<input type="text" rv-value="model:title" placeholder="<?php _e('Title', 'uber-grid') ?>" class="cell-title-editor">
					<input type="text" rv-color="model:title_color" class="color-picker">
				</div>
				<div class="ug-field">
					<input type="text" rv-value="model:tagline" placeholder="<?php _e('Tagline', 'uber-grid') ?>" class="full-width">
					<input type="text" rv-color="model:tagline_color" class="color-picker">
				</div>
				<div class="ug-field">
					<label><?php _e('Background color', 'uber-grid')?></label>
					<input type="text" rv-color="model:title_background_color" class="color-picker">
				</div>
				<div class="ug-field">
					<label><?php _e('Background fill opacity', 'uber-grid') ?></label>
					<input type="text" rv-value="model:title_background_gradient_opacity" placeholder="0.8">
				</div>

				<div class="ug-field">
					<label><?php _e('Title / Tagline position', 'uber-grid')?></label>
					<select rv-value="model:title_position">
						<?php render_select_options(array_merge(array('' => __('Do not show', 'uber-grid')), $position_options))?>
					</select>
				</div>

			</div>
			<div class="ug-column">
				<label><?php _e('Main image', 'uber-grid')?> <small><?php _e('(Does not reflect actual cropping)', 'uber-grid') ?></small></label>
				<div class="image-selector no-image ug-main-image-selector">
					<input type="hidden">
					<img>
					<div class="overlay"></div>
					<div class="actions-wrapper">
						<button class="select-image button "><?php _e('Select image', 'uber-grid')?></button>
						<br>
						<a href="#" class="image-delete"><?php _e('Remove image', 'uber-grid')?></a>
					</div>
				</div>
			</div>
			<div class="ug-column">
				<label><?php _e('Background image', 'uber-grid')?></label>
				<div class="image-selector no-image ug-background-image-selector">
					<input rv-value="model:title_background_image" type="hidden">
					<img>
					<div class="actions-wrapper">
						<button class="select-image button "><?php _e('Select image', 'uber-grid')?></button>
						<br>
						<a href="#" class="image-delete"><?php _e('Remove image', 'uber-grid')?></a>
					</div>
				</div>
				<div class="ug-field">
					<label><?php _e('Background image mode', 'uber-grid')?></label>
					<select rv-value="model:title_background_image_position">
						<option value="fill"><?php _e('Fill', 'uber-grid')?></option>
						<option value="repeat"><?php _e('Repeat', 'uber-grid')?></option>
					</select>
				</div>
			</div>
		</div>
		<br class="clear">
	</div>
</script>

<script type="text/template" id="ug-cell-section-layout-template">
	<label class="huge"><?php _e('Size & layout',  'uber-grid')?></label>
	<input type="hidden" rv-value="model:layout">
	<ul class="ug-layouts ug-column-1">
		<li class="r1c1-io"><div class="img"></div><?php _e('1x', 'uber-grid') ?></li>
		<li class="r1c2-io"><div class="img"></div><?php _e('2x wide', 'uber-grid') ?></li>
		<li class="r1c2-il"><div class="img"></div><?php _e('2x wide, image at the left', 'uber-grid') ?></li>
		<li class="r1c2-ir"><div class="img"></div><?php _e('2x wide, image at the right', 'uber-grid') ?></li>
		<li class="r2c1-io"><div class="img"></div><?php _e('2x height', 'uber-grid') ?></li>
		<li class="r2c1-it"><div class="img"></div><?php _e('2x height, image at the top', 'uber-grid') ?></li>
		<li class="r2c1-ib"><div class="img"></div><?php _e('2x height, image at the bottom', 'uber-grid') ?></li>
		<li class="r2c2-io"><div class="img"></div><?php _e('2x width and height', 'uber-grid') ?></li>
		<li class="r2c2-il"><div class="img"></div><?php _e('2x width and height, image at the left', 'uber-grid') ?></li>
		<li class="r2c2-ir"><div class="img"></div><?php _e('2x width and height, image at the right', 'uber-grid') ?></li>
		<li class="r2c2-it"><div class="img"></div><?php _e('2x width and height, image at the top', 'uber-grid') ?></li>
		<li class="r2c2-ib"><div class="img"></div><?php _e('2x width and height, image at the bottom', 'uber-grid') ?></li>
	</ul>
	<br class="clear">
</script>

<script type="text/template" id="ug-cell-linking-url">
	<div class="ug-field">
		<label class="ug-link-to-url"><?php _e('Link this cell to URL', 'uber-grid')?></label>
		<input type="text" class="full-width" rv-value=":url">
	</div>
	<div class="field ug-link-to-url">
		<label><?php _e('Open link in ', 'uber-grid')?></label>
		<select class="full-width" rv-value=":target">
			<option value=""><?php _e('Same window', 'uber-grid') ?></option>
			<option value="_blank"><?php _e('New tab (target=_blank)', 'uber-grid') ?></option>
			<option value="_parent"><?php _e('Parent frame (target=_parent)', 'uber-grid')?></option>
		</select>
	</div>
</div>
</script>

<script type="text/template" id="ug-cell-linking-lightbox-template">
	<div class="ug-link-to-lightbox">
		<?php if (true): ?>
			<label><?php _e('Lightbox mode', 'uber-grid') ?></label>
			<select rv-value=":lightbox:mode">
				<option value="image"><?php _e('Image', 'uber-grid')?></option>
				<option value="video"><?php _e('Video', 'uber-grid')?></option>
				<option value="audio"><?php _e('Audio', 'uber-grid')?></option>
				<option value="html"><?php _e('HTML', 'uber-grid')?></option>
				<option value="ubergrid"><?php _e('Ubergrid', 'uber-grid') ?></option>
				<option value="iframe"><?php _e('Iframe', 'uber-grid') ?></option>
			</select>
			<div class="image-selector no-image" rv-show=":lightbox.isImage < :mode">
				<input type="hidden" rv-value=":lightbox:image">
				<img>
				<div class="actions-wrapper">
					<button class="select-image button "><?php _e('Select image', 'uber-grid')?></button>
					<br>
					<a href="#" class="image-delete"><?php _e('Remove image', 'uber-grid')?></a>
				</div>
			</div>
			<div rv-hide=":lightbox.isImageOrGrid < :mode">
				<label rv-hide=":lightbox.isIframe < :mode"><?php _e('Media URL', 'uber-grid')?></label>
				<label rv-show=":lightbox.isIframe < :mode"><?php _e('Iframe URL', 'uber-grid')?></label>
				<input type="text" rv-value=":url">
				<label><?php _e('Lightbox thumbnail image', 'uber-grid')?></label>
				<div class="image-selector no-image">
					<input type="hidden" rv-value=":lightbox:image">
					<img>
					<div class="actions-wrapper">
						<button class="select-image button "><?php _e('Select image', 'uber-grid')?></button>
						<br>
						<a href="#" class="image-delete"><?php _e('Remove image', 'uber-grid')?></a>
					</div>
				</div>
			</div>
			<div rv-show=":lightbox.isGrid < :mode" class="field">
				<label><?php _e('Show grid', 'uber-box') ?></label>
				<select rv-value=":lightbox:grid_id">
					<?php $query = new WP_Query('post_type=uber-grid&posts_per_page=-1&orderby=post_name') ?>
					<?php global $post ?>
					<?php $oldpost = $post ?>
					<?php while($query->have_posts()): $query->the_post() ?>
						<option value="<?php the_ID() ?>">
							<?php if (get_the_title()) : ?>
								<?php the_title() ?>
							<?php else: ?>
								<?php the_ID() ?>
							<?php endif ?>
						</option>
					<?php endwhile ?>
					<?php $post = $oldpost ?>
				</select>
			</div>
			<select rv-value=":lightbox:description_style" rv-hide=":lightbox.isIframe < :mode">
				<option value="mini"><?php _e('Mini description at bottom', 'uber-grid')?></option>
				<option value="bottom"><?php _e('Scrollable description at bottom', 'uber-grid')?></option>
				<option value="right"><?php _e('Description at right', 'uber-grid')?></option>
				<option value="none"><?php _e('No description', 'uber-grid')?></option>
			</select>
			<div class="field ug-link-to-lightbox" rv-hide=":lightbox.isIframe < :mode">
				<label><?php _e('Lightbox Title', 'uber-grid')?></label>
				<input type="text" class="full-width" rv-value=":lightbox:title">
			</div>
			<div class="field ug-link-to-lightbox" rv-hide=":lightbox.isIframe < :mode">
				<label><?php _e('Lightbox Text', 'uber-grid')?></label>
				<textarea class="full-width" rv-value=":lightbox:text" rows="7"></textarea>
			</div>
			<div class="field">
				<label><?php _e('Lightbox download link', 'uber-grid')?></label>
				<input type="text" class="full-width" rv-value=":lightbox:download_url">
			</div>
		<?php else:  ?>
			<label><?php _e('Lightbox image', 'uber-grid')?></label>
			<div class="image-selector no-image">
				<input type="hidden" rv-value=":lightbox:image">
				<img>
				<div class="actions-wrapper">
					<button class="select-image button "><?php _e('Select image', 'uber-grid')?></button>
					<br>
					<a href="#" class="image-delete"><?php _e('Remove image', 'uber-grid')?></a>
				</div>
			</div>
			<div class="field ug-link-to-lightbox">
				<label><?php _e('Lightbox Title', 'uber-grid')?></label>
				<input type="text" class="full-width" rv-value=":lightbox:title">
			</div>
			<div class="field ug-link-to-lightbox">
				<label><?php _e('Lightbox Text', 'uber-grid')?></label>
				<textarea class="full-width" rv-value=":lightbox:text" rows="7"></textarea>
			</div>
		<?php endif ?>
	</div>
</script>

<script type="text/template" id="ug-cell-section-link-mode-template">
	<label class="huge"><input type="checkbox" rv-checked=":enable" value="1"><?php _e('Linking and lightbox', 'uber-grid')?></label>
	<div class="ug-columns-2">
		<div class="ug-column">
			<div class="ug-field">
				<label><?php _e('Link mode')?></label>
				<select rv-value=":mode" class="select-link-mode">
					<option value="url"><?php _e('URL', 'uber-grid')?></option>
					<option value="lightbox"><?php _e('Lightbox', 'uber-grid')?></option>
				</select>
			</div>
			<div class="ug-linking-details"></div>
		</div>
		<div class="ug-column">
			<?php if (false): ?>
				<?php foreach(array('facebook', 'twitter', 'instagram', 'linkedin', 'pinterest', 'email', 'skype', 'dribbble', 'flickr', 'website', 'googleplus') as $service): ?>
					<div class="field ug-link-to-lightbox">
						<label><?php _e(ucfirst($service . " url"), 'uber-grid')?></label>
						<input type="text" class="full-width" rv-value=":lightbox:<?php echo $service ?>">
					</div>
				<?php endforeach ?>
				</div>
			<?php endif ?>
		</div>
	</div>
	<br class="clear">
</script>

<script type="text/template" id="ug-cell-section-hover-template">
	<label class="huge"><input type="checkbox" rv-checked="model:hover:enable" value="1"><?php _e('On-hover', 'uber-grid')?></label>
	<div class="ug-columns-2">
		<div class="ug-column">
			<div class="ug-field">
				<label><?php _e('Text position')?></label>
				<select rv-value="model:hover:position">
					<?php render_select_options($position_options) ?>
				</select>
			</div>
			<p>
				<label><?php _e('Title', 'uber-grid')?></label>
				<input type="text" class="full-width" rv-value="model:hover:title">
			</p>
			<p>
				<label><?php _e('Text', 'uber-grid')?></label>
				<textarea class="full-width" rv-value="model:hover:text"></textarea>
			</p>
			<p>
				<label><?php _e('Text color', 'uber-grid')?></label>
				<input type="text" class="color-picker" rv-color="model:hover:text_color">
			</p>
		</div>
		<div class="ug-column">
			<label><?php _e('Background image', 'uber-grid')?></label>
			<div class="image-selector no-image">
				<input type="hidden" rv-value="model:hover:background_image">
				<img>
				<div class="overlay"></div>
				<div class="actions-wrapper">
					<button class="select-image button "><?php _e('Select image', 'uber-grid')?></button>
					<br>
					<a href="#" class="image-delete"><?php _e('Remove image', 'uber-grid')?></a>
				</div>
			</div>
			<div class="ug-field">
				<label><?php _e('Background image mode', 'uber-grid')?></label>
				<select rv-value="model:hover:background_image_position">
					<option value="repeat"><?php _e('Repeat', 'uber-grid')?></option>
					<option value="fill"><?php _e('Fill', 'uber-grid')?></option>
				</select>
			</div>
			<div class="ug-field">
				<label><?php _e('Background color', 'uber-grid')?></label>
				<input type="text" class="color-picker" rv-color="model:hover:background_color">
			</div>
			<div class="ug-field">
				<label><?php _e('Opacity', 'uber-grid') ?></label>
				<input type="text" rv-value="model:hover:background_opacity" placeholder="0.85">
			</div>
		</div>
		<br class="clear">
	</div>
	<br class="clear">
</script>

<script type="text/template" id="ug-cell-section-label-template">
	<label class="huge"><input type="checkbox" rv-checked="model:label:enable" value="1"><?php _e('Label below', 'uber-grid')?></label>
	<div class="ug-columns-2">
		<div class="ug-column">
			<div class="ug-field">
				<label><?php _e('Title', 'uber-grid')?></label>
				<input type="text" class="full-width larger" rv-value="model:label:title">
				<br>
				<input type="text" rv-color="model:label:title_color" class="color-picker">
			</div>
			<div class="ug-field">
				<label><?php _e('Small text', 'uber-grid')?></label>
				<textarea rv-value="model:label:tagline" class="full-width" rows="3"></textarea>
				<br>
				<input type="text" rv-color="model:label:tagline_color" class="color-picker">
			</div>
			<div class="ug-field">
				<label><?php _e('Price tag', 'uber-grid')?></label>
				<input type="text" rv-value="model:label:price">
				<label><?php _e('Price color', 'uber-grid')?></label>
				<input type="text" rv-color="model:label:price_color" class="color-picker">
				<label><?php _e('Price background color', 'uber-grid')?></label>
				<input type="text" rv-color="model:label:price_background_color" class="color-picker">
			</div>
			<div class="ug-field">
				<label><?php _e('Border top', 'uber-grid') ?></label>
				<input type="number" step="1" rv-value="model:label:border_top">px
				<br>
				<input type="text" rv-color="model:label:border_top_color" class="color-picker">
			</div>
			<div class="ug-field">
				<label><?php _e('Border bottom', 'uber-grid') ?></label>
				<input type="number" step="1" rv-value="model:label:border_bottom">px
				<br>
				<input type="text" rv-color="model:label:border_bottom_color" class="color-picker">
			</div>
		</div>
		<div class="ug-column">
			<div class="ug-field">
				<label><?php _e('Background color', 'uber-grid')?></label>
				<input type="text" rv-color="model:label:background_color" class="color-picker">
			</div>
		</div>
	</div>
	<br class="clear">
</script>
