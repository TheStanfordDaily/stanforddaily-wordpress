<?php
/**
* Plugin Name: The Stanford Daily - Jobs
* Description: Add jobs endpoint onto REST API, which can be consumed by our jobs site.
* See http://localhost.stanforddaily.com/wp-json/tsd/v1/jobs
* Author: The Stanford Daily Tech Team
* Version: 1.0
* History:
* 1.0 (2019-05-08) - Created. (Ashwin Ramaswami)
*/
include "inc/tsd-rest-jobs-controller.php";

function tsd_jobs_plugin_enable_api() {
    $args = array(
      'public'       => true,
      'show_in_rest' => true,
      'rest_base' => 'jobs',
      'label'        => 'Jobs',
      'description'  => 'Jobs for Jobs Board',
      'show_in_menu' => true,
      // 'rest_controller_class' => 'TSD_REST_Jobs_Controller',
      'supports' => array('title', 'editor', 'revisions', 'excerpt', 'thumbnail', 'custom-fields')
    );
    register_post_type( 'tsd_job', $args );
}
add_action( 'init', 'tsd_jobs_plugin_enable_api' );

/**
 * Function to register our new routes from the controller.
 */
function tsd_register_jobs_controller() {
	$controller = new TSD_REST_Jobs_Controller("tsd/v1", "jobs", "tsd_job");
	$controller->register_routes();
}

add_action( 'rest_api_init', 'tsd_register_jobs_controller' );