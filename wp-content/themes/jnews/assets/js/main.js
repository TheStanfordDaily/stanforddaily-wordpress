/* ------------------------------------------------------------------------- *
 *  Main Script
 * ------------------------------------------------------------------------- */
(function ($) {
  "use strict";
  
  /** Multimedia Embed **/
  $.youtube_parser = function (url) {
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    
    if (match && match[7].length === 11) {
      return match[7];
    }
    /*jshint latedef: true */
    window.alert("Url Incorrect");
  };
  
  $.vimeo_parser = function (url) {
    var regExp = /http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
    var match = url.match(regExp);
    
    if (match) {
      return match[2];
    }
    
    // check if using https
    regExp = /https:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
    match = url.match(regExp);
    
    if (match) {
      return match[2];
    }
    
    /*jshint latedef: true */
    window.alert("not a vimeo url");
  };
  
  $.type_video_youtube = function (ele, autoplay, repeat) {
    var youtube_id = $.youtube_parser($(ele).attr('data-src'));
    var additionalstring = '';
    var iframe = '';
    if (repeat) {
      additionalstring += ( autoplay === true ) ? "autoplay=1&" : "";
      additionalstring += (repeat === true ) ? "loop=1&playlist=" + youtube_id : "";
      iframe = '<iframe width="700" height="500" src="//www.youtube.com/v/' + youtube_id + '?version=3&' + additionalstring + 'showinfo=0&theme=light&autohide=1&rel=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>';
    } else {
      additionalstring += ( autoplay === true ) ? "autoplay=1&" : "";
      iframe = '<iframe width="700" height="500" src="//www.youtube.com/embed/' + youtube_id + '?' + additionalstring + 'showinfo=0&theme=light&autohide=1&rel=0&wmode=opaque" frameborder="0" allowfullscreen></iframe>';
    }
    
    $('.jeg_video_container', ele).append(iframe);
  };
  
  $.type_video_vimeo = function (ele, autoplay, repeat) {
    var vimeo_id = $.vimeo_parser($(ele).attr('data-src'));
    var additionalstring = '';
    additionalstring += ( autoplay === true ) ? "autoplay=1&" : "";
    additionalstring += (repeat === true ) ? "loop=1&" : "";
    var iframe = '<iframe src="//player.vimeo.com/video/' + vimeo_id + '?' + additionalstring + 'title=0&byline=0&portrait=0" width="700" height="500" frameborder="0" mozallowfullscreen webkitallowfullscreen allowfullscreen></iframe>';
    $('.jeg_video_container', ele).append(iframe);
  };
  
  $.type_soundcloud = function (ele) {
    var soundcloudurl = $(ele).attr('data-src');
    var iframe = '<iframe src="https://w.soundcloud.com/player/?url=' + encodeURIComponent(soundcloudurl) + '" width="700" height="500" frameborder="0"></iframe>';
    $('.jeg_video_container', ele).append(iframe);
  };
  
  $.type_audio = function (ele) {
    var musicmp3 = '';
    var musicogg = '';
    
    if ($(ele).data('mp3') !== '') {
      musicmp3 = "<source type='audio/mpeg' src='" + $(ele).data('mp3') + "' />";
    }
    
    if ($(ele).data('ogg') !== '') {
      musicogg = "<source type='audio/ogg' src='" + $(ele).data('ogg') + "' />";
    }
    
    var audio =
      "<audio preload='none' style='width: 100%; visibility: hidden;' controls='controls'>" +
      musicmp3 + musicogg +
      "</audio>";
    
    $(ele).append(audio);
    
    
    var settings = {};
    
    if (typeof _wpmejsSettings !== 'undefined') {
      settings = _wpmejsSettings;
    }
    
    settings.success = function (mejs) {
      var autoplay, loop;
      
      if ('flash' === mejs.pluginType) {
        autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
        loop = mejs.attributes.loop && 'false' !== mejs.attributes.loop;
        
        autoplay && mejs.addEventListener('canplay', function () {
          mejs.play();
        }, false);
        
        loop && mejs.addEventListener('ended', function () {
          mejs.play();
        }, false);
      }
    };
    
    $(ele).find('audio').mediaelementplayer(settings);
  };
  
  $.type_video_html5 = function (ele, autoplay, options, container) {
    var cover = $(ele).data('cover');
    
    options.pauseOtherPlayers = false;
    
    var videomp4 = '';
    var videowebm = '';
    var videoogg = '';
    
    var themesurl = '';
    
    if ($(ele).data('mp4') !== '') {
      videomp4 = "<source type='video/mp4' src='" + $(ele).data('mp4') + "' />";
    }
    
    if ($(ele).data('webm') !== '') {
      videowebm = "<source type='video/webm' src='" + $(ele).data('webm') + "' />";
    }
    
    if ($(ele).data('ogg') !== '') {
      videoogg = "<source type='video/ogg' src='" + $(ele).data('ogg') + "' />";
    }
    
    var preload = autoplay ? "preload='auto'" : "preload='none'";
    var object = "<object width='100%' height='100%' type='application/x-shockwave-flash' data='" + themesurl + "/public/mediaelementjs/flashmediaelement.swf'>" +
      "<param name='movie' value='" + themesurl + "/public/mediaelementjs/flashmediaelement.swf' />" +
      "<param name='flashvars' value='controls=true&file=" + $(ele).data('mp4') + "' />" +
      "<img src='" + cover + "' alt='No video playback capabilities' title='No video playback capabilities' />" +
      "</object>";
    var iframe = "<video id='player' style='width:100%;height:100%;' width='100%' height='100%' poster='" + cover + "' controls='controls' " + preload + ">" +
      videomp4 + videowebm + videoogg + object +
      "</video>";
    
    $(container, ele).append(iframe);
    if (autoplay) {
      options.success = function (mediaElement) {
        if (mediaElement.pluginType === 'flash') {
          mediaElement.addEventListener('canplay', function () {
            mediaElement.play();
          }, false);
        } else {
          mediaElement.play();
        }
      };
    }
    
    $(ele).find('video').mediaelementplayer(options);
  };
  
  function not_elementor_bg_video(element) {
    return $(element).parents('.elementor-background-video-container');
  }
  
  function do_media_render(container) {
    // youtube
    if ($(container).find("[data-type='youtube']").length) {
      $(container).find("[data-type='youtube']").each(function () {
        var autoplay = $(this).data('autoplay');
        var repeat = $(this).data('repeat');
        $.type_video_youtube($(this), autoplay, repeat);
      });
    }
    
    // vimeo
    if ($(container).find("[data-type='vimeo']").length) {
      $(container).find("[data-type='vimeo']").each(function () {
        var autoplay = $(this).data('autoplay');
        var repeat = $(this).data('repeat');
        $.type_video_vimeo($(this), autoplay, repeat);
      });
    }
    
    // sound cloud
    if ($(container).find("[data-type='soundcloud']").length) {
      $(container).find("[data-type='soundcloud']").each(function () {
        $.type_soundcloud($(this));
      });
    }
    
    // audio
    if ($(container).find("[data-type='audio']").length) {
      $(container).find("[data-type='audio']").each(function () {
        $.type_audio($(this));
      });
    }
    
    // html 5 video
    if ($(container).find("video").length) {
      $(container).find('video').each(function () {
        if (!not_elementor_bg_video(this)) {
          $(this).mediaelementplayer();
        }
      });
    }
  }
  
  function pin_it_image() {
    $("img").attr("data-pin-no-hover", true);
    $(".article-content img, .featured img").removeAttr("data-pin-no-hover");
  }
  
  function sidecontent_scroll() {
    var sidecontent_wrapper = $(".sidecontent_postwrapper");
    
    if (sidecontent_wrapper.length) {
      sidecontent_wrapper.jScrollPane({
        mouseWheelSpeed: 50
      });
      var sidecontent_jsp = sidecontent_wrapper.data('jsp');
      var top = ( jnewsoption.admin_bar == 1 ) ? 32 : 0;
      
      var calculate_sidebar_size = function () {
        
        if ($(window).width() > 1024) {
          sidecontent_wrapper.css('height', $(window).height() - $('.jeg_side_heading').outerHeight() - top);
        } else {
          $('#jeg_sidecontent').css('height', $(window).height() - $('.jeg_navbar_mobile_wrapper').outerHeight());
          sidecontent_wrapper.css('height', $(window).height() - $('.jeg_side_heading').outerHeight() - $('.jeg_navbar_mobile_wrapper').outerHeight());
        }
        
        sidecontent_jsp.reinitialise();
      };
      
      $(window).bind('resize load', calculate_sidebar_size);
    }
  }
  
  function sidecontent() {
    var sidecontent = $('#jeg_sidecontent');
    
    if (sidecontent.length) {
      var offset_top = $('.jeg_header').outerHeight();
      var top = 0;
      var st = 0;
      
      sidecontent_scroll();
      
      var do_sticky_sidebar = function () {
        st = $(window).scrollTop();
        top = ( jnewsoption.admin_bar == 1 ) ? 32 : 0;
        
        if (st > offset_top) {
          sidecontent.addClass('fixed');
        } else {
          sidecontent.removeClass('fixed');
          top = offset_top + top;
        }
        
        sidecontent.css({'top': top});
      };
      
      if ($(window).width() > 1024) {
        $(window).bind('scroll load', do_sticky_sidebar);
      } else {
        $(window).unbind('scroll load', do_sticky_sidebar);
      }
    }
  }
  
  function do_fullscreen_post() {
    var fscontainer = $('.jeg_fs_container');
    var fscontent = fscontainer.find('.jeg_fs_content');
    var fsbg = fscontainer.find('.jeg_featured_bg');
    var fsarrow = fscontainer.find('.jeg_fs_scroll');
    
    var calculateheight = function () {
      var header = $('.jeg_header');
      var mobilenav = $('.jeg_navbar_mobile');
      
      if (fscontent.length > 0) {
        var header_height = header.is(':visible') ? header.outerHeight() : mobilenav.outerHeight();
        var wh = $(window).height();
        
        $(fscontent).css({height: (wh - header_height) + 'px'});
        $(fsbg).css({height: wh + 'px'});
      }
    };
    
    // parallax
    $('.jeg_parallax .jeg_featured_img').each(function () {
      $(this).parallax('50%', 0.15);
    });
    
    // Arrow click: scroll to content
    fsarrow.bind('click', function () {
      var top = $('.jeg_scroll_flag').offset().top;
      $('html, body').animate({scrollTop: top}, 800);
    });
    
    var scroller = function () {
      var st = $(window).scrollTop();
      var height = fscontainer.outerHeight();
      var ratio = 1 - (st / height);
      
      // Post Content
      if ($('body').hasClass('jeg_single_tpl_5')) {
        var scale = (1 - (st / height * 0.2)); // Min scale 0.8
        fscontainer.find('.entry-header .container').css({
          'opacity': ratio,
          '-webkit-transform': 'scale(' + scale + ')',
          'transform': 'scale(' + scale + ')',
        });
      } else {
        fscontainer.find('.entry-header .container').css({
          'opacity': ratio
        });
      }
      
      // Arrow
      fsarrow.css("opacity", ratio - 0.2);
    };
    
    $(window).bind('resize load', calculateheight);
    $(document).bind('ready', calculateheight);
    $(window).bind('scroll load resize', scroller);
  }
  
  function scroll_to_top() {
    var scrollto = $('.jscroll-to-top');
    
    var do_scroll_to_top = function () {
      var st = $(window).scrollTop();
      
      if (st > 400) {
        scrollto.addClass('show');
      } else {
        scrollto.removeClass('show');
      }
    };
    
    scrollto.click(function () {
      $('html, body').animate({scrollTop: 0}, 600);
      return false;
    });
    
    if ($(window).width() > 1024) {
      $(window).bind('scroll load', do_scroll_to_top);
    } else {
      $(window).unbind('scroll load', do_scroll_to_top);
    }
  }
  
  $.fn.jnews_carousel = function () {
    $(this).each(function () {
      $(this).find('.jeg_postblock_carousel_1, .jeg_postblock_carousel_2, .jeg_postblock_carousel_3').each(function () {
        var container = $(this);
        var carousel = container.find('.jeg_carousel_post');
        var options = {
          nav: carousel.data('nav'),
          autoplay: carousel.data('autoplay'),
          items: carousel.data('items') === undefined ? 3 : carousel.data('items'),
          delay: carousel.data('delay') === undefined ? 3000 : carousel.data('delay'),
          rtl: carousel.data('rtl'),
          margin: carousel.data('margin') === undefined ? 20 : carousel.data('margin')
        };
        
        /*** Postblock Carousel 1 ***/
        if (container.hasClass('jeg_postblock_carousel_1')) {
          
          /* Fullwidth (column 12) */
          if (container.hasClass('jeg_col_12')) {
            options.items = carousel.data('items') === undefined ? 5 : carousel.data('items');
          }
          
          carousel.owlCarousel({
            rtl: jnewsoption.rtl == 1,
            nav: options.nav,
            margin: options.margin,
            navText: false,
            dots: false,
            loop: true,
            items: options.items,
            autoplay: options.autoplay,
            autoplayTimeout: options.delay,
            animateOut: 'fadeOut',
            autoHeight: true,
            responsive: {
              0: {items: 1},
              321: {items: 2, margin: 15},
              568: {items: 3, margin: 15},
              1024: {items: options.items}
            }
          });
          
          /*** Postblock Carousel 2 ***/
        } else if (container.hasClass('jeg_postblock_carousel_2')) {
          
          /* Fullwidth (column 12) */
          if (container.hasClass('jeg_col_12')) {
            options.items = carousel.data('items') === undefined ? 3 : carousel.data('items');
            
            options.responsive = {
              0: {items: 1},
              568: {items: 2},
              768: {items: options.items > 3 ? 3 : options.items},
              1024: {items: options.items}
            };
            
            /* Main content w/ sidebar (column 8) */
          } else if (container.hasClass('jeg_col_8')) {
            options.items = carousel.data('items') === undefined ? 2 : carousel.data('items');
            
            options.responsive = {
              0: {items: 1},
              568: {items: 2},
              1024: {items: options.items}
            };
            
          } else {
            options.items = 1;
            
            options.responsive = {
              0: {items: 1},
              568: {items: 2},
              768: {items: options.items}
            };
          }
          
          options.responsive = {
            0: {items: 1},
            568: {items: 2},
            768: {items: options.items > 3 ? 3 : options.items},
            1024: {items: options.items}
          };
          
          carousel.owlCarousel({
            rtl: jnewsoption.rtl == 1,
            nav: options.nav,
            margin: options.margin,
            navText: false,
            dots: false,
            loop: true,
            items: options.items,
            autoplay: options.autoplay,
            autoplayTimeout: options.delay,
            animateOut: 'fadeOut',
            autoHeight: false,
            responsive: options.responsive
          });
        } else if (container.hasClass('jeg_postblock_carousel_3')) {
          
          /* Fullwidth (column 12) */
          if (container.hasClass('jeg_col_12')) {
            options.items = carousel.data('items') === undefined ? 3 : carousel.data('items');
            
            options.responsive = {
              0: {items: 1},
              568: {items: 2},
              768: {items: options.items > 3 ? 3 : options.items},
              1024: {items: options.items}
            };
            
            /* Main content w/ sidebar (column 8) */
          } else if (container.hasClass('jeg_col_8')) {
            options.items = carousel.data('items') === undefined ? 2 : carousel.data('items');
            
            options.responsive = {
              0: {items: 1},
              568: {items: 2},
              1024: {items: options.items}
            };
            
          } else {
            options.items = 1;
            
            options.responsive = {
              0: {items: 1},
              568: {items: 2},
              768: {items: options.items}
            };
          }
          
          options.responsive = {
            0: {items: 1},
            568: {items: 2},
            768: {items: options.items > 3 ? 3 : options.items},
            1024: {items: options.items}
          };
          
          carousel.owlCarousel({
            rtl: jnewsoption.rtl == 1,
            nav: options.nav,
            margin: options.margin,
            navText: false,
            dots: false,
            loop: true,
            items: options.items,
            autoplay: options.autoplay,
            autoplayTimeout: options.delay,
            animateOut: 'fadeOut',
            autoHeight: true,
            responsive: options.responsive
          });
        }
      });
    });
  };
  
  
  /** Tab **/
  $.fn.jtabs = function () {
    $(this).each(function () {
      var ele = $(this);
      var active = $(".jeg_tabpost_nav li.active", ele);
      
      var set_active = function (nav) {
        var contentID = $(nav).data('tab-content');
        $('.jeg_tabpost_nav li.active', ele).removeClass("active");
        $(nav).addClass("active");
        $('.jeg_tabpost_item.active', ele).removeClass('active');
        $('.jeg_tabpost_item[id="' + contentID + '"]', ele).addClass('active');
      };
      
      if (active.length) {
        set_active(active);
      } else {
        var firstitem = $(".jeg_tabpost_nav li", ele).first();
        set_active(firstitem);
      }
      
      $(".jeg_tabpost_nav li", ele).bind('click', function () {
        if (!$(this).hasClass("active")) {
          set_active(this);
        }
      });
    });
  };
  
  /** jskill plugin **/
  $.fn.jskill = function () {
    return $(this).each(function () {
      var element = $(this);
      
      // window.setTimeout(function () {
      element.waypoint(function (direction) {
        var container = element.find('li');
        var scoretype = element.data('scoretype');
        
        element.addClass('show');
        
        container.each(function (i) {
          var progressbar = $(this).find('.barbg');
          var reviewscore = $(this).find('.reviewscore');
          var counter = progressbar.attr('data-width');
          
          window.setTimeout(function () {
            // var scorevalue = scoretype === "point" ?  '%' : '.';
            
            reviewscore.prop('Counter', 0).animate({
              Counter: counter
            }, {
              duration: 600,
              easing: 'swing',
              step: function (now) {
                var scorevalue = '';
                
                if (scoretype === "point") {
                  // scorevalue = +(Math.round(now * 0.1 + "e+1") + "e-1");
                  scorevalue = Math.ceil(now * 0.1);
                } else {
                  scorevalue = Math.ceil(now) + '%';
                }
                
                $(this).text(scorevalue);
                progressbar.css('width', now + '%');
              }
            });
            
          }, 250 * i);
        });
        
        // Trigger Once
        this.destroy();
        
      }, {
        offset: '80%',
        context: window
      });
      // }, 1000);
    });
  };
  
  /** video background **/
  $.fn.jvideo_background = function () {
    function jeg_resizevideobg(container) {
      var size = calculate_container(container.parents('.jeg_block_container'), 'zoom');
      
      container.css({
        'height': size[0],
        'width': size[1],
        'left': size[2] + "px",
        'top': size[3] + "px",
        'max-width': 'inherit'
      });
    }
    
    function calculate_container(container, mode) {
      var nh, nw, nt, nl;
      
      var w = 16;
      var h = 9;
      
      var r = ( h / w );
      var wh = $(container).height();
      var ww = $(container).width();
      var wr = wh / ww;
      
      var resizeWidth = function () {
        nw = ww;
        nh = ww * r;
        nl = ( ww - nw ) / 2;
        nt = ( wh - nh ) / 2;
        
        return [nh, nw, nl, nt];
      };
      
      var resizeHeight = function () {
        nw = wh / r;
        nh = wh;
        nl = ( ww - nw ) / 2;
        nt = ( wh - nh ) / 2;
        return [nh, nw, nl, nt];
      };
      
      var resizenoupscale = function () {
        nw = w;
        nh = h;
        nl = ( ww - nw ) / 2;
        nt = ( wh - nh ) / 2;
        return [nh, nw, nl, nt];
      };
      
      if (mode === 'fit') {
        if (wr > r) {
          return resizeWidth();
        }
        return resizeHeight();
      }
      
      if (mode === 'zoom') {
        if (wr > r) {
          return resizeHeight();
        }
        return resizeWidth();
      }
      
      if (mode === 'fitNoUpscale') {
        if (h > wh || w > ww) {
          return $.new_get_image_container_size(img, container, "fit");
        }
        
        return resizenoupscale();
      }
    }
    
    $(this).each(function () {
      var element = $(this);
      var wrapper = element.parent('.jeg_videowrapper');
      var container = element.get(0);
      var youtubeid = element.data('youtubeid');
      
      new YT.Player(container, {
        width: "100%",
        height: "100%",
        videoId: youtubeid,
        playerVars: {
          playlist: youtubeid,
          iv_load_policy: 3,
          enablejsapi: 1,
          disablekb: 1,
          autoplay: 1,
          controls: 0,
          showinfo: 0,
          rel: 0,
          loop: 1,
          wmode: "transparent"
        },
        events: {
          onReady: function (event) {
            event.target.mute().setLoop(!0)
          }
        }
      }), jeg_resizevideobg(wrapper), jQuery(window).bind("resize", function () {
        jeg_resizevideobg(wrapper)
      });
    });
  };
  
  
  $.fn.jnews_slider = function () {
    $(this).each(function () {
      var element = $(this);
      
      // slider 1
      $(element).find('.jeg_slider_type_1').jowlslider({
        rtl: jnewsoption.rtl == 1,
      });
      
      // slider 2
      $(element).find('.jeg_slider_type_2').each(function () {
        var element = this;
        var autoplay = $(element).data('autoplay');
        var delay = $(element).data('delay');
        
        $(element).owlCarousel({
          rtl: jnewsoption.rtl == 1,
          nav: false,
          items: 1,
          autoplay: autoplay,
          autoplayTimeout: delay,
          loop: true,
        });
      });
      
      // slider 3
      $(element).find('.jeg_slider_type_3').each(function () {
        var element = this;
        var autoplay = $(element).data('autoplay');
        var delay = $(element).data('delay');
        var items = $(element).data('items');
        var wrapper = $(element).parent('.jeg_slider_wrapper');
        
        var items_desktop = items;
        var items_tablet = ( items < 3 ) ? items : 3;
        var items_phone = ( items < 2 ) ? items : 2;
        
        // Main Content
        if (wrapper.hasClass('jeg_col_2o3')) {
          if (items_desktop > 3 && $(window).width() == 1024)
            items_desktop = 3;
          
          // Sidebar
        } else if (wrapper.hasClass('jeg_col_1o3')) {
          items_tablet = 1;
          
          if ($(window).width() >= 1024)
            items_desktop = 1;
        }
        
        $(this).owlCarousel({
          rtl: jnewsoption.rtl == 1,
          nav: true,
          navText: false,
          dots: false,
          loop: true,
          stagePadding: 35,
          margin: 5,
          autoplay: autoplay,
          autoplayTimeout: delay,
          responsive: {
            0: {items: 1},
            568: {items: items_phone},
            768: {items: items_tablet},
            1024: {items: items_desktop}
          }
        });
      });
      
      // slider 4
      $(element).find('.jeg_slider_type_4').each(function () {
        var element = this;
        var autoplay = $(element).data('autoplay');
        var delay = $(element).data('delay');
        
        $(element).owlCarousel({
          rtl: jnewsoption.rtl == 1,
          nav: true,
          navText: false,
          items: 1,
          loop: true,
          autoplay: autoplay,
          autoplayTimeout: delay,
          animateOut: 'fadeOut'
        });
      });
    });
  };
  
  $.fn.ajax_review_search = function () {
    return $(this).each(function () {
      
      var element = this;
      var action = $(element).find('input[name="action"]');
      var page_input = $(element).find('input[name="page"]');
      var category_select = $(element).find('select[name="category"]');
      var keyword_input = $(element).find('.search_keyword');
      var sort_select = $(element).find('select[name="sort"]');
      var search_holder = $(element).find('.jeg_review_search_result_holder');
      var overlay = $(element).find('.module-overlay');
      var form = $(element).find('.review-search-form');
      var unique_id = $(element).data('id');
      var attr = window[unique_id];
      var timeout = null;
      var xhr = null;
      
      var reset_paging = function () {
        $(page_input).val(1);
      };
      
      var do_search_limit = function () {
        $(overlay).stop().fadeIn();
        attr.action = $(action).val();
        attr.keyword = $(keyword_input).val();
        attr.category = $(category_select).val();
        attr.sort = $(sort_select).val();
        attr.page = $(page_input).val();
        
        if (xhr !== null) xhr.abort();
        xhr = $.ajax({
          url: jnews_ajax_url,
          type: 'post',
          dataType: "html",
          data: attr,
          success: function (data) {
            $(search_holder).html(data);
            $(overlay).stop().fadeOut();
          }
        });
      };
      
      var do_search = function () {
        if (timeout) clearTimeout(timeout);
        timeout = setTimeout(function () {
          do_search_limit();
        }, 250);
      };
      
      var do_reset_search = function () {
        reset_paging();
        do_search();
      };
      
      $(keyword_input).on('input', function () {
        if ($(keyword_input).val().length > 2 || $(keyword_input).val().length == 0) {
          do_reset_search();
        }
      });
      
      $(category_select).on('change', function () {
        do_reset_search();
      });
      
      $(sort_select).on('change', function () {
        do_reset_search();
      });
      
      $(element).on('click', '.jeg_navigation a', function (e) {
        e.preventDefault();
        $(page_input).val($(this).data('id'));
        do_search();
      });
      
      $(form).on('submit', function (e) {
        e.preventDefault();
        do_reset_search();
      });
    });
  };
  
  $.facebook_page_widget = function () {
    if ($('.fb-page').length) {
      if ($('#facebook-jssdk').length) {
        FB.XFBML.parse();
      } else {
        var appid = '&appId=' + $('.fb-page').attr('data-id');
        
        (function (d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s);
          js.id = id;
          js.src = "//connect.facebook.net/" + jnewsoption.lang + "/sdk.js#xfbml=1&version=v2.8" + appid;
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      }
    }
  };
  
  $.twitter_widget = function () {
    if ($('.twitter-timeline').length) {
      (function () {
        var dsq = document.createElement('script');
        dsq.type = 'text/javascript';
        dsq.async = true;
        dsq.src = '//platform.twitter.com/widgets.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
      })();
    }
  };
  
  $.google_plus_widget = function () {
    if ($('.jeg_google_plus_widget').length) {
      (function () {
        var dsq = document.createElement('script');
        dsq.type = 'text/javascript';
        dsq.async = true;
        dsq.src = '//apis.google.com/js/platform.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
      })();
    }
    
    $('.jeg_google_plus_widget').each(function () {
      var wrapper_width = $(this).width();
      var widget_width = $(this).find('div').attr('data-width');
      var fit = $(this).find('div').attr('data-fit');
      
      if (fit === 'true' || (wrapper_width < widget_width)) {
        $(this).find('div').attr('data-width', wrapper_width);
      }
    });
  };
  
  $.pinterest_widget = function () {
    if ($('.jeg_pinterest_widget').length) {
      (function () {
        var dsq = document.createElement('script');
        dsq.type = 'text/javascript';
        dsq.async = true;
        dsq.src = '//assets.pinterest.com/js/pinit.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
      })();
    }
  };
  
  function pl_multilanguage() {
    $.ajaxSetup({
      data: {
        // pll_load_front: true,
        lang: jnewsoption.lang
      }
    });
  }

  function cookie_handler()
  {
      var element = $('.jnews-cookie-law-policy'),
          date_now = $.now();

      if ( element.length > 0 )
      {
          var getCookie = function(name) {
              var nameCK = name + "=";
              var ca = document.cookie.split(';');
              for(var i=0;i < ca.length;i++) {
                  var c = ca[i];
                  while (c.charAt(0)==' ') c = c.substring(1,c.length);
                  if (c.indexOf(nameCK) == 0) return c.substring(nameCK.length,c.length);
              }
              return null;
          };

          var setCookie = function(name,days) {
              var date = date_now + (days*24*60*60*1000);
              document.cookie = name + "=" + (date || "") + ";";
          };

          var eraseCookie = function(name) {
              document.cookie = name+'=; Max-Age=-99999999;';
          }

          var cookie_law = getCookie('jnews_cookie_law');

          if (! cookie_law) {
              element.fadeIn('slow');
          } else if (parseInt(cookie_law) < date_now) {
              element.fadeIn('slow');
          }

          element.find('.btn-cookie').on('click', function(e){
              e.preventDefault();
              var $this = $(this);
              setCookie('jnews_cookie_law', $this.data('expire'));
              $this.parent().fadeOut();
          });
      }
  }
  
  function dispatch() {
    /** Sidecontent **/
    sidecontent();
    
    // Widget Tab
    $('.jeg_tabpost_widget').jtabs();
    
    // JNews Slider
    $('body').jnews_slider();
    
    // Single Post Featured Gallery
    $('.featured_gallery').owlCarousel({
      rtl: jnewsoption.rtl == 1,
      nav: true,
      navText: false,
      items: 1,
      autoplay: false,
      autoplayTimeout: 3000,
      lazyLoad: true
    });
    
    // Post Block Carousel
    $('body').jnews_carousel();
    
    // Slider: Overlay
    $(".jeg_overlay_slider").joverlayslider({
      rtl: jnewsoption.rtl == 1
    });
    
    // Newsticker
    $(".jeg_news_ticker").jnewsticker();
    
    // Video Playlist
    $(".jeg_video_playlist").jvidplaylist({
      rtl: jnewsoption.rtl == 1
    });
    
    do_fullscreen_post();
    
    if ($(window).width() > 768) {
      $('.jeg_sticky_sidebar').theiaStickySidebar({additionalMarginTop: 20});
      $('.share-float').theiaStickySidebar({
        additionalMarginTop: 20,
        updateSidebarHeight: false
      });
      
      // parallax
      $('.jeg_parallax_bg').parallax("50%", 0.1);
    }
    
    // review bar animation
    $('.jeg_reviewbars').jskill();
    
    // Scroll to top
    scroll_to_top();
    
    // jQuery Select
    $("select:visible").not(".woocommerce select").chosen({disable_search_threshold: 10});
    
    /** media render **/
    do_media_render($('body'));
    
    /** add pin it on image hover **/
    pin_it_image();
    
    /* Blocklink */
    window.onYouTubeIframeAPIReady = function () {
      $('.jeg_blocklink .jeg_videobg').each(function () {
        $(this).jvideo_background();
      });
    };
    
    // gif image
    if (jnewsoption.gif) {
      var gif = $('.content-inner img[src$=".gif"]').jnewsgif();
    }
    
    // gallery
    split_content($('body'));
    
    // Facebook Page Widget
    $.facebook_page_widget();
    
    // Twitter Widget
    $.twitter_widget();
    
    // Google+ Widget
    $.google_plus_widget();
    
    // Pinterest Widget
    $.pinterest_widget();
    
    $(document).ajaxComplete(function () {
      // Customizer - Google+ Widget
      $.google_plus_widget();
      
      // Customizer - Twitter Widget
      $.twitter_widget();
      
      // Customizer - Facebook Page Widget
      $.facebook_page_widget();
    });
    
    // multilanguage
    pl_multilanguage();

    // cookie law policy
    cookie_handler();
    
    // Review Ajax Search
    $('.jeg_review_search').ajax_review_search();
  }
  
  $(document).ready(dispatch);
  
  $(window).load(function () {
    window.dispatchEvent(new Event('resize'));
  });
  
  function dispatch_ajax(event, element) {
    /** add pin it on image hover **/
    pin_it_image();
    
    /** full screen post **/
    do_fullscreen_post();
    
    /** media render **/
    do_media_render(element);
    
    /** Sticky sidebar & Float share **/
    if ($(window).width() > 768) {
      $(element).find('.jeg_sticky_sidebar').theiaStickySidebar({additionalMarginTop: 20});
      $(element).find('.share-float').theiaStickySidebar({
        additionalMarginTop: 20,
        updateSidebarHeight: false
      });
      
      // parallax
      $(element).find('.jeg_parallax_bg').parallax("50%", 0.1);
    }
    
    /** jQuery Select **/
    $(element).find("select:visible").chosen({disable_search_threshold: 10});
    
    /** Slider: Overlay **/
    $(element).find(".jeg_overlay_slider").joverlayslider({
      rtl: jnewsoption.rtl == 1
    });
    
    /** Post Block Carousel **/
    $(element).jnews_carousel();
    
    /** Single Post Featured Gallery **/
    $(element).find('.featured_gallery').owlCarousel({
      rtl: jnewsoption.rtl == 1,
      nav: true,
      navText: false,
      items: 1,
      autoplay: false,
      autoplayTimeout: 3000,
      lazyLoad: true
    });
    
    /** Gallery **/
    split_content(element);
    
    /** Gif Image **/
    $(element).find('.content-inner img[src$=".gif"]').jnewsgif();
    
    /** Video Playlist */
    $(element).find(".jeg_video_playlist").jvidplaylist({
      rtl: jnewsoption.rtl == 1
    });
    
    /** Review **/
    $(element).find('.jeg_reviewbars').jskill();
    
    /** JNews Slider */
    $(element).jnews_slider();
    
    /** Tabbed widget **/
    $(element).find('.jeg_tabpost_widget').jtabs();
    
    /** Module hook **/
    $(element).find(".jeg_module_hook").jmodule();
    
    /** Init share **/
    jnews.share.init(element);
    
    /** Widget popular share click **/
    jnews.widget.popular.init(element);
    
    /** Popup Image **/
    jnews.popup.init(element);
    
    /** Hero Init **/
    jnews.hero.init(element);
    
    /** Post Popup **/
    jnews.popuppost.init(element);
    
    /** Comment Init Popup **/
    jnews.comment.init(element);
    
    /** mobile truncate **/
    jnews.mobile.truncate();
    
    /** Split **/
    if (jQuery().jsplit) {
      $(element).jsplit();
    }
    
    // Facebook Page Widget
    $.facebook_page_widget();
    
    // Twitter Widget
    $.twitter_widget();
    
    // Google+ Widget
    $.google_plus_widget();
    
    // Pinterest Widget
    $.pinterest_widget();
  }
  
  $(document).bind('jnews-ajax-load', dispatch_ajax);
  
  function split_content(wrapper) {
    $(wrapper).find(".jeg_preview_slider").each(function () {
      var element = $(this);
      var variable = window[element.data('selector')];
      $(element).jpreviewslider(variable);
    });
  }
  
  $(document).bind('jnews_after_split_content_ajax', function (e, data) {
    split_content(data);
  });
  
})(jQuery);


(function ($) {
  "use strict";
  
  window.jnews = window.jnews || {};
  
  /****************
   * Jnews Menu
   ****************/
  window.jnews.menu = {
    
    newsfeed_xhr: null,
    search_length_word: 3,
    search_timeout: null,
    search_xhr: null,
    
    init: function ($container) {
      var menu = this;
      
      if ($container === undefined) {
        $container = $('body');
      }
      
      // setup drop down
      $container.find('.jeg_menu').superfish({
        popUpSelector: 'ul,.sub-menu',
        delay: 250,
        speed: 'fast',
        animation: {opacity: 'show'},
        onShow: function () {
          if ($(this).find('.jeg_newsfeed').length) {
            menu.mega_menu_init(this, menu);
          }
        }
      });
      
      menu.search($container);
      
      // Meganav
      menu.meganav($container);
    },
    
    meganav: function ($container) {
      var meganav = $container.find('.jeg_meganav_bar');
      var current_title = meganav.find('.current_title');
      
      current_title.bind('click', function () {
        meganav.toggleClass('nav-open');
      });
      
      /** Close menu when user click outside **/
      $(document).mouseup(function (e) {
        if (meganav.hasClass('nav-open') && (!$(e.target).parents('.jeg_meganav_bar').length > 0)) {
          meganav.removeClass('nav-open');
        }
      });
    },
    
    search: function ($container) {
      var base = this;
      base.search_toggle($container);
      base.live_search($container);
    },
    
    search_toggle: function ($container) {
      $container.find('.jeg_search_toggle').click(function (e) {
        e.preventDefault();
        
        var search_parent = $(this).parent('.jeg_search_wrapper');
        var wrapper = $(this).parents('.jeg_container, .jeg_container_full');
        var extraclass = search_parent.hasClass('jeg_search_fullwidth_expand') ? 'hide_navbar_items' : '';
        
        wrapper.toggleClass('jeg_search_expanded ' + extraclass);
        $('i.fa', $(this)).toggleClass('fa-close fa-search');
        $('.jeg_search_input', search_parent).focus();
      });
    },
    
    live_search: function ($container) {
      var base = this;
      if (!jnewsoption.live_search) return;
      
      $container.find(".jeg_search_input").each(function () {
        var cacheword = null;
        var element = $(this);
        var parent = $(this).parents('.jeg_search_wrapper');
        
        $(this).bind('keyup', function () {
          if (!$(parent).hasClass('jeg_search_modal_expand')) {
            var searchword = $(this).val();
            
            if (searchword.trim().length >= base.search_length_word && searchword !== cacheword) {
              cacheword = searchword;
              base.do_live_search(searchword, element);
            } else if (searchword.trim().length < base.search_length_word) {
              base.hide_live_search();
            }
          }
        });
      });
      
      $container.find('.search-all-button').bind('click', function (e) {
        e.preventDefault();
        var parent = $(this).parents('.jeg_search_wrapper');
        $(parent).find('form').submit();
      });
    },
    
    do_live_search: function (word, element) {
      var base = this;
      
      clearTimeout(base.search_timeout);
      
      base.search_timeout = setTimeout(function () {
        if (base.search_xhr !== null) {
          base.search_xhr.abort();
        }
        
        base.loading_search(element);
        
        base.search_xhr = $.ajax({
          url: jnews_ajax_url,
          type: "post",
          dataType: "html",
          data: {
            's': word,
            'action': 'jnews_ajax_live_search'
          },
          success: $.proxy(base.load_search, base, element)
        });
      }, 200);
    },
    
    loading_search: function (element) {
      var parent = $(element).parents('.jeg_search_wrapper');
      $(parent).find('.jeg_search_button .fa').removeClass('fa-search').addClass('fa-spinner fa-spin');
    },
    
    remove_loading_search: function (element) {
      var parent = $(element).parents('.jeg_search_wrapper');
      $(parent).find('.jeg_search_button .fa').removeClass('fa-spinner fa-spin').addClass('fa-search');
    },
    
    load_search: function (element, data) {
      var base = this;
      var parent = $(element).parents('.jeg_search_wrapper');
      
      if (data === '') {
        $(parent).find('.search-result-wrapper').html('');
        base.search_no_data(parent);
      } else {
        $(parent).find('.search-result-wrapper').html('').append(data);
        base.search_data_exist(parent);
      }
      
      base.remove_loading_search(element);
    },
    
    search_no_data: function (element) {
      $(element).find('.jeg_search_result').removeClass('jeg_search_hide');
      $(element).find('.jeg_search_result').removeClass('with_result').addClass('no_result');
    },
    
    search_data_exist: function (element) {
      $(element).find('.jeg_search_result').removeClass('jeg_search_hide');
      $(element).find('.jeg_search_result').addClass('with_result').removeClass('no_result');
    },
    
    hide_live_search: function () {
      $(".jeg_search_result").addClass('jeg_search_hide');
    },
    
    sticky_menu: function ($container) {
      if ($container === undefined) {
        $container = $('body');
      }
      
      var navbar = $container.find('.jeg_stickybar');
      var has_searchform = false;
      navbar.jsticky({
        item_offset: '.jeg_header',
        mode: navbar.data('mode'),
        state_class: 'jeg_sticky_nav',
        wrapper: '.jeg_stickybar',
        broadcast_position: true,
      });
    },
    
    mega_menu_init: function (element, menu) {
      menu.create_menu_carousel(element);
      menu.attach_mouseenter_subcategory(element, menu);
    },
    
    create_menu_carousel: function (ele) {
      var $container = $('.newsfeed_carousel', ele);
      
      $container.on('initialized.owl.carousel', function (e) {
        $('.jeg_newsfeed_list', ele).addClass('loaded');
      });
      
      var items = 4;
      
      /* Has Sub category */
      if ($container.hasClass('with_subcat')) {
        
        /* Sidecontent */
        if (ele.parents('.jeg_header.full').length) {
          items = 5;
          
          /* Other header */
        } else {
          items = 3;
        }
        
        /* Full width */
      } else {
        
        /* Sidecontent */
        if (ele.parents('.jeg_header.full').length) {
          items = 6;
          
          /* Other header*/
        } else {
          items = 4;
        }
      }
      
      $container.owlCarousel({
        rtl: jnewsoption.rtl == 1,
        nav: true,
        navText: true,
        dots: false,
        loop: false,
        margin: 20,
        lazyLoad: true,
        items: items
      });
    },
    
    attach_mouseenter_subcategory: function (ele, menu) {
      $(ele).find(".jeg_newsfeed_subcat li").bind('mouseenter', function () {
        menu.menu_load_newsfeed(this, menu);
      });
    },
    
    menu_loaded: function (newsfeed_list) {
      newsfeed_list.addClass('loaded');
      newsfeed_list.height('auto');
    },
    
    menu_load_newsfeed: function (ele, menu) {
      var is_active = $(ele).hasClass('active');
      
      if (!is_active) {
        var container = $(ele).parents('.jeg_newsfeed');
        var newsfeed_list = $(container).find('.jeg_newsfeed_list');
        var newsfeed_list_height = $(newsfeed_list).height();
        newsfeed_list.height(newsfeed_list_height);
        
        var cat_id = $(ele).data('cat-id');
        var newsfeed = newsfeed_list.find(".jeg_newsfeed_container[data-cat-id='" + cat_id + "']");
        
        if (newsfeed.length) {
          newsfeed_list.removeClass('loaded');
          
          // Display newsfeed
          newsfeed_list.find('.jeg_newsfeed_container').removeClass('active').hide();
          newsfeed_list.find(".jeg_newsfeed_container[data-cat-id='" + cat_id + "']").fadeIn(function () {
            menu.menu_loaded(newsfeed_list);
          });
          
        } else {
          
          // Ajax Load
          if (menu.newsfeed_xhr !== null) {
            menu.newsfeed_xhr.abort();
          }
          
          var mega_menu = $(ele).parents('.jeg_megamenu');
          var number = $(mega_menu).data('number');
          
          var action = 'jnews_mega_category_1';
          
          if ($(mega_menu).hasClass('category_2')) {
            action = 'jnews_mega_category_2';
          }
          
          newsfeed_list.removeClass('loaded');
          menu.newsfeed_xhr = $.ajax({
            url: jnews_ajax_url,
            type: "post",
            dataType: "html",
            data: {
              'cat_id': cat_id,
              'action': action,
              'number': number
            },
            success: function (data) {
              newsfeed_list.find('.jeg_newsfeed_container').hide();
              newsfeed_list.append(data);
              
              newsfeed = newsfeed_list.find(".jeg_newsfeed_container[data-cat-id='" + cat_id + "']");
              menu.create_menu_carousel(newsfeed);
              menu.menu_loaded(newsfeed_list);
            }
          });
        }
        
        // Update active state
        $(ele).addClass('active').siblings().removeClass('active');
      }
    }
    
  };
  
  // naivigation
  jnews.menu.init();
  
  // sticky navbar
  jnews.menu.sticky_menu();
  
  /****************
   * jnews login & register popup
   ****************/
  
  window.jnews.loginregister =
  {
    xhr: null,
    show_popup: function (popuplink) {
      if (popuplink.length > 0) {
        popuplink.magnificPopup({
          type: 'inline',
          removalDelay: 500, //delay removal by X to allow out-animation
          midClick: true,
          // mainClass: 'mfp-zoom-out', // this class is for CSS animation below
          callbacks: {
            beforeOpen: function () {
              this.st.mainClass = 'mfp-zoom-out';
              $('body').removeClass('jeg_show_menu');
            }
          }
        });
      }
    },
    init: function () {
      var popuplink = $(".jeg_popuplink");
      this.show_popup(popuplink);
      
      var popupparent = $(".jeg_popuplink_parent a");
      this.show_popup(popupparent);
    },
    hook_form: function () {
      var obj = this;
      
      $(".jeg_popupform > form").each(function () {
        var form = this;
        var msg = $(form).find('.form-message');
        
        $(form).submit(function (e) {
          e.preventDefault();
          
          msg.html('');
          $(form).find('.button').val($(form).find('.button').data('process'));
          
          if (obj.xhr !== null) obj.xhr.abort();
          obj.xhr = $.ajax({
            url: jnews_ajax_url,
            type: 'post',
            dataType: "json",
            data: $(form).serialize(),
            success: function (data) {
              if (data.response == 1) {
                msg.html("<p class='alert alert-success'>" + data.string + "</p>");
                if (data.refresh == 1) {
                  location.reload();
                }
              }
              
              if (data.response == 0) {
                msg.html("<p class='alert alert-error'>" + data.string + "</p>");
              }
              
              $(form).find('.button').val($(form).find('.button').data('string'));
              $(form).trigger('reset');
            }
          });
        });
      });
    },
  };
  
  
  /****************
   * jnews cart
   ****************/
  window.jnews.cart =
  {
    init: function ($container) {
      
      if ($container === undefined) {
        $container = $('body');
      }
      
      var jeg_cart = $container.find(".jeg_cart");
      
      jeg_cart.each(function () {
        $(this).hover(function () {
          $(this).addClass('open');
        }, function () {
          $(this).removeClass('open');
        });
      });
    }
  };
  
  jnews.cart.init();
  
  /****************
   * jnews mobile
   ****************/
  window.jnews.mobile =
  {
    init: function () {
      this.navmobile = $('.jeg_navbar_mobile');
      this.mobilemenu = $('.jeg_mobile_menu');
      
      this.menu();
      this.search();
      this.truncate();
    },
    truncate: function () {
      $('.content-inner.mobile-truncate').bind('click', function () {
        $(this).removeClass('mobile-truncate');
      });
    },
    show_menu: function (e) {
      e.preventDefault();
      $('body').toggleClass('jeg_show_menu');
    },
    hide_menu: function (e) {
      e.preventDefault();
      $('body').removeClass('jeg_show_menu');
    },
    menu: function () {
      var element = this;
      
      element.mobilemenu.superfish();
      
      $('.jeg_mobile_toggle').unbind('click', element.show_menu).bind('click', element.show_menu);
      $('.jeg_menu_close').unbind('click', element.hide_menu).bind('click', element.hide_menu);
      
      /** Close menu & sidefeed when user click outside **/
      $(document).mouseup(function (e) {
        // Mobile Menu Close
        if ($('body').hasClass('jeg_show_menu') && (!$(e.target).parents('.jeg_mobile_wrapper').length > 0)) {
          $('body').removeClass('jeg_show_menu');
        }
      });
      
      // Sticky mobile menu
      element.navmobile.jsticky({
        mode: element.navmobile.data('mode'),
        item_offset: '.jeg_navbar_mobile',
        state_class: 'jeg_sticky_nav',
        wrapper: '.jeg_navbar_mobile_wrapper',
        use_translate3d: true,
        broadcast_position: false
      });
      
    },
    search: function () {
      // Mobile Search
      $('.jeg_mobile_search').click(function (e) {
        e.preventDefault();
        
        $('body').toggleClass('jeg_search_expanded');
        $('i.fa', $(this)).toggleClass('fa-close fa-search');
        $('.jeg_navbar_mobile_wrapper .jeg_search_input').val('').focus();
      });
    }
  };
  
  jnews.mobile.init();
  
  /**
   * Execute this when first load
   */
  
  window.jnews.first_load = {
    data: null,
    init: function () {
      if (jfla.length) {
        this.do_ajax({
          'action': 'jnews_first_load_action',
          'jnews_id': jnewsoption.postid,
          'load_action': jfla
        });
      }
    },
    build_mobile_account: function () {
      var base = this;
      
      $(".jeg_mobile_profile_wrapper").html(base.data.mobile_login);
      
      jnews.loginregister.init();
      jnews.loginregister.hook_form();
    },
    build_top_account: function () {
      var base = this;
      
      $(".jeg_header .jeg_accountlink").html(base.data.desktop_login);
      
      jnews.loginregister.init();
      jnews.loginregister.hook_form();
    },
    build_login_register_form: function () {
      var base = this;
      
      $("#jeg_loginform").find(".jeg_popupform form").prepend(base.data.social_login_form);
      $("#jeg_registerform").find(".jeg_popupform form").prepend(base.data.social_register_form);
      $("input[name='jnews_nonce']").val(base.data.account_nonce);
    },
    update_counter: function () {
      var base = this;
      var selector = {
        total_view: $(".jeg_share_stats .jeg_views_count .counts"),
        total_share: $(".jeg_share_stats .jeg_share_count .counts"),
        total_comment: $(".jeg_meta_comment a span")
      };
      
      $.each(base.data.counter, function (index, value) {
        if (selector[index].length) {
          selector[index].text(value);
        }
      });
    },
    
    do_ajax: function (parameter) {
      var base = this;
      
      $.ajax({
        url: jnews_ajax_url,
        type: "post",
        dataType: "json",
        data: parameter,
        success: function (data) {
          base.data = data;
          
          if (data.desktop_login) {
            base.build_top_account();
          }
          
          if (data.mobile_login) {
            base.build_mobile_account();
          }
          
          if (data.login_form || data.social_login_form || data.social_register_form) {
            base.build_login_register_form();
          }
          if (data.counter) {
            base.update_counter();
          }
        }
      });
    }
  };
  
  jnews.first_load.init();
  
  /**
   * Share Button Clicked
   */
  window.jnews.share =
  {
    init: function ($container) {
      if ($container === undefined) {
        $container = $('body');
      }
      
      $container.find('.jeg_sharelist a, .jeg_post_share a').unbind('click.share').bind('click.share', function (e) {
        var element = $(this);
        
        if (!element.hasClass('jeg_btn-email') && !element.hasClass('jeg_btn-whatsapp') && !element.hasClass('jeg_btn-wechat') && !element.hasClass('jeg_btn-line')) {
          e.preventDefault();
          var url = element.attr('href');
          
          if (element.hasClass('jeg_btn-toggle')) {
            var container = $(this).parents('.jeg_share_button');
            container.toggleClass('show-secondary');
          } else if (element.hasClass('jeg_btn-stumbleupon')) {
            window.open(url, '', "height=730,width=560");
          } else if (element.hasClass('jeg_btn-qrcode')) {
            $.magnificPopup.open({
              items: [
                {
                  src: url
                },
              ],
              type: 'image'
            });
          } else {
            window.open(url, '', "height=570,width=750");
          }
        }
      });
      
    }
  };
  
  jnews.share.init();
  
  /**
   * JNews Widget Script
   */
  window.jnews.widget = {};
  
  window.jnews.widget.popular =
  {
    init: function ($container) {
      if ($container === undefined) {
        $container = $('body');
      }
      
      $container.find(".widget_jnews_popular .socialshare_list a").bind("click", function (e) {
        var element = $(this);
        e.preventDefault();
        var url = element.attr('href');
        window.open(url, '', "height=570,width=750");
      });
    }
  };
  
  jnews.widget.popular.init();
  
  /**
   * JNews Popup
   */
  
  window.jnews.popup =
  {
    popupcontainer: null,
    container: null,
    init: function ($container) {
      var base = this;
      if ($container === undefined) {
        base.container = $('body');
      } else {
        base.container = $container;
      }
      
      this.popupcontainer = $('.pswp').get(0);
      
      if (jnewsoption.popup_script === "photoswipe") {
        this.popup_photoswipe();
      } else if (jnewsoption.popup_script === "magnific") {
        this.popup_magnific();
      }
    },
    
    
    /**
     * Photoswipe Popup
     */
    expand_photoswipe: function (item, index) {
      var base = this;
      var options = {
        index: index,
        history: false,
        focus: false,
        showAnimationDuration: 0,
        hideAnimationDuration: 0,
        barsSize: {top: 44, bottom: 0}
      };
      
      var photoswipe = new PhotoSwipe(base.popupcontainer, PhotoSwipeUI_Default, item, options);
      photoswipe.init();
    },
    expand_single_featured: function (element) {
      var base = this;
      var image = $(element).find('img');
      
      var item = [{
        src: $(element).attr('href'),
        w: parseInt($(image).data('full-width'), 10),
        h: parseInt($(image).data('full-height'), 10),
        title: $(image).attr('alt')
      }];
      
      base.expand_photoswipe(item, 0);
    },
    expand_featured_gallery: function (element) {
      var base = this;
      var parent = $(element).parents('.featured_gallery');
      var figure = $(element).parents('.owl-item');
      var index = $(figure).index('.owl-item');
      var items = [];
      var owl = $(parent).owlCarousel({
        rtl: jnewsoption.rtl == 1
      });
      
      // populate item
      $(parent).find('a').each(function (i) {
        var ele = this;
        var image = $(ele).find('img');
        
        if ($(ele).find('.thumbnail-container').hasClass('thumbnail-background')) {
          items[i] = {
            src: $(ele).attr('href'),
            w: parseInt($(ele).find('.thumbnail-container > div').data('full-width'), 10),
            h: parseInt($(ele).find('.thumbnail-container > div').data('full-height'), 10),
            title: $(ele).find('.thumbnail-container > div').attr('alt')
          };
        } else {
          items[i] = {
            src: $(ele).attr('href'),
            w: parseInt($(image).data('full-width'), 10),
            h: parseInt($(image).data('full-height'), 10),
            title: $(image).attr('alt')
          };
        }
      });
      
      var options = {
        index: index,
        history: false,
        focus: false,
        showAnimationDuration: 0,
        hideAnimationDuration: 0
      };
      
      var gallery = new PhotoSwipe(base.popupcontainer, PhotoSwipeUI_Default, items, options);
      
      gallery.listen('afterChange', function () {
        var index = gallery.getCurrentIndex();
        owl.trigger('to.owl.carousel', [index, 300]);
      });
      
      gallery.init();
    },
    expand_wp_gallery: function (element) {
      var base = this;
      var parent = $(element).parents('.gallery');
      var figure = $(element).parents('figure');
      var index = $(figure).index('figure');
      var items = [];
      
      // populate item
      $(parent).find('a').each(function (i) {
        var ele = this;
        var image = $(ele).find('img');
        var caption = $(ele).parents('.gallery-item').find('.wp-caption-text').text();
        
        items[i] = {
          src: $(ele).attr('href'),
          w: parseInt($(image).data('full-width'), 10),
          h: parseInt($(image).data('full-height'), 10),
          title: caption
        };
      });
      
      base.expand_photoswipe(items, index);
    },
    expand_single_image_caption: function (element) {
      var base = this;
      var figure = $(element).parent();
      var bigimage = $(figure).find('a').attr('href');
      var caption = $(figure).find('.wp-caption-text').text();
      $(element).addClass('load-image');
      
      var newImg = new Image;
      newImg.onload = function () {
        $(element).removeClass('load-image');
        var item = [{
          src: bigimage,
          w: parseInt(newImg.width, 10),
          h: parseInt(newImg.height, 10),
          title: caption
        }];
        base.expand_photoswipe(item, 0);
      };
      newImg.src = bigimage;
    },
    expand_single_image: function (element) {
      var base = this;
      var image = $(element).find('img');
      $(element).addClass('load-image');
      
      var newImg = new Image;
      newImg.onload = function () {
        $(element).removeClass('load-image');
        var item = [{
          src: $(element).attr('href'),
          w: parseInt(newImg.width, 10),
          h: parseInt(newImg.height, 10),
          title: $(image).attr('alt')
        }];
        base.expand_photoswipe(item, 0);
      };
      newImg.src = $(element).attr('href');
    },
    popup_photoswipe: function () {
      
      var base = this;
      
      // featured image single
      $(base.container).find(".jeg_featured.featured_image a").bind('click', function (e) {
        e.preventDefault();
        base.expand_single_featured(this);
      });
      
      // featured image gallery
      $(base.container).find(".featured_gallery a").bind('click', function (e) {
        e.preventDefault();
        base.expand_featured_gallery(this);
      });
      
      // WordPress Default Gallery
      $(base.container)
      .find(".content-inner .gallery")
      .find("a[href$='.gif'], a[href$='.jpg'], a[href$='.png'], a[href$='.bmp']")
      .bind('click', function (e) {
          e.preventDefault();
          base.expand_wp_gallery(this);
        }
      );
      
      // with caption
      $(base.container).find(".content-inner figure.wp-caption")
      .find("a[href$='.gif'], a[href$='.jpg'], a[href$='.png'], a[href$='.bmp']")
      .find("img")
      .each(function () {
        var element = $(this).parent();
        $(element).bind('click', function (e) {
          e.preventDefault();
          base.expand_single_image_caption(this);
        });
      });
      
      // no caption
      $(base.container).find(".content-inner")
      .find("a[href$='.gif'], a[href$='.jpg'], a[href$='.png'], a[href$='.bmp']")
      .find("img[class*='align']")
      .each(function () {
        var element = $(this).parent();
        $(element).bind('click', function (e) {
          e.preventDefault();
          base.expand_single_image(this);
        });
      });
    },
    
    /**
     * Magnific Popup
     */
    expand_magnific: function (element) {
      $(element).magnificPopup({
        gallery: {
          enabled: true
        },
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom',
        image: {
          verticalFit: true,
          titleSrc: function (item) {
            var parent = item.el.parent().prop("tagName");
            if (parent === 'FIGURE') {
              return item.el.parent().find('figcaption').text();
            } else {
              if (item.el.parents('.gallery-item').find('.wp-caption-text').length) {
                return item.el.parents('.gallery-item').find('.wp-caption-text').text();
              } else {
                return item.el.find('img').attr('alt');
              }
            }
          }
        }
      });
    },
    expand_magnific_gallery: function (element) {
      var base = this;
      base.expand_magnific(element);
    },
    popup_magnitif_single_gallery: function (selector_string) {
      var base = this;
      
      // single
      var element = [];
      $(base.container).find(selector_string).each(function () {
        var tag = $(this).prop("tagName");
        var ele = this;
        if (tag === "IMG") {
          element.push($(ele).parent().get(0));
        } else {
          element.push($(ele).get(0));
        }
      });
      base.expand_magnific(element);
      
      // gallery
      base.expand_magnific_gallery('.featured_gallery a');
    },
    popup_magnitif_normal: function (selector_string) {
      var base = this;
      
      // single
      $(base.container).find(selector_string).each(function () {
        var tag = $(this).prop("tagName");
        var ele = this;
        if (tag === "IMG") {
          base.expand_magnific($(ele).parent().get(0));
        } else {
          base.expand_magnific($(ele).get(0));
        }
      });
      
      // gallery
      base.expand_magnific_gallery('.featured_gallery a');
    },
    popup_magnific: function () {
      var base = this;
      var selector_string =
        ".content-inner figure.wp-caption > a > img," +
        ".content-inner a[href$='.gif'] > img[class*='wp-image']," +
        ".content-inner a[href$='.jpg'] > img[class*='wp-image']," +
        ".content-inner a[href$='.png'] > img[class*='wp-image']," +
        ".content-inner a[href$='.bmp'] > img[class*='wp-image']," +
        ".content-inner a[href$='.gif'] > img[class*='align']," +
        ".content-inner a[href$='.jpg'] > img[class*='align']," +
        ".content-inner a[href$='.png'] > img[class*='align']," +
        ".content-inner a[href$='.bmp'] > img[class*='align']," +
        ".jeg_featured.featured_image a," +
        ".content-inner .gallery a";
      
      if (jnewsoption.single_gallery === "1") {
        base.popup_magnitif_single_gallery(selector_string);
      } else {
        base.popup_magnitif_normal(selector_string);
      }
    }
  };
  jnews.popup.init();
  
  /**
   *  HERO
   */
  
  window.jnews.hero =
  {
    init: function ($container) {
      var base = this;
      if ($container === undefined) {
        base.container = $('body');
      } else {
        base.container = $container;
      }
      
      $(window).bind('ready resize load', function () {
        base.dispatch()
      });
    },
    dispatch: function () {
      var base = this;
      
      base.container.find('.jeg_heroblock').each(function () {
        var block = $(this);
        var wrapper = block.find('.jeg_heroblock_wrapper');
        var scroller = block.find('.jeg_heroblock_scroller');
        var items = block.find(".jeg_post");
        var margin = block.data('margin');
        
        if ($(window).width() > 667) {
          wrapper.css({
            'margin-left': -margin + "px",
            'margin-bottom': -margin + "px",
            'margin-right': 0,
            'margin-top': 0
          });
          
          items.css("padding", "0 0 " + margin + "px " + margin + "px ");
          
        } else if (scroller.length > 0) {
          
          if (margin > 5) margin = 5; // reset all margin
          
          scroller.css('margin-left', '-' + margin + 'px');
          
          wrapper.css({
            'margin-left': "0px",
            'margin-bottom': "0px",
            'margin-right': "0px"
          });
          
          items.each(function () {
            if ($(this).parent('.jeg_heroblock_scroller').length > 0) {
              $(this).css("padding-left", margin + "px");
              $(this).css("padding-bottom", "0px");
            } else {
              $(this).css("padding-bottom", margin + "px");
              $(this).css("padding-left", "0px");
            }
          })
        }
      });
    }
  };
  
  jnews.hero.init();
  
  
  /***
   * POPUP POST
   */
  
  window.jnews.popuppost =
  {
    container: null,
    content: null,
    element: null,
    
    init: function ($container) {
      var base = this;
      
      if ($container === undefined) {
        base.container = $('body');
      } else {
        base.container = $container;
      }
      
      base.element = base.container.find('.jeg_popup_post');
      
      if (base.element.length > 0) {
        var parent = $(base.element).parents('.post-wrap');
        base.content = $(parent).find('.entry-content');
        
        base.element.find('.jeg_popup_close').click(function (e) {
          e.preventDefault();
          
          base.element
          .removeClass('active')
          .addClass('closed');
        });
        
        if ($(window).width() > 1024) {
          $(window).bind('scroll resize load', $.proxy(base.dispatch, base));
        } else {
          $(window).unbind('scroll resize load', $.proxy(base.dispatch, base));
        }
      }
    },
    dispatch: function () {
      var base = this;
      
      var is_close = base.element.hasClass('closed');
      var st = $(window).scrollTop();
      var offset = $(window).height() * 0.5;
      var popup_position = Math.abs((base.content.offset().top + base.content.outerHeight()) - offset);
      
      if (st > popup_position && !is_close) {
        base.element.addClass('active');
      } else {
        base.element.removeClass('active');
      }
    }
  };
  
  jnews.popuppost.init();
  
  /**
   *  SIDE FEED
   */
  
  window.jnews.sidefeed =
  {
    init: function () {
      var base = this;
      base.container = $("#jeg_sidecontent");
      
      if (base.container.length) {
        base.variable = window.side_feed;
        base.xhr = null;
        base.xhr_cache = [];
        base.lock_action = false;
        base.current_post_id = jnewsoption.postid;
        base.min_prev_sidefeed = 5;
        
        base.post_xhr = null;
        base.post_xhr_cache = [];
        
        
        base.tab = base.container.find('.jeg_side_tabs > li');
        base.menu = base.container.find('.jeg_filter_menu a');
        base.loadbutton = base.container.find('.sidefeed_loadmore button');
        base.sidefeed = base.container.find('.jeg_sidefeed');
        base.overlay_loader = base.container.find('.jeg_sidefeed_overlay');
        
        base.sectionwrap = $('.post-wrapper');
        base.postoverlay = $(".post-ajax-overlay");
        
        base.bind_autoload();
        base.bind_tab();
        base.bind_menu();
        base.bind_load_button();
        
        if (jnewsoption.sidefeed_ajax) {
          base.bind_ajax();
        }
      }
    },
    load_first_item: function () {
      var base = this;
      var post = base.sidefeed.find('.jeg_post').first();
      
      if (post) {
        $(post).find('a.ajax').trigger('click');
      }
    },
    load_ajax: function (type, parameter, response) {
      var base = this;
      
      if (type === 'append') {
        $(base.sidefeed).append(response.content);
      } else if (type === 'replace') {
        base.sidefeed.html(response.content);
      }
      
      base.after_ajax_request(type, parameter, response);
    },
    cache_get: function (parameter) {
      var base = this;
      var jsonparam = JSON.stringify(parameter);
      
      for (var i = 0; i < base.xhr_cache.length; i++) {
        if (base.xhr_cache[i].param == jsonparam) {
          return base.xhr_cache[i].result;
        }
      }
      
      return false;
    },
    cache_save: function (parameter, response) {
      var base = this;
      var jsonparam = JSON.stringify(parameter);
      
      base.xhr_cache.push({
        param: jsonparam,
        result: response
      });
    },
    before_ajax_request: function (type) {
      var base = this;
      
      if (type === 'append') {
        base.loadbutton.addClass('btn-loading').text($(base.loadbutton).data('loading'));
      } else if (type === 'replace') {
        base.overlay_loader.show();
      }
      
      // lock
      base.lock_action = true;
    },
    after_ajax_request: function (type, parameter, response) {
      var base = this;
      
      // normalize load button
      base.loadbutton.removeClass('btn-end').text($(base.loadbutton).data('loadmore'));
      
      if (response.next) {
        base.loadbutton.text($(base.loadbutton).data('loadmore'));
      } else {
        base.loadbutton.addClass('btn-end').text($(base.loadbutton).data('end'));
      }
      
      // append or replace
      if (type === 'append') {
        base.loadbutton.removeClass('loading');
        
      } else if (type === 'replace') {
        base.overlay_loader.hide();
        base.load_first_item();
        
        // activate state feed
        base.active_state_feed(base.current_post_id);
      }
      
      // lock
      base.lock_action = false;
      base.cache_save(parameter, response);
      
      // reinitialize side feed
      base.reinitialize_view();
    },
    load_content: function (type) {
      // type = replace | append
      var base = this;
      
      base.before_ajax_request(type);
      
      var parameter = {
        'action': 'jnews_newsfeed_load',
        'data': base.variable
      };
      
      var result = base.cache_get(parameter);
      
      if (base.xhr) base.xhr.abort();
      if (result) {
        base.load_ajax(type, parameter, result);
      } else {
        base.xhr = $.ajax({
          url: jnews_ajax_url,
          type: 'post',
          dataType: 'json',
          data: parameter,
          success: $.proxy(base.load_ajax, base, type, parameter)
        });
      }
    },
    bind_autoload: function () {
      var base = this;
      
      $(document).bind('jnews-autoload-change-id', function (event, post_id) {
        base.current_post_id = post_id;
        base.active_state_feed(post_id);
      });
    },
    bind_tab: function () {
      var base = this;
      
      base.tab.bind('click', function (e) {
        e.preventDefault();
        
        if (!base.lock_action) {
          base.tab.removeClass('active');
          $(this).addClass('active');
          
          base.variable.sort_by = $(this).data('sort');
          base.variable.paged = 1;
          base.load_content('replace');
        }
      });
    },
    bind_menu: function () {
      var base = this;
      
      base.menu.bind('click', function (e) {
        e.preventDefault();
        
        if (!base.lock_action) {
          base.menu.removeClass('active');
          $(this).addClass('active');
          
          base.variable.include_category = $(this).data('id');
          base.variable.paged = 1;
          base.load_content('replace');
        }
      });
    },
    bind_load_button: function () {
      var base = this;
      
      base.loadbutton.bind('click', function (e) {
        e.preventDefault();
        
        if (!base.lock_action && !base.loadbutton.hasClass('btn-end')) {
          base.variable.paged = base.variable.paged + 1;
          base.load_content('append');
        }
      });
    },
    
    /** sidefeed ajax **/
    
    bind_ajax: function () {
      var base = this;
      
      if (jnewsoption.isblog && window.history && window.history.pushState) {
        base.ajax_dispatch();
      }
      
      if (window.history.pushState && !jnewsoption.ismobile) {
        $(window).bind('popstate', $.proxy(base.popstate, base));
      }
    },
    
    popstate: function (event) {
      var base = this;
      
      if (typeof event.originalEvent !== 'undefined') {
        var state = event.originalEvent.state;
        var url = location.href;
        
        if (state.type === 'sidefeed') {
          base.current_post_id = state.postid;
          base.active_state_feed(base.current_post_id);
          
          // slide up
          base.do_request(url, true);
        }
      }
    },
    
    
    ajax_dispatch: function () {
      var base = this;
      
      base.sidefeed.on('click', 'a.ajax', function (e) {
        e.preventDefault();
        
        var parent = $(this).parents('.jeg_post');
        var parentid = $(parent).data('id');
        var url = $(this).attr('href');
        
        if (parentid == base.current_post_id) {
          // do nothing
        } else {
          // if in mobile, then we need to close the drawer
          $('body').removeClass('menu-active').removeClass('push-content-right');
          
          base.current_post_id = parentid;
          base.set_side_active(parent);
          
          // slide up
          base.do_request(url, false);
        }
      });
    },
    do_request: function (url, no_push_history) {
      var base = this;
      
      base.postoverlay.fadeIn(500, function () {
        
        // need to trigger this
        $(document).trigger('jnews-sidefeed-ajax-begin');
        
        base.sectionwrap.height($(window).height());
        base.sectionwrap.find('.post-wrap').remove();
        $('html, body').scrollTop(0);
        base.fetch_content(url, base.current_post_id, no_push_history);
      });
    },
    active_state_feed: function (postid) {
      var base = this;
      base.sidefeed.find(".jeg_post").removeClass('active');
      var current = base.sidefeed.find(".jeg_post[data-id=" + postid + "]").addClass('active');
      
      base.load_sidefeed_content(current);
      base.scroll_to_view(current);
    },
    load_sidefeed_content: function (element) {
      var base = this;
      
      for (var i = 0; i < base.min_prev_sidefeed; i++) {
        if (element.length) {
          element = element.next();
        }
      }
      
      if (element.length === 0) {
        base.try_load_sidefeed_content();
      }
    },
    try_load_sidefeed_content: function () {
      var base = this;
      base.loadbutton.trigger('click');
    },
    close_curtain: function () {
      var base = this;
      base.postoverlay.fadeOut(500);
      base.sectionwrap.css({'height': 'auto'});
    },
    fetch_content: function (url, postid, nopush) {
      var base = this;
      if (base.post_xhr !== null) {
        base.post_xhr.abort();
      }
      
      base.post_xhr = $.ajax({
        url: url,
        type: "get",
        dataType: "html",
        success: function (responsehtml) {
          if (!nopush) {
            window.history.pushState({postid: postid, type: 'sidefeed'}, '', url);
          }
          
          // url
          jnews.ajax_analytic.update(url, postid);
          base.set_meta_data(responsehtml);
          base.setup_content(responsehtml, postid);
        },
        timeout: function () {
          window.location = url;
        }
      });
      
    },
    set_side_active: function (element) {
      var base = this;
      base.sidefeed.find(".jeg_post").removeClass('active');
      $(element).addClass('active');
      
      base.load_sidefeed_content(element);
      base.scroll_to_view(element);
    },
    reinitialize_view: function () {
      var sidecontent = $(".sidecontent_postwrapper");
      var api = sidecontent.data('jsp');
      api.reinitialise();
    },
    scroll_to_view: function (element) {
      if ($(element).length) {
        var sidecontent = $(".sidecontent_postwrapper");
        var api = sidecontent.data('jsp');
        var element_offset = $(element).position().top;
        var viewport_height = sidecontent.height();
        var jspane_scroll = $(".jspPane").position().top;
        var top_offset = element_offset + jspane_scroll;
        var element_height = $(element).height();
        
        if (top_offset < 0 || top_offset > ( viewport_height - element_height )) {
          var scrollTo = 0;
          
          if (top_offset < 0) {
            scrollTo = element_offset - 20;
          } else {
            scrollTo = element_offset - viewport_height + element_height + 50;
          }
          
          api.scrollTo(0, scrollTo);
        }
      }
    },
    set_meta_data: function (responsehtml) {
      var title = $(responsehtml).filter("title").text();
      var keyword = $(responsehtml).filter('meta[name=keyword]').attr("content");
      var description = $(responsehtml).filter('meta[name=description]').attr("content");
      
      $('meta[name=description]').attr('content', description);
      $('meta[name=keyword]').attr('content', keyword);
      document.title = title;
    },
    setup_content: function (responsehtml, postid) {
      var base = this;
      var wrappercontent = $(responsehtml).find('.post-wrap');
      base.sectionwrap.append(wrappercontent);
      
      var bodyclass = $(responsehtml).find('#post-body-class').attr('class');
      $('body').attr('class', bodyclass);
      
      /* jnews with  */
      base.close_curtain();
      
      // trigger sidefeed ajax loaded
      $(document).trigger('jnews-sidefeed-ajax', [postid]);
      
      // all element need to be hooked
      $(document).trigger('jnews-ajax-load', [wrappercontent]);
    }
  };
  
  jnews.sidefeed.init();
  
  
  /**
   *  COMMENT
   */
  
  window.jnews.comment =
  {
    container: null,
    init: function ($container) {
      var base = this;
      
      if ($container === undefined) {
        base.container = $('body');
      } else {
        base.container = $container;
      }
      
      // need to create first
      this.create(base.container);
      
      $(base.container).find(".ajax_comment_button").bind('click', function () {
        
        var post_id = $(this).data('id');
        var button = this;
        var loading = $(this).data('loading');
        
        $(this).find('span').text(loading);
        
        $.ajax({
          url: jnews_ajax_url,
          type: "post",
          dataType: "html",
          data: {
            'action': 'jnews_ajax_comment',
            'post_id': post_id
          },
          success: function (result) {
            $(button).after(result).remove();
            base.create(base.container);
          }
        });
      });
    },
    create: function () {
      var commenttype = $('#comments').attr('data-type');
      var commentid = $('#comments').attr('data-id');
      
      if (commenttype == 'disqus') {
        if ($('#disqus-script').length) {
          DISQUS.reset({
            reload: true
          });
        } else {
          $('#disqus-script').remove();
          (function () {
            var dsq = document.createElement('script');
            dsq.id = 'disqus-script';
            dsq.type = 'text/javascript';
            dsq.async = true;
            dsq.src = '//' + commentid + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
          })();
        }
      } else if (commenttype == 'facebook') {
        if ($('#facebook-jssdk').length) {
          FB.XFBML.parse();
        } else if (commenttype == 'facebook') {
          var appid = commentid ? '&appId=' + commentid : '';
          (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/" + jnewsoption.lang + "/sdk.js#xfbml=1&version=v2.8" + appid;
            fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));
        }
      }
    }
  };
  
  jnews.comment.init();
  
  
  /**
   * Ajax Analytics
   */
  window.jnews.ajax_analytic =
  {
    update: function (url, post_id) {
      this.google_analytics(url);
      this.track_jnews(post_id);
    },
    get_nonce: function (post_id) {
      var base = this;
    },
    google_analytics: function (track_page_url) {
      if (typeof pageTracker === "undefined" && typeof _gaq === 'undefined' && typeof ga === 'undefined' && typeof __gaTracker === 'undefined' && typeof gaplusu === 'undefined') {
        return;
      }
      
      // This uses Asynchronous version of Google Analytics tracking method.
      if (typeof pageTracker !== "undefined" && pageTracker !== null) {
        pageTracker._trackPageview(track_page_url);
      }
      
      // This uses Google's classic Google Analytics tracking method.
      if (typeof _gaq !== 'undefined' && _gaq !== null) {
        _gaq.push(['_trackPageview', track_page_url]);
      }
      
      // This uses Google Analytics Universal Analytics tracking method.
      if (typeof ga !== 'undefined' && ga !== null) {
        ga('send', 'pageview', track_page_url);
      }
      
      // This uses Yoast's method of tracking Google Analytics.
      if (typeof __gaTracker !== 'undefined' && __gaTracker !== null) {
        __gaTracker('send', 'pageview', track_page_url);
      }
      
      // This uses WPMU Dev method of tracking Google Analytics.
      if (typeof gaplusu !== 'undefined' && gaplusu !== null) {
        gaplusu('send', 'pageview', track_page_url);
      }
    },
    track_jnews: function (post_id) {
      if (jfla.indexOf('view_counter') > -1) {
        jnews.first_load.do_ajax({
          'action': 'jnews_first_load_action',
          'load_action': ['view_counter'],
          'jnews_id': post_id
        });
      }
    }
  }
  
})(jQuery);