<?php
/*
	Initiated when in the Admin panels.
	Used to create the Settings page for the plugin.
*/

//	Exit if .php file accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

DEFINE( 'JR_PS_BELOW_FIELDS', '<br /> &nbsp; ' );

require_once( jr_ps_path() . 'includes/functions-admin.php' );

add_action( 'admin_menu', 'jr_ps_admin_hook' );
//	Runs just before admin_init (below)

/**
 * Add Admin Menu item for plugin
 * 
 * Plugin needs its own Page in the Settings section of the Admin menu.
 *
 */
function jr_ps_admin_hook() {
	//  Add Settings Page for this Plugin
	global $jr_ps_plugin_data;
	$settings = get_option( 'jr_ps_settings' );
	add_options_page( $jr_ps_plugin_data['Name'], 'Private Site', 'manage_options', 'jr_ps_settings', 'jr_ps_settings_page' );
}

/**
 * Settings page for plugin
 * 
 * Display and Process Settings page for this plugin.
 *
 */
function jr_ps_settings_page() {
	global $jr_ps_plugin_data;
	add_thickbox();
	echo '<div class="wrap">';
	echo '<h2>' . $jr_ps_plugin_data['Name'] . '</h2>';	
		?>
	<p>
	Support has moved to the ZATZLabs site and is no longer provided on the WordPress.org forums. Please visit the new <A HREF=“http://zatzlabs.com/forums/“>ZATZLab Forums</a>. If you need a timely reply from the developer, please <a href=“http://zatzlabs.com/submit-ticket/“>open a ticket</a>.
	</p>
	<?php	
	echo '<h3>Overview</h3><p>';
	$settings = get_option( 'jr_ps_settings' );
	if ( $settings['private_site'] ) {
		echo 'This';
	} else {
		echo 'If you click the <b>Private Site</b> checkbox below, this';
	}
	?>		
	Plugin creates a Private Site,
	by ensuring that site visitors login
	before viewing your web site.
	The only things visible to anyone not logged in, including Search Engines, are:
	<ul>
	<li>
	&raquo; Your site's WordPress Login page;
	</li>
	<li>
	&raquo; Any selections in the 
	<b>
	Visible Exclusions 
	</b>
	section (below);
	</li>
	<li>
	&raquo; Any non-WordPress components of your web site, such as HTML, PHP, ASP or other non-WordPress web page files;
	</li>
	<li>
	&raquo; Images and other media and text files, but only when accessed directly by their URL, 
	or from a browser's directory view, if available.
	</li>
	</ul>
	Other means are available to hide most of the files mentioned above.
	</p>
	<p>
	To see your site, each visitor will need to be registered as a User on your WordPress site.
	They will also have to enter their Username and Password on the WordPress login screen. 
	</p>
	<p>
	You can choose what they see after they login by selecting a <b>Landing Location</b> in the section below.
	</p>
	<form action="options.php" method="POST">
	<?php		
	//	Plugin Settings are displayed and entered here:
	settings_fields( 'jr_ps_settings' );
	do_settings_sections( 'jr_ps_settings_page' );
	echo '<p><input name="save" type="submit" value="Save Changes" class="button-primary" /></p></form>';
	
	/*	Turn off Warning about Private Site defaulting to OFF
		once Admin has seen Settings page.
	*/
	$internal_settings = get_option( 'jr_ps_internal_settings' );
	if ( isset( $internal_settings['warning_privacy'] ) ) {
		unset( $internal_settings['warning_privacy'] );
		update_option( 'jr_ps_internal_settings', $internal_settings );
	}
}

add_action( 'admin_init', 'jr_ps_admin_init' );

/**
 * Register and define the settings
 * 
 * Everything to be stored and/or can be set by the user
 *
 */
