<?php
if(isset($PostID) && isset($_POST['counterbox_save_data_action']) ) {
$My_Array=array();
$box_count= count($_POST['counter_title']);
if($box_count){
	for($i=0; $i < $box_count; $i++){

					$counter_icon   	     = $_POST['counter_icon'][$i];
					$counter_value  		 = $_POST['counter_value'][$i];
					$counter_title          = $_POST['counter_title'][$i];
					
					$My_Array[] = array(
						'counter_icon'            => $counter_icon,
						'counter_value'           => $counter_value,
						'counter_title'           => $counter_title,
						);
			}
				update_post_meta($PostID, 'manisha_demo_data',serialize($My_Array));
				update_post_meta($PostID, 'manisha_demo_count',$box_count );
		}
}		
 ?>