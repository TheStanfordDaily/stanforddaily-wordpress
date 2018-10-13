<?php
/**
 * @author : Jegtheme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class JNews Social Counter
 */
Class JNews_Social_Counter
{
    /**
     * @var Integer
     */
    private $post_id;

    /**
     * JNews_Util_Counter_Social constructor.
     *
     * @param $post_id
     */
    public function __construct($post_id = null)
    {
        $this->post_id = ($post_id === null ) ? get_the_ID() : $post_id;

        // put queue on background process
        JNews_Social_Background_Queue::getInstance()->add_queue($this->post_id);
    }

    /**
     * Get Share Result
     * option : all | total |
     *
     * @param string $type
     * @return array | integer | null
     */
    public function get_share($type = 'all')
    {
        if($type === 'all') {
            $share = get_post_meta($this->post_id, JNEWS_SOCIAL_COUNTER_ALL, true);
        } else if($type === 'total') {
            $share = get_post_meta($this->post_id, JNEWS_SOCIAL_COUNTER_TOTAL, true);
        } else {
            $social_share = get_post_meta($this->post_id, JNEWS_SOCIAL_COUNTER_ALL, true);

            if(is_array($social_share))
            {
                $share = isset($social_share[$type]) ? $social_share[$type] : 0;
            } else {
                $share = 0;
            }
        }

        return apply_filters('jnews_social_counter_get_share', $share, $this->post_id);
    }
}

