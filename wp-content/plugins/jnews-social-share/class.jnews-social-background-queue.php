<?php
/**
 * @author : Jegtheme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class JNews Initial Counter
 */
Class JNews_Social_Background_Queue
{
    /**
     * @var JNews_Social_Background_Queue
     */
    private static $instance;

    /**
     * @var JNews_Social_Background_Process
     */
    private $background_process;

    /**
     * @var Integer
     */
    private $expire;

    /**
     * @var array
     */
    private $queue;

    /**
     * @return JNews_Social_Background_Queue
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
     * JNews_Social_Background_Instance constructor.
     */
    private function __construct()
    {
        $this->background_process = new JNews_Social_Background_Process();
        $this->expire = 24 * 60 * 60; // set expire in 24 hours

        // We process queue while loading footer
        add_action('wp_footer', array($this, 'process_queue'));
    }

    /**
     * @return JNews_Social_Background_Process
     */
    public function get_background_process_instance()
    {
        return $this->background_process;
    }

    /**
     * @param $post_id
     */
    public function add_queue($post_id)
    {
        $this->queue[] = $post_id;
    }

    /**
     * Process Queue
     */
    public function process_queue()
    {
        $new_queue = false;

        if(!is_array($this->queue)) return;

        $this->queue = array_unique($this->queue);

        foreach($this->queue as $post_id)
        {
            if($this->is_expire($post_id))
            {
                $this->background_process->push_to_queue($post_id);
                $this->update_expire($post_id);
                $new_queue = true;
            }
        }

        if($new_queue)
        {
            $this->background_process->save()->dispatch();
        }
    }

    /**
     * check if we counter timeout is expire
     *
     * @param int
     * @return bool
     */
    public function is_expire($post_id)
    {
        $timeout        = apply_filters('jnews_social_counter_expire_timeout', $this->expire);
        $now            = current_time( 'timestamp' );
        $last_update    = get_post_meta($post_id, JNEWS_SOCIAL_COUNTER_LAST_UPDATE, true);
        $expire         = true;

        if($last_update > ( $now - $timeout )) {
            $expire = false;
        }

        return apply_filters('jnews_social_counter_expire_flag', $expire);
    }

    /**
     * @param $post_id
     */
    public function update_expire($post_id)
    {
        // set last fetched social
        update_post_meta($post_id, JNEWS_SOCIAL_COUNTER_LAST_UPDATE, current_time( 'timestamp' ));
    }
}