<?php
if( ! defined( 'ABSPATH' )) exit;
	$PostId=$post->ID;
	$Def_Settings = unserialize(get_option('wpsm_cns_default_settings'));
	$Counter_Meta_Settings = unserialize(get_post_meta( $PostId, 'Counter_Meta_Settings' ,true));
						
			$option_names = array(
					'icon_clr'           => $Def_Settings['icon_clr'],
					'count_num_clr'      => $Def_Settings['count_num_clr'],
					'count_title_clr'    => $Def_Settings['count_title_clr'],
					'icon_size'          => $Def_Settings['icon_size'],
					'count_num_size'  	 => $Def_Settings['count_num_size'],
					'title_size'  		 => $Def_Settings['title_size'],
					'cn_weight'  		 => $Def_Settings['cn_weight'],
					'font_family'  		 => $Def_Settings['font_family'],
					'display_icon'  	 => $Def_Settings['display_icon'],
					'cn_layout'  		 => $Def_Settings['cn_layout'],
					'custom_css' 		 => $Def_Settings['custom_css'],
					
			);
			foreach($option_names as $option_name => $default_value) {
				if(isset($Counter_Meta_Settings[$option_name])) 
					${"" . $option_name}  = $Counter_Meta_Settings[$option_name];
				else
					${"" . $option_name}  = $default_value;
			}
?>
 
	<Script>
 //minimum flake size script
  jQuery(function() {
    jQuery( "#icon_size_id" ).slider({
		orientation: "horizontal",
		range: "min",
		max: 90,
		min:0,
		slide: function( event, ui ) {
		jQuery( "#icon_size" ).val( ui.value );
      }
		});
		jQuery( "#icon_size_id" ).slider("value",<?php if(isset($icon_size)){ echo $icon_size; } else{ echo 5; } ?> );
		jQuery( "#icon_size" ).val( jQuery( "#icon_size_id" ).slider("value") );
    
  });
</script>

<Script>

 //font slider size script
  jQuery(function() {
    jQuery( "#count_num_size_id" ).slider({
		orientation: "horizontal",
		range: "min",
		max: 100,
		min:0,
		slide: function( event, ui ) {
		jQuery( "#count_num_size" ).val( ui.value );
      }
		});
		
		jQuery( "#count_num_size_id" ).slider("value",<?php if(isset($count_num_size)){ echo $count_num_size; } else{ echo 30; } ?> );
		jQuery( "#count_num_size" ).val( jQuery( "#count_num_size_id" ).slider( "value") );
    
    
  });
</script>

<Script>

 //font slider size script
  jQuery(function() {
    jQuery( "#title_size_id" ).slider({
		orientation: "horizontal",
		range: "min",
		max: 50,
		min:0,
		slide: function( event, ui ) {
		jQuery( "#title_size" ).val( ui.value );
      }
		});
		
		jQuery( "#title_size_id" ).slider("value",<?php if(isset($title_size)){ echo $title_size; } else{ echo 25; } ?> );
		jQuery( "#title_size" ).val( jQuery( "#title_size_id" ).slider( "value") );
    
  });
</script>
 	
<Script>
	//font slider size script
	jQuery(function() {
		jQuery( "#sec_title_weight_id" ).slider({
			orientation: "horizontal",
			range: "min",
			max: 900,
			min:100,
			step: 100,
			slide: function( event, ui ) {
			jQuery( "#sec_title_weight" ).val( ui.value );
		  }
		});
		
		jQuery( "#sec_title_weight_id" ).slider("value",<?php if(isset($sec_title_weight)){ echo $sec_title_weight; } else{ echo 500; }  ?>);
		jQuery( "#sec_title_weight" ).val( jQuery( "#sec_title_weight_id" ).slider( "value") );

	});
</script> 
  
<Script>
	//font slider size script
	jQuery(function() {
		jQuery( "#cn_weight_id" ).slider({
			orientation: "horizontal",
			range: "min",
			max: 900,
			min:100,
			step: 100,
			slide: function( event, ui ) {
			jQuery( "#cn_weight" ).val( ui.value );
		  }
		});
		
		jQuery( "#cn_weight_id" ).slider("value",<?php if(isset($cn_weight)){ echo $cn_weight; } else{ echo 500; }  ?>);
		jQuery( "#cn_weight" ).val( jQuery( "#cn_weight_id" ).slider( "value") );

	});
</script> 

<script>
function get_font_group(){
	  
	 var family_group = jQuery('#font_family option:selected').closest('optgroup').prop('label');
	 jQuery("#font_family_group").val(family_group);
			
  }
</script>

