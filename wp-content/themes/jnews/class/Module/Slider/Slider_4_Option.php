<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Slider;

Class Slider_4_Option extends SliderOptionAbstract
{
    protected $default_number = 5;

    public function compatible_column()
    {
        return array( 12 );
    }

    public function get_module_name()
    {
        return esc_html__('JNews - Slider 4', 'jnews');
    }

    public function set_slider_option()
    {
        $this->options[] = array(
            'type'          => 'checkbox',
            'param_name'    => 'enable_autoplay',
            'heading'       => esc_html__('Enable Autoplay', 'jnews'),
            'description'   => esc_html__('check this option to enable auto play', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'checkbox',
            'param_name'    => 'fullsize_image',
            'heading'       => esc_html__('Use Full-Size Image', 'jnews'),
            'description'   => esc_html__('check this option to use full-size image instead of cropped version', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'slider',
            'param_name'    => 'autoplay_delay',
            'heading'       => esc_html__('Autoplay Delay', 'jnews'),
            'description'   => esc_html__('set your autoplay delay (in millisecond)', 'jnews'),
            'min'           => 1000,
            'max'           => 10000,
            'step'          => 500,
            'std'           => 3000,
            'dependency'    => array('element' => 'enable_autoplay', 'value' => 'true')
        );
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'date_format',
            'heading'       => esc_html__('Choose Date Format', 'jnews'),
            'description'   => esc_html__('choose which date format you want to use', 'jnews'),
            'std'           => 'default',
            'value'         => array(
                esc_html__('Relative Date/Time Format (ago)', 'jnews')  => 'ago',
                esc_html__('WordPress Default Format', 'jnews')         => 'default',
                esc_html__('Custom Format', 'jnews')                    => 'custom',
            )
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'date_format_custom',
            'heading'       => esc_html__('Custom Date Format', 'jnews'),
            'description'   => wp_kses(sprintf(__('Please write custom date format for your module, for more detail about how to write date format, you can refer to this <a href="%s" target="_blank">link</a>.', 'jnews'), 'https://codex.wordpress.org/Formatting_Date_and_Time'), wp_kses_allowed_html()),
            'std'           => 'Y/m/d',
            'dependency'    => array('element' => 'date_format', 'value' => array('custom'))
        );
    }
}