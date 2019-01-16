<?php
	$spacing = get_theme_mod('jnews_header_logo_spacing', array (
	    'top' => '0',
	    'bottom' => '0',
	    'left' => '0',
	    'right' => '0',
	));
	$spacing = "{$spacing['top']} {$spacing['right']} {$spacing['bottom']} {$spacing['left']}";
?>
<div class="jeg_nav_item jeg_logo jeg_desktop_logo">
	<?php if ( is_front_page() ) : ?>
	    <h1 class="site-title">
	    	<a href="<?php echo esc_url(home_url('/')); ?>" style="padding: <?php echo esc_attr($spacing); ?>;">
	    	    <?php jnews_generate_header_logo(); ?>
	    	</a>
	    </h1>
	<?php else : ?>
		<div class="site-title">
	    	<a href="<?php echo esc_url(home_url('/')); ?>" style="padding: <?php echo esc_attr($spacing); ?>;">
	    	    <?php jnews_generate_header_logo(); ?>
	    	</a>
	    </div>
	<?php endif; ?>
</div>