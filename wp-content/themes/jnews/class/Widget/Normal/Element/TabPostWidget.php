<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal\Element;

use JNews\Module\ModuleQuery;
use JNews\Widget\Normal\NormalWidgetInterface;

Class TabPostWidget implements NormalWidgetInterface
{
    public function get_options()
    {
        $fields = array();

        if(!class_exists('JNews_View_Counter'))
        {
            $fields['plugin'] = array(
                'title'     => esc_html__('Info : ', 'jnews'),
                'desc'      => esc_html__('Widget Tab Post needs JNews - View Counter to be installed', 'jnews'),
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
            'default'   => 4,
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

    public function trending_content($mostpopular)
    {
        $output = '';

        foreach($mostpopular as $key => $value)
        {
            $title      = get_the_title($value->ID);
            $permalink  = get_the_permalink($value->ID);
            $thumbnail  = apply_filters('jnews_image_thumbnail', $value->ID, 'jnews-120x86');
            $date       = get_the_modified_date(null, $value->ID);
            $additional_class = (!has_post_thumbnail($value->ID)) ? ' no_thumbnail' : '';

            $post_meta = ( get_theme_mod('jnews_show_block_meta', true) && get_theme_mod('jnews_show_block_meta_date', true) ) ?
                "<div class=\"jeg_post_meta\">
                    <div class=\"jeg_meta_date\"><i class=\"fa fa-clock-o\"></i> {$date}</div>
                </div>" : "";

            $output .=
                "<div " . jnews_post_class("jeg_post jeg_pl_sm" . $additional_class, $value->ID) . ">
                    <div class=\"jeg_thumb\">
                        " . jnews_edit_post( $value->ID ) . "
                        <a href=\"{$permalink}\">{$thumbnail}</a>
                    </div>
                    <div class=\"jeg_postblock_content\">
                        <h3 class=\"jeg_post_title\"><a property=\"url\" href=\"{$permalink}\">{$title}</a></h3>
                        {$post_meta}
                    </div>
                </div>";
        }

        return $output;
    }

    public function comment_content($mostpopular)
    {
        $output = '';

        foreach($mostpopular as $key => $value)
        {
            $title      = get_the_title($value->ID);
            $permalink  = get_the_permalink($value->ID);
            $thumbnail  = apply_filters('jnews_image_thumbnail', $value->ID, 'jnews-120x86');
            $comment    = jnews_get_comments_number($value->ID);
            $additional_class = (!has_post_thumbnail($value->ID)) ? ' no_thumbnail' : '';

            $post_meta = ( get_theme_mod('jnews_show_block_meta', true) && get_theme_mod('jnews_show_block_meta_comment', true) ) ?
                "<div class=\"jeg_post_meta\">
                    <div class=\"jeg_meta_like\"><i class=\"fa fa-comment-o\"></i> {$comment}</div>
                </div>" : "";

            $output .=
                "<div " . jnews_post_class("jeg_post jeg_pl_sm" . $additional_class, $value->ID) . ">
                    <div class=\"jeg_thumb\">
                        " . jnews_edit_post( $value->ID ) . "
                        <a href=\"{$permalink}\">{$thumbnail}</a>
                    </div>
                    <div class=\"jeg_postblock_content\">
                        <h3 class=\"jeg_post_title\"><a property=\"url\" href=\"{$permalink}\">{$title}</a></h3>
                        {$post_meta}
                    </div>
                </div>";
        }

        return $output;
    }

    public function render_widget($instance, $text_content = null)
    {
        $output = "<div class=\"jeg_tabpost_widget\">";

        if( ! class_exists('JNews_View_Counter') )
        {
            $output .=
                "<div class=\"alert alert-error\">
                    <strong>" . esc_html__('Plugin Install','jnews') . "</strong>" . ' : ' . esc_html__('Widget Tab Post needs JNews - View Counter to be installed', 'jnews') .
                "</div>";
        }

        $output .= $this->header_tab();
        $output .= "<div class=\"jeg_tabpost_content\">";

        $instance['limit'] = isset($instance['limit']) ? $instance['limit'] : 4;
        $instance['range'] = isset($instance['range']) ? $instance['range'] : 'all';

        $output .= $this->trending_tab($instance);
        $output .= $this->comment_tab($instance);
        $output .= $this->latest_tab($instance);

        $output .= "</div></div>";
        echo jnews_sanitize_output($output);
    }

    public function trending_tab($instance)
    {
        $output = "<div class=\"jeg_tabpost_item active\" id=\"jeg_tabpost_1\"><div class=\"jegwidgetpopular\">";
        if(function_exists('jnews_view_counter_query'))
        {
            switch($instance['range']) {
                case 'monthly' :
                    $sort_by = 'popular_post_month';
                    break;
                case 'weekly' :
                    $sort_by = 'popular_post_week';
                    break;
                case 'daily' :
                    $sort_by = 'popular_post_day';
                    break;
                default :
                    $sort_by = 'popular_post';
                    break;
            }

            $results = ModuleQuery::do_query(array(
                'post_type'                 => 'post',
                'sort_by'                   => $sort_by,
                'post_offset'               => 0,
                'number_post'               => $instance['limit'],
                'pagination_number_post'    => $instance['limit'],
            ));

            $output .= $this->trending_content($results['result']);
        }
        $output .= "</div></div>";
        return $output;
    }

    public function comment_tab($instance)
    {
        $output = "<div class=\"jeg_tabpost_item\" id=\"jeg_tabpost_2\"><div class=\"jegwidgetpopular\">";
        if(function_exists('jnews_view_counter_query'))
        {
            switch($instance['range']) {
                case 'monthly' :
                    $sort_by = 'most_comment_month';
                    break;
                case 'weekly' :
                    $sort_by = 'most_comment_week';
                    break;
                case 'daily' :
                    $sort_by = 'most_comment_day';
                    break;
                default :
                    $sort_by = 'most_comment';
                    break;
            }

            $results = ModuleQuery::do_query(array(
                'post_type'                 => 'post',
                'sort_by'                   => $sort_by,
                'post_offset'               => 0,
                'number_post'               => $instance['limit'],
                'pagination_number_post'    => $instance['limit'],
            ));

            $output .= $this->comment_content($results['result']);
        }
        $output .= "</div></div>";
        return $output;
    }

    public function latest_tab($instance)
    {
        $output = "<div class=\"jeg_tabpost_item\" id=\"jeg_tabpost_3\"><div class=\"jegwidgetpopular\">";

        $results = ModuleQuery::do_query(array(
            'post_type'                 => 'post',
            'sort_by'                   => 'latest',
            'post_offset'               => 0,
            'number_post'               => $instance['limit'],
            'pagination_number_post'    => $instance['limit'],
        ));

        foreach($results['result'] as $result)
        {
            $title      = get_the_title($result);
            $permalink  = get_the_permalink($result);
            $thumbnail  = apply_filters('jnews_image_thumbnail', $result->ID, 'jnews-120x86');
            $date       = get_the_modified_date(null, $result);
            $additional_class = (!has_post_thumbnail($result->ID)) ? ' no_thumbnail' : '';

            $post_meta = ( get_theme_mod('jnews_show_block_meta', true) && get_theme_mod('jnews_show_block_meta_date', true) ) ?
                "<div class=\"jeg_post_meta\">
                    <div class=\"jeg_meta_like\"><i class=\"fa fa-clock-o\"></i> {$date}</div>
                </div>" : "";

            $output .=
                "<div " . jnews_post_class("jeg_post jeg_pl_sm" . $additional_class, $result->ID) . ">
                    <div class=\"jeg_thumb\">
                        " . jnews_edit_post( $result->ID ) . "
                        <a href=\"{$permalink}\">{$thumbnail}</a>
                    </div>
                    <div class=\"jeg_postblock_content\">
                        <h3 class=\"jeg_post_title\"><a property=\"url\" href=\"{$permalink}\">{$title}</a></h3>
                        {$post_meta}
                    </div>
                </div>";
        }

        $output .= "</div></div>";
        return $output;
    }

    public function header_tab()
    {
        return
            "<ul class=\"jeg_tabpost_nav\">
                <li data-tab-content=\"jeg_tabpost_1\" class=\"active\">" . jnews_return_translation('Trending', 'jnews', 'trending') . "</li>
                <li data-tab-content=\"jeg_tabpost_2\">" . jnews_return_translation('Comments', 'jnews', 'comments') . "</li>
                <li data-tab-content=\"jeg_tabpost_3\">" . jnews_return_translation('Latest', 'jnews', 'latest') . "</li>
            </ul>";
    }


    protected function get_widget_template(){
        // do nothing
    }
}