<div class="widget-wrapper type-radioimage" data-field="<?php echo esc_attr($fieldkey) ?>" <?php echo !empty( $dependency ) ? 'data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"' : ''; ?>>
    <label for="<?php echo esc_attr( $fieldid ); ?>"><?php echo esc_html( $title )  ?></label>

    <div id="<?php echo esc_attr( $fieldid ); ?>" class="radio-image-wrapper" type="radio-image">
        <?php
            foreach($options as $key => $val) {
                $checked = ( $key == $value ) ? "checked" : "";
                
                if ( ! empty( $val ) )
                {
                    $image = "<img src='{$val}' class='radio-image'/>";
                } else {
                    $image = "<span class=\"image-clickable\"></span>";
                }
                echo
                "<label>
                    <input {$checked} type='radio' name='{$fieldname}' value='{$key}' class='radio-image-item radioimage_field'/>
                    " . $image . "
                </label>";
            }
        ?>
    </div>

    <i><?php echo wp_kses( $desc, wp_kses_allowed_html() ) ?></i>
</div>