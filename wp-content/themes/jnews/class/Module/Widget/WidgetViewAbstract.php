<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Widget;

use JNews\Module\ModuleViewAbstract;
use JNews\Widget\Normal\NormalWidgetInterface;

abstract Class WidgetViewAbstract extends ModuleViewAbstract
{
    public function render_module($attr, $column_class)
    {
        $class = jeg_get_normal_widget_class_name_from_module(get_called_class());

        /** @var NormalWidgetInterface $widget_class */
        $widget_class = new $class();

        ob_start();
        $this->render_header($attr);
        $widget_class->render_widget($attr, $this->content);
        return ob_get_clean();
    }

    public function render_header($attr)
    {
        if ( defined('POLYLANG_VERSION') )
        {
            $attr['title'] = jnews_return_polylang($attr['title']);
            $attr['second_title'] = jnews_return_polylang($attr['second_title']);
            $attr['header_filter_text'] = jnews_return_polylang($attr['header_filter_text']);
        }

        // Heading
        $subtitle       = ! empty($attr['second_title']) ? "<strong>{$attr['second_title']}</strong>"  : "";
        $header_class   = "jeg_block_{$attr['header_type']}";
        $heading_title  = $attr['title'] . $subtitle;

        if(!empty($heading_title))
        {
            $heading_icon   = empty($attr['header_icon']) ? "" : "<i class='{$attr['header_icon']}'></i>";
            $heading_title  = "<span>{$heading_icon}{$attr['title']}{$subtitle}</span>";
            $heading_title  = ! empty($attr['url']) ? "<a href='{$attr['url']}'>{$heading_title}</a>" : $heading_title;
            $heading_title  = "<h3 class=\"jeg_block_title\">{$heading_title}</h3>";

            $style_output   = jnews_header_styling($attr, $this->unique_id);
            $style          = !empty($style_output) ? "<style scoped>{$style_output}</style>" : "";

            $output =
                "<div class=\"jeg_block_heading {$header_class} {$this->unique_id}\">
                    {$heading_title}
                    {$style}
                </div>";

            echo $output;
        }
    }
}
