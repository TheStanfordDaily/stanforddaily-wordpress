<?php
/**
 * @author Jegtheme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'JNews_Weather_Shortcode' ) )
{
    class JNews_Weather_Shortcode
    {   
        /**
         * @var JNews_Weather_Shortcode
         */
        private static $instance;

        /**
         * @var JNews_Weather
         */
        private $weather_instance;

        /**
         * @var string
         */
        private $prefix = 'add';

        /**
         * @var string
         */
        private $separator = '_';

        /**
         * @var string
         */
        private $suffix = 'shortcode';

        /**
         * @return JNews_Weather_Shortcode
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
         * JNews_Weather_Shortcode constructor
         */
        private function __construct()
        {
            add_action( 'current_screen' , array( $this, 'shortcode_button' ) );

            $this->weather_instance = JNews_Weather::getInstance();

            $this->register_shortcode();
        }

        /**
         * Register shortcode button
         */
        public function shortcode_button()
        {
            $screen = get_current_screen();

            if ( ( $screen->post_type === 'post' || $screen->post_type === 'page' ) && $screen->post_type !== '' )
            {
                if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') &&  get_user_option('rich_editing') == 'true')
                {
                    add_filter( 'mce_buttons_3' , array( $this, 'register_button' ), 11 );
                }
            }
        }

        /**
         * Weather shortcode button
         * 
         * @param  array $buttons
         * 
         * @return array      
         *    
         */
        public function register_button( $buttons )
        {
            array_push( $buttons, '|' );
            array_push( $buttons, 'jnews_weather' );

            return $buttons;
        }

        public function get_shortcode_func()
        {
            return $this->prefix . $this->separator . $this->suffix;
        }

        /**
         * Register shortcode
         */
        public function register_shortcode()
        {   
            call_user_func_array( $this->get_shortcode_func() , array( 
                'jeg_weather', array( $this, 'jeg_weather' ) 
            ) );
        }

        /**
         * Build weather detail content
         * 
         * @param  array  $data  
         * 
         * @return string     
         *    
         */
        public function build_weather_detail( $data )
        {
            $output = "<div class=\"jeg_weather_detail clearfix\">
                            <div class=\"jeg_weather_humidity\">
                                <i class=\"fa fa-tint\"></i>
                                <span class=\"jeg_weather_value\">{$data['now']['humidity']}%</span>
                            </div>
                            <div class=\"jeg_weather_wind\">
                                <i class=\"jegicon jegicon-windy-sm\"></i>
                                <span class=\"jeg_weather_value\">{$data['now']['speed']}mh</span>
                            </div>
                            <div class=\"jeg_weather_cloud\">
                                <i class=\"fa fa-cloud\"></i>
                                <span class=\"jeg_weather_value\">{$data['now']['clouds']}%</span>
                            </div>
                        </div>";

            return $output;
        }

        /**
         * Build weather item content
         * 
         * @param  array $data 
         * @param  int   $count
         * 
         * @return string
         *        
         */
        public function build_weather_item( $data, $count )
        {
            $output  = '';
            $counter = 0;

            foreach ( $data['next'] as $item ) 
            {
                $counter++;

                if ( $counter > $count ) 
                {
                    break;
                }


                $icon = $this->weather_instance->get_icon_condition_handler( $item['condition'] );

                $output .= "<div class=\"jeg_weather_item\">
                                <div class=\"jeg_weather_icon\">
                                    <span class=\"jeg_weather_{$data['now']['condition']}\">
                                        <i class=\"jegicon {$icon['icon_sm']}\"></i>
                                    </span>
                                </div>
                                <div class=\"jeg_weather_temp\">
                                    <span class=\"max\">
                                        <span class=\"jeg_weather_value\">{$this->weather_instance->convert_temperature($item['temp_max'])}</span>
                                        <span class=\"jeg_weather_unit\">{$this->weather_instance->temp_unit}</span>
                                    </span>
                                    <span class=\"jeg_weather_separator\"></span>
                                    <span class=\"min\">
                                        <span class=\"jeg_weather_value\">{$this->weather_instance->convert_temperature($item['temp_min'])}</span>
                                        <span class=\"jeg_weather_unit\">{$this->weather_instance->temp_unit}</span>
                                    </span>
                                </div>
                                <div class=\"jeg_weather_day\">
                                    <span class=\"jeg_weather_day\">" . date( 'D', $item['time'] ) . "</span>
                                </div>
                            </div>";


            }

            return $output;
        }

        /**
         * Weather Shortcode
         */
        public function jeg_weather( $atts )
        {
            if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) return;

            $atts = shortcode_atts(
                array(
                    'location'      => '',
                    'auto_location' => '',
                    'count'         => '',
                    'item'          => '',
                ),
                $atts
            );

            $source = jnews_get_option('weather_forecast_source', 'yahoo');

            if ( $atts['auto_location'] ) 
            {
                $auto_location = $this->weather_instance->get_location();

                if ( $auto_location ) 
                {
                    $atts['location'] = $auto_location;
                }
            }

            $data = $this->weather_instance->check_cache( $source, $atts['location'] );

            if ( !is_array( $data ) ) 
            {
                return false;
            }

            $icon = $this->weather_instance->get_icon_condition_handler( $data['now']['condition'] );
            $item = ( $atts['item'] === 'show' ) ? 'all' : $atts['item'] ;

            return "<div class=\"jeg_weather_widget inline {$item} clearfix\">
                        <div class=\"jeg_weather_now\">
                            <div class=\"jeg_weather_head\">
                                <div class=\"jeg_weather_location\">
                                    <span>" . $data['location']['city'] . ', ' . $data['location']['country'] . "</span>
                                </div>
                            </div>
                            <div class=\"jeg_weather_desc\">
                                <div class=\"jeg_weather_today clearfix\">
                                    <div class=\"jeg_weather_icon\">
                                        <span class=\"jeg_weather_{$data['now']['condition']}\">
                                            <i class=\"jegicon {$icon['icon_lg']}\"></i>
                                        </span>
                                        <span class=\"jeg_weather_condition\">{$data['now']['desc']}</span>
                                    </div>
                                    <div class=\"jeg_weather_temp\">
                                        <span class=\"jeg_weather_value\">{$this->weather_instance->convert_temperature($data['now']['temp'])}</span>
                                        <span class=\"jeg_weather_degrees\">°</span>
                                        <span class=\"jeg_weather_unit\">{$this->weather_instance->temp_unit}</span>
                                    </div>
                                </div>
                                " . $this->build_weather_detail( $data ) . "
                            </div>
                        </div>
                        <div class=\"jeg_weather_next {$item} item_{$atts['count']} clearfix\">
                            " . $this->build_weather_item( $data, $atts['count'] ) . "
                        </div>
                    </div>";
        }
    }
}

