<?php
/**
 * @author : Jegtheme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class JNews_Split_Post
 */
Class JNews_Split_Post
{
    /**
     * @var JNews_Split_Post
     */
    private static $instance;

    /**
     * @return JNews_Split_Post
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        add_filter('the_content', array($this, 'post_split'));
        add_action('wp_enqueue_scripts', array(&$this, 'load_javascript'));

        add_action('jnews_ajax_split_post_handler', array(&$this, 'split_ajax'));
    }

    public function load_javascript()
    {
        wp_enqueue_script( 'jnews-split', JNEWS_SPLIT_URL .'/assets/js/jquery.split.js', array('jquery'), null, true);
    }

    public function split_ajax()
    {
        $post_id    = $_POST['post_id'];
        query_posts(array(
            'p' => $post_id
        ));

        while ( have_posts() ) : the_post();

            $enable     = vp_metabox('jnews_post_split.enable_post_split', false);
            $tag        = vp_metabox('jnews_post_split.post_split.0.tag', 'h2');

            if($enable)
            {
                require_once 'class.jnews-split-tool.php';
                $splitter = new JNews_Split_Tool(get_the_content(), $tag, $tag);

                if($splitter->have_split_content())
                {
                    $result = $splitter->get_all_result();
                    $description = $result['content'][$_POST['index']]['description'];
                    $content = apply_filters('the_content', $description);

                    echo apply_filters('jnews_split_content_description', $content, $_POST['index'], $splitter->get_total_split() + 1);
                }
            }

        endwhile;

        wp_reset_query();

        exit;
    }

    public function post_split($content)
    {
        if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) 
        {
            return $content;
        }

        if(is_single() && get_post_type() === 'post')
        {
            $enable     = vp_metabox('jnews_post_split.enable_post_split', false);
            $tag        = vp_metabox('jnews_post_split.post_split.0.tag', 'h2');
            $template   = vp_metabox('jnews_post_split.post_split.0.template', '1');
            $numbering  = vp_metabox('jnews_post_split.post_split.0.numbering', 'asc');
            $mode       = vp_metabox('jnews_post_split.post_split.0.mode', 'normal');

            if($enable)
            {
                require_once 'class.jnews-split-tool.php';
                $splitter = new JNews_Split_Tool($content, $tag, $tag);

                if($splitter->have_split_content())
                {
                    $page = $this->get_current_page();

                    require_once 'type/class.jnews-split-type-abstract.php';

                    switch($template) {
                        case '1' :
                            require_once 'type/class.jnews-split-type-1.php';
                            $class = new JNews_Split_Type_1($splitter, $page, $numbering, $mode);
                            break;
                        case '2' :
                            require_once 'type/class.jnews-split-type-2.php';
                            $class = new JNews_Split_Type_2($splitter, $page, $numbering, $mode);
                            break;
                        case '3' :
                            require_once 'type/class.jnews-split-type-3.php';
                            $class = new JNews_Split_Type_3($splitter, $page, $numbering, $mode);
                            break;
                        case '4' :
                            require_once 'type/class.jnews-split-type-4.php';
                            $class = new JNews_Split_Type_4($splitter, $page, $numbering, $mode);
                            break;
                        case '5' :
                            require_once 'type/class.jnews-split-type-5.php';
                            $class = new JNews_Split_Type_5($splitter, $page, $numbering, $mode);
                            break;
                        default :
                            $class = null;
                            break;
                    }

                    if($class !== null) {
                        return $class->render();
                    }
                }
            }
        }

        return $content;
    }

    public function get_current_page()
    {
        $page = get_query_var('page') ? get_query_var('page') : 1;
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;

        return max($page, $paged);
    }
}

