<?php
namespace JNews\Elementor\Normal;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use JNews\Widget\Normal\Process\SocialCounterProcess;

class SocialCounter extends Widget_Base
{
	/**
	 * @var string
	 */
	private $fb_key;
	private $gg_key;
	private $bh_key;
	private $twitch_key;
	private $vk_id;
	private $cache_key = "jnews_social_counter_widget_cache";
	private $newtab;

	/**
	 * @var array
	 */
	private $data_cache;
	private $content;

	/**
	 * @var integer
	 */
	private $rss_count = 10;

	/**
	 * @var array
	 */
	private $queue;

	/**
	 * @var SocialCounterProcess
	 */
	private $background_process;
	
    public function __construct( array $data = [], $args = null ) 
    {
	    if ( ! is_admin() )
	    {
		    $this->init_background_process();

		    add_action( 'wp_footer', array( $this, 'process_queue' ) );
	    }
	    
	    parent::__construct( $data, $args );
    }
    
	public function init_background_process()
	{
		$this->background_process = new SocialCounterProcess();
	}

	public function get_name() {
		return 'socialcounter';
	}

	public function get_title() {
		return esc_html__( 'Social Counter', 'jnews' );
	}

	public function get_icon() {
		return 'jnews_element_socialcounterwrapper';
	}

