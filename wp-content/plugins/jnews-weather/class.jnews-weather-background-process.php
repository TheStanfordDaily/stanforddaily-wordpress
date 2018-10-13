<?php
/**
 * @author : Jegtheme
 */

Class JNews_Weather_Background_Process extends WP_Background_Process
{
    /**
     * Action
     *
     * (default value: 'background_process')
     *
     * @var string
     * @access protected
     */
    protected $action = 'jnews_weather_background_process';

    /**
     * Option name of cache
     * 
     * @var string
     */
    protected $cache_key = "jnews_weather_cache";

    /**
     * @var JNews_Weather
     */        
    private $weather_instance;

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
        $this->weather_instance = JNews_Weather::getInstance();

        $feed = $this->fetch_data( $item['source'], $item['location'] );

        if (  !empty( $feed ) ) 
        {
            $this->save_result( $item, $feed );
        }

        return false;
    }

    /**
     * Fetch data
     * 
     * @param  string $source  
     * @param  string $location
     * 
     * @return array
     *           
     */
    protected function fetch_data( $source, $location )
    {
        $result = array();

        switch ( $source ) 
        {
            case 'yahoo':
                
                $url = 'https://query.yahooapis.com/v1/public/yql?q=select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="' . urldecode( $location ) . '")&format=json';

                $result = $this->weather_instance->make_request( $url );

                if ( !empty( $result ) ) 
                {
                    $result = $this->weather_instance->yahoo_handler_data( $result );
                }
                break;

            case 'darksky':

                $api_key    = jnews_get_option('weather_darksky_api_key', '');
                $coordinate = $this->weather_instance->get_location_coordinate( $location );

                if ( !empty( $api_key ) && !empty( $coordinate ) ) 
                {
                    $url = 'https://api.darksky.net/forecast/' . $api_key . '/' . $coordinate . '?exclude=hourly,flags,alerts,minutely';

                    $result = $this->weather_instance->make_request( $url );

                    if ( !empty( $result ) ) 
                    {
                        $result = $this->weather_instance->darksky_handler_data( $result, $location );
                    }
                }
                break;

            case 'openweathermap':

                $api_key = jnews_get_option('weather_openweathermap_api_key', '');

                if ( !empty( $api_key ) ) 
                {
                    $url = 'http://api.openweathermap.org/data/2.5/forecast/daily?q="' . urldecode( $location ) . '"&units=imperial&appid=' . $api_key;

                    $result = $this->weather_instance->make_request( $url );

                    if ( !empty( $result ) ) 
                    {
                        $result = $this->weather_instance->openweathermap_handler_data( $result );
                    }
                }
                break;

            case 'aerisweather':

                $id     = jnews_get_option('weather_aerisweather_id', '');
                $secret = jnews_get_option('weather_aerisweather_secret', '');

                if ( !empty( $id ) && !empty( $secret ) ) 
                {
                    $url = 'http://api.aerisapi.com/forecasts?p=' . urldecode( $location ) . '&client_id=' . $id . '&client_secret=' . $secret;

                    $result = $this->weather_instance->make_request( $url );

                    if ( !empty( $result ) ) 
                    {
                        $result = $this->weather_instance->aerisweather_handler_data( $result, $location );
                    }
                }
                break;
        }

        return $result;
    }

    /**
     * Save result
     * 
     * @param  array $data
     * @param  array $feed
     *    
     */
    protected function save_result( $data, $feed )
    {
        $cache = get_option( $this->cache_key, array() );

        if ( is_array( $cache ) ) 
        {
            foreach ( $cache as &$item ) 
            {
                if ( $data['source'] == $item['source'] && $data['location'] == $item['location'] ) 
                {
                    $item['expired'] = current_time('timestamp');
                    $item['data']    = $feed;
                }
            }

            update_option($this->cache_key, $cache);
        }
    }

}