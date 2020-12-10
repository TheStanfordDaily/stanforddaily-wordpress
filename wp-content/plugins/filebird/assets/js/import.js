jQuery( document ).ready(function() {
  var toastr_opt = {
    closeButton: true,
    showDuration: 300,
    hideDuration: 200,
    hideMethod: "slideUp"
  }
  //import from old version
  jQuery('.njt_fbv_import_from_old_now').click(function(){
    var $this = jQuery(this)
    if($this.hasClass('updating-message')) return false;

    $this.addClass('updating-message')

    get_folders(function(res) {
      if(res.success) {
        insert_folder(res.data.folders, 0, function(){
          $this.removeClass('updating-message')
          setTimeout(() => {
            var mess = '<p>' + fbv_data.i18n.filebird_db_updated + '</p>';
            mess += '<a href="' + fbv_data.media_url + '" class="button button-primary">'+ fbv_data.i18n.go_to_media + '</a>';
            toastr.success(mess, '', {...toastr_opt, timeOut: 0, extendedTimeOut: 0})
          }, 100);
          if(typeof njt_auto_run_import != 'undefined' && njt_auto_run_import == true) {
            location.replace(njt_fb_settings_page)
          }
        }, function(){
          $this.removeClass('updating-message')
        })
      }
    }, function(){
      $this.removeClass('updating-message')
      toastr.error(fbv_data.i18n.import_failed, '', {...toastr_opt, timeOut: 0, extendedTimeOut: 0})
    })

    function get_folders(onDone, onFail) {
      jQuery.ajax({
        dataType: 'json',
        url: fbv_data.json_url + '/fb-get-old-data',
        method: 'POST',
        beforeSend: function ( xhr ) {
          xhr.setRequestHeader( 'X-WP-Nonce', fbv_data.rest_nonce )
        }
      })
      .done(function(res){
        onDone(res)
      })
      .fail(function(res){
        onFail(res)
      })
    }
    function insert_folder(folders, index, onDone, onFail) {
      if(typeof folders[index] != 'undefined') {
        jQuery.ajax({
          dataType: 'json',
          contentType: 'application/json',
          url: fbv_data.json_url + '/fb-insert-old-data',
          method: 'POST',
          beforeSend: function ( xhr ) {
            xhr.setRequestHeader( 'X-WP-Nonce', fbv_data.rest_nonce )
          },
          data: JSON.stringify({
            folders: folders[index],
            autorun: (typeof njt_auto_run_import != 'undefined') && njt_auto_run_import == true
          })
        })
        .done(function(res){
          insert_folder(folders, index + 1, onDone, onFail)
        })
        .fail(function(res){
          onFail();
          toastr.error('Please try again.', '', {...toastr_opt, timeOut: 0, extendedTimeOut: 0})
        })
      } else {
        onDone()
      }
    }
  })
  //wipe old data
  jQuery('.njt_fbv_wipe_old_data').click(function(){
    if(!confirm(fbv_data.i18n.are_you_sure)) return false;
    
    var $this = jQuery(this)

    if($this.hasClass('updating-message')) return false;

    $this.addClass('updating-message')
    jQuery.ajax({
        dataType: 'json',
        url: fbv_data.json_url + '/fb-wipe-old-data',
        method: 'POST',
        beforeSend: function ( xhr ) {
          xhr.setRequestHeader( 'X-WP-Nonce', fbv_data.rest_nonce )
        }
    })
    .done(function(res){
      $this.removeClass('updating-message')
      toastr.success(res.data.mess, '', toastr_opt)
    })
    .fail(function(res){
        $this.removeClass('updating-message')
        toastr.error(res.data.mess, '', toastr_opt)
    })
  })
  //clear all data
  jQuery('.njt_fbv_clear_all_data').click(function(){
    if(!confirm(fbv_data.i18n.are_you_sure)) return false;

    var $this = jQuery(this)

    if($this.hasClass('updating-message')) return false;


    $this.addClass('updating-message')
    jQuery.ajax({
      dataType: 'json',
      url: fbv_data.json_url + '/fb-wipe-clear-all-data',
      method: 'POST',
      beforeSend: function ( xhr ) {
        xhr.setRequestHeader( 'X-WP-Nonce', fbv_data.rest_nonce )
      }
    })
    .done(function(res){
      $this.removeClass('updating-message')
      toastr.success(res.data.mess, '', toastr_opt)
    })
    .fail(function(res){
        $this.removeClass('updating-message')
        toastr.error(res.data.mess, '', toastr_opt)
    })
  })
  //no thanks btn
  jQuery('.njt_fb_no_thanks_btn').click(function(){
    var $this = jQuery(this);
    $this.addClass('updating-message')
    jQuery.ajax({
      dataType: 'json',
      type: "post",
      url: fbv_data.json_url + '/fb-no-thanks',
      beforeSend: function ( xhr ) {
        xhr.setRequestHeader( 'X-WP-Nonce', fbv_data.rest_nonce );
      },
      data: {
        nonce: fbv_data.nonce,
        site: $this.data('site')
      },
      success: function (res) {
        $this.removeClass('updating-message');
        jQuery('.njt.notice.notice-warning.' + $this.data('site')).hide()
      }
    })
    .fail(function(res){
        $this.removeClass('updating-message');
        toastr.error('Please try again later', '', toastr_opt)
      });
  })
  jQuery('.njt-fb-import').click(function(){
    var $this = jQuery(this)
    $this.addClass('updating-message')
      jQuery.ajax({
        dataType: 'json',
        contentType: 'application/json',
        url: fbv_data.json_url + '/fb-import',
        method: 'POST',
        beforeSend: function ( xhr ) {
          xhr.setRequestHeader( 'X-WP-Nonce', fbv_data.rest_nonce )
        },
        data: JSON.stringify({
          site: $this.data('site'),
          count: $this.data('count')
        })
    })
    .done(function(res){
      if(res.data.folders) {
        var folders = res.data.folders
        var site = res.data.site
        var count = res.data.count
        import_site(folders, site, 0, {count: count}, function(res){
          if(res.success) {
            $this.removeClass('updating-message')
            var html_notice = '<div class="njt-success-notice notice notice-success is-dismissible"><p>'+res.data.mess+'</p><button type="button" class="notice-dismiss" onClick="jQuery(\'.njt-success-notice\').remove()"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
            jQuery(html_notice).insertBefore('form#post');
          }
        })
      } else {
        $this.removeClass('updating-message')
        toastr.error(res.data.mess, '', toastr_opt)
      }
        
    })
    .fail(function(res){
        $this.removeClass('updating-message')
        toastr.error('Please try again later', '', toastr_opt)
    })
    
  })
  function import_site(folders, site, index, more_data_when_done, on_done) {
    if(typeof folders[index] != 'undefined') {
      jQuery.ajax({
        dataType: 'json',
        contentType: 'application/json',
        url: fbv_data.json_url + '/fb-import-insert-folder',
        method: 'POST',
        beforeSend: function ( xhr ) {
          xhr.setRequestHeader( 'X-WP-Nonce', fbv_data.rest_nonce )
        },
        data: JSON.stringify({
          site: site,
          folders: folders[index]
        })
      })
      .done(function(res){
        import_site(folders, site, index + 1, more_data_when_done, on_done)
      })
    } else {
      jQuery.ajax({
        dataType: 'json',
        url: fbv_data.json_url + '/fb-import-after-inserting',
        method: 'POST',
        beforeSend: function ( xhr ) {
          xhr.setRequestHeader( 'X-WP-Nonce', fbv_data.rest_nonce )
        },
        data: {
            site: site,
            count: more_data_when_done.count
        }
      })
      .done(function(res){
        on_done(res)
      })
    } 
  }


  //generate API key
  jQuery('.fbv_generate_api_key_now').click(function(){
    if(!confirm(fbv_data.i18n.are_you_sure)) return false;
    var $this = jQuery(this);
    $this.addClass('updating-message')
    jQuery.ajax({
      dataType: 'json',
      type: "post",
      url: fbv_data.json_url + '/fbv-api',
      beforeSend: function ( xhr ) {
        xhr.setRequestHeader( 'X-WP-Nonce', fbv_data.rest_nonce );
      },
      data: {
        act: 'generate-key'
      },
      success: function (res) {
        $this.removeClass('updating-message');
        if(res.success) {
          var key = res.data.key
          jQuery('#fbv_rest_api_key').removeClass('hidden');
          jQuery('#fbv_rest_api_key').val(key)
        } else {
          toastr.error(res.data.mess, '', toastr_opt)
        }
      }
    })
    .fail(function(res){
        $this.removeClass('updating-message');
        toastr.error('Please try again later', '', toastr_opt)
      });
  })
  //submit form
  jQuery('input.njt-submittable').on('change', function(){
    var $this = jQuery(this)
    var data = $this.closest('form').serializeArray()
    let slider = $this.closest('.njt-switch').find('span.slider')
    if(slider.length) {
      slider.addClass('njt_loading')
    }
    jQuery.post('options.php', data)
    .success(function(res){
      if(slider.length) {
        slider.removeClass('njt_loading')
      }
      toastr.success('Changes Saved', '', toastr_opt)
    })
    .error(function(res){
      if(slider.length) {
        slider.removeClass('njt_loading')
      }
      toastr.error('Please try again later.', '', toastr_opt)
    })
  })
  //notice dismiss
  jQuery('#filebird-empty-folder-notice').on('click', function(event){
    if (jQuery(event.target).hasClass('notice-dismiss')){
      jQuery.ajax({
        dataType: 'json',
        url: window.ajaxurl,
        type: "post",
        data: {
          action: "fbv_first_folder_notice",
          nonce: window.fbv_data.nonce,
        },
      })
      .done(function (result) {})
      .fail(function (res) {});
    }
  })
})