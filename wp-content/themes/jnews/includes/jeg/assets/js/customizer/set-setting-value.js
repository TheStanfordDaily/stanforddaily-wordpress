function jnewsSetSettingValue(control, value) {
  
  var api = wp.customize,
      $ = jQuery;
  
  /**
   * Get the control of the sub-setting.
   * This will be used to get properties we need from that control,
   * and determine if we need to do any further work based on those.
   */
  var subControl = api.control(control);
  
  if(typeof subControl === 'undefined')
    throw "Control : " + control +  " not found";
  
  var setting = subControl.setting,
    container = $(subControl.container),
    $select,
    selectize,
    controlType,
    alphaColorControl,
    typographyColor;
  
  /**
   * Get the control-type of this sub-setting.
   * We want the value to live-update on the controls themselves,
   * so depending on the control's type we'll need to do different things.
   */
  controlType = subControl.params.type;
  
  /**
   * Below we're starting to check the control tyype and depending on what that is,
   * make the necessary adjustments to it.
   */
  
  if ('jnews-toggle' === controlType) {
    
    if (1 === value || '1' === value || true === value) {
      
      // Update the value visually in the control
      container.find('input').prop('checked', true);
      
      // Update the value in the customizer object
      setting.set(true);
      
    } else {
      
      // Update the value visually in the control
      container.find('input').prop('checked', false);
      
      // Update the value in the customizer object
      setting.set(false);
      
    }
    
  } else if ('jnews-select' === controlType || 'jnews-preset' === controlType) {
    
    // Update the value visually in the control
    $select = container.find('select').selectize();
    
    selectize = $select[0].selectize;
    
    selectize.setValue(value, true);
    
    // Update the value in the customizer object
    setting.set(value);
    
  } else if ('jnews-slider' === controlType) {
    
    // Update the value visually in the control (slider)
    container.find('input').prop('value', value);
    
    // Update the value visually in the control (number)
    container.find('.kirki_range_value .value').html(value);
    
    // Update the value in the customizer object
    setting.set(value);
    
  } else if ('jnews-generic' === controlType && undefined !== subControl.choices && undefined !== subControl .choices.element && 'textarea' === subControl.choices.element) {
    
    // Update the value visually in the control
    container.find('textarea').prop('value', value);
    
    // Update the value in the customizer object
    setting.set(value);
    
  } else if ('jnews-color' === controlType) {
    
    alphaColorControl = container.find('.jnews-color-control');
    
    alphaColorControl.val(value).trigger('change');
    
    setting.set(value);
    
  } else if ('jnews-multicheck' === controlType) {
    
    // Update the value in the customizer object
    setting.set(value);
    
    /**
     * Update the value visually in the control.
     * This value is an array so we'll have to go through each one of the items
     * in order to properly apply the value and check each checkbox separately.
     *
     * First we uncheck ALL checkboxes in the control
     * Then we check the ones that we want.
     */
    container.find('input').each(function () {
      $(this).prop('checked', false);
    });
    
    _.each(value, function (subValue, i) {
      container.find('input[value="' + value[i] + '"]').prop('checked', true);
    });
    
  } else if ('jnews-radio-buttonset' === controlType || 'jnews-radio-image' === controlType || 'jnews-radio' === controlType || 'jnews-dashicons' === controlType || 'jnews-color-palette' === controlType || 'jnews-palette' === controlType) {
    
    // Update the value visually in the control
    container.find('input[value="' + value + '"]').prop('checked', true);
    
    // Update the value in the customizer object
    setting.set(value);
    
  } else if ('jnews-typography' === controlType) {
    
    if (undefined !== value['font-family']) {
      
      $select = $(container.find('.font-family select')).selectize();
      
      if ('undefined' !== typeof select) {
        selectize = $select[0].selectize;
        
        // Update the value visually in the control
        selectize.setValue(value['font-family'], true);
      }
      
    }
    
    if (undefined !== value.variant) {
      
      $select = container.find('.variant select').selectize();
      
      if ('undefined' !== typeof select) {
        selectize = $select[0].selectize;
        
        // Update the value visually in the control
        selectize.setValue(value.variant, true);
      }
      
    }
    
    if (undefined !== value.subsets) {
      
      $select = container.find('.subset select').selectize();
      
      if ('undefined' !== typeof select) {
        selectize = $select[0].selectize;
        
        // Update the value visually in the control
        selectize.setValue(value.subset, true);
      }
      
    }
    
    if (undefined !== value['font-size']) {
      
      // Update the value visually in the control
      container.find('.font-size input').prop('value', value['font-size']);
      
    }
    
    if (undefined !== value['line-height']) {
      
      // Update the value visually in the control
      container.find('.line-height input').prop('value', value['line-height']);
      
    }
    
    if (undefined !== value['letter-spacing']) {
      
      // Update the value visually in the control
      container.find('.letter-spacing input').prop('value', value['letter-spacing']);
      
    }
    
    if (undefined !== value.color) {
      
      // Update the value visually in the control
      typographyColor = container.find('.jnews-color-control');
      
      typographyColor
      .attr('data-default-color', value)
      // .data( 'default-color', value )
      .wpColorPicker('color', value);
    }
    
    // Update the value in the customizer object
    setting.set(value);
    
  } else if ('repeater' === controlType) {
    
    // Do nothing
  }
  
  /**
   * Fallback for all other controls.
   */
  else {
    
    // Update the value visually in the control
    container.find('input').prop('value', value);
    
    // Update the value in the customizer object
    setting.set(value);
    
  }
  
}
