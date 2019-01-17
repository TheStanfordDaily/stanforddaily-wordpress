(function($){
    $('document').ready(function()
    {
        var container       = $("#widgets-right, #menu-management, #edittag"),
            dependencies    = [];

        var repositioning_block = function () {
            var woh = $(".widget-overlay-wrapper").height();
            var wh = $(window).height();
            $(".widget-overlay-wrapper").css({
                'top' : ( wh - woh ) / 2
            });
        };

        var noduplicate = function(text){
            var duplicated = 0;
            $(".widget-content-wrapper li span").each(function(){
                var widgetname = $(this).text();
                if(widgetname.toLowerCase() === text.toLowerCase()) {
                    duplicated++;
                }
            });

            return ( duplicated === 0 ) ? true : false;
        };

        $(".widget-overlay .close").bind('click', function(){
            $(".widget-overlay").fadeOut();
        });

        $(".addwidgetconfirm").bind('click', function(){
            var text = $(".textwidgetconfirm").val();

            if(text !== '' && noduplicate(text)) {
                var template = "<li><span>" + text + "</span><input type='hidden' name='widgetlist[]' value='" + text + "'><div class='remove fa fa-ban'></div></li>";
                $(".widget-content-wrapper ul").append(template);
                $(".textwidgetconfirm").val('');
            }

            // show list
            $(".widget-adding-content").hide();
            $(".widget-content-list").show();
        });

        $(".addwidget").bind('click', function(){
            $(".widget-adding-content").show();
            $(".widget-content-list").hide();
            $(".textwidgetconfirm").val('');
        });

        $(".widget-overlay").on('click', '.widget-content-wrapper .remove', function(){
            var element = this;
            var parent = $(this).parents('li');
            $(parent).fadeOut(function(){
                $(parent).remove();
            });
        });

        $(".sidebarwidget").bind('click', function(){
            $(".widget-overlay").fadeIn();

            if($(".widget-content-wrapper li").length === 0) {
                $(".widget-adding-content").show();
                $(".widget-content-list").hide();
            } else {
                $(".widget-adding-content").hide();
                $(".widget-content-list").show();
            }

            repositioning_block();
        });

        if ( $(".linkedin-oauth-code-enable").length ) 
        {
            setTimeout(function() 
            {
                $(".sidebarwidget").trigger('click');
            }, 100);

            $(".linkedin-oauth-code input").bind('click', function(e){
                e.preventDefault();

                $(this).focus().select();

                document.execCommand('copy');

                $(this).closest('.linkedin-oauth-code').do_action_notice();
            });
        }

        $(window).bind('resize', repositioning_block);

        $(container).on('click', '.jnews_token_access', function(e)
        {
            e.preventDefault();
            var $this   = $(this),
                control = $this.closest('.widget-content'),
                app_url,
                app_prefix,
                access_token,
                datatype,
                parameter;

            if ( $this.hasClass('facebook') )
            {
                var clientid     = control.find('.type-text[data-field="fb_id"] input'),
                    clientsecret = control.find('.type-text[data-field="fb_secret"] input');

                if (clientid.length > 0 && clientsecret.length > 0) 
                {
                    clientid     = clientid.val();
                    clientsecret = clientsecret.val();
                } else {
                    control      = $this.closest('.accordion-section-content');
                    clientid     = control.find('input[data-customize-setting-link="setting(jnews_social_like_section)(jnews_option[single_social_share_fb_id])"]').val();
                    clientsecret = control.find('input[data-customize-setting-link="setting(jnews_social_like_section)(jnews_option[single_social_share_fb_secret])"]').val();
                }

                parameter = {
                    'client_id'     : clientid,
                    'client_secret' : clientsecret,
                    'grant_type'    : 'client_credentials'
                };

                app_url    = 'https://graph.facebook.com/oauth/access_token';
                app_prefix = 'fb';
            }

            if ( $this.hasClass('linkedin') )
            {
                var grab_url = 'https://www.linkedin.com/oauth/v2/accessToken?grant_type=authorization_code&code=' + control.find('.type-text[data-field="linkedin_code"] input').val() + '&redirect_uri=' + window.location + '&client_id=' + control.find('.type-text[data-field="linkedin_id"] input').val() + '&client_secret=' + control.find('.type-text[data-field="linkedin_secret"] input').val();
                
                parameter = {
                    'action'        : 'jnews_scrap_data_social_counter',
                    'social_type'   : 'linkedin_token',
                    'social_grab'   : grab_url
                };

                app_url    = ajaxurl;
                app_prefix = 'linkedin';
                datatype   = 'json';
            }

            $.ajax({
                url: app_url,
                data: parameter,
                dataType: datatype,
                type: 'POST',
                beforeSend: function( jqXHR ) {
                    $this.parent().find('.jnews-spinner').addClass('active');
                }
            }).done(function( data, textStatus, jqXHR ) 
            {
                if ( app_prefix == 'fb' ) 
                {
                    access_token = data.access_token;
                }

                if ( app_prefix == 'linkedin' ) 
                {
                    access_token = data.token;
                }

                if ( control.hasClass('accordion-section-content') )
                {
                    control.find('input[data-customize-setting-link="setting(jnews_social_like_section)(jnews_option[single_social_share_fb_token])"]').val(access_token);
                } else {
                    control.find('.type-text[data-field="' + app_prefix + '_key"] input').val(access_token);                    
                }

            }).fail(function( jqXHR, textStatus, errorThrown ) 
            {
                window.alert( 'Info Message: ' + errorThrown );
            }).always(function( data, textStatus, jqXHR ) 
            {
                $this.parent().find('.jnews-spinner').removeClass('active');
            });
        });

        $(container).on('click', '.jnews_oauth_code', function(e)
        {
            e.preventDefault();
            var container  = $(this).closest('.widget-content'),
                app_id     = container.find('.type-text[data-field="linkedin_id"] input').val(),
                state      = new Date().getTime(),
                app_url    = 'https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=' + app_id + '&scope=r_basicprofile&state=' + state + '&redirect_uri=' + window.location;

            var win = window.open(app_url, '_blank');
            win.focus();
        });

        $(container).on('click', '.jnews_instagram_access_token', function(e)
        {
            e.preventDefault();
            var element    = $(this),
                container  = element.closest('.widget-content'),
                redirect   = element.attr('href'),
                app_id     = container.find('.type-text[data-field="clientid"] input'),
                app_url    = '';

            if ( app_id.length > 0 )
            {
                app_id = app_id.val();
            } else {
                app_id = element.closest('.accordion-section-content').find('input[data-customize-setting-link="setting(jnews_instagram_feed_section)(jnews_option[footer_instagram_clientid])"]').val();
            }

            app_url = 'https://api.instagram.com/oauth/authorize/?client_id=' + app_id + '&redirect_uri=' + redirect + '&response_type=token';

            var win = window.open(app_url, '_blank');
            win.focus();
        });

        var instagram_access_token = function()
        {
            if (window.location.href.indexOf("#access_token=") > -1)
            {
                var token = window.location.href.split('#access_token=')[1];

                prompt("Your Instagram Access Token:", token);
            }
        }

        instagram_access_token();

        var dependency_check = function(dependencies)
        {   
            for (var i = 0; i < dependencies.length; i++) 
            {
                var data    = dependencies[i],
                    element = data.element,
                    prefix  = element.replace(data.field, '');

                dependency_action(data);

                for (var j = 0; j < data.dep.length; j++)
                {
                    var target  = data.dep[j],
                        id      = prefix + target.field;

                    if ( is_category_editor() ) 
                    {
                        id = target.field + prefix;
                    }

                    dependency_event(id, data);
                }
            }
        };

        var dependency_event = function(id, data)
        {
            $('[id=' + id + ']').on('change', function()
            {
                dependency_action(data);
            });
        };

        var dependency_action = function(data)
        {
            var element = data.element,
                prefix  = element.replace(data.field, ''),
                parent  = $('[id='+ data.element +']').parents('.widget-wrapper'),
                flag    = true;

            for (var i = 0; i < data.dep.length; i++) 
            {
                var target  = data.dep[i],
                    id      = prefix + target.field;

                    if ( is_category_editor() ) 
                    {
                        id = target.field + prefix;
                    }

                var element = $('[id='+ id +']'),
                    type    = element.attr('type'),
                    value   = false;

                if ( type == 'checkbox' ) 
                {
                    value = element.is(':checked');
                }

                if ( type == 'select' ) 
                {
                    value = element.val();
                }

                if ( type == 'hidden' ) 
                {
                    value = element.attr('value');
                }

                if ( type == 'radio-image' ) 
                {
                    value = element.find('input[type=radio]:checked').val();
                }

                compare = dependency_compare(target.operator, target.value, value);
                
                if ( ! compare ) flag = false;
            }

            if ( flag ) 
            {
                parent.addClass('jeg-dep-show').removeClass('jeg-dep-hide');
            } else {
                parent.addClass('jeg-dep-hide').removeClass('jeg-dep-show');
            }
        };

        var is_category_editor = function()
        {
            if ( $('#edittag').length ) 
            {
                return true;
            }

            return false;
        };

        var recursive_accordion = function(element, flag)
        {
            var next = $(element).next();
            if ( next.length === 0 ) return;

            if ( next.hasClass('jeg_accordion_wrapper') )
            {
                if ( flag )
                {
                    next.slideDown('fast');
                } else {
                    next.slideUp('fast');
                }
                recursive_accordion(next, flag)
            }
        };

        var override_category_setting = function( element )
        {
            var flag = false;           

            if ( element.is(':checked') ) 
            {
                flag = true;
            }

            recursive_accordion( element.parent(), flag );
        };

        var dependency_compare = function(operator, value1, value2)
        {
            if ( operator === '===' ) 
            {
                return value1 === value2;
            }

            if ( operator === '=' || operator === '==' ) 
            {
                return value1 == value2;
            }

            if ( operator === '!==' ) 
            {
                return value1 !== value2;
            }

            if ( operator === '!=' ) 
            {
                return value1 != value2;
            }

            if ( operator === '>=' ) 
            {
                return value1 >= value2;
            }

            if ( operator === '<=' ) 
            {
                return value1 <= value2;
            }

            if ( operator === '>' ) 
            {
                return value1 > value2;
            }

            if ( operator === '<' ) 
            {
                return value1 < value2;
            }

            if ( operator === 'in' ) 
            {
                var result = value1.indexOf(value2);
                return result >= 0;
            }

            if ( operator === 'ex' ) 
            {
                var result = value1.indexOf(value2);
                return result < 0;
            }
        };

        // widget script
        window.widget_script = function(wrapper)
        {
            container = ( wrapper === undefined ) ? container : wrapper;

            $(container).find('input[name^="category_override"]').change( function()
            {
                override_category_setting( $(this) );
            });

            $(container).find('input[name^="category_override"]').each( function()
            {
                override_category_setting( $(this) );
            });

            $(container).find('.widget-wrapper').each( function()
            {
                var element = $(this),
                    id      = element.find('label').attr('for'),
                    field   = element.attr('data-field'),
                    dep     = element.attr('data-dependency');

                if ( ! element.hasClass('jeg-dep-bind') )
                {
                    if ( typeof dep !== 'undefined' && dep !== false ) 
                    {   
                        dep = JSON.parse(dep);
                        
                        dependencies.push({dep: dep, field: field, element: id});

                        element.addClass('jeg-dep-bind');
                    }
                }                
            });

            dependency_check(dependencies);

            // color
            $(container).find('.jnews-color-picker-clone').each(function()
            {
                var element = $(this),
                    width   = 250,
                    parent  = $(this).parents('.widget-wrapper').get(0),
                    input   = $(parent).find('.jnews-color-picker');


                if ( $('#customize-controls').length ) width = 200;

                element.wpColorPicker({
                    change: function( event, ui )
                    {
                        var color = ui.color.toString();
                        $(input).val(color).trigger('change');
                    },
                    clear: function () {
                        $(input).val('').trigger('change');
                    },
                    width: width
                });
            });

            // slider
            $(container).find('.type-slider').each(function()
            {
                var element = $(this).find('input[type=range]'),
                    value   = element.attr('value');

                element.closest('div').find('.jnews_range_value .value').text(value);

                element.on('mousedown', function()
                {
                    $(this).mousemove( function() 
                    {
                        var value = $(this).attr('value');
                        $(this).closest('div').find('.jnews_range_value .value').text(value);
                    });
                });

                element.click( function() 
                {
                    var value = $(this).attr('value');
                    $(this).closest('div').find('.jnews_range_value .value').text(value);
                });

                $(this).find('.jnews-slider-reset').click( function() 
                {
                    thisInput    = $(this).closest('div.wrapper').find('input');
                    inputDefault = thisInput.data('reset_value');
                    thisInput.val(inputDefault);
                    thisInput.change();

                    $(this).closest('div.wrapper').find('.jnews_range_value .value').text(inputDefault);
                });
            });

            // image upload
            $(container).find(".button-image-text").unbind('click');
            $(container).find(".button-image-text").bind('click', function(){

                var element             = this;
                var mode                = $(this).attr('data-toggle');
                var removebutton        = $(this).data('remove');
                var addbutton           = $(this).data('add');
                var parent              = $(this).parents('.image-content');
                var imagewrapper        = $(parent).find('.image-wrapper');
                var imageinput          = $(parent).find('.image-input');

                var media_uploader = wp.media({
                    frame:    "post",
                    state:    "insert",
                    multiple: false
                });

                var add_image = function(image){
                    $(element).attr('data-toggle', 1);
                    $(element).attr('value', removebutton);
                    $(imagewrapper).removeClass('hide_image');
                    $(imagewrapper).find('img').attr('src', image.url);
                    $(imageinput).val(image.id).change();
                    $(element).trigger('propertychange');
                };

                var remove_image = function(){
                    $(element).attr('data-toggle', 0);
                    $(element).attr('value', addbutton);
                    $(imagewrapper).addClass('hide_image');
                    $(imageinput).val('').change();
                    $(element).trigger('propertychange');
                };

                if(mode == '1')
                {
                    remove_image();
                } else {

                    media_uploader.on("insert", function(){
                        var json = media_uploader.state().get("selection").first().toJSON();
                        add_image(json);
                        media_uploader.close();
                    });

                    media_uploader.open();
                }
            });

            // number
            $(container).find('.type-number input[type=text]' ).each(function(){
                var element = this,
                    min     = $(this).attr('min'),
                    max     = $(this).attr('max'),
                    step    = $(this).attr('step');

                $( element ).spinner({
                    min: min,
                    max: max,
                    step: step,
                    stop: function(){
                        // console.log('hitting here...');
                        $(element).trigger('change');
                    }
                });
            });

            // multi select
            var $multiselect = $(container).find('.multiselect-wrapper input.input-sortable');

            $multiselect.each(function()
            {
                if($(this).hasClass('selectized')) {
                    // do nothing
                } else {
                    var $parent = $(this).parent();
                    var options = $parent.find('.data-option');

                    if(options.length)
                    {
                        options = JSON.parse(options.text());

                        $(this).selectize({
                            plugins: ['drag_drop', 'remove_button'],
                            options: options,
                            persist: true,
                            create: true,
                            hideSelected: false,
                            render: {
                                option: function(item, escape) {
                                    return '<div class="' + item.class + '"><span>' + item.text + '</span></div>';
                                }
                            }
                        });
                    }
                }
            });

            // multi post
            var $multipost = $(container).find('.multipost-wrapper input.input-sortable');

            $multipost.each(function()
            {
                if ($(this).hasClass('selectized')) {
                    // do nothing
                } else {
                    var $parent = $(this).parent();
                    var options = $parent.find('.data-option');
                    options = JSON.parse(options.text());

                    $(this).selectize({
                        plugins: ['drag_drop', 'remove_button'],
                        persist: true,
                        create: true,
                        hideSelected: true,
                        valueField: 'value',
                        labelField: 'value',
                        options: options,
                        render: {
                            option: function(item, escape) {
                                var text = item.text;
                                if(text === undefined) {
                                    return '<div><span>' + item.value + '</span></div>';
                                } else {
                                    return '<div><span>' + text + '</span></div>';
                                }
                            }
                        },
                        load: function(query, callback) {
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
            });

            // multi post
            var $multitag = $(container).find('.multitag-wrapper input.input-sortable');

            $multitag.each(function()
            {
                if ($(this).hasClass('selectized')) {
                    // do nothing
                } else {
                    var $parent = $(this).parent();
                    var options = $parent.find('.data-option');
                    options = JSON.parse(options.text());

                    $(this).selectize({
                        plugins: ['drag_drop', 'remove_button'],
                        persist: true,
                        create: true,
                        hideSelected: true,
                        valueField: 'value',
                        labelField: 'text',
                        options: options,
                        render: {
                            option: function(item, escape) {
                                var text = item.text;
                                if(text === undefined) {
                                    return '<div><span>' + item.value + '</span></div>';
                                } else {
                                    return '<div><span>' + text + '</span></div>';
                                }
                            }
                        },
                        load: function(query, callback) {
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
                    });
                }
            });

            // multi author
            var $multiauthor = $(container).find('.multiauthor-wrapper input.input-sortable');

            $multiauthor.each(function()
            {
                if($(this).hasClass('selectized')) {
                    // do nothing
                } else {
                    var $this           = $(this),
                        $parent         = $this.parent(),
                        options         = $parent.find('.data-option'),
                        ajax_load       = false;

                        if ( $this.hasClass('jeg-ajax-load') ) 
                        {
                            ajax_load = true;
                        }

                    if(options.length)
                    {
                        options = JSON.parse(options.text());

                        $(this).selectize({
                            plugins: ['drag_drop', 'remove_button'],
                            options: options,
                            persist: true,
                            create: true,
                            hideSelected: true,
                            valueField: 'value',
                            labelField: 'text',
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
                }
            });

            // repeater
            $(container).find('.jeg-repeater-wrapper').each(function()
            {
                $(this).jeg_repeater();
            });

        };

        $.fn.jeg_repeater = function()
        {
            var control = this;

            var limit, theNewRow, settingValue;

            control.row_label = JSON.parse( control.find('.repeater-value').attr('data-label') );

            control.fields    = JSON.parse( control.find('.repeater-value').attr('data-field') );

            control.value     = control.find('.repeater-value').val();

            control.selector  = control.context.id;

            control.setting   = null;

            settingValue      = JSON.parse( decodeURIComponent( control.value ) );

            control.settingField = control.find( '[data-customize-setting-link]' ).first();

            setValue( control, [], false );

            control.find( '.repeater-fields' ).first().html('');

            control.repeaterFieldsContainer = control.find( '.repeater-fields' ).first();

            control.currentIndex = 0;

            control.rows = [];

            limit = false;

            control.unbind('click');
            control.on( 'click', 'button.repeater-add', function( e )
            {
                e.preventDefault();
                if ( ! limit || control.currentIndex < limit )
                {
                    theNewRow = addRow( control );
                    theNewRow.toggleMinimize();
                    initDropdownPages( control, theNewRow );
                } else {
                    $( control.selector + ' .limit' ).addClass( 'highlight' );
                }
            });

            control.on( 'click', '.repeater-row-remove', function( e )
            {
                control.currentIndex--;
                if ( ! limit || control.currentIndex < limit )
                {
                    $( control.selector + ' .limit' ).removeClass( 'highlight' );
                }
            });

            /**
             * Function that loads the Mustache template
             */
            control.repeaterTemplate = _.memoize( function()
            {
                var compiled,
                    /*
                     * Underscore's default ERB-style templates are incompatible with PHP
                     * when asp_tags is enabled, so WordPress uses Mustache-inspired templating syntax.
                     *
                     * @see trac ticket #22344.
                     */
                    options = {
                        evaluate: /<#([\s\S]+?)#>/g,
                        interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
                        escape: /\{\{([^\}]+?)\}\}(?!\})/g,
                        variable: 'data'
                    };

                return function( data )
                {
                    compiled = _.template( control.find( '.customize-control-repeater-content' ).first().html(), null, options );
                    return compiled( data );
                };
            });

            // When we load the control, the fields have not been filled up
            // This is the first time that we create all the rows
            if ( settingValue.length )
            {
                _.each( settingValue, function( subValue )
                {
                    theNewRow = addRow( control, subValue );
                    // control.initColorPicker();
                    initDropdownPages( control, theNewRow, subValue );
                });
            }

            // Once we have displayed the rows, we cleanup the values
            setValue( control, settingValue, true, true );

            control.repeaterFieldsContainer.sortable({
                handle: '.repeater-row-header',
                update: function( e, ui )
                {
                    repeaterSort( control );
                }
            });
        };

        var setValue = function( element, newValue, refresh, filtering )
        {
            var filteredValue = newValue,
                filter        = [];

            if ( filtering )
            {
                $.each( element.fields, function( index, value )
                {
                    if ( 'image' === value.type || 'cropped_image' === value.type || 'upload' === value.type )
                    {
                        filter.push( index );
                    }
                });

                $.each( newValue, function( index, value )
                {
                    $.each( filter, function( ind, field )
                    {
                        if ( 'undefined' !== typeof value[field] && 'undefined' !== typeof value[field].id )
                        {
                            filteredValue[index][field] = value[field].id;
                        }
                    });
                });
            }

            element.setting = ( encodeURIComponent( JSON.stringify( filteredValue ) ) );
            element.find('.repeater-value').val(element.setting);
        };

        var getValue = function( element )
        {
            return JSON.parse( decodeURIComponent( element.setting ) );
        };

        var addRow = function( element, data )
        {
            var control       = element,
                template      = control.repeaterTemplate(), // The template for the new row (defined on render_content() ).
                settingValue  = getValue(element), // Get the current setting value.
                newRowSetting = {}, // Saves the new setting data.
                templateData, // Data to pass to the template
                newRow,
                i;

            if ( template )
            {

                // The control structure is going to define the new fields
                // We need to clone control.params.fields. Assigning it
                // ould result in a reference assignment.
                templateData = jQuery.extend( true, {}, control.fields );

                // But if we have passed data, we'll use the data values instead
                if ( data )
                {
                    for ( i in data ) {
                        if ( data.hasOwnProperty( i ) && templateData.hasOwnProperty( i ) )
                        {
                            templateData[ i ]['default'] = data[ i ];
                        }
                    }
                }

                templateData.index = element.currentIndex;

                // Append the template content
                template = template( templateData );

                // Create a new row object and append the element
                newRow = new RepeaterRow(
                    control.currentIndex,
                    jQuery( template ).appendTo( control.repeaterFieldsContainer ),
                    control.row_label
                );

                newRow.container.on( 'row:remove', function( e, rowIndex )
                {
                    deleteRow( control, rowIndex );
                });

                newRow.container.on( 'row:update', function( e, rowIndex, fieldName, element )
                {
                    updateField.call( control, e, rowIndex, fieldName, element );
                    newRow.updateLabel();
                });

                // Add the row to rows collection
                element.rows[ element.currentIndex ] = newRow;

                for ( i in templateData )
                {
                    if ( templateData.hasOwnProperty( i ) )
                    {
                        newRowSetting[ i ] = templateData[ i ]['default'];
                    }
                }

                settingValue[ element.currentIndex ] = newRowSetting;
                setValue(element, settingValue, true );

                element.currentIndex++;

                return newRow;
            }
        };

        var repeaterSort = function( element )
        {
            var control     = element,
                $rows       = element.repeaterFieldsContainer.find( '.repeater-row' ),
                newOrder    = [],
                settings    = getValue(control),
                newRows     = [],
                newSettings = [];

            $rows.each( function( i, element )
            {
                newOrder.push( jQuery( element ).data( 'row' ) );
            });

            jQuery.each( newOrder, function( newPosition, oldPosition )
            {
                newRows[ newPosition ] = control.rows[ oldPosition ];
                newRows[ newPosition ].setRowIndex( newPosition );

                newSettings[ newPosition ] = settings[ oldPosition ];
            });

            control.rows = newRows;
            setValue( control, newSettings );
        };

        var deleteRow = function( element, index )
        {
            var currentSettings = getValue(element),
                row,
                i,
                prop;

            if ( currentSettings[ index ] )
            {
                row = element.rows[ index ];
                if ( row ) {

                    // Remove the row settings
                    currentSettings.splice(index, 1);

                    // Remove the row from the rows collection
                    delete element.rows[ index ];

                    // Update the new setting values
                    setValue( element, currentSettings, true );
                }
            }

            // Remap the row numbers
            i = 1;
            for ( prop in element.rows )
            {
                if ( element.rows.hasOwnProperty( prop ) && element.rows[ prop ] )
                {
                    element.rows[ prop ].updateLabel();
                    i++;
                }
            }
        };

        var updateField = function( e, rowIndex, fieldId, element )
        {
            var type,
                row,
                currentSettings;

            if ( ! this.rows[ rowIndex ] )
            {
                return;
            }

            if ( ! this.fields [ fieldId ] )
            {
                return;
            }

            type            = this.fields[ fieldId].type;
            row             = this.rows[ rowIndex ];
            currentSettings = getValue(this);

            element = jQuery( element );

            if ( undefined === typeof currentSettings[ row.rowIndex ][ fieldId ] )
            {
                return;
            }

            if ( 'checkbox' === type )
            {
                currentSettings[ row.rowIndex ][ fieldId ] = element.is( ':checked' );
            } else {
                currentSettings[ row.rowIndex ][ fieldId ] = element.val();
            }

            setValue( this, currentSettings, true );
        };

        var initDropdownPages = function( element, theNewRow, data )
        {
            var control  = element,
                dropdown = theNewRow.container.find( '.repeater-dropdown-pages select' ),
                $select,
                selectize,
                dataField;

            if ( 0 === dropdown.length )
            {
                return;
            }

            $select   = jQuery( dropdown ).selectize();
            selectize = $select[0].selectize;
            dataField = dropdown.data( 'field' );

            if ( data )
            {
                setValue( selectize, data[dataField] );
            }

            element.container.on( 'change', '.repeater-dropdown-pages select', function( event )
            {
                var currentDropdown = jQuery( event.target ),
                    row             = currentDropdown.closest( '.repeater-row' ),
                    rowIndex        = row.data( 'row' ),
                    currentSettings = getValue(control);

                currentSettings[ rowIndex ][ currentDropdown.data( 'field' ) ] = jQuery( element ).val();
                setValue( control, currentSettings );
            });
        };

        var RepeaterRow = function( rowIndex, container, label )
        {
            var self        = this;

            this.rowIndex   = rowIndex;
            this.container  = container;
            this.label      = label;
            this.header     = this.container.find( '.repeater-row-header' );

                this.header.on( 'click', function()
                {
                    self.toggleMinimize();
                });

            this.container.on( 'click', '.repeater-row-remove', function()
            {
                self.remove();
            });

            this.header.on( 'mousedown', function()
            {
                self.container.trigger( 'row:start-dragging' );
            });

            this.container.on( 'keyup change', 'input, select, textarea', function( e )
            {
                self.container.trigger( 'row:update', [ self.rowIndex, jQuery( e.target ).data( 'field' ), e.target ] );
            });

            this.setRowIndex = function( rowIndex )
            {
                this.rowIndex = rowIndex;
                this.container.attr( 'data-row', rowIndex );
                this.container.data( 'row', rowIndex );
                this.updateLabel();
            };

            this.toggleMinimize = function()
            {
                if ( this.container.hasClass( 'minimized' ) )
                {
                    this.container.find('.repeater-row-content').slideDown('fast');
                } else {
                    this.container.find('.repeater-row-content').slideUp('fast');
                }

                this.container.toggleClass( 'minimized' );
                this.header.find( '.dashicons' ).toggleClass( 'dashicons-arrow-up' ).toggleClass( 'dashicons-arrow-down' );
            };

            this.remove = function()
            {
                this.container.slideUp( 300, function() {
                    jQuery( this ).detach();
                });
                this.container.trigger( 'row:remove', [ this.rowIndex ] );
            };

            this.updateLabel = function()
            {
                var rowLabelField,
                    rowLabel;

                if ( 'field' === this.label.type )
                {
                    rowLabelField = this.container.find( '.repeater-field [data-field="' + this.label.field + '"]' );
                    if ( 'function' === typeof rowLabelField.val )
                    {
                        rowLabel = rowLabelField.val();
                        if ( '' !== rowLabel )
                        {
                            this.header.find( '.repeater-row-label' ).text( rowLabel );
                            return;
                        }
                    }
                }
                this.header.find( '.repeater-row-label' ).text( this.label.value + ' ' + ( this.rowIndex + 1 ) );
            };

            this.updateLabel();
        };

        $(document).ajaxComplete(function()
        {
            widget_script();
        });

        $('#customize-controls').on('click', '.widget-top', function()
        {
            widget_script();
        });

        $('#available-widgets-list .widget-tpl').on('click', function()
        {
            setTimeout(function()
            {
                widget_script();
            }, 100);
        });

        widget_script();
    });
})(jQuery);