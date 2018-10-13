<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_option[weather_forecast_alert]',
    'type'          => 'jnews-alert',
    'default'       => 'info',
    'section'       => 'jnews_global_weather_section',
    'label'         => esc_html__('Weather Forecast Info','jnews-weather' ),
    'description'   => wp_kses(__('You will need to refersh the page to see the result of your changes.</br></br> If you want to purge the current cache, you just need to choose <strong>Disable Cache</strong> on the <strong>Weather Cache Expired</strong> option. Then you can setup the <strong>Weather Cache Expired</strong> option again right after you refresh the page.','jnews-weather' ), wp_kses_allowed_html()),
);

$options[] = array(
    'id'            => 'jnews_option[weather_forecast_source]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 'yahoo',
    'type'          => 'jnews-select',
    'section'       => 'jnews_global_weather_section',
    'label'         => esc_html__('Weather Forecast Source','jnews-weather'),
    'description'   => esc_html__('Choose weather forecast source.','jnews-weather'),
    'choices'       => array(
        'yahoo'          => esc_html__('Yahoo Weather', 'jnews-weather'),
        'darksky'        => esc_html__('Dark Sky', 'jnews-weather'),
        'openweathermap' => esc_html__('Open Weather Map', 'jnews-weather'),
        'aerisweather'   => esc_html__('Aeris Weather', 'jnews-weather'),
    ),
);

$options[] = array(
    'id'              => 'jnews_option[weather_darksky_api_key]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'type'            => 'jnews-text',
    'default'         => '',
    'section'         => 'jnews_global_weather_section',
    'label'           => esc_html__('Dark Sky Secret Key','jnews-weather'),
    'description'     => wp_kses(sprintf(__("Insert your Dark Sky Secret Key. Find your Dark Sky Secret Key <a href='%s' target='_blank'>here</a>.", "jnews-weather"), "https://darksky.net/dev/account"), wp_kses_allowed_html()),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[weather_forecast_source]',
            'operator' => '==',
            'value'    => 'darksky',
        )
    ),
);

$options[] = array(
    'id'              => 'jnews_option[weather_openweathermap_api_key]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'type'            => 'jnews-text',
    'default'         => '',
    'section'         => 'jnews_global_weather_section',
    'label'           => esc_html__('Open Weather Map API Key','jnews-weather'),
    'description'     => wp_kses(sprintf(__("Insert your Open Weather Map API Key. Find your Open Weather Map API Key <a href='%s' target='_blank'>here</a>.", "jnews-weather"), "https://home.openweathermap.org/api_keys"), wp_kses_allowed_html()),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[weather_forecast_source]',
            'operator' => '==',
            'value'    => 'openweathermap',
        )
    ),
);

$options[] = array(
    'id'              => 'jnews_option[weather_aerisweather_id]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'type'            => 'jnews-text',
    'default'         => '',
    'section'         => 'jnews_global_weather_section',
    'label'           => esc_html__('Aeris Weather Client ID','jnews-weather'),
    'description'     => wp_kses(sprintf(__("Insert your Aeris Weather Client ID. Find your Aeris Weather Client ID <a href='%s' target='_blank'>here</a>.", "jnews-weather"), "http://www.aerisweather.com/account/apps"), wp_kses_allowed_html()),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[weather_forecast_source]',
            'operator' => '==',
            'value'    => 'aerisweather',
        )
    ),
);

$options[] = array(
    'id'              => 'jnews_option[weather_aerisweather_secret]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'type'            => 'jnews-text',
    'default'         => '',
    'section'         => 'jnews_global_weather_section',
    'label'           => esc_html__('Aeris Weather Client Secret','jnews-weather'),
    'description'     => wp_kses(sprintf(__("Insert your Aeris Weather Client Secret. Find your Aeris Weather Client Secret <a href='%s' target='_blank'>here</a>.", "jnews-weather"), "http://www.aerisweather.com/account/apps"), wp_kses_allowed_html()),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[weather_forecast_source]',
            'operator' => '==',
            'value'    => 'aerisweather',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_option[weather_default_temperature]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 'c',
    'type'          => 'jnews-select',
    'section'       => 'jnews_global_weather_section',
    'label'         => esc_html__('Default Temperature Unit','jnews-weather'),
    'description'   => esc_html__('Choose default temperature unit.','jnews-weather'),
    'choices'       => array(
        'c'  => esc_html__('Celsius', 'jnews-weather'),
        'f'  => esc_html__('Fahrenheit', 'jnews-weather'),
    ),
);

$options[] = array(
    'id'            => 'jnews_option[weather_cache_expired]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '1',
    'type'          => 'jnews-select',
    'section'       => 'jnews_global_weather_section',
    'label'         => esc_html__('Weather Cache Expired','jnews-weather'),
    'description'   => esc_html__('Choose the expired time of weather forecast data cache.','jnews-weather'),
    'choices'       => array(
        '1'  => esc_html__('1 Hour', 'jnews-weather'),
        '2'  => esc_html__('2 Hour', 'jnews-weather'),
        '3'  => esc_html__('3 Hour', 'jnews-weather'),
        'no' => esc_html__('Disable Cache', 'jnews-weather'),
    ),
);

return $options;