<Script>
function updte_wpsm_counter_default_settings(){
	 jQuery.ajax({
		url: location.href,
		type: "POST",
		data : {
			    'action_ac_pro':'updte_wpsm_ac_default_settings',
			     },
                success : function(data){
									alert("Default Settings Updated");
									location.reload(true);
                                   }	
	});
	
}
</script>
<?php

	if(isset($_POST['action_ac_pro']) == "updte_wpsm_ac_default_settings")
	{
		$Settings_CN_Array = serialize( array(
				 
				'icon_clr' 		       => $icon_clr,
				'count_title_clr' 	   => $count_title_clr,
				'count_num_clr' 	   => $count_num_clr,
				'icon_size' 		   => $icon_size,
				'count_num_size' 	   => $count_num_size,
				'title_size' 		   => $title_size,
				'cn_weight' 		   => $cn_weight,
				'font_family' 		   => $font_family,
				'display_icon' 		   => $display_icon,
				'cn_layout' 		   => $cn_layout,
				'custom_css' 		   => $custom_css,
			) );

			update_option('wpsm_cns_default_settings', $Settings_CN_Array);
}

 ?> 
<style>
#Counter_settings{
	min-width: 255px;
	border: 0px solid #e5e5e5;
	box-shadow: 0 0px 0px rgba(0,0,0,.0);
	background: #fff;
}
#Counter_settings .hndle  , #Counter_settings .handlediv {
	display:none
}
.wpsm_site_sidebar_widget_title2{
	
	margin-left: 9px;
    margin-right: 2px;
    background: #31a3dd;
    padding: 10px;
    font-size: 20px;
    text-transform: uppercase;
    text-align: center;
    border-bottom: 9px double #FFF;
    box-shadow: 8px 8px 15px rgba(0,0,0,.4);
	margin-bottom:10px;
}
.wpsm_site_sidebar_widget_title2 h5{
	color: #fff !important;
	margin: 0px !important;
}
.modal-body{
	position:relative;
	overflow:hidden;
	padding:15px;
}

</style>
<input type="hidden" id="counterbox_setting_save_action" name="counterbox_setting_save_action" value="colorbox_setting_save_action">

<div class="wpsm_site_sidebar_widget_title" style="margin-left:-13px;margin-right:-13px;border-radius: 3px;margin-bottom:5px">
		<h4 style="border-top-left-radius: 2px;">Counter Settings</h4>
</div>

