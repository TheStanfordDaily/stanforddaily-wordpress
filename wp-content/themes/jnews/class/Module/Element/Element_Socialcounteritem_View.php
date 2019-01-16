<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleViewAbstract;
use JNews\Widget\Normal\Process\SocialCounterProcess;

Class Element_Socialcounteritem_View extends ModuleViewAbstract
{
	private $output = '';

	private $data_cache;

	private $queue;

	private $cache_key = "jnews_social_counter_widget_cache";

	public function render_module($attr, $column_class)
    {
	    add_action( 'wp_footer', array( $this, 'process_queue' ) );

	    $this->data_cache = get_option( $this->cache_key, array() );

	    $this->init_social( $attr );
			    
	    return $this->output;
    }

	protected function init_social( $attr )
	{
		if ( ! empty( $attr['social_url'] ) )
		{
			$this->service_social( $attr );
		}
	}

	protected function service_social( $data )
	{
		switch ( $data['social_icon'] )
		{
			case 'facebook':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );

				global $social_fb_key;

				if ( !empty($social_id) && !empty($social_fb_key)  )
				{
					$array = array(
						'social_type'    => 'facebook',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Fan', 'jnews', 'fan'),
						'social_url'     => $data['social_url'],
						'social_grab'    => 'https://graph.facebook.com/v2.8/' . $social_id . '?access_token=' . apply_filters( 'jnews_facebook_token_access', $social_fb_key ) . '&fields=fan_count',
					);

					$this->check_cache($array);
				}
				break;

			case 'twitter':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );

				if ( !empty($social_id) )
				{
					$array = array(
						'social_type'    => 'twitter',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
						'social_url'     => $data['social_url'],
						'social_grab'    => $data['social_url'],
					);
					$this->check_cache($array);
				}
				break;

			case 'instagram':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );

				if ( !empty($social_id) )
				{
					$array = array(
						'social_type'    => 'instagram',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
						'social_url'     => $data['social_url'],
						'social_grab'    => $data['social_url'],
					);
					$this->check_cache($array);
				}
				break;

			case 'pinterest':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );

				if ( !empty($social_id) )
				{
					$array = array(
						'social_type'    => 'pinterest',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
						'social_url'     => $data['social_url'],
						'social_grab'    => $data['social_url'],
					);
					$this->check_cache($array);
				}
				break;

			case 'vimeo':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );

				if ( !empty($social_id) )
				{
					$array = array(
						'social_type'    => 'vimeo',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
						'social_url'     => $data['social_url'],
						'social_grab'    => 'https://vimeo.com/' . $social_id . '/following/followers/',
					);
					$this->check_cache($array);
				}
				break;

			case 'soundcloud':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );

				if ( !empty($social_id) )
				{
					$array = array(
						'social_type'    => 'soundcloud',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
						'social_url'     => $data['social_url'],
						'social_grab'    => $data['social_url'],
					);
					$this->check_cache($array);
				}
				break;

			case 'google-plus':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );
				$social_id = explode( '/', $social_id );
				$social_id = end( $social_id );

				global $social_gg_key;

				if ( !empty($social_id) && !empty($social_gg_key) )
				{
					$array = array(
						'social_type'    => 'google-plus',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
						'social_url'     => $data['social_url'],
						'social_grab'    => 'https://www.googleapis.com/plus/v1/people/' . $social_id . '?key=' . apply_filters( 'jnews_googleplus_token_access', $social_gg_key ),
					);
					$this->check_cache($array);
				}
				break;

			case 'behance':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );

				global $social_bh_key;

				if ( !empty($social_id) && !empty($social_bh_key) )
				{
					$array = array(
						'social_type'    => 'behance',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
						'social_url'     => $data['social_url'],
						'social_grab'    => 'https://api.behance.net/v2/users/' . $social_id . '?client_id=' . apply_filters( 'jnews_behance_token_access', $social_bh_key ),
					);
					$this->check_cache($array);
				}
				break;

			case 'flickr':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );
				$social_id = str_replace( 'photos/', '', $social_id );

				if ( !empty($social_id) )
				{
					$array = array(
						'social_type'    => 'flickr',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
						'social_url'     => $data['social_url'],
						'social_grab'    => $data['social_url'],
					);
					$this->check_cache($array);
				}
				break;

			case 'twitch':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );

				global $social_twitch_key;

				if ( !empty($social_id) && !empty($social_twitch_key) )
				{
					$array = array(
						'social_type'    => 'twitch',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
						'social_url'     => $data['social_url'],
						'social_grab'    => 'https://api.twitch.tv/kraken/channels/' . $social_id . '?client_id=' . apply_filters( 'jnews_twitch_token_access', $social_twitch_key ),
					);
					$this->check_cache($array);
				}
				break;

			case 'vk':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );

				global $social_vk_id;

				if ( !empty($social_id) )
				{
					$array = array(
						'social_type'    => 'vk',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
						'social_url'     => $data['social_url'],
						'social_grab'    => 'https://api.vk.com/method/users.getFollowers?user_id=' . $social_vk_id,
					);
					$this->check_cache($array);
				}
				break;

			case 'youtube':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );

				global $social_gg_key;

				if ( !empty($social_id) && !empty($social_gg_key) )
				{
					$array = array(
						'social_type'    => 'youtube',
						'social_text'    => jnews_return_translation('Subscriber', 'jnews', 'subscriber'),
						'social_url'     => $data['social_url'],
						'social_grab'    => 'https://www.googleapis.com/youtube/v3/channels?part=statistics&key=' . apply_filters( 'jnews_youtube_token_access', $social_gg_key ),
					);

					$social_id = explode("/", $social_id);

					if ( is_array($social_id) )
					{
						if ( $social_id[0] == 'channel' )
						{
							$array['social_grab'] .= '&id=' . $social_id[1];
						} else {
							$array['social_grab'] .= '&forUsername=' . $social_id[1];
						}

						$array['social_id'] = $social_id[1];
					}

					$this->check_cache($array);
				}
				break;

			case 'rss':
				global $social_rss_count;

				if ( is_numeric($social_rss_count) )
				{
					$array = array(
						'social_text'    => jnews_return_translation('Subscriber', 'jnews', 'subscriber'),
						'social_url'     => empty( $data['social_url'] ) ? esc_url( home_url() . '/feed' ) : $data['social_url'],
						'social_data'    => $social_rss_count,
						'social_type'    => 'rss',
					);

					$this->build_content($array);
				}
				break;
		}
	}

	protected function build_content($data)
	{
		global $social_new_tab;

		$count = jnews_number_format($data['social_data']);

		$this->output =
			"<li class=\"jeg_{$data['social_type']}\">
                <a href=\"{$data['social_url']}\" {$social_new_tab}><i class=\"fa fa-{$data['social_type']}\"></i>
                    <span>{$count}</span>
                    <small>{$data['social_text']}s</small>
                </a>
            </li>";
	}

	protected function check_cache( $data )
	{
		$now          = current_time('timestamp');
		$data_count   = null;
		$add_cache    = true;
		$cache_expire = apply_filters( 'jnews_social_counter_widget_expired', 60 * 60 * 24 );

		if ( !empty($this->data_cache) && is_array($this->data_cache) )
		{
			foreach ($this->data_cache as &$social_data)
			{
				if ( $data['social_type'] == $social_data['social_type'] && $data['social_id'] == $social_data['social_id'] )
				{
					$add_cache = false;

					if ( $social_data['social_expire'] < ( $now - $cache_expire ) )
					{
						$this->add_queue( $data );
					}

					$data_count = $social_data['social_data'];
				}
			}
		}

		if ( $add_cache )
		{
			$data_count = $this->fetch_data( $data );

			if ( ! empty( $data_count ) )
			{
				$this->data_cache[] = array(
					'social_type'   => $data['social_type'],
					'social_id'     => $data['social_id'],
					'social_expire' => current_time('timestamp'),
					'social_data'   => $data_count,
				);
			} else {
				$add_cache = false;
			}
		}

		if ( $add_cache ) update_option( $this->cache_key, $this->data_cache );

		// call build content
		if ( !empty( $data_count ) )
		{
			$data['social_data'] = $data_count;
			$this->build_content( $data );
		}
	}

	protected function fetch_data( $data )
	{
		$response = wp_remote_get($data['social_grab'], array(
			'timeout' => 10,
		));

		if ( !is_wp_error( $response ) && $response['response']['code'] == '200' )
		{
			switch ( $data['social_type'] )
			{
				case 'twitter':
					$pattern = "/title=\"(.*)\"(.*)data-nav=\"followers\"/i";
					preg_match_all($pattern, $response['body'], $matches);

					if ( !empty($matches[1][0]) )
					{
						$result = '';
						foreach (str_split($matches[1][0]) as $char) {
							if (is_numeric($char))
							{
								$result .= $char;
							}
						}
						return (int) $result;
					}
					break;

				case 'instagram':
					$pattern = '/window\._sharedData = (.*);<\/script>/';
					preg_match($pattern, $response['body'], $matches);

					if ( !empty($matches[1]) )
					{
						$result = json_decode($matches[1], true);
						if (!empty($result['entry_data']['ProfilePage'][0]['user']['followed_by']['count']))
						{
							return $result['entry_data']['ProfilePage'][0]['user']['followed_by']['count'];
						}
					}
					break;

				case 'pinterest':
					$pattern = "/name=\"pinterestapp:followers\" content=\"(.*?)\"/";
					preg_match($pattern, $response['body'], $matches);

					if ( !empty($matches[1]) )
					{
						return (int) $matches[1];
					}
					break;

				case 'vimeo':
					$pattern = "/data-title=\"(.*?) Follower(s?)\"/";
					preg_match($pattern, $response['body'], $matches);

					if ( !empty($matches[1]) )
					{
						$result = '';
						foreach (str_split($matches[1]) as $char) {
							if (is_numeric($char))
							{
								$result .= $char;
							}
						}
						return (int) $result;
					}
					break;

				case 'soundcloud':
					$pattern = "/<meta property=\"soundcloud:follower_count\" content=\"(.*?)\">/";
					preg_match($pattern, $response['body'], $matches);

					if ( !empty($matches[1]) )
					{
						return (int) $matches[1];
					}
					break;

				case 'google-plus':
					$result = json_decode( $response['body'] );
					if ( !empty($result->circledByCount) )
					{
						return (int) $result->circledByCount;
					}
					break;

				case 'youtube':
					$result = json_decode( $response['body'] );
					if ( !empty($result->items[0]) )
					{
						return (int) $result->items[0]->statistics->subscriberCount;
					}
					break;

				case 'facebook':
					$result = json_decode( $response['body'] );
					if ( !empty($result->fan_count) )
					{
						return (int) $result->fan_count;
					}
					break;

				case 'behance':
					$result = json_decode( $response['body'] );
					if ( !empty($result->user->stats->followers) )
					{
						return (int) $result->user->stats->followers;
					}
					break;

				case 'flickr':
					$pattern = "/\"followerCount\":(.*?),\"/";
					preg_match($pattern, $response['body'], $matches);

					if ( !empty($matches[1]) )
					{
						return (int) $matches[1];
					}
					break;

				case 'twitch':
					$result = json_decode( $response['body'] );
					if ( !empty($result->followers) )
					{
						return $result->followers;
					}
					break;

				case 'vk':
					$result = json_decode( $response['body'] );
					if ( !empty($result->response->count) )
					{
						return $result->response->count;
					}
					break;
			}
		}
		return null;
	}

	protected function add_queue( $data )
	{
		$this->queue[] = $data;
	}

	public function process_queue()
	{
		if ( !is_array( $this->queue ) ) return;

		$background_process = new SocialCounterProcess();

		foreach( $this->queue as $item )
		{
			$background_process->push_to_queue( $item );
		}

		$background_process->save()->dispatch();
	}
}