(function($, api){
  api.controlConstructor['jnews-textarea'] = api.controlConstructor.default.extend({
    ready: function() {
      var control = this;
      
      this.container.on( 'change click keyup paste', 'textarea', function() {
        control.setting.set( $( this ).val() );
      });
    }
  });
})(jQuery, wp.customize);