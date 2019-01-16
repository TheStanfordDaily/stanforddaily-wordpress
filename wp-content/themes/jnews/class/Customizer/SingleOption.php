<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

/**
 * Class Theme JNews Customizer
 */
Class SingleOption extends CustomizerOptionAbstract
{
    public function set_option()
    {
        $this->set_panel();
        $this->set_section();
    }

    public function single_post_tag()
    {
        return array(
            'redirect'  => 'single_post_tag',
            'refresh'   => false
        );
    }

    public function set_panel()
    {
        $this->customizer->add_panel(array(
            'id' => 'jnews_single_post_panel',
            'title' => esc_html__('JNews : Single Post Option', 'jnews'),
            'description' => esc_html__('JNews Single Post Option', 'jnews'),
            'priority' => $this->id
        ));
    }

    public function set_section()
    {
        $this->add_lazy_section('jnews_single_breadcrumb_section', esc_html__('Breadcrumb Setting', 'jnews'), 'jnews_single_post_panel');
        $this->add_lazy_section('jnews_single_post_section', esc_html__('Single Post Option', 'jnews'), 'jnews_single_post_panel');
        $this->add_lazy_section('jnews_single_related_section', esc_html__('Related Post Option', 'jnews'), 'jnews_single_post_panel');
        $this->add_lazy_section('jnews_single_comment_section', esc_html__('Comment Setting', 'jnews'), 'jnews_single_post_panel');
        $this->add_lazy_section('jnews_single_mobile_truncate_section', esc_html__('Mobile Truncate', 'jnews'), 'jnews_single_post_panel');
    }
}