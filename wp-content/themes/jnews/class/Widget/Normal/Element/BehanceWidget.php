<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal\Element;

use JNews\Widget\Normal\NormalWidgetInterface;

Class BehanceWidget implements NormalWidgetInterface
{
    /**
     * @var string
     */
    private $cache_key = "jnews_behance_widget_cache";

    /**
     * @var integer
     */
    private $count;
    private $next = 2;

    public function get_options()
    {
        return array (
            'title' => array(
                'title'     => esc_html__('Title', 'jnews'),
                'desc'      => esc_html__('Title on widget header.', 'jnews'),
                'type'      => 'text'
            ),

            'token' => array(
                'title'     => esc_html__('Behance API Key', 'jnews'),
                'desc'      => sprintf(__('Register Behance API key from your Behance account <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://www.behance.net/dev/register'),
                'type'      => 'text',
            ),

            'username' => array(
                'title'     => esc_html__('Behance Username', 'jnews'),
                'desc'      => esc_html__('Insert your Behance username.', 'jnews'),
                'type'      => 'text',
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
                    'normal'  => esc_html__('Normal', 'jnews'),
                    'icon'    => esc_html__('Show Icon', 'jnews'),
                    'like'    => esc_html__('Show Appreciation Count', 'jnews'),
                    'view'    => esc_html__('Show View Count', 'jnews'),
                    'comment' => esc_html__('Show Comment Count', 'jnews'),
                    'zoom'    => esc_html__('Zoom', 'jnews'),
                    ''        => esc_html__('No Effect', 'jnews'),
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
                    'most_like'     => esc_html__('Most Appreciated', 'jnews'),
                    'least_like'    => esc_html__('Least Appreciated', 'jnews'),
                    'most_view'     => esc_html__('Most Viewed', 'jnews'),
                    'least_view'    => esc_html__('Least Viewed', 'jnews'),
                    'most_comment'  => esc_html__('Most Commented', 'jnews'),
                    'least_comment' => esc_html__('Least Commented', 'jnews'),
                )
            ),

            'follow_button' => array(
                'title'     => esc_html__('Follow Button Text', 'jnews'),
                'desc'      => esc_html__('Leave it empty if you wont to show it.', 'jnews'),
                'type'      => 'text',
            ),

            'newtab' => array(
                'title'     => esc_html__('Open New Tab', 'jnews'),
                'desc'      => esc_html__('Open Behance profile page on new tab.', 'jnews'),
                'type'      => 'checkbox',
            ),
        );
    }

    /**
     * Initialize Widget
     * 
     * @param  array  $instance
     * 
     */
    public function render_widget( $instance, $text_content = null )
    {
        if ( !empty( $instance['username'] ) && !empty( $instance['token'] ) )
        {
            $this->row    = $instance['row'];
            $this->column = $instance['column'];
            $this->hover  = $instance['hover'];
            $this->sort   = $instance['sort'];
            $this->count  = $this->row * $this->column;
            $this->newtab = isset( $instance['newtab'] ) ? 'target=\'_blank\'' : '';

            if ( !empty( $instance['follow_button'] ) )
            {
                $this->button =
                    '<h3 class=\'jeg_behance_heading\'>
                    <a href=\'//www.behance.net/' . $instance['username'] . '\' ' . $this->newtab . '><i class="fa fa-behance"></i> ' . esc_html( $instance['follow_button'] ) . '</a>
                </h3>';
            } else {
                $this->button = '';
            }

            $this->check_cache( $instance['username'], $instance['token'], $this->count );
        }
    }

    /**
     * Render Widget Content
     * 
     * @param  array  $data
     * 
     */
    protected function render_content( $data )
    {
        $content = '';

        if ( !empty( $data ) && is_array( $data ) ) 
        {
            $data = $this->sort_data( $data );
            $content = $this->build_content( $data );
        }

        $output = 
            "<div class='jeg_behance_widget jeg_grid_thumb_widget clearfix'>
                {$this->button}
                <ul class='behance-pics col{$this->column} {$this->hover}'>
                    {$content}
                </ul>
            </div>";

        echo jnews_sanitize_output($output);
    }

    /**
     * Build Widget Content
     * 
     * @param  array  $data
     * 
     * @return string
     * 
     */
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
                $like =  "<i class='fa fa-thumbs-up'>" . jnews_number_format( $image['like'] ) . "</i>";
            } elseif ( $this->hover == 'comment' ) {
                $like =  "<i class='fa fa-comments'>" . jnews_number_format( $image['comment'] ) . "</i>";
            } elseif ( $this->hover == 'view' ) {
                $like =  "<i class='fa fa-eye'>" . jnews_number_format( $image['view'] ) . "</i>";
            }

            $image_tag = apply_filters('jnews_single_image', $image['thumb'], $image['title'], false);

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

    /**
     * Data Sort
     * 
     * @param  array  $data
     * 
     * @return array
     * 
     */
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
            case 'most_view':
                usort($data, function($a, $b)
                {
                    return $b['view'] - $a['view'];
                });
                break;
            case 'least_view':
                usort($data, function($a, $b)
                {
                    return $a['view'] - $b['view'];
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
    
    /**
     * Check Data Cached
     * 
     * @param  string  $username
     * @param  string  $token
     * @param  integer $count
     * 
     */
    protected function check_cache( $username, $token, $count )
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
                            $data_feed = $this->fetch_data( $username, $token, $count );

                            if ( ! empty( $data_feed ) ) 
                            {
                                $data['feed'] = $data_feed;
                                $data['time'] = current_time('timestamp');
                                $update_feed  = true;
                            }
                        }
                    } else {
                        $data_feed = $this->fetch_data( $username, $token, $count );

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
            $data_feed = $this->fetch_data( $username, $token, $count );

            if ( ! empty( $data_feed ) ) 
            {
                $data_cache[] = array(
                    'username' => $username,
                    'time'     => current_time('timestamp'),
                    'feed'     => $data_feed
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

    /**
     * Fetch data
     * 
     * @param  string  $username
     * @param  string  $token
     * @param  int     $count
     * @param  string  $next
     * 
     * @return array
     * 
     */
    protected function fetch_data( $username, $token, $count = 12, $next = '' )
    {
        $response = wp_remote_get( $this->get_url( $username, $token, $next ) , array(
            'timeout' => 10,
        ));

        if ( !is_wp_error( $response ) && $response['response']['code'] == '200' ) 
        {   
            $data_projects = array();
            $data_json     = json_decode( $response['body'], TRUE );
            $data_json     = $data_json['projects'];

            if ( is_array( $data_json ) && !empty( $data_json ) ) 
            {
                foreach ( $data_json as $project ) 
                {
                    $data_projects[] = array(
                        'title'       => $project['name'],
                        'like'        => $project['stats']["appreciations"],
                        'comment'     => $project['stats']["comments"],
                        'view'        => $project['stats']["views"],
                        'time'        => $project['published_on'],
                        'tag'         => $project['fields'],
                        'link'        => $project['url'],
                        'thumb'       => $project['covers']['202'],
                    );

                    if ( count($data_projects) >= $count ) 
                    {
                        break;
                    }
                }

                if ( (($count - count($data_projects)) > 0) && (count($data_projects) % 12 == 0) && (count($data_projects) > 0) ) 
                {
                    $next_projects = $this->fetch_data( $username, $token, ($count - 12), $this->next++ );

                    if ( !is_wp_error( $response ) && $response['response']['code'] == '200' )
                    {
                        $data_projects = array_merge( $data_projects, $next_projects );
                    }
                }

                return $data_projects;
            }
        }
        
        return null;
    }

    /**
     * Get url for fetch data
     * 
     * @param  string  $username
     * @param  string  $token
     * @param  string  $next
     * 
     * @return string
     * 
     */
    protected function get_url( $username, $token, $next )
    {
        if ( empty( $next ) ) 
        {
            return 'https://api.behance.net/v2/users/' . $username . '/projects?client_id=' . $token ;
        } else {
            return 'https://api.behance.net/v2/users/' . $username . '/projects?client_id=' . $token . '&page=' . $next;
        }
    }

    protected function get_widget_template()
    {
    }
}