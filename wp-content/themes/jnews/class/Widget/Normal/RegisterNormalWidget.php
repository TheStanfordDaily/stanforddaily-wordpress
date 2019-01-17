<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal;

Class RegisterNormalWidget
{
    /**
     * @var RegisterNormalWidget
     */
    private static $instance;

    /**
     * @return RegisterNormalWidget
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
        include get_parent_theme_file_path ('class/Widget/Normal/normal-widget.php');
        add_action('widgets_init', array($this, 'register_widget_normal') );
    }

    public function get_normal_widget()
    {
        return apply_filters('jnews_get_normal_widget_list', array(
            "About_Widget",
            "Popular_Widget",
            "Line_Widget",
            "Recent_News_Widget",
            "Tab_Post_Widget",
            "Social_Widget",
            "Social_Counter_Widget",
            "Facebook_Page_Widget",
            "Twitter_Widget",
            "Google_Plus_Widget",
            "Pinterest_Widget",
            "Instagram_Widget",
            "Flickr_Widget",
            "Behance_Widget",
        ));
    }

    public function register_widget_normal()
    {
        $modules = $this->get_normal_widget();

        foreach($modules as $module) {
            register_widget($module);
        }
    }
}

