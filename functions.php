<?php

$themename = "Sahifa";
$themefolder = "sahifa";

define ('theme_name', $themename );
define ('theme_ver' , 4 );

// Notifier Info
$notifier_name = $themename;
$notifier_url = "http://themes.tielabs.com/xml/".$themefolder.".xml";

//Docs Url
$docs_url = "http://themes.tielabs.com/docs/".$themefolder;

// Constants for the theme name, folder and remote XML url
define( 'MTHEME_NOTIFIER_THEME_NAME', $themename );
define( 'MTHEME_NOTIFIER_THEME_FOLDER_NAME', $themefolder );
define( 'MTHEME_NOTIFIER_XML_FILE', $notifier_url );
define( 'MTHEME_NOTIFIER_CACHE_INTERVAL', 43200 );

// WooCommerce
define('WOOCOMMERCE_USE_CSS', false);
add_action('woocommerce_before_main_content', 'tie_woocommerce_wrapper_start', 22);
function tie_woocommerce_wrapper_start() {
	echo '<div class="post-listing"><div class="post-inner">';
}
add_action('woocommerce_after_main_content', 'tie_woocommerce_wrapper_start2', 11);
function tie_woocommerce_wrapper_start2() {
  echo '</div></div>';
}
add_action('woocommerce_before_shop_loop', 'tie_woocommerce_wrapper_start3', 33);
function tie_woocommerce_wrapper_start3() {
  echo '<div class="clear"></div>';
}


global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' )
	add_action( 'init', 'tie_woocommerce_image_dimensions', 1 );

function tie_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '400',	// px
		'height'	=> '400',	// px
		'crop'		=> 1 		// true
	);
 
	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 1 		// true
	);
 
	$thumbnail = array(
		'width' 	=> '200',	// px
		'height'	=> '200',	// px
		'crop'		=> 1 		// false
	);
 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}


// Custom Functions 
include (TEMPLATEPATH . '/custom-functions.php');

// Get Functions
include (TEMPLATEPATH . '/functions/home-cats.php');
include (TEMPLATEPATH . '/functions/home-cat-tabs.php');
include (TEMPLATEPATH . '/functions/home-cat-scroll.php');
include (TEMPLATEPATH . '/functions/home-cat-pic.php');
include (TEMPLATEPATH . '/functions/home-cat-videos.php');
include (TEMPLATEPATH . '/functions/home-recent-box.php');
include (TEMPLATEPATH . '/functions/theme-functions.php');
include (TEMPLATEPATH . '/functions/common-scripts.php');
include (TEMPLATEPATH . '/functions/banners.php');
include (TEMPLATEPATH . '/functions/widgetize-theme.php');
include (TEMPLATEPATH . '/functions/default-options.php');
include (TEMPLATEPATH . '/functions/updates.php');

include (TEMPLATEPATH . '/includes/pagenavi.php');
include (TEMPLATEPATH . '/includes/breadcrumbs.php');
include (TEMPLATEPATH . '/includes/wp_list_comments.php');
include (TEMPLATEPATH . '/includes/widgets.php');

// tie-Panel
include (TEMPLATEPATH . '/panel/shortcodes/shortcode.php');
if (is_admin()) {
	include (TEMPLATEPATH . '/panel/mpanel-ui.php');
	include (TEMPLATEPATH . '/panel/mpanel-functions.php');
	include (TEMPLATEPATH . '/panel/category-options.php');
	include (TEMPLATEPATH . '/panel/post-options.php');
	include (TEMPLATEPATH . '/panel/custom-slider.php');
	include (TEMPLATEPATH . '/panel/notifier/update-notifier.php');
	include (TEMPLATEPATH . '/panel/importer/tie-importer.php');
}


/*-----------------------------------------------------------------------------------*/
# Custom Admin Bar Menus
/*-----------------------------------------------------------------------------------*/
function tie_admin_bar() {
	global $wp_admin_bar;
	
	if ( current_user_can( 'switch_themes' ) ){
		$wp_admin_bar->add_menu( array(
			'parent' => 0,
			'id' => 'mpanel_page',
			'title' => theme_name ,
			'href' => admin_url( 'admin.php?page=panel')
		) );
	}
	
}
add_action( 'wp_before_admin_bar_render', 'tie_admin_bar' );

if ( ! isset( $content_width ) ) $content_width = 618;


