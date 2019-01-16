<?php

$options = array();

$postmeta_refresh = array (
    'selector'        => '.jeg_meta_container',
    'render_callback' => function() {
        $single = \JNews\Single\SinglePost::getInstance();
        $single->render_post_meta();
    },
);

$top_share = array (
    'selector'        => '.jeg_share_top_container',
    'render_callback' => function() {
        do_action('jnews_share_top_bar', get_the_ID());
    },
);

$float_share = array (
    'selector'        => '.jeg_share_float_container',
    'render_callback' => function() {
        do_action('jnews_share_float_bar', get_the_ID());
    },
);

$bottom_share = array(
    'selector'        => '.jeg_share_bottom_container',
    'render_callback' => function() {
        do_action('jnews_share_bottom_bar', get_the_ID());
    },
);

$single_post_tag = array(
    'redirect'  => 'single_post_tag',
    'refresh'   => false
);

$options[] = array(
    'id'            => 'jnews_single_blog_style_header',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Single Blog Post Template','jnews' ),
);

if(class_exists('JNews_Auto_Load_Post_Option'))
{
    $options[] = array(
        'id'            => 'jnews_autoload_single_alert',
        'type'          => 'jnews-alert',
        'default'       => 'warning',
        'label'         => esc_html__('Attention','jnews' ),
        'description'   => wp_kses(__('<ul>
                    <li>Single Post template overrided by Auto Load Post Option, Please use option on Auto Load Post Instead </li>                    
                </ul>','jnews'), wp_kses_allowed_html()),
    );
}

$options[] = array(
    'id'            => 'jnews_single_blog_template',
    'transport'     => 'postMessage',
    'default'       => '1',
    'type'          => 'jnews-radio-image',
    'label'         => esc_html__('Single Blog Post Template','jnews' ),
    'description'   => esc_html__('Choose your single blog post template.','jnews' ),
    'choices'       => array(
        '1' => '',
        '2' => '',
        '3' => '',
        '4' => '',
        '5' => '',
        '6' => '',
        '7' => '',
        '8' => '',
        '9' => '',
        '10' => '',
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    )
);

$options[] = array(
    'id'            => 'jnews_single_blog_layout',
    'transport'     => 'postMessage',
    'default'       => 'right-sidebar',
    'type'          => 'jnews-radio-image',
    'label'         => esc_html__('Single Blog Post Layout','jnews' ),
    'description'   => esc_html__('Choose your single blog post layout.','jnews' ),
    'choices'       => array(
        'right-sidebar'         => '',
        'left-sidebar'          => '',
        'right-sidebar-narrow'  => '',
        'left-sidebar-narrow'   => '',
        'double-sidebar'        => '',
        'double-right-sidebar'  => '',
        'no-sidebar'            => '',
        'no-sidebar-narrow'     => ''
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    )
);


$options[] = array(
    'id'            => 'jnews_single_blog_enable_parallax',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Parallax Effect','jnews'),
    'description'   => esc_html__('Turn this option on if you want your featured image to have parallax effect.','jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_single_blog_template',
            'operator' => 'contains',
            'value'    => array('4', '5'),
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    ),
    'wrapper_class' => array('first_child')
);

$options[] = array(
    'id'            => 'jnews_single_blog_enable_fullscreen',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Fullscreen Featured Image','jnews'),
    'description'   => esc_html__('Turn this option on if you want your post header to have fullscreen image featured.','jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_single_blog_template',
            'operator' => 'contains',
            'value'    => array('4', '5'),
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    ),
    'wrapper_class' => array('first_child')
);


$all_sidebar = apply_filters('jnews_get_sidebar_widget', null);

$options[] = array(
    'id'            => 'jnews_single_sidebar',
    'transport'     => 'postMessage',
    'default'       => 'default-sidebar',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Single Post Sidebar','jnews'),
    'description'   => wp_kses(__("Choose your single post sidebar. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'       => $all_sidebar,
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_single_blog_layout',
            'operator' => 'contains',
            'value'    => array('left-sidebar', 'right-sidebar', 'left-sidebar-narrow', 'right-sidebar-narrow', 'double-sidebar', 'double-right-sidebar'),
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    ),
    'wrapper_class' => array('first_child')
);

$options[] = array(
    'id'            => 'jnews_single_second_sidebar',
    'transport'     => 'postMessage',
    'default'       => 'default-sidebar',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Second Single Post Sidebar','jnews'),
    'description'   => wp_kses(__("Choose your single post sidebar for the second sidebar. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'       => $all_sidebar,
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_single_blog_layout',
            'operator' => 'contains',
            'value'    => array('double-sidebar', 'double-right-sidebar'),
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    ),
    'wrapper_class' => array('first_child')
);

$options[] = array(
    'id'            => 'jnews_single_sticky_sidebar',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Single Post Sticky Sidebar','jnews'),
    'description'   => esc_html__('Enable sticky sidebar on single post page.','jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_single_blog_layout',
            'operator' => 'contains',
            'value'    => array('left-sidebar', 'right-sidebar', 'left-sidebar-narrow', 'right-sidebar-narrow', 'double-sidebar', 'double-right-sidebar')
        )
    ),
    'postvar'       => array(
        array(
            'redirect'  => 'single_post_tag',
            'refresh'   => true
        )
    ),
    'wrapper_class' => array('first_child')
);

$options[] = array(
    'id'            => 'jnews_single_blog_element_header',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Single Post Element','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_single_show_featured',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Featured Image/Video','jnews'),
    'description'   => esc_html__('Show featured image, gallery or video on single post.','jnews'),
    'postvar'       => array( $single_post_tag ),
);

$postmeta_callback = array(
    'setting'  => 'jnews_single_show_post_meta',
    'operator' => '==',
    'value'    => true,
);

$options[] = array(
    'id'            => 'jnews_single_show_post_meta',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Post Meta','jnews'),
    'description'   => esc_html__('Show post meta on post header.','jnews'),
    'partial_refresh' => array (
        'jnews_single_show_post_meta' => $postmeta_refresh
    ),
    'postvar'       => array( $single_post_tag )
);

$options[] = array(
    'id'            => 'jnews_single_show_post_author',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Post Author','jnews'),
    'description'   => esc_html__('Show post author on post meta container.','jnews'),
    'partial_refresh' => array (
        'jnews_single_show_post_author' => $postmeta_refresh
    ),
    'active_callback'  => array( $postmeta_callback ),
    'postvar'       => array( $single_post_tag ),
    'wrapper_class' => array('first_child')
);

$options[] = array(
    'id'            => 'jnews_single_show_post_author_image',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Post Author Image','jnews'),
    'description'   => esc_html__('Show post author image on post meta container.','jnews'),
    'partial_refresh' => array (
        'jnews_single_show_post_author_image_1' => $postmeta_refresh,
    ),
    'active_callback'  => array( $postmeta_callback,
        array(
            'setting'  => 'jnews_single_show_post_author',
            'operator' => '==',
            'value'    => true,
        )),
    'postvar'       => array( $single_post_tag ),
    'wrapper_class' => array('first_child')
);

$options[] = array(
    'id'            => 'jnews_single_show_post_date',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Post Date','jnews'),
    'description'   => esc_html__('Show post date on post meta container.','jnews'),
    'partial_refresh' => array (
        'jnews_single_show_post_date' => $postmeta_refresh
    ),
    'active_callback'  => array( $postmeta_callback ),
    'postvar'       => array( $single_post_tag ),
    'wrapper_class' => array('first_child')
);

$options[] = array(
    'id'            => 'jnews_single_post_date_format',
    'transport'     => 'postMessage',
    'default'       => 'default',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Post Date Format','jnews'),
    'description'   => esc_html__('Choose which date format you want to use for single post meta.','jnews'),
    'choices'       => array(
        'ago'           => esc_attr__( 'Relative Date/Time Format (ago)', 'jnews' ),
        'default'       => esc_attr__( 'WordPress Default Format', 'jnews' ),
        'custom'        => esc_attr__( 'Custom Format', 'jnews' ),
    ),
    'partial_refresh' => array (
        'jnews_single_post_date_format' => $postmeta_refresh
    ),
    'active_callback'  => array(
        $postmeta_callback,
        array(
            'setting'  => 'jnews_single_show_post_date',
            'operator' => '==',
            'value'    => true,
        )
    ),
    'postvar'       => array( $single_post_tag ),
    'wrapper_class' => array('first_child')
);

$options[] = array(
    'id'            => 'jnews_single_post_date_format_custom',
    'transport'     => 'postMessage',
    'default'       => 'Y/m/d',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Custom Date Format','jnews'),
    'description'   => wp_kses(sprintf(__("Please set custom date format for single post meta. For more detail about this format, please refer to
                                <a href='%s' target='_blank'>Developer Codex</a>.", "jnews"), "https://developer.wordpress.org/reference/functions/current_time/"),
        wp_kses_allowed_html()),
    'partial_refresh' => array (
        'jnews_single_post_date_format_custom' => $postmeta_refresh
    ),
    'active_callback'  => array(
        $postmeta_callback,
        array(
            'setting'  => 'jnews_single_show_post_date',
            'operator' => '==',
            'value'    => true,
        ),
        array(
            'setting'  => 'jnews_single_post_date_format',
            'operator' => '==',
            'value'    => 'custom',
        )
    ),
    'postvar'       => array( $single_post_tag ),
    'wrapper_class' => array('first_child')
);

$options[] = array(
    'id'            => 'jnews_single_show_category',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Category','jnews'),
    'description'   => esc_html__('Show post category on post meta container.','jnews'),
    'partial_refresh' => array (
        'jnews_single_show_category' => $postmeta_refresh
    ),
    'active_callback'  => array( $postmeta_callback ),
    'postvar'       => array( $single_post_tag ),
    'wrapper_class' => array('first_child')
);

$options[] = array(
    'id'            => 'jnews_single_comment',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Comment Button','jnews'),
    'description'   => esc_html__('Show comment button on post meta container.','jnews'),
    'partial_refresh' => array (
        'jnews_single_comment' => $postmeta_refresh
    ),
    'active_callback'  => array( $postmeta_callback ),
    'postvar'       => array( $single_post_tag ),
    'wrapper_class' => array('first_child')
);

$options[] = array(
    'id'            => 'jnews_single_share_position',
    'transport'     => 'postMessage',
    'default'       => 'top',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Share Position','jnews'),
    'description'   => esc_html__('Choose your share position.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'top'           => esc_attr__( 'Only Top', 'jnews' ),
        'float'         => esc_attr__( 'Only Float', 'jnews' ),
        'bottom'        => esc_attr__( 'Only Bottom', 'jnews' ),
        'topbottom'     => esc_attr__( 'Top + Bottom', 'jnews' ),
        'floatbottom'   => esc_attr__( 'Float + Bottom', 'jnews' ),
        'hide'          => esc_attr__( 'Hide All', 'jnews' ),
    ),
    'partial_refresh' => array (
        'jnews_single_share_position_top' => $top_share,
        'jnews_single_share_position_float' => $float_share,
        'jnews_single_share_position_bottom' => $bottom_share,
    ),
    'output'        => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.entry-content',
            'property'      => array(
                'top'               => 'no-share',
                'float'             => 'with-share',
                'bottom'            => 'no-share',
                'topbottom'         => 'no-share',
                'floatbottom'       => 'with-share',
                'hide'              => 'no-share',
            ),
        ),
    ),
    'postvar'       => array( $single_post_tag )
);

$options[] = array(
    'id'            => 'jnews_single_share_float_style',
    'transport'     => 'postMessage',
    'default'       => 'share-monocrhome',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Float Share Style','jnews'),
    'description'   => esc_html__('Choose your float share style.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'share-normal'        => esc_attr__( 'Color', 'jnews' ),
        'share-monocrhome'    => esc_attr__( 'Monochrome', 'jnews' ),
    ),
    'output'        => array(
        array(
            'method'        => 'class-masking',
            'element'       => '.jeg_share_button',
            'property'      => array(
                'share-normal'               => 'share-normal',
                'share-monocrhome'           => 'share-monocrhome',
            ),
        ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_single_share_position',
            'operator' => 'in',
            'value'    => array('float', 'floatbottom'),
        ),
    ),
    'postvar'       => array( $single_post_tag ),
    'wrapper_class' => array('first_child')
);

$options[] = array(
    'id'            => 'jnews_single_show_share_counter',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Share Counter','jnews'),
    'description'   => wp_kses(__('Show or hide share counter, share counter may be hidden depending on your setup on <strong>Share Position</strong> option above.','jnews'), wp_kses_allowed_html()),
    'partial_refresh' => array (
        'jnews_single_show_share_counter' => $top_share
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_single_share_position',
            'operator' => 'in',
            'value'    => array('top', 'topbottom'),
        ),
    ),
    'postvar'       => array( $single_post_tag ),
    'wrapper_class' => array('first_child')
);

$options[] = array(
    'id'            => 'jnews_single_show_view_counter',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show View Counter','jnews'),
    'description'   => wp_kses(__('Show or hide view counter, view counter may be hidden depending on your setup on <strong>Share Position</strong> option above.','jnews'), wp_kses_allowed_html()),
    'partial_refresh' => array (
        'jnews_single_show_view_counter' => $top_share
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_single_share_position',
            'operator' => 'in',
            'value'    => array('top', 'topbottom'),
        ),
    ),
    'postvar'       => array( $single_post_tag ),
    'wrapper_class' => array('first_child')
);

