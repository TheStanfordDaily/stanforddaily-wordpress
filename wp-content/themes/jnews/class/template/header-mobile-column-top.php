<?php
$setting_align = "jnews_hb_align_mobile_{$row}_{$column}";
$default_align = get_theme_mod($setting_align, $column);

$setting_element = "jnews_hb_element_mobile_{$row}_{$column}";
$default_element = get_theme_mod($setting_element);
?>
<div class="header-builder-<?php echo esc_html($column); ?> header-builder-column <?php echo esc_html($default_align); ?>" data-column="<?php echo esc_html($column); ?>">
    <div class="header-builder-drop-zone">
        <?php
        $elements = \JNews\HeaderBuilder::mobile_header_element();
        if(is_array($default_element)) {
            foreach ($default_element as $element) {
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
    </div>
</div>