<?php
add_action( 'widgets_init', 'tie_login_widget_box' );
function tie_login_widget_box() {
	register_widget( 'tie_login_widget' );
}
class tie_login_widget extends WP_Widget {

	function tie_login_widget() {
		$widget_ops = array( 'classname' => 'login-widget'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'login-widget' );
		$this->WP_Widget( 'login-widget',theme_name .' - Login', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;
		echo $before_title;
		echo $title ; 
		echo $after_title;
		tie_login_form();
		echo $after_widget;
			
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('Login' , 'tie')  );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php  if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>



	<?php
	}
}
?>