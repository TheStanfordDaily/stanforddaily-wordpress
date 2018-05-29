<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Block;

use JNews\Module\ModuleOptionAbstract;

abstract Class BlockOptionAbstract extends ModuleOptionAbstract
{
    protected $default_number_post = 5;
    protected $show_excerpt = false;
    protected $show_ads = false;
    protected $default_ajax_post = 5;

    public function compatible_column()
    {
        return array( 4, 8 , 12 );
    }

    public function set_options()
    {
        $this->set_header_option();
        $this->set_header_filter_option();
        $this->set_content_filter_option($this->default_number_post);
        $this->set_content_setting_option($this->show_excerpt);
        $this->set_ajax_filter_option($this->default_ajax_post);
        $this->set_ads_setting_option($this->show_ads);
        $this->set_style_option();
    }

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

    public function additional_style()
    {
        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'title_color',
            'group'         => esc_html__('Design', 'jnews'),
            'heading'       => esc_html__('Title Color', 'jnews'),
            'description'   => esc_html__('This option will change your Title color', 'jnews'),
        );

        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'accent_color',
            'group'         => esc_html__('Design', 'jnews'),
            'heading'       => esc_html__('Accent Color & Link Hover', 'jnews'),
            'description'   => esc_html__('This option will change your accent color', 'jnews'),
        );

        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'alt_color',
            'group'         => esc_html__('Design', 'jnews'),
            'heading'       => esc_html__('Meta Color', 'jnews'),
            'description'   => esc_html__('This option will change your meta color', 'jnews'),
        );

        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'excerpt_color',
            'group'         => esc_html__('Design', 'jnews'),
            'heading'       => esc_html__('Excerpt Color', 'jnews'),
            'description'   => esc_html__('This option will change your excerpt color', 'jnews'),
        );
    }

    /**
     * @return array
     */
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
            'param_name'    => 'first_title',
            'holder'        => 'span',
            'heading'       => esc_html__('Title', 'jnews'),
            'description'   => esc_html__('Main title of Module Block.', 'jnews'),
            'group'         => esc_html__('Header', 'jnews'),
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

    /**
     * @return array
     */
    public function set_header_filter_option()
    {
        $this->options[] = array(
            'type'          => 'multicategory',
            'param_name'    => 'header_filter_category',
            'heading'       => esc_html__('Category', 'jnews'),
            'description'   => esc_html__('Add category filter for heading module.', 'jnews'),
            'group'         => esc_html__('Header Filter', 'jnews'),
            'std'           => '',
            'value'         => jnews_get_all_author()
        );
        $this->options[] = array(
            'type'          => 'multiauthor',
            'param_name'    => 'header_filter_author',
            'heading'       => esc_html__('Author', 'jnews'),
            'description'   => esc_html__('Add author filter for heading module.', 'jnews'),
            'group'         => esc_html__('Header Filter', 'jnews'),
            'std'           => '',
            'value'         => jnews_get_all_author(),
        );
        $this->options[] = array(
            'type'          => 'multitag',
            'param_name'    => 'header_filter_tag',
            'heading'       => esc_html__('Tags', 'jnews'),
            'description'   => esc_html__('Add tag filter for heading module.', 'jnews'),
            'group'         => esc_html__('Header Filter', 'jnews'),
            'std'           => '',
            'value'         => jnews_get_all_tag(),
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'header_filter_text',
            'heading'       => esc_html__('Default Text', 'jnews'),
            'description'   => esc_html__('First item text on heading filter.', 'jnews'),
            'group'         => esc_html__('Header Filter', 'jnews'),
            'std'           => 'All'
        );
    }

    public function set_content_setting_option($show_excerpt = false)
    {
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'date_format',
            'heading'       => esc_html__('Content Date Format', 'jnews'),
            'description'   => esc_html__('Choose which date format you want to use.', 'jnews'),
            'std'           => 'default',
            'group'         => esc_html__('Content Setting', 'jnews'),
            'value'         => array(
                esc_html__('Relative Date/Time Format (ago)', 'jnews')               => 'ago',
                esc_html__('WordPress Default Format', 'jnews')      => 'default',
                esc_html__('Custom Format', 'jnews')                 => 'custom',
            )
        );

        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'date_format_custom',
            'heading'       => esc_html__('Custom Date Format', 'jnews'),
            'description'   => wp_kses(sprintf(__('Please write custom date format for your module, for more detail about how to write date format, you can refer to this <a href="%s" target="_blank">link</a>.', 'jnews'), 'https://codex.wordpress.org/Formatting_Date_and_Time'), wp_kses_allowed_html()),
            'group'         => esc_html__('Content Setting', 'jnews'),
            'std'           => 'Y/m/d',
            'dependency'    => array('element' => 'date_format', 'value' => array('custom'))
        );

        if($show_excerpt)
        {
            $this->options[] = array(
                'type'          => 'slider',
                'param_name'    => 'excerpt_length',
                'heading'       => esc_html__('Excerpt Length', 'jnews'),
                'description'   => esc_html__('Set word length of excerpt on post block.', 'jnews'),
                'group'         => esc_html__('Content Setting', 'jnews'),
                'min'           => 0,
                'max'           => 200,
                'step'          => 1,
                'std'           => 20,
            );

            $this->options[] = array(
                'type'          => 'textfield',
                'param_name'    => 'excerpt_ellipsis',
                'heading'       => esc_html__('Excerpt Ellipsis', 'jnews'),
                'description'   => esc_html__('Define excerpt ellipsis', 'jnews'),
                'group'         => esc_html__('Content Setting', 'jnews'),
                'std'           => '...'
            );
        }
    }

    public function set_ajax_filter_option($number = 10)
    {
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'pagination_mode',
            'heading'       => esc_html__('Choose Pagination Mode', 'jnews'),
            'description'   => esc_html__('Choose which pagination mode that fit with your block.', 'jnews'),
            'group'         => esc_html__('Pagination', 'jnews'),
            'std'           => 'disable',
            'value'         => array(
                esc_html__('No Pagination', 'jnews')             => 'disable',
                esc_html__('Next Prev', 'jnews')                 => 'nextprev',
                esc_html__('Load More', 'jnews')                 => 'loadmore',
                esc_html__('Auto Load on Scroll', 'jnews')       => 'scrollload',
            )
        );
        $this->options[] = array(
            'type'          => 'slider',
            'param_name'    => 'pagination_number_post',
            'heading'       => esc_html__('Pagination Post', 'jnews'),
            'description'   => esc_html__('Number of Post loaded during pagination request.', 'jnews'),
            'group'         => esc_html__('Pagination', 'jnews'),
            'min'           => 1,
            'max'           => 30,
            'step'          => 1,
            'std'           => $number,
            'dependency'    => array('element' => "pagination_mode", 'value' => array('nextprev','loadmore','scrollload'))
        );
        $this->options[] = array(
            'type'          => 'number',
            'param_name'    => 'pagination_scroll_limit',
            'heading'       => esc_html__('Auto Load Limit', 'jnews'),
            'description'   => esc_html__('Limit of auto load when scrolling, set to zero to always load until end of content.', 'jnews'),
            'group'         => esc_html__('Pagination', 'jnews'),
            'min'           => 0,
            'max'           => 9999,
            'step'          => 1,
            'std'           => 0,
            'dependency'    => array('element' => "pagination_mode", 'value' => array('scrollload'))
        );
    }

    public function set_ads_setting_option( $show_ads = false )
    {
        if ( ! $show_ads ) return false;

        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'ads_type',
            'heading'       => esc_html__('Ads Type', 'jnews'),
            'description'   => esc_html__('Choose which ads type you want to use.', 'jnews'),
            'group'         => esc_html__('Ads', 'jnews'),
            'std'           => 'disable',
            'value'         => array(
                esc_html__('Disable Ads', 'jnews')   => 'disable',
                esc_html__('Image Ads', 'jnews')     => 'image',
                esc_html__('Google Ads', 'jnews')    => 'googleads',
                esc_html__('Script Code', 'jnews')   => 'code'
            )
        );
        $this->options[] = array(
            'type'          => 'slider',
            'param_name'    => 'ads_position',
            'heading'       => esc_html__('Ads Position', 'jnews'),
            'description'   => esc_html__('Set after certain number of post you want this advertisement to show.', 'jnews'),
            'group'         => esc_html__('Ads', 'jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('image', 'code', 'googleads')),
            'min'           => 1,
            'max'           => 10,
            'step'          => 1,
            'std'           => 1,
        );
        $this->options[] = array(
            'type'          => 'checkbox',
            'param_name'    => 'ads_random',
            'heading'       => esc_html__('Random Ads Position', 'jnews'),
            'value'         => array( esc_html__("Set after random certain number of post you want this advertisement to show.", "jnews") => 'yes' ),
            'group'         => esc_html__('Ads', 'jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('image', 'code', 'googleads'))
        );
        // IMAGE
        $this->options[] = array(
            'type'          => 'attach_image',
            'param_name'    => 'ads_image',
            'heading'       => esc_html__('Ads Image', 'jnews'),
            'description'   => esc_html__('Upload your ads image.', 'jnews'),
            'group'         => esc_html__('Ads', 'jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('image'))
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'ads_image_link',
            'heading'       => esc_html__('Ads Image Link', 'jnews'),
            'description'   => esc_html__('Insert link of your image ads.','jnews'),
            'group'         => esc_html__('Ads', 'jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('image'))
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'ads_image_alt',
            'heading'       => esc_html__('Image Alternate Text','jnews'),
            'description'   => esc_html__('Insert alternate of your ads image.','jnews'),
            'group'         => esc_html__('Ads', 'jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('image'))
        );
        $this->options[] = array(
            'type'          => 'checkbox',
            'param_name'    => 'ads_image_new_tab',
            'heading'       => esc_html__('Open New Tab','jnews'),
            'value'         => array( esc_html__("Open in new tab when ads image clicked.", "jnews") => 'yes' ),
            'group'         => esc_html__('Ads', 'jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('image'))
        );
        // GOOGLE
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'google_publisher_id',
            'heading'       => esc_html__('Publisher ID','jnews'),
            'description'   => esc_html__('Insert data-ad-client / google_ad_client content.','jnews'),
            'group'         => esc_html__('Ads', 'jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('googleads'))
        );
        $this->options[] = array(
            'type'          => 'textfield',
            'param_name'    => 'google_slot_id',
            'heading'       => esc_html__('Ads Slot ID','jnews'),
            'description'   => esc_html__('Insert data-ad-slot / google_ad_slot content.','jnews'),
            'group'         => esc_html__('Ads', 'jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('googleads'))
        );
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'google_desktop',
            'heading'       => esc_html__('Desktop Ads Size','jnews'),
            'description'   => esc_html__('Choose ads size to show on desktop.','jnews'),
            'group'         => esc_html__('Ads', 'jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('googleads')),
            'std'           => 'auto',
            'value'         => $this->get_ad_size()
        );
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'google_tab',
            'heading'       => esc_html__('Tab Ads Size','jnews'),
            'description'   => esc_html__('Choose ads size to show on tab.','jnews'),
            'group'         => esc_html__('Ads', 'jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('googleads')),
            'std'           => 'auto',
            'value'         => $this->get_ad_size()
        );
        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'google_phone',
            'heading'       => esc_html__('Phone Ads Size','jnews'),
            'description'   => esc_html__('Choose ads size to show on phone.','jnews'),
            'group'         => esc_html__('Ads', 'jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('googleads')),
            'std'           => 'auto',
            'value'         => $this->get_ad_size()
        );
        // CODE
        $this->options[] = array(
            'type'          => 'textarea_html',
            'param_name'    => 'code',
            'heading'       => esc_html__('Script Ads Code','jnews'),
            'description'   => esc_html__('Put your full ads script right here.','jnews'),
            'group'         => esc_html__('Ads', 'jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('code'))
        );
        $this->options[] = array(
            'type'          => 'checkbox',
            'param_name'    => 'ads_bottom_text',
            'heading'       => esc_html__('Show Advertisement Text', 'jnews'),
            'description'   => esc_html__('Show Advertisement Text on bottom of advertisement', 'jnews'),
            'group'         => esc_html__('Ads', 'jnews'),
            'dependency'    => Array('element' => "ads_type", 'value' => array('image'))
        );
    }
}