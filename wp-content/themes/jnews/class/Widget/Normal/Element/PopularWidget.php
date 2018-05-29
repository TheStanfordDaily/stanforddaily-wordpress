<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal\Element;

use JNews\Widget\Normal\NormalWidgetInterface;

Class PopularWidget implements NormalWidgetInterface
{
    /**
     * Register widget with WordPress.
     */
    public function get_options()
    {
        $fields = array();

        if(!class_exists('JNews_View_Counter') || !class_exists('JNews_Share_Bar'))
        {
            $fields['plugin'] = array(
                'title'     => esc_html__('Info : ', 'jnews'),
                'desc'      => esc_html__('This widget requires JNews View Counter Plugin & JNews Social Share to be installed.', 'jnews'),
                'type'      => 'alert',
            );
        }

        $fields['title'] = array(
            'title'     => esc_html__('Title', 'jnews'),
            'desc'      => esc_html__('Title on widget header.', 'jnews'),
            'type'      => 'text'
        );

        $fields['limit'] = array(
            'title'     => esc_html__('Total limit post', 'jnews'),
            'desc'      => esc_html__('Set the number of post shown on widget.', 'jnews'),
            'type'      => 'slider',
            'options'    => array(
                'min'  => '2',
                'max'  => '10',
                'step' => '1',
            ),
            'default'   => 5,
        );

        $fields['order_by'] = array(
            'title'     => esc_html__('Order Popular Post By', 'jnews'),
            'desc'      => esc_html__('Choose which order criteria.', 'jnews'),
            'type'      => 'select',
            'default'   => 'views',
            'options'   => array(
                'comments'      => esc_html__('Comments', 'jnews'),
                'views'         => esc_html__('Total Views', 'jnews'),
                'avg'           => esc_html__('Average Daily Views', 'jnews'),
            )
        );

        $fields['range'] = array(
            'title'     => esc_html__('Time Range', 'jnews'),
            'desc'      => esc_html__('Choose time range for this field.', 'jnews'),
            'type'      => 'select',
            'default'   => 'all',
            'options'   => array(
                'daily'      => esc_html__('Last 24 hours', 'jnews'),
                'weekly'     => esc_html__('Last 7 days', 'jnews'),
                'monthly'    => esc_html__('Last 30 days', 'jnews'),
                'all'        => esc_html__('All-time', 'jnews'),
            )
        );

        return $fields;
    }

    public function render_content($mostpopular)
    {
        $output = '<ul class="popularpost_list">';

        foreach($mostpopular as $key => $value)
        {
            switch($key) {
                case 0 :
                    $output .= $this->first_item($key, $value);
                    break;
                default :
                    $output .= $this->next_item($key, $value);
                    break;
            }
        }

        $output .= '</ul>';

        return $output;
    }

    public function first_item($key, $value)
    {
        $key        = sprintf('%02d', $key + 1);
        $title      = get_the_title($value->ID);
        $permalink  = get_the_permalink($value->ID);
        $thumbnail  = apply_filters('jnews_image_thumbnail', $value->ID, 'jnews-350x250');

        $total_share            = apply_filters('jnews_total_share', 0, $value->ID);
        $facebook_share         = apply_filters('jnews_total_share_social', 0, $value->ID, 'facebook');
        $twitter_share          = apply_filters('jnews_total_share_social', 0, $value->ID, 'twitter');

        $facebook_share_url     = apply_filters('jnews_social_share_url', '', $value->ID, 'facebook');
        $twitter_share_url      = apply_filters('jnews_social_share_url', '', $value->ID, 'twitter');

        $output =
            "<li " . jnews_post_class("popularpost_item", $value->ID) . ">
                <div class=\"jeg_thumb\">
                    " . jnews_edit_post( $value->ID ) . "
                    <a href=\"{$permalink}\">{$thumbnail}</a>
                </div>
                <h3 class=\"jeg_post_title\">
                    <a href=\"{$permalink}\" data-num=\"{$key}\">{$title}</a>
                </h3>
                <div class=\"popularpost_meta\">
                    <div class=\"jeg_socialshare\">
                        <span class=\"share_count\"><i class=\"fa fa-share-alt\"></i> {$total_share} " . jnews_return_translation('shares', 'jnews', 'shares') . "</span>
                        <div class=\"socialshare_list\">
                            <a href=\"{$facebook_share_url}\" class=\"jeg_share_fb\"><span class=\"share-text\">" . jnews_return_translation('Share', 'jnews', 'share') . "</span> <span class=\"share-count\">{$facebook_share}</span></a>
                            <a href=\"{$twitter_share_url}\" class=\"jeg_share_tw\"><span class=\"share-text\">" . jnews_return_translation('Tweet', 'jnews', 'tweet') . "</span> <span class=\"share-count\">{$twitter_share}</span></a>
                        </div>
                    </div>
                </div>
            </li>";

        return $output;
    }

    public function next_item($key, $value)
    {
        $key        = sprintf('%02d', $key + 1);
        $title      = get_the_title($value->ID);
        $permalink  = get_the_permalink($value->ID);

        $total_share            = apply_filters('jnews_total_share', 0, $value->ID);
        $facebook_share         = apply_filters('jnews_total_share_social', 0, $value->ID, 'facebook');
        $twitter_share          = apply_filters('jnews_total_share_social', 0, $value->ID, 'twitter');

        $facebook_share_url     = apply_filters('jnews_social_share_url', '', $value->ID, 'facebook');
        $twitter_share_url      = apply_filters('jnews_social_share_url', '', $value->ID, 'twitter');

        $output =
            "<li " . jnews_post_class("popularpost_item", $value->ID) . ">
                <h3 class=\"jeg_post_title\">
                    <a href=\"{$permalink}\" data-num=\"{$key}\">{$title}</a>
                </h3>
                <div class=\"popularpost_meta\">
                    <div class=\"jeg_socialshare\">
                        <span class=\"share_count\"><i class=\"fa fa-share-alt\"></i> {$total_share} " . jnews_return_translation('shares', 'jnews', 'shares') . "</span>
                        <div class=\"socialshare_list\">
                            <a href=\"{$facebook_share_url}\" class=\"jeg_share_fb\"><span class=\"share-text\">" . jnews_return_translation('Share', 'jnews', 'share') . "</span> <span class=\"share-count\">{$facebook_share}</span></a>
                            <a href=\"{$twitter_share_url}\" class=\"jeg_share_tw\"><span class=\"share-text\">" . jnews_return_translation('Tweet', 'jnews', 'tweet') . "</span> <span class=\"share-count\">{$twitter_share}</span></a>
                        </div>
                    </div>
                </div>
            </li>";

        return $output;
    }

    public function render_widget($instance, $text_content = null)
    {
        if(class_exists('JNews_View_Counter'))
        {
            $query_result = jnews_view_counter_query(array(
                'order_by'  => isset($instance['order_by']) ? $instance['order_by'] : 'views',
                'limit'     => isset($instance['limit']) ? $instance['limit'] : 5,
                'range'     => isset($instance['range']) ? $instance['range'] : 'all',
                'post_type' => 'post',
            ));

            echo jnews_sanitize_output($this->render_content($query_result['result']));
        } else {

            echo
                "<div class=\"alert alert-error\">
                    <strong>" . esc_html__('Plugin Install','jnews') . "</strong>" . ' : ' . esc_html__('Popular Post Widget need JNews - View Counter to be installed', 'jnews') .
                "</div>";
        }
    }
}