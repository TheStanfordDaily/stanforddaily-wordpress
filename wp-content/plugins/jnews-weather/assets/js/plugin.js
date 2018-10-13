(function($){
	
	'use strict';

	window.jnews.weather = window.jnews.weather || {};

	window.jnews.weather = 
	{
		init: function( $container )
        {
            var base = this;

            if ( $container === undefined )
            {
                base.container = $('body');
            } else {
                base.container = $container;
            }

            base.topbarWeather();
            base.widgetWeather();
        },
        
        topbarWeather: function()
        {
            var base = this;

            if ( base.container.find('.jeg_top_weather').length ) 
            {
                base.element = base.container.find('.jeg_top_weather');
                base.topbarWeatherHover();
                base.topbarWeatherCarousel();
                base.topbarTempClick();
            }
        },

        topbarTempClick: function()
        {
            var base = this;

            base.element.on('click', '.jeg_weather_temp', function()
            {
                var $value    = $(this).find('.jeg_weather_value'),
                    $unit     = $(this).find('.jeg_weather_unit'),
                    tempValue = $value.html(),
                    tempUnit  = $unit.html(),
                    dataTemp  = $value.attr('data-temp'),
                    dataUnit  = $unit.attr('data-unit');

                if ( dataTemp === undefined ) 
                {
                    $value.attr( 'data-temp', tempValue );
                    $unit.attr( 'data-unit', tempUnit );

                    var data = base.convertTemperature( tempUnit, tempValue );

                    if ( data.value !== undefined ) 
                    {
                        $value.html( data.value );
                        $unit.html( data.unit );
                    }
                } else {
                    $value.html( dataTemp );
                    $value.attr( 'data-temp', tempValue );

                    $unit.html( dataUnit );
                    $unit.attr( 'data-unit', tempUnit );
                }
            });
        },

        topbarWeatherHover: function()
        {
            var base = this;

            base.element.hoverIntent({
                over: function () {
                    $(this).find('.jeg_weather_item').fadeIn();
                },
                out: function () {
                    $(this).find('.jeg_weather_item').fadeOut();
                },
                timeout: 300
            });
        },

        topbarWeatherCarousel: function()
        {
            var base = this;
                base.autoplay      = base.element.find('.jeg_weather_item_carousel').attr('data-autoplay');
                base.autoplayDelay = base.element.find('.jeg_weather_item_carousel').attr('data-auto-delay');
                base.autoplayHover = base.element.find('.jeg_weather_item_carousel').attr('data-auto-hover');

            if ( base.element.find('.jeg_weather_item_carousel').length ) 
            {
                base.element.find('.jeg_weather_item_carousel').owlCarousel({
                    items: 3,
                    rewind: true,
                    dots: false,
                    nav: false,
                    navText: false,
                    autoplay: base.autoplay,
                    autoplayTimeout: base.autoplayDelay,
                    autoplayHoverPause: base.autoplayHover,
                });
            }
        },

        convertTemperature: function( tempUnit, tempValue )
        {
            var data = {};

            if ( tempUnit == 'f' ) 
            {
                data.unit  = 'c';
                data.value = ( ( tempValue - 32 ) * 5 ) / 9; 
                data.value = Math.floor( data.value ); 
            } else {
                data.unit  = 'f';
                data.value = ( ( tempValue * 9 ) / 5 ) + 32;
                data.value = Math.floor( data.value ); 
            }

            return data;
        },

        widgetWeather: function()
        {
            var base = this;

            if ( base.container.find('.jeg_weather_widget').length ) 
            {
                base.element = base.container.find('.jeg_weather_widget');
                base.widgetTempClick();
            }
        },

        widgetTempClick: function()
        {
            var base = this;

            base.element.on('click', '.jeg_weather_temp', function()
            {
                var $value    = $(this).find('.jeg_weather_value'),
                    $unit     = $(this).find('.jeg_weather_unit'),
                    tempValue = $value.html(),
                    tempUnit  = $unit.html(),
                    dataTemp  = $value.attr('data-temp'),
                    dataUnit  = $unit.attr('data-unit');

                if ( dataTemp === undefined ) 
                {
                    $value.attr( 'data-temp', tempValue );
                    $unit.attr( 'data-unit', tempUnit );

                    var data = base.convertTemperature( tempUnit, tempValue );

                    if ( data.value !== undefined ) 
                    {
                        $value.html( data.value );
                        $unit.html( data.unit );
                    }
                } else {
                    $value.html( dataTemp );
                    $value.attr( 'data-temp', tempValue );

                    $unit.html( dataUnit );
                    $unit.attr( 'data-unit', tempUnit );
                }
            });
        }
	};

    $(document).bind('ready jnews-ajax-load', function(e, data)
    {
        jnews.weather.init();
    });

})(jQuery);