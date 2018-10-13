<style>

#wpsm_counter_b_row_<?php echo $post_id; ?> .wpsm_counterbox
{
	text-align:center;
	margin-top:50px;
	margin-bottom:50px;
}
#wpsm_counter_b_row_<?php echo $post_id; ?> .wpsm_counterbox .wpsm_count-icon{
	display:block;
	margin-top:20px;
	padding-top:0px;
	padding-bottom:0px;
	margin-bottom:0px;
	margin:0 auto;
}
#wpsm_counter_b_row_<?php echo $post_id; ?> .wpsm_counterbox .wpsm_count-icon i{
	font-size:<?php echo $icon_size;?>px;
	color:<?php echo $icon_clr;?>;
}
#wpsm_counter_b_row_<?php echo $post_id; ?> .wpsm_counterbox .wpsm_number{
	font-size:<?php echo $count_num_size;?>px;
	font-weight:<?php echo $cn_weight;?>;
	color:<?php echo $count_num_clr;?>;
	font-family:'<?php echo $font_family;?>';
	letter-spacing:2px;
	margin-top:20px;
	line-height: 1.3em;
	padding-top:0px;
	padding-bottom:0px;
	margin-bottom:0px;
}
#wpsm_counter_b_row_<?php echo $post_id; ?> .wpsm_counterbox .wpsm_count-title{
    font-size:<?php echo $title_size;?>px;
	font-weight:bolder;
	font-family:'<?php echo $font_family;?>';
	letter-spacing:2px;
    color: <?php echo $count_title_clr;?>;
	font-weight:<?php echo $cn_weight;?>;
	margin-top:20px;
	padding-top:0px;
	padding-bottom:0px;
	margin-bottom:0px;
	line-height: 1.3em;
}

<?php echo $custom_css; ?>
</style>