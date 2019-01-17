<?php
/**
 * Customizer Control: typography
 *
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license     https://opensource.org/licenses/MIT
 * @author      Aristath
 * @author      Jegtheme
 */
namespace Jeg\Customizer\Control;

use Jeg\Customizer;

/**
 * Typography control.
 */
Class Gradient extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'jnews-gradient';


	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @access public
	 */
	public function to_json() {
		parent::to_json();
		$defaults = array(
				'degree'    	    => 0,
				'begincolor'      	=> false,
				'beginlocation'     => 0,
				'endcolor'    	    => false,
                'endlocation'    	=> 100,
		);

		$this->json['default'] = wp_parse_args( $this->json['default'], $defaults );
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
		<label class="customizer-text">
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
		</label>

		<div class="wrapper">

            <div class="jnews-range-degree range">
                <h5>Gradient Degree</h5>
                <input type="range" min="0" max="359" step="1" value="{{ data.value['degree'] }}" data-reset_value="0" />
                <div class="jnews_range_value">
                    <span class="value">{{{ data.value['degree'] }}}</span>
                </div>
                <div class="jnews-slider-reset">
                    <span class="dashicons dashicons-image-rotate"></span>
                </div>
            </div>

            <div class="jnews-range-begin range">
                <h5>Begin Location (in %)</h5>
                <input type="range" min="0" max="100" step="1" value="{{ data.value['beginlocation'] }}" data-reset_value="0" />
                <div class="jnews_range_value">
                    <span class="value">{{{ data.value['beginlocation'] }}}</span>
                </div>
                <div class="jnews-slider-reset">
                    <span class="dashicons dashicons-image-rotate"></span>
                </div>
            </div>

            <div class="jnews-range-end range">
                <h5>End Location (in %)</h5>
                <input type="range" min="0" max="100" step="1" value="{{ data.value['endlocation'] }}" data-reset_value="100" />
                <div class="jnews_range_value">
                    <span class="value">{{{ data.value['endlocation'] }}}</span>
                </div>
                <div class="jnews-slider-reset">
                    <span class="dashicons dashicons-image-rotate"></span>
                </div>
            </div>

            <div class="color">
                <h5>Begin Color</h5>
                <input type="text" data-palette="{{ data.palette }}" data-default-color="{{ data.default['begincolor'] }}" value="{{ data.value['begincolor'] }}" class="jnews-color-control jnews-begin-color color-picker"/>
            </div>

            <div class="color">
                <h5>End Color</h5>
                <input type="text" data-palette="{{ data.palette }}" data-default-color="{{ data.default['endcolor'] }}" value="{{ data.value['endcolor'] }}" class="jnews-color-control jnews-end-color color-picker"/>
            </div>

		</div>
		<?php
	}
}