<div style=" overflow: hidden;padding: 10px; clear:both">
	
	<h1>Counter Design Template </h1>
		<div style="overflow:hidden;display:block;width:100%;padding-top:20px;padding-bottom:30px;">
			
			<div class="col-md-3">
				<div class="demoftr">	
					
					<div class="">
						<div class="wpsm_home_portfolio_showcase">
							<div class="wpsm_ribbon"><a target="_blank" href="https://wpshopmart.com/plugins/counter-numbers-pro/"><span> Selected </span></a></div>
							<img class="wpsm_img_responsive ftr_img" src="<?php echo wpshopmart_cns_directory_url.'assets/images/demo-1.jpeg'?>">
							</div>
					</div>
					<div style="padding:13px;overflow:hidden; background: #EFEFEF; border-top: 1px dashed #ccc;">
						<h3 class="text-center pull-left" style="margin-top: 10px;margin-bottom: 10px;font-weight:900">Selected Design</h3>
						<a type="button"  class="pull-right btn btn-danger design_btn" id="templates_btn1" target="_blank" href="http://demo.wpshopmart.com/counter-number-showcase-wordpress-plugin-demo/" >Check Demo</a>
							</div>		
				</div>	
			</div>
			
			<div class="col-md-3">
				<div class="demoftr">	
					
					<div class="">
						<div class="wpsm_home_portfolio_showcase">
							<div class="wpsm_ribbon wpsm_ribbon2"><a target="_blank" href="https://wpshopmart.com/plugins/counter-numbers-pro/"><span>Buy Now</span></a></div>
							<img class="wpsm_img_responsive ftr_img" src="<?php echo wpshopmart_cns_directory_url.'assets/images/demo-2.png'?>">
							</div>
					</div>
					<div style="padding:13px;overflow:hidden; background: #EFEFEF; border-top: 1px dashed #ccc;">
						<h3 class="text-center pull-left" style="margin-top: 10px;margin-bottom: 10px;font-weight:900">Pro Templates </h3>
						<a type="button"  class="pull-right btn btn-danger design_btn" id="templates_btn2" target="_blank" href="http://demo.wpshopmart.com/counter-number-pro/" >Check Demo</a>
							</div>		
				</div>	
			</div>
			
		</div>
	
	<div class="wpsm_site_sidebar_widget_title" style="margin-left:-13px;margin-right:-13px;border-radius: 3px;margin-bottom:40px">
		<h4 style="border-top-left-radius: 2px;">Add Counter number</h4>
	</div>
	<input type="hidden" name="counterbox_save_data_action" value="counterbox_save_data_action" />
	<ul class="clearfix" id="mybox">
		<?php
		
		$Def_Settings = unserialize(get_option('wpsm_counterbox_default_settings'));
		$Counter_Meta_Settings = unserialize(get_post_meta( $post->ID, 'Counter_Meta_Settings' ,true));
		
		$option_names = array(
						
						 
						);
						
		foreach($option_names as $option_name => $default_value) {
					if(isset($Counter_Meta_Settings[$option_name])) 
						${"" . $option_name}  = $Counter_Meta_Settings[$option_name];
					else
						${"" . $option_name}  = $default_value;
				}
		$i=1;
		
		$mydemo = unserialize(get_post_meta( $post->ID, 'manisha_demo_data', true));
		$box_count =  get_post_meta( $post->ID, 'manisha_demo_count',true );
		if($box_count) 
			{	
				if($box_count!=-1)
					{
					foreach($mydemo as $single_data)
						{
							$counter_icon =  $single_data['counter_icon'];
							$counter_value = $single_data['counter_value'];
							$counter_title = $single_data['counter_title'];
								
			?>
			<li class="wpsm_ac-panel single_acc_box">
					<span class="ac_label"><?php _e('Counter Title',wpshopmart_cns_text_domain); ?></span>
					<input type="text" id="counter_title[]" name="counter_title[]" value="<?php echo  $counter_title; ?>" placeholder="Enter Counter Title Here" class="wpsm_ac_label_text">
					<span class="ac_label"><?php _e('Select Counter Icon',wpshopmart_cns_text_domain); ?></span>
					<div class="form-group input-group">
					<input data-placement="bottomRight" id="counter_icon[]" name="counter_icon[]" class="form-control icp icp-auto" value="<?php echo  $counter_icon; ?>" type="text" readonly="readonly" />
					<span class="input-group-addon "></span>
					</div>
					<span class="ac_label"><?php _e('Counter Number Value',wpshopmart_cns_text_domain); ?></span>
					<input type="number" id="counter_value[]" name="counter_value[]" value="<?php echo  $counter_value; ?>" placeholder="Enter Counter Number Value Here" class="wpsm_ac_label_text">
					 	 
					<a class="remove_button" href="#delete" id="remove_bt" ><i class="fa fa-trash-o"></i></a>
				</li>
					<?php
					$i++;
					}
				}else{
				echo "<h2>No Counterbox Found</h2>";
				}
		}
		else
		{
			for($i=1; $i<=3; $i++)
			{
			?>
			<li class="wpsm_ac-panel single_acc_box">
					<span class="ac_label"><?php _e('Counter Title',wpshopmart_cns_text_domain); ?></span>
					<input type="text" id="counter_title[]" name="counter_title[]"  placeholder="Enter Counter Title Here" value="Title" class="wpsm_ac_label_text">
					<span class="ac_label"><?php _e('Select Counter Icon',wpshopmart_cns_text_domain); ?></span>
					<div class="form-group input-group">
					<input data-placement="bottomRight" id="counter_icon[]" name="counter_icon[]" class="form-control icp icp-auto" type="text" value="fa-laptop" readonly="readonly" />
					<span class="input-group-addon "></span>
					</div>
					<span class="ac_label"><?php _e('Counter Number Value',wpshopmart_cns_text_domain); ?></span>
					<input type="number" id="counter_value[]" name="counter_value[]" placeholder="Enter Counter Number Value Here" value="4243" class="wpsm_ac_label_text">
					 
					<a class="remove_button" href="#delete" id="remove_bt" ><i class="fa fa-trash-o"></i></a>
			</li>
			<?php
			}
		}
		?>
	</ul>
</div>
<div style="display:block;margin-top:20px;overflow:hidden;width: 100%;float:left;">
		<a class="wpsm_ac-panel add_wpsm_ac_new" id="add_box" onclick="new_box()"   >
			<?php _e('Add New Counterbox', wpshopmart_cns_text_domain); ?>
		</a>
		<a  style="float: left;padding:10px !important;background:#31a3dd;" class=" add_wpsm_ac_new delete_all_acc" id="delete_all_count"    >
			<i style="font-size:57px;"class="fa fa-trash-o"></i>
			<span style="display:block"><?php _e('Delete All',wpshopmart_cns_text_domain); ?></span>
		</a>
</div>
<div style="clear:left;"></div>
<?php require('add-counter-box-js-footer.php'); ?>
