(function($){
    "use strict";

    var Split = function(element, options)
    {
        if(element === undefined)
        {
            this.container = $('body');
        } else {
            this.container = $(element);
        }

        this.data = null;
        this.xhr = null;
        this.xhr_cache = [];
        this.id = this.container.find('.split-container').data('id');

        this.init();
    };

    Split.DEFAULTS = {};

    Split.prototype.init = function ()
    {
        var base = this;

        if(typeof window[base.id] === 'undefined') return;

        base.data = window[base.id];
        base.data.index = parseInt(base.data.index);

        base.menu_drop();

        if(base.data.mode === 'all' || base.data.mode === 'ajax') {
            base.mode_load_all();
        } else {
            base.mode_normal();
        }

        $(window).bind('popstate', $.proxy(base.popstate, base));
        $(window).bind('jnews_after_split_content_ajax', $.proxy(base.after_ajax, base));
    };

    Split.prototype.after_ajax = function()
    {
        var base = this;

        if(jnews.popup !== undefined) {
            jnews.popup.init(base.container.find(".entry-content"));
        }
        if(jQuery().jskill) {
            base.container.find('.jeg_reviewbars').jskill();
        }
    };

    Split.prototype.menu_drop = function()
    {
        var base = this;

        var splitpost = base.container.find('.jeg_splitpost_bar');

        if (splitpost.find('.jeg_splitpost_nav').length)
        {
            splitpost.each(function() {
                var parent = $(this);
                var nav_wrap = parent.find('.nav_wrap');
                var nav = parent.find('.jeg_splitpost_nav');
                var current_title = parent.find('.current_title');

                current_title.bind('click', function() {
                    splitpost.not(parent).removeClass('nav-open');
                    parent.toggleClass('nav-open');
                });

                /** Close menu when click outside **/
                $(document).mouseup(function(e){
                    if( parent.hasClass('nav-open') && (!$(e.target).parents('.nav_wrap').length > 0) ) {
                        parent.removeClass('nav-open');
                    }
                });
            });
        }
    };

    /** mode normal */
    Split.prototype.mode_normal = function()
    {
        // we do nothing here...
    };

    /** mode all */
    Split.prototype.mode_load_all = function()
    {
        var base = this;

        // assign drop menu
        base.container.find(".jeg_splitpost_nav a").bind('click', function(e){
            e.preventDefault();

            var parent = $(this).parents('.jeg_splitpost_bar');
            $(parent).removeClass('nav-open');

            var index = $(this).data('id');
            base.change_slide(index, true);
        });

        // assign paging number
        base.container.find(".jeg_split_pagination .page_number").bind('click', function(e){
            e.preventDefault();
            var index = $(this).data('id');
            base.change_slide(index, true);
        });

        // assign paging next prev
        base.container.find(".jeg_split_pagination .page_nav, .jeg_bottomnav .page_nav, .jeg_splitpost_bar .page_nav").bind('click', function(e){
            e.preventDefault();
            var element = this;

            if($(element).hasClass('prev')) {
                base.change_slide(base.data.index - 1, true);
            } else {
                base.change_slide(base.data.index + 1, true);
            }
        });

    };

    Split.prototype.popstate = function(event)
    {
        var base = this;

        if(typeof event.originalEvent !== 'undefined')
        {
            var content = event.originalEvent.state;

            if(content && content.type === 'split')
            {
                base.change_slide(content.id, false);
            }
        }
    };

    Split.prototype.change_slide = function(index, change_url)
    {
        var base = this;
        if(index < 0) index = 0;
        if(index > base.data.max) index = base.data.max;

        if(base.data.index === index) {
            // do nothing
        } else {
            base.data.index = index;
            if(change_url) base.change_url(index);
            base.change_title(index);

            if(base.data.mode === 'all') {
                base.change_content(index);
            } else {
                base.change_content_ajax(index);
            }

            base.change_control(index);
            base.scroll_top();

            $(window).trigger('resize');
        }
    };

    Split.prototype.scroll_top = function()
    {
        var base = this;

        $('html, body').stop().animate({
            scrollTop: base.container.find(".top-split-nav").offset().top - 65
        }, 500);
    };

    Split.prototype.change_title = function(index)
    {
        var base = this;
        var content = base.data.content[index];
        document.title = content.page_title;
    };

    Split.prototype.change_url = function(index)
    {
        var base = this;
        var content = base.data.content[index];
        content.type = 'split';

        if(history && history.pushState) {
            history.pushState(content, '', content.url);
        }

        base.push_analytic(content.url, base.data.post_id);
    };

    Split.prototype.change_content = function(index)
    {
        var base = this;

        base.container.find(".content-inner .split-wrapper").removeClass('active');
        base.container.find(".content-inner .split-wrapper[data-id='" + index +  "']").addClass('active');
    };

    Split.prototype.cache_get = function(parameter)
    {
        var base = this;
        var jsonparam = JSON.stringify(parameter);

        for(var i = 0; i < base.xhr_cache.length; i++)
        {
            if(base.xhr_cache[i].param == jsonparam)
            {
                return base.xhr_cache[i].result;
            }
        }
        return false;
    };

    Split.prototype.cache_save = function(parameter, response)
    {
        var base = this;

        var jsonparam = JSON.stringify(parameter);

        base.xhr_cache.push({
            param : jsonparam,
            result : response
        });
    };

    Split.prototype.process_content_ajax = function(parameter, data){
        var base = this;

        base.container.find(".content-inner .split-wrapper").html(data).removeClass('loading');
        base.cache_save(parameter, data);

        $(document).trigger('jnews_after_split_content_ajax', [ base.container.find(".content-inner .split-wrapper") ]);
    };

    Split.prototype.change_content_ajax = function(index){
        var base = this;
        var parameter = {
            post_id 	: base.data.post_id,
            type 		: base.data.mode,
            index 		: index,
            action 		: 'split_post_handler'
        };
        base.container.find(".content-inner .split-wrapper").addClass('loading');

        var result = base.cache_get(parameter);

        if(result)
        {
            base.process_content_ajax(parameter, result);
        } else {
            base.xhr = $.ajax({
                url : jnews_ajax_url,
                type: 'post',
                dataType: 'html',
                data: parameter,
                success: $.proxy(base.process_content_ajax, base, parameter)
            });
        }
    };

    Split.prototype.push_analytic = function(url, post_id)
    {
        if(window.jnews && window.jnews.ajax_analytic)
        {
            jnews.ajax_analytic.update(url, post_id);
        }
    };

    Split.prototype.change_control = function(index){
        var base = this;
        var prevdata = null;
        var nextdata = null;
        var content = base.data.content[index];

        /** Split Post Bar */
        base.container.find(".jeg_splitpost_bar").each(function(){
            var bar = this;

            $(bar).find(".jeg_splitpost_nav li").removeClass('current');
            $($(bar).find(".jeg_splitpost_nav li").get(index)).addClass('current');
        });
        base.change_nav_text(index);

        /**
         * Split paging
         **/
        var page_text = base.data.page_text.replace("{page}", content.page);
        base.container.find(".jeg_split_pagination .page_info").text(page_text);

        // add class active
        base.container.find(".jeg_split_pagination .nav_link .page_number").removeClass('active');
        base.container.find(".jeg_split_pagination .nav_link .page_number[data-id='" + index +  "']").addClass('active');

        // disable next & prev
        base.container.find(".jeg_split_pagination .page_nav").removeClass('disabled');
        if(index == 0) base.container.find(".jeg_split_pagination .page_nav.prev").addClass('disabled');
        if(index == base.data.max) base.container.find(".jeg_split_pagination .page_nav.next").addClass('disabled');

        /**
         * Bottom Nav
         **/
        base.container.find(".jeg_bottomnav .page_nav").removeClass('hide');
        if(index == 0) base.container.find(".jeg_bottomnav .page_nav.prev").addClass('hide');
        if(index == base.data.max) base.container.find(".jeg_bottomnav .page_nav.next").addClass('hide');

        if(index > 0) {
            prevdata = base.data.content[index - 1];
            base.container.find(".jeg_bottomnav .page_nav.prev a").attr('href', prevdata.url);
            base.container.find(".jeg_bottomnav .page_nav.prev strong").text(base.decode_string(prevdata.title));
        }

        if(index < base.data.max) {
            nextdata = base.data.content[index + 1];
            base.container.find(".jeg_bottomnav .page_nav.next a").attr('href', nextdata.url);
            base.container.find(".jeg_bottomnav .page_nav.next strong").text(base.decode_string(nextdata.title));
        }

        /**
         * Split post next prev
         **/
        base.container.find(".jeg_splitpost_bar .page_nav").removeClass('disable');

        if(index > 0) {
            prevdata = base.data.content[index - 1];
            base.container.find(".jeg_splitpost_bar .page_nav.prev a").attr('href', prevdata.url);
        }

        if(index < base.data.max) {
            nextdata = base.data.content[index + 1];
            base.container.find(".jeg_splitpost_bar .page_nav.next a").attr('href', nextdata.url);
        }

        if(index == 0) base.container.find(".jeg_splitpost_bar .page_nav.prev").addClass('disable').find('a').attr('href', "#");
        if(index == base.data.max) base.container.find(".jeg_splitpost_bar .page_nav.next").addClass('disable').find('a').attr('href', "#");
    };

    Split.prototype.decode_string = function(encodedStr){
        var parser = new DOMParser;
        var dom = parser.parseFromString(
            '<!doctype html><body>' + encodedStr,
            'text/html');
        return dom.body.textContent;
    };

    Split.prototype.change_nav_text = function(index){
        var base = this;
        var current = base.data.content[index];
        var text = "<span class='pagenum'>" + current.page + ".</span> " + current.title;
        base.container.find(".jeg_splitpost_bar .current_title").html(text);
    };

    function Plugin(option)
    {
        return $(this).each(function()
        {
            var $this = $(this);
            var options = $.extend({}, Split.DEFAULTS, $this.data(), typeof option == 'object' && option);
            var data = $this.data('jeg.split');

            if (!data) $this.data('jeg.split', (data = new Split(this, options)));
        });
    }

    var old = $.fn.jsplit;

    $.fn.jsplit = Plugin;
    $.fn.jsplit.Constructor = Split;

    $.fn.jsplit.noConflict = function () {
        $.fn.jsplit= old;
        return this
    };

    $("body").jsplit();


})(jQuery);