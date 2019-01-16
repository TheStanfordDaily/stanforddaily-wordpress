<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Dashboard;

use Jeg\Template;
use JNews\Importer;
use JNews\Util\ValidateLicense;

Class ImportDashboard
{
    /**
     * @var Template
     */
    private $template;

    /**
     * @var Importer
     */
    private $importer;

    /**
     * @var ValidateLicense
     */
    private $license;

    /**
     * @var array
     */
    private $content;

    /**
     * @var TGM_Plugin_Activation
     */
    private $tgm_instance;


    public function __construct($template)
    {
        $this->template = $template;
        $this->content = $this->available_content();
        $this->import_url = 'data/import/';

        $this->setup_hook();
        $this->setup_plugin();
    }

    /**
     * Setting up all Hook
     */
    public function setup_hook()
    {
        add_action('jnews_import_content', array(&$this, 'import_view'));

        add_action('wp_ajax_jnews_ajax_import_content',        array($this, 'do_import_content'));
        add_action('wp_ajax_nopriv_jnews_ajax_import_content', array($this, 'do_import_content'));

        add_action('wp_ajax_jnews_ajax_import_item',            array($this, 'do_import_item'));
        add_action('wp_ajax_nopriv_jnews_ajax_import_item',     array($this, 'do_import_item'));

        add_action('wp_ajax_jnews_ajax_install_item',           array($this, 'do_plugin_item'));
        add_action('wp_ajax_nopriv_jnews_ajax_install_item',    array($this, 'do_plugin_item'));
    }

    protected function setup_plugin()
    {
        do_action('tgmpa_register');
        $this->tgm_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
    }

    /**
     * Available Content
     *
     * @return array
     */
    public function available_content()
    {
        return array(
            'default' => array(
                'name' => esc_html__('Default Demo', 'jnews'),
                'category' => 'news',
                'demo' => 'https://jnews.io/default'
            ),
            'tech' => array(
                'name' => esc_html__('Tech Demo', 'jnews'),
                'category' => 'news',
                'demo' => 'https://jnews.io/tech'
            ),
            'news' => array(
                'name' => esc_html__('News Demo', 'jnews'),
                'category' => 'news',
                'demo' => 'https://jnews.io/news'
            ),
            'food' => array(
                'name' => esc_html__('Food Demo', 'jnews'),
                'category' => 'blog',
                'demo' => 'https://jnews.io/food'
            ),
            'travel' => array(
                'name' => esc_html__('Travel Demo', 'jnews'),
                'category' => 'magazine',
                'demo' => 'https://jnews.io/travel'
            ),
            'fashion-blog' => array(
                'name' => esc_html__('Fashion Blog Demo', 'jnews'),
                'category' => 'blog',
                'demo' => 'https://jnews.io/fashion-blog'
            ),
            'parenting' => array(
                'name' => esc_html__('Parenting News', 'jnews'),
                'category' => 'news',
                'demo' => 'https://jnews.io/parenting'
            ),
            'newspaper' => array(
                'name' => esc_html__('Newspaper', 'jnews'),
                'category' => 'news',
                'demo' => 'https://jnews.io/newspaper'
            ),
            'game' => array(
                'name' => esc_html__('Game Demo', 'jnews'),
                'category' => 'magazine',
                'demo' => 'https://jnews.io/game'
            ),
            'personal-blog' => array(
                'name' => esc_html__('Personal Blog', 'jnews'),
                'category' => 'blog',
                'demo' => 'https://jnews.io/personal-blog'
            ),
            'lifestyle' => array(
                'name' => esc_html__('Lifestyle Demo', 'jnews'),
                'category' => 'magazine',
                'demo' => 'https://jnews.io/lifestyle'
            ),
            'science' => array(
                'name' => esc_html__('Science News', 'jnews'),
                'category' => 'news',
                'demo' => 'https://jnews.io/science'
            ),
            'sport' => array(
                'name' => esc_html__('Sport Demo', 'jnews'),
                'category' => 'news',
                'demo' => 'https://jnews.io/sport'
            ),
            'motorcycle' => array(
                'name' => esc_html__('Motorcycle', 'jnews'),
                'category' => 'magazine',
                'demo' => 'https://jnews.io/motorcycle'
            ),
            'architect' => array(
                'name' => esc_html__('Architect News', 'jnews'),
                'category' => 'news',
                'demo' => 'https://jnews.io/architect'
            ),
            'interior' => array(
                'name' => esc_html__('Interior Design Blog', 'jnews'),
                'category' => 'blog',
                'demo' => 'https://jnews.io/interior'
            ),
            'gag' => array(
                'name' => esc_html__('Gag Demo', 'jnews'),
                'category' => 'magazine',
                'demo' => 'https://jnews.io/gag'
            ),
            'gadget-review' => array(
                'name' => esc_html__('Gadget Review', 'jnews'),
                'category' => 'magazine',
                'demo' => 'https://jnews.io/gadget-review'
            ),
            'health' => array(
                'name' => esc_html__('Health Demo', 'jnews'),
                'category' => 'magazine',
                'demo' => 'https://jnews.io/health'
            ),
            'viral' => array(
                'name' => esc_html__('Viral Demo', 'jnews'),
                'category' => 'magazine',
                'demo' => 'https://jnews.io/viral'
            ),
            'video' => array(
                'name' => esc_html__('Video', 'jnews'),
                'category' => 'magazine',
                'demo' => 'https://jnews.io/video'
            ),
            'movie' => array(
                'name' => esc_html__('Movie Holic', 'jnews'),
                'category' => 'blog',
                'demo' => 'https://jnews.io/movie'
            ),
            'pets' => array(
                'name' => esc_html__('Animal Care', 'jnews'),
                'category' => 'magazine',
                'demo' => 'https://jnews.io/pets'
            ),
            'rtl' => array(
                'name' => esc_html__('RTL Demo', 'jnews'),
                'category' => 'magazine',
                'demo' => 'https://jnews.io/rtl'
            ),
            'business' => array(
                'name' => esc_html__('Business News', 'jnews'),
                'category' => 'news',
                'demo' => 'https://jnews.io/business'
            ),

            'music' => array(
                'name' => esc_html__('Music News', 'jnews'),
                'category' => 'magazine',
                'demo' => 'https://jnews.io/music'
            ),

            'magazine' => array(
                'name' => esc_html__('Magazine', 'jnews'),
                'category' => 'magazine',
                'demo' => 'https://jnews.io/magazine'
            ),

            'photography' => array(
                'name' => esc_html__('Photography Blog', 'jnews'),
                'category' => 'blog',
                'demo' => 'https://jnews.io/photography'
            ),

            'fitness' => array(
                'name' => esc_html__('Fitness News', 'jnews'),
                'category' => 'news',
                'demo' => 'https://jnews.io/fitness'
            ),

            'cryptonews' => array(
                'name' => esc_html__('Crypto News', 'jnews'),
                'category' => 'news',
                'demo' => 'https://jnews.io/cryptonews'
            ),

            'classic-blog' => array(
                'name' => esc_html__('Classic Blog', 'jnews'),
                'category' => 'blog',
                'demo' => 'https://jnews.io/classic-blog'
            ),

            'localnews' => array(
                'name' => esc_html__('Local News', 'jnews'),
                'category' => 'news',
                'demo' => 'https://jnews.io/localnews'
            ),

            'metronews' => array(
	            'name' => esc_html__('Metro News', 'jnews'),
	            'category' => 'news',
	            'demo' => 'https://jnews.io/metro'
            ),

            'coming-soon-1' => array(
                'name' => esc_html__('Coming Soon', 'jnews'),
                'category' => 'coming-soon',
                'demo' => '#'
            ),
            'coming-soon-2' => array(
	            'name' => esc_html__('Coming Soon', 'jnews'),
	            'category' => 'coming-soon',
	            'demo' => '#'
            ),
            'coming-soon-3' => array(
	            'name' => esc_html__('Coming Soon', 'jnews'),
	            'category' => 'coming-soon',
	            'demo' => '#'
            )
        );
    }

    /**
     * Populate data from available content
     *
     * @return array
     */
    public function get_data()
    {
        $data = array();

        foreach($this->content as $key => $value)
        {
            $data['content'][$key] = array
            (
                'id'                => $key,
                'image'             => JNEWS_THEME_URL . '/' . Importer::$default_path . $key . '/thumbnail.png',
                'name'              => $value['name'],
                'demo'              => $value['demo'],
                'category-slug'     => sanitize_title($value['category']),
                'category'          => $value['category'],
            );

            if ( $value['category'] === 'coming-soon' ) 
            {
                $data['content'][$key]['image'] = JNEWS_THEME_URL . '/data/import/placeholder.png';
            }
        }

        $importer = get_option(Importer::$option);
        $data['installed_style'] = $importer['style'];
        $data['installed_content'] = $importer['content'];

        return $data;
    }

    /**
     * Step of Import
     *
     * @param $type
     * @param $import_content
     */
    public function import_step($type, $id, $import_content, $import_plugin)
    {
        $option = get_option(Importer::$option);
        $this->importer = new Importer($id);

        if($type === 'install')
        {
            if($import_content)
            {
                $steps = array(
                    array(
                        'id' => 'uninstall',
                        'text' => esc_html__('Uninstall Demo','jnews'),
                        'items' => array('style', 'widget', 'menu', 'post', 'taxonomy', 'image', 'finish')
                    ),
                    array(
                        'id'    => 'image',
                        'text'  => esc_html__('Importing Image','jnews'),
                        'items'  => $this->importer->get_image_index()
                    ),
                    array(
                        'id' => 'taxonomy',
                        'text' => esc_html__('Importing Taxonomy','jnews')
                    ),
                    array(
                        'id' => 'post',
                        'text' => esc_html__('Importing Post','jnews'),
                        'items'  => $this->importer->get_post_index()
                    ),
                    array(
                        'id' => 'menu_location',
                        'text' => esc_html__('Importing Menu','jnews')
                    ),
                    array(
                        'id' => 'menu',
                        'text' => esc_html__('Importing Menu','jnews')
                    ),
                    array(
                        'id' => 'widget',
                        'text' => esc_html__('Importing Widget','jnews')
                    ),
                    array(
                        'id' => 'customizer',
                        'text' => esc_html__('Importing Customizer','jnews')
                    ),
                );
            } else {
                $steps = array(
                    array(
                        'id' => 'style_only',
                        'text' => esc_html__('Importing Style','jnews')
                    ),
                );
            }

            if ( $import_plugin ) 
            {
                array_unshift( $steps,
                    array(
                        'id' => 'plugin',
                        'text' => esc_html__('Installing Required Plugin','jnews'),
                        'items' => array('js_composer', 'vafpress-post-formats-ui-develop', 'jnews-essential', 'elementor')
                    ),
                    array(
                        'id' => 'related_plugin',
                        'text' => esc_html__('Installing Related Plugin','jnews'),
                        'items' => $this->importer->get_plugin_index()
                    )
                );
            }

            // do we need to backup the content first?
            if( ! $option )
            {
                array_unshift($steps, array(
                    'id' => 'backup',
                    'text' => esc_html__('Backup','jnews')
                ));
            }

        } else {
            $steps = array(
                array(
                    'id' => 'begin',
                    'text' => esc_html__('Begin Uninstall','jnews')
                ),
                array(
                    'id' => 'uninstall',
                    'text' => esc_html__('Uninstall Demo','jnews'),
                    'items' => array('style', 'widget', 'menu', 'post', 'taxonomy', 'image', 'finish')
                ),
                array(
                    'id' => 'restore',
                    'text' => esc_html__('Restore Data','jnews')
                ),
                array(
                    'id' => 'end',
                    'text' => esc_html__('Finish Uninstall','jnews')
                ),
            );
        }

        wp_send_json(array(
            'response' => 1,
            'steps' => $steps
        ));
    }

    /**
     * Uninstall content
     */
    public function uninstall_content()
    {
        $option = get_option(Importer::$option);

        $content = new Importer($option['content']);
        $content->do_uninstall_content();
        $content->delete_import_option('content');

        $style = new Importer($option['style']);
        $style->uninstall_style();
	    $style->delete_import_option('style');

        delete_option(Importer::$option);

        wp_send_json(array('response' => 1));
    }

    /**
     * Import Content
     *
     * @param $id
     * @param $step
     */
    public function import_content($id, $step)
    {
        $content_flag = array('image', 'taxonomy', 'post', 'menu_location', 'menu', 'widget');
        $style_flag = array('customizer', 'style_only');

        $this->importer = new Importer( $id );

        // Import Only Style
        if($step === 'style_only')
        {
            $this->importer->do_import_style_only();
        } else {
            $this->importer->do_import($step);
        }

        // Import Content & Flag as Content
        if(in_array($step, $content_flag))
        {
            $this->importer->save_import_option('content', $id);
        }

        // Import Style & Customizer, Flag as style
        if(in_array($step, $style_flag))
        {
            $this->importer->save_import_option('style', $id);
        }

        wp_send_json(array('response' => 1));
    }

    /**
     * Backup
     *
     * @param $id
     */
    public function backup_content($id)
    {
        $this->importer = new Importer( $id );

        $this->importer->do_backup();

        wp_send_json(array('response' => 1));
    }

    /**
     * Restore Content
     *
     * @param $id
     */
    public function restore_content($id)
    {
        $this->importer = new Importer( $id );

        $this->importer->do_restore();

        wp_send_json(array('response' => 1));
    }

    /**
     * Actual Import Content
     */
    public function do_import_content()
    {
        if( isset($_REQUEST['step']) && check_admin_referer( 'jnews_import', 'nonce' ) )
        {
            $step           = $_REQUEST['step'];
            $type           = $_REQUEST['type'];
            $id             = $_REQUEST['id'];
            $import_content = $_REQUEST['content'] === 'true' ? true : false;
            $import_plugin  = $_REQUEST['plugin'] === 'true' ? true : false;

            if( $step === 'check_step' )
            {
                $this->import_step($type, $id, $import_content, $import_plugin);

            } else if ( $step === 'uninstall' ) {

                $this->uninstall_content();

            } else if( $step === 'backup' ) {

                $this->backup_content($id);

            } else if( $step === 'restore' ) {

                $this->restore_content($id);

            } else if ($step === 'begin' || $step === 'end') {

                // we don't need to do anything here...
                wp_send_json(array('response' => 1));

            } else {

                $this->import_content($id, $step);

            }
        }
    }

    /**
     * Normal query may take too long to finish execution.
     * that is why we need to make it smaller
     */
    public function do_import_item()
    {
        if( isset($_REQUEST['step']) && isset($_REQUEST['key']) && check_admin_referer( 'jnews_import', 'nonce' ) )
        {
            $id             = $_REQUEST['id'];
            $step           = $_REQUEST['step'];
            $key            = $_REQUEST['key'];
            $builder        = $_REQUEST['builder'] === 'true' ? 'elementor' : 'vc';

            if($step === 'uninstall')
            {
                $option = get_option(Importer::$option);

                if ( $key === 'style' ) 
                {
                    $style = new Importer($option['style']);
                    $style->do_uninstall_single( $key );
                } else {
                    $content = new Importer($option['content']);
                    $content->do_uninstall_single( $key );
                }
            } else {
                $import = new Importer( $id );
                $import->do_import_single($step, $key, $builder);
            }

            wp_send_json(array('response' => 1));
        }
    }

    /**
     * Ajax handler for install plugin
     */
    public function do_plugin_item()
    {
        if( isset($_REQUEST['step']) && isset($_REQUEST['key']) && check_admin_referer( 'jnews_import', 'nonce' ) )
        {
            $type           = $_REQUEST['type'];
            $item           = $_REQUEST['key'];
	        $builder        = $_REQUEST['builder'] === 'true' ? 'elementor' : 'js_composer';
            $path           = $this->tgm_instance->plugins[$item]['file_path'];

            if ( $type === 'install' && $item !== $builder )
            {
                if ( $this->tgm_instance->is_plugin_installed( $item ) ) 
                {
                    activate_plugins( $path, null, false, false );
                } else {
                    $this->do_install_plugin_item( $item );
                }
            }

            wp_send_json(array('response' => 1));
        }
    }

    /**
     * Installing plugin
     * 
     * @param  string $slug 
     * @param  string $doing
     *      
     */
    protected function do_install_plugin_item( $slug, $doing = 'install' )
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

        set_time_limit( MINUTE_IN_SECONDS * 60 * 2 );

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

        activate_plugins( $upgrader->plugin_info(), null, false, false );
    }

    /**
     * Render Import Content
     */
    public function import_view()
    {
        $this->template->render('import-content', $this->get_data(), true);
    }
}
