<?php

class Pico_Widget {

    private static $raven_nonce;

    public static function init() {
        if (Pico_Setup::get_publisher_id(false) !== null) {
            self::$raven_nonce = wp_create_nonce('pico_raven_nonce');
            // until i can more thoroughly test this, i'd like to table this for now -RC
            // Pico_Sentry::get_instance(self::$raven_nonce);
            add_action('wp', array('Pico_Widget', 'do_widget'), 11);
        }
    }

    public static function verify_tags_are_where_they_should_be() {
        if (Pico_Setup::get_publisher_id(false) !== null) {

            if (!did_action(array('Pico_Widget', 'load_empty_widget_container'))) {
                Pico_Widget::load_empty_widget_container();
            }

            if (!did_action(array('Pico_Widget', 'load_info_for_widget'))) {
                Pico_Widget::load_info_for_widget();
            }

            if (!is_singular()) {
                // If not, just add the <pico> tag at the end so we can load the widget without cutting off content
                if (!did_action(array('Pico_Widget', 'load_empty_pico_tag'))) {
                    Pico_Widget::load_empty_pico_tag();
                }
            }
        }
    }

    public static function do_widget() {
        add_action('wp_footer', array('Pico_Widget', 'load_empty_widget_container'));
        add_action('wp_enqueue_scripts', array('Pico_Widget', 'load_info_for_widget'));

        // If this is a post, page, or any other kind of custom content type, run it through the filter to cut off content
        if (is_singular()) {
            add_filter('the_content', array('Pico_Widget', 'filter_content'));
        } else {
            // If not, just add the <pico> tag at the end so we can load the widget without cutting off content
            add_action('wp_footer', array('Pico_Widget', 'load_empty_pico_tag'));
        }
    }

    public static function load_empty_pico_tag() {
        echo '<div id="pico"></div>';
    }

    public static function load_empty_widget_container() {
        echo "<div id='pico-widget-container'></div>";
    }

    public static function filter_content($content) {
        return '<div id="pico">' . $content . '</div>';
    }

    public static function get_list_of_taxonomies() {
        $taxonomies         = get_taxonomies();
        $list_of_taxonomies = [];
        foreach ($taxonomies as $key) {
            array_push($list_of_taxonomies, $key);
        }
        return $list_of_taxonomies;
    }

    public static function load_info_for_widget() {
        $api_endpoint       = Pico_Setup::get_api_endpoint();
        $widget_endpoint    = Pico_Setup::get_widget_endpoint();
        $publisher_id       = Pico_Setup::get_publisher_id(false);
        $widget_version     = Pico_Setup::get_widget_version_info();
        $wordpress_rest_url = esc_url_raw(rest_url());
        global $wp_version;
        $active_plugins  = get_option('active_plugins');
        $list_of_plugins = [];
        foreach ($active_plugins as $key => $value) {
            array_push($list_of_plugins, explode('/', $value)[0]);
        }
        // raven script is a dependency
        wp_register_script('read-more.js', plugin_dir_url(__FILE__) . 'js/read-more.js', [], $widget_version);
        wp_localize_script('read-more.js', 'pp_vars',
            array_merge(
                array(
                    'publisher_id'    => $publisher_id,
                    'widget_endpoint' => $widget_endpoint,
                    'api_endpoint'    => $api_endpoint,
                    'verify_endpoint' => $wordpress_rest_url,
                    'wp_version'      => $wp_version,
                    'plugin_version'  => PICO_VERSION,
                    'raven_nonce'     => self::$raven_nonce,
                    'root'            => $wordpress_rest_url,
                    'active_plugins'  => $list_of_plugins,
                    'widget_version'  => str_replace('"', "", $widget_version),
                ), self::get_current_view_info()
            )
        );
        wp_enqueue_script('read-more.js');
    }

