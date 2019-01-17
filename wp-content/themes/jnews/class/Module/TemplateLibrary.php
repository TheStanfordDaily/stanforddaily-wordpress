<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module;

/**
 * Class JNews Ads
 */
Class TemplateLibrary
{
    /**
     * @var TemplateLibrary
     */
    private static $instance;

    private $category;

    /**
     * @return TemplateLibrary
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        $this->set_category();
        $this->library();

        add_filter('vc_load_default_templates', array($this, 'library'));
    }

    public function set_category()
    {
        $this->category = array(
            'footer' => esc_html__('Footer', 'jnews'),
            'contact' => esc_html__('Contact', 'jnews'),
        );
    }

    public function library()
    {
        $data               = array();
        $data['name']       = 'Homepage';
        $data['image_path'] = get_template_directory_uri() . '/images/pagebuilder/homepage.png';
        $data['custom_class'] = ''; // default is ''
        $data['content']    = <<<CONTENT
[vc_row full_width="stretch_row_content" vc_row_background="" css=".vc_custom_1490162941985{margin-top: -30px !important;}"][vc_column css=".vc_custom_1490162237805{padding-right: 0px !important;padding-left: 0px !important;}"][jnews_hero_7 compatible_column_notice="" hero_margin="2" content_filter_number_alert="" post_offset="0" unique_content="unique1" sort_by="latest"][/vc_column][/vc_row][vc_row][vc_column][jnews_element_ads compatible_column_notice="" ads_type="image" ads_image="275" ads_image_link="#"][/vc_column][/vc_row][vc_row][vc_column width="2/3"][jnews_block_18 compatible_column_notice="" number_post="5" post_offset="0" unique_content="unique1" sort_by="latest" pagination_mode="loadmore" pagination_number_post="4"][/vc_column][vc_column width="1/3" sticky_sidebar="yes" set_as_sidebar="yes"][vc_column_text][mc4wp_form][/vc_column_text][jnews_block_9 compatible_column_notice="" number_post="4" post_offset="0" sort_by="latest"][/vc_column][/vc_row]
CONTENT;

        return array($data);
    }
}