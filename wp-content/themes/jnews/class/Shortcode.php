<?php
/**
 * @author : Jegtheme
 */
namespace JNews;

/**
 * Class JNews Shortcode
 */
Class Shortcode
{
    /**
     * @var Shortcode
     */
    private static $instance;

    /**
     * @return Shortcode
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        if (apply_filters('jnews_load_shortcode_detail', false))
        {
            $this->setup_hook();
            $this->render_element();
        }
    }

    public function setup_hook()
    {
        add_action('admin_enqueue_scripts', array($this, 'load_script'));
        add_action('current_screen'	, array($this, 'shortcode_button'));
    }

    public function load_script()
    {
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script('jquery-ui-dialog');
    }

    public function render_element()
    {
        do_action('jnews_render_element', 'spacing', array($this, 'spacing'));
    }

    public function spacing($atts, $content = null)
    {
        $atts = shortcode_atts(
            array(
                'class' => '',
                'size' => '10',
            ),
            $atts
        );

        return "<div class='clearfix {$atts['class']}' style='padding-bottom: {$atts['size']}px'></div>";
    }

    public function shortcode_button()
    {
        $screen = get_current_screen();
        if( ( $screen->post_type === 'post' || $screen->post_type === 'page' ) && $screen->post_type !== '')
        {
            if ( ( current_user_can('edit_posts') || current_user_can('edit_pages') ) &&  get_user_option('rich_editing') == 'true')
            {
                add_filter('mce_external_plugins'	, array($this, 'add_tinymce_plugin'));
                add_filter('mce_buttons_3'			, array($this, 'register_button'));
            }
        }
    }

    public function add_tinymce_plugin($plugin_array)
    {
        $plugin_array['jnews_shortcode'] = JNEWS_THEME_URL . '/assets/js/admin/jnews.shortcode.js';
        return $plugin_array;
    }

    public function register_button($buttons)
    {
        array_push( $buttons, 'jnews_grid');
        array_push( $buttons, '|');
        array_push( $buttons, 'jnews_intro');
        array_push( $buttons, 'jnews_dropcaps');
        array_push( $buttons, 'jnews_highlight');
        array_push( $buttons, 'jnews_pullquote');
        array_push( $buttons, '|');
        array_push( $buttons, 'jnews_alert');
        array_push( $buttons, 'jnews_btn');
        array_push( $buttons, 'jnews_spacing');
        return $buttons;
    }

}
