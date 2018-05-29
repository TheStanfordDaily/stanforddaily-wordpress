<?php
/**
 * Customizer Control: text.
 *
 * Creates a text
 *
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license     https://opensource.org/licenses/MIT
 * @author      Aristath
 * @author      Jegtheme
 */
namespace Jeg\Customizer\Control;

/**
 * Slider control (range).
 */
Class Textarea extends ControlAbstract {

    /**
     * The control type.
     *
     * @access public
     * @var string
     */
    public $type = 'jnews-textarea';

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
        <label>
			<span class="customize-control-title">
				{{{ data.label }}}
			</span>
            <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>
            <div>
                <textarea rows="5" {{{ data.link }}}>{{ data.value }}</textarea>
            </div>
        </label>
        <?php
    }
}
