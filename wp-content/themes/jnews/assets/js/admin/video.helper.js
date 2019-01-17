( function(  $ ) {

    var player;
    var currently_played;
    var alredy_open = false;

    function video_documentation()
    {
        $('.video-documentation').bind('click', function(){
            $('body').addClass('video-documentation-body');
            load_player();
            video_resize();
        });

        $('.video-documentation-close, .video-documentation-overlay').bind('click', function(){
            $('body').removeClass('video-documentation-body');
            stop_video();
        });

        $(".video-documentation-list a").bind('click', function(e){
            e.preventDefault();
            var id = $(this).data('id');

            set_active(id);
            change_video(id);
        });
    }

    function set_active(id)
    {
        $(".video-documentation-list a").removeClass('video-active');
        $(".video-documentation-list a[data-id='" + id + "']").addClass('video-active');
    }

    function get_current_id()
    {
        var element = $(".video-documentation-list a").first();
        currently_played = $(element).data('id');
        set_active(currently_played);
        return currently_played;
    }

    function onYouTubePlayer()
    {
        if(alredy_open) {
            player.playVideo();
        } else {
            var videoholder = $(".video-documentation-holder").get(0);
            player = new YT.Player(videoholder, {
                videoId: get_current_id(),
                playerVars: { controls:1, showinfo: 0, rel: 0, showsearch: 0, iv_load_policy: 3 },
                events: {
                    'onReady': onPlayerReady
                }
            });
            alredy_open = true;
        }
    }


    function onPlayerReady(event) {
        event.target.playVideo();
    }

    function stop_video() {
        if(player) {
            player.pauseVideo();
        }
    }

    function change_video(id)
    {
        if(player) {
            player.loadVideoById(id);
        }
    }

    function load_player() {
        if (typeof(YT) == 'undefined' || typeof(YT.Player) == 'undefined') {
            var tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            window.onYouTubePlayerAPIReady = function() {
                onYouTubePlayer();
            };
        } else {
            onYouTubePlayer();
        }
    }

    function video_resize()
    {
        var ww = $(window).width() - ( 40 * 2 );
        var wh = $(window).height() - ( 40 * 2 );

        $(".video-documentation-holder").css({
            width : ww - 350,
            height: wh
        });

        $(".video-documentation-list").css({
            height: wh
        });
    }

    $(document).bind('ready', video_documentation);
    $(window).bind('resize', video_resize);

} )( jQuery );