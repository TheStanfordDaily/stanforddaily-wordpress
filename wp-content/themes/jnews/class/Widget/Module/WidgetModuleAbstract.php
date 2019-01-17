<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Module;

use JNews\Module\ModuleOptionAbstract;
use JNews\Module\ModuleViewAbstract;
use JNews\Widget\WidgetAbstract;

abstract class WidgetModuleAbstract extends WidgetAbstract
{
    /**
     * @var String
     */
    protected $option_class;

    /**
     * @var String
     */
    protected $view_class;

    /**
     * @var ModuleOptionAbstract
     */
    protected $option_instance;

    /**
     * @var ModuleViewAbstract
     */
    protected $view_instance;

    protected $group = array();

    public function __construct()
    {
        $base_name = $this->get_base_name();

        if(is_admin()) {
            $instance = $this->get_option_instance();
            parent::__construct($base_name, $instance->get_module_name(), array(
                'description' => $instance->get_module_name()
            ));
        } else {
            parent::__construct($base_name, null, null);
        }
    }

    public function get_base_name()
    {
        $base_name = str_replace('_Widget', '', get_class($this));
        $base_name = str_replace('JNews', 'JNews_Module', $base_name);
        return strtolower($base_name);
    }

    
    public function get_option_instance()
    {
        if(!$this->option_instance) {
            $this->option_instance = call_user_func(array($this->get_module_option_class(), 'getInstance'));
        }
        
        return $this->option_instance;
    }

    public function get_view_instance()
    {
        if(!$this->view_instance) {
            $this->view_instance = call_user_func(array($this->get_module_view_class(), 'getInstance'));
        }

        return $this->view_instance;
    }

    public function build_option($options)
    {
        $new_options = array();

        foreach($options as $option)
        {
            if( !isset($option['group']) || empty($option['group'])) {
                $group = $this->get_default_group();
            } else {
                $group = $option['group'];
            }

            if(!array_key_exists($group, $this->group)) {
                $this->group[$group] = array();
            }

            $temporary = array();
            $temporary['type']          = $option['type'];
            $temporary['title']         = $option['heading'];
            $temporary['desc']          = isset($option['description']) ? $option['description'] : '';
            $temporary['default']       = isset($option['std']) ? $option['std'] : '';
            $temporary['options']       = isset($option['value']) ? array_flip($option['value']) : '';
            $temporary['name']          = $option['param_name'];

            if($option['type'] === 'slider' || $option['type'] === 'number') {
                $temporary['options'] = array(
                    'min'  => $option['min'],
                    'max'  => $option['max'],
                    'step' => $option['step'],
                );
            }

            if ( isset( $option['dependency'] ) && is_array( $option['dependency'] ) ) 
            {
                $temporary['dependency'] = array(
                    array(
                        'field'     => $option['dependency']['element'],
                        'operator'  => 'in',
                        'value'     => $option['dependency']['value']
                    )
                );
            }

            $this->group[$group][$option['param_name']] = $temporary;
            $new_options[$option['param_name']] = $temporary;
        }

        return $this->group;
    }

    public function form($instance)
    {
        if(!is_customize_preview()) {
            $options = $this->option_instance->get_options();
            $new_options = $this->build_option($options);
            $this->render_form($new_options, $instance);
        }
    }

    /**
     * Get related module class name
     *
     * @return mixed
     */
    public function get_module_option_class()
    {
        $module_class = get_class($this);
        $module_name = str_replace('_Widget', '', $module_class);
        return jnews_get_option_class_from_shortcode($module_name);
    }

    public function get_module_view_class()
    {
        $module_class = get_class($this);
        $module_name = str_replace('_Widget', '', $module_class);
        return jnews_get_view_class_from_shortcode($module_name);
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

        $widget_instance = $this->get_view_instance();
        $widget_instance->render_widget($instance);

        echo jnews_sanitize_output($args['after_widget']);
    }
}
