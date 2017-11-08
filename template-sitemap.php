<?php 
/*
Template Name: Sitemap Page
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
		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
		<?php $get_meta = get_post_custom($post->ID);  ?>
		<?php //Above Post Banner
		if( empty( $get_meta["tie_hide_above"][0] ) ){
			if( !empty( $get_meta["tie_banner_above"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["tie_banner_above"][0]) .'</div>';
			else tie_banner('banner_above' , '<div class="ads-post">' , '</div>' );
		}
		?>
		
		<article class="post-listing post">
			<?php get_template_part( 'includes/post-head' ); ?>
			<div class="post-inner">
				<h1 class="post-title"><?php the_title(); ?></h1>
				<p class="post-meta"></p>
				<div class="clear"></div>
				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tie' ), 'after' => '</div>' ) ); ?>
					
					<div id="sitemap">
						<div class="sitemap-col">
							<h2><?php _e('Pages','tie'); ?></h2>
							<ul id="sitemap-pages"><?php wp_list_pages('title_li='); ?></ul>
						</div> <!-- end .sitemap-col -->
							
						<div class="sitemap-col">
							<h2><?php _e('Categories','tie'); ?></h2>
							<ul id="sitemap-categories"><?php wp_list_categories('title_li='); ?></ul>
						</div> <!-- end .sitemap-col -->
							
						<div class="sitemap-col">
							<h2><?php _e('Tags','tie'); ?></h2>
							<ul id="sitemap-tags">
								<?php $tags = get_tags();
								if ($tags) {
									foreach ($tags as $tag) {
										echo '<li><a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></li> ';
									}
								} ?>
							</ul>
						</div> <!-- end .sitemap-col -->
														
						<div class="sitemap-col<?php echo ' last'; ?>">
							<h2><?php _e('Authors','tie'); ?></h2>
							<ul id="sitemap-authors" ><?php wp_list_authors('optioncount=1&exclude_admin=0'); ?></ul>
						</div> <!-- end .sitemap-col -->
					
					</div> <!-- end #sitemap -->
						
					<?php edit_post_link( __( 'Edit', 'tie' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry /-->	
			
			</div><!-- .post-inner -->
		</article><!-- .post-listing -->
		<?php endwhile; ?>
		
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