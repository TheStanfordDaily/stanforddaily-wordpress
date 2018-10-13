<?php
/*
	Plugin Name: JNews - Gallery
	Plugin URI: http://jegtheme.com/
	Description: Alter your default WordPress post gallery to more beautiful gallery
	Version: 2.0.0
	Author: Jegtheme
	Author URI: http://jegtheme.com
	License: GPL2
*/

defined( 'JNEWS_GALLERY' ) 		        or define( 'JNEWS_GALLERY', 'jnews-gallery');
defined( 'JNEWS_GALLERY_URL' ) 		    or define( 'JNEWS_GALLERY_URL', plugins_url(JNEWS_GALLERY));
defined( 'JNEWS_GALLERY_FILE' ) 		or define( 'JNEWS_GALLERY_FILE',  __FILE__ );
defined( 'JNEWS_GALLERY_DIR' ) 		    or define( 'JNEWS_GALLERY_DIR', plugin_dir_path( __FILE__ ) );


/**
 * Get jnews option
 *
 * @param $setting
 * @param $default
 * @return mixed
 */
if(!function_exists('jnews_get_option'))
{
    function jnews_get_option($setting, $default = null)
    {
        $options = get_option( 'jnews_option', array() );
        $value = $default;
        if ( isset( $options[ $setting ] ) ) {
            $value = $options[ $setting ];
        }
        return $value;
    }
}

/**
 * Gallery Option
 */

add_action( 'jnews_register_customizer_option', 'jnews_gallery_customizer_option');

if(!function_exists('jnews_gallery_customizer_option'))
{
    function jnews_gallery_customizer_option()
    {
        require_once 'class.jnews-gallery-option.php';
        JNews_Gallery_Option::getInstance();
    }
}


add_filter('jeg_register_lazy_section', 'jnews_gallery_lazy_section');

if(!function_exists('jnews_gallery_lazy_section'))
{
    function jnews_gallery_lazy_section($result)
    {
        $result['jnews_preview_slider_section'][] = JNEWS_GALLERY_DIR . "preview-slider-option.php";
        $result['jnews_preview_slider_ads_section'][] = JNEWS_GALLERY_DIR . "preview-slider-ads-option.php";
        return $result;
    }
}


/**
 * Load script for JNews Gallery
 */
add_action('wp_enqueue_scripts', 'jnews_gallery_load_assets');

if( !function_exists('jnews_gallery_load_assets') )
{
    function jnews_gallery_load_assets()
    {
        // Style
        wp_enqueue_style('jnews-previewslider',             JNEWS_GALLERY_URL . '/assets/css/previewslider.css', null, null);
        wp_enqueue_style('jnews-previewslider-responsive',  JNEWS_GALLERY_URL . '/assets/css/previewslider-responsive.css', null, null);
        if(is_rtl()) {
            wp_enqueue_style('jnews-previewslider-rtl',     JNEWS_GALLERY_URL . '/assets/css/previewslider-rtl.css', null, null);
        }

        // Script
        wp_enqueue_script('jnews-previewslider',            JNEWS_GALLERY_URL . '/assets/js/jquery.previewslider.js', array('jquery'), null);
    }
}

/**
 * Additional control for media library
 */
add_action('print_media_templates', 'jnews_gallery_print_media_template');

if( !function_exists('jnews_gallery_print_media_template') )
{
    function jnews_gallery_print_media_template()
    {
        ?>
        <script type="text/html" id="tmpl-jnews-slider-gallery">
            <h2 class="jnews-gallery-setting-header"><?php esc_html_e('JNews Gallery Setting', 'jnews-gallery'); ?></h2>
            <label class="setting">
                <div class="setting-slider-gallery">
                    <span><?php esc_html_e('Enable JNews Slider Gallery', 'jnews-gallery'); ?></span>
                    <input type="checkbox" data-setting="jnewsslider" />
                </div>
            </label>
            <label class="setting">
                <div class="setting-slider-gallery">
                    <span><?php esc_html_e('Use Slider Zoom with Description', 'jnews-gallery'); ?></span>
                    <input type="checkbox" data-setting="jnewsslider_zoom" />
                </div>
            </label>
            <label class="setting">
                <div class="setting-slider-gallery">
                    <span><?php esc_html_e('Show Ads Wrapper', 'jnews-gallery'); ?></span>
                    <input type="checkbox" data-setting="jnewsslider_ads" />
                </div>
            </label>
            <label class="setting">
                <div class="setting-slider-gallery">
                    <span><?php esc_html_e('Slider Title', 'jnews-gallery'); ?></span>
                    <input type="text" data-setting="jnewsslider_title" />
                </div>

            </label>
        </script>

        <script>
            function do_execute_gallery(){
                if(typeof wp !== 'undefined') {
                    _.extend(wp.media.gallery.defaults, {
                        jnewsslider: false,
                        jnewsslider_zoom: false,
                        jnewsslider_ads: false,
                        jnewsslider_title: ''
                    });
                    wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
                        template: function(view){
                            return wp.media.template('gallery-settings')(view)
                                + wp.media.template('jnews-slider-gallery')(view);
                        }
                    });
                }
            }

            function do_gallery(){
                setTimeout(function(){
                    do_execute_gallery();
                }, 500);
            }

            jQuery(window).bind('load',function(){ do_gallery() });
            jQuery(document).bind('ready',function(){ do_gallery() });
        </script>

        <?php
    }
}

