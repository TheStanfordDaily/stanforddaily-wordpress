/** Jeg OwlSlider **/
(function ($) {
    "use strict";

    $.fn.jowlslider = function (options) {
        var setting = {
            items: 5,
            responsive:{
                0:{
                    items: 4,
                    nav: false
                },
                768:{
                    items: 6,
                    nav: false
                },
                1024:{
                    items: 7,
                    nav: true
                }
            },
            margin: 10,
            nav: true,
            autoplay : true,
            slideSpeed : 500,
            delay: 5000,
            rtl: false,
            thumbnail: '.jeg_slider_thumbnail',
            theme: 'jeg_owlslider',
            thumbnail_theme: 'jeg_owlslider_thumbnail',
        };

        if (options) {
            options = $.extend(setting, options);
        } else {
            options = $.extend(setting);
        }

        return $(this).each(function () {

            var slider = this;
            var flag = false;
            var thumbnail = $(options.thumbnail);

            options.autoplay = $(slider).data('autoplay');
            options.delay = $(slider).data('delay');

            $(slider).owlCarousel({
              items: 1,
              autoplay: options.autoplay,
              autoplaySpeed: options.slideSpeed,
              autoplayTimeout: options.delay,
              nav: options.nav,
              navText: false,
              loop: true,
              lazyLoad:true,
              callbacks: true,
              rtl: options.rtl,
            });

            thumbnail.on('initialized.owl.carousel', function(e){
                jeg_set_current_thumbnail(e);
                thumbnail.addClass('disabled_nav');

            }).owlCarousel({
                nav: false,
                navText: false,
                dots: false,
                navRewind: false,
                items   : options.items,
                margin  : options.margin,
                rtl: options.rtl,
                lazyLoad:true,
                responsive: options.responsive
            });

            $(slider).on('changed.owl.carousel', function(e) {
                var target = e.relatedTarget.relative(e.property.value, true);
                if (!flag) {
                    flag = true;
                    thumbnail.trigger('to.owl.carousel', [target, options.slideSpeed, true]);
                    flag = false;
                }

                jeg_set_current_thumbnail(e);
            });

            thumbnail.on('changed.owl.carousel', function (e) {
                if (!flag) {
                    flag = true;
                    $(slider).trigger('to.owl.carousel', e.item.index, options.slideSpeed, true);
                    flag = false;
                }

            }).on('click', '.owl-item', function (e) {
                e.preventDefault();
                $(slider).trigger('to.owl.carousel', $(this).index(), options.slideSpeed, true);
            });

            function jeg_set_current_thumbnail(e) {
                var current = e.relatedTarget.relative(e.item.index);
                var items = thumbnail.find('.owl-stage').children();

                items.removeClass('current');
                items.eq(e.relatedTarget.normalize(current)).toggleClass('current');
            }
        });
    }
})(jQuery);