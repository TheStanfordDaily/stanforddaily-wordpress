(function($){

    var hasSelectiveRefresh;
    var jnews = window.jnews;
    
    hasSelectiveRefresh = (
        'undefined' !== typeof wp &&
        wp.customize &&
        wp.customize.selectiveRefresh &&
        wp.customize.widgetsPreview &&
        wp.customize.widgetsPreview.WidgetPartial
    );

    function begin_with (needle, haystack){
        return (haystack.substr(0, needle.length) == needle);
    }

    function contain_string(needle, haystack)
    {
        var flag = false;
        
        $.each(haystack, function(key, value){
            var contain = needle.indexOf(value) > -1;
            if(contain) flag = true;
        });
        
        return flag;
    }
    
    function is_module_refresh(refresh_id) {
        var single_module = [
            'jnews_single_show_post_related',
            'jnews_single_post_related_match',
            'jnews_single_post_pagination_related',
            'jnews_single_number_post_related',
            'jnews_single_post_auto_load_related',
            'jnews_single_post_related_template',
            'jnews_single_post_related_excerpt',
            'jnews_single_post_related_date',
            'jnews_single_post_related_date_custom',
            'jnews_single_post_show_inline_related',
            'jnews_single_post_inline_related_match',
            'jnews_single_post_inline_related_header',
            'jnews_single_post_inline_related_pagination',
            'jnews_single_post_inline_related_number',
            'jnews_single_post_inline_related_template',
            'jnews_single_post_inline_related_date',
            'jnews_single_post_inline_related_date_custom',
            'jnews_single_post_inline_related_ftitle',
            'jnews_single_post_inline_related_stitle',
            'jnews_single_post_inline_related_fullwidth',
            'jnews_single_post_inline_related_paragraph',
            'jnews_single_post_inline_related_random',
            'jnews_single_post_inline_related_float',
        ];
    
        return contain_string(refresh_id, single_module);
    }
    
    function is_comment_refresh(refresh_id) {
        var comment_id = [
            'jnews_comment_type',
            'jnews_comment_disqus_shortname',
            'jnews_comment_facebook_appid',
        ];
    
        return contain_string(refresh_id, comment_id);
    }
    
    function is_weather_refresh(refresh_id) {
        var weather_id = [
            'jnews_option[top_bar_weather_location]',
            'jnews_option[top_bar_weather_item]',
            'jnews_option[top_bar_weather_item_count]',
            'jnews_option[top_bar_weather_item_content]',
            'jnews_option[top_bar_weather_item_autoplay]',
            'jnews_option[top_bar_weather_item_autodelay]',
            'jnews_option[top_bar_weather_item_autohover]',
            'jnews_option[top_bar_weather_location_auto]',
            'jnews_option[weather_default_temperature]'
        ];
        
        return contain_string(refresh_id, weather_id);
    }
    
    function is_category_content(refresh_id) {
        return refresh_id.indexOf('jnews_category_content') > -1;
    }
    
    function is_category_hero(refresh_id){
        return refresh_id.indexOf('jnews_category_hero') > -1 || refresh_id.indexOf('jnews_author_hero') > -1
    }
    
    function is_header_builder(refresh_id) {
        return begin_with( 'jnews_hb', refresh_id );
    }
    
    function is_mobile_menu(refresh_id) {
        return refresh_id.indexOf('jnews_mobile_menu_follow') > -1;
    }
    
    function is_popup_refresh(refresh_id) {
        var popup_id = [
            'jnews_single_show_popup_post',
            'jnews_single_number_popup_post',
        ];
        
        return contain_string(refresh_id, popup_id);
    }
    
    function is_push_notification_refresh(refresh_id) {
        var push_notification_id = [
            'jnews_option[push_notification_post_enable]',
            'jnews_option[push_notification_post_description]',
            'jnews_option[push_notification_post_btn_subscribe]',
            'jnews_option[push_notification_post_btn_unsubscribe]',
            'jnews_option[push_notification_post_btn_processing]',
            'jnews_option[push_notification_category_enable]',
            'jnews_option[push_notification_category_description]',
            'jnews_option[push_notification_category_btn_subscribe]',
            'jnews_option[push_notification_category_btn_unsubscribe],',
            'jnews_option[push_notification_category_btn_processing]'
        ];
    
        return contain_string(refresh_id, push_notification_id);
    }
    
    if ( hasSelectiveRefresh ) {

        wp.customize.selectiveRefresh.bind( 'partial-content-moved', function( placement ) {
            "use strict";
            var parent = $(placement.container).parents('.jeg_sticky_sidebar');

            if(parent)
            {
                var sticky = $(parent).find('.theiaStickySidebar').html();
                if(sticky === '') {
                    $(parent).find('.theiaStickySidebar').remove();
                    $(parent).css('style', '').theiaStickySidebar({ additionalMarginTop: 20 });
                }
            }
        });

        wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
            "use strict";

            var refresh_id = placement.partial.id;

            if($(placement.container).hasClass('jeg_menu')) {
                jnews.menu.init($(placement.container).parent());
            }

            if($(placement.container).hasClass('jeg_mobile_menu')) {
                $(placement.container).superfish();
            }

            if (refresh_id.substring(0, 6) == "widget") {
                // check if element is valid
                var parent = $(placement.container).parent();

                if($(parent).hasClass('jeg_sticky_sidebar'))
                {
                    var theia = $(parent).find('.theiaStickySidebar');
                    $(placement.container).appendTo(theia);
                }
            }

            if($(placement.container).hasClass('widget')) {
                var element = $(placement.container);

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
                $(element).find(".jeg_video_playlist").addClass('jeg_col_4').jvidplaylist();

                // social

                // Facebook Page Widget
                $.facebook_page_widget();

                // Twitter Widget
                $.twitter_widget();

                // Google+ Widget
                $.google_plus_widget();

                // Pinterest Widget
                $.pinterest_widget();
            }

            if( is_header_builder(refresh_id) )
            {
                jnews.menu.init(placement.container);
                jnews.cart.init(placement.container);
                jnews.mobile.init();
                if ('undefined' !== typeof jnews.weather) jnews.weather.init();
    
                window.jfla = ['desktop_login', 'mobile_login', 'login_form'];
                jnews.first_load.init();
            }

            if( is_mobile_menu(refresh_id) )
            {
                jnews.mobile.init();
            }

            if(is_category_hero(refresh_id))
            {
                jnews.hero.dispatch();
            }

            if(is_category_content(refresh_id) || is_module_refresh(refresh_id))
            {
                $(placement.container).find(".jeg_module_hook").jmodule();
            }
            
            if( is_comment_refresh(refresh_id) )
            {
                jnews.comment.init();
            }
    
            if ( is_weather_refresh(refresh_id) )
            {
                if('undefined' !== typeof jnews.weather) jnews.weather.init();
            }
            
            if( is_popup_refresh(refresh_id) )
            {
                jnews.popuppost.init();
            }

            if ( is_push_notification_refresh(refresh_id) )
            {
                jnews.push_notification.init();
            }
        });
    }
})(jQuery);