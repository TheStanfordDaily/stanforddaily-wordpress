<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget;

Class WidgetTitle
{
    /**
     * @var AdditionalWidget
     */
    private static $instance;

    /**
     * Currently active sidebar
     *
     * @var string
     */
    private $current_sidebar;

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
        add_action('dynamic_sidebar_before', array($this, 'before_sidebar'));
        add_action('dynamic_sidebar_after', array($this, 'after_sidebar'));
        add_filter('dynamic_sidebar_params', array($this, 'modify_sidebar_header'));
    }

    public function unique_id()
    {
        return uniqid();
    }

    public function modify_sidebar_header($params)
    {
        global $wp_registered_widgets;
        $id = $params[0]['widget_id'];

        if( $this->current_sidebar !== 'footer-widget-1' && $this->current_sidebar !== 'footer-widget-2' && $this->current_sidebar !== 'footer-widget-3' && $this->current_sidebar !== 'footer-widget-4' )
        {
            if ( isset( $wp_registered_widgets[ $id ]['callback'][0] ) && is_object( $wp_registered_widgets[ $id ]['callback'][0] ) )
            {
                $callback = $wp_registered_widgets[ $id ]['callback'][0];
                $settings = $callback->get_settings();

                // Get settings for this instance of the widget
                $setting_key    = substr( $id, strrpos( $id, '-' ) + 1 );
                $instance       = isset( $settings[ $setting_key ] ) ? $settings[ $setting_key ] : array();
                $unique_class   = 'jnews_' . $this->unique_id();

                $heading = !empty($instance['header_type']) ? $instance['header_type'] : 'heading_6';
                $params[0]['before_title'] = "<div class=\"jeg_block_heading jeg_block_{$heading} {$unique_class}\"><h3 class=\"jeg_block_title\">";

                $second = !empty($instance['second_title']) ? "<strong>{$instance['second_title']}</strong>"  : "";

                if(!empty($instance['header_url'])) {
                    $params[0]['before_title'] .= "<a href='{$instance['header_url']}'><span>";
                    $params[0]['after_title'] = $second . "</span></a></h3></div>";
                } else {
                    $params[0]['before_title'] .= "<span>";
                    $params[0]['after_title'] = $second . "</span></h3></div>";
                }

                $header_styling = jnews_header_styling($instance, $unique_class);
                $params[0]['after_title'] .= !empty($header_styling) ? "<style scoped>" . $header_styling . "</style>" : "";
            }
        }

        return $params;
    }

    public function before_sidebar($index)
    {
        do_action('jnews_module_set_width', 4);
        $this->current_sidebar = $index;
    }

    public function after_sidebar($index)
    {
        $this->current_sidebar = null;
    }
}

