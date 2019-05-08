<?php
/**
* Plugin Name: The Stanford Daily - Jobs
* Description: Add jobs endpoint onto REST API, which can be consumed by our jobs site.
* Author: The Stanford Daily Tech Team
* Version: 1.0
* History:
* 1.0 (2019-05-08) - Created. (Ashwin Ramaswami)
*/


function tsd_jobs_plugin_enable_api() {
    $args = array(
      'public'       => true,
      'show_in_rest' => true,
      'rest_base' => 'jobs',
      'label'        => 'Jobs',
      'show_in_menu' => true
    );
    register_post_type( 'job', $args );
}
add_action( 'init', 'tsd_jobs_plugin_enable_api' );