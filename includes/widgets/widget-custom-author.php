<?php
add_action( 'widgets_init', 'tie_Author_Bio_widget' );
function tie_Author_Bio_widget() {
	register_widget( 'tie_Author_Bio' );
}
class tie_Author_Bio extends WP_Widget {

	function tie_Author_Bio() {
		$widget_ops = array( 'classname' => 'Author-Bio' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'author-bio-widget' );
		$this->WP_Widget( 'author-bio-widget',theme_name .' - Custom Author Bio', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$img = $instance['img'];
		if( function_exists('icl_t') )  $text_code = icl_t( theme_name , 'widget_content_'.$this->id , $instance['text_code'] ); else $text_code = $instance['text_code'] ;
	
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title; ?>
			<div class="author-avatar">
				<img alt="" src="<?php echo $img; ?>">
			</div>
			<div class="author-description">
			<?php
			echo do_shortcode( $text_code ); ?>
			</div><div class="clear"></div>
			<?php
			echo $after_widget;
		
		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['img'] = $new_instance['img'] ;
		$instance['text_code'] = $new_instance['text_code'] ;
		
		if (function_exists('icl_register_string')) {
			icl_register_string( theme_name , 'widget_content_'.$this->id, $new_instance['text_code'] );
		}
		
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'About Author' , 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'img' ); ?>">Avatar : </label>
			<input id="<?php echo $this->get_field_id( 'img' ); ?>" name="<?php echo $this->get_field_name( 'img' ); ?>" value="<?php if( !empty($instance['img']) ) echo $instance['img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_code' ); ?>">About : <i>You can use Shortcodes</i></label>
			<textarea rows="15" id="<?php echo $this->get_field_id( 'text_code' ); ?>" name="<?php echo $this->get_field_name( 'text_code' ); ?>" class="widefat" ><?php if( !empty($instance['text_code']) ) echo $instance['text_code']; ?></textarea>
		</p>
		


	<?php
	}
}
?>