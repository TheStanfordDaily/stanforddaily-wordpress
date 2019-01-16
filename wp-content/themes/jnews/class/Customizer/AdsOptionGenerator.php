<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

use JNews\Ads;
use JNews\Sidefeed\Sidefeed;
use JNews\Category\Category;

/**
 * Class Theme JNews Customizer
 */
Class AdsOptionGenerator
{
    private $location;
    private $title;
    private $default_size;
    private $visibility;
    private $additional_callback = null;
    private $postvar = null;
    private $default = array();

    public function __construct($options)
    {
        foreach($options as $key => $option) {
            $this->$key = $option;
        }
    }

    protected function get_ad_size()
    {
        return array(
            'auto'                  =>  esc_attr__('Auto', 'jnews'),
            'hide'                  =>  esc_attr__('Hide', 'jnews'),
            '120x90'                =>  esc_attr__('120 x 90', 'jnews'),
            '120x240'               =>  esc_attr__('120 x 240', 'jnews'),
            '120x600'               =>  esc_attr__('120 x 600', 'jnews'),
            '125x125'               =>  esc_attr__('125 x 125', 'jnews'),
            '160x90'                =>  esc_attr__('160 x 90', 'jnews'),
            '160x600'               =>  esc_attr__('160 x 600', 'jnews'),
            '180x90'                =>  esc_attr__('180 x 90', 'jnews'),
            '180x150'               =>  esc_attr__('180 x 150', 'jnews'),
            '200x90'                =>  esc_attr__('200 x 90', 'jnews'),
            '200x200'               =>  esc_attr__('200 x 200', 'jnews'),
            '234x60'                =>  esc_attr__('234 x 60', 'jnews'),
            '250x250'               =>  esc_attr__('250 x 250', 'jnews'),
            '320x100'               =>  esc_attr__('320 x 100', 'jnews'),
            '300x250'               =>  esc_attr__('300 x 250', 'jnews'),
            '300x600'               =>  esc_attr__('300 x 600', 'jnews'),
            '320x50'                =>  esc_attr__('320 x 50', 'jnews'),
            '336x280'               =>  esc_attr__('336 x 280', 'jnews'),
            '468x15'                =>  esc_attr__('468 x 15', 'jnews'),
            '468x60'                =>  esc_attr__('468 x 60', 'jnews'),
            '728x15'                =>  esc_attr__('728 x 15', 'jnews'),
            '728x90'                =>  esc_attr__('728 x 90', 'jnews'),
            '970x90'                =>  esc_attr__('970 x 90', 'jnews'),
            '240x400'               =>  esc_attr__('240 x 400', 'jnews'),
            '250x360'               =>  esc_attr__('250 x 360', 'jnews'),
            '580x400'               =>  esc_attr__('580 x 400', 'jnews'),
            '750x100'               =>  esc_attr__('750 x 100', 'jnews'),
            '750x200'               =>  esc_attr__('750 x 200', 'jnews'),
            '750x300'               =>  esc_attr__('750 x 300', 'jnews'),
            '980x120'               =>  esc_attr__('980 x 120', 'jnews'),
            '930x180'               =>  esc_attr__('930 x 180', 'jnews')
        );
    }

    private function default_value($name, $default)
    {
        if(isset($this->default[$name])) {
            return $this->default[$name];
        } else {
            return $default;
        }
    }

    public function ads_option_generator()
    {
        $options = array();

        // header
        $section_header = array(
            'id'            => 'jnews_ads_' . $this->location . '_section',
            'type'          => 'jnews-header',
            'label'         => sprintf(esc_html__('%s Advertisement','jnews'), $this->title),
        );

        if($this->additional_callback !== null) $section_header['active_callback'] = array($this->additional_callback);
        $options[] = $section_header;

        // enable
        if ( $this->location === 'content_inline' || $this->location === 'content_inline_2' || $this->location === 'content_inline_3' )
        {
            $section_enable = array(
                'id'            => 'jnews_ads_' . $this->location . '_enable',
                'transport'     => 'postMessage',
                'default'       => $this->default_value('jnews_ads_' . $this->location . '_enable', false),
                'type'          => 'jnews-toggle',
                'label'         => sprintf(esc_html__('Enable %s Advertisement','jnews'), $this->title),
                'description'   => sprintf(esc_html__('Show advertisement on %s.','jnews'), $this->title),
                'partial_refresh' => array (
                    'jnews_ads_' . $this->location . '_enable' => array (
                        'selector'              => '.content-inner',
                        'render_callback'       => function() {
                            $content_post = get_post(get_the_ID());
                            $content = $content_post->post_content;
                            $content = apply_filters('the_content', $content);
                            $content = str_replace(']]>', ']]&gt;', $content);
                            echo jnews_sanitize_output($content);
                        },
                    ),
                ),
                'postvar'       => $this->postvar
            );
        }
        else if ( $this->location === 'sidefeed' )
        {
            $section_enable = array(
                'id'            => 'jnews_ads_' . $this->location . '_enable',
                'transport'     => 'postMessage',
                'default'       => $this->default_value('jnews_ads_' . $this->location . '_enable', false),
                'type'          => 'jnews-toggle',
                'label'         => sprintf(esc_html__('Enable %s Advertisement','jnews'), $this->title),
                'description'   => sprintf(esc_html__('Show advertisement on %s.','jnews'), $this->title),
                'partial_refresh' => array (
                    'jnews_ads_' . $this->location . '_enable' => array (
                        'selector'        => '.jeg_sidefeed',
                        'render_callback' => function() {
                            $feed = new Sidefeed();
                            $ajax = $feed->get_side_feed_content();
                            echo jnews_sanitize_output($ajax['content']);
                        },
                    ),
                ),
                'postvar'       => $this->postvar
            );
        }
        else if ( $this->location === 'inline_module' )
        {
            $section_enable = array(
                'id'            => 'jnews_ads_' . $this->location . '_enable',
                'transport'     => 'postMessage',
                'default'       => $this->default_value('jnews_ads_' . $this->location . '_enable', false),
                'type'          => 'jnews-toggle',
                'label'         => sprintf(esc_html__('Enable %s Advertisement','jnews'), $this->title),
                'description'   => sprintf(esc_html__('Show advertisement on %s.','jnews'), $this->title),
                'postvar'       => $this->postvar,
                'partial_refresh' => array (
                    'jnews_ads_' . $this->location . '_enable' => array (
                        'selector'        => '.jnews_category_content_wrapper',
                        'render_callback' => function() {
                            $category = new Category();
                            echo jnews_sanitize_output($category->render_content());
                        }
                    )
                )
            );
        } else {
            $section_enable = array(
                'id'            => 'jnews_ads_' . $this->location . '_enable',
                'transport'     => 'postMessage',
                'default'       => $this->default_value('jnews_ads_' . $this->location . '_enable', false),
                'type'          => 'jnews-toggle',
                'label'         => sprintf(esc_html__('Enable %s Advertisement','jnews'), $this->title),
                'description'   => sprintf(esc_html__('Show advertisement on %s.','jnews'), $this->title),
                'partial_refresh' => array (
                    'jnews_ads_' . $this->location . '_enable' => array (
                        'selector'              => '.jnews_' . $this->location . '_ads',
                        'render_callback'       => function() {
                            $instance = Ads::getInstance();
                            call_user_func(array($instance, $this->location));
                        },
                    ),
                ),
                'postvar'       => $this->postvar
            );
        }



        if($this->additional_callback !== null) $section_enable['active_callback'] = array($this->additional_callback);
        $options[] = $section_enable;

        // type

        $type_callback = array(array(
            'setting'  => 'jnews_ads_' . $this->location . '_enable',
            'operator' => '==',
            'value'    => true,
        ));
        if($this->additional_callback !== null) $type_callback[] = $this->additional_callback;

        if ( $this->location === 'inline_module' )
        {
            $options[] = array(
                'id'            => 'jnews_ads_' . $this->location . '_type',
                'transport'     => 'postMessage',
                'default'       => $this->default_value('jnews_ads_' . $this->location . '_type', 'googleads'),
                'type'          => 'jnews-radio',
                'label'         => sprintf(esc_html__('%s : Advertisement type','jnews'), $this->title),
                'description'   => esc_html__('Choose which type of advertisement you want to use.','jnews'),
                'multiple'      => 1,
                'choices'       => array(
                    'image'         => esc_attr__( 'Image Ads', 'jnews' ),
                    'googleads'     => esc_attr__( 'Google Ads', 'jnews' ),
                    'code'          => esc_attr__( 'Script Code', 'jnews' ),
                ),
                'active_callback'  => $type_callback,
                'partial_refresh' => array (
                    'jnews_ads_' . $this->location . '_type' => array (
                        'selector'              => '.jnews_' . $this->location . '_ads',
                        'render_callback'       => function() {
                            $instance = Ads::getInstance();
                            call_user_func(array($instance, $this->location));
                        },
                    ),
                ),
                'postvar'       => $this->postvar
            );
        } else {
            $options[] = array(
                'id'            => 'jnews_ads_' . $this->location . '_type',
                'transport'     => 'postMessage',
                'default'       => $this->default_value('jnews_ads_' . $this->location . '_type', 'googleads'),
                'type'          => 'jnews-radio',
                'label'         => sprintf(esc_html__('%s : Advertisement type','jnews'), $this->title),
                'description'   => esc_html__('Choose which type of advertisement you want to use.','jnews'),
                'multiple'      => 1,
                'choices'       => array(
                    'image'         => esc_attr__( 'Image Ads', 'jnews' ),
                    'googleads'     => esc_attr__( 'Google Ads', 'jnews' ),
                    'code'          => esc_attr__( 'Script Code', 'jnews' ),
                    'shortcode'     => esc_attr__( 'Shortcode', 'jnews' ),
                ),
                'active_callback'  => $type_callback,
                'partial_refresh' => array (
                    'jnews_ads_' . $this->location . '_type' => array (
                        'selector'              => '.jnews_' . $this->location . '_ads',
                        'render_callback'       => function() {
                            $instance = Ads::getInstance();
                            call_user_func(array($instance, $this->location));
                        },
                    ),
                ),
                'postvar'       => $this->postvar
            );
        }

        // ADDITIONAL OPTION - BEGIN

        if($this->location === 'sidefeed')
        {
            $options[] = array(
                'id'            => 'jnews_ads_' . $this->location . '_sequence',
                'transport'     => 'refresh',
                'default'       => $this->default_value('jnews_ads_' . $this->location . '_sequence', '3'),
                'type'          => 'jnews-slider',
                'label'         => sprintf(esc_html__('%s : Sidefeed Sequence','jnews'), $this->title),
                'description'   => esc_html__('Set after which sequence you want to show this ad.','jnews'),
                'choices'     => array(
                    'min'  => '1',
                    'max'  => '20',
                    'step' => '1',
                ),
                'active_callback'  => $type_callback,
                'partial_refresh' => array (
                    'jnews_ads_' . $this->location . '_sequence' => array (
                        'selector'        => '.jeg_sidefeed',
                        'render_callback' => function() {
                            $feed = new Sidefeed();
                            $ajax = $feed->get_side_feed_content();
                            echo jnews_sanitize_output($ajax['content']);
                        },
                    ),
                ),
                'postvar'       => $this->postvar
            );
        }

        if ( $this->location === 'content_inline' || $this->location === 'content_inline_2' || $this->location === 'content_inline_3' )
        {
            $options[] = array(
                'id'            => 'jnews_ads_' . $this->location . '_paragraph_random',
                'transport'     => 'postMessage',
                'default'       => $this->default_value('jnews_ads_' . $this->location . '_paragraph_random', false),
                'type'          => 'jnews-toggle',
                'label'         => sprintf(esc_html__('Random ads position','jnews'), $this->title),
                'description'   => sprintf(esc_html__('Set random on which paragraph the ad will show.','jnews'), $this->title),
                'active_callback'  => $type_callback,
                'partial_refresh' => array (
                    'jnews_ads_' . $this->location . '_paragraph_random' => array (
                        'selector'        => '.content-inner',
                        'render_callback' => function() {
                            $content_post = get_post(get_the_ID());
                            $content = $content_post->post_content;
                            $content = apply_filters('the_content', $content);
                            $content = str_replace(']]>', ']]&gt;', $content);
                            echo jnews_sanitize_output($content);
                        },
                    ),
                ),
                'postvar'       => $this->postvar
            );

            $options[] = array(
                'id'            => 'jnews_ads_' . $this->location . '_paragraph',
                'transport'     => 'refresh',
                'default'       => $this->default_value('jnews_ads_' . $this->location . '_paragraph', '3'),
                'type'          => 'jnews-slider',
                'label'         => sprintf(esc_html__('%s : After Paragraph','jnews'), $this->title),
                'description'   => esc_html__('Set after which paragraph you want this advertisement to show.','jnews'),
                'choices'     => array(
                    'min'  => '0',
                    'max'  => '20',
                    'step' => '1',
                ),
                'active_callback'  => $type_callback,
                'partial_refresh' => array (
                    'jnews_ads_' . $this->location . '_paragraph' => array (
                        'selector'              => '.content-inner',
                        'render_callback'       => function() {
                            $content_post = get_post(get_the_ID());
                            $content = $content_post->post_content;
                            $content = apply_filters('the_content', $content);
                            $content = str_replace(']]>', ']]&gt;', $content);
                            echo jnews_sanitize_output($content);
                        },
                    ),
                ),
                'postvar'       => $this->postvar
            );

            $options[] = array(
                'id'            => 'jnews_ads_' . $this->location . '_align',
                'transport'     => 'postMessage',
                'default'       => $this->default_value('jnews_ads_' . $this->location . '_align', 'center'),
                'type'          => 'jnews-select',
                'label'         => sprintf(esc_html__('%s : Advertisement align','jnews'), $this->title),
                'description'   => esc_html__('Alignment of ad inside your content paragraph.','jnews'),
                'multiple'      => 1,
                'choices'       => array(
                    'center'        => esc_attr__( 'Center', 'jnews' ),
                    'left'          => esc_attr__( 'Left', 'jnews' ),
                    'right'         => esc_attr__( 'Right', 'jnews' ),
                ),
                'active_callback'  => $type_callback,
                'partial_refresh' => array (
                    'jnews_ads_' . $this->location . '_align' => array (
                        'selector'              => '.jnews_' . $this->location . '_ads',
                        'render_callback'       => function() {
                            $instance = Ads::getInstance();
                            call_user_func(array($instance, $this->location));
                        },
                    ),
                ),
                'postvar'       => $this->postvar
            );
        }

        if ( $this->location === 'inline_module' )
        {
            $options[] = array(
                'id'                => 'jnews_ads_' . $this->location . '_paragraph_random',
                'transport'         => 'postMessage',
                'default'           => $this->default_value('jnews_ads_' . $this->location . '_paragraph_random', false),
                'type'              => 'jnews-toggle',
                'label'             => esc_html__('Random ads position','jnews'),
                'description'       => esc_html__('Set random on which paragraph the ad will show.','jnews'),
                'active_callback'   => $type_callback,
                'postvar'           => $this->postvar,
                'partial_refresh' => array (
                    'jnews_ads_' . $this->location . '_paragraph_random' => array (
                        'selector'        => '.jnews_category_content_wrapper',
                        'render_callback' => function() {
                            $category = new Category();
                            echo jnews_sanitize_output($category->render_content());
                        }
                    )
                )
            );

            $options[] = array(
                'id'                => 'jnews_ads_' . $this->location . '_paragraph',
                'transport'         => 'refresh',
                'default'           => $this->default_value('jnews_ads_' . $this->location . '_paragraph', '3'),
                'type'              => 'jnews-slider',
                'label'             => sprintf(esc_html__('%s : After Paragraph','jnews'), $this->title),
                'description'       => esc_html__('Set after which paragraph you want this advertisement to show.','jnews'),
                'choices'           => array(
                    'min'  => '1',
                    'max'  => '10',
                    'step' => '1',
                ),
                'active_callback'  => $type_callback,
                'postvar'           => $this->postvar,
                'partial_refresh' => array (
                    'jnews_ads_' . $this->location . '_paragraph' => array (
                        'selector'        => '.jnews_category_content_wrapper',
                        'render_callback' => function() {
                            $category = new Category();
                            echo jnews_sanitize_output($category->render_content());
                        }
                    )
                )
            );
        }

        // ADDITIONAL OPTION - END

        // IMAGE
        $image_callback = array(
            array(
                'setting'  => 'jnews_ads_' . $this->location . '_type',
                'operator' => '==',
                'value'    => 'image',
            ),
            array(
                'setting'  => 'jnews_ads_' . $this->location . '_enable',
                'operator' => '==',
                'value'    => true,
            ),
        );

        if($this->additional_callback !== null) $image_callback[] = $this->additional_callback;

        $options[] = array(
            'id'            => 'jnews_ads_' . $this->location . '_image',
            'transport'     => 'postMessage',
            'default'       => $this->default_value('jnews_ads_' . $this->location . '_image', ''),
            'type'          => 'jnews-image',
            'label'         => sprintf(esc_html__('%s : Advertisement Image','jnews'), $this->title),
            'description'   => sprintf(esc_html__('Upload %s Image size.','jnews' ), $this->default_size),
            'active_callback'  => $image_callback,
            'partial_refresh' => array (
                'jnews_ads_' . $this->location . '_image' => array (
                    'selector'              => '.jnews_' . $this->location . '_ads',
                    'render_callback'       => function() {
                        $instance = Ads::getInstance();
                        call_user_func(array($instance, $this->location));
                    },
                ),
            ),
            'postvar'       => $this->postvar
        );

        $options[] = array(
            'id'            => 'jnews_ads_' . $this->location . '_link',
            'transport'     => 'postMessage',
            'default'       => $this->default_value('jnews_ads_' . $this->location . '_link', ''),
            'type'          => 'jnews-text',
            'label'         => sprintf(esc_html__('%s : Advertisement Link','jnews'), $this->title),
            'description'   => esc_html__('Please put where this advertisement image will be heading.','jnews' ),
            'active_callback'  => $image_callback,
            'partial_refresh' => array (
                'jnews_ads_' . $this->location . '_link' => array (
                    'selector'              => '.jnews_' . $this->location . '_ads',
                    'render_callback'       => function() {
                        $instance = Ads::getInstance();
                        call_user_func(array($instance, $this->location));
                    },
                ),
            ),
            'postvar'       => $this->postvar
        );

        $options[] = array(
            'id'            => 'jnews_ads_' . $this->location . '_text',
            'transport'     => 'postMessage',
            'default'       => $this->default_value('jnews_ads_' . $this->location . '_text', ''),
            'type'          => 'jnews-text',
            'label'         => sprintf(esc_html__('%s : Alternate Text','jnews' ), $this->title),
            'description'   => esc_html__('Insert alternate text for advertisement image.','jnews' ),
            'active_callback'  => $image_callback,
            'partial_refresh' => array (
                'jnews_ads_' . $this->location . '_text' => array (
                    'selector'              => '.jnews_' . $this->location . '_ads',
                    'render_callback'       => function() {
                        $instance = Ads::getInstance();
                        call_user_func(array($instance, $this->location));
                    },
                ),
            ),
            'postvar'       => $this->postvar
        );

        $options[] = array(
            'id'            => 'jnews_ads_' . $this->location . '_open_tab',
            'transport'     => 'postMessage',
            'default'       => $this->default_value('jnews_ads_' . $this->location . '_open_tab', ''),
            'type'          => 'jnews-toggle',
            'label'         => sprintf(esc_html__('%s : Open in New Tab','jnews'), $this->title),
            'description'   => esc_html__('Enable open in new tab when advertisement image is clicked.','jnews' ),
            'active_callback'  => $image_callback,
            'partial_refresh' => array (
                'jnews_ads_' . $this->location . '_open_tab' => array (
                    'selector'              => '.jnews_' . $this->location . '_ads',
                    'render_callback'       => function() {
                        $instance = Ads::getInstance();
                        call_user_func(array($instance, $this->location));
                    },
                ),
            ),
            'postvar'       => $this->postvar
        );

        // GOOGLE ADS

        $google_callback = array(
            array(
                'setting'  => 'jnews_ads_' . $this->location . '_type',
                'operator' => '==',
                'value'    => 'googleads',
            ),
            array(
                'setting'  => 'jnews_ads_' . $this->location . '_enable',
                'operator' => '==',
                'value'    => true,
            ),
        );

        if($this->additional_callback !== null) $google_callback[] = $this->additional_callback;

        $options[] = array(
            'id'            => 'jnews_ads_' . $this->location . '_google_publisher',
            'transport'     => 'postMessage',
            'default'       => $this->default_value('jnews_ads_' . $this->location . '_google_publisher', ''),
            'type'          => 'jnews-text',
            'label'         => sprintf(esc_html__('%s : Publisher ID','jnews'), $this->title),
            'description'   => esc_html__('Insert data-ad-client / google_ad_client content.','jnews' ),
            'active_callback'  => $google_callback,
            'partial_refresh' => array (
                'jnews_ads_' . $this->location . '_google_publisher' => array (
                    'selector'              => '.jnews_' . $this->location . '_ads',
                    'render_callback'       => function() {
                        $instance = Ads::getInstance();
                        call_user_func(array($instance, $this->location));
                    },
                ),
            ),
            'postvar'       => $this->postvar
        );

        $options[] = array(
            'id'            => 'jnews_ads_' . $this->location . '_google_id',
            'transport'     => 'postMessage',
            'default'       => $this->default_value('jnews_ads_' . $this->location . '_google_id', ''),
            'type'          => 'jnews-text',
            'label'         => sprintf(esc_html__('%s : Ad Slot ID','jnews'), $this->title),
            'description'   => esc_html__('Insert data-ad-slot / google_ad_slot content.','jnews' ),
            'active_callback'  => $google_callback,
            'partial_refresh' => array (
                'jnews_ads_' . $this->location . '_google_id' => array (
                    'selector'              => '.jnews_' . $this->location . '_ads',
                    'render_callback'       => function() {
                        $instance = Ads::getInstance();
                        call_user_func(array($instance, $this->location));
                    },
                ),
            ),
            'postvar'       => $this->postvar
        );

        if($this->visibility['desktop'])
        {
            $options[] = array(
                'id'            => 'jnews_ads_' . $this->location . '_google_desktop',
                'transport'     => 'postMessage',
                'default'       => $this->default_value('jnews_ads_' . $this->location . '_google_desktop', 'auto'),
                'type'          => 'jnews-select',
                'label'         => sprintf(esc_html__('%s : Desktop Ad Size','jnews'), $this->title),
                'description'   => esc_html__('Choose ad size to be shown on desktop, recommended to use auto.','jnews' ),
                'choices'       => $this->get_ad_size(),
                'active_callback'  => $google_callback,
                'partial_refresh' => array (
                    'jnews_ads_' . $this->location . '_google_desktop' => array (
                        'selector'              => '.jnews_' . $this->location . '_ads',
                        'render_callback'       => function() {
                            $instance = Ads::getInstance();
                            call_user_func(array($instance, $this->location));
                        },
                    ),
                ),
                'postvar'       => $this->postvar
            );
        }

        if($this->visibility['tab'])
        {
            $options[] = array(
                'id'            => 'jnews_ads_' . $this->location . '_google_tab',
                'transport'     => 'postMessage',
                'default'       => $this->default_value('jnews_ads_' . $this->location . '_google_tab', 'auto'),
                'type'          => 'jnews-select',
                'label'         => sprintf(esc_html__('%s : Tab Ad Size','jnews'), $this->title),
                'description'   => esc_html__('Choose ad size to be shown on tablet, recommended to use auto.','jnews' ),
                'choices'       => $this->get_ad_size(),
                'active_callback'  => $google_callback,
                'partial_refresh' => array (
                    'jnews_ads_' . $this->location . '_google_tab' => array (
                        'selector'              => '.jnews_' . $this->location . '_ads',
                        'render_callback'       => function() {
                            $instance = Ads::getInstance();
                            call_user_func(array($instance, $this->location));
                        },
                    ),
                ),
                'postvar'       => $this->postvar
            );
        }

        if($this->visibility['phone'])
        {
            $options[] = array(
                'id' => 'jnews_ads_' . $this->location . '_google_phone',
                'transport' => 'postMessage',
                'default' => $this->default_value('jnews_ads_' . $this->location . '_google_phone', 'auto'),
                'type' => 'jnews-select',
                'label' => sprintf(esc_html__('%s : Phone Ad Size', 'jnews'), $this->title),
                'description' => esc_html__('Choose ad size to be shown on phone, recommended to use auto.', 'jnews'),
                'choices' => $this->get_ad_size(),
                'active_callback'  => $google_callback,
                'partial_refresh' => array(
                    'jnews_ads_' . $this->location . '_google_phone' => array(
                        'selector' => '.jnews_' . $this->location . '_ads',
                        'render_callback' => function () {
                            $instance = Ads::getInstance();
                            call_user_func(array($instance, $this->location));
                        },
                    ),
                ),
                'postvar'       => $this->postvar
            );
        }

        // CODE

        $code_callback = array(
            array(
                'setting'  => 'jnews_ads_' . $this->location . '_type',
                'operator' => '==',
                'value'    => 'code',
            ),
            array(
                'setting'  => 'jnews_ads_' . $this->location . '_enable',
                'operator' => '==',
                'value'    => true,
            ),
        );

        if($this->additional_callback !== null) $code_callback[] = $this->additional_callback;

        $options[] = array(
            'id'            => 'jnews_ads_' . $this->location . '_code',
            'transport'     => 'postMessage',
            'sanitize'      => 'jnews_sanitize_by_pass',
            'default'       => $this->default_value('jnews_ads_' . $this->location . '_code', ''),
            'type'          => 'jnews-textarea',
            'label'         => sprintf(esc_html__('%s : Ad code', 'jnews'), $this->title),
            'description'   => esc_html__('Put your ad\'s script code right here.', 'jnews'),
            'active_callback'  => $code_callback,
            'partial_refresh' => array (
                'jnews_ads_' . $this->location . '_code' => array (
                    'selector'              => '.jnews_' . $this->location . '_ads',
                    'render_callback'       => function() {
                        $instance = Ads::getInstance();
                        call_user_func(array($instance, $this->location));
                    },
                ),
            ),
            'postvar'       => $this->postvar
        );


        // SHORTCODE

        $shortcode_callback = array(
            array(
                'setting'  => 'jnews_ads_' . $this->location . '_type',
                'operator' => '==',
                'value'    => 'shortcode',
            ),
            array(
                'setting'  => 'jnews_ads_' . $this->location . '_enable',
                'operator' => '==',
                'value'    => true,
            ),
        );

        if($this->additional_callback !== null) $shortcode_callback[] = $this->additional_callback;

        $options[] = array(
            'id'            => 'jnews_ads_' . $this->location . '_shortcode',
            'transport'     => 'postMessage',
            'default'       => $this->default_value('jnews_ads_' . $this->location . '_shortcode', ''),
            'type'          => 'jnews-textarea',
            'label'         => sprintf(esc_html__('%s : Advertisement code', 'jnews'), $this->title),
            'description'   => esc_html__('Put your ad\'s shortcode right here.', 'jnews'),
            'active_callback'  => $shortcode_callback,
            'partial_refresh' => array (
                'jnews_ads_' . $this->location . '_shortcode' => array (
                    'selector'              => '.jnews_' . $this->location . '_ads',
                    'render_callback'       => function() {
                        $instance = Ads::getInstance();
                        call_user_func(array($instance, $this->location));
                    },
                ),
            ),
            'postvar'       => $this->postvar
        );



        // Advertisement Text
        $options[] = array(
            'id'            => 'jnews_ads_' . $this->location . '_ads_text',
            'transport'     => 'postMessage',
            'default'       => false,
            'type'          => 'jnews-toggle',
            'label'         => sprintf(esc_html__('Show %s Advertisement Text','jnews'), $this->title),
            'description'   => esc_html__('Show advertisement text bottom of ads.','jnews'),
            'active_callback'  => $type_callback,
            'partial_refresh' => array (
                'jnews_ads_' . $this->location . '_ads_text' => array (
                    'selector'              => '.jnews_' . $this->location . '_ads',
                    'render_callback'       => function() {
                        $instance = Ads::getInstance();
                        call_user_func(array($instance, $this->location));
                    },
                ),
            ),
            'postvar'       => $this->postvar
        );

        return $options;
    }
}