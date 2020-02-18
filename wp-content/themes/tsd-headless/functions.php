<?php
/**
 * Theme for the Postlight Headless WordPress Starter Kit.
 *
 * Read more about this project at:
 * https://postlight.com/trackchanges/introducing-postlights-wordpress-react-starter-kit
 *
 * @package  Postlight_Headless_WP
 */

// Frontend origin.
require_once 'inc/frontend-origin.php';

// ACF commands.
require_once 'inc/class-acf-commands.php';

// Logging functions.
require_once 'inc/log.php';

// CORS handling.
require_once 'inc/cors.php';

// Admin modifications.
require_once 'inc/admin.php';

// Add Menus.
require_once 'inc/menus.php';

// Add Headless Settings area.
require_once 'inc/acf-options.php';

// Add GraphQL resolvers.
require_once 'inc/graphql/resolvers.php';

function tsd_rest_url( $url, $path, $blog_id, $scheme ) {
	// We have to use site_url (WordPress URL) for the REST API
	// else it will call www.stanforddaily.com/wp-json which causes some CORS problems.
    return get_site_url() . substr( $url, strlen( get_home_url() ) );
}
add_filter( 'rest_url', 'tsd_rest_url', 10, 4 );

if ( ! function_exists( 'tsd_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tsd_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-topbar' => esc_html__( 'Top Bar', 'tsd' ),
			'menu-primary' => esc_html__( 'Primary', 'tsd' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'tsd_setup' );

/**
 * Enqueue scripts and styles.
 */
function tsd_scripts() {
	// Nothing yet.
}
add_action( 'wp_enqueue_scripts', 'tsd_scripts' );

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
    if( is_single() && get_the_title() != "sidebar" && get_the_title() != "header" ) {
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