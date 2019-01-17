<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal\Element;

use JNews\Widget\Normal\NormalWidgetInterface;

Class InstagramWidget implements NormalWidgetInterface
{
    /**
     * @var string
     */
    private $cache_key = "jnews_instagram_widget_cache";

	/**
	 * @var string
	 */
    private $user_id;

    /**
     * @var  integer
     */
    private $count;

    public function get_options()
    {
        return array (
            'title' => array(
                'title'     => esc_html__('Title', 'jnews'),
                'desc'      => esc_html__('Title on widget header.', 'jnews'),
                'type'      => 'text'
            ),

            'method' => array(
	            'title'     => esc_html__('Fetch Method', 'jnews'),
	            'desc'      => esc_html__('Select fetch Instagram feed method that you want to use.', 'jnews'),
	            'type'      => 'select',
	            'default'   => 'username',
	            'options'   => array(
		            'username'  => esc_html__('Instagram Username (12 maximun image feed)', 'jnews'),
		            'api'       => esc_html__('Instagram API (20 maximum image feed, get more by sending request)', 'jnews')
	            )
            ),

            'username' => array(
	            'title'     => esc_html__('Instagram Username', 'jnews'),
	            'desc'      => esc_html__('Insert your Instagram username. ', 'jnews'),
	            'type'      => 'text',
            ),

            'redirect' => array(
	            'title'     => esc_html__('Info :', 'jnews'),
	            'desc'      => sprintf(__('You will be asked to enter redirect URI when you configure the app. Please use this url: %s', 'jnews'), get_admin_url() . 'widgets.php'),
	            'type'      => 'alert',
	            'dependency' => array(
		            array(
			            'field' => 'method',
			            'operator' => 'in',
			            'value' => array('api')
		            )
	            )
            ),

            'clientid' => array(
	            'title'     => esc_html__('Instagram Client ID', 'jnews'),
	            'desc'      => sprintf(__('You need to create an Instagram application to get your Instagram Client ID <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://www.instagram.com/developer/'),
	            'type'      => 'text',
	            'dependency' => array(
		            array(
			            'field' => 'method',
			            'operator' => 'in',
			            'value' => array('api')
		            )
	            )
            ),

            'access_token' => array(
	            'title'     => esc_html__('Instagram Access Token', 'jnews'),
	            'desc'      => sprintf(__('Get your Instagram Access Token by clicking this <a class="%s" href="%s" target="_blank">link</a> and refer to next page URL.', 'jnews'), 'jnews_instagram_access_token instagram', get_admin_url() . 'widgets.php'),
	            'type'      => 'text',
	            'dependency' => array(
		            array(
			            'field' => 'method',
			            'operator' => 'in',
			            'value' => array('api')
		            )
	            )
            ),

            'column' => array(
                'title'     => esc_html__('Set Column', 'jnews'),
                'desc'      => esc_html__('Choose number of column widget.', 'jnews'),
                'type'      => 'select',
                'default'   => 3,
                'options'   => array(
                    2 => esc_html__('2 Columns', 'jnews'),
                    3 => esc_html__('3 Columns', 'jnews'),
                    4 => esc_html__('4 Columns', 'jnews'),
                )
            ),

            'row' => array(
                'title'     => esc_html__('Set Row', 'jnews'),
                'desc'      => esc_html__('Choose number of row widget.', 'jnews'),
                'type'      => 'slider',
                'options'    => array(
                    'min'  => '1',
                    'max'  => '10',
                    'step' => '1',
                ),
                'default'   => 3,
            ),

            'hover' => array(
                'title'     => esc_html__('Hover Style', 'jnews'),
                'desc'      => esc_html__('Choose hover effect style.', 'jnews'),
                'type'      => 'select',
                'default'   => 'normal',
                'options'   => array(
                    'normal'      => esc_html__('Normal', 'jnews'),
                    'icon'        => esc_html__('Show Icon', 'jnews'),
                    'like'        => esc_html__('Show Like Count', 'jnews'),
                    'comment'     => esc_html__('Show Comment Count', 'jnews'),
                    'zoom'        => esc_html__('Zoom', 'jnews'),
                    'zoom-rotate' => esc_html__('Zoom Rotate', 'jnews'),
                    ''            => esc_html__('No Effect', 'jnews'),
                )
            ),

            'sort' => array(
                'title'     => esc_html__('Sort Type', 'jnews'),
                'desc'      => esc_html__('Choose sort type.', 'jnews'),
                'type'      => 'select',
                'default'   => 'most_recent',
                'options'   => array(
                    'most_recent'   => esc_html__('Most Recent', 'jnews'),
                    'least_recent'  => esc_html__('Least Recent', 'jnews'),
                    'most_like'     => esc_html__('Most Liked', 'jnews'),
                    'least_like'    => esc_html__('Least Liked', 'jnews'),
                    'most_comment'  => esc_html__('Most Commented', 'jnews'),
                    'least_comment' => esc_html__('Least Commented', 'jnews'),
                )
            ),

            'button' => array(
                'title'     => esc_html__('Follow Button Text', 'jnews'),
                'desc'      => esc_html__('Leave it empty if you wont to show it.', 'jnews'),
                'type'      => 'text',
            ),

            'newtab' => array(
                'title'     => esc_html__('Open New Tab', 'jnews'),
                'desc'      => esc_html__('Open Instagram profile page on new tab.', 'jnews'),
                'type'      => 'checkbox',
            ),
        );
    }


    public function render_widget( $instance, $text_content = null )
    {
        if ( !empty( $instance['username'] ) && !empty($instance['method']) )
        {
            $this->row      = $instance['row'];
            $this->column   = $instance['column'];
            $this->count    = $this->row * $this->column;
            $this->hover    = $instance['hover'];
            $this->sort     = $instance['sort'];
            $this->newtab   = isset($instance['newtab']) ? 'target=\'_blank\'' : '';

            if (!empty($instance['button'])) {
                $this->button =
                    '<h3 class=\'jeg_instagram_heading\'>
                    <a href=\'//www.instagram.com/' . $instance['username'] . '\' ' . $this->newtab . '><i class="fa fa-instagram"></i> ' . esc_html($instance['button']) . '</a>
                </h3>';
            } else {
                $this->button = '';
            }

            $this->check_cache($instance['username'], $instance['access_token'], $instance['method'], $this->count);
        }
    }


    protected function render_content( $data )
    {
        $content = '';

        if ( !empty( $data ) && is_array( $data ) ) 
        {
            $data    = $this->sort_data( $data );
            $content = $this->build_content( $data );
        }

        $output = 
            "<div class='jeg_instagram_widget jeg_grid_thumb_widget clearfix'>
                {$this->button}
                <ul class='instagram-pics col{$this->column} {$this->hover}'>
                    {$content}
                </ul>
            </div>";

        echo jnews_sanitize_output($output);
    }


    protected function build_content( $data )
    {
        $content = $like = '';
        $a = 1;

        foreach ( $data as $image ) 
        {
            if ( $a % $this->column == 0 ) 
            {
                $class = 'last';
            } elseif ( $a % $this->column == 1 ) {
                $class = 'first';
            } else {
                $class = '';
            }

            if ( $this->hover == 'like' ) 
            {
                $like =  "<i class='fa fa-heart'>" . jnews_number_format( $image['like'] ) . "</i>";
            } elseif ( $this->hover == 'comment' ) {
                $like =  "<i class='fa fa-comments'>" . jnews_number_format( $image['comment'] ) . "</i>";
            }

            $image_tag = apply_filters('jnews_single_image', $image['images']['thumbnail'], $image['caption'], '1000');

            $content .= 
                "<li class='{$class}'>
                    <a href='{$image['link'] }' {$this->newtab}>
                        {$like}
                        {$image_tag}
                    </a>
                </li>";

            if ( $a >= ( $this->row * $this->column ) ) 
            {
                break;
            }

            $a++;
        }

        return $content;
    }


    protected function sort_data( $data )
    {
        switch ( $this->sort )
        {
            case 'most_recent':
                usort($data, function($a, $b)
                {
                    return $b['time'] - $a['time'];
                });
                break;
            case 'least_recent':
                usort($data, function($a, $b)
                {
                    return $a['time'] - $b['time'];
                });
                break;
            case 'most_like':
                usort($data, function($a, $b)
                {
                    return $b['like'] - $a['like'];
                });
                break;
            case 'least_like':
                usort($data, function($a, $b)
                {
                    return $a['like'] - $b['like'];
                });
                break;
            case 'most_comment':
                usort($data, function($a, $b)
                {
                    return $b['comment'] - $a['comment'];
                });
                break;
            case 'least_comment':
                usort($data, function($a, $b)
                {
                    return $a['comment'] - $b['comment'];
                });
                break;
        }

        return $data;
    }


    protected function check_cache( $username, $token, $method, $count )
    {
        $data_cache   = get_option( $this->cache_key, array() );
        $now          = current_time('timestamp');
        $data_feed    = null;
        $add_feed     = true;
        $update_feed  = false;
        $expire       = 60 * 60 * 24; // set expire in 1 day

        if ( !empty( $data_cache ) && is_array( $data_cache ) ) 
        {
            foreach ( $data_cache as &$data ) 
            {
                if ( $data['username'] == $username )
                {
                    $add_feed = false;

                    if ( count( $data['feed'] ) >= $count ) 
                    {
                        if ( $data['time'] < ( $now - $expire ) )
                        {
                            $data_feed = $this->fetch_data( $username, $token, $method, $count );

                            if ( ! empty( $data_feed ) ) 
                            {
                                $data['feed'] = $data_feed;
                                $data['time'] = current_time('timestamp');
                                $update_feed  = true;
                            }
                        }
                    } else {
                        $data_feed = $this->fetch_data( $username, $token, $method, $count );

                        if ( ! empty( $data_feed ) ) 
                        {
                            $data['feed'] = $data_feed;
                            $data['time'] = current_time('timestamp');
                            $update_feed  = true;
                        }
                    }   

                    $data_feed = $data['feed'];
                }
            }

        }

        if ( $add_feed ) 
        {
            $data_feed = $this->fetch_data( $username, $token, $method, $count );

            if ( ! empty( $data_feed ) ) 
            {
                $data_cache[] = array(
                    'username'  => $username,
                    'time'      => current_time('timestamp'),
                    'feed'      => $data_feed
                );
            } else {
                $add_feed = false;
            }
        }

        if ( $add_feed || $update_feed ) update_option( $this->cache_key, $data_cache );

        if ( !empty( $data_feed ) ) 
        {
            $this->render_content( $data_feed );
        }
    }


    protected function fetch_data( $username, $token, $method = 'username', $count = 12, $max_id = '' )
    {
        $response = wp_remote_get( $this->get_url( $username, $token, $method, $max_id ) , array(
            'timeout' => 10,
        ));

        if ( !is_wp_error( $response ) && $response['response']['code'] == '200' )
        {
	        $data_images = array();

	        if ( $method === 'username')
	        {
		        $data      = explode( 'window._sharedData = ', $response['body'] );
		        $data_json = explode( ';</script>', $data[1] );
		        $data_json = json_decode( $data_json[0], TRUE );

		        foreach ( $data_json['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] as $image )
		        {
			        $data_images[] = array(
				        'id'          => $image['node']['id'],
				        'time'        => $image['node']['taken_at_timestamp'],
				        'like'        => $image['node']['edge_liked_by']['count'],
				        'comment'     => $image['node']['edge_media_to_comment']['count'],
				        'caption'     => !empty( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ? preg_replace('/[^a-zA-Z0-9\-]/', ' ', $image['node']['edge_media_to_caption']['edges'][0]['node']['text']) : '',
				        'link'        => trailingslashit( '//instagram.com/p/' . $image['node']['shortcode'] ),
				        'images'      => array(
					        'display'   => $image['node']['display_url'],
					        'thumbnail' => $image['node']['thumbnail_src']
				        ),
			        );

			        if ( count($data_images) >= $count )
			        {
				        break;
			        }
		        }

	        } else {
		        $data_json = json_decode( $response['body'], TRUE );

		        foreach ( $data_json['data'] as $image )
		        {
			        $data_images[] = array(
				        'id'          => $image['id'],
				        'time'        => $image['created_time'],
				        'like'        => $image['likes']['count'],
				        'comment'     => $image['comments']['count'],
				        'caption'     => !empty( $image['caption']['text'] ) ? preg_replace('/[^a-zA-Z0-9\-]/', ' ', $image['caption']['text']) : '',
				        'link'        => $image['link'],
				        'images'      => array(
					        'display'   => $image['images']['standard_resolution']['url'],
					        'thumbnail' => $image['images']['thumbnail']['url']
				        ),
			        );

			        if ( count($data_images) >= $count )
			        {
				        break;
			        }
		        }
	        }

            if ( (($count - count($data_images)) > 0) && (count($data_images) % 12 == 0) && (count($data_images) > 0) && $method != 'username' )
            {
            	$max_id = end( $data_images );
	            $max_id = $max_id['id'];

	            $next_images = $this->fetch_data( $username, $token, $method, ($count - 12), $max_id );

                if ( !is_wp_error( $next_images ) )
                {
                    $data_images = array_merge( $data_images, $next_images );
                }
            }

            return $data_images;

        }

        return null;
    }


    protected function get_url( $username, $token, $method, $max_id )
    {
	    $username = str_replace( '@', '', $username );

    	if ( $method === 'username' )
	    {
	    	return 'https://www.instagram.com/' . $username;
	    } else {
		    if ( empty( $max_id ) )
		    {
			    return 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $token . '&count=12';
		    } else {
			    return 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $token . '&count=12&max_id=' . $max_id;
		    }
	    }
    }

    protected function get_widget_template()
    {
    }
}