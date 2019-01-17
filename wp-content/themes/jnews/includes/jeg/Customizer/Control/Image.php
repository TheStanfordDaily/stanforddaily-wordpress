<?php
/**
 * Customizer Control: Alert
 *
 * @author      Jegtheme
 * @license     https://opensource.org/licenses/MIT
 */
namespace Jeg\Customizer\Control;

/**
 * Create a simple number control
 */
Class Image extends \WP_Customize_Image_Control {

    /**
     * The control type.
     *
     * @access public
     * @var string
     */
    public $type = 'jnews-image';

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
     */
    public $dynamic;

    /**
     * Refresh the parameters passed to the JavaScript via JSON.
     *
     * @see WP_Customize_Control::to_json()
     */
    public function to_json() {
        parent::to_json();

        $this->json['postvar']          = $this->postvar;
        $this->json['wrapper_class']    = $this->wrapper_class;
        $this->json['active_rule']      = $this->active_rule;
        $this->json['output']           = $this->output;
        $this->json['partial_refresh']  = $this->partial_refresh;
        $this->json['dynamic']          = $this->dynamic;
    }
}
