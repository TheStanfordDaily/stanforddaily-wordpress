<?php
/**
 * @author Jegtheme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'JNews_Weather_TopBar' ) )
{
    class JNews_Weather_TopBar
    {   
        /**
         * @var JNews_Weather_TopBar
         */
        private static $instance;

        /**
         * @var JNews_Weather
         */
        private $weather_instance;

        /**
         * @return JNews_Weather_TopBar
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
         * JNews_Weather_TopBar constructor
         */
        private function __construct()
        {
            $this->weather_instance = JNews_Weather::getInstance();

            add_action( 'jnews_header_topbar_weather', array( $this, 'header_topbar_weather' ) );
        }

        /**
         * Header top bar weather hook
         */
        public function header_topbar_weather()
        {
            $source   = jnews_get_option('weather_forecast_source', 'yahoo');
            $location = jnews_get_option('top_bar_weather_location', '');

            if ( jnews_get_option('top_bar_weather_location_auto', '') ) 
            {
                $auto_location = $this->weather_instance->get_location();

                if ( $auto_location ) 
                {
                    $location = $auto_location;
                }
            }

            $data = $this->weather_instance->check_cache( $source, $location );

            if ( is_array( $data ) ) 
            {
                echo $this->header_topbar_weather_element( $data );
            }
        }

        /**
         * Header top bar weather element
         * 
         * @param  array  $data
         * 
         * @return string
         *       
         */
        public function header_topbar_weather_element( $data )
        {
            $item_class   = jnews_get_option('top_bar_weather_item', 'hide');
            $item_content = jnews_get_option('top_bar_weather_item_content', 'temp');
            $item_count   = jnews_get_option('top_bar_weather_item_count', '4');
            $temp_unit    = jnews_get_option('weather_default_temperature', 'c');
            
            $temp_item    = $this->build_weather_item( $data, $item_class, $item_count, $item_content, $temp_unit );
            $icon         = $this->weather_instance->get_icon_condition_handler( $data['now']['condition'] );

            return "<div class=\"jeg_nav_item jeg_top_weather {$item_class}\">
                        <div class=\"jeg_weather_condition\">
                            <span class=\"jeg_weather_icon\">
                                <i class=\"jegicon {$icon['icon_sm']}\"></i>
                            </span>
                        </div>
                        <div class=\"jeg_weather_temp\">
                            <span class=\"jeg_weather_value\">" . $this->weather_instance->convert_temperature( $data['now']['temp'] ) . "</span>
                            <span class=\"jeg_weather_unit\">&deg;{$temp_unit}</span>
                        </div>
                        <div class=\"jeg_weather_location\">
                            <span>{$data['location']['city']}</span>
                        </div>
                        <div class=\"jeg_weather_item {$item_class} {$item_content} item_{$item_count}\">
                            {$temp_item}
                        </div>
                    </div>";
        }

        /**
         * Build weather item
         * 
         * @param  array  $data        
         * @param  string $item_class  
         * @param  int    $item_count  
         * @param  string $item_content
         * @param  string $temp_unit   
         * 
         * @return string            
         *   
         */
        public function build_weather_item( $data, $item_class, $item_count, $item_content, $temp_unit )
        {
            $temp_item = '';
            $counter   = 0;

            if ( $item_class != 'hide' ) 
            {
                foreach ( $data['next'] as $item ) 
                {
                    $counter++;
                    if ( $counter > $item_count ) 
                    {
                        break;
                    }

                    $icon = $this->weather_instance->get_icon_condition_handler( $item['condition'] );

                    switch ( $item_content ) 
                    {
                        case 'temp':
                            $temp_content_output = "<span class=\"jeg_weather_value\">" . $this->weather_instance->convert_temperature( $item['temp'] ) . "</span>
                                                    <span class=\"jeg_weather_degrees\">&deg;</span>";
                            break;

                        case 'icon':
                            $temp_content_output = "<span class=\"jeg_weather_icon\"><i class=\"jegicon {$icon['icon_sm']}\"></i></span>";
                            break;

                        case 'both':
                            $temp_content_output = "<span class=\"jeg_weather_icon\"><i class=\"jegicon {$icon['icon_sm']}\"></i></span>
                                                    <span class=\"jeg_weather_value\">" . $this->weather_instance->convert_temperature( $item['temp'] ) . "</span>
                                                    <span class=\"jeg_weather_degrees\">&deg;</span>";
                            break;
                        
                        default:
                            $temp_content_output = "";
                            break;
                    }

                    $temp_item .= "<div class=\"item\">
                                        <div class=\"jeg_weather_temp\">
                                            {$temp_content_output}
                                            <span class=\"jeg_weather_day\">" . date( 'D', $item['time'] ) . "</span>
                                        </div>
                                    </div>";
                }

                if ( $item_class == 'slide' ) 
                {
                    $autoplay  = jnews_get_option('top_bar_weather_item_autoplay', '');
                    $autodelay = jnews_get_option('top_bar_weather_item_autodelay', '2') * 1000;
                    $autohover = jnews_get_option('top_bar_weather_item_autohover', '');

                    $temp_item = "<div class=\"jeg_weather_item_carousel owl-carousel\" data-autoplay=\"{$autoplay}\" data-auto-delay=\"{$autodelay}\" data-auto-hover=\"{$autohover}\">
                                    {$temp_item}
                                </div>"; 
                }
            } 

            return $temp_item;   
        }
    }
}

