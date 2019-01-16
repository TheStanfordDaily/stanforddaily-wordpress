<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Widget;

Class Widget_About_Option extends WidgetOptionAbstract
{
    public function get_module_name()
    {
        return esc_html__('JNews - About Widget', 'jnews');
    }
}