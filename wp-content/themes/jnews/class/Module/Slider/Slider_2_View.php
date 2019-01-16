<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Slider;

Class Slider_2_View extends SliderViewAbstract
{
    public function content($results)
    {
        $content = '';
        foreach($results as $key => $post)
        {
            $primary_category = $this->get_primary_category($post->ID);

            if($this->manager->get_current_width() > 8){
                $image = get_the_post_thumbnail_url($post->ID, 'jnews-1140x570');
            } else {
                $image = get_the_post_thumbnail_url($post->ID, 'jnews-750x375');
            }

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
            $content        = $this->content($result);
            $autoplay_delay = isset( $attr['autoplay_delay']['size'] ) ? $attr['autoplay_delay']['size'] : $attr['autoplay_delay'];

            $output =
                "<div class=\"jeg_slider_wrapper {$this->unique_id} {$this->get_vc_class_name()}\">
                    <div class=\"jeg_slider_type_2 jeg_slider owl-carousel\" data-autoplay=\"{$attr['enable_autoplay']}\" data-delay=\"{$autoplay_delay}\">
                        {$content}
                    </div>
                </div>";

            return $output;
        } else {
            return $this->empty_content();
        }
    }
}