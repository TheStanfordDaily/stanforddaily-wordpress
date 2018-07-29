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


/*
 * Issue #19 - show co-authors.
 */
function jnews_the_author_link($author = null)
{
    if ( function_exists( 'coauthors_posts_links' ) ) {
        return coauthors_posts_links();
    }
    else {
        printf('<a href="%1$s">%2$s</a>',
            esc_url( get_author_posts_url( get_the_author_meta('ID', $author) ) ),
            get_the_author_meta('display_name', $author));
    }
}