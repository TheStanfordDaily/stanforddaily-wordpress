<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $sticky_sidebar
 * @var $set_as_sidebar
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */
$el_class = $width = $css = $offset = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

do_action('jnews_register_column_width', $width);

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
	'wpb_column',
	'jeg_column',
	'vc_column_container',
	$width,
	vc_shortcode_custom_css_class( $css )
);

if(isset($sticky_sidebar) && $sticky_sidebar === 'yes') {
	array_push($css_classes, 'jeg_sticky_sidebar');
}

if(!JNews\Footer\FooterBuilder::getInstance()->is_on_footer())
{
    if(isset($set_as_sidebar) && $set_as_sidebar === 'yes') {
        array_push($css_classes, 'jeg_sidebar');
    } else {
        array_push($css_classes, 'jeg_main_content');
    }
}

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
	$css_classes[]='vc_col-has-fill';
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<div class="jeg_wrapper wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';

echo jnews_sanitize_output($output);

do_action('jnews_reset_column_width', $width);