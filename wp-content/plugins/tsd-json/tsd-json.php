<?php
/**
* Plugin Name: The Stanford Daily - JSON
* Description: Add related endpoint onto REST API, which can be consumed by our React app.
* Author: The Stanford Daily Tech Team
* Version: 1.0
* History:
* 1.0 (2019-09-01) - Created. (Yifei He)
*/

// Custom WP API endpoint
function tsd_json_plugin_enable_api() {
    // Ref: https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/

    // Create json-api endpoint
    add_action('rest_api_init', function () {
        // Match "/locations"
        register_rest_route('tsd/v1', '/json/home', [
            'methods' => 'GET',
            'callback' => 'tsd_json_plugin_return_home',
        ]);
    });

    function tsd_json_plugin_query_not_featured_posts( $query ) {
        $featured_category = get_category_by_slug('featured');
        $featured_category_id = $featured_category->term_id;

        $query[ 'category__not_in' ] = [ $featured_category_id ];
        return query_posts( $query );
    }

    function tsd_json_plugin_return_home() {
        $sections = [];
        $sections[ 'featured' ] = query_posts( [ 'category_name' => 'featured', 'posts_per_page' => 3 ] );
        $sections[ 'news' ] = tsd_json_plugin_query_not_featured_posts( [ 'category_name' => 'NEWS', 'posts_per_page' => 4 ] );
        $sections[ 'sports' ] = tsd_json_plugin_query_not_featured_posts( [ 'category_name' => 'SPORTS', 'posts_per_page' => 7 ] );
        $sections[ 'opinions' ] = tsd_json_plugin_query_not_featured_posts( [ 'category_name' => 'opinions', 'posts_per_page' => 4 ] );
        $sections[ 'the_grind' ] = tsd_json_plugin_query_not_featured_posts( [ 'category_name' => 'thegrind', 'posts_per_page' => 4 ] );
        $sections[ 'arts_and_life' ] = tsd_json_plugin_query_not_featured_posts( [ 'category_name' => 'arts-life', 'posts_per_page' => 4 ] );

        $main_posts_id = [];
        foreach ($sections as $section) {
            foreach ($section as $post) {
                $main_posts_id[] = $post->ID;
            }
        }

        $sections[ 'more_from_the_daily' ] = query_posts( [ 'post__not_in' => $main_posts_id, 'posts_per_page' => 20 ] );

        return $sections;
    }
}
add_action('init', 'tsd_json_plugin_enable_api');
