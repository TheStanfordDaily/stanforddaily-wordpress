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

    function tsd_authors_plugin_get_image_url_from_id($id, $size='thumbnail') {
        if (!empty($id)) {
            return wp_get_attachment_image_src($id, $size)[0];
        }
        return "";
    }

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

        $meta_to_return = [
            "id" => $user->ID,
            "name" => $user->first_name." ".$user->last_name,
            "email" => $user->user_email,
        ];
        foreach ($all_meta_for_user as $key => $value) {
            $shortKey = preg_replace('/^tsd_/', '', $key);
            if (array_key_exists($shortKey, $tsd_author_custom_fields)) {
                if (is_serialized($value)) {
                    // We have to unserialize array if it's serialized (e.g. "a:4:{i:0;s:2:"op";i:1;s:5:"grind";i:2;s:6:"sports";i:3;s:8:"copyedit";}")
                    $value = unserialize($value);
                }
                // If the key ends with `Image`
                if(preg_match('/Image$/', $key)) {
                    $value = tsd_authors_plugin_get_image_url_from_id($value, 'medium');
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
                        $userSectionsAndIDs[$eachSectionName][] = [
                            "id" => $user->ID,
                            "name" => $user->first_name." ".$user->last_name,
                            "profileImage" => tsd_authors_plugin_get_image_url_from_id(get_user_meta($user->ID, "tsd_coverImage", true), 'thumbnail'),
                        ];
                    }
                }
            }
        }
        //print_r($userSectionsAndIDs);

        $results = [];
        foreach ($userSectionsAndIDs as $eachSection => $eachMembers) {
            $thisSectionArray = [];
            $thisSectionArray["name"] = $eachSection;
            $thisSectionArray["members"] = $eachMembers;
            $results[] = $thisSectionArray;
        }
        //print_r($results);
        return $results;

        /*$json = '[
            {"name": "Arts and Life", "members": [
                {"name": "Alex Tsai", "id": 1001790},
                {"name": "Shana Hadi", "id": 1001803}
            ]},
            {"name": "Tech", "members": [
                {"name": "Ashwin Ramaswami", "id": 1001827},
                {"name": "John Doe", "id": 1001714}
            ]}
        ]';

        return json_decode($json, true);*/
    }

    // Issue #51 - Alter the avatar image returned by the get_avatar() function
    // Ref: https://codex.wordpress.org/Plugin_API/Filter_Reference/get_avatar
    function tsd_authors_plugin_custom_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
        // https://wordpress.stackexchange.com/a/214411/75147
        // Properly show Avatars and Gravatars on the options-discussion.php page
        if ( is_admin() ) {
            $screen = get_current_screen();
            if ( is_object( $screen ) && in_array( $screen->id, array( 'dashboard', 'options-discussion' ) ) && ( $default != 'XenForo' ) ) {
                return $avatar;
            }
        }

        $user = false;

        if ( is_numeric( $id_or_email ) ) {
            $id = (int) $id_or_email;
            $user = get_user_by( 'id' , $id );
        } elseif ( is_object( $id_or_email ) ) {
            if ( ! empty( $id_or_email->user_id ) ) {
                $id = (int) $id_or_email->user_id;
                $user = get_user_by( 'id' , $id );
            }
        } else {
            $user = get_user_by( 'email', $id_or_email );
        }

        if ( $user && is_object( $user ) ) {
            $image_id = get_user_meta($user->data->ID, "tsd_profileImage", true);
            if ( ! empty( $image_id ) ) {
                $avatar = tsd_authors_plugin_get_image_url_from_id($image_id, 'thumbnail');
                $avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
            } else {
                // Fallback to default $avatar (i.e. Gravatar).
                // So do nothing.
            }
        }

        return $avatar;
    }
    add_filter( 'get_avatar' , 'tsd_authors_plugin_custom_avatar' , 1 , 5 );

    // Issue #55 - Alter the user description returned by the get_the_author_description() function
    // Ref: https://developer.wordpress.org/reference/hooks/get_the_author_field/
    // Note that this function also alters the value returned by `the_author_meta("description");`,
    // but does NOT alter the value returned by `get_user_meta(..., "description", ...);`.
    function tsd_authors_plugin_custom_user_description( $value, $user_id ) {
        if ( ! empty( $value ) ) {
            // If the user already has the description, do nothing.
            return $value;
        }

        // Return blurb content.
        return get_user_meta( $user_id, "tsd_blurb", true );
    }
    add_filter( 'get_the_author_description' , 'tsd_authors_plugin_custom_user_description' , 1 , 2 );
}
add_action('init', 'tsd_authors_plugin_enable_api');
add_action('init', 'tsd_authors_plugin_add_custom_fields');
