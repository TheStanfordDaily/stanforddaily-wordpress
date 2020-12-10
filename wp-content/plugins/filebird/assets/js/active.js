jQuery( document ).ready(function() {
    jQuery('.login_envato_now').on('click', function(){
        var win = window.open(fbv_data.login_envato_url, "", "width=500,height=500"); 
        var timer = setInterval(function(res) { 
            if(win.closed) {
                clearInterval(timer);
                jQuery.ajax({
                    dataType: 'json',
                    url: ajaxurl,
                    data: {
                        action: 'fb_get_saved_envato_token'
                    }
                })
                .done(function(res){
                    jQuery('input[name="fb_envato_token"]').val(res.data.token)
                })
                .fail(function(res){
                    console.log(res)
                    alert('Can not get Token, please see console for detail.');
                })
            }
        }, 100);
    })
    jQuery('.fb_active_license').on('click', function(){
        var $this = jQuery(this)
        //var purchase_code = jQuery('input[name="fb_purchase_code"]').val()
        var envato_token = jQuery('input[name="fb_envato_token"]').val()
        // if(purchase_code == '') {
        //     alert(fbv_data.i18n.purchase_code_missing);
        // } else 
        if(envato_token == '') {
            alert(fbv_data.i18n.envato_token_missing);
        } else {
            $this.addClass('updating-message')
            jQuery.ajax({
                //dataType: 'json',
                url: ajaxurl,
                method: 'POST',
                data: {
                    action: 'filebird_active_license',
                    //purchase_code: purchase_code,
                    envato_token: envato_token
                }
            })
            .done(function(res){
                $this.removeClass('updating-message')
                if(res.success) {
                    location.reload()
                } else {
                    alert(res.data.mess);
                }
            })
            .fail(function(res){
                console.log(res)
                $this.removeClass('updating-message')
                alert('Can not active your License, please see console for detail.');
            })
        }
    })
    
})