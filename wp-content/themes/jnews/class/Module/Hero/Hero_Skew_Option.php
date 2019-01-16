<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Hero;

Class Hero_Skew_Option extends HeroOptionAbstract
{
    protected $number_post = 2;

    public function get_module_name()
    {
        return esc_html__('JNews - Hero Skew', 'jnews');
    }
}