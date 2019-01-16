wp.customize.controlConstructor['jnews-spacing'] = wp.customize.controlConstructor.default.extend({

	ready: function() {

		'use strict';

		var control = this,
		    value = {};

		_.each( ['top', 'bottom', 'left', 'right'], function( dimension, index ) {

			// Get initial values and pre-populate the object.
			if ( control.container.has( '.' + dimension ).size() ) {

				value[ dimension ] = control.setting._value[ dimension ];

				// Validate the value and show a warning if it's invalid.
				jQuery( control.selector + ' .' + dimension + '.input-wrapper' ).removeClass( 'invalid' );
				// if ( false === jnewsValidateCSSValue( control.setting._value[ dimension ] ) ) {
				//	jQuery( control.selector + ' .' + dimension + '.input-wrapper' ).addClass( 'invalid' );
				//}

				control.container.on( 'change keyup paste', '.' + dimension + ' input', function() {

					var subValue = jQuery( this ).val();

					// Validate the value and show a warning if it's invalid.
					if ( false === jnewsValidateCSSValue( subValue ) ) {

						jQuery( control.selector + ' .' + dimension + '.input-wrapper' ).addClass( 'invalid' );

					} else {

						jQuery( control.selector + ' .' + dimension + '.input-wrapper' ).removeClass( 'invalid' );

						// Only proceed if value is valid.
						value[ dimension ] = subValue;

						var string = JSON.stringify(value);
						control.setting.set( string );

						// Refresh the preview.
						// The `postMessage` implementation is still incomplete for this field.
						if(control.setting.transport === 'refresh') wp.customize.previewer.refresh();
					}

				});

			}

		});

	},

	getValue: function() {
		'use strict';
		// The setting is saved in JSON
		return JSON.parse( this.setting.get() );

	},

});
