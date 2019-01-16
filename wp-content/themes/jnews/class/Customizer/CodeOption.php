<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

/**
 * Class Theme JNews Customizer
 */
Class CodeOption extends CustomizerOptionAbstract
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
        $this->set_section();
        $this->set_code_field();
    }

    public function set_section()
    {
        $this->customizer->add_section(array(
            'id' => 'jnews_code_section',
            'title' => esc_html__('Additonal Javascript', 'jnews'),
            'panel' => '',
            'priority' => 250,
        ));
    }

    public function set_code_field()
    {
        $this->customizer->add_field(array(
            'id'            => 'jnews_additional_js',
            'transport'     => 'refresh',
            'default'       => '',
            'sanitize'      => 'jnews_sanitize_by_pass',
            'type'          => 'jnews-textarea',
            'section'       => 'jnews_code_section',
            'label'         => esc_html__('Additional Javascript', 'jnews'),
            'description'   => esc_html__('put your additional javascript code right here.','jnews'),
        ));
    }
}