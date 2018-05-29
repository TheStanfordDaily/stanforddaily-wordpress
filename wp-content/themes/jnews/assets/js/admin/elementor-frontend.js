(function($){

    /** elementor element hook **/

    function element_ready_hook()
    {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/global' , function( element )
        {
            // widget tab
            $(element).find('.jeg_tabpost_widget').jtabs();

            // hook module
            $(element).find('.jeg_module_hook').jmodule();

            // hero module
            jnews.hero.init(element);

            // news ticker
            $(element).find(".jeg_news_ticker").jnewsticker();

            // carousel
            $(element).jnews_carousel();

            // block link
            $(element).find(".jeg_blocklink .jeg_videobg").jvideo_background();

            // slider
            $(element).jnews_slider();

            // video playlist
            $(element).find(".jeg_video_playlist").addClass('jeg_col_4').jvidplaylist();

            // Social Widget
            $.google_plus_widget();
            $.twitter_widget();
            $.facebook_page_widget();
            $.pinterest_widget();
        });
    }

    function do_ready()
    {
        element_ready_hook();
    }

    $(document).ready(do_ready);

})(jQuery);