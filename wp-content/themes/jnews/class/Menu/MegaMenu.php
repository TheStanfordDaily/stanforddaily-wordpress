<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Menu;

Class MegaMenu
{
    public function __construct()
    {
        add_action( 'admin_enqueue_scripts',        array($this, 'load_asset'));
        add_action( 'wp_update_nav_menu_item',      array($this, 'custom_nav_update'), 10, 2);

        add_filter( 'wp_edit_nav_menu_walker',      array($this, 'custom_walker'), 10);
        add_filter( 'wp_setup_nav_menu_item',       array($this, 'custom_nav_item'));
    }

    public function custom_walker()
    {
        return 'JNews\Menu\MenuOptionWalker';
    }

    public function custom_nav_update($menu_id, $menu_item_db_id)
    {
        if(isset($_POST['jnews_mega_menu']) && isset($_POST['jnews_mega_menu'][$menu_item_db_id]))
        {
            update_post_meta($menu_item_db_id, 'menu_item_jnews_mega_menu', $_POST['jnews_mega_menu'][$menu_item_db_id]);
        }
    }

    public function custom_nav_item($menu_item)
    {
        $menu_item->mega_menu = get_post_meta( $menu_item->ID, 'menu_item_jnews_mega_menu', true );
        return $menu_item;
    }

    public function load_asset($menu)
    {
        if($menu === 'nav-menus.php') {
            wp_enqueue_style ('jeg-admin-style', get_parent_theme_file_uri('assets/css/admin/admin-menu.css'));
        }
    }
}