    /**
     * Handles all of the post info that needs to be
     * returned for the loader to use
     * @return [array]
     */
    public static function get_current_view_info() {
        global $wp;
        $queried_object            = get_queried_object();
        $post_info                 = array();
        $taxonomies                = get_taxonomies();
        $list_of_taxonomies        = self::get_list_of_taxonomies();

        if (is_home() || is_front_page()) {
            // this should prevent us from evaluating the post type
            // to be a page when a static page is set as a home page
            // because it is evaluated before is_singular()
            // more info: https://codex.wordpress.org/Conditional_Tags#The_Blog_Page
            $post_info['post_type']             = 'home';
            $post_info['post_id']               = null;
            $post_info['show_read_more_button'] = false;
        } elseif (is_singular()) {
            // is singular can refer to either a post, page, or custom content type
            $post_info['post_id']                       = $queried_object->ID;
            $post_info['post_type']                     = $queried_object->post_type;
            $post_info['post_title']                    = $queried_object->post_title;
            $post_info['taxonomies_for_this_post_type'] = get_object_taxonomies($queried_object->post_type);
            $post_info['taxonomies']                    = $list_of_taxonomies;
            $post_info['show_read_more_button']         = true;
            if (function_exists('tribe_is_event_query') && tribe_is_event_query()) {
                $post_info['show_read_more_button']         = false;
            } else {
                $post_info['show_read_more_button']         = true;
            }

            // this is assuming their more tag is unmodified
            if (check_to_see_if_more_tag_is_set($queried_object)) {
                $post_info['break_selector'] = 'more-' . $queried_object->ID;
            }

            // tags and categories
            $categories_array = array();
            $tags_array       = array();

            // for babe, there is members_posts_categories
            // and members_posts_tags instead of category and tags (when post type = members_posts)

            // check to see if this post type has the default category taxonomy
            if (in_array('category', $post_info['taxonomies_for_this_post_type'])) {
                $categories = wp_get_post_categories($queried_object->ID);
                if ($categories) {
                    $post_info['categories'] = self::get_categories_array($categories);
                }
            } elseif (in_array('members_posts_categories', $post_info['taxonomies_for_this_post_type'])) {
                // if not, check to see if it has members_posts_categories,
                // and treat those like categories if so
                $categories = get_the_terms($queried_object->ID, 'members_posts_categories');
                if ($categories) {
                    $post_info['categories'] = self::get_categories_array($categories);
                }
            } elseif (in_array('tribe_events_cat', $post_info['taxonomies_for_this_post_type'])) {
                // if not, check to see if it has tribe_events_cat,
                // and treat those like categories if so
                $categories = get_the_terms($queried_object->ID, 'tribe_events_cat');
                if ($categories) {
                    $post_info['categories'] = self::get_categories_array($categories);
                }
                // when it's a tribe_event (hacky workaround for edible), don't clip
                $post_info['show_read_more_button'] = false;
            }

            // check to see if this post type has the default tag taxonomy
            if (in_array('post_tag', $post_info['taxonomies_for_this_post_type'])) {
                $tags = get_the_tags();
                if ($tags) {
                    $post_info['tags'] = self::get_tags_array($tags);
                }
            } elseif (in_array('members_posts_tags', $post_info['taxonomies_for_this_post_type'])) {
                // if not, check to see if it has members_posts_tags,
                // and treat those like tags if so
                $tags = get_the_terms($queried_object->ID, 'members_posts_tags');
                if ($tags) {
                    $post_info['tags'] = self::get_tags_array($tags);
                }
            }
        } elseif (is_author()) {
            $post_info['post_type']             = 'author';
            $post_info['post_id']               = $queried_object->ID;
            $post_info['show_read_more_button'] = false;
        } elseif (is_category()) {
            $post_info['post_type']             = 'category';
            $post_info['post_id']               = $queried_object->term_id;
            $post_info['show_read_more_button'] = false;
        } elseif (is_tag()) {
            $post_info['post_type']             = 'tag';
            $post_info['post_id']               = $queried_object->term_id;
            $post_info['show_read_more_button'] = false;
        } elseif (is_tax()) {
            $post_info['post_type']             = 'tax';
            $post_info['post_id']               = $queried_object->term_id;
            $post_info['show_read_more_button'] = false;
        } elseif (is_search()) {
            $post_info['post_type']             = 'search';
            $post_info['post_id']               = null;
            $post_info['show_read_more_button'] = false;
        } elseif (is_date()) {
            $post_info['post_type']             = 'date';
            $post_info['post_id']               = null;
            $post_info['show_read_more_button'] = false;
        } elseif (is_404()) {
            $post_info['post_type']             = '404';
            $post_info['post_id']               = null;
            $post_info['show_read_more_button'] = false;
        } else {
            // hopefully I've accounted for every scenario
            $post_info['post_type']             = 'unknown';
            $post_info['post_id']               = null;
            $post_info['show_read_more_button'] = false;
        }

        $post_info['resource_ref'] = $wp->query_string;

        return $post_info;
    }

    public static function get_categories_array($categories) {
        $categories_array = array();
        foreach ($categories as $category) {
            array_push($categories_array, self::get_hierarchical_taxonomy_names($category)[0]);
        }
        return json_encode($categories_array);
    }

    public static function get_tags_array($tags) {
        $tags_array = array();
        foreach ($tags as $tag) {
            array_push($tags_array, strtolower($tag->name));
        }
        return json_encode($tags_array);
    }

    public static function get_hierarchical_taxonomy_names($category) {
        $categories_array = array();
        $cat_ids          = array();
        $cat_id           = $category;
        do {
            $cat = get_category($cat_id);
            if (!empty($cat)) {
                if ($cat->cat_ID && !in_array($cat->cat_ID, $cat_ids)) {
                    array_push($categories_array, strtolower($cat->name));
                }
                $cat_id = !empty($cat->category_parent) ? $cat->category_parent : null;
            }
        } while ($cat_id);
        return $categories_array;
    }
}
