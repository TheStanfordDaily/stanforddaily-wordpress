<?php get_header(); ?>
	<div class="content">
		<?php tie_breadcrumbs() ?>
		
		<div class="page-head">
			<?php if ( have_posts() ) the_post(); ?>
			<h2 class="page-title">
				<?php if ( is_day() ) : ?>
					<?php printf( __( 'Daily Archives: <span>%s</span>', 'tie' ), get_the_date() ); ?>
				<?php elseif ( is_month() ) : ?>
					<?php printf( __( 'Monthly Archives: <span>%s</span>', 'tie' ), get_the_date( 'F Y' ) ); ?>
				<?php elseif ( is_year() ) : ?>
					<?php printf( __( 'Yearly Archives: <span>%s</span>', 'tie' ), get_the_date( 'Y' ) ); ?>
				<?php else : ?>
					<?php _e( 'Blog Archives', 'tie' ); ?>
				<?php endif; ?>
			</h2>
			<div class="stripe-line"></div>
		</div>

				
		<?php
		rewind_posts();
		get_template_part( 'loop', 'archive' );	?>
		<?php if ($wp_query->max_num_pages > 1) tie_pagenavi(); ?>
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>