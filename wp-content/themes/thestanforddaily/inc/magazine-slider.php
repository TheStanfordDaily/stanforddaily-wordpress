<?php
get_header();
include "magazine-slider-issues.php";
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
<script>
jQuery(function() {
	jQuery(".tsd-magazine-slider").slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3
	});
	jQuery(".tsd-magazine-slider-item").click(function() {
		console.log("clicked");
	});
})
</script>

<div class="tsd-magazine-slider" style="margin-bottom: 40px;">
<?php foreach (array_reverse($issues) as $key => $issue) {?>
	<a class="tsd-magazine-slider-item" data-fancybox data-type="iframe" data-src="//e.issuu.com/embed.html#<?php echo $issue['id']; ?>" href="javascript:;"
	style="background-image:url('<?php $img = wp_get_attachment_image_src($issue["image"], array(262, 337)); echo $img ? $img[0]: "https://pbs.twimg.com/profile_images/828118030605381636/G3wb0UIB_400x400.jpg"; ?>')"
	></a>
<?php }?>
</div>
