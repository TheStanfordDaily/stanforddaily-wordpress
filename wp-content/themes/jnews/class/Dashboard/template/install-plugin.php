<div class="jnews-wrap jnews-install-plugin">

    <div class="jnews-install-plugin-wrap">
        <div class="jnews-install-plugin-notice" style="border: 1px solid #e6d381; background-color: #fff1b6; color: #8f7d31;">
            <h3 style="text-align: center; margin-bottom: 15px; color: #6b5f38;"><?php esc_html_e('Please only install plugin that you need to make your website lighter and faster', 'jnews'); ?></h3>
        </div>
    </div>

    <div class="jnews-install-plugin-wrap" id="accordion">
    <?php foreach($groups as $key => $group) { ?>
        <h3>
            <span class="flag <?php echo esc_html($group['type']); ?>"><?php echo esc_html($group['type']); ?></span>
            <?php echo esc_html($group['title']); ?>
            <span class="flag update"><?php esc_html_e('New Update Available', 'jnews'); ?></span>
            <span class="jeg_accordion_button"></span>
        </h3>
        <div class="jnews-install-plugin-body">

            <?php if(isset($group['notice'])) { ?>
                <div class="jnews-install-plugin-notice">
                    <strong><?php esc_html_e('Info', 'jnews'); ?></strong>
                    <?php echo jnews_sanitize_output($group['notice']); ?>
                </div>
            <?php } ?>

            <?php
            foreach($group['items'] as $plugin) {
                $instance->get_template()->render('install-plugin-item', array( 'plugin' => $plugin, 'instance' => $instance ), true);
            }
            ?>
        </div>
    <?php } ?>
    </div>
    <input type="hidden" name="jnews-ajax-plugin-error-notice" value="<?php echo sprintf( esc_html__( 'Something went wrong with the plugin API. Please try to install &amp; activate the plugin via TGM Plugin Activation <a href="%s" target="_blank">here</a> or contact our support team <a href="%s" target="_blank">here</a>.', 'jnews' ), "themes.php?page=jnews-install-plugins", "http://support.jegtheme.com/"); ?>">

    <div class="jnews-install-plugin-wrap jnews-supported-plugin-wrap">
        <h3><?php esc_html_e( 'Supported Plugin', 'jnews' ); ?></h3>
        <p>
            <?php esc_html_e('Other than plugin listed above, we also provide compatibility with below plugin. If you have any suggestion what plugin we need to support, please contact us from Forum and let us know.', 'jnews'); ?>
        </p>

        <ul class="jnews-supported-plugin">
            <li class="jnews-supported-plugin-item">
                <span class="name"><?php esc_html_e( 'Breadcrumb NavXT', 'jnews' ); ?></span>
                <span class="description"><?php esc_html_e( 'Alternative for JNews Breadcrumb', 'jnews' ); ?></span>
            </li>
            <li class="jnews-supported-plugin-item">
                <span class="name"><?php esc_html_e( 'Yoast SEO', 'jnews' ); ?></span>
                <span class="description"><?php esc_html_e( 'SEO Plugin', 'jnews' ); ?></span>
            </li>
            <li class="jnews-supported-plugin-item">
                <span class="name"><?php esc_html_e( 'Instant Articles for WP', 'jnews' ); ?></span>
                <span class="description"><?php esc_html_e( 'Adds support for Instant Articles for Facebook', 'jnews' ); ?></span>
            </li>
            <li class="jnews-supported-plugin-item">
                <span class="name"><?php esc_html_e( 'WooCommerce', 'jnews' ); ?></span>
                <span class="description"><?php esc_html_e( 'An e-commerce toolkit that helps you sell anything', 'jnews' ); ?></span>
            </li>
            <li class="jnews-supported-plugin-item">
                <span class="name"><?php esc_html_e( 'BBPress', 'jnews' ); ?></span>
                <span class="description"><?php esc_html_e( 'bbPress is forum software with a twist from the creators of WordPress', 'jnews' ); ?></span>
            </li>
            <li class="jnews-supported-plugin-item">
                <span class="name"><?php esc_html_e( 'Loco Translate', 'jnews' ); ?></span>
                <span class="description"><?php esc_html_e( 'Translate themes and plugins directly in WordPress', 'jnews' ); ?></span>
            </li>
            <li class="jnews-supported-plugin-item">
                <span class="name"><?php esc_html_e( 'Polylang', 'jnews' ); ?></span>
                <span class="description"><?php esc_html_e( 'Adds multilingual capability to WordPress', 'jnews' ); ?></span>
            </li>
            <li class="jnews-supported-plugin-item">
                <span class="name"><?php esc_html_e( 'Jetpack', 'jnews' ); ?></span>
                <span class="description"><?php esc_html_e( 'Bring the power of the WordPress.com cloud to your self-hosted WordPress', 'jnews' ); ?></span>
            </li>
            <li class="jnews-supported-plugin-item">
                <span class="name"><?php esc_html_e( 'MailChimp for WordPress', 'jnews' ); ?></span>
                <span class="description"><?php esc_html_e( 'MailChimp for WordPress', 'jnews' ); ?></span>
            </li>
            <li class="jnews-supported-plugin-item">
                <span class="name"><?php esc_html_e( 'Input / Contact Form', 'jnews' ); ?></span>
                <span class="description"><?php esc_html_e( 'Just another contact form plugin. Simple but flexible', 'jnews' ); ?></span>
            </li>
            <li class="jnews-supported-plugin-item">
                <span class="name"><?php esc_html_e( 'Regenerate Thumbnails', 'jnews' ); ?></span>
                <span class="description"><?php esc_html_e( 'Allows you to regenerate your thumbnails after changing the thumbnail sizes', 'jnews' ); ?></span>
            </li>
        </ul>
    </div>
</div>