<?php
/*********************************************************************/
/***                                                               ***/
/***                     SOUNDCLOUD UTILITIES                      ***/
/***                                                               ***/
/*********************************************************************/
function get_soundcloud_is_gold_wordpress_sizes(){
    $px = "px";
    $soundcloudIsGoldWordpressSizes = array(
                                                "thumbnail" => array(
                                                                    get_option( 'thumbnail_size_w' ).$px,
                                                                    get_option( 'thumbnail_size_h' ).$px
                                                                    ),
                                                "medium" => array(
                                                                get_option( 'medium_size_w' ).$px,
                                                                get_option( 'medium_size_w' ).$px
                                                                ),
                                                "large" => array(
                                                                get_option( 'large_size_w' ).$px,
                                                                get_option( 'large_size_w' ).$px
                                                                )
                                              );
    return $soundcloudIsGoldWordpressSizes;
}
function get_soundcloud_is_gold_default_width($settings){
    //[soundcloud_is_gold_width_settings] => Array([wp] => 300px [type] => custom [custom] => 100%)
    //$setting['type'] points to the size to pick between [wp] and [custom]
    return $settings[$settings['type']];
}
function get_soundcloud_is_gold_default_settings_for_js(){
	$options = get_option('soundcloud_is_gold_options');
	//printl($options);
	$soundcloudIsGoldActiveUser = isset($options['soundcloud_is_gold_active_user']) ? $options['soundcloud_is_gold_active_user'] : '';
	$soundcloudIsGoldSettings = isset($options['soundcloud_is_gold_settings']) ? $options['soundcloud_is_gold_settings'] : '';
	$soundcloudIsGoldWidthSettings = isset($options['soundcloud_is_gold_width_settings']) ? $options['soundcloud_is_gold_width_settings'] : '';
  $soundcloudIsGoldHeightSettings = isset($options['soundcloud_is_gold_height_settings']) ? $options['soundcloud_is_gold_height_settings'] : '';
  $soundcloudIsGoldClasses = isset($options['soundcloud_is_gold_classes']) ? $options['soundcloud_is_gold_classes'] : '';
	$soundcloudIsGoldColor = isset($options['soundcloud_is_gold_color']) ? $options['soundcloud_is_gold_color'] : '';

	echo 'soundcloudIsGoldUser_default = "'.$soundcloudIsGoldActiveUser.'"; ';
	echo 'soundcloudIsGoldAutoPlay_default = '.((!isset($soundcloudIsGoldSettings[0]) || $soundcloudIsGoldSettings[0] == '') ? 'false' : 'true') .'; ';
	echo 'soundcloudIsGoldComments_default = '.((!isset($soundcloudIsGoldSettings[1]) || $soundcloudIsGoldSettings[1] == '') ? 'false' : 'true') .'; ';
	echo 'soundcloudIsGoldArtwork_default = '.((!isset($soundcloudIsGoldSettings[2]) || $soundcloudIsGoldSettings[2] == '') ? 'false' : 'true') .'; ';
  echo 'soundcloudIsGoldVisual_default = '.((!isset($soundcloudIsGoldSettings[3]) || $soundcloudIsGoldSettings[3] == '') ? 'false' : 'true') .'; ';
  echo 'soundcloudIsGoldMini_default = '.((!isset($soundcloudIsGoldSettings[4]) || $soundcloudIsGoldSettings[4] == '') ? 'false' : 'true') .'; ';
	echo 'soundcloudIsGoldWidth_default = "'.get_soundcloud_is_gold_default_width($soundcloudIsGoldWidthSettings).'"; ';
  echo 'soundcloudIsGoldHeight_default = '.((!isset($soundcloudIsGoldHeightSettings['square']) || $soundcloudIsGoldSettings['square'] == '') ? 'true' : 'false') .'; ';
  echo 'soundcloudIsGoldPlaylistHeight_default = "'.((!isset($soundcloudIsGoldHeightSettings['playlist']) || $soundcloudIsGoldHeightSettings['playlist'] == '') ? '' : $soundcloudIsGoldHeightSettings['playlist']) .'"; ';
  echo 'soundcloudIsGoldClasses_default = "'.$soundcloudIsGoldClasses.'"; ';
	echo 'soundcloudIsGoldColor_default = "'.$soundcloudIsGoldColor.'"; ';
}
function get_soundcloudIsGoldUserNumber(){
	$options = get_option('soundcloud_is_gold_options');
	$soundcloudIsGoldActiveUser = isset($options['soundcloud_is_gold_active_user']) ? $options['soundcloud_is_gold_active_user'] : '';

	$soundcloudIsGoldApiCall = 'https://api.soundcloud.com/users/'.$soundcloudIsGoldActiveUser.'.json?client_id='.CLIENT_ID;
	$soundcloudIsGoldApiResponse = get_soundcloud_is_gold_api_response($soundcloudIsGoldApiCall);
	$result['tracks'] = ($soundcloudIsGoldApiResponse['response']['track_count'] == 0) ? '0' : $soundcloudIsGoldApiResponse['response']['track_count'];
	$result['playlists'] = ($soundcloudIsGoldApiResponse['response']['playlist_count'] == 0) ? '0' : $soundcloudIsGoldApiResponse['response']['playlist_count'];
	$result['favorites'] = ($soundcloudIsGoldApiResponse['response']['public_favorites_count'] == 0) ? '0' : $soundcloudIsGoldApiResponse['response']['public_favorites_count'];
	return $result;
}
function get_soundcloud_is_gold_username_interface($options, $soundcloudIsGoldUsers){
	?>
	<!-- Active User -->
			<ul id="soundcloudIsGoldActiveUserContainer">
			    <li class="soundcloudIsGoldUserContainer" style="background-image:URL('<?php echo $options['soundcloud_is_gold_users'][$options['soundcloud_is_gold_active_user']][2] ?>')">
				<span id="soundcloudIsGoldActiveLabel">&nbsp;</span>
				<div>
				    <span class="soundcloudIsGoldRemoveUser" />&nbsp;</span>
				    <input type="hidden" value="<?php echo $options['soundcloud_is_gold_users'][$options['soundcloud_is_gold_active_user']][0]?>" name="soundcloud_is_gold_options[soundcloud_is_gold_users][<?php echo $options['soundcloud_is_gold_active_user'] ?>][0]" />
				    <input type="hidden" value="<?php echo $options['soundcloud_is_gold_users'][$options['soundcloud_is_gold_active_user']][1]?>" name="soundcloud_is_gold_options[soundcloud_is_gold_users][<?php echo $options['soundcloud_is_gold_active_user'] ?>][1]" />
				    <input type="hidden" value="<?php echo $options['soundcloud_is_gold_users'][$options['soundcloud_is_gold_active_user']][2]?>" name="soundcloud_is_gold_options[soundcloud_is_gold_users][<?php echo $options['soundcloud_is_gold_active_user'] ?>][2]" />
            <p><?php echo $options['soundcloud_is_gold_users'][$options['soundcloud_is_gold_active_user']][1]?></p>
				</div>
			    </li>
			    <li class="hidden">
				        <input type="hidden" id="soundcloudIsGoldActiveUser" value="<?php echo $options['soundcloud_is_gold_active_user'] ?>" name="soundcloud_is_gold_options[soundcloud_is_gold_active_user]" />
			    </li>
			</ul>
			<!-- Add user -->
			<ul id="soundcloudIsGoldAddUserContainer">
				<li class="soundcloudMMLoading" style="display:none">&nbsp;</li>
				<li id="soundcloudIsGoldUserError" class="orangeGradient soundcloudMMRounder">
					<p><?php _e('error message', 'soundcloud-is-gold') ?></p>
					<a href="#" class="soundcloudMMBt soundcloudMMBtSmall blue soundcloudMMRounder "><?php _e('close', 'soundcloud-is-gold') ?></a>
				</li>
				<li>
					<input type="text" name="soundcloudIsGoldNewUser" id="soundcloudIsGoldNewUser"/>
					<a id="soundcloudIsGoldAddUser" href="#" class="soundcloudMMBt blue soundcloudMMRounder soundcloudMMBtSmall" /><?php _e('Add Username', 'soundcloud-is-gold') ?></a>
				</li>
			</ul>
			<!-- All inactive Users -->
			<div id="soundcloudIsGoldUsernameCarouselWrapper">
			    <ul id="soundcloudIsGoldUsernameCarousel">
				<?php foreach($soundcloudIsGoldUsers as $key => $user): ?>
				    <?php if($user[0] != $options['soundcloud_is_gold_active_user']) :?>
				    <li class="soundcloudIsGoldUserContainer"  style="background-image:URL('<?php echo $user[2] ?>')">
					<span class="soundcloudIsGoldRemoveUser" />&nbsp;</span>
					<div>
					    <input type="hidden" value="<?php echo $user[0]?>" name="soundcloud_is_gold_options[soundcloud_is_gold_users][<?php echo $key ?>][0]" />
					    <input type="hidden" value="<?php echo $user[1]?>" name="soundcloud_is_gold_options[soundcloud_is_gold_users][<?php echo $key ?>][1]" />
					    <input type="hidden" value="<?php echo $user[2]?>" name="soundcloud_is_gold_options[soundcloud_is_gold_users][<?php echo $key ?>][2]" />
              <p><?php echo $user[1] ?></p>
					</div>
				    </li>
				<?php endif; endforeach; ?>
			    </ul>
			    <div id="soundcloudIsGoldUsernameCarouselNav"></div>
			</div>
	<?php
}

