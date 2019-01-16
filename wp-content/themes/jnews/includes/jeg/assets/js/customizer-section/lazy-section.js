(function($, api) {
  api.sectionConstructor.lazy = api.sectionConstructor.default.extend({
    loaded : false,
    loadingContainer: null,
    opened: false,
    dependency: null,
    promise: null,
    
    ready: function() {
      var section = this;
      
      api.sectionConstructor.default.prototype.ready.call( section );
      
      section.deferred.embedded.done(function() {
        section.setupSectionActions();
      });
    },
  
    /**
     * Setup section when loaded
     */
    setupSectionActions: function(){
      
      var section = this, sectionLoadingTemplate, descriptionContainer;
      
      sectionLoadingTemplate = wp.template( 'customize-lazy-section-loading' );
      
      section.loadingContainer = $(sectionLoadingTemplate({
        loading: 'Loading Control'
      }));
      
      descriptionContainer = section.container.find( '.section-meta:first' );
      
      descriptionContainer.after( section.loadingContainer );
    },
    
    /**
     * Allow an active panel to be contextually active even when it has no active controls.
     *
     * @returns {boolean} Whether contextually active.
     */
    isContextuallyActive: function() {
      var section = this;
      return section.active();
    },
    /**
     * Load Control
     *
     * @returns $.promise
     */
    loadControl : function () {
      var section = this;
      section.dependency = [];
      section.buildDependency(section.params.id);
      
      return wp.ajax.send({
        url: lazySetting.ajaxUrl,
        data: {
          nonce: lazySetting.nonce,
          sections: section.dependency.reverse()
        }
      });
    },
  
    /**
     * Build recursive dependency tree
     * @param sectionID
     * @returns {*}
     */
    buildDependency: function(sectionID){
      var element = this;
      var section = api.section(sectionID);
      var dependency = section.params.dependency;
      
      if(!section.loaded && element.dependency.indexOf(sectionID) <= 0) {
        element.dependency.push(sectionID);
        if(dependency.length > 0){
          _.each(dependency, function(sectionID){
            element.buildDependency(sectionID);
          });
        }
      }
    },
    
    /**
     * Create Customizer Setting
     *
     * @param settingParams
     * @param id
     */
    createSetting: function(settingParams, id) {
      if (!api.has(id)) {
        var setting = new api.Setting(id, settingParams.value, settingParams);
  
        api.add( id, setting );
  
        // Send Dynamic Setting to Customizer Preview
        api.previewer.send('customize-add-setting', {
          id: id,
          value: settingParams.value,
          params: settingParams
        });
      }
    },
  
    /**
     * Create Customizer Control
     * @param option
     * @param id
     */
    createControl: function(option, id) {
      var _type = option.type;
      var control = new api.controlConstructor[_type]( id, {
        params: option
      });
      api.control.add( control.id, control );
    },
  
    /**
     * Proceed to create control by response
     *
     * @param responses
     */
    addControl : function (responses) {
      var that = this;

      if(responses.length === 0) {
        that.finishLoading(that.id);
      }

      // Assign Control & Setting
      _.each(responses, function(response, sectionID){
        var section = api.section(sectionID);
  
        // Create Setting
        _.each(response, function(option){
          section.createSetting(option['setting'], option['settingId']);
        });
  
        // Create Control
        _.each(response, function(option, id){
          section.createControl(option['control'], id);
        });
      });
  
      // Send complete flag
      _.each(responses, function(response, sectionID){
        that.finishLoading(sectionID)
      });
    },


    finishLoading: function(sectionID){
        var section = api.section(sectionID);

        section.loaded = true;
        api.section.trigger(section.id, section);

        section.loadingContainer.fadeOut('slow', function(){
            $(this).remove();
            if(section.promise) {
                section.promise.resolve();
            }
        });
    },
  
    /**
     * Give promise to caller
     *
     * @returns $.Deferred
     */
    loadControlPromise: function(){
      var section = this;
      this.promise = $.Deferred();

      var control = section.loadControl();
      control.done(section.addControl.bind(this));

      return this.promise;
    },
    
    /**
     * handle expand
     *
     * @param params
     * @returns {*|Boolean}
     */
    expand : function(params) {
      var section = this;
      
      api.sectionConstructor.default.prototype.expand.call(this, params);
  
      if(!section.loaded)
      {
        return this.loadControlPromise();
      }
    }
  });
  
})(jQuery, wp.customize);