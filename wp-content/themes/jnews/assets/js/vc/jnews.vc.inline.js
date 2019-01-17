(function($) {

    var get_width = function(element)
    {
        var width = 12;
        var element_class = $(element).attr('class');
        var elaray = element_class.split(" ");

        for(var i = 0; i < elaray.length; i++)
        {
            if(elaray[i].substring(0, 10) === 'vc_col-sm-')
            {
                width = elaray[i].substring(10);
            }
        }

        return width;
    };

    vc_iframe.size_container = function(id)
    {
        var element = $("[data-model-id='" + id + "']");
        var width = 12;

        if($(element).hasClass('vc_vc_column_inner'))
        {
            var parent = $(element).parents('.vc_vc_column');
            var parentwidth = get_width(parent);
            var elementwidth = get_width(element);

            width = Math.ceil(elementwidth * parentwidth / 12);
        }

        if($(element).hasClass('vc_vc_column'))
        {
            width = get_width(element);
        }

        return width;
    };
})(window.jQuery);