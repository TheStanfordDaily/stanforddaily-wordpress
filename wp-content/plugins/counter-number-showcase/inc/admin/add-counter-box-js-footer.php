<script>
var j = 1000;
	function new_box(){
	var Form = '<li class="wpsm_ac-panel single_acc_box">'+
					
					'<span class="ac_label"><?php _e('Counter Title',wpshopmart_cns_text_domain); ?></span>'+
					'<input type="text" id="counter_title[]" name="counter_title[]" placeholder="Enter Counter Title Here" class="wpsm_ac_label_text">'+
					'<span class="ac_label"><?php _e('Select Counter Icon',wpshopmart_cns_text_domain); ?></span>'+
					'<div class="form-group input-group">'+
						'<input data-placement="bottomRight" id="counter_icon[]" name="counter_icon[]" class="form-control icp icp-auto" type="text" value="fa-laptop" readonly="readonly" />'+
						'<span class="input-group-addon "></span>'+
					'</div>'+
					'<span class="ac_label"><?php _e('Counter Number Value',wpshopmart_cns_text_domain); ?></span>'+
					'<input type="number" id="counter_value[]" name="counter_value[]" placeholder="Enter Counter Number Value Here" class="wpsm_ac_label_text">'+
					'<a class="remove_button" href="#delete" id="remove_bt" ><i class="fa fa-trash-o"></i></a>'+
			'</li>';
	
	jQuery(Form).hide().appendTo("#mybox").slideDown("slow");
	j++;
	call_icon();
	hide_color_setting();
	jQuery('.my-color-field').wpColorPicker();
	}
	jQuery(document).ready(function(){

	  jQuery('#mybox').sortable({
	  
	   revert: true,
	 
	  });
	});
		
</script>
<script>
	jQuery(function(jQuery)
		{
			var accordion = 
			{
				accordion_ul: '',
				init: function() 
				{
					this.accordion_ul = jQuery('#mybox');

					this.accordion_ul.on('click', '.remove_button', function() {
					if (confirm('Are you sure you want to delete this?')) {
						jQuery(this).parent().slideUp(600, function() {
							jQuery(this).remove();
						});
					}
					return false;
					});
					 jQuery('#delete_all_count').on('click', function() {
						if (confirm('Are you sure you want to delete all the Faq?')) {
							jQuery(".single_acc_box").slideUp(600, function() {
								jQuery(".single_acc_box").remove();
							});
							jQuery('html, body').animate({ scrollTop: 0 }, 'fast');
							
						}
						return false;
					});
					
			   }
			};
		accordion.init();
	});
</script>


