;(function($) {

	"use strict";

	var validation       = [];
	var bindings         = [];
	var items_binding    = [];
	var dependencies     = [];
	var active_callbacks = [];

	/*
	$(".vp-meta-group").sortable({
		stop : function(event, ui) {
			// empty bracket
		}
	}); 
	*/

	$('.vp-metabox').on('click', '.vp-wpa-group-title', function(e){
		e.preventDefault();
		var group     = $(this).parents('.wpa_group:first');
		var control   = group.find('.vp-controls:first');
		var siblings  = group.siblings('.wpa_group:not(.tocopy)');
		var container = $('html, body');

        if(control.hasClass('vp-hide')) {
            control.slideUp(0,function() {
                $(this).removeClass('vp-hide')
                    .slideDown('fast');
            });
        } else {
            control.slideUp('fast', function() {
                $(this).addClass('vp-hide')
                    .slideDown(0);
            });
        }

        /*
		if(control.hasClass('vp-hide'))
		{
			if(siblings.exists())
			{
				siblings.each(function(i, el){
					$(this).find('.vp-controls').first().slideUp('fast', function() {
						$(this).addClass('vp-hide')
						.slideDown(0, function(){
							if(i == siblings.length - 1)
							{
								container.animate({
									scrollTop: group.offset().top - $('#wpadminbar').height()
								}).promise().done(function(){
									control.slideUp(0,function() {
										$(this).removeClass('vp-hide')
										.slideDown('fast');
									});
								});
							}
						});
					});
				});
			}
			else
			{
				container.animate({
					scrollTop: group.offset().top - $('#wpadminbar').height()
				}).promise().done(function(){
					control.slideUp(0,function() {
						$(this).removeClass('vp-hide')
						.slideDown('fast');
					});
				});
			}
		}
		else
		{
			control.slideUp('fast', function() {
				$(this).addClass('vp-hide')
				.slideDown(0);
			});
		}
        */

		return false;
	});

	function vp_init_fields($elements)
	{
		$elements.each(function(){
			if($(this).parents('.tocopy').length <= 0)
			{
				vp.init_controls($(this));

				var id         = $(this).attr('id'),
					name       = $(this).attr('id'),
					rules      = $(this).attr('data-vp-validation'),
					bind       = $(this).attr('data-vp-bind'),
					items_bind = $(this).attr('data-vp-items-bind'),
					dep        = $(this).attr('data-vp-dependency'),
					callback   = $(this).attr('data-active-callback'),
					type       = $(this).getDatas().type;

				// init validation
				rules && validation.push({name: id, rules: rules, type: type});
				// init binding
				if(typeof bind !== 'undefined' && bind !== false)
				{
					bind && bindings.push({bind: bind, type: type, source: id});
				}
				// init items binding
				if(typeof items_bind !== 'undefined' && items_bind !== false)
				{
					items_bind && items_binding.push({bind: items_bind, type: type, source: id});
				}
				// init dependancies
				if(typeof dep !== 'undefined' && dep !== false)
				{
					dep && dependencies.push({dep: dep, type: 'field', source: id});
				}
				// init active callbacks
				if(typeof callback !== 'undefined' && callback !== false)
				{
					callback && active_callbacks.push({callback: callback, type: 'field', source: id});
				}
			}
		});
	}

	function vp_init_groups($elements)
	{
		$elements.each(function(){
			if($(this).parents('.tocopy').length <= 0 && !$(this).hasClass('.tocopy'))
			{
				var dep      = $(this).attr('data-vp-dependency'),
					callback = $(this).attr('data-active-callback'),
					type     = $(this).getDatas().type,
					id       = $(this).attr('id');

				if(typeof dep !== 'undefined' && dep !== false)
				{
					dep && dependencies.push({dep: dep, type: 'section', source: id});
				}

				if(typeof callback !== 'undefined' && callback !== false)
				{
					callback && active_callbacks.push({callback: callback, type: 'section', source: id});
				}
			}
		});
	}

	function vp_mb_sortable()
	{
		var textareaIDs = [];
		$('.wpa_loop.vp-sortable').sortable({
			items: '>.wpa_group',
			handle: '.vp-wpa-group-heading',
			axis: 'y',
			opacity: 0.5,
			tolerance: 'pointer',
			start: function(event, ui) { // turn TinyMCE off while sorting (if not, it won't work when resorted)
				if(typeof window.KIA_metabox !== 'undefined')
				{
					textareaIDs = [];
					vp.tinyMCE_save();
					$(ui.item).find('.customEditor textarea').each(function(){
						if($(this).parents('.tocopy').length <= 0)
						{
							try { tinyMCE.execCommand('mceRemoveControl', false, this.id); } catch(e){}
							textareaIDs.push(vp.jqid(this.id));
						}
					});
				}
			},
			stop: function(event, ui) { // re-initialize TinyMCE when sort is completed
				if(typeof window.KIA_metabox !== 'undefined')
				{
					for (var i = textareaIDs.length - 1; i >= 0; i--) {
						var $textarea = $(textareaIDs[i]);
						$textarea.val(switchEditors.wpautop($textarea.val()));
					}
					textareaIDs = textareaIDs.join(", ");
					try {
						KIA_metabox.runTinyMCE($(textareaIDs));
						vp.tinyMCE_save();
						for (var i = textareaIDs.length - 1; i >= 0; i--) {
							var $textarea = $(textareaIDs[i]);
							$textarea.val(switchEditors.pre_wpautop($textarea.val()));
						}
					} catch(e){}
				}
			}
		});
	}

	$(document).ready(function () {
		vp_init_fields(jQuery('.vp-metabox .vp-field'));
		vp_init_groups(jQuery('.vp-metabox .vp-meta-group'));
		process_binding(bindings);
		process_items_binding(items_binding);
		process_dependency(dependencies);
		process_active_callback(active_callbacks);
		vp_mb_sortable();
	});

	vp.is_multianswer = function(type){
		var multi = ['vp-checkbox', 'vp-checkimage', 'vp-multiselect'];
		if(jQuery.inArray(type, multi) !== -1 )
		{
			return true;
		}
		return false;
	};

	// image controls event bind
	vp.custom_check_radio_event(".vp-metabox", ".vp-field.vp-checkimage .field .input label");
	vp.custom_check_radio_event(".vp-metabox", ".vp-field.vp-radioimage .field .input label");

	// Bind event to WP publish button to process metabox validation
	$('#post').on( 'submit', function(e){

		var submitter = $("input[type=submit][clicked=true]"),
		    action    = submitter.val(),
		    errors    = 0;

		// update tinyMCE textarea content
		vp.tinyMCE_save();

		$('.vp-field').removeClass('vp-error');
		$('.validation-msg.vp-error').remove();
		$('.vp-metabox-error').remove();

		errors = vp.fields_validation_loop(validation);

		if(errors > 0)
		{
			var $notif = $('<span class="vp-metabox-error vp-js-tipsy" original-title="' + errors + ' error(s) found in metabox"></span>');

			if(action === 'Save Draft')
			{
				$('#minor-publishing-actions .spinner, #minor-publishing-actions .ajax-loading').hide();
				$notif.tipsy();
				$notif.insertAfter('#minor-publishing-actions .spinner, #minor-publishing-actions .ajax-loading');
				$('#save-post').prop('disabled', false).removeClass('button-disabled');
			}
			else if(action === 'Publish' || action === 'Update')
			{
				$('#publishing-action .spinner, #publishing-action .ajax-loading').hide();
				$notif.tipsy();
				$notif.insertAfter('#publishing-action .spinner, #publishing-action .ajax-loading');
				$('#publish').prop('disabled', false).removeClass('button-primary-disabled');
			}

			var margin_top = Math.ceil((submitter.outerHeight() - $notif.height()) / 2);
			if(margin_top > 0)
				$notif.css('margin-top', margin_top);
			e.preventDefault();
			return;
		}

		// add hidden field before toggle to force submit
		$(this).find('.vp-toggle .vp-input').each(function(){
			var hidden = $('<input>', {type: 'hidden', name: this.name, value: 0});
			$(this).before(hidden);
		});

	});

	$("#post input[type=submit]").click(function() {
		$("input[type=submit]", $(this).parents("form")).removeAttr("clicked");
		$(this).attr("clicked", "true");
	});

	function process_binding(bindings)
	{
		for (var i = 0; i < bindings.length; i++)
		{
			var field   = bindings[i];
			var temp    = field.bind.split('|');
			var func    = temp[0];
			var dest    = temp[1];
			var ids     = [];

			var prefix  = '';
			prefix      = field.source.replace('[]', '');
			prefix      = prefix.substring(0, prefix.lastIndexOf('['));

			dest = dest.split(/[\s,]+/);

			for (var j = 0; j < dest.length; j++)
			{
				dest[j] = prefix + '[' + dest[j] + ']';
				ids.push(dest[j]);
			}

			for (j = 0; j < ids.length; j++)
			{
				vp.binding_event(ids, j, field, func, '.vp-metabox', 'metabox');
			}
		}
	}

	function process_items_binding(items_binding)
	{
		for (var i = 0; i < items_binding.length; i++)
		{
			var field   = items_binding[i];
			var temp    = field.bind.split('|');
			var func    = temp[0];
			var dest    = temp[1];
			var ids     = [];

			var prefix  = '';
			prefix      = field.source.replace('[]', '');
			prefix      = prefix.substring(0, prefix.lastIndexOf('['));

			dest = dest.split(/[\s,]+/);

			for (var j = 0; j < dest.length; j++)
			{
				dest[j] = prefix + '[' + dest[j] + ']';
				ids.push(dest[j]);
			}

			for (j = 0; j < ids.length; j++)
			{
				vp.items_binding_event(ids, j, field, func, '.vp-metabox', 'metabox');
			}
		}
	}

	function process_dependency(dependencies)
	{
		for (var i = 0; i < dependencies.length; i++)
		{
			var field  = dependencies[i];
			var temp   = field.dep.split('|');
			var func   = temp[0];
			var dest   = temp[1];
			var ids    = [];
			var prefix = '';

			if(field.type === 'field')
			{
				// strip [] (which multiple option field has)
				prefix = field.source.replace('[]', '');
				prefix = prefix.substring(0, prefix.lastIndexOf('['));
			}
			else if(field.type === 'section')
			{
				var $source = jQuery(vp.jqid(field.source));
				if($source.parents('.wpa_group').length > 0)
				{
					prefix = jQuery(vp.jqid(field.source)).parents('.wpa_group').first().attr('id');
				}
				else
				{
					// get the closest 'postbox' class parent id
					prefix = jQuery(vp.jqid(field.source)).parents('.postbox').attr('id');
					// strip the '_metabox'
					prefix = prefix.substring(0, prefix.lastIndexOf('_'));
				}
			}

			dest = dest.split(',');

			for (var j = 0; j < dest.length; j++)
			{
				dest[j] = prefix + '[' + dest[j] + ']';
				ids.push(dest[j]);
			}

			for (j = 0; j < ids.length; j++)
			{
				vp.dependency_event(ids, j, field, func, '.vp-metabox');
			}
		}
	}

	function process_active_callback(active_callbacks)
	{
		for (var i = 0; i < active_callbacks.length; i++)
		{
			var data   = active_callbacks[i],
				parse  = JSON.parse(data.callback),
				prefix = '';

			if (data.type === 'field')
			{
				// strip [] (which multiple option field has)
				prefix = data.source.replace('[]', '');
				prefix = prefix.substring(0, prefix.lastIndexOf('['));
			}
			else if (data.type === 'section')
			{
				var $source = jQuery(vp.jqid(data.source));
				
				if ($source.parents('.wpa_group').length > 0)
				{
					prefix = jQuery(vp.jqid(data.source)).parents('.wpa_group').first().attr('id');
				}
				else
				{
					// get the closest 'postbox' class parent id
					prefix = jQuery(vp.jqid(data.source)).parents('.postbox').attr('id');
					// strip the '_metabox'
					prefix = prefix.substring(0, prefix.lastIndexOf('_'));
				}
			}

			for (var j = 0; j < parse.length; j++)
			{
				var target = parse[j],
                    ids    = prefix + '['+ target['field'] +']';

                active_callback_event(ids, prefix, data);
			}

			active_callback_action(prefix, data);
		}
	}

	function active_callback_event(ids, prefix, data)
	{
	    var name = vp.thejqname(ids, 'option');

		$('.vp-metabox').on('change', name, function()
		{
            active_callback_action(prefix, data);
        });
	}

	function active_callback_action(prefix, data)
	{
		var dep    	= JSON.parse(data.callback),
			source 	= jQuery(vp.jqid(data.source)),
			targets = [],
			flag   	= true;

		for (var j = 0; j < dep.length; j++)
		{
			var target  = dep[j],
				ids     = prefix + '[' + target.field + ']',
	    		value   = jQuery('[name="' + ids + '"]').validationVal(),
	    		compare = false;
		
			targets.push(jQuery(vp.jqid(ids)));

			compare = active_callback_compare(target.operator, target.value, value);
                
            if ( ! compare ) flag = false;
		}

		if (flag)
		{
			source.removeClass('vp-dep-inactive');
			source.vp_fadeIn();
		} else {
			source.addClass('vp-dep-inactive');
			source.vp_fadeOut();
		}
	}

	function active_callback_compare(operator, value1, value2)
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
	}

	$.wpalchemy.on('wpa_copy', function(event, clone){

		bindings      = [];
		dependencies  = [];
		items_binding  = [];

		// delete tocopy hidden field
		clone.find('input[class="tocopy-hidden"]').first().remove();

		vp_init_fields(clone.find('.vp-field'));
		vp_init_groups(clone.find('.vp-meta-group'));

		clone.find('.vp-wpa-group-title:first').click();

		process_binding(bindings);
		process_items_binding(items_binding);
		process_dependency(dependencies);
		process_active_callback(active_callbacks);
	});

}(jQuery));