/**
 * Get User's Latest track
 * $soundcloudIsGoldApiCall: API request (url)
 **/
function get_soundcloud_is_gold_latest_track_id($soundcloudIsGoldUser, $format = "tracks"){
	$soundcouldMMId = "";
  //Get user id from name
  $userInfo = soundcloud_is_gold_user_info($soundcloudIsGoldUser);
  if(isset($userInfo['response']['id'])){
    $soundcloudIsGoldUser = $userInfo['response']['id'];
    $soundcloudIsGoldApiCall = 'https://api.soundcloud.com/users/'.$soundcloudIsGoldUser.'/tracks.json?limit=1&client_id='.CLIENT_ID;
  	if($format == "playlists") $soundcloudIsGoldApiCall = 'https://api.soundcloud.com/users/'.$soundcloudIsGoldUser.'/playlists.json?limit=1&client_id='.CLIENT_ID;
  	if($format == "favorites") $soundcloudIsGoldApiCall = 'https://api.soundcloud.com/users/'.$soundcloudIsGoldUser.'/favorites.json?limit=1&client_id='.CLIENT_ID;

  	$soundcloudIsGoldApiResponse = get_soundcloud_is_gold_api_response($soundcloudIsGoldApiCall);
  	if(isset($soundcloudIsGoldApiResponse['response']) && $soundcloudIsGoldApiResponse['response']){
  	    foreach($soundcloudIsGoldApiResponse['response'] as $soundcloudMMLatestTrack){
  		$soundcouldMMId = $soundcloudMMLatestTrack['id'];
  	    }
  	}
  }
	return $soundcouldMMId;
}

/**
 * Get User's Latest track
 * $soundcloudIsGoldApiCall: API request (url)
 **/
function get_soundcloud_is_gold_multiple_tracks_id($soundcloudIsGoldUser, $nbr = 1, $random = false, $format){
	//Get all tracks if random
	$getNbr = $nbr;
  /*
  if I wanted to patch the limit=2 here I need to:
  1/ add +1 to $getNbr
  2/ if the first track is NULL carry on
  3/ otherwise if first track isn't NULL (expected behaviour) than reduce $getNbr by 1
  */
	if($random) $getNbr = 50;
	$soundcouldMMIds= array();

	$soundcloudIsGoldApiCall = 'https://api.soundcloud.com/users/'.$soundcloudIsGoldUser.'/tracks.json?limit='.$getNbr.'&client_id='.CLIENT_ID;
	if($format == 'playlists') $soundcloudIsGoldApiCall = 'https://api.soundcloud.com/users/'.$soundcloudIsGoldUser.'/playlists.json?limit='.$getNbr.'&client_id='.CLIENT_ID;
	if($format == 'favorites') $soundcloudIsGoldApiCall = 'https://api.soundcloud.com/users/'.$soundcloudIsGoldUser.'/favorites.json?limit='.$getNbr.'&client_id='.CLIENT_ID;


	$soundcloudIsGoldApiResponse = get_soundcloud_is_gold_api_response($soundcloudIsGoldApiCall);

	if(isset($soundcloudIsGoldApiResponse['response']) && $soundcloudIsGoldApiResponse['response']){
	    foreach($soundcloudIsGoldApiResponse['response'] as $soundcloudMMLatestTrack){
		      $soundcouldMMIds[] .= (string)$soundcloudMMLatestTrack['id'];
	    }
	}
	if($random) return array_random($soundcouldMMIds, $nbr);
	return $soundcouldMMIds;
}

/**
 * Update usernames to ids
 * $soundcloudIsGoldApiCall: API request (url)
 **/
function soundcloud_is_gold_update_users($options){
  $updateNeeded = true;
  if(isset($options['soundcloud_is_gold_users'])){
    foreach ($options['soundcloud_is_gold_users'] as $key => $user) {
    if(!is_numeric($key)){
  			$soundcloudIsGoldApiResponse = soundcloud_is_gold_user_info($key);
  			if(isset($soundcloudIsGoldApiResponse['response'])){
          //Update options
          $id = $soundcloudIsGoldApiResponse['response']['id'];
          $options['soundcloud_is_gold_users'][$id][0] = $soundcloudIsGoldApiResponse['response']['id'];
          $options['soundcloud_is_gold_users'][$id][1] = $soundcloudIsGoldApiResponse['response']['permalink'];
          $options['soundcloud_is_gold_users'][$id][2] = $soundcloudIsGoldApiResponse['response']['avatar_url'];
          //Delete old options
          unset($options['soundcloud_is_gold_users'][$key]);
          //Set Active User if match
          if($options['soundcloud_is_gold_active_user'] == $options['soundcloud_is_gold_users'][$id][1]) {
            $options['soundcloud_is_gold_active_user'] = $options['soundcloud_is_gold_users'][$id][0];
          }
        }
  		}else{
        //If one key is numeric than we're good, just break the loop
        $updateNeeded = false;
        break;
      }
  	}
    //Update Settings
    if($updateNeeded) update_option('soundcloud_is_gold_options', $options);
    return $options;
  }
}

/**
 * Resolve usernames to get ids
 * $username: soundcloud username
 **/
function soundcloud_is_gold_user_info($username){
			//Get user id based on username
			$resolvedAPIurl = soundcloud_is_gold_resolve('https://www.soundcloud.com/'.$username);
			$soundcloudIsGoldApiResponse = get_soundcloud_is_gold_api_response($resolvedAPIurl);
      //Return user info
			return $soundcloudIsGoldApiResponse;
}

/**
 * Resolve
 * $url: url to resolve
 **/
function soundcloud_is_gold_resolve($url){
			//Get the new API url
			$soundcloudIsGoldApiCall = 'https://api.soundcloud.com/resolve.json?url='.$url.'&client_id='.CLIENT_ID;
      $soundcloudIsGoldApiResponse = get_soundcloud_is_gold_api_response($soundcloudIsGoldApiCall);
      //Return resolved url
      return $soundcloudIsGoldApiResponse['response']['location'];
}

/**
 * Get Soundcloud API Response (Json version)
 * $soundcloudIsGoldApiCall: API request (url)
 **/
