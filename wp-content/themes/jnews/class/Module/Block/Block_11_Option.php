<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Block;

Class Block_11_Option extends BlockOptionAbstract
{
    protected $default_number_post = 4;
    protected $show_excerpt = false;
    protected $default_ajax_post = 4;

    public function get_module_name()
    {
        return esc_html__('JNews - Module 11', 'jnews');
    }

    public function additional_style()
    {
        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'title_color',
            'group'         => esc_html__('Design', 'jnews'),
            'heading'       => esc_html__('Title Color', 'jnews'),
            'description'   => esc_html__('This option will change your Title color', 'jnews'),
        );

        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'accent_color',
            'group'         => esc_html__('Design', 'jnews'),
            'heading'       => esc_html__('Accent Color', 'jnews'),
            'description'   => esc_html__('This option will change your accent color', 'jnews'),
        );

        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'alt_color',
            'group'         => esc_html__('Design', 'jnews'),
            'heading'       => esc_html__('Meta Color', 'jnews'),
            'description'   => esc_html__('This option will change your meta color', 'jnews'),
        );

        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'excerpt_color',
            'group'         => esc_html__('Design', 'jnews'),
            'heading'       => esc_html__('Excerpt Color', 'jnews'),
            'description'   => esc_html__('This option will change your excerpt color', 'jnews'),
        );

        $this->options[] = array(
            'type'          => 'colorpicker',
            'param_name'    => 'block_background',
            'group'         => esc_html__('Design', 'jnews'),
            'heading'       => esc_html__('Block Background', 'jnews'),
            'description'   => esc_html__('This option will change your Module 11 Block Background', 'jnews'),
        );
    }
}