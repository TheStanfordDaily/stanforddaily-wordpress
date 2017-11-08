<?php
/*-----------------------------------------------------------------------------------*/
# Register main Scripts and Styles
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'tie_register' ); 
function tie_register() {
	## Register Main style.css file
	wp_register_style( 'tie-style', get_stylesheet_uri() , array(), '', 'all' );
	wp_enqueue_style( 'tie-style' );
	
	## Register All Scripts
    wp_register_script( 'tie-scripts', get_template_directory_uri() . '/js/tie-scripts.js', array( 'jquery' ), false, true );  
    wp_register_script( 'tie-tabs', get_template_directory_uri() . '/js/tabs.min.js', array( 'jquery' ), false, true );  
    wp_register_script( 'tie-cycle', get_template_directory_uri() . '/js/jquery.cycle.all.js', array( 'jquery' ), false, true );
    wp_register_script( 'tie-validation', get_template_directory_uri() . '/js/validation.js', array( 'jquery' ), false, true );  
    wp_register_script( 'tie-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), false, true );

	## Get Global Scripts
    wp_enqueue_script( 'tie-scripts' );
	
	## Register WooCommerce css file
	wp_register_style( 'tie-woocommerce', get_template_directory_uri().'/css/woocommerce.css' , array(), '', 'all' );
	if (class_exists('Woocommerce')) 
		wp_enqueue_style( 'tie-woocommerce' );
		
	## Get Validation Script
	if( tie_get_option('comment_validation') && ( is_page() || is_single() ) && comments_open() )
		wp_enqueue_script( 'tie-validation' );
	
	## For facebook & Google + share
	if(  is_singular() && tie_get_option('post_og_cards')  ) tie_og_data();
}


/*-----------------------------------------------------------------------------------*/
# Enqueue Fonts From Google
/*-----------------------------------------------------------------------------------*/
function tie_enqueue_font ( $got_font) {
	if ($got_font) {
	
		$char_set = '';
		if( tie_get_option('typography_latin_extended') || tie_get_option('typography_cyrillic') ||
		tie_get_option('typography_cyrillic_extended') || tie_get_option('typography_greek') ||
		tie_get_option('typography_greek_extended') || tie_get_option('typography_vietnamese') || tie_get_option('typography_khmer') ){

		
			$char_set = '&subset=latin';
			if( tie_get_option('typography_latin_extended') ) 
				$char_set .= ',latin-ext';
			if( tie_get_option('typography_cyrillic') )
				$char_set .= ',cyrillic';
			if( tie_get_option('typography_cyrillic_extended') )
				$char_set .= ',cyrillic-ext';
			if( tie_get_option('typography_greek') )
				$char_set .= ',greek';
			if( tie_get_option('typography_greek_extended') )
				$char_set .= ',greek-ext';
			if( tie_get_option('typography_khmer') )
				$char_set .= ',khmer';
			if( tie_get_option('typography_vietnamese') )
				$char_set .= ',vietnamese';
		}
		
		$font_pieces = explode(":", $got_font);
		
		$font_name = $font_pieces[0];
		$font_type = $font_pieces[1];
		
		if( $font_type == 'non-google' ){
		
			// Do Nothing :)
			
		}elseif( $font_type == 'early-google'){
			$font_name = str_replace (" ","", $font_pieces[0] );
			$protocol = is_ssl() ? 'https' : 'http';
			wp_enqueue_style( $font_name , $protocol.'://fonts.googleapis.com/earlyaccess/'.$font_name);
			
		}else{
			$font_name = str_replace (" ","+", $font_pieces[0] );
			$font_variants = str_replace ("|",",", $font_pieces[1] );
			$protocol = is_ssl() ? 'https' : 'http';
			wp_enqueue_style( $font_name , $protocol.'://fonts.googleapis.com/css?family='.$font_name . ':' . $font_variants.$char_set );
		}
	}
}


/*-----------------------------------------------------------------------------------*/
# Get Font Name
/*-----------------------------------------------------------------------------------*/
function tie_get_font ( $got_font ) {
	if ($got_font) {
		$font_pieces = explode(":", $got_font);
		$font_name = $font_pieces[0];
		$font_name = str_replace('&quot;' , '"' , $font_pieces[0] );
		if (strpos($font_name, ',') !== false) 
			return $font_name;
		else
			return "'".$font_name."'";
	}
}


/*-----------------------------------------------------------------------------------*/
# Typography Elements Array
/*-----------------------------------------------------------------------------------*/
$custom_typography = array(
	"body"												=>		"typography_general",
	".logo h1 a, .logo h2 a"		=>		"typography_site_title",
	".logo span"										=>		"typography_tagline",
	".top-nav, .top-nav ul li a "						=>		"typography_top_menu",
	"#main-nav, #main-nav ul li a"						=>		"typography_main_nav",
	".page-title"										=>		"typography_page_title",
	".post-title"										=> 		"typography_post_title",
	"h2.post-box-title, h2.post-box-title a"			=> 		"typography_post_title_boxes",
	"h3.post-box-title, h3.post-box-title a"			=> 		"typography_post_title2_boxes",
	"p.post-meta, p.post-meta a"						=> 		"typography_post_meta",
	"body.single .entry, body.page .entry"				=> 		"typography_post_entry",
	".widget-top h4, .widget-top h4 a"					=> 		"typography_widgets_title",
	".footer-widget-top h4, .footer-widget-top h4 a"	=> 		"typography_footer_widgets_title",
	".entry h1"											=> 		"typography_post_h1",
	".entry h2"											=> 		"typography_post_h2",
	".entry h3"											=> 		"typography_post_h3",
	".entry h4"											=> 		"typography_post_h4",
	".entry h5"											=> 		"typography_post_h5",
	".entry h6"											=> 		"typography_post_h6",
	".ei-title h2 , .slider-caption h2 a, .content .slider-caption h2 a, .slider-caption h2, .content .slider-caption h2, .content .ei-title h2"				=> 		"typography_slider_title",
	".cat-box-title h2, .cat-box-title h2 a, .block-head h3, #respond h3, #comments-title, h2.review-box-header"			=> 		"typography_boxes_title"
);
	
	
/*-----------------------------------------------------------------------------------*/
# Get Custom Typography
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'tie_typography');
function tie_typography(){
	global $custom_typography;

	foreach( $custom_typography as $selector => $value){
		$option = tie_get_option( $value );
		if( !empty($option['font']))
			tie_enqueue_font( $option['font'] );
	}
	
	tie_enqueue_font( 'Droid Sans:regular|700' );

}


