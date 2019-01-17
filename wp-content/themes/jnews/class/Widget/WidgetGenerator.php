<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget;

use Jeg\Template;
use JNews\Form\FormControl;

Class WidgetGenerator
{
    /**
     * @var Template
     */
    protected $control_template;

    /**
     * @var \WP_Widget
     */
    protected $wp_widget;

    public function __construct($wp_widget)
    {
        $this->wp_widget = $wp_widget;
    }

    public function setting_field($key, $field, $instance)
    {
        $setting = array();

        $setting['title']       = isset($field['title']) ? $field['title'] : '';
        $setting['desc']        = isset($field['desc']) ? $field['desc'] : '';
        $setting['options']     = isset($field['options']) ? $field['options'] : array();
        $setting['fieldkey']    = $key;
        $setting['fieldid']     = $this->wp_widget->get_field_id($key);
        $setting['fieldname']   = $this->wp_widget->get_field_name($key);
        $setting['default']     = isset($field['default']) ? $field['default'] : '';
        $setting['value']       = isset($instance[$key]) ? $instance[$key] : $setting['default'];
        $setting['fields']      = isset($field['fields']) ? $field['fields'] : array();
        $setting['row_label']   = isset($field['row_label']) ? $field['row_label'] : array();
        $setting['dependency']  = isset($field['dependency']) ? $field['dependency'] : array();

        return $setting;
    }

    public function generate_form($key, $field, $instance)
    {
        return FormControl::generate_form($field['type'], $this->setting_field($key, $field, $instance));
    }

    public function render_form($fields, $instance)
    {
        $html = '';
        $group_index = 0;

        foreach ($fields as $key => $field)
        {
            if(isset($field['type']))
            {
                $html .= $this->generate_form($key, $field, $instance);
            } else {
                $child_html = '';
                $widget_class = sanitize_title($key);

                foreach($field as $child_key => $child_field)
                {
                    $child_html .= $this->generate_form($child_key, $child_field, $instance);
                }

                $html .=
                    "<div class='jeg_accordion_wrapper collapsible close {$widget_class}'>" .
                        "<div class='jeg_accordion_heading'>
                                <span class='jeg_accordion_title'>{$key}</span>
                                <span class='jeg_accordion_button'></span>
                            </div>" .
                        "<div class='jeg_accordion_body' style='display: none'>" .
                        $child_html .
                        "</div>" .
                    "</div>";

                $group_index++;
            }
        }

        if($group_index > 0) {
            echo jnews_sanitize_output('<div class="jeg_widget_wrapper">' . $html . '</div>');
        } else {
            echo jnews_sanitize_output($html);
        }
    }
}

