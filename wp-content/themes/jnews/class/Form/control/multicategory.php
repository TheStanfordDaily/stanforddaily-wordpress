<div class="widget-wrapper type-multiselect" data-field="<?php echo esc_attr($fieldkey) ?>" <?php echo !empty( $dependency ) ? 'data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"' : ''; ?>>
    <label for="<?php echo esc_attr( $fieldid ); ?>"><?php echo esc_html( $title )  ?></label>

    <div class="multiselect-wrapper">
        <?php
        $data = array();

        $categories = get_categories(array(
            'hide_empty' => false,
            'hierarchical' => true
        ));

        $walker = new \JNews\Walker\SelectizeWalker();
        $walker->walk($categories, 3);

        foreach($walker->cache as $val)
        {
            $data[] = array(
                'value'     => $val['id'],
                'text'      => $val['title'],
                'class'     => 'indent_' . $val['depth']
            );
        }

        $data = wp_json_encode($data);
        ?>
        <input type="text" id="input-sortable" class="input-sortable widefat code edit-menu-item-custom" name="<?php echo esc_attr( $fieldname ) ?>" value="<?php echo esc_html($value); ?>">
        <div class="data-option" style="display: none;">
            <?php echo esc_html($data); ?>
        </div>
    </div>

    <i><?php echo wp_kses( $desc, wp_kses_allowed_html() ) ?></i>
</div>