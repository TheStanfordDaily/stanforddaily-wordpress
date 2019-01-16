<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Dashboard;

use Jeg\Template;

Class AdminDashboard
{
    /**
     * @var AdminDashboard
     */
    private static $instance;

    /**
     * @var SystemDashboard
     */
    private $system;

    /**
     * @var PluginDashboard
     */
    private $plugin;

    /**
     * @var ImportDashboard
     */
    private $import;

    /**
     * @var Template
     */
    private $template;

    /**
     * @return AdminDashboard
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
        $this->template = new Template(JNEWS_THEME_DIR . 'class/Dashboard/template/');
        $this->setup_instance();
        $this->setup_hook();
        $this->admin_menu();
    }

    public function setup_instance()
    {
        $this->system = new SystemDashboard($this->template);
        $this->import = new ImportDashboard($this->template);
        $this->plugin = new PluginDashboard($this->template);
    }

    public function setup_hook()
    {
        add_action('vp_before_render_set', array(&$this, 'render_header'));
        add_filter('jnews_get_admin_menu', array(&$this, 'get_admin_menu'));
        add_filter('jnews_get_admin_slug', array(&$this, 'admin_slug'));
        add_action('after_switch_theme',   array(&$this, 'switch_themes'), 99);
    }

    public function switch_themes()
    {
        $slug = $this->admin_slug();
        global $pagenow;

        if ( is_admin() && 'themes.php' === $pagenow && isset( $_GET['activated'] ) )
        {
            wp_redirect(admin_url( 'admin.php?page=' . $slug['dashboard'] ));
        }
    }

    public function admin_slug()
    {
        $admin_slug = array(
            'dashboard' => 'jnews',
            'plugin' => 'jnews_plugin',
            'import' => 'jnews_import',
            'documentation' => 'jnews_documentation',
            'system' => 'jnews_system',
            'option' => 'jnews_option',
        );

        return apply_filters('jnews_admin_slug', $admin_slug);
    }

    public function get_admin_menu()
    {
        $slug = $this->admin_slug();
        $menu = array(
            array(
                'title' => esc_html__('Dashboard', 'jnews'),
                'menu' => esc_html__('JNews Dashboard', 'jnews'),
                'slug' => $slug['dashboard'],
                'action' => array(&$this, 'dashboard_landing'),
                'priority' => 51,
                'show_on_menu' => true
            ),
            array(
                'title' => esc_html__('Import Demo & Style', 'jnews'),
                'menu' => esc_html__('Import Demo & Style', 'jnews'),
                'slug' => $slug['import'],
                'action' => array(&$this, 'import_content'),
                'priority' => 53,
                'show_on_menu' => true
            ),
            array(
                'title' => esc_html__('Install Plugin', 'jnews'),
                'menu' => esc_html__('Install Plugin', 'jnews'),
                'slug' => $slug['plugin'],
                'action' => array(&$this, 'install_plugin'),
                'priority' => 52,
                'show_on_menu' => true
            ),
            array(
                'title' => esc_html__('Customize Style', 'jnews'),
                'menu' => esc_html__('Customize Style', 'jnews'),
                'slug' => 'customize.php',
                'action' => false,
                'priority' => 55,
                'show_on_menu' => true
            ),
            array(
                'title' => esc_html__('System Status', 'jnews'),
                'menu' => esc_html__('System Status', 'jnews'),
                'slug' => $slug['system'],
                'action' => array(&$this, 'system_status'),
                'priority' => 57,
                'show_on_menu' => true
            ),
            array(
                'title' => esc_html__('Video Documentation', 'jnews'),
                'menu' => esc_html__('Video Documentation', 'jnews'),
                'slug' => $slug['documentation'],
                'action' => array(&$this, 'documentation'),
                'priority' => 56,
                'show_on_menu' => true
            ),
        );

        return apply_filters('jnews_admin_menu', $menu);
    }

    public function admin_menu()
    {
        add_action('admin_menu', array($this, 'parent_menu'));
        add_action('admin_menu', array($this, 'child_menu'));
    }

    public function parent_menu()
    {
        do_action('jnews_admin_dashboard_parent', array(
            esc_html__('JNews', 'jnews'), esc_html__('JNews', 'jnews'), 'edit_theme_options', 'jnews', null, 'none', 3.001
        ));
    }

    public function child_menu()
    {
        $self = $this;
        $menus = $this->get_admin_menu();

        foreach ($menus as $menu) {
            if ($menu['show_on_menu']) {
                if ($menu['action']) {
                    do_action('jnews_admin_dashboard_child', array(
                        'jnews', $menu['title'], $menu['menu'], 'edit_theme_options', $menu['slug'], function () use ($self, $menu) {
                            $self->render_header();
                            call_user_func($menu['action']);
                        }
                    ));
                } else {
                    do_action('jnews_admin_dashboard_child', array(
                        'jnews', $menu['title'], $menu['menu'], 'edit_theme_options', $menu['slug']
                    ));
                }
            }
        }

    }

    public function render_header()
    {
        $this->template->render('admin-header-tab', null, true);
    }

    public function dashboard_landing()
    {
        $this->template->render('dashboard-landing', null, true);
    }

    public function documentation()
    {
        $this->template->render('documentation', null, true);
    }

    public function system_status()
    {
        $this->system->system_status();
    }

    public function import_content()
    {
        $this->import->import_view();
    }

    public function install_plugin()
    {
        $this->plugin->install_plugin();
    }

}
