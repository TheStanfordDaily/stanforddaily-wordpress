<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Slider;

Class Slider_4_View extends SliderViewAbstract
{
    public function content($results, $attr)
    {
        $content = '';
        foreach($results as $key => $post)
        {
            $primary_category = $this->get_primary_category($post->ID);
            $size = $attr['fullsize_image'] ? 'full' : 'jnews-1140x815';
            $image = get_the_post_thumbnail_url($post->ID, $size);

            $content .=
                "<div " . jnews_post_class("jeg_slide_item", $post->ID) . " style=\"background-image: url({$image})\">
                    " . jnews_edit_post( $post->ID ) . "
                    <div class=\"jeg_slide_caption\">
                        <div class=\"jeg_caption_container\">
                            <div class=\"jeg_post_category\">
                                {$primary_category}
                            </div>
                            <h2 class=\"jeg_post_title\">
                                <a href=\"" . get_the_permalink($post) . "\">" . get_the_title($post) . "</a>
                            </h2>
                            {$this->render_meta($post)}
                        </div>
                    </div>
                </div>";
        }

        return $content;
    }

    public function render_element($result, $attr)
    {
        if(!empty($result))
        {
            $content        = $this->content($result, $attr);
            $autoplay_delay = isset( $attr['autoplay_delay']['size'] ) ? $attr['autoplay_delay']['size'] : $attr['autoplay_delay'];

            $output =
                "<div class=\"jeg_slider_wrapper {$this->unique_id} {$this->get_vc_class_name()}\">
                    <div class=\"jeg_slider_type_4 jeg_slider jeg_owlslider owl-carousel\" data-autoplay=\"{$attr['enable_autoplay']}\" data-delay=\"{$autoplay_delay}\">
                        {$content}
                    </div>
                </div>";
            return $output;
        } else {
            return $this->empty_content();
        }
    }
}
