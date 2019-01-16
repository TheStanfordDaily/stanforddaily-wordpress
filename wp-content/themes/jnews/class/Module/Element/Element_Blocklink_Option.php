<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleOptionAbstract;

Class Element_Blocklink_Option extends ModuleOptionAbstract
{
    public function compatible_column()
    {
        return array( 4, 8 , 12 );
    }

    public function get_module_name()
    {
        return esc_html__('JNews - Block Link', 'jnews');
    }

	public function get_category()
	{
		return esc_html__('JNews - Element', 'jnews');
	}

    public function set_options()
    {
        $this->set_playlist_option();
        $this->set_style_option();
    }

    public function set_playlist_option()
    {
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'title',
            'heading'       => esc_html__('Title', 'jnews'),
            'description'   => esc_html__('Insert a text for block link title.', 'jnews'),
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'second_title',
            'heading'       => esc_html__('Second Title', 'jnews'),
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
        $this->options[] = array(
            'type'          => 'attach_image',
            'param_name'    => 'image',
            'heading'       => esc_html__('Background Image', 'jnews'),
            'description'   => esc_html__('Choose an image for block background.', 'jnews'),
        );

        $this->options[] = array(
            'type'          => 'checkbox',
            'param_name'    => 'use_video_bg',
            'heading'       => esc_html__('Use Video Background', 'jnews'),
            'description'   => esc_html__('If checked, video will be used as background.', 'jnews'),
        );

        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'video_url',
            'heading'       => esc_html__('YouTube Link', 'jnews'),
            'description'   => esc_html__('Add YouTube video link to used as video background.', 'jnews'),
            'dependency'    => array('element' => 'use_video_bg', 'value' => 'true'),
        );
    }
}