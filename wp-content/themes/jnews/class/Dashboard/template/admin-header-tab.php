<?php settings_errors(); ?>
<div class="wrap">
    <h2 class="nav-tab-wrapper jnews-admin-tab">
        <?php
            $allmenu = apply_filters('jnews_get_admin_menu', '');
            foreach($allmenu as $menu) {
                $tabactive = isset($_GET['page']) && ( $_GET['page'] === $menu['slug'] ) ? "nav-tab-active" : "";
                $pageurl = menu_page_url($menu['slug'], false);
                if($menu['slug'] === 'customize.php') {
                    $pageurl = admin_url() . 'customize.php';
                }
            ?>
                <a href="<?php echo esc_url($pageurl); ?>" class="nav-tab <?php echo esc_attr($tabactive) ?>"><?php echo esc_html($menu['title']); ?></a>
            <?php
            }
        ?>
    </h2>
</div><!-- /.wrap -->