<div class="jeg_header_instagram_wrapper">
    <?php do_action('jnews_render_instagram_feed_header'); ?>
</div>

<!-- HEADER -->
<div class="jeg_header <?php echo esc_attr( get_theme_mod('jnews_header_width', 'normal') ); ?>">
    <?php
        $rows = get_theme_mod('jnews_hb_arrange_bar', array('top', 'mid', 'bottom'));

        foreach ($rows as $row)
        {
            if(jnews_can_render_header('desktop', $row)) {
                get_template_part('fragment/header/desktop-' . $row );
            }
        }
    ?>
</div><!-- /.jeg_header -->