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

function tsd_query_not_featured_posts($args) {
	$args['tax_query'] = array (
		array (
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => "featured",
			'operator' => 'NOT IN'
		)
	);
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
						query_posts( array ( 'category_name' => 'featured', 'posts_per_page' => 1 ));
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
					query_posts( array ( 'category_name' => 'featured', 'posts_per_page' => 2, 'offset' => 1 ) );
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
					tsd_query_not_featured_posts( array ( 'category_name' => 'NEWS', 'posts_per_page' => 4 ) );
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
					tsd_query_not_featured_posts( array ( 'category_name' => 'SPORTS', 'posts_per_page' => 6 ) );
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
					tsd_query_not_featured_posts( array ( 'category_name' => 'arts-life', 'posts_per_page' => 6 ) );
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
						<a href="https://www.stanforddaily.com/podcasts/">
							<h3 class="tsd-block-title">The Daily Brew</h3>
						</a>
					</div>
				</div>
				<div class="row tsd-block">
					<div class="col-12 tsd-excerpt-container-textonly">
						<iframe src="https://anchor.fm/the-daily-brew/embed/episodes/05---Greek-Life-at-Stanford-e3sg6v" width="100%" height="100px" frameborder="0" scrolling="no"></iframe>
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
					tsd_query_not_featured_posts( array ( 'category_name' => 'opinions', 'posts_per_page' => 4 ) );
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
					tsd_query_not_featured_posts( array ( 'category_name' => 'thegrind', 'posts_per_page' => 4 ) );
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
					tsd_query_not_featured_posts( array ( 'category_name' => 'sponsored', 'posts_per_page' => 4 ) );
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
