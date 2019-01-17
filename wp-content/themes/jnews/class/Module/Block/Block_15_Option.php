<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Block;

Class Block_15_Option extends BlockOptionAbstract
{
    protected $default_number_post = 6;
    protected $show_excerpt = false;
    protected $default_ajax_post = 4;

    public function get_module_name()
    {
        return esc_html__('JNews - Module 15', 'jnews');
    }
}