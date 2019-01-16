<?php
    $setting_align = "jnews_hb_align_desktop_{$row}_{$column}";
    $default_align = get_theme_mod($setting_align);

    $setting_display = "jnews_hb_display_desktop_{$row}_{$column}";
    $default_display = get_theme_mod($setting_display);

    $setting_element = "jnews_hb_element_desktop_{$row}_{$column}";
    $default_element = get_theme_mod($setting_element);
?>
<div class="header-builder-<?php echo esc_html($column); ?> header-builder-column <?php echo esc_html($default_align); ?> <?php echo esc_html($default_display); ?>" data-column="<?php echo esc_html($column); ?>">
    <div class="header-builder-drop-zone">
        <?php
            $elements = \JNews\HeaderBuilder::desktop_header_element();
            if(is_array($default_element)) {
                foreach($default_element as $element) {
                    $template->render('header-element', array(
                        'key' => $element,
                        'value' => $elements[$element]
                    ), true);
                }
            }
        ?>
        <div class="header-setting"><i class="fa"></i></div>
    </div>
    <div class="header-column-option-tooltip">
        <div class="header-column-option-align">
            <h3><?php esc_html_e('Align', 'jnews'); ?></h3>
            <ul>
                <li class="left <?php echo esc_attr($default_align) === 'left' ? 'active' : ''; ?>" data-align="left"><?php esc_html_e('Left', 'jnews'); ?></li>
                <li class="center <?php echo esc_attr($default_align) === 'center' ? 'active' : ''; ?>" data-align="center"><?php esc_html_e('Center', 'jnews'); ?></li>
                <li class="right <?php echo esc_attr($default_align) === 'right' ? 'active' : ''; ?>" data-align="right"><?php esc_html_e('Right', 'jnews'); ?></li>
            </ul>
        </div>
        <div class="header-column-option-display">
            <h3><?php esc_html_e('Display', 'jnews'); ?></h3>
            <ul>
                <li class="left <?php echo esc_attr($default_display) === 'grow' ? 'active' : ''; ?>" data-display="grow"><?php esc_html_e('Grow', 'jnews'); ?></li>
                <li class="center <?php echo esc_attr($default_display) === 'normal' ? 'active' : ''; ?>" data-display="normal"><?php esc_html_e('Normal', 'jnews'); ?></li>
            </ul>
        </div>
    </div>
</div>