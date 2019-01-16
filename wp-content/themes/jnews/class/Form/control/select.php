<div class="widget-wrapper type-select <?php !empty( $dependency ) ? esc_attr( 'jeg-dep-hide' ) : ''; ?>" data-field="<?php echo esc_attr($fieldkey) ?>" <?php echo !empty( $dependency ) ? 'data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"' : ''; ?>>
    <label for="<?php echo esc_attr( $fieldid ); ?>"><?php echo esc_html( $title )  ?></label>
    <select class="widefat" id="<?php echo esc_attr( $fieldid ) ?>" name="<?php echo esc_attr( $fieldname ) ?>" type="select">
        <?php
            foreach($options as $key => $option) {
                $select = ( $value == $key ) ? "selected" : "";
                echo "<option value='$key' $select>$option</option>";
            }
        ?>
    </select>
    <i><?php echo wp_kses( $desc, wp_kses_allowed_html() ) ?></i>
</div>