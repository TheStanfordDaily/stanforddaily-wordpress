<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Asset;

use JNews\Module\ModuleManager;

/**
 * Class JNews Load Assets
 */
Class BackendAsset extends AssetAbstract
{
    /**
     * @var BackendAsset
     */
    private static $instance;

    /**
     * @return BackendAsset
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
        add_action( 'admin_enqueue_scripts',            array($this, 'backend_script'), 99);
    }

    public function backend_script()
    {
        $asset_url = $this->get_asset_uri();
        $theme_version = $this->get_theme_version();

        wp_enqueue_style('jquery-ui-accordion');
        wp_enqueue_style('tooltipster',     $asset_url . 'css/admin/tooltipster.css', null, $theme_version);
        wp_enqueue_style('jnews-admin',     $asset_url . 'css/admin/admin-style.css', null, $theme_version);
        wp_enqueue_style('selectize',       $asset_url . 'css/admin/selectize.default.css', null );
        wp_enqueue_style('font-awesome',    $asset_url . 'css/font-awesome.min.css', null, $theme_version);
        wp_enqueue_style('vex',             $asset_url . 'css/admin/vex.css' );

        // load script
        wp_enqueue_script('jquery-ui-accordion');
        wp_enqueue_script( 'vex',           $asset_url . 'js/admin/vex.combined.min.js', array( 'jquery' ), null, true );
        wp_enqueue_script('tooltipster',    $asset_url . 'js/admin/jquery.tooltipster.min.js', array('jquery'), $theme_version, true);
        wp_enqueue_script('selectize',      $asset_url . 'js/vendor/selectize.js', array( 'jquery' ), $theme_version, true );
        wp_enqueue_script('jnews-widget',   $asset_url . 'js/admin/widget.js', array('jquery'), $theme_version, true);
        wp_enqueue_script('jnews-admin',    $asset_url . 'js/admin/jnews.admin.js', array('jquery'), $theme_version, true);
        wp_localize_script('jnews-admin', 'jnewsoption', $this->localize_script());

        if(function_exists('vc_is_frontend_editor') && vc_is_frontend_editor())
        {
            wp_enqueue_script('jnews-vc-frontend', $asset_url . '/js/vc/jnews.vc.frontend.js', array('jquery'), $theme_version, true);
            wp_localize_script('jnews-vc-frontend', 'jnewsmodule', ModuleManager::getInstance()->populate_module());
        }
    }

    public function localize_script()
    {
        $option = array();
        $option['plugin_admin'] = get_admin_url() . 'admin.php?page=jnews_plugin';
        $option['import_track'] = array(
            'url'               => home_url(),
            'license'           => apply_filters( 'jnews_check_is_license_validated', false ),
            'data_license'      => get_option( 'jnews_license' ),
            'demo'              => '',
            'import_type'       => 'content',
            'install_plugin'    => 1
        );
        return $option;
    }
}