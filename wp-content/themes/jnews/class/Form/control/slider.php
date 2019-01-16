<div class="widget-wrapper type-slider" data-field="<?php echo esc_attr($fieldkey) ?>" <?php echo !empty( $dependency ) ? 'data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"' : ''; ?>>
    <label for="<?php echo esc_attr( $fieldid ); ?>"><?php echo esc_html( $title )  ?></label>
    <div class="wrapper">
        <input class="jnews-number-range" type="range"
               id="<?php echo esc_attr( $fieldid ) ?>"
               name="<?php echo esc_attr( $fieldname ) ?>"
               min="<?php echo esc_attr($options['min']); ?>"
               max="<?php echo esc_attr($options['max']); ?>"
               step="<?php echo esc_attr($options['step']); ?>"
               value="<?php echo esc_attr( $value ) ?>"
               data-reset_value="<?php echo esc_attr( $default ) ?>" />
        <div class="jnews_range_value">
            <span class="value"><?php echo esc_attr( $value ) ?></span>
        </div>
        <div class="jnews-slider-reset">
          <span class="dashicons dashicons-image-rotate"></span>
        </div>
    </div>
    <i><?php echo wp_kses( $desc, wp_kses_allowed_html() ) ?></i>
</div>