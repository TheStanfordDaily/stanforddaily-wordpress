<?php

$options = array();

for($i = 1; $i <= 3; $i++)
{
    $partial_refresh = array (
        'selector'        => '.jeg_button_' . $i,
        'render_callback' => function() use ($i) {
            jnews_create_button($i);
        },
    );

    $options[] = array(
        'id'            => 'jnews_header_button_' . $i,
        'type'          => 'jnews-header',
        'label'         => esc_html__('Button','jnews' ) . ' ' . $i,
    );


    $options[] = array(
        'id'            => 'jnews_header_button_' . $i . '_text',
        'transport'     => 'postMessage',
        'default'       => 'Your text',
        'type'          => 'jnews-text',
        'label'         => esc_html__('Button Text', 'jnews'),
        'partial_refresh' => array (
            'jnews_header_button_' . $i . '_text' => $partial_refresh
        ),
    );

    $options[] = array(
        'id'            => 'jnews_header_button_' . $i . '_icon',
        'transport'     => 'postMessage',
        'default'       => 'fa fa-envelope',
        'type'          => 'jnews-text',
        'label'         => esc_html__('Font Icon Class', 'jnews'),
        'partial_refresh' => array (
            'jnews_header_button_' . $i . '_icon' => $partial_refresh
        ),
    );

    $options[] = array(
        'id'            => 'jnews_header_button_' . $i . '_link',
        'transport'     => 'postMessage',
        'default'       => '#',
        'type'          => 'jnews-text',
        'label'         => esc_html__('Button Link', 'jnews'),
        'partial_refresh' => array (
            'jnews_header_button_' . $i . '_link' => $partial_refresh
        ),
    );

    $options[] = array(
        'id'            => 'jnews_header_button_' . $i . '_target',
        'transport'     => 'postMessage',
        'default'       => '_blank',
        'type'          => 'jnews-select',
        'label'         => esc_html__('Link Target', 'jnews'),
        'choices'       => array(
            '_blank'        => esc_attr__( 'Blank', 'jnews' ),
            '_self'         => esc_attr__( 'Self', 'jnews' ),
            '_parent'       => esc_attr__( 'Parent', 'jnews' ),
        ),
        'partial_refresh' => array (
            'jnews_header_button_' . $i . '_target' => $partial_refresh
        ),
    );

    $options[] = array(
        'id'            => 'jnews_header_button_' . $i . '_form',
        'transport'     => 'postMessage',
        'default'       => 'default',
        'type'          => 'jnews-radio-buttonset',
        'label'         => esc_html__('Button Style','jnews'),
        'description'   => esc_html__('Choose button style.','jnews'),
        'choices'     => array(
            'default'   => esc_attr__( 'Default', 'jnews' ),
            'round' => esc_attr__( 'Round', 'jnews' ),
            'outline'  => esc_attr__( 'Outline', 'jnews' ),
        ),
        'partial_refresh' => array (
            'jnews_header_button_' . $i . '_form' => $partial_refresh
        ),
    );

    $options[] = array(
        'id'            => 'jnews_header_button_' . $i . '_background_color',
        'transport'     => 'postMessage',
        'default'       => '',
        'type'          => 'jnews-color',
        'label'         => esc_html__('Background Color','jnews'),
        'description'   => esc_html__('Background color.','jnews'),
        'output'     => array(
            array(
                'method'        => 'inject-style',
                'element'       => '.jeg_button_' . $i . ' .btn',
                'property'      => 'background',
            )
        ),
    );

    $options[] = array(
        'id'            => 'jnews_header_button_' . $i . '_background_hover_color',
        'transport'     => 'postMessage',
        'default'       => '',
        'type'          => 'jnews-color',
        'label'         => esc_html__('Background Hover Color','jnews'),
        'description'   => esc_html__('Background hover color.','jnews'),
        'output'     => array(
            array(
                'method'        => 'inject-style',
                'element'       => '.jeg_button_' . $i . ' .btn:hover',
                'property'      => 'background',
            )
        ),
    );

    $options[] = array(
        'id'            => 'jnews_header_button_' . $i . '_text_color',
        'transport'     => 'postMessage',
        'default'       => '',
        'type'          => 'jnews-color',
        'label'         => esc_html__('Text Color','jnews'),
        'description'   => esc_html__('Text color.','jnews'),
        'output'     => array(
            array(
                'method'        => 'inject-style',
                'element'       => '.jeg_button_' . $i . ' .btn',
                'property'      => 'color',
            )
        ),
    );

    $options[] = array(
        'id'            => 'jnews_header_button_' . $i . '_border_color',
        'transport'     => 'postMessage',
        'default'       => '',
        'type'          => 'jnews-color',
        'label'         => esc_html__('Border Color','jnews'),
        'description'   => esc_html__('Button border color.','jnews'),
        'output'     => array(
            array(
                'method'        => 'inject-style',
                'element'       => '.jeg_button_' . $i . ' .btn',
                'property'      => 'border-color',
            )
        ),
    );
}

return $options;