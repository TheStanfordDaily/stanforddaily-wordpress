<?php
/**
 * Plugin Name: Grace's plugin
 * Plugin URI: https://google.com
 * Description: First plugin
 * Version: 0.1
 * Author: Grace
 */

 add_action("the_content", "my_thank_you_text");

 function my_thank_you_text($content) {
     return "<div style='color:red'>" . $content . "</div><h1>Thank you for reading! - Grace</h1>";
 }

 function create_posttype() {
 
    register_post_type( 'movies',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Movies' ),
                'singular_name' => __( 'Movie' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'movies'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

add_action( 'rest_api_init', 'tsd_test_register_testroute' );
function tsd_test_register_testroute() {
    register_rest_route( 'tsd/v1', 'movies', array(
                    'methods' => 'GET',
                    'callback' => 'tsd_test_custom_phrase',
                )
            );
}
function tsd_test_custom_phrase() {
    return rest_ensure_response( 'Hello World! This is my first REST API' );
}
?>