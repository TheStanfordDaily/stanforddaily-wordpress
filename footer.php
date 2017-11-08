<div class="clear"></div>
</div><!-- .container /-->
<?php tie_banner('banner_bottom' , '<div class="bottom-area">' , '</div>' ); ?>
<?php get_sidebar( 'footer' ); ?>				
<div class="clear"></div>
<div class="footer-bottom">
	<div class="container">
		<div class="alignright">
			<?php
				$footer_vars = array('%year%' , '%site%' , '%url%');
				$footer_val  = array( date('Y') , get_bloginfo('name') , home_url() );
				$footer_two  = str_replace( $footer_vars , $footer_val , tie_get_option( 'footer_two' ));
				echo htmlspecialchars_decode( $footer_two );?>
		</div>
		<?php if( tie_get_option('footer_social') ) tie_get_social('yes',16); ?>
		
		<div class="alignleft">
			<?php
				$footer_one  = str_replace( $footer_vars , $footer_val , tie_get_option( 'footer_one' ));
				echo htmlspecialchars_decode( $footer_one );?>
		</div>
		<div class="clear"></div>
	</div><!-- .Container -->
</div><!-- .Footer bottom -->
<?php if( tie_get_option('footer_top') ): ?>
	<div id="topcontrol" class="tieicon-up-open" title="<?php _e('Scroll To Top' , 'tie'); ?>"></div>
<?php endif; ?>
<?php wp_footer();?>
</body>
</html>