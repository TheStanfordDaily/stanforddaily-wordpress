<div class="jeg_mobile_topbar jeg_container <?php echo esc_attr( get_theme_mod('jnews_header_mobile_topbar_scheme', 'normal') ); ?>">
    <div class="container">
        <div class="jeg_nav_row">
            <?php
            $setting_align = "jnews_hb_align_mobile_top_center";
            $align = get_theme_mod($setting_align, 'center');

            $setting_element = "jnews_hb_element_mobile_top_center";
            $elements = get_theme_mod($setting_element, array());
            ?>
            <div class="jeg_nav_col jeg_nav_center jeg_nav_grow">
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
        </div>
    </div>
</div>