<div class="header-builder-<?php echo esc_html($row); ?> flex-row header-builder-row" data-row="<?php echo esc_html($row); ?>">
    <div class="header-builder-row-option" data-control="jnews_header_mobile_option_section[jnews_header_mobile_<?php echo esc_html($row) ?>bar_setting]">
        <i class="fa fa-cog"></i> <?php echo esc_html(ucfirst($row)) . ' ' . esc_html__('Bar', 'jnews'); ?>
    </div>
    <?php
    if($row === 'top') {
        $columns = array('center');
    } else {
        $columns = array('left', 'center', 'right');
    }

    foreach($columns as $column) {
        $template->render('header-mobile-column-' . $row, array(
            'row' => $row,
            'column' => $column,
            'template' => $template
        ), true);
    }
    ?>
</div>