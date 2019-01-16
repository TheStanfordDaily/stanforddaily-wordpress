<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module;

abstract Class ModuleViewAbstract
{
    /**
     * @var array
     */
    protected static $instance;

    /**
     * Option Field
     *
     * @var array
     */
    protected $options;

    /**
     * @var string
     */
    protected $unique_id;

    /**
     * Array of attribute
     *
     * @var array
     */
    protected $attribute;

    /**
     * @var ModuleManager
     */
    protected $manager;

    /**
     * @var string
     */
    protected $class_name;

    /**
     * @var ModuleOptionAbstract
     */
    protected $option_class;

    /**
     * @var String
     */
    protected $content;

    /**
     * @return ModuleViewAbstract
     * @var $manager
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
     * ModuleViewAbstract constructor.
     */
    protected function __construct()
    {
        $this->class_name = jnews_get_shortcode_name_from_view(get_class($this));
        $this->manager = ModuleManager::getInstance();

        // set option class
        $class_option = str_replace('_View', '_Option', get_class($this));
        $this->option_class = call_user_func(array($class_option, 'getInstance'));

        $this->set_options();
    }

    private function set_options()
    {
        $options = $this->option_class->get_options();

        foreach($options as $option)
        {
            $this->options[$option['param_name']] = isset($option['std']) ? $option['std'] : '';
        }
    }

    private function compatible_column()
    {
        return $this->option_class->compatible_column();
    }

    public function color_scheme()
    {
        return $this->attribute['scheme'];
    }

    public function get_vc_class_name()
    {
        $class_name = null;

        if(isset($this->attribute['css']))
        {
            $css_exploded = explode('{', $this->attribute['css']);
            $class = $css_exploded[0];
            $class_name = substr($class, 1);
        }

        return $class_name;
    }

    public function is_compatible_widget()
    {
        $column = $this->compatible_column();

        if(in_array(4, $column))
        {
            return true;
        }

        return false;
    }

    /**
     * @param $attr
     * @return string
     */
    public function get_module_column_class($attr)
    {
        if(isset($attr['column_width']) && $attr['column_width'] !== 'auto')
        {
            switch($attr['column_width']) {
                case 4 :
                    $class_name = 'jeg_col_1o3';
                    break;
                case 8 :
                    $class_name = 'jeg_col_2o3';
                    break;
                case 12 :
                    $class_name = 'jeg_col_3o3';
                    break;
                default :
                    $class_name = 'jeg_col_3o3';
            }

            return $class_name;
        } else {
            return $this->manager->get_column_class();
        }
    }

    /**
     * Call from VC to build Module
     *
     * @param $attr
     * @param $content
     * @return string
     */
    public function build_module($attr, $content = null)
    {
        $this->content = $content;
        $this->generate_unique_id();
        $attr = $this->get_attribute($attr);

        $column_class = $this->get_module_column_class($attr);
        $output = $this->render_module($attr, $column_class);

        if(!$this->is_column_compatible() && ( current_user_can('editor') || current_user_can('administrator') ))
        {
            $output = $output . $this->render_uncompatible();
        }

        do_action($this->class_name);
        return $output;
    }

    /**
     * Render if module is not compatible
     *
     * @return string
     */
    public function render_uncompatible()
    {
        $compatible = $this->compatible_column();
        $column = $this->manager->get_current_width();
        $text = wp_kses(sprintf(__('This module works best for column <strong>%s</strong> ( current column width <strong>%s</strong> ). This warning will only show if you login as Admin.', 'jnews'), implode(', ', $compatible), $column), wp_kses_allowed_html());
        $element =
            "<div class=\"alert alert-error alert-compatibility\">
                <strong>" . jnews_return_translation('Optimal Column','jnews', 'optimal_column') . "</strong> {$text}
            </div>";

        return $element;
    }

    /**
     * Check if column is not compatible
     *
     * @return bool
     */
    public function is_column_compatible()
    {
        $compatible = $this->compatible_column();
        $column = $this->manager->get_current_width();

        if($column === null) return true;
        return in_array($column, $compatible);
    }

    /**
     * @return int
     */
    public function get_post_id()
    {
        global $wp_query;
        if(isset($wp_query->post)) {
            return $wp_query->post->ID ;
        }
        return null;
    }

    /**
     * Generate Unique ID For Module
     */
    public function generate_unique_id()
    {
        $this->unique_id = 'jnews_module_' . $this->get_post_id() . '_' . $this->manager->get_module_count() . '_' . uniqid();
        // need to increase module count
        $this->manager->increase_module_count();
    }

    /**
     * Render Widget
     *
     * @param $instance
     */
    public function render_widget($instance)
    {
        if($this->is_compatible_widget())
        {
            echo jnews_sanitize_output($this->build_module($instance));
        }
    }

    /**
     * Render VC shortcode
     *
     * @param $attr
     * @param $content
     * @return mixed
     */
    public function render_shortcode($attr, $content)
    {
        return $this->build_module($attr, $content);
    }

    /**
     * get thumbnail
     * @param $post_id
     * @param $size
     * @return mixed|string
     */
    public function get_thumbnail($post_id, $size)
    {
        return apply_filters('jnews_image_thumbnail', $post_id, $size);
    }

    /**
     * Render primary category
     *
     * @param $post_id
     * @return mixed|string
     */
    public function get_primary_category($post_id)
    {
        $cat_id = jnews_get_primary_category($post_id);
        $category = '';

        if($cat_id) {
            $category = get_category($cat_id);
            $class = 'class="category-'. $category->slug .'"';
            $category = "<a href=\"" . get_category_link($cat_id) . "\" {$class}>" . $category->name . "</a>";
        }

        return $category;
    }

    public function except_more()
    {
        return isset($this->attribute['excerpt_ellipsis']) ? $this->attribute['excerpt_ellipsis'] : ' ...';
    }

    public function excerpt_length()
    {
        if(isset($this->attribute['excerpt_length']))
        {
        	if ( isset( $this->attribute['excerpt_length']['size'] ) && ! empty( $this->attribute['excerpt_length']['size'] ) )
	        {
		        return $this->attribute['excerpt_length']['size'];
	        }

            return $this->attribute['excerpt_length'];
        } else {
            return 20;
        }
    }

    public function format_date($post)
    {
        if(isset($this->attribute['date_format']))
        {
            $date_format = $this->attribute['date_format'];

            if($date_format === 'ago') {
                return jnews_ago_time ( human_time_diff( get_the_time('U', $post), current_time('timestamp') ) );
            } else if ($date_format === 'custom') {
                return get_the_modified_date($this->attribute['date_format_custom'], $post);
            } else if ($date_format) {
                return get_the_modified_date(null, $post);
            }
        }

        return get_the_modified_date(null, $post);
    }

    protected function get_excerpt($post)
    {
        $excerpt = $post->post_excerpt;

        if(empty($excerpt))
        {
            $excerpt = $post->post_content;
        }

        $excerpt = wp_trim_words($excerpt, $this->excerpt_length(), $this->except_more());
        $excerpt = preg_replace( '/\[[^\]]+\]/', '', $excerpt );

        return apply_filters('jnews_module_excerpt', $excerpt, $post->ID, $this->excerpt_length(), $this->except_more());
    }

    protected function collect_post_id($content)
    {
        $post_ids = array();
        foreach($content['result'] as $result) {
            $post_ids[] = $result->ID;
        }
        return $post_ids;
    }

    /**
     * build query
     *
     * @param $attr
     * @return array
     */
    protected function build_query($attr)
    {
        if(isset($attr['unique_content']) && $attr['unique_content'] !== 'disable')
        {
            if(!empty($attr['exclude_post'])) {
                $exclude_post = explode(',', $attr['exclude_post']);
            } else {
                $exclude_post = array();
            }

            $exclude_post = array_merge($this->manager->get_unique_article($attr['unique_content']), $exclude_post);
            $attr['exclude_post'] = implode(',', $exclude_post);

            // we need to alter attribute here...
            $this->set_attribute($attr);
        }

        $result = ModuleQuery::do_query($attr);

        if(isset($attr['unique_content']) && $attr['unique_content'] !== 'disable')
        {
            $this->manager->add_unique_article($attr['unique_content'], $this->collect_post_id($result));
        }

        if(isset($result['result']))
        {
            foreach($result['result'] as $post)
            {
                do_action('jnews_json_archive_push', $post->ID);
            }
        }

        return $result;
    }

    /**
     * Post meta type 1
     *
     * @param $post
     * @return string
     */
    public function post_meta_1($post)
    {
        $output = '';

        if(get_theme_mod('jnews_show_block_meta', true))
        {
            $comment            = jnews_get_comments_number($post->ID);

            // author detail
            $author             = $post->post_author;
            $author_url         = get_author_posts_url($author);
            $author_name        = get_the_author_meta('display_name', $author);

            if( jnews_is_review($post->ID) )
            {
                $rating = jnews_generate_rating($post->ID, 'jeg_landing_review');

                $output .= "<div class=\"jeg_post_meta\">";
                $output .= get_theme_mod('jnews_show_block_meta_rating', true) ? $rating : "";
                $output .= get_theme_mod('jnews_show_block_meta_author', true) ? "<div class=\"jeg_meta_author\"><span class=\"by\">" . jnews_return_translation('by', 'jnews', 'by') . "</span> <a href=\"{$author_url}\">{$author_name}</a></div>" : "";
                $output .= "</div>";
            } else {
                $output .= "<div class=\"jeg_post_meta\">";
                $output .= get_theme_mod('jnews_show_block_meta_author', true) ? "<div class=\"jeg_meta_author\"><span class=\"by\">" . jnews_return_translation('by', 'jnews', 'by') . "</span> <a href=\"{$author_url}\">{$author_name}</a></div>" : "";
                $output .= get_theme_mod('jnews_show_block_meta_date', true) ? "<div class=\"jeg_meta_date\"><a href=\"" . get_the_permalink($post) . "\"><i class=\"fa fa-clock-o\"></i> " . $this->format_date($post) . "</a></div>" : "";
                $output .= get_theme_mod('jnews_show_block_meta_comment', true) ? "<div class=\"jeg_meta_comment\"><a href=\"" . jnews_get_respond_link($post->ID) . "\" ><i class=\"fa fa-comment-o\"></i> {$comment}</a></div>" : "";
                $output .= "</div>";
            }
        }

        return apply_filters('jnews_module_post_meta_1', $output, $post, self::getInstance());
    }

    /**
     * Post Meta Type 2
     *
     * @param $post
     * @return string
     */
    public function post_meta_2($post)
    {
        $output = '';

        if(get_theme_mod('jnews_show_block_meta', true))
        {
            if (jnews_is_review($post->ID)) {
                $output = get_theme_mod('jnews_show_block_meta_rating', true) ? jnews_generate_rating($post->ID, 'jeg_landing_review') : "";
            } else {

                $output .= "<div class=\"jeg_post_meta\">";
                $output .= get_theme_mod('jnews_show_block_meta_date', true) ? "<div class=\"jeg_meta_date\"><a href=\"" . get_the_permalink($post) . "\" ><i class=\"fa fa-clock-o\"></i> " . $this->format_date($post) . "</a></div>" : "";
                $output .= "</div>";
            }
        }


        return apply_filters('jnews_module_post_meta_2', $output, $post, self::getInstance());
    }

    /**
     * Post meta type 3
     *
     * @param $post
     * @return string
     */
    public function post_meta_3($post)
    {
        $output = '';

        if(get_theme_mod('jnews_show_block_meta', true))
        {
            if (jnews_is_review($post->ID)) {
                $rating = jnews_generate_rating($post->ID, 'jeg_landing_review');

                $output .= "<div class=\"jeg_post_meta\">";
                $output .= get_theme_mod('jnews_show_block_meta_rating', true) ? $rating : "";
                $output .= get_theme_mod('jnews_show_block_meta_date', true) ? "<div class=\"jeg_meta_date\"><a href=\"" . get_the_permalink($post) . "\"><i class=\"fa fa-clock-o\"></i> " . $this->format_date($post) . "</a></div>" : "";
                $output .= "</div>";
            } else {

                // author detail
                $author = $post->post_author;
                $author_url = get_author_posts_url($author);
                $author_name = get_the_author_meta('display_name', $author);

                $output .= "<div class=\"jeg_post_meta\">";
                $output .= get_theme_mod('jnews_show_block_meta_author', true) ? "<div class=\"jeg_meta_author\"><span class=\"by\">" . jnews_return_translation('by', 'jnews', 'by') . "</span> <a href=\"{$author_url}\">{$author_name}</a></div>" : "";
                $output .= get_theme_mod('jnews_show_block_meta_date', true) ? "<div class=\"jeg_meta_date\"><a href=\"" . get_the_permalink($post) . "\"><i class=\"fa fa-clock-o\"></i> " . $this->format_date($post) . "</a></div>" : "";
                $output .= "</div>";

            }
        }

        return apply_filters('jnews_module_post_meta_3', $output, $post, self::getInstance());
    }

    /**
     * Get attribute
     *
     * @param $attr
     * @return array
     */
    public function get_attribute($attr)
    {
        $this->attribute = wp_parse_args( $attr , $this->options);
        return $this->attribute;
    }

    public function set_attribute($attr)
    {
        $this->attribute = $attr;
    }

    /**
     * Empty Content
     *
     * @return string
     */
    public function empty_content()
    {
        $no_content = "<div class='jeg_empty_module'>" . jnews_return_translation('No Content Available','jnews', 'no_content_available') . "</div>";
        return apply_filters('jnews_module_no_content', $no_content);
    }

    public function render_module_ads( $ajax_class = '' )
    {
        $attr     = $this->attribute;
        $addclass = isset( $attr['ads_class'] ) ? 'jnews_' . $attr['ads_class'] . '_ads' : '';

        return "<div class='jeg_ad jeg_ad_module {$addclass} {$ajax_class}'>" . $this->build_module_ads( $attr ) . "</div>";
    }

    public function build_module_ads( $attr, $echo = false )
    {
        $type       = $attr['ads_type'];
        $addclass   = isset( $attr['ads_class'] ) ? $attr['ads_class'] : '';
        $ads_html   = '';

        if ( $type === 'image' )
        {
            $ads_tab    = $attr['ads_image_new_tab'] ? '_blank' : '_self';
            $ads_link   = $attr['ads_image_link'];
            $ads_text   = $attr['ads_image_alt'];
            $ads_image  = $attr['ads_image'];

            if ( filter_var($ads_image, FILTER_VALIDATE_URL) === FALSE ) 
            {
	            if ( isset( $ads_image['url'] ) && ! empty( $ads_image['url'] ) )
	            {
		            $ads_image = $ads_image['url'];
	            } else {
		            $ads_image  = wp_get_attachment_image_src($ads_image, 'full')[0];
	            }
            }

            if ( ! empty( $ads_image ) )
            {
                $ads_html = "<a href='{$ads_link}' target='{$ads_tab}' class='adlink {$addclass}'><img src='{$ads_image}' alt='{$ads_text}' data-pin-no-hover=\"true\"></a>";
            }
        }

        if ( $type === 'shortcode' )
        {
            $shortcode  = $attr['shortcode'];
            $ads_html   = "<div class='{$addclass}'>" . do_shortcode($shortcode) . "</div>";
        }

        if ( $type === 'code' )
        {
            $code = empty($this->content) ? $attr['content'] : $this->content;
            $ads_html = "<div class='{$addclass}'>" . $code . "</div>";
        }

        if ( $type === 'googleads' )
        {
            $publisherid = $attr['google_publisher_id'];
            $slotid      = $attr['google_slot_id'];

            if ( ! empty($publisherid) && ! empty($slotid) )
            {
                $column = $this->manager->get_current_width();

                if ( $column >= 8 )
                {
                    $desktopsize_ad = array('728','90');
                    $tabsize_ad     = array('468','60');
                    $phonesize_ad   = array('320', '50');
                } else {
                    $desktopsize_ad = array('300','250');
                    $tabsize_ad     = array('300','250');
                    $phonesize_ad   = array('300','250');
                }

                $desktopsize    = $attr['google_desktop'];
                $tabsize        = $attr['google_tab'];
                $phonesize      = $attr['google_phone'];

                if ( $desktopsize !== 'auto' )
                {
                    $desktopsize_ad = explode('x', $desktopsize);
                }
                if ( $tabsize !== 'auto' )
                {
                    $tabsize_ad = explode('x', $tabsize);
                }
                if ( $phonesize !== 'auto' )
                {
                    $phonesize_ad = explode('x', $phonesize);
                }

                $randomstring = $this->random_string();
                $ad_style = '';

                if ( $desktopsize !== 'hide' && is_array($desktopsize_ad) && isset($desktopsize_ad['0']) && isset($desktopsize_ad['1']) ) 
                {
                    $ad_style .= ".adsslot_{$randomstring}{ width:{$desktopsize_ad[0]}px !important; height:{$desktopsize_ad[1]}px !important; }\n";
                }
                if ( $tabsize !== 'hide' && is_array($tabsize_ad) && isset($tabsize_ad['0']) && isset($tabsize_ad['1']) ) 
                {
                    $ad_style .= "@media (max-width:1199px) { .adsslot_{$randomstring}{ width:{$tabsize_ad[0]}px !important; height:{$tabsize_ad[1]}px !important; } }\n";
                }
                if ( $phonesize !== 'hide' && is_array($phonesize_ad) && isset($phonesize_ad['0']) && isset($phonesize_ad['1']) ) 
                {
                    $ad_style .= "@media (max-width:767px) { .adsslot_{$randomstring}{ width:{$phonesize_ad[0]}px !important; height:{$phonesize_ad[1]}px !important; } }\n";
                }

                $ads_html .=
                    "<div class=\"{$addclass}\">
                        <style type='text/css' scoped>
                            {$ad_style}
                        </style>
                        <ins class=\"adsbygoogle adsslot_{$randomstring}\" style=\"display:inline-block;\" data-ad-client=\"{$publisherid}\" data-ad-slot=\"{$slotid}\"></ins>
                        <script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
                        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
                    </div>";
            }
        }

        $bottom_text = $attr['ads_bottom_text'];

        if($bottom_text) {
            $ads_text_html = jnews_return_translation( 'ADVERTISEMENT', 'jnews', 'advertisement' );
            $ads_html = $ads_html . "<div class='ads-text'>{$ads_text_html}</div>";
        }

        $ads_html = "<div class='ads-wrapper'>{$ads_html}</div>";

        if ( $echo )
        {
            echo $ads_html;
        } else {
            return $ads_html;
        }
    }

    protected function random_string( $length = 10 )
    {
        $characters         = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength   = strlen($characters);
        $randomString       = '';
        
        for ($i = 0; $i < $length; $i++) 
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    protected function random_ads_position( $count )
    {
        $position = -1;
        $attr     = $this->attribute;

        if ( isset($attr['ads_type']) && $attr['ads_type'] !== 'disable' )
        {
            if ( $attr['ads_random'] ) 
            {
                $position = rand( $attr['ads_position'], ($count - 2) );
            } else {
                $position = $attr['ads_position'];
            }
        }

        return (int) $position;
    }

	public function _content_template() {}

    abstract public function render_module($attr, $column_class);
}