$options[] = array(
    'id'            => 'jnews_single_show_tag',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Post Tag','jnews'),
    'description'   => esc_html__('Show single post tag (below article).','jnews'),
    'partial_refresh' => array (
        'jnews_single_show_tag' => array (
            'selector'        => '.jeg_post_tags',
            'render_callback' => function() {
                $single = \JNews\Single\SinglePost::getInstance();
                $single->post_tag_render();
            },
        )
    ),
    'postvar'       => array( $single_post_tag )
);

$options[] = array(
    'id'            => 'jnews_single_show_prev_next_post',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Prev / Next Post','jnews'),
    'description'   => esc_html__('Show previous or next post navigation (below article).','jnews'),
    'partial_refresh' => array (
        'jnews_single_show_prev_next_post' => array (
            'selector'        => '.jnews_prev_next_container',
            'render_callback' => function() {
                $single = \JNews\Single\SinglePost::getInstance();
                $single->prev_next_post();
            },
        )
    ),
    'postvar'       => array( $single_post_tag )
);

$options[] = array(
    'id'            => 'jnews_single_show_popup_post',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Popup Post','jnews'),
    'description'   => esc_html__('Show bottom right popup post widget.','jnews'),
    'partial_refresh' => array (
        'jnews_single_show_popup_post' => array (
            'selector'        => '.jnews_popup_post_container',
            'render_callback' => function() {
                $single = \JNews\Single\SinglePost::getInstance();
                $single->popup_post();
            },
        )
    ),
    'postvar'       => array( $single_post_tag )
);

