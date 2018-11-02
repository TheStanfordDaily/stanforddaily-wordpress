<?php
/**
* Plugin Name: TSD Authors Plugin
* Description: Add authors endpoint onto REST API, which can be consumed by our mobile app.
* Author: TSD Tech Team
* Version: 1.0
* History:
* 1.0 (11/2/18) - Created. (Ashwin Ramaswami)
*/

// Custom WP API endpoint
function tsd_authors_plugin_enable_api() {

    // create json-api endpoint

    add_action('rest_api_init', function () {

        // http://example.com/wp-json/random/v2/posts

        register_rest_route('tsd_authors/v1', array (
            'methods'             => 'GET',
            'callback'            => 'tsd_authors_plugin_authors_list',
            'permission_callback' => function (WP_REST_Request $request) {
                return true;
            }
        ));
    });

    // handle the request

    function tsd_authors_plugin_authors_list($request) {
        $data = "{'a': 'b'}";
        return new WP_REST_Response(json_decode($data), 200);
    }

}

add_action('init', 'tsd_authors_plugin_enable_api');