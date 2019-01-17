(function (api) {
  
  if ( ! api.partialRefresh ) {
    api.partialRefresh = {};
  }
  
  api.partialRefresh = {
    partialRefreshCache: [],
  };
  
  /**
   * Add partial setting
   *
   * @param object
   */
  api.partialRefresh.bindSetting = function(object){
    var partial = new api.selectiveRefresh.Partial(
      object.id,
      object.param
    );
    api.selectiveRefresh.partial.add( partial );
  };
  
  /**
   * Bind Setting for partial refresh
   */
  api.partialRefresh.initialize = function(){
    api.preview.bind('register-partial-refresh', function (object) {
      api.partialRefresh.bindSetting(object);
    });
  
    api.preview.bind('register-all-partial-refresh', function(objects){
      _.each(objects, function(object){
        api.partialRefresh.bindSetting(object);
      });
    });
  };
  
  /**
   * Initialize partial refresh
   */
  api.bind('preview-ready', function () {
    api.partialRefresh.initialize();
  });
  
})(wp.customize);