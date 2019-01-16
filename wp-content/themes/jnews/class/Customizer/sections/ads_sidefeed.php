<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_advertisement_info',
    'type'          => 'jnews-alert',
    'default'       => 'info',
    'label'         => esc_html__('Notice','jnews' ),
    'description'   => wp_kses(__(
        '<ul>
            <li>Enable Sidefeed to show this option on  <strong>JNews: Layout, Color & scheme > Sidefeed Setting > Enable Sidefeed</strong></li>                    
        </ul>',
        'jnews'), wp_kses_allowed_html()),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sidefeed_enable',
            'operator' => '==',
            'value'    => false
        )
    ),
);

$side_feed = new \JNews\Customizer\AdsOptionGenerator(array(
    'location' => 'sidefeed',
    'title' => esc_html__('Sidefeed', 'jnews'),
    'default_size' => '300x250',
    'visibility' => array(
        'desktop' => true,
        'tab' => true,
        'phone' => true
    ),
    'additional_callback' => array(
        'setting'  => 'jnews_sidefeed_enable',
        'operator' => '==',
        'value'    => true,
    )
));

return array_merge(
    $options,
    $side_feed->ads_option_generator()
);