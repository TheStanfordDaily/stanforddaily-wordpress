<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}
require_once( 'admin/inc/dbschema.php' );
require_once( 'admin/inc/maintenance.php' );
require_once( 'admin/inc/capabilities.php' );
$yop_poll_maintenance = new YOP_POLL_Maintenance;
$yop_poll_maintenance->uninstall();
