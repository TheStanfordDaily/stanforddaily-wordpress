<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Slider;

Class Slider_Overlay_Option extends SliderOptionAbstract
{
    protected $default_number = 5;

    public function compatible_column()
    {
        return array( 1 , 2 , 3 , 4 , 5 , 6 , 7 , 8 , 9 , 10 , 11 , 12 );
    }

    public function get_module_name()
    {
        return esc_html__('JNews - Overlay Slider', 'jnews');
    }

    public function set_slider_option()
    {
        $this->options[] = array(
            'type'          => 'checkbox',
            'param_name'    => 'enable_fullscreen',
            'heading'       => esc_html__('Enable full screen', 'jnews'),
            'description'   => esc_html__('Check this option to enable full screen slider.', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'checkbox',
            'param_name'    => 'enable_nav',
            'heading'       => esc_html__('Show Navigation', 'jnews'),
            'description'   => esc_html__('Show next/prev buttons to navigate slider.', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'overlay_option',
            'heading'       => esc_html__('Overlay Option', 'jnews'),
            'description'   => esc_html__('Choose overlay type that you want to use for slider.', 'jnews'),
            'std'           => 'gradient',
            'value'         => array(
                esc_html__('Gradient Overlay', 'jnews')          => 'gradient',
                esc_html__('Normal Overlay', 'jnews')            => 'normal',
            )
        );
        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'normal_overlay',
            'heading'       => esc_html__('Normal Overlay Color', 'jnews'),
            'description'   => esc_html__('Choose your normal overlay color for slider.', 'jnews'),
            'dependency'    => array('element' => 'overlay_option', 'value' => array('normal'))
        );
    }
}