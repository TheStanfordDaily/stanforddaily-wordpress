<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal\Element;

use JNews\Widget\Normal\NormalWidgetInterface;

Class FlickrWidget implements NormalWidgetInterface
{
    /**
     * @var string
     */
    private $cache_key = "jnews_flickr_widget_cache";

    /**
     * @var integer
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

            'username' => array(
                'title'     => esc_html__('Flickr Username', 'jnews'),
                'desc'      => esc_html__('Insert your Flickr username.', 'jnews'),
                'type'      => 'text',
            ),

            'id' => array(
                'title'     => esc_html__('Flickr ID', 'jnews'),
                'desc'      => sprintf(__('Get your user id from your Flickr account <a href="%s" target="_blank">here</a>.', 'jnews'), 'http://www.webpagefx.com/tools/idgettr/'),
                'type'      => 'text'
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
                    'max'  => '5',
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
                    'zoom'    => esc_html__('Zoom', 'jnews'),
                    ''        => esc_html__('No Effect', 'jnews'),
                )
            ),

            'button' => array(
                'title'     => esc_html__('Follow Button Text', 'jnews'),
                'desc'      => esc_html__('Leave it empty if you wont to show it.', 'jnews'),
                'type'      => 'text',
            ),

            'newtab' => array(
                'title'     => esc_html__('Open New Tab', 'jnews'),
                'desc'      => esc_html__('Open Flickr profile page on new tab.', 'jnews'),
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
        if ( !empty( $instance['username'] ) && !empty( $instance['id'] ) )
        {
            $this->row    = $instance['row'];
            $this->column = $instance['column'];
            $this->hover  = $instance['hover'];
            $this->count  = $this->row * $this->column;
            $this->newtab = isset($instance['newtab']) ? 'target=\'_blank\'' : '';

            if ( !empty( $instance['button'] ) )
            {
                $this->button =
                    '<h3 class=\'jeg_flickr_heading\'>
                    <a href=\'//www.flickr.com/photos/' . $instance['username'] . '\' ' . $this->newtab . '><i class="fa fa-flickr"></i> ' . esc_html( $instance['button'] ) . '</a>
                </h3>';
            } else {
                $this->button = '';
            }

            $this->check_cache( $instance['id'], $this->count );
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
            $content = $this->build_content( $data );
        }

        $output = 
            "<div class='jeg_flickr_widget jeg_grid_thumb_widget clearfix'>
                {$this->button}
                <ul class='flickr-pics col{$this->column} {$this->hover}'>
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
        $content = '';
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

            $image_tag = apply_filters('jnews_single_image', $this->get_secure_url( $image['media']['thumb'] ), $image['title'], '1000');

            $content .= 
                "<li class='{$class}'>
                    <a href='{$image['link'] }' {$this->newtab}>
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

    protected function get_secure_url( $url )
    {
        $url = preg_replace( "/^http:/i", "https:", $url );

        return $url;
    }
    
    /**
     * Check Data Cached
     * 
     * @param  string  $id
     * @param  integer $count 
     * 
     */
    protected function check_cache( $id, $count )
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
                if ( $data['id'] == $id ) 
                {
                    $add_feed = false;

                    if ( count( $data['feed'] ) >= $count ) 
                    {
                        if ( $data['time'] < ( $now - $expire ) )
                        {
                            $data_feed = $this->fetch_data( $id, $count );

                            if ( ! empty( $data_feed ) ) 
                            {
                                $data['feed'] = $data_feed;
                                $data['time'] = current_time('timestamp');
                                $update_feed  = true;
                            }
                        }
                    } else {
                        $data_feed = $this->fetch_data( $id, $count );

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
            $data_feed = $this->fetch_data( $id, $count );

            if ( ! empty( $data_feed ) ) 
            {
                $data_cache[] = array(
                    'id'   => $id,
                    'time' => current_time('timestamp'),
                    'feed' => $data_feed
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
     * @param  string $id   
     * @param  int    $count
     * 
     * @return array
     * 
     */
    protected function fetch_data( $id, $count )
    {
        $response = wp_remote_get( $this->get_url( $id ) , array(
            'timeout' => 10,
        ));

        if ( !is_wp_error( $response ) && $response['response']['code'] == '200' ) 
        {   
            $data_images = array();
            $data_json = str_replace( "\\'", "'", $response['body'] );
            $data_json = json_decode( $data_json, TRUE );
            $data_json = $data_json['items'];

            if ( is_array( $data_json ) && !empty( $data_json ) ) 
            {
                foreach ( $data_json as $image ) 
                {
                    $image['title']           = !empty( $image['title'] ) ? preg_replace('/[^a-zA-Z0-9\-]/', ' ', $image['title']) : '';
                    $image['description']     = !empty( $image['description'] ) ? preg_replace('/[^a-zA-Z0-9\-]/', ' ', $image['description']) : '';
                    $image['media']['thumb']  = preg_replace( '/_m\.(jp?g|png|gif)$/', '_q_d.\\1', $image['media']['m'] );

                    $data_images[] = $image;

                    if ( count($data_images) >= $count ) 
                    {
                        break;
                    }
                }

                return $data_images;
            }
        }

        return null;
    }

    /**
     * Get url for fetch data
     * 
     * @param  string $id
     * 
     * @return string
     * 
     */
    protected function get_url( $id )
    {
        return 'http://api.flickr.com/services/feeds/photos_public.gne?format=json&id=' . $id . '&nojsoncallback=1';
    }

    protected function get_widget_template()
    {
    }
}