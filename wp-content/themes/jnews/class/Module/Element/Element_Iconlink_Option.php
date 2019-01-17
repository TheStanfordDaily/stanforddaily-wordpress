<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleOptionAbstract;

Class Element_Iconlink_Option extends ModuleOptionAbstract
{
    public function compatible_column()
    {
        return array(1,2,3,4,5,6,7,8,9,10,11,12);
    }

    public function get_module_name()
    {
        return esc_html__('JNews - Icon Link', 'jnews');
    }

    public function get_category()
    {
	    return esc_html__('JNews - Element', 'jnews');
    }

	public function set_options()
    {
        $this->set_icon_option();
        $this->set_style_option();
    }

    public function set_icon_option()
    {
        $this->options[] = array(
            'type'          => 'iconpicker',
            'param_name'    => 'icon',
            'heading'       => esc_html__('Icon', 'jnews'),
            'description'   => esc_html__('Choose icon for this icon link', 'jnews'),
            'std'         => 'fa fa-bolt',
            'settings'      => array(
                'emptyIcon'     => false,
                'iconsPerPage'  => 100,
            )
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'title',
            'heading'       => esc_html__('Title', 'jnews'),
            'description'   => esc_html__('Insert a text for block link title.', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'subtitle',
            'heading'       => esc_html__('Subtitle', 'jnews'),
            'description'   => esc_html__('Sub title or short description.', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'title_url',
            'heading'       => esc_html__('Title URL', 'jnews'),
            'description'   => esc_html__('Url of block link title.', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'checkbox',
            'param_name'    => 'newtab',
            'heading'       => esc_html__('Open New Tab', 'jnews'),
            'description'   => esc_html__('Check this option to open link on new tab.', 'jnews'),
        );
    }
}