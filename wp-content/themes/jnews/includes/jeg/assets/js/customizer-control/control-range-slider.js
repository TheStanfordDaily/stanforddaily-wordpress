(function($, api){
    api.controlConstructor['jnews-range-slider'] = api.controlConstructor.default.extend({
        
        get_number: function(selector, name){
            return parseInt($(selector).attr(name));
        },
        
        ready: function() {
            'use strict';
            
            var control = this;
            var slider = $(this.container).find('.slider-range');
            
            var min     = this.get_number(slider, 'min');
            var max     = this.get_number(slider, 'max');
            var range   = this.get_number(slider, 'range');
            var step    = this.get_number(slider, 'step');
            
            $(slider).ionRangeSlider({
                min: min,
                max: max,
                from: range,
                from_min: min,
                from_max: max,
                grid: true,
                postfix: "px",
                onChange: function (data) {
                    control.setting.set( data.from );
                }
            });
        }
    });
})(jQuery, wp.customize);