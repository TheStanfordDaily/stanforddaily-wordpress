<div class="jnews-container jnews-import-demo">

    <div class="jnews-install-plugin-wrap">
        <div class="jnews-install-plugin-header">
            <h3><?php esc_html_e('Import Demo & Style', 'jnews'); ?></h3>
        </div>
    </div>

    <div class="install-plugin-notice hide-notice">
        <div class="jnews-modal-message message-info">
            <h3><?php esc_html_e('Important Notice', 'jnews'); ?></h3>
            <ul>
                <li>
                    <strong><?php esc_html_e('Before Import', 'jnews'); ?></strong> 
                    <?php esc_html_e('Although we already perform automatic backup before importing content, we recommend you to create your own backup before importing content.','jnews'); ?>
                </li>
                <li>
                    <strong><?php esc_html_e('System Status', 'jnews'); ?></strong> 
                    <?php echo wp_kses( sprintf( __('We highly recommend you to check your <b>System Status</b> on <a href="%s">this</a> page before importing content in order to make importing process runs as expected.', 'jnews'), esc_url( menu_page_url( 'jnews_system', false ) ) ), wp_kses_allowed_html() ); ?>
                </li>
                <li>
                    <strong><?php esc_html_e('Automatic Backup', 'jnews'); ?></strong> 
                    <?php esc_html_e('Before doing import, we will back up your widget setting, menu location, and customizer setting. We will not back up your menu, post, page, taxonomy (category / tag) or image. When you uninstall your setup, we will revert backup previously saved content and remove installed content.','jnews'); ?>
                </li>
                <li>
                    <strong><?php esc_html_e('Import - Style & Content', 'jnews'); ?></strong> 
                    <?php esc_html_e('When you import both style & content we will import demo content into your server. Content includes image, taxonomy, post & page (including landing page example), menu, widget, and customizer setting. We will also install required plugin to replicate the demo.','jnews'); ?>
                </li>
                <li>
                    <strong><?php esc_html_e('Import - Only Style ', 'jnews'); ?></strong>
                    <?php esc_html_e('When you import style only, we will only import customizer setting with no content. Just customizer setting that will be affected by this kind of import.','jnews'); ?>
                </li>
                <li>
                    <strong><?php esc_html_e('Import - Visual Composer Content ', 'jnews'); ?></strong>
		            <?php esc_html_e('When you choose import Visual Composer Content, we will only import all dummy pages that created with WPBakery Page Builder (Visual Composer) plugin.','jnews'); ?>
                </li>
                <li>
                    <strong><?php esc_html_e('Import - Elementor Content ', 'jnews'); ?></strong>
		            <?php esc_html_e('When you choose import Elementor Content, we will only import all dummy pages that created with Elementor plugin.','jnews'); ?>
                </li>
            </ul>
        </div>
    </div>

    <div class="uninstall-plugin-notice hide-notice">
        <div class="jnews-modal-message message-warning">
            <h3><?php esc_html_e('Uninstall Warning', 'jnews'); ?></h3>
            <p><?php esc_html_e('This will remove dummy content and also all widgets you add on this demo. We highly recommend you to create backup before continue.','jnews'); ?></p>
        </div>
    </div>

    <div class="finish-install-plugin-notice hide-notice">
        <div class="jnews-modal-message message-success">
            <h3><?php esc_html_e('Congratulations!', 'jnews'); ?></h3>
            <p><?php esc_html_e('Install process success.','jnews'); ?></p>
        </div>
    </div>

    <div class="finish-uninstall-plugin-notice hide-notice">
        <div class="jnews-modal-message message-success">
            <h3><?php esc_html_e('Congratulations!', 'jnews'); ?></h3>
            <p><?php esc_html_e('Uninstall process success.','jnews'); ?></p>
        </div>
    </div>

    <div class="jnews-required-plugin-list">

        <?php
            $demos   = array_chunk($content, 3);
            $license = JNews\Util\ValidateLicense::getInstance();
            $license = $license->is_license_validated();

            foreach($demos as $demo)
            {
                echo "<div class='jnews-row'>";

                foreach($demo as $value)
                {
                    $install_class = ( $value['id'] === $installed_style ) ? 'imported' : '' ;
                    $install_class .= $license ? ' activated' : ' unactivated';
                    ?>
                    <div class="jnews-item <?php echo esc_attr($install_class); ?>" data-id="<?php echo esc_attr($value['id']); ?>">
                        <input type="hidden" value="<?php echo wp_create_nonce('jnews_import'); ?>" class="nonce"/>
                        <div class="jnews-plugin-image">
                            <div class="thumbnail-container" style="padding-bottom: 71.4%;">
                                <img src="<?php echo esc_url($value['image']) ?>">
                            </div>
                            <div class="jnews-item-installed">
                                <span><?php esc_html_e('Imported', 'jnews'); ?></span>
                            </div>
                            <div class="jnews-item-installing">
                                <span><i class="fa fa-warning"></i> <?php esc_html_e('Don’t refresh page while processing', 'jnews') ?></span>
                            </div>

                            <?php if ( $value['category'] != 'coming-soon' ) : ?>
                                <div class="jnews-demo-hover">
                                    <div class="demo-option">
                                        <div class="jnews-item-button-checkbox">
                                            <label>
                                                <input class="input include-content" name="install-plugin" checked="checked" type="checkbox">
                                                <span></span>
                                                <em> <?php esc_html_e('Install Plugins', 'jnews'); ?></em>
                                            </label>
                                        </div>
                                        <div class="jnews-item-button-checkbox">
                                            <label>
                                                <input class="input include-content" name="include-content" checked="checked" type="checkbox">
                                                <span></span>
                                                <em class="only-style"> <?php esc_html_e('Only Style', 'jnews'); ?></em>
                                                <em class="import-content"> <?php esc_html_e('Style & Content', 'jnews'); ?></em>
                                            </label>
                                        </div>
                                        <div class="jnews-item-button-checkbox">
                                            <label>
                                                <input class="input include-content" name="builder-content" checked="checked" type="checkbox">
                                                <span></span>
                                                <em class="vc-content"> <?php esc_html_e('Visual Composer Content', 'jnews'); ?></em>
                                                <em class="elementor-content"> <?php esc_html_e('Elementor Content', 'jnews'); ?></em>
                                            </label>
                                        </div>
                                    </div>
                                    <a class="jnews-demo-link" href="<?php echo esc_url($value['demo']); ?>" target="_blank">
                                        <i class="fa fa-external-link"></i> <strong><?php esc_html_e('Live Demo', 'jnews'); ?></strong>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="jnews-item-control">
                            <?php if ( $value['category'] === 'coming-soon' ) : ?>
                                <div class="jnews-item-description">
                                    <h3 class="jnews-item-title"> <?php echo esc_html($value['name']) ?> </h3>
                                </div>
                            <?php else: ?>
                                <div class="jnews-item-description">
                                    <span class="<?php echo esc_attr($value['category-slug']); ?>-demo"><?php echo esc_html($value['category']) ?></span>
                                    <h3 class="jnews-item-title"> <?php echo esc_html($value['name']) ?> </h3>
                                </div>

                                <?php if ( $license || ( $value['id'] == 'default' ) ): ?>
                                    <div class="jnews-item-button before-import">
                                        <div class="jnews-item-button-second">
                                            <a class="jnews-demo-link" href="<?php echo esc_url($value['demo']); ?>" target="_blank">
                                                <i class="fa fa-external-link"></i> <strong><?php esc_html_e('Live Demo', 'jnews'); ?></strong>
                                            </a>
                                        </div>
                                        <div class="jnews-item-button-first">
                                            <a class="import-style button button-import" href="#">
                                                <?php esc_html_e('Import Demo', 'jnews'); ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="jnews-item-button before-import license-notice">
                                        <?php
                                            printf(
                                                wp_kses(
                                                    __('Please <strong><a href="%s">activate</a></strong> theme license to unlock all import.', 'jnews'),
                                                    wp_kses_allowed_html()
                                                ),
                                                esc_url( menu_page_url( 'jnews', false ) )
                                            );
                                        ?>
                                    </div>
                                <?php endif; ?>

                                <div class="jnews-item-button after-import">
                                    <a class="import-demo button-uninstall" href="#"><?php esc_html_e('Uninstall', 'jnews'); ?></a>
                                </div>

                                <div class="jnews-item-button while-import">
                                    <div class="jeg-progress-bar">
                                        <div class="progress-line"><span class="progress"></span></div>
                                    </div>
                                    <div class="import-demo progress-text" data-text="<?php esc_attr_e('Preparing', 'jnews'); ?>" data-finish="<?php esc_attr_e('Finished', 'jnews'); ?>">
                                        <i class="fa fa-refresh fa-spin"></i>
                                        <span>
                                            <?php esc_html_e('Preparing', 'jnews'); ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="overlay"></div>
                    </div>

                    <?php
                }

                echo "</div>";
            }

        ?>

    </div>

</div>