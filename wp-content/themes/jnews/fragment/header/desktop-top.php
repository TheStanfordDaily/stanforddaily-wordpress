<div class="jeg_topbar jeg_container <?php echo esc_attr( get_theme_mod('jnews_header_topbar_scheme', 'dark') ); ?>">
    <div class="container">
        <div class="jeg_nav_row">
            <?php
                $columns = array('left', 'center', 'right');

                foreach($columns as $column)
                {
                    $setting_align = "jnews_hb_align_desktop_top_{$column}";
                    $align = get_theme_mod($setting_align, $column);

                    $setting_display = "jnews_hb_display_desktop_top_{$column}";
                    $display = get_theme_mod($setting_display, jnews_header_default("desktop_display_top_{$column}"));

                    $setting_element = "jnews_hb_element_desktop_top_{$column}";
                    $elements = get_theme_mod($setting_element, jnews_header_default("desktop_element_top_{$column}"));
                ?>

                <div class="jeg_nav_col jeg_nav_<?php echo esc_attr($column); ?>  jeg_nav_<?php echo esc_attr($display); ?>">
                    <div class="item_wrap jeg_nav_align<?php echo esc_attr($align); ?>">
                        <?php
                            if(!empty($elements) && is_array($elements))
                            {
                                foreach($elements as $element)
                                {
                                    get_template_part('fragment/header/element/desktop/' . $element);
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
</div><!-- /.jeg_container -->