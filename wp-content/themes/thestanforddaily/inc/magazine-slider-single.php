<?php
get_header();
include "magazine-slider-issues.php";
$issue = end($issues);
?>

<style>
.tsd-magazine-slider-item {
	width: auto;
	height: 300px;
	margin: 0px 20px;
	background-image: url('https://pbs.twimg.com/profile_images/828118030605381636/G3wb0UIB_400x400.jpg');
	background-size: contain;
	background-repeat: no-repeat;
	display: block;
}
.slick-prev::before, .slick-next::before {
	color: black;
}

</style>

<div style="padding: 5px">
<a class="tsd-magazine-slider-item" data-fancybox data-type="iframe" data-src="//e.issuu.com/embed.html#<?php echo $issue['id']; ?>" href="javascript:;"
	style="background-image:url('<?php $img = wp_get_attachment_image_src($issue["image"], array(262, 337)); echo $img ? $img[0]: "https://pbs.twimg.com/profile_images/828118030605381636/G3wb0UIB_400x400.jpg"; ?>')"
	></a>
</div>
