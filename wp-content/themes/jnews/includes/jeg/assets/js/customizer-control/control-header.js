(function($, api){
  
  api.controlConstructor['jnews-header'] = api.controlConstructor.default.extend({
    
    ready: function() {
      var header = this;
      var container = header.container.get(0);
      $(container).bind('click', header.click.bind(container));
    },
    
    click: function(){
      var collapsedClass = 'customizer-collapsed',
          flag = true;
      
      var recursive_control = function(element, flag)
      {
        var $next = $(element).next();
    
        if( $next.length === 0 ) return;
    
        if(!$next.hasClass('customize-control-jnews-header'))
        {
          if(flag) {
            $next.addClass(collapsedClass);
          } else {
            $next.removeClass(collapsedClass);
          }
      
          recursive_control($next, flag)
        }
      };
  
      if($(this).hasClass('collapsed'))
      {
        $(this).removeClass('collapsed');
        flag = false;
      } else {
        $(this).addClass('collapsed');
        flag = true;
      }
  
      recursive_control(this, flag);
    }
    
  });
})(jQuery, wp.customize);
