<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Hero;

Class Hero_4_Option extends HeroOptionAbstract
{
    protected $number_post = 3;

    public function get_module_name()
    {
        return esc_html__('JNews - Hero 4', 'jnews');
    }
}