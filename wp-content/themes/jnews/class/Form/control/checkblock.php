<div class="widget-wrapper type-checkblock" data-field="<?php echo esc_attr($fieldkey) ?>" <?php echo !empty( $dependency ) ? 'data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"' : ''; ?>>
    <label for="<?php echo esc_attr( $fieldid ); ?>"><?php echo esc_html( $title )  ?></label>

    <div class="checkblock-wrapper">
        <?php
        if(!is_array($value)) $value = array($value);
        foreach($options as $key => $val)
        {
            $checked = in_array($key , $value) ? "checked=checked" : "";
            ?>
            <label>
                <input class="widefat code edit-menu-item-custom" name="<?php echo esc_attr( $fieldname ) ?>[]" value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($checked); ?> type="checkbox">
                <?php echo esc_attr($val); ?>
            </label>
            <?php
        }
        ?>
    </div>

    <i><?php echo wp_kses( $desc, wp_kses_allowed_html() ) ?></i>
</div>