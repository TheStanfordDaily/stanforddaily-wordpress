<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Footer;

use JNews\Module\ModuleOptionAbstract;

Class Footer_Menu_Option extends ModuleOptionAbstract
{
    public function compatible_column()
    {
        return array(1,2,3,4,5,6,7,8,9,10,11,12);
    }

    public function get_module_name()
    {
        return esc_html__('JNews - Footer Menu', 'jnews');
    }

    public function get_category()
    {
        return esc_html__('JNews - Footer', 'jnews');
    }

    public function set_options()
    {
        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'text_color',
            'heading'       => esc_html__('Menu Text Color', 'jnews'),
            'description'   => esc_html__('Footer menu text color', 'jnews'),
        );

        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'hover_text_color',
            'heading'       => esc_html__('Menu Hover Text Color', 'jnews'),
            'description'   => esc_html__('Footer menu hover text color', 'jnews'),
        );

        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'menu_separator_color',
            'heading'       => esc_html__('Menu Separator Color', 'jnews'),
            'description'   => esc_html__('Footer menu separator color', 'jnews'),
        );
    }
}