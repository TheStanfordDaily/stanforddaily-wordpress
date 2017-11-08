<?php 
/*
Template Name: Best Reviews
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

		<?php $get_meta = get_post_custom($post->ID);  ?>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php //Above Post Banner
		if( empty( $get_meta["tie_hide_above"][0] ) ){
			if( !empty( $get_meta["tie_banner_above"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["tie_banner_above"][0]) .'</div>';
			else tie_banner('banner_above' , '<div class="ads-post">' , '</div>' );
		}
		?>
		
		<article <?php if( !empty( $rv['review'] ) ) echo $rv['review']; post_class('post-listing post'); ?>>
			<?php get_template_part( 'includes/post-head' ); ?>
			<div class="post-inner">
				<h1 class="name post-title entry-title" itemprop="name"><?php the_title(); ?></h1>
				<p class="post-meta"></p>
				<div class="clear"></div>
				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tie' ), 'after' => '</div>' ) ); ?>

					<ul class="best-reviews">
					<?php
						$tie_blog_cats = unserialize($get_meta["tie_blog_cats"][0]);
						if( empty( $tie_blog_cats ) ) $tie_blog_cats = get_all_category_ids();
						$num_posts = $get_meta["tie_posts_num"][0];
						$counter = 0;
						$cat_query = new WP_Query(array('category__in' => $tie_blog_cats , 'posts_per_page' => $num_posts, 'orderby' => 'meta_value_num' ,  'meta_key' => 'tie_review_score', 'post_status' => 'publish', 'no_found_rows' => 1 ));
						while ( $cat_query->have_posts() ) : $cat_query->the_post(); $counter++ ;?>
					<li>
						<span class="best-review-score" ><?php echo $counter ?></span>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
						<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
								<?php the_post_thumbnail('thumbnail');  ?>
							</a>
						</div><!-- post-thumbnail /-->
						<?php endif; ?>
						<div class="best-reviews-content">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php tie_get_score('large'); ?>
							<p class="post-meta">
								<span><?php _e( 'Posted by: ' , 'tie' ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'tie' ), get_the_author() ) ?>"><?php echo get_the_author() ?> </a></span>
								<?php if( tie_get_option( 'post_date' ) && tie_get_option( 'time_format' ) != 'none' ): ?>		
									<?php __( 'on ' , 'tie' ); ?><?php tie_get_time() ?>
								<?php endif; ?>	
								<span><?php _e( 'in ' , 'tie' ); ?><?php printf('%1$s', get_the_category_list( ', ' ) ); ?></span>
							</p>
						</div>
					</li>
					<?php endwhile;
						$post = $orig_post;
					?>
					</ul>
					<?php edit_post_link( __( 'Edit', 'tie' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry /-->	
				<span style="display:none" class="updated"><?php the_time( 'Y-m-d' ); ?></span>
				<div style="display:none" class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person"><strong class="fn" itemprop="name"><?php the_author_posts_link(); ?></strong></div>

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