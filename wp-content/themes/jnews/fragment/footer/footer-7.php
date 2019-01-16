<div class="jeg_footer jeg_footer_sidecontent <?php echo esc_attr( get_theme_mod('jnews_footer_scheme', 'normal') ); ?>">
    <div class="jeg_footer_container <?php echo esc_attr( get_theme_mod('jnews_footer_force_fullwidth', false) ? 'jeg_container_full' : 'jeg_container' ); ?>">
        <div class="jeg_footer_content">
            <div class="container">
                <div class="row">
                    <div class="jeg_footer_primary clearfix">
                        <div class="col-md-2 footer_column">
                            <div class="footer_widget widget_about">
                                <div class="jeg_about">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" class="footer_logo">
                                        <?php jnews_generate_footer_7_logo(); ?>
                                    </a>
                                    <p class="copyright"> <?php echo jnews_get_footer_copyright(); ?> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-8 footer_column">
                            <div class="footer_widget widget_nav_menu">
                                <div class="jeg_footer_heading jeg_footer_heading_2">
                                    <h3 class="jeg_footer_title menu-title"><span><?php echo jnews_get_footer_menu_title(); ?></span></h3>
                                </div>
                                <?php jnews_menu()->footer_navigation(); ?>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 footer_column">
                            <div class="jeg_footer_heading jeg_footer_heading_2">
                                    <h3 class="jeg_footer_title social-title"><span><?php echo jnews_get_footer_social_title(); ?></span></h3>
                            </div>

                            <div class="socials_widget nobg">
                                <?php jnews_generate_social_icon_block(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.footer -->
