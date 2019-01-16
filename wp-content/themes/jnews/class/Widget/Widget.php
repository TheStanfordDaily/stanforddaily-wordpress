<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget;

/**
 * Class JNews Widget
 */
Class Widget
{
    /**
     * @var Widget
     */
    private static $instance;

    /**
     * @var array
     *
     * all widget location
     */
    private $widget_location;

    /**
     * @return Widget
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        $this->widget_location = array(
            'default-sidebar' => esc_html__('Default Sidebar', 'jnews'),
            'footer-widget-1' => esc_html__('Footer Widget 1', 'jnews'),
            'footer-widget-2' => esc_html__('Footer Widget 2', 'jnews'),
            'footer-widget-3' => esc_html__('Footer Widget 3', 'jnews'),
            'footer-widget-4' => esc_html__('Footer Widget 4', 'jnews'),
        );

        $this->setup_hook();
    }

    public function setup_hook()
    {
        add_action('widgets_init', array(&$this, 'register_widget'));
        add_filter('wp_list_categories', array(&$this, 'list_category'), null, 2);
    }

    public function register_widget()
    {
        foreach($this->widget_location as $location => $widget)
        {
            if($location === 'footer-widget-1' || $location === 'footer-widget-2' || $location === 'footer-widget-3' || $location === 'footer-widget-4')
            {
                register_sidebar(array(
                    'id'                => $location,
                    'name'              => $widget,
                    'before_widget'     => '<div class="footer_widget %2$s" id="%1$s">',
                    'before_title'      => '<div class="jeg_footer_heading jeg_footer_heading_1"><h3 class="jeg_footer_title"><span>',
                    'after_title'       => '</span></h3></div>',
                    'after_widget'      => '</div>',
                ));
            } else {
                register_sidebar(array(
                    'id'                => $location,
                    'name'              => $widget,
                    'before_widget'     => '<div class="widget %2$s" id="%1$s">',
                    'before_title'      => '<div class="jeg_block_heading jeg_block_heading_6"><h3 class="jeg_block_title"><span>',
                    'after_title'       => '</span></h3></div>',
                    'after_widget'      => '</div>',
                ));
            }
        }
    }


    public function list_category($output, $args)
    {
        return $output;
    }
}