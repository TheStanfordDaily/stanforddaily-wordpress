/**
 * JOverflow Slider by Jegtheme
 */
(function ($) {
    "use strict";

    var Slider = function(element, options)
    {
        this.element           = $(element);
        this.options            = options;

        this.header             = $('.jeg_header');
        this.loader             = $('.jeg_overlay_slider_loader', element);
        this.slider_wrapper     = $('.jeg_overlay_slider_wrapper', element);
        this.slider_bottom      = $('.jeg_overlay_slider_bottom', element);
        this.slider_bg          = $('.jeg_overlay_slider_bg', element);
        this.caption_container  = $('.jeg_overlay_caption_container', element);
        this.activeid           = 0;
        this.previd             = 0;

        this.init();
    };

    Slider.DEFAULTS =
    {
        rtl : false,
        fullscreen : false,
        breakpoint : 1024
    };

    Slider.prototype.init = function()
    {
        var base = this;
        var header = base.header;
        base.options.fullscreen = $(base.element).data('fullscreen');
        base.options.shownav = $(base.element).data('nav');

        base.resize_wrapper = function()
        {
            header = ! $(base.header).is(':visible') ? $('.jeg_navbar_mobile_wrapper') : base.header;

            if($(window).width() > base.options.breakpoint)
            {
                base.element.height($(window).height() - $(header).height());
            } else {
                base.element.attr('style', '')
            }

            base.resize_wrapper_fix();
        };

        base.resize_wrapper_fix = function()
        {
            header = ! $(base.header).is(':visible') ? $('.jeg_navbar_mobile_wrapper') : base.header;

            if($(window).width() > 767) 
            {
                base.slider_wrapper.height(base.element.height() + $(header).height());
                base.element.height(base.slider_wrapper.height() - $(header).height());
            } else {
                var wh = $(window).height();
                var height = wh > 414 ? wh * 0.45 : wh;

                base.slider_wrapper.height(height);
                base.element.height(height - $(header).height());
            }
        };

        if(base.options.fullscreen) {
            base.resize_wrapper();
            $(window).bind('resize load', base.resize_wrapper);
        } else {
            base.resize_wrapper_fix();
            $(window).bind('resize load', base.resize_wrapper_fix);
        }

        base.do_slider();
        base.bind_click();
    };


    Slider.prototype.do_slider = function()
    {
        var base = this;

        base.slider_bottom.owlCarousel({
            rtl: base.options.rtl,
            lazyLoad:true,
            margin:10,
            navText: ['',''],
            nav: base.options.shownav,
            dots: false,
            responsive : {
                0 : {
                    items: 1,
                },
                380 : {
                    items: 2,
                },
                768 : {
                    items: 3,
                },
                1024:{
                    items:4,
                    loop:true
                }
            }
        });

        base.slider_bottom.on('changed.owl.carousel', function()
        {
            // unfortunately we unable to use [get(index)], because selector always changed
            base.element.find('.jeg_overlay_slider_item[data-id="' + base.activeid + '"]').addClass('active');
        });
    };


    Slider.prototype.bind_click = function()
    {
        var base = this;

        base.element.on('click', '.jeg_overlay_slider_item',function(e){
            e.preventDefault();

            var ele = this;
            var index = $(ele).data('id');

            base.previd = base.activeid;
            base.activeid = index;

            // change active slider
            base.change_active(ele);

            // load background
            base.load_background_text(index);
        });
    };

    Slider.prototype.change_active = function(element)
    {
        var base = this;

        base.element.find('.jeg_overlay_slider_item').removeClass('active');
        $(element).addClass('active');
    };

    Slider.prototype.load_background_text = function(index)
    {
        var base = this;

        $(base.loader).stop().fadeIn();
        var current_bgelement       = base.slider_bg.get(base.previd);
        var bgelement               = base.slider_bg.get(index);
        var datasrc                 = $(bgelement).data('bg');

        // text data
        var current_textelement     = base.caption_container.get(base.previd);
        var textelement             = base.caption_container.get(index);

        $(current_textelement).fadeOut();

        if(!$(bgelement).hasClass('loaded'))
        {
            var img = new Image();
            $(img).load(function ()
            {
                if(index === base.activeid)
                {
                    $(bgelement).css('background-image', 'url(' + datasrc + ')').addClass('loaded');
                    base.change_active_background(current_bgelement, bgelement, textelement);
                }
            }).attr('src', datasrc);
        } else {
            base.change_active_background(current_bgelement, bgelement, textelement);
        }
    };


    Slider.prototype.change_active_background = function(current_bgelement, bgelement, textelement)
    {
        var base = this;

        $(base.loader).stop().fadeOut();
        base.slider_bg.removeClass('active');

        $(current_bgelement).stop().fadeOut();
        $(bgelement).stop().fadeIn(function(){
            $(this).addClass('active');
        });

        $(textelement).fadeIn();
    };

    function Plugin(option)
    {
        return $(this).each(function()
        {
            var $this = $(this);
            var options = $.extend({}, Slider.DEFAULTS, $this.data(), typeof option == 'object' && option);
            var data = $this.data('jeg.overlayslider');

            if (!data) $this.data('jeg.overlayslider', (data = new Slider(this, options)));
        });
    }

    var old = $.fn.joverlayslider;

    $.fn.joverlayslider = Plugin;
    $.fn.joverlayslider.Constructor = Slider;

    $.fn.joverlayslider.noConflict = function () {
        $.fn.joverlayslider = old;
        return this
    };

})(jQuery);