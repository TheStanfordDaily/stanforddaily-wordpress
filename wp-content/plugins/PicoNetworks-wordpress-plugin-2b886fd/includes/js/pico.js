jQuery(document).ready(function( $ ) {
  //$('body').append('<pp-wrapper></pp-wrapper>');
  $('.open-modal').click(function() {
    $('#modal-container').fadeIn(200);
    $('#modal').fadeIn(200);
    $('#modal-container.modal-disconnect').css('display', 'block');
    $('#modal-container.modal-disconnect .modal#alert').css('display', 'block');
  });  

  $('.close-alert').click(function() {
    $('#modal').fadeOut(200);
    $('#modal-container').fadeOut(200);
    $('#modal-container.modal-disconnect').css('display', 'none');
    $('#modal-container.modal-disconnect .modal#alert').css('display', 'none');
  });
  $('.close-modal').click(function() {
    $('#modal').fadeOut(200);
    $('#modal-container').fadeOut(200);
    $('#modal-container.modal-disconnect').css('display', 'none');
    $('#modal-container.modal-disconnect .modal#alert').css('display', 'none');
  });
  $('#leaky_paywall_option').on('change', function(){
	  var selected_option = this.value;

	  $('#leaky-paywall-update-status').text('Saving...');

	  var url = $('#pico-form').attr('action');

	  $.ajax({
		  url: url,
		  data: {
			  leaky_paywall_percentage: selected_option
		  },
		  type: 'POST',
		  success: function () {
			  $('#leaky-paywall-update-status').text('Saved');
		  }
	  });
  })
});
