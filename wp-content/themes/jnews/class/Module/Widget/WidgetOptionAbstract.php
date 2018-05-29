<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Widget;

use JNews\Module\ModuleOptionAbstract;
use JNews\Widget\Normal\NormalWidgetInterface;

abstract Class WidgetOptionAbstract extends ModuleOptionAbstract
{
	public function get_category()
	{
		return esc_html__('JNews - Widget', 'jnews');
	}

    public function compatible_column()
    {
        return array( 4 );
    }

    public function show_color_scheme()
    {
        return false;
    }

    public function set_options()
    {
        $class = jeg_get_normal_widget_class_name_from_module(get_called_class());

        /** @var NormalWidgetInterface $widget_class */
        $widget_class = new $class();

        foreach($widget_class->get_options() as $key => $value)
        {
        	$dependency = $this->set_dependency($value);

            // Type : Text
            if($value['type'] === 'text')
            {
                $this->options[] = array(
                    'type'          => 'textfield',
                    'param_name'    => $key,
                    'heading'       => $value['title'],
                    'description'   => $value['desc'],
                    'std'           => isset($value['default']) ? $value['default'] : '',
                    'dependency'    => $dependency
                );
            }

            // Type : Image
            if($value['type'] === 'image')
            {
                $this->options[] = array(
                    'type'          => 'attach_image',
                    'param_name'    => $key,
                    'heading'       => $value['title'],
                    'description'   => $value['desc'],
                    'dependency'    => $dependency
                );
            }

            // Type : Textarea
            if($value['type'] === 'textarea')
            {
                $this->options[] = array(
                    'type'          => 'textarea',
                    'param_name'    => 'content',
                    'heading'       => $value['title'],
                    'description'   => $value['desc'],
                    'dependency'    => $dependency
                );
            }

            // Type : Checkbox
            if($value['type'] === 'checkbox')
            {
                $this->options[] = array(
                    'type'          => 'checkbox',
                    'param_name'    => $key,
                    'heading'       => $value['title'],
                    'description'   => $value['desc'],
                    'std'           => isset($value['default']) ? $value['default'] : false,
                    'dependency'    => $dependency
                );
            }

            // Type : Select
            if($value['type'] === 'select')
            {
                $this->options[] = array(
                    'type'          => 'dropdown',
                    'param_name'    => $key,
                    'heading'       => $value['title'],
                    'description'   => $value['desc'],
                    'std'           => $value['default'],
                    'value'         => $this->switch_value_key($value['options']),
                    'dependency'    => $dependency
                );
            }

            // Type : Slider
            if($value['type'] === 'slider')
            {
                $this->options[] = array(
                    'type'          => 'slider',
                    'param_name'    => $key,
                    'heading'       => $value['title'],
                    'description'   => $value['desc'],
                    'min'           => $value['options']['min'],
                    'max'           => $value['options']['max'],
                    'step'          => $value['options']['step'],
                    'std'           => $value['default'],
                    'dependency'    => $dependency
                );
            }

            // Type : Color
            if($value['type'] === 'color')
            {
                $this->options[] = array(
                    'type'          => 'colorpicker',
                    'param_name'    => $key,
                    'heading'       => $value['title'],
                    'description'   => $value['desc'],
                    'std'           => isset($value['default']) ? $value['default'] : false,
                    'dependency'    => $dependency
                );
            }

            if($value['type'] === 'alert')
            {
                $this->options[] = array(
                    'type'          => 'alert',
                    'param_name'    => $key,
                    'heading'       => $value['title'],
                    'description'   => $value['desc'],
                    'std'           => isset($value['default']) ? $value['default'] : false,
                    'dependency'    => $dependency
                );
            }
        }

        $this->set_header_option();
    }

    public function set_dependency($value)
    {
    	$dependecy = '';

    	if ( isset($value['dependency']) )
	    {
	    	$dependecy = array(
	    		'element' => $value['dependency'][0]['field'],
			    'value' => $value['dependency'][0]['value']
		    );
	    }

    	return $dependecy;
    }

    public function switch_value_key($options)
    {
        $array = array();

        foreach($options as $key => $value)
        {
            $array[$value] = $key;
        }

        return $array;
    }

    public function set_header_option()
    {
        $this->options[] = array(
            'type'          => 'iconpicker',
            'param_name'    => 'header_icon',
            'heading'       => esc_html__('Header Icon', 'jnews'),
            'description'   => esc_html__('Choose icon for this block icon', 'jnews'),
            'group'         => esc_html__('Header', 'jnews'),
            'std'         => '',
            'settings'      => array(
                'emptyIcon'     => true,
                'iconsPerPage'  => 100,
            )
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'second_title',
            'holder'        => 'span',
            'heading'       => esc_html__('Second Title', 'jnews'),
            'description'   => esc_html__('Secondary title of Module Block.', 'jnews'),
            'group'         => esc_html__('Header', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'url',
            'heading'       => esc_html__('Title URL', 'jnews'),
            'description'   => esc_html__('Insert URL of heading title.', 'jnews'),
            'group'         => esc_html__('Header', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'radioimage',
            'param_name'    => 'header_type',
            'std'           => 'heading_6',
            'value'         => array(
                JNEWS_THEME_URL . '/assets/img/admin/heading-1.png'  => 'heading_1',
                JNEWS_THEME_URL . '/assets/img/admin/heading-2.png'  => 'heading_2',
                JNEWS_THEME_URL . '/assets/img/admin/heading-3.png'  => 'heading_3',
                JNEWS_THEME_URL . '/assets/img/admin/heading-4.png'  => 'heading_4',
                JNEWS_THEME_URL . '/assets/img/admin/heading-5.png'  => 'heading_5',
                JNEWS_THEME_URL . '/assets/img/admin/heading-6.png'  => 'heading_6',
                JNEWS_THEME_URL . '/assets/img/admin/heading-7.png'  => 'heading_7',
                JNEWS_THEME_URL . '/assets/img/admin/heading-8.png'  => 'heading_8',
                JNEWS_THEME_URL . '/assets/img/admin/heading-9.png'  => 'heading_9',
            ),
            'heading'       => esc_html__('Header Type', 'jnews'),
            'description'   => esc_html__('Choose which header type fit with your content design.', 'jnews'),
            'group'         => esc_html__('Header', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'header_background',
            'heading'       => esc_html__('Header Background', 'jnews'),
            'description'   => esc_html__('This option may not work for all of heading type.', 'jnews'),
            'group'         => esc_html__('Header', 'jnews'),
            'dependency'    => array('element' => "header_type", 'value' => array('heading_1', 'heading_2', 'heading_3', 'heading_4', 'heading_5'))
        );
        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'header_secondary_background',
            'heading'       => esc_html__('Header Secondary Background', 'jnews'),
            'description'   => esc_html__('change secondary background', 'jnews'),
            'group'         => esc_html__('Header', 'jnews'),
            'dependency'    => array('element' => "header_type", 'value' => array('heading_2'))
        );
        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'header_text_color',
            'heading'       => esc_html__('Header Text Color', 'jnews'),
            'description'   => esc_html__('Change color of your header text', 'jnews'),
            'group'         => esc_html__('Header', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'header_line_color',
            'heading'       => esc_html__('Header line Color', 'jnews'),
            'description'   => esc_html__('Change line color of your header', 'jnews'),
            'group'         => esc_html__('Header', 'jnews'),
            'dependency'    => array('element' => "header_type", 'value' => array('heading_1', 'heading_5', 'heading_6', 'heading_9'))
        );
        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'header_accent_color',
            'heading'       => esc_html__('Header Accent', 'jnews'),
            'description'   => esc_html__('Change Accent of your header', 'jnews'),
            'group'         => esc_html__('Header', 'jnews'),
            'dependency'    => array('element' => "header_type", 'value' => array('heading_6', 'heading_7'))
        );
    }
}