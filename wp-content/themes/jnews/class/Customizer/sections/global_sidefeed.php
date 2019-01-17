<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_sidefeed_enable',
    'transport'     => 'refresh',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Enable Sidefeed', 'jnews'),
    'description'   => esc_html__('Turn on this option to enable sidefeed.', 'jnews'),
);

$options[] = array(
    'id'            => 'jnews_sidefeed_enable_ajax',
    'transport'     => 'postMessage',
    'default'       => true,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Enable Ajax Load Sidefeed Post', 'jnews'),
    'description'   => esc_html__('Enable this option, so post on sidefeed will be loaded as ajax on a single post.', 'jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sidefeed_enable',
            'operator' => '==',
            'value'    => true,
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_sidefeed_disable_page',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Disable Sidefeed on Page', 'jnews'),
    'description'   => esc_html__('Enable this option to disable sidefeed on the page.', 'jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sidefeed_enable',
            'operator' => '==',
            'value'    => true,
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_sidefeed_number_post',
    'transport'     => 'postMessage',
    'default'       => 12,
    'type'          => 'jnews-slider',
    'label'         => esc_html__('Number of Post', 'jnews'),
    'description'   => esc_html__('Set the number of news feed per load.', 'jnews'),
    'choices'     => array(
        'min'  => '1',
        'max'  => '30',
        'step' => '1',
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sidefeed_enable',
            'operator' => '==',
            'value'    => true,
        ),
    ),
    'partial_refresh' => array (
        'jnews_sidefeed_number_post' => array (
            'selector'        => '.jeg_sidefeed',
            'render_callback' => function() {
                $feed = new \JNews\Sidefeed\Sidefeed();
                $ajax = $feed->get_side_feed_content();
                echo jnews_sanitize_output($ajax['content']);
            },
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_sidefeed_main_position',
    'transport'     => 'postMessage',
    'default'       => 'center',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Main Content Position', 'jnews'),
    'description'   => esc_html__('Set the position of main content on sidefeed.', 'jnews'),
    'choices'       => array(
        'left'		    => esc_html__('Content Align Left', 'jnews'),
        'center'		=> esc_html__('Content Align Center', 'jnews'),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sidefeed_enable',
            'operator' => '==',
            'value'    => true,
        ),
    ),
    'output'     => array(
        array(
            'method'        => 'class-masking',
            'element'       => 'body',
            'property'      => array(
                'left'          => 'jeg_sidecontent_left',
                'center'        => 'jeg_sidecontent_center',
            ),
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_sidefeed_show_trending',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Trending Button', 'jnews'),
    'description'   => wp_kses(__('Enable this option to show trending button on sidefeed. <br>You will need to enable <strong>JNews View Counter Plugin</strong> to use this feature.','jnews'), wp_kses_allowed_html()),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sidefeed_enable',
            'operator' => '==',
            'value'    => true,
        ),
    ),
    'partial_refresh' => array (
        'jnews_sidefeed_show_trending' => array (
            'selector'        => '.jeg_side_tabs',
            'render_callback' => function() {
                $feed = new \JNews\Sidefeed\Sidefeed();
                echo jnews_sanitize_output($feed->render_side_feed_tab());
            },
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_sidefeed_trending_range',
    'transport'     => 'postMessage',
    'default'       => 'all',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Trending Range', 'jnews'),
    'description'   => esc_html__('Set trending post range.', 'jnews'),
    'choices'       => array(
        'daily'		    => esc_html__('Last 24 hours', 'jnews'),
        'weekly'		=> esc_html__('Last 7 days', 'jnews'),
        'monthly'		=> esc_html__('Last 30 days', 'jnews'),
        'all'		    => esc_html__('All-time', 'jnews')
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sidefeed_enable',
            'operator' => '==',
            'value'    => true,
        ),
        array(
            'setting'  => 'jnews_sidefeed_show_trending',
            'operator' => '==',
            'value'    => true,
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_sidefeed_show_category',
    'transport'     => 'postMessage',
    'default'       => false,
    'type'          => 'jnews-toggle',
    'label'         => esc_html__('Show Category', 'jnews'),
    'description'   => esc_html__('Enable this option to show category selector button on sidefeed.', 'jnews'),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sidefeed_enable',
            'operator' => '==',
            'value'    => true,
        ),
    ),
    'partial_refresh' => array (
        'jnews_sidefeed_show_category' => array (
            'selector'        => '.jeg_side_feed_cat_wrapper',
            'render_callback' => function() {
                $feed = new \JNews\Sidefeed\Sidefeed();
                echo jnews_sanitize_output($feed->render_side_feed_category_button());
            },
        ),
    ),
);


$options[] = array(
    'id'            => 'jnews_sidefeed_category',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Select Category List', 'jnews'),
    'description'   => esc_html__('Select category you want to show on category button.', 'jnews'),
    'multiple'      => 999,
    'choices'       => call_user_func(function(){
        $category = array();
        $categories = get_categories(array(
            'hide_empty' => false,
            'hierarchical' => true
        ));

        $walker = new \JNews\Sidefeed\SidefeedCategoryWalker();
        $walker->walk($categories, 3);

        foreach($walker->cache as $value){
            $category[$value['id']] = $value['title'];
        }

        return $category;
    }),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sidefeed_enable',
            'operator' => '==',
            'value'    => true,
        ),
        array(
            'setting'  => 'jnews_sidefeed_show_category',
            'operator' => '==',
            'value'    => true,
        ),
    ),
    'partial_refresh' => array (
        'jnews_sidefeed_category' => array (
            'selector'        => '.jeg_cat_dropdown',
            'render_callback' => function() {
                $feed = new \JNews\Sidefeed\Sidefeed();
                echo jnews_sanitize_output($feed->render_side_feed_list());
            },
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_sidefeed_overlay_bgcolor',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-color',
    'label'         => esc_html__('Overlay Background Color','jnews'),
    'description'   => esc_html__('If ajax loaded enabled, you can change overlay background color here.','jnews'),
    'choices'     => array(
        'alpha'         => true,
    ),
    'output'     => array(
        array(
            'method'        => 'inject-style',
            'element'       => '.post-ajax-overlay',
            'property'      => 'background',
        )
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sidefeed_enable',
            'operator' => '==',
            'value'    => true,
        ),
    ),
);


