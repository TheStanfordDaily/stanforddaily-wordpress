<?php
get_header();
the_post();
?>

    <div class="jeg_main <?php jnews_get_bbpress_main_class(); ?>">
        <div class="jeg_container">
            <div class="jeg_content jeg_bbpress">

                <div class="container">
                    <div class="jeg_archive_header">
                        <h1 class="jeg_archive_title"><?php the_title(); ?></h1>
                    </div>

                    <div class="row">
                        <div class="jeg_main_content col-md-<?php echo esc_attr(jnews_bbpress_content_width()); ?>">
                            <?php the_content(); ?>
                            <?php wp_link_pages(); ?>
                        </div>
	                    <?php jnews_bbpress_render_sidebar(); ?>
                    </div>
                </div>
            </div>
            <?php do_action('jnews_after_main'); ?>
        </div>
    </div>

<?php get_footer();