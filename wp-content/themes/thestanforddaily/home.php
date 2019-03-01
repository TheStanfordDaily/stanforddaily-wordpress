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
			<div class="col-12 col-lg-8">
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
							echo '<div class="col-12 col-lg-6 tsd-excerpt-container-small">';
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
							echo '<div class="col-12 col-lg-6 tsd-excerpt-container-small">';
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
							echo '<div class="col-12 col-lg-6 tsd-excerpt-container-small">';
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
							echo '<div class="col-12 col-lg-6 tsd-excerpt-container-small">';
							get_template_part( 'template-parts/excerpt', get_post_type() );
							echo "</div>";
						endwhile;
					else:
						get_template_part( 'template-parts/content', 'none' );
					endif;
					wp_reset_query();
					?>
				</div>
				<div class="row tsd-block">
					<div class="col-12 col-lg-6">
						<a class="twitter-timeline" data-height="500" data-theme="light" href="https://twitter.com/StanfordDaily?ref_src=twsrc%5Etfw">Tweets by StanfordDaily</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
					</div>
					<div class="col-12 col-lg-6">
						<div class="fb-page" data-href="https://www.facebook.com/stanforddaily" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/stanforddaily" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/stanforddaily">The Stanford Daily</a></blockquote></div>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-4">
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
