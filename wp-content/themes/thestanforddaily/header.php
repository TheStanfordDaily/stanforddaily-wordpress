<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The_Stanford_Daily
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'tsd' ); ?></a>

	<header id="masthead" class="site-header">
		<nav id="site-topbar" class="main-topbar">
			<div class="container">
				<div class="nav-row">
					<div class="nav-col">
						<button class="menu-toggle" aria-controls="topbar-menu" aria-expanded="false"><?php esc_html_e( 'Top Bar Menu', 'tsd' ); ?></button>
						<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-topbar',
							'menu_id'        => 'topbar-menu',
						) );
						?>
					</div>
					<div class="nav-col">
						<form role="search" method="get" class="topbar-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<label>
								<span class="screen-reader-text">Search for:</span>
								<input type="search" class="topbar-search-field" placeholder="Search&hellip;" value="<?php the_search_query(); ?>" name="s">
							</label>
							<button type="submit" class="topbar-search-submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
				</div>
			</div>
		</nav><!-- #site-topbar -->

		<div class="site-branding">
			<div class="container">
				<?php
				$title_tag = "div";
				if ( is_front_page() && is_home() ) {
					$title_tag = "h1";
				}
				?>
				<<?php echo $title_tag; ?> class="site-title"><?php
					$custom_logo = get_custom_logo();
					if (!empty($custom_logo)) {
						echo $custom_logo;
					} else {
						?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a><?php
					}
				?></<?php echo $title_tag; ?>>
			</div>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<div class="container">
				<div class="nav-row">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'tsd' ); ?></button>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-primary',
						'menu_id'        => 'primary-menu',
					) );
					?>
				</div>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="container">
