<?php
    get_header();
    $archive = new \JNews\Archive\SingleArchive();
?>

<div class="jeg_main <?php $archive->main_class(); ?>">
    <div class="jeg_container">
        <div class="jeg_content">
            <div class="jeg_section">
                <div class="container">

                    <?php do_action( 'jnews_archive_above_content' ); ?>

                    <div class="jeg_archive_header">
                        <?php if ( is_tag() && jnews_can_render_breadcrumb() ): ?>
                            <div class="jeg_breadcrumbs jeg_breadcrumb_container">
                                <?php echo jnews_sanitize_output( $archive->render_breadcrumb() ); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php the_archive_title( '<h1 class="jeg_archive_title">', '</h1>' ); ?>
                        <?php the_archive_description( '<div class="jeg_archive_description">', '</div>' ); ?>
                    </div>

                    <div class="jeg_cat_content row">
                        <div class="jeg_main_content col-sm-<?php echo esc_attr($archive->get_content_width()); ?>">
                            <div class="jnews_archive_content_wrapper">
                                <?php echo jnews_sanitize_output( $archive->render_content() ); ?>
                            </div>

                            <?php echo jnews_sanitize_output( $archive->render_navigation() ); ?>
                        </div>
	                    <?php $archive->render_sidebar(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php do_action('jnews_after_main'); ?>
    </div>
</div>


<?php get_footer(); ?>