<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Footer;

use JNews\Module\ModuleViewAbstract;

Class Footer_Social_View extends ModuleViewAbstract
{
    public function render_module($attr, $column_class)
    {
        /** style  */
        $style = $this->custom_color($attr, $this->unique_id . ' ');
        $style = !empty($style) ? "<style scoped>{$style}</style>" : "";

        $social =
            "<div class='jeg_social_icon_block socials_widget {$this->unique_id} " . esc_attr($attr['social_icon'])  . "'>"
                . jnews_generate_social_icon_block( false ) .
            "</div>";

        return "{$style}{$social}";
    }

    public function custom_color($attr, $unique_id)
    {
        $unique_class = trim($unique_id);
        $style  = '';

        if(isset($attr['icon_text_color']) && !empty($attr['icon_text_color']))
        {
            $style .= ".{$unique_class}.jeg_social_icon_block a .fa{ color: {$attr['icon_text_color']} !important; }";
        }

        if(isset($attr['icon_text_hover_color']) && !empty($attr['icon_text_hover_color']))
        {
            $style .= ".{$unique_class}.jeg_social_icon_block a:hover .fa { color: {$attr['icon_text_hover_color']} !important; }";
        }

        if(isset($attr['icon_background']) && !empty($attr['icon_background']))
        {
            $style .= ".{$unique_class}.jeg_social_icon_block > a > i.fa { background-color: {$attr['icon_background']} !important; }";
        }

        if(isset($attr['icon_hover_background']) && !empty($attr['icon_hover_background']))
        {
            $style .= ".{$unique_class}.jeg_social_icon_block > a:hover > i.fa { background-color: {$attr['icon_hover_background']} !important; }";
        }

        return $style;
    }

    public function render_column_alt($result, $column_class) {}
    public function render_column($result, $column_class) {}
}