<div class="jeg_footer jeg_footer_4 <?php echo esc_attr( get_theme_mod('jnews_footer_scheme', 'normal') ); ?>">
    <div class="jeg_footer_container <?php echo esc_attr( get_theme_mod('jnews_footer_force_fullwidth', false) ? 'jeg_container_full' : 'jeg_container' ); ?>">
        <div class="jeg_footer_content">
            <div class="container">
                <div class="row">
                    <div class="jeg_footer_primary clearfix">
                        <div class="col-md-9 footer_column">
                            <?php jnews_menu()->footer_navigation(); ?>
                        </div>
                        <div class="col-md-3 footer_column footer_right">
                            <div class="footer-text">
                                <?php echo wp_kses(get_theme_mod('jnews_footer_text', jnews_footer_text()), wp_kses_allowed_html()); ?>
                            </div>
                        </div>
                    </div>

                    <?php if(get_theme_mod('jnews_footer_show_secondary', true)) : ?>

                    <div class="jeg_footer_secondary clearfix">
                        <div class="col-md-9 footer_column">
                            <p class="copyright"> <?php echo jnews_get_footer_copyright(); ?> </p>
                        </div>
                        <div class="col-md-3 footer_column footer_right">
                            <div class="jeg_social_icon_block socials_widget nobg">
                                <?php jnews_generate_social_icon_block(); ?>
                            </div>
                        </div>
                    </div>

                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </div>
</div><!-- /.footer -->