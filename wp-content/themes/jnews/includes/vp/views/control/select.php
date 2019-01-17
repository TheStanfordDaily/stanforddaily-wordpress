<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<select name="<?php echo esc_attr($name); ?>" class="vp-input vp-js-select2" autocomplete="off">
	<option></option>
	<?php foreach ($items as $item): ?>
	<option <?php if($item->value == $value) echo "selected" ?> value="<?php echo esc_attr($item->value); ?>"><?php echo esc_html($item->label); ?></option>
	<?php endforeach; ?>
</select>

<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot', $head_info); ?>