/*-----------------------------------------------------------------------------------*/
# Tie Wp Head
/*-----------------------------------------------------------------------------------*/
add_action('wp_head', 'tie_wp_head');
function tie_wp_head() {
	global $custom_typography; 
	?>
	
<!--[if IE]>
<script type="text/javascript">jQuery(document).ready(function (){ jQuery(".menu-item").has("ul").children("a").attr("aria-haspopup", "true");});</script>
<![endif]-->	
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri() ?>/js/html5.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/selectivizr-min.js"></script>
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() ?>/css/ie9.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() ?>/css/ie8.css" />
<![endif]-->
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() ?>/css/ie7.css" />
<![endif]-->
<script type='text/javascript'>
	/* <![CDATA[ */
	var tievar = {'go_to' : '<?php _e('Go to...', 'tie') ?>'};
	var tie = {"ajaxurl":"<?php echo admin_url('admin-ajax.php'); ?>" , "your_rating":"<?php _e( 'Your Rating:' , 'tie' ) ?>"};
	/* ]]> */
</script>
<?php
global $is_IE;
if( $is_IE ){ ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php }

	if( tie_get_option( 'disable_responsive' ) ){?>

<meta name="viewport" content="width=1045" />
	<?php }else{ ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<?php
	}
echo "\n"; ?>
<style type="text/css" media="screen"> 
<?php if(tie_get_option('modern_scrollbar')) echo "::-webkit-scrollbar {width: 8px; height:8px; }\n" ?>
<?php if(tie_get_option('theme_skin')) tie_theme_color(tie_get_option('theme_skin')); ?>
<?php echo "\n"; ?>
<?php if( tie_get_option('background_type') == 'pattern' ):
	if( tie_get_option('background_pattern') || tie_get_option('background_pattern_color') ): ?>
body {
<?php if( tie_get_option('background_pattern_color') ){ ?> background-color: <?php echo tie_get_option('background_pattern_color') ?> !important; <?php } ?>
<?php if( tie_get_option('background_pattern') ){ ?> background-image : url(<?php echo get_template_directory_uri(); ?>/images/patterns/<?php echo tie_get_option('background_pattern') ?>.png);<?php } ?>
background-position: top center;
}
	<?php endif; ?>
<?php elseif( tie_get_option('background_type') == 'custom' ):
	$bg = tie_get_option( 'background' ); 
	if( tie_get_option('background_full') ): ?>
.background-cover{<?php echo "\n"; ?>
	background-color:<?php echo $bg['color'] ?> !important;
	background-image : url('<?php echo $bg['img'] ?>') !important;<?php echo "\n"; ?>
	filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $bg['img'] ?>',sizingMethod='scale') !important;<?php echo "\n"; ?>
	-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $bg['img'] ?>',sizingMethod='scale')" !important;<?php echo "\n"; ?>
}
<?php else: ?>
body{
<?php if( !empty( $bg['color'] ) ){ ?>background-color:<?php echo $bg['color'] ?> !important; <?php echo "\n"; } ?>
<?php if( !empty( $bg['img'] ) ){ ?>background-image: url('<?php echo $bg['img'] ?>') !important; <?php echo "\n"; } ?>
<?php if( !empty( $bg['repeat'] ) ){ ?>background-repeat:<?php echo $bg['repeat'] ?> !important; <?php echo "\n"; } ?>
<?php if( !empty( $bg['attachment'] ) ){ ?>background-attachment:<?php echo $bg['attachment'] ?> !important; <?php echo "\n"; } ?>
<?php if( !empty( $bg['hor'] ) || !empty( $bg['ver'] ) ){ ?>background-position:<?php echo $bg['hor'] ?> <?php echo $bg['ver'] ?> !important; <?php echo "\n"; } ?>
}
<?php endif; ?>
<?php endif; ?>
<?php
foreach( $custom_typography as $selector => $value){
$option = tie_get_option( $value );
if( !empty( $option['font'] ) || !empty( $option['color'] ) || !empty( $option['size'] ) || !empty( $option['weight'] ) || !empty( $option['style'] ) ):
echo "\n".$selector."{\n"; ?>
<?php if( !empty( $option['font'] ) )
	echo "	font-family: ". tie_get_font( $option['font']  ).";\n"?>
<?php if( !empty( $option['color'] ) )
	echo "	color :". $option['color'].";\n"?>
<?php if( !empty( $option['size'] ) )
	echo "	font-size : ".$option['size']."px;\n"?>
<?php if( !empty( $option['weight'] ) )
	echo "	font-weight: ".$option['weight'].";\n"?>
<?php if( !empty( $option['style'] ) )
	echo "	font-style: ". $option['style'].";\n"?>
}
<?php endif;
} ?>
<?php if( tie_get_option( 'global_color' ) ) tie_theme_color( tie_get_option( 'global_color' ) );?>
<?php if( tie_get_option( 'highlighted_color' ) ): ?>
::-moz-selection { background: <?php echo tie_get_option( 'highlighted_color' ) ?>;}
::selection { background: <?php echo tie_get_option( 'highlighted_color' ) ?>; }
<?php endif; ?>
<?php if( tie_get_option( 'links_color' ) || tie_get_option( 'links_decoration' )  ): ?>
a {
	<?php if( tie_get_option( 'links_color' ) ) echo 'color: '.tie_get_option( 'links_color' ).';'; ?>
	<?php if( tie_get_option( 'links_decoration' ) ) echo 'text-decoration: '.tie_get_option( 'links_decoration' ).';'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'links_color_hover' ) || tie_get_option( 'links_decoration_hover' )  ): ?>
