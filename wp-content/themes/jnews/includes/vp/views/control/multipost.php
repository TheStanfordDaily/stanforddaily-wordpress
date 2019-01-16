<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<div class='vp-multipost-wrapper'>
	<input type="text" name="<?php echo esc_attr($name); ?>" class="vp-input input-large input-sortable widefat code multipost" value="<?php echo esc_attr($value); ?>" />
	<div class="data-option" style="display: none;">
        <?php
            $values = explode(',', $value);
            $options = array();

			foreach($values as $val)
			{
				if(!empty($val)) {
					$options[] = array(
						'value' => $val,
						'text' => get_the_title($val)
					);
				}
			}

            echo json_encode($options);
        ?>
    </div>
</div>

<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot', $head_info); ?>