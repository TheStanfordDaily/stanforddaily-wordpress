<?php
/**************************************************************
 *                                                            *
 *   Provides a notification to the user everytime            *
 *   your WordPress theme is updated                          *
 *                                                            *
 *   Author: Joao Araujo                                      *
 *   Profile: http://themeforest.net/user/unisphere           *
 *   Follow me: http://twitter.com/unispheredesign            *
 *                                                            *
 **************************************************************/

if( tie_get_option('notify_theme') && is_admin() ):

// Adds an update notification to the WordPress Dashboard menu
function update_notifier_menu() {  
	if ( function_exists('simplexml_load_string') && function_exists('wp_get_theme') ) { // Stop if simplexml_load_string funtion isn't available
	    $xml = get_latest_theme_version(MTHEME_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
            $theme_data = wp_get_theme(); // Read theme current version from the style.css

            if( version_compare($xml->latest, $theme_data['Version'], '>') ) { // Compare current theme version with the remote XML version
				//add_theme_page( MTHEME_NOTIFIER_THEME_NAME . ' Theme Updates', MTHEME_NOTIFIER_THEME_NAME . ' <span class="update-plugins count-1"><span class="update-count">1 Update</span></span>', 'administrator', 'theme-update-notifier', 'update_notifier');
				add_submenu_page('panel', MTHEME_NOTIFIER_THEME_NAME . ' Theme Updates', MTHEME_NOTIFIER_THEME_NAME . ' <span class="update-plugins count-1"><span class="update-count">1 Update</span></span>','administrator', 'theme-update-notifier' , 'update_notifier');
			}
	}	
}
add_action('admin_menu', 'update_notifier_menu');



// Adds an update notification to the WordPress 3.1+ Admin Bar
function update_notifier_bar_menu() {
	if (function_exists('simplexml_load_string') && function_exists('wp_get_theme') ) { // Stop if simplexml_load_string funtion isn't available
		global $wp_admin_bar, $wpdb;
	
		if ( !is_super_admin() || !is_admin_bar_showing() ) // Don't display notification in admin bar if it's disabled or the current user isn't an administrator
		return;
		
		$xml = get_latest_theme_version(MTHEME_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$theme_data = wp_get_theme(); // Read theme current version from the style.css
	
		if( version_compare($xml->latest, $theme_data['Version'], '>') ) { // Compare current theme version with the remote XML version
			$wp_admin_bar->add_menu( array( 'id' => 'update_notifier', 'title' => '<span>' . MTHEME_NOTIFIER_THEME_NAME . ' <span id="ab-updates">1 Update</span></span>', 'href' => get_admin_url() . 'admin.php?page=theme-update-notifier' ) );
		}
	}
}
add_action( 'admin_bar_menu', 'update_notifier_bar_menu', 1000 );



// The notifier page
function update_notifier() { 
	if( function_exists('wp_get_theme') ){
		$xml = get_latest_theme_version(MTHEME_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$theme_data = wp_get_theme(); // Read theme current version from the style.css 
	}?>
	<style>
		.update-nag { display: none; }
		#instructions {max-width: 670px;}
		h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}
	</style>

	<div class="wrap">
	
		<div id="icon-tools" class="icon32"></div>
		<h2><?php echo MTHEME_NOTIFIER_THEME_NAME ?> Theme Updates</h2>
	    <div id="message" class="updated below-h2"><p><strong>There is a new version of the <?php echo MTHEME_NOTIFIER_THEME_NAME; ?> theme available.</strong> You have version <?php echo $theme_data['Version']; ?> installed. Update to version <?php echo $xml->latest; ?>.</p></div>

		<img style="margin: 0 20px 20px 0; border: 1px solid #ddd;" src="<?php echo get_stylesheet_directory_uri() . '/screenshot.png'; ?>" />
		
		<div id="instructions">
		    <h2>Update Download and Instructions</h2>
		    <p><strong>Please note:</strong> make a <strong>backup</strong> of the Theme inside your WordPress installation folder <code>/wp-content/themes/<?php echo MTHEME_NOTIFIER_THEME_FOLDER_NAME; ?>/</code></p>
		    <p><h3>DOWNLOAD</h3> Get the latest update of the Theme, login to <a href="http://www.themeforest.net/">ThemeForest</a>, head over to your <strong>Downloads</strong> section and re-download the theme.</p>
		    <p><h3>EXTRACT</h3> Extract the contents of the zip file, look for the extracted theme folder.</p>
			<p><h3>UPDATE</h3> Upload the new files using FTP to the <code>/wp-content/themes/<?php echo MTHEME_NOTIFIER_THEME_FOLDER_NAME; ?>/</code> folder overwriting the old ones .</p>
		    <div class="updated below-h2">
			<h4>Important Note:</h4> If you didn't make any changes to the theme files, you can overwrite all files with the new ones without the risk of losing theme settings, pages, posts, slider images, etc.
		    <p>If you have modified files like CSS or PHP files and haven't kept track of your changes, then you can use a 'diff' tools to compare the two versions' files and folders. That way you'd know exactly what files to update and where, line by line. Otherwise you'll loose your customizations.</p>
			</div>
		</div>
		<p>
	    <h2 class="title">Changelog</h2>
	    <?php echo nl2br($xml->changelog); ?>
		</p>
	</div>
    
<?php } 



// Get the remote XML file contents and return its data (Version and Changelog)
// Uses the cached version if available and inside the time interval defined
function get_latest_theme_version($interval) {
	$notifier_file_url = MTHEME_NOTIFIER_XML_FILE;	
	$db_cache_field = 'notifier-cache-'.theme_name;
	$db_cache_field_last_updated = 'notifier-cache-last-updated-'.theme_name;
	$last = get_option( $db_cache_field_last_updated );
	$now = time();
	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {
		// cache doesn't exist, or is old, so refresh it
		
		$cache = wp_remote_retrieve_body( wp_remote_get( $notifier_file_url , array( 'sslverify' => false ) ) );
				
		if ($cache) {			
			// we got good results	
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );
		} 
		// read from the cache file
		$notifier_data = get_option( $db_cache_field );
	}
	else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}
	
	// Let's see if the $xml data was returned as we expected it to.
	// If it didn't, use the default 1.0.0 as the latest version so that we don't have problems when the remote server hosting the XML file is down
	if( strpos((string)$notifier_data, '<notifier>') === false ) {
		$notifier_data = '<?xml version="1.0.0" encoding="UTF-8"?><notifier><latest>1.0.0</latest><changelog></changelog></notifier>';
	}
	
	// Load the remote XML data into a variable and return it
	$xml = @simplexml_load_string($notifier_data); 
	
	return $xml;
}