function jr_ps_admin_init() {
	register_setting( 'jr_ps_settings', 'jr_ps_settings', 'jr_ps_validate_settings' );
	add_settings_section( 'jr_ps_private_settings_section', 
		'Make Site Private', 
		'jr_ps_private_settings_expl', 
		'jr_ps_settings_page' 
	);
	add_settings_field( 'private_site', 
		'Private Site', 
		'jr_ps_echo_private_site', 
		'jr_ps_settings_page', 
		'jr_ps_private_settings_section' 
	);
	add_settings_section( 'jr_ps_self_registration_section', 
		'<input name="save" type="submit" value="Save Changes" class="button-primary" /><hr />'
		. 'Allow Self-Registration', 
		'jr_ps_self_registration_expl', 
		'jr_ps_settings_page' 
	);
	if ( is_multisite() ) {
		/*	Clone Network Admin panels:  Settings-Network Settings-Registration Settings-Allow new registrations.
			It will be Read-Only except for Super Administrators.
		*/
		add_settings_field( 'registrations', 
			'Allow new registrations', 
			'jr_ps_echo_registrations', 
			'jr_ps_settings_page', 
			'jr_ps_self_registration_section' 
		);
	} else {
		/*	Clone Site Admin panels:  Settings-General Settings-Membership
		*/
		add_settings_field( 'membership', 
			'Membership', 
			'jr_ps_echo_membership', 
			'jr_ps_settings_page', 
			'jr_ps_self_registration_section' 
		);
	}
	add_settings_field( 'reveal_registration', 
		'Reveal Registration Page', 
		'jr_ps_echo_reveal_registration', 
		'jr_ps_settings_page', 
		'jr_ps_self_registration_section' 
	);
	add_settings_section( 'jr_ps_landing_settings_section', 
		'Landing Location', 
		'jr_ps_landing_settings_expl', 
		'jr_ps_settings_page' 
	);
	add_settings_field( 'landing', 
		'Where to after Login?', 
		'jr_ps_echo_landing', 
		'jr_ps_settings_page', 
		'jr_ps_landing_settings_section' 
	);
	add_settings_field( 'specific_url', 
		'Specific URL', 
		'jr_ps_echo_specific_url', 
		'jr_ps_settings_page', 
		'jr_ps_landing_settings_section' 
	);
	add_settings_field( 'wplogin_php', 
		'Apply to wp-login.php?', 
		'jr_ps_echo_wplogin_php', 
		'jr_ps_settings_page', 
		'jr_ps_landing_settings_section' 
	);
	add_settings_section( 'jr_ps_custom_login_section', 
		'Custom Login', 
		'jr_ps_custom_login_expl', 
		'jr_ps_settings_page' 
	);
	add_settings_field( 'custom_login', 
		'Custom Login page?', 
		'jr_ps_echo_custom_login', 
		'jr_ps_settings_page', 
		'jr_ps_custom_login_section' 
	);
	add_settings_field( 'login_url', 
		'Custom Login URL', 
		'jr_ps_echo_login_url', 
		'jr_ps_settings_page', 
		'jr_ps_custom_login_section' 
	);
	add_settings_field( 'custom_login_onsite', 
		'Check Custom Login URL?', 
		'jr_ps_echo_custom_login_onsite', 
		'jr_ps_settings_page', 
		'jr_ps_custom_login_section' 
	);
	add_settings_section( 'jr_ps_exclusions_section', 
		'Visible Exclusions', 
		'jr_ps_exclusions_expl', 
		'jr_ps_settings_page' 
	);
	add_settings_field( 'excl_home', 
		'Site Home Always Visible?<br /><code>' . get_home_url() . '</code>', 
		'jr_ps_echo_excl_home', 
		'jr_ps_settings_page', 
		'jr_ps_exclusions_section' 
	);
	add_settings_field( 'excl_url_add', 
		'Add URL to be Always Visible', 
		'jr_ps_echo_excl_url_add', 
		'jr_ps_settings_page', 
		'jr_ps_exclusions_section' 
	);
	add_settings_field( 'excl_url_is_prefix', 
		'Select here if URL is a Prefix', 
		'jr_ps_echo_excl_url_is_prefix', 
		'jr_ps_settings_page', 
		'jr_ps_exclusions_section' 
	);
	add_settings_field( 'excl_url_del', 
		'Current Visible URL Entries', 
		'jr_ps_echo_excl_url_del', 
		'jr_ps_settings_page', 
		'jr_ps_exclusions_section' 
	);
	add_settings_section( 'jr_ps_advanced_settings_section', 
		'Advanced Settings', 
		'jr_ps_advanced_settings_expl', 
		'jr_ps_settings_page' 
	);
	add_settings_field( 'override_omit', 
		'Allow Landing Location for Custom Login pages', 
		'jr_ps_echo_override_omit', 
		'jr_ps_settings_page', 
		'jr_ps_advanced_settings_section' 
	);
	if ( is_multisite() ) {
		add_settings_field( 'check_role', 
			'Check User Role on Site?', 
			'jr_ps_echo_check_role', 
			'jr_ps_settings_page', 
			'jr_ps_advanced_settings_section' 
		);
	}
}

