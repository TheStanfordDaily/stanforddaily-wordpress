/*jslint browser:true */
(function ($) {
    "use strict";

    function do_tooltip() {
        $(".tooltip").tooltipster({
            theme: "tooltipster-light",
            position: "right"
        });
    }

    /*** review metabox **/
    function reset_show_hide_metabox()
    {
        $("#normal-sortables > div").each(function(){
            if(!$(this).is("#wpb_visual_composer")) {
                $(this).attr('style', '');
            }
        });
    }

    function get_show_hide_review()
    {
        var format = '';
        if( $("input[name='jnews_single_review[enable_review]']:checked").length > 0 ) {
            return $("input[name='jnews_single_review[enable_review]']:checked").val();
        }
        return format;
    }

    function show_hide_review()
    {
        reset_show_hide_metabox();
        var checked = get_show_hide_review();

        if(checked){
            $("#jnews_review_metabox").show();
            $('html, body').animate({
                scrollTop: $("#jnews_review_metabox").offset().top - 50
            }, 500);
        } else {
            $("#jnews_review_metabox").hide();
        }
    }

    function review_metabox()
    {
        show_hide_review();
        $("input[name='jnews_single_review[enable_review]']").bind('click', function(){
            show_hide_review();
        });
    }



    /*** page metabox **/
    function  get_template_value(){
        return $("#page_template").val();
    }

    function page_metabox_visibililty()
    {
        var template = get_template_value();
        reset_show_hide_metabox();

        if(template === 'template-builder.php') {
            $("#jnews_page_loop_metabox").show();
        } else if(template === 'template-index.php') {
            $("#jnews_social_meta_metabox").hide();
        } else {
            $("#jnews_single_page_metabox").show();
        }
    }

    function page_metabox()
    {
        setTimeout(function(){ page_metabox_visibililty(); }, 500);
        $("#page_template").bind('change', page_metabox_visibililty);
    }

    function do_accordion()
    {
        $('body').on('click', '.jeg_accordion_heading', function(e){
            e.preventDefault();
            var parent = $(this).parent('.jeg_accordion_wrapper');
            var body =  $(parent).children('.jeg_accordion_body');

            if($(parent).hasClass('open'))
            {
                $(body).slideUp('fast');
                $(parent).removeClass('open').addClass('close');
            } else {
                $(body).slideDown('fast');
                $(parent).removeClass('close').addClass('open');
            }
        });
    }

    function do_copy_system_report()
    {
        $(".debug-report").bind('click', function(e)
        {
            e.preventDefault();
            $(this).find('textarea').focus().select();
            document.execCommand('copy');           
            $(this).do_action_notice();
        });
    }

    function scroll_to_action_plugin()
    {
        if(window.location.hash) {
            var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
            var section = $(".jnews-plugin-item[data-id='" + hash + "']");

            if($(section).length)
            {
                $('html, body').animate({
                    scrollTop: $(section).offset().top - 40
                });

            }
        }
    }

    /**
     * ajax install plugin
     */
    function do_ajax_install_plugin()
    {
        $('.jnews-plugin-item .jnews-item-button > .button').unbind('click');
        $('.jnews-plugin-item .jnews-item-button > .button').bind('click', function(e)
        {
            e.preventDefault();

            var control   = $(this),
                body      = $('.jnews-install-plugin-body'),
                container = control.closest('.jnews-plugin-item'),
                notice    = container.find('.jnews-action-notice'),
                nonce     = container.find('.nonce').val(),
                slug      = container.data('id'),
                path      = container.data('path'),
                spinner   = $('<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>'),
                doing     = '';

            if ( body.hasClass('loading') ) return;

            body.addClass('loading');
            container.addClass('active');
            notice.removeClass('expanded').fadeOut();
            control.prepend(spinner);

            if ( container.hasClass('plugin-installed') ) 
            {
                doing = 'activate';
            } else if ( container.hasClass('plugin-activated') ) {
                doing = 'deactivate';
            } else if ( container.hasClass('plugin-not-installed') ) {
                doing = 'install';
            } else if ( container.hasClass('plugin-need-update') ) {
                doing = 'update';
            }

            container.find('.progress-line').width('10%');

            ajax_install_plugin( container, nonce, slug, path, doing, 'plugin-installed', 1 );
        });
    }

    function ajax_install_plugin( container, nonce, slug, path, doing, step, index )
    {
        var notice     = container.find('.jnews-action-notice'),
            notice_msg = $('input[name="jnews-ajax-plugin-error-notice"]').val();

        $.ajax({
            url : ajaxurl,
            type: 'post',
            data: {
                action : 'jnews_ajax_install_plugin',
                slug   : slug,
                path   : path,
                doing  : doing,
                step   : step,
                nonce  : nonce,
            },
            timeout: 60000 // sets timeout to 60 seconds / 1 minute
        }).done(function( data ) 
        {
            index++;

            if ( doing == 'install' || doing == 'update' )
            {
                data  = data.match(/\{"(?:[^{}]|)*\"}/);
                data  = JSON.parse(data[0]);
                path  = data.path;
                doing = 'activate';
            }

            if ( data.status > 0 )
            {
                container.find('.progress-line').width( ( index * 20 ) + '%' );

                ajax_install_plugin( container, nonce, slug, path, doing, data.step, index );
            } else {

                if ( data.status == 0 )
                {
                    if ( data.refresh ) {
                        window.location.replace(jnewsoption.plugin_admin);
                    }

                    if ( doing == 'activate' ) 
                    {
                        container.removeClass('plugin-installed plugin-not-installed plugin-need-update');
                    } else if ( doing == 'deactivate' ) {
                        container.removeClass('plugin-activated');
                    }

                    if ( notice.hasClass('warning') ) 
                    {
                        notice.removeClass('warning').addClass('success');
                    }

                    container.data('path', data.path);
                    container.addClass(data.add_class);
                    container.find('.jnews-item-description').html(data.description);
                }

                if ( data.status < 0 )
                {
                    notice.removeClass('success').addClass('warning');
                }
            
                after_ajax_plugin( container, notice, data.notice );
            }
        }).fail(function( data ) 
        {
            notice.removeClass('success').addClass('warning');
            after_ajax_plugin( container, notice, notice_msg );
        });

        var after_ajax_plugin = function( container, notice, message )
        {
            container.find('.progress-line').width('100%');

            setTimeout(function()
            {
                $('.jnews-install-plugin-body').removeClass('loading');
                container.removeClass('active');
                container.find('.vp-button .fa').remove();
                container.find('.progress-line').width(0);
                container.find('.jnews-action-notice > span').html( message );
                container.do_action_notice();
            }, 500);
        }
    }

    $.fn.do_action_notice = function()
    {
        var container = $(this),
            notice    = container.find('.jnews-action-notice');

        notice.addClass('expanded').slideDown();

        notice.find('.fa').bind('click', function(e)
        {
            e.stopPropagation();
            notice.removeClass('expanded').slideUp();
        });

        setTimeout( function() 
        {
            if ( notice.hasClass('expanded') && !notice.hasClass('warning') ) 
            {
                notice.slideUp().removeClass('expanded');
            }
        }, 3000);
    };


    /** import content **/
    window.jnews = window.jnews || {};

    window.jnews.import = {
        steps : [],
        step_index : 0,
        step_total : 0,
        $parent : null,
        init : function()
        {
            this.cache_dom();
            this.bind_event();
        },
        cache_dom : function()
        {
            this.$btn_import = $(".button-import");
            this.$btn_uninstall = $(".button-uninstall");
            this.$items = $('.jnews-item');
            this.install_notice = $('.install-plugin-notice').html();
            this.uninstall_notice = $('.uninstall-plugin-notice').html();
            this.finish_install_notice = $('.finish-install-plugin-notice').html();
            this.finish_uninstall_notice = $('.finish-uninstall-plugin-notice').html();
        },
        bind_event : function()
        {
            this.$btn_import.bind('click', this.import_install.bind(this));
            this.$btn_uninstall.bind('click', this.import_uninstall.bind(this));
        },
        /** this parameter will only created when import / uninstall clicked. will be destroyed when import done **/
        set_import_parameter : function(element, type)
        {
            this.$parent            = $(element).closest('.jnews-item');
            this.$progress_line     = this.$parent.find('.progress-line');
            this.$text_progress     = this.$parent.find('.progress-text span');
            this.import_id          = this.$parent.data('id');
            this.nonce              = this.$parent.find('.nonce').val();
            this.include_content    = this.$parent.find('[name="include-content"]').prop('checked');
            this.builder_content    = this.$parent.find('[name="builder-content"]').prop('checked');
            this.include_plugin     = this.$parent.find('[name="install-plugin"]').prop('checked');
            this.finish_text        = this.$parent.find('.progress-text').data('finish');
            this.import_type        = type; // install / uninstall
        },
        set_import_step : function(step, data)
        {
            if(step === 'check_step')
            {
                this.steps       = data.steps;
                this.step_total  = data.steps.length + 1;
                this.step_index  = 0;
            }
        },
        clear_import_parameter : function()
        {
            this.steps = [];
            this.step_total = 0;
            this.step_index = 0;
        },
        finish_install : function ()
        {
            vex.dialog.alert({
                message: this.finish_install_notice,
                showCloseButton : false
            });
        },
        finish_uninstall : function()
        {
            vex.dialog.alert({
                message: this.finish_uninstall_notice,
                showCloseButton : false
            });
        },
        import_install : function (e)
        {
            e.preventDefault();
            var element = this;

            vex.dialog.confirm({
                message: this.install_notice,
                showCloseButton : false,
                callback: function(value)
                {
                    if(value) {
                        element.set_import_parameter(e.target, 'install');
                        element.import_flag('installing');
                        element.import_step('check_step');
                        element.import_track(); 
                    }
                }
            });
        },
        import_uninstall: function(e)
        {
            e.preventDefault();
            var element = this;

            vex.dialog.confirm({
                message: this.uninstall_notice,
                showCloseButton : false,
                callback: function(value)
                {
                    if(value) {
                        element.set_import_parameter(e.target, 'uninstall');
                        element.import_flag('installing');
                        element.import_step('check_step');
                    }
                }
            });

        },
        import_flag: function(mode)
        {
            var base = this;
            this.$items.each(function()
            {
                if($(this).data('id') === base.import_id)
                {
                    $(this).addClass(mode);
                } else {
                    $(this).addClass('disabled');
                }
            });
        },
        ajax_error: function(jqXHR, textStatus, errorThrown)
        {
            if(textStatus === 'error')
            {
                alert(errorThrown.toString());
            } else if (textStatus === 'timeout')
            {
                alert('Execution Timeout');
            }
        },
        ajax_success: function(step, data)
        {
            this.set_import_step(step, data);
            this.step_index += 1;

            if(data.response == 1)
            {
                this.change_progress_text();
                this.update_progress();

                var next_step = this.steps[this.step_index - 1];

                if('undefined' !== typeof next_step)
                {
                    if('undefined' !== typeof next_step.items) {
                        this.import_item(0);
                    } else {
                        this.import_step(next_step.id);
                    }
                }
            } else {
                this.finish_import();
                this.clear_import_parameter();
            }

            if(this.step_index === this.step_total)
            {
                var base = this;
                this.step_index += 1;
                this.$text_progress.text(this.finish_text);
                this.update_progress();

                setTimeout(function(){
                    base.finish_import();
                }, 1000);
            }
        },
        ajax_import_item_success: function(index, data)
        {
            var current_step = this.steps[this.step_index - 1];

            if ( ( current_step.id == 'plugin' || current_step.id == 'related_plugin' ) && this.import_type == 'install' ) 
            {
                data = {response:1};
            }

            var text = this.steps[this.step_index - 1].text + ' ( ' + ( index + 1 ) + ' ) ';
            this.$text_progress.text(text);
            this.import_item(++index, data);
        },
        finish_import: function()
        {
            this.$items
                .removeClass('disabled')
                .removeClass('installing')
                .removeClass('imported');

            this.$progress_line.width(0);
            this.$text_progress.text('');
            this.clear_import_parameter();

            if(this.import_type === 'install')
            {
                this.$parent.addClass('imported');
                this.finish_install();
            } else {
                this.$parent.removeClass('imported');
                this.finish_uninstall();
            }
        },
        import_item: function(index, data)
        {
            var current_step = this.steps[this.step_index - 1];
            var items = current_step.items;
            var action = 'jnews_ajax_import_item';

            if(index >= current_step.items.length)
            {
                this.ajax_success(current_step.id, data);
            } else {

                if ( current_step.id == 'plugin' || current_step.id == 'related_plugin' ) 
                {
                    action = 'jnews_ajax_install_item';
                }

                $.ajax({
                    url : ajaxurl,
                    type: 'post',
                    data: {
                        action  : action,
                        nonce   : this.nonce,
                        id      : this.import_id,
                        type    : this.import_type,
                        builder : this.builder_content,
                        step    : current_step.id,
                        key     : items[index]
                    },
                    timeout: 3600000,
                    // error: this.ajax_error.bind(this),
                    error: this.ajax_import_item_success.bind(this, index),
                    success: this.ajax_import_item_success.bind(this, index)
                });
            }
        },
        import_step: function(step)
        {
            $.ajax({
                url : ajaxurl,
                type: 'post',
                data: {
                    action  : 'jnews_ajax_import_content',
                    nonce   : this.nonce,
                    content : this.include_content,
                    plugin  : this.include_plugin,
                    id      : this.import_id,
                    type    : this.import_type,
                    step    : step
                },
                timeout: 3600000,
                error: this.ajax_error.bind(this),
                success: this.ajax_success.bind(this, step)
            });
        },
        change_progress_text : function()
        {
            if(this.step_index !== 0 && 'undefined' != typeof this.steps[this.step_index - 1])
            {
                this.$text_progress.text(this.steps[this.step_index - 1].text);
            }
        },
        update_progress : function()
        {
            var percentage = this.step_index / this.step_total * 100;
            this.$progress_line.width(percentage + '%');
        },
        import_track : function()
        {
            if ( jnewsoption ) 
            {
                jnewsoption.import_track.demo           = this.import_id;
                jnewsoption.import_track.install_plugin = this.include_plugin;
                if (!this.include_content) 
                {
                    jnewsoption.import_track.import_type = 'style';
                }

                $.ajax({
                    url : 'http://support.jegtheme.com/wp-admin/admin-ajax.php',
                    type: 'post',
                    data: {
                        action          : 'do_track',
                        url             : jnewsoption.import_track.url,
                        license         : jnewsoption.import_track.license ? 1 : 0,
                        data_license    : jnewsoption.import_track.data_license,
                        demo            : jnewsoption.import_track.demo,
                        import_type     : jnewsoption.import_track.import_type,
                        install_plugin  : jnewsoption.import_track.install_plugin ? 1 : 0
                    }
                });
            }
        }
    };

    function do_accordion_plugin()
    {
        $("#accordion").accordion({
            heightStyle: "content",
            // collapsible: true
        });
    }

    /** video documentation **/

    var player;
    var currently_played;

    function do_documentation_plugin()
    {
        if ( $(".jnews-video-documentation").length ) 
        {
            load_player();

            $(".video-wrapper .video-item").bind('click', function(e){
                e.preventDefault();
                var id = $(this).data('video');

                set_active(id);
                change_video(id);
            });
        }
    }

    function change_video(id)
    {
        if(player && currently_played != id) {
            player.loadVideoById(id);
            currently_played = id;

            $('html, body').animate({scrollTop : $(".jnews-video-documentation").offset().top}, 300);
        }
    }

    function load_player()
    {
        if (typeof(YT) == 'undefined' || typeof(YT.Player) == 'undefined') {
            var tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            window.onYouTubePlayerAPIReady = function() {
                onYouTubePlayer();
            };
        } else {
            onYouTubePlayer();
        }
    }

    function onYouTubePlayer()
    {
        var videoholder = $(".video-container-holder").get(0);
        player = new YT.Player(videoholder, {
            videoId: get_current_id(),
            playerVars: { controls:1, showinfo: 0, rel: 0, showsearch: 0, iv_load_policy: 3 },
        });
    }

    function get_current_id()
    {
        var element = $(".video-item").first();
        currently_played = $(element).data('video');
        set_active(currently_played);
        return currently_played;
    }

    function set_active(id)
    {
        $(".video-wrapper .video-item").removeClass('video-active');
        $(".video-wrapper .video-item[data-video='" + id + "']").addClass('video-active');
    }

    function license_notice()
    {
        $('.notice').on('click', '.close-button', function()
        {
            $(this).parent().slideUp();

            $.ajax({
                url : ajaxurl,
                data: {
                    action : 'dismiss_license_notice',
                }
            });
        });
    }

    function do_plugin_update_notice()
    {
        var element = $('.plugin-need-update');

        if ( element.length ) 
        {
            element.each(function()
            {
                var parent  = $(this).parent(),
                    id      = parent.attr('aria-labelledby');

                $('h3#' + id).find('span.flag.update').addClass('active');
            });
        }
    }

    // Ready function
    function do_ready() {
        review_metabox();
        page_metabox();
        license_notice();
        do_tooltip();
        do_accordion();
        do_copy_system_report();
        scroll_to_action_plugin();
        do_ajax_install_plugin();
        do_accordion_plugin();
        do_plugin_update_notice();
        do_documentation_plugin();

        jnews.import.init();
    }

    $(document).ready(do_ready);
})(jQuery);