a:hover {
	<?php if( tie_get_option( 'links_color_hover' ) ) echo 'color: '.tie_get_option( 'links_color_hover' ).';'; ?>
	<?php if( tie_get_option( 'links_decoration_hover' ) ) echo 'text-decoration: '.tie_get_option( 'links_decoration_hover' ).';'; ?>
}
<?php endif; ?>
<?php 
$topbar_bg = tie_get_option( 'topbar_background' ); 
if( !empty( $topbar_bg['img']) || !empty( $topbar_bg['color'] ) ): ?>
.top-nav, .top-nav ul ul {background:<?php if( !empty($topbar_bg['color']) ) echo $topbar_bg['color'] ?> <?php if( !empty($topbar_bg['img']) ){ ?>url('<?php echo $topbar_bg['img'] ?>')<?php } ?> <?php if( !empty ($topbar_bg['repeat']) ) echo $topbar_bg['repeat'] ?> <?php if( !empty ($topbar_bg['attachment']) ) echo $topbar_bg['attachment'] ?> <?php if( !empty ($topbar_bg['hor']) ) echo $topbar_bg['hor'] ?> <?php if( !empty ($topbar_bg['ver']) ) echo $topbar_bg['ver'] ?>;}<?php echo "\n"; ?>
<?php endif; ?>
<?php if( tie_get_option( 'topbar_links_color' ) ): ?>
.top-nav ul li a , .top-nav ul ul a {
	<?php if( tie_get_option( 'topbar_links_color' ) ) echo 'color: '.tie_get_option( 'topbar_links_color' ).' !important;'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'topbar_links_color_hover' ) ): ?>
