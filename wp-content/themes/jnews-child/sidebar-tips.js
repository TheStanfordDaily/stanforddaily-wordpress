jQuery(function() {
    // jQuery(jQuery("#tsd-tips-widget").html()).prependTo(jQuery('.jeg_sidebar'));
    jQuery(".jeg_bottombar .jeg_nav_normal").last().replaceWith(
        jQuery(jQuery("#tsd-tips-widget").html())
    );
    jQuery(jQuery("#tsd-donate-header").html()).prependTo(jQuery('.jeg_viewport'));
});