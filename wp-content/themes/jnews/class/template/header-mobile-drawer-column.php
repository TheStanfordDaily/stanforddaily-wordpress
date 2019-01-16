<?php
$setting_element = "jnews_hb_element_mobile_drawer_{$row}_{$column}";
$default_element = get_theme_mod($setting_element);
?>
<div class="header-builder-<?php echo esc_html($column); ?> header-builder-column" data-column="<?php echo esc_html($column); ?>">
    <div class="header-builder-drop-zone">
        <?php
        $elements = \JNews\HeaderBuilder::mobile_drawer_element();
        if(is_array($default_element)) {
            foreach($default_element as $element) {
                $template->render('header-element', array(
                    'key' => $element,
                    'value' => $elements[$element]
                ), true);
            }
        }
        ?>
    </div>
</div>