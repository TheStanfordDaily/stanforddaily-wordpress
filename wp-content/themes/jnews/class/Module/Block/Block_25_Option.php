<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Block;

Class Block_25_Option extends BlockOptionAbstract
{
    protected $default_number_post = 3;
    protected $show_excerpt = true;
    protected $show_ads = true;
    protected $default_ajax_post = 3;

    public function get_module_name()
    {
        return esc_html__('JNews - Module 25', 'jnews');
    }
}