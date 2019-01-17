<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module;

abstract Class ModuleOptionAbstract
{
    /**
     * @var ModuleOptionAbstract
     */
    protected static $instance;

    /**
     * Option Field
     *
     * @var array
     */
    protected $options = array();

    /**
     * @return ModuleOptionAbstract
     */
    public static function getInstance()
    {
        $class = get_called_class();

        if (!isset(self::$instance[$class]))
        {
            self::$instance[$class] = new $class();
        }

        return self::$instance[$class];
    }

    /**
     * ModuleOptionAbstract constructor.
     */
    protected function __construct()
    {
        $this->set_options();
        $this->setup_hook();
    }

    /**
     * @return array
     */
    public function get_options()
    {
        return $this->options;
    }

    /**
     * Setup Hook
     */
    public function setup_hook()
    {
        add_action('init', array($this, 'map_vc'));
    }

    public function remove_description()
    {
        $options = array();

        foreach($this->options as $key => $option)
        {
            unset($option['description']);
            $options[] = $option;
        }

        return $options;
    }

    public function map_vc()
    {
        if (class_exists('WPBakeryVisualComposerAbstract'))
        {
            $this->show_compatible_column();

            $vc_options['base']         = jnews_get_shortcode_name_from_option(get_class($this));
            $vc_options['params']       = $this->options;
            $vc_options['name']         = $this->get_module_name();
            $vc_options['category']     = $this->get_category();
            $vc_options['icon']         = strtolower($vc_options['base']);
            $vc_options['description']  = $this->get_module_name();
	        $vc_options['as_parent']    = $this->get_module_parent();
	        $vc_options['as_child']     = $this->get_module_child();

	        if ( ! empty( $vc_options['as_parent'] ) )
	        {
	        	include_once 'modules-container.php';

		        $vc_options['js_view']     = 'VcColumnView';
	        }

            vc_map($vc_options);
        }
    }

    public function get_module_parent()
    {
    	return '';
    }

	public function get_module_child()
	{
		return '';
	}

    public function show_compatible_column()
    {
        $option_group = isset($this->options[0]['group']) ? $this->options[0]['group'] : "";


        $compatible_column = array(
            'type'          => 'alert',
            'param_name'    => 'compatible_column_notice',
            'heading'       => esc_html__('Compatible Column: ', 'jnews') . implode($this->compatible_column(), ', '),
            'description'   => esc_html__('Please check style / design tab to change Module / Block width and make it fit with your current column width', 'jnews'),
            'group'         => $option_group,
            'std'           => 'info'
        );

        array_unshift($this->options, $compatible_column);
    }

    public function set_content_filter_option($number = 10, $hide_number_post = false)
    {
        $dependency = array('element' => "sort_by", 'value' => array('post_type', 'latest','oldest','alphabet_asc','alphabet_desc','random','random_week','random_month','most_comment','most_comment_day','most_comment_week','most_comment_month','popular_post_day','popular_post_week','popular_post_month','popular_post','rate','like','share'));


        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'post_type',
            'heading'       => esc_html__('Include Post Type', 'jnews'),
            'description'   => esc_html__('Choose post type for this content.', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => 'post',
            'value'         => jnews_get_all_post_type(),
            'dependency'    => $dependency
        );

        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'content_type',
            'heading'       => esc_html__('Content Type', 'jnews'),
            'description'   => esc_html__('Choose which content type you want to filter', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => 'all',
            'value'         => array(
                esc_html__('All', 'jnews')              => 'all',
                esc_html__('Only review', 'jnews')      => 'review',
                esc_html__('Only post', 'jnews')        => 'post',
            ),
            'dependency'    => array('element' => "post_type", 'value' => "post")
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

        if($hide_number_post && $number > 0)
        {
            $this->options[] = array(
                'type'          => 'alert',
                'param_name'    => 'content_filter_number_alert',
                'heading'       => esc_html__('Number of post', 'jnews'),
                'description'   => sprintf(esc_html__('This module will require you to choose %s number of post.', 'jnews'), $number),
                'group'         => esc_html__('Content Filter', 'jnews'),
                'std'           => 'info',
            );
        }

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
            'dependency'    => $dependency
        );

        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'unique_content',
            'heading'       => esc_html__('Include into Unique Content Group', 'jnews'),
            'description'   => esc_html__('Choose unique content option, and this module will be included into unique content group. It won\'t duplicate content across the group. Ajax loaded content won\'t affect this unique content feature.', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => 'disable',
            'value'         => array(
                esc_html__('Disable', 'jnews')                       => 'disable',
                esc_html__('Unique Content - Group 1', 'jnews')      => 'unique1',
                esc_html__('Unique Content - Group 2', 'jnews')      => 'unique2',
                esc_html__('Unique Content - Group 3', 'jnews')      => 'unique3',
                esc_html__('Unique Content - Group 4', 'jnews')      => 'unique4',
                esc_html__('Unique Content - Group 5', 'jnews')      => 'unique5',
            ),
            'dependency'    => $dependency
        );

        $this->options[] = array(
            'type'          => 'multipost',
            'param_name'    => 'include_post',
            'heading'       => esc_html__('Include Post ID', 'jnews'),
            'description'   => wp_kses(__("Tips :<br/> - You can search post id by inputing title, clicking search title, and you will have your post id.<br/>- You can also directly insert your post id, and click enter to add it on the list.", 'jnews'), wp_kses_allowed_html()),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
            'dependency'    => $dependency
        );

        $this->options[] = array(
            'type'          => 'multipost',
            'param_name'    => 'exclude_post',
            'heading'       => esc_html__('Exclude Post ID', 'jnews'),
            'description'   => wp_kses(__("Tips :<br/> - You can search post id by inputing title, clicking search title, and you will have your post id.<br/>- You can also directly insert your post id, and click enter to add it on the list.", 'jnews'), wp_kses_allowed_html()),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
            'dependency'    => $dependency
        );

        $this->options[] = array(
            'type'          => 'multicategory',
            'param_name'    => 'include_category',
            'heading'       => esc_html__('Include Category', 'jnews'),
            'description'   => esc_html__('Choose which category you want to show on this module.', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
            'dependency'    => $dependency
        );

        $this->options[] = array(
            'type'          => 'multicategory',
            'param_name'    => 'exclude_category',
            'heading'       => esc_html__('Exclude Category', 'jnews'),
            'description'   => esc_html__('Choose excluded category for this module.', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
            'dependency'    => $dependency
        );

        $this->options[] = array(
            'type'          => 'multiauthor',
            'param_name'    => 'include_author',
            'heading'       => esc_html__('Author', 'jnews'),
            'description'   => esc_html__('Write to search post author.', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
            'value'         => jnews_get_all_author(),
            'dependency'    => $dependency
        );

        $this->options[] = array(
            'type'          => 'multitag',
            'param_name'    => 'include_tag',
            'heading'       => esc_html__('Include Tags', 'jnews'),
            'description'   => esc_html__('Write to search post tag.', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
            'value'         => jnews_get_all_tag(),
            'dependency'    => $dependency
        );

        $this->options[] = array(
            'type'          => 'multitag',
            'param_name'    => 'exclude_tag',
            'heading'       => esc_html__('Exclude Tags', 'jnews'),
            'description'   => esc_html__('Write to search post tag.', 'jnews'),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => '',
            'value'         => jnews_get_all_tag(),
            'dependency'    => $dependency
        );

        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'sort_by',
            'heading'       => esc_html__('Sort by', 'jnews'),
            'description'   =>
                wp_kses(__("Sort post by this option<br/>* <strong>View Counter :</strong> Need <strong>JNews View Counter</strong> plugin enabled.<br/>* <strong>Jetpack :</strong> Need <strong>Jetpack</strong> plugin & Stat module enabled.<br/>* Like and share only count real like and share.", 'jnews'), wp_kses_allowed_html()),
            'group'         => esc_html__('Content Filter', 'jnews'),
            'std'           => 'latest',
            'value'         => array(
                esc_html__('Latest Post', 'jnews')                                      => 'latest',
                esc_html__('Oldest Post', 'jnews')                                      => 'oldest',
                esc_html__('Alphabet Asc', 'jnews')                                     => 'alphabet_asc',
                esc_html__('Alphabet Desc', 'jnews')                                    => 'alphabet_desc',
                esc_html__('Random Post', 'jnews')                                      => 'random',
                esc_html__('Random Post (7 Days)', 'jnews')                             => 'random_week',
                esc_html__('Random Post (30 Days)', 'jnews')                            => 'random_month',
                esc_html__('Most Comment', 'jnews')                                     => 'most_comment',
                esc_html__('Most Comment (1 Day - View Counter)', 'jnews')              => 'most_comment_day',
                esc_html__('Most Comment (7 Days - View Counter)', 'jnews')             => 'most_comment_week',
                esc_html__('Most Comment (30 Days - View Counter)', 'jnews')            => 'most_comment_month',
                esc_html__('Popular Post (1 Day - View Counter)', 'jnews')              => 'popular_post_day',
                esc_html__('Popular Post (7 Days - View Counter)', 'jnews')             => 'popular_post_week',
                esc_html__('Popular Post (30 Days - View Counter)', 'jnews')            => 'popular_post_month',
                esc_html__('Popular Post (All Time - View Counter)', 'jnews')           => 'popular_post',
                esc_html__('Popular Post (1 Day - Jetpack)', 'jnews')                   => 'popular_post_jetpack_day',
                esc_html__('Popular Post (7 Days - Jetpack)', 'jnews')                  => 'popular_post_jetpack_week',
                esc_html__('Popular Post (30 Days - Jetpack)', 'jnews')                 => 'popular_post_jetpack_month',
                esc_html__('Popular Post (All Time - Jetpack)', 'jnews')                => 'popular_post_jetpack_all',
                esc_html__('Highest Rate - Review', 'jnews')                            => 'rate',
                esc_html__('Most Like (Thumb up)', 'jnews')                             => 'like',
                esc_html__('Most Share', 'jnews')                                       => 'share',
            )
        );
    }

    public function set_style_option()
    {
        $width = array(
            esc_html__('Auto', 'jnews')  => 'auto'
        );

        if(in_array(4, $this->compatible_column())) {
            $width = array_merge($width, array(
                esc_html__('4 Column Design ( 1 Block )', 'jnews')  => 4
            ));
        }

        if(in_array(8, $this->compatible_column())) {
            $width = array_merge($width, array(
                esc_html__('8 Column Design ( 2 Block )', 'jnews')  => 8
            ));
        }

        if(in_array(12, $this->compatible_column())) {
            $width = array_merge($width, array(
                esc_html__('12 Column Design ( 3 Block )', 'jnews')  => 12
            ));
        }

        if($this->show_color_scheme())
        {
            $this->options[] = array(
                'type'          => 'dropdown',
                'param_name'    => 'scheme',
                'heading'       => esc_html__('Element Color Scheme', 'jnews'),
                'description'   => esc_html__('choose element color scheme for your element ', 'jnews'),
                'group'         => esc_html__('Design', 'jnews'),
                'default'       => 'normal',
                'value'         => array(
                    esc_html__('Normal', 'jnews')          => 'normal',
                    esc_html__('Alternate - Opposite of global color scheme', 'jnews')  => 'alt'
                )
            );
        }

        $this->options[] = array(
            'type'          => 'dropdown',
            'param_name'    => 'column_width',
            'heading'       => esc_html__('Block / Column Width', 'jnews'),
            'description'   => esc_html__('Please choose width of column you want to use on this block. 1 Block represents 4 columns.', 'jnews'),
            'group'         => esc_html__('Design', 'jnews'),
            'std'           => 'auto',
            'value'         => $width,
        );

        $this->additional_style();

        $this->options[] = array(
            'type'          => 'css_editor',
            'param_name'    => 'css',
            'heading'       => esc_html__('CSS Box', 'jnews'),
            'group'         => esc_html__('Design', 'jnews'),
        );
    }

    public function additional_style()
    {
        // do nothing
    }

    public function show_color_scheme()
    {
        return true;
    }

    public function get_category()
    {
	    return esc_html__('JNews - Module', 'jnews');
    }

    abstract public function set_options();
    abstract public function get_module_name();
    abstract public function compatible_column();
}