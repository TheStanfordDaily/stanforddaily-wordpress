var jnews_iframe = {};
( function($) {

    function get_current_width(element)
    {
        var parent = $(element).parents('.vc_vc_column, .vc_vc_column_inner');
        var current_width = 12;
        var width = [];

        for(var i = 0; i < parent.length; i++) {
            var class_string = $(parent[i]).attr('class');
            var str_array = class_string.split(" ");
            for(var j = 0; j < str_array.length; j++) {
                var index = str_array[j].indexOf('vc_col-sm-');
                if(index === 0) {
                    var column_width = parseInt(str_array[j].substring(10));
                    width.push(column_width);
                }
            }
        }

        for(var k = 0; k < width.length; k++) {
            current_width = width[k] / 12 * current_width;
        }

        return  Math.ceil(current_width);
    }

    function prevent_duplicate(element, selector)
    {
        var length = $(element).find(selector).length;
        if(length > 1) {
            $(element).find(selector).each(function(index, value){
                if(index > 0) $(this).remove();
            });
        }
    }

    // Module JS
    window.jnews_iframe.module_js = function(model_id){
        var element = $("[data-model-id='" + model_id + "']");
        $(element).find('.jeg_module_hook').jmodule();
    };

    // Module Hero
    window.jnews_iframe.hero_js = function(model_id){
        var element = $("[data-model-id='" + model_id + "']");
        jnews.hero.init(element);
    };

    // Newsticker
    window.jnews_iframe.newsticker_js = function(model_id){
        var element = $("[data-model-id='" + model_id + "']");
        $(element).find(".jeg_news_ticker").jnewsticker();
    };

    // Video Playlist
    window.jnews_iframe.video_playlist_js = function(model_id){
        var element = $("[data-model-id='" + model_id + "']");
        var width_element = get_current_width(element);
        var width_class = 'jeg_col_' + width_element;
        $(element).find(".jeg_video_playlist").addClass(width_class).jvidplaylist();
    };

    // Block link module
    window.jnews_iframe.block_link_module = function(model_id){
        var element = $("[data-model-id='" + model_id + "']");
        $(element).find(".jeg_blocklink .jeg_videobg").jvideo_background();
    };

    // Slider module
    window.jnews_iframe.slider = function(model_id){
        var element = $("[data-model-id='" + model_id + "']");
        $(element).jnews_slider();
    };

    // Carousel module
    window.jnews_iframe.carousel = function(model_id){
        var element = $("[data-model-id='" + model_id + "']");
        $(element).jnews_carousel();
    };

    // following sidebar
    window.jnews_iframe.sidebar_follow = function(model_id){
        var element = $("[data-model-id='" + model_id + "']");
        var class_string = $(element).find('.jeg_column').attr('class');
        var have_sticky = class_string.indexOf('jeg_sticky_sidebar');

        if(have_sticky >= 0) {
            $(element).theiaStickySidebar({ additionalMarginTop: 20, wrap : '.jeg_sticky_sidebar' })
        } else {
            $(element).trigger('theiaStickySidebarDestroy');
        }
    };

    // Row overlay. Prevent multiple row overlay generated
    window.jnews_iframe.additional_row_option = function(model_id){
        var element = $("[data-model-id='" + model_id + "']");

        // Overlay
        prevent_duplicate(element, '.jeg_row_overlay');
        prevent_duplicate(element, '.jeg_top_ribon');
        prevent_duplicate(element, '.jeg_bottom_ribon');
    };

    // widgetized sidebar
    window.jnews_iframe.widget = function(model_id){
        var element = $("[data-model-id='" + model_id + "']");

        // widget tab
        $(element).find('.jeg_tabpost_widget').jtabs();

        // hook module
        $(element).find('.jeg_module_hook').jmodule();

        // hero module
        jnews.hero.init(element);

        // news ticker
        $(element).find(".jeg_news_ticker").jnewsticker();

        // carousel
        $(element).jnews_carousel();

        // block link
        $(element).find(".jeg_blocklink .jeg_videobg").jvideo_background();

        // slider
        $(element).jnews_slider();

        // video playlist
        var width_element = get_current_width(element);
        var width_class = 'jeg_col_' + width_element;
        $(element).find(".jeg_video_playlist").addClass(width_class).jvidplaylist();

        // social

        // Facebook Page Widget
        $.facebook_page_widget();

        // Twitter Widget
        $.twitter_widget();

        // Google+ Widget
        $.google_plus_widget();

        // Pinterest Widget
        $.pinterest_widget();
    };
})(window.jQuery);