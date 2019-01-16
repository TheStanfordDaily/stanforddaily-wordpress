jQuery(function($){

    wp.customize('jnews_header1_logo_spacing', function (value) {
        value.bind(function (to) {
             console.log(to);
        });
    });

    wp.customize('jnews_header3_height', function (value) {
        value.bind(function (to) {
            console.log(to);
        });
    });

});