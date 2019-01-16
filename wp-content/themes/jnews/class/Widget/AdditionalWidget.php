<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget;

Class AdditionalWidget
{
    /**
     * @var AdditionalWidget
     */
    private static $instance;

    /**
     * @return AdditionalWidget
     */
    public static function getInstance()
    {
        if ( null === static::$instance )
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        if(is_admin())
        {
            if(!is_customize_preview()) {
                add_action('in_widget_form', array($this, 'additional_form'), null, 3);
            }
            add_filter('widget_update_callback', array( $this, 'update_widget_form' ), 99, 2 );
        }
    }

    // Return new instance instead older instance
    function update_widget_form( $instance, $new_instance )
    {
        if ( class_exists( 'Jetpack' ) && \Jetpack::is_module_active( 'widget-visibility' ) )
        {
            return array_merge($instance, $new_instance);   
        }
        
        return $new_instance;
    }

    public function unique_id()
    {
        return uniqid();
    }

    /**
     * @param $t \WP_Widget
     * @param $return
     * @param $instance
     */
    public function additional_form($t, $return, $instance)
    {
        // generator nya disini
        if (strpos($t->id_base, 'jnews_module') === false)
        {
            $generator = new WidgetGenerator($t);
            $generator->render_form($this->header_form(), $instance);
        }
    }

    public function header_form()
    {
        return array(
            'Header Widget' => array(
                'second_title' => array (
                    'type' => 'textfield',
                    'title' => esc_html__('Second Title', 'jnews'),
                    'desc' => esc_html__('Secondary title of Widget.', 'jnews'),
                    'default' => '',
                    'options' => '',
                    'name' => 'second_title',
                ),

                'header_url' => array (
                    'type' => 'textfield',
                    'title' => esc_html__('Title URL', 'jnews'),
                    'desc' => esc_html__('Insert URL for heading title.', 'jnews'),
                    'default' => '',
                    'options' => '',
                    'name' => 'header_url',
                ),

                'header_type' => array (
                    'type' => 'radioimage',
                    'title' => esc_html__('Header Type', 'jnews'),
                    'desc' => esc_html__('Choose which header type fit with your content design.', 'jnews'),
                    'default' => 'heading_6',
                    'options' => array (
                        'heading_1' => JNEWS_THEME_URL . '/assets/img/admin/heading-1.png',
                        'heading_2' => JNEWS_THEME_URL . '/assets/img/admin/heading-2.png',
                        'heading_3' => JNEWS_THEME_URL . '/assets/img/admin/heading-3.png',
                        'heading_4' => JNEWS_THEME_URL . '/assets/img/admin/heading-4.png',
                        'heading_5' => JNEWS_THEME_URL . '/assets/img/admin/heading-5.png',
                        'heading_6' => JNEWS_THEME_URL . '/assets/img/admin/heading-6.png',
                        'heading_7' => JNEWS_THEME_URL . '/assets/img/admin/heading-7.png',
                        'heading_8' => JNEWS_THEME_URL . '/assets/img/admin/heading-8.png',
                        'heading_9' => JNEWS_THEME_URL . '/assets/img/admin/heading-9.png',
                    ),
                    'name' => 'header_type'
                ),

                'header_background' => array (
                    'type' => 'colorpicker',
                    'title' => esc_html__('Header Background', 'jnews'),
                    'desc' => esc_html__('This option may not work for all of heading type.', 'jnews'),
                    'default' => '',
                    'options' => '',
                    'name' => 'header_background',
                ),

                'header_text_color' => array (
                    'type' => 'colorpicker',
                    'title' => esc_html__('Header Text Color', 'jnews'),
                    'desc' => esc_html__('This option may not work for all of heading type.', 'jnews'),
                    'default' =>'',
                    'options' =>'',
                    'name' => 'header_text_color',
                )
            )
        );
    }

}

