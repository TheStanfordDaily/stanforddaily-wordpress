<?php
global $get_meta;
if( ( tie_get_option( 'post_meta' ) && empty( $get_meta["tie_hide_meta"][0] ) ) || $get_meta["tie_hide_meta"][0] == 'no' ): ?>		
<?php if( tie_get_option( 'post_author' ) ): ?>
	<div class="new-post-authors">
		<?php if (function_exists('coauthors')):
			$coauthors_list = new CoAuthorsIterator();
			$coauthors_count = $coauthors_list->count();
			if ($coauthors_count == 1): /* Only 1 author, do it the old way */
				author_box(); /* See theme-functions.php */
			else: /* More than 1 author, list them all */
				while ($coauthors_list->iterate()) {
					author_box();
				}
			endif;
		else: /* Plugin not installed */
			author_box();
		endif; ?>	


	</div>
	<div class="phone-authors">
	<p class="post-meta">
	<?php if (function_exists('coauthors')):
		$coauthors_list = new CoAuthorsIterator();
		$coauthors_count = $coauthors_list->count();
		$i = 1;
		if ($coauthors_count == 1): /* Only 1 author, do it the old way */ ?>
			<span><?php _e( /*'Posted by: ' */'By: ', 'tie' ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'tie' ), get_the_author() ) ?>"><?php echo get_the_author(); ?> </a>
			<?php if (get_the_author_meta('position')):
				echo "| ";
				echo the_author_meta('position');
			endif; ?>
			</span>
		<?php else: /* More than 1 author, list them all */
			$coauthors_list->iterate(); ?>
			<span><?php _e( /*'Posted by: ' */'By: ', 'tie' ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'tie' ), get_the_author() ) ?>"><?php echo get_the_author(); ?></a><?php 
			while ($coauthors_list->iterate()) {
				$i = $i + 1;
				if ($i != $coauthors_count): echo ", "; else: echo " and "; endif; ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'tie' ), get_the_author() ) ?>"><?php echo get_the_author(); ?></a><?php if ($i == $coauthors_count): echo " </span>"; endif; 
			}
		endif;
	else: /* Plugin not installed */ ?>
		<span><?php _e( /*'Posted by: ' */'By: ', 'tie' ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'tie' ), get_the_author() ) ?>"><?php echo get_the_author(); ?> </a>
		<?php if (get_the_author_meta('position')):
			echo "| ";
			echo the_author_meta('position');
		endif; ?>
		</span>
	<?php endif; ?>	
</p>
</div>
<?php endif; ?>

<div class="clear"></div>
<?php endif; ?>
