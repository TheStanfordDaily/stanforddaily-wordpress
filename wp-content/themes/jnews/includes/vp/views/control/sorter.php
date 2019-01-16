<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<select multiple name="<?php echo esc_attr($name); ?>" class="vp-input vp-js-sorter" data-vp-opt="<?php echo esc_attr($opt); ?>">
	<?php
	$labels = array();
	foreach ($items as $item) $labels[$item->value] = $item->label;
	?>

	<?php foreach ($value as $v): ?>
	<option selected value="<?php echo esc_attr($v); ?>">
        <?php if(!is_null($v)) echo esc_html($labels[$v]); ?>
    </option>
	<?php unset($labels[$v]); endforeach; ?>

	<?php foreach ($labels as $i => $label): ?>
	<option value="<?php echo esc_attr($i); ?>"><?php echo esc_html($label); ?></option>
	<?php endforeach; ?>
</select>

<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot', $head_info); ?>