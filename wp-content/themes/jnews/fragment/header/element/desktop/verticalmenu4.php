<div class="jeg_vertical_menu jeg_vertical_menu_4">
    <?php
    $vertical_content = get_theme_mod('jnews_header_vertical_menu_4', '');
    if(!empty($vertical_content))
    {
        wp_nav_menu(
            array(
                'menu'              => $vertical_content,
                'container'         => 'ul',
                'depth'             => 1,
                'echo'              => true
            )
        );
    }
    ?>
</div>
