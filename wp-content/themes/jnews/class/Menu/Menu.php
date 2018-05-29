<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Menu;

use JNews\Module\ModuleQuery;

/**
 * Class JNews Menu
 */
Class Menu
{
    /**
     * @var Menu
     */
    private static $instance;

    /**
     * @var array
     *
     * Menu location
     */
    protected $menu_location;

    /**
     * @var MegaMenu
     */
    protected $mega_class;

    /**
     * @return Menu
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        $this->menu_location = array(
            'top_navigation'        => esc_html__('Top Bar Navigation', 'jnews'),
            'navigation'            => esc_html__('Main Navigation', 'jnews'),
            'mobile_navigation'     => esc_html__('Mobile Navigation', 'jnews'),
            'footer_navigation'     => esc_html__('Footer Navigation', 'jnews'),
        );

        $this->mega_class = new MegaMenu();
        $this->setup_hook();
    }


    public function setup_hook()
    {
        add_action( 'after_setup_theme', array($this, 'register_menu') );
    }


    public function register_menu()
    {
        add_theme_support( 'menus' );
        register_nav_menus($this->menu_location);
    }

    public function top_navigation()
    {
        wp_nav_menu(
            array(
                'theme_location'    => 'top_navigation',
                'container'         => 'ul',
                'menu_class'        => 'jeg_menu jeg_top_menu',
                'depth'             => 3,
                'fallback_cb'       => 'jnews_fallback_cb_top_navigation',
                'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
                'echo'              => true
            )
        );
    }

    public function mobile_navigation()
    {
        wp_nav_menu(
            array(
                'theme_location'    => 'mobile_navigation',
                'container'         => 'ul',
                'menu_class'        => 'jeg_mobile_menu',
                'depth'             => 3,
                'fallback_cb'       => 'jnews_fallback_cb_mobile_navigation',
                'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
                'echo'              => true
            )
        );
    }

    public function footer_navigation()
    {
        wp_nav_menu(
            array(
                'theme_location'    => 'footer_navigation',
                'container'         => 'ul',
                'menu_class'        => 'jeg_menu_footer',
                'depth'             => 1,
                'fallback_cb'       => 'jnews_fallback_cb_footer_navigation',
                'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
                'echo'              => true
            )
        );
    }

    public function main_navigation()
    {
        $menu_class = array('jeg_menu', 'jeg_main_menu');

        $menu_class[] = get_theme_mod('jnews_header_menu_style', 'jeg_menu_style_1');

        add_filter('pre_wp_nav_menu', array($this, 'jeg_pre_wp_nav_menu'), null, 2);

        wp_nav_menu(
            array(
                'theme_location'    => 'navigation',
                'container_class'   => 'jeg_nav_item jeg_mainmenu_wrap',
                'menu_class'        => implode(' ', $menu_class),
                'depth'             => 0,
                'fallback_cb'       => 'jnews_fallback_cb_navigation',
                'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
                'echo'              => true
            )
        );

        remove_filter('pre_wp_nav_menu', array($this, 'jeg_pre_wp_nav_menu'), null);
    }

    public function jeg_pre_wp_nav_menu($nav_menu, $args)
    {
        static $menu_id_slugs = array();
        $args->walker = new MenuWalker();

        // Get the nav menu based on the requested menu
        $menu = wp_get_nav_menu_object( $args->menu );

        // Get the nav menu based on the theme_location
        if ( ! $menu && $args->theme_location && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args->theme_location ] ) )
            $menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );

        // get the first menu that has items if we still can't find a menu
        if ( ! $menu && !$args->theme_location ) {
            $menus = wp_get_nav_menus();
            foreach ( $menus as $menu_maybe ) {
                if ( $menu_items = wp_get_nav_menu_items( $menu_maybe->term_id, array( 'update_post_term_cache' => false ) ) ) {
                    $menu = $menu_maybe;
                    break;
                }
            }
        }

        if ( empty( $args->menu ) ) {
            $args->menu = $menu;
        }

        // If the menu exists, get its items.
        if ( $menu && ! is_wp_error($menu) && !isset($menu_items) )
            $menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );

        /*
         * If no menu was found:
         *  - Fall back (if one was specified), or bail.
         *
         * If no menu items were found:
         *  - Fall back, but only if no theme location was specified.
         *  - Otherwise, bail.
         */
        if ( ( !$menu || is_wp_error($menu) || ( isset($menu_items) && empty($menu_items) && !$args->theme_location ) )
            && isset( $args->fallback_cb ) && $args->fallback_cb && is_callable( $args->fallback_cb ) )
            return call_user_func( $args->fallback_cb, (array) $args );

        if ( ! $menu || is_wp_error( $menu ) )
            return false;

        $nav_menu = $items = '';

        $show_container = false;
        if ( $args->container ) {
            /**
             * Filters the list of HTML tags that are valid for use as menu containers.
             *
             * @since 3.0.0
             *
             * @param array $tags The acceptable HTML tags for use as menu containers.
             *                    Default is array containing 'div' and 'nav'.
             */
            $allowed_tags = apply_filters( 'wp_nav_menu_container_allowedtags', array( 'div', 'nav' ) );
            if ( is_string( $args->container ) && in_array( $args->container, $allowed_tags ) ) {
                $show_container = true;
                $class = $args->container_class ? ' class="' . esc_attr( $args->container_class ) . '"' : ' class="menu-'. $menu->slug .'-container"';
                $id = $args->container_id ? ' id="' . esc_attr( $args->container_id ) . '"' : '';
                $nav_menu .= '<'. $args->container . $id . $class . '>';
            }
        }

        // Set up the $menu_item variables
        _wp_menu_item_classes_by_context( $menu_items );

        $sorted_menu_items = $menu_items_with_children = array();
        foreach ( (array) $menu_items as $menu_item ) {
            $sorted_menu_items[ $menu_item->menu_order ] = $menu_item;
            if ( $menu_item->menu_item_parent )
                $menu_items_with_children[ $menu_item->menu_item_parent ] = true;
        }

        // Add the menu-item-has-children class where applicable
        if ( $menu_items_with_children ) {
            foreach ( $sorted_menu_items as &$menu_item ) {
                if ( isset( $menu_items_with_children[ $menu_item->ID ] ) )
                    $menu_item->classes[] = 'menu-item-has-children';
            }
        }

        unset( $menu_items, $menu_item );

        /**
         * Filters the sorted list of menu item objects before generating the menu's HTML.
         *
         * @since 3.1.0
         *
         * @param array  $sorted_menu_items The menu items, sorted by each menu item's menu order.
         * @param object $args              An object containing wp_nav_menu() arguments.
         */
        $sorted_menu_items = apply_filters( 'wp_nav_menu_objects', $sorted_menu_items, $args );

        $items .= walk_nav_menu_tree( $sorted_menu_items, $args->depth, $args );
        unset($sorted_menu_items);

        // Attributes
        if ( ! empty( $args->menu_id ) ) {
            $wrap_id = $args->menu_id;
        } else {
            $wrap_id = 'menu-' . $menu->slug;
            while ( in_array( $wrap_id, $menu_id_slugs ) ) {
                if ( preg_match( '#-(\d+)$#', $wrap_id, $matches ) )
                    $wrap_id = preg_replace('#-(\d+)$#', '-' . ++$matches[1], $wrap_id );
                else
                    $wrap_id = $wrap_id . '-1';
            }
        }
        $menu_id_slugs[] = $wrap_id;

        $wrap_class = $args->menu_class ? $args->menu_class : '';

        /**
         * Filters the HTML list content for navigation menus.
         *
         * @since 3.0.0
         *
         * @see wp_nav_menu()
         *
         * @param string $items The HTML list content for the menu items.
         * @param object $args  An object containing wp_nav_menu() arguments.
         */
        $items = apply_filters( 'wp_nav_menu_items', $items, $args );
        /**
         * Filters the HTML list content for a specific navigation menu.
         *
         * @since 3.0.0
         *
         * @see wp_nav_menu()
         *
         * @param string $items The HTML list content for the menu items.
         * @param object $args  An object containing wp_nav_menu() arguments.
         */
        $items = apply_filters( "wp_nav_menu_{$menu->slug}_items", $items, $args );

        // Don't print any markup if there are no items at this point.
        if ( empty( $items ) )
            return false;

        $nav_menu .= sprintf( $args->items_wrap, esc_attr( $wrap_id ), esc_attr( $wrap_class ), $items );
        unset( $items );

        if ( $show_container )
            $nav_menu .= '</' . $args->container . '>';

        /**
         * Filters the HTML content for navigation menus.
         *
         * @since 3.0.0
         *
         * @see wp_nav_menu()
         *
         * @param string $nav_menu The HTML content for the navigation menu.
         * @param object $args     An object containing wp_nav_menu() arguments.
         */
        $nav_menu = apply_filters( 'wp_nav_menu', $nav_menu, $args );

        return $nav_menu;
    }

    /**
     * @return array
     *
     * get menu location
     */
    public function get_menu_location()
    {
        return $this->menu_location;
    }


    public function mega_menu_category_1_article()
    {
        if(isset($_POST['cat_id']))
        {
            $category = $_POST['cat_id'];

            $article =
                "<div data-cat-id=\"" . esc_attr($category) . "\" data-load-status=\"loaded\" class=\"jeg_newsfeed_container\">
                    <div class=\"newsfeed_carousel owl-carousel with_subcat\">
                        " . Menu::build_article_category_1($category, $_REQUEST['number']) . "
                    </div>
                </div>";

            echo jnews_sanitize_output($article);
        }
        exit;
    }


    public function mega_menu_category_2_article()
    {
        if(isset($_POST['cat_id']))
        {
            $category = $_POST['cat_id'];

            $article =
                "<div data-cat-id=\"" . esc_attr($category) . "\" data-load-status=\"loaded\" class=\"jeg_newsfeed_container\">
                    <div class=\"newsfeed_static  with_subcat\">
                        " . Menu::build_article_category_2($category, $_REQUEST['number']) . "
                    </div>
                </div>";

            echo jnews_sanitize_output($article);
        }
        exit;
    }


    public static function build_article_category_1($category, $number)
    {
        $article_output = '';

        $results = ModuleQuery::do_query(array(
            'post_type'                 => 'post',
            'sort_by'                   => 'latest',
            'post_offset'               => 0,
            'include_category'          => $category,
            'number_post'               => $number,
            'pagination_number_post'    => $number,
        ));

        foreach($results['result'] as $result)
        {
            $thumbnail = apply_filters('jnews_image_lazy_owl', $result->ID, 'jnews-360x180');
            $additional_class = (!has_post_thumbnail( $result->ID )) ? 'no_thumbnail' : '';

            $article_output .=
                "<div class=\"jeg_newsfeed_item {$additional_class}\">
                    <div class=\"jeg_thumb\">
                        " . jnews_edit_post( $result->ID ) . "
                        <a href=\"" . get_the_permalink($result) . "\">" . $thumbnail . "</a>
                    </div>
                    <h3 class=\"jeg_post_title\"><a href=\"" . get_the_permalink($result) . "\">" . get_the_title($result) . "</a></h3>
                </div>";

        }


        return $article_output;
    }

    public static function build_article_category_2($category, $number)
    {
        $article_output = '';

        $results = ModuleQuery::do_query(array(
            'post_type'                 => 'post',
            'sort_by'                   => 'latest',
            'post_offset'               => 0,
            'include_category'          => $category,
            'number_post'               => $number,
            'pagination_number_post'    => $number,
        ));

        foreach($results['result'] as $result)
        {
            $thumbnail = apply_filters('jnews_image_thumbnail', $result->ID, 'jnews-360x180');
            $additional_class = (!has_post_thumbnail( $result->ID )) ? 'no_thumbnail' : '';

            $article_output .=
                "<div class=\"jeg_newsfeed_item {$additional_class}\">
                    <div class=\"jeg_thumb\">
                        " . jnews_edit_post( $result->ID ) . "
                        <a href=\"" . get_the_permalink($result) . "\">" . $thumbnail . "</a>
                    </div>
                    <h3 class=\"jeg_post_title\"><a href=\"" . get_the_permalink($result) . "\">" . get_the_title($result) . "</a></h3>
                </div>";
        }


        return $article_output;
    }
}