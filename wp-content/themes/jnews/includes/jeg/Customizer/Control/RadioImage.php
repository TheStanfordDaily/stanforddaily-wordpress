<?php
/**
 * Customizer Control: radio-image.
 *
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license     https://opensource.org/licenses/MIT
 * @author      Aristath
 * @author      Jegtheme
 */
namespace Jeg\Customizer\Control;

/**
 * Radio Image control (modified radio).
 */
Class RadioImage extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'jnews-radio-image';

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<label class="customizer-text">
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
		</label>
		<div id="input_{{ data.id }}" class="image">
			<# for ( key in data.choices ) { #>
				<input class="image-select" type="radio" value="{{ key }}" name="_customize-radio-{{ data.id }}" id="{{ data.id }}{{ key }}" {{{ data.link }}}<# if ( data.value === key ) { #> checked="checked"<# } #>></input>
				<label for="{{ data.id }}{{ key }}" data-id="{{ key }}">
					<span class="image-clickable"></span>
				</label>

			<# } #>
		</div>
		<?php
	}
}