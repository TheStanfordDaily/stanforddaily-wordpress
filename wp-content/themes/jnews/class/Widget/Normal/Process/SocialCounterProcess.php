<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal\Process;

Class SocialCounterProcess extends \WP_Background_Process
{
    /**
     * Action
     *
     * (default value: 'background_process')
     *
     * @var string
     * @access protected
     */
    protected $action = 'jnews_social_counter_widget_background_process';

    /**
     * Option name of cache
     * 
     * @var string
     */
    protected $cache_key = 'jnews_social_counter_widget_cache';

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
        $count = $this->fetch_data( $item );

        if ( !empty( $count ) ) 
        {
            $this->save_result( $item, $count );
        }

        return false;
    }

    /**
     * Fetch data
     * 
     * @param  array $data
     * 
     * @return int
     * 
     */
    protected function fetch_data( $data )
    {
        $response = wp_remote_get($data['social_grab'], array(
            'timeout' => 10,
        ));

        if ( !is_wp_error( $response ) && $response['response']['code'] == '200' ) 
        {   
            switch ( $data['social_type'] ) 
            {
                case 'twitter':
                    $pattern = "/title=\"(.*)\"(.*)data-nav=\"followers\"/i";
                    preg_match_all($pattern, $response['body'], $matches);

                    if ( !empty($matches[1][0]) ) 
                    {
                        $result = '';
                        foreach (str_split($matches[1][0]) as $char) {
                            if (is_numeric($char)) 
                            {
                                $result .= $char;
                            }
                        }
                        return (int) $result;
                    }
                    break;

                case 'instagram':
                    $pattern = '/window\._sharedData = (.*);<\/script>/';
                    preg_match($pattern, $response['body'], $matches);

                    if ( !empty($matches[1]) ) 
                    {
                        $result = json_decode($matches[1], true);
                        if (!empty($result['entry_data']['ProfilePage'][0]['graphql']['user']['edge_followed_by']['count']))
                        {
                            return $result['entry_data']['ProfilePage'][0]['graphql']['user']['edge_followed_by']['count'];
                        }
                    }
                    break;

                case 'pinterest':
                    $pattern = "/name=\"pinterestapp:followers\" content=\"(.*?)\"/";
                    preg_match($pattern, $response['body'], $matches);

                    if ( !empty($matches[1]) ) 
                    {
                        return (int) $matches[1];
                    }
                    break;

                case 'vimeo':
                    $pattern = "/data-title=\"(.*?) Follower(s?)\"/";
                    preg_match($pattern, $response['body'], $matches);

                    if ( !empty($matches[1]) ) 
                    {
                        $result = '';
                        foreach (str_split($matches[1]) as $char) {
                            if (is_numeric($char)) 
                            {
                                $result .= $char;
                            }
                        }
                        return (int) $result;
                    }
                    break;

                case 'soundcloud':
                    $pattern = "/<meta property=\"soundcloud:follower_count\" content=\"(.*?)\">/";
                    preg_match($pattern, $response['body'], $matches);

                    if ( !empty($matches[1]) ) 
                    {
                        return (int) $matches[1];
                    }
                    break;

                case 'google-plus':
                    $result = json_decode( $response['body'] );
                    if ( !empty($result->circledByCount) ) 
                    {
                        return (int) $result->circledByCount;
                    }
                    break;

                case 'youtube':
                    $result = json_decode( $response['body'] );
                    if ( !empty($result->items[0]) ) 
                    {
                        return (int) $result->items[0]->statistics->subscriberCount;
                    }
                    break;

                case 'facebook':
                    $result = json_decode( $response['body'] );
                    if ( !empty($result->fan_count) ) 
                    {
                        return (int) $result->fan_count;
                    }
                    break;

                case 'behance':
                    $result = json_decode( $response['body'] );
                    if ( !empty($result->user->stats->followers) ) 
                    {
                        return (int) $result->user->stats->followers;
                    }
                    break;

                case 'dribbble':
                    $pattern = "/<span class=\"label\">Followers<\/span>(\s+)<span class=\"count\">(.*?)<\/span>/";
                    preg_match_all($pattern, $response['body'], $matches);
                    
                    if ( !empty($matches[2][0]) ) 
                    {
                        $result = '';
                        foreach (str_split($matches[2][0]) as $char) {
                            if (is_numeric($char)) 
                            {
                                $result .= $char;
                            }
                        }
                        return (int) $result;
                    }
                    break;

                case 'flickr':
                    $pattern = "/\"followerCount\":(.*?),\"/";
                    preg_match($pattern, $response['body'], $matches);
                    
                    if ( !empty($matches[1]) ) 
                    {
                        return (int) $matches[1];
                    }
                    break;

                case 'github':
                    $pattern = "/class=\"counter\">(.*?)<\/span>/";
                    preg_match_all($pattern, str_replace("\n", "", $response['body']), $matches);
                    
                    if ( !empty($matches[1][2]) ) 
                    {
                        return $matches[1][2];
                    }
                    break;

                case 'linkedin_token':
                    $result = json_decode( $response['body'] );

                    wp_send_json(array(
                        'token'  => $result->access_token,
                        'expire' => $result->expires_in,
                    ));
                    break;

                case 'linkedin':
                    $pattern = "/<num-connections>(.*?)<\/num-connections>/";
                    preg_match($pattern, $response['body'], $matches);
                    
                    if ( !empty($matches[1]) ) 
                    {
                        return (int) $matches[1];
                    }
                    break;

                case 'foursquare':
                    $pattern = "/<li class=\"followers\"><span class=\"stat\"><strong>(.*?)<\/strong>/";
                    preg_match($pattern, $response['body'], $matches);
                    
                    if ( !empty($matches[1]) ) 
                    {
                        return (int) $matches[1];
                    }
                    break;

                case 'vine':
                    $result = json_decode( $response['body'] );
                    if ( !empty($result->data->followerCount) ) 
                    {
                        return $result->data->followerCount;
                    }
                    break;

                case 'twitch':
                    $result = json_decode( $response['body'] );
                    if ( !empty($result->followers) ) 
                    {
                        return $result->followers;
                    }
                    break;

                case 'vk':
                    $result = json_decode( $response['body'] );
                    if ( !empty($result->response->count) ) 
                    {
                       return $result->response->count;
                    }
                    break;
            } 
        }
        return null;
    }

    /**
     * Save result
     * 
     * @param  array $data 
     * @param  int   $count
     *      
     */
    protected function save_result( $data, $count )
    {
        $data_cache = get_option( $this->cache_key, array() );

        if ( is_array( $data_cache ) ) 
        {
            foreach ( $data_cache as &$social ) 
            {
                if ( $data['social_type'] == $social['social_type'] && $data['social_id'] == $social['social_id'] ) 
                {
                    $social['social_expire'] = current_time('timestamp');
                    $social['social_data']   = $count;
                }
            }
            
            update_option($this->cache_key, $data_cache);
        }
    }

}