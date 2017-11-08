<?php 
function get_home_news_videos( $cat_data ){ ?>
<?php
	$Cat_ID = $cat_data['id'];
	$offset = $Box_Title = '';
	
	if( !empty($cat_data['title']) )	
		$Box_Title = $cat_data['title'];
	
	if( !empty($cat_data['offset']) )	
		$offset =  $cat_data['offset'];
		
	$count = 0;
	$cat_query = new WP_Query( array(
		'cat' => $Cat_ID,
		'posts_per_page' => 4,
		'offset' => $offset,
		'no_found_rows' => 1,
		'meta_query' => array(
			'relation' => 'OR',
			array(
				'key' => 'tie_video_url',
				'value' => ' ',
				'compare' => '!='
			),
			array(
				'key' => 'tie_embed_code',
				'value' => ' ',
				'compare' => '!='
			)
		))); 
		
 ?>
		<section class="cat-box video-box">
			<div class="cat-box-title">
				<h2><a href="<?php echo get_category_link( $Cat_ID ); ?>"><?php if( function_exists('icl_t') ) echo icl_t( theme_name , $cat_data['boxid'] , $Box_Title); else echo $Box_Title ; ?></a></h2>
				<div class="stripe-line"></div>
			</div><!-- post-thumbnail /-->
			<div class="cat-box-content">
			
				<?php if($cat_query->have_posts()): ?>
				<ul>
				<?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); $count ++ ;?>
				<?php if($count == 1) : ?>
					<li <?php tie_post_class( 'big-video-column' ); ?>>
						<?php tie_video(); ?>
					</li><!-- .first-news -->
					<?php else: ?>
					<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
					<li <?php tie_post_class( 'videos-item'.$count ); ?>>
						<div class="post-thumbnail">
							<a class="ttip" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php tie_thumb( 'tie-medium' ); ?><span class="overlay-icon"></span></a>
						</div><!-- post-thumbnail /-->
					</li>
					<?php endif; ?>			
					<?php endif; ?>
				<?php endwhile;?>
				</ul>
				<div class="clear"></div>
				<?php endif; ?>
			</div><!-- .cat-box-content /-->
		</section><!-- Videos Box -->
<?php } ?>