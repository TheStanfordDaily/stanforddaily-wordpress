<?php
/**
 * Customizer Control: ControlAbstract
 *
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license     https://opensource.org/licenses/MIT
 * @author      Aristath
 * @author      Jegtheme
 */
namespace Jeg\Customizer\Control;

/**
 * The parent class for all JNews controls.
 * Other controls should extend this object.
 */
class ControlAbstract extends \WP_Customize_Control
{
    /**
     * Used to automatically generate all postMessage scripts.
     *
     * @access public
     * @var array
     */
    public $postvar = array();

    /**
     * Used to automatically generate all CSS output.
     *
     * @access public
     * @var array
     */
    public $output = array();

    /**
     * Data type
     *
     * @access public
     * @var string
     */
    public $option_type = 'theme_mod';

    /**
     * Wrapper Class
     *
     * @var String
     */
    public $wrapper_class;

    /**
     * active callback rule
     *
     * @var array
     */
    public $active_rule;

    /**
     * Partial refresh element
     *
     * @var
     */
    public $partial_refresh;

    /**
     * Check if control created dynamically
     *
     * @var boolean
     */
    public $dynamic;

    /**
     * Refresh the parameters passed to the JavaScript via JSON.
     *
     * @see WP_Customize_Control::to_json()
     */
    public function to_json() {
        parent::to_json();

        if ( isset( $this->default ) ) {
            $this->json['default'] = $this->default;
        } else {
            $this->json['default'] = $this->setting->default;
        }

        $this->json['value']            = $this->value();
        $this->json['choices']          = $this->choices;
        $this->json['link']             = $this->get_link();
        $this->json['id']               = $this->id;

        $this->json['postvar']          = $this->postvar;
        $this->json['wrapper_class']    = $this->wrapper_class;
        $this->json['active_rule']      = $this->active_rule;
        $this->json['output']           = $this->output;
        $this->json['partial_refresh']  = $this->partial_refresh;
        $this->json['dynamic']          = $this->dynamic;
    }

    /**
     * Renders the control wrapper and calls $this->render_content() for the internals.
     */
    protected function render() {
        $id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
        $class = 'customize-control customize-control-jnews customize-control-' . $this->type . ' ' . implode(' ', $this->wrapper_class);
        ?><li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
        <?php $this->render_content(); ?>
        </li><?php
    }

    /**
     * Render the control's content.
     *
     * @see WP_Customize_Control::render_content()
     */
    protected function render_content() {}
}
