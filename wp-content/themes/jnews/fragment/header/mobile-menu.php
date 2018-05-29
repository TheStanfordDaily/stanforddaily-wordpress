<!-- Mobile Navigation
    ============================================= -->
<div id="jeg_off_canvas" class="<?php echo esc_attr(get_theme_mod('jnews_header_mobile_drawer_scheme', 'normal')); ?>">
    <a href="#" class="jeg_menu_close"><i class="jegicon-cross"></i></a>
    <div class="jeg_bg_overlay"></div>
    <div class="jeg_mobile_wrapper">
        <?php get_template_part('fragment/header/mobile-menu-content'); ?>
    </div>
</div>