/**
 * Add & Remove Gallery Shortcode
 */
add_action('plugins_loaded', 'jnews_gallery_alter_shortcode');

if( !function_exists('jnews_gallery_alter_shortcode') )
{
    function jnews_gallery_alter_shortcode()
    {
        remove_shortcode('gallery');
        add_shortcode('gallery', 'jnews_gallery_shortcode');
    }
}


/**
 * Check if Gallery Enabled
 */
if( !function_exists('jnews_gallery_is_enabled') )
{
    function jnews_gallery_is_enabled($atts)
    {
        if($atts['jnewsslider'])
        {
            return true;
        } else {
            return jnews_get_option('preview_slider_toggle', false);
        }
    }
}

/**
 * Check if Gallery Description Enabled
 */
if( !function_exists('jnews_gallery_is_desc_enabled') )
{
    function jnews_gallery_is_desc_enabled($atts)
    {
        if(jnews_gallery_is_enabled($atts))
        {
            if($atts['jnewsslider'])
            {
                return $atts['jnewsslider_zoom'];
            } else {
                return jnews_get_option('preview_slider_desc', false);
            }
        }

        return false;
    }
}

/**
 * Check if Gallery Description Enabled
 */
if( !function_exists('jnews_gallery_is_ads_enabled') )
{
    function jnews_gallery_is_ads_enabled($atts)
    {
        if(jnews_gallery_is_enabled($atts))
        {
            if($atts['jnewsslider'])
            {
                return $atts['jnewsslider_ads'];
            } else {
                return jnews_get_option('preview_slider_ads', false);
            }
        }

        return false;
    }
}

if( !function_exists('jnews_gallery_ads') )
{
    function jnews_gallery_ads()
    {
        $ads_html = '';
        $type = jnews_get_option('ads_preview_slider_type', 'googleads');

        if($type === 'image')
        {
            $ads_tab = 'target="_blank"';
            $ads_link = jnews_get_option('ads_preview_slider_link', '');
            $ads_text = jnews_get_option('ads_preview_slider_text', '');
            $ads_image = jnews_get_option('ads_preview_slider_image', '');

            if( !empty($ads_image) )
            {
                $ads_html = "<a href='{$ads_link}' {$ads_tab} class='adlink jnews_gallery_ads'><img src='{$ads_image}' alt='{$ads_text}' data-pin-no-hover=\"true\"></a>";
            }
        }

        if($type === 'googleads')
        {
            $publisherid = jnews_get_option('ads_preview_slider_google_publisher', '');
            $slotid = jnews_get_option('ads_preview_slider_google_id', '');
            $ad_style = '';

            if(!empty($publisherid) && !empty($slotid))
            {
                $desktopsize_ad = array('300','250');
                $desktopsize    = jnews_get_option('ads_preview_slider_google_desktop', 'auto');

                if($desktopsize !== 'hide' && is_array($desktopsize_ad) && isset($desktopsize_ad['0']) && isset($desktopsize_ad['1']))
                {
                    if($desktopsize !== 'auto') {
                        $desktopsize_ad = explode('x', $desktopsize);
                    }
                    $ad_style .= ".adsslot_jnews_gallery { width:{$desktopsize_ad[0]}px !important; height:{$desktopsize_ad[1]}px !important; }\n";
                }


                $ads_html .=
                    "<div class=\"jnews_gallery_ads\">
                        <style type='text/css' scoped>
                            {$ad_style}
                        </style>
                        <ins class=\"adsbygoogle adsslot_jnews_gallery\" style=\"display:inline-block;\" data-ad-client=\"{$publisherid}\" data-ad-slot=\"{$slotid}\"></ins>
                        <script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
                        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
                    </div>";
            }
        }

        if($type === 'code')
        {
            $code = jnews_get_option('ads_preview_slider_code', '');
            $ads_html = "<div class='jnews_gallery_ads'><script type=\"text/javascript\">" . $code . "</script></div>";
        }

        if($type === 'shortcode')
        {
            $shortcode = jnews_get_option('ads_preview_slider_shortcode', '');
            $ads_html = "<div class='jnews_gallery_ads'>" . do_shortcode($shortcode) . "</div>";
        }

        $bottom_text = jnews_get_option('ads_preview_slider_ads_text', false);

        if($bottom_text) {
            $ads_text_html = jnews_return_translation( 'ADVERTISEMENT', 'jnews', 'advertisement' );
            $ads_html = $ads_html . "<div class='ads-text'>{$ads_text_html}</div>";
        }

        return "<div class='ads-wrapper'>" . $ads_html . "</div>";
    }
}

