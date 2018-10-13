<?php
/**
 * @author : Jegtheme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class JNews Share Bar
 */
Class JNews_Share_Bar
{
    /**
     * @var JNews_Share_Bar
     */
    private static $instance;

    /**
     * $var Integer
     */
    private $post_id;

    /**
     * @var JNews_Social_Counter
     */
    private $counter;

    /**
     * @var JNews_Initial_Counter
     */
    private $initial_counter;

    /**
     * @return JNews_Share_Bar
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * JNews_Util_ShareBar constructor.
     * @param null $post_id
     */
    private function __construct($post_id = null)
    {
        $this->post_id = ($post_id === null ) ? get_the_ID() : $post_id;
        $this->counter = new JNews_Social_Counter($post_id);
        $this->initial_counter = JNews_Initial_Counter::getInstance();
    }

    /**
     * @param $post_id
     */
    public function set_post_id($post_id)
    {
        $this->post_id = $post_id;
    }

    /**
     * @return string
     */
    public function top_share_output()
    {
        $view_tag           = $this->view_tag();
        $share_tag          = $this->share_tag();
        $main_button        = $this->main_button();
        $secondary_button   = $this->secondary_button();

        $output =
            "<div class=\"jeg_share_button clearfix\">
                <div class=\"jeg_share_stats\">
                    {$share_tag}
                    {$view_tag}
                </div>
                <div class=\"jeg_sharelist\">
                    {$main_button}
                    {$secondary_button}
                </div>
            </div>";

        return apply_filters('jnews_top_share_output', $output, $this->post_id);
    }

    public function float_share_output()
    {
        $main_button        = $this->main_button();
        $secondary_button   = $this->secondary_button();

        $output =
            "<div class=\"jeg_sharelist\">
                {$main_button}
                {$secondary_button}
            </div>";

        return apply_filters('jnews_float_share_output', $output, $this->post_id);
    }


    public function bottom_share_output()
    {
        $main_button        = $this->main_button_bottom();
        $secondary_button   = $this->secondary_button();

        $output =
            "<div class=\"jeg_share_button share-bottom clearfix\">
                <div class=\"jeg_sharelist\">
                    {$main_button}
                    {$secondary_button}
                </div>
            </div>";

        return apply_filters('jnews_bottom_share_output', $output, $this->post_id);
    }

    public function amp_share_output()
    {
        $main_button = $this->main_button();

        $output =
            "<div class=\"jeg_share_button share-amp clearfix\">
                <div class=\"jeg_sharelist\">
                    {$main_button}
                </div>
            </div>";

        return apply_filters('jnews_amp_share_output', $output, $this->post_id);
    }


    public function flat_share_output()
    {
        $main = $this->get_main_button();
        $secondary = $this->get_secondary_button();

        $buttons = array_merge($main, $secondary);
        $button_text = '';
        foreach($buttons as $button) {
            $share_url = $this->get_social_share_url($button['social_share'], $this->post_id);
            $icon_class = $this->get_icon_class($button['social_share']);
            $button_text .= "<a href=\"{$share_url}\"><i class=\"fa {$icon_class}\"></i></a>";
        }

        $output =
            "<div class=\"jeg_post_share\">
                {$button_text}
            </div>";

        return apply_filters('jnews_flat_share_output', $output, $this->post_id);
    }

    public function block_share_output()
    {
        $main_button      = $this->main_button_bottom();
        $output =
            "<div class=\"jeg_sharelist\">
                {$main_button}
            </div>";
        return apply_filters('jnews_block_share_output', $output, $this->post_id);
    }

    public function top_share()
    {
        $output = $this->top_share_output();
        $container = "<div class=\"jeg_share_top_container\">$output</div>";
        echo $container;
    }

    public function float_share()
    {
        $output = $this->float_share_output();
        $container = "<div class=\"jeg_share_float_container\">$output</div>";
        echo $container;
    }

    public function bottom_share()
    {
        $output = $this->bottom_share_output();
        $container = "<div class=\"jeg_share_bottom_container\">$output</div>";
        echo $container;
    }

    public function amp_share()
    {
        $output = $this->amp_share_output();
        $container = "<div class=\"jeg_share_amp_container\">$output</div>";
        echo $container;
    }

    public function show_view_tag()
    {
        return apply_filters('jnews_show_view_tag', true, $this->post_id);
    }

    public function show_share_tag()
    {
        return apply_filters('jnews_show_share_tag', true, $this->post_id);
    }

    protected function view_tag()
    {
        if($this->show_view_tag())
        {
            $total = apply_filters('jnews_get_total_view', 0, $this->post_id, 'all');
            $total = $this->initial_counter->get_total_fake_view($total, $this->post_id);

            $view_tag =
                "<div class=\"jeg_views_count\">
                    <div class=\"counts\">" . jnews_number_format($total) . "</div>
                    <span class=\"sharetext\">" . jnews_return_translation('VIEWS', 'jnews-social-share', 'views') . "</span>
                </div>";

            return apply_filters('jnews_single_view_tag', $view_tag, $this->post_id);
        }

        return null;
    }

    protected function share_tag()
    {
        if($this->show_share_tag())
        {
            $total = $this->counter->get_share('total');
            $total = $this->initial_counter->get_total_fake_share($total, $this->post_id);
            $threshold = jnews_get_option('single_social_share_threshold', 0);

            if($total >= $threshold )
            {
                $share_tag =
                    "<div class=\"jeg_share_count\">
                        <div class=\"counts\">" . jnews_number_format($total) . "</div>
                        <span class=\"sharetext\">" . jnews_return_translation('SHARES', 'jnews-social-share', 'shares_uppercase') . "</span>
                    </div>";

                return apply_filters('jnews_single_share_tag', $share_tag, $this->post_id);
            }
        }

        return null;
    }

    protected function secondary_button()
    {
        $secondary_button = '';
        $shares = $this->get_secondary_button();

        if (!empty($shares)) {
            foreach ($shares as $share) {
                $secondary_button .= $this->build_button($share['social_share']);
            }

            $secondary_button =
                "<div class=\"share-secondary\">
                    {$secondary_button}
                </div>
                <a href=\"#\" class=\"jeg_btn-toggle\"><i class=\"fa fa-share\"></i></a>";
        }

        return apply_filters('jnews_single_share_secondary_button', $secondary_button, $this->post_id);
    }

    protected function main_button()
    {
        $main_button = '';
        $shares = $this->get_main_button();

        if (!empty($shares)) {
            foreach ($shares as $share) {
                $main_button .= $this->build_button($share['social_share'], $share['social_text']);
            }
        }

        return apply_filters('jnews_single_share_main_button', $main_button, $this->post_id);
    }

    protected function main_button_bottom()
    {
        $main_button = '';
        $shares = $this->get_main_button();

        if (!empty($shares)) {
            foreach ($shares as $share) {
                $main_button .= $this->build_bottom_button($share['social_share']);
            }
        }

        return apply_filters('jnews_single_share_main_button_bottom', $main_button, $this->post_id);
    }

    public static function get_share_title($post_id)
    {
        $title = get_the_title($post_id);
        $title = html_entity_decode($title, ENT_QUOTES, 'UTF-8');
        $title = urlencode($title);
        $title = str_replace('#', '%23', $title);
        return esc_html($title);
    }

    public static function get_share_twitter_title($post_id)
    {
        $title = get_the_title($post_id);

        $via = jnews_get_option('single_social_share_via_twitter', '');
        if( !empty ( $via )) {
            $title = $title . " via @" . $via;
        }

        $title = html_entity_decode($title, ENT_QUOTES, 'UTF-8');
        $title = urlencode($title);
        $title = str_replace('#', '%23', $title);
        return esc_html($title);
    }

    public static function get_social_share_url($social, $post_id)
    {
        $image      = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
        $image_url  = $image ? $image[0] : '';
        $title      = self::get_share_title($post_id);
        $url        = apply_filters( 'jnews_get_permalink', jnews_encode_url($post_id) );

        switch ($social) {
            case 'facebook' :
                $button_url = 'http://www.facebook.com/sharer.php?u=' . $url;
                break;
            case 'twitter' :
                $title = self::get_share_twitter_title($post_id);
                $button_url = 'https://twitter.com/intent/tweet?text=' . $title . '&url=' . $url;
                break;
            case 'googleplus' :
                $button_url = 'https://plus.google.com/share?url=' . $url;
                break;
            case 'pinterest' :
                $button_url = 'https://www.pinterest.com/pin/create/bookmarklet/?pinFave=1&url=' . $url . '&media=' . $image_url . '&description=' . $title;
                break;
            case 'stumbleupon' :
                $button_url = 'http://www.stumbleupon.com/submit?url=' . $url . '&title='. $title;
                break;
            case 'linkedin' :
                $button_url = 'https://www.linkedin.com/shareArticle?url=' . $url . '&title=' . $title;
                break;
            case 'reddit' :
                $button_url = 'https://reddit.com/submit?url=' . $url . '&title=' . $title;
                break;
            case 'tumblr' :
                $button_url = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . $url . '&title=' . $title;
                break;
            case 'buffer' :
                $button_url = 'https://buffer.com/add?text=' . $title . '&url=' . $url;
                break;
            case 'vk' :
                $button_url = 'http://vk.com/share.php?url=' . $url;
                break;
            case 'whatsapp' :
                $button_url = 'whatsapp://send?text=' . $url;
                break;
            case 'wechat' :
                $button_url = 'weixin://dl/posts/link?url=' . $url;
                break;
            case 'line' :
                $button_url = 'line://msg/text/' . $url;
                break;
            case 'hatena' :
                $button_url = 'http://b.hatena.ne.jp/bookmarklet?url=' . $url . '&btitle=' . $title;
                break;
            case 'qrcode' :
                $button_url = 'https://chart.googleapis.com/chart?chs=400x400&cht=qr&choe=UTF-8&chl=' . $url;
                break;
            case 'email' :
                $button_url = 'mailto:?subject=' . $title . '&amp;body=' . $url;
                break;
            default:
                $button_url = $url;
                break;
        }
        return $button_url;
    }

    protected function get_button_class($social)
    {
        switch ($social) {
            case 'facebook' :
                $button_class = 'jeg_btn-facebook';
                break;
            case 'twitter' :
                $button_class = 'jeg_btn-twitter';
                break;
            case 'googleplus' :
                $button_class = 'jeg_btn-google-plus';
                break;
            case 'pinterest' :
                $button_class = 'jeg_btn-pinterest';
                break;
            case 'stumbleupon' :
                $button_class = 'jeg_btn-stumbleupon';
                break;
            case 'linkedin' :
                $button_class = 'jeg_btn-linkedin';
                break;
            case 'reddit' :
                $button_class = 'jeg_btn-reddit';
                break;
            case 'tumblr' :
                $button_class = 'jeg_btn-tumbrl';
                break;
            case 'buffer' :
                $button_class = 'jeg_btn-buffer';
                break;
            case 'vk' :
                $button_class = 'jeg_btn-vk';
                break;
            case 'whatsapp' :
                $button_class = 'jeg_btn-whatsapp';
                break;
            case 'wechat' :
                $button_class = 'jeg_btn-wechat';
                break;
            case 'line' :
                $button_class = 'jeg_btn-line';
                break;
            case 'hatena' :
                $button_class = 'jeg_btn-hatena';
                break;
            case 'qrcode' :
                $button_class = 'jeg_btn-qrcode';
                break;
            case 'email' :
                $button_class = 'jeg_btn-email';
                break;
            default :
                $button_class = '';
                break;
        }
        return $button_class;
    }

    protected function get_icon_class($social)
    {
        switch ($social) {
            case 'facebook' :
                $icon_class = 'fa fa-facebook-official';
                break;
            case 'twitter' :
                $icon_class = 'fa fa-twitter';
                break;
            case 'googleplus' :
                $icon_class = 'fa fa-google-plus';
                break;
            case 'pinterest' :
                $icon_class = 'fa fa-pinterest';
                break;
            case 'stumbleupon' :
                $icon_class = 'fa fa-stumbleupon';
                break;
            case 'linkedin' :
                $icon_class = 'fa fa-linkedin';
                break;
            case 'reddit' :
                $icon_class = 'fa fa-reddit';
                break;
            case 'tumblr' :
                $icon_class = 'fa fa-tumblr';
                break;
            case 'buffer' :
                $icon_class = 'fa fa-buffer';
                break;
            case 'vk' :
                $icon_class = 'fa fa-vk';
                break;
            case 'whatsapp' :
                $icon_class = 'fa fa-whatsapp';
                break;
            case 'wechat' :
                $icon_class = 'fa fa-wechat';
                break;
            case 'line' :
                $icon_class = 'fa fa-line';
                break;
            case 'hatena' :
                $icon_class = 'fa fa-hatena';
                break;
            case 'qrcode' :
                $icon_class = 'fa fa-qrcode';
                break;
            case 'email' :
                $icon_class = 'fa fa-envelope';
                break;
            default:
                $icon_class = 'fa fa-' . $social;
                break;
        }

        return $icon_class;
    }


    protected function build_button($social, $text = '')
    {
        $button_url     = self::get_social_share_url($social, $this->post_id);
        $button_class   = $this->get_button_class($social);
        $icon_class     = $this->get_icon_class($social);
        $additional_attribute = '';

        if(function_exists('pll__'))
        {
            $text = pll__($text);
        }

        if ( function_exists('icl_t') ) 
        {
            $text = icl_t( 'jnews', $text, $text );
        }

        $expanded = !empty($text) ? "expanded" : "";
        $sharetext = !empty($text) ? "<span>$text</span>" : '';

        if($social === 'whatsapp')
        {
            $additional_attribute .= ' data-action="share/whatsapp/share" ';
        }

        $button = "<a href=\"{$button_url}\" {$additional_attribute} class=\"{$button_class} {$expanded}\"><i class=\"{$icon_class}\"></i>$sharetext</a>";

        return $button;
    }

    protected function build_bottom_button($social)
    {
        $total = 0;

        switch ($social) {
            case 'facebook' :
                $total = $this->initial_counter->social_share($this->counter->get_share('facebook'), $this->post_id, 'facebook');
                $text = jnews_return_translation('Share', 'jnews-social-share', 'share');
                break;
            case 'twitter' :
                $total = $this->initial_counter->social_share($this->counter->get_share('twitter'), $this->post_id, 'twitter');
                $text = jnews_return_translation('Tweet', 'jnews-social-share', 'tweet');
                break;
            case 'googleplus' :
                $total = $this->initial_counter->social_share($this->counter->get_share('google'), $this->post_id, 'google');
                $text = jnews_return_translation('Share', 'jnews-social-share', 'share');
                break;
            case 'pinterest' :
                $total = $this->initial_counter->social_share($this->counter->get_share('pinterest'), $this->post_id, 'pinterest');
                $text = jnews_return_translation('Pin', 'jnews-social-share', 'pin');
                break;
            case 'stumbleupon' :
                $total = $this->initial_counter->social_share($this->counter->get_share('stumbleupon'), $this->post_id, 'stumbleupon');
                $text = jnews_return_translation('Share', 'jnews-social-share', 'share');
                break;
            case 'linkedin' :
                $total = $this->initial_counter->social_share($this->counter->get_share('linkedin'), $this->post_id, 'linkedin');
                $text = jnews_return_translation('Share', 'jnews-social-share', 'share');
                break;
            case 'vk' :
                $total = $this->initial_counter->social_share($this->counter->get_share('vk'), $this->post_id, 'linkedin');
                $text = jnews_return_translation('Share', 'jnews-social-share', 'share');
                break;
            case 'line' :
                $text = jnews_return_translation('Share', 'jnews-social-share', 'share');
                break;
            case 'hatena' :
                $text = jnews_return_translation('Bookmark', 'jnews-social-share', 'bookmark');
                break;
            case 'qrcode' :
                $text = jnews_return_translation('Scan', 'jnews-social-share', 'scan');
                break;
            case 'whatsapp' :
                $text = jnews_return_translation('Send', 'jnews-social-share', 'send');
                break;
            case 'email' :
                $text = jnews_return_translation('Send', 'jnews-social-share', 'send');
                break;
            default :
                $text = jnews_return_translation('Share', 'jnews-social-share', 'share');
        }

        $button_url     = self::get_social_share_url($social, $this->post_id);
        $button_class   = $this->get_button_class($social);
        $icon_class     = $this->get_icon_class($social);

        $counttext      = $total > 0 ? "<span class=\"count\">{$total}</span>" : "";
        $sharetext      = !empty($text) ? "<span>{$text}{$counttext}</span>" : '';
        $button = "<a href=\"{$button_url}\" class=\"{$button_class} expanded\"><i class=\"{$icon_class}\"></i>{$sharetext}</a>";

        return $button;
    }


    public function get_main_button()
    {
        $main_button = array(
            array(
                'social_share'  => 'facebook',
                'social_text'   => 'Share on Facebook'
            ),
            array(
                'social_share'   => 'twitter',
                'social_text'    => 'Share on Twitter'
            ),
            array(
                'social_share'   => 'pinterest',
                'social_text'    => ''
            ),
        );

        $main_button = jnews_get_option('single_social_share_main', $main_button);

        return apply_filters('jnews_single_share_main_button_list', $main_button);
    }

    public function get_secondary_button()
    {
        $secondary_button = array(
            array(
                'social_share'   => 'googleplus',
            ),
            array(
                'social_share'  => 'linkedin',
            ),

        );

        $secondary_button = jnews_get_option('single_social_share_secondary', $secondary_button);

        return apply_filters('jnews_single_share_secondary_button_list', $secondary_button);
    }
}

