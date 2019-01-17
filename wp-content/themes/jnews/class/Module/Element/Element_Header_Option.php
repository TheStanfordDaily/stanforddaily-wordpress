<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleOptionAbstract;

Class Element_Header_Option extends ModuleOptionAbstract
{
    public function compatible_column()
    {
        return array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 );
    }

    public function get_module_name()
    {
        return esc_html__('JNews - Header Module', 'jnews');
    }

    public function get_category()
    {
	    return esc_html__('JNews - Element', 'jnews');
    }

	public function set_options()
    {
        $this->set_header_option();
        $this->set_style_option();
    }

    public function set_header_option()
    {
        $this->options[] = array(
            'type'          => 'iconpicker',
            'param_name'    => 'header_icon',
            'heading'       => esc_html__('Header Icon', 'jnews'),
            'description'   => esc_html__('Choose icon for this block icon', 'jnews'),
            'std'         => '',
            'settings'      => array(
                'emptyIcon'     => true,
                'iconsPerPage'  => 100,
            )
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'first_title',
            'holder'        => 'span',
            'heading'       => esc_html__('Title', 'jnews'),
            'description'   => esc_html__('Main title of Module Block.', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'second_title',
            'holder'        => 'span',
            'heading'       => esc_html__('Second Title', 'jnews'),
            'description'   => esc_html__('Secondary title of Module Block.', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'url',
            'heading'       => esc_html__('Title URL', 'jnews'),
            'description'   => esc_html__('Insert URL of heading title.', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'radioimage',
            'param_name'    => 'header_type',
            'std'           => 'heading_1',
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
        );
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'header_align',
            'heading'       => esc_html__('Header Align', 'jnews'),
            'description'   => esc_html__('Choose which header alignment you want to use.', 'jnews'),
            'std'           => 'left',
            'value'         => array(
                esc_html__('Left', 'jnews')              => 'left',
                esc_html__('Center', 'jnews')            => 'center',
            )
        );
        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'header_background',
            'heading'       => esc_html__('Header Background', 'jnews'),
            'description'   => esc_html__('This option may not work for all of heading type.', 'jnews'),
            'dependency'    => array('element' => "header_type", 'value' => array('heading_1', 'heading_2', 'heading_3', 'heading_4', 'heading_5')),
        );
        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'header_secondary_background',
            'heading'       => esc_html__('Header Secondary Background', 'jnews'),
            'description'   => esc_html__('change secondary background', 'jnews'),
            'dependency'    => array('element' => "header_type", 'value' => array('heading_2'))
        );
        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'header_text_color',
            'heading'       => esc_html__('Header Text Color', 'jnews'),
            'description'   => esc_html__('Change color of your header text', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'header_line_color',
            'heading'       => esc_html__('Header line Color', 'jnews'),
            'description'   => esc_html__('Change line color of your header', 'jnews'),
            'dependency'    => array('element' => "header_type", 'value' => array('heading_1', 'heading_5', 'heading_6', 'heading_9'))
        );
        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'header_accent_color',
            'heading'       => esc_html__('Header Accent', 'jnews'),
            'description'   => esc_html__('Change Accent of your header', 'jnews'),
            'dependency'    => array('element' => "header_type", 'value' => array('heading_6', 'heading_7'))
        );
    }
}
