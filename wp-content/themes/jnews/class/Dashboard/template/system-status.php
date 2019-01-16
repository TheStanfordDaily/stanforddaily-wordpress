<div class="jnews-wrap wrap">
    
    <table class="jnews_admin_table widefat" cellspacing="0" id="status">
        <thead>
        <tr>
            <th><?php echo wp_kses(__( 'System Report <em> - Please copy and paste this information when asking for support</em>', 'jnews' ), wp_kses_allowed_html()); ?></th>
        </tr>
        </thead>
        <tbody>
        <td>
            <div class="debug-report">
                <textarea readonly="readonly">
### <?php esc_html_e('THEME INFO', 'jnews'); ?> ###

<?php do_action('jnews_system_status_theme_info', false); ?>


### <?php esc_html_e('WordPress Enviroment', 'jnews'); ?> ###

<?php do_action('jnews_system_status_wordpress_enviroment', false); ?>


### <?php esc_html_e('Server Enviroment', 'jnews'); ?> ###

<?php do_action('jnews_system_status_server_enviroment', false); ?>


### <?php esc_html_e('Active Plugins', 'jnews'); ?> ###

<?php do_action('jnews_system_status_plugin', false); ?>

### <?php esc_html_e('End', 'jnews'); ?> ###
                </textarea>
                <div class='jnews-action-notice success'>
                    <span><?php esc_html_e('System Report Copied', 'jnews'); ?></span>
                    <i class='fa fa-times'></i>
                </div>
            </div>
        </td>
        </tbody>
    </table>

    <table class="jnews_admin_table widefat" cellspacing="0" id="status">
        <thead>
        <tr>
            <th colspan="3"><?php esc_html_e( 'Themes Info', 'jnews' ); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php do_action('jnews_system_status_theme_info', true); ?>
        </tbody>
    </table>

    <table class="jnews_admin_table widefat" cellspacing="0" id="status">
        <thead>
        <tr>
            <th colspan="3"><?php esc_html_e( 'WordPress Enviroment', 'jnews' ); ?></th>
        </tr>
        </thead>
        <tbody>
            <?php do_action('jnews_system_status_wordpress_enviroment', true); ?>
        </tbody>
    </table>

    <table class="jnews_admin_table widefat" cellspacing="0" id="status">
        <thead>
        <tr>
            <th colspan="3"><?php esc_html_e( 'Server Enviroment', 'jnews' ); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php do_action('jnews_system_status_server_enviroment', true); ?>
        </tbody>
    </table>

    <table class="jnews_admin_table widefat" cellspacing="0" id="status">
        <thead>
        <tr>
            <th colspan="3"><?php esc_html_e( 'Active Plugins', 'jnews' ); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php do_action('jnews_system_status_plugin', true); ?>
        </tbody>
    </table>
</div>

