<?php
## widget_tabs
add_action( 'widgets_init', 'tie_widget_tabs_box' );
function tie_widget_tabs_box(){
	register_widget( 'tie_widget_tabs' );
}
class tie_widget_tabs extends WP_Widget {
	function tie_widget_tabs() {
		$widget_ops = array( 'description' => 'Most Popular, Recent, Comments, Tags'  );
		$this->WP_Widget( 'widget_tabs',theme_name .'- Tabbed  ', $widget_ops );
	}
	function widget( $args, $instance ) {
		
		if( empty($instance['posts_number']) || $instance['posts_number'] == ' ' || !is_numeric($instance['posts_number']))	$posts_number = 5;
		else $posts_number = $instance['posts_number'];
	?>
	<div class="widget" id="tabbed-widget">
		<div class="widget-container">
			<div class="widget-top">
				<ul class="tabs posts-taps">
					<li class="tabs"><a href="#tab1"><?php _e( 'Popular' , 'tie' ) ?></a></li>
					<li class="tabs"><a href="#tab2"><?php _e( 'Recent' , 'tie' ) ?></a></li>
					<li class="tabs"><a href="#tab3"><?php _e( 'Comments' , 'tie' ) ?></a></li>
					<li class="tabs" style="margin-left:0"><a href="#tab4"><?php _e( 'Tags' , 'tie' ) ?></a></li>
				</ul>
			</div>
			<div id="tab1" class="tabs-wrap">
				<ul>
					<?php tie_popular_posts( $posts_number ) ?>	
				</ul>
			</div>
			<div id="tab2" class="tabs-wrap">
				<ul>
					<?php tie_last_posts( $posts_number )?>	
				</ul>
			</div>
			<div id="tab3" class="tabs-wrap">
				<ul>
					<?php tie_most_commented( $posts_number );?>
				</ul>
			</div>
			<div id="tab4" class="tabs-wrap tagcloud">
				<?php wp_tag_cloud( $args = array('largest' => 8,'number' => 25,'orderby'=> 'count', 'order' => 'DESC' )); ?>
			</div>
		</div>
	</div><!-- .widget /-->
<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['posts_number'] = strip_tags( $new_instance['posts_number'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'posts_number' => 5 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'posts_number' ); ?>">Number of items to show : </label>
			<input id="<?php echo $this->get_field_id( 'posts_number' ); ?>" name="<?php echo $this->get_field_name( 'posts_number' ); ?>" value="<?php if( !empty($instance['posts_number']) ) echo $instance['posts_number']; ?>" size="3" type="text" />
		</p>


	<?php
	}
}
?>
