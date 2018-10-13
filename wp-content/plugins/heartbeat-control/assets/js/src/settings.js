(function($) {

    'use strict';

    $('#heartbeat_control_behavior').change(function() {
        console.log('changed');
        if (this.value === 'modify') {
            $('.cmb2-id-heartbeat-control-frequency').show();
        } else {
            $('.cmb2-id-heartbeat-control-frequency').hide();
        }
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
    }


})(jQuery);