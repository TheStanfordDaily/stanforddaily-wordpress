<?php
    // we create class instance outside loop, so we need to take wp query instance directly
    $single = JNews\Single\SinglePost::getInstance()->set_post_id($wp_query->post->ID);

    get_header();
    do_action('single_post_' . $single->get_template());
?>
    <div class="post-wrapper">

        <div class="<?php echo apply_filters('jnews_post_wrap_class', 'post-wrap', $wp_query->post->ID); ?>" <?php echo apply_filters('jnews_post_wrap_attribute', '', $wp_query->post->ID); ?>>

            <?php do_action('jnews_single_post_begin', $wp_query->post->ID); ?>

            <div class="jeg_main <?php $single->main_class(); ?>">
                <div class="jeg_container">
                    <?php get_template_part('fragment/post/single-post-' . $single->get_template()); ?>
                </div>
            </div>

            <div id="post-body-class" <?php body_class(); ?>></div>

            <?php do_action('jnews_single_post_end', $wp_query->post->ID); ?>

        </div>

        <?php get_template_part('fragment/post/post-overlay'); ?>

    </div>
<?php get_footer(); ?>