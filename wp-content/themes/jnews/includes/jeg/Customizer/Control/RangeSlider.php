<?php
/**
 * Customizer Control: slider.
 *
 * Creates a jQuery slider control.
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
Class RangeSlider extends ControlAbstract {

    /**
     * The control type.
     *
     * @access public
     * @var string
     */
    public $type = 'jnews-range-slider';

    /**
     * Refresh the parameters passed to the JavaScript via JSON.
     *
     * @access public
     */
    public function to_json() {
        parent::to_json();
        $this->json['choices']['min']           = ( isset( $this->choices['min'] ) ) ? $this->choices['min'] : '0';
        $this->json['choices']['max']           = ( isset( $this->choices['max'] ) ) ? $this->choices['max'] : '100';
        $this->json['choices']['step']          = ( isset( $this->choices['step'] ) ) ? $this->choices['step'] : '1';
    }

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
            <# if ( data.label ) { #>
                <span class="customize-control-title">{{{ data.label }}}</span>
            <# } #>
            <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>
            <div class="wrapper">
                <div class="slider-range" range="{{data.value}}" bottom="{{data.value}}" min="{{ data.choices['min'] }}" max="{{ data.choices['max'] }}" step="{{ data.choices['step'] }}"></div>
            </div>
        </label>
        <?php
    }
}
