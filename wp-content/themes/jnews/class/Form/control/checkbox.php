<div class="widget-wrapper type-checkbox" data-field="<?php echo esc_attr($fieldkey) ?>" <?php echo !empty( $dependency ) ? 'data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"' : ''; ?>>
    <input type="checkbox" class="checkbox" name="<?php echo esc_attr( $fieldname ) ?>" id="<?php echo esc_attr( $fieldid ) ?>" value="1" <?php checked( (bool) $value ); ?> />
    <label for="<?php echo esc_attr( $fieldid ); ?>"><?php echo esc_html( $title )  ?></label>
    <br />
    <i><?php echo wp_kses( $desc, wp_kses_allowed_html() ) ?></i>
</div>