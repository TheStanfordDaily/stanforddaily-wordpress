<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=yes' />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <?php get_template_part('fragment/side-feed'); ?>

    <div class="jeg_ad jeg_ad_top jnews_header_top_ads">
        <?php do_action('jnews_header_top_ads'); ?>
    </div>

    <!-- The Main Wrapper
    ============================================= -->
    <div class="jeg_viewport">

        <?php jnews_background_ads(); ?>

        <div class="jeg_header_wrapper">
            <?php get_template_part('fragment/header/desktop-builder'); ?>
        </div>

        <div class="jeg_header_sticky">
            <?php get_template_part('fragment/header/desktop-sticky-wrapper'); ?>
        </div>

        <div class="jeg_navbar_mobile_wrapper">
            <?php get_template_part('fragment/header/mobile-builder'); ?>
        </div>