<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * @var $enable_overlay
 * @var $overlay_color
 * @var $enable_top_ribon
 * @var $top_ribon_bg
 * @var $enable_bottom_ribon
 * @var $bottom_ribon_bg
 * @var $background_repeat
 * @var $background_position
 * @var $background_attachment
 * @var $background_size
 *
 * @var $footer_scheme
 * @var $footer_text_color
 * @var $footer_widget_title_color
 * @var $footer_link_color
 * @var $footer_linkhover_color
 * @var $footer_form_bg
 * @var $footer_form_color
 * @var $footer_tags_bg
 * @var $footer_tags_color
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $footer_scheme = '';
$disable_element = '';
$output = $after_output = $footer_style = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

$css_classes = array(
	'row',
	'vc_row',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') ) || $video_bg || $parallax) {
	$css_classes[]='vc_row-has-fill';
}

if (!empty($atts['gap'])) {
	$css_classes[] = 'vc_column-gap-'.$atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$css_classes[] = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( false !== strpos( $parallax, 'fade' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}


/** additional */

$additional_tag = '';

if($enable_overlay) {
    $additional_tag .= '<div class="jeg_row_overlay" style="background-color: ' . $overlay_color . ';"></div>';
}

if($enable_top_ribon) {
    $imagedata = wp_get_attachment_image_src($top_ribon_bg, 'full');
    $additional_tag .= '<div class="jeg_top_ribon" style="background-image: url(' . $imagedata[0] . '); height: ' . $imagedata[2] . 'px;"></div>';
}

if($enable_bottom_ribon) {
    $imagedata = wp_get_attachment_image_src($bottom_ribon_bg, 'full');
    $additional_tag .= '<div class="jeg_bottom_ribon" style="background-image: url(' . $imagedata[0] . '); height: ' . $imagedata[2] . 'px;"></div>';
}


if($enable_overlay || $top_ribon_bg || $bottom_ribon_bg) {
    $css_classes[] = 'jeg_relative';
}

if(JNews\Footer\FooterBuilder::getInstance()->is_on_footer())
{
    $css_classes[] = $footer_class = jnews_random_class();

    if ($footer_scheme === 'dark') {
        $css_classes[] = 'footer_dark';
    } else {
        $css_classes[] = 'footer_light';
    }

    if($footer_text_color) {
        $footer_style .= " .{$footer_class} { color : {$footer_text_color}; }";
    }

    if($footer_link_color) {
        $footer_style .= " .{$footer_class}.footer_light a, .{$footer_class}.footer_dark a { color : {$footer_link_color}; }";
    }

    if($footer_linkhover_color) {
        $footer_style .= " .{$footer_class}.footer_light a:hover, .{$footer_class}.footer_dark a:hover { color : {$footer_linkhover_color}; }";
    }

    if($footer_widget_title_color) {
        $footer_style .= " .jeg_footer .{$footer_class} .widget h2, .{$footer_class}.footer_light .jeg_footer .jeg_footer_heading h3, .{$footer_class}.footer_dark .jeg_footer_heading h3 { color : {$footer_widget_title_color}; }";
    }

    if($footer_form_bg) {
        $footer_style .= " .{$footer_class} input:not([type=\"submit\"]),.{$footer_class} textarea,.{$footer_class} select,.{$footer_class}.footer_dark input:not([type=\"submit\"]),.{$footer_class}.footer_dark textarea,.{$footer_class}.footer_dark select { background-color : {$footer_form_bg}; }";
    }

    if($footer_form_color) {
        $footer_style .= " .{$footer_class} input:not([type=\"submit\"]),.{$footer_class} textarea,.{$footer_class} select,.{$footer_class}.footer_dark input:not([type=\"submit\"]),.{$footer_class}.footer_dark textarea,.{$footer_class}.footer_dark select { color : {$footer_form_color}; }";
    }

    if($footer_button_bg) {
        $footer_style .= " .jeg_footer .{$footer_class} input[type=\"submit\"], .jeg_footer .{$footer_class} .btn, .jeg_footer .{$footer_class} .button { background-color : {$footer_button_bg}; }";
    }

    if($footer_tags_bg) {
        $footer_style .= " .{$footer_class} .footer_widget.widget_tag_cloud a, .{$footer_class}.footer_dark .footer_widget.widget_tag_cloud a { background-color : {$footer_tags_bg}; }";
    }

    if($footer_tags_color) {
        $footer_style .= " .{$footer_class} .footer_widget.widget_tag_cloud a, .{$footer_class}.footer_dark .footer_widget.widget_tag_cloud a { color : {$footer_tags_color}; }";
    }

    $footer_style = !empty($footer_style) ? "<style type='text/css' scoped>$footer_style</style>" : "";
}

// Style
$styles = array();

if($background_repeat) {
    $styles[] = "background-repeat: {$background_repeat} !important";
}

if($background_position) {
    $styles[] = "background-position: {$background_position} !important";
}

if($background_attachment) {
    $styles[] = "background-attachment: {$background_attachment} !important";
}

if($background_size) {
    $styles[] = "background-size: {$background_size} !important";
}

if(!empty($styles)) {
    $wrapper_attributes[] = 'style="' . implode(';', $styles) . '""' ;
}

/** edditional */

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= $footer_style;
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<div class="jeg-vc-wrapper">';
$output .= $additional_tag;
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= $after_output;

echo jnews_sanitize_output($output);
