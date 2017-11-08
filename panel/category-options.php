<?php

add_action ( 'edit_category_form_fields', 'tie_category_fields');
function tie_category_fields( $tag ) {    //check for existing featured ID
    $t_id = $tag->term_id;
	$cat_option = get_option('tie_cat_'.$t_id);

	wp_print_scripts('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');

	$sidebars = tie_get_option( 'sidebars' ) ;
	$new_sidebars = array(''=> 'Default');
	
	if (class_exists('Woocommerce'))
		$new_sidebars ['shop-widget-area'] = __( 'Shop - For WooCommerce Pages', 'tie' ) ;
		
	if($sidebars){
		foreach ($sidebars as $sidebar) {
		$new_sidebars[$sidebar] = $sidebar;
		}
	}
		
	$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
	$cat_slider = array();
	$cat_slider[''] = 'Disabled';
	$cat_slider['recent'] = 'Recent Posts';
	$cat_slider['random'] = 'Random Posts';

	while ( $custom_slider->have_posts() ) {
		$custom_slider->the_post();
		$cat_slider[get_the_ID()] = get_the_title();
	}
?>
<tr class="form-field">
	<td colspan="2">
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				jQuery('.on-of').checkbox({empty:'<?php echo get_template_directory_uri(); ?>/panel/images/empty.png'});
			});
			
			//To Fix WPML Bug
			jQuery( window ).load(function($) {
				var logo_settings = jQuery('input[name=logo_setting_save]').val();
					jQuery("#logo_setting-item input").each(function(){	
					if( jQuery(this).val() == logo_settings ) jQuery(this).attr('checked','checked');
			});
		 });
		</script>
		<div class="tiepanel-item">
			<h3>Blog settings</h3>
			<?php tie_cat_options(
					array(	"name" => "Blog Style",
							"id" => "cat_blog_style",
							"cat" => $t_id ,
							"extra_text" => 'Display the category page like a blog instead of in the normal format' ,
							"type" => "checkbox"));
			?>
		</div>	
							
		<div class="tiepanel-item">
			<h3><?php echo theme_name ?> - Category Settings</h3>
			<?php
				tie_cat_options(
					array(	"name" => "Mega Menu",
							"id" => "cat_mega_menu",
							"cat" => $t_id ,
							"extra_text" => 'To show latest posts in the Main Nav .' ,
							"type" => "checkbox"));

				tie_cat_options(
					array(	"name" => "Category Ubergrid",
							"id" => "cat_ubergrid",
							"cat" => $t_id ,
							"type" => "checkbox"));
							
				tie_cat_options(				
					array(	"name" => 'Custom Sidebar',
							"id" => "cat_sidebar",
							"type" => "select",
							"cat" => $t_id ,
							"options" => $new_sidebars ));
							
				tie_cat_options(				
					array(	"name" => 'Custom Slider',
							"id" => "cat_slider",
							"type" => "select",
							"cat" => $t_id ,
							"options" => $cat_slider )); 
			
			?>
		</div>	
		
		<div class="tiepanel-item">
			<h3><?php echo theme_name ?> - Category Logo</h3>
			<?php
				tie_cat_options(
					array(	"name" => "Custom Logo",
							"id" => "cat_custom_logo",
							"cat" => $t_id ,
							"type" => "checkbox"));
							
				tie_cat_options(
					array( 	"name" => "Logo Setting",
							"id" => "logo_setting",
							"type" => "radio",
							"cat" => $t_id ,
							"options" => array( "logo"=>"Custom Image Logo" ,
												"title"=>"Display The Category Title" )));
				?>
				<input type="hidden" name="logo_setting_save" value="<?php if( !empty($cat_option[ 'logo_setting' ]) )  echo $cat_option['logo_setting'];?>" />
				<?php
				tie_cat_options(
					array(	"name" => "Custom Logo Image",
							"id" => "logo",
							"cat" => $t_id ,
							"type" => "upload"));
					
				tie_cat_options(
					array(	"name" => "Logo Image (Retina Version @2x)",
							"id" => "logo_retina",
							"type" => "upload",
							"cat" => $t_id ,
							"extra_text" => 'Please choose an image file for the retina version of the logo. It should be 2x the size of main logo.')); 			
					
				tie_cat_options(
					array(	"name" => "Standard Logo Width for Retina Logo",
							"id" => "logo_retina_width",
							"type" => "short-text",
							"cat" => $t_id ,
							"extra_text" => 'If retina logo is uploaded, please enter the standard logo (1x) version width, do not enter the retina logo width.')); 			

				tie_cat_options(
					array(	"name" => "Standard Logo Height for Retina Logo",
							"id" => "logo_retina_height",
							"type" => "short-text",
							"cat" => $t_id ,
							"extra_text" => 'If retina logo is uploaded, please enter the standard logo (1x) version height, do not enter the retina logo height.')); 			
								
								
				tie_cat_options(
					array(	"name" => "Logo Margin Top",
							"id" => "logo_margin",
							"type" => "slider",
							"cat" => $t_id ,
							"unit" => "px",
							"max" => 100,
							"min" => 0 ));
			?>
		</div>
		
		<div class="tiepanel-item">
			<h3><?php echo theme_name ?> - Category Style </h3>
			<?php
				tie_cat_options(				
					array(	"name" => "Main color",
							"id" => "cat_color",
							"cat" => $t_id ,
							"type" => "color" ));
								
				tie_cat_options(
					array(	"name" => "Background",
							"id" => "cat_background",
							"cat" => $t_id ,
							"type" => "background"));
								
				tie_cat_options(
					array(	"name" => "Full Screen Background",
							"id" => "cat_background_full",
							"cat" => $t_id ,
							"type" => "checkbox"));
				?>
		</div>
				
	</td>
