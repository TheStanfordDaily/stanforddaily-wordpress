<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post not-found post-listing">
		<h2 class="post-title"><?php _e( 'Not Found', 'tie' ); ?></h2>
		<div class="entry">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'tie' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>

<?php else : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php if( tie_get_option( 'blog_display' ) != 'full_thumb' ): ?>
<div class="post-listing" style="margin-bottom:10px; border-width:2px 2px 4px;">
	<article <?php tie_post_class('item-list'); ?>>
		<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		
		<?php if( tie_get_option( 'blog_display' ) == 'content' ): ?>
		<div class="entry">
			<?php the_content( __( 'Read More &raquo;', 'tie' ) ); ?>
		</div>
		<?php else: ?>
		<div class="entry">
			<?php if( ( tie_get_option( 'share_post_top' ) &&  empty( $get_meta["tie_hide_share"][0] ) ) || $get_meta["tie_hide_share"][0] == 'no' ) get_template_part( 'includes/post-share' ); // Get Share Button template ?>
		</div>
		<?php get_template_part( 'includes/post-meta' ); ?>
		<div class="entry">
			<div style="margin-bottom:15px;"></div>
			<?php the_content('Read more >>'); ?>
		</div>
		<?php endif; ?>

		<?php if( tie_get_option( 'archives_socail' ) ) get_template_part( 'includes/post-share' );  // Get Share Button template ?>
		<div class="clear"></div>
	</article><!-- .item-list -->
</div>
<?php else: ?>
<div class="post-listing">
	<article <?php tie_post_class('item-list'); ?>>
		<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php get_template_part( 'includes/archives-meta' ); ?>					
		<div class="entry">
			<p><?php tie_excerpt() ?>
			<a class="more-link" href="<?php the_permalink() ?>"><?php _e( 'Read More &raquo;', 'tie' ) ?></a></p>
		</div>
		<?php if( tie_get_option( 'archives_socail' ) ) get_template_part( 'includes/post-share' );  // Get Share Button template ?>
		<div class="clear"></div>
	</article><!-- .item-list -->
</div>
<?php endif; ?>
	
<?php endwhile;?>
<?php endif; ?>
