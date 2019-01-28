<?php
/**
* Plugin Name: The Stanford Daily - Locations
* Description: Add locations endpoint onto REST API, which can be consumed by our mobile app.
* Author: The Stanford Daily Tech Team
* Version: 1.0
* History:
* 1.0 (2019-01-21) - Created. (Yifei He)
*/

// Custom WP API endpoint
function tsd_locations_plugin_enable_api() {
    // Ref: https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/

    // Create json-api endpoint
    add_action('rest_api_init', function () {
        // Match "/locations"
        register_rest_route('tsd/v1', '/locations', [
            'methods' => 'GET',
            'callback' => 'tsd_locations_plugin_return_locations',
            'permission_callback' => function (WP_REST_Request $request) {
                return true;
            }
        ]);

        // Match "/locations/locations_search?q="
        register_rest_route('tsd/v1', '/locations_search', [
            'methods' => 'GET',
            'callback' => 'tsd_locations_plugin_return_location_search',
            'permission_callback' => function (WP_REST_Request $request) {
                return true;
            }
        ]);

        // Match "/locations/coordinates/{lat},{long}/{radius}"
        register_rest_route('tsd/v1', '/locations/coordinates/(?P<lat>-?\d+\.\d+),(?P<long>-?\d+\.\d+)/(?P<radius>\d+(\.\d+)?)', [
            'methods' => 'GET',
            'callback' => 'tsd_locations_plugin_return_coordinates_search',
            'permission_callback' => function (WP_REST_Request $request) {
                return true;
            }
        ]);
    });

    function tsd_locations_plugin_get_locations() {
        $locations_string = file_get_contents( __DIR__ . "/locations.json" );
        $locations = json_decode( $locations_string, true );
        //print_r($locations);

        $results = [];
        $count = 0;
        foreach ( $locations as $each_location_key => $each_location_info ) {
            $results_info = $each_location_info;
            $results_info[ "id" ] = $count;
            $results[] = $results_info;
            $count++;
        }

        return $results;
    }

    // Handle the "/locations" with GET request
    function tsd_locations_plugin_return_locations( $request ) {
        if ( empty( $request[ "id" ] ) ) {
            return tsd_locations_plugin_return_locations_list( $request );
        } else {
            return tsd_locations_plugin_return_locations_info( $request );
        }
    }

    // Handle the "/locations" request
    function tsd_locations_plugin_return_locations_list( $request ) {
        $locations = tsd_locations_plugin_get_locations();

        $location_keys = [];
        foreach ( $locations as $each_location_key => $each_location_info ) {
            $results_info = $each_location_info;

            $all_posts = get_posts( [
                'tag' => implode( ",", $each_location_info[ "tag-slug" ] ),
                'numberposts' => -1,
                'fields' => 'ids',  // https://wordpress.stackexchange.com/a/159193/75147
            ] );
            $results_info[ "count" ] = count( $all_posts );

            $location_keys[] = $results_info;
        }
        return $location_keys;
    }

    // Handle the "/locations?id={id}&p={page_number}" request
    function tsd_locations_plugin_return_locations_info( $request ) {
        $locations = tsd_locations_plugin_get_locations();
        $location_key = (int) $request[ "id" ];
        $page_number = 0;
        $number_of_posts_each_page = -1;
        if ( ! empty( $request[ "page" ] ) ) {
            $page_number = $request[ "page" ] - 1;
            $number_of_posts_each_page = 3;
        }

        if ( ! array_key_exists( $location_key, $locations ) ) {
            return new WP_Error( 'no_location', 'Invalid location', ['status' => 404] );
        }

        $location_info = $locations[ $location_key ];
        //print_r($location_info);

        $all_articles = get_posts( [
            'tag' => implode( ",", $location_info[ "tag-slug" ] ),
            'offset' => $page_number * $number_of_posts_each_page,
            'numberposts' => $number_of_posts_each_page
        ] );
        //echo $location_key.count($all_articles)."\n";
        return $all_articles;
    }

    // Handle the "/locations/locations_search?q=" request
    function tsd_locations_plugin_return_location_search( $request ) {
        $search_word = urldecode( $request[ "q" ] );

        $locations = tsd_locations_plugin_get_locations();
        $place_names = [];
        foreach( $locations as $each_location_key => $each_location_info ) {
            $place_names[ $each_location_info["name"] ] = $each_location_key;
            foreach( $each_location_info["aliases"] as $each_alias ) {
                $place_names[ $each_alias ] = $each_location_key;
            }
        }
        //print_r($place_names);

        // https://stackoverflow.com/a/39477606/2603230
        // TODO: Incease accuracy?
        uksort($place_names, function ($a, $b) use ($search_word) {
            similar_text($search_word, $a, $percentA);
            similar_text($search_word, $b, $percentB);

            return $percentA === $percentB ? 0 : ($percentA > $percentB ? -1 : 1);
        });

        $results = [];
        foreach( $place_names as $each_place_name => $each_place_code ) {
            similar_text($search_word, $each_place_name, $match_pertcentage);
            //echo $each_place_name." ".similar_text($search_word, $each_place_name, $match_pertcentage)."\n";
            //echo $each_place_name." ".$match_pertcentage."\n";
            // If it is >40% match.
            if ( $match_pertcentage > 40 ) {
                if ( ! array_key_exists( $each_place_code, $results ) ) {
                    $results[ $each_place_code ] = $locations[ $each_place_code ];
                }
            }
        }
        return $results;
    }


    // https://stackoverflow.com/q/12439801/2603230
    // Return in miles
    function tsd_locations_plugin_get_distance( $latitude1, $longitude1, $latitude2, $longitude2 ) {
        $earth_radius = 6371;

        $dLat = deg2rad( $latitude2 - $latitude1 );
        $dLon = deg2rad( $longitude2 - $longitude1 );

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;

        return $d * 0.621371; // km * 0.621371 = mile
    }

    // Handle the "/locations/coordinates/{lat},{long}/{radius}" request
    function tsd_locations_plugin_return_coordinates_search( $request ) {
        $lat = floatval( $request[ 'lat' ] );
        $long = floatval( $request[ 'long' ] );
        $radius = floatval( $request[ 'radius' ] );

        $locations = tsd_locations_plugin_get_locations();
        $results = [];
        foreach ( $locations as $each_location_key => $each_location_info ) {
            $distance = tsd_locations_plugin_get_distance( $lat, $long, $each_location_info["coordinates"][0], $each_location_info["coordinates"][1] );
            //echo "Distance from ".$lat.", ".$long." to ".$each_location_key." (".$each_location_info["coordinates"][0].",".$each_location_info["coordinates"][1].") is ".$distance." km.\n";
            if ( $distance <= $radius ) {
                $results[ $each_location_key ] = $each_location_info;
                $results[ $each_location_key ][ "distance" ] = $distance;
            }
        }

        // https://stackoverflow.com/q/1597736/2603230
        uasort( $results, function ($a, $b) {
            return $a[ 'distance' ] <=> $b[ 'distance' ];
        });

        return $results;
    }
}
add_action('init', 'tsd_locations_plugin_enable_api');
