<?php

return array(
    'id'          => 'jnews_post_split',
    'types'       => array('post'),
    'title'       => 'JNews : Split Post',
    'priority'    => 'high',
    'template'    => array(

        array(
            'type' => 'toggle',
            'name' => 'enable_post_split',
            'label' => esc_html__('Enable Post Split on this Post', 'jnews-split'),
            'description' => esc_html__('Enable post split on this page. Please don\'t use this feature with WordPress <!--nextpage--> feature', 'jnews-split'),
        ),

        array(
            'type' => 'group',
            'repeating' => false,
            'length'    => 1,
            'name' => 'post_split',
            'title' =>  esc_html__('Post Split Option', 'jnews-split'),
            'description' =>  esc_html__('Post Split Option', 'jnews-split'),
            'active_callback' => array(
                array(
                    'field' => 'enable_post_split',
                    'operator' => '==',
                    'value' => true
                )
            ),
            'fields' => array(
                array(
                    'type' => 'radioimage',
                    'name' => 'template',
                    'label' => esc_html__('Post Split Template', 'jnews-split'),
                    'description' => esc_html__('Choose post split template', 'jnews-split'),
                    'item_max_width' => '118',
                    'item_max_height' => '93',
                    'items' => array(
                        array(
                            'value' => '1',
                            'label' => esc_html__('Split Post Template 1', 'jnews-split'),
                            'img' => JNEWS_SPLIT_URL . '/assets/img/post-split-1.png',
                        ),
                        array(
                            'value' => '2',
                            'label' => esc_html__('Split Post Template 2', 'jnews-split'),
                            'img' => JNEWS_SPLIT_URL . '/assets/img/post-split-2.png',
                        ),
                        array(
                            'value' => '3',
                            'label' => esc_html__('Split Post Template 3', 'jnews-split'),
                            'img' => JNEWS_SPLIT_URL . '/assets/img/post-split-3.png',
                        ),
                        array(
                            'value' => '4',
                            'label' => esc_html__('Split Post Template 4', 'jnews-split'),
                            'img' => JNEWS_SPLIT_URL . '/assets/img/post-split-4.png',
                        ),
                        array(
                            'value' => '5',
                            'label' => esc_html__('Split Post Template 5', 'jnews-split'),
                            'img' => JNEWS_SPLIT_URL . '/assets/img/post-split-5.png',
                        ),
                    ),
                    'default' => array(
                        '1',
                    ),
                ),

                array(
                    'type' => 'select',
                    'name' => 'tag',
                    'label' => esc_html__('Split Post by using this Tag','jnews-split'),
                    'description' => esc_html__('your post will be split with this header as their mark','jnews-split'),
                    'default' => 'h2',
                    'items' => array(
                        array( 'value' => 'h1', 'label' => 'Heading 1 ( H1 Tag )', ),
                        array( 'value' => 'h2', 'label' => 'Heading 2 ( H2 Tag )', ),
                        array( 'value' => 'h3', 'label' => 'Heading 3 ( H3 Tag )', ),
                        array( 'value' => 'h4', 'label' => 'Heading 4 ( H4 Tag )', ),
                        array( 'value' => 'h5', 'label' => 'Heading 5 ( H5 Tag )', ),
                        array( 'value' => 'h6', 'label' => 'Heading 6 ( H6 Tag )', ),
                    ),
                ),

                array(
                    'type' => 'select',
                    'name' => 'numbering',
                    'label' => esc_html__('Split Header Numbering','jnews-split'),
                    'description' => esc_html__('choose how your split page number used','jnews-split'),
                    'default' => 'asc',
                    'items' => array(
                        array( 'value' => 'desc', 'label' => 'Descending (ex : 3, 2, 1)', ),
                        array( 'value' => 'asc', 'label' => 'Ascending (ex : 1, 2, 3)', ),
                    ),
                ),

                array(
                    'type' => 'select',
                    'name' => 'mode',
                    'label' => esc_html__('Load Mode for Post Split', 'jnews-split'),
                    'description' => esc_html__('Choose your how your post split will load', 'jnews-split'),
                    'default' => 'normal',
                    'items' => array(
                        array( 'value' => 'normal', 'label' => 'Normal Load' ),
                        array( 'value' => 'all', 'label' => 'Load All Content' ),
                        array( 'value' => 'ajax', 'label' => 'Load Content with Ajax' ),
                    ),
                ),
            )
        ),


    ),
);