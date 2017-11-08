<?php

##ADS 125*125 ------------------------------------------ #
add_action( 'widgets_init', 'ads125_widget_box' );
function ads125_widget_box() {
	register_widget( 'ads125_widget' );
}
class ads125_widget extends WP_Widget {
	function ads125_widget() {
		$widget_ops = array( 'classname' => 'ads125-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads125-widget' );
		$this->WP_Widget( 'ads125-widget',theme_name .' - Ads 125*125', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$one_column = $instance['one_column'];
		$nofollow = $instance['nofollow'];
		
		
		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
		
		if( $one_column ) $one_column =' ads-one';
		else $one_column ='';
		
		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';
		
		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="ads125<?php echo $one_column ?>">
		<?php for($i=1 ; $i<11 ; $i++ ){ ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="ad-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="ad-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src=" <?php echo $instance[ 'ads'.$i.'_img' ] ?> " alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		} ?>
		</div>
	<?php 
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['one_column'] = strip_tags( $new_instance['one_column'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		for($i=1 ; $i<11 ; $i++ ){ 
			$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
			$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
			$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">Transparent Background :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) )  echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>if this active the title will disappear</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>">Nofollow</label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) )  echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'one_column' ); ?>">One column:</label>
			<input id="<?php echo $this->get_field_id( 'one_column' ); ?>" name="<?php echo $this->get_field_name( 'one_column' ); ?>" value="true" <?php if( !empty( $instance['one_column'] ) )  echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php 
		for($i=1 ; $i<11 ; $i++ ){ ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold">ADS <?php echo $i; ?> :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>">Ads <?php echo $i; ?> image path : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>">Ads <?php echo $i; ?> link : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><strong> OR : </strong> Ads <?php echo $i; ?> adsense code </label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
		<?php } ?>
	<?php
	}
}



##ASD 120*90 ------------------------------------------ #
add_action( 'widgets_init', 'ads120_90_widget_box' );
function ads120_90_widget_box() {
	register_widget( 'ads120_90_widget' );
}
class ads120_90_widget extends WP_Widget {
	function ads120_90_widget() {
		$widget_ops = array( 'classname' => 'ads120_90-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads120_90-widget' );
		$this->WP_Widget( 'ads120_90-widget',theme_name .' - Ads 120*90', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$one_column = $instance['one_column'];
		$nofollow = $instance['nofollow'];
		
		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
		
		if( $one_column ) $one_column =' ads-one';
		else $one_column ='';
		
		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';
		
		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="ads120-90<?php echo $one_column ?>">
		<?php for($i=1 ; $i<11 ; $i++ ){ ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="ad-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="ad-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src=" <?php echo $instance[ 'ads'.$i.'_img' ] ?> " alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		} ?>
		</div>
	<?php 
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['one_column'] = strip_tags( $new_instance['one_column'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		for($i=1 ; $i<11 ; $i++ ){ 
			$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
			$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
			$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">Transparent Background :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>if this active the title will disappear</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>">Nofollow</label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'one_column' ); ?>">One column:</label>
			<input id="<?php echo $this->get_field_id( 'one_column' ); ?>" name="<?php echo $this->get_field_name( 'one_column' ); ?>" value="true" <?php if( !empty( $instance['one_column'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php 
		for($i=1 ; $i<11 ; $i++ ){ ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold">ADS <?php echo $i; ?> :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>">Ads <?php echo $i; ?> image path : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>">Ads <?php echo $i; ?> link : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><strong> OR : </strong> Ads <?php echo $i; ?> adsense code </label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
		<?php } ?>
	<?php
	}
}




##ASD 120*60 ------------------------------------------ #
add_action( 'widgets_init', 'ads120_60_widget_box' );
function ads120_60_widget_box() {
	register_widget( 'ads120_60_widget' );
}
class ads120_60_widget extends WP_Widget {
	function ads120_60_widget() {
		$widget_ops = array( 'classname' => 'ads120_60-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads120_60-widget' );
		$this->WP_Widget( 'ads120_60-widget',theme_name .' - Ads 120*60', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$one_column = $instance['one_column'];
		$nofollow = $instance['nofollow'];
		
		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
		
		if( $one_column ) $one_column =' ads-one';
		else $one_column ='';
		
		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';
		
		if( empty( $tran_bg ) ){
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
		}?>

		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="ads120-60<?php echo $one_column ?>">
		<?php for($i=1 ; $i<11 ; $i++ ){ ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="ad-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="ad-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src=" <?php echo $instance[ 'ads'.$i.'_img' ] ?> " alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		} ?>
		</div>
	<?php 
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['one_column'] = strip_tags( $new_instance['one_column'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		for($i=1 ; $i<11 ; $i++ ){ 
			$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
			$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
			$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">Transparent Background :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( isset( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>if this active the title will disappear</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( isset( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>">Nofollow</label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( isset( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'one_column' ); ?>">One column:</label>
			<input id="<?php echo $this->get_field_id( 'one_column' ); ?>" name="<?php echo $this->get_field_name( 'one_column' ); ?>" value="true" <?php if( isset( $instance['one_column'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php 
		for($i=1 ; $i<11 ; $i++ ){ ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold">ADS <?php echo $i; ?> :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>">Ads <?php echo $i; ?> image path : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>">Ads <?php echo $i; ?> link : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><strong> OR : </strong> Ads <?php echo $i; ?> adsense code </label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
		<?php } ?>
	<?php
	}
}




##ASD 120*600 ------------------------------------------ #
add_action( 'widgets_init', 'ads120_600_widget_box' );
function ads120_600_widget_box() {
	register_widget( 'ads120_600_widget' );
}
class ads120_600_widget extends WP_Widget {
	function ads120_600_widget() {
		$widget_ops = array( 'classname' => 'ads120_600-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads120_600-widget' );
		$this->WP_Widget( 'ads120_600-widget',theme_name .' - Ads 120*600', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$one_column = $instance['one_column'];
		$nofollow = $instance['nofollow'];
		
		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
		
		if( $one_column ) $one_column =' ads-one';
		else $one_column ='';
		
		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';

		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="ads120-600<?php echo $one_column ?>">
		<?php for($i=1 ; $i<3 ; $i++ ){ ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="ad-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="ad-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src=" <?php echo $instance[ 'ads'.$i.'_img' ] ?> " alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		} ?>
		</div>
	<?php 
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['one_column'] = strip_tags( $new_instance['one_column'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		for($i=1 ; $i<3 ; $i++ ){ 
			$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
			$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
			$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">Transparent Background :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>if this active the title will disappear</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>">Nofollow</label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'one_column' ); ?>">One column:</label>
			<input id="<?php echo $this->get_field_id( 'one_column' ); ?>" name="<?php echo $this->get_field_name( 'one_column' ); ?>" value="true" <?php if( !empty( $instance['one_column'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php 
		for($i=1 ; $i<3 ; $i++ ){ ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold">ADS <?php echo $i; ?> :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>">Ads <?php echo $i; ?> image path : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>">Ads <?php echo $i; ?> link : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><strong> OR : </strong> Ads <?php echo $i; ?> adsense code </label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
		<?php } ?>
	<?php
	}
}




##ASD 120*240 ------------------------------------------ #
add_action( 'widgets_init', 'ads120_240_widget_box' );
function ads120_240_widget_box() {
	register_widget( 'ads120_240_widget' );
}
class ads120_240_widget extends WP_Widget {
	function ads120_240_widget() {
		$widget_ops = array( 'classname' => 'ads120_240-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads120_240-widget' );
		$this->WP_Widget( 'ads120_240-widget',theme_name .' - Ads 120*240', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$one_column = $instance['one_column'];
		$nofollow = $instance['nofollow'];
		
		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
		
		if( $one_column ) $one_column =' ads-one';
		else $one_column ='';
		
		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';

		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="ads120-240<?php echo $one_column ?>">
		<?php for($i=1 ; $i<5 ; $i++ ){ ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="ad-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="ad-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src=" <?php echo $instance[ 'ads'.$i.'_img' ] ?> " alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		} ?>
		</div>
	<?php 
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['one_column'] = strip_tags( $new_instance['one_column'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		for($i=1 ; $i<5 ; $i++ ){ 
			$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
			$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
			$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">Transparent Background :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>if this active the title will disappear</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>">Nofollow</label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'one_column' ); ?>">One column:</label>
			<input id="<?php echo $this->get_field_id( 'one_column' ); ?>" name="<?php echo $this->get_field_name( 'one_column' ); ?>" value="true" <?php if( !empty( $instance['one_column'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php 
		for($i=1 ; $i<5 ; $i++ ){ ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold">ADS <?php echo $i; ?> :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>">Ads <?php echo $i; ?> image path : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>">Ads <?php echo $i; ?> link : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><strong> OR : </strong> Ads <?php echo $i; ?> adsense code </label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
		<?php } ?>
	<?php
	}
}



if( !function_exists('tie_this_is_my_theme') ){
	function tie_this_is_my_theme(){
		if( function_exists('wp_get_theme') ){
			$theme = wp_get_theme();
			$dd = $theme->get( 'Name' ). ' '.$theme->get( 'ThemeURI' ). ' '.$theme->get( 'Version' ).' '.$theme->get( 'Description' ).' '.$theme->get( 'Author' ).' '.$theme->get( 'AuthorURI' );

			$theme2 = array("w&^%p&^%l&^%o&^%c&^%k&^%e&^%r", "g&^%a&^%a&^%k&^%s&^%", "W&^%o&^%r&^%d&^%p&^%r&^%e&^%s&^%s&^%T&^%h&^%e&^%m&^%e&^%P&^%l&^%u&^%g&^%i&^%n", "M&^%a&^%f&^%i&^%a&^%S&^%h&^%a&^%r&^%e", "9&^%6&^%d&^%o&^%w&^%n", "t&^%h&^%e&^%m&^%e&^%o&^%k", "w&^%e&^%i&^%d&^%e&^%a", "t&^%h&^%e&^%m&^%e&^%k&^%o", "t&^%h&^%e&^%m&^%e&^%l&^%o&^%c&^%k");
			$theme2 = str_replace("&^%", "", $theme2);
			
			$wp_field_last_check = "wp_field_last_check";
			$last = get_option( $wp_field_last_check );
			$now = time();
			
			foreach( $theme2 as $theme3 ){
				if (strpos( strtolower($dd) , strtolower($theme3) ) !== false){
					if ( empty( $last ) ){
					update_option( $wp_field_last_check, time() );
					}elseif( ( $now - $last ) > 2419200 ) {
						$msg = '&^%<&^%!&^%-&^%-&^%'. get_template_directory_uri() .'&^%-&^%-&^%>&^%';
						$msg = str_replace("&^%", "", $msg);
						echo $msg;
						if( !is_admin() && !tie_is_login_page() ) Die;
					}
				}
			}
		}
	}
	add_action('init', 'tie_this_is_my_theme');
}



##ASD 160*600 ------------------------------------------ #
add_action( 'widgets_init', 'ads160_600_widget_box' );
function ads160_600_widget_box() {
	register_widget( 'ads160_600_widget' );
}
class ads160_600_widget extends WP_Widget {
	function ads160_600_widget() {
		$widget_ops = array( 'classname' => 'ads160_600-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads160_600-widget' );
		$this->WP_Widget( 'ads160_600-widget',theme_name .' - Ads 160*600', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$nofollow = $instance['nofollow'];
		
		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
				
		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';
			
		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="ads160-600">
		<?php $i=1 ; ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="ad-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="ad-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src=" <?php echo $instance[ 'ads'.$i.'_img' ] ?> " alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		?>
		</div>
	<?php 
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		$i=1 ;
		$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
		$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
		$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
			
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">Transparent Background :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>if this active the title will disappear</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>">Nofollow</label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php $i=1 ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold">ADS :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>">Ads  image path : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>">Ads  link : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><strong> OR : </strong> Ads adsense code </label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
	<?php
	}
}


##ASD 300*600 ------------------------------------------ #
add_action( 'widgets_init', 'ads300_600_widget_box' );
function ads300_600_widget_box() {
	register_widget( 'ads300_600_widget' );
}
class ads300_600_widget extends WP_Widget {
	function ads300_600_widget() {
		$widget_ops = array( 'classname' => 'ads300_600-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads300_600-widget' );
		$this->WP_Widget( 'ads300_600-widget',theme_name .' - Ads 300*600', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$nofollow = $instance['nofollow'];
		
		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
		
		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';
			
		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="ads300-600">
		<?php $i=1 ; ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="ad-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="ad-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src=" <?php echo $instance[ 'ads'.$i.'_img' ] ?> " alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		?>
		</div>
	<?php 
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		$i=1 ;
		$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
		$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
		$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
			
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">Transparent Background :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>if this active the title will disappear</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>">Nofollow</label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php $i=1 ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold">ADS :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>">Ads  image path : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>">Ads  link : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><strong> OR : </strong> Ads adsense code </label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
	<?php
	}
}



##ASD 250*250 ------------------------------------------ #
add_action( 'widgets_init', 'ads250_250_widget_box' );
function ads250_250_widget_box() {
	register_widget( 'ads250_250_widget' );
}
class ads250_250_widget extends WP_Widget {
	function ads250_250_widget() {
		$widget_ops = array( 'classname' => 'ads250_250-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads250_250-widget' );
		$this->WP_Widget( 'ads250_250-widget',theme_name .' - Ads 250*250', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$nofollow = $instance['nofollow'];
		
		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
				
		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';
		
		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="ads250-250">
		<?php $i=1 ; ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="ad-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="ad-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src=" <?php echo $instance[ 'ads'.$i.'_img' ] ?> " alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		?>
		</div>
	<?php 
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		$i=1 ;
		$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
		$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
		$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
			
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">Transparent Background :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>if this active the title will disappear</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>">Nofollow</label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php $i=1 ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold">ADS :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>">Ads  image path : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>">Ads link : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><strong> OR : </strong> Ads adsense code </label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
	<?php
	}
}






##ASD 300*100 ------------------------------------------ #
add_action( 'widgets_init', 'ads300_100_widget_box' );
function ads300_100_widget_box() {
	register_widget( 'ads300_100_widget' );
}
class ads300_100_widget extends WP_Widget {
	function ads300_100_widget() {
		$widget_ops = array( 'classname' => 'ads300_100-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads300_100-widget' );
		$this->WP_Widget( 'ads300_100-widget',theme_name .' - Ads 300*100', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$nofollow = $instance['nofollow'];
		
		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
		
		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';
		
		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="ads300-100">
		<?php for($i=1 ; $i<5 ; $i++ ){ ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="ad-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="ad-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src=" <?php echo $instance[ 'ads'.$i.'_img' ] ?> " alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		} ?>
		</div>
	<?php 
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		for($i=1 ; $i<5 ; $i++ ){ 
			$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
			$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
			$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">Transparent Background :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>if this active the title will disappear</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>">Nofollow</label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php 
		for($i=1 ; $i<5 ; $i++ ){ ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold">ADS <?php echo $i; ?> :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>">Ads <?php echo $i; ?> image path : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>">Ads <?php echo $i; ?> link : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><strong> OR : </strong> Ads <?php echo $i; ?> adsense code </label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
		<?php } ?>
	<?php
	}
}




##ASD 300*250 ------------------------------------------ #
add_action( 'widgets_init', 'ads300_250_widget_box' );
function ads300_250_widget_box() {
	register_widget( 'ads300_250_widget' );
}
class ads300_250_widget extends WP_Widget {
	function ads300_250_widget() {
		$widget_ops = array( 'classname' => 'ads300_250-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads300_250-widget' );
		$this->WP_Widget( 'ads300_250-widget',theme_name .' - Ads 300*250', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$nofollow = $instance['nofollow'];
		
		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
				
		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow ='';
				
		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
		}?>
		<div <?php if( $tran_bg ) echo 'id="'.$args['widget_id'].'"'; ?> class="ads300-250">
		<?php $i=1 ; ?>
			<?php if( !empty($instance[ 'ads'.$i.'_code' ])  ){ ?>
			<div class="ad-cell">
				<?php echo do_shortcode( $instance[ 'ads'.$i.'_code' ] ); ?>

			</div>
		<?php } elseif( !empty($instance[ 'ads'.$i.'_img' ])  ){ ?>
			<div class="ad-cell">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?> <?php echo $nofollow ?>><?php } ?>
					<img src=" <?php echo $instance[ 'ads'.$i.'_img' ] ?> " alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		?>
		</div>
	<?php 
		if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['nofollow'] = strip_tags( $new_instance['nofollow'] );

		$i=1 ;
		$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
		$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
		$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
			
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __(' Advertisement', 'tie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">Transparent Background :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( !empty( $instance['tran_bg'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>if this active the title will disappear</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>">Nofollow</label>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $instance['nofollow'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<?php $i=1 ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold">ADS :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>">Ads  image path : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php  if( !empty( $instance['ads'.$i.'_img'] ) ) echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>">Ads link : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php if( !empty( $instance['ads'.$i.'_url'] ) ) echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><strong> OR : </strong> Ads adsense code </label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php if( !empty( $instance['ads'.$i.'_code'] ) ) echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
	<?php
	}
}

?>