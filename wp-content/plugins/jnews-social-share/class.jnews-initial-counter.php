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
Class JNews_Initial_Counter
{
    /**
     * @var JNews_Initial_Counter
     */
    private static $instance;

    /**
     * @return JNews_Initial_Counter
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
     * Total fake view
     *
     * @param null $total
     * @param $post_id
     * @param string $range
     * @return mixed|null
     */
    public function get_total_fake_view($total = null, $post_id, $range = 'all')
    {
        $total = str_replace( ',', '', $total );
	    $total = str_replace( '.', '', $total );
        $total = intval( $total );

        if ( ! $total ) 
        {
            $total = apply_filters('jnews_get_total_view', 0, $post_id, $range);
        }

        $total = (int) $total + (int) jnews_get_option('single_view_initial_value', 0);

        return $total;
    }


    /**
     * Fake share
     *
     * @param $post_id
     * @return float
     */
    public function fake_share($post_id)
    {
        $percentage = (int) jnews_get_option('single_social_share_view_percentage', 0);
        $view       = $this->get_total_fake_view(null, $post_id);

        return (int) round( $view * $percentage / 100 );
    }

    /**
     * Total fake share
     *
     * @param $total
     * @param $post_id
     * @return mixed
     */
    public function get_total_fake_share($total, $post_id)
    {
        $totalshare = (int) $total + (int) $this->fake_share($post_id);
        return $totalshare;
    }

    /**
     * @param $social
     * @return int|mixed|void
     */
    public function social_fake_percentage($social)
    {
        $percentage = 0;

        switch($social) {
            case "facebook" :
                $percentage = apply_filters('jnews_share_fake_percentage', 40, $social);
                break;
            case "twitter" :
                $percentage = apply_filters('jnews_share_fake_percentage', 25, $social);
                break;
            case "google" :
                $percentage = apply_filters('jnews_share_fake_percentage', 10, $social);
                break;
            case "pinterest" :
                $percentage = apply_filters('jnews_share_fake_percentage', 9, $social);
                break;
            case "linkedin" :
                $percentage = apply_filters('jnews_share_fake_percentage', 7, $social);
                break;
            case "vk" :
                $percentage = apply_filters('jnews_share_fake_percentage', 5, $social);
                break;
            case "buffer" :
                $percentage = apply_filters('jnews_share_fake_percentage', 3, $social);
                break;
            case "stumbleupon" :
                $percentage = apply_filters('jnews_share_fake_percentage', 1, $social);
                break;
        }

        return $percentage;
    }

    /**
     * Social Share
     *
     * @param $totalshare
     * @param $post_id
     * @param string $social
     * @return mixed
     */
    public function social_share($totalshare, $post_id, $social = 'facebook')
    {
        $socialshare = round ( $this->fake_share($post_id) * $this->social_fake_percentage($social) / 100 );
        $totalshare = $totalshare + $socialshare;
        return $totalshare;
    }

    /**
     * Fake like
     *
     * @param $post_id
     * @param string $type
     * @return int
     */
    public function fake_like($post_id, $type = 'like')
    {
        $percentage = (int) jnews_get_option('single_like_view_percentage', 0);

        $max_dislike = apply_filters('jnews_max_dislike', 8);
        $title_length = str_word_count(get_the_title($post_id));
        $like_percentage = 100 - ( $title_length % $max_dislike );
        $like_percentage = min($like_percentage, 99);

        $real_view = $total = apply_filters('jnews_get_total_view', 0, $post_id, 'all');
        $total_view = $this->get_total_fake_view($real_view, $post_id);

        $fake_like = round( $total_view * $percentage * $like_percentage / 10000 );
        $fake_dislike = round( $total_view * $percentage / 100 ) - $fake_like;

        if($type === 'like') {
            return (int) $fake_like;
        } else {
            return $fake_dislike;
        }

    }

    /**
     * Get total like with fake like
     *
     * @param $total
     * @param $post_id
     * @return int
     */
    public function total_like($total, $post_id)
    {
        $like = (int) $total + (int) $this->fake_like($post_id);
        return $like;
    }

    /**
     * Get total dislike
     *
     * @param $total
     * @param $post_id
     * @return int
     */
    public function total_dislike($total, $post_id)
    {
        $dislike = (int) $total + (int) $this->fake_like($post_id, 'dislike');
        return $dislike;
    }
}