$options[] = array(
    'id'            => 'jnews_feed_date_format',
    'transport'     => 'postMessage',
    'default'       => 'default',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Sidefeed Date Format','jnews'),
    'description'   => esc_html__('Choose which date format you want to use for sidefeed.','jnews'),
    'multiple'      => 1,
    'choices'       => array(
        'ago' => esc_attr__( 'Relative Date/Time Format (ago)', 'jnews' ),
        'default' => esc_attr__( 'WordPress Default Format', 'jnews' ),
        'custom' => esc_attr__( 'Custom Format', 'jnews' ),
    ),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_sidefeed_enable',
            'operator' => '==',
            'value'    => true,
        )
    ),
    'partial_refresh' => array (
        'jnews_feed_date_format' => array (
            'selector'        => '.jeg_sidefeed',
            'render_callback' => function() {
                $feed = new \JNews\Sidefeed\Sidefeed();
                $content = $feed->get_side_feed_content();
                echo jnews_sanitize_output($content['content']);
            },
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_feed_date_format_custom',
    'transport'     => 'postMessage',
    'default'       => 'Y/m/d',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Sidefeed Date Format','jnews'),
    'description'   => wp_kses(sprintf(__("Please set custom date format for sidefeed. For more detail about this format, please refer to
                                <a href='%s' target='_blank'>Developer Codex</a>.", "jnews"), "https://developer.wordpress.org/reference/functions/current_time/"),
        wp_kses_allowed_html()),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_feed_date_format',
            'operator' => '==',
            'value'    => 'custom',
        ),
        array(
            'setting'  => 'jnews_sidefeed_enable',
            'operator' => '==',
            'value'    => true,
        )
    ),
    'partial_refresh' => array (
        'jnews_feed_date_format_custom' => array (
            'selector'        => '.jeg_sidefeed',
            'render_callback' => function() {
                $feed = new \JNews\Sidefeed\Sidefeed();
                $content = $feed->get_side_feed_content();
                echo jnews_sanitize_output($content['content']);
            },
        ),
    ),
);

return $options;