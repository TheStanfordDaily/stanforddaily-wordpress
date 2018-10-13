<?php
add_shortcode('COUNTER_NUMBER','ShortCNS');
function ShortCNS($Id){
	ob_start();
	if(!isset($Id['id'])){
		$counter_id= "";
	}
	else{
		$counter_id = $Id['id'];
	}
	require("content.php");	
	wp_reset_query();
	return ob_get_clean();	
}
?>