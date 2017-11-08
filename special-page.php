<?php
/*
Template Name: Special Page
*/
$mobile_url = get_post_meta(get_the_ID(), 'mobile_url', true);
if (wp_is_mobile() and !empty($mobile_url)){
	header('Location: '.$mobile_url);
}
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en-US" class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html lang="en-US" class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html lang="en-US" class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html lang="en-US" class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en-US" class="no-js"><!--<![endif]-->


<!-- Background -->
<?php if( tie_get_option('banner_bg_url') && tie_get_option('banner_bg') ): ?>
	<a href="<?php echo tie_get_option('banner_bg_url') ?>" target="_blank" class="background-cover"></a>
<?php else: ?>
	<div class="background-cover"></div>
<?php endif; ?>

<!-- Ad header stuff -->
<head>
<title>Stanford Daily | <?php the_title(); ?></title> 
<?php
echo htmlspecialchars_decode( tie_get_option('header_code') ) , "\n"; 
include ("functions/header-adcodes.php");?>
<link rel="stylesheet" href="https://stanforddaily.com/wp-content/themes/sahifa/style.css" type="text/css" />
</head>

<div id="container">
	<div id="header">
		<meta charset="UTF-8" />
		<title>Stanford Daily | <?php the_title(); ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://stanforddaily.com/wp-content/themes/sahifa/special-page-style.css" type="text/css" />
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
			<a href="http://www.stanforddaily.com"><img class="headerlogo" alt="" src="http://www.stanforddaily.com/wp-content/uploads/2014/03/favicon144x1441.png"</img></a>
		</div>
		<div id="headermeta">
		<?php
			$category_name = strtoupper(get_post_meta(get_the_ID(), 'longform_category_name', true));
			$category_url = get_post_meta(get_the_ID(), 'longform_category_url', true);
			if(empty($category_name) or empty($category_url)){
				$category_name = "The Stanford Daily";
				$category_url = "http://www.stanforddaily.com";
			}
			$category_html = '<h4><a href="'.$category_url.'">'.$category_name.'</a> | <a href="#anchor">'.get_the_title().'</a></h4>';
			echo $category_html;
		?>
			<!--<h4><a href="http://www.stanforddaily.com/category/sports">SPORTS</a> | <a href="#anchor"><?php the_title(); ?></a></h4>-->
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

	<div class="header-content">
<?php if( is_category() || is_single() ){
	if( is_category() ) $category_id = get_query_var('cat') ;
	if( is_single() ){ 
		$categories = get_the_category( $post->ID );
		$category_id = $categories[0]->term_id ;
	}
	$cat_options = get_option( "tie_cat_$category_id");
}

if( !empty($cat_options['cat_custom_logo']) ){
	$logo_margin =''; if( $cat_options['logo_margin'] ) $logo_margin = ' style="margin-top:'.$cat_options['logo_margin'].'px"'; ?>
			<div class="logo"<?php echo $logo_margin ?>>
			<h2>
<?php if( $cat_options['logo_setting'] == 'title' ): ?>
				<a  href="<?php echo home_url() ?>/"><?php echo single_cat_title( '', false ) ?></a>
				<?php else : ?>
				<?php if( !empty($cat_options['logo']) ) $logo = $cat_options['logo'];
				elseif( tie_get_option( 'logo' ) ) $logo = tie_get_option( 'logo' );
						else $logo = get_stylesheet_directory_uri().'/images/logo.png';
				?>
				<a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>/">
					<img src="<?php echo $logo ; ?>" alt="<?php echo single_cat_title( '', false ) ?>" /><strong><?php echo single_cat_title( '', false ) ?></strong>
				</a>
<?php endif; ?>
			</h2>
			</div><!-- .logo /-->
<?php if( $cat_options['logo_retina'] && $cat_options['logo_retina_width'] && $cat_options['logo_retina_height']): ?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var retina = window.devicePixelRatio > 1 ? true : false;
	if(retina) {
       	jQuery('#theme-header .logo img').attr('src', '<?php echo $cat_options['logo_retina']; ?>');
       	jQuery('#theme-header .logo img').attr('width', '<?php echo $cat_options['logo_retina_width']; ?>');
       	jQuery('#theme-header .logo img').attr('height', '<?php echo $cat_options['logo_retina_height']; ?>');
	}
});
</script>
<?php endif; ?>
<?php
}else{
	$logo_margin =''; if( tie_get_option( 'logo_margin' )) $logo_margin = ' style="margin-top:'.tie_get_option( 'logo_margin' ).'px"';  ?>
			<div class="logo"<?php echo $logo_margin ?>>
			<?php if( !is_singular() && !is_category() && !is_tag() ) echo '<h1>'; else echo '<h2>'; ?>
<?php if( tie_get_option('logo_setting') == 'title' ): ?>
				<a  href="<?php echo home_url() ?>/"><?php bloginfo('name'); ?></a>
				<span><?php bloginfo( 'description' ); ?></span>
				<?php else : ?>
				<?php if( tie_get_option( 'logo' ) ) $logo = tie_get_option( 'logo' );
						else $logo = get_stylesheet_directory_uri().'/images/logo.png';
				?>
				<a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>/">
					<img src="<?php echo $logo ; ?>" alt="<?php bloginfo('name'); ?>" />
				</a>
<?php endif; ?>
			<?php if( !is_singular() && !is_category() && !is_tag() ) echo '</h1>'; else echo '</h2>'; ?>
			</div><!-- .logo /-->
<?php if( tie_get_option( 'logo_retina' ) && tie_get_option( 'logo_retina_width' ) && tie_get_option( 'logo_retina_height' )): ?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var retina = window.devicePixelRatio > 1 ? true : false;
	if(retina) {
       	jQuery('#theme-header .logo img').attr('src', '<?php echo tie_get_option( 'logo_retina' ); ?>');
       	jQuery('#theme-header .logo img').attr('width', '<?php echo tie_get_option( 'logo_retina_width' ); ?>');
       	jQuery('#theme-header .logo img').attr('height', '<?php echo tie_get_option( 'logo_retina_height' ); ?>');
	}
});
</script>
<?php endif; ?>
<?php } ?>
			<?php tie_banner('banner_top' , '<div class="top-area">' , '</div>' ); ?>
			<div class="clear"></div>
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
			<div class="special-comments"><?php comments_template(); ?></div>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
	</div>
	<div id="footer">
		<?php if(strcmp(get_the_title(), 'Miracle at Maples') == 0){ ?>
		<p class="byline"><a href="http://www.stanforddaily.com/tag/the-miracle-at-maples/">Read The Daily's complete coverage of The Miracle at Maples</a></p>
		<?php } ?>
	</div>
</div>
