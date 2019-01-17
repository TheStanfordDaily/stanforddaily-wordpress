<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

use JNews\HeaderBuilder;

/**
 * Class Theme JNews Customizer
 */
Class HeaderOption extends CustomizerOptionAbstract
{
    // Section Builder
    private $section_header_block_builder = 'jnews_header_builder_block_section';

    /**
     * Set Section
     */
    public function set_option()
    {
        $this->set_panel();

        $this->set_header_builder_block_field();
        $this->set_section();
    }

    public function refresh_desktop()
    {
        return array (
            'selector'        => '.jeg_header_wrapper',
            'render_callback' => function() {
                get_template_part('fragment/header/desktop-builder');
            },
        );
    }

    public function refresh_mobile()
    {
        return array (
            'selector'        => '.jeg_navbar_mobile_wrapper',
            'render_callback' => function() {
                get_template_part('fragment/header/mobile-builder');
            },
        );
    }

    public function set_panel()
    {
        /** panel */
        $this->customizer->add_panel(array(
            'id'            => 'jnews_header',
            'title'         => esc_html__( 'JNews : Header Option' ,'jnews' ),
            'description'   => esc_html__('JNews Header Option','jnews' ),
            'priority'      => $this->id
        ));
    }

    public function set_section()
    {
        $this->add_lazy_section('jnews_header_builder_section', esc_html__('Header - Builder & Layout','jnews'), 'jnews_header', array(
            'jnews_header_logo_section',
            'jnews_header_social_icon_section',
            'jnews_header_desktop_option_section',
        ));
        $this->add_lazy_section('jnews_header_desktop_option_section', esc_html__('Header - Desktop Option','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_desktop_sticky_section', esc_html__('Header - Desktop Sticky Option','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_mobile_option_section', esc_html__('Header - Mobile Option','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_drawer_container_section', esc_html__('Header - Mobile Drawer Option','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_logo_section', esc_html__('Header - Logo','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_top_bar_menu_section', esc_html__('Header - Top Bar Menu','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_main_menu_section', esc_html__('Header - Main Menu','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_social_icon_section', esc_html__('Header - Social Icon','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_date_section', esc_html__('Header - Date','jnews'), 'jnews_header');
        $this->add_lazy_section('jnews_header_search_icon_section', esc_html__('Header - Search Icon','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_search_form_section', esc_html__('Header - Search Form','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_login_section', esc_html__('Header - Account','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_nav_icon_section', esc_html__('Header - Navigation Icon','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_cart_icon_section', esc_html__('Header - Cart Icon','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_cart_detail_section', esc_html__('Header - Cart Detail','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_language_section', esc_html__('Header - Language Switcher','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_html_section', esc_html__('Header - HTML Element','jnews' ), 'jnews_header');
        $this->add_lazy_section('jnews_header_button_section', esc_html__('Header - Button Element','jnews'), 'jnews_header');
        $this->add_lazy_section('jnews_header_vertical_menu_section', esc_html__('Header - Vertical Menu','jnews' ), 'jnews_header');
    }

    public function set_header_builder_block_field()
    {
        // Section
        $this->customizer->add_section(array(
            'id'            => $this->section_header_block_builder,
            'title'         => esc_html__('Header - Block Builder','jnews' ),
            'panel'         => 'jnews_header',
            'priority'      => 250,
        ));

        // Field
        $rows_desktop    = array('top', 'mid', 'bottom');
        $columns_desktop = array('left', 'center', 'right');

        $this->customizer->add_field(array(
            'id'            => "jnews_hb_arrange_bar",
            'transport'     => 'postMessage',
            'default'       => array('top', 'mid', 'bottom'),
            'type'          => 'jnews-select',
            'section'       => $this->section_header_block_builder,
            'label'         => 'Arrangement',
            'multiple'      => 3,
            'choices'       => array(
                'top'           => esc_attr__( 'Top', 'jnews' ),
                'mid'           => esc_attr__( 'Mid', 'jnews' ),
                'bottom'        => esc_attr__( 'Bottom', 'jnews' ),
            ),
            'partial_refresh' => array (
                'jnews_hb_arrange_bar' => $this->refresh_desktop()
            ),
        ));


        // Column align
        $this->customizer->add_field(array(
            'id'            => 'jnews_hb_align_setting',
            'type'          => 'jnews-header',
            'section'       => $this->section_header_block_builder,
            'label'         => esc_html__('Desktop Column Alignment','jnews' ),
        ));

        foreach ($rows_desktop as $row)
        {
            foreach($columns_desktop as $column)
            {
                $this->customizer->add_field(array(
                    'id'            => "jnews_hb_align_desktop_{$row}_{$column}",
                    'transport'     => 'postMessage',
                    'default'       => $column,
                    'type'          => 'jnews-select',
                    'section'       => $this->section_header_block_builder,
                    'label'         => ucfirst($row) . ' ' . ucfirst($column) . ' ' . esc_html__('Align', 'jnews'),
                    'multiple'      => 1,
                    'choices'       => array(
                        'left'          => esc_attr__( 'Left', 'jnews' ),
                        'center'        => esc_attr__( 'Center', 'jnews' ),
                        'right'         => esc_attr__( 'Right', 'jnews' ),
                    ),
                    'output'     => array(
                        array(
                            'method'        => 'class-masking',
                            'element'       => ".jeg_{$row}bar .jeg_nav_{$column} .item_wrap",
                            'property'      => array(
                                'left'          => 'jeg_nav_alignleft',
                                'center'        => 'jeg_nav_aligncenter',
                                'right'         => 'jeg_nav_alignright',
                            ),
                        ),
                    )
                ));
            }
        }

        // Display Setting
        $this->customizer->add_field(array(
            'id'            => 'jnews_hb_display_setting',
            'type'          => 'jnews-header',
            'section'       => $this->section_header_block_builder,
            'label'         => esc_html__('Desktop Column Alignment','jnews' ),
        ));

        foreach ($rows_desktop as $row)
        {
            foreach($columns_desktop as $column)
            {
                $this->customizer->add_field(array(
                    'id'            => "jnews_hb_display_desktop_{$row}_{$column}",
                    'transport'     => 'postMessage',
                    'default'       => jnews_header_default("desktop_display_{$row}_{$column}"),
                    'type'          => 'jnews-select',
                    'section'       => $this->section_header_block_builder,
                    'label'         => ucfirst($row) . ' ' . ucfirst($column) . ' ' . esc_html__('Display Type', 'jnews'),
                    'multiple'      => 1,
                    'choices'       => array(
                        'grow'          => esc_attr__( 'Grow', 'jnews' ),
                        'normal'        => esc_attr__( 'Normal', 'jnews' ),
                    ),
                    'output'     => array(
                        array(
                            'method'        => 'class-masking',
                            'element'       => ".jeg_{$row}bar .jeg_nav_{$column}",
                            'property'      => array(
                                'grow'          => 'jeg_nav_grow',
                                'normal'        => 'jeg_nav_normal'
                            ),
                        ),
                    )
                ));
            }
        }

        // Element
        $this->customizer->add_field(array(
            'id'            => 'jnews_hb_element_setting',
            'type'          => 'jnews-header',
            'section'       => $this->section_header_block_builder,
            'label'         => esc_html__('Desktop Element','jnews' ),
        ));

        foreach ($rows_desktop as $row)
        {
            foreach($columns_desktop as $column)
            {
                $this->customizer->add_field(array(
                    'id'            => "jnews_hb_element_desktop_{$row}_{$column}",
                    'transport'     => 'postMessage',
                    'default'       => jnews_header_default("desktop_element_{$row}_{$column}"),
                    'type'          => 'jnews-select',
                    'section'       => $this->section_header_block_builder,
                    'label'         => ucfirst($row) . ' ' . ucfirst($column) . ' ' . esc_html__(' Element', 'jnews'),
                    'multiple'      => 100,
                    'choices'       => HeaderBuilder::desktop_header_element(),
                    'partial_refresh' => array (
                        "jnews_hb_element_desktop_{$row}_{$column}" => $this->refresh_desktop()
                    ),
                ));
            }
        }


        /********************************************************************************
         * Mobile Option
         ********************************************************************************/

        $mobile_blocks = array(
            'top'   => array('center'),
            'mid'   => array('left', 'center', 'right'),
        );

        // Align
        $this->customizer->add_field(array(
            'id'            => 'jnews_hb_align_mobile_setting',
            'type'          => 'jnews-header',
            'section'       => $this->section_header_block_builder,
            'label'         => esc_html__('Mobile Align','jnews' ),
        ));

        foreach ($mobile_blocks as $row => $columns)
        {
            foreach ($columns as $column)
            {
                $this->customizer->add_field(array(
                    'id'            => "jnews_hb_align_mobile_{$row}_{$column}",
                    'transport'     => 'postMessage',
                    'default'       => $column,
                    'type'          => 'jnews-select',
                    'section'       => $this->section_header_block_builder,
                    'label'         => ucfirst($row) . ' ' . ucfirst($column) . ' ' . esc_html__('Align', 'jnews'),
                    'multiple'      => 1,
                    'choices'       => array(
                        'left'          => esc_attr__( 'Left', 'jnews' ),
                        'center'        => esc_attr__( 'Center', 'jnews' ),
                        'right'         => esc_attr__( 'Right', 'jnews' ),
                    ),
                    'output'     => array(
                        array(
                            'method'        => 'class-masking',
                            'element'       => ".jeg_mobile_{$row}bar .jeg_nav_{$column} .item_wrap",
                            'property'      => array(
                                'left'          => 'jeg_nav_alignleft',
                                'center'        => 'jeg_nav_aligncenter',
                                'right'         => 'jeg_nav_alignright',
                            ),
                        ),
                    )
                ));
            }
        }

        // Display
        $this->customizer->add_field(array(
            'id'            => 'jnews_hb_display_mobile_setting',
            'type'          => 'jnews-header',
            'section'       => $this->section_header_block_builder,
            'label'         => esc_html__('Mobile Display','jnews' ),
        ));

        foreach ($mobile_blocks as $row => $columns)
        {
            foreach ($columns as $column)
            {
                $this->customizer->add_field(array(
                    'id'            => "jnews_hb_display_mobile_{$row}_{$column}",
                    'transport'     => 'postMessage',
                    'default'       => jnews_header_default("mobile_display_{$row}_{$column}"),
                    'type'          => 'jnews-select',
                    'section'       => $this->section_header_block_builder,
                    'label'         => ucfirst($row) . ' ' . ucfirst($column) . ' ' . esc_html__('Display Type', 'jnews'),
                    'multiple'      => 1,
                    'choices'       => array(
                        'grow'          => esc_attr__( 'Grow', 'jnews' ),
                        'normal'        => esc_attr__( 'Normal', 'jnews' ),
                    ),
                    'output'     => array(
                        array(
                            'method'        => 'class-masking',
                            'element'       => ".jeg_mobile_{$row}bar .jeg_nav_{$column}",
                            'property'      => array(
                                'grow'          => 'jeg_nav_grow',
                                'normal'        => 'jeg_nav_normal'
                            ),
                        ),
                    )
                ));
            }
        }

        // Element
        $this->customizer->add_field(array(
            'id'            => 'jnews_hb_element_mobile_setting',
            'type'          => 'jnews-header',
            'section'       => $this->section_header_block_builder,
            'label'         => esc_html__('Mobile Element','jnews' ),
        ));

        foreach ($mobile_blocks as $row => $columns)
        {
            foreach ($columns as $column)
            {
                $this->customizer->add_field(array(
                    'id'            => "jnews_hb_element_mobile_{$row}_{$column}",
                    'transport'     => 'postMessage',
                    'default'       => jnews_header_default("mobile_element_{$row}_{$column}"),
                    'type'          => 'jnews-select',
                    'section'       => $this->section_header_block_builder,
                    'label'         => ucfirst($row) . ' ' . ucfirst($column) . ' ' . esc_html__(' Element', 'jnews'),
                    'multiple'      => 100,
                    'choices'       => HeaderBuilder::mobile_header_element(),
                    'partial_refresh' => array (
                        "jnews_hb_element_mobile_{$row}_{$column}" => $this->refresh_mobile()
                    ),
                ));
            }
        }

        /********************************************************************************
         * Desktop Sticky Option
         ********************************************************************************/

        $desktop_sticky_blocks = array(
            'mid'   => array('left', 'center', 'right'),
        );

        // Align
        $this->customizer->add_field(array(
            'id'            => 'jnews_hb_align_desktop_sticky_setting',
            'type'          => 'jnews-header',
            'section'       => $this->section_header_block_builder,
            'label'         => esc_html__('Desktop Sticky Align','jnews' ),
        ));

        foreach ($desktop_sticky_blocks as $row => $columns)
        {
            foreach ($columns as $column)
            {
                $this->customizer->add_field(array(
                    'id'            => "jnews_hb_align_desktop_sticky_{$row}_{$column}",
                    'transport'     => 'postMessage',
                    'default'       => $column,
                    'type'          => 'jnews-select',
                    'section'       => $this->section_header_block_builder,
                    'label'         => ucfirst($row) . ' ' . ucfirst($column) . ' ' . esc_html__('Align', 'jnews'),
                    'multiple'      => 1,
                    'choices'       => array(
                        'left'          => esc_attr__( 'Left', 'jnews' ),
                        'center'        => esc_attr__( 'Center', 'jnews' ),
                        'right'         => esc_attr__( 'Right', 'jnews' ),
                    ),

                    'output'     => array(
                        array(
                            'method'        => 'class-masking',
                            'element'       => ".jeg_stickybar .jeg_nav_{$column} .item_wrap",
                            'property'      => array(
                                'left'          => 'jeg_nav_alignleft',
                                'center'        => 'jeg_nav_aligncenter',
                                'right'         => 'jeg_nav_alignright',
                            ),
                        ),
                    )
                ));
            }
        }

        // Display
        $this->customizer->add_field(array(
            'id'            => 'jnews_hb_display_desktop_sticky_setting',
            'type'          => 'jnews-header',
            'section'       => $this->section_header_block_builder,
            'label'         => esc_html__('Desktop Sticky Display','jnews' ),
        ));

        foreach ($desktop_sticky_blocks as $row => $columns)
        {
            foreach ($columns as $column)
            {
                $this->customizer->add_field(array(
                    'id'            => "jnews_hb_display_desktop_sticky_{$row}_{$column}",
                    'transport'     => 'postMessage',
                    'default'       => jnews_header_default("sticky_display_{$row}_{$column}"),
                    'type'          => 'jnews-select',
                    'section'       => $this->section_header_block_builder,
                    'label'         => ucfirst($row) . ' ' . ucfirst($column) . ' ' . esc_html__('Display Type', 'jnews'),
                    'multiple'      => 1,
                    'choices'       => array(
                        'grow'          => esc_attr__( 'Grow', 'jnews' ),
                        'normal'        => esc_attr__( 'Normal', 'jnews' ),
                    ),
                    'output'     => array(
                        array(
                            'method'        => 'class-masking',
                            'element'       => ".jeg_stickybar .jeg_nav_{$column}",
                            'property'      => array(
                                'grow'          => 'jeg_nav_grow',
                                'normal'        => 'jeg_nav_normal'
                            ),
                        ),
                    )
                ));
            }
        }

        // Element
        $this->customizer->add_field(array(
            'id'            => 'jnews_hb_element_desktop_sticky_setting',
            'type'          => 'jnews-header',
            'section'       => $this->section_header_block_builder,
            'label'         => esc_html__('Sticky Display Element','jnews' ),
        ));

        foreach ($desktop_sticky_blocks as $row => $columns)
        {
            foreach ($columns as $column)
            {
                $this->customizer->add_field(array(
                    'id'            => "jnews_hb_element_desktop_sticky_{$row}_{$column}",
                    'transport'     => 'postMessage',
                    'default'       => jnews_header_default("sticky_element_{$row}_{$column}"),
                    'type'          => 'jnews-select',
                    'section'       => $this->section_header_block_builder,
                    'label'         => ucfirst($row) . ' ' . ucfirst($column) . ' ' . esc_html__(' Element', 'jnews'),
                    'multiple'      => 100,
                    'choices'       => HeaderBuilder::desktop_header_element(),
                    'partial_refresh' => array (
                        "jnews_hb_element_desktop_sticky_{$column}" => array (
                            'selector'        => '.jeg_stickybar',
                            'render_callback' => function() {
                                get_template_part('fragment/header/desktop-sticky');
                            },
                        )
                    ),
                ));
            }
        }

        /**
         * Mobile Drawer
         */
        $mobile_drawer_block = array(
            'top'       => array('center'),
            'bottom'    => array('center'),
        );

        $this->customizer->add_field(array(
            'id'            => 'jnews_hb_mobile_drawer_setting',
            'type'          => 'jnews-header',
            'section'       => $this->section_header_block_builder,
            'label'         => esc_html__('Mobile Drawer Element','jnews' ),
        ));

        foreach ($mobile_drawer_block as $row => $columns)
        {
            foreach ($columns as $column)
            {
                $this->customizer->add_field(array(
                    'id'            => "jnews_hb_element_mobile_drawer_{$row}_{$column}",
                    'transport'     => 'postMessage',
                    'default'       => jnews_header_default("drawer_element_{$row}"),
                    'type'          => 'jnews-select',
                    'section'       => $this->section_header_block_builder,
                    'label'         => ucfirst($row) . ' ' . ucfirst($column) . ' ' . esc_html__(' Element', 'jnews'),
                    'multiple'      => 100,
                    'choices'       => HeaderBuilder::mobile_drawer_element(),
                    'partial_refresh' => array (
                        "jnews_hb_element_mobile_drawer_{$row}_{$column}" => array (
                            'selector'        => '.jeg_mobile_wrapper',
                            'render_callback' => function() {
                                get_template_part('fragment/header/mobile-menu-content');
                            },
                        )
                    ),
                ));
            }
        }
    }


}