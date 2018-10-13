<?php
	$args = array('p'=>$counter_id ,'post_type' => 'counter_numbers','orderby' => 'ASC');
	$loop = new WP_Query( $args );

	while ( $loop->have_posts() ) : $loop->the_post();
		$post_id =  get_the_ID();
			$Counter_Meta_Settings = unserialize(get_post_meta( $post_id, 'Counter_Meta_Settings', true));

					$icon_clr  = $Counter_Meta_Settings['icon_clr'];
					$count_num_clr  = $Counter_Meta_Settings['count_num_clr'];
					$count_title_clr  = $Counter_Meta_Settings['count_title_clr'];
					$icon_size  = $Counter_Meta_Settings['icon_size'];
					$count_num_size  = $Counter_Meta_Settings['count_num_size'];
					$title_size  = $Counter_Meta_Settings['title_size'];
					$cn_weight  = $Counter_Meta_Settings['cn_weight'];
					$font_family  = $Counter_Meta_Settings['font_family'];
					$display_icon  = $Counter_Meta_Settings['display_icon'];
					$cn_layout  = $Counter_Meta_Settings['cn_layout'];
					$custom_css  = $Counter_Meta_Settings['custom_css'];
					
		$mydemo = unserialize(get_post_meta( $post_id, 'manisha_demo_data', true));
		$box_count =  get_post_meta( $post_id, 'manisha_demo_count',true );
		/* css files */

	require('designs/style.php'); 
		
		//font-family	
	 ?> 
		 
		
		<style>
		#wpsm_counter_b_row_<?php echo $post_id; ?>
			{
				
				position:relative;
				width:100%;
				overflow:hidden;
				text-align:center;
			}
			 
			#wpsm_counter_b_row_<?php echo $post_id; ?> .wpsm_row{
			overflow:hidden;
			display:block;
			width:100%;
			} 
			 
			#wpsm_counter_b_row_<?php echo $post_id; ?> .wpsm_row{
			overflow:visible;
			} 
			 
			#wpsm_counter_b_row_<?php echo $post_id; ?> .wpsm_counterbox .wpsm_count-title{
			min-height:56px;
			}}
			 
		</style>
		
		<div class="wpsm_counter_b_row" id="wpsm_counter_b_row_<?php echo $post_id; ?>">
			<div>
			<?php 
			if($box_count>0) 
			{
				$i=1;
				switch($cn_layout)
					{	
						case(12):
							$cnrow=1;
						break;
						case(6):
							$cnrow=2;
						break;
						case(4):
							$cnrow=3;
						break;
						case(3):
							$cnrow=4;
						break;
						 
					}
		
				require('designs/index.php');
				
			}
			else{
				echo "<h3>No CounterBox Found </h3>";
			}
			?>
			</div>
		</div>
		
	<?php
							
	endwhile; 

?>