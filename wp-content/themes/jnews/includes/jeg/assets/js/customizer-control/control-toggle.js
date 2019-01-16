(function(api, $){
	api.controlConstructor['jnews-toggle'] = api.controlConstructor.default.extend({
		ready: function() {
			var control = this,
					checkboxValue = control.setting._value;
			
			// Save the value
			this.container.on( 'change', 'input', function() {
				checkboxValue = ( $( this ).is( ':checked' ) ) ? true : false;
				control.setting.set( checkboxValue );
			});
		}
	});
})(wp.customize, jQuery);