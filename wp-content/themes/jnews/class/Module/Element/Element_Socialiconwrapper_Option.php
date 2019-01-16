<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleOptionAbstract;

Class Element_Socialiconwrapper_Option extends ModuleOptionAbstract
{
	public function get_category()
	{
		return esc_html__('JNews - Element', 'jnews');
	}

    public function compatible_column()
    {
        return array( 1,2,3,4,5,6,7,8,9,10,11,12 );
    }

    public function get_module_name()
    {
        return esc_html__('JNews - Social Icon Wrapper', 'jnews');
    }

	public function get_module_parent()
	{
		return array( 'only' => 'jnews_element_socialiconitem' );
	}

    public function set_options()
    {
        $this->get_option();
        $this->set_style_option();
    }

    public function get_option()
    {
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'style',
            'heading'       => esc_html__('Style', 'jnews'),
            'description'   => esc_html__('Choose your social icon style.', 'jnews'),
            'std'           => 'nobg',
            'value'         => array(
                esc_html__('Square', 'jnews')           => 'square',
                esc_html__('Rounded', 'jnews')          => 'rounded',
                esc_html__('Circle', 'jnews')           => 'circle',
                esc_html__('No background', 'jnews')    => 'nobg',
            ),
        );

	    $this->options[] = array(
		    'type'          => 'colorpicker',
		    'param_name'    => 'icon_color',
		    'heading'       => esc_html__('Icon Color', 'jnews'),
		    'description'   => esc_html__('Set global social icon color. Ignore it to use default icon color.', 'jnews'),
		    'dependency'    => array('element' => "style", 'value' => array('square', 'rounded', 'circle', 'nobg'))
	    );

	    $this->options[] = array(
		    'type'          => 'colorpicker',
		    'param_name'    => 'bg_color',
		    'heading'       => esc_html__('Background Color', 'jnews'),
		    'description'   => esc_html__('Set global social icon background color. Ignore it to use default background color.', 'jnews'),
		    'dependency'    => array('element' => "style", 'value' => array('square', 'rounded', 'circle'))
	    );

	    $this->options[] = array(
		    'type'          => 'checkbox',
		    'param_name'    => 'vertical',
		    'heading'       => esc_html__('Vertical Social', 'jnews'),
		    'description'   => esc_html__('Align social icon vertical.', 'jnews')
	    );

	    $this->options[] = array(
		    'type'          => 'checkbox',
		    'param_name'    => 'align',
		    'heading'       => esc_html__('Centered Content', 'jnews'),
		    'description'   => wp_kses(__("This option only works if <strong>Vertical Social</strong> option is unchecked.", 'jnews'), wp_kses_allowed_html()),
	    );

	    $this->options[] = array(
		    'type'          => 'textarea',
		    'param_name'    => 'beforesocial',
		    'heading'       => esc_html__('Before Social Text','jnews'),
		    'description'   => esc_html__('Allowed tag : a, b, strong, em.','jnews'),
	    );

	    $this->options[] = array(
		    'type'          => 'textarea',
		    'param_name'    => 'aftersocial',
		    'heading'       => esc_html__('After Social Text','jnews'),
		    'description'   => esc_html__('Allowed tag : a, b, strong, em.','jnews'),
	    );
    }
}