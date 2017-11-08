<?php
/*
Template Name: Special Page Chapters
*/
if (wp_is_mobile()){
	header('Location: http://www.stanforddaily.com/2014/02/07/feb-7-2004/');
}
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en-US" class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html lang="en-US" class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html lang="en-US" class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html lang="en-US" class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en-US" class="no-js"><!--<![endif]-->
<div id="container">
	<div id="header">
		<meta charset="UTF-8" />
		<title>Stanford Daily | <?php the_title(); ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="http://www.stanforddaily.com/wp-content/themes/magnovus/special-page-style.css" type="text/css" />
		<script type="text/javascript">
			function displaySidebar(toDisplay, toHide)
			{
				document.getElementById(toDisplay).style.display = 'inline';
				document.getElementById(toHide).style.display = 'none';
			}
		</script>
		<!--<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-5773957-1']);
							_gaq.push(['_setCustomVar',1,'author','joseph-beyda',3],['_trackPageview']);
			(function () {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();
		</script>-->
		<?php
			if ( function_exists( 'yoast_analytics' ) ) {
				yoast_analytics();
			}
		?>
		<div id="headerlogo">
			<a href="http://www.stanforddaily.com"><img class="headerlogo" alt="" src="http://josephbeyda.com/wp-content/uploads/2014/01/Site-logo_newfont-200x200.jpg"</img></a>
		</div>
		<div id="headermeta">
			<h4><a href="http://www.stanforddaily.com/category/sports">SPORTS</a> | <a href="#anchor"><?php the_title(); ?></a></h4>
		</div>
		<div id="headerchapters">
			<h4> 1 2 3 4 5 </h4>
		</div>
		<div id="headerright">
			<!--<a target="_blank" href="https://twitter.com/intent/tweet?original_referer=http%3A%2F%2Fwww.stanforddaily.com%2Fmiracle-at-maples%2F&text=Stanford%20Daily%20%7C%20February%207%2C%202004%3A%20The%20day%20Maples%20shook&tw_p=tweetbutton&url=http%3A%2F%2Fwww.stanforddaily.com%2Fmiracle-at-maples%2F&via=Stanford%20Daily"><img class="socialbutton" alt="" src="http://weekender.wpengine.com/wp-content/uploads/2014/02/Twitter-blue-on-white.jpg"</img></a>-->
			<!--<a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.stanforddaily.com%2Fmiracle-at-maples%2F"><img class="socialbutton" alt="" src="http://weekender.wpengine.com/wp-content/uploads/2014/02/Facebook-white-on-blue.jpg"</img></a>-->
			<!--<div class="fb-like" data-href="http://weekender.wpengine.com/?page_id=1081346" data-width="50" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>-->
			<?php
				$shortlink = urlencode(wp_get_shortlink());
				$title = get_the_title(0);
				$twitterlink = "https://twitter.com/intent/tweet?original_referer=".$shortlink."&text=".urlencode("Stanford Daily | ").urlencode($title)."&tw_p=tweetbutton&url=".$shortlink."&via=Stanford%5FDaily";
				$facebooklink = "http://www.facebook.com/sharer/sharer.php?u=".$shortlink;
			?>
			<a target="_blank" href="<?php echo $twitterlink ?>"><img class="socialbutton" alt="" src="http://weekender.wpengine.com/wp-content/uploads/2014/02/Twitter-blue-on-white.jpg"</img></a>
			<a target="_blank" href="<?php echo $facebooklink ?>"><img class="socialbutton" alt="" src="http://weekender.wpengine.com/wp-content/uploads/2014/02/Facebook-white-on-blue.jpg"</img></a>
		</div>
	</div>
	<div id="body">
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
 			 var js, fjs = d.getElementsByTagName(s)[0];
  			if (d.getElementById(id)) return;
  			js = d.createElement(s); js.id = id;
  			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=52111769465";
  			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<a name="anchor" />
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php
			global $more;
			$more = 1;
			the_content(); ?>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
	</div>
	<div id="footer">
		<p class="byline"><a href="http://www.stanforddaily.com/tag/the-miracle-at-maples/">Read The Daily's complete coverage of The Miracle at Maples</a></p>
	</div>
</div>