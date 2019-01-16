<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Block;

Class Block_30_Option extends BlockOptionAbstract
{
    protected $default_number_post = 1;
    protected $show_excerpt = true;
    protected $default_ajax_post = 1;

    public function compatible_column()
    {
        return array( 6 );
    }

    public function get_module_name()
    {
        return esc_html__('JNews - Module 30', 'jnews');
    }
}