/**
 * Section text for Section1
 * 
 * Display an explanation of this Section
 *
 */
function jr_ps_private_settings_expl() {
	?>
	<p>
	You will only have a Private Site if the checkbox just below is checked.
	This allows you to disable the Private Site functionality
	without deactivating the Plugin.
	</p>
	<?php
}

function jr_ps_echo_private_site() {
	$settings = get_option( 'jr_ps_settings' );
	echo '<input type="checkbox" id="private_site" name="jr_ps_settings[private_site]" value="true"'
		. checked( TRUE, $settings['private_site'], FALSE ) . ' />';
	echo ' (This plugin is currently ';
	if ( $settings['private_site'] ) {
		echo 'enabled; click checkbox to disable)';
	} else {
		echo 'disabled; click checkbox to enable)';
	}
}

/**
 * Section text for Section2
 * 
 * Display an explanation of this Section
 *
 */
function jr_ps_self_registration_expl() {
	echo '
	<p>
	If you want Users to be able to Register themselves on a Private Site,
	there are two Settings involved.
	First
	is the WordPress Setting that actually allows new Users to self-register.
	It is shown here as a convenience,
	but:
	<ol>
	<li>This is the same
	';
	if ( is_multisite() ) {
		echo '<b>Allow New Registrations</b> field displayed on the <b>Network Settings</b> Admin panel;</li>';
	} else {
		echo '<b>Membership</b> field displayed on the <b>General Settings</b> Admin panel;</li>';
	}
	if ( is_multisite() && !is_super_admin() ) {
		echo '<li>The field is greyed out below because only Super Administrators can change this field.';
	} else {
		echo '<li>Clicking the Save Changes button will update its value.';
	}
	echo '
	</li>
	</ol>
	</p>
	<p>
	Second, is a Setting
	(Reveal Registration Page)
	for this plugin,
	to make the WordPress User Registration page visible to Visitors who are not logged on.
	Since Users cannot log on until they are Registered,
	this Setting must be selected (check mark) for Self-Registration.
	</p>
	';
}

function jr_ps_echo_registrations() {
	$setting = get_site_option( 'registration' );
	foreach ( array( 
		'none' => 'Registration is disabled.',
		'user' => 'User accounts may be registered.',
		'blog' => 'Logged in users may register new sites.',
		'all'  => 'Both sites and user accounts can be registered.'
		) as $value => $description ) {
		echo '<input type="radio" id="registrations" name="jr_ps_settings[registrations]" '
			. checked( $value, $setting, FALSE )
			. ' value="' . $value . '" '
			. disabled( is_super_admin(), FALSE, FALSE )
			. ' /> ' . $description . '<br />';
	}
}

function jr_ps_echo_membership() {
	echo '<input type="checkbox" id="membership" name="jr_ps_settings[membership]" value="1" '
		. checked( '1', get_option( 'users_can_register' ), FALSE ) . ' /> Anyone can register';
}

function jr_ps_echo_reveal_registration() {
	$settings = get_option( 'jr_ps_settings' );
	echo '<input type="checkbox" id="reveal_registration" name="jr_ps_settings[reveal_registration]" value="true"'
		. checked( TRUE, $settings['reveal_registration'], FALSE ) . ' />';
	echo ' Do not block WordPress standard User Registration page (Advanced Setting: a check mark in this checkbox is recommended)';
}

/**
 * Section text for Section3
 * 
 * Display an explanation of this Section
 *
 */
