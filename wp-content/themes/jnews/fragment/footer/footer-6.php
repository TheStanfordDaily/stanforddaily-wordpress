<div class="jeg_footer jeg_footer_6 <?php echo esc_attr( get_theme_mod('jnews_footer_scheme', 'normal') ); ?>">
    <div class="jeg_footer_container <?php echo esc_attr( get_theme_mod('jnews_footer_force_fullwidth') ? 'jeg_container_full' : 'jeg_container' ); ?>">

        <div class="jeg_footer_content">
            <div class="container">
                <div class="jeg_footer_primary clearfix">
                    <?php jnews_widget_area( 'footer-widget-1' ); ?>
                </div>
            </div>
        </div>

        <div class="jeg_footer_instagram_wrapper">
            <?php do_action('jnews_render_instagram_feed_footer'); ?>
        </div>

        <?php if(get_theme_mod('jnews_footer_show_secondary', true)) : ?>

        <div class="jeg_footer_bottom">
            <div class="container">

                <!-- secondary footer right -->
                <div class="footer_right">

                    <?php if(get_theme_mod('jnews_footer_copyright_position', 'left') === 'right') : ?>
                        <p class="copyright"> <?php echo jnews_get_footer_copyright(); ?> </p>
                    <?php endif; ?>

                    <?php if(get_theme_mod('jnews_footer_menu_position', 'right') === 'right') :
                        jnews_menu()->footer_navigation();
                    endif; ?>

                    <?php if(get_theme_mod('jnews_footer_social_position', 'hide') === 'right') : ?>
                        <div class="jeg_social_icon_block socials_widget nobg">
                            <?php jnews_generate_social_icon_block(); ?>
                        </div>
                    <?php endif; ?>

                </div>

                <!-- secondary footer left -->
                <?php if(get_theme_mod('jnews_footer_social_position', 'hide') === 'left') : ?>
                    <div class="jeg_social_icon_block socials_widget nobg">
                        <?php jnews_generate_social_icon_block(); ?>
                    </div>
                <?php endif; ?>

                <?php if(get_theme_mod('jnews_footer_menu_position', 'right') === 'left') :
                    jnews_menu()->footer_navigation();
                endif; ?>

                <?php if(get_theme_mod('jnews_footer_copyright_position', 'left') === 'left') : ?>
                    <p class="copyright"> <?php echo jnews_get_footer_copyright(); ?> </p>
                <?php endif; ?>

            </div>
        </div>

        <?php endif; ?>

    </div>
</div><!-- /.footer -->