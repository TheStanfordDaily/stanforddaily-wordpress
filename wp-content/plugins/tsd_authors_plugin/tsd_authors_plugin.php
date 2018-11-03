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
    // Create json-api endpoint
    add_action('rest_api_init', function () {
        // Match "/author/{id}"
        register_rest_route('tsd_authors/v1', '/author/(?P<id>\d+)', array (
            'methods'             => 'GET',
            'callback'            => 'tsd_authors_plugin_authors_list',
            'permission_callback' => function (WP_REST_Request $request) {
                return true;
            }
        ));
    });

    // Handle the request
    function tsd_authors_plugin_authors_list($request) {
        return ["id" => (int) $request['id']];
    }
}

add_action('init', 'tsd_authors_plugin_enable_api');
