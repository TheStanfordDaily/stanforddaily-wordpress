<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Slider;

Class Slider_1_Option extends SliderOptionAbstract
{
    protected $default_number = 6;

    public function get_module_name()
    {
        return esc_html__('JNews - Slider 1', 'jnews');
    }
}