<?php
add_action( 'widgets_init', 'tie_authors_posts_widget' );
function tie_authors_posts_widget() {
	register_widget( 'tie_authors_posts' );
}
class tie_authors_posts extends WP_Widget {

	function tie_authors_posts() {
		$widget_ops = array( 'classname' => 'authors-posts' );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'authors-posts-widget' );
		$this->WP_Widget( 'authors-posts-widget',theme_name .' - Authors Posts', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$no_of_posts = $instance['no_of_posts'];
		$cats_id = $instance['cats_id'];
		$thumb = $instance['thumb'];

		echo $before_widget;
			echo $before_title;
			echo $title ; ?>
		<?php echo $after_title; ?>
				<ul>
					<?php tie_last_posts_cat_authors($no_of_posts , $thumb , $cats_id)?>	
				</ul>
		<div class="clear"></div>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
		
		$instance['cats_id'] = implode(',' , $new_instance['cats_id']  );

		$instance['thumb'] = strip_tags( $new_instance['thumb'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'Authors Posts' , 'tie'), 'no_of_posts' => '5' , 'cats_id' => '1' , 'thumb' => 'true' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$categories_obj = get_categories();
		$categories = array();

		foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>">Number of posts to show: </label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo $instance['no_of_posts']; ?>" type="text" size="3" />
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
		<p>
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>">Display Avatars : </label>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="true" <?php if( $instance['thumb'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>

	<?php
	}
}
?>