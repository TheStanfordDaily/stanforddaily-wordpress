<?php
## Reviews Widget
add_action( 'widgets_init', 'tie_review_widget_box' );
function tie_review_widget_box() {
	register_widget( 'tie_review_widget' );
}
class tie_review_widget extends WP_Widget {

	function tie_review_widget() {
		$widget_ops = array( 'classname' => 'review-widget'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'review-widget' );
		$this->WP_Widget( 'review-widget',theme_name .' - Review Box', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		global $post ;
		$get_meta = get_post_custom($post->ID);
		if ( is_single() && !empty( $get_meta['tie_review_position'][0] )) :
				
			$title = apply_filters('widget_title', $instance['title'] );
			$page_url = $instance['page_url'];

			echo $before_widget;
			if ( $title )
				echo $before_title;
			echo $title ;
			echo $after_title;
			tie_get_review( 'review-bottom' );
			echo $after_widget;
		endif;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_url'] = strip_tags( $new_instance['page_url'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'Review Overview' , 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p><em style="color:red;">This Widget appears in single post only .</em></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

	<?php
	}
}

?>