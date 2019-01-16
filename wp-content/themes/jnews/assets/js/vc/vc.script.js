(function($) {

    // Multipost.js
    $('.multipost-input-wrapper input.input-sortable').each(function(){
        var $parent = $(this).parent();
        var options = $parent.find('.data-option');
        options = JSON.parse(options.text());

        $(this).selectize({
            plugins: ['drag_drop', 'remove_button'],
            persist: true,
            create: true,
            options: options,
            hideSelected: true,
            valueField: 'value',
            labelField: 'text',
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
    });

    // Multitag.js
    $('.multitag-input input.input-sortable').each(function(){
        var $this   = $(this),
            $parent = $this.parent(),
            options = $parent.find('.data-option'),
            ajax_load = false;

            options = JSON.parse(options.text());

            if ( $this.hasClass('jeg-ajax-load') ) 
            {
                ajax_load = true;
            }

        $(this).selectize({
            plugins: ['drag_drop', 'remove_button'],
            persist: true,
            options: options,
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
                            'action'  : 'jeg_find_tag'
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
    });

    // Number.js
    $( '.number-input-wrapper input[type=text]' ).each(function(){
        var element = this,
            min     = $(this).attr('min'),
            max     = $(this).attr('max'),
            step    = $(this).attr('step');

        $( element ).spinner({
            min: min,
            max: max,
            step: step
        });
    });

    // Checkblock.js
    $('.wp-tab-panel.vc_checkblock').each(function(){
        var parent = this;
        var input = $(parent).find('.wpb-input');

        $(this).find('.checkblock').bind('click', function(){
            var result = [];
            $(parent).find('.checkblock').each(function(){
                if($(this).is(":checked")) {
                    result.push($(this).val());
                }
            });
            $(input).val(result);
        });
    });

    // Multiselect.js
    $('.mulitselect-input input.input-sortable').each(function(){
        var $parent = $(this).parent();
        var options = $parent.find('.data-option');
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
    });

    // Multiauthor.js
    $('.multiauthor-input input.input-sortable').each(function(){
        var $this   = $(this),
            $parent = $this.parent(),
            options = $parent.find('.data-option'),
            options = JSON.parse(options.text()),
            ajax_load = false;

            if ( $this.hasClass('jeg-ajax-load') ) 
            {
                ajax_load = true;
            }

        $(this).selectize({
            plugins: ['drag_drop', 'remove_button'],
            persist: true,
            options: options,
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
    });

    // Radioimage.js
    window.vc.atts.radioimage = {
        init: function(param, $field) {
            $('.radio-image-wrapper label input', $field).change(function(){
                var $input = $(this).closest('.radio-image-wrapper').find('.wpb_vc_param_value');
                $input.val($(this).val()).trigger('change');
            });
        }
    };

    // Slider.js
    $('.slider-input-wrapper').each( function()
    {
        var element = $(this).find('input[type=range]');

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
            thisInput    = $(this).parent().find('input');
            inputDefault = thisInput.data('reset_value');
            thisInput.val(inputDefault);
            thisInput.change();

            $(this).parent().find('.jnews_range_value .value').text(inputDefault);
        });
    });

    // File.js
    $(".input-uploadfile").each(function(){
        var element = this;
        var input = $(element).find('input[type="text"]');

        $(this).find('.selectfileimage').bind('click', function(e){
            e.preventDefault();

            //Extend the wp.media object
            custom_uploader = wp.media.frames.file_frame = wp.media({
                multiple: false
            });

            //When a file is selected, grab the URL and set it as the text field's value
            custom_uploader.on('select', function() {
                attachment = custom_uploader.state().get('selection').first().toJSON();
                var url = attachment.url;
                input.val(url);
            });

            //Open the uploader dialog
            custom_uploader.open();
        });
    });

    // Sectionid.js
    $(".sectionid-input > input").blur(function(){
        var convertToSlug = function(Text){
            return Text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
        };

        var currentval = $(this).val();
        var slugversion = convertToSlug(currentval);
        $(this).val(slugversion);
    });

    // Select2.js
    function formatvc(state) {
        return "<i class='ivc fa " + state.id.toLowerCase() + "'/></i>" + state.text;
    }

    $(".sectionid-input > select").each(function(){
        $(this).select2({
            placeholder: "Select",
            allowClear: true,
            formatResult: formatvc,
            formatSelection: formatvc,
            escapeMarkup: function(m) { return m; }
        });
    });

    $('.jnews_token_access.facebook').on('click', function(e)
    {
        e.preventDefault();

        var $this   = $(this),
            control = $this.parents('#vc_edit-form-tab-0'),
            app_url = 'https://graph.facebook.com/oauth/access_token',
            access_token,
            parameter = {
                'client_id'     : control.find('input.fb_id').val(),
                'client_secret' : control.find('input.fb_secret').val(),
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

            control.find('input.fb_key').val(access_token);

        }).fail(function( jqXHR, textStatus, errorThrown )
        {
            window.alert( 'Info Message: ' + errorThrown );
        }).always(function( data, textStatus, jqXHR )
        {
            $this.parent().find('.jnews-spinner').removeClass('active');
        });
    });

    $('.jnews_instagram_access_token').on('click', function(e)
    {
        e.preventDefault();
        var element     = $(this),
            control     = element.parents('.vc_edit-form-tab.vc_active'),
            redirect    = element.attr('href'),
            app_id      = control.find('input.clientid').val(),
            app_url     = 'https://api.instagram.com/oauth/authorize/?client_id=' + app_id + '&redirect_uri=' + redirect + '&response_type=token';

        var win = window.open(app_url, '_blank');
        win.focus();
    });
})(window.jQuery);