<?php
    $follow_mode = get_theme_mod('jnews_header_menu_follow', 'scroll');
    if($follow_mode !== 'normal') {
?>
<div class="sticky_blankspace"></div>
<div class="jeg_header <?php echo esc_attr(get_theme_mod('jnews_header_sticky_width', 'normal')) ?>">
    <div class="jeg_container">
        <div data-mode="<?php echo esc_attr( get_theme_mod('jnews_header_menu_follow', 'scroll') ); ?>" class="jeg_stickybar jeg_navbar <?php JNews\Helper\StyleHelper::header_stickybar_class(); ?>">
            <?php
            if(jnews_can_render_header('desktop_sticky', 'mid'))
            {
                get_template_part('fragment/header/desktop-sticky');
            }
            ?>
        </div>
    </div>
</div>
<?php
    }
?>