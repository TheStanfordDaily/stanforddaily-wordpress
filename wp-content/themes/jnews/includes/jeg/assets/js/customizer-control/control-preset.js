(function ($, api) {
  api.controlConstructor['jnews-preset'] = api.controlConstructor.default.extend({
    ready: function () {
      var control = this,
        selectValue,
        element = control.container.find( 'select' );
  
      $( element ).selectize();
      
      // Trigger a change
      this.container.on('change', 'select', function () {
        
        // Get the control's value
        selectValue = $(this).val();
        
        // Update the value using the customizer API and trigger the "save" button
        control.setting.set(selectValue);
        
        // We have to get the choices of this control
        // and then start parsing them to see what we have to do for each of the choices.
        $.each(control.params.choices, function (key, value) {
          
          // If the current value of the control is the key of the choice,
          // then we can continue processing, Otherwise there's no reason to do anything.
          if (selectValue === key) {
            // Each choice has an array of settings defined in it.
            // We'll have to loop through them all and apply the changes needed to them.
            $.each(value.settings, function (presetControl, presetSettingValue) {
              jnewsSetSettingValue(presetControl, presetSettingValue);
            });
          }
        });
      });
    }
  });
})(jQuery, wp.customize);
