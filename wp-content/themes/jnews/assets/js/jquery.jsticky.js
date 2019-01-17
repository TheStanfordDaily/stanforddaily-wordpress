/** jSticky - Make item sticky when scrolling up **/
(function ($) {
    "use strict";

    $.fn.jsticky = function (options)
    {
        var setting = {
            item_offset         : '.jeg_header',
            wrapper             : '.jeg_navbar_wrapper',
            state_class         : '.jeg_sticky_nav',
            mode                : 'scroll', // scroll / sticky
            use_translate3d     : true,
            onScrollDown        : false,
            onScrollUp          : false,
            onStickyRemoved     : false,
            broadcast_position  : false
        };

        if (options) {
            options = $.extend(setting, options);
        } else {
            options = $.extend(setting);
        }

        return $(this).each(function ()
        {
            var base_offset = ( jnewsoption.admin_bar == 1 ) ? 32  : 0;
            var result_offset = 0;

            var last_scroll_top = 0;
            var offset_buff = 0;
            var item = $(this);
            var item_height = item.outerHeight();
            var item_offset;
            var offset = 0;
            var st = 0;
            var delta = 0;

            var refresh_position = function()
            {
                if(jnewsoption.admin_bar == 1) {
                    if($(window).width() <= 782 && $(window).width() > 600) {
                        base_offset = 46;
                    } else if ($(window).width() <= 600) {
                        base_offset = 0;
                    }
                }

                item_offset = $('.sticky_blankspace').offset().top;
            };

            refresh_position();

            var do_jsticky = function(){

                if ( "normal" === options.mode ) return;

                st = $(this).scrollTop();
                delta = Math.abs(st - last_scroll_top); // get from scroll amount

                // remove animation on start position
                if (!item.hasClass( options.state_class )) {
                    item.addClass('notransition');
                }

                if ( st > last_scroll_top ){ // Scroll Down

                    if("scroll" === options.mode) {
                        if ( st < ( item_offset + item_height ) ) return;
                    } else {
                        if ( st < item_offset - base_offset) return;
                    }

                    item.addClass( options.state_class );

                    if ( "scroll" === options.mode ) {
                        offset = offset_buff - delta;

                        if (offset < -item_height) offset = -item_height;

                    } else if ( "pinned" === options.mode && delta > 5 && st > (item_height + base_offset) ) {
                        offset = -item_height;
                    }

                    // Trigger even
                    if (typeof options.onScrollDown === "function") {
                        options.onScrollDown();
                    }

                } else { // Scroll Up

                    if ( st > (item_offset - base_offset) ) {

                        item.removeClass('notransition');

                        if ( "scroll" === options.mode )
                            offset = offset_buff + delta;

                        if ("pinned" === options.mode && delta > 5 || offset > 0) {
                            offset = 0;
                            item.removeClass('notransition');
                        }

                    } else {
                        item.removeClass( options.state_class );
                        offset = 0;

                        // Trigger even
                        if (typeof options.onStickyRemoved === "function") {
                            options.onStickyRemoved();
                        }
                    }

                    // Trigger even
                    if (typeof options.onScrollUp === "function") {
                        options.onScrollUp();
                    }
                }

                if ( st < item_offset - base_offset ) {
                    result_offset = 0;
                } else {
                    result_offset = offset + base_offset;
                }

                if (item.hasClass( options.state_class )) {
                    // Move item
                    if ( options.use_translate3d ) {
                        item.css({
                            '-webkit-transform': 'translate3d(0px, '+ result_offset +'px, 0px)',
                            'transform'        : 'translate3d(0px, '+ result_offset +'px, 0px)'
                        });
                    } else {
                        item.css({top: result_offset + 'px'})
                    }
                } else {
                    // Clear transform style
                    if ( options.use_translate3d ) {
                        item.css({
                            '-webkit-transform': '',
                            'transform'        : ''
                        });
                    } else {
                        item.css({top: ''})
                    }
                }

                if(options.broadcast_position)
                {
                    $(window).trigger('jnews_additional_sticky_margin', item_height + result_offset);
                }

                // Update offset
                offset_buff = offset;
                last_scroll_top = st;
            };

            // do_jsticky();
            $(window).bind('scroll', do_jsticky);
            $(window).bind('load resize', function(){
                setTimeout(refresh_position, 200);
            });
            $(document).ready(refresh_position);
        });
    }
})(jQuery);