<?php
// Custom WP API endpoint
function tsd_push_notification_enable_api() {
    // Ref: https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/

    // Create json-api endpoint
    add_action('rest_api_init', function () {
        // Match "/push-notification/update-user"
        register_rest_route('tsd/v1', '/push-notification/update-user', [
            'methods' => 'POST',
            'callback' => 'tsd_push_notification_update_user',
            'permission_callback' => function (WP_REST_Request $request) {
                return true;
            }
        ]);
    });

    function tsd_push_notification_update_user( $request ) {
        $user_token = $request[ "token" ][ "value" ];

        $this_user = get_posts( [
            'post_type' => 'tsd_pn_receiver',
            'name' => $user_token,
        ] );
        if ( empty( $this_user ) ) {
            tsd_create_new_pn_receiver( $user_token );
        } else if ( count( $this_user ) == 1 ) {
            tsd_create_update_pn_receiver( $this_user[0]->ID, [], [], [] );
        } else {
            echo "WARNING: SHOULD NOT HAVE MORE THAN 1 POST WITH SAME NAME";
        }

        // TODO: return success / error message
        return [];
    }

    function tsd_create_new_pn_receiver( $token, $category_ids = [], $author_ids = [], $location_ids = [] ) {
        // insert the post and set the category
        $post_id = wp_insert_post([
            'post_type' => 'tsd_pn_receiver',
            'post_title' => $token,
            'post_status' => "publish",
            'meta_input' => [
                "category_ids" => json_encode( $category_ids ),
                "author_ids" => json_encode( $author_ids ),
                "location_ids" => json_encode( $location_ids ),
            ]
        ]);
    }

    function tsd_create_update_pn_receiver( $post_id, $category_ids, $author_ids, $location_ids ) {
        update_post_meta( $post_id, 'category_ids', json_encode( $category_ids ) );
        update_post_meta( $post_id, 'author_ids', json_encode( $author_ids ) );
        update_post_meta( $post_id, 'location_ids', json_encode( $location_ids ) );
    }
}
add_action('init', 'tsd_push_notification_enable_api');
