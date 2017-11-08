<?php get_header(); ?>
	<div class="content">
		<?php tie_breadcrumbs() ?>

		<div class="page-head">
			<h1 class="page-title">
				<?php printf( __( 'Tag Archives: %s', 'tie' ), '<span>' . single_tag_title( '', false ) . '</span>' );	?>
			</h1>
			<?php if( tie_get_option( 'tag_rss' ) ):
				$tag_id = get_query_var('tag_id'); ?>
			<a class="rss-cat-icon tooltip" title="<?php _e( 'Feed Subscription', 'tie' ); ?>"  href="<?php echo  get_term_feed_link($tag_id , 'post_tag', "rss2") ?>"></a>
			<?php endif; ?>
			<div class="stripe-line"></div>
		</div>
		
		<?php get_template_part( 'loop', 'tag' );	?>
		<?php if ($wp_query->max_num_pages > 1) tie_pagenavi(); ?>
		
	</div> <!-- .content -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>