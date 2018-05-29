<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Widget;

Class Widget_Popular_Option extends WidgetOptionAbstract
{
    public function get_module_name()
    {
        return esc_html__('JNews - Popular Widget', 'jnews');
    }
}