.top-nav ul li a:hover, .top-nav ul li:hover > a, .top-nav ul :hover > a , .top-nav ul li.current-menu-item a  {
	<?php if( tie_get_option( 'topbar_links_color_hover' ) ) echo 'color: '.tie_get_option( 'topbar_links_color_hover' ).' !important;'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'todaydate_background' ) || tie_get_option( 'todaydate_color' )  ): ?>
.today-date {
	<?php if( tie_get_option( 'todaydate_background' ) ) echo 'background: '.tie_get_option( 'todaydate_background' ).';'; ?>
	<?php if( tie_get_option( 'todaydate_color' ) ) echo 'color: '.tie_get_option( 'todaydate_color' ).';'; ?>
}
<?php endif; ?>
<?php $header_bg = tie_get_option( 'header_background' ); 
if( !empty( $header_bg['img']) || !empty( $header_bg['color'] ) ): ?>
header#theme-header {background:<?php if( !empty($header_bg['color']) ) echo $header_bg['color'] ?> <?php if( !empty($header_bg['img']) ){ ?>url('<?php echo $header_bg['img'] ?>')<?php } ?> <?php if( !empty ($header_bg['repeat']) ) echo $header_bg['repeat'] ?> <?php if( !empty ($header_bg['attachment']) ) echo $header_bg['attachment'] ?> <?php if( !empty ($header_bg['hor']) ) echo $header_bg['hor'] ?> <?php if( !empty ($header_bg['ver']) ) echo $header_bg['ver'] ?> !important;}<?php echo "\n"; ?>
<?php endif; ?>
<?php 
if( tie_get_option( 'sub_nav_background' )): ?>
#main-nav ul ul, #main-nav ul li.mega-menu .mega-menu-block {background-color:<?php echo tie_get_option( 'sub_nav_background' ).' !important;';?>;}<?php echo "\n"; ?>
<?php endif; ?>
<?php if( tie_get_option( 'nav_links_color' ) || tie_get_option( 'nav_shadow_color' ) ): ?>
#main-nav ul li a , #main-nav ul ul a , #main-nav ul.sub-menu a ,  #main-nav ul li.current-menu-item ul a, #main-nav ul li.current-menu-parent ul a, #main-nav ul li.current-page-ancestor ul a{
	<?php if( tie_get_option( 'nav_links_color' ) ) echo 'color: '.tie_get_option( 'nav_links_color' ).' !important;'; ?>
	<?php if( tie_get_option( 'nav_shadow_color' ) ) echo 'text-shadow: 0 1px 1px '.tie_get_option( 'nav_shadow_color' ).' !important;'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'nav_links_color_hover' ) || tie_get_option( 'nav_shadow_color_hover' ) ): ?>
#main-nav ul li a:hover, #main-nav ul li:hover > a, #main-nav ul :hover > a , #main-nav  ul ul li:hover > a, #main-nav  ul ul :hover > a  {
	<?php if( tie_get_option( 'nav_links_color_hover' ) ) echo 'color: '.tie_get_option( 'nav_links_color_hover' ).' !important;'; ?>
	<?php if( tie_get_option( 'nav_shadow_color_hover' ) ) echo 'text-shadow: 0 1px 1px '.tie_get_option( 'nav_shadow_color_hover' ).' !important;'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'nav_current_links_color' ) || tie_get_option( 'nav_current_shadow_color' ) ): ?>
