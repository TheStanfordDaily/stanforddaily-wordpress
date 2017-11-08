<?php get_header(); ?>

	<div class="content">
		<?php 
		/* Display "Opinions" header for ops articles */
		if (in_category(24)) { ?>
			<div class="page-head">
				<h1 class="page-title" style="color:#333333">OPINIONS</h1>
				<div class="stripe-line"></div>
			</div>
		<?php
		/* Display "Dish Daily" header for tech blog articles */
		} else if (in_category(24905)) { ?>
			<div class="page-head">
				<h1 class="page-title" style="color:#333333">THE DISH DAILY</h1>
				<div class="stripe-line"></div>
			</div>
		<?php
		/* Display "Lomita" header for Lomita blog articles */
		} else if (in_category(25964)) { ?>
			<div class="page-head">
				<h1 class="page-title" style="color:#333333">LOMITA ARTS AND CULTURE BLOG</h1>
				<div class="stripe-line"></div>
			</div>

		<?php } ?>
		

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

		<?php while ( have_posts() ) : the_post(); ?>
		
		<?php $get_meta = get_post_custom($post->ID);
			if( !empty( $get_meta['tie_review_position'][0] ) ){
				$review_position = $get_meta['tie_review_position'][0] ;
				$rv = $tie_reviews_attr;
			}
			
			$post_width = $get_meta["tie_sidebar_pos"][0];
			if( $post_width == 'full' ) $content_width = 955;
		?>
		
		<?php //Above Post Banner
		if(  empty( $get_meta["tie_hide_above"][0] ) ){
			if( !empty( $get_meta["tie_banner_above"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["tie_banner_above"][0]) .'</div>';
			else tie_banner('banner_above' , '<div class="ads-post">' , '</div>' );
		}
		?>
				
		<article <?php if( !empty( $rv['review'] ) ) echo $rv['review']; post_class('post-listing'); ?>>
			<?php get_template_part( 'includes/post-head' ); ?>

			<div class="post-inner">
				<h1 class="name post-title entry-title" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing"><span itemprop="name"><?php the_title(); ?></span></h1>

				<div class="entry">
					<?php if( ( tie_get_option( 'share_post_top' ) &&  empty( $get_meta["tie_hide_share"][0] ) ) || $get_meta["tie_hide_share"][0] == 'no' ) get_template_part( 'includes/post-share' ); // Get Share Button template ?>
					<?php if( !empty( $review_position ) && ( $review_position == 'top' || $review_position == 'both'  ) ) tie_get_review('review-top'); ?>
				</div>
				<?php get_template_part( 'includes/post-meta' ); ?>
				<div class="entry">

					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tie' ), 'after' => '</div>' ) ); ?>
					
					<?php if( !empty( $review_position ) && ( $review_position == 'bottom' || $review_position == 'both' ) ) tie_get_review('review-bottom'); ?>

					<?php edit_post_link( __( 'Edit', 'tie' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry /-->
				<?php the_tags( '<span style="display:none">',' ', '</span>'); ?>
				<span style="display:none" class="updated"><?php the_time( 'Y-m-d' ); ?></span>
				<?php if ( get_the_author_meta( 'google' ) ){ ?>
				<div style="display:none" class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person"><strong class="fn" itemprop="name"><a href="<?php the_author_meta( 'google' ); ?>?rel=author">+<?php echo get_the_author(); ?></a></strong></div>
				<?php }else{ ?>
				<div style="display:none" class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person"><strong class="fn" itemprop="name"><?php the_author_posts_link(); ?></strong></div>
				<?php } ?>
				
				<?php if( ( tie_get_option( 'share_post' ) &&  empty( $get_meta["tie_hide_share"][0] ) ) || $get_meta["tie_hide_share"][0] == 'no' ) get_template_part( 'includes/post-share' ); // Get Share Button template ?>

				<!-- Subscribe box -->
				<div class="share-post">
					<span class="share-text">Subscribe</span>
					<span class="share-post-body"><a href="http://www.stanforddaily.com/subscriptions/" style="text-decoration:underline;">Click here</a> to subscribe to our daily newsletter of top headlines.</span>
				</div>
			</div><!-- .post-inner -->
		</article><!-- .post-listing -->
		<?php if( tie_get_option( 'post_tags' ) ) the_tags( '<p class="post-tag">'.__( 'Tagged with: ', 'tie' )  ,' ', '</p>'); ?>

		
		<?php //Below Post Banner
		if( empty( $get_meta["tie_hide_below"][0] ) ){
			if( !empty( $get_meta["tie_banner_below"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["tie_banner_below"][0]) .'</div>';
			else tie_banner('banner_below' , '<div class="ads-post">' , '</div>' );
		}
		?>
		
		<?php if (function_exists('coauthors')):
			$coauthors_list = new CoAuthorsIterator();
			$coauthors_count = $coauthors_list->count();
			if ($coauthors_count == 1): /* Only 1 author, do it the old way */ ?>
				<?php if( get_the_author_meta( 'description' ) && ( tie_get_option( 'post_authorbio' ) && empty( $get_meta["tie_hide_author"][0] ) ) || ( isset( $get_meta["tie_hide_related"][0] ) && $get_meta["tie_hide_author"][0] == 'no' ) ): ?>		
				<section id="author-box">
					<div class="block-head">
						<h3><?php _e( 'About', 'tie' ) ?> <?php the_author() ?> </h3><div class="stripe-line"></div>
					</div>
					<div class="post-listing">
						<?php tie_author_box() ?>
					</div>
				</section><!-- #author-box -->
				<?php endif; ?>
			<?php else: /* More than 1 author, list them all */
				while ($coauthors_list->iterate()) {
					if( get_the_author_meta( 'description' ) && ( tie_get_option( 'post_authorbio' ) && empty( $get_meta["tie_hide_author"][0] ) ) || ( isset( $get_meta["tie_hide_related"][0] ) && $get_meta["tie_hide_author"][0] == 'no' ) ): ?>		
					<section id="author-box">
						<div class="block-head">
							<h3><?php _e( 'About', 'tie' ) ?> <?php the_author() ?> </h3><div class="stripe-line"></div>
						</div>
						<div class="post-listing">
							<?php tie_author_box() ?>
						</div>
					</section><!-- #author-box -->
					<?php endif;
				}
			endif;
		else: /* Plugin not installed */ ?>
			<?php if( get_the_author_meta( 'description' ) && ( tie_get_option( 'post_authorbio' ) && empty( $get_meta["tie_hide_author"][0] ) ) || ( isset( $get_meta["tie_hide_related"][0] ) && $get_meta["tie_hide_author"][0] == 'no' ) ): ?>		
				<section id="author-box">
				<div class="block-head">
					<h3><?php _e( 'About', 'tie' ) ?> <?php the_author() ?> </h3><div class="stripe-line"></div>
				</div>
				<div class="post-listing">
					<?php tie_author_box() ?>
				</div>
			</section><!-- #author-box -->
			<?php endif; ?>

		<?php endif; ?>	
				
		<?php if( tie_get_option( 'post_nav' ) ): ?>				
		<div class="post-navigation">
			<div class="post-previous"><?php previous_post_link( '%link', '<span>'. __( 'Previous:', 'tie' ).'</span> %title' ); ?></div>
			<div class="post-next"><?php next_post_link( '%link', '<span>'. __( 'Next:', 'tie' ).'</span> %title' ); ?></div>
		</div><!-- .post-navigation -->
		<?php endif; ?>
	
		<?php get_template_part( 'includes/post-related' ); ?>

		<?php endwhile;?>

		<?php comments_template( '', true ); ?>
	
	</div><!-- .content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
