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
					<button class="menu-toggle" aria-controls="topbar-menu" aria-expanded="false"><?php esc_html_e( 'Top Bar Menu', 'tsd' ); ?></button>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-topbar',
						'menu_id'        => 'topbar-menu',
					) );
					?>
				</div>
			</div>
		</nav><!-- #site-topbar -->

		<div class="site-branding">
			<div class="container">
				<?php
				$custom_logo = get_custom_logo();
				if (!empty($custom_logo)) {
					echo $custom_logo;
				} else {
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
				}
				?>
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
