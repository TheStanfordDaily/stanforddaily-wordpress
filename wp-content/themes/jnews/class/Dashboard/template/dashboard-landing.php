<?php
$menu = apply_filters('jnews_get_admin_slug', '');
$theme = wp_get_theme();
?>
<div class="jnews-wrap wrap about-wrap">
    <h1>
        <?php esc_html_e('Welcome to', 'jnews') ?> <strong><?php echo esc_html($theme->get('Name')); ?></strong>
        <span class="jnews-version"><?php esc_html_e('Version', 'jnews'); ?> <?php echo esc_html($theme->get('Version')); ?></span>
    </h1>

    <?php
        $is_license_validated = apply_filters('jnews_check_is_license_validated', array());
        if( ! $is_license_validated ) :
    ?>
        <div class="about-text">
            <?php
                esc_html_e('Please register your purchase to receive theme updates, import JNews demos, and unlock all features. Read below for additional information.', 'jnews');
            ?>
        </div>

        <div class="jnews-registration-wrap jnews-panel">
            <form method="POST" action="<?php menu_page_url($menu['dashboard']); ?>">
                <?php wp_nonce_field($menu['dashboard']); ?>

                <input type="hidden" name="jnews-validate-license" value="validate-license">

                <label for="envato_token"><?php esc_html_e('Product License Registration', 'jnews'); ?></label>
                <div class="input-token">
                    <input name="envato_token" class="large-text" autocomplete="off" type="text" placeholder="<?php esc_html_e('Enter your Envato Token', 'jnews'); ?>">
                    <?php submit_button( _('Submit') ); ?>
                </div>

                <p class="description">
                <?php
                    printf(
                        __('Please enter your Envato API Personal Token to complete registration. You could <a target="_blank" href="%s">Generate your token here</a>', 'jnews'),
                        "https://build.envato.com/create-token/?purchase:download=t&purchase:list=t&sale:verify=t"
                    );
                ?>
                </p>
            </form>
        </div>

        <div class="jnews-howto">
            <h3><?php esc_html_e('Instructions for Generating Envato Token', 'jnews') ?></h3>
            <ol>
                <li>
                    <?php
                    printf(
                        wp_kses(
                            __('Click on <a href="%s" title="Generate token">Generate Token</a>. You must be logged into the same Themeforest account that purchased JNews. If you are logged in already, look in the top menu bar to ensure it is the right account. If you are not logged in, you will be directed to login then directed back to the Create A Token Page.','jnews')
                            , wp_kses_allowed_html()
                        ),
                        'https://build.envato.com/create-token/?purchase:download=t&purchase:list=t'
                    );
                    ?>
                </li>
                <li><?php esc_html_e('Enter a name for your token, then check the boxes for View Your Envato Account Username, Download Your Purchased Items, Verify Purchases You\'ve Made and List Purchases You\'ve Made from the permissions needed section. Check the box to agree to the terms and conditions, then click the Create Token button', 'jnews') ?></li>
                <li><?php esc_html_e('A new page will load with a token number in a box. Copy the token number then come back to this registration page and paste it into the field below and click the Submit button.','jnews'); ?></li>
                <li><?php esc_html_e('You will see a green check mark for success, or a failure message if something went wrong. If it failed, please make sure you followed the steps above correctly. You can also view our documentation post for various fallback methods.','jnews'); ?></li>
            </ol>
        </div>

    <?php else: ?>
        <div class="about-text">
            <?php echo wp_kses(__('Congratulations! JNews is <strong>activated</strong> and ready to use. Get ready to create awesome news, magazine, or blog site using this theme. Read below for additional information. We hope you enjoy it!', 'jnews'),wp_kses_allowed_html()) ?>
        </div>

        <div class="jnews-dashboard-box jnews-panel">
            <div class="jnews-dashboard-video" style="margin-right: 20px; width: 700px;">
                <img src="<?php echo esc_url(JNEWS_THEME_URL . '/assets/css/thankyou.jpg'); ?>"/>
            </div>
            <div class="jnews-welcome">
                <h3><?php esc_html_e('Thank you for choosing JNews', 'jnews'); ?></h3>
                <p><?php
                    printf(
                        wp_kses(
                            __('We would like to thank you for purchasing JNews! Before you get started, please be sure to always check out <a href="%s">Documentation</a>','jnews'),
                            wp_kses_allowed_html()),
                        'http://support.jegtheme.com/theme/jnews/'
                    );
                    ?>
                </p>
                <p><?php echo wp_kses(__('We provide video guidance on every page to help you understand how to use this theme. You can see it by clicking icon <span class="fa-lightbulb-o fa"></span> at bottom right.','jnews'), wp_kses_allowed_html()); ?></p>
                <p><?php esc_html_e('We outline all kinds of good information, and provide you with all the details you need to use JNews.', 'jnews') ?></p>
            </div>
        </div>

        <div class="jnews-feature-list jnews-panel">
            <div class="three-col">
                <div class="col">
                    <h3 class="jnews-item-title"><i class="fa fa-plug"></i> <?php esc_html_e('Supported Plugin', 'jnews'); ?></h3>
                    <p><?php esc_html_e('We provide list of all plugins that supported JNews. However, you are not limited to only install plugin from this list. To speed up your website performance please choose only necessary plugin.', 'jnews'); ?></p>
                    <div class="jnews-item-button">
                        <a class="button button-primary" href="<?php echo esc_url(menu_page_url($menu['plugin'], false)); ?>"><?php esc_html_e('Install Plugins', 'jnews'); ?></a>
                    </div>
                </div>

                <div class="col">
                    <h3 class="jnews-item-title"><i class="fa fa-cubes"></i> <?php esc_html_e('Install Demo', 'jnews'); ?></h3>
                    <p><?php esc_html_e('Installing demo and style as easy as one click. Our import system will also backup widget & customizer setting. Also, will restore both widget and customizer setting during uninstallation.', 'jnews'); ?></p>
                    <div class="jnews-item-button">
                        <a class="button button-primary" href="<?php echo esc_url(menu_page_url($menu['import'], false)); ?>"><?php esc_html_e('Install Demo', 'jnews'); ?></a>
                    </div>
                </div>

                <div class="col">
                    <h3 class="jnews-item-title"><i class="fa fa-life-buoy"></i> <?php esc_html_e('Any Questions?', 'jnews'); ?></h3>
                    <p><?php esc_html_e('Our online documentation is an incredible resource for learning how to use JNews. But if you still have any question, please don\'t hesitate to ask through our dedicated support forum.', 'jnews'); ?></p>
                    <div class="jnews-item-button">
                        <a class=" button button-primary" href="http://support.jegtheme.com/forums/forum/jnews/"><?php esc_html_e('Documentation & Support', 'jnews'); ?></a>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
</div>