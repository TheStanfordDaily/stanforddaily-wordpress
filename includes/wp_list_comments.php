<?php
function custom_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment ;
	?>
	<li id="comment-<?php comment_ID(); ?>">
		<div  <?php comment_class('comment-wrap'); ?> >
			<div class="comment-avatar"><?php echo get_avatar( $comment, 45 ); ?></div>
			<div class="author-comment">
				<?php printf( __( '%s ', 'tie' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">	<?php printf( __( '%1$s at %2$s', 'tie' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'tie' ), ' ' ); ?></div><!-- .comment-meta .commentmetadata -->
			</div>
			<div class="clear"></div>
			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'tie' ); ?></em>
					<br />
				<?php endif; ?>
					
				<?php comment_text(); ?>
			</div>
			<div class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div><!-- .reply -->
		</div><!-- #comment-##  -->

	<?php
}

function custom_pings($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
	<li class="comment pingback">
		<p><?php _e( 'Pingback:', 'tie' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'tie' ), ' ' ); ?></p>
<?php	
}
?>