function jr_ps_landing_settings_expl() {
	?>
	<p>
	What do you want your visitors to see immediately after they login?
	For most Private Sites, the default
	<b>Return to same URL</b>
	setting works best,
	as it takes visitors to where they would have been had they already been logged on when they clicked a link or entered a URL,
	just as if they hit the browser's Back button twice and then the Refresh button after logging in.
	</p>
	<p>
	<b>Specific URL</b> only applies when <b>Go to specific URL</b> is selected.
	</p>
	</p>
	Landing Location also is applied to Logins via the Meta Widget.
	<p>
	<?php
}

function jr_ps_echo_landing() {
	$settings = get_option( 'jr_ps_settings' );
	$first = TRUE;
	foreach ( array(
		'return' => 'Return to same URL',
	    'home'   => 'Go to Site Home',
	    'admin'  => 'Go to WordPress Admin Dashboard',
		'omit'   => 'Omit <code>?redirect_to=</code> from URL (this option is recommended for Custom Login pages)', 
	    'url'    => 'Go to Specific URL'
		) as $val => $desc ) {
		if ( $first ) {
			$first = FALSE;
		} else {
			echo '<br />';
		}
		echo '<input type="radio" id="landing" name="jr_ps_settings[landing]" '
			. checked( $val, $settings['landing'], FALSE )
			. ' value="' . $val . '" /> ' . $desc;
	}
}

function jr_ps_echo_specific_url() {
	$settings = get_option( 'jr_ps_settings' );
	echo '<input type="text" id="specific_url" name="jr_ps_settings[specific_url]" size="100" maxlength="256" value="';
	echo esc_url( $settings['specific_url'] ) 
		. '" />'
		. JR_PS_BELOW_FIELDS
		. '(cut and paste URL here of Page, Post or other)'
		. JR_PS_BELOW_FIELDS
		. 'URL must begin with <code>' 
		. trim( get_home_url(), '\ /' ) 
		. '/</code>';
}

function jr_ps_echo_wplogin_php() {
	$settings = get_option( 'jr_ps_settings' );
	echo '<input type="checkbox" id="wplogin_php" name="jr_ps_settings[wplogin_php]" value="true"'
		. checked( TRUE, $settings['wplogin_php'], FALSE ) 
		. ' /> Should Landing Location apply when a <code>wp-login.php</code> URL is clicked or typed without <code>&redirect_to=</code> after it?';
}

/**
 * Section text for Section4
 * 
 * Display an explanation of this Section
 *
 */
function jr_ps_custom_login_expl() {
	echo '<p>If you have a Custom Login page at a different URL than the standard WordPress Login <code>'
		. wp_login_url()
		. '</code>, then you will need to specify it here. Otherwise, visitors will be redirected to the standard WordPress Login.</p>';
	echo '<p>If the Custom Login page is not based on the standard WordPress Login page, it may not accept the <code>?redirect_to=http://landingurl</code> Query that is automatically added to the URL of the Custom Login page. Select Omit for "Where to after Login?" in the Landing Location section to remove the <code>redirect_to</code> Query.</p>';
	echo '<p>Even with the Custom Login page selected, the standard WordPress login page will still appear in certain circumstances, such as logging into the Admin panels.<p>';
}

function jr_ps_echo_custom_login() {
	$settings = get_option( 'jr_ps_settings' );
	echo '<input type="checkbox" id="custom_login" name="jr_ps_settings[custom_login]" value="true" '
		. checked( TRUE, $settings['custom_login'], FALSE )
		. ' />';
}

function jr_ps_echo_login_url() {
	$settings = get_option( 'jr_ps_settings' );
	echo '<input type="text" id="login_url" name="jr_ps_settings[login_url]" size="100" maxlength="256" value="'
		. esc_url( $settings['login_url'] ) 
		. '" />'
		. JR_PS_BELOW_FIELDS
		. '(cut and paste Custom Login URL here; leave blank otherwise)';
}

