<?php
include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
include_once  ABSPATH . 'wp-admin/includes/plugin.php';
$plugin_slug = basename( dirname(  __FILE__ ) );
$plugin = $plugin_slug . "/" . 'yop_poll.php';
$upgrader = new Plugin_Upgrader( new Plugin_Upgrader_Skin( array(
    'title'  => 'Yop Poll',
    'plugin' => $plugin_slug . '/yop_poll.php'
) ) );
$upgrader->init();
if( is_plugin_active( $plugin ) ) {
    deactivate_plugins( $plugin );
}
$result = $upgrader->run( array(
    'package'                     => $download_link,
    'destination'                 => WP_PLUGIN_DIR . '/' . $plugin_slug . '/',
    'clear_destination'           => false,
    'abort_if_destination_exists' => false,
    'clear_working'               => true,
    'is_multi'                    => true,
    'hook_extra'                  => array()
) );
if( ! is_wp_error( $result ) ) {
    if( ! is_plugin_active( $plugin ) ) {
        $pro_options = get_option( 'yop_poll_pro' );
        unset( $pro_options['rand_number'], $pro_options['huid'] );
        update_option( 'yop_poll_pro', $pro_options );
        activate_plugins( $plugin );
    }
}
wp_die();
