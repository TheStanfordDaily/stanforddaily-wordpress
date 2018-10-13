<?php if ($have_social): ?>
<div class="uber-grid-social">
	<?php foreach(array('facebook', 'twitter', 'instagram', 'linkedin', 'pinterest', 'email', 'skype', 'dribbble', 'flickr', 'website', 'googleplus') as $service): ?>
		<?php if (trim($lightbox[$service])): ?>
			<a href="<?php echo esc_url($lightbox[$service]) ?>" class="uber-grid-<?php echo $service ?>" target="_blank"></a>
		<?php endif?>
	<?php endforeach ?>
</div>
<?php endif ?>
