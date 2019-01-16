<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleOptionAbstract;

Class Element_Socialiconitem_Option extends ModuleOptionAbstract
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
        return esc_html__('JNews - Social Icon Item', 'jnews');
    }

	public function get_module_child()
	{
		return array('only' => 'jnews_element_socialiconwrapper');
	}

    public function set_options()
    {
        $this->get_option();
    }

    public function get_option()
    {
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'social_icon',
            'heading'       => esc_html__('Social Icon', 'jnews'),
            'description'   => esc_html__('Choose your social account.', 'jnews'),
            'std'           => '',
            'value'         => array(
                esc_html__('Choose Icon', 'jnews')  => '',
                esc_html__('Facebook', 'jnews')     => 'facebook',
                esc_html__('Twitter', 'jnews')      => 'twitter',
                esc_html__('Linkedin', 'jnews')     => 'linkedin',
                esc_html__('Google+', 'jnews')      => 'googleplus',
                esc_html__('Pinterest', 'jnews')    => 'pinterest',
                esc_html__('Behance', 'jnews')      => 'behance',
                esc_html__('Github', 'jnews')       => 'github',
                esc_html__('Flickr', 'jnews')       => 'flickr',
                esc_html__('Tumblr', 'jnews')       => 'tumblr',
                esc_html__('Dribbble', 'jnews')     => 'dribbble',
                esc_html__('Soundcloud', 'jnews')   => 'soundcloud',
                esc_html__('Instagram', 'jnews')    => 'instagram',
                esc_html__('Vimeo', 'jnews')        => 'vimeo',
                esc_html__('YouTube', 'jnews')      => 'youtube',
                esc_html__('Twitch', 'jnews')       => 'twitch',
                esc_html__('Vk', 'jnews')           => 'vk',
                esc_html__('Reddit', 'jnews')       => 'reddit',
                esc_html__('Weibo', 'jnews')        => 'weibo',
                esc_html__('RSS', 'jnews')          => 'rss',
            ),
        );

	    $this->options[] = array(
		    'type'          => 'textfield',
		    'param_name'    => 'social_url',
		    'heading'       => esc_html__('Social URL', 'jnews'),
		    'description'   => esc_html__('Insert your social account url.', 'jnews')
	    );
    }
}