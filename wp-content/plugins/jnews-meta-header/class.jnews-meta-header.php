<?php
/**
 * @author : Jegtheme
 */

class JNews_Meta_Header
{
    /**
     * @var JNews_Meta_Header
     */
    private static $instance;

    /**
     * @var JNews_Meta_Facebook
     */
    private $facebook_meta;

    /**
     * @var JNews_Meta_Twitter
     */
    private $twitter_meta;

    /**
     * @return JNews_Meta_Header
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
        add_action('wp', array($this, 'instantiate_post'));
        add_action('after_setup_theme', array($this, 'load_metabox'));
        add_action('wp_head', array($this, 'generate_social_meta'), 1);
    }

    public function load_metabox()
    {
        if(class_exists('VP_Metabox'))
        {
            new VP_Metabox(JNEWS_META_HEADER_DIR . '/metabox/social-meta.php');
        }
    }

    public function instantiate_post()
    {
        require_once 'class.jnews-meta-abstract.php';
        require_once 'class.jnews-meta-facebook.php';
        require_once 'class.jnews-meta-twitter.php';

        $post_id = get_the_ID();

        $this->facebook_meta = new JNews_Meta_Facebook($post_id);
        $this->twitter_meta = new JNews_Meta_Twitter($post_id);
    }

    public function generate_social_meta()
    {
        $this->facebook_meta->render_meta();
        $this->twitter_meta->render_meta();

        $this->add_fb_app_id();
    }

    public function add_fb_app_id()
    {
        $id = jnews_get_option('social_meta_fb_app_id', '');

        if(!empty( $id )) 
        {
            echo '<meta property="fb:app_id" content="' . $id . '">';
        }
    }
}