$options[] = array(
    'id'            => 'jnews_single_number_popup_post',
    'transport'     => 'postMessage',
    'default'       => 1,
    'type'          => 'jnews-slider',
    'label'         => esc_html__('Number of Popup Post','jnews'),
    'description'   => esc_html__('Set the number of post to show when popup post appear.','jnews'),
    'choices'       => array(
        'min'  => '1',
        'max'  => '5',
        'step' => '1',
    ),
    'partial_refresh' => array (
        'jnews_single_number_popup_post' => array (
            'selector'        => '.jnews_popup_post_container',
            'render_callback' => function() {
                $single = \JNews\Single\SinglePost::getInstance();
                $single->popup_post();
            },
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_single_show_popup_post',
            'operator' => '==',
            'value'    => true,
        ),
    ),
    'postvar'       => array( $single_post_tag )
);

$options[] = array(
    'id'            => 'jnews_single_show_author_box',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Author Box','jnews'),
    'description'   => esc_html__('Show author box (below article).','jnews'),
    'partial_refresh' => array (
        'jnews_single_show_author_box' => array (
            'selector'        => '.jnews_author_box_container',
            'render_callback' => function() {
                $single = \JNews\Single\SinglePost::getInstance();
                $single->author_box();
            },
        )
    ),
    'postvar'       => array( $single_post_tag )
);

