<?php
/**
 * Customizer Control: preset-image.
 *
 * @license     https://opensource.org/licenses/MIT
 * @author      Jegtheme
 */
namespace Jeg\Customizer\Control;

/**
 * Radio Image control (modified radio).
 */
Class PresetImage extends ControlAbstract {

    /**
     * The control type.
     *
     * @access public
     * @var string
     */
    public $type = 'jnews-preset-image';

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
        <div id="input_{{ data.id }}" data-link="{{ data.default }}" class="image">
            <# for ( key in data.choices ) { #>
                <label for="{{ data.id }}{{ key }}" data-id="{{ key }}">
                    <span class="image-clickable"></span>
                </label>
            <# } #>
        </div>
        <?php
    }
}