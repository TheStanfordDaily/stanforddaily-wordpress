<div class="widget-wrapper type-multiselect" data-field="<?php echo esc_attr($fieldkey) ?>" <?php echo !empty( $dependency ) ? 'data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"' : ''; ?>>
    <label for="<?php echo esc_attr( $fieldid ); ?>"><?php echo esc_html( $title )  ?></label>

    <div class="multipost-wrapper">
        <input type="text" id="input-sortable" class="input-sortable widefat code edit-menu-item-custom" name="<?php echo esc_attr( $fieldname ) ?>" value="<?php echo esc_html($value); ?>">
        <div class="data-option" style="display: none;">
            <?php
                $values = explode(',', $value);
                $options = array();

                foreach($values as $val)
                {
                    if(!empty($val)) {
                        $options[] = array(
                            'value' => $val,
                            'text' => get_the_title($val) . " [ ID : $val ]"
                        );
                    }
                }

                echo wp_json_encode($options);
            ?>
        </div>
    </div>

    <i><?php echo wp_kses( $desc, wp_kses_allowed_html() ) ?></i>
</div>