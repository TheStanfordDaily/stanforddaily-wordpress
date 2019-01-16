(function(api){
  
  /**
   * Extend control functionality
   *
   * @param control
   * @param id
   * @param options
   */
  window.extendControl = function(control, id, options){
    // need to fetch default setting used for control
    var setting = options.params.settings.default;
    
    // Post Parameter (post var)
    api.previewerSync.registerRedirectTag(setting, options.params.postvar);
  
    // Style Output
    api.previewerSync.registerStyleOutput(setting, options.params.default, options.params.output);
    
    // only Register Partial Refresh when control created dynamically
    if(options.params.dynamic) {
      api.previewerSync.registerPartialRefresh(setting, control.section.get(), options.params.partial_refresh)
    }
  
    // Active Callback
    api.activeCallback.registerActiveRule(control, options.params.active_rule);
  };
  
  /**
   * Initialize control
   *
   * @param control
   * @param id
   * @param options
   */
  window.initializeControl = function(control, id, options){
    var sectionId = options.params.section;
  
    // if control is normal, extend control right away
    if(!control.params.dynamic) {
      window.extendControl(control, id, options);
    }
  
    api.section.bind(sectionId, function(section){
      if(section.loaded && control.params.dynamic) {
        window.extendControl(control, id, options);
      }
    });
  };
  
  api.controlConstructor.default = api.Control.extend({
    initialize: function( id, options ) {
      api.Control.prototype.initialize.call( this, id, options );
      window.initializeControl(this, id, options);
    },
  });
  
})(wp.customize);
