<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal\Element;

use JNews\Widget\Normal\WidgetNormalAbstract;

Class DribbbleWidget extends WidgetNormalAbstract
{
    /**
     * @var string
     */
    private $cache_key = "jnews_dribbble_widget_cache";

    /**
     * @var integer
     */
    private $count;
    private $next = 2;


    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {   
        $this->fields = array (
            'title' => array(
                'title'     => esc_html__('Title', 'jnews'),
                'desc'      => esc_html__('Title on widget header.', 'jnews'),
                'type'      => 'text'
            ),

            'token' => array(
                'title'     => esc_html__('Dribbble Access Token', 'jnews'),
                'desc'      => sprintf(__('Register Dribbble access token from your Dribbble account <a href="%s" target="_blank">here</a>.', 'jnews'), 'https://dribbble.com/account/applications'),
                'type'      => 'text',
            ),

            'username' => array(
                'title'     => esc_html__('Dribbble Username', 'jnews'),
                'desc'      => esc_html__('Insert your Dribbble username.', 'jnews'),
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
                    'like'    => esc_html__('Show Like Count', 'jnews'),
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
                    'most_like'     => esc_html__('Most Liked', 'jnews'),
                    'least_like'    => esc_html__('Least Liked', 'jnews'),
                    'most_view'     => esc_html__('Most Viewed', 'jnews'),
                    'least_view'    => esc_html__('Least Viewed', 'jnews'),
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
                'desc'      => esc_html__('Open Dribbble profile page on new tab.', 'jnews'),
                'type'      => 'checkbox',
            ),
        );

        parent::__construct (
            'jnews_dribbble', // Base ID
            esc_html__('JNews : Dribbble', 'jnews'), // Name
            array( 'description' =>  esc_html__('Dribbble widget for JNews', 'jnews') ) // Args
        );
    }

    /**
     * Initialize Widget
     * 
     * @param  array  $args
     * @param  array  $instance
     * 
     */
    public function widget( $args, $instance )
    {
        $title = apply_filters( 'widget_title', isset($instance['title']) ? $instance['title'] : "" );

        echo jnews_sanitize_output($args['before_widget']);

        if ( ! empty( $title ) ) 
        {
            echo jnews_sanitize_output($args['before_title']) . esc_html( $title ) . jnews_sanitize_output($args['after_title']);
        }

        if ( !empty( $instance['username'] ) && !empty( $instance['token'] ) ) 
        {
            $this->init_dribbble( $instance );
        }

        echo jnews_sanitize_output($args['after_widget']);
    }

    /**
     * Initialize Widget
     * 
     * @param  array  $instance
     * 
     */
    protected function init_dribbble( $instance )
    {
        $this->row    = $instance['row'];
        $this->column = $instance['column'];
        $this->hover  = $instance['hover'];
        $this->sort   = $instance['sort'];
        $this->count  = $this->row * $this->column;
        $this->newtab = isset($instance['newtab']) ? 'target=\'_blank\'' : '';

        if ( !empty( $instance['button'] ) ) 
        {
            $this->button = 
                '<h3 class=\'jeg_dribbble_heading\'>
                    <a href=\'//www.dribbble.com/' . $instance['username'] . '\' ' . $this->newtab . '><i class="fa fa-dribbble"></i> ' . esc_html( $instance['button'] ) . '</a>
                </h3>';
        } else {
            $this->button = '';
        }

        $this->check_cache( $instance['username'], $instance['token'], $this->count );
    }

    /**
     * Render Widget Content
     * 
     * @param  array $data
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
            "<div class='jeg_dribbble_widget jeg_grid_thumb_widget clearfix'>
                {$this->button}
                <ul class='dribbble-pics col{$this->column} {$this->hover}'>
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
                $like =  "<i class='fa fa-heart'>" . jnews_number_format( $image['like'] ) . "</i>";
            } elseif ( $this->hover == 'comment' ) {
                $like =  "<i class='fa fa-comments'>" . jnews_number_format( $image['comment'] ) . "</i>";
            } elseif ( $this->hover == 'view' ) {
                $like =  "<i class='fa fa-eye'>" . jnews_number_format( $image['view'] ) . "</i>";
            }

            $image_tag = apply_filters('jnews_single_image', $image['thumb'], $image['title'], '1000');

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
        // $data_cached  = get_option( $this->cache_key );
        // $now          = current_time('timestamp');
        // $data_feed    = null;
        // $add_feed     = true;
        // $expire       = 60 * 60 * 24; // set expire in 1 day

        // if ( !empty( $data_cached ) && is_array( $data_cached ) ) 
        // {
        //     foreach ( $data_cached as $data ) 
        //     {
        //         if ( $data['username'] == $username ) 
        //         {
        //             $add_feed = false;

        //             if ( count( $data['feed'] ) >= $count ) 
        //             {
        //                 if ( $data['time'] < ( $now - $expire ) )
        //                 {
        //                     $this->add_queue(array(
        //                         'username' => $username,
        //                         'token'    => $token,
        //                         'count'    => $count
        //                     ));
        //                 } 
        //             } else {
        //                 $this->add_queue(array(
        //                     'username' => $username,
        //                     'token'    => $token,
        //                     'count'    => $count
        //                 ));
        //             }   

        //             $data_feed = $data['feed'];
        //         }
        //     }

        //     if ( $add_feed ) 
        //     {
        //         $this->add_queue(array(
        //             'username' => $username,
        //             'token'    => $token,
        //             'count'    => $count
        //         ));
        //     }

        // } else {
        //     $this->add_queue(array(
        //         'username' => $username,
        //         'token'    => $token,
        //         'count'    => $count
        //     ));
        // }

        // if ( !empty( $data_feed ) ) 
        // {
        //     $this->render_content( $data_feed );
        // }
    }

    protected function get_widget_template()
    {
    }
}