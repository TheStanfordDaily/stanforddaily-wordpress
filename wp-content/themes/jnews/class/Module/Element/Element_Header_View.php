<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleViewAbstract;

Class Element_Header_View extends ModuleViewAbstract
{
    public function render_module($attr, $column_class)
    {
        // Heading
        $subtitle       = ! empty($attr['second_title']) ? "<strong>{$attr['second_title']}</strong>"  : "";
        $header_class   = "jeg_block_{$attr['header_type']}";
        $heading_title  = $attr['first_title'] . $subtitle;

        if(!empty($heading_title))
        {
            $heading_icon   = empty($attr['header_icon']) ? "" : "<i class='{$attr['header_icon']}'></i>";
            $heading_title  = "<span>{$heading_icon}{$attr['first_title']}{$subtitle}</span>";
            $heading_title  = ! empty($attr['url']) ? "<a href='{$attr['url']}'>{$heading_title}</a>" : $heading_title;
            $heading_title  = "<h3 class=\"jeg_block_title\">{$heading_title}</h3>";
        }

        $style_output   = jnews_header_styling($attr, $this->unique_id);
        $style          = !empty($style_output) ? "<style>{$style_output}</style>" : "";

        // Now Render Output
        if(empty($heading_title)) {
            $output = '';
        } else {
            $output =
                "<div class=\"jeg_block_heading {$header_class} jeg_align{$attr['header_align']} {$this->unique_id} {$this->get_vc_class_name()} {$this->color_scheme()}\">
                    {$heading_title}
                    {$style}
                </div>";
        }

        return $output;
    }

	public function _content_template()
	{
        ?>
        <# if ( settings.first_title ) { #>
            <style>
                <# if ( settings.header_type === 'heading_1' ) { #>
                    <# if ( settings.header_background ) { #>
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title span { background: {{{ settings.header_background }}}; }
                    <# } #>
                    <# if ( settings.header_text_color ) { #>
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title span,
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title i { color: {{{ settings.header_text_color }}}; }
                    <# } #>
                    <# if ( settings.header_line_color ) { #>
                        .jeg_block_{{{ settings.header_type }}} { border-color: {{{ settings.header_line_color }}}; }
                    <# } #>
                <# } #>
                <# if ( settings.header_type === 'heading_2' ) { #>
                    <# if ( settings.header_background ) { #>
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title span { background: {{{ settings.header_background }}}; }
                    <# } #>
                    <# if ( settings.header_text_color ) { #>
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title span,
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title i { color: {{{ settings.header_text_color }}}; }
                    <# } #>
                    <# if ( settings.header_secondary_background ) { #>
                        .jeg_block_{{{ settings.header_type }}} { background-color: {{{ settings.header_secondary_background }}}; }
                    <# } #>
                <# } #>
                <# if ( settings.header_type === 'heading_3' ) { #>
                    <# if ( settings.header_background ) { #>
                        .jeg_block_{{{ settings.header_type }}} { background: {{{ settings.header_background }}}; }
                    <# } #>
                    <# if ( settings.header_text_color ) { #>
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title span,
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title i { color: {{{ settings.header_text_color }}}; }
                    <# } #>
                <# } #>
                <# if ( settings.header_type === 'heading_4' ) { #>
                    <# if ( settings.header_background ) { #>
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title span { background: {{{ settings.header_background }}}; }
                    <# } #>
                    <# if ( settings.header_text_color ) { #>
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title span,
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title i { color: {{{ settings.header_text_color }}}; }
                    <# } #>
                <# } #>
                <# if ( settings.header_type === 'heading_5' ) { #>
                    <# if ( settings.header_background ) { #>
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title span,
                        .jeg_block_{{{ settings.header_type }}} .jeg_subcat { background: {{{ settings.header_background }}}; }
                    <# } #>
                    <# if ( settings.header_text_color ) { #>
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title span,
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title i { color: {{{ settings.header_text_color }}}; }
                    <# } #>
                    <# if ( settings.header_line_color ) { #>
                        .jeg_block_{{{ settings.header_type }}}:before { border-color: {{{ settings.header_line_color }}}; }
                    <# } #>
                <# } #>
                <# if ( settings.header_type === 'heading_6' ) { #>
                    <# if ( settings.header_text_color ) { #>
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title span,
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title i { color: {{{ settings.header_text_color }}}; }
                    <# } #>
                    <# if ( settings.header_line_color ) { #>
                        .jeg_block_{{{ settings.header_type }}} { border-color: {{{ settings.header_line_color }}}; }
                    <# } #>
                    <# if ( settings.header_accent_color ) { #>
                        .jeg_block_{{{ settings.header_type }}}:after { background-color: {{{ settings.header_accent_color }}}; }
                    <# } #>
                <# } #>
                <# if ( settings.header_type === 'heading_7' ) { #>
                    <# if ( settings.header_text_color ) { #>
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title span,
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title i { color: {{{ settings.header_text_color }}}; }
                    <# } #>
                    <# if ( settings.header_accent_color ) { #>
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title span { background-color: {{{ settings.header_accent_color }}}; }
                    <# } #>
                <# } #>
                <# if ( settings.header_type === 'heading_8' ) { #>
                    <# if ( settings.header_text_color ) { #>
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title span,
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title i { color: {{{ settings.header_text_color }}}; }
                    <# } #>
                <# } #>
                <# if ( settings.header_type === 'heading_9' ) { #>
                    <# if ( settings.header_text_color ) { #>
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title span,
                        .jeg_block_{{{ settings.header_type }}} .jeg_block_title i { color: {{{ settings.header_text_color }}}; }
                    <# } #>
                    <# if ( settings.header_line_color ) { #>
                        .jeg_block_{{{ settings.header_type }}} { border-color: {{{ settings.header_line_color }}}; }
                    <# } #>
                <# } #>
            </style>
            <div class="jeg_block_heading jeg_block_{{{ settings.header_type }}} jeg_align{{{ settings.header_align }}}">
                <h3 class="jeg_block_title">
                    <# if ( settings.url ) { #>
                        <a href="{{{ settings.url }}}">
                    <# } #>
                        <span>
                            <# if ( settings.header_icon ) { #>
                                <i class='{{{ settings.header_icon }}}'></i>
                            <# } #>
                            {{{ settings.first_title }}}
                            <# if ( settings.second_title ) { #>
                                <strong>{{{ settings.second_title }}}</strong>
                            <# } #>
                        </span>
                    <# if ( settings.url ) { #>
                        </a>
                    <# } #>
                </h3>
            </div>
        <# } #>
        <?php		
	}
}