if( !function_exists('jnews_gallery_shortcode') )
{
    function jnews_gallery_shortcode($attr)
    {
        $post = get_post();

        static $instance = 0;
        $instance++;

        if ( ! empty( $attr['ids'] ) ) {
            // 'ids' is explicitly ordered, unless you specify otherwise.
            if ( empty( $attr['orderby'] ) ) {
                $attr['orderby'] = 'post__in';
            }
            $attr['include'] = $attr['ids'];
        }

        /**
         * Filter the default gallery shortcode output.
         *
         * If the filtered output isn't empty, it will be used instead of generating
         * the default gallery template.
         *
         * @since 2.5.0
         *
         * @see gallery_shortcode()
         *
         * @param string $output The gallery output. Default empty.
         * @param array  $attr   Attributes of the gallery shortcode.
         */
        $output = apply_filters( 'post_gallery', '', $attr );
        if ( $output != '' ) {
            return $output;
        }

        $html5 = current_theme_supports( 'html5', 'gallery' );
        $atts = shortcode_atts( array(
            'order'                 => 'ASC',
            'orderby'               => 'menu_order ID',
            'id'                    => $post ? $post->ID : 0,
            'itemtag'               => $html5 ? 'figure'     : 'dl',
            'icontag'               => $html5 ? 'div'        : 'dt',
            'captiontag'            => $html5 ? 'figcaption' : 'dd',
            'columns'               => 3,
            'size'                  => 'thumbnail',
            'include'               => '',
            'exclude'               => '',
            'link'                  => '',
            'jnewsslider'           => false,
            'jnewsslider_zoom'      => false,
            'jnewsslider_ads'       => false,
            'jnewsslider_title'     => '&nbsp;',
        ), $attr, 'gallery' );

        $zoom_script = apply_filters('jnews_single_popup_script', 'disable');

        if($zoom_script !== 'disable') {
            $atts['link'] = 'file';
        }

        $id = intval( $atts['id'] );

        if ( ! empty( $atts['include'] ) ) {
            $_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif ( ! empty( $atts['exclude'] ) ) {
            $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
        } else {
            $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
        }

        if ( empty( $attachments ) ) {
            return '';
        }

        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment ) {
                $output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
            }
            return $output;
        }

        $itemtag = tag_escape( $atts['itemtag'] );
        $captiontag = tag_escape( $atts['captiontag'] );
        $icontag = tag_escape( $atts['icontag'] );
        $valid_tags = wp_kses_allowed_html( 'post' );
        if ( ! isset( $valid_tags[ $itemtag ] ) ) {
            $itemtag = 'dl';
        }
        if ( ! isset( $valid_tags[ $captiontag ] ) ) {
            $captiontag = 'dd';
        }
        if ( ! isset( $valid_tags[ $icontag ] ) ) {
            $icontag = 'dt';
        }

        $columns = intval( $atts['columns'] );
        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
        $float = is_rtl() ? 'right' : 'left';

        $selector = "gallery_{$instance}";

        $gallery_style = '';

        if(jnews_gallery_is_enabled($atts))
        {
            if(!defined('JNEWS_THEME_URL'))
            {
                return
                    "<div style='background: #eee; border-left: 5px solid red; padding: 20px; margin-bottom: 1.5em;'>
                        <span>Please Install JNews Themes To use JNews Gallery Shortcode Feature</span>
                    </div>";
            }

            $slider_size = sizeof($attachments);
            $image_slides = $preview_description_content = '';
            $image_sequence = array();
            $sequence = 0;

            foreach ( $attachments as $id => $attachment )
            {
                $image_big = wp_get_attachment_image_src($attachment->ID, 'full');
                $first_active = ( $sequence === 0 ) ? 'active' : '';

                $image_slides .=
                    "<a data-id=\"{$sequence}\" data-title=\"{$attachment->post_excerpt}\" data-image=\"{$image_big[0]}\" href=\"{$image_big[0]}\" class=\"jeg_preview_item {$first_active}\">
                        <div class=\"jeg_preview_item_thumbnail\">
                            " . wp_get_attachment_image( $id, 'jnews-120x86' ) . "
                        </div>
                    </a>";

                $sequence++;

                if(jnews_gallery_is_desc_enabled($atts))
                {
                    $preview_description_content .=
                        "<div class=\"jeg_hidden_preview_description\">
                            <h3>{$sequence}. {$attachment->post_excerpt}</h3>
                            <div class=\"jeg_preview_description_content\">
                                " . wpautop($attachment->post_content) . "
                            </div>
                        </div>";
                } else {
                    $image_sequence[] = array(
                        'src'   => $image_big[0],
                        'w'     => $image_big[1],
                        'h'     => $image_big[2],
                        'title' => $attachment->post_excerpt
                    );
                }
            }

            $loader = jnews_get_option('preview_slider_loader', 'dot');

            $preview_holder_content =
                "<div class=\"jeg_preview_media\">
                    <div class=\"jeg_preview_media_holder\">
                        <h3>{$atts['jnewsslider_title']}</h3>
                        <div class=\"fullscreen-switch\">
                            <i class=\"fa\"></i>
                        </div>
                        <div class=\"jeg_preview_media_content\">
                            <div class=\"jeg_preview_media_content_holder_padding\">
                                <div class=\"jeg_preview_media_content_holder\"></div>
                            </div>
                            <div class=\"jeg_preview_media_content_navigation\">
                                <div class=\"prev\"></div>
                                <div class=\"next\"></div>
                            </div>
                            <div class='preview-slider-overlay'>
                                <div class='preloader_type preloader_{$loader}'>
                                    <div class=\"module-preloader jeg_preloader dot\">
                                        <span></span><span></span><span></span>
                                    </div>
                                    <div class=\"module-preloader jeg_preloader circle\">
                                        <div class=\"jnews_preloader_circle_outer\">
                                            <div class=\"jnews_preloader_circle_inner\"></div>
                                        </div>
                                    </div>
                                    <div class=\"module-preloader jeg_preloader square\">
                                        <div class=\"jnews-cube-grid\">
                                            <div class=\"jnews-cube jnews-cube1\"></div>
                                            <div class=\"jnews-cube jnews-cube2\"></div>
                                            <div class=\"jnews-cube jnews-cube3\"></div>
                                            <div class=\"jnews-cube jnews-cube4\"></div>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"jeg_preview_control\">
                            <div class=\"left_control\">
                                <div class=\"counter\"><span class=\"current\">1</span> " . jnews_return_translation('of', 'jnews-gallery', 'of') .  "  {$slider_size}</div>
                                <div class=\"subtitle\"></div>
                            </div>
                            <div class=\"zoom\">
                                <span class=\"reduce\">-</span>
                                <span class=\"increase\">+</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=\"jeg_preview_bottom_slider owl-carousel\">
                    {$image_slides}
                </div>";

            $preview_ads_container = "";

            if(jnews_gallery_is_ads_enabled($atts))
            {
                $preview_ads_container =
                    "<div class=\"jeg_preview_slider_ads\">" . jnews_gallery_ads() . "</div>";
            }

            // script parameter
            $is_rtl = is_rtl() ? "true" : "false";
            $native_zoom = jnews_gallery_is_desc_enabled($atts) ? "true" : "false";
            $image_sequence = wp_json_encode($image_sequence);
            $max_zoom = apply_filters('jnews_gallery_max_zoom',5);
            $zoom_step = apply_filters('jnews_gallery_zoom_step',40);

            $output =
                "<div class=\"jeg_preview_slider {$selector}\" data-selector='{$selector}'>
                    <div class=\"jeg_preview_holder\">
                        {$preview_holder_content}
                    </div>
                    <div class=\"jeg_preview_description\">
                        {$preview_ads_container}
                        <div class=\"jeg_preview_description_wrapper\">
                        {$preview_description_content}
                        </div>
                    </div>
                    <script>
                        var {$selector} = {
                            rtl: {$is_rtl},
                            native_zoom: {$native_zoom},
                            zoom_max: {$max_zoom},
                            zoom_step: {$zoom_step},
                            image_sequence: {$image_sequence}
                        };
                    </script>
                </div>";

        } else {

            add_filter( 'wp_get_attachment_image_attributes' , 'jnews_gallery_lazy_load_image');

            /**
             * Filter whether to print default gallery styles.
             *
             * @since 3.1.0
             *
             * @param bool $print Whether to print default gallery styles.
             *                    Defaults to false if the theme supports HTML5 galleries.
             *                    Otherwise, defaults to true.
             */
            if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
                $gallery_style = "
                    <style type='text/css' scoped>
                        #{$selector} {
                            margin: auto;
                        }
                        #{$selector} .gallery-item {
                            float: {$float};
                            margin-top: 10px;
                            text-align: center;
                            width: {$itemwidth}%;
                        }
                        #{$selector} img {
                            border: 2px solid #cfcfcf;
                        }
                        #{$selector} .gallery-caption {
                            margin-left: 0;
                        }
                        /* see gallery_shortcode() in wp-includes/media.php */
                    </style>\n\t\t";
            }

            $size_class = sanitize_html_class( $atts['size'] );
            $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

            /**
             * Filter the default gallery shortcode CSS styles.
             *
             * @since 2.5.0
             *
             * @param string $gallery_style Default CSS styles and opening HTML div container
             *                              for the gallery shortcode output.
             */
            $output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

            $i = 0;
            foreach ( $attachments as $id => $attachment ) {

                $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
                if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
                    $image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
                } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
                    $image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
                } else {
                    $image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
                }
                $image_meta  = wp_get_attachment_metadata( $id );

                $orientation = '';
                if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
                    $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
                }
                $output .= "<{$itemtag} class='gallery-item'>";
                $output .= "
            <{$icontag} class='gallery-icon {$orientation}'>
                $image_output
            </{$icontag}>";
                if ( $captiontag && trim($attachment->post_excerpt) ) {
                    $output .= "
                <{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
                }
                $output .= "</{$itemtag}>";
                if ( $columns > 0 && ++$i % $columns == 0 ) {
                    $output .= '<br style="clear: both" />';
                }
            }

            if ( $columns > 0 && $i % $columns !== 0 ) {
                $output .= "
            <br style='clear: both' />";
            }

            $output .= "
        </div>\n";

            remove_filter('wp_get_attachment_image_attributes', 'jnews_gallery_lazy_load_image');
        }
        return $output;
    }
}

