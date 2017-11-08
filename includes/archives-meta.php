<p class="post-meta">
<?php if( tie_get_option( 'arc_meta_score' ) ) tie_get_score(); ?>
<?php if( tie_get_option( 'arc_meta_author' ) ): ?>
	<?php if (function_exists('coauthors')):
		$coauthors_list = new CoAuthorsIterator();
		$coauthors_count = $coauthors_list->count();
		$i = 1;
		if ($coauthors_count == 1): /* Only 1 author, do it the old way */ ?>
			<span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'tie' ), get_the_author() ) ?>"><?php echo get_the_author(); ?> </a>
			</span>
		<?php else: /* More than 1 author, list them all */
			$coauthors_list->iterate(); ?>
			<span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'tie' ), get_the_author() ) ?>"><?php echo get_the_author(); ?></a><?php 
			while ($coauthors_list->iterate()) {
				$i = $i + 1;
				if ($i != $coauthors_count): echo ", "; else: echo " and "; endif; ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'tie' ), get_the_author() ) ?>"><?php echo get_the_author(); ?></a><?php if ($i == $coauthors_count): echo " </span>"; endif; 
			}
		endif;
	else: /* Plugin not installed */ ?>
		<span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'tie' ), get_the_author() ) ?>"><?php echo get_the_author(); ?> </a>
		</span>
	<?php endif; ?>	
<?php endif; ?>	
<?php if( tie_get_option( 'arc_meta_date' ) ): ?>		
	<?php tie_get_time() ?>
<?php endif; ?>	
<?php if( tie_get_option( 'arc_meta_cats' ) ): ?>
	<span><?php printf('%1$s', get_the_category_list( ', ' ) ); ?></span>
<?php endif; ?>	
<?php if( tie_get_option( 'arc_meta_comments' ) ): ?>
	<span><?php comments_popup_link( __( /*'Leave a comment'*/'0 Comments', 'tie' ), __( '1 Comment', 'tie' ), __( '% Comments', 'tie' ) ); ?></span>
<?php endif; ?>
</p>
