<div class="widget-wrapper type-multiselect" data-field="<?php echo esc_attr($fieldkey) ?>" <?php echo !empty( $dependency ) ? 'data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"' : ''; ?>>
    <label for="<?php echo esc_attr( $fieldid ); ?>"><?php echo esc_html( $title )  ?></label>

    <div class="multiselect-wrapper">
        <?php
            $data = array();
            foreach($options as $key => $val) {
                $data[] = array(
                    'value' => $key,
                    'text' => $val,
                );
            }

            $data = wp_json_encode($data);
        ?>
        <input type="text" id="<?php echo esc_attr( $fieldid ); ?>" class="input-sortable widefat code edit-menu-item-custom" name="<?php echo esc_attr( $fieldname ) ?>" value="<?php echo esc_html($value); ?>">
        <div class="data-option" style="display: none;">
            <?php echo esc_html($data); ?>
        </div>
    </div>

    <i><?php echo wp_kses( $desc, wp_kses_allowed_html() ) ?></i>
</div>