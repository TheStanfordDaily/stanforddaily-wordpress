(function (api, $) {
  
  /************************************************************************************************************************
   * Overwrite JNews Preset
   ***********************************************************************************************************************/
  
  api.controlConstructor['jnews-preset'] = api.controlConstructor.default.extend({
    ready: function () {
      var control = this,
        selectValue;
      
      // Trigger a change
      this.container.on('change', 'select', function () {
        // Get the control's value
        selectValue = jQuery(this).val();
        control.setting.set(selectValue);
        
        if (control.id === 'jnews_hb_preset') {
          preset_clicked(control, selectValue);
        }
        else {
          $.each(control.params.choices, function (key, value) {
            if (selectValue === key) {
              $.each(value.settings, function (presetSetting, presetSettingValue) {
                jnewsSetSettingValue(presetSetting, presetSettingValue);
              });
            }
          });
        }
      });
    }
  });
  
  function preset_clicked(control, selectValue) {
    var preset = null;
    
    $.each(control.params.choices, function (key, value) {
      if (selectValue === key) {
        preset = value.settings;
      }
    });
    
    reset_header_default(preset);
    clear_all_block();
    hb_desktop_preset();
    hb_sticky_preset();
    hb_mobile_preset();
    hb_mobile_drawer_preset();
  }
  
  function clear_all_block() {
    $(".header-builder-body .header-builder-device").each(function () {
      var element = $(this);
      var blocks = $(element).find('.header-builder-column');
      
      $.each(blocks, function (key, block) {
        clear_block(block);
      });
    });
  }
  
  function reset_header_default(preset) {
    var sections = api.panel('jnews_header').sections();
    
    // loop section inside panel
    $.each(sections, function (key, section) {
      
      var controls = section.controls();
      
      // loop control inside section
      $.each(controls, function (key, control) {
        if (undefined !== preset[control.id]) {
          jnewsSetSettingValue(control.id, preset[control.id]);
        } else {
          jnewsSetSettingValue(control.id, control.params.default);
        }
      });
    });
  }
  
  function hb_desktop_preset() {
    var rows = ['top', 'mid', 'bottom'];
    var columns = ['left', 'center', 'right'];
    
    // change align & display
    $.each(rows, function (key, row) {
      $.each(columns, function (key, column) {
        var align = api.control('jnews_hb_align_desktop_' + row + '_' + column).setting();
        var display = api.control('jnews_hb_display_desktop_' + row + '_' + column).setting();
        var element = api.control('jnews_hb_element_desktop_' + row + '_' + column).setting();
        
        change_column_align('desktop', row, column, align);
        change_column_display('desktop', row, column, display);
        change_column_element('desktop', row, column, element);
      });
    });
    
    // change arrangement
    var arrangement = api.control('jnews_hb_arrange_bar').setting();
    change_row_arrangement('desktop', arrangement);
  }
  
  function hb_sticky_preset() {
    var rows = ['mid'];
    var columns = ['left', 'center', 'right'];
    
    // change align & display
    $.each(rows, function (key, row) {
      $.each(columns, function (key, column) {
        var align = api.control('jnews_hb_align_desktop_sticky_' + row + '_' + column).setting();
        var display = api.control('jnews_hb_display_desktop_sticky_' + row + '_' + column).setting();
        var element = api.control('jnews_hb_element_desktop_sticky_' + row + '_' + column).setting();
        
        change_column_align('desktop_sticky', row, column, align);
        change_column_display('desktop_sticky', row, column, display);
        change_column_element('desktop_sticky', row, column, element);
      });
    });
  }
  
  function hb_mobile_preset() {
    var rows = {
      top: ['center'],
      mid: ['left', 'center', 'right']
    };
    
    // change align & display
    $.each(rows, function (row, columns) {
      $.each(columns, function (key, column) {
        var align = api.control('jnews_hb_align_mobile_' + row + '_' + column).setting();
        var display = api.control('jnews_hb_display_mobile_' + row + '_' + column).setting();
        var element = api.control('jnews_hb_element_mobile_' + row + '_' + column).setting();
        
        change_column_align('mobile', row, column, align);
        change_column_display('mobile', row, column, display);
        change_column_element('mobile', row, column, element);
      });
    });
  }
  
  function hb_mobile_drawer_preset() {
    var rows = ['top', 'bottom'];
    var columns = ['center'];
    
    // change align & display
    $.each(rows, function (key, row) {
      $.each(columns, function (key, column) {
        var element = api.control('jnews_hb_element_mobile_drawer_' + row + '_' + column).setting();
        change_column_element('mobile_drawer', row, column, element);
      });
    });
  }
  
  function begin_with(needle, haystack) {
    return (haystack.substr(0, needle.length) == needle);
  }
  
  function find_row_column(element) {
    var column = $(element).parents('.header-builder-column').data('column');
    var row = $(element).parents('.header-builder-row').data('row');
    var device = $(element).parents('.header-builder-device').data('device');
    
    return [row, column, device];
  }
  
  function change_option(setting, option) {
    var control = api.control(setting);
    
    if (control) {
      var $select = $(control.container.find('select')).selectize();
      var selectize = $select[0].selectize;
      selectize.setValue(option, true);
    }
    
    // Update the value in the customizer object
    var control_setting = api.instance(setting);
    
    if (control_setting) {
      control_setting.set(option);
    }
  }
  
  function change_column_option(device_mode, prefix, row, column, option) {
    var setting = prefix + '_' + device_mode + '_' + row + '_' + column;
    change_option(setting, option);
  }
  
  function open_setting() {
    $("[data-section^=jnews]").bind('click', function () {
      go_to_section(this);
    });
    
    $("[data-control^=jnews]").bind('click', function () {
      go_to_control(this);
    });
  }
  
  function go_to_section(element) {
    var data_section = $(element).data('section');
    var section_id = '';
    var device = $(element).parents('.header-builder-device').data('device');
    
    if (data_section === 'jnews_header_ads') {
      section_id = 'jnews_ads_header_section';
    } else if (begin_with('jnews_header_html', data_section)) {
      section_id = 'jnews_header_html_section';
    } else if (begin_with('jnews_header_button', data_section)) {
      section_id = 'jnews_header_button_section';
    } else if (begin_with('jnews_header_verticalmenu', data_section)) {
      section_id = 'jnews_header_vertical_menu_section';
    } else if (begin_with('jnews_header_search_icon', data_section)) {
      if (device === 'mobile') {
        go_to_control('jnews_header_search_icon_section[jnews_header_search_icon_mobile]');
        return;
      } else {
        section_id = data_section + '_section';
      }
    } else {
      section_id = data_section + '_section';
    }
    
    var section = api.section(section_id);
    if (section) section.focus();
  }
  
  function go_to_control(element) {
    var data_control = typeof element === 'string' ? element : $(element).data('control');
    var regexp = /([^[]+)\[([^\]]+)\]/g;
    
    if(data_control.match(regexp)) {
      var match = regexp.exec(data_control);
      var section = api.section(match[1]);
      
      if(section.loaded) {
        focus_control(match[2]);
      } else {
        var promise = section.expand();
        
        promise.done(function(){
          setTimeout(function(){
            focus_control(match[2]);
          });
        }, 3000);
      }
    } else {
      focus_control(data_control);
    }
  }
  
  function focus_control(controlID) {
    var control = api.control(controlID);
    if(control) control.focus();
  }
  
  function find_element(device_mode, name) {
    return $("[data-device='" + device_mode + "'] [data-element='" + name + "']");
  }
  
  function open_alert(text) {
    $(".warning-text").html(text);
    $(".header-builder-warning").fadeIn('fast');
    $(".close-warning").bind('click', function () {
      $(this).parents('.header-builder-warning').fadeOut('fast');
    });
  }
  
  /************************************************************************************************************************
   * Header Builder Open / Close
   ***********************************************************************************************************************/
  
  function open_header_builder() {
    $('body').addClass('header-builder-open');
  }
  
  function close_header_builder() {
    $('body').removeClass('header-builder-open');
  }
  
  /************************************************************************************************************************
   * Change Align on Column
   ************************************************************************************************************************/
  
  function change_column_align(device_mode, row, column, align) {
    var element = $("[data-device='" + device_mode + "'] [data-row='" + row + "'] [data-column='" + column + "'] [data-align='" + align + "']");
    
    // active class
    $(element).parent().find('> li').removeClass('active');
    $(element).addClass('active');
    
    // parent column
    var parentColumn = $(element).parents('.header-builder-column');
    parentColumn.removeClass('left center right').addClass(align);
  }
  
  function align_click() {
    $(".header-column-option-align li").bind('click', function (e) {
      if (!$(this).hasClass('active')) {
        var selector = find_row_column(this);
        change_column_align(selector[2], selector[0], selector[1], $(this).data('align'));
        change_column_option(selector[2], 'jnews_hb_align', selector[0], selector[1], $(this).data('align'));
      }
    });
  }
  
  
  /************************************************************************************************************************
   * Change Display on Column
   ************************************************************************************************************************/
  
  function change_column_display(device_mode, row, column, display) {
    var element = $("[data-device='" + device_mode + "'] [data-row='" + row + "'] [data-column='" + column + "'] [data-display='" + display + "']");
    
    // active class
    $(element).parent().find('> li').removeClass('active');
    $(element).addClass('active');
    
    // parent column
    var parentColumn = $(element).parents('.header-builder-column');
    parentColumn.removeClass('grow normal').addClass(display);
  }
  
  function display_click() {
    $(".header-column-option-display li").bind('click', function (e) {
      if (!$(this).hasClass('active')) {
        var selector = find_row_column(this);
        change_column_display(selector[2], selector[0], selector[1], $(this).data('display'));
        change_column_option(selector[2], 'jnews_hb_display', selector[0], selector[1], $(this).data('display'));
      }
    });
  }
  
  
  /************************************************************************************************************************
   * Element
   ************************************************************************************************************************/
  
  function clear_block(block) {
    var parent = $(block).parents('.header-builder-device');
    var list = $(parent).find('.header-builder-list');
    
    $(block).find('.header-element').appendTo(list);
    
  }
  
  function update_block(element) {
    element = $(element).hasClass('header-builder-drop-zone') ? element : $(element).parents('.header-builder-drop-zone');
    
    if ($(element).hasClass('header-builder-list')) {
      return null;
    }
    
    // populate element
    var elements = [];
    $(element).find('.header-element').each(function () {
      elements.push($(this).data('element'));
    });
    
    // selector
    var selector = find_row_column(element);
    change_column_option(selector[2], 'jnews_hb_element', selector[0], selector[1], elements);
  }
  
  function sortable_element() {
    $(".header-builder-drop-zone").sortable({
      items: ".header-element",
      connectWith: ".header-builder-drop-zone",
      update: function (event, ui) {
        if (ui.sender !== null) update_block(ui.sender);
        update_block(ui.item);
      }
    });
  }
  
  function element_close_clicked() {
    $(".header-element-close").bind('click', function () {
      var element = $(this).parent();
      var cache_drop_zone = $(element).parent();
      var parent = $(this).parents('.header-builder-body');
      var list = $(parent).find('.header-builder-list');
      
      $(element).appendTo(list);
      update_block(cache_drop_zone);
    });
  }
  
  function change_column_element(device_mode, row, column, elements) {
    var block = $("[data-device='" + device_mode + "'] [data-row='" + row + "'] [data-column='" + column + "']");
    
    // need to clear the block first
    clear_block(block);
    var drop_zone = $(block).find('.header-builder-drop-zone ');
    
    $.each(elements, function (key, value) {
      var ele = find_element(device_mode, value);
      $(ele).appendTo(drop_zone);
    });
  }
  
  
  /************************************************************************************************************************
   * Sortable Header Bar
   ************************************************************************************************************************/
  
  function update_header_bar() {
    var bars = [];
    
    $("[data-device='desktop'] .header-builder-row").each(function () {
      bars.push($(this).data('row'));
    });
    
    change_option('jnews_hb_arrange_bar', bars);
  }
  
  function sortable_header_bar() {
    $(".header-builder-wrapper").sortable({
      handle: '.header-builder-row-drag-handle',
      cancel: ".header-builder-top",
      update: function () {
        update_header_bar();
      },
      beforeStop: function (ev, ui) {
        var index = $(ui.placeholder).index();
        var can_move = $(ui.item).data('row') === 'mid' || $(ui.item).data('row') === 'bottom';
        
        if (index === 1 && can_move) {
          $(this).sortable('cancel');
          open_alert('Unable to move <strong>Middle Bar & Bottom Bar</strong> above <strong>Top Bar</strong>');
        }
      }
    });
  }
  
  function change_row_arrangement(device_mode, rows) {
    var row_cache, row_element;
    
    $.each(rows, function (key, row) {
      row_element = $("[data-device='" + device_mode + "'] [data-row='" + row + "']");
      
      if (key > 0) {
        $(row_element).insertAfter(row_cache);
      }
      
      row_cache = $("[data-device='" + device_mode + "'] [data-row='" + row + "']");
    });
  }
  
  /************************************************************************************************************************
   * Mobile
   ************************************************************************************************************************/
  
  function switch_device() {
    $(".device-mode > div").bind('click', function () {
      $(".devices .preview-" + $(this).data('mode')).click();
    });
    
    $(".desktop-mode li").bind('click', function () {
      var desktopmode = $(this).data('desktop-mode');
      $(".wp-full-overlay").removeClass('sticky normal').addClass(desktopmode);
    });
    
    $(".mobile-mode li").bind('click', function () {
      var mobilemode = $(this).data('mobile-mode');
      $(".wp-full-overlay").removeClass('mobile_menu drawer').addClass(mobilemode);
    });
  }
  
  function header_setting() {
    $(".header-setting").bind('mousedown', function () {
      var element = $(this);
      var parent = $(element).parents('.header-builder-column');
      
      if ($(parent).hasClass('active')) {
        $(parent).removeClass('active');
      } else {
        $('.header-builder-column').removeClass('active');
        $(parent).addClass('active');
      }
    });
    
    $(document).bind('mousedown', function (e) {
      var target = e.target;
      var tooltip = $(target).parents('.header-column-option-tooltip');
      var setting_parent = $(target).parents('.header-setting');
      var setting = $(target).hasClass('header-setting');
      
      if (tooltip.length === 0 && setting_parent.length === 0 && !setting) {
        $('.header-builder-column').removeClass('active');
      }
    });
  }
  
  
  function header_builder_button() {
    var $header = $("#customize-header-actions");
    $header.append("<div class='jeg-btn-header-builder'><i class='fa fa-bars'></i></div>");
    
    $(".jeg-btn-header-builder").bind('click', function () {
      if ($('body').hasClass('header-builder-open')) {
        close_header_builder();
      } else {
        open_header_builder();
      }
    });
  }
  
  
  /************************************************************************************************************************
   * Dispatch
   ************************************************************************************************************************/
  
  function dispatch() {
    // Open header builder
    $('body').bind('jnews-open-header-builder', open_header_builder);
    
    // Close header builder
    $(".top-menu.close").bind('click', function () {
      close_header_builder();
    });
    
    $('.header-builder-open').bind('click', open_header_builder);
    
    // switch device
    switch_device();
    
    // Sortable Header Bar
    sortable_header_bar();
    
    // Align Click
    align_click();
    
    // Display Type click
    display_click();
    
    // sortable element
    sortable_element();
    
    // Element Close Clicked
    element_close_clicked();
    
    // Open Setting
    open_setting();
    
    // Header setting clicked
    header_setting();
    
    // Header Builder Button
    header_builder_button();
  }
  
  $(document).ready(dispatch);
  
})(wp.customize, jQuery);