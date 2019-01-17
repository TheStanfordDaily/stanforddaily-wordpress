<?php extract($head_info); ?>

<?php if(!$is_compact): ?>
<div class="vp-field <?php echo esc_attr($type); ?><?php echo !empty($container_extra_classes) ? (' ' . $container_extra_classes) : ''; ?>"
	data-vp-type="<?php echo esc_attr($type); ?>"
	<?php echo VP_Util_Text::print_if_exists(isset($dependency) ? $dependency : '', 'data-vp-dependency="%s"'); ?>
	<?php echo vp_sanitize_output($is_hidden) ? 'style="display: none;"' : ''; ?>
	id="<?php echo esc_attr($name); ?>">
<?php endif; ?>
	<?php switch ($status) {
		case 'normal':
			$icon_class = 'fa-lightbulb-o';
			break;
		case 'info':
			$icon_class = 'fa-info';
			break;
		case 'success':
			$icon_class = 'fa-bell-o';
			break;
		case 'warning':
			$icon_class = 'fa-warning ';
			break;
		case 'error':
			$icon_class = 'fa-ban';
			break;
		default:
			$icon_class = 'fa-lightbulb-o';
			break;
	} ?>
	<i class="fa <?php echo esc_attr($icon_class); ?>"></i>
	<div class="label"><?php echo esc_html($label); ?></div>
	<?php VP_Util_Text::print_if_exists($description, '<div class="description">%s</div>'); ?>

<?php if(!$is_compact): ?>
</div>
<?php endif; ?>