function get_soundcloud_is_gold_api_response($soundcloudIsGoldApiCall){
	//Set Error default message && default Json state
	$soundcloudIsGoldRespError = false;
  //Check is cURL extension is loaded
	if(extension_loaded("curl")){
		// create a new cURL resource
		$soundcloudIsGoldCURL = curl_init();
		//Set cURL Options
		curl_setopt($soundcloudIsGoldCURL, CURLOPT_USERAGENT, "user_agent : FOOBAR");
		curl_setopt($soundcloudIsGoldCURL, CURLOPT_SSL_VERIFYPEER, false);// Disable SSL verification
		curl_setopt($soundcloudIsGoldCURL, CURLOPT_RETURNTRANSFER, true);// Will return the response, if false it print the response
		curl_setopt($soundcloudIsGoldCURL, CURLOPT_URL, $soundcloudIsGoldApiCall); // Set URL
		// Execute Curl
		$soundcloudIsGoldResponse = curl_exec($soundcloudIsGoldCURL);
		//Check for cURL errors
		if($soundcloudIsGoldResponse === false) $soundcloudIsGoldRespError = 'Curl error: ' . curl_error($soundcloudIsGoldCURL);
		//No cURL Errors: Load the call and captured Json returned by the API
		else {

		}
		// close cURL resource, and free up system resources
		curl_close($soundcloudIsGoldCURL);

	}
	//No cURL: Try loading the Json directly
	else $soundcloudIsGoldResponse = file_get_contents($soundcloudIsGoldApiCall);

  //Check for empty response as it mean the User could have blocked the API
  if(empty($soundCloudIsGoldResponseRawArray) || empty($soundcloudIsGoldRespError)) $soundcloudIsGoldRespError = __("<h2>Nothing was found</h2><small><strong>Disclaimer:</strong> This artist's label might be blocking access to the artist's tracks from outside Soundcloud.com and only allow embedding from Soundcloud.com. </br><strong>If you are the artist, please do get in touch on the <a href='https://wordpress.org/support/plugin/soundcloud-is-gold'>forum</a> to help me fix this issue</strong></small>", 'soundcloud-is-gold');

  //Add response and error to array
	$soundCloudIsGoldResponseRawArray = json_decode($soundcloudIsGoldResponse, true);
	$soundCloudIsGoldResponseArray = array('response' => $soundCloudIsGoldResponseRawArray, 'error' => $soundcloudIsGoldRespError);
	return $soundCloudIsGoldResponseArray;
}
/**
 * Get Soundcloud API Response (XML version)
 * $soundcloudIsGoldApiCall: API request (url)
 **/
function get_soundcloud_is_gold_api_response_xml($soundcloudIsGoldApiCall){
	//Set Error default message && default XML state
	$soundcloudIsGoldRespError = false;
	$soundcloudIsGoldResp = false;
	//Check is cURL extension is loaded
	if(extension_loaded("curl")){
		// create a new cURL resource
		$soundcloudIsGoldCURL = curl_init();
		//Set cURL Options
		curl_setopt($soundcloudIsGoldCURL, CURLOPT_URL, $soundcloudIsGoldApiCall);
		curl_setopt($soundcloudIsGoldCURL, CURLOPT_RETURNTRANSFER, true);//return a string
		curl_setopt($soundcloudIsGoldCURL, CURLOPT_USERAGENT, "user_agent : FOOBAR");
		// Get XML as a string
		$soundcloudIsGoldXmlString = curl_exec($soundcloudIsGoldCURL);
		//Check for cURL errors
		if($soundcloudIsGoldXmlString === false) $soundcloudIsGoldRespError = 'Curl error: ' . curl_error($soundcloudIsGoldCURL);
		//No cURL Errors: Load the call and captured xml returned by the API
		else $soundcloudIsGoldResp = simplexml_load_string($soundcloudIsGoldXmlString);
		// close cURL resource, and free up system resources
		curl_close($soundcloudIsGoldCURL);
	}
	//No cURL: Try loading the XML directly with simple_xml_load_file
	else $soundcloudIsGoldResp = simplexml_load_file($soundcloudIsGoldApiCall);

	//Add response and error to array
	$soundCloudIsGoldResponseArray = array('response' => $soundcloudIsGoldResp, 'error' => $soundcloudIsGoldRespError);
	return $soundCloudIsGoldResponseArray;
}
/*Pagination
soundcloud_is_gold_pagination($totalItems, $currentPage, $perPage)
*/
function soundcloud_is_gold_pagination($format, $totalItems, $currentPage, $perPage, $post_ID){

	// The items on the current page.
	$offset = ($currentPage - 1) * $perPage;
	$firstItem = $offset + 1;
	$lastItem = $offset + $perPage < $totalItems ? $offset + $perPage : $totalItems;

	// Some useful variables for making links.
	$firstPage = 1;
	$lastPage = ceil($totalItems / $perPage);
	$prevPage = $currentPage - 1 > 0 ? $currentPage - 1 : 1;
	$nextPage = $currentPage + 1 > $lastPage ? $lastPage : $currentPage + 1;

	$disableFirst = ($currentPage == $firstPage) ? ' disabled' : '';
	$disableLast = ($currentPage == $lastPage) ? ' disabled' : '';

	$output = '<div class="tablenav-pages"><span class="displaying-num">'.$totalItems.' '.__('tracks', 'soundcloud-is-gold').'</span>';
	$output .= '<span class="pagination-links">';
	$output .= '<a href="?post_id='.$post_ID.'&tab=soundcloud_is_gold&selectFormat='.$format.'&paged='.$firstPage.'&TB_iframe=1&width=640&height=584" title="Go to the first page" class="first-page'.$disableFirst.'">&laquo;</a>';
	$output .= '<a href="?post_id='.$post_ID.'&tab=soundcloud_is_gold&selectFormat='.$format.'&paged='.$prevPage.'&TB_iframe=1&width=640&height=584" title="Go to the previous page" class="prev-page'.$disableFirst.'">&lsaquo;</a>';
	$output .= '<span class="paging-input">'.__('page', 'soundcloud-is-gold') .' '.$currentPage.' '. __('of', 'soundcloud-is-gold').' <span class="total-pages">'.$lastPage.'</span></span>';
	$output .= '<a href="?post_id='.$post_ID.'&tab=soundcloud_is_gold&selectFormat='.$format.'&paged='.$nextPage.'&TB_iframe=1&width=640&height=584" title="Go to the next page" class="next-page'.$disableLast.'">&rsaquo;</a>';
	$output .= '<a href="?post_id='.$post_ID.'&tab=soundcloud_is_gold&selectFormat='.$format.'&paged='.$lastPage.'&TB_iframe=1&width=640&height=584" title="Go to the last page" class="last-page'.$disableLast.'">&raquo;</a>';
	$output .= '</span></div>';

	return $output;
}
/*Select Tracks / Favorites / Playlists
*/
function soundcloud_is_gold_select_tracks_favs_sets($selectedFormat, $soundcloudIsGoldNumbers, $post_ID){
	$formats = array('tracks', 'playlists', 'favorites');
	$output = '<ul id="soundcloudMMSelectTracksFavsSets" class="subsubsub">';
	foreach($formats as $key => $format){
		$current = ($format == $selectedFormat) ? 'current' : '';
		$seperator = ($key != 0) ? ' | ' : ' ';
		$output .= $seperator.'<li><a id="soundcloudMM-'.$format.'" href="?post_id='.$post_ID.'&tab=soundcloud_is_gold&selectFormat='.$format.'&paged=1" class="'.$current.'">'.$format.' <span class="count">('.$soundcloudIsGoldNumbers[$format].')</span></a></li>';
	}
	$output .= '</ul>';
	return $output;
}

/*Add Soundcloud is Gold Plugin to TinyMce*/
function soundcloud_is_gold_mce_plugin($plugin_array) {
    $plugin_array['soundcloudIsGold']  =  SIG_PLUGIN_DIR.'tinymce-plugin/soundcloud-is-gold-editor_plugin.js';
    return $plugin_array;
}
function soundcloud_is_gold_mce_button( $buttons ) {
	// add a separation before our button, here our button's id is "mygallery_button"
	array_push( $buttons, '|', 'soundcloudisgoldbtns' );
	return $buttons;
}
function soundcloud_is_gold_mce_css($mce_css) {
  if (! empty($mce_css)) $mce_css .= ',';
  $mce_css .= SIG_PLUGIN_DIR.'/tinymce-plugin/soundcloud-is-gold-editor_plugin.css';
  return $mce_css;
}

/* Random Values from Array */
function array_random($arr, $num = 1) {
    shuffle($arr);
    //check if requested number is bigger than array length
    if(count($arr) < $num){
	$tempArray = $arr;
	$repeat = ceil($num/count($arr));
	for($i=0; $i<$repeat; $i++){
		$arr = array_merge($arr, $tempArray);
	}
    }
    $r = array();
    for ($i = 0; $i < $num; $i++) {
        $r[] = $arr[$i];
    }
   // return $num == 1 ? $r[0] : $r;
   return $r;
}

