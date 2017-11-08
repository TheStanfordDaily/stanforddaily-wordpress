<?php 
/*
Template Name: Blog List
*/
?>
<?php get_header(); ?>
	<div class="content">
		<?php tie_breadcrumbs() ?>
				
		<?php if ( ! have_posts() ) : ?>
			<div id="post-0" class="post not-found post-listing">
				<h1 class="post-title"><?php _e( 'Not Found', 'tie' ); ?></h1>
				<div class="entry">
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'tie' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php endif; ?>
		
		<div class="page-head">
			<h1 class="page-title">
				<?php the_title(); ?>
			</h1>
		</div>
		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php $get_meta = get_post_custom($post->ID);  ?>
		<?php get_template_part( 'includes/post-head' ); ?>
		<div class="entry"><?php the_content(); ?></div>
		<?php endwhile; ?>
		
		<?php //Above Post Banner
		if( empty( $get_meta["tie_hide_above"][0] ) ){
			if( !empty( $get_meta["tie_banner_above"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["tie_banner_above"][0]) .'</div>';
			else tie_banner('banner_above' , '<div class="ads-post">' , '</div>' );
		}
		?>
		
		<?php
			$tie_blog_cats = unserialize($get_meta["tie_blog_cats"][0]);
			if( empty( $tie_blog_cats ) ) $tie_blog_cats = get_all_category_ids();
			query_posts( array( 'paged' => $paged , 'category__in' => $tie_blog_cats ));
			get_template_part( 'loop', 'category' );
			if ($wp_query->max_num_pages > 1) tie_pagenavi(); ?>
		
		<?php //Below Post Banner
		if( empty( $get_meta["tie_hide_below"][0] ) ){
			if( !empty( $get_meta["tie_banner_below"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["tie_banner_below"][0]) .'</div>';
			else tie_banner('banner_below' , '<div class="ads-post">' , '</div>' );
		}
		?>
		
		<?php comments_template( '', true ); ?>
	</div><!-- .content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>