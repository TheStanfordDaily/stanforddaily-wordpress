<?php extract($head_info); ?>

<div class="vp-field <?php echo esc_attr($type); ?><?php echo !empty($container_extra_classes) ? (' ' . $container_extra_classes) : ''; ?>"
	data-vp-type="<?php echo esc_attr($type); ?>"
	<?php echo VP_Util_Text::print_if_exists(isset($binding) ? $binding : '', 'data-vp-bind="%s"'); ?>
	<?php echo VP_Util_Text::print_if_exists(isset($dependency) ? $dependency : '', 'data-vp-dependency="%s"'); ?>
	id="<?php echo esc_attr($name); ?>">
	<div class="field" style="height: <?php echo esc_attr($height); ?>;">
		<div class="input" id="<?php echo esc_attr($name . '_dom'); ?>">
			<?php echo VP_WP_Util::kses_html($value); ?>
		</div>
		<textarea name="<?php echo esc_attr($name); ?>" class="vp-hide"><?php echo VP_WP_Util::kses_html($value); ?></textarea>
		<div class="vp-js-bind-loader vp-field-loader vp-hide"><img src="<?php VP_Util_Res::img_out('ajax-loader.gif', ''); ?>" /></div>
	</div>
</div>