#main-nav ul li.current-menu-item a  {
	<?php if( tie_get_option( 'nav_current_links_color' ) ) echo 'color: '.tie_get_option( 'nav_current_links_color' ).' !important;'; ?>
	<?php if( tie_get_option( 'nav_current_shadow_color' ) ) echo 'text-shadow: 0 1px 1px '.tie_get_option( 'nav_current_shadow_color' ).' !important;'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'nav_sep1' ) ): ?>
#main-nav ul li {
	border-color: <?php echo tie_get_option( 'nav_sep1' ); ?>;
}
#main-nav ul ul li, #main-nav ul ul li:first-child {
	border-top-color: <?php echo tie_get_option( 'nav_sep1' ); ?>;
}
#main-nav ul li .mega-menu-block ul.sub-menu {
	border-bottom-color: <?php echo tie_get_option( 'nav_sep1' ); ?>;
}
<?php endif; ?>
<?php if( tie_get_option( 'nav_sep2' ) ): ?>
#main-nav ul li a {
	border-left-color: <?php echo tie_get_option( 'nav_sep2' ); ?>;
}
#main-nav ul ul li, #main-nav ul ul li:first-child {
	border-bottom-color: <?php echo tie_get_option( 'nav_sep2' ); ?>;
}
<?php endif; ?>
<?php $content_bg = tie_get_option( 'main_content_bg' ); 
if( !empty( $content_bg['img']) || !empty( $content_bg['color'] ) ): ?>
#main-content {background:<?php if( !empty($content_bg['color']) ) echo $content_bg['color'] ?> <?php if( !empty($content_bg['img']) ){ ?>url('<?php echo $content_bg['img'] ?>')<?php } ?> <?php if( !empty($content_bg['repeat']) ) echo $content_bg['repeat'] ?> <?php if( !empty($content_bg['attachment']) ) echo $content_bg['attachment'] ?> <?php if( !empty($content_bg['hor']) ) echo $content_bg['hor'] ?> <?php if( !empty($content_bg['ver']) ) echo $content_bg['ver'] ?>;}<?php echo "\n"; ?>
<?php endif; ?>
<?php $boxes_bg = tie_get_option( 'boxes_bg' ); 
if( !empty( $boxes_bg['img']) || !empty( $boxes_bg['color'] ) ): ?>
.cat-box-content, #sidebar .widget-container, .post-listing, .column2 li.first-news, .wide-box li.first-news {background:<?php if( !empty($boxes_bg['color']) ) echo $boxes_bg['color'] ?> <?php if( !empty($boxes_bg['img']) ){ ?>url('<?php echo $boxes_bg['img'] ?>')<?php } ?> <?php if( !empty($boxes_bg['repeat']) ) echo $boxes_bg['repeat'] ?> <?php if( !empty($boxes_bg['attachment']) ) echo $boxes_bg['attachment'] ?> <?php if( !empty($boxes_bg['hor']) ) echo $boxes_bg['hor'] ?> <?php if( !empty($boxes_bg['ver']) ) echo $boxes_bg['ver'] ?> !important;}<?php echo "\n"; ?>
<?php endif; ?>
<?php if( tie_get_option( 'breaking_title_bg' ) ): ?>
.breaking-news span {<?php if( tie_get_option( 'breaking_title_bg' ) ) echo 'background: '.tie_get_option( 'breaking_title_bg' ).';'; ?>}
<?php endif; ?>
<?php if( tie_get_option( 'post_links_color' ) || tie_get_option( 'post_links_decoration' )  ): ?>
body.single .post .entry a, body.page .post .entry a {
	<?php if( tie_get_option( 'post_links_color' ) ) echo 'color: '.tie_get_option( 'post_links_color' ).';'; ?>
	<?php if( tie_get_option( 'post_links_decoration' ) ) echo 'text-decoration: '.tie_get_option( 'post_links_decoration' ).';'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'post_links_color_hover' ) || tie_get_option( 'post_links_decoration_hover' )  ): ?>
