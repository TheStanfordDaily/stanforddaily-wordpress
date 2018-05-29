<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Hero;

Class Hero_9_View extends HeroViewAbstract
{
    public function render_block_type_1($post)
    {
        if($post) {
            $primary_category = $this->get_primary_category($post->ID);
            $image = $this->get_thumbnail($post->ID, 'jnews-featured-750');

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
                                {$this->post_meta_2($post)}
                            </div>
                        </div>
                    </div>
                </article>";

            return $output;
        } else {
            $output = "
                <article class=\"jeg_post jeg_hero_item_1 jeg_hero_empty\" style=\"padding: 0 0 {$this->margin}px {$this->margin}px;\">
                    <div class=\"jeg_block_container\"></div>
                </article>";
            return $output;
        }
    }

    public function render_block_type_2($post, $index)
    {
        $index = $index + 1;

        if($post) {
            $primary_category = $this->get_primary_category($post->ID);
            $image = $this->get_thumbnail($post->ID, 'jnews-featured-750');

            $output =
                "<article " . jnews_post_class("jeg_post jeg_hero_item_{$index}", $post->ID) . " style=\"padding: 0 0 {$this->margin}px {$this->margin}px;\">
                    <div class=\"jeg_block_container\">
                        " . jnews_edit_post( $post->ID ) . "
                        <span class=\"jeg_postformat_icon\"></span>
                        <div class=\"jeg_thumb\">
                            <a href=\"" . get_the_permalink($post) . "\" >{$image}</a>
                        </div>
                        <div class=\"jeg_postblock_content\">
                            <div class=\"jeg_post_category\">
                                {$primary_category}
                            </div>
                            <div class=\"jeg_post_info\">
                                <h2 class=\"jeg_post_title\">
                                    <a href=\"" . get_the_permalink($post) . "\">" . get_the_title($post) . "</a>
                                </h2>
                                {$this->post_meta_2($post)}
                            </div>
                        </div>
                    </div>
                </article>";

            return $output;
        } else {
            $output =
                "<article class=\"jeg_post jeg_hero_item_{$index} jeg_hero_empty\" style=\"padding: 0 0 {$this->margin}px {$this->margin}px;\">
                    <div class=\"jeg_block_container\"></div>
                </article>";

            return $output;
        }
    }

    public function render_element($result)
    {
        $first_block = isset($result[0]) ? $this->render_block_type_1($result[0]) : '';
        $item = isset($result[1]) ? $result[1] : '';
        $second_block = $this->render_block_type_2($item, 1);

        $output = $first_block . $second_block;

        return $output;
    }
}