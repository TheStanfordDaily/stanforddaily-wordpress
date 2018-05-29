<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleOptionAbstract;

Class Element_Ads_Option extends ModuleOptionAbstract
{
    protected function get_ad_size()
    {
        return array(
            esc_attr__('Auto', 'jnews')              => 'auto',
            esc_attr__('Hide', 'jnews')              => 'hide',
            esc_attr__('120 x 90', 'jnews')          => '120x90',
            esc_attr__('120 x 240', 'jnews')         => '120x240',
            esc_attr__('120 x 600', 'jnews')         => '120x600',
            esc_attr__('125 x 125', 'jnews')         => '125x125',
            esc_attr__('160 x 90', 'jnews')          => '160x90',
            esc_attr__('160 x 600', 'jnews')         => '160x600',
            esc_attr__('180 x 90', 'jnews')          => '180x90',
            esc_attr__('180 x 150', 'jnews')         => '180x150',
            esc_attr__('200 x 90', 'jnews')          => '200x90',
            esc_attr__('200 x 200', 'jnews')         => '200x200',
            esc_attr__('234 x 60', 'jnews')          => '234x60',
            esc_attr__('250 x 250', 'jnews')         => '250x250',
            esc_attr__('320 x 100', 'jnews')         => '320x100',
            esc_attr__('300 x 250', 'jnews')         => '300x250',
            esc_attr__('300 x 600', 'jnews')         => '300x600',
            esc_attr__('320 x 50', 'jnews')          => '320x50',
            esc_attr__('336 x 280', 'jnews')         => '336x280',
            esc_attr__('468 x 15', 'jnews')          => '468x15',
            esc_attr__('468 x 60', 'jnews')          => '468x60',
            esc_attr__('728 x 15', 'jnews')          => '728x15',
            esc_attr__('728 x 90', 'jnews')          => '728x90',
            esc_attr__('970 x 90', 'jnews')          => '970x90',
            esc_attr__('240 x 400', 'jnews')         => '240x400',
            esc_attr__('250 x 360', 'jnews')         => '250x360',
            esc_attr__('580 x 400', 'jnews')         => '580x400',
            esc_attr__('750 x 100', 'jnews')         => '750x100',
            esc_attr__('750 x 200', 'jnews')         => '750x200',
            esc_attr__('750 x 300', 'jnews')         => '750x300',
            esc_attr__('980 x 120', 'jnews')         => '980x120',
            esc_attr__('930 x 180', 'jnews')         => '930x180',
        );
    }

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
        return esc_html__('JNews - Ads Block', 'jnews');
    }

    public function set_options()
    {
        $this->get_ads_option();
        $this->set_style_option();
    }

    public function get_ads_option()
    {
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'ads_type',
            'heading'       => esc_html__('Ads Type', 'jnews'),
            'description'   => esc_html__('Choose which ads type you want to use.', 'jnews'),
            'std'           => 'googleads',
            'value'         => array(
                esc_html__('Image Ads', 'jnews')     => 'image',
                esc_html__('Script Code', 'jnews')   => 'code',
                esc_html__('Google Ads', 'jnews')    => 'googleads',
            ),
        );
        // IMAGE
        $this->options[] = array(
            'type'          => 'attach_image',
            'param_name'    => 'ads_image',
            'heading'       => esc_html__('[Image Ads] Ads Image', 'jnews'),
            'description'   => esc_html__('Upload your ads image.', 'jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('image'))
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'ads_image_link',
            'heading'       => esc_html__('[Image Ads] Ads Image Link', 'jnews'),
            'description'   => esc_html__('Insert link of your image ads.','jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('image'))
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'ads_image_alt',
            'heading'       => esc_html__('[Image Ads] Image Alternate Text','jnews'),
            'description'   => esc_html__('Insert alternate of your ads image.','jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('image'))
        );
        $this->options[] = array(
            'type'          => 'checkbox',
            'param_name'    => 'ads_image_new_tab',
            'heading'       => esc_html__('[Image Ads] Open New Tab','jnews'),
            'value'         => array( "Open in new tab when ads image clicked." => 'yes' ),
            'dependency'    => Array('element' => "ads_type", 'value' => array('image'))
        );
        // GOOGLE
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'google_publisher_id',
            'heading'       => esc_html__('[Google Ads] Publisher ID','jnews'),
            'description'   => esc_html__('Insert data-ad-client / google_ad_client content.','jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('googleads'))
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'google_slot_id',
            'heading'       => esc_html__('[Google Ads] Ads Slot ID','jnews'),
            'description'   => esc_html__('Insert data-ad-slot / google_ad_slot content.','jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('googleads'))
        );
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'google_desktop',
            'heading'       => esc_html__('[Google Ads] Desktop Ads Size','jnews'),
            'description'   => esc_html__('Choose ads size to show on desktop.','jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('googleads')),
            'std'           => 'auto',
            'value'         => $this->get_ad_size()
        );
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'google_tab',
            'heading'       => esc_html__('[Google Ads] Tab Ads Size','jnews'),
            'description'   => esc_html__('Choose ads size to show on tab.','jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('googleads')),
            'std'           => 'auto',
            'value'         => $this->get_ad_size()
        );
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'google_phone',
            'heading'       => esc_html__('[Google Ads] Phone Ads Size','jnews'),
            'description'   => esc_html__('Choose ads size to show on phone.','jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('googleads')),
            'std'           => 'auto',
            'value'         => $this->get_ad_size()
        );
        // CODE
        $this->options[] = array(
            'type'          => 'textarea_html',
            'param_name'    => 'content',
            'heading'       => esc_html__('[Script Code] Ads Code','jnews'),
            'description'   => esc_html__('Put your full ads script right here.','jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('code'))
        );
        $this->options[] = array(
            'type'          => 'checkbox',
            'param_name'    => 'ads_bottom_text',
            'heading'       => esc_html__('Show Advertisement Text', 'jnews'),
            'description'   => esc_html__('Show Advertisement Text on bottom of advertisement', 'jnews'),
        );
    }
}