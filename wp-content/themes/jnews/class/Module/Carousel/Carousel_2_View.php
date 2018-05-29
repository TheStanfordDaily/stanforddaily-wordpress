<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Carousel;

Class Carousel_2_View extends CarouselViewAbstract
{
    public function content($results)
    {
        $content = '';
        foreach($results as $key => $post)
        {
            $image = $this->get_thumbnail($post->ID, 'jnews-350x250');
            $primary_category = $this->get_primary_category($post->ID);
            $additional_class = (!has_post_thumbnail($post->ID)) ? ' no_thumbnail' : '';

            $content .=
                "<article " . jnews_post_class("jeg_post" . $additional_class, $post->ID) . ">
                    <div class=\"jeg_thumb\">
                        " . jnews_edit_post( $post->ID ) . "
                        <a href=\"" . get_the_permalink($post) . "\" >{$image}</a>
                    </div>
                    <div class=\"overlay_content\">
                        <div class=\"jeg_postblock_content\">
                            <div class=\"jeg_post_category\">{$primary_category}</div>
                            <h3 class=\"jeg_post_title\"><a href=\"" . get_the_permalink($post) . "\">" . get_the_title($post) . "</a></h3>
                            " . $this->post_meta_2($post) . "
                        </div>
                    </div>
                </article>";
        }

        return $content;
    }

    public function render_element($result, $attr)
    {
        if(!empty($result))
        {
            $content        = $this->content($result);
            $width          = $this->manager->get_current_width();
	        $autoplay_delay = isset( $attr['autoplay_delay']['size'] ) ? $attr['autoplay_delay']['size'] : $attr['autoplay_delay'];
	        $number_item    = isset( $attr['number_item']['size'] ) ? $attr['number_item']['size'] : $attr['number_item'];
	        $margin         = isset( $attr['margin']['size'] ) ? $attr['margin']['size'] : $attr['margin'];

            $output =
                "<div class=\"jeg_postblock_carousel_2 jeg_postblock jeg_col_{$width} {$this->unique_id} {$this->get_vc_class_name()}\">
                    <div class=\"jeg_carousel_post owl-carousel\" data-nav='{$attr['show_nav']}' data-autoplay='{$attr['enable_autoplay']}' data-delay='{$autoplay_delay}' data-items='{$number_item}' data-margin='{$margin}'>
                        {$content}
                    </div>
                </div>";

            return $output;
        } else {
            return $this->empty_content();
        }
    }
}