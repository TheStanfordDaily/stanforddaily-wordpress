<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_image_load_alert',
    'type'          => 'jnews-alert',
    'default'       => 'info',
    'label'         => esc_html__('How Image Loaded','jnews' ),
    'description'   => wp_kses(__(
        '<ul>
                    <li><strong>Normal Load Image :</strong> Support retina, largest size at first load, good for SEO.</li>
                    <li><strong>Lazy Load :</strong> Less number of image on first load, support for retina, best browsing experience, good for SEO.</li>
                    <li><strong>Background :</strong> Support GIF image as featured thumbnail, bad for SEO.</li>
                </ul>',
        'jnews'), wp_kses_allowed_html()),
);

$options[] = array(
    'id'            => 'jnews_image_load',
    'transport'     => 'refresh',
    'default'       => 'lazyload',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Image Load Mechanism', 'jnews'),
    'description'   => esc_html__('Choose image load mechanism method.', 'jnews'),
    'choices'       => array(
        'normal'        => 'Normal image load',
        'lazyload'		=> 'Lazy load image',
        'background'    => 'Background Image',
    ),
);


$options[] = array(
    'id'            => 'jnews_image_generator_alert',
    'type'          => 'jnews-alert',
    'default'       => 'info',
    'label'         => esc_html__('How Image Generated','jnews' ),
    'description'   => wp_kses(__(
        '<ul>
                    <li><strong>Normal Image Generator :</strong> Fastest load time, but require more space. About 12 images will be generated for single image uploaded. If you switch to this option, please regenerate image again.</li>
                    <li><strong>Dynamic Image Generator :</strong> Slower load time only when image created for the first time. Image generated only when needed.</li>                    
                </ul>',
        'jnews'), wp_kses_allowed_html()),
);

$options[] = array(
    'id'            => 'jnews_image_generator',
    'transport'     => 'refresh',
    'default'       => 'normal',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Image Generator', 'jnews'),
    'description'   => esc_html__('Choose image generated method.', 'jnews'),
    'choices'       => array(
        'normal'        => 'Normal Image Generator',
        'dynamic'		=> 'Dynamic Image Generator',
    ),
);

return $options;