<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Sidefeed;

use JNews\Module\ModuleQuery;

/**
 * Class Theme JNews SideFeed
 */
Class Sidefeed
{

    private $attr;

    public function __construct()
    {
        $this->side_feed_query();
    }

    public function can_render()
    {
        return apply_filters('jnews_enable_sidefeed', get_theme_mod('jnews_sidefeed_enable', false));
    }

    public function build_response()
    {
        $data     = $_REQUEST['data'];
        $response = $this->request_ajax( $data );

        wp_send_json( $response );
    }

    public function render_side_feed_tab()
    {
        $latest_active = $this->attr['sort_by'] === 'latest' ? 'active' : '';
        $popular_active = $this->attr['sort_by'] === 'popular_post' ? 'active' : '';

        $output = "<li data-tab-content=\"tab1\" data-sort='latest' class=\"{$latest_active}\">" . jnews_return_translation('Latest', 'jnews', 'latest') . "</li>";

        if(get_theme_mod('jnews_sidefeed_show_trending', false)) :
            $output .= "<li data-tab-content=\"tab2\" data-sort='popular_post' class=\"{$popular_active}\"><i class=\"fa fa-fire\"></i> " . jnews_return_translation('Trending', 'jnews', 'trending') . "</li>";
        endif;

        return $output;
    }

    public function render_side_feed_category_button()
    {
        if(get_theme_mod('jnews_sidefeed_show_category', false)) {
            $output =
                "<div class=\"jeg_cat_dropdown\">" . $this->render_side_feed_list() . "</div>";

            return $output;
        }

        return null;
    }

    public function request_ajax($attr)
    {
        $this->attr = $attr;
        return $this->get_side_feed_content(true);
    }

    public function render_side_feed_list()
    {
        $category_list = '';

        $categories = get_theme_mod('jnews_sidefeed_category', '');

        if ( !empty($categories) && is_array($categories) )
        {
            foreach($categories as $category) {
                $cat = get_category($category);
                if(!$cat instanceof \WP_Error && !is_null($cat)) {
                    $cat_active = ( $this->attr['include_category'] == $cat->term_id ) ? "active" : "";
                    $category_list .= "<li><a class=\"{$cat_active}\" href=\"" . get_category_link($cat) . "\" data-id=\"{$cat->term_id}\">{$cat->name}</a></li>";
                }
            }
        } else {
            return null;
        }

        $all_active = empty($this->attr['include_category']) ? "active" : "";
        $output =
            "<button type=\"button\" class=\"jeg_filter_button\">" . jnews_return_translation('Filter', 'jnews', 'filter') ."</button>
             <ul class=\"jeg_filter_menu\">
                <li><a href=\"#\" class='{$all_active}'>" . jnews_return_translation('All', 'jnews', 'all') ."</a></li>
                {$category_list}
             </ul>";

        return $output;
    }

    public function side_feed_query()
    {
        global $wp_query;

        $this->attr['paged'] = 1;
        $this->attr['post_type'] = 'post';
        $this->attr['exclude_post'] = is_single() ? $wp_query->post->ID : null;;
        $this->attr['include_category'] = '';
        $this->attr['sort_by'] = 'latest';
        $this->attr['post_offset'] = 0;
        $this->attr['number_post']  = $this->attr['pagination_number_post'] = get_theme_mod('jnews_sidefeed_number_post', 12);
    }

    public function render_side_feed_script()
    {
        $json_attr = wp_json_encode($this->attr);

        return "<script> var side_feed = {$json_attr}; </script>";
    }

    public function render_side_feed_content()
    {
        $result = $this->get_side_feed_content();
        return $result['content'];
    }

    public function get_side_feed_content($ajax = false)
    {
        $this->attr['pagination_mode'] = 'loadmore';
        $query_result = ModuleQuery::do_query($this->attr);

        $result = $query_result['result'];

        if($this->attr['paged'] == 1 && !empty($this->attr['exclude_post']) && $this->attr['sort_by'] === 'latest' && empty($this->attr['include_category'])) {
            $current = get_post($this->attr['exclude_post']);
            $result = array_merge(array($current), $result);
        }

        $content = $this->generate_side_feed_content($result, $ajax);

        $content_result = array(
            'next' => $query_result['next'],
            'prev' => $query_result['prev'],
            'content' => $content
        );

        return $content_result;
    }

    public function format_date($post)
    {
        $date_format = get_theme_mod('jnews_feed_date_format');

        if($date_format === 'ago') {
            return jnews_ago_time ( human_time_diff( get_the_time('U', $post), current_time('timestamp')) );
        } else if ($date_format === 'custom') {
            return get_the_modified_date(get_theme_mod('jnews_feed_date_format_custom'), $post);
        } else if ($date_format) {
            return get_the_modified_date(null, $post);
        }

        return get_the_modified_date(null, $post);
    }

    public function render_meta($post)
    {
        $output = '';

        if(get_theme_mod('jnews_show_block_meta', true))
        {
            if (jnews_is_review($post->ID)) {
                $output .= get_theme_mod('jnews_show_block_meta_rating', true) ? jnews_generate_rating($post->ID, 'jeg_live_search_review') : "";
            } else {
                $output .= "<div class=\"jeg_post_meta\">";
                $output .= get_theme_mod('jnews_show_block_meta_date', true) ? "<div class=\"jeg_meta_date\"><i class=\"fa fa-clock-o\"></i> {$this->format_date($post)}</div>" : "";
                $output .= "</div>";
            }
        }

        return $output;
    }

    public function generate_side_feed_content($result, $ajax)
    {
        $output = $active_id = '';
        $sequence = get_theme_mod('jnews_ads_sidefeed_sequence', '3');

        if($ajax) {

        } else {
            if (is_single()) {
                reset($result);
                $active_index = key($result);
                $active_id = $result[$active_index]->ID;   
            }
        }

        foreach($result as $index => $post)
        {
            $active_class = ( $post->ID === $active_id ) ? "active" : "";

            if($index == $sequence)
            {
                $side_ads = $this->get_sidefeed_ads();
                $output .= "<div class=\"jeg_ad jnews_sidefeed_ads\">{$side_ads}</div>";
            }

            if($index === 0) {
                $thumbnail = apply_filters('jnews_image_thumbnail', $post->ID, 'jnews-360x180');
                $additional_class = (!has_post_thumbnail($post->ID)) ? ' no_thumbnail' : '';

                $output .=
                    "<div class=\"jeg_post jeg_pl_md_box {$active_class} {$additional_class}\" data-id=\"{$post->ID}\" data-sequence=\"{$index}\">
                        <div class=\"overlay_container\">
                            <div class=\"jeg_thumb\">
                                " . jnews_edit_post( $post->ID ) . "
                                <a class=\"ajax\" href=\"" . get_the_permalink($post) . "\">{$thumbnail}</a>
                            </div>
                            <div class=\"jeg_postblock_content\">
                                <h2 class=\"jeg_post_title\"><a class=\"ajax\" href=\"" . get_the_permalink($post) . "\">" . get_the_title($post) . "</a></h2>
                                {$this->render_meta($post)}
                            </div>
                        </div>
                    </div>";
            } else {
                $thumbnail = apply_filters('jnews_image_thumbnail', $post->ID, 'jnews-75x75');
                $additional_class = (!has_post_thumbnail($post->ID)) ? ' no_thumbnail' : '';

                $output .=
                    "<div class=\"jeg_post jeg_pl_xs_3 {$active_class} {$additional_class}\" data-id=\"{$post->ID}\" data-sequence=\"{$index}\">
                        <div class=\"jeg_thumb\">
                            " . jnews_edit_post( $post->ID ) . "
                            <a class=\"ajax\" href=\"" . get_the_permalink($post) . "\">{$thumbnail}</a>
                        </div>
                        <div class=\"jeg_postblock_content\">
                            <h2 class=\"jeg_post_title\"><a class=\"ajax\" href=\"" . get_the_permalink($post) . "\">" . get_the_title($post) . "</a></h2>
                            {$this->render_meta($post)}
                        </div>
                    </div>";
            }
        }

        return $output;
    }

    public function get_sidefeed_ads()
    {
        ob_start();
        do_action('jnews_sidefeed_ads') ;
        return ob_get_clean();
    }
}