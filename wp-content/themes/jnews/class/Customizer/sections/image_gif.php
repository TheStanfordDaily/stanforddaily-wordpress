<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_transform_gif',
    'transport'     => 'refresh',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Use JNews GIF image','jnews'),
    'description'   => esc_html__('Enable stop / pause GIF image','jnews'),
);

return $options;