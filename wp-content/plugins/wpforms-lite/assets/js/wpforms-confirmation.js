/* globals jQuery */
;(function($){
	$(function(){
		if (window.location.hash) {
			var hash = window.location.hash.substring(1),
				$form;
			hash = hash.split('-');
			if ( 'undefined' !== hash[0] && 'wpforms' === hash[0] && 'undefined' !== hash[1] ) {
				$form = $('#wpforms-confirmation-'+hash[1]);
				$('html,body').animate({
					scrollTop: ($form.offset().top)-100
				}, 1000);
			}
		}
	});
}(jQuery));
