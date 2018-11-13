<?php
/**
* Plugin Name: The Stanford Daily Authors Plugin
* Description: Add authors endpoint onto REST API, which can be consumed by our mobile app.
* Author: The Stanford Daily Tech Team
* Version: 1.0
* History:
* 1.0 (11/2/18) - Created. (Ashwin Ramaswami & Yifei He)
*/

include "lib/custom_author_fields.php";

// Custom WP API endpoint
function tsd_authors_plugin_enable_api() {
    // Ref: https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/

    // Create json-api endpoint
    add_action('rest_api_init', function () {
        // Match "/authors/{id}"
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

    // Handle the "/authors/{id}" request
    function tsd_authors_plugin_author_info( $request ) {
        global $tsd_author_custom_fields;
        // https://wordpress.stackexchange.com/a/180143/75147
        $userId = $request['id'];
        $user = get_userdata( $userId );
        if ( $user === false ) {
            // User ID does not exist
            return new WP_Error( 'no_author', 'Invalid author', ['status' => 404] );
        }

        // https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/#return-value
        // "After your callback is called, the return value is then converted to JSON, and returned to the client."

        // https://codex.wordpress.org/Function_Reference/get_user_meta
        // "To avoid this, you may want to run a simple array_map() on the results of get_user_meta() in order to take only the first index of each result (this emulating what the $single argument does when $key is provided:"
        $all_meta_for_user = array_map( function( $a ){ return $a[0]; }, get_user_meta( $userId, null ) );
        $meta_to_return = ["id" => $user->ID, "name" => $user->first_name." ".$user->last_name];
        foreach ($all_meta_for_user as $key => $value) {
            $shortKey = preg_replace('/^tsd_/', '', $key);
            if (array_key_exists($shortKey, $tsd_author_custom_fields)) {
                if (is_serialized($value)) {
                    // We have to unserialize array if it's serialized (e.g. "a:4:{i:0;s:2:"op";i:1;s:5:"grind";i:2;s:6:"sports";i:3;s:8:"copyedit";}")
                    $value = unserialize($value);
                }
                $meta_to_return[$shortKey] = $value;
            }
        }
        return $meta_to_return;
    }

    // Handle the "/authors" request
    function tsd_authors_plugin_authors_list( $request ) {
        global $theDailySections;
        $userSectionsAndIDs = [];
        // https://wordpress.stackexchange.com/q/10881/75147
        $user_query = new WP_User_Query([
            'meta_key' => 'tsd_section',
            'meta_value' => [''],
            'meta_compare' => 'NOT IN'
        ]);
        if (!empty( $user_query->get_results())) {
            foreach($user_query->get_results() as $user) {
                $thisUserSections = get_user_meta($user->ID, "tsd_section", true);
                if (!empty($thisUserSections)){
                    foreach ($thisUserSections as $eachSection) {
                        $eachSectionName = $theDailySections[$eachSection];
                        $userSectionsAndIDs[$eachSectionName][$user->ID] = $user->first_name." ".$user->last_name;
                    }
                }
            }
        }
        //print_r($userSectionsAndIDs);

        $results = [];
        foreach ($userSectionsAndIDs as $eachSection => $eachIDs) {
            $thisSectionArray = [];
            $thisSectionArray["name"] = $eachSection;
            foreach ($eachIDs as $eachID => $eachName) {
                $thisMemberInfo = [];
                $thisMemberInfo["id"] = $eachID;
                $thisMemberInfo["name"] = $eachName;
                $thisSectionArray["members"][] = $thisMemberInfo;
            }
            $results[] = $thisSectionArray;
        }
        //print_r($results);
        return $results;

        $json = '[
            {"name": "Arts and Life", "members": [
                {"name": "Alex Tsai", "id": 1001790},
                {"name": "Shana Hadi", "id": 1001803}
            ]},
            {"name": "Tech", "members": [
                {"name": "Ashwin Ramaswami", "id": 1001827},
                {"name": "John Doe", "id": 1001714}
            ]}
        ]';

        return json_decode($json, true);
    }
}
add_action('init', 'tsd_authors_plugin_enable_api');
add_action('init', 'tsd_authors_plugin_add_custom_fields');
