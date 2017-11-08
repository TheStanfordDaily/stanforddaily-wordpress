<?php
$category_id = get_query_var('cat') ; 
$cat_options = get_option( "tie_cat_$category_id");
if( !empty( $cat_options['cat_slider'] ) ):

	global $post;
	$orig_post = $post;
	
	$number = tie_get_option( 'slider_number' );
	$slider_query = $cat_options['cat_slider'] ;
	$caption_length = tie_get_option( 'slider_caption_length' );
	if( empty($caption_length) || $caption_length == ' ' || !is_numeric($caption_length))	$caption_length = 100;

	if( tie_get_option('slider_type') == 'elastic' ){
				
		$effect = tie_get_option( 'elastic_slider_effect' );
		$autoplay = tie_get_option( 'elastic_slider_autoplay' );
		$speed = tie_get_option( 'elastic_slider_speed' );
		$interval = tie_get_option( 'elastic_slider_interval' );
		
		if( !$speed || $speed == ' ' || !is_numeric($speed))	$speed = 800 ;
		if( !$interval || $interval == ' ' || !is_numeric($interval))	$interval = 3000;
		
		if( $effect == 'sides' ) $effect = 'sides';
		else $effect = 'center';

		if( $autoplay ) $autoplay = 'true';
		else $autoplay = 'false'; ?>
		
		<script type="text/javascript">
            jQuery(function() {
                jQuery('#ei-slider').eislideshow({
					animation			: '<?php echo $effect ?>',
					autoplay			: <?php echo $autoplay ?>,
					slideshow_interval	: <?php echo $interval ?>,
					speed          		: <?php echo $speed ?>,
					titlesFactor		: 0.60,
					titlespeed          : 1000,
					thumbMaxWidth       : 100
                });
            });
        </script>
		
	<?php
	}else{
	
		
		$effect = tie_get_option( 'flexi_slider_effect' );
		$speed = tie_get_option( 'flexi_slider_speed' );
		$time = tie_get_option( 'flexi_slider_time' );
		
		if( !$speed || $speed == ' ' || !is_numeric($speed))	$speed = 7000 ;
		if( !$time || $time == ' ' || !is_numeric($time))	$time = 600;
		
		if( $effect == 'slideV' )
				$effect = 'animation: "slide",
						  direction: "vertical",';
		elseif( $effect == 'slideH' )
					$effect = 'animation: "slide",';
		else
			$effect = 'animation: "fade",';
		?>
		
		<script>
			jQuery(document).ready(function() {
			  jQuery('.flexslider').flexslider({
				<?php echo $effect  ?>
				slideshowSpeed: <?php echo $speed ?>,
				animationSpeed: <?php echo $time ?>,
				randomize: false,
				pauseOnHover: true,
				prevText: "",
				nextText: "",
				after: function(slider) {
					jQuery('#flexslider .slider-caption').animate({bottom:12,}, 400)
				},
				before: function(slider) {
					jQuery('#flexslider .slider-caption').animate({ bottom:-105,}, 400)
				},	
				start: function(slider) {
					var slide_control_width = 100/<?php echo $number; ?>;
					jQuery('#flexslider .flex-control-nav li').css('width', slide_control_width+'%');
					jQuery('#flexslider .slider-caption').animate({ bottom:12,}, 400)
				}
			  });
			});
		</script>
	<?php
	}
	
	
	if( $slider_query == 'recent' || $slider_query == 'random' ){
	
		if( $slider_query == 'random' )
			$args= array('posts_per_page'=> $number , 'cat' => $category_id , 'orderby' => 'rand', 'no_found_rows' => 1 );
		else
			$args= array('posts_per_page'=> $number , 'cat' => $category_id, 'no_found_rows' => 1 );

		$featured_query = new wp_query( $args );
	?>
	
<?php if( tie_get_option('slider_type') == 'elastic' ): ?>

	<?php if( $featured_query->have_posts() ) : ?>
	<div id="ei-slider" class="ei-slider">
		<ul class="ei-slider-large">
		<?php $i= 0;
			while ( $featured_query->have_posts() ) : $featured_query->the_post(); $i++; ?>
			<li>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>"><?php tie_thumb( 'slider' ); ?></a>
			<?php endif; ?>
				<div class="ei-title">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php if (tie_get_option( 'slider_caption' )) : ?><h3><?php echo tie_content_limit( get_the_excerpt() , $caption_length ) ?></h3><?php endif; ?>
				</div>
			</li>
		<?php endwhile;?>
		</ul>
		 <ul class="ei-slider-thumbs">
			<li class="ei-slider-element">Current</li>
		<?php $i= 0;
			while ( $featured_query->have_posts() ) : $featured_query->the_post(); $i++; ?>
			<li><a href="#">Slide <?php echo $i; ?></a><?php tie_thumb( 'tie-medium' ); ?></li>
    		<?php endwhile;?>
		</ul><!-- ei-slider-thumbs -->
	</div>
	<?php endif; ?>
	
	
<?php else: ?>
	
	
	<?php if( $featured_query->have_posts() ) : ?>
	<div id="flexslider" class="flexslider">
		<ul class="slides">
		<?php while ( $featured_query->have_posts() ) : $featured_query->the_post()?>
			<li>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
				<a href="<?php the_permalink(); ?>">
				<?php tie_thumb( 'slider' ); ?>
				</a>
			<?php endif; ?>
				<div class="slider-caption">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php if (tie_get_option( 'slider_caption' )) : ?><p><?php echo tie_content_limit( get_the_excerpt() , $caption_length ) ?></p><?php endif; ?>
				</div>
			</li>
		<?php endwhile;?>
		</ul>
	</div>
	<?php endif; ?>
	
<?php endif; ?>
	
	
	<?php
	
	
	}else{
		global $last_15_days_posts;

		$last_15_days_custom_slider_posts;
		foreach ($last_15_days_posts as $post):
			if ($post->ID == $slider_query && $post->post_type == 'tie_slider')
				$last_15_days_custom_slider_posts[] = $post;
		endforeach;

		$custom_slider;
		
		if (count($last_15_days_custom_slider_posts) > 0):
			$custom_slider = $last_15_days_custom_slider_posts;
		else:
			$custom_slider_args = array( 'post_type' => 'tie_slider', 'p' => $slider_query, 'no_found_rows' => 1  ) ;
			$custom_slider = new WP_Query( $custom_slider_args );
		endif;

	?>
	
<?php if( tie_get_option('slider_type') == 'elastic' ): ?>

	<div id="ei-slider" class="ei-slider">
		<ul class="ei-slider-large">
		<?php $i= 0;
		
		foreach ($custom_slider as $post): setup_postdata($post);/*while ( $custom_slider_query->have_posts() ) : $custom_slider_query->the_post();*/
			$custom = get_post_custom($post->ID);
			$slider = unserialize( $custom["custom_slider"][0] );
			$number = count($slider);
				
			if( $slider ){
			foreach( $slider as $slide ): ?>	
			<li>
				<?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?>
				<img src="<?php echo tie_slider_img_src( $slide['id'] , 'slider' ) ?>" alt="<?php  echo stripslashes( $slide['title'] )  ?>" />
				<?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?>

				<?php if( !empty( $slide['title'] ) || !empty( $slide['caption'] ) ) :?>
				<div class="ei-title">
					<?php if( !empty( $slide['title'] ) ):?>
					<h2><?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?>
						<?php  echo stripslashes( $slide['title'] )  ?>
						<?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?>
					</h2>
					<?php endif; ?>
					<?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?>
					<?php if( !empty( $slide['caption'] ) ):?><h3><?php echo stripslashes($slide['caption']) ; ?></h3><?php endif; ?>
					<?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?>
				</div>
				<?php endif; ?>
			</li>
			<?php endforeach; ?>
			
		</ul>
		
		 <ul class="ei-slider-thumbs">
			<li class="ei-slider-element">Current</li>
			<?php $i= 0; foreach( $slider as $slide ): $i++; ?>	
				<li><a href="#">Slide <?php echo $i; ?></a><!-- <img src="<?php echo tie_slider_img_src($slide['id'] , 'tie-medium' ); ?>" alt="<?php  echo stripslashes( $slide['title'] )  ?>" /> --> </li>

			<?php endforeach; ?>
			
		</ul><!-- ei-slider-thumbs -->
	
	<?php
		}?>
		<?php /*endwhile;*/endforeach;?>
	</div>
	
	
<?php else: ?>
	
	
	<div id="flexslider" class="flexslider">
		<ul class="slides">
		<?php foreach ($custom_slider as $post): setup_postdata($post);/*while ( $custom_slider_query->have_posts() ) : $custom_slider_query->the_post();*/
			$custom = get_post_custom($post->ID);
			$slider = unserialize( $custom["custom_slider"][0] );
			$number = count($slider);
				
			if( $slider ){
			foreach( $slider as $slide ): ?>	
			<li>
				<?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?>
				<img src="<?php echo tie_slider_img_src( $slide['id'] , 'slider' ) ?>" alt="" />
				<?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?>
				<?php if( !empty( $slide['title'] ) || !empty( $slide['caption'] ) ) :?>
				<div class="slider-caption">
					<?php if( !empty( $slide['title'] ) ):?><h2><?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?><?php  echo stripslashes( $slide['title'] )  ?><?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?></h2><?php endif; ?>
					<?php if( !empty( $slide['caption'] ) ):?><p><?php echo stripslashes($slide['caption']) ; ?></p><?php endif; ?>
				</div>
				<?php endif; ?>
			</li>
			<?php endforeach; 
			}?>
		<?php /*endwhile;*/endforeach;?>
		</ul>
	</div>
	
<?php endif; 
 } 
	$post = $orig_post;
	wp_reset_query();
	
endif; ?>
