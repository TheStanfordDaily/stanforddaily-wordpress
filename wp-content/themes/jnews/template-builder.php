<?php
/**
Template Name: Landing Page
*/
get_header();
the_post();

$single = new \JNews\LandingBuilder();
?>

<div class="jeg_main">

    <div class="jeg_container">
        <div class="jeg_content">
            <div class="jeg_vc_content">
                <?php
                if($single->can_render_builder()) :
                    the_content();
                endif;
                ?>
            </div>

            <?php if($single->can_render_loop()) : ?>
                <div class="container">
                    <div class="jeg_latestpost <?php $single->main_class(); ?>">
                        <div class="row">
                            <div class="jeg_main_content col-md-<?php echo esc_attr($single->column_width()) ?>">
                                <?php echo jnews_sanitize_output($single->render_loop()); ?>
                            </div>
	                        <?php $single->render_sidebar(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php do_action('jnews_after_main'); ?>
    </div>
</div>

<?php get_footer(); ?>