<?php get_header(); ?>
	<div class="content">
		<?php tie_breadcrumbs();
 ?>

		<div class="page-head">
			<h2 class="page-title">
				<?php if ( have_posts() ) : ?>
				<?php printf( __( 'Search Results for: %s', 'tie' ), '<span>' . get_search_query() . '</span>' ); ?>
				<?php else : ?>
				<?php _e( 'Nothing Found', 'tie' ); ?>
				<?php endif; ?>
			</h2>
			<div class="stripe-line"></div>
		</div>
		
		<?php if ( have_posts() ) : ?>
			<?php get_template_part( 'loop', 'search' );	?>
			<?php if ($wp_query->max_num_pages > 1) tie_pagenavi(); ?>
		<?php else : ?>
			<div id="post-0" class="post not-found post-listing">
				<div class="entry">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'tie' ); ?></p>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>
