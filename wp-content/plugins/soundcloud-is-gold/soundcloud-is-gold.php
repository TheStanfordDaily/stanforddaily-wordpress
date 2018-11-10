<?php
/*
Plugin Name: Soundcloud is Gold
Plugin URI: http://www.mightymess.com/soundcloud-is-gold-wordpress-plugin
Description: <strong><a href="http://www.mightymess.com/soundcloud-is-gold-wordpress-plugin">Soundcloud is gold</a></strong> integrates perfectly into wordpress. Select, set and add track, playlists or favorites to your post using the soundcloud player. Live Preview, easy, smart and straightforward. You can set default settings in the option page, choose your defaut soundcloud player (Standard, Artwork, Visual), its width, extra Css classes for you CSS lovers and your favorite colors. You'll still be able to set players to different settings before adding to your post if you fancy a one off change!
Version: 2.5.1
Author: Thomas Michalak
Author URI: http://www.mightymess.com/thomas-michalak
License: GPL2 or Later
Text Domain: soundcloud-is-gold
*/

/*
 Default Sizes
 mini: h = 18, w = 100%
 standard: h = 81 (165), w = 100%
 artwork: h = 300, w = 300
 html5: h=166, w=100%
*/

define ('SIG_PLUGIN_DIR', WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)) );
//define( 'SIG_PLUGIN_DIR_HTTP', WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)) );
//define( 'SIG_PLUGIN_DIR', (is_ssl() ? str_replace('http:', 'https:', SIG_PLUGIN_DIR_HTTP) : SIG_PLUGIN_DIR_HTTP) );
//$httpPrefix = (is_ssl() ? 'https' : 'http');

define ('CLIENT_ID', '9UhNtlbTIh7V6YHJm9wwHgjCwd7t1xOk');

require_once('soundcloud-is-gold-notice.php');
require_once('soundcloud-is-gold-functions.php');
require_once('soundcloud-is-gold-widget.php');
//require_once('soundcloud-is-gold-advance.php');

/** Get Plugin Version **/
function get_soundcloud_is_gold_version() {
	$plugin_data = get_plugin_data( __FILE__ );
	$plugin_version = $plugin_data['Version'];
	return $plugin_version;
}

/*** Plugin Init ***/
add_action( 'admin_init', 'soundcloud_is_gold_admin_init' );
function soundcloud_is_gold_admin_init() {
    register_setting( 'soundcloud_is_gold_options', 'soundcloud_is_gold_options' );
    wp_register_script('soundcloud-is-gold-js', SIG_PLUGIN_DIR.'soundcloud-is-gold-js.js', array('jquery', 'farbtastic'));
    wp_register_script('carouFredSel', SIG_PLUGIN_DIR.'includes/jquery.carouFredSel-5.5.0-packed.js', array('jquery'));
    wp_register_style('soundcloud-is-gold-css', SIG_PLUGIN_DIR.'soundcloud-is-gold-css.css');
    wp_register_style('soundcloud-is-gold-editor-css', SIG_PLUGIN_DIR.'tinymce-plugin/soundcloud-is-gold-editor_plugin.css');
		load_plugin_textdomain( 'soundcloud-is-gold' );
}
//Plugin option scripts
function soundcloud_is_gold_option_scripts() {
    wp_enqueue_script('farbtastic');
    wp_enqueue_script('soundcloud-is-gold-js');
    wp_enqueue_script('carouFredSel');
}
//Plugin option style
function soundcloud_is_gold_option_styles() {
  wp_enqueue_style('soundcloud-is-gold-css');
  wp_enqueue_style('farbtastic');
}
//Plugin Options' Fonts
function soundcloud_is_gold_option_fonts() {
  wp_enqueue_style('ChunkFive');
  wp_enqueue_style('Quicksand');
}
/*** Add Admin Menu ***/
add_action('admin_menu', 'soundcloud_is_gold_menu');
function soundcloud_is_gold_menu() {
	//Main
	$soundcloudIsGoldPage = add_menu_page('Soundcloud is Gold', 'Soundcloud is Gold', 'activate_plugins', __FILE__, 'soundcloud_is_gold_options', SIG_PLUGIN_DIR.'images/soundcloud-is-gold-icon.png');
	add_action( "admin_print_scripts-$soundcloudIsGoldPage", 'soundcloud_is_gold_option_scripts' ); // Add script
	add_action( "admin_print_styles-$soundcloudIsGoldPage", 'soundcloud_is_gold_option_styles' ); // Add Style
	//add_action( "admin_print_styles-$soundcloudIsGoldPage", 'soundcloud_is_gold_option_fonts' ); // Add Fonts

	//Advance
	/*$soundcloudIsGoldAdvancePage = add_submenu_page( __FILE__, 'Soundcloud is Gold: Advance', 'Advance Options', 'activate_plugins', 'soundcloud_is_gold_advance_options', soundcloud_is_gold_advance_options );
	add_action( "admin_print_scripts-$soundcloudIsGoldAdvancePage", 'soundcloud_is_gold_option_scripts' ); // Add script
	add_action( "admin_print_styles-$soundcloudIsGoldAdvancePage", 'soundcloud_is_gold_option_styles' ); // Add Style
	add_action( "admin_print_styles-$soundcloudIsGoldAdvancePage", 'soundcloud_is_gold_option_fonts' ); // Add Fonts
	*/

}

