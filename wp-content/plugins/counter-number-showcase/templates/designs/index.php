	<div class="wpsm_row">
		
		<?php 
		
			foreach($mydemo as $single_data)
					{
						$counter_icon =  $single_data['counter_icon'];
						$counter_value = $single_data['counter_value'];
						$counter_title = $single_data['counter_title'];
					
		?>
				<div class="wpsm_col-md-<?php echo $cn_layout;?> wpsm_col-sm-6">
					<div class="wpsm_counterbox">
						<?php if($display_icon=="yes"){ ?> 
						<div class="wpsm_count-icon"><i <?php echo $icon_clr ;?> class="fa <?php echo $counter_icon;?>"></i></div>
						<?php }?>
						<div class="wpsm_number" style="<?php echo $count_num_clr ;?>" >
						   <span class="counter"><?php echo $counter_value ;?>
						   </span>
						    
					    </div>
						<h3 class="wpsm_count-title" <?php echo $count_title_clr ;?>> <?php echo $counter_title;?></h3>
						 
					</div>
				</div>
			<?php
		if($i%$cnrow==0){
			?>
			</div>
			<div class="wpsm_row">
		<?php 
					}	
		?>
		<?php 
		$i++;
				}
		?>		
			</div>	