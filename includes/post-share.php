<?php
global $post;
$share_box_class= "share-post";
if( is_singular() ) $share_box_class = "share-post";
?>

<div class="<?php echo $share_box_class ?>">
<span class="new-post-meta">
<?php if( tie_get_option( 'post_date' ) && tie_get_option( 'time_format' ) != 'none' ): ?>		
	<?php __( 'on ' , 'tie' ); ?><?php tie_get_time() ?>
<?php endif; ?>	
<?php if( tie_get_option( 'post_cats' ) ): ?>
	<span><?php _e( 'in ' , 'tie' ); ?><?php printf('%1$s', get_the_category_list( ', ' ) ); ?></span>
<?php endif; ?>	
<?php if( tie_get_option( 'post_comments' ) ): ?>
	<span><?php comments_popup_link( __( /*'Leave a comment'*/'0 Comments', 'tie' ), __( '1 Comment', 'tie' ), __( '% Comments', 'tie' ) ); ?></span>
<?php endif; ?>
</span>

	<span class="share-text"><?php _e( 'Share' , 'tie' );?></span>
	<script>
	window.___gcfg = {lang: 'en-US'};
	(function(w, d, s) {
	  function go(){
		var js, fjs = d.getElementsByTagName(s)[0], load = function(url, id) {
		  if (d.getElementById(id)) {return;}
		  js = d.createElement(s); js.src = url; js.id = id;
		  fjs.parentNode.insertBefore(js, fjs);
		};
		load('//connect.facebook.net/en/all.js#xfbml=1', 'fbjssdk');
		load('https://apis.google.com/js/plusone.js', 'gplus1js');
		load('//platform.twitter.com/widgets.js', 'tweetjs');
	  }
	  if (w.addEventListener) { w.addEventListener("load", go, false); }
	  else if (w.attachEvent) { w.attachEvent("onload",go); }
	}(window, document, 'script'));
	</script>

	<?php
		$via_text = tie_get_option( 'share_twitter_username' );
		if (is_singular()):
			$author_handle = get_the_author_meta('twitter');
			if ($author_handle):
				if ($author_handle[0] == '@'):
					$author_handle = substr($author_handle, 1);
				endif;
				if ($via_text[0] != '@'):
					$via_text = "@".$via_text;
				endif;
				$via_text = $author_handle." ".$via_text;
			endif;
		endif;
	?>	

	<ul>			
	<?php if( tie_get_option( 'share_tweet' ) ): ?>
		<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="<?php echo $via_text; ?>" data-lang="en">tweet</a></li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_facebook' ) ): ?>
		<li>
			<div id="fb-root"></div>
			<div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
		</li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_google' ) ): ?>
		<li style="width:80px;"><div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div>
		</li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_stumble' ) ): ?>
		<li><su:badge layout="2" location="<?php the_permalink(); ?>"></su:badge>
			<script type="text/javascript">
				(function() {
					var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
					li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
				})();
			</script>
		</li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_linkdin' ) ): ?>
		<li><script src="http://platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="<?php the_permalink(); ?>" data-counter="right"></script></li>
	<?php endif; ?>
	<?php if( tie_get_option( 'share_pinterest' ) ): ?>
		<li style="width:80px;"><script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo tie_thumb_src( 'slider' ); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="http://assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
	<?php endif; ?>
	</ul>
	<div class="clear"></div>
</div> <!-- .share-post -->