function jr_ps_echo_custom_login_onsite() {
	$settings = get_option( 'jr_ps_settings' );
	echo '<input type="checkbox" id="custom_login_onsite" name="jr_ps_settings[custom_login_onsite]" value="true" '
		. checked( TRUE, $settings['custom_login_onsite'], FALSE )
		. ' /> '
		. 'URL must begin with <code>' 
		. trim( get_home_url(), '\ /' ) 
		. '/</code> (Advanced Setting: a check mark in this checkbox is recommended)';	
}

/**
 * Section text for Section5
 * 
 * Display an explanation of this Section
 *
 */
function jr_ps_exclusions_expl() {
	?>
	<p>
	If you want to use your Site Home to interest visitors in registering for your site so they can see the rest of your site,
	you obviously need Site Home visible to everyone.
	</p><p>
	You can add additional Visible site URLs,
	one entry at a time,
	in the 
	<b>
	Add URL to be Always Visible 
	</b>
	field.
	</p><p>
	The
	<b>
	Select here if URL is a Prefix
	</b>
	option allows you to specify a portion of a URL,
	which will match, and make visible, all URLs that begin with that specified portion ("URL Prefix").
	</p>
	<?php
}

function jr_ps_echo_excl_home() {
	$settings = get_option( 'jr_ps_settings' );
	echo '<input type="checkbox" id="excl_home" name="jr_ps_settings[excl_home]" value="true"'
		. checked( TRUE, $settings['excl_home'], FALSE ) . ' /> Site Home is visible to everyone?';
}

function jr_ps_echo_excl_url_add() {
	echo '<input id="excl_url_add" name="jr_ps_settings[excl_url_add]" type="text" size="100" maxlength="256" value="" />'
		. JR_PS_BELOW_FIELDS
		. '(cut and paste URL here of Page, Post or other)'
		. JR_PS_BELOW_FIELDS
		. 'URL must begin with <code>' 
		. trim( get_home_url(), '\ /' ) 
		. '/</code>';
}

function jr_ps_echo_excl_url_is_prefix() {
	?>
	<input type="checkbox" id="excl_url_is_prefix" name="jr_ps_settings[excl_url_is_prefix]" value="true" /> Anything that begins with this URL Prefix will be Always Visible
	<?php
}

function jr_ps_echo_excl_url_del() {
	$settings = get_option( 'jr_ps_settings' );
	if ( empty( $settings['excl_url'] ) && empty( $settings['excl_url_prefix'] ) ) {
		echo 'None. To add a Visible URL Entry, fill in the fields above.<br />The Custom Login URL, if specified, is always Visible.';
	} else {
		$first = TRUE;
		foreach ( array( 'url' => 'URL', 'url_prefix' => 'Prefix' ) as $key => $description ) {
			foreach ( $settings["excl_$key"] as $index => $arr ) {
				if ( $first ) {
					$first = FALSE;
				} else {
					echo '<br />';
				}
				$display_url = $arr[0];
				echo 'Delete <input type="checkbox" id="excl_' . $key . '_del" name="jr_ps_settings[excl_' . $key . '_del][]"'
					. " value='$index' /> $description=<a href='$display_url' target='_blank'>$display_url</a>";
			}
		}
		echo '<br />In addition, the Custom Login URL, if specified, is always Visible.';
	}
}

function jr_ps_advanced_settings_expl() {
	?>
	<p>
	The
	<b>
	Allow Landing Location for Custom Login pages
	</b>
	setting shown immediately below will,
	under some circumstances,
	lock you out of your own WordPress site
	and prevent Visitors from viewing your site.
	You will have to rename or delete the
	<code>/wp-contents/plugins/jonradio-private-site/</code>
	folder with FTP or a File Manager provided with your web hosting.
	If you are not familiar with either of these methods
	for deleting files within your WordPress installation,
	you risk making your WordPress site completely inoperative.
	</p>
	<?php
}

function jr_ps_echo_override_omit() {
	$settings = get_option( 'jr_ps_settings' );
	echo '<input type="checkbox" id="override_omit" name="jr_ps_settings[override_omit]" value="true"'
		. checked( TRUE, $settings['override_omit'], FALSE ) . ' /> Can Lock You Out of Your WordPress Site! (see paragraph above)';
}

