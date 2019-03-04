<?php
get_header();
$issues = array(
	array("volume" => "I",
		"issue" => "1",
		"date" => "09.26.16",
		"id" => "28430991/65761807",
		"image" => 1146942),

	array("volume" => "I",
		"issue" => "2",
		"date" => "11.04.16",
		"id" => "28430991/65748806",
		"image" => 1146944),

	array("volume" => "I",
		"issue" => "3",
		"date" => "01.13.17",
		"id" => "28430991/65714607",
		"image" => 1146945),

	array("volume" => "I",
		"issue" => "4",
		"date" => "2.24.17",
		"id" => "28430991/45977522",
		"image" => 1146946),

	array("volume" => "I",
		"issue" => "5",
		"date" => "5.07.17",
		"id" => "28430991/65761817",
		"image" => 1146947),

	array("volume" => "I",
		"issue" => "6",
		"date" => "5.5.17",
		"id" => "28430991/48344745",
		"image" => 1146948),

	array("volume" => "I",
		"issue" => "7",
		"date" => "6.2.17",
		"id" => "28430991/50160766",
		"image" => 1146949),

	array("volume" => "II",
		"issue" => "1",
		"date" => "9.22.17",
		"id" => "28430991/55708902",
		"image" => 1146954),

	array("volume" => "II",
		"issue" => "2",
		"date" => "10.20.17",
		"id" => "28430991/55708935",
		"image" => 1146955),

	array("volume" => "II",
		"issue" => "3",
		"date" => "11.17.17",
		"id" => "28430991/55568201",
		"image" => 1146956),

	array("volume" => "II",
		"issue" => "4",
		"date" => "01.26.18",
		"id" => "28430991/65761858",
		"image" => 1146957),

	array("volume" => "II",
		"issue" => "5",
		"date" => "03.02.18",
		"id" => "28430991/65761868",
		"image" => 1146950),

	array("volume" => "II",
		"issue" => "6",
		"date" => "04.27.18",
		"id" => "28430991/65761877",
		"image" => 1146951),

	array("volume" => "II",
		"issue" => "7",
		"date" => "05.22.18",
		"id" => "28430991/65748802",
		"image" => 1146952),

	array("volume" => "III",
		"issue" => "1",
		"date" => "09.20.18",
		"id" => "28430991/65761903",
		"image" => 1146953),

	array("volume" => "III",
		"issue" => "2",
		"date" => "11.14.18",
		"id" => "28430991/65761909",
		"image" => 1146963),

	array("volume" => "III",
		"issue" => "3",
		"date" => "02.19.19",
		"id" => "28430991/67880779",
		"image" => 1149963),
);
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
