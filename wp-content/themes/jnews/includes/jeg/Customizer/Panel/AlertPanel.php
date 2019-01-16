<?php
/**
 * Customizer Panel: Alert
 *
 * @author      Jegtheme
 * @license     https://opensource.org/licenses/MIT
 */
namespace Jeg\Customizer\Panel;

/**
 * Default Settings
 */
class AlertPanel extends \WP_Customize_Panel {

    /**
     * Type of this panel.
     *
     * @since 4.1.0
     * @access public
     * @var string
     */
    public $type = 'warning';

    /**
     * An Underscore (JS) template for rendering this panel's container.
     *
     * Class variables for this panel class are available in the `data` JS object;
     * export custom variables by overriding WP_Customize_Panel::json().
     *
     * @see WP_Customize_Panel::print_template()
     *
     * @since 4.3.0
     * @access protected
     */
    protected function render_template() {
        ?>
        <div class="panel-customize-alert customize-alert customize-alert-warning control-panel-{{ data.type }}">
            <label>
                <# if ( data.title ) { #>
                    <strong class="customize-control-title">{{{ data.title }}}</strong>
                <# } #>
                <# if ( data.description ) { #>
                    <div class="description customize-control-description">{{{ data.description }}}</div>
                <# } #>
            </label>
        </div>
        <?php
    }


    /**
     * An Underscore (JS) template for this panel's content (but not its container).
     *
     * Class variables for this panel class are available in the `data` JS object;
     * export custom variables by overriding WP_Customize_Panel::json().
     *
     * @see WP_Customize_Panel::print_template()
     *
     * @since 4.3.0
     * @access protected
     */
    protected function content_template() {

    }
}

