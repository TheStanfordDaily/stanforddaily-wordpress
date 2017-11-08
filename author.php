<?php get_header(); ?>
	<div class="content">
		<?php tie_breadcrumbs() ?>
		
		<?php if ( have_posts() ): the_post(); ?>
		<div class="page-head">

			<h2 class="page-title">
				<?php global $authordata;
				$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
				$authordata = get_userdata($curauth->ID);
				?>
				<?php printf( __( 'Author Archives: %s', 'tie' ),  get_the_author() ); ?>
			</h2>
			<?php if( tie_get_option( 'author_rss' ) ): ?>
			<a class="rss-cat-icon ttip" title="<?php _e( 'Feed Subscription', 'tie' ); ?>"  href="<?php echo get_author_feed_link( get_the_author_meta('ID') ); ?>"></a>
			<?php endif; ?>
			<div class="stripe-line"></div>
			
			<?php if( tie_get_option( 'author_bio' ) ): ?>
			
			<div class="author-bio">
				<?php $email = get_the_author_meta('user_email');
				if (validate_gravatar($email)): ?>
					<div id="author-avatar">
						<?php echo get_avatar( $email, apply_filters( 'tie_author_bio_avatar_size', 60 ) ); ?>
					</div><!-- #author-avatar -->
				<?php endif; ?>
			
				<div id="author-description">
					<?php the_author_meta( 'description' ); ?>
				</div><!-- #author-description -->
				<div class="author-social">
					<?php if ( get_the_author_meta( 'url' ) ) : ?>
					<a class="ttip" href="<?php the_author_meta( 'url' ); ?>" title="<?php the_author_meta( 'display_name' ); ?><?php _e( " 's site", 'tie' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/author_site.png" width="18" height="18" alt="" /></a>
					<?php endif ?>	
					<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
					<a class="ttip" href="http://twitter.com/<?php the_author_meta( 'twitter' ); ?>" title="<?php the_author_meta( 'display_name' ); ?><?php _e( '  on Twitter', 'tie' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/author_twitter.png" width="18" height="18" alt="" /></a>
					<?php endif ?>	
					<?php if ( get_the_author_meta( 'facebook' ) ) : ?>
					<a class="ttip" href="<?php the_author_meta( 'facebook' ); ?>" title="<?php the_author_meta( 'display_name' ); ?> <?php _e( '  on Facebook', 'tie' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/author_facebook.png" width="18" height="18" alt="" /></a>
					<?php endif ?>
					<?php if ( get_the_author_meta( 'google' ) ) : ?>
					<a class="ttip" href="<?php the_author_meta( 'google' ); ?>" title="<?php the_author_meta( 'display_name' ); ?> <?php _e( '  on Google+', 'tie' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/author_google.png" width="18" height="18" alt="" /></a>
					<?php endif ?>	
					<?php if ( get_the_author_meta( 'linkedin' ) ) : ?>
					<a class="ttip" href="<?php the_author_meta( 'linkedin' ); ?>" title="<?php the_author_meta( 'display_name' ); ?> <?php _e( '  on Linkedin', 'tie' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/author_linkedin.png" width="18" height="18" alt="" /></a>
					<?php endif ?>				
					<?php if ( get_the_author_meta( 'flickr' ) ) : ?>
					<a class="ttip" href="<?php the_author_meta( 'flickr' ); ?>" title="<?php the_author_meta( 'display_name' ); ?><?php _e( '  on Flickr', 'tie' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/author_flickr.png" width="18" height="18" alt="" /></a>
					<?php endif ?>	
					<?php if ( get_the_author_meta( 'youtube' ) ) : ?>
					<a class="ttip" href="<?php the_author_meta( 'youtube' ); ?>" title="<?php the_author_meta( 'display_name' ); ?><?php _e( '  on YouTube', 'tie' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/author_youtube.png" width="18" height="18" alt="" /></a>
					<?php endif ?>
					<?php if ( get_the_author_meta( 'pinterest' ) ) : ?>
					<a class="ttip" href="<?php the_author_meta( 'pinterest' ); ?>" title="<?php the_author_meta( 'display_name' ); ?><?php _e( '  on Pinterest', 'tie' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/author_pinterest.png" width="18" height="18" alt="" /></a>
					<?php endif ?>
					<?php if ( get_the_author_meta( 'behance' ) ) : ?>
					<a class="ttip" href="<?php the_author_meta( 'behance' ); ?>" title="<?php the_author_meta( 'display_name' ); ?><?php _e( '  on Behance', 'tie' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/author_behance.png" width="18" height="18" alt="" /></a>
					<?php endif ?>
					<?php if ( get_the_author_meta( 'instagram' ) ) : ?>
					<a class="ttip" href="<?php the_author_meta( 'instagram' ); ?>" title="<?php the_author_meta( 'display_name' ); ?><?php _e( '  on Instagram', 'tie' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/author_instagram.png" width="18" height="18" alt="" /></a>
					<?php endif ?>	
				</div>
			</div>
			<?php endif; ?>
		</div><!-- .page-head /-->
	<?php endif; ?>

		<?php
			rewind_posts();
			get_template_part( 'loop', 'author' );
		?>
		<?php if ($wp_query->max_num_pages > 1) tie_pagenavi(); ?>			
	
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>
