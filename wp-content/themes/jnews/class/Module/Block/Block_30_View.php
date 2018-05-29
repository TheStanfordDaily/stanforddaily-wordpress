<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Block;

Class Block_30_View extends BlockViewAbstract
{
    public function render_block($post, $attr)
    {
        $primary_category = $this->get_primary_category($post->ID);
        $image = apply_filters('jnews_image_thumbnail', $post->ID, 'jnews-750x536');

        $output =
            "<article " . jnews_post_class("jeg_post jeg_pl_lg_7", $post->ID) . ">
                    <div class=\"jeg_thumb\">
                        " . jnews_edit_post( $post->ID ) . "
                        <a href=\"" . get_the_permalink($post) . "\">{$image}</a>
                        <div class=\"jeg_post_category\">
                            {$primary_category}
                        </div>
                    </div>
                    <div class=\"jeg_postblock_content\">
                        <h3 class=\"jeg_post_title\">
                            <a href=\"" . get_the_permalink($post) . "\">" . get_the_title($post) . "</a>
                        </h3>
                        <div class=\"jeg_post_meta\">
                            {$this->post_meta_3($post)}
                        </div>
                        <div class=\"jeg_post_excerpt\">
                            <p>" . $this->get_excerpt($post) . "</p>
                            <a href=\"" . get_the_permalink($post) . "\" class=\"jeg_readmore\">" . jnews_return_translation('Read more','jnews', 'read_more') . "</a>
                        </div>
                    </div>
                </article>";

        return $output;
    }

    public function build_column($results, $attr)
    {
        $output = '';

        for ( $i = 0; $i < sizeof($results); $i++ ) 
        {   
            $output .= $this->render_block($results[$i], $attr);
        }

        return $output;
    }

    public function render_output($attr, $column_class)
    {
        $results    = $this->build_query($attr);
        $navigation = $this->render_navigation($attr, $results['next'], $results['prev'], $results['total_page']);

        if(!empty($results['result'])) {
            $content = $this->render_column($results['result'], $column_class);
        } else {
            $content = $this->empty_content();
        }

        return
            "<div class=\"jeg_block_container jeg_load_more_flag\">
                {$this->get_content_before($attr)}
                {$content}
                {$this->get_content_after($attr)}
            </div>
            <div class=\"jeg_block_navigation\">
                {$this->get_navigation_before($attr)}
                {$navigation}
                {$this->get_navigation_after($attr)}
            </div>";
    }

    public function render_column($result, $attr)
    {
        $content = $this->build_column($result, $attr);

        return $content;
    }

    public function render_column_alt($result, $attr)
    {
        $content = $this->build_column($result, $attr);

        return $content;
    }
}