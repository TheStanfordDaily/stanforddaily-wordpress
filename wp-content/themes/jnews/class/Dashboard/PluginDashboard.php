<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Dashboard;

use Jeg\Template;

Class PluginDashboard
{
    /**
     * @var \TGM_Plugin_Activation
     */
    private $tgm_instance;

    /**
     * @var Template
     */
    private $template;

    private $plugins = array();

    public function __construct($template)
    {
        $this->template = $template;
        $this->init_hook();
    }

    public function init_hook()
    {
        $this->register_instance();

        add_filter( 'jnews_plugin_action_url',           array(&$this, 'plugin_action_url'), null, 2 );
        add_filter( 'update_plugin_complete_actions',    array(&$this, 'plugin_complete_update_action') );
        add_filter( 'install_plugin_complete_actions',   array(&$this, 'plugin_complete_install_action') );

        add_action( 'wp_ajax_jnews_ajax_install_plugin',        array($this, 'ajax_install_plugin') );
        add_action( 'wp_ajax_nopriv_jnews_ajax_install_plugin', array($this, 'ajax_install_plugin') );

        register_activation_hook('js_composer/js_composer.php', array($this, 'disable_vc_welcome_page'));
    }

    public function plugin_complete_update_action($install_actions)
    {
        if ($this->is_jnews_plugin_page()) {
            return false;
        }
        return $install_actions;
    }

    public function plugin_complete_install_action($install_actions)
    {
        if ($this->is_jnews_plugin_page()) {
            return false;
        }
        return $install_actions;
    }

    public function register_instance()
    {
        do_action('tgmpa_register');

        $this->tgm_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );

        $this->plugins = jnews_plugin_group();
    }

    public function install_plugin()
    {
        if ($this->tgm_instance->do_plugin_install()) {
            return;
        }

        // Force refresh of available plugin information so we'll know about manual updates/deletes.
        wp_clean_plugins_cache( false );

        $parameter = array(
            'instance' => $this,
            'groups' => jnews_plugin_group(),
        );
        $this->template->render('install-plugin', $parameter, true);
    }

    /**
     * @return \TGM_Plugin_Activation
     */
    public function get_tgm_instance()
    {
        return $this->tgm_instance;
    }

    /**
     * @return Template
     */
    public function get_template()
    {
        return $this->template;
    }

    public function plugin_action_url($slug, $install_type)
    {
        $url = wp_nonce_url(
            add_query_arg(
                array(
                    'plugin' => urlencode($slug),
                    'tgmpa-' . $install_type => $install_type . '-plugin',
                ),
                $this->get_jnews_plugin_url()
            ),
            'tgmpa-' . $install_type,
            'tgmpa-nonce'
        );

        if( $install_type === 'deactivate' || $install_type === 'activate' )
        {
            $url = $url . '#' . $slug;
        }

        return $url;
    }

    /**
     * @return string
     */
    public function get_jnews_plugin_url()
    {
        $adminslug = apply_filters('jnews_get_admin_slug', '');
        return menu_page_url($adminslug['plugin'], false);
    }

    /**
     * @return bool
     */
    protected function is_jnews_plugin_page()
    {
        $adminslug = apply_filters('jnews_get_admin_slug', '');
        return isset($_GET['page']) && $adminslug['plugin'] === $_GET['page'];
    }

    public function disable_vc_welcome_page() 
    {
        remove_action( 'vc_activation_hook', 'vc_page_welcome_set_redirect' );
    }

    public function ajax_install_plugin()
    {
        if ( check_admin_referer( 'jnews_plugin', 'nonce' ) ) 
        {
            $slug   = $_POST['slug'];
            $path   = $_POST['path'];
            $doing  = $_POST['doing'];
            $step   = $_POST['step'];

            switch ( $doing )
            {
                case 'activate':
                    $this->ajax_activate_plugin_action( $slug, $path, $step );
                    break;

                case 'deactivate':
                    $this->ajax_deactivate_plugin_action( $slug, $path, $step );
                    break;

                case 'install':
                case 'update' :
                    $this->ajax_install_plugin_action( $slug, $step, $doing );
                    break;
            }
        }
    }

    public function ajax_activate_plugin_action( $slug, $path, $step )
    {
        switch ( $step )
        {
            case 'plugin-installed':
                if ( $this->tgm_instance->is_plugin_installed( $slug ) )
                {
                    wp_send_json(array(
                        'status'   => 1,
                        'step'     => 'plugin-active',
                        'path'     => $path,
                    ));
                } else {
                    wp_send_json(array(
                        'status'   => -1,
                        'notice'   => sprintf( __( 'Something went wrong with the plugin API. Please try to install &amp; activate the plugin via TGM Plugin Activation <a href="%s" target="_blank">here</a> or contact our support team <a href="%s" target="_blank">here</a>.', 'jnews' ), "themes.php?page=jnews-install-plugins", "http://support.jegtheme.com/"),
                    ));
                }
                break;

            case 'plugin-active':
                if ( !$this->tgm_instance->is_plugin_active( $slug ) )
                {
                    wp_send_json(array(
                        'status'   => 1,
                        'step'     => 'activate-plugin',
                    ));
                } else {
                    wp_send_json(array(
                        'status'   => 0,
                        'add_class' => 'plugin-activated',
                        'notice'   => __( 'No action taken. The plugin was already activated.', 'jnews' ),
                    ));
                }
                break;

            case 'activate-plugin':
                if ( $this->ajax_plugin_activate( $path ) )
                {
                    $plugin   = $this->tgm_instance->plugins[ $slug ];

                    $response = array(
                        'status'      => 0,
                        'path'        => $path,
                        'add_class'   => 'plugin-activated',
                        'description' => $this->install_plugin_response( $plugin, $slug ),
                        'refresh'     => isset( $plugin['refresh'] ) ? $plugin['refresh'] : false,
                        'notice'      =>  __( 'The plugin is successfully activated.', 'jnews' ),
                    );

                    if ( $this->tgm_instance->does_plugin_require_update( $slug ) )
                    {
                        $response['add_class'] = 'plugin-need-update';
                        $response['notice']    = __( 'A higher version of the plugin is needed. Please update the plugin.', 'jnews' );
                    }

                    wp_send_json( $response );
                } else {
                    wp_send_json(array(
                        'status'   => -1,
                        'notice'   => sprintf( __( 'Something went wrong with the plugin API. Please try to install &amp; activate the plugin via TGM Plugin Activation <a href="%s" target="_blank">here</a> or contact our support team <a href="%s" target="_blank">here</a>.', 'jnews' ), "themes.php?page=jnews-install-plugins", "http://support.jegtheme.com/"),
                    ));
                }
                break;
        }
    }

    public function ajax_deactivate_plugin_action( $slug, $path, $step )
    {
        switch ( $step )
        {
            case 'plugin-installed':
                if ( $this->tgm_instance->is_plugin_installed( $slug ) )
                {
                    wp_send_json(array(
                        'status'   => 1,
                        'step'     => 'plugin-active',
                    ));
                } else {
                    wp_send_json(array(
                        'status'   => -1,
                        'notice'   => sprintf( __( 'Something went wrong with the plugin API. Please try to install &amp; activate the plugin via TGM Plugin Activation <a href="%s" target="_blank">here</a> or contact our support team <a href="%s" target="_blank">here</a>.', 'jnews' ), "themes.php?page=jnews-install-plugins", "http://support.jegtheme.com/"),
                    ));
                }
                break;

            case 'plugin-active':
                if ( $this->tgm_instance->is_plugin_active( $slug ) )
                {
                    wp_send_json(array(
                        'status'   => 1,
                        'step'     => 'deactivate-plugin',
                    ));
                } else {
                    wp_send_json(array(
                        'status'   => 0,
                        'add_class' => 'plugin-installed',
                        'notice'   => __( 'No action taken. The plugin was already deactivated.', 'jnews' ),
                    ));
                }
                break;

            case 'deactivate-plugin':
                $this->ajax_plugin_deactivate( $path );

                if ( !$this->tgm_instance->is_plugin_active( $slug ) )
                {
                    wp_send_json(array(
                        'status'   => 1,
                        'step'     => 'update-plugin-check'
                    ));
                } else {
                    wp_send_json(array(
                        'status'   => -1,
                        'notice'   => sprintf( __( 'Something went wrong with the plugin API. Please try to install &amp; activate the plugin via TGM Plugin Activation <a href="%s" target="_blank">here</a> or contact our support team <a href="%s" target="_blank">here</a>.', 'jnews' ), "themes.php?page=jnews-install-plugins", "http://support.jegtheme.com/"),
                    ));
                }
                break;

            case 'update-plugin-check':
                $plugin   = $this->tgm_instance->plugins[ $slug ];

                $response = array(
                    'status'      => 0,
                    'path'        => $path,
                    'add_class'   => 'plugin-installed',
                    'description' => $this->install_plugin_response( $plugin, $slug ),
                    'refresh'     => isset( $plugin['refresh'] ) ? $plugin['refresh'] : false,
                    'notice'      =>  __( 'The plugin is successfully deactivated.', 'jnews' ),
                );

                if ( $this->tgm_instance->does_plugin_require_update( $slug ) )
                {
                    $response['add_class'] = 'plugin-need-update';
                    $response['notice']    = __( 'A higher version of the plugin is needed. Please update the plugin.', 'jnews' );
                }

                wp_send_json( $response );
                break;
        }
    }

    public function ajax_install_plugin_action( $slug, $step, $doing )
    {
        $slug      = $this->tgm_instance->sanitize_key( urldecode( $slug ) );
        $plugin    = $this->tgm_instance->plugins[ $slug ];

        $extra         = array();
        $extra['slug'] = $slug;
        $source        = $this->tgm_instance->get_download_url( $slug );
        $api           = ( 'repo' === $plugin['source_type'] ) ? $this->tgm_instance->get_plugin_api( $slug ) : null;
        $api           = ( false !== $api ) ? $api : null;

        $url = add_query_arg(
            array(
                'action' => $doing . '-plugin',
                'plugin' => urlencode( $slug ),
            ),
            'update.php'
        );

        if ( !class_exists( 'Plugin_Upgrader', false ) )
        {
            require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        }

        $skin_args = array(
            'type'   => ( 'bundled' !== $plugin['source_type'] ) ? 'web' : 'upload',
            'title'  => $plugin['name'],
            'url'    => esc_url_raw( $url ),
            'nonce'  => $doing . '-plugin_' . $slug,
            'plugin' => '',
            'api'    => $api,
            'extra'  => $extra,
        );

        if ( 'update' === $doing )
        {
            $skin_args['plugin'] = $plugin['file_path'];
            $skin                = new \Plugin_Upgrader_Skin( $skin_args );
        } else {
            $skin = new \Plugin_Installer_Skin( $skin_args );
        }

        $upgrader = new \Plugin_Upgrader( $skin );

        add_filter( 'upgrader_source_selection', array( $this->tgm_instance, 'maybe_adjust_source_dir' ), 1, 3 );

        set_time_limit( MINUTE_IN_SECONDS * 60 );

        if ( 'update' === $doing ) {
            $to_inject                    = array( $slug => $plugin );
            $to_inject[ $slug ]['source'] = $source;
            $this->tgm_instance->inject_update_info( $to_inject );

            $upgrader->upgrade( $plugin['file_path'] );
        } else {
            $upgrader->install( $source );
        }

        remove_filter( 'upgrader_source_selection', array( $this->tgm_instance, 'maybe_adjust_source_dir' ), 1 );

        $this->tgm_instance->populate_file_path( $slug );

        // $this->ajax_activate_plugin_action( $slug, $upgrader->plugin_info(), $step );

        $response = array(
            'status'      => 0,
            'path'        => $upgrader->plugin_info(),
            'add_class'   => 'plugin-installed',
            'description' => $this->install_plugin_response( $plugin, $slug ),
            'refresh'     => false,
            'notice'      =>  __( 'The plugin is successfully installed.', 'jnews' ),
        );

        wp_send_json( $response );
    }

    public function ajax_plugin_activate( $path )
    {
        $activate = activate_plugins( $path, null, false, false );

        return $activate;
    }

    public function ajax_plugin_deactivate( $path )
    {
        deactivate_plugins( $path );
    }

    public function install_plugin_response( $plugin, $slug )
    {
        $plugin_link = $plugin_version = '';
        $plugin_require_update = $this->tgm_instance->does_plugin_require_update( $slug );

        if ( isset( $plugin['link'] ) )
        {
            foreach( $plugin['link'] as $link )
            {
                $target      = $link['newtab'] ? 'target="_blank"' : '';
                $plugin_link .= "[ <a href=" . $link['url'] . " {$target}>" . $link['title'] . " </a> ] ";
            }
        }

        if ( !empty( $plugin['version'] ) )
        {
            $plugin_version =
                '<li>
                    ' . esc_html__('Required Version :', 'jnews') . '
                    <strong class="' . esc_attr( $plugin_require_update ? 'newversion' : '' ) . '">
                        ' . esc_html( $plugin['version'] ) . '
                    </strong>
                </li>';
        }

        $plugin_info =
            '<h3 class="jnews-item-title">
                ' . esc_html( $plugin['name'] ) . '
                ' .  $plugin_link .  '
            </h3>
            <em>
                ' . esc_html__('by', 'jnews') . '
                <strong>' . esc_html( $this->tgm_instance->get_plugin_author( $slug ) ) . '</strong>
            </em>
            <p>
                ' . trim( $this->tgm_instance->get_plugin_description( $slug ) ) . '
            </p>
            <div class="jnews-plugin-version">
                <ul>
                    <li>
                        ' . esc_html__('Installed Version :', 'jnews') . '
                        <strong>' . esc_html( $this->tgm_instance->get_installed_version( $slug ) ) . '</strong>
                    </li>
                    ' . $plugin_version . '
                </ul>
            </div>';

        return $plugin_info;
    }

}
