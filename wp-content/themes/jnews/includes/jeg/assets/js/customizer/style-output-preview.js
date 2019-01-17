(function (api, $) {
  "use strict";
  
  if ( ! api.styleOutput ) {
    api.styleOutput = {};
  }
  
  api.styleOutput = {
    rulesCache: [],
  };
  
  api.styleOutput.generateStyle = function (value, option) {
    if (undefined === option.property) {
      option.property = '';
    }
    
    if (undefined === option.prefix) {
      option.prefix = '';
    }
    
    if (undefined === option.units) {
      option.units = '';
    }
    
    if (undefined === option.suffix) {
      option.suffix = '';
    }
    
    return option.property + ' : ' + option.prefix + value + option.units + option.suffix + ';';
  };
  
  api.styleOutput.getFontVariant = function ($variant) {
    if ($variant === '100') {
      return {'weight': '100', 'style': 'normal'};
    }
    if ($variant === '100reguler') {
      return {'weight': '100', 'style': 'reguler'};
    }
    if ($variant === '100italic') {
      return {'weight': '100', 'style': 'italic'};
    }
    if ($variant === '200') {
      return {'weight': '200', 'style': 'normal'};
    }
    if ($variant === '200reguler') {
      return {'weight': '200', 'style': 'reguler'};
    }
    if ($variant === '200italic') {
      return {'weight': '200', 'style': 'italic'};
    }
    if ($variant === '300') {
      return {'weight': '300', 'style': 'normal'};
    }
    if ($variant === '300reguler') {
      return {'weight': '300', 'style': 'reguler'};
    }
    if ($variant === '300italic') {
      return {'weight': '300', 'style': 'italic'};
    }
    if ($variant === 'regular') {
      return {'weight': '400', 'style': 'normal'};
    }
    if ($variant === 'italic') {
      return {'weight': '400', 'style': 'italic'};
    }
    if ($variant === '400reguler') {
      return {'weight': '400', 'style': 'reguler'};
    }
    if ($variant === '400italic') {
      return {'weight': '400', 'style': 'italic'};
    }
    if ($variant === '500') {
      return {'weight': '500', 'style': 'normal'};
    }
    if ($variant === '500reguler') {
      return {'weight': '500', 'style': 'reguler'};
    }
    if ($variant === '500italic') {
      return {'weight': '500', 'style': 'italic'};
    }
    if ($variant === '600') {
      return {'weight': '600', 'style': 'normal'};
    }
    if ($variant === '600reguler') {
      return {'weight': '600', 'style': 'reguler'};
    }
    if ($variant === '600italic') {
      return {'weight': '600', 'style': 'italic'};
    }
    if ($variant === '700') {
      return {'weight': '700', 'style': 'normal'};
    }
    if ($variant === '700reguler') {
      return {'weight': '700', 'style': 'reguler'};
    }
    if ($variant === '700italic') {
      return {'weight': '700', 'style': 'italic'};
    }
    if ($variant === '800') {
      return {'weight': '800', 'style': 'normal'};
    }
    if ($variant === '800reguler') {
      return {'weight': '800', 'style': 'reguler'};
    }
    if ($variant === '800italic') {
      return {'weight': '800', 'style': 'italic'};
    }
    if ($variant === '900') {
      return {'weight': '900', 'style': 'normal'};
    }
    if ($variant === '900reguler') {
      return {'weight': '900', 'style': 'reguler'};
    }
    if ($variant === '900italic') {
      return {'weight': '900', 'style': 'italic'};
    }
  };
  
  api.styleOutput.generateFontStyle = function (value) {
    var style = '';
    
    if (value['font-family'] !== '') {
      style += 'font-family: ' + value['font-family'] + '; ';
      
      if (value['variant'] && value['variant'].constructor === Array && value['variant'].length === 1) {
        var variant = this.getFontVariant(value['variant'][0]);
        style += 'font-weight : ' + variant['weight'] + '; ';
        style += 'font-style : ' + variant['style'] + '; ';
      }
      
      
      if (value['font-size'] && value['font-size'] !== '') {
        style += 'font-size: ' + value['font-size'] + '; ';
      }
      
      if (value['letter-spacing'] && value['letter-spacing'] !== '') {
        style += 'letter-spacing: ' + value['letter-spacing'] + '; ';
      }
      
      if (value['color'] && value['color'] !== '') {
        style += 'color : ' + value['color'] + '; ';
      }
      
      if (value['line-height'] && value['line-height'] !== '') {
        style += 'line-height: ' + value['line-height'] + '; ';
      }
      
      if (value['text-transform'] && value['text-transform'] !== '') {
        style += 'text-transform : ' + value['text-transform'] + '; ';
      }
      
    }
    
    return style;
  };
  
  api.styleOutput.attachGoogleFontHeader = function (value, setting) {
    var font_id = this.settingName(setting, '', '-css');
    
    // need to remove the font first
    $("#" + font_id).remove();
    
    var variant = [];
    var subset = [];
    
    if (value['variant'] && value['variant'].constructor === Array) {
      if (value['variant'].length === 1) {
        variant = ['reguler'];
      } else {
        variant = value['variant'];
      }
    }
    
    if (value['subsets'] && value['subsets'].constructor === Array) {
      subset = value['subsets'];
    }
    
    var font_family = 'family=' + value['font-family'] + ":" + variant.join(',');
    var font_subset = 'subset=' + subset.join(',');
    
    var url = "//fonts.googleapis.com/css?" + encodeURI(font_family + '&' + font_subset);
    $('head').append('<link rel="stylesheet" id="' + font_id + '" href="' + url + '" type="text/css" media="all">');
  };
  
  api.styleOutput.handleInlineStyle = function (setting, value, option) {
    var obj = this;
    
    if (undefined !== option.element) {
      var css = obj.generateStyle(value, option);
      var currentCss = $(option.element).attr('style');
      
      if (undefined === currentCss) {
        currentCss = '';
      }
      
      $(option.element).attr('style', currentCss + css);
    }
  };
  
  api.styleOutput.handleRemoveClass = function (value, option) {
    if (1 === value || '1' === value || true === value || 'true' === value || 'on' === value) {
      $(option.element).removeClass(option.property);
    }
    
    if (0 === value || '0' === value || false === value || 'false' === value || 'off' === value) {
      $(option.element).addClass(option.property);
    }
  };
  
  api.styleOutput.handleInlineSpacing = function (value, option) {
    value = JSON.parse(value);
    
    if (option.property === 'padding') {
      $(option.element).css({
        'padding-top': value['top'],
        'padding-left': value['left'],
        'padding-bottom': value['bottom'],
        'padding-right': value['right']
      });
    }
    
    if (option.property === 'margin') {
      $(option.element).css({
        'margin-top': value['top'],
        'margin-left': value['left'],
        'margin-bottom': value['bottom'],
        'margin-right': value['right']
      });
    }
  };

  api.styleOutput.handleGradient = function(value, option) {
      var degree = value['degree'];
      var begincolor = value['begincolor'];
      var beginlocation = value['beginlocation'];
      var endcolor = value['endcolor'];
      var endlocation = value['endlocation'];

      var gradient = "background: -moz-linear-gradient(" + degree + "deg, " + begincolor + " " + beginlocation + "%, " + endcolor + " " + endlocation + "%);" +
          "background: -webkit-linear-gradient(" + degree + "deg, " + begincolor + " " + beginlocation + "%, " + endcolor + " " + endlocation + "%);" +
          "background: -o-linear-gradient(" + degree + "deg, " + begincolor + " " + beginlocation + "%, " + endcolor + " " + endlocation + "%);" +
          "background: -ms-linear-gradient(" + degree + "deg, " + begincolor + " " + beginlocation + "%, " + endcolor + " " + endlocation + "%);" +
          "background: linear-gradient(" + degree + "deg, " + begincolor + " " + beginlocation + "%, " + endcolor + " " + endlocation + "%);";

      return gradient;
  };
  
  api.styleOutput.handleAddClass = function (value, option) {
    if (1 === value || '1' === value || true === value || 'true' === value || 'on' === value) {
      $(option.element).addClass(option.property);
    }
    
    if (0 === value || '0' === value || false === value || 'false' === value || 'off' === value) {
      $(option.element).removeClass(option.property);
    }
  };
  
  api.styleOutput.handleSwitchClass = function (value, option) {
    if (1 === value || '1' === value || true === value || 'true' === value || 'on' === value) {
      $(option.element).removeClass(option.property[0]).addClass(option.property[1]);
    }
    
    if (0 === value || '0' === value || false === value || 'false' === value || 'off' === value) {
      $(option.element).addClass(option.property[0]).removeClass(option.property[1]);
    }
  };
  
  api.styleOutput.handleClassMasking = function (value, option) {
    $.each(option.property, function (classkey, classname) {
      $(option.element).removeClass(classname);
    });
    
    $(option.element).addClass(option.property[value]);
  };
  
  api.styleOutput.isExcludedFont = function (font) {
    if (font.indexOf(',') >= 0) {
      font = font.substring(font.indexOf(','), 0);
    }
    var inarray = $.inArray(font, window.outputSetting.excludeFont);
    return ( inarray >= 0 );
  };
  
  api.styleOutput.handleOutput = function (output, newval, setting, result) {
    var obj = this;
    
    if (undefined !== output && 0 < output.length) {
      var injectCss = '';
      var css = '';
      
      _.each(output, function (option) {
        
        if (option.method === 'typography') {
          if (undefined !== option.element && newval['font-family'] !== '') {
            // add google font into header
            if (!obj.isExcludedFont(newval['font-family'])) {
              obj.attachGoogleFontHeader(newval, setting);
            }
            
            // css inject
            css = obj.generateFontStyle(newval);
            css = option.element + ' { ' + css + ' } ';
            injectCss += css;
          }
        }

        if (option.method === 'gradient') {
            if (undefined !== option.element) {
                css = obj.handleGradient(newval, option);
                css = option.element + ' { ' + css + ' } ';

                if (undefined !== option.mediaquery) {
                    css = option.mediaquery + ' { ' + css + ' } ';
                }

                injectCss += css;
            }
        }
        
        if (option.method === 'inline-css') {
          if (result) {
            obj.handleInlineStyle(setting, newval, option);
          } else {
            obj.handleInlineStyle(setting, option.default, option);
          }
        }
        
        if (option.method === 'inject-style') {
          if (undefined !== option.element) {
            css = obj.generateStyle(newval, option);
            css = option.element + ' { ' + css + ' } ';
            
            if (undefined !== option.mediaquery) {
              css = option.mediaquery + ' { ' + css + ' } ';
            }
            
            injectCss += css;
          }
        }
        
        if (option.method === 'remove-class') {
          if (result) {
            obj.handleRemoveClass(newval, option);
          } else {
            obj.handleAddClass(newval, option);
          }
        }
        
        if (option.method === 'add-class') {
          if (result) {
            obj.handleAddClass(newval, option);
          } else {
            obj.handleRemoveClass(newval, option);
          }
        }
        
        if (option.method === 'switch-class') {
          if (result) {
            obj.handleSwitchClass(newval, option);
          } else {
            obj.handleSwitchClass(option.default, option);
          }
        }
        
        if (option.method === 'class-masking') {
          if (result) {
            obj.handleClassMasking(newval, option);
          } else {
            obj.handleClassMasking(option.default, option);
          }
        }
        
        if (option.method === 'inline-spacing') {
          if (result) {
            obj.handleInlineSpacing(newval, option);
          } else {
            obj.handleInlineSpacing(option.default, option);
          }
        }
        
      });
      
      var $selector = $('#' + this.settingName(setting));
      
      if (injectCss !== '' && result) {
        if (!$selector.length) {
          $('head').append('<style id="' + this.settingName(setting) + '"> ' + injectCss + ' </style>');
        } else {
          $selector.text(injectCss);
        }
      } else {
        $selector.remove();
      }
      
      if (!result && $selector.length) {
        $selector.remove();
      }
    }
  };
  
  api.styleOutput.settingName = function(setting, prefix, suffix){
    if(typeof prefix === 'undefined') prefix = window.outputSetting.inlinePrefix;
    if(typeof suffix === 'undefined') suffix = '';

    var regexp = new RegExp(window.outputSetting.settingPattern);
    var match = regexp.exec(setting);
    setting = Array.isArray(match) && match.length >= 2 ? match[2] : setting;
    return prefix + setting.replace(/\[/g, '-').replace(/\]/g, '') + suffix
  };
  
  /**
   * Bind setting to style output
   *
   * @param object
   */
  api.styleOutput.bindSetting = function(object) {
    var styleOutput = api.styleOutput;
    styleOutput.rulesCache[object.id] = object.output;
    
    api( object.id, function( setting ){
      setting.bind( function( value ){
        styleOutput.handleOutput(object.output, value, object.id, true);
      });
    });
  };
  
  /**
   * Listen to customizer panel event
   */
  api.styleOutput.initialize = function(){
    api.preview.bind('register-style-output', function (object) {
      api.styleOutput.bindSetting(object);
    });
  
    api.preview.bind('active-callback-control-output', function (object) {
      api.styleOutput.handleOutput(api.styleOutput.rulesCache[object.id], api(object.id).get(), object.id, object.result);
    });
    
    api.preview.bind('register-all-style-output', function(objects){
      _.each(objects, function(object){
        api.styleOutput.bindSetting(object);
      });
    });
  };
  
  api.bind('preview-ready', function () {
    api.styleOutput.initialize();
  });
  
  
})(wp.customize, jQuery);