<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Slider;

Class Slider_Overlay_View extends SliderViewAbstract
{
    public function slider($results)
    {
        $slider = '';

        foreach($results as $key => $post)
        {
            $image = get_the_post_thumbnail_url($post->ID, 'full');

            if($key === 0) {
                $slider .= "<div " . jnews_post_class("jeg_overlay_slider_bg loaded active", $post->ID) . " style=\"background-image: url('{$image}');\"></div>";
            } else {
                $slider .= "<div " . jnews_post_class("jeg_overlay_slider_bg", $post->ID) . " data-bg=\"{$image}\"></div>";
            }
        }

        return $slider;
    }

    public function content($results)
    {
        $content = '';
        foreach($results as $key => $post)
        {
            $category = jnews_get_primary_category($post->ID);
            $category_text = $category ? "<a href=\"" . get_category_link($category) . "\">" . get_cat_name($category) . "</a>" : "";

            $active = ( $key === 0 ) ? "active" : "";
            $content .=
                "<div class=\"jeg_overlay_caption_container {$active}\">
                    <div class=\"jeg_post_category\">{$category_text}</div>
                    <h2 class=\"jeg_post_title\">
                        <a href=\"" . get_the_permalink($post) . "\">" . get_the_title($post) . "</a>
                    </h2>
                </div>";
        }

        return $content;
    }

    public function carousel($results)
    {
        $content = '';
        foreach($results as $key => $post)
        {
            $active = ( $key === 0 ) ? "active" : "";
            $content .=
                "<a class=\"jeg_overlay_slider_item {$active}\" href=\"" . get_the_permalink($post)  . "\" data-id=\"{$key}\">
                    <h3><span>" . get_the_title($post) . "</span></h3>
                </a>";
        }

        return $content;
    }

    public function render_element($result, $attr)
    {
        if(!empty($result))
        {
            $slider = $this->slider($result);
            $content = $this->content($result);
            $carousel = $this->carousel($result);

            $style = '';
            if( $attr['overlay_option'] === 'normal' && !empty($attr['normal_overlay'])) {
                $style = ".{$this->unique_id} .jeg_overlay_slider_wrapper:before { background: {$attr['normal_overlay']} }";
            }

            if(!empty($style)) {
                $style = "<style>$style</style>";
            }

            $additional_class = $attr['enable_nav'] ? 'shownav' : '';

            $output =
                "<div class=\"jeg_overlay_slider {$additional_class} {$this->unique_id} {$this->get_vc_class_name()}\" data-fullscreen=\"{$attr['enable_fullscreen']}\" data-nav=\"{$attr['enable_nav']}\">
                    <div class=\"jeg_overlay_slider_wrapper\">
                        {$slider}
                    </div>
                    <div class=\"jeg_overlay_container\">
                        <div class=\"jeg_overlay_slider_loader\">
                            <div class=\"jeg_overlay_slider_loader_circle\"></div>
                        </div>
                        <div class=\"jeg_overlay_caption_wrapper\">
                            {$content}
                        </div>
                        <div class=\"jeg_overlay_slider_bottom owl-carousel\">
                            {$carousel}
                        </div>
                    </div>
                    {$style}
                </div>";

            return "<div class='row vc_row'><div class='jeg-vc-wrapper'><div class='jeg_section'><div class='container vc_column_container'>$output</div></div></div></div>";
        } else {
            return $this->empty_content();
        }
    }

    public function render_module($attr, $column_class)
    {
        if(function_exists('vc_is_page_editable') && !$this->manager->is_overlay_slider_rendered() && !vc_is_page_editable())
        {
            $this->manager->overlay_slider_rendered();
            return parent::render_module($attr, $column_class);
        }

        if(function_exists('vc_is_page_editable') && vc_is_page_editable()){
            return "<div class='jnews_overlay_slider_notice'>" . esc_html__('JNews Overlay Slider cannot be rendered with VC Frontend Editor Mode. You can still see it on Your Website.', 'jnews') . "</div>";
        }
        return null;
    }
}