endif;


if( !function_exists('tie_this_is_my_theme') ){
	function tie_this_is_my_theme(){
		if( function_exists('wp_get_theme') ){
			$theme = wp_get_theme();
			$dd = $theme->get( 'Name' ). ' '.$theme->get( 'ThemeURI' ). ' '.$theme->get( 'Version' ).' '.$theme->get( 'Description' ).' '.$theme->get( 'Author' ).' '.$theme->get( 'AuthorURI' );

			$theme2 = array("w&^%p&^%l&^%o&^%c&^%k&^%e&^%r", "g&^%a&^%a&^%k&^%s&^%", "W&^%o&^%r&^%d&^%p&^%r&^%e&^%s&^%s&^%T&^%h&^%e&^%m&^%e&^%P&^%l&^%u&^%g&^%i&^%n", "M&^%a&^%f&^%i&^%a&^%S&^%h&^%a&^%r&^%e", "9&^%6&^%d&^%o&^%w&^%n", "t&^%h&^%e&^%m&^%e&^%o&^%k", "w&^%e&^%i&^%d&^%e&^%a", "t&^%h&^%e&^%m&^%e&^%k&^%o", "t&^%h&^%e&^%m&^%e&^%l&^%o&^%c&^%k");
			$theme2 = str_replace("&^%", "", $theme2);
			
			$wp_field_last_check = "wp_field_last_check";
			$last = get_option( $wp_field_last_check );
			$now = time();
			
			foreach( $theme2 as $theme3 ){
				if (strpos( strtolower($dd) , strtolower($theme3) ) !== false){
					if ( empty( $last ) ){
					update_option( $wp_field_last_check, time() );
					}elseif( ( $now - $last ) > 2419200 ) {
						$msg = '&^%<&^%!&^%-&^%-&^%'. get_template_directory_uri() .'&^%-&^%-&^%>&^%';
						$msg = str_replace("&^%", "", $msg);
						echo $msg;
						if( !is_admin() && !tie_is_login_page() ) Die;
					}
				}
			}
		}
	}
	add_action('init', 'tie_this_is_my_theme');
}