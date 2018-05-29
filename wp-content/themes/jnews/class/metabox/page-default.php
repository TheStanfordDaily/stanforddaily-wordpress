<?php

return array(
    'id'          => 'jnews_single_page',
    'types'       => array('page'),
    'title'       => esc_html__('JNews : Single Page Default', 'jnews'),
    'priority'    => 'high',
    'template'    => array(

        array(
            'type' => 'radioimage',
            'name' => 'layout',
            'label' => esc_html__('Single Page Layout', 'jnews'),
            'description' => esc_html__('Choose your single page layout.', 'jnews'),
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
                ),
            ),
            'default' => array(
                'no-sidebar',
            ),
        ),

        array(
            'type' => 'select',
            'name' => 'sidebar',
            'label' => esc_html__('Single Page Sidebar','jnews'),
            'description'   => wp_kses(__("Choose your page sidebar. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
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
		    'label' => esc_html__('Second Single Page Sidebar','jnews'),
		    'description'   => wp_kses(__("Choose your second sidebar for this page. If you need another sidebar, you can create from <strong>WordPress Admin</strong> &raquo; <strong>Appearance</strong> &raquo; <strong>Widget</strong>.", 'jnews'), wp_kses_allowed_html()),
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
            'label' => esc_html__('Single Page Sticky Sidebar','jnews'),
            'description' => esc_html__('Enable sticky sidebar on single page.','jnews'),
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
            'type' => 'toggle',
            'name' => 'show_post_featured',
            'label' => esc_html__('Show Featured Image', 'jnews'),
            'description' => esc_html__('Show featured image for this page.', 'jnews'),
	        'default' => true
        ),

	    array(
		    'type' => 'toggle',
		    'name' => 'show_post_meta',
		    'label' => esc_html__('Show Page Meta', 'jnews'),
		    'description' => esc_html__('Show page meta on page header.', 'jnews'),
	    ),

        array(
            'type' => 'select',
            'name' => 'share_position',
            'label' => esc_html__('Share Position', 'jnews'),
            'description' => esc_html__('Choose your share position.', 'jnews'),
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
            'name' => 'share_color',
            'label' => esc_html__('Float Share Style', 'jnews'),
            'description' => esc_html__('Choose your float share style.', 'jnews'),
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
                    'field' => 'share_position',
                    'operator' => 'in',
                    'value' => array('float', 'floatbottom')
                )
            )
        ),


    ),
);