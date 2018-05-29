<?php

return array(
    'id'          => 'jnews_primary_category',
    'types'       => array('post'),
    'title'       => esc_html__('JNews : Primary Category', 'jnews'),
    'priority'    => 'high',
    'context'     => 'side',
    'template'    => array(

        array(
            'type' => 'select',
            'name' => 'id',
            'label' => esc_html__('Primary Category', 'jnews'),
            'description' => wp_kses(__('Primary category will show as your <strong>breadcrumb</strong> category on single Blog Post. <br/> Other <strong>page that require single category</strong> to show, this category will be used', 'jnews'), wp_kses_allowed_html()),
            'items' => array(
                'data' => array(
                    array(
                        'source' => 'function',
                        'value'  => 'jnews_get_categories',
                    ),
                ),
            ),
        ),

    ),
);

