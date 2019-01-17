<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal\Element;

use JNews\Widget\Normal\NormalWidgetInterface;
use JNews\Widget\Normal\Process\SocialCounterProcess;

Class SocialCounterWidget implements NormalWidgetInterface
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

    
    public function __construct()
    {
        if ( ! is_admin() )
        {
            $this->init_background_process();

            add_action( 'wp_footer', array( $this, 'process_queue' ) );
        }
    }

    public function init_background_process()
    {
        $this->background_process = new SocialCounterProcess();
    }

    public function get_options()
    {
        $fields = array (
            'title' => array(
                'title'     => esc_html__('Title', 'jnews'),
                'desc'      => esc_html__('Title on widget header.', 'jnews'),
                'type'      => 'text'
            ),

            'column' => array(
                'title'     => esc_html__('Number of Column', 'jnews'),
                'desc'      => esc_html__('Set the number of widget column.', 'jnews'),
                'type'      => 'select',
                'default'   => 'col1',
                'options'   => array(
                    'col1' => esc_html__('1 Column', 'jnews'),
                    'col2' => esc_html__('2 Columns', 'jnews'),
                    'col3' => esc_html__('3 Columns', 'jnews'),
                    'col4' => esc_html__('4 Columns', 'jnews'),
                )
            ),

            'style' => array(
                'title'     => esc_html__('Social Style', 'jnews'),
                'desc'      => esc_html__('Choose your social counter style.', 'jnews'),
                'type'      => 'select',
                'default'   => 'light',
                'options'   => array(
                    'light' => esc_html__('Light', 'jnews'),
                    'colored' => esc_html__('Colored', 'jnews'),
                )
            ),

            'newtab' => array(
                'title'     => esc_html__('Open New Tab', 'jnews'),
                'desc'      => esc_html__('Open social account page on new tab.', 'jnews'),
                'type'      => 'checkbox',
            ),
        );

        $fields['Account Setting'] = array (
            'fb_id' => array(
                'title'     => esc_html__('Facebook App ID', 'jnews'),
                'desc'      => sprintf(__('You can create an application and get Facebook App ID <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://developers.facebook.com/docs/apps/register'),
                'type'      => 'text'
            ),

            'fb_secret' => array(
                'title'     => esc_html__('Facebook App Secret', 'jnews'),
                'desc'      => sprintf(__('You can create an application and get Facebook App Secret <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://developers.facebook.com/docs/apps/register'),
                'type'      => 'text'
            ),

            'fb_key' => array(
                'title'     => esc_html__('Facebook Access Token', 'jnews'),
                'desc'      => sprintf(__('Get your Facebook Access Token by clicking this <a class="%s" href="%s" target="_blank">link</a>.<span class="jnews-spinner spinner"></span>', 'jnews'), 'jnews_token_access facebook', '#'),
                'type'      => 'text'
            ),

            'gg_key' => array(
                'title'     => esc_html__('Google API Key', 'jnews'),
                'desc'      => sprintf(__('You can register Google API Key here for <a href="%s" target="_blank">Google+</a> and <a href="%s" target="_blank">YouTube</a>.', 'jnews'), 'https://developers.google.com/+/web/api/rest/oauth', 'https://developers.google.com/youtube/v3/getting-started'),
                'type'      => 'text'
            ),

            'bh_key' => array(
                'title'     => esc_html__('Behance API Key', 'jnews'),
                'desc'      => sprintf(__('You can register Behance API Key <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://www.behance.net/dev/register'),
                'type'      => 'text'
            ),

            'twitch_key' => array(
                'title'     => esc_html__('Twitch Client ID', 'jnews'),
                'desc'      => sprintf(__('You can create an application and get Twitch Client ID <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://dev.twitch.tv/docs/v5/guides/authentication/'),
                'type'      => 'text'
            ),

            'vk_id' => array(
                'title'     => esc_html__('VK User ID', 'jnews'),
                'desc'      => esc_html__('Insert your VK user id.', 'jnews'),
                'type'      => 'text'
            ),

            'rss_count' => array(
                'title'     => esc_html__('RSS Subscriber', 'jnews'),
                'desc'      => esc_html__('Insert the number of RSS subscribers.', 'jnews'),
                'type'      => 'text'
            ),

            'account'   => array(
                'title'     => esc_html__('Social Account', 'jnews'),
                'desc'      => esc_html__('Add your social account list.', 'jnews'),
                'type'      => 'repeater',
                'default'       => array(
                    array(
                        'social_icon'    => 'facebook',
                        'social_url'     => 'https://www.facebook.com/jegtheme/',
                    ),
                    array(
                        'social_icon'    => 'twitter',
                        'social_url'     => 'https://twitter.com/jegtheme',
                    ),
                ),
                'row_label'     => array(
                    'type'  => 'text',
                    'value' => esc_attr__( 'Social Account', 'jnews' ),
                    'field' => false,
                ),
                'fields' => array(
                    'social_icon' => array(
                        'type'        => 'select',
                        'label'       => esc_attr__( 'Social Account', 'jnews' ),
                        'description' => esc_attr__( 'Choose your social account.', 'jnews' ),
                        'default'     => '',
                        'id'          => 'social_icon',
                        'choices'     => array(
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
                    ),
                    'social_url' => array(
                        'type'        => 'text',
                        'label'       => esc_attr__( 'Social URL', 'jnews' ),
                        'description' => esc_attr__( 'Insert your social account url.', 'jnews' ),
                        'default'     => '',
                        'id'          => 'social_url',
                    )
                ),
            ),
        );

        return $fields;
    }

    /**
     * Initialize Widget
     *
     * @param  array  $instance
     */
    public function render_widget($instance, $text_content = null)
    {

        $this->content      = $this->data_cache = null;
        $this->vk_id        = isset( $instance['vk_id'] ) ? str_replace('id', '', $instance['vk_id']) : '';
        $this->fb_key       = isset( $instance['fb_key'] ) ? $instance['fb_key'] : '';
        $this->gg_key       = isset( $instance['gg_key'] ) ? $instance['gg_key'] : '';
        $this->bh_key       = isset( $instance['bh_key'] ) ? $instance['bh_key'] : '';
        $this->twitch_key   = isset( $instance['twitch_key'] ) ? $instance['twitch_key'] : '';
        $this->rss_count    = isset( $instance['rss_count'] ) ? $instance['rss_count'] : '' ;

        $this->render_content($instance);
    }

    /**
     * Render widget content
     *
     * @param  array $instance
     */
    protected function render_content( $instance )
    {
        $this->data_cache = get_option( $this->cache_key, array() );

        $this->newtab = isset($instance['newtab']) ? 'target="_blank"' : '' ;

        $this->init_social($instance);

        $output =
            "<ul class=\"jeg_socialcounter {$instance['column']} {$instance['style']}\">
                {$this->content}
            </ul>";

        echo jnews_sanitize_output($output);
    }

    /**
     * Init function
     *
     * @param  array $instance
     */
    protected function init_social( $instance )
    {
        if ( ! empty( $instance['account'] ) )
        {
            $instance['account'] = json_decode( urldecode( $instance['account'] ) );

            if ( is_array( $instance['account'] ) )
            {
                foreach ( $instance['account'] as $social )
                {
                    if (  empty( $social ) || ( empty( $social->social_url ) && $social->social_icon !== 'rss' ) )
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
        switch ( $data->social_icon )
        {
            case 'facebook':
                $social_id = parse_url( $data->social_url );
                $social_id = trim( $social_id['path'], '/' );

                if ( !empty($social_id) && !empty($this->fb_key)  )
                {
                    $array = array(
                        'social_type'    => 'facebook',
                        'social_id'      => $social_id,
                        'social_text'    => jnews_return_translation('Fan', 'jnews', 'fan'),
                        'social_url'     => $data->social_url,
                        'social_grab'    => 'https://graph.facebook.com/v2.8/' . $social_id . '?access_token=' . apply_filters( 'jnews_facebook_token_access', $this->fb_key ) . '&fields=fan_count',
                    );

                    $this->check_cache($array);
                }
                break;

            case 'twitter':
                $social_id = parse_url( $data->social_url );
                $social_id = trim( $social_id['path'], '/' );

                if ( !empty($social_id) )
                {
                    $array = array(
                        'social_type'    => 'twitter',
                        'social_id'      => $social_id,
                        'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
                        'social_url'     => $data->social_url,
                        'social_grab'    => $data->social_url,
                    );
                    $this->check_cache($array);
                }
                break;

            case 'instagram':
                $social_id = parse_url( $data->social_url );
                $social_id = trim( $social_id['path'], '/' );

                if ( !empty($social_id) )
                {
                    $array = array(
                        'social_type'    => 'instagram',
                        'social_id'      => $social_id,
                        'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
                        'social_url'     => $data->social_url,
                        'social_grab'    => $data->social_url,
                    );
                    $this->check_cache($array);
                }
                break;

            case 'pinterest':
                $social_id = parse_url( $data->social_url );
                $social_id = trim( $social_id['path'], '/' );

                if ( !empty($social_id) )
                {
                    $array = array(
                        'social_type'    => 'pinterest',
                        'social_id'      => $social_id,
                        'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
                        'social_url'     => $data->social_url,
                        'social_grab'    => $data->social_url,
                    );
                    $this->check_cache($array);
                }
                break;

            case 'vimeo':
                $social_id = parse_url( $data->social_url );
                $social_id = trim( $social_id['path'], '/' );

                if ( !empty($social_id) )
                {
                    $array = array(
                        'social_type'    => 'vimeo',
                        'social_id'      => $social_id,
                        'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
                        'social_url'     => $data->social_url,
                        'social_grab'    => 'https://vimeo.com/' . $social_id . '/following/followers/',
                    );
                    $this->check_cache($array);
                }
                break;

            case 'soundcloud':
                $social_id = parse_url( $data->social_url );
                $social_id = trim( $social_id['path'], '/' );

                if ( !empty($social_id) )
                {
                    $array = array(
                        'social_type'    => 'soundcloud',
                        'social_id'      => $social_id,
                        'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
                        'social_url'     => $data->social_url,
                        'social_grab'    => $data->social_url,
                    );
                    $this->check_cache($array);
                }
                break;

            case 'google-plus':
                $social_id = parse_url( $data->social_url );
                $social_id = trim( $social_id['path'], '/' );
                $social_id = explode( '/', $social_id );
                $social_id = end( $social_id );

                if ( !empty($social_id) && !empty($this->gg_key) )
                {
                    $array = array(
                        'social_type'    => 'google-plus',
                        'social_id'      => $social_id,
                        'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
                        'social_url'     => $data->social_url,
                        'social_grab'    => 'https://www.googleapis.com/plus/v1/people/' . $social_id . '?key=' . apply_filters( 'jnews_googleplus_token_access', $this->gg_key ),
                    );
                    $this->check_cache($array);
                }
                break;

            case 'behance':
                $social_id = parse_url( $data->social_url );
                $social_id = trim( $social_id['path'], '/' );

                if ( !empty($social_id) && !empty($this->bh_key) )
                {
                    $array = array(
                        'social_type'    => 'behance',
                        'social_id'      => $social_id,
                        'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
                        'social_url'     => $data->social_url,
                        'social_grab'    => 'https://api.behance.net/v2/users/' . $social_id . '?client_id=' . apply_filters( 'jnews_behance_token_access', $this->bh_key ),
                    );
                    $this->check_cache($array);
                }
                break;

            case 'flickr':
                $social_id = parse_url( $data->social_url );
                $social_id = trim( $social_id['path'], '/' );
                $social_id = str_replace( 'photos/', '', $social_id );

                if ( !empty($social_id) )
                {
                    $array = array(
                        'social_type'    => 'flickr',
                        'social_id'      => $social_id,
                        'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
                        'social_url'     => $data->social_url,
                        'social_grab'    => $data->social_url,
                    );
                    $this->check_cache($array);
                }
                break;

            case 'twitch':
                $social_id = parse_url( $data->social_url );
                $social_id = trim( $social_id['path'], '/' );

                if ( !empty($social_id) && !empty($this->twitch_key) )
                {
                    $array = array(
                        'social_type'    => 'twitch',
                        'social_id'      => $social_id,
                        'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
                        'social_url'     => $data->social_url,
                        'social_grab'    => 'https://api.twitch.tv/kraken/channels/' . $social_id . '?client_id=' . apply_filters( 'jnews_twitch_token_access', $this->twitch_key ),
                    );
                    $this->check_cache($array);
                }
                break;

            case 'vk':
                $social_id = parse_url( $data->social_url );
                $social_id = trim( $social_id['path'], '/' );

                if ( !empty($social_id) )
                {
                    $array = array(
                        'social_type'    => 'vk',
                        'social_id'      => $social_id,
                        'social_text'    => jnews_return_translation('Follower', 'jnews', 'follower'),
                        'social_url'     => $data->social_url,
                        'social_grab'    => 'https://api.vk.com/method/users.getFollowers?user_id=' . $this->vk_id,
                    );
                    $this->check_cache($array);
                }
                break;

            case 'youtube':
                $social_id = parse_url( $data->social_url );
                $social_id = trim( $social_id['path'], '/' );

                if ( !empty($social_id) && !empty($this->gg_key) )
                {
                    $array = array(
                        'social_type'    => 'youtube',
                        'social_text'    => jnews_return_translation('Subscriber', 'jnews', 'subscriber'),
                        'social_url'     => $data->social_url,
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
                        'social_url'     => empty( $data->social_url ) ? esc_url( home_url() . '/feed' ) : $data->social_url,
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
                        if (!empty($result['entry_data']['ProfilePage'][0]['graphql']['user']['edge_followed_by']['count']))
                        {
                            return $result['entry_data']['ProfilePage'][0]['graphql']['user']['edge_followed_by']['count'];
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

    protected function get_widget_template()
    {
    }
}