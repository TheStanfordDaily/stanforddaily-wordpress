<div class="widget-wrapper type-alert" data-field="<?php echo esc_attr($fieldkey) ?>" <?php echo !empty( $dependency ) ? 'data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"' : ''; ?>>
    <label for="<?php echo esc_attr( $fieldid ); ?>"></label>
    <div class="widget-alert alert-<?php echo esc_attr($default); ?>" id="<?php echo esc_attr( $fieldid ) ?>" name="<?php echo esc_attr( $fieldname ) ?>">
        <strong><?php echo esc_html($title); ?></strong>
        <div class="alert-description"><?php echo esc_html($desc); ?></div>
    </div>
</div>