<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<div class="image">
	<img src="<?php echo esc_url($preview); ?>" alt="" />
</div>
<input class="vp-input" type="hidden" readonly id="<?php echo esc_attr($name); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>" />
<div class="buttons">
	<input class="vp-js-imageupload vp-button button" type="button" value="<?php echo 'Choose File'; ?>" />
	<input class="vp-js-remove-upload vp-button button" type="button" value="x" />
</div>

<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot', $head_info); ?>