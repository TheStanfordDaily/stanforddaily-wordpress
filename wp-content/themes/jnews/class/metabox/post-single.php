<?php

return array(
    'id'          => 'jnews_single_post',
    'types'       => array('post', 'sp_event', 'sp_team', 'sp_player', 'sp_staff'),
    'title'       => esc_html__('JNews : Single Post Setting', 'jnews'),
    'priority'    => 'high',
    'template'    => array(

        array(
            'type'      => 'tab',
            'name'      => 'override_default_template_tab',
            'title'     => esc_html__('Override Default Template', 'jnews'),
            'fields'    => array(

                array(
                    'type' => 'toggle',
                    'name' => 'override_template',
                    'label' => esc_html__('Override Global Template Setting', 'jnews'),
                    'description' => esc_html__('Check this option and you will have option to override global template setting for only this post.', 'jnews'),
                ),

                array(
                    'type' => 'group',
                    'repeating' => false,
                    'sortable' => false,
                    'length'    => 1,
                    'name' => 'override',
                    'title' =>  esc_html__('Template Override Option', 'jnews'),
                    'description' =>  esc_html__('Option for overriding jnews single post template.', 'jnews'),
                    'active_callback' => array(
                        array(
                            'field'    => 'override_template',
                            'operator' => '==',
                            'value'    => true
                        )
                    ),
                    'fields' => array(

                        array(
                            'type' => 'radioimage',
                            'name' => 'template',
                            'label' => esc_html__('Post Header Template', 'jnews'),
                            'description' => esc_html__('This template may not work for every post format, for more information please refer to documentation.', 'jnews'),
                            'item_max_width' => '118',
                            'item_max_height' => '93',
                            'items' => array(
                                array(
                                    'value' => '1',
                                    'label' => esc_html__('Post Template 1', 'jnews'),
                                    'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-1.png',
                                ),
                                array(
                                    'value' => '2',
                                    'label' => esc_html__('Post Template 2', 'jnews'),
                                    'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-2.png',
                                ),
                                array(
                                    'value' => '3',
                                    'label' => esc_html__('Post Template 3', 'jnews'),
                                    'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-3.png',
                                ),
                                array(
                                    'value' => '4',
                                    'label' => esc_html__('Post Template 4', 'jnews'),
                                    'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-4.png',
                                ),
                                array(
                                    'value' => '5',
                                    'label' => esc_html__('Post Template 5', 'jnews'),
                                    'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-5.png',
                                ),
                                array(
                                    'value' => '6',
                                    'label' => esc_html__('Post Template 6', 'jnews'),
                                    'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-6.png',
                                ),
                                array(
                                    'value' => '7',
                                    'label' => esc_html__('Post Template 7', 'jnews'),
                                    'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-7.png',
                                ),
                                array(
                                    'value' => '8',
                                    'label' => esc_html__('Post Template 8', 'jnews'),
                                    'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-8.png',
                                ),
                                array(
                                    'value' => '9',
                                    'label' => esc_html__('Post Template 9', 'jnews'),
                                    'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-9.png',
                                ),
                                array(
                                    'value' => '10',
                                    'label' => esc_html__('Post Template 10', 'jnews'),
                                    'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-10.png',
                                ),
                            ),
                            'default' => array(
                                '1',
                            ),
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'parallax',
                            'label' => esc_html__('Enable Parallax Effect', 'jnews'),
                            'description' => esc_html__('Turn on this option if you want your featured image have parallax effect.', 'jnews'),
                            'default' => true,
                            'active_callback' => array(
                                array(
                                    'field'    => 'template',
                                    'operator' => 'in',
                                    'value'    => array('4', '5')
                                )
                            )
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'fullscreen',
                            'label' => esc_html__('Enable Fullscreen Featured Image', 'jnews'),
                            'description' => esc_html__('Turn on this option if you want your post header have fullscreen image featured.', 'jnews'),
                            'default' => false,
                            'active_callback' => array(
                                array(
                                    'field'    => 'template',
                                    'operator' => 'in',
                                    'value'    => array('4', '5')
                                )
                            )
                        ),

                        array(
                            'type' => 'radioimage',
                            'name' => 'layout',
                            'label' => esc_html__('Single Blog Post Layout', 'jnews'),
                            'description' => esc_html__('Choose your single blog post layout.', 'jnews'),
                            'item_max_width' => '118',
                            'item_max_height' => '93',
                            'items' => array(
                                array(
                                    'value' => 'right-sidebar',
                                    'label' => esc_html__('Right Sidebar', 'jnews'),
                                    'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-right-sidebar.png',
                                ),
                                array(
                                    'value' => 'left-sidebar',
                                    'label' => esc_html__('Left Sidebar', 'jnews'),
                                    'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-left-sidebar.png',
                                ),
	                            array(
		                            'value' => 'right-sidebar-narrow',
		                            'label' => esc_html__('Right Sidebar - Narrow', 'jnews'),
		                            'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-wide-right-sidebar.png',
	                            ),
	                            array(
		                            'value' => 'left-sidebar-narrow',
		                            'label' => esc_html__('Left Sidebar - Narrow', 'jnews'),
		                            'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-wide-left-sidebar.png',
	                            ),
	                            array(
		                            'value' => 'double-sidebar',
		                            'label' => esc_html__('Double Sidebar', 'jnews'),
		                            'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-double-sidebar.png',
	                            ),
	                            array(
		                            'value' => 'double-right-sidebar',
		                            'label' => esc_html__('Double Right Sidebar ', 'jnews'),
		                            'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-double-right.png',
	                            ),
                                array(
                                    'value' => 'no-sidebar',
                                    'label' => esc_html__('No Sidebar', 'jnews'),
                                    'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-no-sidebar.png',
                                ),
                                array(
                                    'value' => 'no-sidebar-narrow',
                                    'label' => esc_html__('No Sidebar - Narrow', 'jnews'),
                                    'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-no-sidebar-narrow.png',
                                ),
                            ),
                            'default' => array(
                                'right-sidebar',
                            ),
                        ),

                        array(
                            'type' => 'select',
                            'name' => 'sidebar',
                            'label' => esc_html__('Single Post Sidebar','jnews'),
                            'description'   => wp_kses(__("Choose your single post sidebar. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
                            'default' => '{{first}}',
                            'active_callback' => array(
                                array(
                                    'field'    => 'layout',
                                    'operator' => 'in',
                                    'value'    => array('left-sidebar', 'right-sidebar', 'left-sidebar-narrow', 'right-sidebar-narrow', 'double-sidebar', 'double-right-sidebar')
                                )
                            ),
                            'items' => array(
                                'data' => array(
                                    array(
                                        'source' => 'function',
                                        'value'  => 'jnews_get_sidebar',
                                    ),
                                ),
                            ),
                        ),

	                    array(
		                    'type' => 'select',
		                    'name' => 'second_sidebar',
		                    'label' => esc_html__('Second Single Post Sidebar','jnews'),
		                    'description'   => wp_kses(__("Choose your single post sidebar for the second sidebar. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
		                    'default' => '{{first}}',
		                    'active_callback' => array(
			                    array(
				                    'field'    => 'layout',
				                    'operator' => 'in',
				                    'value'    => array('double-sidebar', 'double-right-sidebar')
			                    )
		                    ),
		                    'items' => array(
			                    'data' => array(
				                    array(
					                    'source' => 'function',
					                    'value'  => 'jnews_get_sidebar',
				                    ),
			                    ),
		                    ),
	                    ),

                        array(
                            'type' => 'toggle',
                            'name' => 'sticky_sidebar',
                            'label'         => esc_html__('Single Post Sticky Sidebar','jnews'),
                            'description'   => esc_html__('Enable sticky sidebar on single post page.','jnews'),
                            'default' => true,
                            'active_callback' => array(
                                array(
                                    'field'    => 'layout',
                                    'operator' => 'in',
                                    'value'    => array('left-sidebar', 'right-sidebar', 'left-sidebar-narrow', 'right-sidebar-narrow', 'double-sidebar', 'double-right-sidebar')
                                )
                            )
                        ),

                        array(
                            'type' => 'select',
                            'name' => 'share_position',
                            'label' => esc_html__('Single Post Share Position','jnews'),
                            'description' => esc_html__('Choose your share position.','jnews'),
                            'items' => array(
                                array(
                                    'value' => 'top',
                                    'label' => esc_attr__( 'Only Top', 'jnews' )
                                ),
                                array(
                                    'value' => 'float',
                                    'label' => esc_attr__( 'Only Float', 'jnews' )
                                ),
                                array(
                                    'value' => 'bottom',
                                    'label' => esc_attr__( 'Only Bottom', 'jnews' )
                                ),
                                array(
                                    'value' => 'topbottom',
                                    'label' => esc_attr__( 'Top + Bottom', 'jnews' )
                                ),
                                array(
                                    'value' => 'floatbottom',
                                    'label' => esc_attr__( 'Float + Bottom', 'jnews' )
                                ),
                                array(
                                    'value' => 'hide',
                                    'label' => esc_attr__( 'Hide All', 'jnews' )
                                ),
                            ),
                            'default' => array(
                                'top',
                            ),
                        ),

                        array(
                            'type' => 'select',
                            'name' => 'share_float_style',
                            'label' => esc_html__('Float Share Style','jnews'),
                            'description' => esc_html__('Choose your float share style.','jnews'),
                            'items' => array(
                                array(
                                    'value' => 'share-normal',
                                    'label' => esc_attr__( 'Color', 'jnews' )
                                ),
                                array(
                                    'value' => 'share-monocrhome',
                                    'label' => esc_attr__( 'Monochrome', 'jnews' )
                                ),
                            ),
                            'default' => array(
                                'share-monocrhome',
                            ),
                            'active_callback' => array(
                                array(
                                    'field'    => 'share_position',
                                    'operator' => 'in',
                                    'value'    => array('float', 'floatbottom')
                                )
                            )
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'show_share_counter',
                            'label' => esc_html__('Show Share Counter', 'jnews'),
                            'description'   => wp_kses(__("Show or hide share counter, share counter may be hidden depend on your setup on <strong>Single Post Share Position</strong>.", 'jnews'), wp_kses_allowed_html()),
                            'default' => true,
                            'active_callback' => array(
                                array(
                                    'field'    => 'share_position',
                                    'operator' => 'in',
                                    'value'    => array('top', 'topbottom')
                                )
                            )
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'show_view_counter',
                            'label' => esc_html__('Show View Counter', 'jnews'),
                            'description'   => wp_kses(__("Show or hide view counter, share counter may be hidden depend on your setup on <strong>Single Post Share Position</strong>.", 'jnews'), wp_kses_allowed_html()),
                            'default' => true,
                            'active_callback' => array(
                                array(
                                    'field'    => 'share_position',
                                    'operator' => 'in',
                                    'value'    => array('top', 'topbottom')
                                )
                            )
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'show_featured',
                            'label'         => esc_html__('Show Featured Image/Video','jnews'),
                            'description'   => esc_html__('Show featured image, gallery or video on single post.','jnews'),
                            'default' => true,
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'show_post_meta',
                            'label' => esc_html__('Show Post Meta', 'jnews'),
                            'description' => esc_html__('Show post meta on post header.', 'jnews'),
                            'default' => true,
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_post_author',
                            'label' => esc_html__('Show Post Author','jnews'),
                            'description'   => esc_html__('Show post author on post meta container.','jnews'),
                            'default' => true,
                            'active_callback' => array(
                                array(
                                    'field'    => 'show_post_meta',
                                    'operator' => '==',
                                    'value'    => true
                                )
                            )
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_post_author_image',
                            'label' => esc_html__('Show Post Author Image','jnews'),
                            'description' => esc_html__('Show post author image on post meta container.','jnews'),
                            'default' => true,
                            'active_callback' => array(
                                array(
                                    'field'    => 'show_post_meta',
                                    'operator' => '==',
                                    'value'    => true
                                )
                            )
                        ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_post_date',
                            'label'         => esc_html__('Show Post Date','jnews'),
                            'description'   => esc_html__('Show post date on post meta container.','jnews'),
                            'default' => true,
                            'active_callback' => array(
                                array(
                                    'field'    => 'show_post_meta',
                                    'operator' => '==',
                                    'value'    => true
                                )
                            )
                        ),
	                    array(
		                    'type'  => 'select',
		                    'name'  => 'post_date_format',
		                    'label' => esc_html__('Post Date Format','jnews'),
		                    'description'   => esc_html__('Choose which date format you want to use for single post meta.','jnews'),
		                    'default'   => 'default',
		                    'items' => array(
			                    array(
				                    'value' => 'ago',
				                    'label' => esc_attr__( 'Relative Date/Time Format (ago)', 'jnews' )
			                    ),
			                    array(
				                    'value' => 'default',
				                    'label' => esc_attr__( 'WordPress Default Format', 'jnews' )
			                    ),
			                    array(
				                    'value' => 'custom',
				                    'label' => esc_attr__( 'Custom Format', 'jnews' )
			                    )
		                    ),
		                    'active_callback'   => array(
			                    array(
				                    'field'    => 'show_post_meta',
				                    'operator' => '==',
				                    'value'    => true
			                    ),
			                    array(
				                    'field'    => 'show_post_date',
				                    'operator' => '==',
				                    'value'    => true
			                    )
		                    )
	                    ),
	                    array(
		                    'type'  => 'textbox',
		                    'name'  => 'post_date_format_custom',
		                    'label' => esc_html__('Custom Date Format','jnews'),
		                    'description'   => wp_kses(sprintf(__("Please set custom date format for single post meta. For more detail about this format, please refer to
                                <a href='%s' target='_blank'>Developer Codex</a>.", "jnews"), "https://developer.wordpress.org/reference/functions/current_time/"),
			                    wp_kses_allowed_html()),
		                    'default'   => 'Y/m/d',
		                    'active_callback'   => array(
			                    array(
				                    'field'    => 'show_post_meta',
				                    'operator' => '==',
				                    'value'    => true
			                    ),
			                    array(
				                    'field'    => 'show_post_date',
				                    'operator' => '==',
				                    'value'    => true
			                    ),
			                    array(
				                    'field'    => 'post_date_format',
				                    'operator' => 'in',
				                    'value'    => array('custom')
			                    )
		                    )
	                    ),
                        array(
                            'type' => 'toggle',
                            'name' => 'show_post_category',
                            'label'         => esc_html__('Show Category','jnews'),
                            'description'   => esc_html__('Show post category on post meta container.','jnews'),
                            'default' => true,
                            'active_callback' => array(
                                array(
                                    'field'    => 'show_post_meta',
                                    'operator' => '==',
                                    'value'    => true
                                )
                            )
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'show_post_tag',
                            'label' => esc_html__('Show Post Tag', 'jnews'),
                            'description' => esc_html__('Show single post tag (below article).', 'jnews'),
                            'default' => true,
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'show_prev_next_post',
                            'label' => esc_html__('Show Prev / Next Post', 'jnews'),
                            'description' => esc_html__('Show previous or next post navigation (below article).', 'jnews'),
                            'default' => true,
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'show_popup_post',
                            'label' => esc_html__('Show Popup Post', 'jnews'),
                            'description' => esc_html__('Show bottom right popup post widget.', 'jnews'),
                            'default' => true,
                        ),

                        array(
                            'type' => 'slider',
                            'name' => 'number_popup_post',
                            'label' => esc_html__('Number of Post', 'jnews'),
                            'description' => esc_html__('Set the number of post to show when popup post appear.', 'jnews'),
                            'min' => '1',
                            'max' => '5',
                            'step' => '1',
                            'default' => '1',
                            'active_callback' => array(
                                array(
                                    'field'    => 'show_popup_post',
                                    'operator' => '==',
                                    'value'    => true
                                )
                            )
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'show_author_box',
                            'label' => esc_html__('Show Author Box', 'jnews'),
                            'description' => esc_html__('Show author box (below article).', 'jnews'),
                            'default' => false,
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'show_post_related',
                            'label' => esc_html__('Show Post Related', 'jnews'),
                            'description' => esc_html__('Show post related (below article).', 'jnews'),
                            'default' => true,
                        ),

                        array(
                            'type' => 'toggle',
                            'name' => 'show_inline_post_related',
                            'label' => esc_html__('Show Inline Post Related', 'jnews'),
                            'description' => esc_html__('Show inline post related (inside article).', 'jnews'),
                            'default' => false,
                        ),
                        
                    )
                ),
            ),
        ),

        array(
            'type'      => 'tab',
            'name'      => 'override_image_size_tab',
            'title'     => esc_html__('Override Image Size', 'jnews'),
            'fields'    => array(

                array(
                    'type' => 'toggle',
                    'name' => 'override_image_size',
                    'label' => esc_html__('Override Image Thumbnail Size', 'jnews'),
                    'description' => esc_html__('Check this option and you will have option to override your image thumbnail size. If you are using post template with full size image, this option will be ignored.', 'jnews'),
                ),

                array(
                    'type' => 'group',
                    'repeating' => false,
                    'sortable' => false,
                    'length'    => 1,
                    'name' => 'image_override',
                    'title' =>  esc_html__('Image Size Override Option', 'jnews'),
                    'description' =>  esc_html__('Option for overriding jnews single image size.', 'jnews'),
                    'active_callback' => array(
                        array(
                            'field'    => 'override_image_size',
                            'operator' => '==',
                            'value'    => true
                        )
                    ),
                    'fields' => array(

                        array(
                            'type' => 'select',
                            'name' => 'single_post_thumbnail_size',
                            'label' => esc_html__('Post Thumbnail Size','jnews'),
                            'description' => esc_html__('Choose image thumbnail size.','jnews'),
                            'default' => 'crop-500',
                            'items' => array(
                                array(
                                    'value' => 'no-crop',
                                    'label' => esc_html__('No Crop', 'jnews'),
                                ),
                                array(
                                    'value' => 'crop-500',
                                    'label' => esc_html__('Crop 1/2 Dimension', 'jnews'),
                                ),
                                array(
                                    'value' => 'crop-715',
                                    'label' => esc_html__('Crop Default Dimension', 'jnews'),
                                ),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'name' => 'single_post_gallery_size',
                            'label' => esc_html__('Post Gallery Thumbnail Size','jnews'),
                            'description' => esc_html__('Choose image gallery thumbnail size.','jnews'),
                            'default' => 'crop-500',
                            'items' => array(
                                array(
                                    'value' => 'crop-500',
                                    'label' => esc_html__('Crop 1/2 Dimension', 'jnews'),
                                ),
                                array(
                                    'value' => 'crop-715',
                                    'label' => esc_html__('Crop Default Dimension', 'jnews'),
                                ),
                            ),
                        ),

                    )
                ),

            )
        ),
        
    ),
);