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
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main tsd-home-main container-fluid">
		<div class="row">
			<div class="col-12 col-sm-8">
				<div class="row">
					<div class="col-12 tsd-excerpt-container-bignews">
						<?php
						query_posts( array ( 'category_name' => 'big-news-feed', 'posts_per_page' => 1 ) );
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
					query_posts( array ( 'category_name' => 'big-news-feed', 'posts_per_page' => 2, 'offset' => 1 ) );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							echo '<div class="col-12 col-sm-6 tsd-excerpt-container-small">';
							get_template_part( 'template-parts/excerpt', get_post_type() );
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
						<h3 class="tsd-block-title">News</h3>
					</div>
				</div>
				<div class="row tsd-block">
					<?php
					query_posts( array ( 'category_name' => 'NEWS', 'posts_per_page' => 4 ) );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							echo '<div class="col-12 col-sm-6 tsd-excerpt-container-small">';
							get_template_part( 'template-parts/excerpt', get_post_type() );
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
						<h3 class="tsd-block-title">Sports</h3>
					</div>
				</div>
				<div class="row tsd-block">
					<?php
					query_posts( array ( 'category_name' => 'SPORTS', 'posts_per_page' => 6 ) );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							echo '<div class="col-12 col-sm-6 tsd-excerpt-container-small">';
							get_template_part( 'template-parts/excerpt', get_post_type() );
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
						<h3 class="tsd-block-title">Arts & Life</h3>
					</div>
				</div>
				<div class="row tsd-block">
					<?php
					query_posts( array ( 'category_name' => 'arts-life', 'posts_per_page' => 6 ) );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							echo '<div class="col-12 col-sm-6 tsd-excerpt-container-small">';
							get_template_part( 'template-parts/excerpt', get_post_type() );
							echo "</div>";
						endwhile;
					else:
						get_template_part( 'template-parts/content', 'none' );
					endif;
					wp_reset_query();
					?>
				</div>
			</div>
			<div class="col-12 col-sm-4">
				<div class="row tsd-block-title">
					<div class="col-12">
						<h3 class="tsd-block-title">Opinions</h3>
					</div>
				</div>
				<div class="row tsd-block">
					<?php
					query_posts( array ( 'category_name' => 'opinions', 'posts_per_page' => 4 ) );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							echo '<div class="col-12 tsd-excerpt-container-textonly">';
							get_template_part( 'template-parts/excerpt', get_post_type() );
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
						<h3 class="tsd-block-title">The Grind</h3>
					</div>
				</div>
				<div class="row tsd-block">
					<?php
					query_posts( array ( 'category_name' => 'thegrind', 'posts_per_page' => 4 ) );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							echo '<div class="col-12 tsd-excerpt-container-textonly">';
							get_template_part( 'template-parts/excerpt', get_post_type() );
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
						<h3 class="tsd-block-title">Sponsored Content</h3>
					</div>
				</div>
				<div class="row tsd-block">
					<?php
					query_posts( array ( 'category_name' => 'sponsored', 'posts_per_page' => 4 ) );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							echo '<div class="col-12 tsd-excerpt-container-textonly">';
							get_template_part( 'template-parts/excerpt', get_post_type() );
							echo "</div>";
						endwhile;
					else:
						get_template_part( 'template-parts/content', 'none' );
					endif;
					wp_reset_query();
					?>
				</div>
			</div>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
