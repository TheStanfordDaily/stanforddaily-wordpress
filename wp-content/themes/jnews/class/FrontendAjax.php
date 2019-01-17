<?php
/**
 * @author : Jegtheme
 */
namespace JNews;

use Jeg\Template;
use JNews\Ajax\AccountHandler;
use JNews\Ajax\LiveSearch;
use JNews\Ajax\FirstLoadAction;
use JNews\Menu\Menu;
use JNews\Module\ModuleManager;
use JNews\Sidefeed\Sidefeed;
use JNews\Dashboard\SystemDashboard;

/**
 * Class JNews Frontend Ajax
 */
Class FrontendAjax
{
    /**
     * @var FrontendAjax
     */
    private static $instance;

    private $endpoint = 'ajax-request';

    /**
     * @return FrontendAjax
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
     * FrontendAjax constructor.
     */
    private function __construct()
    {
        add_action( 'wp_head',              array( $this, 'frontend_ajax_script' ), 1 );

        add_action( 'parse_request',        array( $this, 'ajax_parse_request' ) );
        add_filter( 'query_vars',           array( $this, 'ajax_query_vars' ) );
    }

    public function ajax_query_vars( $vars )
    {
        $vars[] = $this->endpoint;
        $vars[] = 'action';
        return $vars;
    }

    public function is_doing_ajax()
    {
        return true;
    }

    public function ajax_parse_request( $wp )
    {
        if ( array_key_exists( $this->endpoint, $wp->query_vars ) )
        {
            // need to flag this request is ajax request
            add_filter('wp_doing_ajax', array($this, 'is_doing_ajax'));

            $action = $wp->query_vars['action'];

            switch( $action )
            {
                case 'jnews_first_load_action' :
                    $fragment = new FirstLoadAction();
                    $fragment->build_response($_REQUEST['load_action']);
                    break;
                case 'jnews_newsfeed_load' :
                    $sidefeed = new Sidefeed();
                    $sidefeed->build_response();
                    break;
                case 'jnews_ajax_live_search' :
                    $search = new LiveSearch();
                    $search->build_response();
                    break;
                case 'jnews_mega_category_1' :
                    $mega_menu = Menu::getInstance();
                    $mega_menu->mega_menu_category_1_article();
                    break;
                case 'jnews_mega_category_2' :
                    $menu_menu = Menu::getInstance();
                    $menu_menu->mega_menu_category_2_article();
                    break;
                case 'jnews_refresh_nonce' :
                    wp_send_json(array(
                        'jnews_nonce' => wp_create_nonce('jnews-view-token')
                    ));
                    break;
                case 'jnews_system' :
                    $template   = new Template( JNEWS_THEME_DIR . 'class/Dashboard/template/' );
                    $system     = new SystemDashboard( $template );
                    $system->backend_status();
                    break;
                case 'login_handler':
                case 'register_handler':
                case 'forget_password_handler':
                    $account = AccountHandler::getInstance();
                    $account->$action();
                    break;
                case 'jnews_ajax_comment':
                    // ajax comment
                    query_posts(array( 'p' => $_REQUEST['post_id'], 'withcomments' => 1, 'feed' => 1 ));

                    while ( have_posts() ) : the_post();
                        global $post;
                        setup_postdata($post);
                        get_template_part('fragment/comments');
                    endwhile;

                    wp_reset_query();
                    break;
            }

            // Module Ajax
            $module_prefix = ModuleManager::$module_ajax_prefix;
            if(0 === strpos($action, $module_prefix))
            {
                $module_name = str_replace($module_prefix, '', $action);
                ModuleManager::getInstance()->module_ajax($module_name);
            }

            do_action( 'jnews_ajax_' . $action );

            exit;
        }
    }

    public function ajax_url()
    {
        return add_query_arg( array( $this->endpoint => 'jnews' ), home_url('/') );
    }

    public function frontend_ajax_script()
    {
        if(!is_admin())
        {
            ?>
            <script type="text/javascript"> var jnews_ajax_url = '<?php echo esc_url( $this->ajax_url() ); ?>'; </script>
            <?php
        }
    }
}