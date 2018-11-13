// https://wordpress.stackexchange.com/a/233212/75147

jQuery(document).ready( function($) {
    jQuery('input#selectimage').click(function(e) {
        e.preventDefault();
        var image_frame;
        if(image_frame){
            image_frame.open();
        }
        image_frame = wp.media({
                    title: 'Select Media',
                    multiple : false,
                    library : {
                        type : 'image',
                    }
                });

        image_frame.on('close',function() {
            // get selections and save to hidden input plus other AJAX stuff etc.
            var selection =  image_frame.state().get('selection');
            var gallery_ids = new Array();
            var my_index = 0;
            selection.each(function(attachment) {
                gallery_ids[my_index] = attachment['id'];
                my_index++;
            });
            var ids = gallery_ids.join(",");
            jQuery('input#' + $(e.target).data('field-id')).val(ids);
            Refresh_Image(ids, $(e.target).data('field-id'));
        });

        image_frame.on('open',function() {
            var selection =  image_frame.state().get('selection');
            ids = jQuery('input#' + $(e.target).data('field-id')).val().split(',');
            ids.forEach(function(id) {
                attachment = wp.media.attachment(id);
                attachment.fetch();
                selection.add( attachment ? [ attachment ] : [] );
            });
        });

        image_frame.on('toolbar:create:select',function() {
            image_frame.state().set('filterable', 'uploaded');
        });

        image_frame.open();
    });
});

function Refresh_Image(the_id, the_field_id){
    var data = {
        action: 'cyb_get_image_url',
        id: the_id,
        fieldId: the_field_id
    };

    jQuery.get(ajaxurl, data, function(response) {
        if(response.success === true) {
            jQuery('.user-preview-image#' + response.data.fieldID).replaceWith( response.data.image );
        }
    });
}