function jr_ps_echo_check_role() {
	$settings = get_option( 'jr_ps_settings' );
	echo '<input type="checkbox" id="check_role" name="jr_ps_settings[check_role]" value="true" '
		. checked( TRUE, $settings['check_role'], FALSE )
		. ' />'
		. ' Only allow Users listed <a href="'
		. admin_url( 'users.php' )
		. '">here</a> to view this site (Security: a check mark in this checkbox is recommended)';
}

function jr_ps_validate_settings( $input ) {
	$valid = array();
	$settings = get_option( 'jr_ps_settings' );
	
	foreach ( array(
				'private_site', 
				'reveal_registration', 
				'wplogin_php', 
				'override_omit', 
				'custom_login',
				'custom_login_onsite', 
				'excl_home'
				) as $opt ) {
		$valid[ $opt ] = isset( $input[ $opt ] ) && ( 'true' === $input[ $opt ] );
	}

	$url = jr_v1_sanitize_url( $input['specific_url'] );
	if ( '' !== $url ) {
		if ( FALSE === $url ) {
			/*	Reset to previous URL value and generate an error message.
			*/
			$url = $settings['specific_url'];			
			add_settings_error(
				'jr_ps_settings',
				'jr_ps_urlerror',
				'Landing Location URL is not a valid URL<br /><code>'
					. sanitize_text_field( $input['specific_url'] ) . '</code>',
				'error'
			);
		} else {
			if ( !jr_ps_site_url( $url ) ) {
				/*	Reset to previous URL value and generate an error message.
				*/
				$url = $settings['specific_url'];
				add_settings_error(
					'jr_ps_settings',
					'jr_ps_urlerror',
					'Error in Landing Location URL.  It must point to someplace on this WordPress web site<br /><code>'
						. sanitize_text_field( $input['specific_url'] ) . '</code>',
					'error'
				);
			}
		}
	}
	$valid['specific_url'] = $url;
	
	if ( 'url' === $input['landing'] ) {
		if ( '' === $valid['specific_url'] ) {
			add_settings_error(
				'jr_ps_settings',
				'jr_ps_nourlerror',
				'Error in Landing Location: <i>Go to Specific URL</i> selected but no URL specified.  Set to default <i>Return to same URL</i>.',
				'error'
			);
			$valid['landing'] = 'return';
		} else {
			$valid['landing'] = 'url';
		}
	} else {
		if ( '' !== $valid['specific_url'] ) {
			add_settings_error(
				'jr_ps_settings',
				'jr_ps_nourlerror',
				'Error in Landing Location:  URL specified when not valid.  URL deleted.',
				'error'
			);
			$valid['specific_url'] = '';
		}
		$valid['landing'] = $input['landing'];
	}
	
	/*	Custom Login section
	*/
	if ( FALSE === ( $valid['login_url'] = jr_v1_sanitize_url( $input['login_url'] ) ) ) {
		/*	Generate an error message.
			Then clear Custom Login checkbox and URL fields.
		*/
		add_settings_error(
			'jr_ps_settings',
			'jr_ps_urlerror',
			'Custom Login URL is not a valid URL<br /><code>'
				. sanitize_text_field( $input['login_url'] ) . '</code>',
			'error'
		);		
		$valid['login_url'] = '';
		$valid['custom_login'] = FALSE;
	} else {
		if ( ( '' !== $valid['login_url'] )
			&& $valid['custom_login_onsite'] 
			&& ( !jr_ps_site_url( $url ) ) ) {
			/*	Generate an error message.
				Then clear Custom Login checkbox and URL fields.
			*/
			add_settings_error(
				'jr_ps_settings',
				'jr_ps_urlerror',
				'Error in Custom Login URL.  It must point to someplace on this WordPress web site<br /><code>'
					. sanitize_text_field( $input['login_url'] ) . '</code>',
				'error'
			);
			$valid['login_url'] = '';
			$valid['custom_login'] = FALSE;
		} else {
			if ( ( '' !== $valid['login_url'] ) && ( !$valid['custom_login'] ) ) {
				/*	URL specified but not Custom Login checkbox
					
					Generate an error message.
					Then clear Custom Login checkbox and URL fields.
				*/
				add_settings_error(
					'jr_ps_settings',
					'jr_ps_urlerror',
					'Error in Custom Login: URL specified but <i>Custom Login page?</i> checkbox not selected.',
					'error'
				);
				$valid['login_url'] = '';
				$valid['custom_login'] = FALSE;
			} else {
				if ( ( '' === $valid['login_url'] ) && ( $valid['custom_login'] ) ) {
					/*	Custom Login checkbox specified but not URL
					
						Generate an error message.
						Then clear Custom Login checkbox and URL fields.
					*/
					add_settings_error(
						'jr_ps_settings',
						'jr_ps_nourlerror',
						'Error in Custom Login: <i>Custom Login page?</i> checkbox selected but no URL specified.  Checkbox deselected.',
						'error'
					);
					$valid['login_url'] = '';
					$valid['custom_login'] = FALSE;
				}
			}
		}
	}

	if ( $valid['custom_login'] 
		&& ( !$valid['override_omit'] ) 
		&& ( 'omit' !== $valid['landing'] ) ) {
		$valid['landing'] = 'omit';
		add_settings_error(
			'jr_ps_settings',
			'jr_ps_setomit',
			'Landing Location changed to "Omit", recommended for Custom Login pages. See Advanced Settings to Override, but please read Warnings first.',
			'updated'
		);
	}
	
	if ( is_multisite() ) {
		if ( is_super_admin() ) {
			if ( isset( $input['registrations'] ) ) {
				update_site_option( 'registration', $input['registrations'] );
			}	
		}
		/*	Only in Form in WordPress Network
		*/
		if ( isset( $input['check_role'] ) && ( $input['check_role'] === 'true' ) ) {
			$valid['check_role'] = TRUE;
		} else {
			$valid['check_role'] = FALSE;
		}
	} else {
		if ( isset( $input['membership'] ) ) {
			$mem = $input['membership'];
		} else {
			$mem = '0';
		}
		update_option( 'users_can_register', $mem );
		/*	Not in Form except in WordPress Network
		*/
		$valid['check_role'] = $settings['check_role'];
	}
	
	foreach ( array( 'excl_url', 'excl_url_prefix' ) as $key ) {
		if ( isset( $settings[$key] ) ) {
			$valid[$key] = $settings[$key];
		} else {
			$valid[$key] = array();
		}
	
		/*	Delete URLs to Exclude from Privacy.
		*/
		if ( isset ( $input[$key . '_del'] ) ) {
			foreach ( $input[$key . '_del'] as $excl_url_del ) {
				unset( $valid[$key][$excl_url_del] );
			}
		}
	}

	/*	Add a URL to Exclude from Privacy.
	*/
	$url = jr_v1_sanitize_url( $input['excl_url_add'] );
	if ( '' !== $url ) {
		if ( FALSE === $url ) {
			add_settings_error(
				'jr_ps_settings',
				'jr_ps_urlerror',
				'Always Visible URL is not a valid URL<br /><code>'
					. sanitize_text_field( $input['excl_url_add'] ) . '</code>',
				'error'
			);
		} else {
			if ( jr_ps_site_url( $url ) ) {
				if ( isset ( $input['excl_url_is_prefix'] ) && ( 'true' === $input['excl_url_is_prefix'] ) ) {
					$key = 'excl_url_prefix';
				} else {
					$key = 'excl_url';
				}
				$valid[$key][] = array( $url, jr_v1_prep_url( $url ) );
			} else {
				add_settings_error(
					'jr_ps_settings',
					'jr_ps_urlerror',
					'Error in Always Visible URL.  It must point to someplace on this WordPress web site<br /><code>'
						. sanitize_text_field( $input['excl_url_add'] ) . '</code>',
					'error'
				);
			}
		}
	}
	
	$errors = get_settings_errors();
	if ( isset( $jr_ps_users_submenu ) && empty( $errors ) ) {
		add_settings_error(
			'jr_ps_settings',
			'jr_ps_saved',
			'Settings Saved',
			'updated'
		);	
	}	
	
	return $valid;
}
	
?>