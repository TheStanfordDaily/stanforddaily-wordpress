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


/**
 * Issue #43 - Register a custom post type called "magazine_issue".
 */
function tsd_add_magazine_issue_post_type() {
    // Ref: https://developer.wordpress.org/reference/functions/register_post_type/#comment-351
    $labels = [
        'name'                  => 'Magazine Issues', // Post type general name
        'singular_name'         => 'Magazine Issue', // Post type singular name
        'menu_name'             => 'Magazine Issues', // Admin Menu text
        'name_admin_bar'        => 'Magazine Issue', // Add New on Toolbar
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Magazine Issue',
        'new_item'              => 'New Magazine Issue',
        'edit_item'             => 'Edit Magazine Issue',
        'view_item'             => 'View Magazine Issue',
        'all_items'             => 'All Magazine Issues',
        'search_items'          => 'Search Magazine Issues',
        'parent_item_colon'     => 'Parent Magazine Issues:',
        'not_found'             => 'No Magazine Issues found.',
        'not_found_in_trash'    => 'No Magazine Issues found in Trash.',
        'featured_image'        => 'Magazine Cover Image', // Overrides the “Featured Image” phrase for this post type. Added in 4.3
        'set_featured_image'    => 'Set cover image', // Overrides the “Set featured image” phrase for this post type. Added in 4.3
        'remove_featured_image' => 'Remove cover image', // Overrides the “Remove featured image” phrase for this post type. Added in 4.3
        'use_featured_image'    => 'Use as cover image', // Overrides the “Use as featured image” phrase for this post type. Added in 4.3
        'archives'              => 'Magazine Issue archives', // The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4
        'insert_into_item'      => 'Insert into Magazine Issue', // Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4
        'uploaded_to_this_item' => 'Uploaded to this Magazine Issue', // Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4
        'filter_items_list'     => 'Filter Magazine Issues list', // Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4
        'items_list_navigation' => 'Magazine Issues list navigation', // Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4
        'items_list'            => 'Magazine Issues list', // Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4
    ];

    $args = [
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => [ 'slug' => 'magazine_issue' ], // TODO: what does this does?
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => [ 'title', 'custom-fields', 'thumbnail' ],
    ];

    register_post_type( 'magazine_issue', $args );
}
add_action( 'init', 'tsd_add_magazine_issue_post_type' );