/*** Link to Settings from the plugin Page ***/
function soundcloud_is_gold_settings_link($links, $file) {
    if ( $file == plugin_basename( __FILE__ ) ) {
	$settings_link = '<a href="admin.php?page=soundcloud-is-gold/soundcloud-is-gold.php">'.__('Settings').'</a>';
	array_unshift($links, $settings_link);
    }
    return $links;
}
add_filter("plugin_action_links", 'soundcloud_is_gold_settings_link', 10, 2 );

/*** Add tinyMce Soundcloud is Gold Plugin ***/
add_filter("mce_external_plugins", 'soundcloud_is_gold_mce_plugin');
//add_filter( 'mce_buttons', 'soundcloud_is_gold_mce_button' );
add_filter('mce_css', 'soundcloud_is_gold_mce_css');


/*** Options and Utilities***/
register_activation_hook(__FILE__, 'soundcloud_is_gold_add_defaults');
function soundcloud_is_gold_add_defaults() {
    //Get the options to see if plugin was already installed or not
		$tmpOptions = get_option('soundcloud_is_gold_options');
		//First Time install or reactivating
		if(empty($tmpOptions)) {
					//Set default Users and Pick a random user to be active
					$soundcloudIsGoldDefaultUsers = array(
									    '2708382' => array('2708382', 'anna-chocola', 'https://i1.sndcdn.com/avatars-000009470567-spqine-large.jpg?4387aef'),
									    '150596' => array('150596', 't-m', 'https://i1.sndcdn.com/avatars-000002680779-fkvvpj-large.jpg?4387aef'),
									    '3140049' => array('3140049', 'my-disco-nap', 'https://i1.sndcdn.com/avatars-000012680897-foqv41-large.jpg?b9f92e9')
									    );
					$soundcloudIsGoldDefaultUser = $soundcloudIsGoldDefaultUsers[array_rand($soundcloudIsGoldDefaultUsers, 1)][0];
					//Set Default Settings
					$soundcloudIsGoldDefaultSettings = array(
				                                        false,
				                                        true,
																								true,
																								false
					);
					//Set default Width Settings
					$soundcloudIsGoldWitdhDefaultSettings = array(
				                                       "type" => "custom",
				                                       "wp" => "medium",
				                                       "custom" => "100%"
					);
					//Register defaults settings
					$args = array(
					    'soundcloud_is_gold_users' => $soundcloudIsGoldDefaultUsers,
					    'soundcloud_is_gold_active_user' => $soundcloudIsGoldDefaultUser,
					    'soundcloud_is_gold_settings' => $soundcloudIsGoldDefaultSettings,
					    'soundcloud_is_gold_width_settings' => $soundcloudIsGoldWitdhDefaultSettings,
					    'soundcloud_is_gold_classes' => '',
					    'soundcloud_is_gold_color' => 'ff7700'
						  );
					//Update Settings
					update_option('soundcloud_is_gold_options', $args);
		}else{
			//Updating plugin
		}
		//For both New and Updating
		add_action( 'admin_notices', 'soundcloud_is_gold_update_admin_notice__info');
}

//Deactivation
//register_deactivation_hook(__FILE__, 'soundcloud_is_gold_deactivate_plugin');
function soundcloud_is_gold_deactivate_plugin() {
}
// Delete options table entries ONLY when plugin is deactivated AND gets deleted
register_uninstall_hook(__FILE__, 'soundcloud_is_gold_delete_plugin_options');
function soundcloud_is_gold_delete_plugin_options() {
	delete_option("soundcloud_is_gold_options");
}

