<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_header_language_text_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Text Color','jnews'),
    'description'   => esc_html__('Language text color.','jnews'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_lang_switcher',
            'property'      => 'color',
        )
    ),
);

$options[] = array(
    'id'            => 'jnews_header_language_background_color',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Background Color','jnews'),
    'description'   => esc_html__('Language background color.','jnews'),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.jeg_lang_switcher',
            'property'      => 'background',
        )
    ),
);

return $options;