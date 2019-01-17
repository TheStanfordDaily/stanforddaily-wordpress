<?php
/**
 * @author : Jegtheme
 */
namespace JNews;

use JNews\Single\SinglePost;

/**
 * Class JNews Ads
 */
Class Ads
{
    /**
     * @var Ads
     */
    private static $instance;

    /**
     * @return Ads
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        // header
        add_action('jnews_header_top_ads', array($this, 'header_top'));
        add_action('jnews_header_ads', array($this, 'header'));

        // article
        add_action('jnews_article_top_ads', array($this, 'article_top'));
        add_action('jnews_content_top_ads', array($this, 'content_top'));
        add_action('jnews_article_bottom_ads', array($this, 'article_bottom'));
        add_action('jnews_content_inline_ads', array($this, 'content_inline'));

        add_action('jnews_single_post_before_content', array($this, 'article_content_top'), 10);
        add_action('jnews_single_post_after_content', array($this, 'article_content_bottom'), 10);

        // paragraph
        add_filter('the_content', array($this, 'inject_ads'), 10);

        // archive
        add_action('jnews_archive_above_content',   array($this, 'above_content'));
        add_action('jnews_archive_above_hero',      array($this, 'above_hero'));
        add_action('jnews_archive_below_hero',      array($this, 'below_hero'));

        // sidefeed
        add_action('jnews_sidefeed_ads', array($this, 'sidefeed'));

        // footer
        add_action('jnews_above_footer_ads', array($this, 'above_footer'));
        add_action('jnews_after_main', array($this, 'after_main'));
        add_action('wp_footer', array($this, 'sticky_footer_ads'), 50);

        // page level ads
        add_action('wp_footer', array($this, 'page_level_ads'));

    }

    public function page_level_ads()
    {
        if(wp_is_mobile())
        {
            if(get_theme_mod('jnews_page_level_ads_enable', false))
            {
                $join_ads           = array();
                $publisher          = get_theme_mod('jnews_ads_page_level_google_publisher', '');
                $vignette_channel   = get_theme_mod('jnews_ads_page_level_vignette_google_channel', '');
                $anchor_channel     = get_theme_mod('jnews_ads_page_level_anchor_google_channel', '');

                $join_ads[] = "google_ad_client: '{$publisher}'";
                $join_ads[] = "enable_page_level_ads: true";

                if(get_theme_mod('jnews_page_level_vignette_enable', false) && !empty($vignette_channel)) {
                    $join_ads[] = "vignettes: {google_ad_channel: '{$vignette_channel}'}";
                }

                if(get_theme_mod('jnews_page_level_anchor_enable', false) && !empty($anchor_channel)) {
                    $join_ads[] = "overlays: {google_ad_channel: '{$anchor_channel}'}";
                }

                $join_ads = implode(', ', $join_ads);

                $script =
                    "<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
                    <script>
                      ( adsbygoogle = window.adsbygoogle || []).push({
                            {$join_ads}
                      });
                    </script>";

                echo jnews_sanitize_output( $script );
            }
        }
    }

    /**
     * Inject ads inside content paragraph
     *
     * @param $content
     * @return string
     */
    public function inject_ads($content)
    {
        if(get_post_type() === 'post' && is_single() && ! is_admin())
        {
            $pnumber   = explode( '<p>', $content );
            $locations = array( 'content_inline', 'content_inline_2', 'content_inline_3' );

            foreach ( $locations as $location ) 
            {
                $adsposition = get_theme_mod('jnews_ads_' . $location . '_paragraph', 3);

                if ( get_theme_mod('jnews_ads_' . $location . '_paragraph_random', false) )
                {
                    $maxparagraph = count($pnumber) - 2;
                    $adsposition  = rand( $adsposition, $maxparagraph );
                }

                $ad_code = "<div class=\"jeg_ad jeg_ad_article jnews_{$location}_ads " . $this->additional_class($location) . " \">" . $this->content_inline( $location, false) . "</div>";
                $content = $this->prefix_insert_after_paragraph($ad_code, $adsposition, $content);
            }
        }

        return $content;
    }

    /**
     * insert code after paragraph
     *
     * @param $insertion
     * @param $paragraph_id
     * @param $content
     * @return string
     */
    public function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content )
    {
        $begin_p = '</p>';
        $paragraphs = explode( $begin_p, $content );

        if ($paragraph_id == 0 ) {
            return $insertion . $content;
        }

        foreach ($paragraphs as $index => $paragraph) {
            if ( ($paragraph_id - 1 ) == $index ) {
                $paragraphs[$index] .= $insertion;
            }
            if ( trim( $paragraph ) ) {
                $paragraphs[$index] .= $begin_p;
            }
        }
        return implode( '', $paragraphs );
    }

    /** call back **/
    public function header_top() {
        echo jnews_sanitize_output( $this->render_ads('header_top') );
    }

    public function header() {
        echo jnews_sanitize_output( 
            $this->render_ads('header', null, array(
                'jnews_ads_header_enable' => 1,
                'jnews_ads_header_type' => 'image',
                'jnews_ads_header_image' => get_parent_theme_file_uri('assets/img/ad_728x90.png'),
                'jnews_ads_header_link' => '#',
                'jnews_ads_header_text' => esc_html__('Advertisement', 'jnews')
            ))
        );
    }

    public function article_top() {
        echo jnews_sanitize_output( $this->render_ads('article_top') );
    }

    public function above_footer($echo = true)
    {
        $ads = $this->render_ads('above_footer');

        if($echo) {
            echo jnews_sanitize_output( $ads );
        } else {
            return $ads;
        }
    }

    public function article_content_top()
    {
        $html = "<div class=\"jeg_ad jeg_article jnews_content_top_ads " . $this->additional_class('content_top') . "\">" .  $this->content_top(false) . "</div>";
        echo jnews_sanitize_output( $html );
    }

    public function content_top($echo = true)
    {
        $ads = $this->render_ads('content_top');

        if($echo) {
            echo jnews_sanitize_output( $ads );
        } else {
            return $ads;
        }
    }

    public function article_content_bottom()
    {
        $html = "<div class=\"jeg_ad jeg_article jnews_content_bottom_ads " . $this->additional_class('content_bottom') . "\">" .  $this->content_bottom(false) . "</div>";
        echo jnews_sanitize_output( $html );
    }

    public function content_bottom($echo = true)
    {
        $ads = $this->render_ads('content_bottom');

        if($echo) {
            echo jnews_sanitize_output( $ads );
        } else {
            return $ads;
        }
    }

    public function article_bottom()
    {
        echo jnews_sanitize_output( $this->render_ads('article_bottom') );
    }

    public function content_inline_2() {
        $this->content_inline('content_inline_2');
    }

    public function content_inline_3() {
        $this->content_inline('content_inline_3');
    }

    public function content_inline($location = 'content_inline', $echo = true)
    {
        $align = get_theme_mod('jnews_ads_' . $location . '_align', 'center');
        $ads   = $this->render_ads( $location, 'align-' . $align );

        if ( $echo )
        {
            echo jnews_sanitize_output( $ads );
        } else {
            return $ads;
        }
    }

    public function sidefeed()
    {
        echo jnews_sanitize_output( $this->render_ads('sidefeed', 'jeg_ad_sidecontent') );
    }

    public function after_main()
    {
        $html = "<div class=\"jeg_ad jnews_above_footer_ads " . $this->additional_class('above_footer') . "\">" .  $this->above_footer(false) . "</div>";
        echo jnews_sanitize_output( $html );
    }

    public function sticky_footer_ads()
    {
        $html = "<div class=\"jeg_ad jnews_mobile_sticky_ads " . $this->additional_class('mobile_sticky') . "\">" .  $this->mobile_sticky(false) . "</div>";
        echo jnews_sanitize_output( $html );
    }

    public function mobile_sticky($echo = true)
    {
        if(wp_is_mobile())
        {
            $ads = $this->render_ads('mobile_sticky');

            if($echo) {
                echo jnews_sanitize_output( $ads );
            } else {
                return $ads;
            }
        }
    }

    public function above_content()
    {
        $html = "<div class=\"jeg_ad jeg_archive jnews_archive_above_content_ads " . $this->additional_class('archive_above_content') . "\">" . $this->archive_above_content(false) . "</div>";
        echo jnews_sanitize_output( $html );
    }

    public function archive_above_content( $echo = true )
    {
        $ads = $this->render_ads('archive_above_content');

        if ( $echo ) 
        {
            echo jnews_sanitize_output( $ads );
        } else {
            return $ads;
        }
    }

    public function above_hero()
    {
        $html = "<div class=\"jeg_ad jeg_category jnews_archive_above_hero_ads " . $this->additional_class('archive_above_hero') . "\">" . $this->archive_above_hero(false) . "</div>";
        echo jnews_sanitize_output( $html );
    }

    public function archive_above_hero( $echo = true )
    {
        $ads = $this->render_ads('archive_above_hero');

        if ( $echo ) 
        {
            echo jnews_sanitize_output( $ads );
        } else {
            return $ads;
        }
    }

    public function below_hero()
    {
        $html = "<div class=\"jeg_ad jeg_category jnews_archive_below_hero_ads " . $this->additional_class('archive_below_hero') . "\">" . $this->archive_below_hero(false) . "</div>";
        echo jnews_sanitize_output( $html );
    }

    public function archive_below_hero( $echo = true )
    {
        $ads = $this->render_ads('archive_below_hero');

        if ( $echo ) 
        {
            echo jnews_sanitize_output( $ads );
        } else {
            return $ads;
        }
    }

    public function inline_module()
    {
        echo jnews_sanitize_output( $this->render_ads('inline_module') );
    }

    /**
     * Calculate default size
     */
    public function get_location_size($location, &$desktopsize_ad, &$tabsize_ad, &$phonesize_ad)
    {
        if($location === 'header_1' || $location === 'header_2' || $location === 'header') {
            $desktopsize_ad = array('728','90');
            $tabsize_ad = array('468','60');
            $phonesize_ad = array('320', '50');
        }

        if($location === 'header_4' || $location === 'header_top' || $location === 'article_top' || $location === 'article_bottom') {
            $desktopsize_ad = array('970','90');
            $tabsize_ad = array('468','60');
            $phonesize_ad = array('320', '50');
        }

        if($location === 'content_top' || $location === 'content_bottom') {
            $desktopsize_ad = array('728','90');
            $tabsize_ad = array('468','60');
            $phonesize_ad = array('320', '50');
        }

        if($location === 'content_inline' || $location === 'content_inline_2' || $location === 'content_inline_3' || $location === 'inline_module')
        {
            $align = get_theme_mod('jnews_ads_' . $location . '_align', 'center');

            if($align === 'center')
            {
                $single = SinglePost::getInstance();
                $float_class = $single->share_float_additional_class();

                if($float_class === 'with-share')
                {
                    $desktopsize_ad = array('468','60');
                    $tabsize_ad = array('468','60');
                    $phonesize_ad = array('320', '50');
                } else {
                    $desktopsize_ad = array('728','90');
                    $tabsize_ad = array('468','60');
                    $phonesize_ad = array('320', '50');
                }

            } else {
                $desktopsize_ad = array('300','250');
                $tabsize_ad = array('300','250');
                $phonesize_ad = array('300','250');
            }
        }

        if($location === 'sidefeed')
        {
            $desktopsize_ad = array('300','250');
            $tabsize_ad = array('250','250');
            $phonesize_ad = array('250','250');
        }

        if($location === 'mobile_sticky') {
            $desktopsize_ad = array('','');
            $tabsize_ad = array('','');
            $phonesize_ad = array('320', '50');
        }
    }

    private function default_value($name, $default, $ads_default)
    {
        if(isset($ads_default[$name])) {
            return get_theme_mod($name, $ads_default[$name]);
        } else {
            return get_theme_mod($name, $default);
        }
    }

    /**
     * Calculate Real Ads
     *
     * @param $location
     * @param string $addclass
     * @param array $default
     * @return string
     */
    public function render_ads($location, $addclass = '', $default = array())
    {
        $enabled = $this->default_value('jnews_ads_' . $location . '_enable', false, $default);
        $ads_html = '';

        if($enabled)
        {
            $type = $this->default_value('jnews_ads_' . $location . '_type', 'googleads', $default);

            if($type === 'image')
            {
                $ads_tab = $this->default_value('jnews_ads_' . $location . '_open_tab', false, $default) ? 'target="_blank"' : '';
                $ads_link = $this->default_value('jnews_ads_' . $location . '_link', '', $default);
                $ads_text = $this->default_value('jnews_ads_' . $location . '_text', '', $default);
                $ads_image = $this->default_value('jnews_ads_' . $location . '_image', '', $default);

                if( !empty($ads_image) )
                {
                    $ads_html = "<a href='{$ads_link}' {$ads_tab} class='adlink {$addclass}'><img src='{$ads_image}' alt='{$ads_text}' data-pin-no-hover=\"true\"></a>";
                }
            }

            if($type === 'shortcode')
            {
                $shortcode = $this->default_value('jnews_ads_' . $location . '_shortcode', '', $default);
                $ads_html = "<div class='ads_shortcode'>" . do_shortcode($shortcode) . "</div>";
            }

            if($type === 'code')
            {
                $code = $this->default_value('jnews_ads_' . $location . '_code', '', $default);
                $ads_html = "<div class='ads_code'>" . $code . "</div>";
            }

            if($type === 'googleads')
            {
                $publisherid = $this->default_value('jnews_ads_' . $location . '_google_publisher', '', $default);
                $slotid = $this->default_value('jnews_ads_' . $location . '_google_id', '', $default);


                if(!empty($publisherid) && !empty($slotid))
                {
                    $desktopsize_ad = array();
                    $tabsize_ad = array();
                    $phonesize_ad = array();
                    $ad_style = '';

                    $desktopsize    = $this->default_value('jnews_ads_' . $location . '_google_desktop', 'auto', $default);
                    $tabsize        = $this->default_value('jnews_ads_' . $location . '_google_tab', 'auto', $default);
                    $phonesize      = $this->default_value('jnews_ads_' . $location . '_google_phone', 'auto', $default);

                    $this->get_location_size($location, $desktopsize_ad, $tabsize_ad, $phonesize_ad);

                    if($desktopsize !== 'auto') {
                        $desktopsize_ad = explode('x', $desktopsize);
                    }
                    if($tabsize !== 'auto') {
                        $tabsize_ad = explode('x', $tabsize);
                    }
                    if($phonesize !== 'auto') {
                        $phonesize_ad = explode('x', $phonesize);
                    }

                    $randomstring = $this->random_string();

                    if($desktopsize !== 'hide' && is_array($desktopsize_ad) && isset($desktopsize_ad['0']) && isset($desktopsize_ad['1'])) {
                        $ad_style .= ".adsslot_{$randomstring}{ width:{$desktopsize_ad[0]}px !important; height:{$desktopsize_ad[1]}px !important; }\n";
                    }

                    if($tabsize !== 'hide' && is_array($tabsize_ad) && isset($tabsize_ad['0']) && isset($tabsize_ad['1'])) {
                        $ad_style .= "@media (max-width:1199px) { .adsslot_{$randomstring}{ width:{$tabsize_ad[0]}px !important; height:{$tabsize_ad[1]}px !important; } }\n";
                    }

                    if($phonesize !== 'hide' && is_array($phonesize_ad) && isset($phonesize_ad['0']) && isset($phonesize_ad['1'])) {
                        $ad_style .= "@media (max-width:767px) { .adsslot_{$randomstring}{ width:{$phonesize_ad[0]}px !important; height:{$phonesize_ad[1]}px !important; } }\n";
                    }


                    $ads_html .=
                        "<div class=\"ads_google_ads\">
                            <style type='text/css' scoped>
                                {$ad_style}
                            </style>
                            <ins class=\"adsbygoogle adsslot_{$randomstring}\" style=\"display:inline-block;\" data-ad-client=\"{$publisherid}\" data-ad-slot=\"{$slotid}\"></ins>
                            <script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
                            <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
                        </div>";
                }
            }

            $bottom_text = $this->default_value('jnews_ads_' . $location . '_ads_text', false, $default);

            if($bottom_text) {
                $ads_text_html = jnews_return_translation( 'ADVERTISEMENT', 'jnews', 'advertisement' );
                $ads_html = $ads_html . "<div class='ads-text'>{$ads_text_html}</div>";
            }
        }

        return "<div class='ads-wrapper {$addclass}'>" . $ads_html . "</div>";
    }

    /**
     * Random string helper
     *
     * @param int $length
     * @return string
     */
    public function random_string($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

	protected function additional_class($location)
	{
		$class = array();

		if ( $this->default_value('jnews_ads_' . $location . '_google_desktop', false, 'auto') === 'hide' )
		{
			$class[] = 'jeg_ads_hide_desktop';
		}

		if ( $this->default_value('jnews_ads_' . $location . '_google_tab', false, 'auto') === 'hide' )
		{
			$class[] = 'jeg_ads_hide_tab';
		}

		if ( $this->default_value('jnews_ads_' . $location . '_google_phone', false, 'auto') === 'hide' )
		{
			$class[] = 'jeg_ads_hide_phone';
		}

		return implode(' ', $class);
	}
}