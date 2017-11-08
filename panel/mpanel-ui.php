<?php
function panel_options() { 

	$categories_obj = get_categories('hide_empty=0');
	$categories = array();
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	}
	
	$sliders = array();
	$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
	while ( $custom_slider->have_posts() ) {
		$custom_slider->the_post();
		$sliders[get_the_ID()] = get_the_title();
	}
	
	
$save='
	<div class="mpanel-submit">
		<input type="hidden" name="action" value="test_theme_data_save" />
        <input type="hidden" name="security" value="'. wp_create_nonce("test-theme-data").'" />
		<input name="save" class="mpanel-save" type="submit" value="Save Changes" />    
	</div>'; 
?>
		
		
<div id="save-alert"></div>

<div class="mo-panel">

	<div class="mo-panel-tabs">
		<div class="logo"></div>
		<ul>
			<li class="tie-tabs general"><a href="#tab1"><span></span>General Settings</a></li>
			<li class="tie-tabs homepage"><a href="#tab2"><span></span>Homepage</a></li>
			<li class="tie-tabs header"><a href="#tab9"><span></span>Header Settings</a></li>
			<li class="tie-tabs archives"><a href="#tab12"><span></span>Archives Settings</a></li>
			<li class="tie-tabs article"><a href="#tab6"><span></span>Article Settings</a></li>
			<li class="tie-tabs sidebars"><a href="#tab11"><span></span>Sidebars</a></li>
			<li class="tie-tabs footer"><a href="#tab7"><span></span>Footer Settings</a></li>
			<li class="tie-tabs slideshow"><a href="#tab5"><span></span>Slider Settings</a></li>
			<li class="tie-tabs banners"><a href="#tab8"><span></span>Ads Settings</a></li>
			<li class="tie-tabs styling"><a href="#tab13"><span></span>Styling</a></li>
			<li class="tie-tabs typography"><a href="#tab14"><span></span>Typography</a></li>
			<li class="tie-tabs Social"><a href="#tab4"><span></span>Social Networking</a></li>
			<li class="tie-tabs advanced"><a href="#tab10"><span></span>Advanced</a></li>
			<li class="tie-tabs tie-rate tie-not-tab"><a target="_blank" href="http://themeforest.net/downloads?ref=tielabs"><span></span>Rate <?php echo theme_name ?></a></li>
			<li class="tie-tabs tie-more tie-not-tab"><a target="_blank" href="http://themeforest.net/user/tielabs/portfolio?ref=tielabs"><span></span>More Themes</a></li>
		</ul>
		<div class="clear"></div>
	</div> <!-- .mo-panel-tabs -->
	
	
	<div class="mo-panel-content">
	<form action="/" name="tie_form" id="tie_form">
		<div id="tab1" class="tabs-wrap">
			<h2>General Settings</h2> <?php echo $save ?>
			<?php if(class_exists( 'bbPress' )): ?>
			<div class="tiepanel-item">
				<h3>bbPress Settings</h3>
				<?php
					tie_options(
						array(	"name" => "bbPress Full width",
								"id" => "bbpress_full",
								"type" => "checkbox"));
				?>
			</div>
			<?php endif; ?>
			<div class="tiepanel-item">
				<h3>Custom Favicon</h3>
				<?php
					tie_options(
						array(	"name" => "Custom Favicon",
								"id" => "favicon",
								"type" => "upload"));
				?>
			</div>	
			<div class="tiepanel-item">
				<h3>Custom Gravatar</h3>
				<?php
					tie_options(
						array(	"name" => "Custom Gravatar",
								"id" => "gravatar",
								"type" => "upload"));
				?>
			</div>	
			<div class="tiepanel-item">
				<h3>Apple Icons</h3>
				<?php
					tie_options(
						array(	"name" => "Apple iPhone Icon",
								"id" => "apple_iphone",
								"type" => "upload",
								"extra_text" => 'Icon for Apple iPhone (57px x 57px)')); 			

					tie_options(
						array(	"name" => "Apple iPhone Retina Icon",
								"id" => "apple_iphone_retina",
								"type" => "upload",
								"extra_text" => 'Icon for Apple iPhone Retina Version (120px x 120px)')); 			

					tie_options(
						array(	"name" => "Apple iPad Icon",
								"id" => "apple_iPad",
								"type" => "upload",
								"extra_text" => 'Icon for Apple iPhone (72px x 72px)')); 			

					tie_options(
						array(	"name" => "Apple iPad Retina Icon",
								"id" => "apple_iPad_retina",
								"type" => "upload",
								"extra_text" => 'Icon for Apple iPad Retina Version (144px x 144px)')); 			

				?>
			</div>	
			<div class="tiepanel-item">
				<h3>Time format</h3>
				<?php
					tie_options(
						array( 	"name" => "Time format for blog posts",
								"id" => "time_format",
								"type" => "radio",
								"options" => array( "traditional"=>"Traditional" ,
													"modern"=>"Time Ago Format",
													"none"=>"Disable all " )));
				?>									
			</div>	
			
			<div class="tiepanel-item">
				<h3>Breadcrumbs Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Breadcrumbs ",
								"id" => "breadcrumbs",
								"type" => "checkbox")); 
					
					tie_options(
						array(	"name" => "Breadcrumbs Delimiter",
								"id" => "breadcrumbs_delimiter",
								"type" => "short-text"));
				?>
			</div>
						
			<div class="tiepanel-item">
				<h3>Header Code</h3>
				<div class="option-item">
					<small>The following code will add to the &lt;head&gt; tag. Useful if you need to add additional scripts such as CSS or JS.</small>
					<textarea id="header_code" name="tie_options[header_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('header_code'));  ?></textarea>				
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>Footer Code</h3>
				<div class="option-item">
					<small>The following code will add to the footer before the closing  &lt;/body&gt; tag. Useful if you need to Javascript or tracking code.</small>

					<textarea id="footer_code" name="tie_options[footer_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('footer_code'));  ?></textarea>				
				</div>
			</div>	
			
		</div>
		
		<div id="tab9" class="tabs-wrap">
			<h2>Header Settings</h2> <?php echo $save ?>
			
			<div class="tiepanel-item">
				<h3>Logo</h3>
				<?php
					tie_options(
						array( 	"name" => "Logo Setting",
								"id" => "logo_setting",
								"type" => "radio",
								"options" => array( "logo"=>"Custom Image Logo" ,
													"title"=>"Display Site Title" )));

					tie_options(
						array(	"name" => "Logo Image",
								"id" => "logo",
								"help" => "Upload a logo image, or enter URL to an image if it is already uploaded. the theme default logo gets applied if the input field is left blank.",
								"type" => "upload",
								"extra_text" => 'Recommended size (MAX) : 190px x 60px')); 
								
					tie_options(
						array(	"name" => "Logo Image (Retina Version @2x)",
								"id" => "logo_retina",
								"type" => "upload",
								"extra_text" => 'Please choose an image file for the retina version of the logo. It should be 2x the size of main logo.')); 			
					
					tie_options(
						array(	"name" => "Standard Logo Width for Retina Logo",
								"id" => "logo_retina_width",
								"type" => "short-text",
								"extra_text" => 'If retina logo is uploaded, please enter the standard logo (1x) version width, do not enter the retina logo width.')); 			

					tie_options(
						array(	"name" => "Standard Logo Height for Retina Logo",
								"id" => "logo_retina_height",
								"type" => "short-text",
								"extra_text" => 'If retina logo is uploaded, please enter the standard logo (1x) version height, do not enter the retina logo height.')); 			
								
					tie_options(
						array(	"name" => "Logo Margin Top",
								"id" => "logo_margin",
								"type" => "slider",
								"help" => "Input number to set the top space of the logo .",
								"unit" => "px",
								"max" => 100,
								"min" => 0 ));

					tie_options(
						array(	"name" => "Full Width Logo",
								"id" => "full_logo",
								"type" => "checkbox",
								"extra_text" => 'Recommended logo width : 1045px')); 

					tie_options(
						array(	"name" => "Center the Logo",
								"id" => "center_logo",
								"type" => "checkbox")); 			
				?>

			</div>
			

			<div class="tiepanel-item">
				<h3>Header Menus Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Hide Top menu",
								"id" => "top_menu",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Hide Main Nav",
								"id" => "main_nav",
								"type" => "checkbox"));	

					tie_options(
						array(	"name" => "Today Date",
								"id" => "top_date",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Today Date Format ",
								"id" => "todaydate_format",
								"type" => "text",
								"extra_text" => '<a target="_blank" href="http://codex.wordpress.org/Formatting_Date_and_Time">Documentation on date and time formatting</a>')); 			
					tie_options(
						array(	"name" => "Top Menu Right Area",
								"id" => "top_right",
								"type" => "radio",
								"options" => array( ""=>"None" ,
													"search"=>"Search" ,
													"social"=>"Social Icons" ))); 
													
					tie_options(
						array(	"name" => "Random Article Button",
								"id" => "random_article",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Stick The Navigation menu",
								"id" => "stick_nav",
								"type" => "checkbox")); 			
				?>		
			</div>
			

			<div class="tiepanel-item">
				<h3>Breaking News</h3>
				<?php
					tie_options(
						array(	"name" => "Enable",
								"id" => "breaking_news",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Show in Homepage Only",
								"id" => "breaking_home",
								"type" => "checkbox")); 
												
					tie_options(
						array(	"name" => "Breaking News Title",
								"id" => "breaking_title",
								"type" => "text"));
																
					tie_options(
						array(	"name" => "Animation Effect",
								"id" => "breaking_effect",
								"type" => "select",
								"options" => array(
									'fade' => 'Fade',
									'slide' => 'Slide',
									'ticker' => 'Ticker',
								)));
								
					tie_options(
						array(	"name" => "Animation Speed",
								"id" => "breaking_speed",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));

								
					tie_options(
						array(	"name" => "Time between the fades",
								"id" => "breaking_time",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));
				
				?>
				
				<?php				
					tie_options(
						array(	"name" => "Breaking News Query Type",
								"id" => "breaking_type",
								"options" => array( "category"	=>	"Categories" ,
													"tag"		=>	"Tags",
													"custom"	=>	"Custom Text"),
								"type" => "radio")); 
															
					
					tie_options(
						array(	"name" => "Number Of Posts To Show",
								"id" => "breaking_number",
								"type" => "short-text"));
								
					tie_options(
						array(	"name" => "Breaking News Tags",
								"help" => "Enter a tag name, or names seprated by comma. ",
								"id" => "breaking_tag",
								"type" => "text"));
								
				?>
					
				
					<div class="option-item" id="breaking_cat-item">
						<span class="label">Breaking News Categories</span>
							<select multiple="multiple" name="tie_options[breaking_cat][]" id="tie_breaking_cat">
							<?php foreach ($categories as $key => $option) { ?>
								<option value="<?php echo $key ?>" <?php if ( @in_array( $key , tie_get_option('breaking_cat') ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
							<?php } ?>
						</select>
					</div>
		
			</div>
			
			<div class="tiepanel-item" id="breaking_custom-item">
				<h3>Breaking News Custom Text</h3>
					<div class="option-item" >
					
						<span class="label" style="width:40px">Text</span>
						<input id="custom_text" type="text" size="56" style="direction:ltr; text-laign:left; width:200px; float:left" name="custom_text" value="" />
						<span class="label" style="width:40px; margin-left:10px;">Link</span>
						<input id="custom_link" type="text" size="56" style="direction:ltr; text-laign:left; width:200px; float:left" name="custom_link" value="" />
						<input id="TextAdd"  class="small_button" type="button" value="Add" />
							
						<ul id="customList" style="margin-top:15px;">
						<?php $breaking_custom = tie_get_option( 'breaking_custom' ) ;
							$custom_count = 0 ;
							if($breaking_custom){
								foreach ($breaking_custom as $custom_text) { $custom_count++; ?>
							<li>
								<div class="widget-head">
									<a href="<?php echo $custom_text['link'] ?>" target="_blank"><?php echo $custom_text['text'] ?></a>
									<input name="tie_options[breaking_custom][<?php echo $custom_count ?>][link]" type="hidden" value="<?php echo $custom_text['link'] ?>" />
									<input name="tie_options[breaking_custom][<?php echo $custom_count ?>][text]" type="hidden" value="<?php echo $custom_text['text'] ?>" />
									<a class="del-custom-text"></a></div>
							</li>
								<?php }
							}
						?>
						</ul>
						<script>
							var customnext = <?php echo $custom_count+1 ?> ;
						</script>
					</div>	
				</div>
		</div> <!-- Header Settings -->
		
		
		
		<div id="tab2" class="tabs-wrap">
			<h2>Homepage</h2> <?php echo $save ?>
		
			<div class="tiepanel-item">
				<h3>Home page displays</h3>
				<?php
					tie_options(
						array( 	"name" => "Home page displays",
								"id" => "on_home",
								"type" => "radio",
								"options" => array( "latest"=>"Latest posts - Blog Layout" ,
													"boxes"=>" News Boxes - use Home Builder" )));
				?>
			</div>	
			
		<div id="Home_Builder" style="width:100%;">

			<div class="tiepanel-item">
				<h3>News Boxes Settings</h3>
				<?php
					tie_options(
						array( 	"name" => "First News Excerpt Length",
								"id" => "home_exc_length",
								"type" => "short-text"));	
					tie_options(
						array(	"name" => "Review Score",
								"id" => "box_meta_score",
								"type" => "checkbox" )); 			
					tie_options(
						array(	"name" => "Author Meta",
								"id" => "box_meta_author",
								"type" => "checkbox",
								"extra_text" => 'This option not applied on Scrolling boxes and Recent posts Blog Style .')); 			
					tie_options(
						array(	"name" => "Date Meta",
								"id" => "box_meta_date",
								"type" => "checkbox"));
					tie_options(
						array(	"name" => "Categories Meta",
								"id" => "box_meta_cats",
								"type" => "checkbox",
								"extra_text" => 'This option not applied on Scrolling boxes and Recent posts Blog Style .')); 
					tie_options(
						array(	"name" => "Comments Meta",
								"id" => "box_meta_comments",
								"type" => "checkbox",
								"extra_text" => 'This option not applied on Scrolling boxes and Recent posts Blog Style .')); 
				?>
			</div>	
			
			
			<div class="tiepanel-item"  style=" overflow: visible; ">
				<h3>Home Builder 					<a id="collapse-all">[-] Collapse All</a>
					<a id="expand-all">[+] Expand All</a></h3>
				<div class="option-item">

					<select style="display:none" id="cats_defult">
						<?php foreach ($categories as $key => $option) { ?>
						<option value="<?php echo $key ?>"><?php echo $option; ?></option>
						<?php } ?>
					</select>
				
					
					<div style="clear:both"></div>
					<div class="home-builder-buttons">
						<a id="add-cat" >News Box</a>
						<a id="add-slider" >Scrolling Box</a>
						<a id="add-ads" >Ads / Custom Content</a>
						<a id="add-news-picture" >News in picture</a>
						<a id="add-news-videos" >Videos</a>
						<a id="add-recent" >Recent Posts</a>
						<a id="add-divider" >Divider</a>
					</div>
										
					<ul id="cat_sortable">
						<?php
							$cats = get_option( 'tie_home_cats' ) ;
							$i=0;
							if($cats){
								foreach ($cats as $cat) { 
									$i++;
									?>
									<li id="listItem_<?php echo $i ?>" class="ui-state-default">
			
								<?php 
									if( $cat['type'] == 'n' ) :	?>
										<div class="widget-head"> News Box : <?php if( !empty($cat['id']) ) echo get_the_category_by_ID( $cat['id'] ); ?>
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>Box Category : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label><span>Posts Order : </span><select name="tie_home_cats[<?php echo $i ?>][order]" id="tie_home_cats[<?php echo $i ?>][order]"><option value="latest" <?php if( $cat['order'] == 'latest' || $cat['order']=='' ) echo 'selected="selected"'; ?>>Latest Posts</option><option  <?php if( $cat['order'] == 'rand' ) echo 'selected="selected"'; ?> value="rand">Random Posts</option></select></label>
											<label for="tie_home_cats[<?php echo $i ?>][number]"><span>Number of posts to show :</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php  if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											<label>
												<span style="float:left;">Box Style : </span>
												<ul class="tie-cats-options tie-options">
													<li>
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="li" <?php if( $cat['style'] == 'li' || $cat['style']=='' ) echo 'checked="checked"'; ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/li.png" /></a>
													</li>
													<li>
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="2c" <?php if( $cat['style'] == '2c' ) echo 'checked="checked"' ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/2c.png" /></a>
													</li>
													<li style="margin-right:0 !important;">
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="1c" <?php if( $cat['style'] == '1c') echo 'checked="checked"' ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/1c.png" /></a>
													</li>
												</ul>
											</label>
								<?php 
									elseif( $cat['type'] == 'recent' ) :	?>
										<div class="widget-head"> Recent Posts 
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span style="float:left;">Exclude This Categories : </span><select multiple="multiple" name="tie_home_cats[<?php echo $i ?>][exclude][]" id="tie_home_cats[<?php echo $i ?>][exclude][]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $cat['exclude'] ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span>Box Title :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php   if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][number]"><span>Number of posts to show :</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php   if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php   if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][display]"><span>Display Mode:</span>
												<select id="tie_home_cats[<?php echo $i ?>][display]" name="tie_home_cats[<?php echo $i ?>][display]">
													<option value="default" <?php if ( $cat['display'] == 'default') { echo ' selected="selected"' ; } ?>>Default Style</option>
													<option value="blog" <?php if ( $cat['display'] == 'blog') { echo ' selected="selected"' ; } ?>>Blog Style</option>
												</select>
											</label>
											<label for="tie_home_cats[<?php echo $i ?>][pagi]"><span>Show Pagination:</span>
												<select id="tie_home_cats[<?php echo $i ?>][pagi]" name="tie_home_cats[<?php echo $i ?>][pagi]">
													<option value="n" <?php if ( $cat['pagi'] == 'n') { echo ' selected="selected"' ; } ?>>No</option>
													<option value="y" <?php if ( $cat['pagi'] == 'y') { echo ' selected="selected"' ; } ?>>Yes</option>
												</select>
											</label>
											<p class="tie_message_hint">WordPress WARNING: Setting the offset option breaks pagination, set pagination option to "NO" if you want to use the offset option.</p>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
										
									<?php elseif( $cat['type'] == 's' ) : ?>
										<div class="widget-head scrolling-box"> Scrolling Box : <?php if( !empty($cat['id']) ) echo get_the_category_by_ID( $cat['id'] ); ?>
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>Box Category : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span>Box Title :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php   if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][number]"><span>Number of posts to show :</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][number]" name="tie_home_cats[<?php echo $i ?>][number]" value="<?php   if( !empty($cat['number']) ) echo $cat['number']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php   if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
									<?php elseif( $cat['type'] == 'ads' ) : ?>
										<div class="widget-head ads-box"> Ads / Custom Content
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<textarea cols="36" rows="5" name="tie_home_cats[<?php echo $i ?>][text]" id="tie_home_cats[<?php echo $i ?>][text]"><?php  if( !empty($cat['text']) ) echo stripslashes($cat['text']) ; ?></textarea>
											<small>Supports <strong>Text, HTML and Shortcodes</strong> .</small>

										
									<?php elseif( $cat['type'] == 'news-pic' ) : ?>
										<div class="widget-head news-pic-box">  News In Picture
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>Box Category : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span>Box Title :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php if( !empty($cat['title']) ) echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  if( !empty($cat['offset']) ) echo $cat['offset']  ?>" type="text" /></label>
											<label>
												<span style="float:left;">Box Style : </span>
												<ul class="tie-cats-options tie-options">
													<li>
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="default" <?php if( $cat['style'] == 'default' || $cat['style']=='' ) echo 'checked="checked"'; ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/news-in-pic1.png" /></a>
													</li>
													<li>
														<input id="tie_home_cats[<?php echo $i ?>][style]" name="tie_home_cats[<?php echo $i ?>][style]" type="radio" value="row" <?php if( $cat['style'] == 'row' ) echo 'checked="checked"' ?> />
														<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/news-in-pic2.png" /></a>
													</li>
												</ul>
											</label>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
								
								<?php elseif( $cat['type'] == 'videos' ) : ?>
										<div class="widget-head news-pic-box">Videos
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label><span>Box Category : </span><select name="tie_home_cats[<?php echo $i ?>][id]" id="tie_home_cats[<?php echo $i ?>][id]">
												<?php foreach ($categories as $key => $option) { ?>
												<option value="<?php echo $key ?>" <?php if ( $cat['id']  == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
												<?php } ?>
											</select></label>
											<label for="tie_home_cats[<?php echo $i ?>][title]"><span>Box Title :</span><input id="tie_home_cats[<?php echo $i ?>][title]" name="tie_home_cats[<?php echo $i ?>][title]" value="<?php if( !empty($cat['title']) )  echo $cat['title']  ?>" type="text" /></label>
											<label for="tie_home_cats[<?php echo $i ?>][offset]"><span>Offset - number of post to pass over</span><input style="width:50px;" id="tie_home_cats[<?php echo $i ?>][offset]" name="tie_home_cats[<?php echo $i ?>][offset]" value="<?php  if( !empty($cat['offset']) )  echo $cat['offset']  ?>" type="text" /></label>
											<input id="tie_home_cats[<?php echo $i ?>][boxid]" name="tie_home_cats[<?php echo $i ?>][boxid]" value="<?php  if(empty($cat['boxid'])) echo $cat['type'].'_'.rand(200, 3500); else echo $cat['boxid'];  ?>" type="hidden" />
								
									<?php elseif( $cat['type'] == 'divider' ) : ?>
										<div class="widget-head news-pic-box">  Divider
											<a class="toggle-open">+</a>
											<a class="toggle-close">-</a>
										</div>
										<div class="widget-content">
											<label for="tie_home_cats[<?php echo $i ?>][height]"><span>Height :</span><input id="tie_home_cats[<?php echo $i ?>][height]" name="tie_home_cats[<?php echo $i ?>][height]" value="<?php  echo $cat['height']  ?>" type="text" style="width:50px;" /> px</label>

									<?php endif; ?>
									
									
											<input id="tie_home_cats[<?php echo $i ?>][type]" name="tie_home_cats[<?php echo $i ?>][type]" value="<?php  echo $cat['type']  ?>" type="hidden" />
											<a class="del-cat"></a>
										
										</div>
									</li>
							<?php } 
							} else{?>
							<?php } ?>
					</ul>

					<script>
						var nextCell = <?php echo $i+1 ?> ;
						var templatePath =' <?php echo get_template_directory_uri(); ?>';
					</script>
				</div>	
			</div>
			
			<div class="tiepanel-item">
				<h3>Categories Tabs Box</h3>
				
				<?php
				tie_options(
					array(	"name" => "Show Category Tabs Box",
							"id" => "home_tabs_box",
							"type" => "checkbox")); 
							
					if( tie_get_option('home_tabs') )
						$tie_home_tabs = tie_get_option('home_tabs') ;
					else 
						$tie_home_tabs = array();
					
					$tie_home_tabs_new = array();					
					
					foreach ($tie_home_tabs as $key1 => $option1) {
						if ( array_key_exists( $option1 , $categories) )
							$tie_home_tabs_new[$option1] = $categories[$option1];
					}
					foreach ($categories as $key2 => $option2) {
						if ( !in_array( $key2 , $tie_home_tabs) )
							$tie_home_tabs_new[$key2] = $option2;
					}
				?>
					
				<div class="option-item">
					<span class="label">Choose Categories : </span>
					<div class="clear"></div> <p></p>
					<ul id="tabs_cats">
						<?php foreach ($tie_home_tabs_new as $key => $option) { ?>
						<li><input id="tie_home_tabs" name="tie_options[home_tabs][]" type="checkbox" <?php if ( in_array( $key , $tie_home_tabs) ) { echo ' checked="checked"' ; } ?> value="<?php echo $key ?>">
						<span><?php echo $option; ?></span></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>

		</div> <!-- Homepage Settings -->
		
	
		
		<div id="tab4" class="tabs-wrap">
			<h2>Social Networking</h2> <?php echo $save ?>

			<div class="tiepanel-item">
				<h3>Custom Feed URL</h3>
							
				<?php
					tie_options(
						array(	"name" => "Hide Rss Icon",
								"id" => "rss_icon",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Custom Feed URL",
								"id" => "rss_url",
								"help" => "e.g. http://feedburner.com/userid",
								"type" => "text"));
				?>
			</div>
			
		<div class="tiepanel-item">
				<h3>Social Networking</h3>
				<p class="tie_message_hint"> Don't forget http:// before link .</p>
						
				<?php						
					tie_options(
						array(	"name" => "Facebook URL",
								"id" => "social",
								"key" => "facebook",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Twitter URL",
								"id" => "social",
								"key" => "twitter",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Google+ URL",
								"id" => "social",
								"key" => "google_plus",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "MySpace URL",
								"id" => "social",
								"key" => "myspace",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "dribbble URL",
								"id" => "social",
								"key" => "dribbble",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "LinkedIn URL",
								"id" => "social",
								"key" => "linkedin",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "evernote URL",
								"id" => "social",
								"key" => "evernote",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Dropbox URL",
								"id" => "social",
								"key" => "dropbox",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Flickr URL",
								"id" => "social",
								"key" => "flickr",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Picasa Web URL",
								"id" => "social",
								"key" => "picasa",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "DeviantArt URL",
								"id" => "social",
								"key" => "deviantart",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "YouTube URL",
								"id" => "social",
								"key" => "youtube",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "grooveshark URL",
								"id" => "social",
								"key" => "grooveshark",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Vimeo URL",
								"id" => "social",
								"key" => "vimeo",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "ShareThis URL",
								"id" => "social",
								"key" => "sharethis",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "yahoobuzz URL",
								"id" => "social",
								"key" => "yahoobuzz",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "500px URL",
								"id" => "social",
								"key" => "px500",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Skype URL",
								"id" => "social",
								"key" => "skype",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Digg URL",
								"id" => "social",
								"key" => "digg",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Reddit URL",
								"id" => "social",
								"key" => "reddit",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Delicious URL",
								"id" => "social",
								"key" => "delicious",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "StumbleUpon  URL",
								"key" => "stumbleupon",
								"id" => "social",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "FriendFeed URL",
								"id" => "social",
								"key" => "friendfeed",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Tumblr URL",
								"id" => "social",
								"key" => "tumblr",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Blogger URL",
								"id" => "social",
								"key" => "blogger",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Wordpress URL",
								"id" => "social",
								"key" => "wordpress",
								"type" => "arrayText"));						
					tie_options(
						array(	"name" => "Yelp URL",
								"id" => "social",
								"key" => "yelp",
								"type" => "arrayText"));							
					tie_options(
						array(	"name" => "posterous URL",
								"id" => "social",
								"key" => "posterous",
								"type" => "arrayText"));																														
					tie_options(
						array(	"name" => "Last.fm URL",
								"id" => "social",
								"key" => "lastfm",
								"type" => "arrayText"));						
					tie_options(
						array(	"name" => "Apple URL",
								"id" => "social",
								"key" => "apple",
								"type" => "arrayText"));											
					tie_options(
						array(	"name" => "FourSquare URL",
								"id" => "social",
								"key" => "foursquare",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Github URL",
								"id" => "social",
								"key" => "github",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "openid URL",
								"id" => "social",
								"key" => "openid",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "SoundCloud URL",
								"id" => "social",
								"key" => "soundcloud",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "xing.me URL",
								"id" => "social",
								"key" => "xing",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Google Play URL",
								"id" => "social",
								"key" => "google_play",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Pinterest URL",
								"id" => "social",
								"key" => "Pinterest",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Instagram URL",
								"id" => "social",
								"key" => "instagram",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Spotify URL",
								"id" => "social",
								"key" => "spotify",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "PayPal URL",
								"id" => "social",
								"key" => "paypal",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Forrst URL",
								"id" => "social",
								"key" => "forrst",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Behance URL",
								"id" => "social",
								"key" => "behance",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "Viadeo URL",
								"id" => "social",
								"key" => "viadeo",
								"type" => "arrayText"));
					tie_options(
						array(	"name" => "VK.com URL",
								"id" => "social",
								"key" => "vk",
								"type" => "arrayText"));
				?>
			</div>			
		</div><!-- Social Networking -->
		
		
		<div id="tab5" class="tab_content tabs-wrap">
			<h2>Slider Settings</h2> <?php echo $save; ?>
			<div class="tiepanel-item">
				<h3>Slider Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Enable",
								"id" => "slider",
								"type" => "checkbox")); 
		
					tie_options(
						array(	"name" => "Slider Type",
								"id" => "slider_type",
								"options" => array( "flexi"=>"Flexi Slider" ,
													"elastic"=>"Elastic Slideshow " ),
								"type" => "radio")); 

					tie_options(
						array(	"name" => "Show Slides Caption",
								"id" => "slider_caption",
								"type" => "checkbox")); 
	
					tie_options(
						array(	"name" => "Show Slides Headline",
								"id" => "slider_headline",
								"type" => "checkbox")); 

					tie_options(
						array(	"name" => "Slides Caption Length",
								"id" => "slider_caption_length",
								"type" => "short-text"));
								
				?>
				<div class="option-item">
					<span class="label">Slider Position</span>
					<div style="float:left; width: 338px;">
						<?php
							$checked = 'checked="checked"';
							$tie_slider_pos = tie_get_option('slider_pos');
						?>
						<ul id="sidebar-position-options" class="tie-options">
							<li style="margin:5px 20px 5px 0 ">
								<input id="tie_slider_pos"  name="tie_options[slider_pos]" type="radio" value="small" <?php if($tie_slider_pos == 'small' || !$tie_slider_pos ) echo $checked; ?> />
								<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/small-slider.png" /></a>
							</li>
							<li>
								<input id="tie_slider_pos"  name="tie_options[slider_pos]" type="radio" value="big" <?php if($tie_slider_pos == 'big') echo $checked; ?> />
								<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/big-slider.png" /></a>
							</li>
						</ul>
					</div>
				</div>		
			</div>
			<div id="elastic" class="tiepanel-item">
			<h3>Elastic Slideshow Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Animation Effect",
								"id" => "elastic_slider_effect",
								"type" => "select",
								"options" => array(
									'center' => 'Center',
									'sides' => 'Sides'
								)));

					tie_options(
						array(	"name" => "Autoplay",
								"id" => "elastic_slider_autoplay",
								"type" => "checkbox"));
					
					
					tie_options(
						array(	"name" => "Slideshow Speed",
								"id" => "elastic_slider_interval",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));

					tie_options(
						array(	"name" => "Animation Speed",
								"id" => "elastic_slider_speed",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));
				?>
			</div>

			<div id="flexi" class="tiepanel-item">
			<h3>Flexi Slider Settings</h3>
				<?php
					if( is_rtl() ){
						tie_options(
							array(	"name" => "Animation Effect",
									"id" => "flexi_slider_effect",
									"type" => "select",
									"options" => array(
										'fade' => 'Fade',
										'slideV' => 'Slide Vertical',
									)));
					}else{
						tie_options(
							array(	"name" => "Animation Effect",
									"id" => "flexi_slider_effect",
									"type" => "select",
									"options" => array(
										'fade' => 'Fade',
										'slideV' => 'Slide Vertical',
										'slideH' => 'Slide Horizontal',
									)));
					}
								
					tie_options(
						array(	"name" => "Slideshow Speed",
								"id" => "flexi_slider_speed",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));

					tie_options(
						array(	"name" => "Animation Speed",
								"id" => "flexi_slider_time",
								"type" => "slider",
								"unit" => "ms",
								"max" => 40000,
								"min" => 100 ));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Query Settings</h3>
			<?php
					tie_options(
						array(	"name" => "Number Of Posts To Show",
								"id" => "slider_number",
								"type" => "short-text"));
								
					tie_options(
						array(	"name" => "Query Type",
								"id" => "slider_query",
								"options" => array( "category"=>"Category" ,
													"tag"=>"Tag",
													"post"=>"Selctive Posts",
													"page"=>"Selctive pages" ,
													"custom"=>"Custom Slider" ),
								"type" => "radio")); 
								
					tie_options(
						array(	"name" => "Tags",
								"help" => "Enter a tag name, or names seprated by comma. ",
								"id" => "slider_tag",
								"type" => "text"));
			?>
				<?php $slider_cat = tie_get_option('slider_cat') ; ?>
					<div class="option-item" id="slider_cat-item">
						<span class="label">Category</span>
							<select multiple="multiple" name="tie_options[slider_cat][]" id="tie_slider_cat">
							<?php foreach ($categories as $key => $option) { ?>
								<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $slider_cat ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
							<?php } ?>
						</select>
						<a class="mo-help tooltip" title="Enter a category ID, or IDs seprated by comma. "></a>
					</div>
					
			<?php
																
					tie_options(
						array(	"name" => "Selctive Posts IDs",
								"help" => "Enter a post ID, or IDs seprated by comma. ",
								"id" => "slider_posts",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "Selctive Pages IDs",
								"help" => "Enter a page ID, or IDs seprated by comma. ",
								"id" => "slider_pages",
								"type" => "text"));	
								
					tie_options(
						array(	"name" => "Custom Slider",
								"help" => "Choose your custom slider",
								"id" => "slider_custom",
								"type" => "select",
								"options" => $sliders));
			?>
			
			</div>
		</div> <!-- Slideshow -->
		
				
		<div id="tab6" class="tab_content tabs-wrap">
			<h2>Article Settings</h2> <?php echo $save ?>
			
			<div class="tiepanel-item">
				<h3>Rating System Settings</h3>
				<?php
					tie_options(
						array( 	"name" => 'Who Is Allowed To Rate ?',
								"id" => "allowtorate",
								"type" => "radio",
								"options" => array( "none"=> 'Disable' ,
													"both"=> 'Registered Users And Guests',
													"guests"=>'Guests Only',
													"users"=>'Registered Users Only') ));
				?>									
			</div>
			
			<div class="tiepanel-item">
				<h3>Article Elements</h3>
				<?php
					tie_options(
						array(	"name" => "Show Featured Image",
								"desc" => "",
								"id" => "post_featured",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Post Author Box",
								"desc" => "",
								"id" => "post_authorbio",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Next/Prev Article",
								"desc" => "",
								"id" => "post_nav",
								"type" => "checkbox")); 

					tie_options(
						array(	"name" => "OG Meta",
								"desc" => "",
								"id" => "post_og_cards",
								"type" => "checkbox")); 

				?>
			</div>
			
			<div class="tiepanel-item">

				<h3>Post Meta Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Post Meta :",
								"id" => "post_meta",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Author Meta",
								"id" => "post_author",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Date Meta",
								"id" => "post_date",
								"type" => "checkbox"));


					tie_options(
						array(	"name" => "Categories Meta",
								"id" => "post_cats",
								"type" => "checkbox"));


					tie_options(
						array(	"name" => "Comments Meta",
								"id" => "post_comments",
								"type" => "checkbox"));


					tie_options(
						array(	"name" => "Tags Meta",
								"id" => "post_tags",
								"type" => "checkbox"));

								
				?>	
			</div>

				
			<div class="tiepanel-item">

				<h3>Share Post Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Bottom Share Post Buttons :",
								"id" => "share_post",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Top Share Post Buttons :",
								"id" => "share_post_top",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Tweet Button",
								"id" => "share_tweet",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Twitter Username <small>(optional)</small>",
								"id" => "share_twitter_username",
								"type" => "text"));
						
					tie_options(
						array(	"name" => "Facebook Like Button",
								"id" => "share_facebook",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Google+ Button",
								"id" => "share_google",
								"type" => "checkbox"));
								
																
					tie_options(
						array(	"name" => "Linkedin Button",
								"id" => "share_linkdin",
								"type" => "checkbox"));
																					
					tie_options(
						array(	"name" => "StumbleUpon Button",
								"id" => "share_stumble",
								"type" => "checkbox"));
								
																			
					tie_options(
						array(	"name" => "Pinterest Button",
								"id" => "share_pinterest",
								"type" => "checkbox"));
								
				?>	
			</div>

				
			<div class="tiepanel-item">

				<h3>Related Posts Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Related Posts",
								"id" => "related",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Related Posts Box Title",
								"id" => "related_title",
								"type" => "text")); 
								
					tie_options(
						array(	"name" => "Number of posts to show",
								"id" => "related_number",
								"type" => "short-text"));
								
					tie_options(
						array(	"name" => "Query Type",
								"id" => "related_query",
								"options" => array( "category"=>"Category" ,
													"tag"=>"Tag",
													"author"=>"Author" ),
								"type" => "radio")); 
				?>
			</div>

			
			<div class="tiepanel-item">

				<h3>jQuery Comments Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Adding Comment Validation ",
								"id" => "comment_validation",
								"type" => "checkbox"));
				?>
			</div>
		</div> <!-- Article Settings -->
		
		
		<div id="tab7" class="tabs-wrap">
			<h2>Footer Settings</h2> <?php echo $save ?>

			<div class="tiepanel-item">

				<h3>Footer Elements</h3>
				<?php
					tie_options(
						array(	"name" => "'Go To Top' Icon",
								"id" => "footer_top",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Social Icons",
								"desc" => "",
								"id" => "footer_social",
								"type" => "checkbox")); 

				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Footer Column layout</h3>
					<div class="option-item">

					<?php
						$checked = 'checked="checked"';
						$tie_footer_widgets = tie_get_option('footer_widgets');
					?>
					<ul id="footer-widgets-options" class="tie-options">
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-1c" <?php if($tie_footer_widgets == 'footer-1c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-1c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-2c" <?php if($tie_footer_widgets == 'footer-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-2c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="narrow-wide-2c" <?php if($tie_footer_widgets == 'narrow-wide-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-2c-narrow-wide.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-narrow-2c" <?php if($tie_footer_widgets == 'wide-narrow-2c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-2c-wide-narrow.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-3c" <?php if($tie_footer_widgets == 'footer-3c' || !$tie_footer_widgets ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-3c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-left-3c" <?php if($tie_footer_widgets == 'wide-left-3c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-3c-wide-left.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="wide-right-3c" <?php if($tie_footer_widgets == 'wide-right-3c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-3c-wide-right.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="footer-4c" <?php if($tie_footer_widgets == 'footer-4c') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-4c.png" /></a>
						</li>
						<li>
							<input id="tie_footer_widgets"  name="tie_options[footer_widgets]" type="radio" value="disable" <?php if($tie_footer_widgets == 'disable') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/footer-no.png" /></a>
						</li>

					</ul>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>Footer Text One</h3>
				<div class="option-item">
					<textarea id="tie_footer_one" name="tie_options[footer_one]" style="width:100%" rows="4"><?php echo htmlspecialchars_decode(tie_get_option('footer_one'));  ?></textarea>				
					<span style="padding-left:0" class="extra-text"><strong style="font-size: 12px;">Variables</strong>
						These tags can be included in the textarea above and will be replaced when a page is displayed.
						<br />
						<strong>%year%</strong> : <em>Replaced with the current year .</em><br />
						<strong>%site%</strong> : <em>Replaced with The site's name .</em><br />
						<strong>%url%</strong>  : <em>Replaced with The site's URI .</em>
					</span>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>Footer Text Two</h3>
				<div class="option-item">
					<textarea id="tie_footer_two" name="tie_options[footer_two]" style="width:100%" rows="4"><?php echo htmlspecialchars_decode(tie_get_option('footer_two'));  ?></textarea>				
					<span style="padding-left:0" class="extra-text"><strong style="font-size: 12px;">Variables</strong>
						These tags can be included in the textarea above and will be replaced when a page is displayed.
						<br />
						<strong>%year%</strong> : <em>Replaced with the current year .</em><br />
						<strong>%site%</strong> : <em>Replaced with The site's name .</em><br />
						<strong>%url%</strong>  : <em>Replaced with The site's URI .</em>
					</span>
				</div>
			</div>

		</div><!-- Footer Settings -->

		
		<div id="tab8" class="tab_content tabs-wrap">
			<h2>Banners Settings</h2> <?php echo $save ?>

			<div class="tiepanel-item">
				<h3>Header Ad Codes</h3>
				<?php	
							
					tie_options(					
						array(	"name" => "Generic Header Code",
								"id" => "ads_generic_header",
								"type" => "textarea"));
					/*tie_options(					
						array(	"name" => "News Header Code",
								"id" => "ads_news_header",
								"type" => "textarea"));
					tie_options(					
						array(	"name" => "Sports Header Code",
								"id" => "ads_sports_header",
								"type" => "textarea"));
					tie_options(					
						array(	"name" => "Opinions Header Code",
								"id" => "ads_ops_header",
								"type" => "textarea"));
					tie_options(					
						array(	"name" => "Arts Header Code",
								"id" => "ads_arts_header",
								"type" => "textarea"));*/
				?>
			</div>

			<div class="tiepanel-item">
				<h3>Leaderboard Ad Codes</h3>
				<?php
					tie_options(				
						array(	"name" => "Top Banner",
								"id" => "banner_top",
								"type" => "checkbox"));
				?>

				<?php
					tie_options(					
						array(	"name" => "Generic Leaderboard Code",
								"id" => "banner_top_adsense",
								"type" => "textarea")); 
					tie_options(					
						array(	"name" => "News Leaderboard Code",
								"id" => "banner_top_news",
								"type" => "textarea")); 
					tie_options(					
						array(	"name" => "Ops Leaderboard Code",
								"id" => "banner_top_ops",
								"type" => "textarea")); 
					tie_options(					
						array(	"name" => "Sports Leaderboard Code",
								"id" => "banner_top_sports",
								"type" => "textarea")); 
					tie_options(					
						array(	"name" => "Arts Leaderboard Code",
								"id" => "banner_top_arts",
								"type" => "textarea")); 
				?>

				<div class="tie-accordion">
					<h4 class="accordion-head"><a href="">Image Ad (ignore)</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name" => "Top Banner Image",
								"id" => "banner_top_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "Top Banner Link",
								"id" => "banner_top_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "Alternative Text For The image",
								"id" => "banner_top_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "Open The Link In a new Tab",
								"id" => "banner_top_tab",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Nofollow",
								"id" => "banner_top_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">Responsive Google AdSense (ignore)</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "Publisher ID",
								"id" => "banner_top_publisher",
								"type" => "text"));

					tie_options(					
						array(	"name" => "728x90 (Leaderboard) - ad ID",
								"id" => "banner_top_728",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "468x60 (Banner) - ad ID",
								"id" => "banner_top_468",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "300x250 (Medium Rectangle) - ad ID",
								"id" => "banner_top_300",
								"type" => "text"));

				?>
					</div>
				</div>
			</div>


			<div class="tiepanel-item">
				<h3>Background Image ADS</h3>
				<?php
					tie_options(				
						array(	"name" => "Enable Background Image ADS",
								"id" => "banner_bg",
								"type" => "checkbox")); 	
							
					tie_options(					
						array(	"name" => "Background Image ADS Link",
								"id" => "banner_bg_url",
								"type" => "text"));
				?>
				<p class="tie_message_hint">
					Go to "Styling" tab and set "Background Type" to "Custom Background" then upload your custom image and enable <strong>"Full Screen Background"</strong> option ... <a href="http://themes.tielabs.com/docs/sahifa/#!/setting_up_a_background" target="_blank">check this</a> for more info .
				</p>
			</div>
			

			<div class="tiepanel-item">
				<h3>Bottom Banner Area</h3>
				<?php
					tie_options(				
						array(	"name" => "Bottom Banner",
								"id" => "banner_bottom",
								"type" => "checkbox")); 
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href="">Image Ad</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name" => "Bottom Banner Image",
								"id" => "banner_bottom_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "Bottom Banner Link",
								"id" => "banner_bottom_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "Alternative Text For The image",
								"id" => "banner_bottom_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "Open The Link In a new Tab",
								"id" => "banner_bottom_tab",
								"type" => "checkbox"));
						
					tie_options(
						array(	"name" => "Nofollow",
								"id" => "banner_bottom_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">Responsive Google AdSense</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "Publisher ID",
								"id" => "banner_bottom_publisher",
								"type" => "text"));

					tie_options(					
						array(	"name" => "728x90 (Leaderboard) - ad ID",
								"id" => "banner_bottom_728",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "468x60 (Banner) - ad ID",
								"id" => "banner_bottom_468",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "300x250 (Medium Rectangle) - ad ID",
								"id" => "banner_bottom_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">Custom Code</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "Custom Ad Code",
								"id" => "banner_bottom_adsense",
								"extra_text" => 'Supports <strong>Text, HTML and Shortcodes</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>
	
	
			<div class="tiepanel-item">
				<h3>Above Article Banner Area</h3>
				<?php
					tie_options(				
						array(	"name" => "Above Article Banner",
								"id" => "banner_above",
								"type" => "checkbox")); 	
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href="">Image Ad</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name" => "Above Article Banner Image",
								"id" => "banner_above_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "Above Article Banner Link",
								"id" => "banner_above_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "Alternative Text For The image",
								"id" => "banner_above_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "Open The Link In a new Tab",
								"id" => "banner_above_tab",
								"type" => "checkbox"));
					
					tie_options(
						array(	"name" => "Nofollow",
								"id" => "banner_above_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">Responsive Google AdSense</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "Publisher ID",
								"id" => "banner_above_publisher",
								"type" => "text"));
	
					tie_options(					
						array(	"name" => "468x60 (Banner) - ad ID",
								"id" => "banner_above_468",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "300x250 (Medium Rectangle) - ad ID",
								"id" => "banner_above_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">Custom Code</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "Custom Ad Code",
								"id" => "banner_above_adsense",
								"extra_text" => 'Supports <strong>Text, HTML and Shortcodes</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>
	
			
			<div class="tiepanel-item">
				<h3>Below Article Banner Area</h3>
				<?php
					tie_options(				
						array(	"name" => "Below Article Banner",
								"id" => "banner_below",
								"type" => "checkbox")); 	
				?>
				<div class="tie-accordion">
					<h4 class="accordion-head"><a href="">Image Ad</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(			
						array(	"name" => "Below Article Banner Image",
								"id" => "banner_below_img",
								"type" => "upload")); 
								
					tie_options(					
						array(	"name" => "Below Article Banner Link",
								"id" => "banner_below_url",
								"type" => "text")); 
								
					tie_options(				
						array(	"name" => "Alternative Text For The image",
								"id" => "banner_below_alt",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "Open The Link In a new Tab",
								"id" => "banner_below_tab",
								"type" => "checkbox"));
							
					tie_options(
						array(	"name" => "Nofollow",
								"id" => "banner_below_nofollow",
								"type" => "checkbox"));
				?>
					</div>
					<h4 class="accordion-head"><a href="">Responsive Google AdSense</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "Publisher ID",
								"id" => "banner_below_publisher",
								"type" => "text"));
	
					tie_options(					
						array(	"name" => "468x60 (Banner) - ad ID",
								"id" => "banner_below_468",
								"type" => "text"));
								
					tie_options(					
						array(	"name" => "300x250 (Medium Rectangle) - ad ID",
								"id" => "banner_below_300",
								"type" => "text"));

				?>
					</div>
					<h4 class="accordion-head"><a href="">Custom Code</a></h4>
					<div class="tie-accordion-contnet">
				<?php
					tie_options(					
						array(	"name" => "Custom Ad Code",
								"id" => "banner_below_adsense",
								"extra_text" => 'Supports <strong>Text, HTML and Shortcodes</strong> .',
								"type" => "textarea")); 
				?>
					</div>
				</div>
			</div>

			<div class="tiepanel-item">
				<h3>Shortcode ADS</h3>
				<?php
					tie_options(				
						array(	"name" => "[ads1] Shortcode Banner",
								"id" => "ads1_shortcode",
								"type" => "textarea")); 
	
					tie_options(
						array(	"name" => "[ads2] Shortcode Banner",
								"id" => "ads2_shortcode",
								"type" => "textarea")); 
				?>
			</div>
		</div> <!-- Banners Settings -->
		
			

		<div id="tab11" class="tab_content tabs-wrap">
			<h2>Sidebars</h2>	<?php echo $save ?>	
			
			<div class="tiepanel-item">
				<h3>Sidebar Position</h3>
				<div class="option-item">
					<?php
						$checked = 'checked="checked"';
						$tie_sidebar_pos = tie_get_option('sidebar_pos');
					?>
					<ul id="sidebar-position-options" class="tie-options">
						<li>
							<input id="tie_sidebar_pos" name="tie_options[sidebar_pos]" type="radio" value="right" <?php if($tie_sidebar_pos == 'right' || !$tie_sidebar_pos ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-right.png" /></a>
						</li>
						<li>
							<input id="tie_sidebar_pos" name="tie_options[sidebar_pos]" type="radio" value="left" <?php if($tie_sidebar_pos == 'left') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/sidebar-left.png" /></a>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="tiepanel-item">
				<h3>Add Sidebar</h3>
				<div class="option-item">
					<span class="label">Sidebar Name</span>
					
					<input id="sidebarName" type="text" size="56" style="direction:ltr; text-laign:left" name="sidebarName" value="" />
					<input id="sidebarAdd"  class="small_button" type="button" value="Add" />
					
					<ul id="sidebarsList">
					<?php $sidebars = tie_get_option( 'sidebars' ) ;
						if($sidebars){
							foreach ($sidebars as $sidebar) { ?>
						<li>
							<div class="widget-head"><?php echo $sidebar ?>  <input id="tie_sidebars" name="tie_options[sidebars][]" type="hidden" value="<?php echo $sidebar ?>" /><a class="del-sidebar"></a></div>
						</li>
							<?php }
						}
					?>
					</ul>
				</div>				
			</div>

			<div class="tiepanel-item" id="custom-sidebars">
				<h3>Custom Sidebars</h3>
				<?php
				
				$new_sidebars = array(''=> 'Default');
				if (class_exists('Woocommerce'))
					$new_sidebars ['shop-widget-area'] = __( 'Shop - For WooCommerce Pages', 'tie' ) ;

				if($sidebars){
					foreach ($sidebars as $sidebar) {
						$new_sidebars[$sidebar] = $sidebar;
					}
				}
				
				
				tie_options(				
					array(	"name" => "Home Sidebar",
							"id" => "sidebar_home",
							"type" => "select",
							"options" => $new_sidebars ));
							
				tie_options(				
					array(	"name" => "Single Page Sidebar",
							"id" => "sidebar_page",
							"type" => "select",
							"options" => $new_sidebars ));
							
				tie_options(				
					array(	"name" => "Single Article Sidebar",
							"id" => "sidebar_post",
							"type" => "select",
							"options" => $new_sidebars ));
							
				tie_options(				
					array(	"name" => "Archives Sidebar",
							"id" => "sidebar_archive",
							"type" => "select",
							"options" => $new_sidebars ));

				if(class_exists( 'bbPress' ))
				tie_options(				
					array(	"name" => "bbPress Sidebar",
							"id" => "sidebar_bbpress",
							"type" => "select",
							"options" => $new_sidebars )); 

				?>
				<p class="tie_message_hint">
				You can Set Custom Sidebars for Your Categories from category's edit page .. Go to <strong><a target="Blank" href="edit-tags.php?taxonomy=category">Categories Page</a></strong> - edit the Category you want and choose your custom sidebar from <strong><?php echo theme_name;?> - Category Settings</strong> box  .
				</p>
			</div>
		</div> <!-- Sidebars -->
		
		
		<div id="tab12" class="tab_content tabs-wrap">
			<h2>Archives Settings</h2>	<?php echo $save ?>	
			
			<div class="tiepanel-item">
				<h3>General Settings</h3>
				<p class="tie_message_hint">Following settings will applies on the homepage blog layout and all pages with blog List template .</p>
				<?php
					tie_options(
						array(	"name" => "Display",
								"id" => "blog_display",
								"help" => "will appears in all archives pages like categories / tags / search and in homepage blog style .",
								"type" => "radio",
								"options" => array( "excerpt"=>"Excerpt + Featured image" ,
													"full_thumb"=>"Excerpt + Full width Featured image" ,
													"content"=>"Content" )));
								
					tie_options(
						array(	"name" => "Show Social Buttons",
								"id" => "archives_socail",
								"type" => "checkbox",
								"help" => "if checked Facebook , Twitter , Google plus and Pinterest social buttons will appear in all archives pages like categories / tags / search and in homepage blog style ." ));
					
					tie_options(
						array( 	"name" => "Excerpt Length",
								"id" => "exc_length",
								"type" => "short-text"));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>Archives Posts Meta</h3>
				<p class="tie_message_hint">Following settings will applies on the homepage blog layout and all pages with blog List template .</p>
				<?php
					tie_options(
						array(	"name" => "Review Score",
								"id" => "arc_meta_score",
								"type" => "checkbox" )); 			
					tie_options(
						array(	"name" => "Author Meta",
								"id" => "arc_meta_author",
								"type" => "checkbox")); 			
					tie_options(
						array(	"name" => "Date Meta",
								"id" => "arc_meta_date",
								"type" => "checkbox"));
					tie_options(
						array(	"name" => "Categories Meta",
								"id" => "arc_meta_cats",
								"type" => "checkbox")); 
					tie_options(
						array(	"name" => "Comments Meta",
								"id" => "arc_meta_comments",
								"type" => "checkbox")); 
				?>
			</div>	
			
			<div class="tiepanel-item">
				<h3>Category Page Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Category Description",
								"id" => "category_desc",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "RSS Icon",
								"id" => "category_rss",
								"type" => "checkbox"));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>Tag Page Settings</h3>
				<?php
					tie_options(
						array(	"name" => "RSS Icon",
								"id" => "tag_rss",
								"type" => "checkbox"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Author Page Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Author Bio",
								"id" => "author_bio",
								"type" => "checkbox"));
				?>
				<?php
					tie_options(
						array(	"name" => "RSS Icon",
								"id" => "author_rss",
								"type" => "checkbox"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Search Page Settings</h3>
				<?php
					tie_options(
						array(	"name" => "Search in Category IDs",
								"id" => "search_cats",
								"help" => "Use minus sign (-) to exclude categories. Example: (1,4,-7) = search only in Category 1 & 4, and exclude Category 7.",
								"type" => "text"));
				?>
				<?php
					tie_options(
						array(	"name" => "Exclude Pages in results",
								"id" => "search_exclude_pages",
								"type" => "checkbox"));
				?>
			</div>
		</div> <!-- Archives -->
				
				
		<div id="tab13" class="tab_content tabs-wrap">
			<h2>Styling</h2>	<?php echo $save ?>	
			<div class="tiepanel-item">
				<h3>Theme Color and Settings</h3>

				<div class="option-item">
					<span class="label">Choose Theme Color</span>
			
					<?php
						$checked = 'checked="checked"';
						$theme_color = tie_get_option('theme_skin');
					?>
					<ul style="clear:both" id="theme-skins" class="tie-options">
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="0" <?php if(!$theme_color) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-none.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#ef3636" <?php if($theme_color == '#ef3636' ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-red.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#37b8eb" <?php if($theme_color == '#37b8eb') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-blue.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#81bd00" <?php if($theme_color == '#81bd00') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-green.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#e95ca2" <?php if($theme_color == '#e95ca2') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-pink.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#000" <?php if($theme_color == '#000') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-black.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#ffbb01" <?php if($theme_color == '#ffbb01' ) echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-yellow.png" /></a>
						</li>
						<li>
							<input id="tie_theme_skin"  name="tie_options[theme_skin]" type="radio" value="#7b77ff" <?php if($theme_color == '#7b77ff') echo $checked; ?> />
							<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/skin-purple.png" /></a>
						</li>
					</ul>
				</div>

				<?php
					tie_options(
						array(	"name" => "Custom Theme Color",
								"id" => "global_color",
								"type" => "color"));

					tie_options(				
						array(	"name" => "Dark Skin",
								"id" => "dark_skin",
								"type" => "checkbox")); 
								
					tie_options(				
						array(	"name" => "Modern Colored Scrollbar",
								"id" => "modern_scrollbar",
								"type" => "checkbox",
								"extra_text" => 'For Chrome and Safari only .'));
				?>
			</div>	
			<div class="tiepanel-item">

				<h3>Background Type</h3>
				<?php
					tie_options(
						array( 	"name" => "Background Type",
								"id" => "background_type",
								"type" => "radio",
								"options" => array( "pattern"=>"Pattern" ,
													"custom"=>"Custom Background" )));
				?>
			</div>

			<div class="tiepanel-item" id="pattern-settings">
				<h3>Choose Pattern</h3>
				
				<?php
					tie_options(
						array( 	"name" => "Background Color",
								"id" => "background_pattern_color",
								"type" => "color" ));
				?>
				
				<?php
					$checked = 'checked="checked"';
					$theme_pattern = tie_get_option('background_pattern');
				?>
				<ul id="theme-pattern" class="tie-options">
					<?php for($i=1 ; $i<=36 ; $i++ ){ 
					 $pattern = 'body-bg'.$i; ?>
					<li>
						<input id="tie_background_pattern"  name="tie_options[background_pattern]" type="radio" value="<?php echo $pattern ?>" <?php if($theme_pattern == $pattern ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/panel/images/pattern<?php echo $i ?>.png" /></a>
					</li>
					<?php } ?>
				</ul>
			</div>

			<div class="tiepanel-item" id="bg_image_settings">
				<h3>Custom Background</h3>
				<?php
					tie_options(
						array(	"name" => "Custom Background",
								"id" => "background",
								"type" => "background"));
				?>
				<?php
					tie_options(
						array(	"name" => "Full Screen Background",
								"id" => "background_full",
								"type" => "checkbox"));
				?>

			</div>	
			<div class="tiepanel-item">
				<h3>Body Styling</h3>
				<?php
				
					tie_options(
						array(	"name" => "Highlighted Text Color",
								"id" => "highlighted_color",
								"type" => "color"));
								
					tie_options(
						array(	"name" => "Links Color",
								"id" => "links_color",
								"type" => "color"));
					tie_options(
						array(	"name" => "Links Decoration",
								"id" => "links_decoration",
								"type" => "select",
								"options" => array( ""=>"Default" ,
													"none"=>"none",
													"underline"=>"underline",
													"overline"=>"overline",
													"line-through"=>"line-through" )));

					tie_options(
						array(	"name" => "Links Color on mouse over",
								"id" => "links_color_hover",
								"type" => "color"));
	
					tie_options(
						array(	"name" => "Links Decoration on mouse over",
								"id" => "links_decoration_hover",
								"type" => "select",
								"options" => array( ""=>"Default" ,
													"none"=>"none",
													"underline"=>"underline",
													"overline"=>"overline",
													"line-through"=>"line-through" )));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>Top Navigation Styling</h3>
				<?php
					tie_options(
						array(	"name" => "Background",
								"id" => "topbar_background",
								"type" => "background"));
				?>
				<?php
					tie_options(
						array(	"name" => "Links Color",
								"id" => "topbar_links_color",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "Links Color on mouse over",
								"id" => "topbar_links_color_hover",
								"type" => "color"));
				?>

				<?php
					tie_options(
						array(	"name" => "Today Date background",
								"id" => "todaydate_background",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "Today Date text color",
								"id" => "todaydate_color",
								"type" => "color"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Header Background</h3>
				<?php
					tie_options(
						array(	"name" => "Background",
								"id" => "header_background",
								"type" => "background"));
				?>
			</div>
			
						
			<div class="tiepanel-item">
				<h3>Main Navigation Styling</h3>
				<p class="tie_message_hint">To change the Main Nav background you need to edit <strong>images/main-menu-bg</strong> via photo editing software and change it's color .</p>
				<?php
					tie_options(
						array(	"name" => "Sub Menu Background",
								"id" => "sub_nav_background",
								"type" => "color"));

					tie_options(
						array(	"name" => "Links Color",
								"id" => "nav_links_color",
								"type" => "color"));
										
					tie_options(
						array(	"name" => "Links Text Shadow Color",
								"id" => "nav_shadow_color",
								"type" => "color"));
								
					tie_options(
						array(	"name" => "Links Color on mouse over",
								"id" => "nav_links_color_hover",
								"type" => "color"));

					tie_options(
						array(	"name" => "Links Text Shadow Color on mouse over",
								"id" => "nav_shadow_color_hover",
								"type" => "color"));
								
					tie_options(
						array(	"name" => "Current Item Links Color",
								"id" => "nav_current_links_color",
								"type" => "color"));
										
					tie_options(
						array(	"name" => "Current Item Links Text Shadow Color",
								"id" => "nav_current_shadow_color",
								"type" => "color"));

					tie_options(
						array(	"name" => "Seprator Line1 color",
								"id" => "nav_sep1",
								"type" => "color"));
								
					tie_options(
						array(	"name" => "Seprator Line2 color",
								"id" => "nav_sep2",
								"type" => "color"));
				?>
			</div>
			
			
			<div class="tiepanel-item">
				<h3>Breaking News Styling</h3>
				<?php
					tie_options(
						array(	"name" => "Breaking News Text Background ",
								"id" => "breaking_title_bg",
								"type" => "color"));
				?>		
			</div>

			<div class="tiepanel-item">
				<h3>Content Styling</h3>
				<?php
					tie_options(
						array(	"name" => "Main Content Box Background ",
								"id" => "main_content_bg",
								"type" => "background"));

					tie_options(
						array(	"name" => "Boxes / Widgets Background ",
								"id" => "boxes_bg",
								"type" => "background"));

				?>		
			</div>
			<div class="tiepanel-item">
				<h3>Post Styling</h3>
				<?php
					tie_options(
						array(	"name" => "Post Links Color",
								"id" => "post_links_color",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "Post Links Decoration",
								"id" => "post_links_decoration",
								"type" => "select",
								"options" => array( ""=>"Default" ,
													"none"=>"none",
													"underline"=>"underline",
													"overline"=>"overline",
													"line-through"=>"line-through" )));
				?>
				<?php
					tie_options(
						array(	"name" => "Post Links Color on mouse over",
								"id" => "post_links_color_hover",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "Post Links Decoration on mouse over",
								"id" => "post_links_decoration_hover",
								"type" => "select",
								"options" => array( ""=>"Default" ,
													"none"=>"none",
													"underline"=>"underline",
													"overline"=>"overline",
													"line-through"=>"line-through" )));
				?>
			</div>
			<div class="tiepanel-item">
				<h3>Footer Background</h3>
				<?php
					tie_options(
						array(	"name" => "Background",
								"id" => "footer_background",
								"type" => "background"));
				?>
				<?php
					tie_options(
						array(	"name" => "Footer Widget Title color",
								"id" => "footer_title_color",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "Links Color",
								"id" => "footer_links_color",
								"type" => "color"));
				?>
				<?php
					tie_options(
						array(	"name" => "Links Color on mouse over",
								"id" => "footer_links_color_hover",
								"type" => "color"));
				?>
			</div>				
						
			<div class="tiepanel-item">
				<h3>Custom CSS</h3>	
				<div class="option-item">
					<p><strong>Global CSS :</strong></p>
					<textarea id="tie_css" name="tie_options[css]" style="width:100%" rows="7"><?php echo tie_get_option('css');  ?></textarea>
				</div>	
				<div class="option-item">
					<p><strong>Tablets CSS :</strong> Width from 768px to 985px</p>
					<textarea id="tie_css" name="tie_options[css_tablets]" style="width:100%" rows="7"><?php echo tie_get_option('css_tablets');  ?></textarea>
				</div>
				<div class="option-item">
					<p><strong>Wide Phones CSS :</strong> Width from 480px to 767px</p>
					<textarea id="tie_css" name="tie_options[css_wide_phones]" style="width:100%" rows="7"><?php echo tie_get_option('css_wide_phones');  ?></textarea>
				</div>
				<div class="option-item">
					<p><strong>Phones CSS :</strong> Width from 320px to 479px</p>
					<textarea id="tie_css" name="tie_options[css_phones]" style="width:100%" rows="7"><?php echo tie_get_option('css_phones');  ?></textarea>
				</div>	
			</div>	

		</div> <!-- Styling -->

	
		
		<div id="tab14" class="tab_content tabs-wrap">
			<h2>Typography</h2>	<?php echo $save ?>	
			
			<div class="tiepanel-item">
				<h3>Character sets</h3>
				<p class="tie_message_hint"><strong>Tip:</strong> If you choose only the languages that you need, you'll help prevent slowness on your webpage.</p>
				<?php
					tie_options(
						array(	"name" => "Latin Extended",
								"id" => "typography_latin_extended",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Cyrillic",
								"id" => "typography_cyrillic",
								"type" => "checkbox"));

					tie_options(
						array(	"name" => "Cyrillic Extended",
								"id" => "typography_cyrillic_extended",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Greek",
								"id" => "typography_greek",
								"type" => "checkbox"));
								
					tie_options(
						array(	"name" => "Greek Extended",
								"id" => "typography_greek_extended",
								"type" => "checkbox"));	
								
					tie_options(
						array(	"name" => "Khmer",
								"id" => "typography_khmer",
								"type" => "checkbox"));		
								
					tie_options(
						array(	"name" => "Vietnamese",
								"id" => "typography_vietnamese",
								"type" => "checkbox"));
				?>
			</div>
			
			<div class="tiepanel-item">
				<h3>Live typography preview</h3>
					<?php 	global $options_fonts;
					tie_options(
						array( 	"name" => "",
								"id" => "typography_test",
								"type" => "typography"));
						?>
	
				<div id="font-preview" class="option-item">Grumpy wizards make toxic brew for the evil Queen and Jack.</div>		

			</div>
			<div class="tiepanel-item">
				<h3>Main Typography</h3>
				<?php
					tie_options(
						array( 	"name" => "General Typography",
								"id" => "typography_general",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "Site Title In Header",
								"id" => "typography_site_title",
								"type" => "typography"));	

					tie_options(
						array( 	"name" => "Tagline In Header",
								"id" => "typography_tagline",
								"type" => "typography"));	
								
					tie_options(
						array( 	"name" => "Top Menu",
								"id" => "typography_top_menu",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "Main navigation",
								"id" => "typography_main_nav",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "Slider Post Title",
								"id" => "typography_slider_title",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "Page Title",
								"id" => "typography_page_title",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "Single Post Title",
								"id" => "typography_post_title",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "Post Title in Homepage Boxes and Post Titles in Blog Layout",
								"id" => "typography_post_title_boxes",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "Small Post Title in Homepage Boxes",
								"id" => "typography_post_title2_boxes",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "Post Meta",
								"id" => "typography_post_meta",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "Post Entry",
								"id" => "typography_post_entry",
								"type" => "typography"));

					tie_options(
						array( 	"name" => "News Boxes Titles",
								"id" => "typography_boxes_title",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "Widgets Titles",
								"id" => "typography_widgets_title",
								"type" => "typography"));
								
					tie_options(
						array( 	"name" => "Footer Widgets Titles",
								"id" => "typography_footer_widgets_title",
								"type" => "typography"));
				?>
			</div>			
		</div> <!-- Typography -->
		
		
		<div id="tab10" class="tab_content tabs-wrap">
			<h2>Advanced Settings</h2>	<?php echo $save ?>	

			<div class="tiepanel-item">
				<h3>Disable the Responsiveness</h3>
				<?php
					tie_options(
						array(	"name" => "Disable Responsive",
								"id" => "disable_responsive",
								"type" => "checkbox"));
				?>
				<p class="tie_message_hint">This option works only on Tablets and Phones .. to disable the responsiveness action on the desktop .. edit style.css file and remove all Media Quries from the end of the file .</p>
			</div>	
			
			<div class="tiepanel-item">
				<h3>Disable Theme [Gallery] Shortcode</h3>
				<?php
					tie_options(
						array(	"name" => "Disable Theme [Gallery]",
								"id" => "disable_gallery_shortcode",
								"type" => "checkbox"));
				?>
				<p class="tie_message_hint">Set it to <strong>ON</strong> if you want to use the Jetpack Tiled Galleries or if you uses custom lightbox plugin for [Gallery] shortcode .</p>
			</div>	
			
			<div class="tiepanel-item">
				<h3>Twitter API OAuth settings</h3>
				<p class="tie_message_hint">This information will uses in Social counter and Twitter Widget .. You need to create <a href="https://dev.twitter.com/apps" target="_blank">Twitter APP</a> to get this info .. check this <a href="https://vimeo.com/59573397" target="_blank">Video</a> .</p>

				<?php
					tie_options(
						array(	"name" => "Twitter Username",
								"id" => "twitter_username",
								"type" => "text"));

					tie_options(
						array(	"name" => "Consumer key",
								"id" => "twitter_consumer_key",
								"type" => "text"));
								
					tie_options(
						array(	"name" => "Consumer secret",
								"id" => "twitter_consumer_secret",
								"type" => "text"));	
								
					tie_options(
						array(	"name" => "Access token",
								"id" => "twitter_access_token",
								"type" => "text"));	
								
					tie_options(
						array(	"name" => "Access token secret",
								"id" => "twitter_access_token_secret",
								"type" => "text"));
				?>
			</div>	
			
			<div class="tiepanel-item">
				<h3>Image Resizing</h3>
				
				<?php
					tie_options(
						array(	"name" => "TimThumb <small style='font-weight:bold;'>(Not Recommended)</small>",
								"id" => "timthumb",
								"type" => "checkbox"));
				?>
			</div>	
				
			<div class="tiepanel-item">
				<h3>Theme Updates</h3>
				<?php
					tie_options(
						array(	"name" => "Notify On Theme Updates",
								"id" => "notify_theme",
								"type" => "checkbox"));
				?>
			</div>

			<div class="tiepanel-item">
				<h3>Wordpress Login page Logo</h3>
				<?php
					tie_options(
						array(	"name" => "Worpress Login page Logo",
								"id" => "dashboard_logo",
								"type" => "upload"));

					tie_options(
						array(	"name" => "Worpress Login page Logo URL",
								"id" => "dashboard_logo_url",
								"type" => "text"));
				?>
			
			</div>
			<?php
				global $array_options ;
				
				$current_options = array();
				foreach( $array_options as $option ){
					if( get_option( $option ) )
						$current_options[$option] =  get_option( $option ) ;
				}
			?>
			
			<div class="tiepanel-item">
				<h3>Export</h3>
				<div class="option-item">
					<textarea style="width:100%" rows="7"><?php echo $currentsettings = base64_encode( serialize( $current_options )); ?></textarea>
				</div>
			</div>
			<div class="tiepanel-item">
				<h3>Import</h3>
				<div class="option-item">
					<textarea id="tie_import" name="tie_import" style="width:100%" rows="7"></textarea>
				</div>
			</div>


		</div> <!-- Advanced -->
		
		
		<div class="mo-footer">
			<?php echo $save; ?>
		</form>

			<form method="post">
				<div class="mpanel-reset">
					<input type="hidden" name="resetnonce" value="<?php echo wp_create_nonce('reset-action-code'); ?>" />
					<input name="reset" class="mpanel-reset-button" type="submit" onClick="if(confirm('All settings will be rest .. Are you sure ?')) return true ; else return false; " value="Reset All Settings" />
					<input type="hidden" name="action" value="reset" />
				</div>
			</form>
		</div>

	</div><!-- .mo-panel-content -->
	<div class="clear"></div>
</div><!-- .mo-panel -->
<?php 
}
?>
