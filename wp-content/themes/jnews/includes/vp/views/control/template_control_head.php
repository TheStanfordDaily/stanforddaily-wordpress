<div class="vp-field <?php echo esc_attr($type); ?><?php echo !empty($container_extra_classes) ? (' ' . $container_extra_classes) : ''; ?>"
	data-vp-type="<?php echo esc_attr($type); ?>"
	<?php echo VP_Util_Text::print_if_exists($validation, 'data-vp-validation="%s"'); ?>
	<?php echo VP_Util_Text::print_if_exists(isset($binding) ? $binding : '', 'data-vp-bind="%s"'); ?>
	<?php echo VP_Util_Text::print_if_exists(isset($items_binding) ? $items_binding : '', 'data-vp-items-bind="%s"'); ?>
	<?php echo VP_Util_Text::print_if_exists(isset($dependency) ? $dependency : '', 'data-vp-dependency="%s"'); ?>
	<?php echo !empty( $active_callback ) ? 'data-active-callback="' . esc_attr( $active_callback ) . '"' : '' ; ?>
	id="<?php echo esc_attr($name); ?>">
	<div class="label">
		<label><?php echo esc_html($label); ?></label>
	</div>
	<div class="field">
		<div class="input">