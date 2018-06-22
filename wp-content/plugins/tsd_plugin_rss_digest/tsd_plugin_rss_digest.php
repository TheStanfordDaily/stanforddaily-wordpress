<?php
/**
* Plugin Name: TSD RSS Digest
* Description: Makes RSS feeds reflect a "daily digest" that shows only the posts since the last day.
* Author: TSD Tech Team
* Version: 1.0
* History:
* 1.0 (6/22/18) - Created. (Ashwin Ramaswami)
*/

/**
 * Modify the main feed query to show posts from the previous day (after 6 AM).
 *
 * Originally from http://wordpress.stackexchange.com/a/194843/26350
 */
add_action( 'pre_get_posts', function( $q )
{
    if(    $q->is_feed() 
        // && filter_input( INPUT_GET, 'wpse_previous_week', FILTER_SANITIZE_NUMBER_INT ) 
    )
        $q->set( 'date_query', 
            [
                [
                    'after'     => 'yesterday 06:00',
                    'inclusive' => true 
                ]
            ] 
        );
} );