<div class="header-builder">

    <div class="header-builder-top-header flex-row">
        <div class="device-mode flex-col flex-left">
            <div class="device-mode-desktop" data-mode="desktop">
                <span><?php esc_html_e('Desktop', 'jnews'); ?></span>

            </div>
            <div class="device-mode-mobile" data-mode="mobile">
                <span><?php esc_html_e('Tablet / Phone', 'jnews'); ?></span>
            </div>
        </div>
        <div class="header-builder-top-menu flex-col flex-right">
            <div class="nav-right">
                <div class="top-menu" data-section="jnews_header_builder">
                    <?php esc_html_e('Layout', 'jnews'); ?>
                </div>
                <div class="top-menu close">
                    <i class="fa fa-close"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="desktop-mode header-tab">
        <ul>
            <li class="normal" data-desktop-mode="normal" data-section="jnews_header_desktop_option">
                <i class="fa fa-cog"></i> <?php esc_html_e('Normal Header', 'jnews'); ?>
            </li>
            <li class="sticky" data-desktop-mode="sticky" data-section="jnews_header_desktop_sticky">
                <i class="fa fa-cog"></i> <?php esc_html_e('Sticky Header', 'jnews'); ?>
            </li>
        </ul>
    </div>


    <div class="mobile-mode header-tab">
        <ul>
            <li class="menu" data-mobile-mode="mobile_menu" data-section="jnews_header_mobile_option">
                <i class="fa fa-cog"></i> <?php esc_html_e('Mobile Header', 'jnews'); ?>
            </li>
            <li class="drawer" data-mobile-mode="drawer" data-section="jnews_header_drawer_container">
                <i class="fa fa-cog"></i> <?php esc_html_e('Drawer Content', 'jnews'); ?>
            </li>
        </ul>
    </div>


    <div class="header-builder-body">

        <!-- Desktop -->
        <div class="header-builder-device header-builder-desktop" data-device="desktop">
            <div class="header-builder-wrapper">
                <?php
                    $rows = get_theme_mod('jnews_hb_arrange_bar');
                    foreach($rows as $row) {
                        $template->render('header-row', array(
                            'row' => $row,
                            'template' => $template
                        ), true);
                    }
                ?>
            </div>
            <div class="header-builder-list header-builder-drop-zone">
                <?php
                    $elements = \JNews\HeaderBuilder::remain_desktop_header_element();
                    foreach($elements as $key => $value) {
                        $template->render('header-element', array(
                            'key' => $key,
                            'value' => $value
                        ), true);
                    }
                ?>
            </div>
        </div><!-- Desktop -->

        <!-- Desktop Sticky -->
        <div class="header-builder-device header-builder-desktop-sticky" data-device="desktop_sticky">
            <div class="header-builder-wrapper">
                <?php
                $template->render('header-sticky', array(
                    'template' => $template
                ), true);
                ?>
            </div>
            <div class="header-builder-list header-builder-drop-zone">
                <?php
                $elements = \JNews\HeaderBuilder::remain_sticky_header_element();
                foreach($elements as $key => $value) {
                    $template->render('header-element', array(
                        'key' => $key,
                        'value' => $value
                    ), true);
                }
                ?>
            </div>
        </div><!-- Desktop Sticky -->

        <!-- Mobile -->
        <div class="header-builder-device header-builder-mobile" data-device="mobile">
            <div class="header-builder-wrapper">
                <?php
                $rows = array('mid');
                foreach($rows as $row) {
                    $template->render('header-mobile-row', array(
                        'row' => $row,
                        'template' => $template
                    ), true);
                }
                ?>
            </div>
            <div class="header-builder-list header-builder-drop-zone">
                <?php
                $elements = \JNews\HeaderBuilder::remain_mobile_header_element();
                foreach($elements as $key => $value) {
                    $template->render('header-element', array(
                        'key' => $key,
                        'value' => $value
                    ), true);
                }
                ?>
            </div>
        </div><!-- Mobile -->

        <!-- Mobile Drawer -->
        <div class="header-builder-device header-builder-mobile-drawer" data-device="mobile_drawer">
            <div class="header-builder-wrapper">
                <?php
                $rows = array('top', 'bottom');
                foreach($rows as $row) {
                    $template->render('header-mobile-drawer', array(
                        'row' => $row,
                        'template' => $template
                    ), true);
                }
                ?>
            </div>
            <div class="header-builder-list header-builder-drop-zone">
                <?php
                $elements = \JNews\HeaderBuilder::remain_mobile_drawer_element();
                foreach($elements as $key => $value) {
                    $template->render('header-element', array(
                        'key' => $key,
                        'value' => $value
                    ), true);
                }
                ?>
            </div>
        </div><!-- Drawer -->

    </div>

    <div class="header-builder-warning">
        <div class="header-builder-warning-wrapper">
            <div class="close-warning">
                <i class="fa fa-close"></i>
            </div>
            <div class="warning-header">
                <?php esc_html_e('Notice', 'jnews'); ?>
            </div>
            <div class="warning-text"></div>
        </div>
    </div>


</div>