if( !function_exists('jnews_gallery_lazy_load_image') )
{
    function jnews_gallery_lazy_load_image($attr)
    {
        $attr['class']          = $attr['class'] . ' lazyload';
        $attr['data-src']       = $attr['src'];
        $attr['data-sizes']     = 'auto';
        $attr['data-srcset']    = $attr['srcset'];
        $attr['data-expand']    = '700';
        $attr['src']            = '';

        unset($attr['srcset']);
        unset($attr['sizes']);

        return $attr;
    }
}


/** Print Translation */

if(!function_exists('jnews_print_translation'))
{
    function jnews_print_translation($string, $domain, $name)
    {
        do_action('jnews_print_translation', $string, $domain, $name);
    }
}


if(!function_exists('jnews_print_main_translation'))
{
    add_action('jnews_print_translation', 'jnews_print_main_translation', 10, 2);

    function jnews_print_main_translation($string, $domain)
    {
        call_user_func_array('esc_html_e', array($string, $domain));
    }
}

/** Return Translation */

if(!function_exists('jnews_return_translation'))
{
    function jnews_return_translation($string, $domain, $name, $escape = true)
    {
        return apply_filters('jnews_return_translation', $string, $domain, $name, $escape);
    }
}

if(!function_exists('jnews_return_main_translation'))
{
    add_filter('jnews_return_translation', 'jnews_return_main_translation', 10, 4);

    function jnews_return_main_translation($string, $domain, $name, $escape = true)
    {
        if($escape)
        {
            return call_user_func_array('esc_html__', array($string, $domain));
        } else {
            return call_user_func_array('__', array($string, $domain));
        }

    }
}



/**
 * Load Text Domain
 */

function jnews_gallery_load_textdomain()
{
    load_plugin_textdomain( JNEWS_GALLERY, false, basename(__DIR__) . '/languages/' );
}

jnews_gallery_load_textdomain();