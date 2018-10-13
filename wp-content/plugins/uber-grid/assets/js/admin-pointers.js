jQuery(function($) {
    $.each(uber_grid_pointers[0], function(index, element) {
        var options;
        options = {
            content: "<h3>" + element.title + "</h3>" + element.content,
            position: element.position,
            close: function(what) {
                $.post("admin-ajax.php?action=uber_grid_dismiss_pointer", {
                    pointer: index
                });
            }
        };
        $(index).pointer(options).pointer("open");
    });
});
