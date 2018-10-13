<?php

return array(
    'id'          => 'jnews_social_meta',
    'types'       => array('post', 'page'),
    'title'       => 'JNews : Social Meta',
    'priority'    => 'high',
    'template'    => array(

        array(
            'type'      => 'tab',
            'name'      => 'facebook_social_meta',
            'title'     => esc_html__('Facebook Social Meta', 'jnews-meta-header'),
            'fields'    => array(
                array(
                    'type' => 'textbox',
                    'name' => 'fb_title',
                    'label' => esc_attr__( 'FB Share Title', 'jnews-meta-header' ),
                    'description' => esc_attr__( 'Leave this option empty to use this post / page title', 'jnews-meta-header' ),
                ),
                array(
                    'type' => 'textarea',
                    'name' => 'fb_description',
                    'label' => esc_attr__( 'FB Share Description', 'jnews-meta-header' ),
                    'description' => esc_attr__( 'Leave this option empty to use this post / page excerpt', 'jnews-meta-header' ),
                ),
                array(
                    'type' => 'imageupload',
                    'name' => 'fb_image',
                    'label' => esc_attr__( 'FB Share Image', 'jnews-meta-header' ),
                    'description' => esc_attr__( 'Leave this option empty to use default featured image', 'jnews-meta-header' ),
                ),
            ),
        ),


        array(
            'type'      => 'tab',
            'name'      => 'twitter_social_meta',
            'title'     => esc_html__('Twitter Social Meta', 'jnews-meta-header'),
            'fields'    => array(
                array(
                    'type' => 'textbox',
                    'name' => 'twitter_title',
                    'label' => esc_attr__( 'Twitter Share Title', 'jnews-meta-header' ),
                    'description' => esc_attr__( 'Leave this option empty to use post / page title', 'jnews-meta-header' ),
                ),
                array(
                    'type' => 'textarea',
                    'name' => 'twitter_description',
                    'label' => esc_attr__( 'Twitter Share Description', 'jnews-meta-header' ),
                    'description' => esc_attr__( 'Leave this option empty to use post / page excerpt', 'jnews-meta-header' ),
                ),
                array(
                    'type' => 'imageupload',
                    'name' => 'twitter_image',
                    'label' => esc_attr__( 'Twitter Share Image', 'jnews-meta-header' ),
                    'description' => esc_attr__( 'Leave this option empty to use default featured image', 'jnews-meta-header' ),
                ),
            ),
        ),

    ),
);