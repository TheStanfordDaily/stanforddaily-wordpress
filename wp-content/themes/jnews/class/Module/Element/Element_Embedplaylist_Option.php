<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleOptionAbstract;

Class Element_Embedplaylist_Option extends ModuleOptionAbstract
{
    public function compatible_column()
    {
        return array( 4, 8 , 12 );
    }

    public function get_category()
    {
	    return esc_html__( 'JNews - Element', 'jnews' );
    }

	public function show_color_scheme()
    {
        return false;
    }

    public function set_options()
    {
        $this->set_playlist_option();
        $this->set_style_option();
    }

    public function get_module_name()
    {
        return esc_html__('JNews - Youtube / Vimeo Playlist', 'jnews');
    }

    public function set_playlist_option()
    {
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'layout',
            'heading'       => esc_html__('Video Playlist Layout', 'jnews'),
            'description'   => esc_html__('Choose video playlist layout.', 'jnews'),
            'std'           => 'default',
            'value'         => array(
                esc_html__('Horizontal', 'jnews')    => 'horizontal',
                esc_html__('Vertical', 'jnews')      => 'vertical',
            )
        );
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'scheme',
            'heading'       => esc_html__('Video Playlist Scheme', 'jnews'),
            'description'   => esc_html__('Choose video scheme color.', 'jnews'),
            'std'           => 'light',
            'value'         => array(
                esc_html__('Light Scheme', 'jnews')      => 'light',
                esc_html__('Dark Scheme', 'jnews')    => 'dark',
            )
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'playlist',
            'heading'       => esc_html__('YouTube / Vimeo Video', 'jnews'),
            'description'   => esc_html__('Enter your youtube / vimeo video separated by comma (Ex : https://www.youtube.com/watch?v=IvcE4o36cAo, https://vimeo.com/180337696).', 'jnews'),
        );
    }
}