/* Debug */
if(!function_exists('printl')){
	function printl($val){
		printf("<pre>%s</pre>", print_r($val, true));
	}
}

/*********************************************************************/
/***                                                               ***/
/***                   SOUNDCLOUD MEDIA UPLOAD TAB                 ***/
/***                                                               ***/
/*********************************************************************/
/* Add a new Tab */
function soundcloud_is_gold_media_upload_tab($tabs) {
	$newtab = array('soundcloud_is_gold' => __('Insert from Soundcloud', 'soundcloud_is_gold_tabname'));
	return array_merge($tabs, $newtab);
}
add_filter('media_upload_tabs', 'soundcloud_is_gold_media_upload_tab');

/* Add Scripts and Styles to New Tab **/
add_action('admin_print_scripts-media-upload-popup', 'soundcloud_is_gold_option_scripts', 2000);
add_action('admin_print_styles-media-upload-popup', 'soundcloud_is_gold_option_styles', 2000);


/* Soundcloud is Gold Tab (Iframe) content*/
function media_soundcloud_is_gold_process() {
	media_upload_header();
	get_soundcloud_is_gold_user_tracks();
}
/* load Iframe in the tab page */
function soundcloud_is_gold_media_menu_handle() {
    return wp_iframe( 'media_soundcloud_is_gold_process');
}
add_action('media_upload_soundcloud_is_gold', 'soundcloud_is_gold_media_menu_handle');


/*Add Soundcloud Button to Upload/Insert*/
function plugin_media_button($context) {
	global $post_ID;
	$plugin_media_button = ' %s' . '<a id="add_soundcloud_is_gold" title="Insert Soundcloud Player" href="media-upload.php?post_id='.$post_ID.'&tab=soundcloud_is_gold&selectFormat=tracks&paged=1&TB_iframe=1&width=640&height=584" class="thickbox"><img alt="Insert Soundcloud Player" src="'.SIG_PLUGIN_DIR.'images/soundcloud-is-gold-icon.png"></a>';
	return sprintf($context, $plugin_media_button);
  }
add_filter('media_buttons_context', 'plugin_media_button');

