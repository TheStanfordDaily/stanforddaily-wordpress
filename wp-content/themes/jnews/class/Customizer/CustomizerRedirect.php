<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

/**
 * Class JNews Redirect Tag
 */
Class CustomizerRedirect
{
    /**
     * @var CustomizerRedirect
     */
    private static $instance;

    /**
     * @var
     */
    private $post_id;

    /**
     * @var array
     */
    private $redirect_tag = array();

    /**
     * @return CustomizerRedirect
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * construct
     */
    private function __construct()
    {
        add_action( 'wp_enqueue_scripts' , array($this, 'load_script'), 99);
    }


    /**
     * load jnews script
     */
    public function load_script()
    {
        global $wp_query;
        if($wp_query->post)
        {
            $this->post_id = $wp_query->post->ID;
        }

        $this->setup_redirect_tag();
        wp_enqueue_script( 'jnews-customizer-redirect', get_parent_theme_file_uri('assets/js/admin/redirect.customizer.js'), array( 'jquery', 'customize-preview' ), null, true );
        wp_localize_script('jnews-customizer-redirect', 'jnews_redirect', $this->redirect_tag);
    }

    /**
     * Setup redirect tag for customizer
     */
    public function setup_redirect_tag()
    {
        $this->redirect_tag['setting'] = array (
            'change_notice' => wp_kses(__("Change you made not showing on this page.<br/> Do you want to be redirected to the appropriate page to see change you just made?", 'jnews'), wp_kses_allowed_html()),
            'yes' => esc_html__('Yes', 'jnews'),
        );

        $this->redirect_tag['category_tag'] = array(
            'url'       => $this->get_first_category_url(),
            'flag'      => is_category(),
            'text'      => esc_html__('Category Page', 'jnews'),
        );

        $this->redirect_tag['home_tag'] = array(
            'url'       => site_url('/'),
            'flag'      => is_front_page(),
            'text'      => esc_html__('Home Page', 'jnews'),
        );

        $this->redirect_tag['single_post_tag'] = array(
            'url'       => $this->get_random_single_post_url(),
            'flag'      => is_single(),
            'text'      => esc_html__('Single Post', 'jnews'),
        );

        $this->redirect_tag['single_review_tag'] = array(
            'url'       => $this->get_single_review_url(),
            'flag'      => $this->is_review(),
            'text'      => esc_html__('Review Post', 'jnews'),
        );

        $this->redirect_tag['breadcrumb_tag'] = array(
            'url'       => $this->get_single_review_url(),
            'flag'      => $this->is_breadcrumb(),
            'text'      => esc_html__('Single Post', 'jnews'),
        );

        $this->redirect_tag['search_tag'] = array(
            'url'       => $this->get_search_url(),
            'flag'      => is_search(),
            'text'      => esc_html__('Search Post', 'jnews'),
        );

        $this->redirect_tag['archive_tag'] = array(
            'url'       => $this->get_first_archive_url(),
            'flag'      => is_archive(),
            'text'      => esc_html__('Archive Page', 'jnews'),
        );

        $this->redirect_tag['author_tag'] = array(
            'url'       => $this->get_author_url(),
            'flag'      => is_author(),
            'text'      => esc_html__('Author Page', 'jnews'),
        );

        $this->redirect_tag['attachment_tag'] = array(
            'url'       => $this->get_attachment_url(),
            'flag'      => is_attachment(),
            'text'      => esc_html__('Attachment Tag', 'jnews'),
        );

        $this->redirect_tag['404_tag'] = array(
            'url'       => $this->get_404_url(),
            'flag'      => is_404(),
            'text'      => esc_html__('404 Tag', 'jnews'),
        );


        if ( function_exists( 'is_bbpress' ) )
        {
            $this->redirect_tag['bbpress_tag'] = array(
                'url' => $this->get_bbpress_url(),
                'flag' => is_bbpress(),
                'text' => esc_html__('BBPress Tag', 'jnews'),
            );
        }


        if ( function_exists( 'is_woocommerce' ) )
        {
            $this->redirect_tag['woo_archive_tag'] = array(
                'url' => $this->get_woo_archive_url(),
                'flag' => is_shop(),
                'text' => esc_html__('Archive WooCommerce', 'jnews'),
            );

            $this->redirect_tag['woo_single_tag'] = array(
                'url' => $this->get_woo_single_url(),
                'flag' => is_product(),
                'text' => esc_html__('Single WooCommerce', 'jnews'),
            );
        }

        $this->setup_redirect_category();
    }

    public function get_attachment_url()
    {
        $query = new \WP_Query(array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'orderby' => 'rand',
            'numberposts' => 1
        ));

        $permalink = '';

        if ( $query->have_posts() )
        {
            while ( $query->have_posts() )
            {
                $query->the_post();
                $permalink = get_the_permalink(get_the_ID());
            }
        }

        wp_reset_postdata();
        return $permalink;
    }

    public function get_woo_archive_url()
    {
        return get_permalink( wc_get_page_id( 'shop' ) );
    }

    public function get_woo_single_url()
    {
        $permalink = null;
        $query = new \WP_Query(
            array (
                'showposts' => 1,
                'post_type' => 'product',
            )
        );

        if($query->have_posts()) {
            while($query->have_posts()) {
                $query->the_post();
                $permalink = get_the_permalink();
            }
        }
        wp_reset_postdata();

        return $permalink;
    }

    public function get_bbpress_url()
    {
        $page = bbp_get_page_by_path( bbp_get_root_slug() );
        if ( !empty( $page ) ) {
            $root_url = get_permalink( $page->ID );

            // Use the root slug
        } else {
            $root_url = get_post_type_archive_link( bbp_get_forum_post_type() );
        }

        return $root_url;
    }

    public function get_404_url()
    {
        return home_url() . "/404";
    }

    public function get_search_url()
    {
        return home_url() . "/?s=";
    }

    public function get_author_url()
    {
        $user = wp_get_current_user();
        return get_author_posts_url($user->ID);
    }

    public function is_breadcrumb()
    {
        return true;
    }

    public function setup_redirect_category()
    {
        $categories = get_categories(
            array(
                'hide_empty' => false
            )
        );

        foreach($categories as $category)
        {
            $redirect_name  = 'category_tag_' . $category->term_id;
            $redirect_url   = get_category_link($category->term_id);
            $title_text     = esc_html__('Category : ', 'jnews') . $category->name;
            $is_category    = $this->check_on_category($category);

            $this->redirect_tag[$redirect_name] = array(
                'url'       => $redirect_url,
                'flag'      => $is_category,
                'text'      => $title_text
            );
        }
    }

    public function check_on_category($category)
    {
        if( is_category() )
        {
            $term = get_queried_object();

            if($term->term_id === $category->term_id)
            {
                return true;
            }
        }
        return false;
    }

    /**
     * FLAG HELPER
     */

    public function is_review()
    {
        if(is_single()) {
            return jnews_is_review($this->post_id);
        } else {
            return false;
        }
    }

    /**
     * URL HELPER
     */

    public function get_single_review_url()
    {
        $permalink = null;
        $query = new \WP_Query(
            array (
                'showposts' => 1,
                'post_type' => 'post',
                'meta_query'=> array(
                    array(
                        'key' => 'enable_review',
                        'compare' => '==',
                        'value' => 1,
                    )),
            )
        );

        if($query->have_posts()) {
            while($query->have_posts()) {
                $query->the_post();
                $permalink = get_the_permalink();
            }
        } else {
            $permalink = $this->get_random_single_post_url();
        }
        wp_reset_postdata();

        return $permalink;
    }

    public function get_first_category_url()
    {
        $terms = get_terms( array(
            'taxonomy' => 'category',
            'hide_empty' => false,
            'number' => 1,
        ));

        if($terms) {
            return get_term_link($terms[0]->term_id);
        } else {
            return null;
        }
    }

    public function get_first_archive_url()
    {
        $terms = get_terms( array(
            'taxonomy' => 'post_tag',
            'hide_empty' => false,
            'number' => 1,
        ));

        if ( $terms )
        {
            return get_term_link($terms[0]->term_id);
        } else {
            return get_year_link('');
        }

    }

    public function get_random_single_post_url()
    {
        $posts = get_posts('orderby=rand&numberposts=1');

        if($posts) {
            return get_permalink($posts[0]->ID);
        } else {
            return null;
        }
    }
}
