<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The_Stanford_Daily
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="excerpt-thumb">
		<?php tsd_post_thumbnail(); ?>
	</div><!-- .excerpt-thumb -->

	<div class="excerpt-content">
		<header class="entry-header">
			<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php tsd_posted_by(false); ?> &mdash; <?php tsd_posted_on(); tsd_comments_count(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</div><!-- .excerpt-content -->
	<div class="clear"></div>
</article><!-- #post-<?php the_ID(); ?> -->
