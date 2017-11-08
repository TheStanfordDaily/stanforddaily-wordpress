<?php 
function get_home_cats( $cat_data ){ ?>

<?php
	global $count2 ;
	
	$Cat_ID = $cat_data['id'];
	$rand = $offset = $order = $Posts = '';

	if( !empty($cat_data['number']) )
		$Posts = $cat_data['number'];
		
	if( !empty($cat_data['order']) )
		$order = $cat_data['order'];
	
	if( !empty($cat_data['offset']) )	
		$offset =  $cat_data['offset'];

	if( $order == 'rand') $rand ="&orderby=rand";

	global $last_15_days_posts;
	global $last_15_days_categories;
	global $post;

	$last_15_days_count = 0;
	$last_15_days_cat_posts;

	$numberOfPosts = 0;
	if( !empty($cat_data['number']) )
		$numberOfPosts = (int)$Posts;

	$postsOffset = 0;
	if( !empty($cat_data['offset']) )	
		$postsOffset = (int)$offset;

	$postsCategory = (int)$Cat_ID;

	foreach ($last_15_days_posts as $post):

		if (!$last_15_days_categories[$post->ID]):
			$last_15_days_categories[$post->ID] = implode(",", wp_get_post_categories($post->ID));
		endif;
	
		$in_cat = in_array($Cat_ID, explode(",", $last_15_days_categories[$post->ID]));

		if ($last_15_days_count < ($numberOfPosts + $postsOffset)):
			if ($in_cat):
				$last_15_days_count++;
				if ($last_15_days_count > $postsOffset):
					$last_15_days_cat_posts[] = $post;
				endif;
			endif;
		else:
			break;		
		endif;
	endforeach;

	$cat_posts;
	if ($last_15_days_count < ($numberOfPosts + $postsOffset)):
		$cat_posts = get_posts('cat='.$Cat_ID.'&no_found_rows=1&posts_per_page='.$Posts.$rand.'&offset='.$offset);
	else:
		$cat_posts = $last_15_days_cat_posts;
	endif;

	

/*	$cat_query = new WP_Query('cat='.$Cat_ID.'&no_found_rows=1&posts_per_page='.$Posts.$rand.'&offset='.$offset); */
	$cat_title = get_the_category_by_ID($Cat_ID);
	$count = 0;
	$home_layout = $cat_data['style'];
	
?>
	<?php if( $home_layout == '2c'):  //************** 2C ****************************************************** ?>
		<?php $count2++; ?>
		<section class="cat-box column2 <?php if($count2 == 2) { echo 'last-column'; $count2=0; } ?>">
			<div class="cat-box-title">
				<h2><a href="<?php echo get_category_link( $Cat_ID ); ?>"><?php echo $cat_title ; ?></a></h2>
				<div class="stripe-line"></div>
			</div><!-- post-thumbnail /-->
			<div class="cat-box-content">
			
				<?php if(/*$cat_query->have_posts()): */count($cat_posts) > 0):?>
				<ul>
				<?php /*while ( $cat_query->have_posts() ) : $cat_query->the_post();*/foreach($cat_posts as $post): setup_postdata($post); $count ++ ;?>
				<?php if($count == 1) : ?>
					<li <?php tie_post_class('first-news'); ?>>
						<div class="inner-content">
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
									<?php tie_thumb( 'tie-medium' ); ?>
									<span class="overlay-icon"></span>
								</a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>
					
						<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						
							<?php get_template_part( 'includes/boxes-meta' ); ?>
					
							<div class="entry">
								<?php tie_excerpt_home() ?>
								<a class="more-link" href="<?php the_permalink() ?>"><?php _e( 'Read More &raquo;', 'tie' ) ?></a>
							</div>
						</div>
					</li><!-- .first-news -->
					<?php else: ?>
					<li <?php tie_post_class(); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php tie_thumb(); ?><span class="overlay-icon"></span></a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>			
						<h3 class="post-box-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<?php get_template_part( 'includes/boxes-meta' ); ?>					
					</li>
					<?php endif; ?>
				<?php /*endwhile;*/endforeach;?>
				</ul>

				<?php endif; ?>
			</div><!-- .cat-box-content /-->
		</section> <!-- Two Columns -->
		
		
	<?php elseif( $home_layout == '1c' ):  //************** 1C ******************************************************  ?>
		<section class="cat-box wide-box">
			<div class="cat-box-title">
				<h2><a href="<?php echo get_category_link( $Cat_ID ); ?>"><?php echo $cat_title ; ?></a></h2>
				<div class="stripe-line"></div>
			</div><!-- post-thumbnail /-->
			<div class="cat-box-content">
			
				<?php if(/*$cat_query->have_posts()): */count($cat_posts) > 0):?>
				<ul>
				<?php /*while ( $cat_query->have_posts() ) : $cat_query->the_post();*/foreach($cat_posts as $post): setup_postdata($post); $count ++ ;?>
				<?php if($count == 1) : ?>
					<li <?php tie_post_class( 'first-news' ); ?>>
						<div class="inner-content">
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
									<?php tie_thumb( 'tie-large' ); ?>
									<span class="overlay-icon"></span>
								</a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>
					
						<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						
							<?php get_template_part( 'includes/boxes-meta' ); ?>					
							<div class="entry">
								<?php tie_excerpt_home() ?>
								<a class="more-link" href="<?php the_permalink() ?>"><?php _e( 'Read More &raquo;', 'tie' ) ?></a>
							</div>
						</div>
					</li><!-- .first-news -->
					<?php else: ?>
					<li <?php tie_post_class(); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php tie_thumb(); ?><span class="overlay-icon"></span></a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>			
						<h3 class="post-box-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<?php get_template_part( 'includes/boxes-meta' ); ?>					
					</li>
					<?php endif; ?>
				<?php /*endwhile;*/endforeach;?>
				</ul>
				<div class="clear"></div>

					<?php endif; ?>
			</div><!-- .cat-box-content /-->
		</section><!-- Wide Box -->

	<?php else :   //************** list **********************************************************************************  ?>
		
		<section class="cat-box list-box">
			<div class="cat-box-title">
				<h2><a href="<?php echo get_category_link( $Cat_ID ); ?>"><?php echo $cat_title ; ?></a></h2>
				<div class="stripe-line"></div>
			</div><!-- post-thumbnail /-->
			<div class="cat-box-content">
			
				<?php if(/*$cat_query->have_posts()): */count($cat_posts) > 0):?>
				<ul>
				<?php /*while ( $cat_query->have_posts() ) : $cat_query->the_post();*/foreach($cat_posts as $post): setup_postdata($post); $count ++ ;?>
				<?php if($count == 1) : ?>
					<li <?php tie_post_class( 'first-news' ); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<!-- <div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
									<?php tie_thumb( 'tie-medium' ); ?>
									<span class="overlay-icon"></span>
								</a>
							</div> ->><!-- post-thumbnail /-->
						<?php endif; ?>
					
						<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						
							<?php get_template_part( 'includes/boxes-meta' ); ?>					
							<div class="entry">
								<?php tie_excerpt_home() ?>
								<a class="more-link" href="<?php the_permalink() ?>"><?php _e( 'Read More &raquo;', 'tie' ) ?></a>
							</div>
						</li><!-- .first-news -->
					<?php else: ?>
					<li <?php tie_post_class( 'other-news' ); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php tie_thumb(); ?><span class="overlay-icon"></span></a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>			
						<h3 class="post-box-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<?php get_template_part( 'includes/boxes-meta' ); ?>
					</li>
					<?php endif; ?>
				<?php /*endwhile;*/endforeach;?>
				</ul>
				<div class="clear"></div>

					<?php endif; ?>
			</div><!-- .cat-box-content /-->
		</section><!-- List Box -->

	<?php endif; ?>
<?php } ?>
