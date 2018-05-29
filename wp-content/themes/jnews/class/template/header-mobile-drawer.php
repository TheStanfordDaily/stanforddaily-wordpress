<div class="header-builder-<?php echo esc_html($row); ?> flex-row header-builder-row" data-row="<?php echo esc_html($row); ?>">
    <div class="header-builder-row-option">
        <?php echo esc_html(ucfirst($row)) . ' ' . esc_html__('Content', 'jnews'); ?>
    </div>
    <?php
    $columns = array('center');

    foreach($columns as $column) {
        $template->render('header-mobile-drawer-column', array(
            'row' => $row,
            'column' => $column,
            'template' => $template
        ), true);
    }
    ?>
</div>