	public function get_categories() {
		return [ 'jnews-element' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'general_section',
			[
				'label' => esc_html__( 'General Setting', 'jnews' ),
			]
		);

		$this->add_control(
			'column',
			[
				'label'         => esc_html__( 'Number of Column', 'jnews' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'col1',
				'options'       => array(
					'col1'  => esc_html__('1 Column', 'jnews'),
					'col2'  => esc_html__('2 Columns', 'jnews'),
					'col3'  => esc_html__('3 Columns', 'jnews'),
					'col4'  => esc_html__('4 Columns', 'jnews'),
                ),
				'label_block'   => true,
				'description'   => esc_html__( 'Set the number of social counter column.', 'jnews' )
			]
		);

		$this->add_control(
			'style',
			[
				'label'         => esc_html__( 'Social Style', 'jnews' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'light',
				'options'       => array(
					'light'     => esc_html__('Light', 'jnews'),
					'colored'   => esc_html__('Colored', 'jnews'),
				),
				'label_block'   => true,
				'description'   => esc_html__( 'Choose your social counter style.', 'jnews' )
			]
		);

		$this->add_control(
			'newtab',
			[
				'label'         => esc_html__( 'Open New Tab', 'jnews' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => '',
				'description'   => esc_html__( 'Open social account page on new tab.', 'jnews' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'account_section',
			[
				'label' => esc_html__( 'Account Setting', 'jnews' ),
			]
		);

		$this->add_control(
			'fb_id',
			[
				'label'         => esc_html__('Facebook App ID', 'jnews'),
				'type'          => Controls_Manager::TEXT,
				'default'       => '',
				'label_block'   => true,
				'description'   => sprintf(__('You can create an application and get Facebook App ID <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://developers.facebook.com/docs/apps/register'),
			]
		);

		$this->add_control(
			'fb_secret',
			[
				'label'         => esc_html__('Facebook App Secret', 'jnews'),
				'type'          => Controls_Manager::TEXT,
				'default'       => '',
				'label_block'   => true,
				'description'   => sprintf(__('You can create an application and get Facebook App Secret <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://developers.facebook.com/docs/apps/register'),
			]
		);

		$this->add_control(
			'fb_key',
			[
				'label'         => esc_html__('Facebook Access Token', 'jnews'),
				'description'   => sprintf(__('Get your Facebook Access Token by clicking this <a class="%s" href="%s" target="_blank">link</a>.<i class="jnews-spinner fa fa-spinner fa-pulse"></i>', 'jnews'), 'jnews_token_access facebook', '#'),
				'type'          => Controls_Manager::TEXT,
				'default'       => '',
				'label_block'   => true,
			]
		);

		$this->add_control(
			'gg_key',
			[
				'label'         => esc_html__('Google API Key', 'jnews'),
				'description'   => sprintf(__('You can register Google API Key here for <a href="%s" target="_blank">Google+</a> and <a href="%s" target="_blank">YouTube</a>.', 'jnews'), 'https://developers.google.com/+/web/api/rest/oauth', 'https://developers.google.com/youtube/v3/getting-started'),
				'type'          => Controls_Manager::TEXT,
				'default'       => '',
				'label_block'   => true,
			]
		);

		$this->add_control(
			'bh_key',
			[
				'label'         => esc_html__('Behance API Key', 'jnews'),
				'description'   => sprintf(__('You can register Behance API Key <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://www.behance.net/dev/register'),
				'type'          => Controls_Manager::TEXT,
				'default'       => '',
				'label_block'   => true,
			]
		);

		$this->add_control(
			'twitch_key',
			[
				'label'         => esc_html__('Twitch Client ID', 'jnews'),
				'description'   => sprintf(__('You can create an application and get Twitch Client ID <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://dev.twitch.tv/docs/v5/guides/authentication/'),
				'type'          => Controls_Manager::TEXT,
				'default'       => '',
				'label_block'   => true,
			]
		);

		$this->add_control(
			'vk_id',
			[
				'label'         => esc_html__('VK User ID', 'jnews'),
				'description'   => esc_html__('Insert your VK user id.', 'jnews'),
				'type'          => Controls_Manager::TEXT,
				'default'       => '',
				'label_block'   => true,
			]
		);

		$this->add_control(
			'rss_count',
			[
				'label'         => esc_html__('RSS Subscriber', 'jnews'),
				'description'   => esc_html__('Insert the number of RSS subscribers.', 'jnews'),
				'type'          => Controls_Manager::TEXT,
				'default'       => '',
				'label_block'   => true,
			]
		);

		$this->add_control(
			'account',
			[
				'label'         => esc_html__( 'Social Account', 'jnews' ),
				'description'   => esc_html__('Add your social account list.', 'jnews'),
				'type'          => Controls_Manager::REPEATER,
				'default' => [
					[
						'social_icon'   => 'facebook',
						'social_url'    => 'https://www.facebook.com/jegtheme/'
					],
					[
						'social_icon'   => 'twitter',
						'social_url'    => 'https://twitter.com/jegtheme'
					],
				],
				'fields' => [
					[
						'name'          => 'social_icon',
						'label'         => esc_html__( 'Social Icon', 'jnews' ),
						'description'   => esc_html__( 'Choose your social account.', 'jnews' ),
						'type'          => Controls_Manager::SELECT,
						'options'       => array(
							''              => esc_attr__( 'Choose Icon', 'jnews' ),
							'facebook'      => esc_attr__( 'Facebook Page', 'jnews' ),
							'twitter'       => esc_attr__( 'Twitter', 'jnews' ),
							'google-plus'   => esc_attr__( 'Google+', 'jnews' ),
							'pinterest'     => esc_attr__( 'Pinterest', 'jnews' ),
							'behance'       => esc_attr__( 'Behance', 'jnews' ),
							'flickr'        => esc_attr__( 'Flickr', 'jnews' ),
							'soundcloud'    => esc_attr__( 'Soundcloud', 'jnews' ),
							'instagram'     => esc_attr__( 'Instagram', 'jnews' ),
							'vimeo'         => esc_attr__( 'Vimeo', 'jnews' ),
							'youtube'       => esc_attr__( 'Youtube', 'jnews' ),
							'twitch'        => esc_attr__( 'Twitch', 'jnews' ),
							'vk'            => esc_attr__( 'VK', 'jnews' ),
							'rss'           => esc_attr__( 'RSS', 'jnews' ),
						),
						'default'       => '',
						'label_block'   => true,
					],
					[
						'name'          => 'social_url',
						'label'         => esc_html__( 'Social URL', 'jnews' ),
						'description'   => esc_html__( 'Insert your social account url.', 'jnews' ),
						'type'          => Controls_Manager::TEXT,
						'default'       => '',
						'label_block'   => true,
					],
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render()
    {
		$settings = $this->get_settings();

	    $this->content      = $this->data_cache = null;
	    $this->vk_id        = isset( $settings['vk_id'] ) ? str_replace('id', '', $settings['vk_id']) : '';
	    $this->fb_key       = isset( $settings['fb_key'] ) ? $settings['fb_key'] : '';
	    $this->gg_key       = isset( $settings['gg_key'] ) ? $settings['gg_key'] : '';
	    $this->bh_key       = isset( $settings['bh_key'] ) ? $settings['bh_key'] : '';
	    $this->twitch_key   = isset( $settings['twitch_key'] ) ? $settings['twitch_key'] : '';
	    $this->rss_count    = isset( $settings['rss_count'] ) ? $settings['rss_count'] : '' ;

	    $this->render_social_content($settings);
	}

	protected function render_social_content( $settings )
	{
		$this->data_cache = get_option( $this->cache_key, array() );

		$this->newtab = isset($settings['newtab']) ? 'target="_blank"' : '' ;

		$this->init_social($settings);

		$output =
			"<ul class=\"jeg_socialcounter {$settings['column']} {$settings['style']}\">
                {$this->content}
            </ul>";

		echo jnews_sanitize_output($output);
	}

	/**
	 * Init function
	 *
	 * @param  array $settings
	 */
	protected function init_social( $settings )
	{
		if ( ! empty( $settings['account'] ) )
		{
			if ( is_array( $settings['account'] ) )
			{
				foreach ( $settings['account'] as $social )
				{
					if (  empty( $social ) || ( empty( $social['social_url'] ) && $social['social_icon'] !== 'rss' ) )
					{
						continue;
					}

					$this->service_social( $social );
				}
			}

		}
	}

	/**
	 * Build content for each social account
	 *
	 * @param  array $data
	 */
	protected function build_content($data)
	{
		$count = jnews_number_format($data['social_data']);

		$this->content .=
			"<li class=\"jeg_{$data['social_type']}\">
                <a href=\"{$data['social_url']}\" {$this->newtab}><i class=\"fa fa-{$data['social_type']}\"></i>
                    <span>{$count}</span>
                    <small>{$data['social_text']}s</small>
                </a>
            </li>";
	}

	/**
	 * Checking social type
	 *
	 * @param  array $data
	 */
	protected function service_social( $data )
	{
		switch ( $data['social_icon'] )
		{
			case 'facebook':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );

				if ( !empty($social_id) && !empty($this->fb_key)  )
				{
					$array = array(
						'social_type'    => 'facebook',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Fan', 'jnews', 'fan'),
						'social_url'     => $data['social_url'],
						'social_grab'    => 'https://graph.facebook.com/v2.8/' . $social_id . '?access_token=' . apply_filters( 'jnews_facebook_token_access', $this->fb_key ) . '&fields=fan_count',
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

				if ( !empty($social_id) && !empty($this->gg_key) )
				{
					$array = array(
						'social_type'    => 'google-plus',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
						'social_url'     => $data['social_url'],
						'social_grab'    => 'https://www.googleapis.com/plus/v1/people/' . $social_id . '?key=' . apply_filters( 'jnews_googleplus_token_access', $this->gg_key ),
					);
					$this->check_cache($array);
				}
				break;

			case 'behance':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );

				if ( !empty($social_id) && !empty($this->bh_key) )
				{
					$array = array(
						'social_type'    => 'behance',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
						'social_url'     => $data['social_url'],
						'social_grab'    => 'https://api.behance.net/v2/users/' . $social_id . '?client_id=' . apply_filters( 'jnews_behance_token_access', $this->bh_key ),
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

				if ( !empty($social_id) && !empty($this->twitch_key) )
				{
					$array = array(
						'social_type'    => 'twitch',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
						'social_url'     => $data['social_url'],
						'social_grab'    => 'https://api.twitch.tv/kraken/channels/' . $social_id . '?client_id=' . apply_filters( 'jnews_twitch_token_access', $this->twitch_key ),
					);
					$this->check_cache($array);
				}
				break;

			case 'vk':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );

				if ( !empty($social_id) )
				{
					$array = array(
						'social_type'    => 'vk',
						'social_id'      => $social_id,
						'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
						'social_url'     => $data['social_url'],
						'social_grab'    => 'https://api.vk.com/method/users.getFollowers?user_id=' . $this->vk_id,
					);
					$this->check_cache($array);
				}
				break;

			case 'youtube':
				$social_id = parse_url( $data['social_url'] );
				$social_id = trim( $social_id['path'], '/' );

				if ( !empty($social_id) && !empty($this->gg_key) )
				{
					$array = array(
						'social_type'    => 'youtube',
						'social_text'    => jnews_return_translation('Subscriber', 'jnews', 'subscriber'),
						'social_url'     => $data['social_url'],
						'social_grab'    => 'https://www.googleapis.com/youtube/v3/channels?part=statistics&key=' . apply_filters( 'jnews_youtube_token_access', $this->gg_key ),
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
				if ( is_numeric($this->rss_count) )
				{
					$array = array(
						'social_text'    => jnews_return_translation('Subscriber', 'jnews', 'subscriber'),
						'social_url'     => empty( $data['social_url'] ) ? esc_url( home_url() . '/feed' ) : $data['social_url'],
						'social_data'    => $this->rss_count,
						'social_type'    => 'rss',
					);

					$this->build_content($array);
				}
				break;
		}
	}

	/**
	 * Check available data cached
	 *
	 * @param  array $data
	 */
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

	/**
	 * Fetch data
	 *
	 * @param  array $data
	 *
	 * @return int
	 *
	 */
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

	/**
	 * Add queue
	 *
	 * @param array $data
	 *
	 */
	protected function add_queue( $data )
	{
		$this->queue[] = $data;
	}

	/**
	 * Proses queue
	 */
	public function process_queue()
	{
		if ( !is_array( $this->queue ) ) return;

		foreach( $this->queue as $item )
		{
			$this->background_process->push_to_queue( $item );
		}

		$this->background_process->save()->dispatch();
	}

	protected function _content_template() {}
}
