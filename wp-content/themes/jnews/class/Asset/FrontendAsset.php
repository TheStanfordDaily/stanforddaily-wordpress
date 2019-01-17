<?php
/**
 * @author : Jegtheme
 *
 * Code harus di sync dengan webpack config
 */
namespace JNews\Asset;

use JNews\Importer;
use JNews\Module\ModuleManager;

/**
 * Class JNews Load Assets
 */
Class FrontendAsset extends AssetAbstract
{
    /**
     * @var FrontendAsset
     */
    private static $instance;

    private $load_action = array();

    /**
     * @return FrontendAsset
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function __construct()
    {
        add_action( 'wp_enqueue_scripts',               array($this, 'load_style'), 98);
        add_action( 'wp_enqueue_scripts',               array($this, 'load_script'));
        add_action( 'wp_enqueue_scripts',               array($this, 'load_vc'), 99);
        add_action( 'wp_head',                          array($this, 'add_typekit'));
        add_action( 'wp_footer',                        array($this, 'add_additional_script'), 99);

        // First Load Ajax Action
        add_action( 'wp_footer',                        array($this, 'first_load_footer_action'), 1);
        add_action( 'jnews_push_first_load_action',     array($this, 'push_action'));
    }

    public function push_action($action)
    {
        if(is_array($action))
        {
            $this->load_action = array_merge($this->load_action, $action);
        } else {
            $this->load_action[] = $action;
        }

        $this->load_action = array_unique($this->load_action);
    }

    public function first_load_footer_action()
    {
        $footer_script = "<script type=\"text/javascript\">var jfla = " . json_encode($this->load_action) . "</script>";
        echo jnews_sanitize_output( $footer_script );
    }

    public function add_additional_script()
    {
        $script = get_theme_mod('jnews_additional_js', '');

        if( ! empty( $script ) )
        {
            $html = strip_tags($script);
            $script_tag =
                "<script>$html</script>";

            echo jnews_sanitize_output( $script_tag );
        }
    }

    public function add_typekit()
    {
        $typekit = get_theme_mod('jnews_type_kit_id', '');
        if( ! empty( $typekit ) )
        {
            $typekit =
                "<script type=\"text/javascript\" src=\"https://use.typekit.net/" . $typekit . ".js\"></script>
                 <script>try{Typekit.load({ async: true });}catch(e){}</script>";

            echo jnews_sanitize_output( $typekit );
        }
    }
    

    public function load_style()
    {
        $asset_url = $this->get_asset_uri();
        $theme_version = $this->get_theme_version();

        if(!$this->is_login_page())
        {
            wp_enqueue_style('wp-mediaelement');

            if( SCRIPT_DEBUG )
            {
                /***** Code harus di sync dengan webpack config ****/
                wp_enqueue_style('font-awesome',            $asset_url . 'fonts/font-awesome/font-awesome.min.css', null, $theme_version);
                wp_enqueue_style('jnews-icon',              $asset_url . 'fonts/jegicon/jegicon.css', null, $theme_version);
                wp_enqueue_style('jscrollpane',             $asset_url . 'css/jquery.jscrollpane.css', null, $theme_version);
                wp_enqueue_style('oknav',                   $asset_url . 'css/okayNav.css', null, $theme_version);
                wp_enqueue_style('magnific-popup',          $asset_url . 'css/magnific-popup.css', null, $theme_version);
                wp_enqueue_style('chosen',                  $asset_url . 'css/chosen/chosen.css', null, $theme_version);
                wp_enqueue_style('owl-carousel2',           $asset_url . 'js/owl-carousel2/assets/owl.carousel.min.css', null, $theme_version);
                wp_enqueue_style('photoswipe',              $asset_url . 'css/photoswipe/photoswipe.css', null, $theme_version);
                wp_enqueue_style('photoswipe-default',      $asset_url . 'css/photoswipe/default-skin/default-skin.css', null, $theme_version);
                wp_enqueue_style('jnews-newsticker',        $asset_url . 'css/jnewsticker.css', null, $theme_version);
                wp_enqueue_style('jnews-overlayslider',     $asset_url . 'css/joverlayslider.css', null, $theme_version);
                wp_enqueue_style('jnews-video-playlist',    $asset_url . 'css/jvidplaylist.css', null, $theme_version);
                wp_enqueue_style('jnews-main',              $asset_url . 'css/main.css', null, $theme_version);
                wp_enqueue_style('jnews-responsive',        $asset_url . 'css/responsive.css', null, $theme_version);
                wp_enqueue_style('jnews-pb-temp',           $asset_url . 'css/pb-temp.css', null, $theme_version);
                wp_enqueue_style('jnews-woocommerce',       $asset_url . 'css/woocommerce.css', null, $theme_version);
                wp_enqueue_style('jnews-bbpress',           $asset_url . 'css/bbpress.css', null, $theme_version);
            } else {
                wp_enqueue_style('jnews-frontend',          $asset_url . 'dist/frontend.min.css', null, $theme_version);
            }

            if ( defined('ELEMENTOR_VERSION') )
            {
	            wp_enqueue_style('jnews-elementor',         $asset_url . 'css/elementor-frontend.css', null, $theme_version);
            }

            wp_enqueue_style('jnews-style',             get_stylesheet_uri(), null, $theme_version);

            $scheme = get_theme_mod('jnews_scheme_color', 'normal');

            if($scheme === 'dark') {
                wp_enqueue_style('jnews-scheme-dark', $asset_url . 'css/dark.css', null, $theme_version);
            }

            if(is_rtl()) {
                wp_enqueue_style('jnews-rtl',           $asset_url . 'css/rtl.css', null, $theme_version);
            }

            $additional = get_option(Importer::$option);

            if ( isset( $additional['style'] ) ) 
            {
                $style = $additional['style'];

                if (!empty($style) && $style != 'default') 
                {
                    wp_enqueue_style('jnews-scheme',   JNEWS_THEME_URL . '/' . Importer::$default_path . $style .'/scheme.css', null, $theme_version);
                }
            }
        }
    }


    public function load_script()
    {
        if(!$this->is_login_page())
        {
            $asset_url = $this->get_asset_uri();
            $theme_version = $this->get_theme_version();

            if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
            wp_enqueue_script( 'wp-mediaelement' );

            if(get_theme_mod('jnews_single_popup_script', 'magnific') === 'photoswipe')
            {
                wp_enqueue_script('photoswipe',             $asset_url . 'js/photoswipe/photoswipe.js', null, $theme_version, true);
                wp_enqueue_script('photoswipe-ui-default',  $asset_url . 'js/photoswipe/photoswipe-ui-default.js', null, $theme_version, true);
            }

            wp_enqueue_script('hoverIntent');
            wp_enqueue_script('imagesloaded');

            if( SCRIPT_DEBUG )
            {
                /***** Code harus di sync dengan webpack config ****/
                wp_enqueue_script('lazysizes',              $asset_url . 'js/lazysizes.js', null, $theme_version, true);
                wp_enqueue_script('bgset',                  $asset_url . 'js/ls.bgset.js', null, $theme_version, true);
                wp_enqueue_script('owlcarousel',            $asset_url . 'js/owl-carousel2/owl.carousel.js', null, $theme_version, true);
                wp_enqueue_script('superfish',              $asset_url . 'js/superfish.js', null, $theme_version, true);
                wp_enqueue_script('theia-sticky-sidebar',   $asset_url . 'js/theia-sticky-sidebar.js', null, $theme_version, true);
                wp_enqueue_script('waypoint',               $asset_url . 'js/jquery.waypoints.js', null, $theme_version, true);
                wp_enqueue_script('scrollto',               $asset_url . 'js/jquery.scrollTo.js', null, $theme_version, true);
                wp_enqueue_script('parallax',               $asset_url . 'js/jquery.parallax.js', null, $theme_version, true);
                wp_enqueue_script('okaynav',                $asset_url . 'js/jquery.okayNav.js', null, $theme_version, true);
                wp_enqueue_script('mousewheel',             $asset_url . 'js/jquery.mousewheel.js', null, $theme_version, true);
                wp_enqueue_script('jscrollpane',            $asset_url . 'js/jquery.jscrollpane.js', null, $theme_version, true);
                wp_enqueue_script('modernizr',              $asset_url . 'js/modernizr-custom.js', null, $theme_version, true);
                wp_enqueue_script('smartresize',            $asset_url . 'js/jquery.smartresize.js', null, $theme_version, true);
                wp_enqueue_script('chosen',                 $asset_url . 'js/chosen.jquery.js', null, $theme_version, true);
                wp_enqueue_script('magnific',               $asset_url . 'js/jquery.magnific-popup.js', null, $theme_version, true);
                wp_enqueue_script('jnews-gif',              $asset_url . 'js/jquery.jnewsgif.js', null, $theme_version, true);
                wp_enqueue_script('jnews-newsticker',       $asset_url . 'js/jquery.jnewsticker.js', null, $theme_version, true);
                wp_enqueue_script('jnews-overlayslider',    $asset_url . 'js/jquery.joverlayslider.js', null, $theme_version, true);
                wp_enqueue_script('jnews-owlslider',        $asset_url . 'js/jquery.jowlslider.js', null, $theme_version, true);
                wp_enqueue_script('jnews-sticky',           $asset_url . 'js/jquery.jsticky.js', null, $theme_version, true);
                wp_enqueue_script('jnews-video-playlist',   $asset_url . 'js/jquery.jvidplaylist.js', null, $theme_version, true);
                wp_enqueue_script('jnews-landing-module',   $asset_url . 'js/jquery.module.js', null, $theme_version, true);

                wp_enqueue_script('jnews-main',             $asset_url . 'js/main.js', null, $theme_version, true);
                wp_localize_script('jnews-main', 'jnewsoption', $this->localize_script());
            } else {
                wp_enqueue_script('jnews-frontend', $asset_url . 'dist/frontend.min.js', null, $theme_version, true);
                wp_localize_script('jnews-frontend', 'jnewsoption', $this->localize_script());
            }

            wp_enqueue_script('html5shiv', $asset_url . 'js/html5shiv.min.js', null, $theme_version, true);
            wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');
        }
    }

    public function load_vc()
    {
        $asset_url = $this->get_asset_uri();
        $theme_version = $this->get_theme_version();

        if (function_exists('vc_is_page_editable') && vc_is_page_editable()) {
            wp_enqueue_script('jnews-vc-page-iframe', $asset_url . 'js/vc/jnews.vc.page.iframe.js', null, $theme_version, true);
            wp_enqueue_script('jnews-vc-inline', $asset_url . 'js/vc/jnews.vc.inline.js', null, $theme_version, true);
        }
    }

    public function localize_script()
    {
        global $is_IE;
        $option = array();
        $option['popup_script'] = get_theme_mod('jnews_single_popup_script', 'magnific');
        $option['single_gallery'] = get_theme_mod('jnews_single_as_gallery', false);
        $option['ismobile'] = wp_is_mobile();
        $option['isie'] = $is_IE;
        $option['sidefeed_ajax'] = false;
        $option['lang'] = get_locale();
        $option['module_prefix'] = ModuleManager::$module_ajax_prefix;
        
        if(get_theme_mod('jnews_sidefeed_enable', false))
        {
            $option['sidefeed_ajax'] = apply_filters('jnews_sidefeed_enable_ajax', get_theme_mod('jnews_sidefeed_enable_ajax', true));
        }

        $option['live_search'] = get_theme_mod('jnews_live_search_show', true);

        if(is_single() && !is_page()) {
            $option['postid'] = get_the_ID();
            $option['isblog'] = true;
        } else {
            $option['postid'] = 0;
            $option['isblog'] = false;
        }

        if(is_admin_bar_showing())
        {
            if(function_exists('vc_is_page_editable') && vc_is_page_editable())
            {
                $option['admin_bar'] = 0;
            } else {
                $option['admin_bar'] = 1;
            }
        } else {
            $option['admin_bar'] = 0;
        }

        $option['rtl'] = is_rtl() ? 1 : 0;
        $option['gif'] = get_theme_mod('jnews_transform_gif', false);
        return $option;
    }
}