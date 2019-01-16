<div class="jeg_prevnext_post">
    <?php
    $prev_post = get_previous_post();
    if (empty( $prev_post )) $prev_post = 0;
    if (!empty( $prev_post )):
        ?>
        <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="post prev-post">
            <span class="caption"><?php jnews_print_translation('Previous Post', 'jnews', 'previous_post'); ?></span>
            <h3 class="post-title"><?php echo wp_kses_post( $prev_post->post_title ) ?></h3>
        </a>
    <?php endif; ?>

    <?php
    $next_post = get_next_post();
    if (empty( $next_post )) $next_post = 0;
    if (!empty( $next_post )):
        ?>
        <a href="<?php echo esc_url(get_permalink($next_post->ID)) ?>" class="post next-post">
            <span class="caption"><?php jnews_print_translation('Next Post', 'jnews', 'next_post'); ?></span>
            <h3 class="post-title"><?php echo wp_kses_post( $next_post->post_title ) ?></h3>
        </a>
    <?php endif; ?>
</div>