<div class="jeg_nav_item jeg_cart woocommerce jeg_cart_icon">
    <i class="fa fa-shopping-cart jeg_carticon"></i>
    
    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
    	<div class="jeg_cartcontent">
	        <div class="widget_shopping_cart_content">
	        	<?php woocommerce_mini_cart(); ?>
		    </div>
		</div>
	<?php else : ?>
		<div class="jeg_cartcontent_fallback">
			<div class="alert alert-error">
				<strong><?php esc_html_e('Plugin Install','jnews'); ?></strong> : <?php esc_html_e('Cart Icon need WooCommerce plugin to be installed.', 'jnews'); ?>
            </div>
		</div>
	<?php endif ?>

</div>