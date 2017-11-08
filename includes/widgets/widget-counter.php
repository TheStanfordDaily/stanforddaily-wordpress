<?php
add_action( 'widgets_init', 'tie_counter_widget_box' );
function tie_counter_widget_box() {
	register_widget( 'tie_counter_widget' );
}
class tie_counter_widget extends WP_Widget {

	function tie_counter_widget() {
		$widget_ops = array( 'classname' => 'counter-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'counter-widget' );
		$this->WP_Widget( 'counter-widget',theme_name .' - Social Counter', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {

		$facebook_page = @$instance['facebook'] ;
		$rss_id = @$instance['rss'] ;
		$twitter_id =  @$instance['twitter'] ;
		$youtube_url = @$instance['youtube'] ;
		$vimeo_url = @$instance['vimeo'] ;
		$dribbble_url = @$instance['dribbble'];
		$soundcloud_url = @$instance['soundcloud'];
		$soundcloud_api = @$instance['soundcloud_api'];
		$behance_url = @$instance['behance'];
		$behance_api = @$instance['behance_api'];
		$instagram_url = @$instance['instagram'];
		$instagram_api = @$instance['instagram_api'];
		$new_window = @$instance['new_window'];

		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
				
		$counter = 0;
		if( $rss_id ) $counter ++ ;
		if( $twitter_id ) $counter ++ ;
		if( $facebook_page ) $counter ++ ;
		if( $youtube_url ) $counter ++ ;
		if( $vimeo_url ) $counter ++ ;
		if( $dribbble_url ) $counter ++ ;
		if( $soundcloud_url ) $counter ++ ;
		if( $behance_url ) $counter ++ ;
		if( $instagram_url ) $counter ++ ;

		?>
		<div class="widget widget-counter col<?php echo $counter; ?>">
			<ul>
			<?php if( $rss_id ): ?>
				<li class="rss-subscribers">
					<a href="<?php echo $rss_id ?>"<?php echo $new_window ?>>
						<strong class="tieicon-rss"></strong>
						<span><?php _e('Subscribe' , 'tie' ) ?><?php __('Subscribers' , 'tie' ) ?></span>
						<small><?php _e('To RSS Feed' , 'tie' ) ?></small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $twitter_id ):
					$twitter = tie_followers_count(); ?>
				<li class="twitter-followers">
					<a href="<?php echo $twitter['page_url'] ?>"<?php echo $new_window ?>>
						<strong class="tieicon-twitter"></strong>
						<span><?php echo @number_format($twitter['followers_count']) ?></span>
						<small><?php _e('Followers' , 'tie' ) ?></small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $facebook_page ):
					$facebook = tie_facebook_fans( $facebook_page ); ?>
				<li class="facebook-fans">
					<a href="<?php echo $facebook_page ?>"<?php echo $new_window ?>>
						<strong class="tieicon-facebook"></strong>
						<span><?php echo @number_format( $facebook ) ?></span>
						<small><?php _e('Fans' , 'tie' ) ?></small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $youtube_url ):
					$youtube = tie_youtube_subs( $youtube_url ); ?>
				<li class="youtube-subs">
					<a href="<?php echo $youtube_url ?>"<?php echo $new_window ?>>
						<strong class="tieicon-youtube"></strong>
						<span><?php echo @number_format( $youtube ) ?></span>
						<small><?php _e('Subscribers' , 'tie' ) ?></small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $vimeo_url ):
					$vimeo = tie_vimeo_count( $vimeo_url ); ?>
				<li class="vimeo-subs">
					<a href="<?php echo $vimeo_url ?>"<?php echo $new_window ?>>
						<strong class="tieicon-vimeo"></strong>
						<span><?php echo @number_format( $vimeo ) ?></span>
						<small><?php _e('Subscribers' , 'tie' ) ?></small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $dribbble_url ):
					$dribbble = tie_dribbble_count( $dribbble_url ); ?>
				<li class="dribbble-followers">
					<a href="<?php echo $dribbble_url ?>"<?php echo $new_window ?>>
						<strong class="tieicon-dribbble"></strong>
						<span><?php echo @number_format( $dribbble ) ?></span>
						<small><?php _e('Followers' , 'tie' ) ?></small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $soundcloud_url && $soundcloud_api ):
				$soundcloud = tie_soundcloud_count( $soundcloud_url , $soundcloud_api ); ?>
				<li class="soundcloud-followers">
					<a href="<?php echo $soundcloud_url ?>"<?php echo $new_window ?>>
						<strong class="tieicon-soundcloud"></strong>
						<span><?php echo @number_format( $soundcloud ) ?></span>
						<small><?php _e('Followers' , 'tie' ) ?></small>
					</a>
				</li>
			<?php endif; ?>	
			<?php if( $behance_url && $behance_api ):
				$behance = tie_behance_count( $behance_url , $behance_api ); ?>
				<li class="behance-followers">
					<a href="<?php echo $behance_url ?>"<?php echo $new_window ?>>
						<strong class="tieicon-behance"></strong>
						<span><?php echo @number_format( $behance ) ?></span>
						<small><?php _e('Followers' , 'tie' ) ?></small>
					</a>
				</li>
			<?php endif; ?>
			<?php if( $instagram_url && $instagram_api ):
				$instagram = tie_instagram_count( $instagram_url , $instagram_api ); ?>
				<li class="instagram-followers">
					<a href="<?php echo $instagram_url ?>"<?php echo $new_window ?>>
						<strong class="tieicon-instagram"></strong>
						<span><?php echo @number_format( $instagram ) ?></span>
						<small><?php _e('Followers' , 'tie' ) ?></small>
					</a>
				</li>
			<?php endif; ?>

			</ul>
		</div>
		
	<?php 
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['facebook'] = $new_instance['facebook'] ;
		$instance['rss'] =  $new_instance['rss'] ;
		$instance['twitter'] =  strip_tags($new_instance['twitter']) ;
		$instance['youtube'] = $new_instance['youtube'] ;
		$instance['vimeo'] =  $new_instance['vimeo'] ;
		$instance['dribbble'] =  $new_instance['dribbble'] ;
		$instance['soundcloud'] =  $new_instance['soundcloud'] ;
		$instance['soundcloud_api'] =  $new_instance['soundcloud_api'] ;
		$instance['behance'] =  $new_instance['behance'] ;
		$instance['behance_api'] =  $new_instance['behance_api'] ;
		$instance['instagram'] =  $new_instance['instagram'] ;
		$instance['instagram_api'] =  $new_instance['instagram_api'] ;
		
		delete_transient('fans_count');
		delete_transient('twitter_count');
		delete_transient('youtube_count');
		delete_transient('vimeo_count');
		delete_transient('dribbble_count');
		delete_transient('soundcloud_count');
		delete_transient('behance_count');
		delete_transient('instagram_count');

		return $instance;
	}

	function form( $instance ) { ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $instance['new_window'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><strong>Feed</strong> URL : </label>
			<input id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php if( !empty( $instance['rss'] ) ) echo $instance['rss']; ?>" class="widefat" type="text" />
		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><strong>Facebook</strong> Page URL : </label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php if( !empty( $instance['facebook'] ) ) echo $instance['facebook']; ?>" class="widefat" type="text" />
		</p>
		<?php
		$twitter_username 		= tie_get_option('twitter_username');
		$consumer_key 			= tie_get_option('twitter_consumer_key');
		$consumer_secret		= tie_get_option('twitter_consumer_secret');
		$access_token 			= tie_get_option('twitter_access_token');
		$access_token_secret 	= tie_get_option('twitter_access_token_secret');
		
		if( empty($twitter_username) || empty($consumer_key) || empty($consumer_secret) || empty($access_token) || empty($access_token_secret)  )
				echo '<p style="display:block; padding: 5px; font-weight:bold; clear:both; background: rgb(255, 157, 157);">Error : Setup Twitter API OAuth settings under Tiepanel > Advanced tab .</p>';
		
		?>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><strong>Twitter</strong> Followers Counter: </label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>"  value="true" <?php if( !empty( $instance['twitter'] ) ) echo 'checked="checked"'; ?> type="checkbox"  />
		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><strong>Youtube</strong> Channel URL : </label>
			<input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php if( !empty( $instance['youtube'] ) ) echo $instance['youtube']; ?>" class="widefat" type="text" />
			<small>Link must be like http://www.youtube.com/user/username or http://www.youtube.com/channel/channel-name </small>

		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><strong>Vimeo</strong> Channel URL : </label>
			<input id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php if( !empty( $instance['vimeo'] ) ) echo $instance['vimeo']; ?>" class="widefat" type="text" />
			<small>Link must be like http://vimeo.com/channels/username </small>

		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'dribbble' ); ?>"><strong>dribbble</strong> Page URL : </label>
			<input id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php if( !empty( $instance['dribbble'] ) ) echo $instance['dribbble']; ?>" class="widefat" type="text" />
			<small>Link must be like http://dribbble.com/username</small>
		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'soundcloud' ); ?>"><strong>SoundCloud</strong> User Profile URL : </label>
			<input id="<?php echo $this->get_field_id( 'soundcloud' ); ?>" name="<?php echo $this->get_field_name( 'soundcloud' ); ?>" value="<?php if( !empty( $instance['soundcloud'] ) ) echo $instance['soundcloud']; ?>" class="widefat" type="text" />
			
			<label for="<?php echo $this->get_field_id( 'soundcloud_api' ); ?>">API Key : </label>
			<input id="<?php echo $this->get_field_id( 'soundcloud_api' ); ?>" name="<?php echo $this->get_field_name( 'soundcloud_api' ); ?>" value="<?php if( !empty( $instance['soundcloud_api'] ) ) echo $instance['soundcloud_api']; ?>" class="widefat" type="text" />
			<small>Check <a href="http://themes.tielabs.com/docs/sahifa/index.htm#counter" target="_blank"><strong>Social Counter Documentation</strong></a> for more info .</small>
		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'behance' ); ?>"><strong>Behance</strong> User Profile URL : </label>
			<input id="<?php echo $this->get_field_id( 'behance' ); ?>" name="<?php echo $this->get_field_name( 'behance' ); ?>" value="<?php if( !empty( $instance['behance'] ) ) echo $instance['behance']; ?>" class="widefat" type="text" />
			
			<label for="<?php echo $this->get_field_id( 'behance_api' ); ?>">API Key : </label>
			<input id="<?php echo $this->get_field_id( 'behance_api' ); ?>" name="<?php echo $this->get_field_name( 'behance_api' ); ?>" value="<?php if( !empty( $instance['behance_api'] ) )  echo $instance['behance_api']; ?>" class="widefat" type="text" />
			<small>Check <a href="http://themes.tielabs.com/docs/sahifa/index.htm#counter" target="_blank"><strong>Social Counter Documentation</strong></a> for more info .</small>
		</p>
		<p style="border-bottom: 1px solid #DDD;padding-bottom: 10px;">
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><strong>Instagram</strong> User Profile URL : </label>
			<input id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php if( !empty( $instance['instagram'] ) ) echo $instance['instagram']; ?>" class="widefat" type="text" />
			
			<label for="<?php echo $this->get_field_id( 'instagram_api' ); ?>">Access Token Key : </label>
			<input id="<?php echo $this->get_field_id( 'instagram_api' ); ?>" name="<?php echo $this->get_field_name( 'instagram_api' ); ?>" value="<?php if( !empty( $instance['instagram_api'] ) ) echo $instance['instagram_api']; ?>" class="widefat" type="text" />
			<small>Check <a href="http://themes.tielabs.com/docs/sahifa/index.htm#counter" target="_blank"><strong>Social Counter Documentation</strong></a> for more info .</small>
		</p>

	<?php
	}
}


?>