// additional metabox field
(function ($) {
    "use strict";

    function do_multitermhierarchy() {
        
        var $multiselect = $('.vp-multitermhierarchy-wrapper input.input-sortable');
        
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
                        hideSelected: true,
                        render: {
                            option: function(item, escape) {
                                return '<div class="' + item.class + '"><span>' + item.text + '</span></div>';
                            }
                        }
                    });
                }
            }
        });
    }

    function do_multipost()
	{
        var $multipost = $('.vp-multipost-wrapper input.input-sortable');

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
                                'action'  : 'vp_find_ajax_post'
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
    }

    function do_multitag()
	{
        var $multitag = $('.vp-multitag-wrapper input.input-sortable');

        $multitag.each(function()
        {
            if ($(this).hasClass('selectized')) {
                // do nothing
            } else {
                var $this		= $(this),
                	$parent 	= $this.parent(),
					options 	= $parent.find('.data-option'),
					ajax_load	= false;

					if ( $this.hasClass('vp-ajax-load') ) 
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
		                                'action'  : 'vp_find_ajax_post_tag'
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
    }

    function do_multiauthor() {
        
        var $multiajax = $('.vp-multiauthor-wrapper input.input-sortable');
        
        $multiajax.each(function()
        {
            if($(this).hasClass('selectized')) {
                // do nothing
            } else {
                var $this			= $(this),
                	$parent 		= $this.parent(),
					options 		= $parent.find('.data-option'),
					ajax_load   	= false;

					if ( $this.hasClass('vp-ajax-load') ) 
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
		                                'action'  : 'vp_find_ajax_author'
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
    }

	function do_tab()
	{
		var $tab = $(".vp-tabs");
		$tab.tabs();
	}

    function do_ready() 
    {
    	do_multiauthor();
        do_multitermhierarchy();
        do_multipost();
        do_multitag();
		do_tab();
    }

    $(document).ready(do_ready);
})(jQuery);