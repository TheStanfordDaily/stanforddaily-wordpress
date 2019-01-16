<?php
    $single = JNews\Single\SinglePost::getInstance();
?>
<div class="jeg_content jeg_singlepage">

    <div class="container">

        <div class="jeg_ad jeg_article jnews_article_top_ads">
            <?php do_action('jnews_article_top_ads'); ?>
        </div>

        <div class="row">
            <div class="jeg_main_content col-md-<?php echo esc_attr($single->main_content_width()); ?>">

                <?php if(have_posts()) : the_post(); ?>

                    <?php if(jnews_can_render_breadcrumb()) : ?>
                    <div class="jeg_breadcrumbs jeg_breadcrumb_container">
                        <?php $single->render_breadcrumb(); ?>
                    </div>
                    <?php endif; ?>

                    <div class="entry-header">
                        <h1 class="jeg_post_title"><?php the_title(); ?></h1>

                        <?php if( ! $single->is_subtitle_empty() ) : ?>
                            <h2 class="jeg_post_subtitle"><?php echo esc_html($single->render_subtitle()); ?></h2>
                        <?php endif; ?>

                        <div class="jeg_meta_container"><?php $single->render_post_meta(); ?></div>
                    </div>

                    <?php $single->render_featured_post(); ?>

                    <?php do_action('jnews_share_top_bar', get_the_ID()); ?>

                    <?php do_action('jnews_single_post_before_content'); ?>

                    <div class="entry-content <?php echo esc_attr($single->share_float_additional_class()); ?>">
                        <div class="jeg_share_button share-float jeg_sticky_share clearfix <?php $single->share_float_style_class(); ?>">
                            <?php do_action('jnews_share_float_bar', get_the_ID()); ?>
                        </div>

                        <div class="content-inner <?php echo apply_filters('jnews_content_class', '', get_the_ID()) ?>">
                            <?php the_content(); ?>
                            <?php wp_link_pages(); ?>

                            <?php if( has_tag() ) { ?>
                            <div class="jeg_post_tags"><?php $single->post_tag_render(); ?></div>
                            <?php } ?>
                            
                            <?php do_action('jnews_share_bottom_bar', get_the_ID()); ?>

                            <?php do_action('jnews_push_notification_single_post'); ?>
                        </div>
                    </div>

                    <?php do_action('jnews_single_post_after_content'); ?>

                <?php endif; ?>

            </div>
            <?php $single->render_sidebar(); ?>
        </div>

        <div class="jeg_ad jeg_article jnews_article_bottom_ads">
            <?php do_action('jnews_article_bottom_ads'); ?>
        </div>

    </div>
</div>