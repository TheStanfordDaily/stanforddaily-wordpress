<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

/**
 * Class Theme JNews Customizer
 */
Class BlockOption extends CustomizerOptionAbstract
{
    public function set_option()
    {
        $this->set_section();
    }

    public function set_section()
    {
        $this->add_lazy_section('jnews_block_section', esc_html__('JNews : Global Block Option','jnews'), null);
    }
}