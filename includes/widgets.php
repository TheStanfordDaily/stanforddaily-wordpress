<?php

include (TEMPLATEPATH . '/includes/widgets/widget-author.php');
include (TEMPLATEPATH . '/includes/widgets/widget-author-custom.php');
include (TEMPLATEPATH . '/includes/widgets/widget-facebook.php');
include (TEMPLATEPATH . '/includes/widgets/widget-google.php');
include (TEMPLATEPATH . '/includes/widgets/widget-youtube.php');
include (TEMPLATEPATH . '/includes/widgets/widget-tabbed.php');
include (TEMPLATEPATH . '/includes/widgets/widget-twitter.php');
include (TEMPLATEPATH . '/includes/widgets/widget-flickr.php');
include (TEMPLATEPATH . '/includes/widgets/widget-ads.php');
include (TEMPLATEPATH . '/includes/widgets/widget-video.php');
include (TEMPLATEPATH . '/includes/widgets/widget-posts.php');
include (TEMPLATEPATH . '/includes/widgets/widget-category.php');
include (TEMPLATEPATH . '/includes/widgets/widget-authors-posts.php');
include (TEMPLATEPATH . '/includes/widgets/widget-news-pic.php');
include (TEMPLATEPATH . '/includes/widgets/widget-comments-avatar.php');
include (TEMPLATEPATH . '/includes/widgets/widget-text-html.php');
include (TEMPLATEPATH . '/includes/widgets/widget-social.php');
include (TEMPLATEPATH . '/includes/widgets/widget-search.php');
include (TEMPLATEPATH . '/includes/widgets/widget-custom-author.php');
include (TEMPLATEPATH . '/includes/widgets/widget-counter.php');
include (TEMPLATEPATH . '/includes/widgets/widget-login.php');
include (TEMPLATEPATH . '/includes/widgets/widget-feedburner.php');
include (TEMPLATEPATH . '/includes/widgets/widget-reviews.php');
include (TEMPLATEPATH . '/includes/widgets/widget-slider.php');
include (TEMPLATEPATH . '/includes/widgets/widget-soundcloud.php');


function remove_default_widgets() {
	if (function_exists('unregister_widget')) {
		unregister_widget('WP_Widget_Search');
	}
}
add_action('widgets_init', 'remove_default_widgets');

?>