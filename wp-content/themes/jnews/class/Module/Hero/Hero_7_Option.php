<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Hero;

Class Hero_7_Option extends HeroOptionAbstract
{
    protected $number_post = 4;

    public function get_module_name()
    {
        return esc_html__('JNews - Hero 7', 'jnews');
    }
}