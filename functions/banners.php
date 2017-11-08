<?php
function tie_banner( $banner , $before= false , $after = false){
	if(tie_get_option( $banner )):
		echo $before;
		?>
		<?php
		if(tie_get_option( $banner.'_img' )):
			$target = $nofollow ="";
			if( tie_get_option( $banner.'_tab' )) $target='target="_blank"';
			if( tie_get_option( $banner.'_nofollow' )) $nofollow='rel="nofollow"'; ?>
			
			<a href="<?php echo tie_get_option( $banner.'_url' ) ?>" title="<?php echo tie_get_option( $banner.'_alt') ?>" <?php echo $target; echo $nofollow ?>>
				<img src="<?php echo tie_get_option( $banner.'_img' ) ?>" alt="<?php echo tie_get_option( $banner.'_alt') ?>" />
			</a>
		<?php elseif( tie_get_option( $banner.'_publisher' ) ): ?>
		<script type="text/javascript">
			var adWidth = jQuery(document).width();
			google_ad_client = "<?php echo tie_get_option( $banner.'_publisher' ) ?>";
			<?php if( $banner != 'banner_above' && $banner != 'banner_below' ){ ?>if ( adWidth >= 768 ) {
			  google_ad_slot	= "<?php echo tie_get_option( $banner.'_728' ) ?>";
			  google_ad_width	= 728;
			  google_ad_height 	= 90;
			} else <?php } ?> if ( adWidth >= 468 ) {
			  google_ad_slot	= "<?php echo tie_get_option( $banner.'_468' ) ?>";
			  google_ad_width 	= 468;
			  google_ad_height 	= 60;
			}else {
			  google_ad_slot 	= "<?php echo tie_get_option( $banner.'_300' ) ?>";
			  google_ad_width 	= 300;
			  google_ad_height 	= 250;
			}
		</script>
		<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
		<?php elseif(tie_get_option( $banner.'_adsense' )): 
			if ($banner == 'banner_top') {
				global $name_of_sidebar;
				if  ($name_of_sidebar == "ops-sidebar" && tie_get_option("banner_top_ops")) {
					echo do_shortcode(htmlspecialchars_decode(tie_get_option( 'banner_top_ops' )));
				} else if  ($name_of_sidebar == "news-sidebar" && tie_get_option("banner_top_news")) {
					echo do_shortcode(htmlspecialchars_decode(tie_get_option( 'banner_top_news' )));
				} else if  (($name_of_sidebar == "sports-sidebar" || $name_of_sidebar == "football-sidebar") && tie_get_option("banner_top_sports")) {
					echo do_shortcode(htmlspecialchars_decode(tie_get_option( 'banner_top_sports' )));
				} else if  ($name_of_sidebar == "arts-and-life-sidebar" && tie_get_option("banner_top_arts")) {
					echo do_shortcode(htmlspecialchars_decode(tie_get_option( 'banner_top_arts' )));
				} else {
					echo do_shortcode(htmlspecialchars_decode(tie_get_option( $banner.'_adsense' )));
				}
			} else {
				echo do_shortcode(htmlspecialchars_decode(tie_get_option( $banner.'_adsense' )));
			}
		endif;
		?>
		<?php
		echo $after;
	endif;
}
?>
