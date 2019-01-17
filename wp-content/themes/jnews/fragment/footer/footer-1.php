<div class="jeg_footer jeg_footer_1 <?php echo esc_attr( get_theme_mod('jnews_footer_scheme', 'dark') ); ?>">
    <div class="jeg_footer_container <?php echo esc_attr( get_theme_mod('jnews_footer_force_fullwidth', false) ? 'jeg_container_full' : 'jeg_container' ); ?>">
        <div class="jeg_footer_content">
            <div class="container">

                <div class="row">
                    <div class="jeg_footer_primary clearfix">
                        <div class="col-md-4 footer_column">
                            <?php jnews_widget_area( 'footer-widget-1' ); ?>
                        </div>
                        <div class="col-md-4 footer_column">
                            <?php jnews_widget_area( 'footer-widget-2' ); ?>
                        </div>
                        <div class="col-md-4 footer_column">
                            <?php jnews_widget_area( 'footer-widget-3' ); ?>
                        </div>
                    </div>
                </div>


                <?php if(get_theme_mod('jnews_footer_show_secondary', true)) : ?>

                <div class="jeg_footer_secondary clearfix">

                    <!-- secondary footer right -->

                    <div class="footer_right">

                        <?php if(get_theme_mod('jnews_footer_menu_position', 'right') === 'right') :
                            jnews_menu()->footer_navigation();
                        endif; ?>

                        <?php if(get_theme_mod('jnews_footer_social_position', 'hide') === 'right') : ?>
                            <div class="jeg_social_icon_block socials_widget nobg">
                                <?php jnews_generate_social_icon_block(); ?>
                            </div>
                        <?php endif; ?>

                        <?php if(get_theme_mod('jnews_footer_copyright_position', 'left') === 'right') : ?>
                            <p class="copyright"> <?php echo jnews_get_footer_copyright(); ?> </p>
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

                </div> <!-- secondary menu -->

                <?php endif; ?>


            </div>
        </div>
    </div>
</div><!-- /.footer -->