$options[] = array(
    'id'            => 'jnews_single_blog_post_thumbnail_header',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Single Thumbnail Setting','jnews' ),
);

$options[] = array(
    'id'            => 'jnews_single_post_thumbnail_size',
    'transport'     => 'refresh',
    'default'       => 'crop-500',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Post Thumbnail Size','jnews'),
    'description'   => esc_html__('Choose your post\'s single image thumbnail size. You can also override this behaviour on your single post editor.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'no-crop'           => esc_attr__( 'No Crop', 'jnews' ),
        'crop-500'          => esc_attr__( 'Crop 1/2 Dimension', 'jnews' ),
        'crop-715'          => esc_attr__( 'Crop Default Dimension', 'jnews' ),
    ),
    'postvar'       => array( $single_post_tag )
);

$options[] = array(
    'id'            => 'jnews_single_post_gallery_size',
    'transport'     => 'refresh',
    'default'       => 'crop-500',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Post Gallery Thumbnail Size','jnews'),
    'description'   => esc_html__('Choose your gallery image thumbnail size. You can also override this behaviour on your single post editor.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'crop-500'          => esc_attr__( 'Crop 1/2 Dimension', 'jnews' ),
        'crop-715'          => esc_attr__( 'Crop Default Dimension', 'jnews' ),
    ),
    'postvar'       => array( $single_post_tag )
);

return $options;