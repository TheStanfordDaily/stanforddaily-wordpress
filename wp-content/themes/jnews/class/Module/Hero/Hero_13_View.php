<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Hero;

Class Hero_13_View extends HeroViewAbstract
{
    public function get_module_name()
    {
        return esc_html__('JNews - Hero 13', 'jnews');
    }

    public function render_block_type_1($post)
    {
        if($post) {
            $primary_category = $this->get_primary_category($post->ID);
            $image = $this->get_thumbnail($post->ID, 'jnews-featured-1140');

            $output =
                "<article " . jnews_post_class("jeg_post jeg_hero_item_1", $post->ID) . " style=\"padding: 0 0 {$this->margin}px {$this->margin}px;\">
                    <div class=\"jeg_block_container\">
                        " . jnews_edit_post( $post->ID ) . "
                        <span class=\"jeg_postformat_icon\"></span>
                        <div class=\"jeg_thumb\">
                            <a href=\"" . get_the_permalink($post) . "\" >{$image}</a>
                        </div>
                        <div class=\"jeg_postblock_content\">
                            <div class=\"jeg_post_category\">{$primary_category}</div>
                            <div class=\"jeg_post_info\">
                                <h2 class=\"jeg_post_title\">
                                    <a href=\"" . get_the_permalink($post) . "\" >" . get_the_title($post) . "</a>
                                </h2>
                                {$this->post_meta_3($post)}
                            </div>
                        </div>
                    </div>
                </article>";

            return $output;
        }
        return null;
    }

    public function render_element($result)
    {
        $first_block = $this->render_block_type_1($result[0]);
        return $first_block;
    }
}
