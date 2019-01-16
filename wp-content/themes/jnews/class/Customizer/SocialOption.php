<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

/**
 * Class Theme JNews Customizer
 */
Class SocialOption extends CustomizerOptionAbstract
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
            'id' => 'jnews_social_panel',
            'title' => esc_html__('JNews : Social, Like & View', 'jnews'),
            'description' => esc_html__('Social, Like & View Option', 'jnews'),
            'priority' => $this->id
        ));
    }

    public function set_section()
    {
        $this->add_lazy_section('jnews_social_icon_section', esc_html__('Social Icon', 'jnews'), 'jnews_social_panel');
    }
}