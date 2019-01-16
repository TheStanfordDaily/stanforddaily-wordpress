(function($){
    "use strict";

    var Module = function(element, options)
    {
        this.element = $(element);
        this.options = options;
        this.xhr = null;
        this.xhr_cache = [];
        this.lock_action = false;

        this.unique = this.element.data('unique');
        this.data = {
            filter: 0,
            filter_type: 'all',
            current_page : 1,
            attribute : window[this.unique]
        };
        this.ajax_mode = this.data.attribute.pagination_mode;

        // Populate Element
        this.header = this.element.find('.jeg_block_heading');
        this.container = this.element.find('.jeg_block_container');
        this.nav_block = this.element.find('.jeg_block_navigation');
        this.nav_next = null;
        this.nav_prev = null;
        this.module_overlay = $(element).find('.module-overlay');
        this.load_more_block = $(element).find('.jeg_block_loadmore');

        if(this.ajax_mode === 'nextprev')
        {
            this.nav_next = this.nav_block.find('.next');
            this.nav_prev = this.nav_block.find('.prev');

            // assign click
            this.nav_next.bind('click', $.proxy(this.click_next, this));
            this.nav_prev.bind('click', $.proxy(this.click_prev, this));
        }

        if(this.ajax_mode === 'loadmore' || this.ajax_mode === 'scrollload')
        {
            this.nav_next = this.nav_block.find('.jeg_block_loadmore > a');
            this.nav_next.bind('click', $.proxy(this.load_more, this));
        }

        if(this.ajax_mode === 'scrollload')
        {
            this.load_limit = this.data.attribute.pagination_scroll_limit;
            this.load_scroll();
        }

        this.init();
    };

    Module.DEFAULTS = {};

    Module.prototype.init = function()
    {
        var base = this;

        // call subcat
        base.element.find('.jeg_subcat').okayNav({ swipe_enabled: false, threshold: 80 });

        /** Block Heading */
        base.assign_header();
    };

    Module.prototype.load_scroll = function()
    {
        var base = this;

        if(!base.nav_next.hasClass('disabled'))
        {
            if(base.load_limit > base.data.current_page || base.load_limit == 0)
            {
                base.nav_next.waypoint(function ()
                {
                    base.data.current_page = base.data.current_page + 1;
                    base.request_ajax('scroll');
                    this.destroy();
                }, {
                    offset: '100%',
                    context: window
                });
            }
        }
    };

    Module.prototype.click_next = function(event)
    {
        var base = this;
        var element = base.nav_next;
        event.preventDefault();

        if (!$(element).hasClass('disabled') && !base.lock_action)
        {
            base.data.current_page = base.data.current_page + 1;
            base.request_ajax('next');
        }
    };

    Module.prototype.click_prev = function(event)
    {
        var base = this;
        var element = base.nav_prev;
        event.preventDefault();

        if(!$(element).hasClass('disabled') && !base.lock_action)
        {
            base.data.current_page = base.data.current_page - 1;
            base.request_ajax('prev');
        }
    };

    Module.prototype.load_more = function(event)
    {
        var base = this;
        var element = base.nav_next;
        event.preventDefault();

        if (!$(element).hasClass('disabled') && !base.lock_action)
        {
            base.data.current_page = base.data.current_page + 1;
            base.request_ajax('more');
        }
    };

    Module.prototype.assign_header = function()
    {
        var base = this;
        $(base.header).on('click', '.subclass-filter', $.proxy(base.subclass_click, base));
    };

    Module.prototype.subclass_click = function(event)
    {
        var base = this;
        var target = event.target;
        event.preventDefault();

        if(!base.lock_action)
        {
            this.header.find('.subclass-filter').removeClass('current');
            $(target).addClass('current');

            base.data.filter = $(target).data('id');
            base.data.filter_type = $(target).data('type');
            base.data.current_page = 1;

            base.request_ajax('subclass');
        }
    };


    Module.prototype.request_ajax = function(type)
    {
        var base = this;
        base.lock_action = true;

        var action = jnewsoption.module_prefix + base.data.attribute.class;
        var parameter = {
            'action' : action,
            'module' : true,
            'data' : base.data
        };

        var result = base.cache_get(parameter);

        if(result)
        {
            base.before_ajax_request(type, false);
            setTimeout(function(){
                base.load_ajax(type, parameter, result);
            }, 100);

        } else {
            base.before_ajax_request(type, true);
            base.xhr = $.ajax({
                url : jnews_ajax_url,
                type: 'post',
                dataType: 'json',
                data: parameter,
                success: function(response){
                    base.load_ajax(type, parameter, response);
                    base.cache_save(parameter, response);
                }
            });
        }
    };

    Module.prototype.cache_get = function(parameter)
    {
        var base = this;
        var jsonparam = JSON.stringify(parameter);

        for(var i = 0; i < base.xhr_cache.length; i++)
        {
            if(base.xhr_cache[i].param == jsonparam)
            {
                return base.cache_prepare(base.xhr_cache[i].result);
            }
        }

        return false;
    };

    Module.prototype.cache_prepare = function(response)
    {
        response.content = '<div>' + response.content + '</div>';

        var content = $(response.content);

        content.find('img').each(function(){
            var src = $(this).data('src');
            $(this).attr('src', src).removeClass('lazyload').addClass('lazyloaded');
        });

        response.content = content.html();

        return response;

    };

    Module.prototype.cache_save = function(parameter, response)
    {
        var base = this;
        var jsonparam = JSON.stringify(parameter);

        base.xhr_cache.push({
            param : jsonparam,
            result : response
        });
    };

    Module.prototype.load_ajax = function(type, parameter, response)
    {
        var base = this;
        base.lock_action = false;

        switch(base.ajax_mode) {
            case 'loadmore' :
                base.load_ajax_load_more(response, type);
                break;
            case 'scrollload' :
                base.load_scroll_more(response, type);
                break;
            case 'nextprev' :
            default :
                base.load_ajax_next_prev(response, type);
                break;
        }

        if(jnews.like) jnews.like.init();
        jnews.share.init();
    };

    Module.prototype.before_ajax_request = function(type, show_loading)
    {
        var base = this;

        // remove necessary class
        base.element
            .removeClass('loaded next prev more scroll subclass')
            .addClass('loading');

        if( ( type === 'next' || type === 'prev' || type === 'subclass' ) && show_loading) {
            base.module_overlay.show();
        }

        if(type === 'more' || type === 'scroll') {
            base.load_more_block.find('a').text(base.load_more_block.find('a').data('loading')).addClass('active');
        }
    };

    Module.prototype.after_ajax_request = function(type)
    {
        var base = this;

        // loading class
        base.element
            .removeClass('loading')
            .addClass('loaded')
            .addClass(type);

        if(type === 'next' || type === 'prev' || type === 'subclass') {
            base.module_overlay.hide();
        }

        if(type === 'more' || type === 'scroll') {
            base.load_more_block.find('a').text(base.load_more_block.find('a').data('load')).removeClass('active');
            // base.navigation_overlay.hide();
        }
    };

    Module.prototype.replace_content = function(content)
    {
        var base = this;

        base.container.children().each(function(){
            if(!$(this).hasClass('module-overlay'))
            {
                $(this).remove();
            }
        });
        base.container.prepend(content);
    };


    Module.prototype.load_ajax_next_prev = function(response, load_type)
    {
        var base = this;

        // change content
        base.replace_content(response.content);

        // change navigation
        if(base.nav_next !== null) {
            if(response.next) {
                base.nav_next.removeClass('disabled');
            } else {
                base.nav_next.addClass('disabled');
            }
        }

        if(base.nav_prev !== null) {
            if (response.prev) {
                base.nav_prev.removeClass('disabled');
            } else {
                base.nav_prev.addClass('disabled');
            }
        }

        if(!(response.next || response.prev)) {
            if(base.nav_next !== null) {
                base.nav_next.parent().addClass('inactive');
            }
        } else {
            if(base.nav_prev !== null) {
                base.nav_next.parent().removeClass('inactive');
            }
        }

        // we done :)
        base.after_ajax_request(load_type);
        $(window).trigger('resize');
    };


    Module.prototype.load_ajax_load_more = function(response, load_type)
    {
        var base = this;
        var content = $(response.content);

        // add ajax flag class for animation
        var count = 0;
        content.each(function() {

            if ( $(this).hasClass('jeg_post') ) {
                $(this).addClass('jeg_ajax_loaded anim_'+ count);

            } else {
                var posts = $(this).find('.jeg_post');
                posts.each(function() {
                    $(this).addClass('jeg_ajax_loaded anim_'+ count);
                    count++;
                });
            }

            count++;
        });

        base.container.find('.jeg_post').removeClass('jeg_ajax_loaded');
        base.container.find('.jeg_ad_module').removeClass('jeg_ajax_loaded');

        if(base.data.current_page == 1) {
            base.replace_content(content);
        } else {
            base.element.find('.jeg_load_more_flag').append(content);
        }

        if(response.next) {
            base.nav_next.removeClass('disabled');
        } else {
            base.nav_next.addClass('disabled');
        }

        base.after_ajax_request(load_type);
        $(window).trigger('resize');
    };

    Module.prototype.load_scroll_more = function(response, load_type)
    {
        var base = this;
        var content = $(response.content);

        var count = 0;
        content.each(function() {

            if ( $(this).hasClass('jeg_post') ) {
                $(this).addClass('jeg_ajax_loaded anim_'+ count);

            } else {
                var posts = $(this).find('.jeg_post');
                posts.each(function() {
                    $(this).addClass('jeg_ajax_loaded anim_'+ count);
                    count++;
                });
            }

            count++;
        });

        base.container.find('.jeg_post').removeClass('jeg_ajax_loaded');
        base.container.find('.jeg_ad_module').removeClass('jeg_ajax_loaded');

        if(base.data.current_page == 1) {
            base.container.html('').html(content);
        } else {
            base.element.find('.jeg_load_more_flag').append(content);
        }

        if(response.next) {
            base.nav_next.removeClass('disabled');
        } else {
            base.nav_next.addClass('disabled');
        }

        base.after_ajax_request(load_type);
        $(window).trigger('resize');

        setTimeout(function(){
            base.load_scroll();
        }, 500);

    };

    function Plugin(option)
    {
        return $(this).each(function()
        {
            var $this = $(this);
            var options = $.extend({}, Module.DEFAULTS, $this.data(), typeof option == 'object' && option);
            var data = $this.data('jeg.module');

            if (!data) $this.data('jeg.module', (data = new Module(this, options)));
        });
    }

    var old = $.fn.jmodule;

    $.fn.jmodule = Plugin;
    $.fn.jmodule.Constructor = Module;

    $.fn.jmodule.noConflict = function () {
        $.fn.jmodule= old;
        return this
    };

    $(".jeg_module_hook").jmodule();


})(jQuery);