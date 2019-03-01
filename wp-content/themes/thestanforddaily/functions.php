<?php
/**
 * The Stanford Daily functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package The_Stanford_Daily
 */

if ( ! function_exists( 'tsd_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tsd_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on The Stanford Daily, use a find and replace
		 * to change 'tsd' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tsd', get_template_directory() . '/languages' );

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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'tsd_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 60,
			'width'       => 500,
			'flex-width'  => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'tsd_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tsd_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'tsd_content_width', 640 );
}
add_action( 'after_setup_theme', 'tsd_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tsd_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'tsd' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'tsd' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tsd_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tsd_scripts() {
	wp_enqueue_style( 'tsd-style', get_stylesheet_uri() );
	// TODO: Use style.min.css in production.
	//wp_enqueue_style( 'tsd-style', get_stylesheet_directory_uri() . "/style.min.css" );
	wp_enqueue_style( 'load-fa', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css' );
	wp_enqueue_style( 'load-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans|Libre+Baskerville:400,400i,700' );
	wp_enqueue_style( 'bootstrap-grid', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap-grid.min.css' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'tsd-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'tsd-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		// We are using Disqus
		//wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tsd_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Feature image sizes.
 */
// For backward compatibility
// TODO: Set our own prefix
$prefix = "jnews-";
/*$image_size = array(
	// dimension : 0.5
	$prefix . '360x180'           => array('width' => 360,  'height' => 180, 'crop' => true , 'dimension' => 500),
	$prefix . '750x375'           => array('width' => 750,  'height' => 375, 'crop' => true , 'dimension' => 500),
	$prefix . '1140x570'          => array('width' => 1140, 'height' => 570, 'crop' => true , 'dimension' => 500),

	// dimension : 0.715
	$prefix . '120x86'            => array('width' => 120,  'height' => 86,  'crop' => true , 'dimension' => 715),
	$prefix . '350x250'           => array('width' => 350,  'height' => 250, 'crop' => true , 'dimension' => 715),
	$prefix . '750x536'           => array('width' => 750,  'height' => 536, 'crop' => true , 'dimension' => 715),
	$prefix . '1140x815'          => array('width' => 1140, 'height' => 815, 'crop' => true , 'dimension' => 715),

	// dimension
	$prefix . '360x504'           => array('width' => 360, 'height' => 504, 'crop' => true , 'dimension' => 1400),

	// dimension 1
	$prefix . '75x75'             => array('width' => 75, 'height' => 75, 'crop' => true , 'dimension' => 1000),

	// featured post
	$prefix . 'featured-750'      => array('width' => 750,  'height' => 0,  'crop' => true , 'dimension' => 1000),
	$prefix . 'featured-1140'     => array('width' => 1140, 'height' => 0,  'crop' => true , 'dimension' => 1000),
);*/

// For post, we only have to use this size
// TODO: Add size for homepage thumbnail
$image_size = [$prefix . '1140x570' => array('width' => 1140, 'height' => 570, 'crop' => true , 'dimension' => 500),];

foreach($image_size as $id => $image) {
	add_image_size( $id, $image['width'], $image['height'], $image['crop'] );
}

// Excerpts have no ellipses ([...]) at the end
add_filter('excerpt_more','__return_false');
