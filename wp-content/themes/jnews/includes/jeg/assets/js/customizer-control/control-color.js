(function($, api){
	api.controlConstructor['jnews-color'] = api.controlConstructor.default.extend({
		
		ready: function() {
			var dispatch = this.dispatch.bind(this);
			dispatch();
		},
		
		dispatch: function(){
			var control = this;
			var picker  = control.container.find( '.jnews-color-control');
			
			$( picker ).wpColorPicker();
			
			if ( undefined !== control.params.choices ) {
				picker.wpColorPicker( control.params.choices );
			}
			
			control.container.find('.wp-picker-clear').on('click', function(){
				setTimeout( function() {
					control.setting.set( picker.val() );
				}, 100 );
			});
			
			picker.wpColorPicker({
				change: function(){
					setTimeout( function() {
						control.setting.set( picker.val() );
					}, 100 );
				}
			});
		}
		
	});
})(jQuery, wp.customize);
