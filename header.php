<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	if ( function_exists( 'yoast_analytics' ) ) {
		yoast_analytics();
	}
?>
<?php wp_head(); ?>
<?php
$featured_image_url = "http://www.stanforddaily.com/wp-content/uploads/2014/03/Logo-3-Lines1.png";
if (is_single() && has_post_thumbnail() ) {
	$tn_id = get_post_thumbnail_id( $post->ID );

	$img = wp_get_attachment_image_src( $tn_id, 'full' );
	$width = $img[1];
	$height = $img[2];
	if ($width > 200 && $height > 200) {
		$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	}
}
echo '<meta property="og:image" content="'.$featured_image_url.'"/>';

?></head>
<?php global $is_IE ?>
<body id="top" <?php body_class(); ?>>
<?php if( tie_get_option('banner_bg_url') && tie_get_option('banner_bg') ): ?>
	<a href="<?php echo tie_get_option('banner_bg_url') ?>" target="_blank" class="background-cover"></a>
<?php else: ?>
	<div class="background-cover"></div>
<?php endif; ?>
	<?php $full_width =''; if( tie_get_option( 'full_logo' )) $full_width = ' full-logo';
		  $center_logo =''; if( tie_get_option( 'center_logo' )) $center_logo = ' center-logo';
	?>
		<header id="theme-header" class="theme-header<?php echo $full_width.$center_logo ?>">
			<?php if(!tie_get_option( 'top_menu' )): ?>
			<div class="top-nav">
			<?php if(tie_get_option( 'top_date' )):
				if( tie_get_option('todaydate_format') ) $date_format = tie_get_option('todaydate_format');
				else $date_format = 'l ,  j  F Y';
			?>
				<span class="today-date"><?php  echo date_i18n( $date_format , current_time( 'timestamp' ) ); ?></span><?php endif; ?>
					
				<?php wp_nav_menu( array( 'container_class' => 'top-menu', 'theme_location' => 'top-menu', 'fallback_cb' => 'tie_nav_fallback'  ) ); ?>

	<?php if(tie_get_option( 'top_right' ) == 'search'): ?>
					<div class="search-block">
						<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
							<button class="search-button" type="submit" value="<?php if( !$is_IE ) _e( 'Search' , 'tie' ) ?>"></button>	
							<input type="text" id="s" name="s" value="<?php _e( 'Search...' , 'tie' ) ?>" onfocus="if (this.value == '<?php _e( 'Search...' , 'tie' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Search...' , 'tie' ) ?>';}"  />
						</form>
					</div><!-- .search-block /-->
	<?php elseif( tie_get_option('top_right') == 'social' ):
		tie_get_social( 'yes' , 16 , 'tooldown' ); ?>
	<?php endif; ?>
	
	<?php tie_language_selector_flags(); ?>

			</div><!-- .top-menu /-->
			<?php endif; ?>

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
					<img src="<?php echo $logo ; ?>" alt="<?php bloginfo('name'); ?>" /><strong><?php bloginfo('name'); ?> <?php bloginfo( 'description' ); ?></strong>
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
		<?php $stick = ''; ?>
		<?php if( tie_get_option( 'stick_nav' ) ) $stick = ' class="fixed-enabled"' ?>
			<?php if(!tie_get_option( 'main_nav' )): ?>
			<?php
			//UberMenu Support
			$navID = 'main-nav';
			if ( class_exists( 'UberMenu' ) ){
				$uberMenus = get_option( 'wp-mega-menu-nav-locations' );
				if( !empty($uberMenus) && is_array($uberMenus) && in_array("primary", $uberMenus)) $navID = 'main-nav-uber';
			}?>
			<nav id="<?php echo $navID; ?>"<?php echo $stick; ?>>
				<div class="container">
					<?php $orig_post = $post; wp_nav_menu( array( 'container_class' => 'main-menu', 'theme_location' => 'primary' ,'fallback_cb' => 'tie_nav_fallback',  'walker' => new tie_mega_menu_walker()  ) ); $post = $orig_post; ?>
					<?php if(tie_get_option( 'random_article' )): ?>
					<a href="<?php echo home_url(); ?>/?tierand=1" class="random-article tieicon-shuffle ttip" title="<?php _e( 'Random Article' , 'tie' ) ?>"></a>
					<?php endif ?>
				</div>
			</nav><!-- .main-nav /-->
			<?php endif; ?>
		</header><!-- #header /-->
	
	<?php get_template_part( 'includes/breaking-news' ); // Get Breaking News template ?>	
<?php 
$sidebar = '';
if( tie_get_option( 'sidebar_pos' ) == 'left' ) $sidebar = ' sidebar-left';
if( is_singular() || ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) ){

	$current_ID = $post->ID;
	if( function_exists( 'is_woocommerce' ) && is_woocommerce() )	$current_ID = woocommerce_get_page_id('shop');

	$get_meta = get_post_custom( $current_ID );
	if( !empty($get_meta["tie_sidebar_pos"][0]) ){
		$sidebar_pos = $get_meta["tie_sidebar_pos"][0];

		if( $sidebar_pos == 'left' ) $sidebar = ' sidebar-left';
		elseif( $sidebar_pos == 'full' ) $sidebar = ' full-width';
		elseif( $sidebar_pos == 'right' ) $sidebar = ' sidebar-right';
	}
}
if(  function_exists('is_bbpress') && is_bbpress() && tie_get_option( 'bbpress_full' )) $sidebar = ' full-width';
?>
	<div id="main-content" class="container<?php echo $sidebar ; ?>">


<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Header Widgets') ) : ?>
<?php endif; ?>

<!--googleoff: snippet-->
<?php 
	/* $sports = FALSE;
	$dish_daily = FALSE;
	$arts_blog = FALSE;
	if( is_category() || is_single() ){
		if( is_category() ) {
			$category = get_category(get_query_var('cat'),false);
			if ($category->cat_name == 'SPORTS' || get_cat_name($category->category_parent) == 'SPORTS') {
				$sports = TRUE;
			}
			if ($category->cat_name == 'The Dish Daily' || get_cat_name($category->category_parent) == 'The Dish Daily') {
				$dish_daily = TRUE;
			}
			if ($category->cat_name == 'Arts Blog' || get_cat_name($category->category_parent) == 'Arts Blog') {
				$arts_blog = TRUE;
			}
		}		
		if( is_single() ){ 
			$categories = get_the_category( $post->ID );
			foreach ($categories as &$category) {
				$category_name = $category->cat_name ;
				if ($category_name == 'SPORTS') {
					$sports = TRUE;
				}
				if ($category->cat_name == 'The Dish Daily') {
					$dish_daily = TRUE;
				}
				if ($category->cat_name == 'Arts Blog') {
					$arts_blog = TRUE;
				}
			}
		}
		if ($sports) {
			if(function_exists('ditty_news_ticker')){ditty_news_ticker(1083639);}
			echo "<br />\n";
		} else if ($dish_daily) {
			if(function_exists('ditty_news_ticker')){ditty_news_ticker(1087550);}
			echo "<br />\n";
		
		} else if ($arts_blog) {
			if(function_exists('ditty_news_ticker')){ditty_news_ticker(1089054);}
			echo "<br />\n";
		
		} else {
			if(function_exists('ditty_news_ticker')){ditty_news_ticker(1083640);}
			echo "<br />\n";
		}
	} else if (!is_home()) {
		if(function_exists('ditty_news_ticker')){ditty_news_ticker(1083640);}
			echo "<br />\n";
	} */
?>
<!--googleon: snippet-->
