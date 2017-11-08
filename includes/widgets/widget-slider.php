<?php
add_action( 'widgets_init', 'tie_slider_widget' );
function tie_slider_widget() {
	register_widget( 'tie_slider' );
}
class tie_slider extends WP_Widget {

	function tie_slider() {
		$widget_ops = array( 'classname' => 'tie-slider' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'tie-slider-widget' );
		$this->WP_Widget( 'tie-slider-widget',theme_name .' - Slider', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$title_link = $instance['title_link'];		
		$enable_title_link = $instance['enable_title_link'];
		$tran_bg = $instance['tran_bg'];
		$no_of_posts = $instance['no_of_posts'];
		$cats_id = $instance['cats_id'];
		$custom_slider = $instance['custom_slider'];
			
		global $post;			
		if (empty($custom_slider)):
			global $last_15_days_posts;
			global $last_15_days_categories;

			$last_15_days_count = 0;
			$last_15_days_cat_posts;

			$post_categories = explode(',', $cats_id);
			foreach ($last_15_days_posts as $post):
				if (!$last_15_days_categories[$post->ID]):
					$last_15_days_categories[$post->ID] = implode(",", wp_get_post_categories($post->ID));
				endif;
	
				$in_cat = false;
				foreach ($post_categories as $post_cat):
					if (in_array($post_cat, explode(",", $last_15_days_categories[$post->ID]))):
						$in_cat = true;
						break;
					endif;
				endforeach;

				if ($last_15_days_count < $no_of_posts): 
					if ($in_cat):
						$last_15_days_count++;
						$last_15_days_cat_posts[] = $post;
					endif;
				else:
					break;
				endif;
			endforeach;
		endif;
	/* Old Query (decided to not display widget if there aren't posts in last 15 days) */
	/*	$argss= array('posts_per_page'=> $no_of_posts , 'category__in' => $cats_id, 'no_found_rows' => 1 );
		$featured_query = new WP_Query( $argss );*/
	?>

	<?php
		if (!empty($custom_slider) || $last_15_days_count > 0) {
			if (!$tran_bg) {
				echo '<div style="margin-bottom:25px;">';
				echo $before_title;
				if ($enable_title_link) {
					echo '<a href='.$title_link.'>';
					echo $title ; 
					echo '</a>';
				} else {
					echo $title ;
				}
				echo '</h4><div class="stripe-line"></div></div>
							<div class="widget-container" style="padding:0px;">';
			}
		}
	?> 
	<?php if( empty($custom_slider) ):
	if( $last_15_days_count > 0 ) : ?>

	<div class="flexslider" id="<?php echo $args['widget_id']; ?>">
		<ul class="slides">
		<?php foreach($last_15_days_cat_posts as $post): setup_postdata($post);?>
			<li>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
				<a href="<?php the_permalink(); ?>">
				<?php tie_thumb( 'tie-large' ); ?>
				</a>
			<?php endif; ?>
				<div class="slider-caption">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</div>
			</li>
		<?php endforeach;?>
		</ul>
	</div>
	<?php endif; ?>
	<?php else :
		global $last_15_days_posts;

		$last_15_days_custom_slider_posts;
		foreach ($last_15_days_posts as $post):
			if ($post->ID == $custom_slider && $post->post_type == 'tie_slider'):
				$last_15_days_custom_slider_posts[] = $post;
				break;
			endif;
		endforeach;

		$custom_slider_query;
		
		if (count($last_15_days_custom_slider_posts) > 0):
			$custom_slider_query = $last_15_days_custom_slider_posts;
		else:
			$custom_slider_args = array( 'post_type' => 'tie_slider', 'p' => $custom_slider, 'no_found_rows' => 1  ) ;
			$custom_slider_query = new WP_Query( $custom_slider_args );
		endif;
	?>
	<div class="flexslider" id="<?php echo $args['widget_id']; ?>">
		<ul class="slides">
		<?php foreach ($custom_slider_query as $post): setup_postdata($post);/*while ( $custom_slider_query->have_posts() ) : $custom_slider_query->the_post();*/
			$custom = get_post_custom($post->ID);
			$slider = unserialize( $custom["custom_slider"][0] );
			$number = count($slider);
				
			if( $slider ){
			foreach( $slider as $slide ): ?>	
			<li>
				<?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?>
				<img src="<?php echo tie_slider_img_src( $slide['id'] , 'tie-large' ) ?>" alt="" />
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
	<?php endif; ?>
	<?php if (!empty($custom_slider) || $last_15_days_count > 0) {
		if (!$tran_bg) {
			echo '</div></div>';
		} 
	}?> 
	<script>
	jQuery(document).ready(function() {
	  jQuery('#<?php echo $args['widget_id']; ?>').flexslider({
		animation: "fade",
		slideshowSpeed: 7000,
		animationSpeed: 600,
		randomize: false,
		pauseOnHover: true,
		prevText: "",
		nextText: "",
		controlNav: false
	  });
	});
	</script>
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['title_link'] = strip_tags( $new_instance['title_link'] );
		$instance['enable_title_link'] = strip_tags( $new_instance['enable_title_link'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['cat_posts_title'] = strip_tags( $new_instance['cat_posts_title'] );
		$instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
		$instance['custom_slider'] =  $new_instance['custom_slider'] ;
		
		$instance['cats_id'] = implode(',' , $new_instance['cats_id']  );

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'no_of_posts' => '5' , 'cats_id' => '1' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$categories_obj = get_categories();
		$categories = array();

		foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}
		
		$sliders = array();
		$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
		while ( $custom_slider->have_posts() ) {
			$custom_slider->the_post();
			$sliders[get_the_ID()] = get_the_title();
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'title_link' ); ?>">Title Link : </label>
			<input id="<?php echo $this->get_field_id( 'title_link' ); ?>" name="<?php echo $this->get_field_name( 'title_link' ); ?>" value="<?php if( !empty($instance['title_link']) ) echo $instance['title_link']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'enable_title_link' ); ?>">Enable Title Link :</label>
			<input id="<?php echo $this->get_field_id( 'enable_title_link' ); ?>" name="<?php echo $this->get_field_name( 'enable_title_link' ); ?>" value="true" <?php if( !empty( $instance['enable_title_link'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p> 

		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">Transparent Background :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>if this active the title will disappear</small>
		</p>

		
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>">Number of posts to show: </label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php if( !empty($instance['no_of_posts']) ) echo $instance['no_of_posts']; ?>" type="text" size="3" />
		</p>
		<p>
			<?php $cats_id = explode ( ',' , $instance['cats_id'] ) ; ?>
			<label for="<?php echo $this->get_field_id( 'cats_id' ); ?>">Category : </label>
			<select multiple="multiple" id="<?php echo $this->get_field_id( 'cats_id' ); ?>[]" name="<?php echo $this->get_field_name( 'cats_id' ); ?>[]">
				<?php foreach ($categories as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( in_array( $key , $cats_id ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		</p>
		<?php if(!empty($instance['custom_slider']))  $slider = $instance['custom_slider'] ; ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'custom_slider' ); ?>">Custom Slider : </label>
			<?php if( !empty($sliders) ):  ?>
			<select id="<?php echo $this->get_field_id( 'custom_slider' ); ?>" name="<?php echo $this->get_field_name( 'custom_slider' ); ?>">
				<option value="">Disable</option>
				<?php foreach ($sliders as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( !empty( $slider ) && ( $key == $slider ) )  { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
			<?php else: ?>
			<span style="color:#FF0000;">Add Custom sliders first .</span>
			<?php endif; ?>
		</p>
	<?php
	}
}
?>
