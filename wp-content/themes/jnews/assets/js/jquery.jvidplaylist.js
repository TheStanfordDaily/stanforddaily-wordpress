/**
 * Video Playlist by Jegtheme
 */
(function ($) {
    "use strict";

    var Playlist = function(element, options)
    {
        this.element            = $(element);
        this.options            = options;
        this.unique             = this.element.data('unique');
        this.data               = window[this.unique];

        this.init();
    };

    Playlist.DEFAULTS = {
        rtl: false
    };

    Playlist.prototype.init = function()
    {
        var base = this;

        if(base.element.hasClass('jeg_vertical_playlist')) {
            base.vertical_playlist();
        } else {
            base.horizontal_playlist();
        }

        base.element.find('video').mediaelementplayer();
        base.bind_click();
    };


    Playlist.prototype.horizontal_playlist = function()
    {
        var base = this;
        var ew = $(base.element).width();
        var items_desktop = Math.floor(ew / 160);
        var items_tab = items_desktop - 1;

        var item_margin = base.element.hasClass('jeg_dark_playlist') ? '' : 10;

        base.element.find(".jeg_video_playlist_list_inner_wrapper").addClass('owl-carousel').owlCarousel({
            rtl: base.options.rtl,
            lazyLoad:true,
            navText: ['',''],
            dots: false,
            loop: false,
            nav:true,
            items: items_desktop,
            margin: item_margin,
            autoHeight: true,
            responsive : {
                0 : {
                    items: 2
                },
                480 : {
                    items: 3
                },
                568 : {
                    items: 4
                },
                768 : {
                    items: items_tab
                },
                1024:{
                    items: items_desktop
                }
            }
        });
    };

    Playlist.prototype.vertical_playlist = function()
    {
        var base = this;

        base.element.find('.jeg_video_playlist_list_inner_wrapper').jScrollPane();
        var navscrollpane = base.element.find('.jeg_video_playlist_list_inner_wrapper').data('jsp');

        base.vertical_resize = function (navscrollpane)
        {
            var playlist_current = base.element.find('.jeg_video_playlist_current');
            var playlist_video = base.element.find('.jeg_video_playlist_video_content');
            var playlist_list =  base.element.find('.jeg_video_playlist_list_inner_wrapper');
            var playlist_height = playlist_video.height();
            var ww = $(window).width();

            var max_item_height = 3;

            if ((base.element.hasClass('jeg_col_12') && ww > 768) ||
                (base.element.hasClass('jeg_col_9') || base.element.hasClass('jeg_col_8')) && ww > 1024) {

                playlist_height = playlist_video.height() - playlist_current.outerHeight();

            } else {
                var items = playlist_list.find('.jeg_video_playlist_item');
                var pl_height = 0;

                for (var i = 0; i < max_item_height; i++) {
                    pl_height += $(items[i]).outerHeight();
                }

                // playlist_height = pl_height + ( $(items[i]).outerHeight() / 2 );
                playlist_height = pl_height;
            }

            playlist_list.height(playlist_height);
            navscrollpane.reinitialise();
        };

        $(window).bind('resize load', function(){
            base.vertical_resize(navscrollpane);
        });

        $(window).bind('load', function(){
            setTimeout(function(){
                base.vertical_resize(navscrollpane);
            }, 200);
        });
        base.vertical_resize(navscrollpane);
    };

    Playlist.prototype.load_content = function(element, data)
    {
        var parent = $(element).parent();
        var grandparent = $(parent).parents('.jeg_video_playlist_wrapper');
        var videocontainer = $(grandparent).find('.jeg_video_holder');
        var currentinfo = $(grandparent).find('.jeg_video_playlist_current_info');

        $(videocontainer).find('.jeg_preview_slider_loader').remove();
        $(videocontainer).append(data.tag);

        if(data.type === 'mediaplayer')
        {
            $(videocontainer).find('video').mediaelementplayer({
                success : function (mediaElement) {
                    mediaElement.play();
                }
            });
        }

        var content = "<a href='" + $(element).attr('href') + "'>" + $(element).find('.jeg_video_playlist_title').text() + "</a>";
        $(videocontainer).css('height', 'auto');
        $(currentinfo).find('h2').html(content);
        $(currentinfo).find('span').text($(element).find('.jeg_video_playlist_category').text());
    };

    Playlist.prototype.bind_click = function()
    {
        var base = this;

        base.element.find('.jeg_video_playlist_item').bind('click', function(e){
            e.preventDefault();
            var element = this;
            var id = $(element).data('id');
            var parent = $(element).parent();
            var grandparent = $(parent).parents('.jeg_video_playlist_wrapper');
            var videocontainer = $(grandparent).find('.jeg_video_holder');
            var loader = "<div class='jeg_preview_slider_loader'><div class='jeg_preview_slider_loader_circle'></div></div>";

            $(grandparent).find('a.jeg_video_playlist_item').removeClass('active');
            $(element).addClass('active');

            $(videocontainer).css('height', $(videocontainer).height()).html(loader);
            base.load_content(element, base.data[id]);
            return false;
        });
    };


    function Plugin(option)
    {
        return $(this).each(function()
        {
            var $this = $(this);
            var options = $.extend({}, Playlist.DEFAULTS, $this.data(), typeof option == 'object' && option);
            var data = $this.data('jeg.vidplaylist');

            if (!data) $this.data('jeg.vidplaylist', (data = new Playlist(this, options)));
        });
    }

    var old = $.fn.jvidplaylist;

    $.fn.jvidplaylist = Plugin;
    $.fn.jvidplaylist.Constructor = Playlist;

    $.fn.jvidplaylist.noConflict = function () {
        $.fn.jvidplaylist = old;
        return this
    };

})(jQuery);