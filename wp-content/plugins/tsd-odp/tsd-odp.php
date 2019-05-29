<?php
/*
* Plugin Name: ODP Plugin
* Plugin URI: stanforddaily.com
* Description: Plugin for the Stanford Open Data Portal
* Version: 0.1
* Author: Emily Wen and Cathy Zhang
*/

function tsd_odp_create_posttype() {
    register_post_type( 'odp_datasets',
            array(
                'labels' => array(
                    'name' => __( 'Datasets' ),
                    'singular_name' => __( 'Dataset' )
                ),
                'taxonomies'  => array( 'tsd_dataset_category' ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'datsets'),
                'supports' => array( 'title', 'editor', 'custom-fields' )
            )
        );
    }
/*
function tsd_odp_add_dataset($request) {
    $params = $request->get_params();
    return rest_ensure_response( array("name" => $params["name"]) );
}
*/

// Hooking up our function to theme setup
add_action( 'init', 'tsd_odp_create_posttype' );

?>