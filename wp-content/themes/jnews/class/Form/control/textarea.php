<div class="widget-wrapper type-textarea" data-field="<?php echo esc_attr($fieldkey) ?>" <?php echo !empty( $dependency ) ? 'data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"' : ''; ?>>
    <label for="<?php echo esc_attr( $fieldid ); ?>"><?php echo esc_html( $title )  ?></label>
	<textarea class="widefat" name="<?php echo esc_attr( $fieldname ) ?>" id="<?php echo esc_attr( $fieldid ) ?>"><?php echo jnews_sanitize_output( $value ); ?></textarea>
    <i><?php echo wp_kses( $desc, wp_kses_allowed_html() ) ?></i>
</div>