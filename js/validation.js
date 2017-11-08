jQuery(document).ready(function() {
	var jval2 = {
		'title' : function() {
			var ele = jQuery('#author');
			if (jQuery(ele).length) {
				if(ele.val().length < 3  ) {
					jval2.errors = true;
					ele.removeClass('normal').addClass('error');
				} else {
					ele.removeClass('error').addClass('normal');
				}
			}
		},
		'email' : function() {
			var ele = jQuery('#email');
			var patt = /^.+@.+[.].{2,}$/i;
			if (jQuery(ele).length) {
				if(!patt.test(ele.val())) {
					jval2.errors = true;
					ele.removeClass('normal').addClass('error');
				} else {
					ele.removeClass('error').addClass('normal');
				}
			}
		},
		'details' : function() {
			var ele = jQuery('textarea#comment');
			if(ele.val().length < 10 ) {
				jval2.errors = true;
				ele.removeClass('normal').addClass('error');
			} else {
				ele.removeClass('error').addClass('normal');
			}
		}
	};
	 jQuery("#commentform").submit(function() {
		jval2.errors = false;
		jval2.details();
		jval2.title();
		jval2.email();
		
		if(jval2.errors)
			return false;
		
   });
	
	jQuery('#author').blur(jval2.title);
	jQuery('#email').blur(jval2.email);
	jQuery('#comment').blur(jval2.details);
	
	jQuery('#author').keyup(jval2.title);
	jQuery('#email').keyup(jval2.email);
	jQuery('#comment').keyup(jval2.details);

});