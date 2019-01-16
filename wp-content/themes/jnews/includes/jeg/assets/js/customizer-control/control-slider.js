(function($, api){
	api.controlConstructor['jnews-slider'] = api.controlConstructor.default.extend({
		ready: function() {
			var control = this,
				value,
				thisInput,
				inputDefault,
				$range = $('input[type=range]'),
				$reset = $('.jnews-slider-reset');
			
			// Update the text value
			$range.on( 'mousedown', function() {
				value = $( this ).attr( 'value' );
				$( this ).mousemove( function() {
					value = $( this ).attr( 'value' );
					$( this ).closest( 'label' ).find( '.jnews_range_value .value' ).text( value );
				});
			});
			
			$range.on( 'click', function() {
				value = $( this ).attr( 'value' );
				$( this ).closest( 'label' ).find( '.jnews_range_value .value' ).text( value );
			});
	
			// Handle the reset button
			$reset.click( function() {
				thisInput    = $( this ).closest( 'label' ).find( 'input' );
				inputDefault = thisInput.data( 'reset_value' );
				thisInput.val( inputDefault );
				thisInput.change();
				$( this ).closest( 'label' ).find( '.jnews_range_value .value' ).text( inputDefault );
			});
	
			// Save changes.
			this.container.on( 'change', 'input', function() {
				control.setting.set( $( this ).val() );
			});
		}
	});
})(jQuery, wp.customize);