<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$labels = array(
				'name'                => _x( 'Counter Numbers', 'Counter Numbers ', wpshopmart_cns_text_domain ),
				'singular_name'       => _x( 'Counter Numbers ', 'Counter Numbers ', wpshopmart_cns_text_domain ),
				'menu_name'           => __( 'Counter Numbers ', wpshopmart_cns_text_domain ),
				'parent_item_colon'   => __( 'Parent Item:', wpshopmart_cns_text_domain ),
				'all_items'           => __( 'All counters', wpshopmart_cns_text_domain ),
				'view_item'           => __( 'View counters', wpshopmart_cns_text_domain ),
				'add_new_item'        => __( 'Add New Counter', wpshopmart_cns_text_domain ),
				'add_new'             => __( 'Add New Counter', wpshopmart_cns_text_domain ),
				'edit_item'           => __( 'Edit Counter', wpshopmart_cns_text_domain ),
				'update_item'         => __( 'Update Counters', wpshopmart_cns_text_domain ),
				'search_items'        => __( 'Search Counters', wpshopmart_cns_text_domain ),
				'not_found'           => __( 'No Counter Found', wpshopmart_cns_text_domain ),
				'not_found_in_trash'  => __( 'No Counter found in Trash', wpshopmart_cns_text_domain ),
			);
			$args = array(
				'label'               => __( 'Counter Numbers ', wpshopmart_cns_text_domain ),
				'description'         => __( 'Counter Numbers ', wpshopmart_cns_text_domain ),
				'labels'              => $labels,
				'supports'            => array( 'title', '', '', '', '', '', '', '', '', '', '', ),
				//'taxonomies'          => array( 'category', 'post_tag' ),
				 'hierarchical'        => false,
				'public'              => false,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => false,
				'show_in_admin_bar'   => false,
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-clock',
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => false,
				'capability_type'     => 'page',
			);
			register_post_type( 'counter_numbers', $args );	
 ?>