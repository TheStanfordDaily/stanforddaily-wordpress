 <?php
/**
 * @author : TSD Tech Team
 */

/**
 * Load parent theme style test
 */
add_action( 'wp_enqueue_scripts', 'jnews_child_enqueue_parent_style' );

function jnews_child_enqueue_parent_style()
{
    wp_enqueue_style( 'jnews-parent-style', get_parent_theme_file_uri('/style.css'));
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

/**
 * Style of blockquotes inserted within article.
 */
function tsd_blockquote_function($atts, $content = null) {

    $atts = shortcode_atts( array(
        'width' => '200px',
        'padding-bottom' => '10px',
        'padding-right' => '10px',
        'float' => 'left',
        'font-size' => '30px',
    ), $atts);

    $return .= '<div><div style="width: ' . $atts['width'] . '; padding-bottom: ' .$atts['padding-bottom'] . '; 
    float: ' . $atts['float'] . '; padding-right: ' .$atts['padding-right'] .';
    font-size: ' . $atts['font-size'] .';">' .do_shortcode($content) .'</div></div>';

    return $return;
}
add_shortcode('tsd_blockquote', 'tsd_blockquote_function');