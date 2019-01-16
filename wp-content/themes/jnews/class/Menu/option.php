<?php

if(!function_exists('jnews_get_mega_menu_option'))
{
    function jnews_get_mega_menu_option()
    {
        return array(
            esc_html__('Mega Menu Category', 'jnews') => array(
                'type' => array (
                    'type' => 'radioimage',
                    'title' => esc_html__('Mega Menu Type', 'jnews'),
                    'desc' => esc_html__('Choose which mega menu type you want to use in this menu.', 'jnews'),
                    'default' => 'disable',
                    'options' => array (
                        'disable'    => JNEWS_THEME_URL . '/assets/img/admin/megamenu-none.png',
                        'category_1' => JNEWS_THEME_URL . '/assets/img/admin/megamenu-1.png',
                        'category_2' => JNEWS_THEME_URL . '/assets/img/admin/megamenu-2.png',
                    ),
                    'name' => 'type'
                ),
                'category' => array (
                    'type' => 'select',
                    'title' => esc_html__('Choose Category', 'jnews'),
                    'desc' => esc_html__('Choose which category you want to use for this mega menu.', 'jnews'),
                    'default' => '',
                    'options' => jnews_categories_drop(),
                    'name' => 'category',
                    'dependency'  => array(
                        array(
                            'field'    => 'type',
                            'operator' => '!=',
                            'value'    => 'disable'
                        ),
                    ),
                ),
                'number' => array (
                    'type' => 'slider',
                    'title' => esc_html__('Number of Post', 'jnews'),
                    'desc' => esc_html__('Set max number show for mega menu.', 'jnews'),
                    'default' => 9,
                    'options' => array(
                        'min' => 1,
                        'max' => 20,
                        'step' => 1
                    ),
                    'name' => 'number',
                    'dependency'  => array(
                        array(
                            'field'    => 'type',
                            'operator' => '!=',
                            'value'    => 'disable'
                        ),
                    ),
                ),
                'trending_tag' => array (
                    'type' => 'multitag',
                    'title' => esc_html__('Trending Tag', 'jnews'),
                    'desc' => esc_html__('Write to search post tag.','jnews'),
                    'name' => 'trending_tag',
                    'options' => jnews_get_mega_menu_tag(),
                    'default' => '',
                    'dependency'  => array(
                        array(
                            'field'    => 'type',
                            'operator' => '==',
                            'value'    => 'category_2'
                        ),
                    ),
                ),
            ),
            esc_html__('Child Level Mega Menu', 'jnews') => array(
                'child_mega' => array (
                    'type' => 'radioimage',
                    'title' => esc_html__('Mega Menu Child', 'jnews'),
                    'desc' => esc_html__('Set mega menu for this menu child.', 'jnews'),
                    'default' => 'disable',
                    'options' => array (
                        'disable'   => JNEWS_THEME_URL . '/assets/img/admin/megamenu-none.png',
                        'two_row'   => JNEWS_THEME_URL . '/assets/img/admin/menuchild-2col.png',
                        'three_row' => JNEWS_THEME_URL . '/assets/img/admin/menuchild-3col.png',
                        'four_row'  => JNEWS_THEME_URL . '/assets/img/admin/menuchild-4col.png',
                    ),
                    'name' => 'child_mega'
                ),
            )
        );
    }
}
