<?php
function get_home_scroll( $cat_data ){ ?>
	
<?php
    wp_enqueue_script( 'tie-cycle' );

	$Cat_ID = $cat_data['id'];
	$offset = $Box_Title = $Posts = '';

	if( !empty($cat_data['number']) )
		$Posts = $cat_data['number'];
		
	if( !empty($cat_data['title']) )
		$Box_Title = $cat_data['title'];
	
	if( !empty($cat_data['offset']) )	
		$offset =  $cat_data['offset'];
		
	$cat_query = new WP_Query('cat='.$Cat_ID.'&no_found_rows=1&posts_per_page='.$Posts.'&offset='.$offset); 
?>
		<section class="cat-box scroll-box">
			<div class="cat-box-title">
				<h2><a href="<?php echo get_category_link( $Cat_ID ); ?>"><?php if( function_exists('icl_t') ) echo icl_t( theme_name , $cat_data['boxid'] , $Box_Title); else echo $Box_Title ; ?></a></h2>
				<div class="stripe-line"></div>
			</div><!-- post-thumbnail /-->
			<div class="cat-box-content">
				<?php if($cat_query->have_posts()): ?>
				<div id="slideshow<?php echo $Cat_ID ?>" class="group_items-box">
				<?php while ( $cat_query->have_posts() ) : $cat_query->the_post()?>
					<div <?php tie_post_class('scroll-item'); ?>>
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
									<?php tie_thumb( 'tie-medium' ); ?>
									<span class="overlay-icon"></span>
								</a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>			
						<h3 class="post-box-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<p class="post-meta">
							<?php if( tie_get_option( 'box_meta_score' ) ) tie_get_score(); ?>
							<?php if( tie_get_option( 'box_meta_date'  ) )  tie_get_time() ?>
						</p>
					</div>
				<?php endwhile;?>
				<div class="clear"></div>
				</div>
				<div id="nav<?php echo $Cat_ID ?>" class="scroll-nav"></div>
					<?php endif; ?>
			</div><!-- .cat-box-content /-->
		</section>
		<div class="clear"></div>
<script type="text/javascript">
	jQuery(document).ready(function() {
		var vids = jQuery("#slideshow<?php echo $Cat_ID ?> .scroll-item");
		for(var i = 0; i < vids.length; i+=4) {
		  vids.slice(i, i+4).wrapAll('<div class="group_items"></div>');
		}
		jQuery(function() {
			jQuery('#slideshow<?php echo $Cat_ID ?>').cycle({
				fx:     'scrollHorz',
				timeout: 3000,
				pager:  '#nav<?php echo $Cat_ID ?>',
				slideExpr: '.group_items',
				speed: 300,
				pause: true
			});
		});
  });
</script>
<?php } ?>