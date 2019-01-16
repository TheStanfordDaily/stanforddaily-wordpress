<div class="widget-wrapper type-text" data-field="<?php echo esc_attr($fieldkey); ?>" <?php echo !empty( $dependency ) ? 'data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"' : ''; ?>>
	<label for="<?php echo esc_attr( $fieldid ); ?>"><?php echo esc_html( $title )  ?></label>
	<input class="widefat" id="<?php echo esc_attr( $fieldid ) ?>" name="<?php echo esc_attr( $fieldname ) ?>" type="text" value="<?php echo esc_attr( $value ) ?>" />
	<i><?php echo wp_kses( $desc, wp_kses_allowed_html() ); ?></i>
</div>