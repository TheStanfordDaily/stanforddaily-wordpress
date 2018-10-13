<?php

class Pico {

    private static function add_post_id_data_attribute($post)
    {
        return 'data-pico-post-id="' . $post->ID . '""';
    }

    private static function add_title_data_attribute($post)
    {
        return 'data-pico-title="' . get_the_title($post->ID) . '""';
    }

    private static function add_url_data_attribute($post)
    {
        return 'data-pico-url="' . get_permalink($post->ID) . '""';
    }

    private static function add_categories_data_attribute($post)
    {
        $categories = get_the_category($post->ID);

        $category_names = array_map(function ($cat) {
            return $cat->name;
        }, $categories);

        return 'data-pico-categories="' . implode(",", $category_names) . '""';
    }

    private static function add_tags_data_attribute($post)
    {
        $tags = wp_get_post_tags($post->ID);

        $tag_names = array_map(function ($tag) {
            return $tag->name;
        }, $tags);

        return 'data-pico-tags="' . implode(",", $tag_names) . '""';
    }

    public static function add_data_attributes()
    {
        global $post;

        $post_id    = Pico::add_post_id_data_attribute($post);
        $title      = Pico::add_title_data_attribute($post);
        $url        = Pico::add_url_data_attribute($post);
        $categories = Pico::add_categories_data_attribute($post);
        $tags       = Pico::add_tags_data_attribute($post);

        echo "$post_id $title $url $categories $tags";
    }

}
