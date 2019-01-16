<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Block;

Class Block_14_Option extends BlockOptionAbstract
{
    protected $default_number_post = 5;
    protected $show_excerpt = false;
    protected $default_ajax_post = 4;

    public function get_module_name()
    {
        return esc_html__('JNews - Module 14', 'jnews');
    }
}