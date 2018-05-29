(function($){


    /* hook every widget **/
    function attach_widget()
    {
        $.each(jnews_elementor.widgets, function(index, widget)
        {
            var action = 'panel/widgets/wp-widget-' + widget + '/controls/wp_widget/loaded';
            elementor.hooks.addAction( action , function( panel ) {
                do_accordion(panel);
                window.widget_script(panel.$el);
            });
        });
    }

    function instagram_feed_element()
    {
        elementor.hooks.addAction( 'panel/open_editor/widget/wp-widget-jnews_instagram' , function( panel )
        {
            instagram_token(panel);
        });

        elementor.hooks.addAction( 'panel/open_editor/widget/jnews_footer_instagram_elementor' , function( panel )
        {
            instagram_token(panel);
        });
    }

    function instagram_token(panel)
    {
        $(panel.$el).on('click', '.jnews_instagram_access_token', function(e)
        {
            e.preventDefault();

            var element    = $(this),
                container  = element.parents('#elementor-controls'),
                redirect   = element.attr('href'),
                app_id     = container.find('.type-text[data-field="clientid"] input');

            if ( app_id.length > 0 )
            {
                app_id = app_id.val();
            } else {
                app_id = container.find('input[data-setting="clientid"]').val();
            }

            var app_url = 'https://api.instagram.com/oauth/authorize/?client_id=' + app_id + '&redirect_uri=' + redirect + '&response_type=token';


            var win = window.open(app_url, '_blank');
            win.focus();
        });
    }

    function socialcounter_element()
    {
        elementor.hooks.addAction( 'panel/open_editor/widget/socialcounter' , function( panel )
        {
            facebook_token(panel);
        });
    }

    function facebook_token(panel)
    {
        $(panel.$el).on('click', '.jnews_token_access.facebook', function(e)
        {
            e.preventDefault();

            var $this   = $(this),
                control = $this.parents('#elementor-controls'),
                app_url = 'https://graph.facebook.com/oauth/access_token',
                access_token,
                parameter = {
                    'client_id'     : control.find('.elementor-control-fb_id input').val(),
                    'client_secret' : control.find('.elementor-control-fb_secret input').val(),
                    'grant_type'    : 'client_credentials'
                };

            $.ajax({
                url         : app_url,
                data        : parameter,
                dataType    : 'json',
                type        : 'POST',
                beforeSend  : function( jqXHR )
                {
                    $this.parent().find('.jnews-spinner').addClass('active');
                }
            }).done(function( data, textStatus, jqXHR )
            {
                access_token = data.access_token;

                control.find('.elementor-control-fb_key input').val(access_token);

            }).fail(function( jqXHR, textStatus, errorThrown )
            {
                window.alert( 'Info Message: ' + errorThrown );
            }).always(function( data, textStatus, jqXHR )
            {
                $this.parent().find('.jnews-spinner').removeClass('active');
            });
        });
    }

    function do_accordion(panel)
    {
        $(panel.$el).find('.jeg_accordion_heading').on('click' , function(e){
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

    window.open_control = function(control)
    {
        var wrapper = control.parent();

        if ( wrapper.hasClass('type-multicategory') )
        {
            multicategory_control(wrapper);
        }
        else if ( wrapper.hasClass('type-multitag') )
        {
            multitag_control(wrapper);
        }
        else if ( wrapper.hasClass('type-multipost') )
        {
            multipost_control(wrapper);
        }
        else if ( wrapper.hasClass('type-multiauthor') )
        {
            multiauthor_control(wrapper);
        }
        else if ( wrapper.hasClass('type-multiproduct') )
        {
            multiproduct_control(wrapper);
        }

        wrapper.find('input.input-sortable').on('change', function()
        {
            $(this).trigger('input');
        });
    };

    function multiauthor_control(element)
    {
        var options     = element.find('.data-option'),
            ajax_load   = false;

        options = JSON.parse(options.text());

        if ( element.find('input.input-sortable').hasClass('jeg-ajax-load') )
        {
            ajax_load = true;
        }

        element.find('input.input-sortable').selectize({
            plugins: ['drag_drop', 'remove_button'],
            persist: true,
            create: false,
            hideSelected: true,
            valueField: 'value',
            labelField: 'text',
            options: options,
            render: {
                option: function(item, escape)
                {
                    var text = item.text;
                    if ( ajax_load )
                    {
                        if ( text === undefined )
                        {
                            return '<div><span>' + item.value + '</span></div>';
                        } else {
                            return '<div><span>' + text + '</span></div>';
                        }
                    } else {
                        return '<div class="' + item.class + '"><span>' + item.text + '</span></div>';
                    }
                }
            },
            load: function(query, callback)
            {
                if ( ajax_load )
                {
                    if (!query.length || query.length < 3) return callback();
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            'string' : encodeURIComponent(query),
                            'action'  : 'jeg_find_author'
                        },
                        error: function() {
                            callback();
                        },
                        success: function(res) {
                            callback(res);
                        }
                    });
                }
            }
        });
    }

    function multiproduct_control(element)
    {
        var options = element.find('.data-option');
        options = JSON.parse(options.text());

        element.find('input.input-sortable').selectize({
            plugins: ['drag_drop', 'remove_button'],
            persist: true,
            create: true,
            hideSelected: true,
            valueField: 'value',
            labelField: 'text',
            options: options,
            render: {
                option: function(item)
                {
                    var text = item.text;
                    if(text === undefined)
                    {
                        return '<div><span>' + item.value + '</span></div>';
                    } else {
                        return '<div><span>' + text + '</span></div>';
                    }
                }
            }
        });
    }

    function multipost_control(element)
    {
        var options = element.find('.data-option');
            options = JSON.parse(options.text());

        element.find('input.input-sortable').selectize({
            plugins: ['drag_drop', 'remove_button'],
            persist: true,
            create: true,
            hideSelected: true,
            valueField: 'value',
            labelField: 'value',
            options: options,
            render: {
                option: function(item, escape)
                {
                    var text = item.text;
                    if(text === undefined)
                    {
                        return '<div><span>' + item.value + '</span></div>';
                    } else {
                        return '<div><span>' + text + '</span></div>';
                    }
                }
            },
            load: function(query, callback)
            {
                if (!query.length || query.length < 3) return callback();
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'string' : encodeURIComponent(query),
                        'action'  : 'jeg_find_post'
                    },
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback(res);
                    }
                });
            }
        });
    }

    function multitag_control(element)
    {
        var options     = element.find('.data-option'),
            ajax_load   = false;

            options = JSON.parse(options.text());

        if ( element.find('input.input-sortable').hasClass('jeg-ajax-load') )
        {
            ajax_load = true;
        }

        element.find('input.input-sortable').selectize({
            plugins: ['drag_drop', 'remove_button'],
            persist: true,
            create: true,
            hideSelected: true,
            valueField: 'value',
            labelField: 'text',
            options: options,
            render: {
                option: function(item, escape)
                {
                    var text = item.text;
                    if ( ajax_load )
                    {
                        if ( text === undefined )
                        {
                            return '<div><span>' + item.value + '</span></div>';
                        } else {
                            return '<div><span>' + text + '</span></div>';
                        }
                    } else {
                        return '<div class="' + item.class + '"><span>' + item.text + '</span></div>';
                    }
                }
            },
            load: function(query, callback)
            {
                if ( ajax_load )
                {
                    if (!query.length || query.length < 3) return callback();
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            'string' : encodeURIComponent(query),
                            'action'  : 'jeg_find_post_tag'
                        },
                        error: function() {
                            callback();
                        },
                        success: function(res) {
                            callback(res);
                        }
                    });
                }
            }
        });
    }

    function multicategory_control(element)
    {
        var options = element.find('.data-option');
            options = JSON.parse(options.text());

        element.find('input.input-sortable').selectize({
            plugins: ['drag_drop', 'remove_button'],
            options: options,
            persist: true,
            create: true,
            hideSelected: true,
            render: {
                option: function(item)
                {
                    return '<div class="' + item.class + '"><span>' + item.text + '</span></div>';
                }
            }
        });
    }

    function enable_droppable_sticky()
    {
        elementor.hooks.addFilter( 'elements/column/render/droppable-item-selector' , function( selector ) {
            return "> .jegStickyHolder > .theiaStickySidebar > .elementor-column-wrap > .elementor-widget-wrap > .elementor-element, > .jegStickyHolder > .theiaStickySidebar >.elementor-column-wrap > .elementor-widget-wrap > .elementor-empty-view > .elementor-first-add, " + selector;
        });
    }

    function get_column_width(width)
    {
        var column = 12;

        if(width < 34) {
            column = 4;
        } else if(width < 67) {
            column = 8;
        } else {
            column = 12;
        }

        return column;
    }

    function calculate_column_width()
    {
        var column = 12;

        elementor.channels.data.on( 'column:before:drop', function(event)
        {
            var width = $(event.delegateTarget).data('col');
            column = get_column_width(width);
        });

        $.ajaxPrefilter(function(options, originalOptions, jqXHR)
        {
            if(originalOptions.data.action === 'elementor_ajax')
            {
                var option  = JSON.parse(originalOptions.data.actions),
                    data    = Object.values(option)[0];

                if ( data.action === 'render_widget' )
                {
                    var element = $(elementor.$previewContents.get(0).activeElement).find("[data-id='" + data.data.data.id + "']");

                    if(element.length > 0)
                    {
                        var width = $(element).parents('.elementor-column').data('col');
                        column = get_column_width(width);
                    }

                    options.data += "&colwidth=" + column;
                }
            }

            column = 12;
        });

    }

    function open_control_handler()
    {
        elementor.hooks.addAction( 'panel/open_editor/widget' , function( panel )
        {
            var control = $(panel.$el).find('.elementor-control-input-wrapper > input');

            control.each(function()
            {
                window.open_control($(this));
            });
        });
    }

    function sticky_sidebar()
    {
        elementor.hooks.addFilter( 'editor/style/styleText', function(css, element)
        {
            setTimeout(function()
            {
                var $wrapper = $(element.$el);

                if($wrapper.hasClass('elementor-column'))
                {
                    var stickyClass = $wrapper.find('.theiaStickySidebar');

                    if($wrapper.hasClass('jeg_sticky_sidebar'))
                    {
                        $wrapper.theiaStickySidebar({ additionalMarginTop: 20 });
                        $wrapper.trigger('theiaStickySidebarActivate');
                    } else {
                        $wrapper.trigger('theiaStickySidebarDeactivate');
                    }
                }
            }, 500);
        });
    }

    function do_ready()
    {
        attach_widget();
        open_control_handler();
        socialcounter_element();
        instagram_feed_element();
        enable_droppable_sticky();
        calculate_column_width();
        sticky_sidebar();
    }

    $(document).ready(do_ready);

})(jQuery);