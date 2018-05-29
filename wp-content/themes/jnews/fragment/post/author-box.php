<?php
    $author_id = get_post_field( 'post_author', get_the_ID() );
?>
<div class="jeg_authorbox">
    <div class="jeg_author_image">
        <?php echo get_avatar( $author_id, 80, null, get_the_author_meta('display_name', $author_id) ) ?>
    </div>
    <div class="jeg_author_content">
        <h3 class="jeg_author_name">
            <a href="<?php echo esc_url(get_author_posts_url( $author_id )); ?>">
                <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
            </a>
        </h3>
        <p class="jeg_author_desc">
            <?php if ( get_the_author_meta( 'description', $author_id ) ) :
                the_author_meta( 'description', $author_id );
            endif; ?>
        </p>

        <div class="jeg_author_socials">
            <?php get_template_part('fragment/post/author-social'); ?>
        </div>
    </div>
</div>

