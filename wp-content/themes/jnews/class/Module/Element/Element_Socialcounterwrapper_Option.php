<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleOptionAbstract;

Class Element_Socialcounterwrapper_Option extends ModuleOptionAbstract
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
        return esc_html__('JNews - Social Counter Wrapper', 'jnews');
    }

	public function get_module_parent()
	{
		return array( 'only' => 'jnews_element_socialcounteritem' );
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
            'param_name'    => 'column',
            'heading'       => esc_html__('Number of Column', 'jnews'),
            'description'   => esc_html__('Set the number of social counter column.', 'jnews'),
            'std'           => 'col1',
            'value'         => array(
                esc_html__('1 Column', 'jnews')     => 'col1',
                esc_html__('2 Columns', 'jnews')    => 'col2',
                esc_html__('3 Columns', 'jnews')    => 'col3',
                esc_html__('4 Columns', 'jnews')    => 'col4',
            ),
        );

	    $this->options[] = array(
		    'type'          => 'dropdown',
		    'param_name'    => 'style',
		    'heading'       => esc_html__('Social Style', 'jnews'),
		    'description'   => esc_html__('Choose your social counter style.', 'jnews'),
		    'std'           => 'light',
		    'value'         => array(
			    esc_html__('Light', 'jnews')    => 'light',
			    esc_html__('Colored', 'jnews')  => 'colored',
		    ),
	    );

	    $this->options[] = array(
		    'type'          => 'checkbox',
		    'param_name'    => 'newtab',
		    'heading'       => esc_html__('Open New Tab', 'jnews'),
		    'description'   => esc_html__('Open social account page on new tab.', 'jnews')
	    );

	    $this->options[] = array(
		    'type'          => 'textfield',
		    'param_name'    => 'fb_id',
		    'heading'       => esc_html__('Facebook App ID','jnews'),
		    'description'   => sprintf(__('You can create an application and get Facebook App ID <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://developers.facebook.com/docs/apps/register')
	    );

	    $this->options[] = array(
		    'type'          => 'textfield',
		    'param_name'    => 'fb_secret',
		    'heading'       => esc_html__('Facebook App Secret','jnews'),
		    'description'   => sprintf(__('You can create an application and get Facebook App Secret <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://developers.facebook.com/docs/apps/register')
	    );

	    $this->options[] = array(
		    'type'          => 'textfield',
		    'param_name'    => 'fb_key',
		    'heading'       => esc_html__('Facebook Access Token','jnews'),
		    'description'   => sprintf(__('Get your Facebook Access Token by clicking this <a class="%s" href="%s" target="_blank">link</a>.<i class="jnews-spinner fa fa-spinner fa-pulse"></i>', 'jnews'), 'jnews_token_access facebook', '#')
	    );

	    $this->options[] = array(
		    'type'          => 'textfield',
		    'param_name'    => 'gg_key',
		    'heading'       => esc_html__('Google API Key','jnews'),
		    'description'   => sprintf(__('You can register Google API Key here for <a href="%s" target="_blank">Google+</a> and <a href="%s" target="_blank">YouTube</a>.', 'jnews'), 'https://developers.google.com/+/web/api/rest/oauth', 'https://developers.google.com/youtube/v3/getting-started')
	    );

	    $this->options[] = array(
		    'type'          => 'textfield',
		    'param_name'    => 'bh_key',
		    'heading'       => esc_html__('Behance API Key','jnews'),
		    'description'   => sprintf(__('You can register Behance API Key <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://www.behance.net/dev/register')
	    );

	    $this->options[] = array(
		    'type'          => 'textfield',
		    'param_name'    => 'twitch_key',
		    'heading'       => esc_html__('Twitch Client ID','jnews'),
		    'description'   => sprintf(__('You can create an application and get Twitch Client ID <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://dev.twitch.tv/docs/v5/guides/authentication/')
	    );

	    $this->options[] = array(
		    'type'          => 'textfield',
		    'param_name'    => 'vk_id',
		    'heading'       => esc_html__('VK User ID','jnews'),
		    'description'   => esc_html__('Insert your VK user id.', 'jnews'),
	    );

	    $this->options[] = array(
		    'type'          => 'textfield',
		    'param_name'    => 'rss_count',
		    'heading'       => esc_html__('RSS Subscriber','jnews'),
		    'description'   => esc_html__('Insert the number of RSS subscriber.', 'jnews'),
	    );
    }
}