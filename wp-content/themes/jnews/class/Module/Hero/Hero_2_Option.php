<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Hero;

Class Hero_2_Option extends HeroOptionAbstract
{
    protected $number_post = 5;

    public function get_module_name()
    {
        return esc_html__('JNews - Hero 2', 'jnews');
    }
}