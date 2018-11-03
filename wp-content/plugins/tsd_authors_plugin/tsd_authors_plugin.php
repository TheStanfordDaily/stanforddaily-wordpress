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
        $intUserID = (int) $request['id'];

        // https://wordpress.stackexchange.com/a/180143/75147
        $user = get_userdata( $intUserID );
        if ( $user === false ) {
            // User ID does not exist
            return new WP_Error( 'no_author', 'Invalid author', array( 'status' => 404 ) );
        }

        // https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/#return-value
        // "After your callback is called, the return value is then converted to JSON, and returned to the client."
        return ["id" => $user->ID, "name" => $user->first_name." ".$user->last_name];
    }
}

add_action('init', 'tsd_authors_plugin_enable_api');
