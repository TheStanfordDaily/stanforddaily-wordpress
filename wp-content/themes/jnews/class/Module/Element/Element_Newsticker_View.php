<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleViewAbstract;

Class Element_Newsticker_View extends ModuleViewAbstract
{
    public function render_item($post, $index)
    {
        $active = ( $index === 0 ) ? "jeg_news_ticker_active" : "";
        $time = $this->format_date($post);
        $class = jnews_post_class("jeg_news_ticker_item jeg_news_ticker_animated {$active}", $post->ID);

        $output =
            "<div {$class}>
                <span>
                    <a href=\"" . get_the_permalink($post) . "\" >" . get_the_title($post) . "</a>
                </span>
                <span class=\"post-date\">
                    $time
                </span>
            </div>";

        return $output;
    }

    public function render_module($attr, $column_class)
    {
        $attr['pagination_number_post'] = 1;
        $results = $this->build_query($attr);
        $results = $results['result'];
        $autoplay_delay = isset( $attr['autoplay_delay']['size'] ) ? $attr['autoplay_delay']['size'] : $attr['autoplay_delay'];

        $style = $items  = '';

        for($i = 0; $i < sizeof($results); $i++) {
            $items .= $this->render_item($results[$i], $i);
        }

        if(!empty($attr['newsticker_background'])) {
            $style .= ".{$this->unique_id} .jeg_breakingnews_title { background: {$attr['newsticker_background']}; }";
        }

        if(!empty($attr['newsticker_text_color'])) {
            $style .= ".{$this->unique_id} .jeg_breakingnews_title { color: {$attr['newsticker_text_color']}; }";
        }

        if(!empty($style)) {
            $style = "<style>$style</style>";
        }

        $output =
            "<div class=\"jeg_breakingnews clearfix {$this->unique_id} {$this->get_vc_class_name()} {$this->color_scheme()}\">
                <div class=\"jeg_breakingnews_title\"><i class=\"{$attr['newsticker_icon']}\">&nbsp;</i> <span>{$attr['newsticker_title']}</span></div>

                <div class=\"jeg_news_ticker\" data-autoplay='{$attr['enable_autoplay']}' data-delay='{$autoplay_delay}' data-animation='{$attr['newsticker_animation']}'>
                    <div class=\"jeg_news_ticker_items\">
                        {$items}
                    </div>
                    <div class=\"jeg_news_ticker_control\">
                        <div class=\"jeg_news_ticker_next jeg_news_ticker_arrow\"><span>" . jnews_return_translation('Next', 'jnews', 'next') . "</span></div>
                        <div class=\"jeg_news_ticker_prev jeg_news_ticker_arrow\"><span>" . jnews_return_translation('Prev', 'jnews', 'prev') . "</span></div>
                    </div>
                </div>
                {$style}
            </div>";

        return $output;

    }

    public function render_column_alt($result, $column_class) {}
    public function render_column($result, $column_class) {}
}