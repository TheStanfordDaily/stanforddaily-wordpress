<?php
define ( 'JS_PATH' , get_template_directory_uri().'/panel/shortcodes/customcodes.js');


add_action('admin_head','html_quicktags');
function html_quicktags() {

	$output = "<script type='text/javascript'>\n
	/* <![CDATA[ */ \n";
	wp_print_scripts( 'quicktags' );

	$buttons = array();
	
	/*$buttons[] = array(
		'name' => 'raw',
		'options' => array(
			'display_name' => 'raw',
			'open_tag' => '\n[raw]',
			'close_tag' => '[/raw]\n',
			'key' => ''
	));*/

	$buttons[] = array(
		'name' => 'review',
		'options' => array(
			'display_name' => 'Review Overview',
			'open_tag' => '\n[review]',
			'close_tag' => '',
			'key' => ''
	));

	$buttons[] = array(
		'name' => 'ads1',
		'options' => array(
			'display_name' => 'ADS1',
			'open_tag' => '\n[ads1]',
			'close_tag' => '',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'ads2',
		'options' => array(
			'display_name' => 'ADS2',
			'open_tag' => '\n[ads2]',
			'close_tag' => '',
			'key' => ''
	));

	$buttons[] = array(
		'name' => 'is_logged_in',
		'options' => array(
			'display_name' => 'is logged in',
			'open_tag' => '\n[is_logged_in]',
			'close_tag' => '[/is_logged_in]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'is_guest',
		'options' => array(
			'display_name' => 'is guest',
			'open_tag' => '\n[is_guest]',
			'close_tag' => '[/is_guest]\n',
			'key' => ''
	));

		
	$buttons[] = array(
		'name' => 'one_third',
		'options' => array(
			'display_name' => 'one third',
			'open_tag' => '\n[one_third]',
			'close_tag' => '[/one_third]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'one_third_last',
		'options' => array(
			'display_name' => 'one third last',
			'open_tag' => '\n[one_third_last]',
			'close_tag' => '[/one_third_last]\n',
			'key' => ''
	));
			
	$buttons[] = array(
		'name' => 'two_third',
		'options' => array(
			'display_name' => 'two third',
			'open_tag' => '\n[two_third]',
			'close_tag' => '[/two_third]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'two_third_last',
		'options' => array(
			'display_name' => 'two third last',
			'open_tag' => '\n[two_third_last]',
			'close_tag' => '[/two_third_last]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'one_half',
		'options' => array(
			'display_name' => 'one half',
			'open_tag' => '\n[one_half]',
			'close_tag' => '[/one_half]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'one_half_last',
		'options' => array(
			'display_name' => 'one half last',
			'open_tag' => '\n[one_half_last]',
			'close_tag' => '[/one_half_last]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'one_fourth',
		'options' => array(
			'display_name' => 'one fourth',
			'open_tag' => '\n[one_fourth]',
			'close_tag' => '[/one_fourth]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'one_fourth_last',
		'options' => array(
			'display_name' => 'one fourth last',
			'open_tag' => '\n[one_fourth_last]',
			'close_tag' => '[/one_fourth_last]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'three_fourth',
		'options' => array(
			'display_name' => 'three fourth',
			'open_tag' => '\n[three_fourth]',
			'close_tag' => '[/three_fourth]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'three_fourth_last',
		'options' => array(
			'display_name' => 'three fourth last',
			'open_tag' => '\n[three_fourth_last]',
			'close_tag' => '[/three_fourth_last]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'one_fifth',
		'options' => array(
			'display_name' => 'one fifth',
			'open_tag' => '\n[one_fifth]',
			'close_tag' => '[/one_fifth]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'one_fifth_last',
		'options' => array(
			'display_name' => 'one fifth last',
			'open_tag' => '\n[one_fifth_last]',
			'close_tag' => '[/one_fifth_last]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'two_fifth',
		'options' => array(
			'display_name' => 'two fifth',
			'open_tag' => '\n[two_fifth]',
			'close_tag' => '[/two_fifth]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'two_fifth_last',
		'options' => array(
			'display_name' => 'two fifth last',
			'open_tag' => '\n[two_fifth_last]',
			'close_tag' => '[/two_fifth_last]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'three_fifth',
		'options' => array(
			'display_name' => 'three fifth',
			'open_tag' => '\n[three_fifth]',
			'close_tag' => '[/three_fifth]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'three_fifth_last',
		'options' => array(
			'display_name' => 'three fifth last',
			'open_tag' => '\n[three_fifth_last]',
			'close_tag' => '[/three_fifth_last]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'four_fifth',
		'options' => array(
			'display_name' => 'four fifth',
			'open_tag' => '\n[four_fifth]',
			'close_tag' => '[/four_fifth]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'four_fifth_last',
		'options' => array(
			'display_name' => 'four fifth last',
			'open_tag' => '\n[four_fifth_last]',
			'close_tag' => '[/four_fifth_last]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'one_sixth',
		'options' => array(
			'display_name' => 'one sixth',
			'open_tag' => '\n[one_sixth]',
			'close_tag' => '[/one_sixth]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'one_sixth_last',
		'options' => array(
			'display_name' => 'one sixth last',
			'open_tag' => '\n[one_sixth_last]',
			'close_tag' => '[/one_sixth_last]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'five_sixth',
		'options' => array(
			'display_name' => 'five sixth',
			'open_tag' => '\n[five_sixth]',
			'close_tag' => '[/five_sixth]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'five_sixth_last',
		'options' => array(
			'display_name' => 'five sixth last',
			'open_tag' => '\n[five_sixth_last]',
			'close_tag' => '[/five_sixth_last]\n',
			'key' => ''
	));
		
			
	for ($i=0; $i <= (count($buttons)-1); $i++) {
		$output .= "edButtons[edButtons.length] = new edButton('ed_{$buttons[$i]['name']}'
			,'{$buttons[$i]['options']['display_name']}'
			,'{$buttons[$i]['options']['open_tag']}'
			,'{$buttons[$i]['options']['close_tag']}'
			,'{$buttons[$i]['options']['key']}'
		); \n";
	}
	
	$output .= "\n /* ]]> */ \n
	</script>";
	echo $output;
}



function tie_custom_addbuttons() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;

	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_tcustom_tinymce_plugin");
		add_filter('mce_buttons_3', 'register_tcustom_button');
	}
}
function register_tcustom_button($buttons) {
	array_push(
		$buttons,
		"AddBox",
		"AddButtons",
		"Tabs",
		"Toggle",
		"AuthorBio",
		"|",		
		"AddFlickr",
		//"AddTwitter",
		"AddFeeds",
		"AddMap",
		"|",
		"highlight",
		"dropcap",
		"|",
		"checklist",
		"starlist",
		"|",
		"Video",
		"Audio",
		"LightBox",
		"|",
		"Tooltip",
		"ShareButtons",
		"divider"	); 
	return $buttons;
} 
function add_tcustom_tinymce_plugin($plugin_array) {
	$plugin_array['tieShortCodes'] = JS_PATH;
	return $plugin_array;
}
add_action('init', 'tie_custom_addbuttons');




## Ads1 -------------------------------------------------- #
function tie_shortcode_ads1( $atts, $content = null ) {
	$out ='<div class="ads-in-post1">'. htmlspecialchars_decode(tie_get_option( 'ads1_shortcode' )) .'</div>';
   return $out;
}
add_shortcode('ads1', 'tie_shortcode_ads1');


## Ads2 -------------------------------------------------- #
function tie_shortcode_ads2( $atts, $content = null ) {
	$out ='<div class="ads-in-post2">'. htmlspecialchars_decode(tie_get_option( 'ads2_shortcode' )) .'</div>';
   return $out;
}
add_shortcode('ads2', 'tie_shortcode_ads2');


## Boxes -------------------------------------------------- #
function tie_shortcode_box( $atts, $content = null ) {
    @extract($atts);

	$type =  ($type)  ? ' '.$type  :'shadow' ;
	$align = ($align) ? ' '.$align : '';
	$class = ($class) ? ' '.$class : '';
	$width = ($width) ? ' style="width:'.$width.'"' : '';

	$out = '<div class="box'.$type.$class.$align.'"'.$width.'><div class="box-inner-block"><i class="tieicon-boxicon"></i>
			' .do_shortcode($content). '
			</div></div>';
    return $out;
}
add_shortcode('box', 'tie_shortcode_box');


## Lightbox -------------------------------------------------- #
function tie_shortcode_lightbox( $atts, $content = null ) {
    @extract($atts);

	$out = '<a rel="prettyPhoto" href="'.$full.'" title="'.$title.'">' .do_shortcode($content). '</a>';
    return $out;
}
add_shortcode('lightbox', 'tie_shortcode_lightbox');


## Toggle -------------------------------------------------- #
function tie_shortcode_Toggle( $atts, $content = null ) {
    @extract($atts);

	$state =  ($state)  ? ' '.$state  :' open' ;
	$title = ($title) ? ' '.$title : '';

	$out = '<div class="clear"></div><div class="toggle '.$state.'"><h3 class="toggle-head-open">'.$title.'<i class="tieicon-up"></i></h3><h3 class="toggle-head-close">'.$title.'<i class="tieicon-down"></i></h3><div class="toggle-content">
			' .do_shortcode($content). '
			</div></div>';
    return $out;
}
add_shortcode('toggle', 'tie_shortcode_Toggle');



## Author_info -------------------------------------------------- #
function tie_shortcode_Author_info( $atts, $content = null ) {
    @extract($atts);

	$title = ($title) ? ' '.$title : '';

	$out = '<div class="clear"></div><div class="author-info"><img class="author-img" src="'.$image.'" alt="" /><div class="author-info-content"><h3>'. __('About The Author' , 'tie').'</h3>
			' .do_shortcode($content). '
			</div></div>';
    return $out;
}
add_shortcode('author', 'tie_shortcode_Author_info');



## Buttons -------------------------------------------------- #
function tie_shortcode_button( $atts, $content = null ) {
    @extract($atts);

	$size  = ($size)  ? ' '.$size  :' small' ;
	$color = ($color) ? ' '.$color : ' gray';
	$link  = ($link) ? ' '.$link : '';
	$target = ($target) ? ' target="_blank"' : '';

	$out = '<a href="'.$link.'"'.$target.' class="shortc-button'.$size.$color.$align.'">' .do_shortcode($content). '</a>';
    return $out;
}
add_shortcode('button', 'tie_shortcode_button');


## Flickr -------------------------------------------------- #
function tie_shortcode_flickr( $atts, $content = null ) {
    @extract($atts);

	$number  = ($number)  ? $number  : '5' ;
	$orderby = ($orderby) ? $orderby : 'random';

	$out = '<div class="flickr-wrapper">
	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='. $number .'&amp;display='. $orderby .'&amp;size=s&amp;layout=x&amp;source=user&amp;user='. $id .'"></script>
	</div>';       

    return $out;
}
add_shortcode('flickr', 'tie_shortcode_flickr');


## Twitter -------------------------------------------------- #
function tie_shortcode_twitter( $atts, $content = null ) {
    @extract($atts);
	
	wp_enqueue_script( 'tie-tweet' );

	$number  = ($number)  ? $number  : '5' ;
	if($avatar == "true") $avatar = "avatar_size:32," ;
	else $avatar = "" ;

	$out = '
		<div id="twitter-shortcode">
			<div class="tweet-shortcode"></div>
		</div>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".tweet-shortcode").tweet({
						username: "'. $id .'",
						'.$avatar .'
						count: '. $number .',
						loading_text: " loading tweets..." ,
					});
				});
			</script>

';       

    return $out;
}
add_shortcode('twitter', 'tie_shortcode_twitter');


## Reviews -------------------------------------------------- #
function tie_shortcode_review( $atts, $content = null ) {
	ob_start();
	tie_get_review( 'review-bottom' );
	$output = ob_get_contents();
	ob_end_clean();
	return $output; 
}
add_shortcode('review', 'tie_shortcode_review');

## Feeds -------------------------------------------------- #
function tie_shortcode_feeds( $atts, $content = null ) {
    @extract($atts);
	$number  = ($number)  ? $number  : '5' ;
	return tie_get_feeds( $url , $number );
}
add_shortcode('feed', 'tie_shortcode_feeds');


## Google Map -------------------------------------------------- #
function tie_shortcode_googlemap( $atts, $content = null ) {
    @extract($atts);
	$width  = ($width)  ? $width  :'620' ;
	$height = ($height) ? $height : '440';

	return tie_google_maps( $src , $width, $height , $align  );
}
add_shortcode('googlemap', 'tie_shortcode_googlemap');



## is_logged_in shortcode -------------------------------------------------- #
function tie_shortcode_is_logged_in( $atts, $content = null ) {
	global $user_ID ;
	if( $user_ID )
		return do_shortcode($content) ;
}
add_shortcode('is_logged_in', 'tie_shortcode_is_logged_in');


## is_guest shortcode -------------------------------------------------- #
function tie_shortcode_is_guest( $atts, $content = null ) {
	global $user_ID ;
	if( !$user_ID  )
		return do_shortcode($content) ;
}
add_shortcode('is_guest', 'tie_shortcode_is_guest');


## Follow Twitter -------------------------------------------------- #
function tie_shortcode_follow( $atts, $content = null ) {
    @extract($atts);

	if($size == "large") $size = 'data-size="large"' ;
		else $size="";
		
	if($count == "true") $count = "true" ;
	else $count = "false" ;

	$out = '
	<a href="https://twitter.com/'. $id .'" class="twitter-follow-button" data-show-count="'.$count.'" '.$size.'>Follow @'. $id .'</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';       

    return $out;
}
add_shortcode('follow', 'tie_shortcode_follow');


## AddAudio -------------------------------------------------- #
function tie_shortcode_AddAudio( $atts, $content = null ) {
    @extract($atts);
	$player_id = rand(5, 15) ;
	
	wp_enqueue_script( 'tie-jplayer' );

$out= '
	<script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery("#jquery_jplayer_'. $player_id .'").jPlayer({
        ready: function () {
          jQuery(this).jPlayer("setMedia", {
            mp3: "'. $mp3 .'",
            m4a: "'. $m4a .'",
            oga: "'. $ogg .'"
          });
        },
		cssSelectorAncestor: "#jp_container_'. $player_id .'",
        supplied: "m4a, oga, mp3"
      });
    });
  </script> 
  <div id="jquery_jplayer_'. $player_id .'" class="jp-jplayer"></div>
  <div id="jp_container_'. $player_id .'" class="jp-audio">
	<div class="jp-type-single">
		<div class="jp-gui jp-interface">
			<div class="jp-progress">
			  <div class="jp-seek-bar">
				<div class="jp-play-bar"><span></span></div>
			</div>
		</div>
		<a href="javascript:;" class="jp-play" tabindex="1">play</a>
		<a href="javascript:;" class="jp-pause" tabindex="1">pause</a>
			
		<div class="jp-volume-bar">
			<div class="jp-volume-bar-value"><span class="handle"></span></div>
		</div>
		
		<a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a>
		<a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a>
	</div>

	<div class="jp-no-solution">
		<span>Update Required</span>
		To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
	</div>
  </div>
  </div>';?>
 
  <?php
   return do_shortcode( $out );
}
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) ) add_shortcode('audio', 'tie_shortcode_AddAudio');


## AddAudio -------------------------------------------------- #
function tie_shortcode_Tooltip( $atts, $content = null ) {
    @extract($atts);
	if( empty($gravity) ) $gravity = '';
	$out = '<span class="post-tooltip tooltip-'.$gravity.'" title="'.$content.'">'.$text.'</span>';
   return $out;
}
add_shortcode('tooltip', 'tie_shortcode_Tooltip');



## highlight -------------------------------------------------- #
function tie_highlight_shortcode( $atts, $content = null ) {  
    return '<span class="highlight">'.$content.'</span>';  
}  
add_shortcode("highlight", "tie_highlight_shortcode");  


## Dropcap  -------------------------------------------------- #
function tie_dropcap_shortcode( $atts, $content = null ) {  
    return '<span class="dropcap">'.$content.'</span>';  
}  
add_shortcode("dropcap", "tie_dropcap_shortcode");  



## checklist -------------------------------------------------- #
function tie_checklist_shortcode( $atts, $content = null ) {  
    return '<div class="checklist">'.do_shortcode($content).'</div>';  
}  
add_shortcode("checklist", "tie_checklist_shortcode");


## starlist -------------------------------------------------- #
function tie_starlist_shortcode( $atts, $content = null ) {  
    return '<div class="starlist">'.do_shortcode($content).'</div>';  
}  
add_shortcode("starlist", "tie_starlist_shortcode");


## Facebook -------------------------------------------------- #
function tie_facebook_shortcode( $atts, $content = null ) { 
	global $post;
    return '<iframe src="http://www.facebook.com/plugins/like.php?href='. get_permalink($post->ID) .'&amp;layout=box_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;font&amp;colorscheme=light&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:65px;" allowTransparency="true"></iframe>';  
}  
add_shortcode("facebook", "tie_facebook_shortcode");


## Tweet -------------------------------------------------- #
function tie_tweet_shortcode( $atts, $content = null ) { 
	global $post;
    return '<a href="http://twitter.com/share" class="twitter-share-button" data-url="'. get_permalink($post->ID) .'" data-text="'. get_the_title($post->ID) .'" data-via="'. tie_get_option( 'share_twitter_username' ) .'" data-lang="en" data-count="vertical" >tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';  
}  
add_shortcode("tweet", "tie_tweet_shortcode");


## Digg -------------------------------------------------- #
function tie_digg_shortcode( $atts, $content = null ) { 
	global $post;
    return "
	<script type='text/javascript'>
(function() {
var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
s.type = 'text/javascript';
s.async = true;
s.src = 'http://widgets.digg.com/buttons.js';
s1.parentNode.insertBefore(s, s1);
})();
</script><a class='DiggThisButton DiggMedium' href='http://digg.com/submit?url". get_permalink($post->ID) ."=&amp;title=". get_the_title($post->ID) ."'></a>";  
}  
add_shortcode("digg", "tie_digg_shortcode");


## stumble -------------------------------------------------- #
function tie_stumble_shortcode( $atts, $content = null ) { 
	global $post;
    return "<su:badge layout='5' location='". get_permalink($post->ID) ."'></su:badge>
<script type='text/javascript'>
  (function() {
    var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
    li.src = 'https://platform.stumbleupon.com/1/widgets.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
  })();
</script>";  
}  
add_shortcode("stumble", "tie_stumble_shortcode");


## pinterest -------------------------------------------------- #
function tie_pinterest_shortcode( $atts, $content = null ) { 
	global $post;
    return '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
	<a href="http://pinterest.com/pin/create/button/?url='.get_permalink($post->ID).'&amp;media='.tie_thumb_src( 'slider' ).' class="pin-it-button" count-layout="vertical"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>';
 
}  
add_shortcode("pinterest", "tie_pinterest_shortcode");



## Google + -------------------------------------------------- #
function tie_google_shortcode( $atts, $content = null ) { 
	global $post;
    return "<g:plusone size='tall'></g:plusone>
<script type='text/javascript'>
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
";  
}  
add_shortcode("Google", "tie_google_shortcode");


## feedburner -------------------------------------------------- #
function tie_feedburner_shortcode( $atts, $content = null ) { 
    @extract($atts);
    return '<a href="http://feeds.feedburner.com/'.$name.'"><img src="http://feeds.feedburner.com/~fc/'.$name.'?anim=1" height="26" width="88" style="border:0" alt="" /></a>';  
}  
add_shortcode("feedburner", "tie_feedburner_shortcode");




## Tabs -------------------------------------------------- #
function tie_shortcode_tabs( $atts, $content = null ) {
    @extract($atts);
	
	if($type== "vertical" ) $type= '-ver';
	else $type= '';
	
    wp_enqueue_script( 'tie-tabs' );

	$out ='
	<script type="text/javascript">	jQuery(document).ready(function($){	jQuery("ul.tabs-nav").tabs("> .pane"); }); </script>

		<div class="post-tabs'.$type.'">
		'.do_shortcode($content).'
		</div>
	';
   return $out;
}
add_shortcode('tabs', 'tie_shortcode_tabs');


## Tab -------------------------------------------------- #
function tie_shortcode_tab( $atts, $content = null ) {
	$out ='
		<div class="pane">
		'.do_shortcode($content).'
		</div>
	';
   return $out;
}
add_shortcode('tab', 'tie_shortcode_tab');


## Tab Head -------------------------------------------------- #
function tie_shortcode_tabs_head( $atts, $content = null ) {
	$out ='<ul class="tabs-nav">'.do_shortcode($content).'</ul>';
   return $out;
}
add_shortcode('tabs_head', 'tie_shortcode_tabs_head');


## Tab_title -------------------------------------------------- #
function tie_shortcode_tab_title( $atts, $content = null ) {
	$out ='<li>'.do_shortcode($content).'</li>';
   return $out;
}
add_shortcode('tab_title', 'tie_shortcode_tab_title');


## Divider -------------------------------------------------- #
function tie_shortcode_divider( $atts, $content = null ) {
	$out ='<div class="clear"></div><div class="divider"></div>';
   return $out;
}
add_shortcode('divider', 'tie_shortcode_divider');




## Columns  -------------------------------------------------- #
function tie_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'tie_one_third');

function tie_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'tie_one_third_last');

function tie_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'tie_two_third');

function tie_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'tie_two_third_last');

function tie_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'tie_one_half');

function tie_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'tie_one_half_last');

function tie_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'tie_one_fourth');

function tie_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'tie_one_fourth_last');

function tie_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'tie_three_fourth');

function tie_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 'tie_three_fourth_last');

function tie_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'tie_one_fifth');

function tie_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'tie_one_fifth_last');

function tie_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'tie_two_fifth');

function tie_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'tie_two_fifth_last');

function tie_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'tie_three_fifth');

function tie_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'tie_three_fifth_last');

function tie_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'tie_four_fifth');

function tie_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'tie_four_fifth_last');

function tie_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'tie_one_sixth');

function tie_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'tie_one_sixth_last');

function tie_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'tie_five_sixth');

function tie_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'tie_five_sixth_last');
?>