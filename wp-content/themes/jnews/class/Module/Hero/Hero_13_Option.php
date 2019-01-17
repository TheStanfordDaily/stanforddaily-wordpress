<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Hero;

Class Hero_13_Option extends HeroOptionAbstract
{
    protected $number_post = 1;

    public function get_module_name()
    {
        return esc_html__('JNews - Hero 13', 'jnews');
    }
}