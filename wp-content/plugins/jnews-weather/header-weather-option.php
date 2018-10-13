<?php

$options = array();

$topbar_refresh = array(
    'selector'        => '.jnews_header_topbar_weather',
    'render_callback' => function()
    {
        do_action('jnews_header_topbar_weather');
    },
);

$options[] = array(
    'id'            => 'jnews_option[top_bar_weather_forecast_alert]',
    'type'          => 'jnews-alert',
    'default'       => 'info',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Top Bar Weather Forecast','jnews-weather' ),
    'description'   => wp_kses(sprintf(__('Please make sure you\'ve been setup <strong>General Weather Forescast Setting</strong>. You can check it right <a href=\'%s\' target=\'_blank\'>here</a>.','jnews-weather' ), get_admin_url() . "customize.php?autofocus[section]=jnews_global_weather_section"), wp_kses_allowed_html()),
);

$options[] = array(
    'id'            => 'jnews_option[top_bar_weather_location]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Weather Location','jnews-weather'),
    'description'   => wp_kses(sprintf(__("You can insert <strong>\"city name\"</strong> or <strong>\"city name, country code\"</strong>. For more detail information, you can read our documentation <a href='%s' target='_blank'>here</a>", "jnews-weather"), "#"), wp_kses_allowed_html()),
    'partial_refresh' => array(
        'jnews_option[top_bar_weather_location]' => $topbar_refresh
    ),
);

$options[] = array(
    'id'            => 'jnews_option[top_bar_weather_location_auto]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-toggle',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Weather Auto Detect Location','jnews-weather'),
    'description'   => wp_kses(sprintf(__("Enable this option will automatically detect weather location of your site visitor. For more detail information, you can read our documentation <a href='%s' target='_blank'>here</a>", "jnews-weather"), "#"), wp_kses_allowed_html()),
    'partial_refresh' => array(
        'jnews_option[top_bar_weather_location]' => $topbar_refresh
    ),
);

$options[] = array(
    'id'            => 'jnews_option[top_bar_weather_item]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 'hide',
    'type'          => 'jnews-select',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Top Bar Weather Item','jnews-weather'),
    'description'   => esc_html__('Show weather forecast for next days.','jnews-weather'),
    'choices'       => array(
        'hide'   => esc_html__('Hide', 'jnews-weather'),
        'normal' => esc_html__('Normal', 'jnews-weather'),
        'slide'  => esc_html__('Slide', 'jnews-weather'),
    ),
    'partial_refresh' => array(
        'jnews_option[top_bar_weather_item]' => $topbar_refresh
    ),
);

$options[] = array(
    'id'            => 'jnews_option[top_bar_weather_item_count]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '4',
    'type'          => 'jnews-slider',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Weather Item Count','jnews-weather'),
    'description'   => esc_html__('The number of weather item to show.','jnews-weather'),
    'choices'       => array(
        'min'  => '3',
        'max'  => '6',
        'step' => '1',
    ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[top_bar_weather_item]',
            'operator' => '==',
            'value'    => 'normal',
        ),
    ),
    'partial_refresh' => array(
        'jnews_option[top_bar_weather_item_count]' => $topbar_refresh
    ),
);

$options[] = array(
    'id'            => 'jnews_option[top_bar_weather_item_content]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 'temp',
    'type'          => 'jnews-select',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Weather Item Content','jnews-weather'),
    'description'   => esc_html__('The content of weather item to show.','jnews-weather'),
    'choices'       => array(
        'temp'  => 'Only Temperature',
        'icon'  => 'Only Weather Icon',
        'both'  => 'Show Both',
    ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[top_bar_weather_item]',
            'operator' => '!=',
            'value'    => 'hide',
        ),
    ),
    'partial_refresh' => array(
        'jnews_option[top_bar_weather_item_content]' => $topbar_refresh
    ),
);

$options[] = array(
    'id'            => 'jnews_option[top_bar_weather_item_autoplay]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-toggle',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Autoplay Slide Weather Item','jnews-weather'),
    'description'   => esc_html__('Enable this option to make weather item auto slide.','jnews-weather'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[top_bar_weather_item]',
            'operator' => '==',
            'value'    => 'slide',
        ),
    ),
    'partial_refresh' => array(
        'jnews_option[top_bar_weather_item_autoplay]' => $topbar_refresh
    ),
);

