<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

/**
 * Class Theme JNews Customizer
 */
Class FontOption extends CustomizerOptionAbstract
{

    /** @var string section */
    private $section_typekit_font = 'jnews_typekit_font_section';

    /**
     * Set Section
     */
    public function set_option()
    {
        $this->set_panel();
        $this->set_section();

        $this->set_typekit_font_field();
    }

    public function set_panel()
    {
        /** panel */
        $this->customizer->add_panel(array(
            'id'            => 'jnews_font',
            'title'         => esc_html__( 'JNews : Font Option' ,'jnews' ),
            'description'   => esc_html__( 'JNews Font Management','jnews' ),
            'priority'      => $this->id
        ));
    }

    public function set_section()
    {
        $this->add_lazy_section('jnews_font_global_section', esc_html__('Global Font','jnews'), 'jnews_font');
        $this->add_lazy_section('jnews_font_additional_section', esc_html__('Custom Font','jnews'), 'jnews_font');
        $this->add_lazy_section('jnews_font_typekit_section', esc_html__('Type Kit font','jnews'), 'jnews_font');
    }


    public function set_typekit_font_field()
    {

    }
}