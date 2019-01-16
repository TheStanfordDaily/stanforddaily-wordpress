<div class="jeg_mobile_bottombar jeg_mobile_midbar jeg_container <?php echo esc_attr( get_theme_mod('jnews_header_mobile_midbar_scheme', 'dark') ); ?>">
    <div class="container">
        <div class="jeg_nav_row">
            <?php
            $columns = array('left', 'center', 'right');

            foreach($columns as $column)
            {
                $setting_align = "jnews_hb_align_mobile_mid_{$column}";
                $align = get_theme_mod($setting_align, $column);

                $setting_display = "jnews_hb_display_mobile_mid_{$column}";
                $display = get_theme_mod($setting_display, jnews_header_default("mobile_display_mid_{$column}"));

                $setting_element = "jnews_hb_element_mobile_mid_{$column}";
                $elements = get_theme_mod($setting_element, jnews_header_default("mobile_element_mid_{$column}"));
                ?>

                <div class="jeg_nav_col jeg_nav_<?php echo esc_attr($column); ?> jeg_nav_<?php echo esc_attr($display); ?>">
                    <div class="item_wrap jeg_nav_align<?php echo esc_attr($align); ?>">
                        <?php
                        if(!empty($elements))
                        {
                            foreach($elements as $element)
                            {
                                get_template_part('fragment/header/element/mobile/' . $element);
                            }
                        }
                        ?>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
    </div>
</div>