/** Populate the new Soundcloud is Gold Tab **/
function get_soundcloud_is_gold_user_tracks(){
  //Default Settings
	$options = get_option('soundcloud_is_gold_options');
  //Fix bug when updating to 2.4.2 where API requests can only use user id
  $options = soundcloud_is_gold_update_users($options);
	//printl($options);
	$soundcloudIsGoldActiveUser = isset($options['soundcloud_is_gold_active_user']) ? $options['soundcloud_is_gold_active_user'] : '';
	$soundcloudIsGoldUsers = isset($options['soundcloud_is_gold_users']) ? $options['soundcloud_is_gold_users'] : '';
	$soundcloudIsGoldSettings = isset($options['soundcloud_is_gold_settings']) ? $options['soundcloud_is_gold_settings'] : '';
	$soundcloudIsGoldWidthSettings = isset($options['soundcloud_is_gold_width_settings']) ? $options['soundcloud_is_gold_width_settings'] : '';
	$soundcloudIsGoldWidth = get_soundcloud_is_gold_default_width($soundcloudIsGoldWidthSettings);
  $soundcloudIsGoldHeightSettings = isset($options['soundcloud_is_gold_height_settings']) ? $options['soundcloud_is_gold_height_settings'] : '';
  $soundcloudIsGoldClasses = isset($options['soundcloud_is_gold_classes']) ? $options['soundcloud_is_gold_classes'] : '';
	$soundcloudIsGoldColor = isset($options['soundcloud_is_gold_color']) ? $options['soundcloud_is_gold_color'] : '';

	//Default Pagination Settings
	$soundcloudIsGoldTracksPerPage = 25;
	$soundcloudIsGoldPage = isset($_REQUEST['paged']) ? $_REQUEST['paged'] : '1';
	$post_id = no_more_XSS($_REQUEST['post_id']);
	$soundcloudIsGoldApiOffset = $soundcloudIsGoldTracksPerPage*($soundcloudIsGoldPage-1);

	//API Call
	$soundcloudIsGoldSelectedFormat = isset($_REQUEST['selectFormat']) ? no_more_XSS($_REQUEST['selectFormat']) : 'tracks';
  if($soundcloudIsGoldSelectedFormat == 'playlist') $soundcloudIsGoldSelectedFormat = 'playlists'; //when coming from the editor, format is taken from the shortcode where format = 'playlist'
  if($soundcloudIsGoldSelectedFormat == 'tracks') $soundcloudIsGoldApiCall = 'https://api.soundcloud.com/users/'.$soundcloudIsGoldActiveUser.'/tracks.json?limit='.$soundcloudIsGoldTracksPerPage.'&offset='.$soundcloudIsGoldApiOffset.'&client_id='.CLIENT_ID;
  if($soundcloudIsGoldSelectedFormat == 'playlists') $soundcloudIsGoldApiCall = 'https://api.soundcloud.com/users/'.$soundcloudIsGoldActiveUser.'/playlists.json?limit='.$soundcloudIsGoldTracksPerPage.'&offset='.$soundcloudIsGoldApiOffset.'&client_id='.CLIENT_ID;
	if($soundcloudIsGoldSelectedFormat == 'favorites') $soundcloudIsGoldApiCall = 'https://api.soundcloud.com/users/'.$soundcloudIsGoldActiveUser.'/favorites.json?limit='.$soundcloudIsGoldTracksPerPage.'&offset='.$soundcloudIsGoldApiOffset.'&client_id='.CLIENT_ID;
	$soundcloudIsGoldApiResponse = get_soundcloud_is_gold_api_response($soundcloudIsGoldApiCall);

	//Pagination and Actions
	$soundcloudIsGoldNumbers = get_soundcloudIsGoldUserNumber($soundcloudIsGoldSelectedFormat);
	$soundcloudIsGoldPagination = soundcloud_is_gold_pagination($soundcloudIsGoldSelectedFormat, $soundcloudIsGoldNumbers[$soundcloudIsGoldSelectedFormat], $soundcloudIsGoldPage, $soundcloudIsGoldTracksPerPage, $post_id);
	$soundcloudIsGoldSelectTracksFavsSets = soundcloud_is_gold_select_tracks_favs_sets($soundcloudIsGoldSelectedFormat, $soundcloudIsGoldNumbers, $post_id);
  $opened_track = isset($_REQUEST['track_id']) ? no_more_XSS($_REQUEST['track_id']) : false;


	//Usernames
	echo '<div class="soundcloudMMWrapper">';
		echo '<div id="soundcloudMMUsernameHeader"><img src="'.$soundcloudIsGoldUsers[$soundcloudIsGoldActiveUser][2].'" width="50" height="50"/><span>'.$soundcloudIsGoldUsers[$soundcloudIsGoldActiveUser][1].'</span> <a href="#" id="soundcloudMMShowUsernames">'.__('show users options', 'soundcloud-is-gold').'</a><a href="#" id="soundcloudMMHideUsernames" class="hidden">'.__('hide users options', 'soundcloud-is-gold').'</a></div>';
		echo '<div id="soundcloudMMUsermameTab">';
		get_soundcloud_is_gold_username_interface($options, $soundcloudIsGoldUsers);
	echo '</div></div>';

	echo '<div id="soundcloudMMTabActions" class="tablenav">';
		//Select Tracks / Playlists / Favs
		echo (isset($soundcloudIsGoldSelectTracksFavsSets)) ? $soundcloudIsGoldSelectTracksFavsSets : '';
		//Pagination
		echo (isset($soundcloudIsGoldPagination)) ? $soundcloudIsGoldPagination : '';
	echo '</div>';

	//Sorting Menu
	echo '<form id="library-form" class="media-upload-form validate" action="" method="post" enctype="multipart/form-data"><div id="media-items" class="media-items-'.$post_id.'">';
	?>

	<script type="text/javascript">
	<!--
	jQuery(function($){
    <?php
    $ot = (!$opened_track) ? 'false' : $opened_track;
    echo 'var opened_track = '.$ot.';';
    ?>
		var preloaded = $(".media-item.preloaded");
    var track_opened = false;
    if ( preloaded.length > 0 ) {
			preloaded.each(function(i){
        prepareMediaItem({id:this.id.replace(/[^0-9]/g, '')},'');
        if(opened_track!= false && !track_opened){
          myID = this.id.match(/[0-9]+./);
          if(opened_track == myID) {
            $('#show-'+myID).trigger("click");
            track_opened = true; // just so we don't keep on running this for nothing
          }
        }
        /*
        //Went through all, so must be a Favourite track
        if(i == preloaded.length-1){
          console.log('all done');
          $('#soundcloudMM-favorites').trigger("click");
        }*/
      });
		}
	});
	-->

	//Set default Soundcloud Is Gold Settings
	<?php get_soundcloud_is_gold_default_settings_for_js(); ?>


	</script>

	<?php
	if (isset($soundcloudIsGoldApiResponse['response']) && $soundcloudIsGoldApiResponse['response']) {
			foreach($soundcloudIsGoldApiResponse['response'] as $soundcloudIsGoldtrack): ?>

				<div class="media-item preloaded" id="media-item-<?php echo $soundcloudIsGoldtrack['id'] ?>">
					<a href="#" class="toggle describe-toggle-on soundcloudMM" id="show-<?php echo $soundcloudIsGoldtrack['id'] ?>"><?php _e('Show') ?></a>
					<a href="#" class="toggle describe-toggle-off soundcloudMM"><?php _e('Hide') ?></a>
					<div class="filename new"><span class="title soundcloudMMTitle" id="soundcloudMMTitle-<?php echo $soundcloudIsGoldtrack['id'] ?>"><?php echo $soundcloudIsGoldtrack['title'] ?></span></div>
					<table class="slidetoggle describe startclosed soundcloudMMWrapper soundcloudMMMainWrapper <?php echo $soundcloudIsGoldSelectedFormat ?>">
						<thead id="media-head-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="media-item-info">
							<tr valign="top">
								<td id="thumbnail-head-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="A1B1">
									<p><a href="<?php echo $soundcloudIsGoldtrack['permalink_url']?>" title="Go to the Soundcloud page" target="_blank"><img id="soundcloudMMThumb-<?php echo $soundcloudIsGoldtrack['id'] ?>" style="margin-top: 3px;" alt="" src="<?php echo ($soundcloudIsGoldtrack['artwork_url'] != '') ? $soundcloudIsGoldtrack['artwork_url'] : SIG_PLUGIN_DIR."images/noThumbnail.gif" ?>" class="thumbnail"></a></p>
								</td>
								<td>
								<p><strong><?php _e('Title:', 'soundcloud-is-gold') ?></strong> <?php echo $soundcloudIsGoldtrack['title'] ?></p>
								<p id="soundcloudMMId-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="soundcloudMMId"><strong><?php _e('id:', 'soundcloud-is-gold') ?></strong> <?php echo $soundcloudIsGoldtrack['id'] ?></p>
								<p><strong><?php _e('Upload date:', 'soundcloud-is-gold') ?></strong> <?php echo $soundcloudIsGoldtrack['created_at'] ?></p>
                <p><strong><?php _e('Duration:', 'soundcloud-is-gold') ?></strong> <span id="media-dims-<?php echo $soundcloudIsGoldtrack['id'] ?>"><?php echo round(($soundcloudIsGoldtrack['duration']/1000)/60, 2, PHP_ROUND_HALF_DOWN) ?></span></p>
								<p><strong><?php _e('Url:', 'soundcloud-is-gold') ?></strong> <a id="videoUrl-<?php echo $soundcloudIsGoldtrack['id'] ?>" href="<?php echo $soundcloudIsGoldtrack['permalink_url'] ?>" title="<?php _e('Go to the video page', 'soundcloud-is-gold') ?>" target="_blank"><?php echo $soundcloudIsGoldtrack['permalink_url']?></a></p>
								</td>
								<td>
								<tbody>
									<tr class="soundcloudMM_description">
										<th valign="top" class="label" scope="row"><label><span class="alignleft"><?php _e('Description', 'soundcloud-is-gold') ?></span><br class="clear"></label></th>
										<td class="field">
											<p class="text soundcloudMMDescription" id="soundcloudMMDescription-<?php echo $soundcloudIsGoldtrack['id'] ?>"><?php echo $soundcloudIsGoldtrack['description'] ?></p>
										</td>
									</tr>
									<tr class="soundcloudMM_settings">
										<th valign="top" class="label" scope="row"><label><span class="alignleft"><?php _e('Settings', 'soundcloud-is-gold') ?></span><br class="clear"></label></th>
										<td class="field">
											<input type="checkbox" <?php echo (isset($soundcloudIsGoldSettings[0]) ? $soundcloudIsGoldSettings[0] : 0) ? 'checked="checked"' : '' ?> id="soundcloudMMAutoPlay-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="text soundcloudMMAutoPlay">
											<label ><?php _e('Play Automaticly', 'soundcloud-is-gold') ?></label>
											<input type="checkbox" <?php echo (isset($soundcloudIsGoldSettings[1]) ? $soundcloudIsGoldSettings[1] : 0) ? 'checked="checked"' : '' ?> id="soundcloudMMShowComments-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="text soundcloudMMShowComments">
											<label ><?php _e('Show comments', 'soundcloud-is-gold') ?></label>
											<input type="checkbox" <?php echo (isset($soundcloudIsGoldSettings[2]) ? $soundcloudIsGoldSettings[2] : 0) ? 'checked="checked"' : '' ?> id="soundcloudMMShowArtwork-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="text soundcloudMMShowArtwork">
											<label ><?php _e('Show artwork', 'soundcloud-is-gold') ?></label>
                      <input type="checkbox" <?php echo (isset($soundcloudIsGoldSettings[3]) ? $soundcloudIsGoldSettings[3] : 0) ? 'checked="checked"' : '' ?> id="soundcloudMMShowVisual-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="text soundcloudMMShowVisual">
											<label ><?php _e('Full Visual', 'soundcloud-is-gold') ?> <small>(<?php _e('use soundcloud colors', 'soundcloud-is-gold') ?>)</small></label>
                      <input type="checkbox" <?php echo (isset($soundcloudIsGoldSettings[4]) ? $soundcloudIsGoldSettings[4] : 0) ? 'checked="checked"' : '' ?> id="soundcloudMMSForceMini-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="text soundcloudMMSForceMini">
											<label ><?php _e('Force Mini Player', 'soundcloud-is-gold') ?><small>(<?php _e('Artwork and comments won\'t show', 'soundcloud-is-gold') ?>)</small></label>
										</td>
									</tr>
									<tr class="soundcloudMM_size">
										<th valign="top" class="label" scope="row"><label><span class="alignleft"><?php _e('Width', 'soundcloud-is-gold') ?></span><br class="clear"></label></th>
										<td class="field">
											<ul id="soundcloudMMWidthSetting" class="subSettings texts soundcloudMMTabWidthSettings">
												<li>
												    <input name="soundcloudMMWidthType-<?php echo $soundcloudIsGoldtrack['id'] ?>" <?php echo ($soundcloudIsGoldWidthSettings['type'] == "wp") ? 'checked="checked"' : ''; ?> id="soundcloudMMWpWidth-<?php echo $soundcloudIsGoldtrack['id'] ?>" value="wp" type="radio" class="soundcloudMMWpWidth soundcloudMMWidthType"/><label for="soundcloudMMWpWidth-<?php echo $soundcloudIsGoldtrack['id'] ?>"><?php _e('Media Width', 'soundcloud-is-gold') ?></label>
												    <select class="soundcloudMMInput soundcloudMMWidth" name="soundcloud_is_gold_width_settings[wp]">
												    <?php foreach(get_soundcloud_is_gold_wordpress_sizes() as $key => $soundcloudIsGoldMediaSize) : ?>
													<?php $soundcloudIsGoldMediaSelected = ($soundcloudIsGoldMediaSize[0] == $soundcloudIsGoldWidthSettings['wp']) ? 'selected="selected"' : ''; ?>
													<option <?php echo $soundcloudIsGoldMediaSelected ?> value="<?php echo $soundcloudIsGoldMediaSize[0]?>" class="soundcloudMMWPSelectedWidth soundcloudMMWidth"><?php echo $key.': '.$soundcloudIsGoldMediaSize[0]?></option>
												    <?php endforeach; ?>
												    </select>
												</li>
												<li>
												    <input name="soundcloudMMWidthType-<?php echo $soundcloudIsGoldtrack['id'] ?>" <?php echo ($soundcloudIsGoldWidthSettings['type'] == "custom") ? 'checked="checked"' : ''; ?> id="soundcloudMMCustomWidth-<?php echo $soundcloudIsGoldtrack['id'] ?>" value="custom" type="radio" class="soundcloudMMCustomWidth soundcloudMMWidthType"/><label for="soundcloudMMCustomWidth-<?php echo $soundcloudIsGoldtrack['id'] ?>"><?php _e('Custom Width', 'soundcloud-is-gold') ?></label>
												    <input name="soundcloudMMCustomSelectedWidth-<?php echo $soundcloudIsGoldtrack['id'] ?>" id="soundcloudMMCustomSelectedWidth-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="soundcloudMMInput soundcloudMMWidth soundcloudMMCustomSelectedWidth" type="text" value="<?php echo $soundcloudIsGoldWidthSettings['custom'] ?>" />
												</li>
                        </ul>
                      </td>
                    </tr>
                    <tr class="soundcloudMM_size">
  									<th valign="top" class="label" scope="row"><label><span class="alignleft"><?php _e('Height', 'soundcloud-is-gold') ?></span><br class="clear"></label></th>
										<td class="field">
                        <ul id="soundcloudMMHeightSetting" class="subSettings texts soundcloudMMTabWidthSettings">
                          <li>
                            <label><?php _e('Playlist Height', 'soundcloud-is-gold') ?> <small>(<?php _e('leave empty for default, can\'t be less than 300px', 'soundcloud-is-gold') ?>)</small></label>
                            <input id="soundcloudMMPlaylistHeight" class="soundcloudMMInput soundcloudMMWidth soundcloudMMPlaylistHeight" type="text" name="soundcloud_is_gold_options[soundcloud_is_gold_height_settings][playlist]" value="<?php echo (isset($soundcloudIsGoldHeightSettings['playlist'])) ? $soundcloudIsGoldHeightSettings['playlist'] : ''?>" />
                          </li>
                          <li>
                          <input type="checkbox" <?php echo (isset($soundcloudIsGoldHeightSettings['square']) && $soundcloudIsGoldHeightSettings['square']) ? 'checked="checked"' : ''?> name="soundcloud_is_gold_options[soundcloud_is_gold_height_settings][square]" value="true" class="soundcloudMMSquareHeight" id="soundcloudMMSquareHeight"/>
                          <label for="soundcloudMMSquareHeight"><?php _e('Force Square Player', 'soundcloud-is-gold') ?> <small>(<?php _e('Visual', 'soundcloud-is-gold') ?>)</small></label>
                          </li>
											  </ul>
										</td>
									</tr>
									<tr class="soundcloudMM_color">
										<th valign="top" class="label" scope="row"><label><span class="alignleft"><?php _e('Colour', 'soundcloud-is-gold') ?></span><br class="clear"></label></th>
										<td class="field">
											<div class="soundcloudMMColorPickerContainer" id="soundcloudMMColorPickerContainer-<?php echo $soundcloudIsGoldtrack['id'] ?>">
												<input type="text" id="soundcloudMMColor-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="soundcloudMMColor" name="soundcloudMMColor-<?php echo $soundcloudIsGoldtrack['id'] ?>" value="<?php echo $soundcloudIsGoldColor ?>" style="background-color:<?php echo $soundcloudIsGoldColor ?>"/><a href="#" class="soundcloudMMBt soundcloudMMBtSmall inline blue soundcloudMMRounder soundcloudMMResetColor"><?php _e('reset to default', 'soundcloud-is-gold') ?></a>
												<div id="soundcloudMMColorPicker-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="shadow soundcloudMMColorPicker" ><div id="soundcloudMMColorPickerSelect-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="soundcloudMMColorPickerSelect"></div><a id="soundcloudMMColorPickerClose-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="blue soundcloudMMBt soundcloudMMColorPickerClose"><?php _e('done', 'soundcloud-is-gold') ?></a></div>
											</div>
										</td>
									</tr>
									<tr class="soundcloudMM_classes">
										<th valign="top" class="label" scope="row"><label><span class="alignleft"><?php _e('Extra CSS classes', 'soundcloud-is-gold') ?></span><br class="clear"></label></th>
										<td class="field">
											<input type="text" class="text soundcloudMMClasses" id="soundcloudMMClasses-<?php echo $soundcloudIsGoldtrack['id'] ?>" value="<?php echo $soundcloudIsGoldClasses ?>">
											<p class="help"><?php _e('In case you need extra css classes (seperate with a space, no commas!)', 'soundcloud-is-gold') ?></p>
										</td>
									</tr>
									<tr class="soundcloudMM_player">
										<th valign="top" class="label" scope="row"><label><span class="alignleft"><?php _e('Preview', 'soundcloud-is-gold') ?></span><br class="clear"></label></th>
										<td>
											<p id="soundcloudMMEmbed-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="field soundcloudMMEmbed" style="text-align:center">
												<!-- Soundcloud Preview here -->
											</p>
											<p class="soundcloudMMLoading soundcloudMMPreviewLoading" style="display:none"></p>
										</td>
									</tr>
									<tr class="soundcloudMM_shortcode">
										<th valign="top" class="label" scope="row"><label><span class="alignleft"><?php _e('Shortcode', 'soundcloud-is-gold') ?></span><br class="clear"></label></th>
										<td class="field">
											<input id="soundcloudMMShortcode-<?php echo $soundcloudIsGoldtrack['id'] ?>" type="text" class="text soundcloudMMShortcode" value="[soundcloud <?php echo "id='".$soundcloudIsGoldtrack['id'] ?>']">
										</td>
									</tr>
									 <tr class="soundcloudMM_submit">
										<td></td>
										<td class="savesend">
											<a href="#" id="soundcloudMMInsert-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="button soundcloudMMInsert"><?php _e('Insert Soundcloud Player', 'soundcloud-is-gold') ?></a>

											<!-- <input type="submit" value="Insert into Post" name="" class="button"> -->
											<!-- <input type="button" id="soundcloudMMAddToGallery-<?php echo $soundcloudIsGoldtrack['id'] ?>" value="Add to post's gallery" name="" class="button soundcloudMMAddToGallery">
											<a href="#" id="soundcloudMMFeat-<?php echo $soundcloudIsGoldtrack['id'] ?>" class="soundcloudMMFeat">Use as featured Soundcloud</a> -->

										</td>
									</tr>
								</tbody>
								</td>
							</tr>
						</thead>
					</table>
				</div>
			<?php endforeach;
		}
		//Error getting json
		else{
			if($soundcloudIsGoldApiResponse['error'] === false) $soundcloudIsGoldApiResponse['error'] = 'Json error';
			echo '<div class="soundcloudMMJsonError">'.$soundcloudIsGoldApiResponse['error'].'</div>';
		}
	echo '<div id="colorpicker"></div>';
	echo '</div></form>';
}





