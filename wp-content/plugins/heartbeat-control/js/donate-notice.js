jQuery(document).on('click', '.heartbeat-control-donate .notice-dismiss', function() {

    jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'heartbeat_control_dismiss_donate'
        }
    });

});