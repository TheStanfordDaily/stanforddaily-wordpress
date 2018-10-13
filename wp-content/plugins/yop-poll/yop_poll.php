<?php
/*
Plugin Name: YOP Poll
Plugin URI:  https://yop-poll.com
Description: Use a full option polling functionality to get the answers you need. YOP Poll is the perfect, easy to use poll plugin for your WordPress website.
Version:     6.0.1
Author:      yourownprogrammer
Author URI:  https://yop-poll.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: yop-poll
*/
define ( 'YOP_POLL_VERSION', '6.0.1' );
define ( 'YOP_POLL_URL', plugin_dir_url( __FILE__ ) );
define ( 'YOP_POLL_PATH', plugin_dir_path( __FILE__ ) );
require_once( 'admin/inc/dbschema.php' );
require_once( 'admin/inc/maintenance.php' );
require_once( 'admin/inc/capabilities.php' );
require_once( 'admin/inc/Helper.php' );
require_once( 'admin/inc/ClassYOPPollWidget.php' );
require_once( 'admin/inc/ClassYopPollImporter5x.php' );
require_once( 'admin/inc/ClassYopPollImporter4x.php' );
require_once( 'admin/inc/YopPollUpgrade.php' );
$maintenance_obj = new YOP_Poll_Maintenance();
register_activation_hook( __FILE__, array(
    $maintenance_obj,
    'activate'
));
register_deactivation_hook( __FILE__, array(
    $maintenance_obj,
    'deactivate'
) );
function yop_poll_widget() {
	register_widget( 'YOP_Poll_Widget' );
}
if ( true === is_admin() ) {
    require_once( 'admin/admin.php' );
    require_once( 'admin/inc/view.php' );
    require_once( 'public/inc/basic.php' );
    require_once( 'admin/models/bans.php' );
    require_once( 'admin/models/logs.php' );
    require_once( 'admin/models/votes.php' );
    require_once( 'admin/models/polls.php' );
	require_once( 'admin/models/settings.php' );
    require_once( 'admin/models/elements.php' );
    require_once( 'admin/models/templates.php' );
    require_once( 'public/inc/Captcha.php' );
    require_once( 'public/inc/Session.php' );
    require_once( 'admin/models/subelements.php' );
    $yop_poll_admin = new YOP_Poll_Admin;
} else {
    require_once( 'public/public.php' );
    require_once( 'public/inc/basic.php' );
	require_once( 'admin/models/votes.php' );
    require_once( 'admin/models/polls.php' );
    require_once( 'admin/models/elements.php' );
    require_once( 'admin/models/templates.php' );
    require_once( 'admin/models/subelements.php' );
    $yop_poll_public = new YOP_Poll_Public;
}
add_action( 'widgets_init', 'YOP_Poll_Widget' );
