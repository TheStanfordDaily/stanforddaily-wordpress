<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Comment;

Class CommentProcess extends \WP_Background_Process
{
    /**
     * Action
     *
     * (default value: 'background_process')
     *
     * @var string
     * @access protected
     */
    protected $action = 'jnews_comment_number_background_process';

    /**
     * Option name of cache
     * 
     * @var string
     */
    protected $cache_key = 'jnews_comments_number';

    /**
     * Task
     *
     * Override this method to perform any actions required on each
     * queue item. Return the modified item for further processing
     * in the next pass through. Or, return false to remove the
     * item from the queue.
     *
     * @param mixed $item Queue item to iterate over.
     *
     * @return mixed
     */
    protected function task( $item )
    {
        $number = $this->fetch_data( $item['post_id'], $item['type'] );

        $this->save_result( $item['post_id'], $item['type'], $number );

        return false;
    }

    /**
     * Fetch data post comment
     * 
     * @param  int    $post_id
     * @param  string $type   
     * 
     * @return int
     *      
     */
    protected function fetch_data( $post_id, $type )
    {
        $comment_number = 0;

        if ( $type === 'facebook' )
        {
            $url    = 'https://graph.facebook.com/?id=' . apply_filters( 'jnews_get_permalink', get_permalink( $post_id ) );
            $result = $this->make_request( $url );

            if ( !empty( $result['share'] ) )
            {
                $comment_number = $result['share']['comment_count'];
            }
        } 

        if ( $type === 'disqus' ) 
        {
            $api_key   = get_theme_mod( 'jnews_comment_disqus_api_key', '' );
            $shortname = get_theme_mod( 'jnews_comment_disqus_shortname', '' );
            $url       = 'https://disqus.com/api/3.0/threads/set.json?api_key=' . urlencode( $api_key ) . '&forum=' . urlencode( $shortname ) . '&thread:link=' . apply_filters( 'jnews_get_permalink', get_permalink( $post_id ) ); // alternatif use details.json

            $result    = $this->make_request( $url );

            if ( !empty( $result['response'][0]['posts'] ) )
            {
                $comment_number = $result['response'][0]['posts'];
            }
        }

        return $comment_number;
    }

    /**
     * Make request
     * 
     * @param  string $url
     * 
     * @return bool|array (default:bool)
     * 
     */
    protected function make_request( $url )
    {
        $response = wp_remote_get( $url );

        if ( !is_wp_error( $response ) && $response['response']['code'] == '200' )
        {
            $result = json_decode( $response['body'], true );

            return $result;
        }

        return false;
    }

    /**
     * Save post meta data for post comment
     * 
     * @param  int   $post_id
     * @param  array $data   
     *          
     */
    protected function save_result( $post_id, $type, $number )
    {
        $data_comment = get_post_meta( $post_id, $this->cache_key, true );

        if ( ! empty( $data_comment[$type] ) ) 
        {
            $data_comment = array(
                    $type => array(
                        'number' => $number,
                        'expired' => current_time('timestamp')
                    )
                );
        } else {
            if ( $number > 0 ) 
            {
                $data_comment = array(
                    $type => array(
                        'number' => $number,
                        'expired' => current_time('timestamp')
                    )
                );
            } else {
                $data_comment = array(
                    $type => array(
                        'expired' => current_time('timestamp')
                    )
                );
            }
        }
        
        update_post_meta( $post_id, $this->cache_key, $data_comment );
    }
}