<?php
add_action( 'widgets_init', 'tie_text_html_widget' );
function tie_text_html_widget() {
	register_widget( 'tie_text_html' );
}
class tie_text_html extends WP_Widget {

	function tie_text_html() {
		$widget_ops = array( 'classname' => 'text-html'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'text-html-widget' );
		$this->WP_Widget( 'text-html-widget',theme_name .' - Text or Html', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		if( function_exists('icl_t') )  $text_code = icl_t( theme_name , 'widget_content_'.$this->id , $instance['text_code'] ); else $text_code = $instance['text_code'] ;
		$tran_bg = $instance['tran_bg'];
		$center = $instance['center'];
		
		if ($center)
			$center = 'style="text-align:center;"';
		else
			$center = '';

		
		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
			echo '<div '.$center.'>';
			echo do_shortcode( $text_code ) .'
				</div><div class="clear"></div>';
			echo $after_widget;
		}
		else {?>
			<div <?php echo 'id="'.$args['widget_id'].'"'; ?> class="text-html-box" <?php echo $center ?>>
			<?php echo do_shortcode( $text_code ) ?>
			</div>
		<?php
		}			
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text_code'] = $new_instance['text_code'] ;
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['center'] = strip_tags( $new_instance['center'] );
		
		if (function_exists('icl_register_string')) {
			icl_register_string( theme_name , 'widget_content_'.$this->id, $new_instance['text_code'] );
		}
		
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('Text' , 'tie')  );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">Transparent Background :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>if this active the title will disappear</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'center' ); ?>">Center content :</label>
			<input id="<?php echo $this->get_field_id( 'center' ); ?>" name="<?php echo $this->get_field_name( 'center' ); ?>" value="true" <?php if( !empty( $instance['center'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_code' ); ?>">Text , Shortcodes or Html code : </label>
			<textarea rows="15" id="<?php echo $this->get_field_id( 'text_code' ); ?>" name="<?php echo $this->get_field_name( 'text_code' ); ?>" class="widefat" ><?php if( !empty( $instance['text_code'] ) ) echo $instance['text_code']; ?></textarea>
		</p>
		


	<?php
	}
}
?>