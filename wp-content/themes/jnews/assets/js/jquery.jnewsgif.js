/** Jeg GIF **/
(function ($) {
    "use strict";

    $.fn.jnewsgif = function (options) {
        var setting = {
        };

        if (options) {
            options = $.extend(setting, options);
        } else {
            options = $.extend(setting);
        }

        return $(this).each(function () {

            var $image = $(this);
            var container_classnames = ['ff-container', 'ff-responsive'];

            $image.addClass('ff-setup ff-image');

            var $start = $('<div class="ff-overlay"><div class="ff-control">GIF</div></div>')
                .insertBefore($image);

            var $canvas = $('<canvas />', {
                class: 'ff-canvas'
            }).attr({
                width: 0,
                height: 0
            }).insertBefore($image);

            $image.add($start).add($canvas).wrapAll(
                $('<div />', {
                    class: container_classnames.join(' ')
                })
            );

            $start.bind('click', function(){
                var container = $(this);
                var canvas = $(container).siblings('canvas');

                if($(canvas).hasClass('ff-canvas-active')) {
                    $(container).removeClass('ff-container-active');
                    $(canvas).removeClass('ff-canvas-active').addClass('ff-canvas-ready');
                } else {
                    $(container).addClass('ff-container-active');
                    $(canvas).removeClass('ff-canvas-ready').addClass('ff-canvas-active');
                }
            });


            $image.imagesLoaded().progress( function( instance, image )
            {
                var $canvas = $(image.img).siblings('canvas'),
                    transitionEnd = 'transitionend webkitTransitionEnd oTransitionEnd otransitionend',
                    image_width = $(image.img).width(),
                    image_height = $(image.img).height();

                $canvas.attr({
                    'width': image_width,
                    'height': image_height
                });

                var context = $canvas[0].getContext('2d');
                context.drawImage($(image.img).get(0), 0, 0, image_width, image_height);

                $canvas.addClass('ff-canvas-ready').on(transitionEnd, function () {
                    $(this).off(transitionEnd);
                    $(image.img).addClass('ff-image-ready');
                });

            });

        });
    }
})(jQuery);