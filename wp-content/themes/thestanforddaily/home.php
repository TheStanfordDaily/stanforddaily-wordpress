<?php
/**
 * The home template file
 *
 * This is the home page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The_Stanford_Daily
 */

get_header();

$featured_post_query = new WP_Query( array (
    'posts_per_page' => 3,
	'fields' => 'ids',
	'category_name' => 'featured'
));
$featured_post_ids = $featured_post_query->posts;

$tsd_query_not_featured_posts = function($args) use ($featured_post_ids) {
	$args['post__not_in'] = $featured_post_ids;
	return query_posts($args);
}
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main tsd-home-main container-fluid">
		<div class="row">
			<div class="col-12 col-lg-8">
				<div class="row">
					<div class="col-12 tsd-excerpt-container-bignews">
						<?php
						query_posts( array ( 'post__in' => array_slice($featured_post_ids, 0, 1) ));
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
								get_template_part( 'template-parts/excerpt', get_post_type() );
							endwhile;
						else:
							get_template_part( 'template-parts/content', 'none' );
						endif;
						wp_reset_query();
						?>
					</div>
				</div>
				<div class="row tsd-block">
					<?php
					query_posts( array ( 'post__in' => array_slice($featured_post_ids, 1) ) );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							echo '<div class="col-12 col-lg-6 tsd-excerpt-container-small">';
							get_template_part( 'template-parts/excerpt-thumb', get_post_type() );
							echo "</div>";
						endwhile;
					else:
						get_template_part( 'template-parts/content', 'none' );
					endif;
					wp_reset_query();
					?>
				</div>
				<div class="row tsd-block-title">
					<div class="col-12">
						<a href="<?php echo get_category_link(get_category_by_slug("news")); ?>">
							<h3 class="tsd-block-title">News</h3>
						</a>
					</div>
				</div>
				<div class="row tsd-block">
					<?php
					$tsd_query_not_featured_posts( array ( 'category_name' => 'NEWS', 'posts_per_page' => 4 ) );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							echo '<div class="col-12 col-lg-6 tsd-excerpt-container-small">';
							get_template_part( 'template-parts/excerpt-thumb', get_post_type() );
							echo "</div>";
						endwhile;
					else:
						get_template_part( 'template-parts/content', 'none' );
					endif;
					wp_reset_query();
					?>
				</div>
				<div class="row tsd-block-title">
					<div class="col-12">
						<a href="<?php echo get_category_link(get_category_by_slug("sports")); ?>">
							<h3 class="tsd-block-title">Sports</h3>
						</a>
					</div>
				</div>
				<div class="row tsd-block">
					<?php
					$tsd_query_not_featured_posts( array ( 'category_name' => 'SPORTS', 'posts_per_page' => 6 ) );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							echo '<div class="col-12 col-lg-6 tsd-excerpt-container-small">';
							get_template_part( 'template-parts/excerpt-thumb', get_post_type() );
							echo "</div>";
						endwhile;
					else:
						get_template_part( 'template-parts/content', 'none' );
					endif;
					wp_reset_query();
					?>
				</div>
				<div class="row tsd-block-title">
					<div class="col-12">
						<a href="<?php echo get_category_link(get_category_by_slug("arts-life")); ?>">
							<h3 class="tsd-block-title">Arts & Life</h3>
						</a>
					</div>
				</div>
				<div class="row tsd-block">
					<?php
					$tsd_query_not_featured_posts( array ( 'category_name' => 'arts-life', 'posts_per_page' => 6 ) );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							echo '<div class="col-12 col-lg-6 tsd-excerpt-container-small">';
							get_template_part( 'template-parts/excerpt-thumb', get_post_type() );
							echo "</div>";
						endwhile;
					else:
						get_template_part( 'template-parts/content', 'none' );
					endif;
					wp_reset_query();
					?>
				</div>
			</div>
			<div class="col-12 col-lg-4">
				<div class="row tsd-block-title">
					<div class="col-12">
						<a href="https://www.stanforddaily.com/2019/04/19/modeling-the-draw/">
							<h3 class="tsd-block-title">Modeling the Draw</h3>
						</a>
					</div>
				</div>
				<div class="row tsd-block">
					<div class="col-12 tsd-excerpt-container-textonly">
						<article id="post-1144742" class="post-1144742 post type-post status-publish format-standard hentry category-op-eds category-opinions">
							<div class="excerpt-content">
								<header class="entry-header">
									<p style='margin-bottom: 0; font-family: "PT Serif",serif;'>Our calculator can tell you the probability that you draw into ANY RESIDENCE on campus. Try it now!</p>
									<br />
									<a href="https://www.stanforddaily.com/2019/04/19/modeling-the-draw/">
										<button class="tsd-button outline">Calculate your chances</button>
									</a>
													<div class="entry-meta">
								</header><!-- .entry-header -->
							</div><!-- .excerpt-content -->
							<div class="clear"></div>
						</article><!-- #post-1144742 -->
					</div>
				</div>
				<div class="row tsd-block-title">
					<div class="col-12">
						<a href="<?php echo get_category_link(get_category_by_slug("opinions")); ?>">
							<h3 class="tsd-block-title">Opinions</h3>
						</a>
					</div>
				</div>
				<div class="row tsd-block">
					<?php
					$tsd_query_not_featured_posts( array ( 'category_name' => 'opinions', 'posts_per_page' => 4 ) );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/excerpt-textonly', get_post_type() );
						endwhile;
					else:
						get_template_part( 'template-parts/content', 'none' );
					endif;
					wp_reset_query();
					?>
				</div>
				<div class="row tsd-block-title">
					<div class="col-12">
						<a href="<?php echo get_category_link(get_category_by_slug("thegrind")); ?>">
							<h3 class="tsd-block-title">The Grind</h3>
						</a>
					</div>
				</div>
				<div class="row tsd-block">
					<?php
					$tsd_query_not_featured_posts( array ( 'category_name' => 'thegrind', 'posts_per_page' => 4 ) );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/excerpt-textonly', get_post_type() );
						endwhile;
					else:
						get_template_part( 'template-parts/content', 'none' );
					endif;
					wp_reset_query();
					?>
				</div>
				<div class="row tsd-block-title">
					<div class="col-12">
						<a href="<?php echo get_category_link(get_category_by_slug("sponsored")); ?>">
							<h3 class="tsd-block-title">Sponsored Content</h3>
						</a>
					</div>
				</div>
				<div class="row tsd-block">
					<?php
					$tsd_query_not_featured_posts( array ( 'category_name' => 'sponsored', 'posts_per_page' => 4 ) );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/excerpt-textonly', get_post_type() );
						endwhile;
					else:
						// Do nothing
					endif;
					wp_reset_query();
					?>
				</div>
			</div>
		</div>
		<div class="row tsd-block" style="margin-top: 25px;">
			<div class="col-12" style="height: 150px">
				<div class="scorestream-widget-container" data-ss_widget_type="horzScoreboard" data-user-widget-id="28769"></div><script async="async" type="text/javascript" src="https://scorestream.com/apiJsCdn/widgets/embed.js"></script>
			</div>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
