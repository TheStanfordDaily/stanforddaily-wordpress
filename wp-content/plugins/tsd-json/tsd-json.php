<?php
/**
* Plugin Name: The Stanford Daily - JSON
* Description: Add related endpoint onto REST API, which can be consumed by our React app.
* Author: The Stanford Daily Tech Team
* Version: 1.0
* History:
* 1.0 (2019-09-01) - Created. (Yifei He)
*/

// Since 1, 2, 3, 4, 6 are all factors of 12, it is best for the responsive layout.
const MORE_FROM_DAILY_POST_PER_PAGE = 12;
const MORE_FROM_DAILY_INITIAL_NUMBER_OF_PAGES = 3;

// Custom WP API endpoint
function tsd_json_plugin_enable_api() {
    // Ref: https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/

    // Create json-api endpoint
    // NOTE: When this is changed, remember to also update the `tsd-json.json` file
    // in the client with the content on https://www.stanforddaily.com/wp-json/tsd/json/v1/.
    add_action('rest_api_init', function () {
        register_rest_route('tsd/json/v1', '/home', [
            'methods' => 'GET',
            'callback' => 'tsd_json_plugin_return_home',
        ]);

        register_rest_route('tsd/json/v1', '/home/more/(?P<extraPageNumber>\d+)', [
            'methods' => 'GET',
            'callback' => 'tsd_json_plugin_return_home_more',
        ]);

        // Note that we use `postYear`, etc. because `year`, etc. is a reserved word in `WPAPI` in the client side.
        register_rest_route('tsd/json/v1', "/posts/(?P<postYear>\d{4})/(?P<postMonth>\d{2})/(?P<postDay>\d{2})/(?P<postSlug>[\S]+)", [
            'methods' => 'GET',
            'callback' => 'tsd_json_plugin_return_post',
        ]);

        register_rest_route('tsd/json/v1', "/category/(?P<categorySlugs>[\S]+)/(?P<pageNumber>\d+)", [
            'methods' => 'GET',
            'callback' => 'tsd_json_plugin_return_category_posts',
        ]);

        register_rest_route('tsd/json/v1', "/author/(?P<authorSlug>[\w-]+)/(?P<pageNumber>\d+)", [
            'methods' => 'GET',
            'callback' => 'tsd_json_plugin_return_author_posts',
        ]);
    });

    function tsd_json_plugin_query_not_featured_posts( $query ) {
        $featured_category = get_category_by_slug('featured');
        $featured_category_id = $featured_category->term_id;

        $query[ 'category__not_in' ] = [ $featured_category_id ];
        return query_posts( $query );
    }

    // Returns an array of author.
    function tsd_json_plugin_get_author_info( $post ) {
        $author_objects = [];
        if ( function_exists( 'get_coauthors' ) ) {
            $author_objects = get_coauthors( $post->ID );
        } else {
            $author_objects[] = get_user_meta( $post->post_author );
        }

        $authors = [];
        foreach ($author_objects as $author) {
            $authors[] = [
                'id' => $author->ID,
                'displayName' => html_entity_decode( $author->display_name ),
                'userNicename' => $author->user_nicename,
                'url' => wp_make_link_relative( get_author_posts_url( $author->ID ) ),
            ];
        };
        return $authors;
    }

    // Returns a single category info.
    function tsd_json_plugin_get_category_info( $post ) {
        $primary_category_id = get_post_meta( $post->ID, '_yoast_wpseo_primary_category', true );
        $primary_category = null;
        if ( empty( $primary_category_id ) ) {
            $main_categories = [ 'featured', 'NEWS', 'SPORTS', 'opinions', 'thegrind', 'arts-life' ];
            foreach ( $main_categories as $main_category ) {
                if ( in_category( $main_category, $post ) ) {
                    $primary_category = get_category_by_slug( $main_category );
                    break;
                }
            }
            if ( is_null( $primary_category ) ) {
                // If the post is not in any `$main_categories`, simply get the first post category.
                $post_categories = get_the_category( $post->ID );
                if ( count( $post_categories ) > 0 ) {
                    $primary_category = $post_categories[0];
                }
            }
        } else {
            $primary_category = get_category( $primary_category_id );
        }

        if ( ! is_null( $primary_category ) ) {
            return [
                'id' => $primary_category->term_id,
                'name' => html_entity_decode( $primary_category->name ),
                'slug' => $primary_category->slug,
                'url' => wp_make_link_relative( get_category_link( $primary_category ) ),
            ];
        } else {
            return null;
        }
    }

    function tsd_json_plugin_get_processed_posts( $query, $options = [] ) {
        $defaults_options = array(
            'include_post_content' => false,
            'exclude_featured_category' => false,
            'include_category_info_for_each_post' => false,
        );
        $options = wp_parse_args( $options, $defaults_options );

        $post_objects = null;
        if ( $options[ 'exclude_featured_category' ] ) {
            $post_objects = tsd_json_plugin_query_not_featured_posts( $query );
        } else {
            $post_objects = query_posts( $query );
        }

        $posts = [];
        foreach ( $post_objects as $post_object ) {
            $post = tsd_json_plugin_convert_keys_to_camelCase( $post_object->to_array() );
            $post[ 'postTitle' ] = html_entity_decode( apply_filters( 'the_title', $post[ 'postTitle' ] ) );
            $post[ 'postExcerpt' ] = html_entity_decode( $post[ 'postExcerpt' ] );
            if ( ! $options[ 'include_post_content' ] ) {
                unset( $post[ 'postContent' ] );
                unset( $post[ 'postContentFiltered' ] );
            } else {
                // https://codex.wordpress.org/Class_Reference/WP_Post#Accessing_the_WP_Post_Object
                $post[ 'postContent' ] = apply_filters( 'the_content', $post[ 'postContent' ] );
            }

            foreach( $post[ 'tagsInput' ] as $key => $tag ) {
                $post[ 'tagsInput' ][ $key ] = html_entity_decode( $tag );
            }

            $thumbnail_full_url = get_the_post_thumbnail_url( $post_object, 'full' );
            if ( ! empty ( $thumbnail_full_url ) ) {
                $thumbnail_info = [];
                $thumbnail_info_urls = [];
                $thumbnail_info_urls[ 'full' ] = $thumbnail_full_url;
                $thumbnail_info_urls[ 'mediumLarge' ] = get_the_post_thumbnail_url( $post_object, 'medium_large' );
                $thumbnail_info_urls[ 'thumbnail' ] = get_the_post_thumbnail_url( $post_object, 'thumbnail' );
                $thumbnail_info[ 'urls' ] = $thumbnail_info_urls;
                $thumbnail_info[ 'caption' ] = get_the_post_thumbnail_caption( $post_object );

                $thumbnail_id = get_post_thumbnail_id( $post_object );
                $thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                $thumbnail_info[ 'alt' ] = $thumbnail_alt;

                $post[ 'thumbnailInfo' ] = $thumbnail_info;
            }

            if ( function_exists( 'get_the_subtitle' ) ) {
                $post[ 'postSubtitle' ] = html_entity_decode( get_the_subtitle( $post_object, '', '', false ) );
            }

            $post[ 'tsdAuthors' ] = tsd_json_plugin_get_author_info( $post_object );

            if ( $options[ 'include_category_info_for_each_post' ] ) {
                $category_info = tsd_json_plugin_get_category_info( $post_object );
                if ( ! is_null( $category_info ) ) {
                    $post[ 'tsdPrimaryCategory' ] = $category_info;
                }
            }

            $post_date = strtotime( $post_object->post_date );
            $post[ 'tsdUrlParameters' ] = [
                "year" => date('Y', $post_date),
                "month" => date('m', $post_date),
                "day" => date('d', $post_date),
                "slug" => $post_object->post_name,
            ];

            $posts[] = $post;
        }
        return $posts;
    }

    function tsd_json_plugin_get_home_sections() {
        $sections = [];
        $sections[ 'featured' ] = tsd_json_plugin_get_processed_posts( [ 'category_name' => 'featured', 'posts_per_page' => 3 ] );
        $sections[ 'news' ] = tsd_json_plugin_get_processed_posts( [ 'category_name' => 'NEWS', 'posts_per_page' => 4 ], [ 'exclude_featured_category' => true ] );
        $sections[ 'sports' ] = tsd_json_plugin_get_processed_posts( [ 'category_name' => 'SPORTS', 'posts_per_page' => 7 ], [ 'exclude_featured_category' => true ] );
        $sections[ 'opinions' ] = tsd_json_plugin_get_processed_posts( [ 'category_name' => 'opinions', 'posts_per_page' => 4 ], [ 'exclude_featured_category' => true ] );
        $sections[ 'theGrind' ] = tsd_json_plugin_get_processed_posts( [ 'category_name' => 'thegrind', 'posts_per_page' => 4 ], [ 'exclude_featured_category' => true ] );
        $sections[ 'artsAndLife' ] = tsd_json_plugin_get_processed_posts( [ 'category_name' => 'arts-life', 'posts_per_page' => 4 ], [ 'exclude_featured_category' => true ] );
        $sections[ 'sponsored' ] = tsd_json_plugin_get_processed_posts( [ 'category_name' => 'sponsored', 'posts_per_page' => 4 ], [ 'exclude_featured_category' => true ] );
        return $sections;
    }

    function tsd_json_plugin_get_home_more_from_the_daily( $home_sections, $paged = -1 ) {
        $main_posts_id = [];
        foreach ($home_sections as $section) {
            foreach ($section as $post) {
                $main_posts_id[] = $post[ 'id' ];
            }
        }

        $posts_per_page = MORE_FROM_DAILY_POST_PER_PAGE;
        if ( $paged === -1 ) {
            $posts_per_page *= MORE_FROM_DAILY_INITIAL_NUMBER_OF_PAGES;
            $paged = 1;
        } else {
            $paged += MORE_FROM_DAILY_INITIAL_NUMBER_OF_PAGES;
        }

        $more_from_the_daily = tsd_json_plugin_get_processed_posts(
            [
                'post__not_in' => $main_posts_id,
                'posts_per_page' => $posts_per_page,
                'paged' => $paged,
            ],
            [ 'include_category_info_for_each_post' => true ]
        );
        return $more_from_the_daily;
    }

    function tsd_json_plugin_return_home() {
        $sections = tsd_json_plugin_get_home_sections();

        $sections[ 'moreFromTheDaily' ] = tsd_json_plugin_get_home_more_from_the_daily( $sections );

        return $sections;
    }

    function tsd_json_plugin_return_home_more( $request ) {
        $extra_page_number = (int) $request[ "extraPageNumber" ];
        if ( $extra_page_number <= 1 ) {
            return new WP_Error( 'invalid_page_number', 'Extra page number number start from 2.', [ 'status' => 404 ] );
        }

        $home_sections = tsd_json_plugin_get_home_sections();
        $more_from_the_daily = tsd_json_plugin_get_home_more_from_the_daily( $home_sections, $extra_page_number - 1 );

        return $more_from_the_daily;
    }

    function tsd_json_plugin_return_post( $request ) {
        $year = (int) $request[ "postYear" ];
        $month = (int) $request[ "postMonth" ];
        $day = (int) $request[ "postDay" ];
        $slug = (string) $request[ "postSlug" ];

        if ( ! checkdate( $month, $day, $year ) ) {
            return new WP_Error( 'invalid_date', 'The date is invalid.', [ 'status' => 404 ] );
        }

        $posts = tsd_json_plugin_get_processed_posts(
            [
                'year' => $year,
                'monthnum' => $month,
                'day' => $day,
                'name' => $slug,
            ],
            [
                'include_post_content' => true,
                'include_category_info_for_each_post' => true,
            ]
        );
        if ( empty( $posts ) ) {
            return new WP_Error( 'post_not_found', 'This post cannot be found.', [ 'status' => 404 ] );
        }
        if ( count( $posts ) > 1 ) {
            return new WP_Error( 'more_than_one_post_found', 'It returns more than one post!', [ 'status' => 500 ] );
        }

        return $posts[0];
    }

    function tsd_json_plugin_return_category_posts( $request ) {
        $page_number = (int) $request[ "pageNumber" ];
        if ( $page_number <= 0 ) {
            return new WP_Error( 'invalid_page_number', 'Page number start from 1.', [ 'status' => 404 ] );
        }

        $category_slugs = $request[ "categorySlugs" ];

        // https://stackoverflow.com/a/1361752/2603230
        $pos = strrpos($category_slugs, '/');
        $last_category_slug = $pos === false ? $category_slugs : substr($category_slugs, $pos + 1);

        $category = get_category_by_slug( $last_category_slug );
        if ( ! $category ||
            // Make sure this is the correct subcategory
            ("/category/$category_slugs/") !== wp_make_link_relative( get_category_link( $category ) )
        ) {
            return new WP_Error( 'category_not_found', 'Category not found.', [ 'status' => 404 ] );
        }

        $category_posts = tsd_json_plugin_get_processed_posts(
            [
                'cat' => $category->term_id,
                'posts_per_page' => MORE_FROM_DAILY_POST_PER_PAGE,
                'paged' => $page_number,
            ],
        );

        return [
            "meta" => [
                "title" => html_entity_decode( $category->name ),
            ],
            "posts" => $category_posts,
        ];
    }

    function tsd_json_plugin_return_author_posts( $request ) {
        $page_number = (int) $request[ "pageNumber" ];
        if ( $page_number <= 0 ) {
            return new WP_Error( 'invalid_page_number', 'Page number start from 1.', [ 'status' => 404 ] );
        }

        $author_slug = $request[ "authorSlug" ];

        $author = get_user_by( 'slug', $author_slug );
        if ( ! $author ) {
            return new WP_Error( 'author_not_found', 'Author not found.', [ 'status' => 404 ] );
        }

        $author_posts = tsd_json_plugin_get_processed_posts(
            [
                'author' => $author->ID,
                'posts_per_page' => MORE_FROM_DAILY_POST_PER_PAGE,
                'paged' => $page_number,
            ],
            [
                'include_category_info_for_each_post' => true,
            ]
        );

        return [
            "meta" => [
                "name" => html_entity_decode( $author->display_name ),
            ],
            "posts" => $author_posts,
        ];
    }

    // https://stackoverflow.com/a/31275117/2603230
    function tsd_json_plugin_convert_keys_to_camelCase( $input ) {
    $arr = [];
    foreach ( $input as $key => $value ) {
        $key = lcfirst( implode( '', array_map( 'ucfirst', explode( '_', strtolower( $key ) ) ) ) );
        if ( is_array($value) ) {
            $value = tsd_json_plugin_convert_keys_to_camelCase( $value );
        }
        $arr[$key] = $value;
    }
    return $arr;
}
}
add_action('init', 'tsd_json_plugin_enable_api');
