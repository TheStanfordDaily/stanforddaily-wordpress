<?php
/**
 * @author : TSD Tech Team
 */

/**
 * Load parent theme style
 */
add_action( 'wp_enqueue_scripts', 'jnews_child_enqueue_parent_style' );

function jnews_child_enqueue_parent_style()
{
    wp_enqueue_style( 'jnews-parent-style', get_parent_theme_file_uri('/style.css'));
    
}

add_action( 'wp_enqueue_scripts', 'tsd_enqueue_slick' );

function tsd_enqueue_slick()
{
    wp_enqueue_style( 'tsd-slick-style', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_style( 'tsd-slick-style-theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');
    wp_enqueue_script('tsd-slick-script', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'));
}

add_action( 'wp_enqueue_scripts', 'tsd_enqueue_fancybox' );

function tsd_enqueue_fancybox()
{
    wp_enqueue_style( 'tsd-fancybox-style', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css');
    wp_enqueue_script('tsd-fancybox-script', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js', array('jquery'));
}




/*
 * Issue #19 - show co-authors.
 */
function jnews_the_author_link($author = null)
{
    if ( function_exists( 'coauthors_posts_links' ) ) {
        coauthors_posts_links();
    }
    else {
        printf('<a href="%1$s">%2$s</a>',
            esc_url( get_author_posts_url( get_the_author_meta('ID', $author) ) ),
            get_the_author_meta('display_name', $author));
    }
}


function tsd_get_coauthors_link_for_post($post)
{
    if ( function_exists( 'get_coauthors' ) ) {
        $coauthors = get_coauthors($post->ID);
    }
    else {
        $coauthors = array($post->post_author);
    }
    $links = array();
    foreach ($coauthors as $author) {
        array_push($links, coauthors_posts_links_single($author));
    }
    return join(", ", $links);
}


/**
 * Issue #28 - Add a banner to download iOS app
 */
function tsd_add_ios_app_banner()
{
    ?><meta name="apple-itunes-app" content="app-id=1341270063"><?php
}
add_action('wp_head', 'tsd_add_ios_app_banner');

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
 * Add tips and donation widget before every sidebar
 */
function tsd_add_widget_before_sidebar( $name ) 
{
    wp_enqueue_script('tsd-sidebar-script', get_stylesheet_directory_uri() . "/sidebar-tips.js", array('jquery'));
    wp_enqueue_style('tsd-sidebar-styles', get_stylesheet_directory_uri() . "/sidebar-tips.css");
}
add_action( 'wp_enqueue_scripts', 'tsd_add_widget_before_sidebar' );

function tsd_add_widget_content()
{
    ?>
    
    <script type="text/html" id="tsd-donate-header">
    <?php include "donate-header.php"; ?>
    </script>

    <script type="text/html" id="tsd-tips-widget">
    <?php include "tips-widget.php"; ?>
    </script>
    
    <?php
}
add_action('wp_head', 'tsd_add_widget_content');
