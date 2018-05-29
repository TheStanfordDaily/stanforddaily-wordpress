<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<?php foreach ($items as $item): ?>
<label>
	<?php $checked = ($item->value == $value); ?>
	<input <?php if($checked) echo 'checked'; ?> class="vp-input<?php if($checked) echo " checked"; ?>" type="radio" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($item->value); ?>" />
	<span></span><?php echo esc_html($item->label); ?>
</label>
<?php endforeach; ?>

<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot', $head_info); ?>