<?php
    get_header();
    $term = get_queried_object(); 
    $category = new \JNews\Category\Category($term);
?>

<div class="jeg_main <?php $category->main_class(); ?>">
    <div class="jeg_container">
        <div class="jeg_content">
            <div class="jnews_category_header_top">
                <?php echo jnews_sanitize_output( $category->render_header('top') ); ?>
            </div>

            <div class="jeg_section">
                <div class="container">

                    <?php do_action('jnews_archive_above_hero'); ?>

                    <div class="jnews_category_hero_container">
                        <?php echo jnews_sanitize_output( $category->render_hero() ); ?>
                    </div>

                    <?php do_action('jnews_archive_below_hero'); ?>
                    
                    <div class="jeg_cat_content row">
                        <div class="jeg_main_content jeg_column col-sm-<?php echo esc_attr($category->get_content_width()); ?>">
                            <div class="jnews_category_header_bottom">
                                <?php echo jnews_sanitize_output( $category->render_header('bottom') ); ?>
                            </div>
                            <div class="jnews_category_content_wrapper">
                                <?php echo jnews_sanitize_output( $category->render_content() ); ?>
                            </div>
                        </div>
	                    <?php $category->render_sidebar(); ?>
                    </div>
                </div>
            </div>

        </div>
        <?php do_action('jnews_after_main'); ?>
    </div>
</div>


<?php get_footer(); ?>