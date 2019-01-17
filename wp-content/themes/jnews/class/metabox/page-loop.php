<?php

return array(
    'id'          => 'jnews_page_loop',
    'types'       => array('page'),
    'title'       => esc_html__('JNews : Page Loop', 'jnews'),
    'priority'    => 'high',
    'template'    => array(

        array(
            'type'      => 'tab',
            'name'      => 'page_loop_enable',
            'title'     => esc_html__('Page Loop', 'jnews'),
            'fields'    => array(
                array(
                    'type' => 'toggle',
                    'name' => 'enable_page_loop',
                    'label' => esc_html__('Enable Page Loop', 'jnews'),
                    'description' => esc_html__('Check this option to enable page loop on this page.', 'jnews'),
                ),
            )
        ),
        

        array(
            'type'      => 'tab',
            'name'      => 'page_loop_header',
            'title'     => esc_html__('Page Loop Header', 'jnews'),
            'fields'    => array(

                array(
                    'type' => 'textbox',
                    'name' => 'first_title',
                    'label' => esc_attr__( 'First Header Title', 'jnews' ),
                    'description' => esc_attr__( 'Main title of header.', 'jnews' ),
                    'default' => 'Latest Post',
                ),

                array(
                    'type' => 'textbox',
                    'name' => 'second_title',
                    'label' => esc_attr__( 'Second  Title', 'jnews' ),
                    'description' => esc_attr__( 'Secondary title of header.', 'jnews' ),
                    'default' => '',
                ),

                array(
                    'type' => 'radioimage',
                    'name' => 'header_type',
                    'label' => esc_html__('Header Style', 'jnews'),
                    'description' => esc_html__('Choose your loop header style.', 'jnews'),
                    'item_max_width' => '118',
                    'item_max_height' => '93',
                    'items' => array(
                        array(
                            'value' => 'heading_1',
                            'label' => esc_html__('Header 1', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/heading-metabox-1.png',
                        ),
                        array(
                            'value' => 'heading_2',
                            'label' => esc_html__('Header 2', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/heading-metabox-2.png',
                        ),
                        array(
                            'value' => 'heading_3',
                            'label' => esc_html__('Header 3', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/heading-metabox-3.png',
                        ),
                        array(
                            'value' => 'heading_4',
                            'label' => esc_html__('Header 4', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/heading-metabox-4.png',
                        ),
                        array(
                            'value' => 'heading_5',
                            'label' => esc_html__('Header 5', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/heading-metabox-5.png',
                        ),
                        array(
                            'value' => 'heading_6',
                            'label' => esc_html__('Header 6', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/heading-metabox-6.png',
                        ),
                        array(
                            'value' => 'heading_7',
                            'label' => esc_html__('Header 7', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/heading-metabox-7.png',
                        ),
                        array(
                            'value' => 'heading_8',
                            'label' => esc_html__('Header 8', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/heading-metabox-8.png',
                        ),
                        array(
                            'value' => 'heading_9',
                            'label' => esc_html__('Header 9', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/heading-metabox-9.png',
                        ),
                    ),
                    'default' => array(
                        'heading_6',
                    ),
                ),

                array(
                    'type' => 'color',
                    'name' => 'header_background',
                    'label' => esc_html__('Header Background', 'jnews'),
                    'description' => esc_html__('This option may not work for all of heading type.', 'jnews'),
                    'default' => '',
                    'format' => 'rgba',
                ),

                array(
                    'type' => 'color',
                    'name' => 'header_text_color',
                    'label' => esc_html__('Header Text Color', 'jnews'),
                    'description' => esc_html__('This option may not work for all of heading type.', 'jnews'),
                    'default' => '',
                    'format' => 'rgba',
                ),

            )
        ),



        array(
            'type'      => 'tab',
            'name'      => 'page_loop_content',
            'title'     => esc_html__('Content Template', 'jnews'),
            'fields'    => array(

                array(
                    'type' => 'radioimage',
                    'name' => 'layout',
                    'label' => esc_html__('Page Loop Layout', 'jnews'),
                    'description' => esc_html__('Choose your page loop layout.', 'jnews'),
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
	                        'label' => esc_html__('Double Right Sidebar', 'jnews'),
	                        'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-double-right.png',
                        ),
                        array(
                            'value' => 'no-sidebar',
                            'label' => esc_html__('No Sidebar', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/single-post-no-sidebar.png',
                        )
                    ),
                    'default' => array(
                        'right-sidebar',
                    ),
                ),

                array(
                    'type' => 'select',
                    'name' => 'sidebar',
                    'label' => esc_html__('Page Loop Sidebar','jnews'),
                    'description'   => wp_kses(__("Choose your page loop sidebar. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
                    'default' => '{{first}}',
                    'active_callback' => array(
                        array(
                            'field'    => 'layout',
                            'operator' => '!=',
                            'value'    => 'no-sidebar'
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
		            'label' => esc_html__('Second Page Loop Sidebar','jnews'),
		            'description'   => wp_kses(__("Choose your second sidebar for the page loop. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
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
                    'label' => esc_html__('Page Loop Sticky Sidebar','jnews'),
                    'description'   => esc_html__('Enable sticky sidebar on page loop.','jnews'),
                    'default' => true,
                    'active_callback' => array(
                        array(
                            'field'    => 'layout',
                            'operator' => '!=',
                            'value'    => 'no-sidebar'
                        )
                    )
                ),

                array(
                    'type' => 'radioimage',
                    'name' => 'module',
                    'label' => esc_html__('Page Loop Module Template', 'jnews'),
                    'description' => esc_html__('You can use module template for your index loop.', 'jnews'),
                    'item_max_width' => '118',
                    'item_max_height' => '93',
                    'items' => array(
                        array(
                            'value' => '3',
                            'label' => esc_html__('Module Bock 3', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-3.png',
                        ),
                        array(
                            'value' => '4',
                            'label' => esc_html__('Module Bock 4', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-4.png',
                        ),
                        array(
                            'value' => '5',
                            'label' => esc_html__('Module Bock 5', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-5.png',
                        ),
                        array(
                            'value' => '6',
                            'label' => esc_html__('Module Bock 6', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-6.png',
                        ),
                        array(
                            'value' => '7',
                            'label' => esc_html__('Module Bock 7', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-7.png',
                        ),
                        array(
                            'value' => '9',
                            'label' => esc_html__('Module Bock 9', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-9.png',
                        ),
                        array(
                            'value' => '10',
                            'label' => esc_html__('Module Bock 10', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-10.png',
                        ),
                        array(
                            'value' => '11',
                            'label' => esc_html__('Module Bock 11', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-11.png',
                        ),
                        array(
                            'value' => '12',
                            'label' => esc_html__('Module Bock 12', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-12.png',
                        ),
                        array(
                            'value' => '14',
                            'label' => esc_html__('Module Bock 14', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-14.png',
                        ),
                        array(
                            'value' => '15',
                            'label' => esc_html__('Module Bock 15', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-15.png',
                        ),
                        array(
                            'value' => '18',
                            'label' => esc_html__('Module Bock 18', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-18.png',
                        ),
                        array(
                            'value' => '22',
                            'label' => esc_html__('Module Bock 22', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-22.png',
                        ),
                        array(
                            'value' => '23',
                            'label' => esc_html__('Module Bock 23', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-23.png',
                        ),
                        array(
                            'value' => '25',
                            'label' => esc_html__('Module Bock 25', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-25.png',
                        ),
                        array(
                            'value' => '26',
                            'label' => esc_html__('Module Bock 26', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-26.png',
                        ),
                        array(
                            'value' => '27',
                            'label' => esc_html__('Module Bock 27', 'jnews'),
                            'img' => JNEWS_THEME_URL . '/assets/img/admin/content-27.png',
                        ),
                    ),
                    'default' => array(
                        '3',
                    ),
                ),

                array(
                    'type' => 'slider',
                    'name' => 'excerpt_length',
                    'label' => esc_html__('Excerpt Length', 'jnews'),
                    'description' => esc_html__('Set word length of excerpt on post.', 'jnews'),
                    'min' => '0',
                    'max' => '200',
                    'step' => '1',
                    'default' => '20',
                ),

                array(
                    'type' => 'select',
                    'name' => 'content_date',
                    'label' => esc_html__('Date Format for Content', 'jnews'),
                    'description' => esc_html__('Choose which date format you want to use for search for content.', 'jnews'),
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
                        ),
                    ),
                    'default' => array(
                        'default',
                    ),
                ),

                array(
                    'type' => 'textbox',
                    'name' => 'date_custom',
                    'label' => esc_attr__( 'Custom Date Format for Content', 'jnews' ),
                    'description'   => wp_kses(sprintf(__("Please set custom date format for post content. For more detail about this format, please refer to
                                <a href='%s' target='_blank'>Developer Codex</a>.", "jnews"), "https://developer.wordpress.org/reference/functions/current_time/"),
                    wp_kses_allowed_html()),
                    'default' => 'Y/m/d',
                    'active_callback' => array(
                        array(
                            'field' => 'content_date',
                            'operator' => '==',
                            'value' => 'custom'
                        )
                    )
                ),

                array(
                    'type' => 'select',
                    'name' => 'content_pagination',
                    'label' => esc_html__('Pagination Mode', 'jnews'),
                    'description' => esc_html__('Choose which pagination mode that fit with your block.', 'jnews'),
                    'items' => array(
                        array(
                            'value' => 'nav_1',
                            'label' => esc_attr__( 'Normal - Navigation 1', 'jnews' )
                        ),
                        array(
                            'value' => 'nav_2',
                            'label' => esc_attr__( 'Normal - Navigation 2', 'jnews' )
                        ),
                        array(
                            'value' => 'nav_3',
                            'label' => esc_attr__( 'Normal - Navigation 3', 'jnews' )
                        ),
                    ),
                    'default' => array(
                        'nav_1',
                    ),
                ),

                array(
                    'type' => 'select',
                    'name' => 'pagination_align',
                    'label' => esc_html__('Pagination Align', 'jnews'),
                    'description' => esc_html__('Choose pagination alignment.', 'jnews'),
                    'items' => array(
                        array(
                            'value' => 'left',
                            'label' => esc_attr__( 'Left', 'jnews' )
                        ),
                        array(
                            'value' => 'center',
                            'label' => esc_attr__( 'Center', 'jnews' )
                        ),
                    ),
                    'default' => array(
                        'center',
                    ),
                ),

                array(
                    'type' => 'toggle',
                    'name' => 'show_navtext',
                    'label' => esc_html__('Show Navigation Text', 'jnews'),
                    'description' => esc_html__('Show navigation text (next, prev).', 'jnews'),
                ),

                array(
                    'type' => 'toggle',
                    'name' => 'show_pageinfo',
                    'label' => esc_html__('Show Page Info', 'jnews'),
                    'description' => esc_html__('Show page info text (Page x of y).', 'jnews'),
                ),
            )
        ),


        array(
            'type'      => 'tab',
            'name'      => 'page_loop_filter',
            'title'     => esc_html__('Content Filter', 'jnews'),
            'fields'    => array(

                array(
                    'type' => 'slider',
                    'name' => 'post_offset',
                    'label' => __('Post Offset', 'jnews'),
                    'description' => __('Number of post offset (start of content).', 'jnews'),
                    'min' => '0',
                    'max' => '100',
                    'step' => '1',
                    'default' => '0',
                ),
	            array(
		            'type' => 'slider',
		            'name' => 'posts_per_page',
		            'label' => __('Posts Per Page', 'jnews'),
		            'description' => __('Number of posts per page.', 'jnews'),
		            'min' => '1',
		            'max' => '100',
		            'step' => '1',
		            'default' => '5',
	            ),
                array(
                    'type' => 'multipost',
                    'name' => 'include_post',
                    'label' => esc_attr__( 'Include Post ID', 'jnews' ),
                    'description' => wp_kses(__("Tips :<br/> - You can search post id by inputing title, clicking search title, and you will have your post id.<br/>- You can also directly insert your post id, and click enter to add it on the list.", 'jnews'), wp_kses_allowed_html()),
                ),
                array(
                    'type' => 'multipost',
                    'name' => 'exclude_post',
                    'label' => esc_attr__( 'Exclude Post ID', 'jnews' ),
                    'description' => wp_kses(__("Tips :<br/> - You can search post id by inputing title, clicking search title, and you will have your post id.<br/>- You can also directly insert your post id, and click enter to add it on the list.", 'jnews'), wp_kses_allowed_html()),
                ),
                array(
                    'type' => 'multitermhierarchy',
                    'name' => 'include_category',
                    'label' => esc_html__('Include Category','jnews'),
                    'description' => esc_html__('Choose which category you want to show on this module.','jnews'),
                    'default' => '',
                    'items' => array(
                        'data' => array(
                            array(
                                'source' => 'function',
                                'value'  => 'jnews_get_categories_selectize',
                            ),
                        ),
                    ),
                ),
                array(
                    'type' => 'multitermhierarchy',
                    'name' => 'exclude_category',
                    'label' => esc_html__('Exclude Category','jnews'),
                    'description' => esc_html__('Choose excluded category for this module.','jnews'),
                    'default' => '',
                    'items' => array(
                        'data' => array(
                            array(
                                'source' => 'function',
                                'value'  => 'jnews_get_categories_selectize',
                            ),
                        ),
                    ),
                ),

                array(
                    'type' => 'multiauthor',
                    'name' => 'include_author',
                    'label' => esc_html__('Author','jnews'),
                    'description' => esc_html__('Write to search post author.','jnews'),
                    'default' => '',
                    'items' => array(
                        'data' => array(
                            array(
                                'source' => 'function',
                                'value'  => 'jnews_get_all_author_loop',
                            ),
                        ),
                    ),
                ),
                array(
                    'type' => 'multitag',
                    'name' => 'include_tag',
                    'label' => esc_html__('Include Tags','jnews'),
                    'description' => esc_html__('Write to search post tag.','jnews'),
                    'default' => '',
                    'items' => array(
                        'data' => array(
                            array(
                                'source' => 'function',                                
                                'value'  => 'jnews_get_all_tag_loop',
                            ),
                        ),
                    ),
                ),
                array(
                    'type' => 'multitag',
                    'name' => 'exclude_tag',
                    'label' => esc_html__('Exclude Tags','jnews'),
                    'description' => esc_html__('Write to search post tag.','jnews'),
                    'default' => '',
                    'items' => array(
                        'data' => array(
                            array(
                                'source' => 'function',
                                'value'  => 'jnews_get_all_tag_loop',
                            ),
                        ),
                    ),
                ),
                array(
                    'type' => 'select',
                    'name' => 'sort_by',
                    'label' => esc_html__('Sort By','jnews'),
                    'description' => esc_html__('Choose sort type for this module.','jnews'),
                    'default' => 'latest',
                    'items' => array(
                        array(
                            'value' => 'latest',
                            'label' => esc_html__('Latest Post', 'jnews')
                        ),
                        array(
                            'value' => 'oldest',
                            'label' => esc_attr__( 'Oldest Post', 'jnews' )
                        ),
                        array(
                            'value' => 'alphabet_asc',
                            'label' => esc_attr__( 'Alphabet Asc', 'jnews' )
                        ),
                        array(
                            'value' => 'alphabet_desc',
                            'label' => esc_attr__( 'Alphabet Desc', 'jnews' )
                        ),
                        array(
                            'value' => 'random',
                            'label' => esc_attr__( 'Random Post', 'jnews' )
                        ),
                        array(
                            'value' => 'random_week',
                            'label' => esc_attr__( 'Random Post (7 Days)', 'jnews' )
                        ),
                        array(
                            'value' => 'random_month',
                            'label' => esc_attr__( 'Random Post (30 Days)', 'jnews' )
                        ),
                        array(
                            'value' => 'most_comment',
                            'label' => esc_attr__( 'Most Comment', 'jnews' )
                        ),
                        array(
                            'value' => 'rate',
                            'label' => esc_attr__( 'Highest Rate - Review', 'jnews' )
                        ),
                        array(
                            'value' => 'like',
                            'label' => esc_attr__( 'Most Like (Thumb up)', 'jnews' )
                        ),
                        array(
                            'value' => 'share',
                            'label' => esc_attr__( 'Most Share', 'jnews' )
                        ),
                    ),
                ),
            )
        ),

    ),
);

