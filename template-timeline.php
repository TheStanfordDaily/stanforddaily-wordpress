<?php 
/*
Template Name: Timeline
*/
?>
<?php get_header(); ?>
	<div class="content">
		<?php tie_breadcrumbs() ?>
				
		<?php if ( ! have_posts() ) : ?>
			<div id="post-0" class="post not-found post-listing">
				<h1 class="post-title"><?php _e( 'Not Found', 'tie' ); ?></h1>
				<div class="entry">
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'tie' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php endif; ?>
		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
		<?php $get_meta = get_post_custom($post->ID);  ?>
		<?php //Above Post Banner
		if( empty( $get_meta["tie_hide_above"][0] ) ){
			if( !empty( $get_meta["tie_banner_above"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["tie_banner_above"][0]) .'</div>';
			else tie_banner('banner_above' , '<div class="ads-post">' , '</div>' );
		}
		?>
		<article class="post-listing post">
			<?php get_template_part( 'includes/post-head' ); ?>
			<div class="post-inner">
				<h1 class="post-title"><?php the_title(); ?></h1>
				<p class="post-meta"></p>
				<div class="clear"></div>
				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tie' ), 'after' => '</div>' ) ); ?>
					<?php
					$where = apply_filters( 'getarchives_where', "WHERE post_type = 'post' AND post_status = 'publish'" );
					$join = apply_filters( 'getarchives_join', '' );
					$query = "SELECT YEAR(post_date) AS `year`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date) ORDER BY post_date DESC";
					$key = md5($query);
					$cache = wp_cache_get( 'wp_get_archives' , 'general');
					if ( !isset( $cache[ $key ] ) ) {
						$arcresults = $wpdb->get_results($query);
						$cache[ $key ] = $arcresults;
						wp_cache_set( 'wp_get_archives', $cache, 'general' );
					} else {
						$arcresults = $cache[ $key ];
					}
					if ($arcresults) {
						foreach ( (array) $arcresults as $arcresult) { ?>

						<h2 class="timeline-head"><?php echo $arcresult->year ?></h2>					
						<?php 
						$year = (int) $arcresult->year;
						$query = new WP_Query( 'year='.$year.'&no_found_rows=1&posts_per_page=100' ); ?>
						<ul class="timeline">
						<?php while ( $query->have_posts() ) : $query->the_post()?>
						<li>	
							<span><?php the_time('j F') ?></span><a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</li>
					<?php endwhile; ?>
						</ul>
					<?php	}
					}	 
					?>
					
				</div><!-- .entry /-->	
			
			</div><!-- .post-inner -->
		</article><!-- .post-listing -->
		<?php endwhile; ?>
		
		<?php wp_reset_query(); ?>
		<?php edit_post_link( __( 'Edit', 'tie' ), '<span class="edit-link">', '</span>' ); ?>

		<?php //Below Post Banner
		if( empty( $get_meta["tie_hide_below"][0] ) ){
			if( !empty( $get_meta["tie_banner_below"][0] ) ) echo '<div class="ads-post">' .htmlspecialchars_decode($get_meta["tie_banner_below"][0]) .'</div>';
			else tie_banner('banner_below' , '<div class="ads-post">' , '</div>' );
		}
		?>
		
		<?php comments_template( '', true ); ?>
	</div><!-- .content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>