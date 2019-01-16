<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

/**
 * Class Theme JNews Customizer
 */
Class FooterOption extends CustomizerOptionAbstract
{
    public function set_option()
    {
        $this->set_panel();
        $this->set_section();
    }

    public function set_panel()
    {
        $this->customizer->add_panel(array(
            'id'            => 'jnews_footer',
            'title'         => esc_html__( 'JNews : Footer Option' ,'jnews' ),
            'description'   => esc_html__( 'JNews Footer Option','jnews' ),
            'priority'      => $this->id
        ));
    }

    public function set_section()
    {
        $this->add_lazy_section('jnews_footer_layout_section', esc_html__('Footer Layout','jnews'), 'jnews_footer');
        $this->add_lazy_section('jnews_footer_global_section', esc_html__('Footer Option','jnews' ), 'jnews_footer', array(
            'jnews_footer_layout_section',
            'jnews_global_layout_section'
        ));
    }

}