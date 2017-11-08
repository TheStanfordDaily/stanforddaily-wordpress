<?php
global $get_meta;
if( ( tie_get_option( 'post_meta' ) && empty( $get_meta["tie_hide_meta"][0] ) ) || $get_meta["tie_hide_meta"][0] == 'no' ): ?>		
<p class="post-meta" style="text-align: center;">
<?php if( tie_get_option( 'post_date' ) && tie_get_option( 'time_format' ) != 'none' ): ?>		
	<?php __( 'on ' , 'tie' ); ?><?php tie_get_time() ?>
<?php endif; ?>	
<?php if( tie_get_option( 'post_cats' ) ): ?>
	<span><?php _e( 'in ' , 'tie' ); ?><?php printf('%1$s', get_the_category_list( ', ' ) ); ?></span>
<?php endif; ?>	
<?php if( tie_get_option( 'post_comments' ) ): ?>
	<span><?php comments_popup_link( __( /*'Leave a comment'*/'0 Comments', 'tie' ), __( '1 Comment', 'tie' ), __( '% Comments', 'tie' ) ); ?></span>
<?php endif; ?>
</p>
<div class="clear"></div>
<?php endif; ?>
