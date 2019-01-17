(function(api){
  
  if ( ! api.previewerSync ) {
    api.previewerSync = {};
  }
  
  api.previewerSync = {
    styleOutput: [],
    redirectTag: [],
    partialRefresh: []
  };
  
  /**
   * Register Style output by save it on style output cache, and send it to previewer
   *
   * @param id
   * @param value
   * @param output
   */
  api.previewerSync.registerStyleOutput = function(id, value, output) {
    if(output.length) {
      _.each(output, function(style){
        style.default = value;
      });
      
      var param = {
        id: id,
        output: output
      };
      
      this.styleOutput.push(param);
      this.sendStyleOutput(param);
    }
  };
  
  /**
   * Send style output to previewer
   *
   * @param param
   */
  api.previewerSync.sendStyleOutput = function(param){
    api.previewer.send('register-style-output', param);
  };
  
  /**
   * Send cached style output to previewer
   */
  api.previewerSync.sendAllStyleOutput = function(){
    api.previewer.send('register-all-style-output', this.styleOutput);
  };
  
  
  /**
   * Send redirect tag to previewer
   *
   * @param param
   */
  api.previewerSync.sendRedirectTag = function(param){
    api.previewer.send('register-redirect-tag', param);
  };
  
  /**
   * Send all redirect tag to previewer
   */
  api.previewerSync.sendAllRedirectTag = function(){
    api.previewer.send('register-all-redirect-tag', this.redirectTag);
  };
  
  /**
   * Register post variable (redirect tag)
   *
   * @param id
   * @param postvars
   */
  api.previewerSync.registerRedirectTag = function(id, postvars) {
    _.each(postvars, function(postvar){
      if('undefined' !== typeof postvar.redirect ) {
        var param = {
          id: id,
          redirect: postvar.redirect,
          refresh: postvar.refresh
        };
  
        this.redirectTag.push(param);
        this.sendRedirectTag(param);
      }
    }.bind(this));
  };
  
  /**
   * Send Partial refresh chunk to previewer
   *
   * @param param
   */
  api.previewerSync.sendPartialRefresh = function(param){
    api.previewer.send('register-partial-refresh', param);
  };
  
  /**
   * Send all redirect tag to previewer
   */
  api.previewerSync.sendAllPartialRefresh = function(){
    api.previewer.send('register-all-partial-refresh', this.partialRefresh);
  };
  
  /**
   * Compose partial Name
   *
   * @param section
   * @param id
   * @returns {string}
   */
  api.previewerSync.partialRefreshId = function(section, id){
    return partialSetting.patternTemplate.replace(/\{section\}/g, section).replace(/\{id\}/g, id);
  };
  
  /**
   * Register all partial refresh send by control-default
   *
   * @param setting
   * @param section
   * @param partials
   */
  api.previewerSync.registerPartialRefresh = function(setting, section, partials){
    _.each(partials, function(partial, id){
      if(typeof partial !== 'undefined') {
        var option = {
          type: 'default',
          fallbackRefresh: false,
          containerInclusive: false,
          settings: [setting],
          primarySetting: setting,
        };
        
        var param = {
          id: this.partialRefreshId(section, id),
          param: _.extend(option, partials[id])
        };
        
        this.partialRefresh.push(param);
        this.sendPartialRefresh(param);
      }
    }.bind(this));
  };
  
  /**
   * Initialize connection between previewer & customizer panel
   * When previewer ready, we try to synchronize all registered additional setting
   * from customizer panel to previewer
   */
  api.previewerSync.initialize = function(){
    api.previewer.bind('ready', function(){
      api.previewerSync.sendAllStyleOutput();
      api.previewerSync.sendAllRedirectTag();
      api.previewerSync.sendAllPartialRefresh();
    });
  };
  
  /** Initialize */
  api.bind('ready', function(){
    api.previewerSync.initialize();
  });
  
  
})(wp.customize);
