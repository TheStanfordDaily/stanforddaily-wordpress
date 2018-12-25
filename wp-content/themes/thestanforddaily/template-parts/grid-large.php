<?php
/**
 * Template part for displaying large grid posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The_Stanford_Daily
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("tsd-grid-large"); ?>>
        <div class="tsd-post-thumbnail">
            <img src="<?php echo the_post_thumbnail_url('medium'); ?>" />
        </div>
		<div class="tsd-post-main">
            <h3>
                <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                    <?php the_title(); ?>
                </a>
            </h3>
            <div class="entry-meta">
            <?php tsd_posted_by(false); ?> <i class="far fa-clock"></i> <?php tsd_posted_on(); ?>
            </div>
            <?php
            the_excerpt();
            ?>
        </div>
</article><!-- #post-<?php the_ID(); ?> -->
