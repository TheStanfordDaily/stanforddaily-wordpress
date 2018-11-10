<?php

/*******************************************/
/**                                       **/
/**                WIDGET                 **/
/**                                       **/
/*******************************************/
// register Soundcloud_Is_Gold_Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "soundcloud_is_gold_widget" );' ) );
class Soundcloud_Is_Gold_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'soundcloud_is_gold_widget', // Base ID
			'Soundcloud is Gold', // Name
			array( 'description' => __( 'Show your Latest Tracks, Favorites or Playlists for one or multiple users. If you\'re crasy go random for everything!', 'soundcloud-is-gold' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$user = $instance['user'];
		$autoplay = $instance['autoplay'] ? 'true' : 'false';
		$comments = $instance['comments'] ? 'true' : 'false';
		$artwork = $instance['artwork'] ? 'true' : 'false';
    $visual = $instance['visual'] ? 'true' : 'false';
    $mini = $instance['mini'] ? 'true' : 'false';
		$classes = $instance['classes'];
		$widthType = $instance['type'];
		$wp = $instance['wp'];
		$custom = $instance['custom'];
		$width = ($widthType == 'wp') ? $wp : $custom;
    $height = $instance['square'] ? 'true' : 'false';
    $playlistHeight = $instance['playlistHeight'];
		$behavior = $instance['behavior'];
		$number = $instance['number'];
		$format = $instance['format'];

    //Fix for people updating from 2.3.3 when widgets settings were using "sets" for "playlists"
    if($format == 'sets' || $format == 'set') $format = 'playlists';

		//Random User
		if($user == "randomUser") {
			$options = get_option('soundcloud_is_gold_options');
      //Fix bug when updating to 2.4.2 where API requests can only use user id
      $options = soundcloud_is_gold_update_users($options);
  		//Pick Random User
			$soundcloudIsGoldUsers = isset($options['soundcloud_is_gold_users']) ? array_random($options['soundcloud_is_gold_users'], 1) : '';
			//printl($soundcloudIsGoldUsers[0][0]);
			if(isset($soundcloudIsGoldUsers))  $user = $soundcloudIsGoldUsers[0][0];
		}

		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;

		//Random User per Track
		if($user == "randomUsers") {
			$options = get_option('soundcloud_is_gold_options');
      //Fix bug when updating to 2.4.2 where API requests can only use user id
      $options = soundcloud_is_gold_update_users($options);
  		//Set Random User per Track
			if(isset($options['soundcloud_is_gold_users'])){
				//Never select more tracks than there is users.
				$number = (count($options['soundcloud_is_gold_users']) <= $number) ? count($options['soundcloud_is_gold_users']) : $number;
				$soundcloudIsGoldUsers = array_random($options['soundcloud_is_gold_users'], $number);
			}
			if(isset($soundcloudIsGoldUsers)){
				foreach($soundcloudIsGoldUsers as $userKey=>$user){
					if($userKey == 1) $autoplay = false;
					foreach(get_soundcloud_is_gold_multiple_tracks_id($user[0], 1, ($behavior == "latest") ? FALSE : TRUE, $format) as $key=>$ids){
						if($format == "favorites") $format = "tracks"; //Soundcloud treats Favorites as Tracks for the player.
            echo soundcloud_is_gold_player($ids, NULL, $autoplay, $comments, $width, $height, $playlistHeight, $classes, NULL, $artwork, $visual, $mini, $format);
					}
				}
			}
		}
		//One User
		else{
			foreach(get_soundcloud_is_gold_multiple_tracks_id($user, $number, ($behavior == "latest") ? FALSE : TRUE, $format) as $key=>$ids){
				if($key == 1) $autoplay = false;
				if($format == "favorites") $format = "tracks"; //Soundcloud treats Favorites as Tracks for the player.
        echo soundcloud_is_gold_player($ids, NULL, $autoplay, $comments, $width, $height, $playlistHeight, $classes, NULL, $artwork, $visual, $mini, $format);
			}
		}

		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['user'] = strip_tags( $new_instance['user'] );
		$instance['format'] = strip_tags( $new_instance['format'] );
		$instance['behavior'] = strip_tags( $new_instance['behavior'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		$instance['autoplay'] = strip_tags( $new_instance['autoplay'] );
		$instance['comments'] = strip_tags( $new_instance['comments'] );
		$instance['artwork'] = strip_tags( $new_instance['artwork'] );
    $instance['visual'] = strip_tags( $new_instance['visual'] );
    $instance['mini'] = strip_tags( $new_instance['mini'] );
		$instance['classes'] = strip_tags( $new_instance['classes'] );
		$instance['type'] = strip_tags( $new_instance['type'] );
		$instance['wp'] = strip_tags( $new_instance['wp'] );
		$instance['custom'] = strip_tags( $new_instance['custom'] );
    $instance['square'] = strip_tags( $new_instance['square'] );
    $instance['playlistHeight'] = strip_tags( $new_instance['playlistHeight'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Latest', 'soundcloud-is-gold' );
		}
    //Get Plugin Options
    $options = get_option('soundcloud_is_gold_options');
    //Fix bug when updating to 2.4.2 where API requests can only use user id
    $options = soundcloud_is_gold_update_users($options);
		?>
		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'soundcloud-is-gold'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<!-- Users -->
		<p>
			<label for="<?php echo $this->get_field_id('user'); ?>"><?php _e( 'Username:', 'soundcloud-is-gold' ); ?></label>
			<select name="<?php echo $this->get_field_name('user'); ?>" id="<?php echo $this->get_field_id('user'); ?>" class="widefat">
				<?php
				foreach($options['soundcloud_is_gold_users'] as $user) : ?>
					<option value="<?php echo $user[0] ?>"<?php selected( $instance['user'], $user[0] ); ?>><?php _e($user[1]); ?></option>
				<?php endforeach; ?>
				<option value="randomUser"<?php selected( $instance['user'], "randomUser" ); ?>><?php _e("Pick a Random User", 'soundcloud-is-gold'); ?></option>
				<option value="randomUsers"<?php selected( $instance['user'], "randomUsers" ); ?>><?php _e("Pick a Random User per Track", 'soundcloud-is-gold'); ?></option>
			</select>
		</p>
		<!-- Main options -->
		<?php
			$autoplay = (isset($instance['autoplay']) && $instance['autoplay']) ? 'checked="checked"' : '';
			$comments = (isset($instance['comments']) && $instance['comments']) ? 'checked="checked"' : '';
			$artwork = (isset($instance['artwork']) && $instance['artwork']) ? 'checked="checked"' : '';
      $visual = (isset($instance['visual']) && $instance['visual']) ? 'checked="checked"' : '';
      $mini = (isset($instance['mini']) && $instance['mini']) ? 'checked="checked"' : '';
		?>
		<p>
			<label for=""><?php _e( 'Settings:', 'soundcloud-is-gold' ); ?></label>
			<select name="<?php echo $this->get_field_name('format'); ?>" id="<?php echo $this->get_field_id('format'); ?>" class="widefat">
				<option value="tracks"<?php selected( $instance['format'], "tracks" ); ?>><?php _e("tracks", 'soundcloud-is-gold'); ?></option>
				<option value="favorites"<?php selected( $instance['format'], "favorites" ); ?>><?php _e("favorites", 'soundcloud-is-gold'); ?></option>
				<option value="playlists"<?php selected( $instance['format'], "playlists" ); ?>><?php _e("playlists", 'soundcloud-is-gold'); ?></option>
			</select>
			<br/>
			<br/>
			<select name="<?php echo $this->get_field_name('behavior'); ?>" id="<?php echo $this->get_field_id('behavior'); ?>" class="widefat">
				<option value="latest"<?php selected( $instance['behavior'], "latest" ); ?>><?php _e("Latest", 'soundcloud-is-gold'); ?></option>
				<option value="random"<?php selected( $instance['behavior'], "random" ); ?>><?php _e("Random", 'soundcloud-is-gold'); ?></option>
			</select>
			<br/>
			<br/>
			<select name="<?php echo $this->get_field_name('number'); ?>" id="<?php echo $this->get_field_id('number'); ?>" class="widefat">
				<?php
				for($i=1; $i<=10; $i++) : ?>
					<option value="<?php echo $i ?>"<?php selected( $instance['number'], $i ); ?>><?php _e($i); ?></option>
				<?php endfor; ?>
			</select>
			<br/>
			<br/>
			<input class="checkbox" type="checkbox" <?php echo $autoplay; ?> id="<?php echo $this->get_field_id('autoplay'); ?>" name="<?php echo $this->get_field_name('autoplay'); ?>" /> <label for="<?php echo $this->get_field_id('autoplay'); ?>"><?php _e('Play Automatically', 'soundcloud-is-gold'); ?></label>
			<br/>
			<input class="checkbox" type="checkbox" <?php echo $comments; ?> id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" /> <label for="<?php echo $this->get_field_id('comments'); ?>"><?php _e('Show comments', 'soundcloud-is-gold'); ?></label>
			<br/>
			<input class="checkbox" type="checkbox" <?php echo $artwork; ?> id="<?php echo $this->get_field_id('artwork'); ?>" name="<?php echo $this->get_field_name('artwork'); ?>" /> <label for="<?php echo $this->get_field_id('artwork'); ?>"><?php _e('Show Artwork', 'soundcloud-is-gold', 'soundcloud-is-gold'); ?></label>
      <br/>
      <input class="checkbox" type="checkbox" <?php echo $visual; ?> id="<?php echo $this->get_field_id('visual'); ?>" name="<?php echo $this->get_field_name('visual'); ?>" /> <label for="<?php echo $this->get_field_id('visual'); ?>"><?php _e('Full Visual <small>(use soundcloud colors)</small>', 'soundcloud-is-gold'); ?></label>
      <br/>
      <input class="checkbox" type="checkbox" <?php echo $mini; ?> id="<?php echo $this->get_field_id('mini'); ?>" name="<?php echo $this->get_field_name('mini'); ?>" /> <label for="<?php echo $this->get_field_id('mini'); ?>"><?php _e('Force Mini Player <small>(Artwork and comments won\'t show)</small>', 'soundcloud-is-gold'); ?></label>
    </p>
		<!-- Width -->
		<?php

		?>
    </br>
		<p>
			<label for=""><?php _e( 'Width:', 'soundcloud-is-gold' ); ?></label>
			<p>
				<input type="radio" <?php checked( $instance['type'], "wp" ); ?> value="wp" id="wp" name="<?php echo $this->get_field_name('type'); ?>" /><label for="wp"><?php _e('Media Width', 'soundcloud-is-gold') ?></label>
				<br/>
				<select name="<?php echo $this->get_field_name('wp'); ?>" id="<?php echo $this->get_field_id('wp'); ?>" class="widefat">
				<?php foreach(get_soundcloud_is_gold_wordpress_sizes() as $key => $soundcloudIsGoldMediaSize) : ?>
					<option value="<?php echo $soundcloudIsGoldMediaSize[0]?>" <?php selected( $instance['wp'], $soundcloudIsGoldMediaSize[0] ); ?>><?php _e($key.': '.$soundcloudIsGoldMediaSize[0]); ?></option>
				<?php endforeach; ?>
				</select>
			</p>
			<p>
				<input type="radio" <?php checked( $instance['type'], "custom" ); ?> value="custom" id="custom" name="<?php echo $this->get_field_name('type'); ?>" /><label for="custom"><?php _e('Custom Width', 'soundcloud-is-gold') ?></label>
				<br/>
				<input type="text" value="<?php echo $instance['custom'] ? $instance['custom'] : "100%" ?>" id="<?php echo $this->get_field_id('custom'); ?>" name="<?php echo $this->get_field_name('custom'); ?>"/>
			</p>
    </p>
  </br>
    <p>
      <label for=""><?php _e( 'Height:', 'soundcloud-is-gold' ); ?></label>
      <p>
      <label for="<?php echo $this->get_field_id('playlistHeight'); ?>"><?php _e('Playlist Height <small>(leave empty for default, can\'t be less than 300px)</small>', 'soundcloud-is-gold'); ?></label>
      <input type="text" value="<?php echo $instance['playlistHeight'] ? $instance['playlistHeight'] : "" ?>" id="<?php echo $this->get_field_id('playlistHeight'); ?>" name="<?php echo $this->get_field_name('playlistHeight'); ?>"/>
      </p>
      <p>
      <?php $square = (isset($instance['square']) && $instance['square']) ? 'checked="checked"' : ''; ?>
			<input class="checkbox" type="checkbox" <?php echo $square; ?> id="<?php echo $this->get_field_id('square'); ?>" name="<?php echo $this->get_field_name('square'); ?>" /> <label for="<?php echo $this->get_field_id('square'); ?>"><?php _e('Force Square Player <small>(Visual)</small>', 'soundcloud-is-gold'); ?></label>
      </p>
		</p>
    </br>
		<!-- Classes -->
		<p>
			<label for="<?php echo $this->get_field_id('classes'); ?>"><?php _e( 'CSS Classes <small>(no commas)</small>:', 'soundcloud-is-gold' ); ?></label>
			<input type="text" value="<?php echo $instance['classes'] ?>" id="<?php echo $this->get_field_id('classes'); ?>" name="<?php echo $this->get_field_name('classes'); ?>"/>
		</p>
		<?php
	}

} // class Foo_Widget
?>
