<?php
$single = JNews\Single\SinglePost::getInstance();
$author = $post->post_author;
?>
<div class="jeg_post_meta jeg_post_meta_2">

    <?php if($single->show_author_meta()) : ?>
        <div class="jeg_meta_author">
            <?php
                if($single->show_author_meta_image())
                    echo get_avatar( get_the_author_meta( 'ID', $author ), 80, null, get_the_author_meta('display_name', $author) );
            ?>
            <span class="meta_text"><?php jnews_print_translation('by', 'jnews', 'by'); ?></span>
            <?php jnews_the_author_link($author); ?>
        </div>
    <?php endif; ?>

    <?php if($single->show_date_meta()) : ?>
        <div class="jeg_meta_date">
            <a href="<?php the_permalink(); ?>"><?php echo esc_html($single->post_date_format($post)); ?></a>
        </div>
    <?php endif; ?>

    <?php if($single->show_category_meta()) : ?>
        <div class="jeg_meta_category">
            <span><span class="meta_text"><?php jnews_print_translation('in', 'jnews', 'in'); ?></span>
                <?php the_category(', '); ?>
            </span>
        </div>
    <?php endif; ?>

    <div class="meta_right">
        <?php do_action('jnews_render_like', get_the_ID());  ?>
        <?php if($single->show_comment_meta()) : ?>
            <div class="jeg_meta_comment"><a href="<?php echo jnews_get_respond_link(); ?>"><i class="fa fa-comment-o"></i> <?php echo esc_html(jnews_get_comments_number()); ?></a></div>
        <?php endif; ?>
    </div>
</div>