$options[] = array(
    'id'            => 'jnews_option[top_bar_weather_item_autodelay]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '2',
    'type'          => 'jnews-slider',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Autoplay Slide Speed','jnews-weather'),
    'description'   => esc_html__('Setup the speed of autoplay slide weather item (second).','jnews-weather'),
    'choices'       => array(
        'min'  => '1',
        'max'  => '5',
        'step' => '1',
    ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[top_bar_weather_item]',
            'operator' => '==',
            'value'    => 'slide',
        ),
        array(
            'setting'  => 'jnews_option[top_bar_weather_item_autoplay]',
            'operator' => '==',
            'value'    => true,
        ),
    ),
    'partial_refresh' => array(
        'jnews_option[top_bar_weather_item_autodelay]' => $topbar_refresh
    ),
);

$options[] = array(
    'id'            => 'jnews_option[top_bar_weather_item_autohover]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Stop Autoplay Slide','jnews-weather'),
    'description'   => esc_html__('Enable this option to stop autoplay slide when mouse hover on weather item.','jnews-weather'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[top_bar_weather_item]',
            'operator' => '==',
            'value'    => 'slide',
        ),
        array(
            'setting'  => 'jnews_option[top_bar_weather_item_autoplay]',
            'operator' => '==',
            'value'    => true,
        ),
    ),
    'partial_refresh' => array(
        'jnews_option[top_bar_weather_item_autohover]' => $topbar_refresh
    ),
);

$options[] = array(
    'id'            => 'jnews_header_weather_style',
    'type'          => 'jnews-header',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Weather Style','jnews-weather' ),
);

$options[] = array(
    'id'            => 'jnews_header_weather_bg',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Background Color','jnews-weather'),
    'description'   => esc_html__('weather background color','jnews-weather'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_top_weather',
            'property'      => 'background',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_weather_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Text Color','jnews-weather'),
    'description'   => esc_html__('weather text color','jnews-weather'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_top_weather > .jeg_weather_temp,
                                        .jeg_midbar .jeg_top_weather > .jeg_weather_temp > .jeg_weather_unit,
                                        .jeg_top_weather > .jeg_weather_location',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_weather_icon_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Icon Color','jnews-weather'),
    'description'   => esc_html__('weather icon color','jnews-weather'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_top_weather .jeg_weather_condition .jeg_weather_icon',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_weather_drop_bg',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Drop Background Color','jnews-weather'),
    'description'   => esc_html__('weather drop background color','jnews-weather'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_top_weather .jeg_weather_item',
            'property'      => 'background',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_weather_drop_bg_hover',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Drop Hover Background Color','jnews-weather'),
    'description'   => esc_html__('weather drop hover background color','jnews-weather'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_top_weather .jeg_weather_item .jeg_weather_temp:hover, 
                                        .jeg_weather_widget .jeg_weather_item:hover',
            'property'      => 'background',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_weather_drop_icon',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Drop Weather Icon Color','jnews-weather'),
    'description'   => esc_html__('drop weather icon color','jnews-weather'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_top_weather .jeg_weather_item .jeg_weather_temp .jeg_weather_icon',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_weather_drop_degree',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Drop Degree Color','jnews-weather'),
    'description'   => esc_html__('weather drop degree color','jnews-weather'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_top_weather .jeg_weather_item .jeg_weather_temp .jeg_weather_value,
                                        .jeg_top_weather .jeg_weather_item .jeg_weather_temp .jeg_weather_unit',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_weather_drop_days',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Drop Days Color','jnews-weather'),
    'description'   => esc_html__('weather drop days color','jnews-weather'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_top_weather .jeg_weather_item .jeg_weather_temp .jeg_weather_day',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_weather_drop_border',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'section'       => 'jnews_header_weather_section',
    'label'         => esc_html__('Drop Border Color','jnews-weather'),
    'description'   => esc_html__('drop border color','jnews-weather'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_top_weather .jeg_weather_item .jeg_weather_temp .jeg_weather_icon',
            'property'      => 'border-color',
        )
    ),
);

return $options;