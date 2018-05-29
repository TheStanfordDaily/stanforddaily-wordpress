<?php
get_header();
the_post();

$attachment = new \JNews\Archive\AttachmentArchive();
?>

    <div class="jeg_main <?php $attachment->main_class(); ?>">
        <div class="jeg_container">
            <div class="jeg_content jeg_singlepage">

                <div class="container">

                    <?php do_action( 'jnews_archive_above_content' ); ?>

                    <?php if(jnews_can_render_breadcrumb()) : ?>
                    <div class="jeg_breadcrumbs jeg_breadcrumb_container">
                        <?php echo jnews_render_breadcrumb(); ?>
                    </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="jeg_main_content col-sm-<?php echo esc_attr($attachment->get_content_width()); ?>">
                            <div class="entry-header">
                                <h1 class="jeg_post_title"><?php the_title(); ?></h1>
                            </div>
                            <div class="jeg_featured featured_image">
                                <?php
                                    if ( wp_attachment_is_image( get_the_ID() ) ) {
                                        $image_size = $attachment->get_page_layout() !== 'no-sidebar' ? 'jnews-featured-750' : 'jnews-featured-1140';
                                        echo apply_filters('jnews_single_image_unwrap', get_the_ID(), $image_size);
                                    }
                                ?>
                            </div>
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
	                    <?php $attachment->render_sidebar(); ?>
                    </div>
                </div>
            </div>
            <?php do_action('jnews_after_main'); ?>
        </div>
    </div>

<?php get_footer(); ?>