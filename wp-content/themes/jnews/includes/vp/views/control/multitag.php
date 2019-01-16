<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<div class='vp-multitag-wrapper'>
	<?php
        $data = array();
        $ajax_class = '';

        if ( empty( $items ) ) 
        {
            $values = explode(',', $value);
            $ajax_class = 'vp-ajax-load';

            foreach( $values as $val )
            {
                if ( ! empty( $val ) ) 
                {
                    $term = get_term( $val, 'post_tag' );
                    $data[] = array(
                        'value' => $val,
                        'text'  => $term->name
                    );
                }
            }
        } else {
            foreach( $items as $item ) 
            {
            	if ( ! empty( $item ) ) 
                {
	                $data[] = array(
	                    'value' => $item->value,
	                    'text'  => is_array($item->label) ? $item->label[0] : $item->label,
	                    'class' => is_array($item->label) ? 'indent_' . $item->label[1] : 'indent_0',
	                );
                }
            }
        }

    ?>
	<input type="text" name="<?php echo esc_attr($name); ?>" class="vp-input input-large input-sortable widefat code multitag <?php echo esc_attr( $ajax_class ); ?>" value="<?php echo esc_attr($value); ?>" />
	<div class="data-option" style="display: none;">
		<?php echo wp_json_encode($data); ?>
    </div>
</div>

<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot', $head_info); ?>