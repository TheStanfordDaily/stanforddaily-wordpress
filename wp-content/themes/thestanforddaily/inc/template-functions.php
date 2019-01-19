<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package The_Stanford_Daily
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tsd_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'tsd_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function tsd_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'tsd_pingback_header' );

/*
 * Add donate blurb to the bottom of every article page
 */
function tsd_add_donate_blurb_to_content( $content ) {
    if( is_single() ) {
        ob_start();
        include "donate-blurb.php";
        $donate_blurb_content = ob_get_contents();
        ob_end_clean();
        $content .= $donate_blurb_content;
    }
    return $content;
}
add_filter( 'the_content', 'tsd_add_donate_blurb_to_content' );

/*
 * Add Font Awesome
 */
function tsd_load_fa() {
	?><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"><?php
}
add_action( 'wp_head', 'tsd_load_fa' );

/*
 * Change the meta key of the post subtitle to `post_subtitle`
 * for https://wordpress.org/plugins/wp-subtitle/,
 * as JNews uses `post_subtitle` as the meta key.
 * (Issue #50)
 */
function tsd_change_post_subtitle_meta_key() {
    return "post_subtitle";
}
add_filter( 'wps_subtitle_key', 'tsd_change_post_subtitle_meta_key' );

/*
 * Add a Stanford Daily logo to wp-login.php.
 */
function tsd_add_login_logo() { ?>
    <style>
	#login h1 a, .login h1 a {
		display: inline-block;
	}
	#login h1::after, .login h1::after {
		display: inline-block;
		margin-bottom: 25px;
		margin-left: 50px;
		content: "";

		/**background-image: url(wp-admin/images/w-logo-blue.png?ver=20131202);
		background-image: none,url(wp-admin/images/wordpress-logo.svg?ver=20131107);**/
		background-image: url(https://www.stanforddaily.com/wp-content/uploads/2018/05/TSDLogo.jpg);

		height: 84px;
		width: 84px;
		background-size: 84px;
		background-position: center top;
		background-repeat: no-repeat;
		border-radius: 20px;
	}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'tsd_add_login_logo' );
