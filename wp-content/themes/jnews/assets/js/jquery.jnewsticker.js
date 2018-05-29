/**
 * JnewsTicker by Jegtheme
 */
(function ($, window) {
    "use strict";

    var Newsticker = function (element, options) {
        this.$element = $(element);
        this.options = options;
        this.current_slider = 0;
        this.trailing_slider = null;
        this.previous_slider = null;
        this.number_slider = 0;
        this.advance_timeout = null;
        this.newsticker_item = this.$element.find('.jeg_news_ticker_item');
        this.active_class = 'jeg_news_ticker_active';

        this.horizontal_effect = ['fadeInLeft', 'fadeInRight', 'fadeOutLeft', 'fadeOutRight'];
        this.vertical_effect = ['fadeInUp', 'fadeInDown', 'fadeOutDown', 'fadeOutUp'];
        this.slide_effect = null;

        this.init();
    };

    Newsticker.DEFAULT =
    {
        autoplay: true,
        delay: 3000,
        animation: 'vertical' // horizontal, vertical
    };

    Newsticker.prototype.init = function () {
        var base = this;

        base.options.animation = $(base.$element).data('animation');
        base.options.autoplay = $(base.$element).data('autoplay');
        base.options.delay = $(base.$element).data('delay');

        base.number_slider = base.newsticker_item.size();

        if (base.number_slider > 1) {
            if (base.options.animation === 'horizontal') {
                base.slide_effect = base.horizontal_effect;
            } else if (base.options.animation === 'vertical') {
                base.slide_effect = base.vertical_effect;
            }

            base.bind_direction();
            base.do_autoplay();
            base.do_slide('next');
        } else {
            $(base.newsticker_item.get(0)).addClass(base.active_class);
        }
    };

    Newsticker.prototype.do_slide = function (goto) {
        var base = this;

        base.remove_class_trailing_slider();
        base.add_active_class(goto);
        base.advance_slider(goto);
        base.do_autoplay();
    };

    Newsticker.prototype.do_autoplay = function () {
        var base = this;

        if (base.options.autoplay) {
            base.autoplay();
        }
    };

    Newsticker.prototype.autoplay = function () {
        var base = this;

        window.clearTimeout(base.advance_timeout);
        base.advance_timeout = window.setTimeout(function () {
            base.do_slide('next');
        }, base.options.delay);
    };

    Newsticker.prototype.remove_class_trailing_slider = function () {
        var base = this;
        var trailing_item = $(base.newsticker_item).get(base.trailing_slider);
        $.each(base.slide_effect, function (i) {
            $(trailing_item).removeClass(base.slide_effect[i]);
        });
    };

    Newsticker.prototype.add_active_class = function (goto) {
        var base = this;
        var current_slider = $(base.newsticker_item).get(base.current_slider);
        var previous_slider = $(base.newsticker_item).get(base.previous_slider);
        base.trailing_slider = base.previous_slider;

        if (goto === 'next') {
            if (base.previous_slider !== null) {
                $(previous_slider).removeClass(base.active_class).addClass(base.slide_effect[3]);
            }
            $(current_slider).addClass(base.active_class).addClass(base.slide_effect[0]);
        } else {
            if (base.previous_slider !== null) {
                $(previous_slider).removeClass(base.active_class).addClass(base.slide_effect[2]);
            }
            $(current_slider).addClass(base.active_class).addClass(base.slide_effect[1]);
        }
    };

    Newsticker.prototype.advance_slider = function (goto) {
        var base = this;
        base.previous_slider = base.current_slider;

        if (goto === 'next') {
            base.current_slider++;
        } else {
            base.current_slider--;
        }

        if (base.current_slider >= base.number_slider) {
            base.current_slider = 0;
        }

        if (base.current_slider < 0) {
            base.current_slider = base.number_slider - 1;
        }
    };

    Newsticker.prototype.bind_direction = function () {
        var base = this;

        base.$element.find('.jeg_news_ticker_next').bind('click', function () {
            base.do_slide('next');
        });
        base.$element.find('.jeg_news_ticker_prev').bind('click', function () {
            base.do_slide('prev');
        });

        $(base.newsticker_item).bind('mouseenter', function () {
            clearTimeout(base.advance_timeout);
        }).bind('mouseleave', function () {
            base.do_autoplay();
        });
    };

    function Plugin(option) {
        return $(this).each(function () {
            var $this = $(this);
            var options = $.extend({}, Newsticker.DEFAULTS, $this.data(), typeof option == 'object' && option);
            var data = $this.data('jeg.newsticker');

            if (!data) {
                data = new Newsticker(this, options);
                $this.data('jeg.newsticker', data);
            }
        });
    }

    var old = $.fn.jnewsticker;

    $.fn.jnewsticker = Plugin;
    $.fn.jnewsticker.Constructor = Newsticker;

    $.fn.jnewsticker.noConflict = function () {
        $.fn.jnewsticker = old;
        return this;
    };
})(jQuery, window);

