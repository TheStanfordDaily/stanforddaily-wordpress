<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleOptionAbstract;

Class Element_Splitnav_Option extends ModuleOptionAbstract
{
    public function compatible_column()
    {
        return array( 8 , 10, 12 );
    }

    public function get_category()
    {
	    return esc_html__('JNews - Element', 'jnews');
    }

	public function get_module_name()
    {
        return esc_html__('JNews - Split Navigation ', 'jnews');
    }

    public function set_options()
    {
        $this->set_header_option();
        $this->set_style_option();
    }

    public function set_header_option()
    {
        $this->options[] = array(
            'type'          => 'multiselect',
            'param_name'    => 'menu',
            'heading'       => esc_html__('Menu to Include', 'jnews'),
            'description'   => esc_html__('Include menu into split navigation.', 'jnews'),
            'std'           => '',
            'value'         => jnews_get_all_menu(),
        );
    }

}
