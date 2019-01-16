<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_footer_style',
    'transport'     => 'postMessage',
    'default'       => '1',
    'type'          => 'jnews-radio-image',
    'label'         => esc_html__('Footer Layout','jnews' ),
    'description'   => esc_html__('Select style of your footer.','jnews' ),
    'choices'       => array(
        '1' => '',
        '2' => '',
        '3' => '',
        '4' => '',
        '5' => '',
        '6' => '',
        '7' => '',
        'custom' => '',
    ),
    'partial_refresh' => array (
        'jnews_footer_style' => array (
            'selector'              => '.footer-holder',
            'render_callback'       => function() {
                get_template_part('fragment/footer/footer-' . get_theme_mod('jnews_footer_style', '1'));
            },
        ),
    ),
);

$options[] = array(
    'id'            => 'jnews_footer_custom_layout',
    'transport'     => 'refresh',
    'default'       => '',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Custom Footer','jnews'),
    'description'   => wp_kses(sprintf(__('Create custom footer from <a href="%s" target="_blank">here</a>','jnews'), get_admin_url() . 'edit.php?post_type=footer'), wp_kses_allowed_html()),
    'multiple'      => 1,
    'choices'       => call_user_func(function(){
        $post = get_posts(array(
            'posts_per_page'   => -1,
            'post_type'        => 'footer',
        ));

        $footer = array();
        $footer[] = esc_html__('Choose Custom Footer', 'jnews');

        if($post) {
            foreach($post as $value) {
                $footer[$value->ID] = $value->post_title;
            }
        }

        return $footer;
    }),
    'active_callback'  => array(
        array(
            'setting'  => 'jnews_footer_style',
            'operator' => '==',
            'value'    => 'custom',
        )
    )
);

return $options;