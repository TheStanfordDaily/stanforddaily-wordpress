<?php
/**
 * @author : Jegtheme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Breadcrumb
 */
Class JNews_Breadcrumb
{
    /**
     * @var JNews_Breadcrumb
     */
    private static $instance;

    private $last_link_class = 'breadcrumb_last_link';

    private $json_schema = array();

    /**
     * @return JNews_Breadcrumb
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * @var WP_Post
     */
    private function __construct()
    {
    }

    public function call_breadcrumb()
    {
        $object = get_queried_object();

        if(is_category() || is_tag()) {
            $output = $this->render_category($object->term_id);
        } else if(is_search()){
            $output = $this->render_search();
        } else if(is_author()){
            $output = $this->render_author();
        } else if(is_page()){
            $output = $this->render_page();
        } else if (is_home()) {
            $output = null;
        } else if (is_404()) {
            $output = $this->render_404();
        } else if (is_attachment()) {
            $output = $this->render_attachment();
        } else {
            $output = $this->render($object->ID);
        }

        return $output;
    }

    public function render_404()
    {
        $breadcrumb = array();
        $breadcrumb[] = $this->breadcrumb_text(home_url(), jnews_return_translation('Home','jnews-breadcrumb', 'home'));
        $breadcrumb[] = $this->breadcrumb_text('', jnews_return_translation('Page Not Found', 'jnews-breadcrumb', 'page_not_found'), $this->last_link_class);

        $breadcrumb = implode("<i class=\"fa fa-angle-right\"></i>", $breadcrumb);
        $breadcrumb = "<div id=\"breadcrumbs\">$breadcrumb</div>";

        return apply_filters('jnews_native_breadcrumb_page', $breadcrumb);
    }

    public function render_attachment()
    {
        $breadcrumb = array();
        $breadcrumb[] = $this->breadcrumb_text(home_url(), jnews_return_translation('Home','jnews-breadcrumb', 'home'));

        $attachment = get_post(get_the_ID());
        $parent_id = $attachment->post_parent;

        $category = apply_filters('jnews_get_primary_category_filter', '', $parent_id);

        if($category !== NULL)
        {
            $this->recursive_category($category, $breadcrumb, false);
        }

        $breadcrumb[] = $this->breadcrumb_text(get_the_permalink($parent_id), get_the_title($parent_id), $this->last_link_class);

        $breadcrumb = implode("<i class=\"fa fa-angle-right\"></i>", $breadcrumb);
        $breadcrumb = "<div id=\"breadcrumbs\">$breadcrumb</div>";

        return apply_filters('jnews_native_breadcrumb_page', $breadcrumb);
    }

    public function render_page()
    {
        $breadcrumb = array();
        $breadcrumb[] = $this->breadcrumb_text(home_url(), jnews_return_translation('Home','jnews-breadcrumb', 'home'));
        $breadcrumb[] = $this->breadcrumb_text('', get_the_title(), $this->last_link_class);

        $breadcrumb = implode("<i class=\"fa fa-angle-right\"></i>", $breadcrumb);
        $breadcrumb = "<div id=\"breadcrumbs\">$breadcrumb</div>";

        return apply_filters('jnews_native_breadcrumb_page', $breadcrumb);
    }

    public function render_author()
    {
        $breadcrumb = array();
        $breadcrumb[] = $this->breadcrumb_text(home_url(), jnews_return_translation('Home','jnews-breadcrumb', 'home'));
        $breadcrumb[] = $this->breadcrumb_text('', jnews_return_translation('Author', 'jnews-breadcrumb', 'author'), $this->last_link_class);

        $breadcrumb = implode("<i class=\"fa fa-angle-right\"></i>", $breadcrumb);
        $breadcrumb = "<div id=\"breadcrumbs\">$breadcrumb</div>";

        return apply_filters('jnews_native_breadcrumb_search', $breadcrumb);
    }

    public function render_search()
    {
        $breadcrumb = array();
        $breadcrumb[] = $this->breadcrumb_text(home_url(), jnews_return_translation('Home','jnews-breadcrumb', 'home'));
        $breadcrumb[] = $this->breadcrumb_text('', jnews_return_translation('Search', 'jnews-breadcrumb', 'search'), $this->last_link_class);

        $breadcrumb = implode("<i class=\"fa fa-angle-right\"></i>", $breadcrumb);
        $breadcrumb = "<div id=\"breadcrumbs\">$breadcrumb</div>";

        return apply_filters('jnews_native_breadcrumb_search', $breadcrumb);
    }

    public function breadcrumb_schema()
    {
        return $this->json_schema;
    }

    public function add_schema($url, $title)
    {
        $this->json_schema[] = array(
            'url' => $url,
            'title' => $title
        );
    }

    public function breadcrumb_text($url, $title, $class = null)
    {
        $this->add_schema($url, $title);
        return
            "<span class=\"{$class}\">
                <a href=\"{$url}\">{$title}</a>
            </span>";
    }

    public function render_category($id)
    {
        $breadcrumb = array();
        $breadcrumb[] = $this->breadcrumb_text(home_url(), jnews_return_translation('Home','jnews-breadcrumb', 'home'));

        if(is_category()) {
            $breadcrumb[] = $this->breadcrumb_text('', jnews_return_translation('Category', 'jnews-breadcrumb', 'category'));
        } else if(is_tag()) {
            $breadcrumb[] = $this->breadcrumb_text('', jnews_return_translation('Tag', 'jnews-breadcrumb', 'tag'));
        }

        $this->recursive_category($id, $breadcrumb, true);

        $breadcrumb = implode("<i class=\"fa fa-angle-right\"></i>", $breadcrumb);
        $breadcrumb = "<div id=\"breadcrumbs\">$breadcrumb</div>";

        return apply_filters('jnews_native_breadcrumb_category', $breadcrumb, $id);
    }

    public function render($id)
    {
        $breadcrumb = array();
        $breadcrumb[] = $this->breadcrumb_text(home_url(), jnews_return_translation('Home','jnews-breadcrumb', 'home'));

        $category = apply_filters('jnews_get_primary_category_filter', '', $id);

        if($category !== NULL)
        {
            $this->recursive_category($category, $breadcrumb, true);

            $breadcrumb = implode("<i class=\"fa fa-angle-right\"></i>", $breadcrumb);
            $breadcrumb = "<div id=\"breadcrumbs\">$breadcrumb</div>";

            return apply_filters('jnews_native_breadcrumb', $breadcrumb, $id);
        }

        return null;
    }

    public function recursive_category($category, &$breadcrumb, $islast = false)
    {
        if($category) {
            $cat = get_term($category);
            if($cat->parent) $this->recursive_category($cat->parent, $breadcrumb);

            $class = $islast ? $this->last_link_class : "";
            $breadcrumb[] = $this->breadcrumb_text(get_category_link($cat->term_id), $cat->name, $class);
        }
    }
}

 