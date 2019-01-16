<div class="jeg_footer_instagram_wrapper jeg_container">
    <?php do_action('jnews_render_instagram_feed_footer'); ?>
</div>

<div class="jeg_footer jeg_footer_5 <?php echo esc_attr( get_theme_mod('jnews_footer_scheme', 'normal') ); ?>">
    <div class="jeg_footer_container <?php echo esc_attr( get_theme_mod('jnews_footer_force_fullwidth', false) ? 'jeg_container_full' : 'jeg_container' ); ?>">

        <div class="jeg_footer_content">
            <div class="container">
                <?php if(get_theme_mod('jnews_footer_show_social', true)) : ?>
                <div class="jeg_footer_social">
                    <div class="socials_widget jeg_new_social_icon_block circle">
                        <?php jnews_generate_social_icon_block(true, true); ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="jeg_footer_primary clearfix">
                    <!-- Footer Widget: Column 1 -->
                    <div class="col-md-4 footer_column">
                        <?php jnews_widget_area( 'footer-widget-1' ); ?>
                    </div>

                    <!-- Footer Widget: Column 2 -->
                    <div class="col-md-4 footer_column">
                        <?php jnews_widget_area( 'footer-widget-2' ); ?>
                    </div>

                    <!-- Footer Widget: Column 3 -->
                    <div class="col-md-4 footer_column">
                        <?php jnews_widget_area( 'footer-widget-3' ); ?>
                    </div>
                </div>

                <?php if(get_theme_mod('jnews_footer_show_secondary', true)) : ?>

                <div class="jeg_footer_secondary clearfix">
                    <div class="footer_center">
                        <p class="copyright"> <?php echo jnews_get_footer_copyright(); ?></p>
                    </div>
                </div>

                <?php endif; ?>

            </div>
        </div>

    </div>
</div><!-- /.footer -->