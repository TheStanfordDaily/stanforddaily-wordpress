<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;


/**
 * Class Theme JNews Customizer
 */
Class AdsOption extends CustomizerOptionAbstract
{
    public function set_option()
    {
        $this->set_panel();
        $this->set_section();
    }

    public function set_panel()
    {
        $this->customizer->add_panel(array(
            'id'            => 'jnews_ads',
            'title'         => esc_html__( 'JNews : Advertisement Option' ,'jnews' ),
            'description'   => esc_html__('JNews Advertisement Option','jnews' ),
            'priority'      => $this->id
        ));
    }

    public function set_section()
    {
        $this->add_lazy_section('jnews_ads_header_section', esc_html__('Header Ads','jnews'), 'jnews_ads');
        $this->add_lazy_section('jnews_ads_article_section', esc_html__('Article Ads','jnews'), 'jnews_ads');
        $this->add_lazy_section('jnews_ads_archive_section', esc_html__('Category Ads','jnews'), 'jnews_ads');
        $this->add_lazy_section('jnews_ads_sidefeed_section', esc_html__('Sidefeed Ads','jnews'), 'jnews_ads', array(
            'jnews_global_sidefeed_section'
        ));
        $this->add_lazy_section('jnews_ads_global_section', esc_html__('Global Ads','jnews'), 'jnews_ads');
        $this->add_lazy_section('jnews_ads_mobile_section', esc_html__('Mobile Ads','jnews'), 'jnews_ads');
    }
}