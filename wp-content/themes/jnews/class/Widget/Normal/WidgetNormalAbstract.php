<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal;

use Jeg\Util\Sanitize;
use JNews\Widget\WidgetAbstract;

abstract class WidgetNormalAbstract extends WidgetAbstract
{
    /**
     * @var NormalWidgetInterface
     */
    protected $widget_instance;

    public function __construct()
    {
        $base_name = $this->get_base_name();

        if(is_admin()) {
            parent::__construct($base_name, $this->get_module_name(), array(
                'description' => $this->get_module_name()
            ));
        } else {
            parent::__construct($base_name, null, null);
        }
    }

    public function get_module_name()
    {
        $element = get_class($this);
        $text = explode('_', $element);
        return "JNews - " . ucfirst(implode(' ' , $text));
    }

    public function get_base_name()
    {
        $base_name = str_replace('_Widget', '', get_class($this));
        return 'jnews_' . strtolower($base_name);
    }

    /**
     * @return NormalWidgetInterface
     */
    public function get_widget_instance()
    {
        if(!$this->widget_instance) {
            $widgetClass = $this->get_widget_class();
            $this->widget_instance = new $widgetClass();
        }

        return $this->widget_instance;
    }

    public function get_widget_class()
    {
        $class = str_replace('_', '', get_class($this));
        $class_instance = "JNews\\Widget\\Normal\\Element\\" . $class;
        return apply_filters('jnews_widget_class_instance', $class_instance, $class);
    }

    public function form($instance)
    {
        if(!is_customize_preview()) {
            $options = $this->get_widget_instance()->get_options();
            $this->render_form($options, $instance);
        }
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance )
    {
        $instance = array();

        $sanitizeClass = Sanitize::getInstance();

        foreach ($this->get_widget_instance()->get_options() as $key => $field) :

            if ( isset( $field['type'] ) ) 
            {
                switch ($field['type']) {
                    case 'textarea' :
                        $instance[$key] = wp_kses($new_instance[$key], wp_kses_allowed_html());
                        break;
                    default :
                        $instance[$key] = $sanitizeClass->sanitize_input($new_instance[$key]);
                        break;
                }
            }
            
        endforeach;

        return $instance;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance )
    {
        $title = apply_filters( 'widget_title', isset($instance['title']) ? $instance['title'] : "" );

        echo jnews_sanitize_output($args['before_widget']);

        if ( ! empty( $title ) ) {
            echo jnews_sanitize_output($args['before_title']) . esc_html( $title ) . jnews_sanitize_output($args['after_title']);
        }

        $widget_instance = $this->get_widget_instance();
        $widget_instance->render_widget($instance);

        echo jnews_sanitize_output($args['after_widget']);
    }
}
