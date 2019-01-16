<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Block;

Class Block_4_Option extends BlockOptionAbstract
{
    protected $default_number_post = 4;
    protected $show_excerpt = true;
    protected $show_ads = true;
    protected $default_ajax_post = 4;

    public function get_module_name()
    {
        return esc_html__('JNews - Module 4', 'jnews');
    }
}