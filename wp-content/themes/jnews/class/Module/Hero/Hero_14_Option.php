<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Hero;

Class Hero_14_Option extends HeroOptionAbstract
{
    protected $number_post = 8;

    public function get_module_name()
    {
        return esc_html__('JNews - Hero 14', 'jnews');
    }

    public function show_color_scheme()
    {
        return true;
    }
}