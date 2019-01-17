wp.customize.controlConstructor['jnews-number'] = wp.customize.controlConstructor.default.extend({

	ready: function() {

		'use strict';

		var control = this,
		    element = this.container.find( 'input' ),
		    min     = -99999,
		    max     = 99999,
		    step    = 1;

		// Set minimum value.
		if ( 'undefined' !== typeof control.params.choices && 'undefined' !== typeof control.params.choices.min ) {
			min = control.params.choices.min;
		}

		// Set maximum value.
		if ( 'undefined' !== typeof control.params.choices && 'undefined' !== typeof control.params.choices.max ) {
			max = control.params.choices.max;
		}

		// Set step value.
		if ( 'undefined' !== typeof control.params.choices && 'undefined' !== typeof control.params.choices.step ) {
			step = control.params.choices.step;
			if ( 'any' === control.params.choices.step ) {
				step = '0.001';
			}
		}

		// Init the spinner
		var spinInput = jQuery( element ).spinner({
			min: min,
			max: max,
			step: step
		});
		
		// disable mousewheel
		spinInput.on("spin", function (evt, ui) {
			if (evt.originalEvent && evt.originalEvent.type === 'mousewheel') {
				evt.preventDefault();
			}
		});

		// On change
		this.container.on( 'change click keyup paste', 'input', function() {
			control.setting.set( jQuery( this ).val() );
		});

	}

});
