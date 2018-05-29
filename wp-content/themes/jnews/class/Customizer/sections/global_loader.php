<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_module_loader',
    'transport'     => 'postMessage',
    'default'       => 'dot',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Module Loader Style', 'jnews'),
    'description'   => esc_html__('Choose loader style for general module element.','jnews'),
    'choices'       => array(
        'dot'		    => esc_html__('Dot', 'jnews'),
        'circle'		=> esc_html__('Circle', 'jnews'),
        'square'		=> esc_html__('Square', 'jnews'),
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.module-overlay  .preloader_type',
            'property'      => array(
                'dot'           => 'preloader_dot',
                'circle'        => 'preloader_circle',
                'square'        => 'preloader_square',
            ),
        ),
    )
);

$options[] = array(
    'id'            => 'jnews_loader_mega_menu',
    'transport'     => 'postMessage',
    'default'       => 'dot',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Mega Menu Loader Style', 'jnews'),
    'description'   => esc_html__('Choose loader style for mega menu.','jnews'),
    'choices'       => array(
        'dot'		    => esc_html__('Dot', 'jnews'),
        'circle'		=> esc_html__('Circle', 'jnews'),
        'square'		=> esc_html__('Square', 'jnews'),
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.newsfeed_overlay .preloader_type',
            'property'      => array(
                'dot'           => 'preloader_dot',
                'circle'        => 'preloader_circle',
                'square'        => 'preloader_square',
            ),
        ),
    )
);

$options[] = array(
    'id'            => 'jnews_sidefeed_loader',
    'transport'     => 'postMessage',
    'default'       => 'dot',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Sidefeed Loader Style', 'jnews'),
    'description'   => esc_html__('Choose loader style for sidefeed.','jnews'),
    'choices'       => array(
        'dot'		    => esc_html__('Dot', 'jnews'),
        'circle'		=> esc_html__('Circle', 'jnews'),
        'square'		=> esc_html__('Square', 'jnews'),
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.jeg_sidefeed_overlay .preloader_type',
            'property'      => array(
                'dot'           => 'preloader_dot',
                'circle'        => 'preloader_circle',
                'square'        => 'preloader_square',
            ),
        ),
    )
);


$options[] = array(
    'id'            => 'jnews_sidefeed_ajax_loader',
    'transport'     => 'postMessage',
    'default'       => 'dot',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Sidefeed Ajax Overlay Loader Style', 'jnews'),
    'description'   => esc_html__('Choose loader style for sidefeed ajax overlay.','jnews'),
    'choices'       => array(
        'dot'		    => esc_html__('Dot', 'jnews'),
        'circle'		=> esc_html__('Circle', 'jnews'),
        'square'		=> esc_html__('Square', 'jnews'),
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.post-ajax-overlay .preloader_type',
            'property'      => array(
                'dot'           => 'preloader_dot',
                'circle'        => 'preloader_circle',
                'square'        => 'preloader_square',
            ),
        ),
    )
);

return $options;