<table class="form-table acc_table">
	<tbody>
			
			<tr class="cn_ind_clr_enable_class">
				<th>Icon Color					
				<a class="ac_tooltip" href="#help" data-tooltip="#cn_icon_clr"><i class="fa fa-lightbulb-o"></i></a>
				</th>
				<td>
				<input id="icon_clr" name="icon_clr" type="text" value="<?php echo $icon_clr;?>" class="my-color-field" data-default-color="#e8e8e8" />
				<!-- Tooltip -->
					<div id="cn_icon_clr" style="display:none;">
						<div style="color:#fff !important;padding:10px;">
							<h2 style="color:#fff !important;"><?php _e('Icon Color',wpshopmart_cns_text_domain); ?></h2>
							<img src="<?php echo wpshopmart_cns_directory_url.'assets/tooltip/img/icon-color.png'; ?>">
						</div>
					</div>
				</td>
			</tr>
			
			<tr class="cn_ind_clr_enable_class">
				<th>Counter Title Color
				<a class="ac_tooltip" href="#help" data-tooltip="#cn_title_clr"><i class="fa fa-lightbulb-o"></i></a>				
				</th>
				<td>
				<input id="count_title_clr" name="count_title_clr" type="text" value="<?php echo $count_title_clr;?>" class="my-color-field" data-default-color="#e8e8e8" />
				<!-- Tooltip -->
					<div id="cn_title_clr" style="display:none;">
						<div style="color:#fff !important;padding:10px;">
							<h2 style="color:#fff !important;"><?php _e('Counter Title Color',wpshopmart_cns_text_domain); ?></h2>
							<img src="<?php echo wpshopmart_cns_directory_url.'assets/tooltip/img/title-color.png'; ?>">
						</div>
					</div>
				</td>
			</tr>
			
			<tr class="cn_ind_clr_enable_class">
				<th>Counter Number Color
				<a class="ac_tooltip" href="#help" data-tooltip="#cn_title_clr"><i class="fa fa-lightbulb-o"></i></a>				
				</th>
				<td>
				<input id="count_num_clr" name="count_num_clr" type="text" value="<?php echo $count_num_clr;?>" class="my-color-field" data-default-color="#e8e8e8" />
				<!-- Tooltip -->
					<div id="cn_title_clr" style="display:none;">
						<div style="color:#fff !important;padding:10px;">
							<h2 style="color:#fff !important;"><?php _e('Counter Number Color',wpshopmart_cns_text_domain); ?></h2>
							<img src="<?php echo wpshopmart_cns_directory_url.'assets/tooltip/img/counter-number-color.png'; ?>">
						</div>
					</div>
				</td>
			</tr>
			 
			<tr class="setting_color">
				<th>Icon Size</th>
				<td>
				<div id="icon_size_id" class="size-slider" ></div>
				<input type="text" class="slider-text" id="icon_size" name="icon_size" readonly="readonly">
				</td>
			</tr>
			<tr class="setting_color">
				<th>Counter Number Font Size</th>
				<td>
				<div id="count_num_size_id" class="size-slider" ></div>
				<input type="text" class="slider-text" id="count_num_size" name="count_num_size" readonly="readonly">
				</td>
			</tr>
			<tr class="setting_color">
				<th>Title Font Size</th>
				<td>
				<div id="title_size_id" class="size-slider" ></div>
				<input type="text" class="slider-text" id="title_size" name="title_size" readonly="readonly">
				</td>
			</tr>
			 
			 
			<tr class="setting_color">
				<th>Counter Number/Title Font Weight</th>
				<td>
				<div id="cn_weight_id" class="size-slider" ></div>
				<input type="text" class="slider-text" id="cn_weight" name="cn_weight" readonly="readonly">
				</td>
			</tr>
			<tr>
				<th scope="row"><label><?php _e('Enable Font Family',wpshopmart_cns_text_domain); ?></label></th>
				<td>
					<?php 
					require_once("font-family.php");
					?>	
					<input type="hidden" name="font_family_group" id="font_family_group" value="<?php echo $font_family_group; ?>" />
					<div style="margin-top:10px;display:block;overflow:hidden;width:100%;"> <a style="margin-top:10px" href="https://wpshopmart.com/plugins/counter-numbers-pro/" target="_balnk">Get 500+ Google Fonts In Premium Version</a> </div>
			
				</td>
			</tr>
			 
			 
			<tr>
				<th>Display Icon
					<a class="ac_tooltip" href="#help" data-tooltip="#cn_dis_icon"><i class="fa fa-lightbulb-o"></i></a>
				</th>
				<td>
					<div class="switch">
						<input type="radio" class="switch-input" name="display_icon" value="yes"  id="enable_display_icon" <?php if($display_icon == 'yes' ) { echo "checked"; } ?>   >
						<label for="enable_display_icon" class="switch-label switch-label-off"><?php _e('Yes',wpshopmart_cns_text_domain); ?></label>
						<input type="radio" class="switch-input" name="display_icon" value="no" id="disable_display_icon"  <?php if($display_icon == 'no' ) { echo "checked"; } ?> >
						<label for="disable_display_icon" class="switch-label switch-label-on"><?php _e('No',wpshopmart_cns_text_domain); ?></label>
						<span class="switch-selection"></span>
					</div>
					<!-- Tooltip -->
					<div id="cn_dis_icon" style="display:none;">
						<div style="color:#fff !important;padding:10px;">
							<h2 style="color:#fff !important;"><?php _e('Show Icon',wpshopmart_cns_text_domain); ?></h2>
							<img src="<?php echo wpshopmart_cns_directory_url.'assets/tooltip/img/display icon.png'; ?>">
						</div>
					</div>
				</td>
			</tr>
			 
			<tr>
				<th>Display Column Layout</th>
				<td>
					<select name="cn_layout" id="cn_layout" class="standard-dropdown" style="width:100%" >
						<option value="12"  <?php if($cn_layout == '12') { echo "selected"; } ?>>One Column Layout</option>
						<option value="6"  <?php if($cn_layout == '6') { echo "selected"; } ?>>Two Column Layout</option>
						<option value="4"  <?php if($cn_layout == '4') { echo "selected"; } ?>>Three Column Layout</option>
						<option value="3"  <?php if($cn_layout == '3') { echo "selected"; } ?>>Four Column Layout</option>
					</select>
					
					<div style="margin-top:10px;display:block;overflow:hidden;width:100%;"> <a style="margin-top:10px" href="https://wpshopmart.com/plugins/counter-numbers-pro/" target="_balnk">Get More 6+ Column Layout In Premium Version</a> </div>
			
				</td>
				
			</tr>
			 
			 
	</tbody>
</table>
<script>
			jQuery('.ac_tooltip').darkTooltip({
				opacity:1,
				gravity:'east',
				size:'small'
			});
		</script>
 