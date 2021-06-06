jQuery( document ).ready(function() {
    jQuery('.fbv_BtnLoginEnvato').on('click', function(){
        var win = window.open(fbv_data.login_envato_url, "", "width=500,height=500"); 
        var timer = setInterval(function(res) { 
            if(win.closed) {
                clearInterval(timer);
                location.reload();
            }
        }, 100);
    })
})