<?php
function tsd_pn_plugin_menu() {
	add_options_page(
		'TSD Push Notification',
		'TSD Push Notification',
		'manage_options',
		'tsd-push-notification.php',
		'tsd_pn_plugin_settings_page'
	);

	// DEBUG
	//set_transient( "tsd_pn_debug_info", [] );
}
add_action( 'admin_menu', 'tsd_pn_plugin_menu' );

function tsd_pn_plugin_settings_page() {
	?>
<div class="wrap">
	<h1>TSD Push Notification Debug</h1>
	<pre>
	<?php var_dump( get_transient( "tsd_pn_debug_info" ) ); ?>
	</pre>
</div>
	<?php
}
