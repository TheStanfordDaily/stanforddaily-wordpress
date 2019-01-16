<?php
/**
 * Customizer Control: radio.
 *
 * Creates a radio
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
Class Radio extends ControlAbstract {

    /**
     * The control type.
     *
     * @access public
     * @var string
     */
    public $type = 'jnews-radio';

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
        <span class="customize-control-title">
            {{{ data.label }}}
        </span>
        <# if ( data.description ) { #>
            <span class="description customize-control-description">{{{ data.description }}}</span>
        <# } #>
        <# for ( key in data.choices ) { #>
            <span class="customize-inside-control-row">
                <input id="_customize-input-{{ data.id }}-{{ key }}" type="radio" value="{{ key }}" name="_customize-radio-{{{ data.id }}}" id="{{ data.id }}{{ key }}" {{{ data.link }}}<# if ( key === data.value ) { #> checked="checked" <# } #>/>
                <label for="_customize-input-{{ data.id }}-{{ key }}">
                    {{ data.choices[ key ] }}
                </label>
            </span>
        <# } #>
        <?php
    }
}
