(function ($, api) {
  api.controlConstructor['jnews-preset-image'] = api.controlConstructor.default.extend({
    ready: function () {
      var $select,
        selectize,
        value,
        container;
      
      // Change the value
      var setting = $(this.container).find('.image').data('link');
      
      $(this.container).find('label').bind('click', function () {
        value = $(this).data('id');
        
        // find the container
        container = $(api.control(setting).container.find('select'));
        
        // Need to change content of selectize dropdown
        $select = container.selectize();
        selectize = $select[0].selectize;
        selectize.setValue(value, true);
        
        // Update the value in the customizer object
        api.control(setting).setting.set(value);
        
        // now trigger change
        $(container).change();
      });
    }
  });
})(jQuery, wp.customize);