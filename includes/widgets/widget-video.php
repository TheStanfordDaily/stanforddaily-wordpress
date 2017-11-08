<?php

add_action( 'widgets_init', 'tie_video_widget_box' );
function tie_video_widget_box() {
	register_widget( 'tie_video_widget' );
}
class tie_video_widget extends WP_Widget {

	function tie_video_widget() {
		$widget_ops = array( 'classname' => 'video-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'video-widget' );
		$this->WP_Widget( 'video-widget',theme_name .' - Video', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );

		if( !empty($instance['embed_code']) ){
			$embed_code = $instance['embed_code'];
			$width = 'width="100%"';
			$height = 'height="210"';
			$embed_code = preg_replace('/width="([3-9][0-9]{2,}|[1-9][0-9]{3,})"/',$width,$embed_code);
			$embed_code = preg_replace( '/height="([0-9]*)"/' , $height , $embed_code );
				
			$width1 = 'width: 100%';
			$height1 = 'height: 210';
			$embed_code = preg_replace('/width:"([3-9][0-9]{2,}|[1-9][0-9]{3,})"/',$width1,$embed_code);
			$embed_code = preg_replace( '/height: ([0-9]*)/' , $height1 , $embed_code );  
		}
		
		echo $before_widget;
		if ( $title )
			echo $before_title;
			echo $title ; ?>
		<?php echo $after_title; ?>
		
		<?php if ( !empty( $embed_code ) ): echo $embed_code ?>

		<?php elseif ( !empty( $instance['youtube_video'] ) ):?>
			<iframe width="100%" height="210" src="http://www.youtube.com/embed/<?php echo $instance['youtube_video'] ?>?rel=0&wmode=opaque&showinfo=0" frameborder="0" allowfullscreen></iframe>
		<?php elseif ( !empty( $instance['vimeo_video'] ) ):?>
			<iframe src="http://player.vimeo.com/video/<?php echo $instance['vimeo_video'] ?>?wmode=opaque" width="100%" height="210" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		<?php endif; ?>
		
		
		
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['embed_code'] = $new_instance['embed_code'] ;
		$instance['youtube_video'] = strip_tags( $new_instance['youtube_video'] );
		$instance['vimeo_video'] = strip_tags( $new_instance['vimeo_video'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__(' Featured Video', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'embed_code' ); ?>">Embed Code : </label>
			<textarea id="<?php echo $this->get_field_id( 'embed_code' ); ?>" name="<?php echo $this->get_field_name( 'embed_code' ); ?>" class="widefat" ><?php if( !empty( $instance['embed_code'] ) ) echo $instance['embed_code']; ?></textarea>
		</p>
		<em style="display:block; border-bottom:1px solid #CCC; margin-bottom:15px;">OR</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube_video' ); ?>">Youtube Video ID : </label>
			<input id="<?php echo $this->get_field_id( 'youtube_video' ); ?>" name="<?php echo $this->get_field_name( 'youtube_video' ); ?>" value="<?php if( !empty( $instance['youtube_video'] ) ) echo $instance['youtube_video']; ?>" class="widefat" type="text" />
			<small>if video url : http://www.youtube.com/watch?v=UjXi6X-moxE  Enter above <strong>UjXi6X-moxE</strong></small>
		</p>
		<em style="display:block; border-bottom:1px solid #CCC; margin-bottom:15px;">OR</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'vimeo_video' ); ?>">Vimeo Video ID : </label>
			<input id="<?php echo $this->get_field_id( 'vimeo_video' ); ?>" name="<?php echo $this->get_field_name( 'vimeo_video' ); ?>" value="<?php if( !empty( $instance['vimeo_video'] ) ) echo $instance['vimeo_video']; ?>" class="widefat" type="text" />
			<small>if video url : http://vimeo.com/6184227  Enter above <strong>6184227</strong></small>
		</p>


	<?php
	}
}
?>
