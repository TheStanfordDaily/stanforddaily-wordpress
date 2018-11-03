<?php
/**
* Plugin Name: TSD Authors Plugin
* Description: Add authors endpoint onto REST API, which can be consumed by our mobile app.
* Author: TSD Tech Team
* Version: 1.0
* History:
* 1.0 (11/2/18) - Created. (Ashwin Ramaswami & Yifei He)
*/

// Custom WP API endpoint
function tsd_authors_plugin_enable_api() {
    // Ref: https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/

    // Create json-api endpoint
    add_action('rest_api_init', function () {
        // Match "/author/{id}"
        register_rest_route('tsd_authors/v1', '/author/(?P<id>\d+)', [
            'methods' => 'GET',
            'callback' => 'tsd_authors_plugin_author_info',
            'args' => [
                'id' => [
                    'validate_callback' => function($param, $request, $key) {
                        // Make sure the parameter passed in is always a number
                        return is_numeric( $param );
                    }
                ]
            ],
            'permission_callback' => function (WP_REST_Request $request) {
                return true;
            }
        ]);

        // Match "/authorsList"
        register_rest_route('tsd_authors/v1', '/authorsList', [
            'methods' => 'GET',
            'callback' => 'tsd_authors_plugin_authors_list',
            'permission_callback' => function (WP_REST_Request $request) {
                return true;
            }
        ]);

        // Match "/authorsJSON"
        register_rest_route('tsd_authors/v1', '/authorsJSON', [
            'methods' => 'GET',
            'callback' => 'tsd_authors_plugin_authors_json',
            'permission_callback' => function (WP_REST_Request $request) {
                return true;
            }
        ]);
    });

    // Handle the "/author/{id}" request
    function tsd_authors_plugin_author_info( $request ) {
        // https://wordpress.stackexchange.com/a/180143/75147
        $user = get_userdata( $request['id'] );
        if ( $user === false ) {
            // User ID does not exist
            return new WP_Error( 'no_author', 'Invalid author', array( 'status' => 404 ) );
        }

        // https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/#return-value
        // "After your callback is called, the return value is then converted to JSON, and returned to the client."
        return ["id" => $user->ID, "name" => $user->first_name." ".$user->last_name];
    }

    // Handle the "/authorsList" request
    function tsd_authors_plugin_authors_list( $request ) {
        $users = get_users();

        $userIDs = [];
        foreach ( $users as $user ) {
            $userIDs[] = $user->ID;
        }

        return $userIDs;
    }

    // Handle the "/authorsJSON" request
    // (hardcoded JSON)
    function tsd_authors_plugin_authors_json( $request ) {
        $jsonString = '[
    {
        "fruit": "Apple",
        "size": "Large",
        "color": "Red"
    },
    {
        "fruit": "Orange",
        "size": "Small",
        "color": "Orange"
    }
]';
        // We want to `json_decode` and then return array instead of return string directly because:
        // 1. To make sure the json the valid.
        // 2. To avoid dealing with extra `"`s and `\n`s.
        $json = json_decode($jsonString, true);
        return $json;
    }
}

add_action('init', 'tsd_authors_plugin_enable_api');
