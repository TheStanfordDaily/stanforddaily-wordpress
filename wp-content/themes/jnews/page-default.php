<?php
get_header();
the_post();
$single = new \JNews\Single\SinglePage();
?>

    <div class="jeg_main <?php $single->main_class(); ?>">
        <div class="jeg_container">

            <div class="jeg_content jeg_singlepage">
                <div class="container">

                    <div class="row">
                        <div class="jeg_main_content col-md-<?php echo esc_attr($single->column_width()) ?>">

                            <?php if(jnews_can_render_breadcrumb()) : ?>
                            <div class="jeg_breadcrumbs jeg_breadcrumb_container">
                                <?php $single->render_breadcrumb(); ?>
                            </div>
                            <?php endif; ?>

                            <div class="entry-header">
                                <h1 class="jeg_post_title"><?php the_title(); ?></h1>

                                <?php if($single->can_render_post_meta()) :  ?>
                                    <div class="jeg_meta_container">
                                        <div class="jeg_post_meta">
                                            <div class="jeg_meta_author">
                                                <span class="meta_text"><?php jnews_print_translation('by', 'jnews', 'by'); ?></span>
                                                <?php jnews_the_author_link(); ?>
                                            </div>
                                            <div class="jeg_meta_date"><a href="<?php the_permalink(); ?>"><?php the_date(); ?></a></div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>

                            <?php
                                if ( vp_metabox('jnews_single_page.show_post_featured', true) )
                                {
	                                echo jnews_sanitize_output($single->render_featured_post());
                                }
                            ?>

                            <?php do_action('jnews_share_top_bar', get_the_ID()); ?>

                            <div class="entry-content <?php $single->share_float_additional_class() ?>">
                                <?php if ($single->is_share_float()) : ?>
                                <div class="jeg_share_button share-float jeg_sticky_share clearfix <?php echo esc_html(vp_metabox('jnews_single_page.share_color')); ?>">
                                    <?php do_action('jnews_share_float_bar', get_the_ID()); ?>
                                </div>
                                <?php endif; ?>

                                <div class="content-inner">
                                    <?php the_content(); ?>
                                    <?php wp_link_pages(); ?>

                                    <?php do_action('jnews_share_bottom_bar', get_the_ID()); ?>
                                </div>
                            </div>


                            <?php
                            if ( comments_open() || '0' != jnews_get_comments_number() ) {
                                comments_template();
                            }
                            ?>
                        </div>
                        <?php $single->render_sidebar(); ?>
                    </div>

                </div>
            </div>
	        <?php do_action('jnews_after_main'); ?>

        </div>
    </div>

<?php get_footer();