body.single .post .entry a:hover, body.page .post .entry a:hover {
	<?php if( tie_get_option( 'post_links_color_hover' ) ) echo 'color: '.tie_get_option( 'post_links_color_hover' ).';'; ?>
	<?php if( tie_get_option( 'post_links_decoration_hover' ) ) echo 'text-decoration: '.tie_get_option( 'post_links_decoration_hover' ).';'; ?>
}
<?php endif; ?>
<?php $footer_bg = tie_get_option( 'footer_background' ); 
if( !empty( $footer_bg['img']) || !empty( $footer_bg['color'] ) ): ?>
footer#theme-footer {background:<?php if( !empty($footer_bg['color']) ) echo $footer_bg['color'] ?> <?php if( !empty($footer_bg['img']) ){ ?>url('<?php echo $footer_bg['img'] ?>')<?php }?> <?php if( !empty($footer_bg['repeat']) ) echo $footer_bg['repeat'] ?> <?php if( !empty($footer_bg['attachment']) ) echo $footer_bg['attachment'] ?> <?php if( !empty($footer_bg['hor']) ) echo $footer_bg['hor'] ?> <?php if( !empty($footer_bg['ver']) ) echo $footer_bg['ver'] ?>;}<?php echo "\n"; ?>
<?php endif; ?>
<?php if( tie_get_option( 'footer_title_color' ) ): ?>
.footer-widget-top h3 {	<?php if( tie_get_option( 'footer_title_color' ) ) echo 'color: '.tie_get_option( 'footer_title_color' ).';'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'footer_links_color' ) ): ?>
footer a  {	<?php if( tie_get_option( 'footer_links_color' ) ) echo 'color: '.tie_get_option( 'footer_links_color' ).' !important;'; ?>
}
<?php endif; ?>
<?php if( tie_get_option( 'footer_links_color_hover' ) ): ?>
footer a:hover {<?php if( tie_get_option( 'footer_links_color_hover' ) ) echo 'color: '.tie_get_option( 'footer_links_color_hover' ).' !important;'; ?>
}
<?php endif; ?>
<?php global $post ;
if( is_category() || is_singular() || ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) ): 
	if( is_category() ){
		$category_id = get_query_var('cat') ;
		$cat_options = get_option( "tie_cat_$category_id");
		
		if( !empty($cat_options['cat_background']) )
			$cat_bg = $cat_options['cat_background'];
		
		if( !empty($cat_options['cat_color']) )
			$cat_color = $cat_options['cat_color'];
		
		if( !empty($cat_options['cat_background_full']) )
			$cat_full = $cat_options['cat_background_full'];
	}
	if( is_singular() || ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) ){
		$current_ID = $post->ID;
		if( function_exists( 'is_woocommerce' ) && is_woocommerce() ) $current_ID = woocommerce_get_page_id('shop');
		
		$get_meta = get_post_custom( $current_ID );
		
		if( !empty( $get_meta["post_color"][0] ) )
			$cat_color = $get_meta["post_color"][0];
		
		if( !empty( $get_meta["post_background"][0] ) )
			$cat_bg = unserialize($get_meta["post_background"][0]);
		
		if( !empty( $get_meta["post_background_full"][0] ) )
			$cat_full = $get_meta['post_background_full'];
		
		$categories = get_the_category( $post->ID );
		$category_id = $categories[0]->term_id ;
		$cat_options = get_option( "tie_cat_$category_id");

		if( empty($cat_color) && !empty( $cat_options['cat_color'] ) ) $cat_color = $cat_options['cat_color'];
		if( empty($cat_full) && !empty( $cat_options['cat_background_full'] ) ) $cat_full = $cat_options['cat_background_full'];
		if( empty($cat_bg['color']) && empty($cat_bg['img']) && !empty( $cat_bg['cat_background'] ) ) $cat_bg = $cat_options['cat_background'];;
	}

if( $cat_bg['color'] || $cat_bg['img']):
	if( $cat_full  ): ?>