// with activate istall option
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {

	if( !get_option('tie_active') ){
		tie_save_settings( $default_data );
		update_option( 'tie_active' , theme_ver );
	}
   //header("Location: admin.php?page=panel");
}

add_action( 'import_done', 'wordpress_importer_init' );



//Adding header "sidebar"
function header_widgets_init() {
	if (function_exists('register_sidebar')) {
	     register_sidebar(array(
	      'name' => 'Header Widgets',
	      'id'   => 'header-widgets',
	      'description'   => 'Header Sidebar Area',
	      'before_widget' => '<div>',
	      'after_widget'  => '</div>',
	      'before_title'  => '<h2>',
	      'after_title'   => '</h2>'
	     ));
	}
}

add_action('widgets_init', 'header_widgets_init');

//Adding "sidebar" for widgets at top of frontpage
function frontpage_top_widgets_init() {
	if (function_exists('register_sidebar')) {
	     register_sidebar(array(
	      'name' => 'Frontpage Top Widgets',
	      'id'   => 'frontpage-top-widgets',
	      'description'   => 'Frontpage Top Widgets Area (right below slider)',
	      'before_widget' => '<section class="cat-box list-box">',
	      'after_widget'  => '</div></section>',
	      'before_title'  => '<div class="cat-box-title"><h2>',
	      'after_title'   => '</h2><div class="stripe-line"></div></div>
						<div class="cat-box-content">'
	     ));
	}
}

add_action('widgets_init', 'frontpage_top_widgets_init');

//Adding "sidebar" for widgets at bottom of frontpage
function frontpage_bottom_widgets_init() {
	if (function_exists('register_sidebar')) {
	     register_sidebar(array(
	      'name' => 'Frontpage Bottom Widgets',
	      'id'   => 'frontpage-bottom-widgets',
	      'description'   => 'Frontpage Bottom Widgets Area (right below category boxes)',
	      'before_widget' => '<section class="cat-box list-box">',
	      'after_widget'  => '</div></section>',
	      'before_title'  => '<div class="cat-box-title"><h2>',
	      'after_title'   => '</h2><div class="stripe-line"></div></div>
						<div class="cat-box-content">'
	     ));
	}
}

add_action('widgets_init', 'frontpage_bottom_widgets_init');

?>

<?php
	// Create a new filtering function that will add our where clause to the query
	function filter_where( $where = '' ) {
	    // posts in the last 15 days
	    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-15 days')) . "'";
	    return $where;
	}

	add_filter( 'posts_where', 'filter_where' );
	global $last_15_days_posts;
	$args = array(
		'numberposts' => '-1',
		'no_found_rows' => '1',
		'suppress_filters' => '0',
		'post_type' => array('post', 'tie_slider')
	);

	$last_15_days_posts = get_posts($args);
	remove_filter( 'posts_where', 'filter_where' );

	global $last_15_days_categories;
	$last_15_days_categories = array();
?>

<?php /* Creating new user title option */

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
	<h3><?php _e("Extra profile information", "blank"); ?></h3>

	<table class="form-table">
	<tr>
	<th><label for="position"><?php _e("Position"); ?></label></th>
	<td>
	<input type="text" name="position" id="position" value="<?php echo esc_attr( get_the_author_meta( 'position', $user->ID ) ); ?>" class="regular-text" /><br />
	<span class="description"><?php _e("Position (will be displayed on articles next to author name)"); ?></span>
	</td>
	</tr>
	</table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

	update_user_meta( $user_id, 'position', $_POST['position'] );
}


function validate_gravatar($email) {
	// Craft a potential url and test its headers
	$hash = md5(strtolower(trim($email)));
	$uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
	$headers = @get_headers($uri);
	if (!preg_match("|200|", $headers[0])) {
		$has_valid_avatar = FALSE;
	} else {
		$has_valid_avatar = TRUE;
	}
	return $has_valid_avatar;
}

/* Prevent feed from including email digest post or job postings */
function myFeedExcluder($query) {
 if ($query->is_feed) {
   $query->set('cat','-27387,-28728');
 }
return $query;
}
 
add_filter('pre_get_posts','myFeedExcluder');

/* Prevent search results from including custom post types */
function searchfilter($query) {
    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('post','page'));
    }

return $query;
}

add_filter('pre_get_posts','searchfilter');

include (TEMPLATEPATH . '/magazine/magazinePostType.php');


?>
