<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleViewAbstract;

Class Element_Socialiconwrapper_View extends ModuleViewAbstract
{
    public function render_module($attr, $column_class)
    {
    	global $social_inline_css, $social_vertical;

	    $style              = isset( $attr['style'] ) ? $attr['style'] : '';
	    $bg_color           = ( $attr['style'] != 'nobg') && ! empty( $attr['bg_color'] ) ? 'background-color:'. $attr['bg_color'] .';' : '';
	    $icon_color         = ! empty( $attr['icon_color'] ) ? 'color:'. $attr['icon_color'] .';' : '';

	    $social_inline_css  = ! empty( $attr['bg_color'] ) || !empty( $icon_color ) ? 'style="'. $bg_color . $icon_color .'"' : '';
	    $social_vertical    = $attr['vertical'] ? 'vertical_social' : '';

	    $align              = ! $social_vertical && $attr['align'] ? 'jeg_aligncenter' : '';
	    $beforesocial       = isset( $attr['beforesocial'] ) && ! empty( $attr['beforesocial'] ) ? wp_kses( $attr['beforesocial'], wp_kses_allowed_html() ) : '';
	    $aftersocial        = isset( $attr['aftersocial'] ) && ! empty( $attr['aftersocial'] ) ? wp_kses( $attr['aftersocial'], wp_kses_allowed_html() ) : '';

	    return
		    "<div class='jeg_social_wrap " . esc_attr( $align ) . "'>
				{$beforesocial}
			    <div class='socials_widget {$social_vertical}  " . esc_attr( $style ) . "'>
				    " . wpb_js_remove_wpautop( $this->content ) . "
			    </div>
			    {$aftersocial}
		    </div>";
    }
}