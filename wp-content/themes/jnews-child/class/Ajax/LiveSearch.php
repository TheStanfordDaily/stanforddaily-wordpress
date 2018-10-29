<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Ajax;

/**
 * Class JNews Live Search
 */
Class LiveSearch
{
    public function build_response()
    {
        $statement = array(
            's'                     => $_REQUEST['s'],
            'post_status'			=> array('publish'),
            'orderby'				=> 'date',
            'order'					=> 'DESC',
            'posts_per_page'		=> get_theme_mod('jnews_live_search_number_post', 4),
            'paged'                 => 1
        );

        if ( get_theme_mod('jnews_search_only_post', true) )
        {
            $statement['post_type'] = 'post';
        }

        $query = new \WP_Query($statement);
        wp_reset_postdata();
        echo jnews_sanitize_output( $this->build_live_search($query) );
        exit;
    }


    /**
     * @param $query \WP_Query
     * @return string
     */
    public function build_live_search($query)
    {
        $html = '';

        if ( $query->have_posts() )
        {
            while ( $query->have_posts() )
            {
                $query->the_post();
                $html .= $this->build_search_item(get_post());
            }
        }

        return $html;
    }

    public function build_search_item($post)
    {
        $thumbnail = apply_filters('jnews_image_thumbnail', $post->ID, 'jnews-75x75');
        $additional_class = (!has_post_thumbnail( $post->ID )) ? 'no_thumbnail' : '';

        $html =
            "<div class=\"jeg_post jeg_pl_xs_3 {$additional_class}\">
                <div class=\"jeg_thumb\">
                    " . jnews_edit_post( $post->ID ) . "
                    <a class=\"ajax\" href=\"" . get_the_permalink($post) . "\">{$thumbnail}</a>
                </div>
                <div class=\"jeg_postblock_content\">
                    <h2 class=\"jeg_post_title\"><a class=\"ajax\" href=\"" . get_the_permalink($post) . "\">" . get_the_title($post) . "</a></h2>
                    {$this->render_meta($post)}
                </div>
            </div>";

        return $html;
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

    public function format_date($post)
    {
        $date_format = get_theme_mod('jnews_live_search_date');

        if($date_format === 'ago') {
            return jnews_ago_time( human_time_diff( get_the_time('U', $post), current_time('timestamp') ) );
        } else if ($date_format === 'custom') {
            return get_the_modified_date(get_theme_mod('jnews_live_search_date_custom'), $post);
        } else if ($date_format) {
            return get_the_modified_date(null, $post);
        }

        return get_the_modified_date(null, $post);
    }
}