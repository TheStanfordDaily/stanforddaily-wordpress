<?php
/**
 * @author : Jegtheme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

Class JNews_Weather_Widget extends WP_Widget
{
     /**
     * @var JNews_Weather
     */
    private $weather_instance;

    public function __construct()
    {
        parent::__construct(
            'jnews_weather',
            esc_html__('JNews : Weather', 'jnews-weather'), // Name
            array(
                'description' =>  esc_html__('Weather forecast for JNews', 'jnews-review'),
                'customize_selective_refresh' => true
            ), null);
    }

    /**
     * Register widget with WordPress.
     */
    public function form($instance)
    {
        $options = array (
            'title' => array(
                'title'     => esc_html__('Title', 'jnews-weather'),
                'desc'      => esc_html__('Title on widget header.', 'jnews-weather'),
                'type'      => 'text'
            ),
            'location' => array(
                'title'     => esc_html__('Weather Location', 'jnews-weather'),
                'desc'      => sprintf(__('You can insert <strong>"city name"</strong> or <strong>"city name, country code"</strong>. For more detail information, you can read our documentation <a href="%s" target="_blank">here</a>.', 'jnews-weather'), 'http://support.jegtheme.com/documentation/weather-forecast/'),
                'type'      => 'text'
            ),
            'location_name' => array(
                'title'     => esc_html__('Location Name', 'jnews-weather'),
                'desc'      => esc_html__('Insert custom name for weather location. Leave blank to use default location name.', 'jnews-weather'),
                'type'      => 'text'
            ),
            'auto_location' => array(
                'title'     => esc_html__('Auto Detect Location', 'jnews-weather'),
                'desc'      => sprintf(__('Enable this option will automatically detect weather location of your site visitor. For more detail information, you can read our documentation <a href="%s" target="_blank">here</a>.', 'jnews-weather'), 'http://support.jegtheme.com/documentation/weather-forecast/'),
                'type'      => 'checkbox'
            ),
            'date' => array(
                'title'     => esc_html__('Date Format', 'jnews-weather'),
                'desc'      => wp_kses(sprintf(__("Please set date format weather widget, for more detail about this format, please refer to
                                <a href='%s' target='_blank'>Developer Codex</a>. Leave blank if you wont show them.", "jnews-weather"), "https://developer.wordpress.org/reference/functions/current_time/"),
                wp_kses_allowed_html()),
                'type'      => 'text',
                'default'   => 'l, F j, Y',
            ),
            'detail' => array(
                'title'     => esc_html__('Detail Weather Forecast', 'jnews-weather'),
                'desc'      => esc_html__('Show weather forecast detail info for today.', 'jnews-weather'),
                'type'      => 'select',
                'default'   => 'show',
                'options'   => array(
                    'show' => esc_html__('Show', 'jnews-weather'),
                    'hide' => esc_html__('Hide', 'jnews-weather'),
                )
            ),
            'item' => array(
                'title'     => esc_html__('Next Days Weather Forecast', 'jnews-weather'),
                'desc'      => esc_html__('Show weather forecast info for next days.', 'jnews-weather'),
                'type'      => 'select',
                'default'   => 'all',
                'options'   => array(
                    'temp' => esc_html__('Temperature Only', 'jnews-weather'),
                    'icon' => esc_html__('Icon Weather Only', 'jnews-weather'),
                    'all'  => esc_html__('Show All', 'jnews-weather'),
                    'hide' => esc_html__('Hide All', 'jnews-weather'),
                ),
            ),
            'count' => array(
                'title'     => esc_html__('Number of Weather Item', 'jnews-weather'),
                'desc'      => esc_html__('Setup the number of days to show. This option will works if you show weather forecast info for next days.', 'jnews-weather'),
                'type'      => 'slider',
                'default'   => 4,
                'options'    => array(
                    'min'  => '3',
                    'max'  => '6',
                    'step' => '1',
                ),
                'dependency' => array(
                    array(
                        'field' => 'item',
                        'operator' => 'ex',
                        'value' => array('hide')
                    )
                )
            ),
            'background'   => array(
                'title'     => esc_html__('Image Background', 'jnews-weather'),
                'desc'      => esc_html__('Insert an image for weather background.', 'jnews-weather'),
                'type'      => 'image'
            ),
        );

        $generator = new \JNews\Widget\WidgetGenerator($this);
        $generator->render_form($options, $instance);
    }

    /**
     * Init widget
     * 
     * @param  array $args    
     * @param  array $instance
     * 
     */
    public function widget( $args, $instance )
    {
        $title = apply_filters( 'widget_title', isset($instance['title']) ? $instance['title'] : "" );

        echo $args['before_widget'];

        if ( ! empty( $title ) ) 
        {
            echo $args['before_title'] . wp_kses( $title, wp_kses_allowed_html() ) . $args['after_title'];
        }

        $this->weather_instance = JNews_Weather::getInstance();

        if ( !empty( $instance['location'] ) ) 
        {
            $this->render_content( $instance );
        }

        echo $args['after_widget'];
    }

    /**
     * Render widget content
     * 
     * @param  array $instance
     *        
     */
    public function render_content( $instance )
    {   
        $source = jnews_get_option('weather_forecast_source', 'yahoo');

        if ( !empty( $instance['auto_location'] ) ) 
        {
            $auto_location = $this->weather_instance->get_location();

            if ( $auto_location ) 
            {
                $instance['location']      = $auto_location;
                $instance['location_name'] = null;
            }
        }

        $data = $this->weather_instance->check_cache( $source, $instance['location'] );

        if ( !is_array( $data ) ) 
        {
            return false;
        }

        $location = empty( $instance['location_name'] ) ? $data['location']['city'] . ', ' . $data['location']['country'] : $instance['location_name'];
        $icon     = $this->weather_instance->get_icon_condition_handler( $data['now']['condition'] );

        $background = $bg_class = '';

        if ( !empty( $instance['background'] ) ) 
        {
            $background = wp_get_attachment_image_src( $instance['background'], 'full' );
            $background = $background[0];
            $background = "style=\"background-image: url({$background})\"";
            $bg_class   = 'background';
        }

        $output = "<div class=\"jeg_weather_widget {$bg_class}\" {$background}>
                        <div class=\"jeg_weather_now\">
                            <div class=\"jeg_weather_head\">
                                <div class=\"jeg_weather_location\">
                                    <span>{$location}</span>
                                </div>
                                <div class=\"jeg_weather_date\">
                                    <span>" . date_i18n($instance['date']) . "</span>
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
                                        <span class=\"jeg_weather_degrees\">&deg;</span>
                                        <span class=\"jeg_weather_unit\">{$this->weather_instance->temp_unit}</span>
                                    </div>
                                </div>
                                " . $this->build_weather_detail( $instance['detail'], $data ) . "
                            </div>
                        </div>
                        <div class=\"jeg_weather_next {$instance['item']} item_{$instance['count']} clearfix\">
                            " . $this->build_weather_item( $data, $instance['count'] ) . "
                        </div>
                    </div>";

        echo $output; 
    }

    /**
     * Build weather detail content
     * 
     * @param  string $detail
     * @param  array  $data  
     * 
     * @return string     
     *    
     */
    public function build_weather_detail( $detail, $data )
    {
        $output = '';

        if ( $detail === 'show' ) 
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
        }

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
                                <span class=\"max\"><span class=\"jeg_weather_value\">{$this->weather_instance->convert_temperature($item['temp_max'])}</span>
                                    <span class=\"jeg_weather_unit\">{$this->weather_instance->temp_unit}</span>
                                </span>
                                <span class=\"jeg_weather_separator\"></span>
                                <span class=\"min\"><span class=\"jeg_weather_value\">{$this->weather_instance->convert_temperature($item['temp_min'])}</span>
                                    <span class=\"jeg_weather_unit\">{$this->weather_instance->temp_unit}</span>
                                </span>
                            </div>
                            <div class=\"jeg_weather_day\">
                                <span class=\"jeg_weather_day\">" . date_i18n( 'D', $item['time'] ) . "</span>
                            </div>
                        </div>";


        }

        return $output;
    }
}