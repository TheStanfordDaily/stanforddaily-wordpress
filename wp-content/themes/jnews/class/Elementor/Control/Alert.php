<?php

namespace JNews\Elementor\Control;

use \Elementor\Base_Data_Control;

class Alert extends Base_Data_Control
{

	public function get_type()
    {
		return 'alert';
	}

	public function content_template()
    {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
            <div id="<?php echo $control_uid; ?>" class="elementor-control-input-wrapper type-alert">
                <div class="widget-alert alert-{{{ data.default }}}">
                    <strong>{{{ data.label }}}</strong>
                    <div class="alert-description">{{{ data.description }}}</div>
                </div>
            </div>
		</div>
		<?php
	}
}