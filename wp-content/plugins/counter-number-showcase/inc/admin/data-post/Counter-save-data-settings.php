<?php
if(isset($PostID) && isset($_POST['counterbox_setting_save_action'])) {
	 		 
			$icon_clr        	  	 = $_POST['icon_clr'];
			$count_title_clr         = $_POST['count_title_clr'];
			$count_num_clr        	 = $_POST['count_num_clr'];	
			$icon_size        	 	 = $_POST['icon_size'];
			$count_num_size        	 = $_POST['count_num_size'];
			$title_size        	 	 = $_POST['title_size'];
			$cn_weight        	 	 = $_POST['cn_weight'];
			$font_family         	 = $_POST['font_family'];
			$display_icon        	 = $_POST['display_icon'];
			$cn_layout         		 = $_POST['cn_layout'];
			$custom_css         	 = $_POST['custom_css'];
			
			$Settings_MyArray = serialize( array(
			
			//BOX COLOR SETTINGS
			
				 
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
				
			));
			update_post_meta($PostID, 'Counter_Meta_Settings', $Settings_MyArray);				
}
?>