<div class="jeg_nav_item jeg_mobile_logo">
	<?php if ( is_front_page() ) : ?>
	    <h1 class="site-title">
	    	<a href="<?php echo esc_url(home_url('/')); ?>">
		        <?php jnews_generate_mobile_logo(); ?>
		    </a>
	    </h1>
	<?php else : ?>
		<div class="site-title">
	    	<a href="<?php echo esc_url(home_url('/')); ?>">
		        <?php jnews_generate_mobile_logo(); ?>
		    </a>
	    </div>
	<?php endif; ?>
</div>