/******************************************************/
/**                                                  **/
/**                     SHORTCODE                    **/
/**                                                  **/
/******************************************************/
//kill any other shortcode called "soundcloud" before hand
//if ( shortcode_exists( 'soundcloud' ) ) remove_shortcode('soundcloud');
//Add Soundcloud shortcode
add_shortcode('soundcloud', 'soundcloud_is_gold_shortcode');

function soundcloud_is_gold_shortcode($atts){
	$options = get_option('soundcloud_is_gold_options');
	$soundcloudIsGoldSettings = isset($options['soundcloud_is_gold_settings']) ? $options['soundcloud_is_gold_settings'] : '';
	$soundcloudIsGoldWidthSettings = isset($options['soundcloud_is_gold_width_settings']) ? $options['soundcloud_is_gold_width_settings'] : '';
  $soundcloudIsGoldHeightSettings = isset($options['soundcloud_is_gold_height_settings']) ? $options['soundcloud_is_gold_height_settings'] : '';
  $soundcloudIsGoldClasses = isset($options['soundcloud_is_gold_classes']) ? $options['soundcloud_is_gold_classes'] : '';
	$soundcloudIsGoldColor = isset($options['soundcloud_is_gold_color']) ? $options['soundcloud_is_gold_color'] : '';

  //Only use lowercase as atts!
	extract( shortcode_atts( array(
					'id' => '1',
					'user' => 'null',
					'autoplay' => ((!isset($soundcloudIsGoldSettings[0]) || $soundcloudIsGoldSettings[0] == '') ? 'false' : 'true'),
					'comments' => ((!isset($soundcloudIsGoldSettings[1]) || $soundcloudIsGoldSettings[1] == '') ? 'false' : 'true'),
					'artwork' => ((!isset($soundcloudIsGoldSettings[2]) || $soundcloudIsGoldSettings[2] == '') ? 'false' : 'true'),
          'visual' => ((!isset($soundcloudIsGoldSettings[3]) || $soundcloudIsGoldSettings[3] == '') ? 'false' : 'true'),
          'mini' => ((!isset($soundcloudIsGoldSettings[4]) || $soundcloudIsGoldSettings[4] == '') ? 'false' : 'true'),
    			'width' => get_soundcloud_is_gold_default_width($soundcloudIsGoldWidthSettings),
          'height' => ((!isset($soundcloudIsGoldHeightSettings['square']) || $soundcloudIsGoldHeightSettings['square'] == '') ? 'false' : 'true'),
          'playlistheight' => ((!isset($soundcloudIsGoldHeightSettings['playlist']) || $soundcloudIsGoldHeightSettings['playlist'] == '') ? '' : $soundcloudIsGoldHeightSettings['playlist']),
          'classes' => $soundcloudIsGoldClasses,
					'color' => $soundcloudIsGoldColor,
					'format' => 'tracks'
				), $atts )
		);

	return soundcloud_is_gold_player($id, $user, $autoplay, $comments, $width, $height, $playlistheight, $classes, $color, $artwork, $visual, $mini, $format);
}


