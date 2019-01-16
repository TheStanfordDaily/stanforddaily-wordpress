<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Slider;

use JNews\Module\ModuleOptionAbstract;

abstract Class SliderOptionAbstract extends ModuleOptionAbstract
{
    protected $default_number = 4;

    public function compatible_column()
    {
        return array( 8, 12 );
    }

	public function get_category()
	{
		return esc_html__('JNews - Slider', 'jnews');
	}

	public function show_color_scheme()
    {
        return false;
    }

    public function set_options()
    {
        $this->set_slider_option();
        $this->set_content_filter_option($this->default_number);
        $this->set_style_option();
    }

    public function set_slider_option()
    {
        $this->options[] = array(
            'type'          => 'checkbox',
            'param_name'    => 'enable_autoplay',
            'heading'       => esc_html__('Enable Autoplay', 'jnews'),
            'description'   => esc_html__('Check this option to enable auto play.', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'slider',
            'param_name'    => 'autoplay_delay',
            'heading'       => esc_html__('Autoplay Delay', 'jnews'),
            'description'   => esc_html__('Set your autoplay delay (in millisecond).', 'jnews'),
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
            'description'   => esc_html__('Choose which date format you want to use.', 'jnews'),
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