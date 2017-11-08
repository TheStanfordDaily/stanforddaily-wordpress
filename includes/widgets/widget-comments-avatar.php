<?php
add_action( 'widgets_init', 'tie_comments_avatar_widget' );
function tie_comments_avatar_widget() {
	register_widget( 'tie_comments_avatar' );
}
class tie_comments_avatar extends WP_Widget {

	function tie_comments_avatar() {
		$widget_ops = array( 'classname' => 'comments-avatar' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'comments_avatar-widget' );
		$this->WP_Widget( 'comments_avatar-widget',theme_name .' - Recent Comments with avatar', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$no_of_comments = $instance['no_of_comments'];
		$avatar_size = $instance['avatar_size'];

		echo $before_widget;
		if ( $title )
			echo $before_title;
			echo $title ; ?>
		<?php echo $after_title; ?>
			<ul>	
		<?php tie_most_commented( $no_of_comments , $avatar_size); ?>
		</ul>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['no_of_comments'] = strip_tags( $new_instance['no_of_comments'] );
		$instance['avatar_size'] = strip_tags( $new_instance['avatar_size'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'Recent Comments' , 'tie'), 'no_of_comments' => '5' , 'avatar_size' => '50' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'avatar_size' ); ?>"> Avatar Size : </label>
			<input id="<?php echo $this->get_field_id( 'avatar_size' ); ?>" name="<?php echo $this->get_field_name( 'avatar_size' ); ?>" value="<?php echo $instance['avatar_size']; ?>"  type="text" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_comments' ); ?>">Number of comments to show:  </label>
			<input id="<?php echo $this->get_field_id( 'no_of_comments' ); ?>" name="<?php echo $this->get_field_name( 'no_of_comments' ); ?>" value="<?php echo $instance['no_of_comments']; ?>" type="text" size="3" />
		</p>


	<?php
	}
}
?>