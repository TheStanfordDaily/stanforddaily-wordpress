/**
 * Preview Slider by Jegtheme
 */

(function ($) {
    "use strict";

    var Slider = function(element, options)
    {
        this.element           = $(element);
        this.options            = options;

        // base element
        this.holder             = $('.jeg_preview_media_content_holder', element);
        this.slider             = $('.jeg_preview_bottom_slider', element);
        this.nav_next           = $('.jeg_preview_media_content_navigation > div.next', element);
        this.nav_prev           = $('.jeg_preview_media_content_navigation > div.prev', element);
        this.control_index      = $('.jeg_preview_control .counter .current', element);
        this.thumb              = $('.jeg_preview_bottom_slider > a', element);
        this.subtitle           = $('.jeg_preview_control .subtitle', element);
        this.description        = $('.jeg_hidden_preview_description', element);
        this.description_wrap   = $('.jeg_preview_description_wrapper', element);
        this.slider_ads         = $('.jeg_preview_slider_ads', element);

        // switch mode
        this.mode               = 'normal'; // or fullscreen
        this.mode_switcher      = $('.fullscreen-switch', element);
        this.preview_holder     = $('.jeg_preview_holder', element);
        this.description_holder = $('.jeg_preview_description', element);
        this.preview_content    = $('.jeg_preview_media_content', element);
        this.text_title         = $('.jeg_preview_media_holder h3', element);

        // number slide
        this.index              = 0;
        this.max                = this.thumb.length - 1;

        // zoom variable
        this.zoom_size          = 0;
        this.zoom_reduce        = $('.jeg_preview_control .reduce', element);
        this.zoom_increase      = $('.jeg_preview_control .increase', element);
        this.zoom_cache         = null;
        this.zoom_lock          = true;
        this.zoom_limit         = [0,0,0,0];

        this.init();
    };

    Slider.DEFAULTS = {
        rtl: false,
        native_zoom: true,
        slideSpeed: 100,
        fit: 'fit',
        zoom_max: 5,
        zoom_step: 20,
        fullscreen_stop: 976
    };

    Slider.prototype.init = function()
    {
        this.bind_event();
        this.create_slider_normal();
        this.assign_slider_event();
        this.first_load();
    };

    Slider.prototype.first_load = function()
    {
        var base = this;

        base.change_content();
        base.change_subtitle();
        base.slider_navigation_check();
    };

    Slider.prototype.bind_event = function()
    {
        var base = this;

        // zoom changed
        base.zoom_reduce.bind('click', function(){
            base.change_zoom('reduce');
        });

        base.zoom_increase.bind('click', function(){
            base.change_zoom('increase');
        });

        base.holder.bind('dblclick', function(){
            base.change_zoom('increase');
        });


        // thumb clicked
        base.thumb.bind('click', function(e){
            e.preventDefault();

            base.index = $(this).data('id');
            base.do_change_slider();
        });


        // draggable event
        base.holder.bind('mousedown', function(e){
            $(this).addClass('draggable');

            var pos_y = e.pageY,
                pos_x = e.pageX;

            $(window).bind('mousemove', function(e)
            {
                base.do_dragging(e.pageX - pos_x , e.pageY - pos_y);

                pos_y = e.pageY;
                pos_x = e.pageX;
            }).bind('mouseup', function(){
                $(this).removeClass('draggable');
                $(window).unbind('mousemove');
            });

            e.preventDefault();
        }).bind('mouseup', function(){
            $(this).removeClass('draggable');
            $(window).unbind('mousemove');
        });

        // fullscreen switcher
        base.mode_switcher.bind('click', $.proxy(function (e) {
            if(base.options.native_zoom) {
                 base.switch_mode();
            } else {
                if(jnewsoption === null) {
                    base.open_magnific_popup();
                } else {
                    if(jnewsoption.popup_script === 'photoswipe') {
                        base.open_photoswipe_popup();
                    } else {
                        base.open_magnific_popup();
                    }
                }

            }
            e.preventDefault();
        },base));


        // resize even
        var resizetimeout;
        $(window).bind('resize', function(){
            clearTimeout(resizetimeout);
            resizetimeout = setTimeout(function(){
                if(base.mode === 'normal') {
                    base.resize_normal();
                } else if(base.mode === 'fullscreen') {
                    base.resize_fullscreen();
                }
            }, 50);
        });
    };

    Slider.prototype.open_magnific_popup = function(){
        var base = this;
        var sequence = base.options.image_sequence;
        var current = base.index;

        $.magnificPopup.instance.next = function() {
            $.magnificPopup.proto.next.call(this);
            if(base.index >= base.max) {
                base.index = 0;
            } else {
                base.index = base.index + 1;
            }
            base.do_change_slider();
        };

        $.magnificPopup.instance.prev = function() {
            $.magnificPopup.proto.prev.call(this);
            if(base.index === 0 ) {
                base.index = base.max;
            } else {
                base.index = base.index - 1;
            }
            base.do_change_slider();
        };

        $.magnificPopup.open({
            items: sequence,
            gallery: {
                enabled: true
            },
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            mainClass: 'mfp-no-margins mfp-with-zoom',
            image: {
                verticalFit: true
            },
        }, current);
    };

    Slider.prototype.open_photoswipe_popup = function(){
        var base = this;
        var items = base.options.image_sequence;
        var current = base.index;
        var pswpElement = $('.pswp').get(0);

        var options = {
            index: current,
            history: false,
            focus: false,
            showAnimationDuration: 0,
            hideAnimationDuration: 0
        };

        var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);

        gallery.listen('afterChange', function() {
            base.index = gallery.getCurrentIndex();
            base.do_change_slider();
        });

        gallery.init();
    };

    Slider.prototype.switch_mode = function()
    {
        var base = this;

        if(base.mode === 'normal') {
            base.fullscreen_mode();
        } else if(base.mode === 'fullscreen') {
            base.normal_mode();
        }
    };

    Slider.prototype.fullscreen_mode = function()
    {
        var base = this;

        base.mode = 'fullscreen';
        $('body').addClass('jeg_preview_body_hidden');
        base.go_fullscreen(true);
        base.keyboard_event('bind');
    };

    Slider.prototype.normal_mode = function()
    {
        var base = this;

        base.mode = 'normal';
        $('body').removeClass('jeg_preview_body_hidden');
        base.go_normal();
        base.keyboard_event('unbind');
    };


    Slider.prototype.keyboard_event = function(event)
    {
        var base = this;

        if(event === 'bind')
        {
            $('body').bind('keydown', function(e)
            {
                if(e.keyCode == 37) {
                    base.change_slider('prev');
                } else if(e.keyCode == 39) {
                    base.change_slider('next');
                } else if(e.keyCode == 27) {
                    base.mode = 'normal';
                    base.normal_mode();
                }
                e.preventDefault();
            });
        } else if(event === 'unbind'){
            $('body').unbind('keydown');
        }
    };

    Slider.prototype.resize_normal = function()
    {
        var base = this;

        // fix image position
        base.change_content();
    };

    Slider.prototype.resize_fullscreen = function()
    {
        var base = this;

        if($(window).width() > base.options.fullscreen_stop)
        {
            base.go_fullscreen(false);
        } else {
            base.mode = 'normal';
            base.normal_mode();
        }
    };

    Slider.prototype.go_fullscreen = function(recreate_carousel)
    {
        var base = this;

        var window_width = $(window).width();
        var window_height = $(window).height();
        var preview_width, description_width;

        // preview_content
        description_width = 400;
        preview_width = window_width - description_width;

        base.element.addClass('fullscreen');
        base.preview_holder.outerWidth(preview_width);
        base.description_holder.outerWidth(description_width);
        base.description_wrap.outerHeight(window_height - base.slider_ads.outerHeight());

        // recreate owl carousel
        if(recreate_carousel) {
            base.recreate_slider();
            base.create_slider_fullscreen();
        }

        // canvas
        base.preview_content.outerHeight(window_height - base.slider.outerHeight() - base.text_title.outerHeight());

        // fix image position
        base.change_content();
    };


    Slider.prototype.go_normal = function()
    {
        var base = this;

        base.element.removeClass('fullscreen');

        // normalize width & height
        base.preview_holder.css('width', 'auto');
        base.description_holder.css('width', 'auto');
        base.preview_content.css('height', 'auto');

        // recreate owl carousel
        base.recreate_slider();
        base.create_slider_normal();

        //fix image position
        base.change_content();
    };


    Slider.prototype.recreate_slider = function()
    {
        var base = this;

        base.slider.trigger('destroy.owl.carousel').removeClass('owl-loaded');
        base.slider.find('.owl-stage-outer').children().unwrap();
    };

    Slider.prototype.create_slider_normal = function()
    {
        var base = this;

        base.slider.owlCarousel({
            rtl: base.options.rtl,
            lazyLoad:true,
            nav: false,
            margin:15,
            navText: ['',''],
            dots: false,
            stagePadding: 15,
            responsive : {
                0 : {
                    items: 3
                },
                480 : {
                    items: 4
                },
                768 : {
                    items: 5
                },
                1000:{
                    items: 7
                }
            }
        });
    };

    Slider.prototype.create_slider_fullscreen = function()
    {
        var base = this;

        base.slider.owlCarousel({
            rtl: base.options.rtl,
            lazyLoad:true,
            nav: false,
            margin:15,
            navText: ['',''],
            dots: false,
            stagePadding: 15,
            responsive : {
                0 : {
                    items: 2
                },
                480 : {
                    items: 3
                },
                768 : {
                    items: 5
                },
                1000 : {
                    items: 6
                },
                1200 : {
                    items: 8
                },
                1600:{
                    items: 10
                }
            }
        });
    };

    Slider.prototype.assign_slider_event = function()
    {
        var base = this;

        base.nav_next.bind('click', function(e){
            e.preventDefault();
            base.change_slider('next');
        });

        base.nav_prev.bind('click', function(e){
            e.preventDefault();
            base.change_slider('prev');
        });
    };

    Slider.prototype.change_slider = function(goto)
    {
        var base = this;

        base.index = ( goto === 'next' ) ? base.index + 1 : base.index - 1;

        if(base.index < 0 || base.index > base.max)
        {
            if(base.index < 0) {
                base.index = 0;
            }

            if(base.index > base.max) {
                base.index = base.max;
            }
            return;
        }

        base.do_change_slider();
    };


    Slider.prototype.slider_navigation_check = function()
    {
        var base = this;

        if(base.index === 0) {
            base.nav_prev.hide();
        } else if(base.index === base.max) {
            base.nav_next.hide();
        } else {
            base.nav_prev.show();
            base.nav_next.show();
        }
    };

    Slider.prototype.do_change_slider = function()
    {
        var base = this;
        var current_thumb = $(base.thumb.get(base.index));


        if(!current_thumb.parent('.owl-item').hasClass('active'))
        {
            base.slider.trigger('to.owl.carousel', [base.index, base.options.slideSpeed, true]);
        }

        // add active class
        $(base.thumb).removeClass('active');
        current_thumb.addClass('active');

        // change control index text
        base.control_index.text(base.index + 1);
        base.change_content();

        // slider navigation check
        base.slider_navigation_check();
    };

    Slider.prototype.reset_zoom = function()
    {
        var base = this;

        base.zoom_size = 0;
        base.zoom_lock = true;
        $(base.zoom_reduce).addClass('off');
        $(base.zoom_increase).removeClass('off');
        base.holder.removeClass('jeg_preview_grabbing');
    };

    Slider.prototype.change_subtitle = function()
    {
        var base = this;

        var thumb = $(base.thumb.get(base.index));
        var subtitle = $(thumb).data('title');

        if(subtitle === '') {
            base.subtitle.hide();
        } else {
            base.subtitle.show();
        }

        base.subtitle.text(subtitle);

        return subtitle;
    };

    Slider.prototype.change_description = function()
    {
        var base = this;

        base.description.removeClass('active');
        $(base.description.get(base.index)).addClass('active');
    };

    Slider.prototype.change_content = function()
    {
        var base = this;
        var img = new Image();
        var cur_index = base.index;
        var image = $(base.thumb.get(cur_index)).data('image');
        base.reset_zoom();

        base.holder.find('img').fadeOut(function(){
            $(this).remove();
        });

        base.change_subtitle();
        base.change_description();

        $(img).load(function(){
            if(cur_index === base.index)
            {
                var imgsize = base.image_resize_calc(img, base.holder, 'fit');
                base.zoom_cache = imgsize;

                $(img).addClass('jeg_preview_hide');
                base.holder.append(img);

                $(img).css({
                    'height': Math.floor(imgsize[0]),
                    'width': Math.floor(imgsize[1]),
                    'left' : Math.floor(imgsize[2]) + "px",
                    'top' : Math.floor(imgsize[3]) + "px",
                    'max-width': 'inherit'
                }).fadeIn();
                base.zoom_lock = false;
            }
        }).attr('src', image);
    };

    Slider.prototype.change_zoom = function(mode)
    {
        var base = this;
        if(base.zoom_lock) return;

        if(mode === 'increase') {
            base.zoom_size = base.zoom_size + 1;
        } else {
            base.zoom_size = base.zoom_size - 1;
        }

        if(base.zoom_size < 0 || base.zoom_size > base.options.zoom_max)
        {
            if(base.zoom_size < 0) {
                base.zoom_size = 0;
            }
            if(base.zoom_size > base.options.zoom_max) {
                base.zoom_size = base.options.zoom_max;
            }
            return;
        }

        if(base.zoom_size <= 0) {
            $(base.zoom_reduce).addClass('off');
            $(base.zoom_increase).removeClass('off');
            base.holder.removeClass('jeg_preview_grabbing');
            base.zoom_size = 0;
        } else if(base.zoom_size >= base.options.zoom_max) {
            $(base.zoom_reduce).removeClass('off');
            $(base.zoom_increase).addClass('off');
            base.holder.addClass('jeg_preview_grabbing');
            base.zoom_size = base.options.zoom_max;
        } else {
            $(base.zoom_reduce).removeClass('off');
            $(base.zoom_increase).removeClass('off');
            base.holder.addClass('jeg_preview_grabbing');
        }

        base.change_image_zoom(mode);
    };

    Slider.prototype.do_dragging = function(x, y)
    {
        var base = this;
        if(base.zoom_size > 0) {
            var img = base.holder.find('img');
            var imgposition = img.position();

            var toppos = imgposition.top + y;
            var leftpos = imgposition.left + x;

            if(toppos < base.zoom_limit[1]) {
                toppos = base.zoom_limit[1];
            }

            if(toppos > base.zoom_limit[0]) {
                toppos = base.zoom_limit[0];
            }

            if(leftpos < base.zoom_limit[3]) {
                leftpos = base.zoom_limit[3];
            }

            if(leftpos > base.zoom_limit[2]){
                leftpos = base.zoom_limit[2];
            }

            img.css({
                top: toppos,
                left: leftpos
            });
        }
    };

    Slider.prototype.change_image_zoom = function(mode)
    {
        var base = this;
        var current_image = $(base.holder).find('img');
        var zoom_size = base.zoom_size;
        var zoom_step  = base.options.zoom_step;
        var new_top, new_left;

        var new_height =  Math.floor(base.zoom_cache[0] + ( base.zoom_cache[0] * zoom_step * zoom_size / 100 ));
        var new_width =  Math.floor(base.zoom_cache[1] + ( base.zoom_cache[1] * zoom_step * zoom_size / 100 ));

        if(mode === 'increase') {
            new_top = current_image.position().top - base.zoom_cache[0] * zoom_step / 2 / 100;
            new_left = current_image.position().left - base.zoom_cache[1] * zoom_step / 2 / 100;
        } else {
            new_top = current_image.position().top + base.zoom_cache[0] * zoom_step / 2  / 100;
            new_left = current_image.position().left + base.zoom_cache[1] * zoom_step / 2 / 100
        }

        // calculate limit of this.zoom_limit
        var zoom_limit_top;
        var zoom_limit_bottom;
        var zoom_limit_left;
        var zoom_limit_right;
        var holder_height = base.holder.height();
        var holder_width = base.holder.width();

        // holder limitation
        if(holder_height > new_height) {
            zoom_limit_top = ( holder_height - new_height ) / 2;
            zoom_limit_bottom = zoom_limit_top + new_height;
        } else {
            zoom_limit_top = 0;
            zoom_limit_bottom = holder_height - new_height;
        }

        if(holder_width > new_width) {
            zoom_limit_left = ( holder_width - new_width ) / 2;
            zoom_limit_right = zoom_limit_left + new_width;
        } else {
            zoom_limit_left = 0;
            zoom_limit_right = holder_width - new_width;
        }

        base.zoom_limit = [
            zoom_limit_top,
            zoom_limit_bottom,
            zoom_limit_left,
            zoom_limit_right
        ];

        if(base.zoom_size > 0)
        {
            if( new_top < zoom_limit_bottom) {
                new_top = zoom_limit_bottom;
            }

            // prioritize zoom top
            if(new_top > zoom_limit_top) {
                new_top = zoom_limit_top;
            }

            if( new_left < zoom_limit_right) {
                new_left = zoom_limit_right;
            }

            // prioritize zoom left
            if(new_left > zoom_limit_left) {
                new_left = zoom_limit_left;
            }
        } else {
            new_top = ( holder_height - new_height ) / 2;
            new_left = ( holder_width - new_width ) / 2;
        }

        $(current_image).css({
            'height': new_height,
            'width': new_width,
            'left' : new_left + "px",
            'top' : new_top + "px"
        });
    };

    Slider.prototype.image_resize_calc = function (img, container)
    {
        // height / width / top / left
        var nh, nw, nt, nl;

        var h = $(img).get(0).naturalHeight;
        var w = $(img).get(0).naturalWidth;

        if (h === 0) {
            h = $(img).data('height');
            w = $(img).data('width');
        }

        var wh = $(container).height();
        var ww = $(container).width();
        var r = ( h / w );
        var wr = wh / ww;

        var resizeWidth = function () {
            nw = ww;
            nh = ww * r;
            nl = ( ww - nw ) / 2;
            nt = ( wh - nh ) / 2;

            return [nh, nw, nl, nt];
        };

        var resizeHeight = function () {
            nw = wh / r;
            nh = wh;
            nl = ( ww - nw ) / 2;
            nt = ( wh - nh ) / 2;
            return [nh, nw, nl, nt];
        };

        var resizeSmall = function(){
            nh = h;
            nw = w;
            nl = ( ww - nw ) / 2;
            nt = ( wh - nh ) / 2;

            return [nh, nw, nl, nt];
        };

        if(wh > h && ww > w) {
            return resizeSmall();
        } else {
            if (wr > r) {
                return resizeWidth();
            }
            return resizeHeight();
        }
    };

    function Plugin(option)
    {
        return $(this).each(function()
        {
            var $this = $(this);
            var options = $.extend({}, Slider.DEFAULTS, $this.data(), typeof option == 'object' && option);
            var data = $this.data('jeg.previewslider');

            if (!data) $this.data('jeg.previewslider', (data = new Slider(this, options)));
        });
    }

    var old = $.fn.jpreviewslider;

    $.fn.jpreviewslider = Plugin;
    $.fn.jpreviewslider.Constructor = Slider;

    $.fn.jpreviewslider.noConflict = function () {
        $.fn.jpreviewslider = old;
        return this
    };

})(jQuery);