// display default admin notice
function soundcloud_is_gold_add_settings_errors() {
    settings_errors();
}
add_action('admin_notices', 'soundcloud_is_gold_add_settings_errors');


/**********************************************/
/**                                          **/
/**            THE OPTIONS PAGE              **/
/**                                          **/
/**********************************************/
function soundcloud_is_gold_options(){
    $options = get_option('soundcloud_is_gold_options');
		//Fix bug when updating to 2.4.2 where API requests can only use user id
    $options = soundcloud_is_gold_update_users($options);
		//printl($options);
    $soundcloudIsGoldActiveUser = isset($options['soundcloud_is_gold_active_user']) ? $options['soundcloud_is_gold_active_user'] : '';
    $soundcloudIsGoldUsers = isset($options['soundcloud_is_gold_users']) ? $options['soundcloud_is_gold_users'] : '';
    $soundcloudIsGoldSettings = isset($options['soundcloud_is_gold_settings']) ? $options['soundcloud_is_gold_settings'] : '';
    $soundcloudIsGoldWidthSettings = isset($options['soundcloud_is_gold_width_settings']) ? $options['soundcloud_is_gold_width_settings'] : '';
		$soundcloudIsGoldHeightSettings = isset($options['soundcloud_is_gold_height_settings']) ? $options['soundcloud_is_gold_height_settings'] : '';
	  $soundcloudIsGoldClasses = isset($options['soundcloud_is_gold_classes']) ? $options['soundcloud_is_gold_classes'] : '';
    $soundcloudIsGoldColor = isset($options['soundcloud_is_gold_color']) ? $options['soundcloud_is_gold_color'] : '';

		//weird bug limit as to be set to 2 as some user don't return anything when set to 1
    $soundcloudIsGoldApiCall = 'https://api.soundcloud.com/users/'.$soundcloudIsGoldActiveUser.'/tracks.json?limit=2&client_id='.CLIENT_ID;
		$soundcloudIsGoldApiResponse = get_soundcloud_is_gold_api_response($soundcloudIsGoldApiCall);

		if(isset($soundcloudIsGoldApiResponse['response']) && $soundcloudIsGoldApiResponse['response']){
			foreach($soundcloudIsGoldApiResponse['response'] as $soundcloudMMLatestTrack){
				$soundcouldMMId = (string)$soundcloudMMLatestTrack['id'];
				break;//we just want the first track as we have to loop because of the limit=2 bug
			}
    }
    $soundcouldMMShortcode = '[soundcloud id='.$soundcouldMMId.']';

		//Output Options header
		soundcloud_options_header();
?>
            <form method="post" action="options.php" id="soundcloudMMMainForm" name="soundcloudMMMainForm" class="">
	    <p class="hidden soundcloudMMId" id="soundcloudMMId-<?php echo $soundcouldMMId ?>"><?php echo $soundcouldMMId ?></p>
            <?php settings_fields('soundcloud_is_gold_options'); ?>
                <ul id="soundcloudMMSettings">
                    <!-- Username -->
		    <li class="soundcloudMMBox"><label class="optionLabel"><?php _e('User Name', 'soundcloud-is-gold') ?></label>
			<?php get_soundcloud_is_gold_username_interface($options, $soundcloudIsGoldUsers) ?>
		    </li>
		    <!-- Default Settings -->
                    <li class="soundcloudMMBox">
												<label class="optionLabel"><?php _e('Default Settings', 'soundcloud-is-gold') ?></label>
                        <ul class="subSettings checkboxes">
                            <li><input type="checkbox" <?php echo (isset($soundcloudIsGoldSettings[0]) && $soundcloudIsGoldSettings[0]) ? 'checked="checked"' : ''?> name="soundcloud_is_gold_options[soundcloud_is_gold_settings][0]" value="true" class="soundcloudMMAutoPlay" id="soundcloudMMAutoPlay"/><label for="soundcloudMMAutoPlay"><?php _e('Play Automatically', 'soundcloud-is-gold') ?></label></li>
                            <li><input type="checkbox" <?php echo (isset($soundcloudIsGoldSettings[1]) && $soundcloudIsGoldSettings[1]) ? 'checked="checked"' : ''?> name="soundcloud_is_gold_options[soundcloud_is_gold_settings][1]" value="true" class="soundcloudMMShowComments" id="soundcloudMMShowComments"/><label for="soundcloudMMShowComments"><?php _e('Show comments', 'soundcloud-is-gold') ?></label></li>
			    									<li><input type="checkbox" <?php echo (isset($soundcloudIsGoldSettings[2]) && $soundcloudIsGoldSettings[2]) ? 'checked="checked"' : ''?> name="soundcloud_is_gold_options[soundcloud_is_gold_settings][2]" value="true" class="soundcloudMMShowArtwork" id="soundcloudMMShowArtwork"/><label for="soundcloudMMShowArtwork"><?php _e('Show Artwork', 'soundcloud-is-gold') ?></label></li>
												</ul>
												<ul class="subSettings checkboxes">
														<li><input type="checkbox" <?php echo (isset($soundcloudIsGoldSettings[3]) && $soundcloudIsGoldSettings[3]) ? 'checked="checked"' : ''?> name="soundcloud_is_gold_options[soundcloud_is_gold_settings][3]" value="true" class="soundcloudMMShowVisual" id="soundcloudMMShowVisual"/><label for="soundcloudMMShowVisual"><?php _e('Full Visual', 'soundcloud-is-gold') ?><small>(<?php _e('use soundcloud colors', 'soundcloud-is-gold') ?>)</small></label></li>
														<li><input type="checkbox" <?php echo (isset($soundcloudIsGoldSettings[4]) && $soundcloudIsGoldSettings[4]) ? 'checked="checked"' : ''?> name="soundcloud_is_gold_options[soundcloud_is_gold_settings][4]" value="true" class="soundcloudMMSForceMini" id="soundcloudMMSForceMini"/><label for="soundcloudMMSForceMini"><?php _e('Force mini player', 'soundcloud-is-gold') ?><small>(<?php _e('Artwork and comments won\'t show', 'soundcloud-is-gold') ?>)</small></label></li>
												</ul>
                    </li>
		    <!-- Sizes -->
                    <li class="soundcloudMMBox"><label class="optionLabel"><?php _e('Default Sizes', 'soundcloud-is-gold') ?></label>
                        <ul id="soundcloudMMWidthSetting" class="subSettings texts">
                            <li>
                                <input name="soundcloud_is_gold_options[soundcloud_is_gold_width_settings][type]" <?php echo ($soundcloudIsGoldWidthSettings['type'] == "wp") ? 'checked="checked"' : ''; ?> id="soundcloudMMWpWidth" value="wp" type="radio" class="soundcloudMMWpWidth soundcloudMMWidthType radio"/><label for="soundcloudMMWpWidth"><?php _e('Media Width', 'soundcloud-is-gold') ?></label>
                                <select class="soundcloudMMInput soundcloudMMWidth" name="soundcloud_is_gold_options[soundcloud_is_gold_width_settings][wp]">
                                <?php foreach(get_soundcloud_is_gold_wordpress_sizes() as $key => $soundcloudIsGoldMediaSize) : ?>
                                    <?php
                                    //First Time, then Other Times
                                    if($soundcloudIsGoldWidthSettings['wp'] == 'medium') $soundcloudIsGoldMediaSelected = ($key == $soundcloudIsGoldWidthSettings['wp']) ? 'selected="selected"' : '';
                                    else $soundcloudIsGoldMediaSelected = ($soundcloudIsGoldMediaSize[0] == $soundcloudIsGoldWidthSettings['wp']) ? 'selected="selected"' : ''; ?>
                                    <option <?php echo $soundcloudIsGoldMediaSelected ?> value="<?php echo $soundcloudIsGoldMediaSize[0]?>" class="soundcloudMMWpSelectedWidth"><?php echo $key.': '.$soundcloudIsGoldMediaSize[0]?></option>
                                <?php endforeach; ?>
                                </select>
                            </li>
                            <li>
                                <input name="soundcloud_is_gold_options[soundcloud_is_gold_width_settings][type]" <?php echo ($soundcloudIsGoldWidthSettings['type'] == "custom") ? 'checked="checked"' : ''; ?> id="soundcloudMMCustomWidth" value="custom" type="radio" class="soundcloudMMCustomWidth soundcloudMMWidthType radio"/><label for="soundcloudMMCustomWidth"><?php _e('Custom Width', 'soundcloud-is-gold') ?></label>
                                <input name="soundcloud_is_gold_options[soundcloud_is_gold_width_settings][custom]" id="soundcloudMMCustomSelectedWidth" class="soundcloudMMInput soundcloudMMWidth soundcloudMMCustomSelectedWidth" type="text" name="soundcloud_is_gold_options[soundcloudMMCustomSelectedWidth]" value="<?php echo $soundcloudIsGoldWidthSettings['custom'] ?>" />
                            </li>
                        </ul>
												<ul class="subSettings texts">
													<li>
															<label><?php _e('Playlist Height', 'soundcloud-is-gold') ?><small>(<?php _e('leave empty for default, can\'t be less than 300px', 'soundcloud-is-gold') ?></small></label>
															<input id="soundcloudMMPlaylistHeight" class="soundcloudMMInput soundcloudMMWidth soundcloudMMPlaylistHeight" type="text" name="soundcloud_is_gold_options[soundcloud_is_gold_height_settings][playlist]" value="<?php echo (isset($soundcloudIsGoldHeightSettings['playlist'])) ? $soundcloudIsGoldHeightSettings['playlist'] : ''?>" />
													</li>
													<li>
														<input type="checkbox" <?php echo (isset($soundcloudIsGoldHeightSettings['square']) && $soundcloudIsGoldHeightSettings['square']) ? 'checked="checked"' : ''?> name="soundcloud_is_gold_options[soundcloud_is_gold_height_settings][square]" value="true" class="soundcloudMMSquareHeight" id="soundcloudMMSquareHeight"/><label for="soundcloudMMSquareHeight"><?php _e('Force Square Player', 'soundcloud-is-gold') ?><small>(<?php _e('Visual', 'soundcloud-is-gold') ?>)</small></label>
													</li>
												</ul>
                    </li>
		    <!-- Color and Classes -->
                    <li class="soundcloudMMBox"><label class="optionLabel"><?php _e('Extras', 'soundcloud-is-gold') ?></label>
                        <ul class="subSettings texts">
                            <li>
                                <label><?php _e('Color', 'soundcloud-is-gold') ?></label>
                                <div class="soundcloudMMColorPickerContainer" id="soundcloudMMColorPickerContainer">
                                    <input type="text" class="soundcloudMMInput soundcloudMMColor" id="soundcloudMMColor" name="soundcloud_is_gold_options[soundcloud_is_gold_color]" value="<?php echo $soundcloudIsGoldColor ?>" style="background-color:<?php echo $soundcloudIsGoldColor ?>"/><a href="#" class="soundcloudMMBt soundcloudMMBtSmall inline blue soundcloudMMRounder soundcloudMMResetColor"><?php _e('reset to default', 'soundcloud-is-gold') ?></a>
                                    <div id="soundcloudMMColorPicker" class="shadow soundcloudMMColorPicker"><div id="soundcloudMMColorPickerSelect" class="soundcloudMMColorPickerSelect"></div><a id="soundcloudMMColorPickerClose" class="blue soundcloudMMBt soundcloudMMColorPickerClose"><?php _e('done', 'soundcloud-is-gold') ?></a></div>
                                </div>
                            </li>
                            <li class="clear">
                                <label><?php _e('CSS Classes', 'soundcloud-is-gold') ?><small>(<?php _e('no commas', 'soundcloud-is-gold') ?>)</small></label><input class="soundcloudMMInput soundcloudMMClasses" type="text" name="soundcloud_is_gold_options[soundcloud_is_gold_classes]" value="<?php echo $soundcloudIsGoldClasses ?>" />
                            </li>
                        </ul>
                    </li>
		    <!-- Preview -->
                    <li class="soundcloudMMBox"><label class="optionLabel previewLabel"><?php _e('Live Preview', 'soundcloud-is-gold') ?><small>(<?php _e('your latest track', 'soundcloud-is-gold') ?>)</small></label>
                        <?php if($soundcloudIsGoldApiResponse['response']) :?>
                        <p class="soundcloudMMEmbed soundcloudMMEmbedOptions" style="text-align:center;">
			    							<!-- Soundcloud Preview here -->
												</p>
                        <p class="soundcloudMMLoading soundcloudMMPreviewLoading" style="display:none"></p>
                        <?php else : ?>
                        <!-- Error getting Json -->
                        <div class="soundcloudMMJsonError"><p><?php echo $soundcloudIsGoldApiResponse['error'] ? $soundcloudIsGoldApiResponse['error'] : "__('Oups! There's been a error while getting the tracks from soundcloud. Please reload the page.', 'soundcloud-is-gold')"?></p></div>
                        <?php endif; ?>
                    </li>
                </ul>
		<!-- Submit -->
                <p id="soundcloudMMSubmit"><input type="submit" name="Submit" value="<?php _e('Save Your SoundCloud Settings') ?>" class="soundcloudMMButton-primary button-primary"/></p>
	    </form>

    <?php

		//Output Options Footer
		soundcloud_options_footer();
}


?>
