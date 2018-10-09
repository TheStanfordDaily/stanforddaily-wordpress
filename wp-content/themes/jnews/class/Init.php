<?php
/**
 * @author : Jegtheme
 */
namespace JNews;

use JNews\Asset\BackendAsset;
use JNews\Asset\FrontendAsset;
use JNews\Comment\CommentNumber;
use JNews\Comment\CommentProcess;
use JNews\Customizer\CustomizerRedirect;
use JNews\Dashboard\AdminDashboard;
use JNews\Footer\FooterBuilder;
use JNews\Helper\StyleHelper;
use JNews\Image\Image;
use JNews\Menu\Menu;
use JNews\Elementor\ModuleElementor;
use JNews\Module\ModuleManager;
use JNews\Module\ModuleVC;
use JNews\Module\TemplateLibrary;
use JNews\Multilang\Polylang;
use JNews\Multilang\WPML;
use JNews\Util\ValidateLicense;
use JNews\Util\VideoThumbnail;
use JNews\Widget\AdditionalWidget;
use JNews\Widget\EditWidgetArea;
use JNews\Widget\Module\RegisterModuleWidget;
use JNews\Widget\Normal\RegisterNormalWidget;
use JNews\Widget\Normal\Process\SocialCounterProcess;
use JNews\Widget\Widget;
use JNews\Widget\WidgetTitle;

/**
 * Starting Point for JNews Themes
 *
 * Class JNews Init
 */
class Init
{
    /**
     * @var Init
     */
    private static $instance;

    /**
     * @return Init
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
        $this->load_helper();
        $this->init_themes();
        $this->load_textdomain();
        $this->setup_hook();
        $this->populate_metabox();

        TemplateLibrary::getInstance();
    }

    public function load_helper()
    {
        // Load Plugin Helper
        require_once get_parent_theme_file_path('lib/theme-helper.php');
        require_once get_parent_theme_file_path('lib/theme-filter.php');
    }

    public function populate_metabox()
    {
        new Metabox();
    }

    public function background_process()
    {
        if ( defined('DOING_AJAX') && DOING_AJAX )
        {
            new CommentProcess();
            new SocialCounterProcess();
        }
    }

    public function load_textdomain()
    {
        load_theme_textdomain('jnews', get_parent_theme_file_path('languages'));
    }

    public function multilang()
    {
        if ( class_exists('Polylang') )
        {
            // multilanguage
            Polylang::getInstance();
        }

        if ( class_exists('WPML') )
        {
            // WPML multilanguage
            WPML::getInstance();
        }
    }

    public function frontend_script()
    {
        // Front End
        if(!is_admin())
        {
            // Frontend Ajax
            FrontendAjax::getInstance();

            // Style Helper
            StyleHelper::getInstance();

            // Ads
            Ads::getInstance();

            // load frontend asset
            FrontendAsset::getInstance();

            // Comment Number
            CommentNumber::getInstance();
        }
    }

    public function backend_script()
    {
        // Back End
        if(is_admin())
        {
            // dashboard
            AdminDashboard::getInstance();

            // License
            ValidateLicense::getInstance();

            // load backend asset
            BackendAsset::getInstance();

            // Load header builder on backend
            HeaderBuilder::getInstance();

            // Load background process
            $this->background_process();

            // Need to load video thumbnail
            VideoThumbnail::getInstance();
        }
    }

    public function init_themes()
    {
        // Themes Menu
        Menu::getInstance();

        // Customizer
        Customizer::getInstance();

        // Initialize Image
        Image::getInstance();

        // Shortcode
        Shortcode::getInstance();

        // Footer Builder
        FooterBuilder::getInstance();

        // Account Page
        AccountPage::getInstance();

        // Multi language Initialize
        $this->multilang();

        // frontend script
        $this->frontend_script();

        // backend script
        $this->backend_script();

        // Load Visual Composer
        $this->load_module();

        // Load Widget
        $this->load_widget();
    }

    public function load_module()
    {
        ModuleManager::getInstance();
        ModuleVC::getInstance();
        ModuleElementor::getInstance();
    }

    public function load_widget()
    {
        Widget::getInstance();
        WidgetTitle::getInstance();

        if (apply_filters('jnews_load_all_widget', false))
        {
            $this->load_widget_element();
        }
    }

    public function load_widget_element()
    {
        EditWidgetArea::getInstance();
        AdditionalWidget::getInstance();

        RegisterNormalWidget::getInstance();
        RegisterModuleWidget::getInstance();
    }

    public function setup_hook()
    {
	    define('YP_THEME_MODE', 'true');

	    add_action( 'after_setup_theme',                array($this, 'themes_support'));
        add_action( 'admin_enqueue_scripts',            array($this, 'load_admin_style'));
        add_action( 'customize_preview_init',           array($this, 'preview_init'));
        add_action( 'admin_head',                       array($this, 'admin_ajax_url' ), 1 );
        add_action( 'after_switch_theme',               array($this, 'flush_rewrite_rules' ));

        if (apply_filters('jnews_load_post_subtitle', false))
        {
            // Post Subtitle Field
            add_action('edit_form_before_permalink', array($this, 'post_subtitle_field'));
            add_action('edit_post', array($this, 'post_subtitle'));
            add_action('save_post', array($this, 'post_subtitle'));
        }
    }

    public function flush_rewrite_rules()
    {
        // $this->add_rewrite_rule();

        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }

    public function preview_init()
    {
        // Theme Customizer Redirect Tag Init
         CustomizerRedirect::getInstance();
    }

    public function load_admin_style()
    {
        add_editor_style(get_parent_theme_file_uri('assets/css/admin/editor.css'));
    }

    public function themes_support()
    {
        // support feed link
        add_theme_support( 'automatic-feed-links' );

        // title tag
        add_theme_support( 'title-tag' );

        // featured image
        add_theme_support( 'post-thumbnails' );

        // selective refresh widget
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Supported post type
        add_theme_support( 'post-formats', array( 'gallery', 'video' ) );

        // HTML 5 support
        add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );

        // support woocommerce
        add_theme_support( 'woocommerce' );

        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );

        // auto load next post
        add_theme_support( 'auto-load-next-post' );
    }

    public function post_subtitle_field($post)
    {
        if ( $post->post_type === 'post' ) 
        {
            $post_subtitle = get_post_meta( $post->ID, 'post_subtitle', true );
            $subtitle = !empty( $post_subtitle ) ? esc_html( get_post_meta( $post->ID, 'post_subtitle', true ) ) : '';

            echo '<div id="jnews_post_subtitle">
                    <input type="text" name="post_subtitle" value="' . $subtitle . '" spellcheck="true" autocomplete="off" placeholder="' . esc_html__('Enter subtitle here', 'jnews') . '" />
                </div>';
        }
    }

    public function post_subtitle($post_id)
    {
        if ( !defined('XMLRPC_REQUEST') && isset($_POST['post_subtitle']) ) 
        {
            update_post_meta( $post_id, 'post_subtitle', sanitize_text_field($_POST['post_subtitle']));
        }
    }

    public function admin_ajax_url() {
        ?>
        <script type="text/javascript">
            var ajaxurl = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
        </script>
        <?php
    }
}