<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module;

/**
 * Class JNews Query
 */
Class ModuleQuery
{
    private static $cache_thumbnail = array();

    /**
     * @param $attr
     * @return array
     */
    public static function do_query($attr)
    {
        $attr = self::unset_unnecessary($attr);
        $query_hash = 'query_hash_' . md5 ( serialize( $attr ) );

	    if( ! $result = wp_cache_get($query_hash, 'jnews') )
        {
            if( $attr['sort_by'] === 'most_comment_day'     ||
                $attr['sort_by'] === 'most_comment_week'    ||
                $attr['sort_by'] === 'most_comment_month'   ||
                $attr['sort_by'] === 'popular_post_day'     ||
                $attr['sort_by'] === 'popular_post'         ||
                $attr['sort_by'] === 'popular_post_week'    ||
                $attr['sort_by'] === 'popular_post_month' )
            {
                $result = self::custom_query($attr);
            } else if(
                $attr['sort_by'] === 'popular_post_jetpack_day'     ||
                $attr['sort_by'] === 'popular_post_jetpack_week'    ||
                $attr['sort_by'] === 'popular_post_jetpack_month'   ||
                $attr['sort_by'] === 'popular_post_jetpack_all' )
            {
                $result = self::jetpack_query($attr);
            } else
            {
                $result = self::default_query($attr);
            }

            wp_cache_set($query_hash, $result, 'jnews');

            // need to optimize query
            self::optimize_query($result);
        }

        return $result;
    }

    private static function unset_unnecessary($attr)
    {
        $accepted = array(
            'post_type',
            'number_post',
            'post_offset',
            'include_post',
            'exclude_post',
            'include_category',
            'exclude_category',
            'include_author',
            'include_tag',
            'exclude_tag',
            'sort_by',
            'paged',
            'video_only',
            'content_type',
            'pagination_number_post',
            'pagination_mode',
            'date_query'
        );

        foreach($attr as $key => $value)
        {
            if( ! in_array($key, $accepted) )
            {
                unset($attr[$key]);
            }
        }

        if(isset($attr['pagination_number_post'])) {
            $attr['pagination_number_post'] = intval($attr['pagination_number_post']);
        }

        if(isset($attr['paged'])) {
            $attr['paged'] = intval($attr['paged']);
        }

        if(isset($attr['number_post']['size'])) {
            $attr['number_post'] = $attr['number_post']['size'];
        }

        return $attr;
    }

    /**
     * @param $result
     */
    private static function optimize_query($result)
    {
        self::cache_thumbnail($result);
    }

    /**
     * @param $results
     */
    public static function cache_thumbnail($results)
    {
        $thumbnails = array();

        foreach($results['result'] as $result)
        {
            if( ! in_array( $result->ID, self::$cache_thumbnail ))
            {
                $thumbnails[] = get_post_thumbnail_id($result->ID);
                self::$cache_thumbnail[] = $result->ID;
            }
        }

        if(!empty($thumbnails))
        {
            $query = array(
                'post__in'  => $thumbnails,
                'post_type' => 'attachment',
                'showposts' => count( $thumbnails )
            );

            get_posts( $query );
        }
    }

    /**
     * Jetpack Query
     *
     * @param $attr
     * @return array
     */
    private static function jetpack_query($attr)
    {
        $result = array();

        if(function_exists('stats_get_csv'))
        {
            switch( $attr['sort_by'] ){
                case 'popular_post_jetpack_week':
                    $days = 7;
                    break;
                case 'popular_post_jetpack_month':
                    $days = 30;
                    break;
                case 'popular_post_jetpack_day' :
                    $days = 2;
                    break;
                case 'popular_post_jetpack_all':
                default:
                    $days = -1;
                    break;
            }

            $top_posts = stats_get_csv( 'postviews', array( 'days' => $days, 'limit' => $attr['number_post'] + 5 ) );

            if( !$top_posts ){
                return array();
            }

            $counter = 0;
            foreach($top_posts as $post)
            {
                $the_post = get_post( $post['post_id'] );

                if ( !$the_post ) continue;
                if( 'post' != $the_post->post_type ) continue;

                $counter++;
                $result[] =  get_post($post['post_id']);

                if( $counter == $attr['number_post'] )
                    break;
            }
        }

        return array(
            'result'        => $result,
            'next'          => false,
            'prev'          => false,
            'total_page'    => 1
        );

    }

    /**
     * WordPress Default Query
     *
     * @param $attr
     * @return array
     */
    private static function default_query($attr)
    {
        $include_category = $exclude_category = $result = $args = array();

        // Argument
        $args['post_type'] = $attr['post_type'];
        $args['paged'] = isset ( $attr['paged'] ) ? $attr['paged'] : 1;
        $args['offset'] = self::calculate_offset($args['paged'], $attr['post_offset'], $attr['number_post'], $attr['pagination_number_post']);
        $args['posts_per_page'] = ( $args['paged'] > 1 ) ? $attr['pagination_number_post'] : $attr['number_post'];
        $args['no_found_rows'] = ! isset($attr['pagination_mode']) || $attr['pagination_mode'] === 'disable';
        $args['ignore_sticky_posts'] = 1;

        if(!empty($attr['include_post'])) {
            $args['post__in'] = explode(',', $attr['include_post']);
        }

        if(!empty($attr['exclude_post'])) {
            $args['post__not_in'] = explode(',', $attr['exclude_post']);
        }

        if(!empty($attr['include_category']))
        {
            $categories = explode(',', $attr['include_category']);
            self::recursive_category($categories, $include_category);
            $args['category__in'] = $include_category;
        }

        if(!empty($attr['exclude_category']))
        {
            $categories = explode(',', $attr['exclude_category']);
            self::recursive_category($categories, $exclude_category);
            $args['category__not_in'] = $exclude_category;
        }

        if(!empty($attr['include_author'])) {
            $args['author__in'] = explode(',', $attr['include_author']);
        }

        if(!empty($attr['include_tag'])) {
            $args['tag__in'] = explode(',', $attr['include_tag']);
        }

        if(!empty($attr['exclude_tag'])) {
            $args['tag__not_in'] = explode(',', $attr['exclude_tag']);
        }

        // order
        if('latest' === $attr['sort_by'])
        {
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
        }

        if('oldest' === $attr['sort_by'])
        {
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
        }

        if('alphabet_asc' === $attr['sort_by'])
        {
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
        }

        if('alphabet_desc' === $attr['sort_by'])
        {
            $args['orderby'] = 'title';
            $args['order'] = 'DESC';
        }

        if('random' === $attr['sort_by'])
        {
            $args['orderby'] = 'rand';
        }

        if('random_week' === $attr['sort_by'])
        {
            $args['orderby'] = 'rand';
            $args['date_query'] = array(
                array(
                    'after' => '1 week ago'
                )
            );
        }

        if('random_month' === $attr['sort_by'])
        {
            $args['orderby'] = 'rand';
            $args['date_query'] = array(
                array(
                    'after' => '1 year ago'
                )
            );
        }

        if('most_comment' === $attr['sort_by'])
        {
            $args['orderby'] = 'comment_count';
            $args['order'] = 'DESC';
        }

        if('rate' === $attr['sort_by'])
        {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'jnew_rating_mean';
            $args['order'] = 'DESC';
            $args['meta_query'] = array(
                'relation' => 'AND',
                array(
                    'key'     => 'enable_review',
                    'value'   => '1',
                ),
                array(
                    'key'     => 'jnew_rating_mean',
                    'value'   => '0',
                    'compare' => '>',
                ),
            );
        }

        if('share' === $attr['sort_by'])
        {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'jnews_social_counter_total';
            $args['order'] = 'DESC';
        }

        if('like' === $attr['sort_by'])
        {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'jnews_like_counter';
            $args['order'] = 'DESC';
        }

        if(isset($attr['video_only']) && $attr['video_only'] === true)
        {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array(
                        'post-format-video'
                    ),
                    'operator' => 'IN'
                )
            );
        }

        // TODO : fix kalau hanya lihat post
        if(isset($attr['content_type']))
        {
            if($attr['content_type'] === 'all') {
                // do nothing
            }

            if($attr['content_type'] === 'post') {
                add_filter('posts_join', array(__CLASS__, 'join_only_post'));
                add_filter('posts_where', array(__CLASS__, 'where_only_post'));
            }

            if($attr['content_type'] === 'review') {
                $args['meta_query'] = array(
                    array(
                        'key'     => 'enable_review',
                        'value'   => '1'
                    )
                );
            }
        }

        // date
        if ( isset( $attr['date_query'] ) ) 
        {
            $args['date_query'] = $attr['date_query'];
        }

        // Query
        $query = new \WP_Query( $args );


        foreach($query->posts as $post) {
            $result[] = $post;
        }

        wp_reset_postdata();

        if(isset($attr['content_type']) && $attr['content_type'] === 'post')
        {
            remove_filter('posts_join', array(__CLASS__, 'join_only_post'));
            remove_filter('posts_where', array(__CLASS__, 'where_only_post'));
        }

        return array(
            'result'        => $result,
            'next'          => self::has_next_page($query->found_posts, $args['paged'], $args['offset'], $attr['number_post'], $attr['pagination_number_post']),
            'prev'          => self::has_prev_page($args['paged']),
            'total_page'    => self::count_total_page($query->found_posts, $args['paged'], $args['offset'], $attr['number_post'], $attr['pagination_number_post'])
        );
    }

    public static function join_only_post($clause = '')
    {
        return $clause;
    }

    public static function where_only_post($clause = '')
    {
        global $wpdb;

        $enable_review_key   = 'enable_review';
        $enable_review_value = '1';
        $post_type           = 'post';
        $post_status         = 'publish';


        $clause .=
            $wpdb->prepare("AND {$wpdb->posts}.ID NOT IN (
                SELECT {$wpdb->posts}.ID
                    FROM {$wpdb->posts}
                    INNER JOIN {$wpdb->postmeta}
                    ON  {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id
                    WHERE
                    {$wpdb->postmeta}.meta_key = %s                    
                    AND {$wpdb->postmeta}.meta_value = %s
                    AND {$wpdb->posts}.post_type = %s
                AND {$wpdb->posts}.post_status = %s
            )", $enable_review_key, $enable_review_value, $post_type, $post_status );

        return $clause;
    }


    /**
     * JNews View Counter Query
     *
     * @param $attr
     * @return array
     */
    private static function custom_query($attr)
    {
        if(function_exists('jnews_view_counter_query'))
        {
            $exclude_category = $include_category = $args = array();

            // Argument
            $args['post_type']  = $attr['post_type'];
            $args['paged']      = isset ( $attr['paged'] ) ? $attr['paged'] : 1;
            $args['offset'] = self::calculate_offset($args['paged'], $attr['post_offset'], $attr['number_post'], $attr['pagination_number_post']);
            $args['limit'] = ( $args['paged'] > 1 ) ? $attr['pagination_number_post'] : $attr['number_post'];
            $args['no_found_rows'] = ! isset($attr['pagination_mode']) || $attr['pagination_mode'] === 'disable';

            if(!empty($attr['include_post']))
            {
                $args['include_post'] = $attr['include_post'];
            }

            if(!empty($attr['exclude_post']))
            {
                $args['exclude_post'] = $attr['exclude_post'];
            }


            if(!empty($attr['include_category']))
            {
                $categories = explode(',', $attr['include_category']);
                self::recursive_category($categories, $include_category);
                $args['include_category'] = implode(',', $include_category);
            }

            if(!empty($attr['exclude_category']))
            {
                $categories = explode(',', $attr['exclude_category']);
                self::recursive_category($categories, $exclude_category);
                $args['exclude_category'] = implode(',', $exclude_category);
            }

            if(!empty($attr['include_author'])) {
                $args['author'] = $attr['include_author'];
            }

            if(!empty($attr['include_tag'])) {
                $args['include_tag'] = $attr['include_tag'];
            }

            if(!empty($attr['exclude_tag'])) {
                $args['exclude_tag'] = $attr['exclude_tag'];
            }

            if($attr['sort_by'] === 'most_comment_day' || $attr['sort_by'] === 'most_comment_week' || $attr['sort_by'] === 'most_comment_month') {
                $args['order_by'] = 'comments';
            } else {
                $args['order_by'] = 'views';
            }

            if($attr['sort_by'] === 'most_comment_day' || $attr['sort_by'] === 'popular_post_day') {
                $args['range'] = 'daily';
            }

            if($attr['sort_by'] === 'most_comment_week' || $attr['sort_by'] === 'popular_post_week') {
                $args['range'] = 'weekly';
            }

            if($attr['sort_by'] === 'most_comment_month' || $attr['sort_by'] === 'popular_post_month') {
                $args['range'] = 'monthly';
            }

            if($attr['sort_by'] === 'popular_post') {
                $args['range'] = 'all';
            }


            return self::custom_jnews_query($args, $attr);
        } else {
            return array(
                'result' => array(),
                'next' => false,
                'prev' => false,
                'total_page' => 1
            );
        }
    }

    private static function recursive_category($categories, &$result)
    {
        foreach($categories as $category)
        {
            if(!in_array($category, $result))
            {
                $result[] = $category;
                $children = get_categories ( array( 'parent' => $category ) );

                if( ! empty( $children ) )
                {
                    $child_id = array();
                    foreach($children as $child) {
                        $child_id[] = $child->term_id;
                    }
                    self::recursive_category($child_id, $result);
                }
            }
        }
    }

    /**
     * Calculate Offset
     *
     * @param $paged
     * @param $offset
     * @param $number_post
     * @param $number_post_ajax
     * @return int
     */
    private static function calculate_offset($paged, $offset, $number_post, $number_post_ajax)
    {
        $new_offset = 0;

        if ( isset( $offset['size'] ) )
        {
			$offset = $offset['size'];
        }

        if($paged == 1) $new_offset = $offset;
        if($paged == 2) $new_offset = $number_post + $offset;
        if($paged >= 3) $new_offset = $number_post + $offset + ( $number_post_ajax * ( $paged - 2 ) );

        return $new_offset;
    }

    /**
     * Check if we have next page
     *
     * @param $total
     * @param int $curpage
     * @param int $offset
     * @param $perpage
     * @param $perpage_ajax
     * @return bool
     */
    private static function has_next_page($total, $curpage = 1, $offset = 0, $perpage, $perpage_ajax )
    {
        if($curpage == 1)
        {
            return (int) $total > (int) $offset + (int) $perpage;
        }

        if($curpage > 1) {
            return (int) $total > (int) $offset + (int) $perpage_ajax;
        }

        return false;
    }

    /**
     * Check if we have previous page
     *
     * @param int $curpage
     * @return bool
     */
    private static function has_prev_page($curpage = 1)
    {
        if($curpage <= 1)
        {
            return false;
        }

        return true;
    }

    /**
     * Get total count of total page
     *
     * @param $total
     * @param $offset
     * @param $perpage
     * @param $perpage_ajax
     * @return int
     */
    private static function count_total_page($total, $curpage = 1, $offset = 0, $perpage, $perpage_ajax)
    {
        $remain = (int) $total - ((int) $offset + (int) $perpage);

        if($remain > 0)
        {
            while($remain > 0){
                $remain  -= $perpage_ajax;
                $curpage += 1;
            }
        }

        return $curpage;
    }

    /**
     * Custom Query for JNews. Add ability to receive Paging Parameter and Tag Parameter
     *
     * @param $instance
     * @param $attr
     * @return array
     */
    private static function custom_jnews_query($instance, $attr)
    {
        if(function_exists('jnews_view_counter_query'))
        {
            $query_result = jnews_view_counter_query($instance);

            return array(
                'result'        => $query_result['result'],
                'next'          => self::has_next_page($query_result['total'], $instance['paged'], $instance['offset'], $attr['number_post'], $attr['pagination_number_post']),
                'prev'          => self::has_prev_page($instance['paged']),
                'total_page'    => self::count_total_page($query_result['total'], $instance['paged'], $instance['offset'], $attr['number_post'], $attr['pagination_number_post'])
            );

        } else {
            return array(
                'result'        => '',
                'next'          => false,
                'prev'          => false,
                'total_page'    => 0
            );
        }
    }
}