<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

/**
 * Class Theme JNews Customizer
 */
Class ImageOption extends CustomizerOptionAbstract
{
    public function set_option()
    {
        $this->set_panel();
        $this->set_section();
    }

    public function set_panel()
    {
        $this->customizer->add_panel(array(
            'id' => 'jnews_image_panel',
            'title' => esc_html__('JNews : Image & Gallery Option', 'jnews'),
            'description' => esc_html__('JNews Image Option', 'jnews'),
            'priority' => $this->id
        ));
    }

    public function set_section()
    {
        $this->add_lazy_section('jnews_image_global_section', esc_html__('Image Load & Generator Setting', 'jnews'), 'jnews_image_panel');
        $this->add_lazy_section('jnews_image_popup_section', esc_html__('Image Popup', 'jnews'), 'jnews_image_panel');
        $this->add_lazy_section('jnews_image_gif_section', esc_html__('GIF Image', 'jnews'), 'jnews_image_panel');
    }
}