.background-cover{<?php echo "\n"; ?>
	background-color:<?php echo $cat_bg['color'] ?> !important;
	background-image : url('<?php echo $cat_bg['img'] ?>') !important;<?php echo "\n"; ?>
	filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $cat_bg['img'] ?>',sizingMethod='scale') !important;<?php echo "\n"; ?>
	-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $cat_bg['img'] ?>',sizingMethod='scale')" !important;<?php echo "\n"; ?>
}
<?php else: ?>
body{
<?php if( !empty( $cat_bg['color'] ) ){ ?>background-color:<?php echo $cat_bg['color'] ?> !important; <?php echo "\n"; } ?>
<?php if( !empty( $cat_bg['img'] ) ){ ?>background-image: url('<?php echo $cat_bg['img'] ?>') !important; <?php echo "\n"; } ?>
<?php if( !empty( $cat_bg['repeat'] ) ){ ?>background-repeat:<?php echo $cat_bg['repeat'] ?> !important; <?php echo "\n"; } ?>
<?php if( !empty( $cat_bg['attachment'] ) ){ ?>background-attachment:<?php echo $cat_bg['attachment'] ?> !important; <?php echo "\n"; } ?>
<?php if( !empty( $cat_bg['hor'] ) || !empty( $cat_bg['ver'] ) ){ ?>background-position:<?php echo $cat_bg['hor'] ?> <?php echo $cat_bg['ver'] ?> !important; <?php echo "\n"; } ?>
}<?php echo "\n"; ?>
<?php endif;
endif; 
if( !empty($cat_color) ) tie_theme_color( $cat_color ); ?>
<?php endif; ?>
<?php $css_code =  str_replace("<pre>", "", htmlspecialchars_decode( tie_get_option('css')) ); 
echo $css_code = str_replace("</pre>", "", $css_code )  , "\n";?>
<?php if( tie_get_option('css_tablets') ) : ?>
@media only screen and (max-width: 985px) and (min-width: 768px){
<?php $css_code1 =  str_replace("<pre>", "", htmlspecialchars_decode( tie_get_option('css_tablets')) ); 
echo $css_code1 = str_replace("</pre>", "", $css_code1 )  , "\n";?>
}
<?php endif; ?>
<?php if( tie_get_option('css_wide_phones') ) : ?>
@media only screen and (max-width: 767px) and (min-width: 480px){
<?php $css_code2 =  str_replace("<pre>", "", htmlspecialchars_decode( tie_get_option('css_wide_phones')) ); 
echo $css_code2 = str_replace("</pre>", "", $css_code2 )  , "\n";?>
}
<?php endif; ?>
<?php if( tie_get_option('css_phones') ) : ?>
@media only screen and (max-width: 479px) and (min-width: 320px){
<?php $css_code3 =  str_replace("<pre>", "", htmlspecialchars_decode( tie_get_option('css_phones')) ); 
echo $css_code3 = str_replace("</pre>", "", $css_code3 )  , "\n";?>
}
<?php endif; ?>
</style> 
<?php if( tie_get_option('apple_iPad_retina') ) : ?>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo tie_get_option('apple_iPad_retina') ?>" />
<?php endif; ?>
<?php if( tie_get_option('apple_iphone_retina') ) : ?>
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo tie_get_option('apple_iphone_retina') ?>" />
<?php endif; ?>
<?php if( tie_get_option('apple_iPad') ) : ?>
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo tie_get_option('apple_iPad') ?>" />
<?php endif; ?>
<?php if( tie_get_option('apple_iphone') ) : ?>
<link rel="apple-touch-icon-precomposed" href="<?php echo tie_get_option('apple_iphone') ?>" />
<?php endif; ?>
<?php
echo htmlspecialchars_decode( tie_get_option('header_code') ) , "\n";
include ("header-adcodes.php");
}

function tie_theme_color( $color ){ ?>
	#main-nav,.cat-box-content,#sidebar .widget-container,.post-listing {border-bottom-color: <?php echo $color; ?>;}
	.search-block .search-button,
	#topcontrol,
	#main-nav ul li.current-menu-item a,
	#main-nav ul li.current-menu-item a:hover,
	#main-nav ul li.current-menu-parent a,
	#main-nav ul li.current-menu-parent a:hover,
	#main-nav ul li.current-page-ancestor a,
	#main-nav ul li.current-page-ancestor a:hover,
	.pagination span.current,
	.share-post span.share-text,
	.flex-control-paging li a.flex-active,
	.ei-slider-thumbs li.ei-slider-element,
	.review-percentage .review-item span span,.review-final-score ,
	.woocommerce span.onsale, .woocommerce-page span.onsale ,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle  {
		background-color:<?php echo $color; ?> !important;
	}
	::-webkit-scrollbar-thumb{background-color:<?php echo $color; ?> !important;}
	footer#theme-footer, .top-nav, .top-nav ul li.current-menu-item:after,#main-nav ul li.mega-menu .mega-menu-block, #main-nav ul ul {border-top-color: <?php echo $color; ?>;}
	.search-block:after {border-right-color:<?php echo $color; ?>;}
	#main-nav ul > li.parent-list:hover > a:after{border-color:transparent transparent <?php echo $color; ?>;}
<?php
}
?>
