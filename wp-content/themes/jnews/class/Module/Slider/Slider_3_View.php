<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Slider;

Class Slider_3_View extends SliderViewAbstract
{
    public function content($results)
    {
        $content = '';
        foreach($results as $key => $post)
        {
            $primary_category = $this->get_primary_category($post->ID);
            $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
            $image = apply_filters('jnews_single_image_owl', $post_thumbnail_id, 'jnews-360x504');

            $content .=
                "<div " . jnews_post_class("jeg_slide_item", $post->ID) . ">
                    " . jnews_edit_post( $post->ID ) . "
                    <a href=\"" . get_the_permalink($post) . "\">
                        {$image}
                    </a>
                    <div class=\"jeg_slide_caption\">
                        <div class=\"jeg_caption_container\">
                            <div class=\"jeg_post_category\">
                                {$primary_category}
                            </div>
                            <h2 class=\"jeg_post_title\">
                                <a href=\"" . get_the_permalink($post) . "\">" . get_the_title($post) . "</a>
                            </h2>
                            <p class=\"jeg_post_excerpt\"> {$this->get_excerpt($post)} </p>
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
            $column_class   = $this->get_module_column_class($attr);
            $autoplay_delay = isset( $attr['autoplay_delay']['size'] ) ? $attr['autoplay_delay']['size'] : $attr['autoplay_delay'];
            $number_item    = isset( $attr['number_item']['size'] ) ? $attr['number_item']['size'] : $attr['number_item'];

            $output =
                "<div class=\"jeg_slider_wrapper {$column_class} {$this->unique_id} {$this->get_vc_class_name()}\">
                    <div class=\"jeg_slider_type_3 jeg_slider owl-carousel\" data-items=\"{$number_item}\" data-autoplay=\"{$attr['enable_autoplay']}\" data-delay=\"{$autoplay_delay}\">
                        {$content}
                    </div>
                </div>";
            return $output;
        } else {
            return $this->empty_content();
        }
    }

    public function render_meta($post)
    {
        $output = '';

        if( get_theme_mod('jnews_show_block_meta', true) && get_theme_mod('jnews_show_block_meta_date', true) )
        {
            $time   = $this->format_date($post);
            $output =
                "<div class=\"jeg_post_meta\">
                    <span class=\"jeg_meta_date\"><i class=\"fa fa-clock-o\"></i> {$time}</span>
                </div>";
        }

        return $output;
    }
}
