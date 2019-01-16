<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Block;

Class Block_31_Option extends BlockOptionAbstract
{
    protected $default_number_post = 4;
    protected $show_excerpt = false;
    protected $show_ads = true;
    protected $default_ajax_post = 4;

    public function compatible_column()
    {
        return array( 3, 4, 5, 6, 7, 8 , 9, 10, 11, 12 );
    }

    public function get_module_name()
    {
        return esc_html__('JNews - Module 31', 'jnews');
    }
}