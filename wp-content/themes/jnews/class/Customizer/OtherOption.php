<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

/**
 * Class Theme JNews Customizer
 */
Class OtherOption extends CustomizerOptionAbstract
{
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
            'id' => 'jnews_global_panel',
            'title' => esc_html__('JNews : Additional Option', 'jnews'),
            'description' => esc_html__('JNews Additional Option', 'jnews'),
            'priority' => $this->id
        ));
    }

    public function set_section()
    {
        $this->add_lazy_section('jnews_global_loader_section', esc_html__('Loader Setting','jnews'), 'jnews_global_panel');
	    $this->add_lazy_section('jnews_global_gdpr_section', esc_html__('GDPR Compliance','jnews'), 'jnews_global_panel');
    }
}