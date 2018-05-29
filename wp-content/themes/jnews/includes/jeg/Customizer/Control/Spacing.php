<?php
/**
 * Customizer Control: spacing
 *
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license     https://opensource.org/licenses/MIT
 * @author      Aristath
 * @author      Jegtheme
 */
namespace Jeg\Customizer\Control;

/**
 * Spacing control.
 * multiple checkboxes with CSS units validation.
 */
Class Spacing extends ControlAbstract {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'jnews-spacing';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @access public
	 */
	public function to_json() {
		parent::to_json();
		$this->json['choices'] = array();
		if ( is_array( $this->choices ) ) {
			foreach ( $this->choices as $choice => $value ) {
				if ( true === $value ) {
					$this->json['choices'][ $choice ] = true;
				}
			}
		}

		if ( is_array( $this->json['default'] ) ) {
			foreach ( $this->json['default'] as $key => $value ) {
				if ( isset( $this->json['choices'][ $key ] ) && ! isset( $this->json['value'][ $key ] ) ) {
					$this->json['value'][ $key ] = $value;
				}
			}
		}
	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
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
				<div class="control">
					<# for ( choiceKey in data.default ) { #>
						<div class="{{ choiceKey }}">
							<h5>{{ choiceKey }}</h5>
							<div class="{{ choiceKey }} input-wrapper">
								<input type="text" value="{{ data.value[ choiceKey ] }}"/>
								<span class="invalid-value"><?php echo esc_attr__( 'Value Invalid', 'jnews' ); ?></span>
							</div>
						</div>
					<# } #>
				</div>
			</div>
		</label>
		<?php
	}
}
