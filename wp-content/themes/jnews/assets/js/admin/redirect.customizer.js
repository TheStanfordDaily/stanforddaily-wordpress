(function (api) {
  "use strict";
  
  if ( ! api.redirectTag ) {
    api.redirectTag = {};
  }
  
  api.redirectTag = {
    redirectTagCache: [],
    dialogOpen: false
  };
  
  /**
   * Actual Customize Redirect Functionality
   *
   * @param tag
   * @param refresh
   */
  api.redirectTag.customizerRedirect = function (tag, refresh) {
    var redirectTag = api.redirectTag;
    var redirect = jnews_redirect[tag];
    
    if (!redirect.flag) {
      if (!redirectTag.dialogOpen) {
        redirectTag.dialogOpen = true;
        vex.dialog.confirm({
          message: jnews_redirect.setting.change_notice,
          showCloseButton: false,
          callback: function (value) {
            if (value) {
              redirectTag.redirectPreview(redirect.url);
            } else {
              redirectTag.dialogOpen = false;
              redirectTag.refreshPreviewer(refresh, redirect.flag);
            }
          }
        });
      }
    } else {
      redirectTag.refreshPreviewer(refresh, redirect.flag);
    }
  };
  
  /**
   * Force Refresh previewer
   *
   * @param refresh
   * @param flag
   */
  api.redirectTag.refreshPreviewer = function (refresh, flag) {
    if (refresh && flag) {
      parent.wp.customize.previewer.refresh();
    }
  };
  
  /**
   * Redirect Previewer to appropriate URL
   *
   * @param url
   */
  api.redirectTag.redirectPreview = function (url) {
    var customizerpreview = new wp.customize.Preview({
      url: url,
      channel: wp.customize.settings.channel
    });
    
    customizerpreview.send('scroll', 0);
    customizerpreview.send('url', url);
  };
  
  /**
   * Bind setting to redirect tag
   *
   * @param object
   */
  api.redirectTag.bindSetting = function(object) {
    var redirectTag = api.redirectTag;
    
    api( object.id, function( setting ){
      setting.bind(function(){
        redirectTag.customizerRedirect(object.redirect, object.refresh);
      });
    });
  };
  
  api.redirectTag.initialize = function(){
    api.preview.bind('register-redirect-tag', function (object) {
      api.redirectTag.bindSetting(object);
    });
    
    api.preview.bind('register-all-redirect-tag', function(objects){
      _.each(objects, function(object){
        api.redirectTag.bindSetting(object);
      });
    });
  };
  
  api.bind('preview-ready', function () {
    api.redirectTag.initialize();
  });
  
})(wp.customize);
