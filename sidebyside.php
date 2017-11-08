<?php 
/*
Template Name Posts: Side-by-side template
*/

get_header(); ?>
	
<div class="full-width sidebyside">
	<div class="content">
		
		<?php 
		/* Display "Opinions" header for ops articles */
		if (in_category(24)): ?>
			<div class="page-head" style="border-bottom: 0px;">
				<h1 class="page-title" style="color:#333333">OPINIONS</h1>
				<div class="stripe-line"></div>
			</div>
		<?php endif; ?>

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
				<h1 class="name post-title entry-title" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing" style="text-align: center;"><span itemprop="name"><?php the_title(); ?></span></h1>

				<?php/* get_template_part( 'includes/sidebyside-meta' );*/ ?>

				<div class="entry">
					<div class="sidebyside-share">
					<?php if( ( tie_get_option( 'share_post_top' ) &&  empty( $get_meta["tie_hide_share"][0] ) ) || $get_meta["tie_hide_share"][0] == 'no' ) get_template_part( 'includes/post-share' ); // Get Share Button template ?>
					</div>
					<?php if( !empty( $review_position ) && ( $review_position == 'top' || $review_position == 'both'  ) ) tie_get_review('review-top'); ?>
	
				<?php /* Split content up and add author headings */
					global $more;
    					$more = true;
   					$content = preg_split('/<span id="more-\d+"><\/span>/i', get_the_content('more'));
			
					$author_left = get_post_meta($post->ID, 'sidebyside-left-author', true);
					$author_right = get_post_meta($post->ID, 'sidebyside-right-author', true);
			
					$headline_left = get_post_meta($post->ID, 'sidebyside-left-headline', true);
					$headline_right = get_post_meta($post->ID, 'sidebyside-right-headline', true);
			
					$email_left = get_the_author_meta('user_email', $author_left);
					$icon_code_left = "";
					if (validate_gravatar($email_left)):
						$icon_code_left .= '<div id="author-avatar">'.get_avatar($email_left, apply_filters( 'MFW_author_bio_avatar_size', 80 )).'</div>';
					endif;

					$email_right = get_the_author_meta('user_email', $author_right);
					$icon_code_right = "";
					if (validate_gravatar($email_right)):
						$icon_code_right .= '<div id="author-avatar">'.get_avatar($email_right, apply_filters( 'MFW_author_bio_avatar_size', 80 )).'</div>';
					endif;

					$link_open_left = "";
					$link_close_left = "";
					$link_left = get_post_meta($post->ID, 'sidebyside-left-link', true);
					if ($link_left):
						$link_open_left .= '<a href="'.$link_left.'">';
						$link_close_left .= '</a>';
					endif;

					$link_open_right = "";
					$link_close_right = "";
					$link_right = get_post_meta($post->ID, 'sidebyside-right-link', true);
					if ($link_right):
						$link_open_right .= '<a href="'.$link_right.'">';
						$link_close_right .= '</a>';
					endif;

					$ret = '<div class="sidebyside-half sidebyside-left">'
						. '<div class="page-head"><h1 class="author-name"><a href="'
						. get_author_posts_url(get_the_author_meta('ID', $author_left))
						. '">'
						. get_the_author_meta('display_name', $author_left)
						. '</a></h1>'
						. $icon_code_left
						. '<div class="stripe-line"></div>'
						. '<h2>'
						. $link_open_left
						. $headline_left
						. $link_close_left 
						. '</h2></div>'
						. array_shift($content)
						. '</div>';
					if (!empty($content)) $ret .= '<div class="sidebyside-half sidebyside-right">'
						. '<div class="page-head">'
						. '<div class="sidebyside-first-right-avatar">'
						. $icon_code_right
						. '</div>'
						. '<h1 class="author-name"><a href="'
						. get_author_posts_url(get_the_author_meta('ID', $author_right))
						. '">'
						. get_the_author_meta('display_name', $author_right)
						. '</a></h1>'
						. '<div class="sidebyside-second-right-avatar">'
						. $icon_code_right
						. '</div>'
						. '<div class="stripe-line"></div>'
						. '<h2>'
						. $link_open_right
						. $headline_right
						. $link_close_right 
						. '</h2></div>'
						. implode($content)
						. '</div>';
					echo apply_filters('the_content', $ret);
				?>




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

			</div><!-- .post-inner -->
		</article><!-- .post-listing -->
		<?php if( tie_get_option( 'post_tags' ) ) the_tags( '<p class="post-tag">'.__( 'Tagged with: ', 'tie' )  ,' ', '</p>'); ?>

		
		<?php //Below Post Banner
		if( empty( $get_meta["tie_hide_below"][0] ) ){
			if( !empty( $get_meta["tie_banner_below"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["tie_banner_below"][0]) .'</div>';
			else tie_banner('banner_below' , '<div class="ads-post">' , '</div>' );
		}
		?>
				
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
</div><!-- .full-width -->
<?php get_footer(); ?>
