<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleOptionAbstract;

Class Element_Newsticker_Option extends ModuleOptionAbstract
{
    public function compatible_column()
    {
        return array( 6 , 7 , 8 , 9 , 10 , 11 , 12 );
    }

    public function get_module_name()
    {
        return esc_html__('JNews - News Ticker', 'jnews');
    }

    public function get_category()
    {
	    return esc_html__('JNews - Element', 'jnews');
    }

	public function set_options()
    {
        $this->set_newsticker_option();
        $this->set_content_filter_option(5);
        $this->set_style_option();
    }

    public function set_newsticker_option()
    {
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'newsticker_title',
            'heading'       => esc_html__('News Ticker Title', 'jnews'),
            'description'   => esc_html__('Title of news ticker.', 'jnews'),
            'std'           => esc_html__('TRENDING', 'jnews')
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

        $this->options[] = array(
            'type'          => 'iconpicker',
            'param_name'    => 'newsticker_icon',
            'heading'       => esc_html__('News ticker icon', 'jnews'),
            'description'   => esc_html__('Choose which font icon that best to describe your news ticker.', 'jnews'),
            'std'         => 'fa fa-bolt',
            'settings'      => array(
                'emptyIcon'     => false,
                'iconsPerPage'  => 100,
            )
        );

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
            'param_name'    => 'newsticker_animation',
            'heading'       => esc_html__('Animation Direction', 'jnews'),
            'description'   => esc_html__('Choose news ticker animation direction.', 'jnews'),
            'std'           => 'horizontal',
            'value'         => array(
                esc_html__('Vertical', 'jnews')          => 'vertical',
                esc_html__('Horizontal', 'jnews')        => 'horizontal',
            ),
        );

        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'newsticker_background',
            'heading'       => esc_html__('News Ticker Title Background', 'jnews'),
            'description'   => esc_html__('Choose news ticker title background. If you leave it empty, you will use default theme scheme color.', 'jnews'),
        );

        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'newsticker_text_color',
            'heading'       => esc_html__('News Ticker Text Color', 'jnews'),
            'description'   => esc_html__('Choose news ticker title text color. If you leave it empty, you will use default theme scheme color.', 'jnews'),
        );
    }
}