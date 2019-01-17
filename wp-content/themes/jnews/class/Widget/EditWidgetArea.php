<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget;

Class EditWidgetArea
{
    /**
     * @var EditWidgetArea
     */
    private static $instance;

    /**
     * @var String
     */
    public static $widget_list = 'jnews-widget-list';

    /**
     * @return EditWidgetArea
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
        add_action('widgets_init', array($this, 'register_sidebar') );
        add_action('admin_enqueue_scripts', array($this, 'load_script'));
        add_action('widgets_admin_page', array($this, 'additional_widget_button'), 9);
        add_action('sidebar_admin_page', array($this, 'widget_overlay'));
        add_action('after_setup_theme', array($this, 'save_widgetlist'));
        add_filter('jnews_get_sidebar_widget', array($this, 'get_sidebar_widget'));
    }

    public function load_script()
    {
        if($this->is_widget_page())
        {
            wp_enqueue_script('jquery-ui-spinner');
            wp_enqueue_style('jnews-widget-css',        JNEWS_THEME_URL . '/assets/css/admin/widget.css', null, jnews_get_theme_version());
            wp_enqueue_style('font-awesome',            JNEWS_THEME_URL . '/assets/css/font-awesome.min.css', null, jnews_get_theme_version());

            // upload
            wp_enqueue_media();

            // color picker
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'wp-color-picker-alpha', JEG_URL . '/assets/js/vendor/wp-color-picker-alpha.js', array( 'wp-color-picker' ), null, true );
        }
    }

    public function is_widget_page()
    {
        return in_array($GLOBALS['pagenow'], array('widgets.php'));
    }

    public function save_widgetlist()
    {
        if($this->is_widget_page())
        {
            if(isset($_POST['modifwidget']))
            {
                if(isset($_POST['widgetlist']))
                {
                    update_option(self::$widget_list, $_POST['widgetlist'] );
                } else {
                    delete_option(self::$widget_list);
                }
            }
        }
    }

    public function additional_widget_button()
    {
        if($this->is_widget_page())
        {
            echo wp_kses("<h1><a class='sidebarwidget add-new-h2'>" . esc_html__('Add or Remove Widget Area', 'jnews') . "</a></h1><div class='clearfix'></div>",
                array(
                    'a' => array( 'class' => true),
                    'div' => array( 'class' => true ),
                )
            );
        }
    }

    public function populate_widget()
    {
        $html = '';
        $widgetlist = get_option(self::$widget_list);

        if( $widgetlist) {
            foreach($widgetlist as $widget) {
                $html .= "<li><span>" . $widget . "</span><input type='hidden' name='widgetlist[]' value='" . $widget . "'><div class='remove fa fa-ban'></div></li>";
            }
        }

        return $html;
    }

    public function widget_overlay()
    {
        $linkedin_element = $this->linkedin_oauth_code();
        $linkedin_class   = !empty( $linkedin_element ) ? "linkedin-oauth-code-enable" : "";

        if($this->is_widget_page())
        {
            echo
                "<div class='widget-overlay {$linkedin_class}'>
                    <form method='POST'>
                        <div class='widget-overlay-wrapper'>
                            <h3>" . esc_html__('Edit Widget Area', 'jnews') . "</h3>
                            <div class='close fa fa-times'></div>
                            <div class='widget-content-list'>
                                <div class='widget-content-wrapper'>
                                    <h4>" . esc_html__('Widget Area List :', 'jnews') . "</h4>
                                    <ul> " . $this->populate_widget() .  "</ul>
                                </div>
                                <div class='widget-confirm'>
                                    <input type='button' class='addwidget button-secondary' value='" .  esc_html__('Create Widget Area', 'jnews') . "'>
                                    <input type='submit' class='savewidget button-primary' value='" .  esc_html__('Save Widget', 'jnews')  . "'>
                                </div>
                            </div>
                            <div class='widget-adding-content'>
                                <div class='widget-additional'>
                                    <h4>" .  esc_html__('Create Widget Area', 'jnews') . "</h4>
                                    <input type='text' class='textwidgetconfirm' placeholder='" .  esc_html__('Enter name of widget', 'jnews')  . "'>
                                </div>
                                <div class='widget-confirm'>
                                    <input type='button' class='addwidgetconfirm button-primary' value='" .  esc_html__('Add Widget', 'jnews')  . "'>
                                </div>
                            </div>
                        </div>
                        <input type='hidden' name='modifwidget' value='1'/>
                        " . wp_nonce_field( 'edit-widgetlist' ) . "
                    </form>
                    {$linkedin_element}
                </div>";
        }
    }

    public function linkedin_oauth_code()
    {
        if ( isset( $_GET['code'] ) && !empty( $_GET['code'] ) ) 
        {
            $linkedin_element = 
                "<div class='widget-overlay-wrapper linkedin-oauth-code'>
                    <div class='jnews-action-notice success'>
                        <span>" . esc_html__('Linked In Oauth Code Copied', 'jnews') . "</span>
                        <i class='fa fa-times'></i>
                    </div>
                    <h3>" . esc_html__('Linked In Info', 'jnews') . "</h3>
                    <i class='fa fa-linkedin'></i>
                    <div class='widget-adding-content'>
                        <div class='widget-additional'>
                            <h4>" .  esc_html__('Oauth Code', 'jnews') . "</h4>
                            <input type='text' class='textwidgetconfirm' value='" . $_GET['code'] . "'>
                            <p>" . esc_html__('Please copy and paste the code above on Linked In Oauth Code field', 'jnews') . "</p>
                            <p class='alert-info'>
                                <strong>" . esc_html__('Info :', 'jnews') . "</strong>
                                <span>" . esc_html__('The Linked In Oauth Code can only be used once. You will need to generate it again when your Linked In Access Token expired.', 'jnews') . "</span>
                            </p>
                        </div>
                    </div>
                </div>";

            return $linkedin_element;
        }
    }
    
    public function register_sidebar()
    {
        $widgetlist = get_option(self::$widget_list);

        if( $widgetlist)
        {
            foreach($widgetlist as $location => $widget)
            {
                register_sidebar(array(
                    'id'                => sanitize_title($widget),
                    'name'              => $widget,
                    'before_widget'     => '<div class="widget %2$s" id="%1$s">',
                    'before_title'      => '<div class="jeg_block_heading jeg_block_heading_6"><h3 class="jeg_block_title"><span>',
                    'after_title'       => '</span></h3></div>',
                    'after_widget'      => '</div>',
                ));
            }
        }
    }

    public function get_sidebar_widget()
    {
        $widgetlist = get_option(self::$widget_list);
        $allwidget = array(
            'default-sidebar' => esc_html__('Default Sidebar', 'jnews'),
        );

        if(!empty($widgetlist)) {
            foreach($widgetlist as $widget) {
                $allwidget[sanitize_title($widget)] = $widget;
            }
        }

        return $allwidget;
    }
}

