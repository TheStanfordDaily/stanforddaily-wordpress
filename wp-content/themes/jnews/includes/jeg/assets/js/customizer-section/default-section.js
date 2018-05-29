( function($, api) {
  "use strict";
  
  api.sectionConstructor.default = api.Section.extend({
    expand : function(params)
    {
      var section = this.container[1];
      
      if(!$(section).hasClass('jnews-section-loaded'))
      {
        $(section).addClass('jnews-section-loaded').trigger('jnews-open-section');
      }
      
      api.Section.prototype.expand.call(this, params);
    }
  });
  
  
})( jQuery, wp.customize );