/******************************************************/
/**                                                  **/
/**                     OUTPUT                       **/
/**                                                  **/
/******************************************************/


/** The Player **/
function soundcloud_is_gold_player($id, $user, $autoPlay, $comments, $width, $height, $playlistHeight, $classes, $color, $artwork, $visual, $mini, $format){

	$options = get_option('soundcloud_is_gold_options');

	$soundcloudIsGoldSettings = isset($options['soundcloud_is_gold_settings']) ? $options['soundcloud_is_gold_settings'] : '';
	$soundcloudIsGoldWidthSettings = isset($options['soundcloud_is_gold_width_settings']) ? $options['soundcloud_is_gold_width_settings'] : '';
  $soundcloudIsGoldHeightSettings = isset($options['soundcloud_is_gold_height_settings']) ? $options['soundcloud_is_gold_height_settings'] : '';
  $soundcloudIsGoldClasses = isset($options['soundcloud_is_gold_classes']) ? $options['soundcloud_is_gold_classes'] : '';
	$soundcloudIsGoldColor = isset($options['soundcloud_is_gold_color']) ? $options['soundcloud_is_gold_color'] : '';

	//Default values: Needed when not called trough shortode (like in the ajax preview)
	if(!isset($autoPlay)) $autoPlay = ((!isset($soundcloudIsGoldSettings[0]) || $soundcloudIsGoldSettings[0] == '') ? 'false' : 'true');
	if(!isset($comments)) $comments = ((!isset($soundcloudIsGoldSettings[1]) || $soundcloudIsGoldSettings[1] == '') ? 'false' : 'true');
	if(!isset($artwork)) $artwork = ((!isset($soundcloudIsGoldSettings[2]) || $soundcloudIsGoldSettings[2] == '') ? 'false' : 'true');
  if(!isset($visual)) $visual = ((!isset($soundcloudIsGoldSettings[3]) || $soundcloudIsGoldSettings[3] == '') ? 'false' : 'true');
  if(!isset($mini)) $mini = ((!isset($soundcloudIsGoldSettings[4]) || $soundcloudIsGoldSettings[4] == '') ? 'false' : 'true');
  if(!isset($width)) $width = get_soundcloud_is_gold_default_width($soundcloudIsGoldWidthSettings);
  if(!isset($height)) $height = ((!isset($soundcloudIsGoldHeightSettings['square']) || $soundcloudIsGoldHeightSettings['square'] == '') ? 'false' : 'true');
  if(!isset($playlistHeight)) $playlistHeight = ((!isset($soundcloudIsGoldHeightSettings['playlist']) || $soundcloudIsGoldHeightSettings['playlist'] == '') ? '' : $soundcloudIsGoldHeightSettings['playlist']);
  if(!isset($classes)) $classes = $soundcloudIsGoldClasses;
	if(!isset($color)) $color = $soundcloudIsGoldColor;
	if(!isset($format)) $format = 'tracks';

  //Format logic
	if($format == 'playlists' || $format == 'playlist') $format = 'playlists';
  //Fix for people updating from 2.3.3 when widgets settings were using "sets" for "playlists"
  if($format == 'sets' || $format == 'set') $format = 'playlists';

	$color = str_replace('#', '', $color);

	//In case of requesting latest track
	if(isset($user) && $user != "null"){
		$returnedId = get_soundcloud_is_gold_latest_track_id($user, $format);
		if($returnedId != "") $id = $returnedId;
	}

  //Reset Favorites to tracks as soundcloud treats them as tracks.
  if($format == 'favorites') $format = "tracks";


  //Height Logic (Include force square)
  if($height == 'true' && $visual == 'true')  $height = '450px';
  else{
    if($format == 'tracks') $height =  '166px';
    else{
      //Default height
      if ($playlistHeight == "" ) $height = '450px';
      //Custom height
      else $height =  trim($playlistHeight);
    }
  }


  //Force Mini Player (only for tracks)
  if($mini == 'true' && $format == 'tracks') $height = '20px';

  //Html5 Player
	$player = '<div class="soundcloudIsGold '.esc_attr($classes).'" id="soundcloud-'.esc_attr($id).'">';
	$player .= '<iframe width="'.esc_attr($width).'" height="'.esc_attr($height).'" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A%2F%2Fapi.soundcloud.com%2F'.esc_attr($format).'%2F'.esc_attr($id).'&amp;auto_play='.esc_attr($autoPlay).'&amp;show_artwork='.esc_attr($artwork).'&amp;color='.esc_attr($color).'&amp;visual='.esc_attr($visual).'&amp;show_comments='.esc_attr($comments).'"></iframe>';
  $player .= '</div>';

	return $player;

}


/*******************/
/*                 */
/*   XSS Protect   */
/*                 */
/*******************/
/**
 * XSS Protection on data coming from fields
 * data = value coming from a field
 * return cleaned data
 **/

function no_more_XSS($data){
	$xssBlackList = "/^[A-Za-z0-9 \,]{2,15}$/";
	//$check = preg_match($xssBlackList, $data);
	$d = strip_tags($data);
	return $d;

}


/*******************************************/
/**                                       **/
/**                  AJAX                 **/
/**                                       **/
/*******************************************/
/** Preview **/
add_action('wp_ajax_soundcloud_is_gold_player_preview', 'soundcloud_is_gold_player_preview');
function soundcloud_is_gold_player_preview(){
	if(isset($_POST['request'])) echo soundcloud_is_gold_player(no_more_XSS($_POST['ID']), no_more_XSS($_POST['user']), no_more_XSS($_POST['autoPlay']), no_more_XSS($_POST['comments']), no_more_XSS($_POST['width']), no_more_XSS($_POST['height']), no_more_XSS($_POST['playlistHeight']), no_more_XSS($_POST['classes']), no_more_XSS($_POST['color']), no_more_XSS($_POST['artwork']), no_more_XSS($_POST['visual']), no_more_XSS($_POST['mini']), no_more_XSS($_POST['format']));
	die;
}
/** viewer Ajax **/
/*add_action('wp_ajax_get_soundcloud_player', 'get_soundcloud_player');
add_action('wp_ajax_nopriv_get_soundcloud_player', 'get_soundcloud_player');
function get_soundcloud_player(){
  echo soundcloud_is_gold_player(no_more_XSS($_POST['id']), no_more_XSS($_POST['width']), no_more_XSS($_POST['comments']), no_more_XSS($_POST['autoPlay']), no_more_XSS($_POST['visual']), no_more_XSS($_POST['color']), no_more_XSS($_POST['format']));
	die();
}*/

