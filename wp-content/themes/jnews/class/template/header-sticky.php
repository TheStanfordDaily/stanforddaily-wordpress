<div class="header-builder-sticky flex-row header-builder-row" data-row="mid">
    <div class="header-builder-row-option" data-section="jnews_header_desktop_sticky">
        <i class="fa fa-cog"></i> <?php echo esc_html__('Sticky Bar', 'jnews'); ?>
    </div>
    <?php
    $columns = array('left', 'center', 'right');
    foreach($columns as $column) {
        $template->render('header-sticky-column', array(
            'column' => $column,
            'template' => $template
        ), true);
    }
    ?>
</div>