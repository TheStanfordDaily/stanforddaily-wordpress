<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Widget;

Class Widget_RecentNews_Option extends WidgetOptionAbstract
{
    public function get_module_name()
    {
        return esc_html__('JNews - Recent News Widget', 'jnews');
    }
}