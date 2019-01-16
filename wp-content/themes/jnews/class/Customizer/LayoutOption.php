<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

/**
 * Class Theme JNews Customizer
 */
Class LayoutOption extends CustomizerOptionAbstract
{
    /** section */

    public function __construct($customizer, $id)
    {
        parent::__construct($customizer, $id);
    }

    /**
     * Set Section
     */
    public function set_option()
    {
        $this->set_panel();
        $this->set_section();
    }

    public function set_panel()
    {
        /** panel */
        $this->customizer->add_panel(array(
            'id' => 'jnews_layout_panel',
            'title' => esc_html__('JNews : Layout, Color & Scheme', 'jnews'),
            'description' => esc_html__('JNews Layout Option', 'jnews'),
            'priority' => $this->id
        ));
    }

    public function set_section()
    {
        $this->add_lazy_section('jnews_global_layout_section', esc_html__('Layout & Background', 'jnews'), 'jnews_layout_panel');
        $this->add_lazy_section('jnews_global_sidefeed_section', esc_html__('Sidefeed Setting', 'jnews'), 'jnews_layout_panel');
        $this->add_lazy_section('jnews_global_color_section', esc_html__('Scheme & Website Color', 'jnews'), 'jnews_layout_panel', array(
            'jnews_global_layout_section'
        ));
        $this->add_lazy_section('jnews_global_browser_section', esc_html__('Mobile Browser Color', 'jnews'), 'jnews_layout_panel');
    }
}