/** Add username **/
add_action('wp_ajax_soundcloud_is_gold_add_user', 'soundcloud_is_gold_add_user');
function soundcloud_is_gold_add_user(){
	if(isset($_POST['request'])){
    //Set return to error by default
    $return = 'error';
    //If username is blank kill it
    if (empty($_POST['username'])) {
      echo $return;
      die;
    }
    //Get options
    $options = get_option('soundcloud_is_gold_options');
    //Replace spaces with hyphen in case users enter their name without it
    $newUsername = str_replace(" ", "-", trim($_POST['username']));
    //Trim the soundcloud url in case the user enters the full url
    $newUsername = str_replace("https://soundcloud.com/", "", $newUsername);
    //Get user info
    $userInfo = soundcloud_is_gold_user_info($newUsername);
    //Check that plugin's options are in place and that we've got $userinfo
		if(isset($options['soundcloud_is_gold_users']) && isset($userInfo)){
      //Set Info to keep
      $newUserId = $userInfo['response']['id'];
      $newUsername = $userInfo['response']['permalink'];
      $newUsernameImg = $userInfo['response']['avatar_url'];
			//Check if id doesn't exist already
			if(!array_key_exists($newUserId, $options['soundcloud_is_gold_users'])){
					$return = '<li class="soundcloudIsGoldUserContainer" style="background-image:URL('.$newUsernameImg.')">';
					$return .= '<span class="soundcloudIsGoldRemoveUser" />&nbsp;</span>';
					$return .= '<div>';
          $return .= '<input type="hidden" value="'.$newUserId.'" name="soundcloud_is_gold_options[soundcloud_is_gold_users]['.$newUserId.'][0]" />';
          $return .= '<input type="hidden" value="'.$newUsername.'" name="soundcloud_is_gold_options[soundcloud_is_gold_users]['.$newUserId.'][1]" />';
					$return .= '<input type="hidden" value="'.$newUsernameImg.'" name="soundcloud_is_gold_options[soundcloud_is_gold_users]['.$newUserId.'][2]" />';
					$return .= '<p>'.$newUsername.'</p>';
					$return .= '</div>';
					$return .= '</li>';

					//Tab: extra actions
					if($_POST['updateOption'] == '1'){
						$options['soundcloud_is_gold_users'][$newUserId][0] = $newUserId;
            $options['soundcloud_is_gold_users'][$newUserId][1] = $newUsername;
						$options['soundcloud_is_gold_users'][$newUserId][2] = $newUsernameImg;
						update_option( 'soundcloud_is_gold_options', $options );
					}
			}
			echo $return;
		}
	}
	die;
}
/** Set Active User **/
add_action('wp_ajax_soundcloud_is_gold_set_active_user', 'soundcloud_is_gold_set_active_user');
function soundcloud_is_gold_set_active_user(){
	$message = 'error';
	if(isset($_POST['request'])){
		$options = get_option('soundcloud_is_gold_options');
		if(isset($options['soundcloud_is_gold_active_user'])){
			//Check if userid exist and is not blank
			if(!empty($_POST['userid']) && array_key_exists($_POST['userid'], $options['soundcloud_is_gold_users'])){
				$options['soundcloud_is_gold_active_user'] = $_POST['userid'];
				update_option( 'soundcloud_is_gold_options', $options );
				$message = 'done';
			}
		}
	}
	echo $message;
	die;
}
/** Delete User **/
add_action('wp_ajax_soundcloud_is_gold_delete_user', 'soundcloud_is_gold_delete_user');
function soundcloud_is_gold_delete_user(){
	$message = 'error';
	if(isset($_POST['request'])){
		$options = get_option('soundcloud_is_gold_options');
		if(isset($options['soundcloud_is_gold_active_user'])){
			//Check username exist and isn't blank
			if(!empty($_POST['userid']) && array_key_exists($_POST['userid'], $options['soundcloud_is_gold_users'])){
				//Remove from users
				unset($options['soundcloud_is_gold_users'][$_POST['userid']]);
				//If active user, set the first element to be active
				if($options['soundcloud_is_gold_active_user'] == $_POST['userid']){
					$newActiveUser = array_shift(array_values($options['soundcloud_is_gold_users']));
					$options['soundcloud_is_gold_active_user'] = $newActiveUser[0];
				}
				update_option( 'soundcloud_is_gold_options', $options );
				$message = 'done';
			}
		}
	}

	echo $message;
	die;
}




/********************************/
/*                              */
/*          Templating          */
/*                              */
/********************************/

function soundcloud_options_header(){ ?>
  <script type="text/javascript">
    //Set default Soundcloud Is Gold Settings
    <?php get_soundcloud_is_gold_default_settings_for_js(); ?>
  </script>


  <!-- XXS test -->
  <!-- <form method="POST" action="
  http://localhost/~thomas/Others/dev/wp-admin/admin-ajax.php?action=get_soundcloud_player" />
  <input type="text" name="id" value='"></param></object><img src=xonerror=alert(1) />' />
  <input type="text" name="format" value="1">
  <input type="submit" name="submit" />
  </form> -->

  <div class="soundcloudMMWrapper soundcloudMMOptions soundcloudMMMainWrapper">
    <!-- Survey -->
    <!-- a href="/" id="soundcloudMMSurvey" class="button-primary" target="_blank" >Help me make a better plugin by taking this super short survey ></a -->
    <!-- Header -->
    <div id="soundcloudMMTop">
      <div class="leftPart">
        <img id="soundcloudMMPowered" width="104" height="32" src="https://developers.soundcloud.com/assets/powered_by_black-4339b4c3c9cf88da9bfb15a16c4f6914.png">
        <h1>SoundCloud is gold <small>v<?php echo get_soundcloud_is_gold_version($options) ?></small></h1>
        <p><?php _e('This is your main options page. You can set a default styling for your site and link to your soundcloud accounts.', 'soundcloud-is-gold') ?></p>
      </div>
      <div class="rightPart">
        <ul id="soundcloudMMExtras" class="">
            <li><a href="https://wordpress.org/support/plugin/soundcloud-is-gold" target="_blank" title="Soundcloud is Gold Forum" class="soundcloudMMBt button-primary"><?php _e('Problems? Support Forum', 'soundcloud-is-gold') ?></a></li>
            <li>
            <form class="soundcloudMMBtForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="9VGA6PYQWETGY">
                    <input type="submit" name="submit" value="<?php _e('Keep this plugin alive with a donation', 'soundcloud-is-gold') ?>" class="soundcloudMMBt button-primary" alt="PayPal - The safer, easier way to pay online.">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                </form>
            </li>
        </ul>
      </div>
    </div>
    <!-- Main -->
        <div id="soundcloudMMMain" class="">
          <?php
            //Soundcloud doesn't allow for asking new API keys, so on hold until then
            //$active_options_page = $_GET['page'];
          ?>
          <!-- <h2 class="nav-tab-wrapper">
            <a href="admin.php?page=soundcloud-is-gold/soundcloud-is-gold.php" class="nav-tab <?php echo $active_options_page == 'soundcloud-is-gold/soundcloud-is-gold.php' ? 'nav-tab-active' : ''; ?>">Main Options</a>
            <a href="admin.php?page=soundcloud_is_gold_advance_options" class="nav-tab <?php echo $active_options_page == 'soundcloud_is_gold_advance_options' ? 'nav-tab-active' : ''; ?>">Advance Options</a>
          </h2> -->
<?php }


function soundcloud_options_footer(){ ?>
  </div> <!-- Closing #soundcloudMMMain -->
  <p id="disclaimer"><?php _e('SoundCloud and SoundCloud Logo are trademarks of SoundCloud Ltd.', 'soundcloud-is-gold') ?></p>
  </div> <!-- Closing #soundcloudMMWrapper -->
<?php }
?>
