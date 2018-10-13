jQuery(document).on('click', '#heartbeat_control_update_notice .notice-dismiss', function() {

    jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'dismiss_heartbeat_control_update_notice'
        }
    })

});
(function($) {

    'use strict';

    function maybeHideFrequency() {
        $('.heartbeat_behavior select').each(function() {
            if (this.value !== 'modify') {
                $(this).closest('.cmb-repeatable-grouping').find('.heartbeat_frequency').hide();
            } else {
                $(this).closest('.cmb-repeatable-grouping').find('.heartbeat_frequency').show();
            }
        });
    }

    function bindChangeEvent() {
        $('.heartbeat_behavior select').change(function() {
            maybeHideFrequency();
        });
    }

    $(document).ready(function() {
        maybeHideFrequency();
        bindChangeEvent();
    });

    // Init slider at start
    $('.cmb-type-slider').each(function() {
        initRow($(this));
    });


    // When a group row is shifted, reinitialise slider value
    $('.cmb-repeatable-group').on('cmb2_shift_rows_complete', function(event, instance) {

        var shiftedGroup = $(instance).closest('.cmb-repeatable-group');

        shiftedGroup.find('.cmb-type-slider').each(function() {

            $(this).find('.slider-field').slider('value', $(this).find('.slider-field-value').val());
            $(this).find('.slider-field-value-text').text($(this).find('.slider-field-value').val());

        });
        maybeHideFrequency();
        bindChangeEvent();

        return false;
    });


    // When a group row is added, reset slider
    $('.cmb-repeatable-group').on('cmb2_add_row', function(event, newRow) {

        $(newRow).find('.cmb-type-slider').each(function() {

            initRow($(this));

            $(this).find('.ui-slider-range').css('width', 0);
            $(this).find('.slider-field').slider('value', 0);
            $(this).find('.slider-field-value-text').text('0');
        });

        maybeHideFrequency();
        bindChangeEvent();
        return false;
    });


    // Init slider
    function initRow(row) {

        // Loop through all cmb-type-slider-field instances and instantiate the slider UI
        row.each(function() {
            var $this = $(this);
            var $value = $this.find('.slider-field-value');
            var $slider = $this.find('.slider-field');
            var $text = $this.find('.slider-field-value-text');
            var slider_data = $value.data();

            $slider.slider({
                range: 'min',
                value: slider_data.start,
                min: slider_data.min,
                max: slider_data.max,
                step: slider_data.step,
                slide: function(event, ui) {
                    $value.val(ui.value);
                    $text.text(ui.value);
                }
            });

            // Initiate the display
            $value.val($slider.slider('value'));
            $text.text($slider.slider('value'));
        });

        maybeHideFrequency();
        bindChangeEvent();
    }


})(jQuery);