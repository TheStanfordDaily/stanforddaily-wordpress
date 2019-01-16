<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Footer;

use JNews\Module\ModuleViewAbstract;

Class Footer_Header_View extends ModuleViewAbstract
{
	public function render_module($attr, $column_class)
	{
		$style = isset( $attr['text_color'] ) && ! empty( $attr['text_color'] ) ? "style=\"color:{$attr['text_color']};\"" : "";
		$heading_title  = "<h3 class=\"jeg_footer_title\" {$style}>{$attr['first_title']}</h3>";

		if ( empty( $heading_title ) )
		{
			$output = '';
		} else {
			$output =
				"<div class=\"jeg_footer_heading jeg_align{$attr['header_align']} {$this->unique_id} {$this->get_vc_class_name()}\">
                    {$heading_title}
                </div>";
		}

		return $output;
	}

	public function _content_template()
	{
		?>
		<# if ( settings.first_title ) { #>
			<div class="jeg_footer_heading jeg_align{{{ settings.header_align }}}">
				<style>
					<# if ( settings.text_color ) { #>
						.jeg_footer_heading .jeg_footer_title { color: {{{ settings.text_color }}}; }
					<# } #>
				</style>
				<h3 class="jeg_footer_title">
					{{{ settings.first_title }}}
				</h3>
			</div>
			<# } #>
		<?php
	}

	public function render_column_alt($result, $column_class) {}
	public function render_column($result, $column_class) {}
}