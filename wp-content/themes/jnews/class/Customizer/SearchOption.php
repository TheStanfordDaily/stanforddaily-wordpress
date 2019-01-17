<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

/**
 * Class Theme JNews Customizer
 */
Class SearchOption extends CustomizerOptionAbstract
{
    public function __construct($customizer, $id)
    {
        parent::__construct($customizer, $id);
    }

    public function set_option()
    {
        $this->set_panel();
        $this->set_section();
    }

    public function set_panel()
    {
        $this->customizer->add_panel(array(
            'id' => 'jnews_search_panel',
            'title' => esc_html__('JNews : Search Option', 'jnews'),
            'description' => esc_html__('Search Option', 'jnews'),
            'priority' => $this->id
        ));
    }

    public function set_section()
    {
        $this->add_lazy_section('jnews_search_option_section', esc_html__('Search Content', 'jnews'), 'jnews_search_panel');
        $this->add_lazy_section('jnews_search_live_section', esc_html__('Live Search Setting', 'jnews'), 'jnews_search_panel');
    }
}