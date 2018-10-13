jQuery(document).ready(function() {
    jQuery('#heartbeat_control_update_notice > button').click(function() {
        jQuery.post(ajaxurl, {
            action: 'dismiss_heartbeat_control_update_notice'
        });
    });
});