</tr>
<?php
}


// save extra category extra fields hook
add_action ( 'edited_category', 'tie_save_extra_category_fileds');
   // save extra category extra fields callback function
function tie_save_extra_category_fileds( $term_id ) {
	$t_id = $term_id;
	update_option( "tie_cat_$t_id", $_POST["tie_cat"] );
}




function tie_cat_options($value){
	global $options_fonts;
?>
	<div class="option-item" id="<?php echo $value['id'] ?>-item">
		<span class="label"><?php  echo $value['name']; ?></span>
	<?php
	$cat_option = get_option('tie_cat_'.$value['cat']);
	
	switch ( $value['type'] ) {

		case 'checkbox':
			if( !empty($cat_option[$value['id']]) ){$checked = "checked=\"checked\"";  } else{$checked = "";} ?>
				<input class="on-of" type="checkbox" name="tie_cat[<?php echo $value['id']; ?>]" id="<?php echo $value['id'] ?>" value="true" <?php echo $checked; ?> />			
		<?php	
		break;
		
		case 'radio': 
		?>
			<div style="float:left; width: 295px;">
				<?php foreach ($value['options'] as $key => $option) {?>
				<label style="display:block; margin-bottom:8px;"><input  <?php if( !empty($cat_option[$value['id']]) ) checked($cat_option[$value['id']] , $key); ?> id="<?php echo $value['id'] ?>" name="tie_cat[<?php echo $value['id']; ?>]" type="radio" value="<?php echo $key ?>"> <?php echo $option; ?></label>
				<?php } ?>
			</div>
		<?php
		break;
		
		case 'select':
		?>
			<select name="tie_cat[<?php echo $value['id']; ?>]" id="<?php echo $value['id']; ?>">
				<?php foreach ($value['options'] as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( $cat_option[$value['id']] == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		<?php
		break;
		
		case 'upload':
		?>
				<input id="<?php echo $value['id']; ?>" class="img-path" type="text" size="56" style="direction:ltr; text-laign:left" name="tie_cat[<?php echo $value['id']; ?>]" value="<?php if( !empty($cat_option[$value['id']]) ) echo $cat_option[$value['id']]; ?>" />
				<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="small_button" value="Upload" />
					
				<div id="<?php echo $value['id']; ?>-preview" class="img-preview" <?php if( empty( $cat_option[$value['id']] ) ) echo 'style="display:none;"' ?>>
					<img src="<?php if( !empty( $cat_option[$value['id']] ) ) echo $cat_option[$value['id']] ; else echo get_template_directory_uri().'/panel/images/spacer.png'; ?>" alt="" />
					<a class="del-img" title="Delete"></a>
				</div>
		<?php
		break;

		case 'slider':
		?>
				<div id="<?php echo $value['id']; ?>-slider"></div>
				<input type="text" id="<?php echo $value['id']; ?>" value="<?php if( !empty( $cat_option[$value['id']]) ) echo $cat_option[$value['id']]; ?>" name="tie_cat[<?php echo $value['id']; ?>]" style="width:50px;" /> <?php echo $value['unit']; ?>
				<script>
				  jQuery(document).ready(function() {
					jQuery("#<?php echo $value['id']; ?>-slider").slider({
						range: "min",
						min: <?php echo $value['min']; ?>,
						max: <?php echo $value['max']; ?>,
						value: <?php if( $cat_option[$value['id']] ) echo $cat_option[$value['id']]; else echo 0; ?>,

						slide: function(event, ui) {
						jQuery('#<?php echo $value['id']; ?>').attr('value', ui.value );
						}
					});
				  });
				</script>
		<?php
		break;
		
		
		case 'background':
	?>
				<input id="<?php echo $value['id']; ?>-img" class="img-path" type="text" size="56" style="direction:ltr; text-align:left" name="tie_cat[<?php echo $value['id']; ?>][img]" value="<?php if( !empty($cat_option[$value['id']]['img']) ) echo $cat_option[$value['id']]['img']; ?>" />
				<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="small_button" value="Upload" />
					
				<div style="margin-top:15px; clear:both">
					<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php if( !empty($cat_option[$value['id']]['color']) ) echo $cat_option[$value['id']]['color'] ; ?>"></div></div>
					<input style="width:80px; margin-right:5px;"  name="tie_cat[<?php echo $value['id']; ?>][color]" id="<?php  echo $value['id']; ?>color" type="text" value="<?php if( !empty($cat_option[$value['id']]['color']) ) echo $cat_option[$value['id']]['color'] ; ?>" />
					
					<select name="tie_cat[<?php echo $value['id']; ?>][repeat]" id="<?php echo $value['id']; ?>[repeat]" style="width:96px;">
						<option value="" <?php if ( empty ($cat_option[$value['id']]['repeat']) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="repeat" <?php if ( !empty($cat_option[$value['id']]['repeat']) && $cat_option[$value['id']]['repeat']  == 'repeat' ) { echo ' selected="selected"' ; } ?>>repeat</option>
						<option value="no-repeat" <?php if ( !empty($cat_option[$value['id']]['repeat']) && $cat_option[$value['id']]['repeat']  == 'no-repeat') { echo ' selected="selected"' ; } ?>>no-repeat</option>
						<option value="repeat-x" <?php if ( !empty($cat_option[$value['id']]['repeat']) && $cat_option[$value['id']]['repeat'] == 'repeat-x') { echo ' selected="selected"' ; } ?>>repeat-x</option>
						<option value="repeat-y" <?php if ( !empty($cat_option[$value['id']]['repeat']) && $cat_option[$value['id']]['repeat'] == 'repeat-y') { echo ' selected="selected"' ; } ?>>repeat-y</option>
					</select>

					<select name="tie_cat[<?php echo $value['id']; ?>][attachment]" id="<?php echo $value['id']; ?>[attachment]" style="width:96px;">
						<option value="" <?php if ( empty( $cat_option[$value['id']]['attachment']) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="fixed" <?php if ( !empty($cat_option[$value['id']]['attachment']) && $cat_option[$value['id']]['attachment']  == 'fixed' ) { echo ' selected="selected"' ; } ?>>Fixed</option>
						<option value="scroll" <?php if ( !empty($cat_option[$value['id']]['attachment']) && $cat_option[$value['id']]['attachment']  == 'scroll') { echo ' selected="selected"' ; } ?>>scroll</option>
					</select>
					
					<select name="tie_cat[<?php echo $value['id']; ?>][hor]" id="<?php echo $value['id']; ?>[hor]" style="width:96px;">
						<option value="" <?php if ( empty($cat_option[$value['id']]['hor']) ) { echo ' selected="selected"' ; } ?>></option>
						<option value="left" <?php if ( !empty($cat_option[$value['id']]['hor']) && $cat_option[$value['id']]['hor']  == 'left' ) { echo ' selected="selected"' ; } ?>>Left</option>
						<option value="right" <?php if ( !empty($cat_option[$value['id']]['hor']) && $cat_option[$value['id']]['hor']  == 'right') { echo ' selected="selected"' ; } ?>>Right</option>
						<option value="center" <?php if ( !empty($cat_option[$value['id']]['hor']) && $cat_option[$value['id']]['hor'] == 'center') { echo ' selected="selected"' ; } ?>>Center</option>
					</select>
					
					<select name="tie_cat[<?php echo $value['id']; ?>][ver]" id="<?php echo $value['id']; ?>[ver]" style="width:100px;">
						<option value="" <?php if ( empty($cat_option[$value['id']]['ver'] )) { echo ' selected="selected"' ; } ?>></option>
						<option value="top" <?php if ( !empty($cat_option[$value['id']]['ver']) &&  $cat_option[$value['id']]['ver']  == 'top' ) { echo ' selected="selected"' ; } ?>>Top</option>
						<option value="center" <?php if ( !empty($cat_option[$value['id']]['ver']) && $cat_option[$value['id']]['ver'] == 'center') { echo ' selected="selected"' ; } ?>>Center</option>
						<option value="bottom" <?php if ( !empty($cat_option[$value['id']]['ver']) && $cat_option[$value['id']]['ver']  == 'bottom') { echo ' selected="selected"' ; } ?>>Bottom</option>

					</select>
				</div>
				<div id="<?php echo $value['id']; ?>-preview" class="img-preview" <?php if( empty($cat_option[$value['id']]['img'])  ) echo 'style="display:none;"' ?>>
					<img src="<?php if( !empty( $cat_option[$value['id']]['img']) ) echo $cat_option[$value['id']]['img'] ; else echo get_template_directory_uri().'/panel/images/spacer.png'; ?>" alt="" />
					<a class="del-img" title="Delete"></a>
				</div>
					
				<script>
				jQuery('#<?php echo $value['id']; ?>colorSelector').ColorPicker({
					color: '<?php if( !empty($cat_option[$value['id']]['color']) ) echo $cat_option[$value['id']]['color'] ; ?>',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery('#<?php echo $value['id']; ?>colorSelector div').css('backgroundColor', '#' + hex);
						jQuery('#<?php echo $value['id']; ?>color').val('#'+hex);
					}
				});
				tie_styling_uploader('<?php echo $value['id']; ?>');
				</script>
		<?php
		break;
		
		
		case 'color':
		?>
			<div id="<?php echo $value['id']; ?>colorSelector" class="color-pic"><div style="background-color:<?php echo $cat_option[$value['id']] ; ?>"></div></div>
			<input style="width:80px; margin-right:5px;"  name="tie_cat[<?php echo $value['id']; ?>]" id="<?php echo $value['id']; ?>" type="text" value="<?php echo $cat_option[$value['id']]; ?>" />
							
			<script>
				jQuery('#<?php echo $value['id']; ?>colorSelector').ColorPicker({
					color: '<?php echo $cat_option[$value['id']] ; ?>',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery('#<?php echo $value['id']; ?>colorSelector div').css('backgroundColor', '#' + hex);
						jQuery('#<?php echo $value['id']; ?>').val('#'+hex);
					}
				});
				</script>
		<?php
		break;
		case 'short-text': ?>
			<input style="width:50px" name="tie_cat[<?php echo $value['id']; ?>]" id="<?php  echo $value['id']; ?>" type="text" value="<?php if( !empty( $cat_option[$value['id']]) ) echo $cat_option[$value['id']]; ?>" />
		<?php 
		break;		
}
		if( !empty( $value['extra_text'] ) ) { ?><span class="extra-text"><?php echo $value['extra_text'] ?></span><?php }
?>
</div>
			
<?php
}
?>
