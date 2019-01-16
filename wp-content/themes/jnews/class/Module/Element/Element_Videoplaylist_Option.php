<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleOptionAbstract;

Class Element_Videoplaylist_Option extends ModuleOptionAbstract
{
    public function compatible_column()
    {
        return array( 4, 8 , 12 );
    }

    public function get_category()
    {
	    return esc_html__('JNews - Element', 'jnews');
    }

	public function show_color_scheme()
    {
        return false;
    }

    public function set_options()
    {
        $this->set_video_playlist_option();
        $this->set_content_filter_option(5);
        $this->set_style_option();
    }

    public function get_module_name()
    {
        return esc_html__('JNews - Video Playlist', 'jnews');
    }

    /**
     * @param int $number
     * @param bool $hide_number_post
     */
    public function set_content_filter_option($number = 10, $hide_number_post = false)
    {
        $this->options[] = array(
            'type'          => 'alert',
            'param_name'    => 'content_video_alert',
            'heading'       => esc_html__('Video Type', 'jnews'),
            'description'   => esc_html__('This module will automatically find video post type base on your post filter.', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => 'info',
        );

        if(!$hide_number_post)
        {
            $this->options[] = array(
                'type'          => 'slider',
                'param_name'    => 'number_post',
                'heading'       => esc_html__('Number of Post', 'jnews'),
                'description'   => esc_html__('Show number of post on this module.', 'jnews'),
                'group'         => esc_html__('Content Filter', 'jnews'),
                'min'           => 1,
                'max'           => 30,
                'step'          => 1,
                'std'           => $number,
            );
        }

        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'post_type',
            'heading'       => esc_html__('Include Post Type', 'jnews'),
            'description'   => esc_html__('Choose post type for this content.', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => 'post',
            'value'         => jnews_get_all_post_type(),
        );

        $this->options[] = array(
            'type'          => 'number',
            'param_name'    => 'post_offset',
            'heading'       => esc_html__('Post Offset', 'jnews'),
            'description'   => esc_html__('Number of post offset (start of content).', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'min'           => 0,
            'max'           => 9999,
            'step'          => 1,
            'std'           => 0,
        );

        $this->options[] = array(
            'type'          => 'multipost',
            'param_name'    => 'include_post',
            'heading'       => esc_html__('Include Post ID', 'jnews'),
            'description'   => wp_kses(__("Tips :<br/> - You can search post id by inputing title, clicking search title, and you will have your post id.<br/>- You can also directly insert your post id, and click enter to add it on the list.", 'jnews'), wp_kses_allowed_html()),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
        );

        $this->options[] = array(
            'type'          => 'multipost',
            'param_name'    => 'exclude_post',
            'heading'       => esc_html__('Exclude Post ID', 'jnews'),
            'description'   => wp_kses(__("Tips :<br/> - You can search post id by inputing title, clicking search title, and you will have your post id.<br/>- You can also directly insert your post id, and click enter to add it on the list.", 'jnews'), wp_kses_allowed_html()),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
        );

        $this->options[] = array(
            'type'          => 'multicategory',
            'param_name'    => 'include_category',
            'heading'       => esc_html__('Include Category', 'jnews'),
            'description'   => esc_html__('Choose which category you want to show on this module.', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
        );

        $this->options[] = array(
            'type'          => 'multicategory',
            'param_name'    => 'exclude_category',
            'heading'       => esc_html__('Exclude Category', 'jnews'),
            'description'   => esc_html__('Choose excluded category for this module.', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
        );

        $this->options[] = array(
            'type'          => 'multiauthor',
            'param_name'    => 'include_author',
            'heading'       => esc_html__('Author', 'jnews'),
            'description'   => esc_html__('Write to search post author.', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
            'value'         => jnews_get_all_author(),
        );

        $this->options[] = array(
            'type'          => 'multitag',
            'param_name'    => 'include_tag',
            'heading'       => esc_html__('Include Tags', 'jnews'),
            'description'   => esc_html__('Write to search post tag.', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
            'value'         => jnews_get_all_tag(),
        );

        $this->options[] = array(
            'type'          => 'multitag',
            'param_name'    => 'exclude_tag',
            'heading'       => esc_html__('Exclude Tags', 'jnews'),
            'description'   => esc_html__('Write to search post tag.', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
            'value'         => jnews_get_all_tag(),
        );

        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'sort_by',
            'heading'       => esc_html__('Sort by', 'jnews'),
            'description'   =>
                wp_kses(__("Sort post by this option<br/>* <strong>Jetpack :</strong> Need <strong>Jetpack</strong> plugin & Stat module enabled.<br/>* Like and share only count real like and share.", 'jnews'), wp_kses_allowed_html()),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
            'value'         => array(
                esc_html__('Latest Post', 'jnews')                           => 'latest',
                esc_html__('Oldest Post', 'jnews')                           => 'oldest',
                esc_html__('Alphabet Asc', 'jnews')                          => 'alphabet_asc',
                esc_html__('Alphabet Desc', 'jnews')                         => 'alphabet_desc',
                esc_html__('Random Post', 'jnews')                           => 'random',
                esc_html__('Random Post (7 Days)', 'jnews')                  => 'random_week',
                esc_html__('Random Post (30 Days)', 'jnews')                 => 'random_month',
                esc_html__('Most Comment', 'jnews')                          => 'most_comment',
                esc_html__('Highest Rate - Review', 'jnews')                 => 'rate',
                esc_html__('Most Like (Thumb up)', 'jnews')                  => 'like',
                esc_html__('Most Share', 'jnews')                            => 'share',
            )
        );
    }

    public function set_video_playlist_option()
    {

        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'layout',
            'heading'       => esc_html__('Video Playlist Layout', 'jnews'),
            'description'   => esc_html__('Choose video playlist layout.', 'jnews'),
            'std'           => 'horizontal',
            'value'         => array(
                esc_html__('Horizontal', 'jnews')    => 'horizontal',
                esc_html__('Vertical', 'jnews')      => 'vertical',
            )
        );

        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'scheme',
            'heading'       => esc_html__('Video Playlist Scheme', 'jnews'),
            'description'   => esc_html__('Choose video scheme color.', 'jnews'),
            'std'           => 'light',
            'value'         => array(
                esc_html__('Light Scheme', 'jnews')      => 'light',
                esc_html__('Dark Scheme', 'jnews')    => 'dark',
            )
        );
    }
}