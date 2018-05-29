<?php
/**
 * @author Jegtheme
 */
namespace JNews\Module;

use JNews\Module\Block\BlockViewAbstract;

/**
 * Class JNews Module Manager
 */
Class ModuleManager
{
    /**
     * @var ModuleManager
     */
    private static $instance;

    /**
     * Absolute width of element
     * @var array
     */
    private $width = array();

    /**
     * @var array
     */
    private $module = array();

    /**
     * Overlay slider rendered Flag
     *
     * @var bool
     */
    private $overlay_slider = false;

    /**
     * Module Counter for each element
     *
     * @var int
     */
    private $module_count = 0;

    /**
     * Unique article container
     *
     * @var array
     */
    private $unique_article = array();

    /**
     * @var array
     */
    private $module_array = array();

    /**
     * @var string
     */
    public static $module_ajax_prefix = 'jnews_module_ajax_';

    /**
     * @return ModuleManager
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * ModuleManager constructor.
     *
     */
    private function __construct()
    {
        if( ( isset($_GET['vc_editable']) && $_GET['vc_editable'] ) ||
            ( isset($_GET['vc_action']) && $_GET['vc_action'] === 'vc_inline' ) )
        {
            $this->load_all_module_option();
            $this->do_shortcode();
        } else if(is_admin()) {
            $this->load_all_module_option();
        } else {
            $this->do_shortcode();
        }

        $this->setup_hook();
    }


    public function module_ajax($module_name)
    {
        $class_name = jnews_get_view_class_from_shortcode($module_name);

        /** @var ModuleViewAbstract $instance */
        $instance = call_user_func(array($class_name, 'getInstance'));

        if($instance instanceof BlockViewAbstract) {
            $instance->ajax_request();
        }
    }

    public function setup_hook()
    {
        add_filter('jnews_module_block_container_extend_after', array($this, 'module_container_after'), null, 2);
        add_filter('jnews_module_block_navigation_extend_before', array($this, 'module_navigation_before'), null, 2);
        add_filter('the_content', array($this, 'move_slider'), 1);

        add_action('jnews_register_column_width', array(&$this, 'register_width'), null, 1);
        add_action('jnews_reset_column_width', array(&$this, 'reset_width'), null, 1);
        add_action('jnews_module_set_width', array(&$this, 'force_set_width'));
    }

    public function is_overlay_slider_rendered()
    {
        return $this->overlay_slider;
    }

    public function overlay_slider_rendered()
    {
        $this->overlay_slider = true;
    }

    public function move_slider($content)
    {
        if(function_exists('vc_is_page_editable') && is_page() && !vc_is_page_editable())
        {
            $slider = null;
            $first = strpos($content, '[jnews_slider_overlay');

            if($first) {
                $second = strpos($content, ']', $first);
                $slider = substr($content, $first, $second - $first + 1);
            }

            return $slider . $content;
        }

        return $content;
    }

    public function module_loader()
    {
        $loader = get_theme_mod("jnews_module_loader", "dot");
        $output =
            "<div class='module-overlay'>
                <div class='preloader_type preloader_{$loader}'>
                    <div class=\"module-preloader jeg_preloader dot\">
                        <span></span><span></span><span></span>
                    </div>
                    <div class=\"module-preloader jeg_preloader circle\">
                        <div class=\"jnews_preloader_circle_outer\">
                            <div class=\"jnews_preloader_circle_inner\"></div>
                        </div>
                    </div>
                    <div class=\"module-preloader jeg_preloader square\">
                        <div class=\"jeg_square\"><div class=\"jeg_square_inner\"></div></div>
                    </div>
                </div>
            </div>";

        return $output;
    }

    public function module_container_after($content, $attr)
    {
        $output = $this->module_loader();
        $content = $content . $output;

        return $content;
    }

    public function module_navigation_before($content, $attr)
    {
        $output = "<div class='navigation_overlay'><div class='module-preloader jeg_preloader'><span></span><span></span><span></span></div></div>";
        $content = $content . $output;

        return $content;
    }

    public function populate_module()
    {
        if(empty($this->module_array))
        {
            $this->module_array = include "modules.php";
        }

        return  apply_filters('jnews_module_list', $this->module_array);
    }

    public function load_all_module_option()
    {
        $modules = $this->populate_module();

        // Need to load module first
        do_action('jnews_load_all_module_option');

        foreach($modules as $module) {
            $mod = jnews_get_option_class_from_shortcode($module['name']);
            $this->module[$mod] = call_user_func(array($mod, 'getInstance'));
        }
    }

    public function do_shortcode()
    {
        $self = $this;
        $modules = $this->populate_module();

        foreach($modules as $module)
        {
            $shortcode = strtolower($module['name']);

            do_action('jnews_render_element', $shortcode,
                function($attr, $content) use ($self, $module){
                    $mod = jnews_get_view_class_from_shortcode($module['name']);

                    // Call shortcode from plugin
                    do_action('jnews_build_shortcode_' . strtolower($mod));

                    /** @var ModuleViewAbstract $instance */
                    $instance = call_user_func(array($mod, 'getInstance'));

                    if($instance instanceof  ModuleViewAbstract) {
                        return $instance->build_module($attr, $content);
                    } else {
                        return null;
                    }
                }
            );
        }
    }


    /*** calculate column width **/

    /**
     * Calculate width
     *
     * @param $width
     * @return float
     */
    public function calculate_width($width)
    {
        preg_match( '/(\d+)\/(\d+)/', $width, $matches );

        if ( ! empty( $matches ) ) {
            $part_x = (int) $matches[1];
            $part_y = (int) $matches[2];
            if ( $part_x > 0 && $part_y > 0 ) {
                $value = ceil( $part_x / $part_y * 12 );
                if ( $value > 0 && $value <= 12 ) {
                    $width = $value;
                }
            }
        }

        return $width;
    }

    /**
     * Register Width
     *
     * @param $width
     */
    public function register_width($width)
    {
        $width = $this->calculate_width($width);
        array_push($this->width, $width);
    }

    /**
     * Reset Width
     */
    public function reset_width()
    {
        array_pop($this->width);
    }

    /**
     * @return float
     */
    public function get_current_width()
    {
        if(!empty($this->width))
        {
            $current_width = 12;

            foreach($this->width as $width)
            {
                $current_width = $width / 12 * $current_width;
            }

            return ceil($current_width);
        } else {
            // Default Width
            if(isset($_REQUEST['colwidth']))
            {
                return $_REQUEST['colwidth'];
            } else if($this->is_widget_customizer())
            {
                return 4;
            } else
            {
                return 8;
            }
        }
    }

    public function is_widget_customizer()
    {
        if(isset($_REQUEST['customized']))
        {
            if(strpos($_REQUEST['customized'], 'widget_jnews_module') !== false) {
                return true;
            }
        }
        return false;
    }

    public function set_width($width)
    {
        $this->width = $width;
    }

    public function force_set_width($width)
    {
        $this->set_width(array($width));
    }

    /**
     * @return string
     */
    public function get_column_class()
    {
        $class_name = 'jeg_col_1o3';
        $width = $this->get_current_width();

        if($width < 6){
            $class_name = "jeg_col_1o3";
        } else if($width >= 6 && $width <= 8) {
            $class_name = "jeg_col_2o3";
        } else if($width > 8 && $width <= 12) {
            $class_name = "jeg_col_3o3";
        }

        return $class_name;
    }

    /**
     * Increase Module Count
     */
    public function increase_module_count()
    {
        $this->module_count++;
    }

    /**
     * @return int
     */
    public function get_module_count()
    {
        return $this->module_count;
    }

    /**
     * push unique article to array
     *
     * @param $group
     * @param $unique
     */
    public function add_unique_article($group, $unique)
    {
        if(!isset($this->unique_article[$group])) {
            $this->unique_article[$group] = array();
        }

        if(is_array($unique)) {
            $this->unique_article[$group] = array_merge($this->unique_article[$group], $unique);
        } else {
            array_push($this->unique_article[$group], $unique);
        }
    }

    /**
     * @param $group
     * @return array
     */
    public function get_unique_article($group)
    {
        if(isset($this->unique_article[$group])) {
            return $this->unique_article[$group];
        } else {
            return array();
        }
    }
}