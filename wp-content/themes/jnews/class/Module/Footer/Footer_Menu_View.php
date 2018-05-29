<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Footer;

use JNews\Module\ModuleViewAbstract;

Class Footer_Menu_View extends ModuleViewAbstract
{
    public function render_module($attr, $column_class)
    {
        /** style  */
        $style = $this->custom_color($attr, $this->unique_id . ' ');
        $style = !empty($style) ? "<style scoped>{$style}</style>" : "";

        ob_start();
        jnews_menu()->footer_navigation();
        $footer = ob_get_clean();

        return "{$style}<div class='{$this->unique_id}'>{$footer}</div>";
    }

    public function custom_color($attr, $unique_id)
    {
        $unique_class = trim($unique_id);
        $style  = '';

        if(isset($attr['text_color']) && !empty($attr['text_color']))
        {
            $style .= ".{$unique_class} .jeg_menu_footer a, .footer_dark .{$unique_class} .jeg_menu_footer a { color: {$attr['text_color']} }";
        }

        if(isset($attr['hover_text_color']) && !empty($attr['hover_text_color']))
        {
            $style .= ".{$unique_class} .jeg_menu_footer a:hover, .footer_dark .{$unique_class} .jeg_menu_footer a:hover { color: {$attr['hover_text_color']} }";
        }

        if(isset($attr['menu_separator_color']) && !empty($attr['menu_separator_color']))
        {
            $style .= ".{$unique_class} .jeg_menu_footer li:not(:last-child):after, .footer_dark .{$unique_class} .jeg_menu_footer li:not(:last-child):after { color: {$attr['menu_separator_color']} }";
        }

        return $style;
    }

    public function render_column_alt($result, $column_class) {}
    public function render_column($result, $column_class) {}
}