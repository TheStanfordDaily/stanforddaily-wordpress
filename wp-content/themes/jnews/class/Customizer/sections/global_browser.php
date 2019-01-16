<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_mobile_browser_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Mobile Browser Background Color','jnews'),
    'description'   => esc_html__('Change color of chrome, firefox, vivaldi, windows phone browser, iOS Safari on mobile device.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
);

return $options;