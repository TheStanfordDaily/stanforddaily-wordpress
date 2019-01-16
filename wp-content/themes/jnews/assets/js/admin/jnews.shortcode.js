/*jslint browser:true */
(function ($) {
    "use strict";

    var dialog = null;

    tinymce.PluginManager.add('jnews_shortcode', function(editor, url)
    {
        // 1. GRID ------------------------------------------------------------------------------------

        editor.addButton('jnews_grid', {
            title: 'Grid Builder',
            image : url + '/shortcode/grid.png',
            cmd: 'jnews_grid_cmd'
        });

        editor.addCommand('jnews_grid_cmd', function()
        {
            dialog = buildResponse("Grid Builder", [
                { type : 'grid', name : 'Grid Layout' }
            ], 820);

            dialog.find('#exeCmd').click(function(event)
            {
                var html = '<div class="row clearfix">\n';

                $('.buildgrid > li').each (function()
                {
                    var spanWidth = parseInt($(this).attr('data-length'), 10);
                    html += '<div class="col-md-'+ spanWidth +'">' + '<p>Your Content Goes Here</p>' + '</div>\n';
                });

                html += '</div>\n';
                editor.execCommand('mceInsertContent', false, html);

                dialog.remove();
            });
        });

        // 2. INTRO  ------------------------------------------------------------------------------------

        editor.on('init', function(e)
        {
            editor.formatter.register(
                'jnews_intro_formater', {
                    block: 'div',
                    classes: ['intro-text'],
                    wrapper: true
                }
            );
        });

        editor.addButton('jnews_intro', {
            title: 'Intro',
            image : url + '/shortcode/intro.png',
            cmd: 'jnews_intro_cmd',
            onPostRender: function()
            {
                var ctrl = this;
                editor.on('NodeChange', function(e)
                {
                    var formatMatch = editor.formatter.match('jnews_intro_formater');
                    ctrl.active(formatMatch);
                });
            }
        });

        editor.addCommand('jnews_intro_cmd', function()
        {
            if (!editor.formatter.match('jnews_intro_formater'))
            {
                editor.formatter.apply("jnews_intro_formater");
            } else {
                editor.formatter.remove("jnews_intro_formater");
            }
        });

        // 3. DROPCAPS  ------------------------------------------------------------------------------------

        var check_dropcaps = function(editor)
        {
            var formatMatch = editor.formatter.match('jnews_dropcaps_formater');
            var formatMatchSquare = editor.formatter.match('jnews_dropcaps_formater_square');
            var formatMatchCircle = editor.formatter.match('jnews_dropcaps_formater_circle');
            var formatMatchRounded = editor.formatter.match('jnews_dropcaps_formater_rounded');
            var formatMatchBorder = editor.formatter.match('jnews_dropcaps_formater_border');
            var formatMatchRoundedBorder = editor.formatter.match('jnews_dropcaps_formater_border_rounded');
            var formatMatchCircleBorder = editor.formatter.match('jnews_dropcaps_formater_border_circle');
            var formatMatchShadow = editor.formatter.match('jnews_dropcaps_formater_shadow');

            return Boolean(formatMatch|formatMatchSquare|formatMatchCircle|formatMatchRounded|formatMatchBorder|formatMatchRoundedBorder|formatMatchCircleBorder|formatMatchShadow);
        };

        editor.on('init', function(e)
        {
            editor.formatter.register(
                'jnews_dropcaps_formater', {
                    block: 'span',
                    classes: ['dropcap'],
                    wrapper: true,
                    styles: ['background-color', 'color', 'border-color']
                }
            );

            editor.formatter.register(
                'jnews_dropcaps_formater_square', {
                    block: 'span',
                    classes: ['dropcap', 'square'],
                    wrapper: true,
                    styles: ['background-color', 'color', 'border-color']
                }
            );

            editor.formatter.register(
                'jnews_dropcaps_formater_circle', {
                    block: 'span',
                    classes: ['dropcap', 'circle'],
                    wrapper: true,
                    styles: ['background-color', 'color', 'border-color']
                }
            );

            editor.formatter.register(
                'jnews_dropcaps_formater_rounded', {
                    block: 'span',
                    classes: ['dropcap', 'rounded'],
                    wrapper: true,
                    styles: ['background-color', 'color', 'border-color']
                }
            );

            editor.formatter.register(
                'jnews_dropcaps_formater_border', {
                    block: 'span',
                    classes: ['dropcap', 'border'],
                    wrapper: true,
                    styles: ['background-color', 'color', 'border-color']
                }
            );

            editor.formatter.register(
                'jnews_dropcaps_formater_border_rounded', {
                    block: 'span',
                    classes: ['dropcap', 'border', 'rounded'],
                    wrapper: true,
                    styles: ['background-color', 'color', 'border-color']
                }
            );

            editor.formatter.register(
                'jnews_dropcaps_formater_border_circle', {
                    block: 'span',
                    classes: ['dropcap', 'border', 'circle'],
                    wrapper: true,
                    styles: ['background-color', 'color', 'border-color']
                }
            );

            editor.formatter.register(
                'jnews_dropcaps_formater_shadow', {
                    block: 'span',
                    classes: ['dropcap', 'shadow'],
                    wrapper: true,
                    styles: ['background-color', 'color', 'border-color']
                }
            );
        });

        editor.addButton('jnews_dropcaps', {
            title: 'Dropcap',
            image : url + '/shortcode/dropcaps.png',
            cmd: 'jnews_dropcaps_cmd',
            onPostRender: function() {
                var ctrl = this;
                editor.on('NodeChange', function(e) {
                    ctrl.active(check_dropcaps(editor));
                });
            }
        });

        editor.addCommand('jnews_dropcaps_cmd', function()
        {
            if (!check_dropcaps(editor))
            {
                var content = editor.selection.getContent();
                var options = ['normal', 'square', 'circle', 'rounded', 'square-border', 'rounded-border', 'circle-border', 'shadow'];

                if(content === '')
                {
                    dialog = buildResponse("Dropcap", [
                        { type : 'select', name : 'Select Dropcap style ', id : 'dropstyle' , option : options},
                        { type : 'colorpicker', name : 'Background Color', id : 'bgcolor', color : '#ffffff' },
                        { type : 'colorpicker', name : 'Text Color', id : 'txtcolor' , color : '#000000' },
                        { type : 'colorpicker', name : 'Border Color', id : 'bordercolor' , color : '#ffffff' },
                        { type : 'text' , name : 'Dropcap String' , id: 'dropcap'}
                    ], 500);

                } else {
                    dialog = buildResponse("Dropcap", [
                        { type : 'select', name : 'Select Dropcap style ', id : 'dropstyle' , option : options},
                        { type : 'colorpicker', name : 'Background Color', id : 'bgcolor', color : '#ffffff' },
                        { type : 'colorpicker', name : 'Text Color', id : 'txtcolor' , color : '#000000' },
                        { type : 'colorpicker', name : 'Border Color', id : 'bordercolor' , color : '#ffffff' }
                    ], 500);
                }

                dialog.find('#exeCmd').click(function(event)
                {
                    var style 	            = $('#style').val();
                    var txtcolor 	        = $('#txtcolor').val();
                    var bgcolor 	        = $('#bgcolor').val();
                    var bordercolor 	    = $('#bordercolor').val();
                    var dropcap     = '';

                    if(content !== '') {
                        dropcap = content;
                    } else {
                        dropcap = $('#dropcap').val();
                    }

                    var drop_style = $('#dropstyle').val();
                    var inline_style = "background-color : " + bgcolor + "; color : " + txtcolor + "; border-color : " + bordercolor;

                    if(drop_style === 'normal') {
                        drop_style = "";
                    } else  if(drop_style === 'square-border') {
                        drop_style = "border";
                    } else if(drop_style === 'rounded-border') {
                        drop_style = "border rounded";
                    } else if(drop_style === 'circle-border') {
                        drop_style = "border circle";
                    }

                    var insertHtml 	= '<span class="dropcap ' + drop_style + '" style="' + inline_style + '">' + dropcap + '</span>';
                    editor.execCommand('mceInsertContent', false, insertHtml);
                    dialog.remove();
                });
            } else {

                var formater = [
                    'jnews_dropcaps_formater',
                    'jnews_dropcaps_formater_square',
                    'jnews_dropcaps_formater_circle',
                    'jnews_dropcaps_formater_rounded',
                    'jnews_dropcaps_formater_border',
                    'jnews_dropcaps_formater_border_rounded',
                    'jnews_dropcaps_formater_border_circle',
                    'jnews_dropcaps_formater_shadow'
                ];

                for(var i = 0; i < formater.length; i++)
                {
                    if(editor.formatter.match(formater[i]))
                    {
                        editor.formatter.remove(formater[i]);
                    }
                }
            }
        });

        // 4. HIGHLIGHT  ------------------------------------------------------------------------------------

        editor.on('init', function(e)
        {
            editor.formatter.register(
                'jnews_highlight_formater', {
                    block: 'span',
                    classes: ['highlight'],
                    wrapper: true,
                    styles: ['background-color', 'color']
                }
            );
        });

        editor.addButton('jnews_highlight',
        {
            title: 'Highlight',
            image : url + '/shortcode/highlight.png',
            cmd: 'jnews_highlight_cmd',
            onPostRender: function() {
                var ctrl = this;
                editor.on('NodeChange', function(e) {
                    var formatMatch = editor.formatter.match('jnews_highlight_formater');
                    ctrl.active(formatMatch);
                });
            }
        });


        editor.addCommand('jnews_highlight_cmd', function()
        {
            if (!editor.formatter.match('jnews_highlight_formater'))
            {
                var content = editor.selection.getContent();

                if(content === '')
                {
                    dialog = buildResponse("Highlight", [
                        { type : 'colorpicker', name : 'Background Color', id : 'bgcolor', color : '#666666' },
                        { type : 'colorpicker', name : 'Text Color', id : 'txtcolor' , color : '#ffffff' },
                        { type : 'text', name : 'Highlighed text', id : 'highlight' }
                    ], 500);


                } else {
                    dialog = buildResponse("Highlight", [
                        { type : 'colorpicker', name : 'Background Color', id : 'bgcolor', color : '#666666' },
                        { type : 'colorpicker', name : 'Text Color', id : 'txtcolor' , color : '#ffffff' }
                    ], 500);
                }

                dialog.find('#exeCmd').click(function(e)
                {
                    var txtcolor 	= $('#txtcolor').val();
                    var bgcolor 	= $('#bgcolor').val();
                    var highlight   = '';

                    if(content !== '') {
                        highlight 	= content;
                    } else {
                        highlight 	= $('#highlight').val();
                    }

                    var style = "background-color : " + bgcolor + "; color : " + txtcolor;

                    var insertHtml = '<span class="highlight" style="' + style + '">' + highlight + '</span>';
                    editor.execCommand('mceInsertContent', false, insertHtml);

                    dialog.remove();
                });
            } else {
                editor.formatter.remove("jnews_highlight_formater");
            }
        });


        // 5. PULLQUOTE  ------------------------------------------------------------------------------------

        var check_pullquote = function(editor)
        {
            var formatMatchCenter = editor.formatter.match('jnews_pullquote_formater_center');
            var formatMatchLeft = editor.formatter.match('jnews_pullquote_formater_right');
            var formatMatchRight = editor.formatter.match('jnews_pullquote_formater_left');

            return Boolean(formatMatchCenter|formatMatchLeft|formatMatchRight);
        };

        editor.on('init', function(e)
        {
            editor.formatter.register(
                'jnews_pullquote_formater_center', {
                    block: 'blockquote',
                    classes: ['pullquote', 'align-center'],
                    wrapper: true
                }
            );

            editor.formatter.register(
                'jnews_pullquote_formater_right', {
                    block: 'blockquote',
                    classes: ['pullquote', 'align-right'],
                    wrapper: true
                }
            );

            editor.formatter.register(
                'jnews_pullquote_formater_left', {
                    block: 'blockquote',
                    classes: ['pullquote', 'align-left'],
                    wrapper: true
                }
            );
        });

        editor.addButton('jnews_pullquote', {
            title: 'Pullquote',
            image : url + '/shortcode/pullquote.png',
            cmd: 'jnews_pullquote_cmd',
            onPostRender: function() {
                var ctrl = this;
                editor.on('NodeChange', function(e) {
                    ctrl.active(check_pullquote(editor));
                });
            }
        });


        editor.addCommand('jnews_pullquote_cmd', function()
        {
            if (!check_pullquote(editor))
            {
                dialog = buildResponse("Pullquote", [
                    {
                        type : 'select',
                        name : 'Pullquote Position ',
                        id : 'pullposition' ,
                        option : ['left', 'right', 'center']
                    }
                ], 500);

                dialog.find('#exeCmd').click(function(e)
                {
                    var position = $('#pullposition').val();

                    switch(position) {
                        case 'left' :
                            editor.formatter.apply("jnews_pullquote_formater_left");
                            break;
                        case 'right' :
                            editor.formatter.apply("jnews_pullquote_formater_right");
                            break;
                        case 'center' :
                            editor.formatter.apply("jnews_pullquote_formater_center");
                            break;
                    }

                    dialog.remove();
                });
            } else {
                if(editor.formatter.match('jnews_pullquote_formater_center'))
                {
                    editor.formatter.remove("jnews_pullquote_formater_center");
                }
                if(editor.formatter.match('jnews_pullquote_formater_right'))
                {
                    editor.formatter.remove("jnews_pullquote_formater_right");
                }
                if(editor.formatter.match('jnews_pullquote_formater_left'))
                {
                    editor.formatter.remove("jnews_pullquote_formater_left");
                }
            }
        });


        // 6. ALERT  ------------------------------------------------------------------------------------

        editor.addButton('jnews_alert', {
            title: 'Alert',
            image : url + '/shortcode/alert.png',
            cmd: 'jnews_alert_cmd',
        });

        editor.addCommand('jnews_alert_cmd', function()
        {
            dialog = buildResponse("Alert", [
                {type : 'select', name : 'Select alert style' , id :'select-color', option : ['warning', 'error', 'success', 'info']} ,
                {type : 'text' , name : 'Alert Title' , id: 'alert-title'},
                {type : 'text' , name : 'Alert Content' , id: 'alert-content'}
            ], 500);

            dialog.find('#exeCmd').click(function(e)
            {
                var color 	= $('#select-color').val();
                var title	= $('#alert-title').val();
                var content	= $('#alert-content').val();

                var alertstyle = '';
                if(color == "warning") {
                    alertstyle = 'alert-warning';
                } else if(color == "error") {
                    alertstyle = 'alert-error';
                } else if(color == "success") {
                    alertstyle = 'alert-success';
                } else if(color == "info") {
                    alertstyle = 'alert-info';
                }

                var html = "<div class='alert " + alertstyle + "'><strong>" + title + "</strong> " + content + " </div>";

                editor.execCommand('mceInsertContent', false, html);
                dialog.remove();
            });
        });

        // 7. BUTTON  ------------------------------------------------------------------------------------

        editor.addButton('jnews_btn', {
            title: 'Button',
            image : url + '/shortcode/button.png',
            cmd: 'jnews_btn_cmd'
        });

        editor.addCommand('jnews_btn_cmd', function()
        {
            dialog = buildResponse("Button", [
                {type : 'select', name : 'Select button style ', id : 'select-color' , option : ['default', 'primary', 'success', 'info', 'warning', 'danger']} ,
                {type : 'text'  , name : 'Button Url'     , id: 'btnurl'},
                {type : 'text'  , name : 'Button Text'    , id: 'btntxt'}
            ], 500);

            dialog.find('#exeCmd').click(function(e)
            {
                var color 	= $('#select-color').val();
                var url		= $('#btnurl').val();
                var txt 	= $('#btntxt').val();

                var html = '<a href="' + url + '" class="btn btn-' + color + '">' + txt + '</a>';

                editor.execCommand('mceInsertContent', false, html);
                dialog.remove();
            });
        });


        // 8. SPACING  ------------------------------------------------------------------------------------

        editor.addButton('jnews_spacing', {
            title: 'Spacing',
            image : url + '/shortcode/spacing.png',
            cmd: 'jnews_spacing_cmd'
        });

        editor.addCommand('jnews_spacing_cmd', function()
        {
            dialog = buildResponse("Spacing", [
                { type : 'text' , name : 'Size in px' , id: 'size'}
            ], 500);

            dialog.find('#exeCmd').click(function(e)
            {
                var size = $('#size').val();
                var insertHtml 	= '[spacing size="' + size + '"]';
                editor.execCommand('mceInsertContent', false, insertHtml);
                dialog.remove();
            });
        });

        // 9. WEATHER  ------------------------------------------------------------------------------------

        editor.addButton('jnews_weather', {
            title: 'Weather',
            image : url + '/shortcode/weather.png',
            cmd: 'jnews_weather_cmd'
        });

        editor.addCommand('jnews_weather_cmd', function()
        {
            dialog = buildResponse("Weather", [
                {
                    type : 'text', 
                    name : 'Weather Location', 
                    id   : 'location'
                },
                {
                    type : 'checkbox', 
                    name : 'Auto Detect Location', 
                    id   : 'auto_location'
                },
                {
                    type : 'select', 
                    name : 'Next Days Weather Forecast', 
                    id   : 'item', 
                    option : ['show', 'hide']
                },
                {
                    type : 'slider', 
                    name : 'Number of Weather Item', 
                    id   : 'count',
                    min  : 3,
                    max  : 6,
                    step : 1,
                    value: 4,
                }
            ], 500);

            dialog.find('#exeCmd').click(function(e)
            {
                var location      = $('#location').val(),
                    auto_location = false,
                    count         = $('#count').val(),
                    item          = $('#item').val();

                if ( $('#auto_location').is(":checked") )
                {
                    auto_location = true;
                }

                var html = '[jeg_weather location="' + location + '" auto_location="' + auto_location + '" count="' + count + '" item="' + item + '"]';

                editor.execCommand('mceInsertContent', false, html);
                dialog.remove();
            });
        });

    });


    // ------------------------------------------------------------------------------------

    var capitalizeFirstLetter = function (string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };

    var addOption = function (arr)
    {
        var html = '';
        for (var i = 0; i < arr.length ; i++) {
            html += '<option value="' + arr[i] + '">' + capitalizeFirstLetter(arr[i]) + '</option>\n';
        }
        return html;
    };

    var build_option = function(fields){

        var htmlfield = '';

        for ( var i = 0 ; i < fields.length; i++ )
        {
            var field = fields[i];

            if(field.type == 'text') {
                htmlfield +=
                    "<label>" + field.name + " : </label><input type='text' id='" + field.id + "' name='" + field.id + "' />";
            } else if(field.type == 'textarea') {
                htmlfield +=
                    "<label>" + field.name + " : </label><textarea id='" + field.id + "' name='" + field.id + "' /></textarea>";
            } else if(field.type == 'grid') {
                htmlfield +=
                    "<label>" + field.name + " : <a href='#' title='Add Grid' class='addgrid'>&nbsp;</a></label>" +
                    "<ul class='buildgrid'>" +
                        "<li class='gridlist span12' data-length='12'>" +
                        "<div class='gridcounter'>12/12</div>" +
                        "<div class='panelgrid'>" +
                            "<a href='#' class='plusgrid' title='Increase Grid Width'>plus</a>" +
                            "<a href='#' class='reducegrid' title='Reduce Grid Width'>reduce</a>" +
                            "<a href='#' class='removegrid' title='Remove Grid'>remove</a></div>" +
                        "</li>" +
                    "</ul>";
            } else if(field.type == 'select') {
                htmlfield +=
                    "<label>" + field.name + " : " + "</label>" +
                    "<select id='" + field.id + "' name='" + field.id + "'>" +
                        addOption(field.option) +
                    "</select>";
            } else if(field.type == 'colorpicker') {
                htmlfield +=
                    "<label>" + field.name + " : " +
                        "<input class='pickcolor' id='" + field.id + "' value='" + field.color + "'/>" +
                    "</label>";
            } else if(field.type == 'checkbox') {
                htmlfield +=
                    "<label>" + field.name + " :  " +
                        "<input type='checkbox' class='checkbox' id='" + field.id + "' />" +
                    "</label>";
            } else if(field.type == 'slider') {
                htmlfield +=
                    "<label>" + field.name + " :  " + "</label>" +
                    "<div class='type-range-wrapper'>" + 
                        "<input type='range' class='range' id='" + field.id + "' min='" + field.min + "' max='" + field.max + "' step='" + field.step + "' value='" + field.value + "' />" +
                        "<span class='range-value'>" + field.value + "</span>" +
                    "</div>";
            }
        }

        return htmlfield;
    };

    var buildResponse = function (title, fields, width)
    {
        var htmlfield = build_option(fields);

        var html =
            '<div>'+
                '<div class="jeg-dialog-form">' +
                htmlfield +
                '</div>'+
                '<div class="jeg-dialog-submit">' +
                    '<input type="button" id="exeCmd" class="button-primary alignright" value="Insert" />'+
                '</div>'+
                '<div style="clear: both;"></div>' +
            '</div>';

        dialog = $(html).dialog({
            title			: title,
            modal			: true,
            dialogClass	    : 'j-dialog',
            resizable		: true,
            width			: width,
            close			: function(event, ui){
                jQuery(this).html('').remove();
            },
            create:function(){
                // color picker
                if($(".pickcolor").length) {
                    $(".pickcolor").each (function () {
                        var $this = $(this);
                        $this.wpColorPicker();
                    });
                }

                // slider
                if ( $(".type-range-wrapper").length ) 
                {
                    $(".type-range-wrapper").each( function() 
                    {
                        var $this = $(this);

                        $this.on('mousedown', function()
                        {
                            var value = $(this).find('input').attr('value');

                            $(this).mousemove( function() {
                                value = $(this).find('input').attr('value');

                                $(this).find('.range-value').text(value);
                            });
                        });
                    });
                }

                /** jika grid **/
                if($(".buildgrid").length) {
                    var maxlength = 12;
                    var getTotalGrid = function () {
                        return $(".buildgrid > li").size();
                    };

                    var getTotalGridLength = function () {
                        var length = 0;
                        $(".buildgrid > li").each (function (){
                            length += parseInt($(this).attr('data-length'), 10);
                        });
                        return length;
                    };

                    var gridtemplate = function (gridlength) {
                        return '<li class="gridlist span'+ gridlength +'" data-length="'+ gridlength +'">' +
                            '<div class="gridcounter">'+ gridlength +'/12</div>' +
                                '<div class="panelgrid">' +
                                    '<a href="#" class="plusgrid" title="Increase Grid Width">plus</a> ' +
                                    '<a href="#" class="reducegrid" title="Reduce Grid Width">reduce</a> ' +
                                    '<a href="#" class="removegrid" title="Remove Grid">remove</a>' +
                                '</div>' +
                            '</li>';
                    };

                    var createGrid = function (i) {
                        var grid = '';
                        var gridlength = Math.floor( 12 / i );
                        for(var a = 0; a < i ; a++) {
                            grid += gridtemplate (gridlength);
                        }
                        return grid;
                    };

                    $(".addgrid").on("click", function(event){
                        var totalgrid = getTotalGrid();
                        if(totalgrid < maxlength) {
                            var resgrid = createGrid( totalgrid + 1 ) ;
                            $('.buildgrid').html(resgrid);
                        }
                        return false;
                    });

                    $(document).on("click", ".buildgrid .removegrid" ,function(event) {
                        $(this).parent().parent().remove();
                        return false;
                    });

                    $(document).on("click", ".buildgrid .reducegrid" ,function(event) {
                        var selector = $(this).parent().parent();
                        var gridlength = parseInt($(selector).attr('data-length'));
                        if(gridlength == 1) {
                            $(selector).remove();
                        } else {
                            var grid = gridtemplate(gridlength - 1);
                            $(selector).replaceWith(grid);
                        }
                        return false;
                    });

                    $(document).on("click", ".buildgrid .plusgrid" ,function(event) {
                        var selector = $(this).parent().parent();
                        var gridlength = parseInt($(selector).attr('data-length'));
                        if(getTotalGridLength() < maxlength ) {
                            var grid = gridtemplate(gridlength + 1);
                            $(selector).replaceWith(grid);
                        } else {
                            alert("Remove or reduce other grid before increasing this grid size");
                        }
                        return false;
                    });
                }
            }
        });

        return dialog;
    };


})(jQuery);