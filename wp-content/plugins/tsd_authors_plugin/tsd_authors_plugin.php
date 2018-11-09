<?php
/**
* Plugin Name: The Stanford Daily Authors Plugin
* Description: Add authors endpoint onto REST API, which can be consumed by our mobile app.
* Author: The Stanford Daily Tech Team
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
        register_rest_route('tsd/v1', '/authors/(?P<id>\d+)', [
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

        // Match "/authors"
        register_rest_route('tsd/v1', '/authors', [
            'methods' => 'GET',
            'callback' => 'tsd_authors_plugin_authors_list',
            'permission_callback' => function (WP_REST_Request $request) {
                return true;
            }
        ]);

    });

    // Handle the "/author/{id}" request
    function tsd_authors_plugin_author_info( $request ) {
        global $tsd_author_custom_fields;
        // https://wordpress.stackexchange.com/a/180143/75147
        $userId = $request['id'];
        $user = get_userdata( $userId );
        if ( $user === false ) {
            // User ID does not exist
            return new WP_Error( 'no_author', 'Invalid author', array( 'status' => 404 ) );
        }

        // https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/#return-value
        // "After your callback is called, the return value is then converted to JSON, and returned to the client."
        $all_meta_for_user = get_user_meta( $userId, null, false );
        $meta_to_return = array("id" => $user->ID, "name" => $user->first_name." ".$user->last_name);
        foreach ($all_meta_for_user as $key => $value) {
            $shortKey = preg_replace('/^tsd_/', '', $key);
            if (array_key_exists( $shortKey, $tsd_author_custom_fields)) {
                $meta_to_return[$shortKey] = $value[0];
            }
        }
        return $meta_to_return;
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
}
include "lib/custom_author_fields.php";
add_action('init', 'tsd_authors_plugin_enable_api');
add_action('init', 'tsd_authors_plugin_add_custom_fields');
