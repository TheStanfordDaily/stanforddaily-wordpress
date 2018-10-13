<?php $link = $cell['link'] ?>
<?php $hover = $cell['hover'] ?>
<?php $label = $cell['label'] ?>
<?php $lightbox = $link['lightbox'] ?>
<?php $link_and_not_hover = $link['enable'] && !$hover['enable'] ?>
<?php $hover_enable = $hover['enable'] ?>
<?php if ($link_and_not_hover): ?>
	<div <?php $cell->link_attributes($this, $options) ?>>
<?php else: ?>
	<div class="uber-grid-cell-wrapper">
<?php endif?>
<?php if ($link['enable']): ?>
	<a href="<?php echo esc_attr($cell->get_link_url()) ?>"
		target="<?php echo $link['target'] ?>"
		class="uber-grid-cell-link"></a>
<?php endif ?>
<div class="uber-grid-cell-content"
	<?php if ($link['mode'] == 'lightbox'): ?>data-lightbox-thumbnail="<?php echo esc_attr($cell->get_lightbox_image_src()) ?>"
	data-lightbox-download-url="<?php echo esc_attr($lightbox['download_url']) ?>"
	data-lightbox-mode="<?php echo esc_attr($lightbox['mode']) ?>"
	<?php if ($lightbox['mode'] == 'ubergrid'): ?>data-lightbox-grid-id="<?php echo esc_attr($lightbox['grid_id']) ?>"<?php endif ?> <?php endif ?>
	<?php if ($lightbox['mode'] == 'iframe'): ?>data-iframe="true"<?php endif ?>>
	<?php if ($cell['image']): ?>
		<img src="<?php echo esc_attr($cell->get_image_src($this)) ?>" alt="<?php echo esc_attr(strip_tags($cell->get_image_alt())) ?>" data-lightbox-width="<?php echo $cell->get_lightbox_image_width() ?>"  data-lightbox-height="<?php echo $cell->get_lightbox_image_height() ?>" class="uber-grid-cell-image">
	<?php endif ?>
	<?php if ((trim($cell['title']) || trim($cell['tagline'])) && $cell['title_position']): ?>
		<div class="uber-grid-cell-title-wrapper uber-grid-title-position-<?php echo $cell['title_position'] ?>">
			<div class="uber-grid-cell-title">
				<?php if (trim($cell['title'])) :?>
					<strong><?php echo do_shortcode($cell['title']) ?></strong>
				<?php endif?>
				<?php if (trim($cell['tagline'])): ?>
					<small><?php echo do_shortcode($cell['tagline']) ?></small>
				<?php endif?>
			</div>
		</div>
	<?php endif ?>
</div>
<?php if ($hover['enable'] ): ?>
	<?php if ($link['enable']): ?>
		<div <?php $cell->hover_attributes($this, $options) ?>>
	<?php else: ?>
		<div <?php $cell->non_link_hover_attributes($this, $options) ?>>
	<?php endif ?>
		<div class="uber-grid-hover-inner">
			<?php if ($hover['title']): ?>
				<div class="uber-grid-hover-title"><strong><?php echo do_shortcode($hover['title'])?></strong></div>
			<?php endif ?>
			<div class="uber-grid-hover-text"><?php echo nl2br(do_shortcode($hover['text'])) ?></div>
		</div>
	<?php if ($link['enable']): ?>
		</div>
	<?php else: ?>
		</div>
	<?php endif ?>
<?php endif ?>
<?php if ($link_and_not_hover): ?>
	</div>
<?php else: ?>
	</div>
<?php endif?>

<?php if ($label['enable']): ?>
	<div class="uber-grid-cell-label">
		<?php if ($label['price']): ?><div class="uber-grid-price-tag"><?php echo do_shortcode($label['price']) ?></div><?php endif ?>
		<?php if (trim($label['title'])): ?><div class="uber-grid-label-heading"><?php echo do_shortcode($label['title']) ?></div><?php endif?>
		<?php if (trim($label['tagline'])): ?><div class="uber-grid-label-text"><?php echo do_shortcode($label['tagline'])?></div><?php endif ?>
	</div>
<?php endif ?>
<?php $have_social = false ?>
<?php foreach(array('facebook', 'twitter', 'linkedin', 'pinterest', 'email', 'skype', 'dribbble', 'flickr', 'website', 'googleplus') as $service): ?>
	<?php if (!empty($lightbox[$service])): ?>
		<?php $have_social = true ?>
	<?php endif ?>
<?php endforeach ?>
<?php if (true): ?>
	<div class="uber-grid-lightbox-content-wrapper" data-style="<?php echo esc_attr($lightbox['description_style']) ?>">
		<?php if (!empty($lightbox['title'])): ?>
			<h2><?php echo do_shortcode($lightbox['title'])?></h2>
		<?php endif ?>
		<?php if (!empty($lightbox['text'])): ?>
			<?php echo do_shortcode($lightbox['text']) ?>
		<?php endif ?>
	</div>
<?php else: ?>
	<?php if ($link['enable'] && $link['mode'] == 'lightbox' &&  ($lightbox['title'] || $lightbox['text'] || $have_social)): ?>
		<div class="uber-grid-lightbox-content-wrapper">
			<?php if (trim($lightbox['title']) || trim($lightbox['text'])): ?>
				<div class="uber-grid-lightbox-content uber-grid-<?php echo $this->id ?>-lightbox-content <?php echo $have_social && trim($lightbox['title']) && !$lightbox['text'] ? 'uber-grid-nopadding-bottom' : '' ?>">
				<?php if ($lightbox['title'] || $lightbox['text']): ?>
						<?php if ($lightbox['title']): ?>
						<h3 class="uber-grid-lightbox-title"><?php echo do_shortcode($lightbox['title']) ?></h3>
						<?php endif ?>
						<?php if ($lightbox['text']): ?><div class="uber-grid-lightbox-description"><?php echo do_shortcode(nl2br($lightbox['text'])) ?></div><?php endif ?>
				<?php endif ?>
				</div>
			<?php endif ?>
			<?php require('social.php') ?>
		</div>
	<?php endif ?>
<?php endif ?>
