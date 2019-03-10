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
 * Remove ellipses ([...]) at the end of excerpts in the homepage
 */
function custom_excerpt_more( $more ) {
	if ( is_home() ) {
		return false;
	}
	return "&hellip;";
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

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
 * Issue #28 - Add a banner to download iOS app.
 * `app-argument` will be parsed and read in the app.
 */
function tsd_add_ios_app_banner() {
	$currentPageURL = home_url( '/' );
	if ( is_single() ) {
		$currentPageURL = home_url( '/?p=' . get_queried_object_id() );
	} else if ( is_author() ) {
		$currentPageURL = home_url( '/?author=' . get_queried_object_id() );
	}
	?><meta name="apple-itunes-app" content="app-id=1341270063, app-argument=<?php echo $currentPageURL; ?>"><?php
}
add_action( 'wp_head', 'tsd_add_ios_app_banner' );

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
 * Add a Stanford Daily logo and a Stanford background to wp-login.php.
 * https://codex.wordpress.org/Customizing_the_Login_Form
 */
function tsd_add_login_css() { ?>
    <style>
	body {
		background: #f1f1f1 url('<?php echo get_template_directory_uri(); ?>/img/login-background.png') center center no-repeat !important;
		background-size: cover !important;
	}
	body::after {
		content: "(King of Hearts / Wikimedia Commons / CC-BY-SA-3.0)";
		position: absolute;
		right: 10px;
		bottom: 10px;
		color: #f1f1f1;
		opacity: 0.75;
	}
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
add_action( 'login_enqueue_scripts', 'tsd_add_login_css' );

// Add a new default avatar (Tree)
// Note: this will NOT work on localhost.
// https://crunchify.com/how-to-change-default-avatar-in-wordpress/#comment-3851077053
function tsd_custom_default_gravatar( $avatar_defaults ) {
	$customAvatar = get_template_directory_uri() . '/img/placeholder-avatar.png';
	$avatar_defaults[ $customAvatar ] = "Stanford Tree";
	return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'tsd_custom_default_gravatar' );

// https://wordpress.stackexchange.com/a/54988/75147
function tsd_add_lazyload_to_attachment_image( $attr, $attachment ) {
	if ( is_admin() ) {
		// Do not lazyload in wp-admin
		return $attr;
	}

	$attr[ 'class' ] = $attr[ 'class' ] . " lazyload";

	$attr[ 'data-src' ] = $attr[ 'src' ];
	$attr[ 'data-sizes' ] = $attr[ 'sizes' ];
	$attr[ 'data-srcset' ] = $attr[ 'srcset' ];
	$attr[ 'src' ] = "data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==";	// https://stackoverflow.com/a/14115340/2603230
	$attr[ 'sizes' ] = "";
	$attr[ 'srcset' ] = "";

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'tsd_add_lazyload_to_attachment_image', 10, 2 );
