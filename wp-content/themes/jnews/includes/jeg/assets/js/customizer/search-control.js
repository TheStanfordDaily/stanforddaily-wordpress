(function ($) {
  "use strict";
  
  var api = wp.customize;
  
  /**
   * Search
   */
  api.bind('ready', function () {
    var build_element = function ($header, $control) {
      $header.append(
        "<div class='customizer-search-wrapper'>" +
          "<a href='#' class='customizer-search-toggle'>" +
            "<i class='fa fa-search'></i>" +
          "</a>" +
          "<form class='customizer-form-search'>" +
            "<input type='text' name='customizer-form-input'/>" +
          "</form>" +
        "</div>" +
        "<div class='customizer-search-result'>" +
          "<ul></ul>" +
          "<div class='search-loader hidden'>" +
            "<div class='loader'></div>" +
          "</div>" +
        "</div>"
      );
      $control.append("<div class='customizer-search-overlay'></div>");
    };
    
    var search_string = function (query) {
      query = query.trim();
      
      return wp.ajax.send({
        url: searchSetting.ajaxUrl,
        data: {
          nonce: searchSetting.nonce,
          search: query
        }
      });
    };
    
    var show_loader = function(searchresult) {
        $(searchresult).find('.search-loader').removeClass('hidden');
    };
    
    var hide_loader = function(searchresult){
      $(searchresult).find('.search-loader').addClass('hidden');
    };
    
    var hook_input = function ($searchinput, $searchresult) {
      var timeout = null;
      $searchinput.on('input', function (e) {
        var value = $(this).val();
        clearTimeout(timeout);
        timeout = setTimeout(function () {
          value = value.trim();
          
          if (value.length >= 3) {
            show_loader($searchresult);
            var result = search_string(value);
            result.done(build_search_result.bind($searchresult))
          }
        }, 500);
      });
    };
    
    var build_search_result = function (responses) {
      var wrapper = this;
      var result = _.sortBy(responses, 'match').reverse();
      var html = '';
      
      _.each(result, function(content){
        var section = api.section(content.section);
        var path = section.params.title;
        
        var panelID = api.section(content.section).panel();
        if(panelID) {
          path = api.panel(panelID).params.title + " &raquo; " + path;
        }
        
        html = html +
          "<li class='search-li' data-section='" + content.section + "' data-control='" + content.id + "'>" +
            "<span>" + path + "</span>" +
            "<h3>" + content.label + "</h3>" +
            "<em>" + content.description + "</em>" +
          "</li>";
      });
      
      $(wrapper).find('ul').html(html);
      hide_loader(wrapper);
    };
    
    var resize_search_result = function ($searchresult, $control) {
      var resize_search_container = function () {
        var wh = $control.height();
        $searchresult.height(wh - 90);
      };
      
      resize_search_container();
      $(window).bind('resize', resize_search_container);
    };
    
    var dispatch = function () {
      var showsearch = false;
      var $header = $("#customize-header-actions");
      var $control = $("#customize-controls");
      
      build_element($header, $control);
      
      var $searchinput = $header.find("input[type='text']");
      var $searchwrapper = $header.find('.customizer-search-wrapper');
      var $togglebutton = $header.find('.customizer-search-toggle');
      var $toggleicon = $header.find('.customizer-search-toggle i');
      var $searchresult = $header.find('.customizer-search-result');
      var $overlay = $control.find('.customizer-search-overlay');
      
      resize_search_result($searchresult, $control);
      
      var open_search = function () {
        $toggleicon.removeClass('fa-search').addClass('fa-times');
        $searchwrapper.addClass('active');
        $searchresult.addClass('active');
        $overlay.addClass('active');
        $searchinput.focus();
        showsearch = true;
      };
      
      var close_search = function () {
        $toggleicon.removeClass('fa-times').addClass('fa-search');
        $searchwrapper.removeClass('active');
        $searchresult.removeClass('active');
        $overlay.removeClass('active');
        showsearch = false;
      };
  
      var focus_control = function(controlID) {
        var control = api.control(controlID);
        if(control) control.focus();
      };
      
      $togglebutton.bind('click', function (e) {
        e.preventDefault();
        
        if (!showsearch) {
          open_search();
        } else {
          close_search();
        }
      });
      
      hook_input($searchinput, $searchresult);
      
      $searchresult.on('click', '.search-li', function () {
        var control = $(this).data('control');
        var section = $(this).data('section');
        
        var sectionAPI = api.section(section);
        close_search();
        
        if(sectionAPI.params.type === 'lazy') {
          if(sectionAPI.loaded) {
            focus_control(control);
          } else {
            var promise = sectionAPI.expand();
            promise.done(function(){
              focus_control(control);
            });
          }
        } else {
          focus_control(control);
        }
      });
    };
    
    dispatch();
  });
})(jQuery);